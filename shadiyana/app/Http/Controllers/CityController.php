<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController extends Controller
{
    /**
     * Display a listing of cities.
     */
    public function index(): View
    {
        $cities = City::with([
                'state.country',
            ])
            ->latest()
            ->paginate(15);

        return view('locations.cities.index', compact('cities'));
    }


    /**
     * Show the form for creating a new city.
     */
    public function create(): View
    {
        $states = State::where('status', 'active')
            ->with('country')
            ->orderBy('name')
            ->get();

        return view('locations.cities.create', compact('states'));
    }


    /**
     * Store a newly created city.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'state_id' => [
                'nullable',
                'integer',
                'exists:states,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'slug' => [
                'required',
                'string',
                'max:120',
                'unique:cities,slug',
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        City::create($validated);

        return redirect()
            ->route('locations.cities.index')
            ->with('success', 'City created successfully.');
    }


    /**
     * Display the specified city.
     */
    public function show(City $city): View
    {
        $city->load([
            'state.country',
            'vendors',
        ]);

        return view('locations.cities.show', compact('city'));
    }


    /**
     * Show the form for editing the specified city.
     */
    public function edit(City $city): View
    {
        $states = State::where('status', 'active')
            ->with('country')
            ->orderBy('name')
            ->get();

        return view('locations.cities.edit', compact(
            'city',
            'states'
        ));
    }


    /**
     * Update the specified city.
     */
    public function update(
        Request $request,
        City $city
    ): RedirectResponse {
        $validated = $request->validate([
            'state_id' => [
                'nullable',
                'integer',
                'exists:states,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'slug' => [
                'required',
                'string',
                'max:120',
                'unique:cities,slug,' . $city->id,
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $city->update($validated);

        return redirect()
            ->route('locations.cities.index')
            ->with('success', 'City updated successfully.');
    }


    /**
     * Remove the specified city.
     */
    public function destroy(City $city): RedirectResponse
    {
        /*
         * Prevent deleting a city that still has vendors.
         */
        if ($city->vendors()->exists()) {
            return redirect()
                ->route('cities.index')
                ->with(
                    'error',
                    'This city cannot be deleted because it has vendors associated with it.'
                );
        }

        $city->delete();

        return redirect()
            ->route('locations.cities.index')
            ->with('success', 'City deleted successfully.');
    }
}