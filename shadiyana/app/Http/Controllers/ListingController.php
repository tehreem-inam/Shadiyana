<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\EventType;
use App\Models\Service;
use App\Models\Taxonomy;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Vendor Listings
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
$categorySlug = $request->query('category');
$taxonomySlug = $request->query('slug');
$cityFilter = $request->query('city');
$sort = $request->query('sort', 'relevance');

$cityId = null;

/*
|--------------------------------------------------------------------------
| Resolve City Filter
|--------------------------------------------------------------------------
|
| The public URL can provide either:
|
| /listings?city=4
| /listings?city=Islamabad
|
| Internally vendors are filtered using vendors.city_id.
|
*/

if ($cityFilter !== null && $cityFilter !== '') {

    if (is_numeric($cityFilter)) {

        $cityId = (int) $cityFilter;

    } else {

        $cityId = City::query()
            ->whereRaw(
                'LOWER(name) = ?',
                [strtolower(trim($cityFilter))]
            )
            ->value('id');
    }
}
        $category = null;
        $taxonomy = null;
        $service = null;

        /*
        |--------------------------------------------------------------------------
        | Service Listing
        |--------------------------------------------------------------------------
        */

        if (
            $categorySlug === 'services' &&
            $taxonomySlug
        ) {

            $service = Service::query()
                ->where('slug', $taxonomySlug)
                ->where('status', 'active')
                ->first();

            abort_unless($service, 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Taxonomy Listing
        |--------------------------------------------------------------------------
        */

        if (
            $categorySlug &&
            $categorySlug !== 'services'
        ) {

            $category = Taxonomy::query()
                ->where('slug', $categorySlug)
                ->whereNull('parent_id')
                ->where('status', 'active')
                ->first();
        }

        if (
            $taxonomySlug &&
            $categorySlug !== 'services'
        ) {

            $taxonomy = Taxonomy::query()
                ->with('parent')
                ->where('slug', $taxonomySlug)
                ->where('status', 'active')
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Child Taxonomy
        |--------------------------------------------------------------------------
        */

        if (
            $category &&
            $taxonomy &&
            (int) $taxonomy->parent_id !== (int) $category->id
        ) {

            $taxonomy = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Vendors Query
        |--------------------------------------------------------------------------
        */

        $vendors = Vendor::query()
            ->where('status', 'active')

            ->with([
                'city',
                'taxonomies.parent',
                'packages',
            ])

            /*
            |--------------------------------------------------------------------------
            | Taxonomy Filter
            |--------------------------------------------------------------------------
            */

            ->when(
                $taxonomy,
                function ($query) use ($taxonomy) {

                    $query->whereHas(
                        'taxonomies',
                        function ($taxonomyQuery) use ($taxonomy) {

                            $taxonomyQuery->where(
                                'taxonomies.id',
                                $taxonomy->id
                            );
                        }
                    );
                }
            )

            /*
            |--------------------------------------------------------------------------
            | Service Filter
            |--------------------------------------------------------------------------
            */

            ->when(
                $service,
                function ($query) use ($service) {

                    $query->whereHas(
                        'services',
                        function ($serviceQuery) use ($service) {

                            $serviceQuery
                                ->where(
                                    'services.id',
                                    $service->id
                                )
                                ->where(
                                    'vendor_services.status',
                                    'active'
                                );
                        }
                    );
                }
            )

            /*
            |--------------------------------------------------------------------------
            | City Filter
            |--------------------------------------------------------------------------
            */

            ->when(
                $cityId,
                function ($query) use ($cityId) {

                    $query->where(
                        'city_id',
                        $cityId
                    );
                }
            );

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        switch ($sort) {

            case 'rating':

                $vendors
                    ->orderByDesc('avg_rating')
                    ->orderByDesc('review_count');

                break;

            case 'reviews':

                $vendors
                    ->orderByDesc('review_count')
                    ->orderByDesc('avg_rating');

                break;

            case 'newest':

                $vendors->latest();

                break;

            case 'relevance':

            default:

                $vendors
                    ->orderByDesc('is_featured')
                    ->orderByDesc('is_premium')
                    ->orderByDesc('avg_rating')
                    ->orderByDesc('review_count');

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $vendors = $vendors
            ->paginate(12)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Public Navigation Data
        |--------------------------------------------------------------------------
        */

        $venueTaxonomies = Taxonomy::query()
            ->with('children')
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $eventTypes = EventType::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $cities = City::query()
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Listings View
        |--------------------------------------------------------------------------
        */

        return view('public.listings.index', [

            'vendors' => $vendors,

            'category' => $category,
            'taxonomy' => $taxonomy,
            'service' => $service,

            'categorySlug' => $categorySlug,
            'taxonomySlug' => $taxonomySlug,
            'cityId' => $cityId,
            'sort' => $sort,

            'venueTaxonomies' => $venueTaxonomies,
            'services' => $services,
            'eventTypes' => $eventTypes,
            'cities' => $cities,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Public Vendor Profile
    |--------------------------------------------------------------------------
    */

    public function show(string $slug)
    {
        /*
        |--------------------------------------------------------------------------
        | Find Active Vendor By Slug
        |--------------------------------------------------------------------------
        */

        $vendor = Vendor::query()
            ->where('slug', $slug)
            ->where('status', 'active')
            ->first();

        abort_unless($vendor, 404);

        /*
        |--------------------------------------------------------------------------
        | Load Vendor Data
        |--------------------------------------------------------------------------
        */

        $vendor->load([

            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */

            'city',

            /*
            |--------------------------------------------------------------------------
            | Categories / Taxonomies
            |--------------------------------------------------------------------------
            */

            'taxonomies.parent',

            /*
            |--------------------------------------------------------------------------
            | Services
            |--------------------------------------------------------------------------
            */

            'services' => function ($query) {

                $query
                    ->where(
                        'services.status',
                        'active'
                    )
                    ->where(
                        'vendor_services.status',
                        'active'
                    )
                    ->orderBy(
                        'services.name'
                    );
            },

            /*
            |--------------------------------------------------------------------------
            | Event Types
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | vendor_event_types does NOT have a status column.
            | Therefore only event_types.status is checked.
            |
            */

            'eventTypes' => function ($query) {

                $query
                    ->where(
                        'event_types.status',
                        'active'
                    )
                    ->orderBy(
                        'event_types.name'
                    );
            },

            /*
            |--------------------------------------------------------------------------
            | Gallery Images
            |--------------------------------------------------------------------------
            */

            'images' => function ($query) {

                $query
                    ->where(
                        'status',
                        'active'
                    )
                    ->orderBy(
                        'sort_order'
                    );
            },

            /*
            |--------------------------------------------------------------------------
            | Packages
            |--------------------------------------------------------------------------
            */

            'packages' => function ($query) {

                $query
                    ->where(
                        'status',
                        'active'
                    )
                    ->with([
                        'services' => function ($serviceQuery) {

                            $serviceQuery
                                ->where(
                                    'services.status',
                                    'active'
                                );
                        },
                    ])
                    ->orderBy('name');
            },
        ]);

        /*
        |--------------------------------------------------------------------------
        | Related Vendors
        |--------------------------------------------------------------------------
        */

        $taxonomyIds = $vendor
            ->taxonomies
            ->pluck('id');

        $relatedVendors = Vendor::query()

            ->where(
                'status',
                'active'
            )

            ->where(
                'id',
                '!=',
                $vendor->id
            )

            ->when(
                $taxonomyIds->isNotEmpty(),
                function ($query) use ($taxonomyIds) {

                    $query->whereHas(
                        'taxonomies',
                        function ($taxonomyQuery) use ($taxonomyIds) {

                            $taxonomyQuery->whereIn(
                                'taxonomies.id',
                                $taxonomyIds
                            );
                        }
                    );
                }
            )

            ->with([
                'city',
                'taxonomies',

                'images' => function ($query) {

                    $query
                        ->where(
                            'status',
                            'active'
                        )
                        ->orderBy(
                            'sort_order'
                        );
                },
            ])

            ->orderByDesc('is_featured')
            ->orderByDesc('is_premium')
            ->orderByDesc('avg_rating')
            ->orderByDesc('review_count')

            ->limit(4)

            ->get();

        /*
        |--------------------------------------------------------------------------
        | Public Navigation Data
        |--------------------------------------------------------------------------
        */

        $venueTaxonomies = Taxonomy::query()
            ->with('children')
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $eventTypes = EventType::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $cities = City::query()
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Vendor Profile View
        |--------------------------------------------------------------------------
        */

        return view('public.vendors.show', [

            'vendor' => $vendor,

            'relatedVendors' => $relatedVendors,

            'venueTaxonomies' => $venueTaxonomies,
            'services' => $services,
            'eventTypes' => $eventTypes,
            'cities' => $cities,
        ]);
    }
}