<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PackageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request, Vendor $vendor): View
    {
        $this->ensureVendorAccess($vendor);

        $query = Package::query()
            ->where('vendor_id', $vendor->id)
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
                    ->orWhere('description', 'ilike', "%{$search}%");
            });
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

            'name_asc' => $query->orderBy(
                'name',
                'asc'
            ),

            'name_desc' => $query->orderBy(
                'name',
                'desc'
            ),

            'price_low' => $query->orderByRaw(
                'COALESCE(price, min_price, 0) ASC'
            ),

            'price_high' => $query->orderByRaw(
                'COALESCE(price, max_price, 0) DESC'
            ),

            default => $query->latest(),
        };

        $packages = $query
            ->paginate(15)
            ->withQueryString();

        return view(
            'packages.index',
            compact(
                'packages',
                'vendor'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(Vendor $vendor): View
    {
        $this->ensureVendorAccess($vendor);

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        |
        | Vendor can select ANY active service from the global services table.
        |
        | We intentionally DO NOT use:
        |
        | $vendor->services()
        |
        |--------------------------------------------------------------------------
        */

        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view(
            'packages.create',
            compact(
                'vendor',
                'services'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        Vendor $vendor
    ): RedirectResponse {
        $this->ensureVendorAccess($vendor);

        /*
        |--------------------------------------------------------------------------
        | Validate Package
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
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

            /*
            |--------------------------------------------------------------------------
            | Package Services
            |--------------------------------------------------------------------------
            */

            'services' => [
                'nullable',
                'array',
            ],

            'services.*.service_id' => [
                'required',
                'integer',
                'distinct',
                'exists:services,id',
            ],

            'services.*.quantity' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'services.*.description' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['name']
        );

        /*
        |--------------------------------------------------------------------------
        | Separate Services From Package Data
        |--------------------------------------------------------------------------
        */

        $services = $validated['services'] ?? [];

        unset($validated['services']);

        /*
        |--------------------------------------------------------------------------
        | Create Package + Services
        |--------------------------------------------------------------------------
        */

        $package = DB::transaction(function () use (
            $validated,
            $services,
            $vendor
        ) {
            /*
            |--------------------------------------------------------------------------
            | Always force the authenticated vendor's vendor_id
            |--------------------------------------------------------------------------
            */

            $validated['vendor_id'] = $vendor->id;

            $package = Package::create($validated);

            $this->syncPackageServices(
                $package,
                $services
            );

            return $package;
        });

        return redirect()
            ->route(
                'vendors.packages.index',
                ['vendor' => $vendor]
            )
            ->with(
                'success',
                "Package '{$package->name}' was created successfully."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        Vendor $vendor,
        Package $package
    ): View {
        $this->ensureVendorAccess($vendor);

        $this->ensurePackageBelongsToVendor(
            $package,
            $vendor
        );

        $package->load([
            'vendor',
            'packageServices.service',
        ]);

        return view(
            'packages.show',
            compact(
                'package',
                'vendor'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Vendor $vendor,
        Package $package
    ): View {
        $this->ensureVendorAccess($vendor);

        $this->ensurePackageBelongsToVendor(
            $package,
            $vendor
        );

        /*
        |--------------------------------------------------------------------------
        | ALL ACTIVE GLOBAL SERVICES
        |--------------------------------------------------------------------------
        */

        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Existing Package Services
        |--------------------------------------------------------------------------
        */

        $package->load([
            'packageServices.service',
        ]);

        return view(
            'packages.edit',
            compact(
                'package',
                'vendor',
                'services'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Vendor $vendor,
        Package $package
    ): RedirectResponse {
        $this->ensureVendorAccess($vendor);

        $this->ensurePackageBelongsToVendor(
            $package,
            $vendor
        );

        /*
        |--------------------------------------------------------------------------
        | Validate Package
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique(
                    'packages',
                    'slug'
                )->ignore($package->id),
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

            /*
            |--------------------------------------------------------------------------
            | Package Services
            |--------------------------------------------------------------------------
            */

            'services' => [
                'nullable',
                'array',
            ],

            'services.*.service_id' => [
                'required',
                'integer',
                'distinct',
                'exists:services,id',
            ],

            'services.*.quantity' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'services.*.description' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate New Slug When Name Changes
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
        | Separate Services
        |--------------------------------------------------------------------------
        */

        $services = $validated['services'] ?? [];

        unset($validated['services']);

        /*
        |--------------------------------------------------------------------------
        | Update Package + Services
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $package,
            $validated,
            $services
        ) {
            /*
            |--------------------------------------------------------------------------
            | Never allow vendor_id to be changed
            |--------------------------------------------------------------------------
            */

            unset($validated['vendor_id']);

            $package->update($validated);

            $this->syncPackageServices(
                $package,
                $services
            );
        });

        return redirect()
            ->route(
                'vendors.packages.index',
                ['vendor' => $vendor]
            )
            ->with(
                'success',
                "Package '{$package->name}' was updated successfully."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Vendor $vendor,
        Package $package
    ): RedirectResponse {
        $this->ensureVendorAccess($vendor);

        $this->ensurePackageBelongsToVendor(
            $package,
            $vendor
        );

        $packageName = $package->name;

        DB::transaction(function () use ($package) {
            /*
            |--------------------------------------------------------------------------
            | Remove Package Services
            |--------------------------------------------------------------------------
            */

            $package->packageServices()->delete();

            /*
            |--------------------------------------------------------------------------
            | Remove Package
            |--------------------------------------------------------------------------
            */

            $package->delete();
        });

        return redirect()
            ->route(
                'vendors.packages.index',
                ['vendor' => $vendor]
            )
            ->with(
                'success',
                "Package '{$packageName}' was deleted successfully."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SYNC PACKAGE SERVICES
    |--------------------------------------------------------------------------
    */

    private function syncPackageServices(
        Package $package,
        array $services
    ): void {
        /*
        |--------------------------------------------------------------------------
        | No Services
        |--------------------------------------------------------------------------
        */

        if (empty($services)) {
            $package->services()->sync([]);

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Prepare Pivot Data
        |--------------------------------------------------------------------------
        */

        $syncData = [];

        foreach ($services as $service) {
            $serviceId = (int) $service['service_id'];

            $syncData[$serviceId] = [
                'quantity' => !empty($service['quantity'])
                    ? (int) $service['quantity']
                    : 1,

                'description' => $service['description'] ?? null,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Sync Package Services
        |--------------------------------------------------------------------------
        */

        $package->services()->sync($syncData);
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE UNIQUE SLUG
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
    | ENSURE VENDOR ACCESS
    |--------------------------------------------------------------------------
    */

    private function ensureVendorAccess(
        Vendor $vendor
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
            /*
            |--------------------------------------------------------------------------
            | IMPORTANT:
            | Vendor ownership uses user_id
            |--------------------------------------------------------------------------
            */

            $currentVendor = Vendor::query()
                ->where(
                    'user_id',
                    auth()->id()
                )
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Vendor can only access their own vendor
            |--------------------------------------------------------------------------
            */

            if (
                !$currentVendor ||
                $currentVendor->id !== $vendor->id
            ) {
                abort(403);
            }

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Everyone Else
        |--------------------------------------------------------------------------
        */

        abort(403);
    }


    /*
    |--------------------------------------------------------------------------
    | ENSURE PACKAGE BELONGS TO VENDOR
    |--------------------------------------------------------------------------
    */

    private function ensurePackageBelongsToVendor(
        Package $package,
        Vendor $vendor
    ): void {
        if (
            (int) $package->vendor_id !==
            (int) $vendor->id
        ) {
            abort(403);
        }
    }
}