@extends('layouts.app')

@section('title', 'Edit City')

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
                Edit {{ $city->name }}
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                                d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"
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

                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                            Edit City
                        </h1>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Update the details and location information for this city.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Back --}}
            <a
                href="{{ route('locations.cities.index') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-800 sm:w-auto"
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
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Cities

            </a>

        </div>

    </div>


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4"
        >

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">

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
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3l-7.5-13a2 2 0 00-3.42 0l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3z"
                        />
                    </svg>

                </div>


                <div class="min-w-0 flex-1">

                    <p class="text-sm font-bold text-red-800">
                        Please correct the following errors
                    </p>

                    <ul class="mt-2 space-y-1 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li class="flex items-start gap-2">

                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-500"></span>

                                <span>
                                    {{ $error }}
                                </span>

                            </li>

                        @endforeach

                    </ul>

                </div>


                <button
                    type="button"
                    @click="show = false"
                    class="shrink-0 text-red-500 transition hover:text-red-700"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>

        </div>

    @endif


    {{-- ============================================================
        EDIT CITY FORM
    ============================================================= --}}

    <form
        action="{{ route('locations.cities.update', $city->id) }}"
        method="POST"
        class="space-y-6"
    >

        @csrf

        @method('PUT')


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
                            Update the basic information for this city.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Form Fields --}}
            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                    {{-- State --}}
                    <div class="sm:col-span-2">

                        <label
                            for="state_id"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            State / Province
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>
                        </label>

                        <div class="relative">

                            <select
                                id="state_id"
                                name="state_id"
                                class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 px-4 pr-10 text-sm text-gray-800 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('state_id') border-red-300 bg-red-50 @enderror"
                            >

                                <option value="">
                                    No state / province
                                </option>

                                @foreach($states as $state)

                                    <option
                                        value="{{ $state->id }}"
                                        @selected(old('state_id', $city->state_id) == $state->id)
                                    >
                                        {{ $state->name }}
                                        @if($state->country)
                                            — {{ $state->country->name }}
                                        @endif
                                    </option>

                                @endforeach

                            </select>

                            <svg
                                class="pointer-events-none absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 9l6 6 6-6"
                                />
                            </svg>

                        </div>

                        @error('state_id')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                        <p class="mt-1.5 text-xs text-gray-400">
                            Select the state or province where this city belongs.
                        </p>

                    </div>


                    {{-- City Name --}}
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
                            value="{{ old('name', $city->name) }}"
                            placeholder="e.g. Multan"
                            maxlength="100"
                            required
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('name') border-red-300 bg-red-50 @enderror"
                        >

                        @error('name')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Slug --}}
                    <div>

                        <label
                            for="slug"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Slug
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <div class="relative">

                            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-400">
                                /
                            </span>

                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $city->slug) }}"
                                placeholder="multan"
                                maxlength="120"
                                required
                                class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 pl-8 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('slug') border-red-300 bg-red-50 @enderror"
                            >

                        </div>

                        @error('slug')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                        <p class="mt-1.5 text-xs text-gray-400">
                            Use a unique, URL-friendly identifier.
                        </p>

                    </div>


                    {{-- Status --}}
                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Status
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <div class="relative">

                            <select
                                id="status"
                                name="status"
                                required
                                class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 px-4 pr-10 text-sm text-gray-800 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('status') border-red-300 bg-red-50 @enderror"
                            >

                                <option
                                    value="active"
                                    @selected(old('status', $city->status) === 'active')
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    @selected(old('status', $city->status) === 'inactive')
                                >
                                    Inactive
                                </option>

                            </select>

                            <svg
                                class="pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 9l6 6 6-6"
                                />
                            </svg>

                        </div>

                        @error('status')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
            COORDINATES
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Card Header --}}
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
                                d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"
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
                            Update the optional latitude and longitude of the city.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                    {{-- Latitude --}}
                    <div>

                        <label
                            for="latitude"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Latitude
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                id="latitude"
                                name="latitude"
                                value="{{ old('latitude', $city->latitude) }}"
                                placeholder="e.g. 30.1575"
                                step="any"
                                min="-90"
                                max="90"
                                class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 pr-16 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('latitude') border-red-300 bg-red-50 @enderror"
                            >

                            <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs font-semibold text-gray-400">
                                ° LAT
                            </span>

                        </div>

                        @error('latitude')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                        <p class="mt-1.5 text-xs text-gray-400">
                            Valid range: -90 to 90.
                        </p>

                    </div>


                    {{-- Longitude --}}
                    <div>

                        <label
                            for="longitude"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Longitude
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>
                        </label>

                        <div class="relative">

                            <input
                                type="number"
                                id="longitude"
                                name="longitude"
                                value="{{ old('longitude', $city->longitude) }}"
                                placeholder="e.g. 71.5249"
                                step="any"
                                min="-180"
                                max="180"
                                class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 pr-16 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('longitude') border-red-300 bg-red-50 @enderror"
                            >

                            <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs font-semibold text-gray-400">
                                ° LNG
                            </span>

                        </div>

                        @error('longitude')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                        <p class="mt-1.5 text-xs text-gray-400">
                            Valid range: -180 to 180.
                        </p>

                    </div>

                </div>


                {{-- Coordinates Info --}}
                <div class="mt-5 rounded-xl border border-blue-100 bg-blue-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600">

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
                                    d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-bold text-blue-800">
                                Location coordinates
                            </p>

                            <p class="mt-1 text-xs leading-5 text-blue-700">
                                Coordinates can be used later for maps, vendor discovery,
                                distance calculations, and location-based services.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
            FORM ACTIONS
        ========================================================= --}}

        <div class="flex flex-col-reverse gap-3 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-6">

            <div>

                <p class="text-xs text-gray-400">
                    City ID #{{ $city->id }}
                </p>

                <p class="mt-0.5 text-xs text-gray-400">
                    Make sure all information is correct before saving.
                </p>

            </div>


            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">

                <a
                    href="{{ route('locations.cities.index') }}"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-800"
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
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                    Cancel

                </a>


                <button
                    type="submit"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#C92F53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30"
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    Update City

                </button>

            </div>

        </div>

    </form>


    {{-- ============================================================
        RECORD INFORMATION
    ============================================================= --}}

    <div class="mt-6 rounded-2xl border border-gray-100 bg-gray-50 p-4">

        <div class="flex flex-col gap-2 text-xs text-gray-500 sm:flex-row sm:items-center sm:justify-between">

            <span>
                Created
                <span class="font-semibold text-gray-700">
                    {{ $city->created_at?->format('d M Y, h:i A') ?? '—' }}
                </span>
            </span>

            <span class="hidden sm:block text-gray-300">
                •
            </span>

            <span>
                Last updated
                <span class="font-semibold text-gray-700">
                    {{ $city->updated_at?->format('d M Y, h:i A') ?? '—' }}
                </span>
            </span>

        </div>

    </div>

</div>

@endsection