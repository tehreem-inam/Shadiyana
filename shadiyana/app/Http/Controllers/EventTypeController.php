<?php

namespace App\Http\Controllers;
use League\CommonMark\CommonMarkConverter;
use App\Models\EventType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\Image;


class EventTypeController extends Controller
{
    /**
     * Display a listing of event types.
     */
    public function index(Request $request): View
    {
        $query = EventType::query()
            ->withCount('vendors')
            ->with('images');

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $eventTypes = $query
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view(
            'event_types.index',
            compact('eventTypes')
        );
    }


    /**
     * Show the form for creating a new event type.
     */
    public function create(): View
    {
        return view('event_types.create');
    }


    /**
     * Store a newly created event type.
     */
public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'slug' => [
            'required',
            'string',
            'max:255',
            'unique:event_types,slug',
        ],

        'description' => [
            'nullable',
            'string',
        ],

        /*
        |--------------------------------------------------------------------------
        | Multiple Images
        |--------------------------------------------------------------------------
        */

        'images' => [
            'nullable',
            'array',
            'max:10',
        ],

        'images.*' => [
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

        'status' => [
            'required',
            Rule::in(['active', 'inactive']),
        ],

        'sort_order' => [
            'nullable',
            'integer',
            'min:0',
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Create Event Type
    |--------------------------------------------------------------------------
    */

    $eventType = EventType::create([
        'name' => $validated['name'],
        'slug' => $validated['slug'],
        'description' => $validated['description'] ?? null,
        'status' => $validated['status'],
        'sort_order' => $validated['sort_order'] ?? 0,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Store Multiple Images
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('images')) {

        foreach ($request->file('images') as $image) {

            $path = $image->store(
                'event-types',
                'public'
            );

            $eventType->images()->create([
                'path' => $path,
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('event-types.index')
        ->with(
            'success',
            'Event type created successfully.'
        );
}

/**
 * Display the specified event type.
 */
public function show(EventType $eventType): View
{
    $eventType->load([
        'vendors',
        'images',
    ]);

    $converter = new CommonMarkConverter();

    $descriptionHtml = $eventType->description
        ? $converter->convert($eventType->description)->getContent()
        : null;

    return view(
        'event_types.show',
        compact(
            'eventType',
            'descriptionHtml'
        )
    );
}
    /**
     * Show the form for editing the specified event type.
     */
public function edit(EventType $eventType): View
{
    $eventType->load('images');

    return view(
        'event_types.edit',
        compact('eventType')
    );
}


/**
 * Update the specified event type.
 */
public function update(
    Request $request,
    EventType $eventType
): RedirectResponse {

    /*
    |--------------------------------------------------------------------------
    | Validate Event Type
    |--------------------------------------------------------------------------
    */

    $validated = $request->validate([

        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'slug' => [
            'required',
            'string',
            'max:255',
            Rule::unique('event_types', 'slug')
                ->ignore($eventType->id),
        ],

        'description' => [
            'nullable',
            'string',
        ],

        'status' => [
            'required',
            Rule::in(['active', 'inactive']),
        ],

        'sort_order' => [
            'nullable',
            'integer',
            'min:0',
        ],

        /*
        |--------------------------------------------------------------------------
        | New Images
        |--------------------------------------------------------------------------
        */

        'images' => [
            'nullable',
            'array',
        ],

        'images.*' => [
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | Update Event Type Information
    |--------------------------------------------------------------------------
    */

    $eventType->update([
        'name' => $validated['name'],
        'slug' => $validated['slug'],
        'description' => $validated['description'] ?? null,
        'status' => $validated['status'],
        'sort_order' => $validated['sort_order'] ?? 0,
    ]);


    /*
    |--------------------------------------------------------------------------
    | Store Newly Added Images
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('images')) {

        foreach ($request->file('images') as $image) {

            $path = $image->store(
                'event-types',
                'public'
            );

            $eventType->images()->create([
                'path' => $path,
            ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('event-types.index')
        ->with(
            'success',
            'Event type updated successfully.'
        );
}

    /**
 * Remove an image from an event type.
 */
            public function destroyImage(
    EventType $eventType,
    Image $image
): RedirectResponse {

    /*
    |--------------------------------------------------------------------------
    | Make sure the image belongs to this event type
    |--------------------------------------------------------------------------
    */

    if (
        $image->imageable_type !== EventType::class ||
        (int) $image->imageable_id !== (int) $eventType->id
    ) {
        abort(404);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete physical image
    |--------------------------------------------------------------------------
    */

    if (
        $image->path &&
        Storage::disk('public')->exists($image->path)
    ) {
        Storage::disk('public')->delete($image->path);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete database record
    |--------------------------------------------------------------------------
    */

    $image->delete();

    return redirect()
        ->route('event-types.edit', $eventType)
        ->with(
            'success',
            'Event type image deleted successfully.'
        );
}

    /**
     * Remove the specified event type.
     */
    public function destroy(
        EventType $eventType
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Prevent deletion if vendors are assigned
        |--------------------------------------------------------------------------
        */

        if ($eventType->vendors()->exists()) {

            return redirect()
                ->route('event-types.index')
                ->with(
                    'error',
                    'This event type cannot be deleted because vendors are currently assigned to it.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Event Type Images
        |--------------------------------------------------------------------------
        */

        foreach ($eventType->images as $image) {

            if (
                $image->path &&
                Storage::disk('public')->exists($image->path)
            ) {
                Storage::disk('public')->delete(
                    $image->path
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Image Records
        |--------------------------------------------------------------------------
        */

        $eventType->images()->delete();


        /*
        |--------------------------------------------------------------------------
        | Delete Event Type
        |--------------------------------------------------------------------------
        */

        $eventType->delete();


        return redirect()
            ->route('event-types.index')
            ->with(
                'success',
                'Event type deleted successfully.'
            );
    }
}

