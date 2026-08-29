<?php

namespace App\Http\Controllers;
use App\Enums\TaxonomyType;
use App\Models\Taxonomy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class TaxonomyController extends Controller
{
    /**
     * Display a listing of taxonomies.
     */
    public function index(Request $request): View
    {
        $query = Taxonomy::query()
            ->with('parent')
            ->withCount(['children', 'services', 'vendors']);

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->string('type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('parent_id')) {
            if ($request->parent_id === 'root') {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $request->parent_id);
            }
        }

        $taxonomies = $query
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $types = Taxonomy::query()
            ->select('type')
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        $parents = Taxonomy::query()
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('taxonomies.index', compact(
            'taxonomies',
            'types',
            'parents'
        ));
    }

    /**
     * Show the form for creating a new taxonomy.
     */
    public function create(): View
    {
        $parents = Taxonomy::query()
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('taxonomies.create', compact('parents'));
    }

    /**
     * Store a newly created taxonomy.
     */
public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'parent_id' => [
            'nullable',
            'integer',
            'exists:taxonomies,id',
        ],

        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'slug' => [
            'required',
            'string',
            'max:255',
            'unique:taxonomies,slug',
        ],

        'description' => [
            'nullable',
            'string',
        ],

        'image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

        'type' => [
            'required',
            Rule::enum(TaxonomyType::class),
        ],

        'sort_order' => [
            'nullable',
            'integer',
            'min:0',
        ],

        'status' => [
            'required',
            Rule::in(['active', 'inactive']),
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Store Image
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store(
            'taxonomies',
            'public'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create Taxonomy
    |--------------------------------------------------------------------------
    */

    Taxonomy::create($validated);

    return redirect()
        ->route('taxonomies.index')
        ->with('success', 'Taxonomy created successfully.');
}
    /**
     * Display the specified taxonomy.
     */
    public function show(Taxonomy $taxonomy): View
    {
        $taxonomy->load([
            'parent',
            'children',
            'services',
            'vendors',
        ]);

        return view('taxonomies.show', compact('taxonomy'));
    }

    /**
     * Show the form for editing the specified taxonomy.
     */
    public function edit(Taxonomy $taxonomy): View
    {
        $parents = Taxonomy::query()
            ->whereNull('parent_id')
            ->whereKeyNot($taxonomy->id)
            ->orderBy('name')
            ->get();

        return view('taxonomies.edit', compact(
            'taxonomy',
            'parents'
        ));
    }

    /**
     * Update the specified taxonomy.
     */
    public function update(
        Request $request,
        Taxonomy $taxonomy
    ): RedirectResponse {
        $validated = $request->validate([
            'parent_id' => [
                'nullable',
                'integer',
                'exists:taxonomies,id',
                Rule::notIn([$taxonomy->id]),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('taxonomies', 'slug')
                    ->ignore($taxonomy->id),
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'image' => [
                'nullable',
                'string',
                'max:255',
            ],
            'type' => [
              'required',
                 Rule::enum(TaxonomyType::class),
],
            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ]);

        $taxonomy->update($validated);

        return redirect()
            ->route('taxonomies.index')
            ->with('success', 'Taxonomy updated successfully.');
    }

    /**
     * Remove the specified taxonomy.
     */
    public function destroy(Taxonomy $taxonomy): RedirectResponse
    {
        if ($taxonomy->children()->exists()) {
            return redirect()
                ->route('taxonomies.index')
                ->with(
                    'error',
                    'This taxonomy cannot be deleted because it has child taxonomies.'
                );
        }

        if ($taxonomy->services()->exists()) {
            return redirect()
                ->route('taxonomies.index')
                ->with(
                    'error',
                    'This taxonomy cannot be deleted because it has services assigned to it.'
                );
        }

        $taxonomy->delete();

        return redirect()
            ->route('taxonomies.index')
            ->with('success', 'Taxonomy deleted successfully.');
    }
}