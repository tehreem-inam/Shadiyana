<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\EventType;
use App\Models\Service;
use App\Models\Taxonomy;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the public Shadiyana homepage.
     */
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Venue Taxonomies
        |--------------------------------------------------------------------------
        |
        | Fetch only top-level venue taxonomies.
        | Their child taxonomies are eager-loaded for the
        | Venue dropdown in the public navbar.
        |
        | Example:
        |
        | Wedding Venues
        | ├── Hall
        | ├── Marquee
        | ├── Banquet
        | └── Farmhouse
        |
        */

        $venueTaxonomies = Taxonomy::query()
            ->where('type', 'venue')
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->with([
                'children' => fn ($query) => $query
                    ->where('type', 'venue')
                    ->where('status', 'active')
                    ->orderBy('sort_order')
                    ->orderBy('name'),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        $services = Service::query()
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Event Types
        |--------------------------------------------------------------------------
        */

        $eventTypes = EventType::query()
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Cities
        |--------------------------------------------------------------------------
        */

        $cities = City::query()
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Homepage
        |--------------------------------------------------------------------------
        */

        return view('public.home.index', [
            'venueTaxonomies' => $venueTaxonomies,
            'services'        => $services,
            'eventTypes'      => $eventTypes,
            'cities'          => $cities,
        ]);
    }
}

