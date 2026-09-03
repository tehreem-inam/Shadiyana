<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Taxonomy;
use App\Models\Vendor;
use App\Models\VendorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VendorServiceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Vendor Service Statuses
    |--------------------------------------------------------------------------
    */

    private const STATUSES = [
        'active',
        'inactive',
    ];


    /*
    |--------------------------------------------------------------------------
    | Display Vendor Services
    |--------------------------------------------------------------------------
    */

public function index(Request $request, Vendor $vendor): View
{
    $this->ensureVendorAccess($vendor);

    $query = $vendor->services()
        ->withPivot([
            'custom_name',
            'description',
            'status',
        ]);

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $search = trim($request->input('search'));

        $query->where(function ($q) use ($search) {

            $q->where('services.name', 'ilike', "%{$search}%")
                ->orWhere(
                    'vendor_services.custom_name',
                    'ilike',
                    "%{$search}%"
                )
                ->orWhere(
                    'vendor_services.description',
                    'ilike',
                    "%{$search}%"
                );

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Status Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where(
            'vendor_services.status',
            $request->input('status')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Ordering
    |--------------------------------------------------------------------------
    */

    $query->orderByDesc('vendor_services.created_at');


    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    */

    $services = $query
        ->paginate(15)
        ->withQueryString();


    /*
    |--------------------------------------------------------------------------
    | View
    |--------------------------------------------------------------------------
    */

    return view('vendors.services.index', [
        'vendor' => $vendor,
        'services' => $services,
    ]);
}

    /*
    |--------------------------------------------------------------------------
    | Show Create Form
    |--------------------------------------------------------------------------
    */

    public function create(Vendor $vendor): View
    {
        $vendor->load([
            'user',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Already Assigned Services
        |--------------------------------------------------------------------------
        */

        $assignedServiceIds = VendorService::query()
            ->where('vendor_id', $vendor->id)
            ->pluck('service_id');


        /*
        |--------------------------------------------------------------------------
        | Available Taxonomies
        |--------------------------------------------------------------------------
        |
        | Only taxonomies containing at least one available service
        | are displayed.
        |
        */

        $taxonomies = Taxonomy::query()
            ->whereHas('services', function ($query) use ($assignedServiceIds) {

                $query
                    ->where('services.status', 'active')
                    ->when(
                        $assignedServiceIds->isNotEmpty(),
                        function ($query) use ($assignedServiceIds) {
                            $query->whereNotIn(
                                'services.id',
                                $assignedServiceIds
                            );
                        }
                    );

            })
            ->with([
                'services' => function ($query) use ($assignedServiceIds) {

                    $query
                        ->where('services.status', 'active')
                        ->when(
                            $assignedServiceIds->isNotEmpty(),
                            function ($query) use ($assignedServiceIds) {
                                $query->whereNotIn(
                                    'services.id',
                                    $assignedServiceIds
                                );
                            }
                        )
                        ->orderBy('services.name');

                },
            ])
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Available Services
        |--------------------------------------------------------------------------
        */

        $services = Service::query()
            ->where('status', 'active')
            ->when(
                $assignedServiceIds->isNotEmpty(),
                function ($query) use ($assignedServiceIds) {
                    $query->whereNotIn(
                        'id',
                        $assignedServiceIds
                    );
                }
            )
            ->with([
                'taxonomy',
            ])
            ->orderBy('name')
            ->get();


        return view(
            'vendors.services.create',
            compact(
                'vendor',
                'taxonomies',
                'services'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Vendor Services
    |--------------------------------------------------------------------------
    |
    | Assigns multiple existing services to a vendor.
    |
    | IMPORTANT:
    | taxonomy_ids is OPTIONAL because taxonomy IDs are derived from
    | the selected services.
    |
    */

    public function store(
        Request $request,
        Vendor $vendor
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Selected Services
            |--------------------------------------------------------------------------
            */

            'service_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'service_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:services,id',
            ],


            /*
            |--------------------------------------------------------------------------
            | Taxonomy IDs
            |--------------------------------------------------------------------------
            |
            | Optional.
            |
            | The controller derives these automatically from the selected
            | services, so the form does NOT need to submit taxonomy_ids[].
            |
            */

            'taxonomy_ids' => [
                'nullable',
                'array',
            ],

            'taxonomy_ids.*' => [
                'nullable',
                'integer',
                'distinct',
                'exists:taxonomies,id',
            ],


            /*
            |--------------------------------------------------------------------------
            | Custom Name
            |--------------------------------------------------------------------------
            */

            'custom_name' => [
                'nullable',
                'string',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------------------
            | Vendor Specific Description
            |--------------------------------------------------------------------------
            */

            'description' => [
                'nullable',
                'string',
                'max:50000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                Rule::in(self::STATUSES),
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Normalize Service IDs
        |--------------------------------------------------------------------------
        */

        $serviceIds = collect($validated['service_ids'])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Load Selected Services
        |--------------------------------------------------------------------------
        |
        | Only active services are allowed.
        |
        */

        $services = Service::query()
            ->whereIn('id', $serviceIds)
            ->where('status', 'active')
            ->with([
                'taxonomy',
            ])
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Verify All Selected Services Exist and Are Active
        |--------------------------------------------------------------------------
        */

        if ($services->count() !== $serviceIds->count()) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'service_ids' =>
                        'One or more selected services are not currently active.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Derive Taxonomy IDs From Selected Services
        |--------------------------------------------------------------------------
        |
        | There is no need for the form to send taxonomy_ids[].
        |
        */

        $derivedTaxonomyIds = $services
            ->pluck('taxonomy_id')
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Optional Taxonomy Validation
        |--------------------------------------------------------------------------
        |
        | If taxonomy_ids[] happens to be submitted by the form,
        | verify that the submitted taxonomies actually match the
        | selected services.
        |
        */

        if ($request->filled('taxonomy_ids')) {

            $submittedTaxonomyIds = collect(
                $request->input('taxonomy_ids', [])
            )
                ->map(fn ($id) => (int) $id)
                ->unique()
                ->values();


            /*
            |------------------------------------------------------------------
            | Check Every Service's Taxonomy Is Selected
            |------------------------------------------------------------------
            */

            $invalidServices = $services->filter(
                function ($service) use ($submittedTaxonomyIds) {

                    return ! $submittedTaxonomyIds->contains(
                        (int) $service->taxonomy_id
                    );
                }
            );


            if ($invalidServices->isNotEmpty()) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'service_ids' =>
                            'One or more selected services do not belong to the selected taxonomies.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Check Already Assigned Services
        |--------------------------------------------------------------------------
        */

        $alreadyAssignedServiceIds = VendorService::query()
            ->where('vendor_id', $vendor->id)
            ->whereIn('service_id', $serviceIds)
            ->pluck('service_id');


        if ($alreadyAssignedServiceIds->isNotEmpty()) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'service_ids' =>
                        'One or more selected services are already assigned to this vendor.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Create Vendor Service Assignments
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $vendor,
            $serviceIds,
            $validated
        ) {

            foreach ($serviceIds as $serviceId) {

                VendorService::create([

                    'vendor_id' =>
                        $vendor->id,

                    'service_id' =>
                        $serviceId,

                    'custom_name' =>
                        $validated['custom_name'] ?? null,

                    'description' =>
                        $validated['description'] ?? null,

                    'status' =>
                        $validated['status'],

                ]);
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        $count = $serviceIds->count();

        return redirect()
            ->route(
                'vendors.services.index',
                $vendor
            )
            ->with(
                'success',
                $count === 1
                    ? 'Service assigned to vendor successfully.'
                    : "{$count} services assigned to vendor successfully."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Form
    |--------------------------------------------------------------------------
    */

    public function edit(
        Vendor $vendor,
        VendorService $vendorService
    ): View {

        /*
        |--------------------------------------------------------------------------
        | Verify Ownership
        |--------------------------------------------------------------------------
        */

        $this->ensureVendorServiceBelongsToVendor(
            $vendor,
            $vendorService
        );


        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        */

        $vendorService->load([
            'service.taxonomy',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Available Services
        |--------------------------------------------------------------------------
        |
        | Include:
        |
        | 1. Current service.
        | 2. Other active services not assigned to this vendor.
        |
        */

        $services = Service::query()
            ->where('status', 'active')
            ->where(function ($query) use (
                $vendor,
                $vendorService
            ) {

                $query
                    ->whereDoesntHave(
                        'vendors',
                        function ($vendorQuery) use ($vendor) {

                            $vendorQuery->where(
                                'vendors.id',
                                $vendor->id
                            );
                        }
                    )
                    ->orWhere(
                        'id',
                        $vendorService->service_id
                    );
            })
            ->with([
                'taxonomy',
            ])
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Taxonomies
        |--------------------------------------------------------------------------
        */

        $taxonomies = Taxonomy::query()
            ->whereHas(
                'services',
                function ($query) use (
                    $vendor,
                    $vendorService
                ) {

                    $query
                        ->where(
                            'services.status',
                            'active'
                        )
                        ->where(function ($serviceQuery) use (
                            $vendor,
                            $vendorService
                        ) {

                            $serviceQuery
                                ->whereDoesntHave(
                                    'vendors',
                                    function ($vendorQuery) use ($vendor) {

                                        $vendorQuery->where(
                                            'vendors.id',
                                            $vendor->id
                                        );
                                    }
                                )
                                ->orWhere(
                                    'services.id',
                                    $vendorService->service_id
                                );
                        });
                }
            )
            ->with([
                'services' => function ($query) use (
                    $vendor,
                    $vendorService
                ) {

                    $query
                        ->where(
                            'services.status',
                            'active'
                        )
                        ->where(function ($serviceQuery) use (
                            $vendor,
                            $vendorService
                        ) {

                            $serviceQuery
                                ->whereDoesntHave(
                                    'vendors',
                                    function ($vendorQuery) use ($vendor) {

                                        $vendorQuery->where(
                                            'vendors.id',
                                            $vendor->id
                                        );
                                    }
                                )
                                ->orWhere(
                                    'services.id',
                                    $vendorService->service_id
                                );
                        })
                        ->orderBy(
                            'services.name'
                        );
                },
            ])
            ->orderBy('name')
            ->get();


        return view(
            'vendors.services.edit',
            compact(
                'vendor',
                'vendorService',
                'services',
                'taxonomies'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Vendor Service
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Vendor $vendor,
        VendorService $vendorService
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Verify Ownership
        |--------------------------------------------------------------------------
        */

        $this->ensureVendorServiceBelongsToVendor(
            $vendor,
            $vendorService
        );


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'service_id' => [
                'required',
                'integer',
                'exists:services,id',

                Rule::unique(
                    'vendor_services',
                    'service_id'
                )
                    ->where(
                        fn ($query) =>
                            $query->where(
                                'vendor_id',
                                $vendor->id
                            )
                    )
                    ->ignore(
                        $vendorService->id
                    ),
            ],

            'custom_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:50000',
            ],

            'status' => [
                'required',
                Rule::in(self::STATUSES),
            ],

        ], [

            'service_id.unique' =>
                'This service is already assigned to this vendor.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verify Selected Service Is Active
        |--------------------------------------------------------------------------
        */

        $service = Service::query()
            ->where(
                'id',
                $validated['service_id']
            )
            ->where(
                'status',
                'active'
            )
            ->first();


        if (! $service) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'service_id' =>
                        'The selected service is not currently active.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update Vendor Service
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $vendorService,
            $validated
        ) {

            $vendorService->update([

                'service_id' =>
                    $validated['service_id'],

                'custom_name' =>
                    $validated['custom_name'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'status' =>
                    $validated['status'],

            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'vendors.services.index',
                $vendor
            )
            ->with(
                'success',
                'Vendor service updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Vendor Service
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Vendor $vendor,
        VendorService $vendorService
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Verify Ownership
        |--------------------------------------------------------------------------
        */

        $this->ensureVendorServiceBelongsToVendor(
            $vendor,
            $vendorService
        );


        /*
        |--------------------------------------------------------------------------
        | Delete Assignment
        |--------------------------------------------------------------------------
        |
        | The original Service record is NOT deleted.
        |
        */

        DB::transaction(function () use (
            $vendorService
        ) {

            $vendorService->delete();
        });


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'vendors.services.index',
                $vendor
            )
            ->with(
                'success',
                'Service removed from vendor successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Verify Vendor Service Ownership
    |--------------------------------------------------------------------------
    */

    private function ensureVendorServiceBelongsToVendor(
        Vendor $vendor,
        VendorService $vendorService
    ): void {

        abort_unless(
            (int) $vendorService->vendor_id === (int) $vendor->id,
            404
        );
    }
    /*
|--------------------------------------------------------------------------
| Verify Vendor Access
|--------------------------------------------------------------------------
|
| Super admins can manage any vendor.
| Vendors can only manage their own vendor profile/services.
|
*/

private function ensureVendorAccess(Vendor $vendor): void
{
    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | Super Admin
    |--------------------------------------------------------------------------
    */

    if ($user && $user->role === 'superadmin') {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Vendor
    |--------------------------------------------------------------------------
    */

    if ($user && $user->role === 'vendor') {

        abort_unless(
            (int) $vendor->user_id === (int) $user->id,
            403
        );

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Everyone Else
    |--------------------------------------------------------------------------
    */

    abort(403);
}
}