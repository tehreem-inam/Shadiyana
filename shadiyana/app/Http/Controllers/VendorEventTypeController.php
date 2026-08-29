<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use App\Models\Vendor;
use App\Models\VendorEventType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VendorEventTypeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Vendor Event Types
    |--------------------------------------------------------------------------
    |
    | Displays all event types currently assigned to the vendor.
    |
    */

    public function index(Vendor $vendor): View
    {
        $vendor->load([
            'user',
        ]);

        $vendorEventTypes = VendorEventType::query()
            ->with([
                'eventType',
            ])
            ->where(
                'vendor_id',
                $vendor->id
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'vendors.event-types.index',
            compact(
                'vendor',
                'vendorEventTypes'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Create Form
    |--------------------------------------------------------------------------
    |
    | Displays active event types which have not already been
    | assigned to this vendor.
    |
    */

    public function create(Vendor $vendor): View
    {
        $vendor->load([
            'user',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Already Assigned Event Types
        |--------------------------------------------------------------------------
        */

        $assignedEventTypeIds = VendorEventType::query()
            ->where(
                'vendor_id',
                $vendor->id
            )
            ->pluck('event_type_id');


        /*
        |--------------------------------------------------------------------------
        | Available Event Types
        |--------------------------------------------------------------------------
        |
        | Only active global event types which are not already
        | assigned to this vendor are available.
        |
        */

        $eventTypes = EventType::query()
            ->where(
                'status',
                'active'
            )
            ->whereNotIn(
                'id',
                $assignedEventTypeIds
            )
            ->orderBy(
                'sort_order'
            )
            ->orderBy(
                'name'
            )
            ->get();


        return view(
            'vendors.event-types.create',
            compact(
                'vendor',
                'eventTypes'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Vendor Event Type
    |--------------------------------------------------------------------------
    |
    | Assigns an existing event type to the vendor.
    |
    */

    public function store(
        Request $request,
        Vendor $vendor
    ): RedirectResponse {

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Event Type
            |--------------------------------------------------------------------------
            */

            'event_type_id' => [
                'required',
                'integer',
                'exists:event_types,id',

                /*
                |--------------------------------------------------------------------------
                | Prevent Duplicate Assignment
                |--------------------------------------------------------------------------
                */

                Rule::unique(
                    'vendor_event_types',
                    'event_type_id'
                )->where(
                    fn ($query) =>
                        $query->where(
                            'vendor_id',
                            $vendor->id
                        )
                ),
            ],

        ], [

            'event_type_id.unique' =>
                'This event type is already assigned to this vendor.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verify Event Type Is Active
        |--------------------------------------------------------------------------
        |
        | An inactive global event type should not be newly
        | assigned to a vendor.
        |
        */

        $eventType = EventType::query()
            ->where(
                'id',
                $validated['event_type_id']
            )
            ->where(
                'status',
                'active'
            )
            ->first();


        if (! $eventType) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'event_type_id' =>
                        'The selected event type is not currently active.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Create Assignment
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $vendor,
            $validated
        ) {

            VendorEventType::create([

                'vendor_id' =>
                    $vendor->id,

                'event_type_id' =>
                    $validated['event_type_id'],

            ]);
        });


        return redirect()
            ->route(
                'vendors.event-types.index',
                $vendor
            )
            ->with(
                'success',
                'Event type assigned to vendor successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Form
    |--------------------------------------------------------------------------
    |
    | Since the pivot contains only vendor_id and event_type_id,
    | editing means replacing the assigned event type.
    |
    */

    public function edit(
        Vendor $vendor,
        VendorEventType $vendorEventType
    ): View {

        /*
        |--------------------------------------------------------------------------
        | Verify Ownership
        |--------------------------------------------------------------------------
        */

        $this->ensureVendorEventTypeBelongsToVendor(
            $vendor,
            $vendorEventType
        );


        /*
        |--------------------------------------------------------------------------
        | Load Relationship
        |--------------------------------------------------------------------------
        */

        $vendorEventType->load([
            'eventType',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Available Event Types
        |--------------------------------------------------------------------------
        |
        | Include:
        |
        | 1. Current event type.
        | 2. Other active event types not assigned to this vendor.
        |
        */

        $eventTypes = EventType::query()
            ->where(
                'status',
                'active'
            )
            ->where(function ($query) use (
                $vendor,
                $vendorEventType
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
                        $vendorEventType->event_type_id
                    );

            })
            ->orderBy(
                'sort_order'
            )
            ->orderBy(
                'name'
            )
            ->get();


        return view(
            'vendors.event-types.edit',
            compact(
                'vendor',
                'vendorEventType',
                'eventTypes'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Vendor Event Type
    |--------------------------------------------------------------------------
    |
    | Replaces the event type assigned to the vendor.
    |
    */

    public function update(
        Request $request,
        Vendor $vendor,
        VendorEventType $vendorEventType
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Verify Ownership
        |--------------------------------------------------------------------------
        */

        $this->ensureVendorEventTypeBelongsToVendor(
            $vendor,
            $vendorEventType
        );


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'event_type_id' => [
                'required',
                'integer',
                'exists:event_types,id',

                Rule::unique(
                    'vendor_event_types',
                    'event_type_id'
                )
                    ->where(
                        fn ($query) =>
                            $query->where(
                                'vendor_id',
                                $vendor->id
                            )
                    )
                    ->ignore(
                        $vendorEventType->id
                    ),
            ],

        ], [

            'event_type_id.unique' =>
                'This event type is already assigned to this vendor.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verify Event Type Is Active
        |--------------------------------------------------------------------------
        */

        $eventType = EventType::query()
            ->where(
                'id',
                $validated['event_type_id']
            )
            ->where(
                'status',
                'active'
            )
            ->first();


        if (! $eventType) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'event_type_id' =>
                        'The selected event type is not currently active.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update Assignment
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $vendorEventType,
            $validated
        ) {

            $vendorEventType->update([

                'event_type_id' =>
                    $validated['event_type_id'],

            ]);
        });


        return redirect()
            ->route(
                'vendors.event-types.index',
                $vendor
            )
            ->with(
                'success',
                'Vendor event type updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Vendor Event Type
    |--------------------------------------------------------------------------
    |
    | Removes only the relationship between the vendor and event type.
    |
    | The global EventType record is NEVER deleted.
    |
    */

    public function destroy(
        Vendor $vendor,
        VendorEventType $vendorEventType
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Verify Ownership
        |--------------------------------------------------------------------------
        */

        $this->ensureVendorEventTypeBelongsToVendor(
            $vendor,
            $vendorEventType
        );


        /*
        |--------------------------------------------------------------------------
        | Delete Assignment
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $vendorEventType
        ) {

            $vendorEventType->delete();
        });


        return redirect()
            ->route(
                'vendors.event-types.index',
                $vendor
            )
            ->with(
                'success',
                'Event type removed from vendor successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Verify Ownership
    |--------------------------------------------------------------------------
    |
    | Prevents a vendor event type belonging to another vendor
    | from being accessed through a manipulated URL.
    |
    */

    private function ensureVendorEventTypeBelongsToVendor(
        Vendor $vendor,
        VendorEventType $vendorEventType
    ): void {

        abort_unless(
            $vendorEventType->vendor_id === $vendor->id,
            404
        );
    }
}