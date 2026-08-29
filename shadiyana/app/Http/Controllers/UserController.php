<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get All Users
    |--------------------------------------------------------------------------
    */
    public function getUsers()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }


    /*
    |--------------------------------------------------------------------------
    | Get User By ID
    |--------------------------------------------------------------------------
    */
    public function getUserById($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }


    /*
    |--------------------------------------------------------------------------
    | Show Create User Form
    |--------------------------------------------------------------------------
    */
    public function createUser()
    {
        return view('users.create');
    }


    /*
    |--------------------------------------------------------------------------
    | Create User
    |--------------------------------------------------------------------------
    */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'country_code' => 'required|string|max:10',

            'email' => 'required|email|max:255|unique:users,email',

            'password' => 'required|string|min:8|confirmed',

            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'role' => 'required|in:vendor,customer',

            'status' => 'required|in:active,inactive',

            'is_verified' => 'nullable|boolean',
        ]);


        DB::transaction(function () use ($request, $validated) {

            /*
            |--------------------------------------------------------------------------
            | Profile Image
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('profile_image')) {

                $validated['profile_image'] = $request
                    ->file('profile_image')
                    ->store('profile-images', 'public');
            }


            /*
            |--------------------------------------------------------------------------
            | User Verification
            |--------------------------------------------------------------------------
            */

            $isVerified = $request->boolean('is_verified');

            $validated['is_verified'] = $isVerified;


            /*
            |--------------------------------------------------------------------------
            | Create User
            |--------------------------------------------------------------------------
            */

            $user = User::create($validated);


            /*
            |--------------------------------------------------------------------------
            | Create Vendor Profile
            |--------------------------------------------------------------------------
            |
            | Every user whose role is vendor must have exactly one
            | vendor profile.
            |
            */

            if ($user->role === 'vendor') {

                $this->createVendorProfile(
                    $user,
                    $isVerified
                );
            }
        });


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit User Form
    |--------------------------------------------------------------------------
    */
    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }


    /*
    |--------------------------------------------------------------------------
    | Update User By ID
    |--------------------------------------------------------------------------
    */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        |
        | Role is intentionally NOT accepted from the request.
        |
        | An administrator should not convert a customer into a vendor
        | or vendor into customer from the normal User Edit screen.
        |
        | Role changes should be handled through a dedicated workflow
        | later if the business requires them.
        |
        */

        $validated = $request->validate([

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'phone_number' => [
                'required',
                'string',
                'max:20',
            ],

            'country_code' => [
                'required',
                'string',
                'max:10',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],

            'is_verified' => [
                'nullable',
                'boolean',
            ],
        ]);


        DB::transaction(function () use (
            $request,
            $validated,
            $user
        ) {

            /*
            |--------------------------------------------------------------------------
            | Profile Image
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('profile_image')) {

                if (
                    $user->profile_image &&
                    Storage::disk('public')->exists(
                        $user->profile_image
                    )
                ) {
                    Storage::disk('public')->delete(
                        $user->profile_image
                    );
                }

                $validated['profile_image'] = $request
                    ->file('profile_image')
                    ->store('profile-images', 'public');
            }


            /*
            |--------------------------------------------------------------------------
            | Password
            |--------------------------------------------------------------------------
            */

            if (empty($validated['password'])) {
                unset($validated['password']);
            }


            /*
            |--------------------------------------------------------------------------
            | Verification
            |--------------------------------------------------------------------------
            |
            | Checkbox unchecked = false.
            |
            */

            $isVerified = $request->boolean('is_verified');

            $validated['is_verified'] = $isVerified;


            /*
            |--------------------------------------------------------------------------
            | Update User
            |--------------------------------------------------------------------------
            */

            $user->update($validated);


            /*
            |--------------------------------------------------------------------------
            | Synchronize Vendor Verification
            |--------------------------------------------------------------------------
            |
            | User and Vendor verification must always remain synchronized
            | for vendor accounts.
            |
            */

            if ($user->role === 'vendor') {

                $vendor = Vendor::where(
                    'user_id',
                    $user->id
                )->first();

                /*
                |----------------------------------------------------------------------
                | Safety Net
                |----------------------------------------------------------------------
                |
                | If somehow a vendor user does not have a vendor record,
                | create it automatically.
                |
                */

                if (! $vendor) {

                    $vendor = $this->createVendorProfile(
                        $user,
                        $isVerified
                    );

                } else {

                    /*
                    |------------------------------------------------------------------
                    | Synchronize Verification
                    |------------------------------------------------------------------
                    */

                    $vendor->update([

                        'is_verified' => $isVerified,

                        'verified_at' => $isVerified
                            ? ($vendor->verified_at ?? now())
                            : null,

                    ]);
                }
            }
        });


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete User By ID
    |--------------------------------------------------------------------------
    */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        DB::transaction(function () use ($user) {

            /*
            |--------------------------------------------------------------------------
            | Delete Vendor Profile
            |--------------------------------------------------------------------------
            |
            | If this user owns a vendor profile, remove the vendor profile
            | as well.
            |
            */

            if ($user->role === 'vendor') {

                $vendor = Vendor::where(
                    'user_id',
                    $user->id
                )->first();

                if ($vendor) {

                    /*
                    |------------------------------------------------------------------
                    | Delete Vendor Images
                    |------------------------------------------------------------------
                    */

                    if (
                        $vendor->logo_image &&
                        Storage::disk('public')->exists(
                            $vendor->logo_image
                        )
                    ) {
                        Storage::disk('public')->delete(
                            $vendor->logo_image
                        );
                    }

                    if (
                        $vendor->cover_image &&
                        Storage::disk('public')->exists(
                            $vendor->cover_image
                        )
                    ) {
                        Storage::disk('public')->delete(
                            $vendor->cover_image
                        );
                    }

                    $vendor->delete();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Delete User Profile Image
            |--------------------------------------------------------------------------
            */

            if (
                $user->profile_image &&
                Storage::disk('public')->exists(
                    $user->profile_image
                )
            ) {
                Storage::disk('public')->delete(
                    $user->profile_image
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Delete User
            |--------------------------------------------------------------------------
            */

            $user->delete();
        });


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Create Vendor Profile
    |--------------------------------------------------------------------------
    |
    | Centralized vendor creation logic.
    |
    */
    private function createVendorProfile(
        User $user,
        bool $isVerified = false
    ): Vendor {

        /*
        |--------------------------------------------------------------------------
        | Generate Business Name
        |--------------------------------------------------------------------------
        */

        $businessName = trim(
            $user->first_name . ' ' . $user->last_name
        );


        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $slug = $this->generateUniqueVendorSlug(
            $businessName
        );


        /*
        |--------------------------------------------------------------------------
        | Create Vendor
        |--------------------------------------------------------------------------
        */

        return Vendor::create([

            'user_id' => $user->id,

            'business_name' => $businessName,

            'slug' => $slug,

            'description' => null,

            'phone_number' => $user->phone_number,

            'whatsapp_number' => null,

            'email' => $user->email,

            'logo_image' => null,

            'cover_image' => null,

            'address' => null,

            'city_id' => null,

            'latitude' => null,

            'longitude' => null,

            /*
            |----------------------------------------------------------------------
            | Vendor Status
            |----------------------------------------------------------------------
            |
            | A newly created vendor should remain pending even if
            | the user account itself is verified.
            |
            */

            'status' => 'pending',

            /*
            |----------------------------------------------------------------------
            | Verification
            |----------------------------------------------------------------------
            */

            'is_verified' => $isVerified,

            'verified_at' => $isVerified
                ? now()
                : null,

            /*
            |----------------------------------------------------------------------
            | Vendor Flags
            |----------------------------------------------------------------------
            */

            'is_featured' => false,

            'is_premium' => false,

            /*
            |----------------------------------------------------------------------
            | Statistics
            |----------------------------------------------------------------------
            */

            'avg_rating' => 0,

            'review_count' => 0,

            'view_count' => 0,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Unique Vendor Slug
    |--------------------------------------------------------------------------
    */
    private function generateUniqueVendorSlug(
        string $businessName
    ): string {

        $baseSlug = Str::slug($businessName);

        /*
        |----------------------------------------------------------------------
        | Fallback
        |----------------------------------------------------------------------
        */

        if (empty($baseSlug)) {
            $baseSlug = 'vendor';
        }


        $slug = $baseSlug;

        $counter = 1;


        while (
            Vendor::where('slug', $slug)->exists()
        ) {

            $slug = $baseSlug . '-' . $counter;

            $counter++;
        }


        return $slug;
    }
}