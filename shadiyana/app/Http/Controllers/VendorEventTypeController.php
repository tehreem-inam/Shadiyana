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
public function index(Request $request, Vendor $vendor): View
{
    $this->ensureVendorAccess($vendor);

    $query = $vendor->eventTypes()
        ->withPivot([
            'id',
            'created_at',
        ]);

    if ($request->filled('search')) {
        $search = trim($request->input('search'));

        $query->where(function ($q) use ($search) {
            $q->where(
                'event_types.name',
                'ilike',
                "%{$search}%"
            );
        });
    }

    $query->orderBy('event_types.sort_order')
        ->orderBy('event_types.name');

    $eventTypes = $query
        ->paginate(15)
        ->withQueryString();

    return view(
        'vendors.event-types.index',
        compact('vendor', 'eventTypes')
    );
}

    public function create(Vendor $vendor): View
    {
        $this->ensureSuperAdmin();

        $assignedEventTypeIds = VendorEventType::query()
            ->where('vendor_id', $vendor->id)
            ->pluck('event_type_id');

        $eventTypes = EventType::query()
            ->where('status', 'active')
            ->when(
                $assignedEventTypeIds->isNotEmpty(),
                function ($query) use ($assignedEventTypeIds) {
                    $query->whereNotIn('id', $assignedEventTypeIds);
                }
            )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'vendors.event-types.create',
            compact('vendor', 'eventTypes')
        );
    }

    public function store(
        Request $request,
        Vendor $vendor
    ): RedirectResponse {
        $this->ensureSuperAdmin();

        $validated = $request->validate([
            'event_type_ids' => [
                'required',
                'array',
                'min:1',
            ],
            'event_type_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:event_types,id',
            ],
        ]);

        $eventTypeIds = collect($validated['event_type_ids'])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        $activeEventTypes = EventType::query()
            ->whereIn('id', $eventTypeIds)
            ->where('status', 'active')
            ->pluck('id');

        if ($activeEventTypes->count() !== $eventTypeIds->count()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'event_type_ids' =>
                        'One or more selected event types are not currently active.',
                ]);
        }

        $alreadyAssignedIds = VendorEventType::query()
            ->where('vendor_id', $vendor->id)
            ->whereIn('event_type_id', $eventTypeIds)
            ->pluck('event_type_id');

        if ($alreadyAssignedIds->isNotEmpty()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'event_type_ids' =>
                        'One or more selected event types are already assigned to this vendor.',
                ]);
        }

        DB::transaction(
            function () use ($vendor, $eventTypeIds) {
                foreach ($eventTypeIds as $eventTypeId) {
                    DB::table('vendor_event_types')->insert([
                        'vendor_id' => $vendor->id,
                        'event_type_id' => $eventTypeId,
                        'created_at' => now(),
                    ]);
                }
            }
        );

        $count = $eventTypeIds->count();

        return redirect()
            ->route('vendors.event-types.index', $vendor)
            ->with(
                'success',
                $count === 1
                    ? 'Event type assigned to vendor successfully.'
                    : "{$count} event types assigned to vendor successfully."
            );
    }

    public function edit(
        Vendor $vendor,
        VendorEventType $vendorEventType
    ): View {
        $this->ensureSuperAdmin();

        $this->ensureVendorEventTypeBelongsToVendor(
            $vendor,
            $vendorEventType
        );

        $vendorEventType->load(['eventType']);

        $eventTypes = EventType::query()
            ->where('status', 'active')
            ->where(function ($query) use ($vendor, $vendorEventType) {
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
            ->orderBy('sort_order')
            ->orderBy('name')
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

    public function update(
        Request $request,
        Vendor $vendor,
        VendorEventType $vendorEventType
    ): RedirectResponse {
        $this->ensureSuperAdmin();

        $this->ensureVendorEventTypeBelongsToVendor(
            $vendor,
            $vendorEventType
        );

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

        $eventType = EventType::query()
            ->where('id', $validated['event_type_id'])
            ->where('status', 'active')
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

        DB::transaction(
            function () use (
                $vendorEventType,
                $validated
            ) {
                DB::table('vendor_event_types')
                    ->where('id', $vendorEventType->id)
                    ->update([
                        'event_type_id' =>
                            $validated['event_type_id'],
                    ]);
            }
        );

        return redirect()
            ->route('vendors.event-types.index', $vendor)
            ->with(
                'success',
                'Vendor event type updated successfully.'
            );
    }

    public function destroy(
        Vendor $vendor,
        VendorEventType $vendorEventType
    ): RedirectResponse {
        $this->ensureSuperAdmin();

        $this->ensureVendorEventTypeBelongsToVendor(
            $vendor,
            $vendorEventType
        );

        DB::transaction(
            function () use ($vendorEventType) {
                DB::table('vendor_event_types')
                    ->where('id', $vendorEventType->id)
                    ->delete();
            }
        );

        return redirect()
            ->route('vendors.event-types.index', $vendor)
            ->with(
                'success',
                'Event type removed from vendor successfully.'
            );
    }

    private function ensureVendorEventTypeBelongsToVendor(
        Vendor $vendor,
        VendorEventType $vendorEventType
    ): void {
        abort_unless(
            (int) $vendorEventType->vendor_id ===
            (int) $vendor->id,
            404
        );
    }

    private function ensureVendorAccess(
        Vendor $vendor
    ): void {
        $user = auth()->user();

        if (
            $user &&
            in_array(
                $user->role,
                ['super_admin', 'superadmin'],
                true
            )
        ) {
            return;
        }

        if (
            $user &&
            $user->role === 'vendor'
        ) {
            abort_unless(
                (int) $vendor->user_id ===
                (int) $user->id,
                403
            );

            return;
        }

        abort(403);
    }

    private function ensureSuperAdmin(): void
    {
        $user = auth()->user();

        abort_unless(
            $user &&
            in_array(
                $user->role,
                ['super_admin', 'superadmin'],
                true
            ),
            403
        );
    }
}