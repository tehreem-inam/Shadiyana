<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\EventType;
use App\Models\Service;
use App\Models\Taxonomy;
use Illuminate\View\View;

class EventLandingController extends Controller
{
    /**
     * Display all public event types.
     *
     * Example:
     * /events
     */
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Public Navbar Data
        |--------------------------------------------------------------------------
        */

        $venueTaxonomies = Taxonomy::query()
            ->where('status', 'active')
            ->with([
                'children' => function ($query) {
                    $query
                        ->where('status', 'active')
                        ->orderBy('sort_order')
                        ->orderBy('name');
                },
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Active Events
        |--------------------------------------------------------------------------
        */

        $eventTypes = EventType::query()
            ->where('status', 'active')
            ->with([
                'images',
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        $cities = City::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'public.events.index',
            compact(
                'eventTypes',
                'venueTaxonomies',
                'services',
                'cities'
            )
        );
    }


    /**
     * Display public event landing page.
     *
     * Example:
     * /events/baraat-planning
     */
    public function show(string $slug): View
    {
        /*
        |--------------------------------------------------------------------------
        | Event Type
        |--------------------------------------------------------------------------
        */

        $eventType = EventType::query()
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Public Navbar Data
        |--------------------------------------------------------------------------
        */

        $venueTaxonomies = Taxonomy::query()
            ->where('status', 'active')
            ->with([
                'children' => function ($query) {
                    $query
                        ->where('status', 'active')
                        ->orderBy('sort_order')
                        ->orderBy('name');
                },
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();


        $eventTypes = EventType::query()
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        $cities = City::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Wedding Venues
        |--------------------------------------------------------------------------
        */

        $weddingVenues = Taxonomy::query()
            ->where('slug', 'wedding-venues')
            ->where('status', 'active')
            ->with([
                'children' => function ($query) {
                    $query
                        ->where('status', 'active')
                        ->orderBy('sort_order')
                        ->orderBy('name');
                },
            ])
            ->first();


        $venueSections = collect();


        if ($weddingVenues) {

            /*
            |--------------------------------------------------------------------------
            | Parent Wedding Venue Vendors
            |--------------------------------------------------------------------------
            */

            $parentVendors = $weddingVenues
                ->vendors()
                ->whereHas('eventTypes', function ($query) use ($eventType) {
                    $query->where(
                        'event_types.id',
                        $eventType->id
                    );
                })
                ->with([
                    'images',
                    'city',
                ])
                ->where('vendors.status', 'active')
                ->get()
                ->unique('id')
                ->values();


            if ($parentVendors->isNotEmpty()) {

                $venueSections->push([
                    'category' => $weddingVenues,
                    'vendors' => $parentVendors,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Child Wedding Venue Taxonomies
            |--------------------------------------------------------------------------
            */

            foreach ($weddingVenues->children as $child) {

                $childVendors = $child
                    ->vendors()
                    ->whereHas('eventTypes', function ($query) use ($eventType) {
                        $query->where(
                            'event_types.id',
                            $eventType->id
                        );
                    })
                    ->with([
                        'images',
                        'city',
                    ])
                    ->where('vendors.status', 'active')
                    ->get()
                    ->unique('id')
                    ->values();


                if ($childVendors->isNotEmpty()) {

                    $venueSections->push([
                        'category' => $child,
                        'vendors' => $childVendors,
                    ]);
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Service Sections
        |--------------------------------------------------------------------------
        */

        $serviceSections = collect();


        foreach ($services as $service) {

            $serviceVendors = $service
                ->vendors()
                ->wherePivot(
                    'status',
                    'active'
                )
                ->whereHas('eventTypes', function ($query) use ($eventType) {
                    $query->where(
                        'event_types.id',
                        $eventType->id
                    );
                })
                ->with([
                    'images',
                    'city',
                ])
                ->where('vendors.status', 'active')
                ->get()
                ->unique('id')
                ->values();


            if ($serviceVendors->isNotEmpty()) {

                $serviceSections->push([
                    'service' => $service,
                    'vendors' => $serviceVendors,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Return Event Landing Page
        |--------------------------------------------------------------------------
        */

        return view(
            'public.events.show',
            compact(
                'eventType',
                'venueTaxonomies',
                'services',
                'eventTypes',
                'cities',
                'venueSections',
                'serviceSections'
            )
        );
    }
}