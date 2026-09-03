<?php

namespace App\Http\Controllers;

use App\Models\CustomerProfile;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    /**
     * Show login page.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Authenticate user.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'phone_number' => [
                'required',
                'string',
                'max:30',
            ],
            'password' => [
                'required',
                'string',
            ],
        ]);

        if (!Auth::attempt([
            'phone_number' => $credentials['phone_number'],
            'password' => $credentials['password'],
        ])) {
            return back()
                ->withErrors([
                    'phone_number' => 'The provided phone number or password is incorrect.',
                ])
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();

        $user->update([
            'last_login_at' => now(),
        ]);

        return redirect()
            ->intended(route('dashboard'))
            ->with('success', 'Welcome back!');
    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    /**
     * Log the authenticated user out.
     */
    public function logout(Request $request): RedirectResponse
    {
Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Customer Registration
    |--------------------------------------------------------------------------
    */

    /**
     * Show customer registration page.
     *
     * Kept separate from vendor registration.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Register a customer.
     */
    public function registerCustomer(Request $request): RedirectResponse
    {
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
                'max:30',
                'unique:users,phone_number',
            ],

            'country_code' => [
                'required',
                'string',
                'max:10',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        DB::transaction(function () use ($validated): void {
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone_number' => $validated['phone_number'],
                'country_code' => $validated['country_code'],
                'email' => $validated['email'] ?? null,
                'password' => $validated['password'],
                'role' => 'customer',
                'is_verified' => false,
                'status' => 'active',
            ]);

            CustomerProfile::create([
                'user_id' => $user->id,
            ]);

            Auth::login($user);
        });

        return redirect()
            ->route('dashboard')
            ->with('success', 'Your account has been created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Vendor Registration
    |--------------------------------------------------------------------------
    */

    /**
     * Show vendor registration page.
     */
    public function showVendorRegister(): View
    {
        return view('auth.vendor-register');
    }

    /**
     * Register a new vendor/business.
     */
public function registerVendor(Request $request): RedirectResponse
{
    /*
    |--------------------------------------------------------------------------
    | Validate Vendor Registration
    |--------------------------------------------------------------------------
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

        'business_name' => [
            'required',
            'string',
            'max:255',
        ],

        'phone_number' => [
            'required',
            'string',
            'max:30',
            'unique:users,phone_number',
        ],

        'email' => [
            'nullable',
            'email',
            'max:255',
        ],

        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Create User + Vendor
    |--------------------------------------------------------------------------
    */

    DB::transaction(function () use ($validated, &$user) {

        /*
        |--------------------------------------------------------------------------
        | Create Vendor Owner User
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],

            'phone_number' => $validated['phone_number'],

            // Automatically set Pakistan country code
            'country_code' => '+92',

            'email' => $validated['email'] ?? null,

            'password' => $validated['password'],

            'role' => 'vendor',

            'is_verified' => false,

            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate Unique Vendor Slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($validated['business_name']);

        $originalSlug = $slug;
        $counter = 1;

        while (Vendor::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Vendor Profile
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Your vendors table requires user_id.
        |
        */

        Vendor::create([
            'user_id' => $user->id,

            'business_name' => $validated['business_name'],

            'slug' => $slug,

            'phone_number' => $validated['phone_number'],

            'status' => 'pending',

            'is_featured' => false,

            'is_premium' => false,

            'avg_rating' => 0,

            'review_count' => 0,

            'view_count' => 0,
        ]);
    });

    /*
    |--------------------------------------------------------------------------
    | Login Vendor
    |--------------------------------------------------------------------------
    */

   Auth::guard('web')->login($user);

$request->session()->regenerate();

return redirect()
    ->route('home')
    ->with(
        'success',
        'Your business has been registered successfully and is awaiting approval.'
    );
}

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    /**
     * Show authenticated user's profile.
     */
    public function profile(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $user->load([
            'vendor',
            'customerProfile.city',
        ]);

        return view('auth.profile', compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | Change Password
    |--------------------------------------------------------------------------
    */

    /**
     * Show change password page.
     */
    public function showChangePassword(): View
    {
        return view('auth.change-password');
    }

    /**
     * Change authenticated user's password.
     */
    public function changePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->update([
            'password' => $validated['password'],
        ]);

        return back()
            ->with('success', 'Your password has been changed successfully.');
    }
}