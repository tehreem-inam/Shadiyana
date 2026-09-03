<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Taxonomy;
use App\Models\Service;
use App\Models\EventType;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use League\CommonMark\CommonMarkConverter;

class VendorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Vendor Statuses
    |--------------------------------------------------------------------------
    */

    private const STATUSES = [
        'pending',
        'active',
        'inactive',
        'suspended',
        'rejected',
    ];


  /**
 * Display a listing of vendors.
 */
public function index(Request $request): View
{
    
    //Base Query
   
    // Load the relationships required by the vendor listing.

    $query = Vendor::query()
        ->with([
            'user',
            'city.state',
        ]);


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    |
    | Search vendor information as well as vendor-owner information.
    |
    */

    if ($request->filled('search')) {

        $search = trim($request->search);

        $query->where(function ($q) use ($search) {

            /*
            | Vendor fields
            */

            $q->where(
                'business_name',
                'ilike',
                "%{$search}%"
            )
            ->orWhere(
                'phone_number',
                'ilike',
                "%{$search}%"
            )
            ->orWhere(
                'whatsapp_number',
                'ilike',
                "%{$search}%"
            )
            ->orWhere(
                'email',
                'ilike',
                "%{$search}%"
            );


            /*
            | Vendor owner fields
            */

            $q->orWhereHas('user', function ($userQuery) use ($search) {

                $userQuery->where(function ($user) use ($search) {

                    $user->where(
                        'first_name',
                        'ilike',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'last_name',
                        'ilike',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'email',
                        'ilike',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'phone_number',
                        'ilike',
                        "%{$search}%"
                    );

                });

            });

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Status Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where(
            'status',
            $request->status
        );
    }


    /*
    |--------------------------------------------------------------------------
    | City Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('city_id')) {

        $query->where(
            'city_id',
            $request->city_id
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Verification Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('is_verified')) {

        $query->where(
            'is_verified',
            $request->is_verified
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Featured Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('is_featured')) {

        $query->where(
            'is_featured',
            $request->is_featured
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Premium Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('is_premium')) {

        $query->where(
            'is_premium',
            $request->is_premium
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Sorting
    |--------------------------------------------------------------------------
    */

    $sort = $request->get(
        'sort',
        'latest'
    );

    switch ($sort) {

        case 'oldest':

            $query->orderBy(
                'created_at',
                'asc'
            );

            break;


        case 'business_name_asc':

            $query->orderBy(
                'business_name',
                'asc'
            );

            break;


        case 'business_name_desc':

            $query->orderBy(
                'business_name',
                'desc'
            );

            break;


        case 'rating':

            $query->orderBy(
                'avg_rating',
                'desc'
            );

            break;


        case 'views':

            $query->orderBy(
                'view_count',
                'desc'
            );

            break;


        case 'latest':

        default:

            $query->orderBy(
                'created_at',
                'desc'
            );

            break;
    }


    /*
    |--------------------------------------------------------------------------
    | Vendors
    |--------------------------------------------------------------------------
    */

    $vendors = $query
        ->paginate(15)
        ->withQueryString();


    /*
    |--------------------------------------------------------------------------
    | Cities
    |--------------------------------------------------------------------------
    |
    | Used by the City filter in the index Blade.
    |
    */

    $cities = City::query()
        ->with('state')
        ->orderBy('name')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Vendor Users
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    |
    | The index Blade uses $users for the Vendor Owner filter / UI.
    |
    | We include:
    |
    | 1. Vendor users who do not yet have a vendor profile.
    | 2. Existing vendor owners.
    |
    | This makes the owner data available without causing:
    |
    | Undefined variable $users
    |
    */

    $users = User::query()
        ->where('role', 'vendor')
        ->with('vendor')
        ->orderBy('first_name')
        ->orderBy('last_name')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    |
    | Keep these values consistent with STATUSES.
    |
    | STATUSES:
    | pending
    | active
    | inactive
    | suspended
    | rejected
    |
    */

    $stats = [

        /*
        | Total
        */

        'total' => Vendor::count(),


        /*
        | Statuses
        */

        'pending' => Vendor::where(
            'status',
            'pending'
        )->count(),

        'active' => Vendor::where(
            'status',
            'active'
        )->count(),

        'inactive' => Vendor::where(
            'status',
            'inactive'
        )->count(),

        'suspended' => Vendor::where(
            'status',
            'suspended'
        )->count(),

        'rejected' => Vendor::where(
            'status',
            'rejected'
        )->count(),


        /*
        | Verification
        */

        'verified' => Vendor::where(
            'is_verified',
            true
        )->count(),


        /*
        | Featured
        */

        'featured' => Vendor::where(
            'is_featured',
            true
        )->count(),


        /*
        | Premium
        */

        'premium' => Vendor::where(
            'is_premium',
            true
        )->count(),
    ];


    /*
    |--------------------------------------------------------------------------
    | Return View
    |--------------------------------------------------------------------------
    */

    return view(
        'vendors.index',
        compact(
            'vendors',
            'users',
            'cities',
            'stats'
        )
    );
}



/**
 * Show the form for creating a new vendor.
 *
 * Super Admin creates both:
 * 1. Vendor user account
 * 2. Vendor business profile
 */
public function create(): View
{
    /*
    |--------------------------------------------------------------------------
    | Cities
    |--------------------------------------------------------------------------
    */

    $cities = City::query()
        ->with('state')
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    */

    $taxonomies = Taxonomy::query()
        ->where('status', 'active')
        ->with('parent')
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    $services = Service::query()
        ->where('status', 'active')
        ->with('taxonomy')
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Event Types
    |--------------------------------------------------------------------------
    */

    $eventTypes = EventType::query()
        ->where('status', 'active')
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Return View
    |--------------------------------------------------------------------------
    */

    return view('vendors.create', compact(
        'cities',
        'taxonomies',
        'services',
        'eventTypes'
    ));
}
    /*
    |--------------------------------------------------------------------------
    | Store Vendor
    |--------------------------------------------------------------------------
    */

/**
 * Store a newly created vendor.
 *
 * Super Admin creates:
 * 1. Vendor User account
 * 2. Vendor business profile
 */
public function store(Request $request): RedirectResponse
{
    $validated = $this->validateVendor($request);

    /*
    |--------------------------------------------------------------------------
    | Generate Vendor Slug
    |--------------------------------------------------------------------------
    */

    $slug = $this->generateUniqueSlug(
        $validated['slug']
            ?? $validated['business_name']
    );

    /*
    |--------------------------------------------------------------------------
    | Verification
    |--------------------------------------------------------------------------
    */

    $isVerified = $request->boolean('is_verified');

    /*
    |--------------------------------------------------------------------------
    | Resolve Coordinates
    |--------------------------------------------------------------------------
    |
    | Prefer the latitude/longitude submitted from the map on the form
    | (the user explicitly pinned/confirmed this location).
    |
    | Only fall back to server-side geocoding if the coordinates were
    | not submitted for some reason.
    |
    */

    $latitude  = $validated['latitude']  ?? null;
    $longitude = $validated['longitude'] ?? null;

    if (is_null($latitude) || is_null($longitude)) {

        $coordinates = $this->geocodeLocation(
            $validated['address'] ?? null,
            $validated['city_id'] ?? null
        );

        $latitude  = $coordinates['latitude'];
        $longitude = $coordinates['longitude'];
    }

    /*
    |--------------------------------------------------------------------------
    | Create User + Vendor
    |--------------------------------------------------------------------------
    |
    | Both records are created inside one transaction.
    |
    | If Vendor creation fails, the User is also rolled back.
    |
    */

    $vendor = DB::transaction(function () use (
        $validated,
        $request,
        $slug,
        $isVerified,
        $latitude,
        $longitude
    ) {

        /*
        |--------------------------------------------------------------------------
        | Create Vendor User Account
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'first_name' => $validated['first_name'],

            'last_name' => $validated['last_name'],

            'phone_number' => $validated['account_phone_number'],

            'country_code' => $validated['country_code'],

            'email' => $validated['account_email'] ?? null,

            'password' => $validated['password'],

            'role' => 'vendor',

            'is_verified' => $isVerified,

            'status' => 'active',

            'last_login_at' => null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Vendor Profile
        |--------------------------------------------------------------------------
        */

        $vendor = Vendor::create([

            /*
            |--------------------------------------------------------------------------
            | Owner
            |--------------------------------------------------------------------------
            */

            'user_id' => $user->id,

            /*
            |--------------------------------------------------------------------------
            | Business
            |--------------------------------------------------------------------------
            */

            'business_name' =>
                $validated['business_name'],

            'slug' =>
                $slug,

            'description' =>
                $validated['description'] ?? null,

            /*
            |--------------------------------------------------------------------------
            | Business Contact
            |--------------------------------------------------------------------------
            */

            'phone_number' =>
                $validated['phone_number'],

            'whatsapp_number' =>
                $validated['whatsapp_number'] ?? null,

            'email' =>
                $validated['email'] ?? null,

            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */

            'address' =>
                $validated['address'] ?? null,

            'city_id' =>
                $validated['city_id'] ?? null,

            'latitude' =>
                $latitude,

            'longitude' =>
                $longitude,

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' =>
                $validated['status'],

            /*
            |--------------------------------------------------------------------------
            | Verification
            |--------------------------------------------------------------------------
            */

            'is_verified' =>
                $isVerified,

            'verified_at' =>
                $isVerified
                    ? now()
                    : null,

            /*
            |--------------------------------------------------------------------------
            | Visibility Flags
            |--------------------------------------------------------------------------
            */

            'is_featured' =>
                $request->boolean('is_featured'),

            'is_premium' =>
                $request->boolean('is_premium'),

            /*
            |--------------------------------------------------------------------------
            | Statistics
            |--------------------------------------------------------------------------
            */

            'avg_rating' => 0,

            'review_count' => 0,

            'view_count' => 0,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo_image')) {

            $logoPath = $request
                ->file('logo_image')
                ->store(
                    'vendors/logos',
                    'public'
                );

            $vendor->update([
                'logo_image' => $logoPath,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Cover Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            $coverPath = $request
                ->file('cover_image')
                ->store(
                    'vendors/covers',
                    'public'
                );

            $vendor->update([
                'cover_image' => $coverPath,
            ]);
        }

        return $vendor;
    });

    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('vendors.show', $vendor)
        ->with(
            'success',
            'Vendor account and vendor profile created successfully.'
        );
}

    /*
    |--------------------------------------------------------------------------
    | Display Vendor
    |--------------------------------------------------------------------------
    */

    public function show(Vendor $vendor): View
    {
        $vendor->load([
            'user',
            'city.state',
            'taxonomies',
            'services',
            'eventTypes',
            'images',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Markdown
        |--------------------------------------------------------------------------
        |
        | Keep Markdown in database.
        | Convert to HTML only when displaying it.
        |
        */

        $descriptionHtml = null;

        if ($vendor->description) {

            $converter = new CommonMarkConverter([
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]);

            $descriptionHtml = $converter
                ->convert(
                    $vendor->description
                )
                ->getContent();
        }


        return view(
            'vendors.show',
            compact(
                'vendor',
                'descriptionHtml'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Form
    |--------------------------------------------------------------------------
    */

    public function edit(Vendor $vendor): View
    {
        $vendor->load([
            'user',
            'city.state',
            'images',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Vendor Users
        |--------------------------------------------------------------------------
        |
        | Include:
        |
        | 1. Vendor users without a profile
        | 2. Current vendor owner
        |
        */

        $users = User::query()
            ->where('role', 'vendor')
            ->where(function ($query) use ($vendor) {

                $query
                    ->whereDoesntHave('vendor')
                    ->orWhere(
                        'id',
                        $vendor->user_id
                    );

            })
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Cities
        |--------------------------------------------------------------------------
        */

        $cities = City::query()
            ->with('state')
            ->orderBy('name')
            ->get();


        return view(
            'vendors.edit',
            compact(
                'vendor',
                'users',
                'cities'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Vendor
    |--------------------------------------------------------------------------
    */
/*
|--------------------------------------------------------------------------
| Update Vendor
|--------------------------------------------------------------------------
*/

public function update(
    Request $request,
    Vendor $vendor
): RedirectResponse {

    /*
    |--------------------------------------------------------------------------
    | Validate Request
    |--------------------------------------------------------------------------
    */

    $validated = $this->validateVendor(
        $request,
        $vendor
    );


    /*
    |--------------------------------------------------------------------------
    | Current Vendor User
    |--------------------------------------------------------------------------
    */

    $user = $vendor->user;

    if (! $user) {

        return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'user' => 'The vendor owner account could not be found.',
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Resolve Coordinates
    |--------------------------------------------------------------------------
    |
    | Prefer the latitude/longitude submitted from the map on the form
    | (the user explicitly pinned/confirmed this location).
    |
    | Only fall back to server-side geocoding if the coordinates were
    | not submitted for some reason.
    |
    */

    $latitude  = $validated['latitude']  ?? null;
    $longitude = $validated['longitude'] ?? null;

    if (is_null($latitude) || is_null($longitude)) {

        $coordinates = $this->geocodeLocation(
            $validated['address'] ?? null,
            $validated['city_id'] ?? null
        );

        $latitude  = $coordinates['latitude'];
        $longitude = $coordinates['longitude'];
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Slug
    |--------------------------------------------------------------------------
    */

    $slug = $this->generateUniqueSlug(
        $validated['slug']
            ?? $validated['business_name'],
        $vendor->id
    );


    /*
    |--------------------------------------------------------------------------
    | Verification
    |--------------------------------------------------------------------------
    */

    $isVerified = $request->boolean(
        'is_verified'
    );

    $verifiedAt = $isVerified
        ? ($vendor->verified_at ?? now())
        : null;


    /*
    |--------------------------------------------------------------------------
    | Update User + Vendor
    |--------------------------------------------------------------------------
    */

    DB::transaction(function () use (
        $request,
        $vendor,
        $user,
        $validated,
        $latitude,
        $longitude,
        $slug,
        $isVerified,
        $verifiedAt
    ) {

        /*
        |--------------------------------------------------------------------------
        | Update Vendor Account User
        |--------------------------------------------------------------------------
        */

        $userData = [

            'first_name' =>
                $validated['first_name'],

            'last_name' =>
                $validated['last_name'],

            'phone_number' =>
                $validated['account_phone_number'],

            'country_code' =>
                $validated['country_code'],

            'email' =>
                $validated['account_email'] ?? null,

            'is_verified' =>
                $isVerified,

            'status' =>
                'active',
        ];


        /*
        |--------------------------------------------------------------------------
        | Update Password Only If Provided
        |--------------------------------------------------------------------------
        */

        if (
            ! empty($validated['password'])
        ) {

            $userData['password'] =
                $validated['password'];
        }


        $user->update($userData);


        /*
        |--------------------------------------------------------------------------
        | Update Vendor
        |--------------------------------------------------------------------------
        */

        $vendor->update([

            /*
            |--------------------------------------------------------------------------
            | Business
            |--------------------------------------------------------------------------
            */

            'business_name' =>
                $validated['business_name'],

            'slug' =>
                $slug,

            'description' =>
                $validated['description'] ?? null,


            /*
            |--------------------------------------------------------------------------
            | Business Contact
            |--------------------------------------------------------------------------
            */

            'phone_number' =>
                $validated['phone_number'],

            'whatsapp_number' =>
                $validated['whatsapp_number'] ?? null,

            'email' =>
                $validated['email'] ?? null,


            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */

            'address' =>
                $validated['address'] ?? null,

            'city_id' =>
                $validated['city_id'] ?? null,

            'latitude' =>
                $latitude,

            'longitude' =>
                $longitude,


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' =>
                $validated['status'],


            /*
            |--------------------------------------------------------------------------
            | Verification
            |--------------------------------------------------------------------------
            */

            'is_verified' =>
                $isVerified,

            'verified_at' =>
                $verifiedAt,


            /*
            |--------------------------------------------------------------------------
            | Visibility Flags
            |--------------------------------------------------------------------------
            */

            'is_featured' =>
                $request->boolean('is_featured'),

            'is_premium' =>
                $request->boolean('is_premium'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Replace Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo_image')) {

            $oldLogo =
                $vendor->logo_image;

            $newLogo = $request
                ->file('logo_image')
                ->store(
                    'vendors/logos',
                    'public'
                );

            $vendor->update([
                'logo_image' => $newLogo,
            ]);


            if (
                $oldLogo &&
                Storage::disk('public')
                    ->exists($oldLogo)
            ) {

                Storage::disk('public')
                    ->delete($oldLogo);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Replace Cover Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            $oldCover =
                $vendor->cover_image;

            $newCover = $request
                ->file('cover_image')
                ->store(
                    'vendors/covers',
                    'public'
                );

            $vendor->update([
                'cover_image' => $newCover,
            ]);


            if (
                $oldCover &&
                Storage::disk('public')
                    ->exists($oldCover)
            ) {

                Storage::disk('public')
                    ->delete($oldCover);
            }
        }
    });


    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route(
            'vendors.show',
            $vendor
        )
        ->with(
            'success',
            'Vendor account and profile updated successfully.'
        );
}

    /*
    |--------------------------------------------------------------------------
    | Delete Vendor
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Vendor $vendor
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Store Image Paths
        |--------------------------------------------------------------------------
        */

        $logo = $vendor->logo_image;

        $cover = $vendor->cover_image;


        /*
        |--------------------------------------------------------------------------
        | Delete Vendor
        |--------------------------------------------------------------------------
        |
        | Pivot records and vendor images should be removed through
        | database cascade relationships.
        |
        */

        DB::transaction(function () use ($vendor) {

            $vendor->delete();
        });


        /*
        |--------------------------------------------------------------------------
        | Delete Logo
        |--------------------------------------------------------------------------
        */

        if (
            $logo &&
            Storage::disk('public')->exists($logo)
        ) {

            Storage::disk('public')->delete($logo);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Cover
        |--------------------------------------------------------------------------
        */

        if (
            $cover &&
            Storage::disk('public')->exists($cover)
        ) {

            Storage::disk('public')->delete($cover);
        }


        return redirect()
            ->route('vendors.index')
            ->with(
                'success',
                'Vendor deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Logo
    |--------------------------------------------------------------------------
    */

    public function destroyLogo(
        Vendor $vendor
    ): RedirectResponse {

        $logo = $vendor->logo_image;


        if (
            $logo &&
            Storage::disk('public')->exists($logo)
        ) {

            Storage::disk('public')->delete($logo);
        }


        $vendor->update([
            'logo_image' => null,
        ]);


        return redirect()
            ->route(
                'vendors.edit',
                $vendor
            )
            ->with(
                'success',
                'Vendor logo removed successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Cover
    |--------------------------------------------------------------------------
    */

    public function destroyCover(
        Vendor $vendor
    ): RedirectResponse {

        $cover = $vendor->cover_image;


        if (
            $cover &&
            Storage::disk('public')->exists($cover)
        ) {

            Storage::disk('public')->delete($cover);
        }


        $vendor->update([
            'cover_image' => null,
        ]);


        return redirect()
            ->route(
                'vendors.edit',
                $vendor
            )
            ->with(
                'success',
                'Vendor cover image removed successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
private function validateVendor(
    Request $request,
    ?Vendor $vendor = null
): array {

    /*
    |--------------------------------------------------------------------------
    | Determine Create / Update
    |--------------------------------------------------------------------------
    */

    $isUpdate = $vendor !== null;

    /*
    |--------------------------------------------------------------------------
    | Current Vendor Owner
    |--------------------------------------------------------------------------
    |
    | During update, we ignore the current user's record when checking
    | unique phone number and email.
    |
    */

    $currentUserId = $vendor?->user_id;


    return $request->validate([

        /*
        |--------------------------------------------------------------------------
        | Vendor Account
        |--------------------------------------------------------------------------
        */

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

        'country_code' => [
            'required',
            'string',
            'max:10',
        ],

        /*
        |--------------------------------------------------------------------------
        | Account Phone Number
        |--------------------------------------------------------------------------
        |
        | CREATE:
        |   Must be unique.
        |
        | UPDATE:
        |   Ignore the current vendor owner's user record.
        |
        */

        'account_phone_number' => [
            'required',
            'string',
            'max:30',

            Rule::unique(
                'users',
                'phone_number'
            )->ignore($currentUserId),
        ],

        /*
        |--------------------------------------------------------------------------
        | Account Email
        |--------------------------------------------------------------------------
        |
        | CREATE:
        |   Must be unique.
        |
        | UPDATE:
        |   Ignore the current vendor owner's user record.
        |
        */

        'account_email' => [
            'nullable',
            'email',
            'max:255',

            Rule::unique(
                'users',
                'email'
            )->ignore($currentUserId),
        ],

        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        |
        | CREATE:
        |   Required.
        |
        | UPDATE:
        |   Optional.
        |
        | If empty during update, the old password remains unchanged.
        |
        */

        'password' => [
            $isUpdate ? 'nullable' : 'required',
            'string',
            'min:8',
            'confirmed',
        ],

        /*
        |--------------------------------------------------------------------------
        | Business Information
        |--------------------------------------------------------------------------
        */

        'business_name' => [
            'required',
            'string',
            'max:255',
        ],

        'slug' => [
            'nullable',
            'string',
            'max:255',

            Rule::unique(
                'vendors',
                'slug'
            )->ignore(
                $vendor?->id
            ),
        ],

        'description' => [
            'nullable',
            'string',
            'max:50000',
        ],

        /*
        |--------------------------------------------------------------------------
        | Business Contact Information
        |--------------------------------------------------------------------------
        */

        'phone_number' => [
            'required',
            'string',
            'max:30',
        ],

        'whatsapp_number' => [
            'nullable',
            'string',
            'max:30',
        ],

        'email' => [
            'nullable',
            'email',
            'max:255',
        ],

        /*
        |--------------------------------------------------------------------------
        | Logo
        |--------------------------------------------------------------------------
        */

        'logo_image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

        /*
        |--------------------------------------------------------------------------
        | Cover Image
        |--------------------------------------------------------------------------
        */

        'cover_image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:4096',
        ],

        /*
        |--------------------------------------------------------------------------
        | Location
        |--------------------------------------------------------------------------
        */

        'address' => [
            'nullable',
            'string',
            'max:1000',
        ],

        'city_id' => [
            'nullable',
            'integer',
            'exists:cities,id',
        ],

        /*
        |--------------------------------------------------------------------------
        | Coordinates
        |--------------------------------------------------------------------------
        |
        | Submitted from the Leaflet map on the create/edit form. These are
        | the user-confirmed coordinates and take priority over server-side
        | geocoding.
        |
        */

        'latitude' => [
            'nullable',
            'numeric',
            'between:-90,90',
        ],

        'longitude' => [
            'nullable',
            'numeric',
            'between:-180,180',
        ],

        /*
        |--------------------------------------------------------------------------
        | Vendor Status
        |--------------------------------------------------------------------------
        */

        'status' => [
            'required',
            Rule::in(self::STATUSES),
        ],

        /*
        |--------------------------------------------------------------------------
        | Verification
        |--------------------------------------------------------------------------
        */

        'is_verified' => [
            'nullable',
            'boolean',
        ],

        /*
        |--------------------------------------------------------------------------
        | Featured
        |--------------------------------------------------------------------------
        */

        'is_featured' => [
            'nullable',
            'boolean',
        ],

        /*
        |--------------------------------------------------------------------------
        | Premium
        |--------------------------------------------------------------------------
        */

        'is_premium' => [
            'nullable',
            'boolean',
        ],
    ]);
}
/*
|--------------------------------------------------------------------------
| Generate Unique Slug
|--------------------------------------------------------------------------
*/

private function generateUniqueSlug(
    string $value,
    ?int $ignoreId = null
): string {

    $slug = Str::slug($value);

    /*
    |--------------------------------------------------------------------------
    | Fallback
    |--------------------------------------------------------------------------
    */

    if ($slug === '') {
        $slug = 'vendor';
    }

    $originalSlug = $slug;
    $counter = 1;

    /*
    |--------------------------------------------------------------------------
    | Check Existing Slug
    |--------------------------------------------------------------------------
    */

    while (
        Vendor::query()
            ->where('slug', $slug)
            ->when(
                $ignoreId !== null,
                fn ($query) =>
                    $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    )
            )
            ->exists()
    ) {

        $slug = $originalSlug . '-' . $counter;

        $counter++;
    }

    return $slug;
}

/*
|--------------------------------------------------------------------------
| Geocode Vendor Location
|--------------------------------------------------------------------------
|
| Uses OpenStreetMap Nominatim to convert the vendor address/city
| into latitude and longitude.
|
| This is now only used as a FALLBACK when latitude/longitude were not
| submitted from the form's map. Geocoding is non-critical: if the
| external service fails, vendor create/update continues normally.
|
*/

private function geocodeLocation(
    ?string $address,
    ?int $cityId
): array {

    /*
    |--------------------------------------------------------------------------
    | Default Result
    |--------------------------------------------------------------------------
    */

    $result = [
        'latitude' => null,
        'longitude' => null,
    ];


    /*
    |--------------------------------------------------------------------------
    | Nothing To Geocode
    |--------------------------------------------------------------------------
    */

    if (
        blank($address) &&
        blank($cityId)
    ) {
        return $result;
    }


    /*
    |--------------------------------------------------------------------------
    | Get City Information
    |--------------------------------------------------------------------------
    */

    $city = null;

    if ($cityId) {

        $city = City::query()
            ->with('state')
            ->find($cityId);
    }


    /*
    |--------------------------------------------------------------------------
    | Build Search Query
    |--------------------------------------------------------------------------
    */

    $parts = [];


    if ($address) {

        $parts[] = trim($address);
    }


    if ($city) {

        $parts[] = $city->name;

        if (
            $city->state &&
            $city->state->name
        ) {

            $parts[] = $city->state->name;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Country
    |--------------------------------------------------------------------------
    */

    $parts[] = 'Pakistan';


    /*
    |--------------------------------------------------------------------------
    | Final Query
    |--------------------------------------------------------------------------
    */

    $query = implode(
        ', ',
        array_filter($parts)
    );


    /*
    |--------------------------------------------------------------------------
    | Nominatim Request
    |--------------------------------------------------------------------------
    */

    try {

        $response = Http::timeout(8)
            ->retry(
                2,
                300
            )
            ->withHeaders([

                'User-Agent' =>
                    config(
                        'app.name',
                        'Shadiyana'
                    ) .
                    ' Vendor Location Service ' .
                    config(
                        'app.url',
                        'http://localhost'
                    ),

                'Accept' =>
                    'application/json',

            ])
            ->get(
                'https://nominatim.openstreetmap.org/search',
                [
                    'q' => $query,
                    'format' => 'json',
                    'limit' => 1,
                    'addressdetails' => 1,
                    'countrycodes' => 'pk',
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | Request Failed
        |--------------------------------------------------------------------------
        */

        if (! $response->successful()) {

            return $result;
        }


        /*
        |--------------------------------------------------------------------------
        | Get First Location
        |--------------------------------------------------------------------------
        */

        $location = $response->json('0');


        if (
            ! is_array($location) ||
            ! isset(
                $location['lat'],
                $location['lon']
            )
        ) {

            return $result;
        }


        /*
        |--------------------------------------------------------------------------
        | Convert Coordinates
        |--------------------------------------------------------------------------
        */

        $latitude =
            (float) $location['lat'];

        $longitude =
            (float) $location['lon'];


        /*
        |--------------------------------------------------------------------------
        | Validate Coordinates
        |--------------------------------------------------------------------------
        */

        if (
            $latitude < -90 ||
            $latitude > 90 ||
            $longitude < -180 ||
            $longitude > 180
        ) {

            return $result;
        }


        /*
        |--------------------------------------------------------------------------
        | Return Coordinates
        |--------------------------------------------------------------------------
        */

        return [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

    } catch (ConnectionException $e) {

        /*
        |--------------------------------------------------------------------------
        | Connection Failure
        |--------------------------------------------------------------------------
        |
        | Geocoding should never prevent a vendor from being updated.
        |
        */

        return $result;

    } catch (\Throwable $e) {

        /*
        |--------------------------------------------------------------------------
        | Any Other Geocoding Error
        |--------------------------------------------------------------------------
        */

        return $result;
    }
}
}