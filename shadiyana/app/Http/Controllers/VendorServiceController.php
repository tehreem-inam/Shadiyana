<?php

namespace App\Http\Controllers;

use App\Models\Service;
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
    |
    | These statuses describe whether the vendor currently offers
    | the assigned service.
    |
    */

    private const STATUSES = [
        'active',
        'inactive',
    ];


    /*
    |--------------------------------------------------------------------------
    | Display Vendor Services
    |--------------------------------------------------------------------------
    |
    | Shows all services currently assigned to a vendor.
    |
    */

    public function index(Vendor $vendor): View
    {
        $vendor->load([
            'user',
        ]);


        $vendorServices = VendorService::query()
            ->with([
                'service.taxonomy',
            ])
            ->where(
                'vendor_id',
                $vendor->id
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();


        return view(
            'vendors.services.index',
            compact(
                'vendor',
                'vendorServices'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Create Form
    |--------------------------------------------------------------------------
    |
    | Displays services which can be assigned to the vendor.
    |
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
            ->where(
                'vendor_id',
                $vendor->id
            )
            ->pluck('service_id');


        /*
        |--------------------------------------------------------------------------
        | Available Services
        |--------------------------------------------------------------------------
        |
        | Only services which:
        |
        | 1. Are not already assigned to this vendor.
        | 2. Are active globally.
        |
        */

        $services = Service::query()
            ->where(
                'status',
                'active'
            )
            ->whereNotIn(
                'id',
                $assignedServiceIds
            )
            ->with([
                'taxonomy',
            ])
            ->orderBy(
                'name'
            )
            ->get();


        return view(
            'vendors.services.create',
            compact(
                'vendor',
                'services'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Vendor Service
    |--------------------------------------------------------------------------
    |
    | Assign an existing service to a vendor.
    |
    */

    public function store(
        Request $request,
        Vendor $vendor
    ): RedirectResponse {

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Service
            |--------------------------------------------------------------------------
            */

            'service_id' => [
                'required',
                'integer',
                'exists:services,id',

                /*
                |--------------------------------------------------------------------------
                | Prevent Duplicate Assignment
                |--------------------------------------------------------------------------
                */

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
                    ),
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
            | Vendor-Specific Description
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
                Rule::in(
                    self::STATUSES
                ),
            ],

        ], [

            'service_id.unique' =>
                'This service is already assigned to this vendor.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verify Service
        |--------------------------------------------------------------------------
        |
        | Do not allow an inactive global service to be newly assigned.
        |
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
        | Create Vendor Service
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $vendor,
            $validated
        ) {

            VendorService::create([

                'vendor_id' =>
                    $vendor->id,

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


        return redirect()
            ->route(
                'vendors.services.index',
                $vendor
            )
            ->with(
                'success',
                'Service assigned to vendor successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Form
    |--------------------------------------------------------------------------
    |
    | Allows the administrator to modify the vendor-specific
    | service information.
    |
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
            ->where(
                'status',
                'active'
            )
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
            ->orderBy(
                'name'
            )
            ->get();


        return view(
            'vendors.services.edit',
            compact(
                'vendor',
                'vendorService',
                'services'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Vendor Service
    |--------------------------------------------------------------------------
    |
    | Updates the vendor-specific service assignment.
    |
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

            /*
            |--------------------------------------------------------------------------
            | Service
            |--------------------------------------------------------------------------
            */

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
            | Description
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
                Rule::in(
                    self::STATUSES
                ),
            ],

        ], [

            'service_id.unique' =>
                'This service is already assigned to this vendor.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verify Selected Service
        |--------------------------------------------------------------------------
        |
        | The service must still exist and be active.
        |
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
    |
    | Removes only the vendor-service assignment.
    |
    | IMPORTANT:
    | The actual Service record is NOT deleted.
    |
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
        */

        DB::transaction(function () use (
            $vendorService
        ) {

            $vendorService->delete();
        });


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
    |
    | Prevent manipulation of another vendor's service assignment.
    |
    */

    private function ensureVendorServiceBelongsToVendor(
        Vendor $vendor,
        VendorService $vendorService
    ): void {

        abort_unless(
            $vendorService->vendor_id === $vendor->id,
            404
        );
    }
}