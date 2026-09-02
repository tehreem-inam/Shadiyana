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
    /**
     * Display public vendor listings.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Query Parameters
        |--------------------------------------------------------------------------
        */

        $categorySlug = $request->query('category');
        $taxonomySlug = $request->query('slug');
        $cityId = $request->query('city');
        $sort = $request->query('sort', 'relevance');


        /*
        |--------------------------------------------------------------------------
        | Parent Taxonomy / Category
        |--------------------------------------------------------------------------
        */

        $category = null;

        if ($categorySlug) {
            $category = Taxonomy::query()
                ->where('slug', $categorySlug)
                ->whereNull('parent_id')
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | Child Taxonomy
        |--------------------------------------------------------------------------
        */

        $taxonomy = null;

        if ($taxonomySlug) {
            $taxonomy = Taxonomy::query()
                ->with('parent')
                ->where('slug', $taxonomySlug)
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Parent → Child Relationship
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
        |
        | IMPORTANT:
        | Only vendors with status = active are displayed.
        |
        */

        $vendors = Vendor::query()

            /*
            |--------------------------------------------------------------------------
            | ACTIVE VENDORS ONLY
            |--------------------------------------------------------------------------
            */

            ->where('status', 'active')


            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            ->with([
                'city',
                'taxonomies.parent',
                'packages',
            ])


            /*
            |--------------------------------------------------------------------------
            | Filter By Child Taxonomy
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
            | Filter By City
            |--------------------------------------------------------------------------
            */

            ->when(
                $cityId,
                function ($query) use ($cityId) {

                    $query->where('city_id', $cityId);

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
        | Navbar Data
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
        | Return View
        |--------------------------------------------------------------------------
        */

        return view('public.listings.index', [

            'vendors' => $vendors,

            // Parent taxonomy
            'category' => $category,

            // Child taxonomy
            'taxonomy' => $taxonomy,

            // Query parameters
            'categorySlug' => $categorySlug,
            'taxonomySlug' => $taxonomySlug,
            'cityId' => $cityId,
            'sort' => $sort,

            // Navbar data
            'venueTaxonomies' => $venueTaxonomies,
            'services' => $services,
            'eventTypes' => $eventTypes,
            'cities' => $cities,
        ]);
    }
}