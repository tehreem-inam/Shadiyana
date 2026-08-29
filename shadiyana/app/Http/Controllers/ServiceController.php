<?php

namespace App\Http\Controllers;
use League\CommonMark\CommonMarkConverter;
use App\Models\Service;
use App\Models\Taxonomy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(Request $request): View
    {
        $query = Service::query()
            ->with('taxonomy')
            ->withCount('vendors');

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('taxonomy_id')) {
            $query->where(
                'taxonomy_id',
                $request->taxonomy_id
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $services = $query
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $taxonomies = Taxonomy::query()
            ->orderBy('name')
            ->get();

        return view('services.index', compact(
            'services',
            'taxonomies'
        ));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): View
    {
        $taxonomies = Taxonomy::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('services.create', compact('taxonomies'));
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'taxonomy_id' => [
                'required',
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
                'unique:services,slug',
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
                'services',
                'public'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Service
        |--------------------------------------------------------------------------
        */

        Service::create($validated);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified service.
     */
/**
 * Display the specified service.
 */
public function show(Service $service): View
{
    $service->load([
        'taxonomy',
        'vendors',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Convert Markdown Description to HTML
    |--------------------------------------------------------------------------
    */

    $converter = new CommonMarkConverter();

    $descriptionHtml = $service->description
        ? $converter->convert($service->description)->getContent()
        : '';

    return view('services.show', compact(
        'service',
        'descriptionHtml'
    ));
}

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service): View
    {
        $taxonomies = Taxonomy::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('services.edit', compact(
            'service',
            'taxonomies'
        ));
    }

    /**
     * Update the specified service.
     */
/**
 * Update the specified service.
 */
public function update(
    Request $request,
    Service $service
): RedirectResponse {
    $validated = $request->validate([
        'taxonomy_id' => [
            'required',
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
            Rule::unique('services', 'slug')
                ->ignore($service->id),
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

        'status' => [
            'required',
            Rule::in(['active', 'inactive']),
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Replace Image
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('image')) {

        // Store the new image first.
        $newImagePath = $request->file('image')->store(
            'services',
            'public'
        );

        // Delete the old image if it exists.
        if (
            $service->image &&
            Storage::disk('public')->exists($service->image)
        ) {
            Storage::disk('public')->delete($service->image);
        }

        // Save the new image path.
        $validated['image'] = $newImagePath;
    }

    /*
    |--------------------------------------------------------------------------
    | Update Service
    |--------------------------------------------------------------------------
    */

    $service->update($validated);

    return redirect()
        ->route('services.index')
        ->with('success', 'Service updated successfully.');
}

    /**
     * Remove the specified service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent deletion if vendors are assigned
        |--------------------------------------------------------------------------
        */

        if ($service->vendors()->exists()) {
            return redirect()
                ->route('services.index')
                ->with(
                    'error',
                    'This service cannot be deleted because vendors are currently assigned to it.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Image
        |--------------------------------------------------------------------------
        */

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Service
        |--------------------------------------------------------------------------
        */

        $service->delete();

        return redirect()
            ->route('services.index')
            ->with(
                'success',
                'Service deleted successfully.'
            );
    }
}