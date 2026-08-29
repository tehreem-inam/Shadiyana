
@extends('layouts.app')

@section('title', 'Create City')

@section('content')

<div class="mx-auto max-w-4xl">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6">

        {{-- Breadcrumb --}}
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-400">

            <a
                href="{{ route('locations.cities.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Locations
            </a>

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <a
                href="{{ route('locations.cities.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Cities
            </a>

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="text-gray-600">
                Create
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4">

            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                Create City
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Add a new city to the location management system.
            </p>

        </div>

    </div>


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}

    @if ($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

            <div class="flex gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-red-600">

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v3m0 4h.01M10.29 3.86l-7.36 12.75A2 2 0 004.67 19.6h14.66a2 2 0 001.74-2.99L13.71 3.86a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div>

                    <h3 class="text-sm font-bold text-red-800">
                        Please correct the following errors:
                    </h3>

                    <ul class="mt-2 space-y-1 text-xs text-red-600">

                        @foreach ($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
        CREATE CITY FORM
    ============================================================= --}}

    <form
        action="{{ route('locations.cities.store') }}"
        method="POST"
    >

        @csrf


        {{-- ========================================================
            BASIC INFORMATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Card Header --}}
            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 10h.01M15 10h.01M9 14h.01M15 14h.01"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            City Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Enter the basic details of the city.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Form Fields --}}
            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                    {{-- =================================================
                        STATE
                    ================================================== --}}

                    <div class="sm:col-span-2">

                        <label
                            for="state_id"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            State / Province
                        </label>

                        <select
                            id="state_id"
                            name="state_id"
                            class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                            <option value="">
                                No State / Province
                            </option>

                            @foreach ($states as $state)

                                <option
                                    value="{{ $state->id }}"
                                    {{ old('state_id') == $state->id ? 'selected' : '' }}
                                >
                                    {{ $state->name }}

                                    @if ($state->country)
                                        — {{ $state->country->name }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1.5 text-xs text-gray-400">
                            Select the state or province this city belongs to.
                            This field is optional.
                        </p>

                        @error('state_id')

                            <p class="mt-1.5 text-xs font-semibold text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        CITY NAME
                    ================================================== --}}

                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            City Name
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            maxlength="100"
                            placeholder="e.g. Multan"
                            class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                        @error('name')

                            <p class="mt-1.5 text-xs font-semibold text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        SLUG
                    ================================================== --}}

                    <div>

                        <label
                            for="slug"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Slug
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            required
                            maxlength="120"
                            placeholder="e.g. multan"
                            class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                        <p class="mt-1.5 text-xs text-gray-400">
                            URL-friendly identifier. Must be unique.
                        </p>

                        @error('slug')

                            <p class="mt-1.5 text-xs font-semibold text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            LOCATION COORDINATES
        ============================================================= --}}

        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- ========================================================
                CARD HEADER
            ========================================================= --}}

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 21s7-5.2 7-11a7 7 0 10-14 0c0 5.8 7 11 7 11z"
                            />

                            <circle
                                cx="12"
                                cy="10"
                                r="2.5"
                                stroke-width="1.8"
                            />

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            Geographic Coordinates
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Search for a location or select the exact position on the map.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                LOCATION CONTENT
            ========================================================= --}}

            <div class="p-5 sm:p-6">


                {{-- ====================================================
                    SEARCH LOCATION
                ===================================================== --}}

                <div>

                    <label
                        for="location-search"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Search Location
                    </label>


                    <div class="flex flex-col gap-2 sm:flex-row">

                        <div class="relative flex-1">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                <svg
                                    class="h-4 w-4 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                                    />
                                </svg>

                            </div>


                            <input
                                type="text"
                                id="location-search"
                                autocomplete="off"
                                placeholder="e.g. Multan, Pakistan"
                                class="block w-full rounded-xl border border-gray-200 bg-white py-3 pl-11 pr-4 text-sm font-medium text-gray-700 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                            >

                        </div>


                        <button
                            type="button"
                            id="location-search-button"
                            class="inline-flex h-11 shrink-0 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#C92F53] hover:shadow-md disabled:cursor-not-allowed disabled:opacity-60"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                                />
                            </svg>

                            <span>
                                Search
                            </span>

                        </button>

                    </div>


                    {{-- Search Status --}}
                    <p
                        id="location-search-message"
                        class="mt-2 hidden text-xs"
                    ></p>


                    <p class="mt-2 text-xs text-gray-400">
                        Search for a city or location, then fine-tune the exact position using the map.
                    </p>

                </div>


                {{-- ====================================================
                    MAP
                ===================================================== --}}

                <div class="mt-6">

                    <div class="mb-3 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <h3 class="text-sm font-bold text-gray-700">
                                Select Location on Map
                            </h3>

                            <p class="text-xs text-gray-400">
                                Click anywhere on the map or drag the marker.
                            </p>

                        </div>


                        <span class="inline-flex w-fit items-center rounded-full bg-gray-100 px-3 py-1 text-[11px] font-semibold text-gray-500">
                            OpenStreetMap
                        </span>

                    </div>


                    {{-- Map --}}
                    <div
                        id="city-map"
                        class="h-[350px] w-full overflow-hidden rounded-2xl border border-gray-200 bg-gray-100 shadow-sm sm:h-[450px]"
                    ></div>


                    {{-- Map Instructions --}}
                    <div class="mt-3 flex items-start gap-2 rounded-xl bg-[#FBEBEF] px-4 py-3">

                        <svg
                            class="mt-0.5 h-4 w-4 shrink-0 text-[#D7385E]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                            />

                        </svg>


                        <p class="text-xs leading-5 text-[#9f2946]">

                            <span class="font-bold">
                                Tip:
                            </span>

                            Click anywhere on the map to place the marker.
                            You can also drag the marker to fine-tune the exact location.

                        </p>

                    </div>

                </div>


                {{-- ====================================================
                    COORDINATES
                ===================================================== --}}

                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">


                    {{-- =================================================
                        LATITUDE
                    ================================================== --}}

                    <div>

                        <label
                            for="latitude"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Latitude
                        </label>


                        <input
                            type="number"
                            id="latitude"
                            name="latitude"
                            value="{{ old('latitude') }}"
                            step="0.00000001"
                            min="-90"
                            max="90"
                            placeholder="e.g. 30.15750000"
                            class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                        >


                        <p class="mt-1.5 text-xs text-gray-400">
                            Automatically updated when a map location is selected.
                        </p>


                        @error('latitude')

                            <p class="mt-1.5 text-xs font-semibold text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        LONGITUDE
                    ================================================== --}}

                    <div>

                        <label
                            for="longitude"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Longitude
                        </label>


                        <input
                            type="number"
                            id="longitude"
                            name="longitude"
                            value="{{ old('longitude') }}"
                            step="0.00000001"
                            min="-180"
                            max="180"
                            placeholder="e.g. 71.52490000"
                            class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                        >


                        <p class="mt-1.5 text-xs text-gray-400">
                            Automatically updated when a map location is selected.
                        </p>


                        @error('longitude')

                            <p class="mt-1.5 text-xs font-semibold text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            STATUS
        ============================================================= --}}

        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-600">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 12l2 2 4-4m5.5 2a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            City Status
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Control whether this city is available throughout the system.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <label
                    for="status"
                    class="mb-2 block text-sm font-bold text-gray-700"
                >
                    Status
                    <span class="text-[#D7385E]">*</span>
                </label>

                <select
                    id="status"
                    name="status"
                    required
                    class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10 sm:max-w-sm"
                >

                    <option
                        value="active"
                        {{ old('status', 'active') === 'active' ? 'selected' : '' }}
                    >
                        Active
                    </option>

                    <option
                        value="inactive"
                        {{ old('status') === 'inactive' ? 'selected' : '' }}
                    >
                        Inactive
                    </option>

                </select>

                <p class="mt-1.5 text-xs text-gray-400">
                    Active cities can be selected when creating or managing vendors.
                </p>

                @error('status')

                    <p class="mt-1.5 text-xs font-semibold text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>


        {{-- ============================================================
            FORM ACTIONS
        ============================================================= --}}

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('locations.cities.index') }}"
                class="inline-flex h-11 items-center justify-center rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-800"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#C92F53] hover:shadow-md"
            >

                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 5v14M5 12h14"
                    />
                </svg>

                Create City

            </button>

        </div>

    </form>

</div>

@endsection

