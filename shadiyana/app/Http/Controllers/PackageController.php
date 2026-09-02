<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PackageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display a listing of packages
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $query = Package::query()
            ->with('vendor')
            ->withCount('packageServices');


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('name', 'ilike', "%{$search}%")
                    ->orWhere('description', 'ilike', "%{$search}%")
                    ->orWhereHas('vendor', function ($vendorQuery) use ($search) {
                        $vendorQuery->where(
                            'business_name',
                            'ilike',
                            "%{$search}%"
                        );
                    });

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Vendor Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('vendor_id')) {

            $query->where(
                'vendor_id',
                $request->vendor_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Pricing Type Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('pricing_type')) {

            $query->where(
                'pricing_type',
                $request->pricing_type
            );
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
        | Sorting
        |--------------------------------------------------------------------------
        */

        $sort = $request->get('sort', 'latest');

        match ($sort) {

            'oldest' => $query->oldest(),

            'name_asc' => $query->orderBy('name', 'asc'),

            'name_desc' => $query->orderBy('name', 'desc'),

            'price_low' => $query->orderByRaw(
                'COALESCE(price, min_price, 0) ASC'
            ),

            'price_high' => $query->orderByRaw(
                'COALESCE(price, max_price, 0) DESC'
            ),

            default => $query->latest(),

        };


        /*
        |--------------------------------------------------------------------------
        | Vendor Visibility
        |--------------------------------------------------------------------------
        |
        | Vendors can only see their own packages.
        | Super admins can see all packages.
        |
        */

        if (
            auth()->check() &&
            auth()->user()->role === 'vendor'
        ) {

            $vendor = Vendor::where(
                'owner_user_id',
                auth()->id()
            )->first();

            if ($vendor) {

                $query->where(
                    'vendor_id',
                    $vendor->id
                );

            } else {

                $query->whereRaw('1 = 0');

            }
        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $packages = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Filter Data
        |--------------------------------------------------------------------------
        */

        $vendors = collect();

        if (
            auth()->check() &&
            auth()->user()->role === 'super_admin'
        ) {

            $vendors = Vendor::query()
                ->orderBy('business_name')
                ->get([
                    'id',
                    'business_name',
                ]);
        }


        return view('packages.index', compact(
            'packages',
            'vendors'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Show Create Form
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        $vendors = collect();


        /*
        |--------------------------------------------------------------------------
        | Super Admin can select vendor
        |--------------------------------------------------------------------------
        */

        if (
            auth()->check() &&
            auth()->user()->role === 'super_admin'
        ) {

            $vendors = Vendor::query()
                ->orderBy('business_name')
                ->get([
                    'id',
                    'business_name',
                ]);
        }


        return view('packages.create', compact(
            'vendors'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Store Package
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'vendor_id' => [
                'nullable',
                'integer',
                'exists:vendors,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:packages,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'min_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'max_price' => [
                'nullable',
                'numeric',
                'min:0',
                'gte:min_price',
            ],

            'pricing_type' => [
                'required',
                'in:fixed,starting_from,price_range,per_person,custom',
            ],

            'duration' => [
                'nullable',
                'string',
                'max:255',
            ],

            'guest_capacity' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Resolve Vendor
        |--------------------------------------------------------------------------
        */

        if (
            auth()->check() &&
            auth()->user()->role === 'vendor'
        ) {

            $vendor = Vendor::where(
                'owner_user_id',
                auth()->id()
            )->firstOrFail();

            $validated['vendor_id'] = $vendor->id;

        } else {

            if (empty($validated['vendor_id'])) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'vendor_id' => 'Please select a vendor.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Generate Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['name']
        );


        /*
        |--------------------------------------------------------------------------
        | Create Package
        |--------------------------------------------------------------------------
        */

        $package = Package::create($validated);


        return redirect()
            ->route('packages.index')
            ->with(
                'success',
                "Package '{$package->name}' was created successfully."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Display Package
    |--------------------------------------------------------------------------
    */

    public function show(Package $package): View
    {
        $this->ensurePackageAccess($package);

        $package->load([
            'vendor',
            'packageServices.service',
        ]);

        return view(
            'packages.show',
            compact('package')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Form
    |--------------------------------------------------------------------------
    */

    public function edit(Package $package): View
    {
        $this->ensurePackageAccess($package);

        $vendors = collect();

        if (
            auth()->check() &&
            auth()->user()->role === 'super_admin'
        ) {

            $vendors = Vendor::query()
                ->orderBy('business_name')
                ->get([
                    'id',
                    'business_name',
                ]);
        }


        return view(
            'packages.edit',
            compact(
                'package',
                'vendors'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Package
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Package $package
    ): RedirectResponse {

        $this->ensurePackageAccess($package);


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'vendor_id' => [
                'nullable',
                'integer',
                'exists:vendors,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:packages,slug,' . $package->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'min_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'max_price' => [
                'nullable',
                'numeric',
                'min:0',
                'gte:min_price',
            ],

            'pricing_type' => [
                'required',
                'in:fixed,starting_from,price_range,per_person,custom',
            ],

            'duration' => [
                'nullable',
                'string',
                'max:255',
            ],

            'guest_capacity' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Resolve Vendor
        |--------------------------------------------------------------------------
        */

        if (
            auth()->check() &&
            auth()->user()->role === 'vendor'
        ) {

            $vendor = Vendor::where(
                'owner_user_id',
                auth()->id()
            )->firstOrFail();

            $validated['vendor_id'] = $vendor->id;

        } else {

            if (empty($validated['vendor_id'])) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'vendor_id' => 'Please select a vendor.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        if (
            empty($validated['slug']) ||
            $validated['slug'] !== $package->slug
        ) {

            $validated['slug'] = $this->generateUniqueSlug(
                $validated['name'],
                $package->id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $package->update($validated);


        return redirect()
            ->route('packages.index')
            ->with(
                'success',
                "Package '{$package->name}' was updated successfully."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Package
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Package $package
    ): RedirectResponse {

        $this->ensurePackageAccess($package);


        /*
        |--------------------------------------------------------------------------
        | Delete Package
        |--------------------------------------------------------------------------
        |
        | PackageService records should be removed automatically by the
        | database foreign-key cascade if configured in the migration.
        |
        */

        $packageName = $package->name;

        $package->delete();


        return redirect()
            ->route('packages.index')
            ->with(
                'success',
                "Package '{$packageName}' was deleted successfully."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Unique Slug
    |--------------------------------------------------------------------------
    */

    private function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {

        $baseSlug = Str::slug($name);

        if ($baseSlug === '') {
            $baseSlug = 'package';
        }

        $slug = $baseSlug;

        $counter = 1;


        while (
            Package::query()
                ->where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    )
                )
                ->exists()
        ) {

            $slug = $baseSlug . '-' . $counter;

            $counter++;
        }


        return $slug;
    }


    /*
    |--------------------------------------------------------------------------
    | Ensure Package Access
    |--------------------------------------------------------------------------
    */

    private function ensurePackageAccess(
        Package $package
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        if (
            auth()->check() &&
            auth()->user()->role === 'super_admin'
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Vendor
        |--------------------------------------------------------------------------
        */

        if (
            auth()->check() &&
            auth()->user()->role === 'vendor'
        ) {

            $vendor = Vendor::where(
                'owner_user_id',
                auth()->id()
            )->first();

            if (
                !$vendor ||
                $package->vendor_id !== $vendor->id
            ) {

                abort(403);
            }

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Unauthorized
        |--------------------------------------------------------------------------
        */

        abort(403);
    }
}