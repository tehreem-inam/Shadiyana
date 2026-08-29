<?php

namespace App\Http\Controllers;

use App\Models\Taxonomy;
use App\Models\Vendor;
use App\Models\VendorTaxonomy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VendorTaxonomyController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Vendor Taxonomies
    |--------------------------------------------------------------------------
    */

    public function index(Vendor $vendor): View
    {
        $vendor->load([
            'user',
        ]);

        $vendorTaxonomies = VendorTaxonomy::query()
            ->with([
                'taxonomy.parent',
            ])
            ->where('vendor_id', $vendor->id)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'vendors.taxonomies.index',
            compact(
                'vendor',
                'vendorTaxonomies'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Create Form
    |--------------------------------------------------------------------------
    |
    | Displays all taxonomies which are not already assigned
    | to this vendor.
    |
    */

    public function create(Vendor $vendor): View
    {
        $vendor->load([
            'user',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Get Already Assigned Taxonomy IDs
        |--------------------------------------------------------------------------
        */

        $assignedTaxonomyIds = VendorTaxonomy::query()
            ->where('vendor_id', $vendor->id)
            ->pluck('taxonomy_id')
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | Get Available Taxonomies
        |--------------------------------------------------------------------------
        |
        | Only taxonomies which are not already assigned to this vendor
        | are displayed.
        |
        */

        $taxonomies = Taxonomy::query()
            ->when(
                !empty($assignedTaxonomyIds),
                function ($query) use ($assignedTaxonomyIds) {
                    $query->whereNotIn('id', $assignedTaxonomyIds);
                }
            )
            ->with('parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Group Taxonomies
        |--------------------------------------------------------------------------
        |
        | Group taxonomies by parent_id so the Blade view can organize
        | them by category/parent.
        |
        */

        $groupedTaxonomies = $taxonomies->groupBy(
            function ($taxonomy) {
                return $taxonomy->parent_id ?? 0;
            }
        );


        return view(
            'vendors.taxonomies.create',
            compact(
                'vendor',
                'taxonomies',
                'groupedTaxonomies',
                'assignedTaxonomyIds'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Vendor Taxonomies
    |--------------------------------------------------------------------------
    |
    | Allows multiple taxonomies to be assigned to a vendor
    | in a single request.
    |
    */

    public function store(
        Request $request,
        Vendor $vendor
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Validate Multiple Taxonomies
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'taxonomy_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'taxonomy_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:taxonomies,id',
            ],

        ], [

            'taxonomy_ids.required' =>
                'Please select at least one taxonomy.',

            'taxonomy_ids.array' =>
                'Invalid taxonomy selection.',

            'taxonomy_ids.min' =>
                'Please select at least one taxonomy.',

            'taxonomy_ids.*.required' =>
                'Invalid taxonomy selection.',

            'taxonomy_ids.*.integer' =>
                'Invalid taxonomy selection.',

            'taxonomy_ids.*.distinct' =>
                'A taxonomy cannot be selected more than once.',

            'taxonomy_ids.*.exists' =>
                'One or more selected taxonomies do not exist.',

        ]);


        $taxonomyIds = collect($validated['taxonomy_ids'])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();


        /*
        |--------------------------------------------------------------------------
        | Check Already Assigned Taxonomies
        |--------------------------------------------------------------------------
        |
        | Even though create() only displays unassigned taxonomies,
        | this server-side check protects against duplicate assignments
        | caused by stale forms or manipulated requests.
        |
        */

        $alreadyAssigned = VendorTaxonomy::query()
            ->where('vendor_id', $vendor->id)
            ->whereIn('taxonomy_id', $taxonomyIds)
            ->pluck('taxonomy_id');


        if ($alreadyAssigned->isNotEmpty()) {

            return back()
                ->withInput()
                ->withErrors([
                    'taxonomy_ids' =>
                        'One or more selected taxonomies are already assigned to this vendor.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Create Vendor Taxonomy Relationships
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $vendor,
            $taxonomyIds
        ) {

            $now = now();

            $records = collect($taxonomyIds)
                ->map(function ($taxonomyId) use (
                    $vendor,
                    $now
                ) {

                    return [
                        'vendor_id' => $vendor->id,
                        'taxonomy_id' => $taxonomyId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                })
                ->all();


            VendorTaxonomy::insert($records);
        });


        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $count = count($taxonomyIds);

        return redirect()
            ->route(
                'vendors.taxonomies.index',
                $vendor
            )
            ->with(
                'success',
                $count === 1
                    ? 'Taxonomy assigned to vendor successfully.'
                    : "{$count} taxonomies assigned to vendor successfully."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Form
    |--------------------------------------------------------------------------
    |
    | Editing remains a single relationship operation.
    |
    */

    public function edit(
        Vendor $vendor,
        VendorTaxonomy $vendorTaxonomy
    ): View {

        $this->ensureVendorTaxonomyBelongsToVendor(
            $vendor,
            $vendorTaxonomy
        );

        $vendor->load([
            'user',
        ]);

        $vendorTaxonomy->load([
            'taxonomy.parent',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Get Available Taxonomies
        |--------------------------------------------------------------------------
        |
        | Show:
        |
        | 1. Taxonomies not assigned to this vendor
        | 2. The taxonomy currently assigned to this relationship
        |
        */

        $taxonomies = Taxonomy::query()
            ->where(function ($query) use (
                $vendor,
                $vendorTaxonomy
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
                        $vendorTaxonomy->taxonomy_id
                    );
            })
            ->with('parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        return view(
            'vendors.taxonomies.edit',
            compact(
                'vendor',
                'vendorTaxonomy',
                'taxonomies'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Vendor Taxonomy
    |--------------------------------------------------------------------------
    |
    | Updates one vendor-taxonomy relationship.
    |
    */

    public function update(
        Request $request,
        Vendor $vendor,
        VendorTaxonomy $vendorTaxonomy
    ): RedirectResponse {

        $this->ensureVendorTaxonomyBelongsToVendor(
            $vendor,
            $vendorTaxonomy
        );


        /*
        |--------------------------------------------------------------------------
        | Validate Taxonomy
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'taxonomy_id' => [
                'required',
                'integer',
                'exists:taxonomies,id',

                /*
                |--------------------------------------------------------------
                | Prevent duplicate taxonomy assignment
                |--------------------------------------------------------------
                */

                function (
                    $attribute,
                    $value,
                    $fail
                ) use (
                    $vendor,
                    $vendorTaxonomy
                ) {

                    $exists = VendorTaxonomy::query()
                        ->where('vendor_id', $vendor->id)
                        ->where('taxonomy_id', $value)
                        ->where(
                            'id',
                            '!=',
                            $vendorTaxonomy->id
                        )
                        ->exists();


                    if ($exists) {

                        $fail(
                            'This taxonomy is already assigned to this vendor.'
                        );
                    }
                },
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Relationship
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $vendorTaxonomy,
            $validated
        ) {

            $vendorTaxonomy->update([
                'taxonomy_id' => $validated['taxonomy_id'],
            ]);
        });


        return redirect()
            ->route(
                'vendors.taxonomies.index',
                $vendor
            )
            ->with(
                'success',
                'Vendor taxonomy updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Vendor Taxonomy
    |--------------------------------------------------------------------------
    |
    | Removes only the relationship between the vendor and taxonomy.
    |
    | The original taxonomy record remains untouched.
    |
    */

    public function destroy(
        Vendor $vendor,
        VendorTaxonomy $vendorTaxonomy
    ): RedirectResponse {

        $this->ensureVendorTaxonomyBelongsToVendor(
            $vendor,
            $vendorTaxonomy
        );


        DB::transaction(function () use (
            $vendorTaxonomy
        ) {

            $vendorTaxonomy->delete();
        });


        return redirect()
            ->route(
                'vendors.taxonomies.index',
                $vendor
            )
            ->with(
                'success',
                'Taxonomy removed from vendor successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Verify Vendor Taxonomy Ownership
    |--------------------------------------------------------------------------
    |
    | Makes sure that a vendor-taxonomy relationship actually belongs
    | to the vendor supplied in the URL.
    |
    */

    private function ensureVendorTaxonomyBelongsToVendor(
        Vendor $vendor,
        VendorTaxonomy $vendorTaxonomy
    ): void {

        abort_unless(
            (int) $vendorTaxonomy->vendor_id === (int) $vendor->id,
            404
        );
    }
}

