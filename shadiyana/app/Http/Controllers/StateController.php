<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StateController extends Controller
{
    /**
     * Display a listing of states.
     */
    public function index(): View
    {
        $states = State::with('country')
            ->latest()
            ->paginate(15);

        return view('locations.states.index', compact('states'));
    }


    /**
     * Show the form for creating a new state.
     */
    public function create(): View
    {
        $countries = Country::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('locations.states.create', compact('countries'));
    }


    /**
     * Store a newly created state.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'country_id' => [
                'required',
                'integer',
                'exists:countries,id',
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
                'unique:states,slug',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        State::create($validated);

        return redirect()
            ->route('locations.states.index')
            ->with('success', 'State created successfully.');
    }


    /**
     * Display the specified state.
     */
    public function show(State $state): View
    {
        $state->load([
            'country',
            'cities',
        ]);

        return view('locations.states.show', compact('state'));
    }


    /**
     * Show the form for editing the specified state.
     */
    public function edit(State $state): View
    {
        $countries = Country::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('locations.states.edit', compact(
            'state',
            'countries'
        ));
    }


    /**
     * Update the specified state.
     */
    public function update(
        Request $request,
        State $state
    ): RedirectResponse {
        $validated = $request->validate([
            'country_id' => [
                'required',
                'integer',
                'exists:countries,id',
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
                'unique:states,slug,' . $state->id,
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $state->update($validated);

        return redirect()
            ->route('locations.states.index')
            ->with('success', 'State updated successfully.');
    }


    /**
     * Remove the specified state.
     */
    public function destroy(State $state): RedirectResponse
    {
        /*
         * Prevent deleting a state that still has cities.
         */
        if ($state->cities()->exists()) {
            return redirect()
                ->route('states.index')
                ->with(
                    'error',
                    'This state cannot be deleted because it has cities associated with it.'
                );
        }

        $state->delete();

        return redirect()
            ->route('locations.states.index')
            ->with('success', 'State deleted successfully.');
    }
}