@extends('layouts.app')

@section('title', 'Edit State')

@section('content')

<div class="mx-auto max-w-4xl">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6">

        {{-- Breadcrumb --}}
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-400">

            <a
                href="{{ route('locations.states.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Locations
            </a>

            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <a
                href="{{ route('locations.states.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                States
            </a>

            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="text-gray-600">
                Edit State
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4">

            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                Edit State
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Update the information and status of this state or province.
            </p>

        </div>

    </div>


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

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
                            stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3l-7.5-13a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div class="min-w-0">

                    <h3 class="text-sm font-bold text-red-800">
                        Please fix the following errors
                    </h3>

                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
        EDIT FORM
    ============================================================= --}}

    <form
        action="{{ route('locations.states.update', $state->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        {{-- ========================================================
            STATE INFORMATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                            State Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Update the basic information for this state.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                    {{-- =================================================
                        COUNTRY
                    ================================================== --}}

                    <div>

                        <label
                            for="country_id"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Country
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <svg
                                class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
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


                            <select
                                id="country_id"
                                name="country_id"
                                class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 pl-10 pr-10 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('country_id') border-red-300 bg-red-50 @enderror"
                            >

                                <option value="">
                                    Select country
                                </option>

                                @foreach($countries as $country)

                                    <option
                                        value="{{ $country->id }}"
                                        @selected(old('country_id', $state->country_id) == $country->id)
                                    >
                                        {{ $country->name }}
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
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </div>

                        @error('country_id')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        STATE NAME
                    ================================================== --}}

                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            State / Province Name
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $state->name) }}"
                            placeholder="e.g. Punjab"
                            autocomplete="off"
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('name') border-red-300 bg-red-50 @enderror"
                        >

                        @error('name')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
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
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Slug
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="slug"
                            name="slug"
                            type="text"
                            value="{{ old('slug', $state->slug) }}"
                            placeholder="e.g. punjab"
                            autocomplete="off"
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('slug') border-red-300 bg-red-50 @enderror"
                        >

                        <p class="mt-1.5 text-xs text-gray-400">
                            URL-friendly identifier. Example: <span class="font-medium">punjab</span>
                        </p>

                        @error('slug')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        STATUS
                    ================================================== --}}

                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Status
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('status') border-red-300 bg-red-50 @enderror"
                        >

                            <option value="">
                                Select status
                            </option>

                            <option
                                value="active"
                                @selected(old('status', $state->status) === 'active')
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                @selected(old('status', $state->status) === 'inactive')
                            >
                                Inactive
                            </option>

                        </select>

                        @error('status')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                    CURRENT RECORD INFORMATION
                ================================================== --}}

                <div class="mt-6 rounded-xl border border-gray-100 bg-gray-50 p-4">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Record Information
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-800">
                                State ID #{{ $state->id }}
                            </p>

                        </div>


                        <div class="grid grid-cols-2 gap-5">

                            <div>

                                <p class="text-[10px] font-bold uppercase tracking-wide text-gray-400">
                                    Created
                                </p>

                                <p class="mt-1 text-xs font-semibold text-gray-700">
                                    {{ $state->created_at?->format('d M Y') ?? '—' }}
                                </p>

                            </div>

                            <div>

                                <p class="text-[10px] font-bold uppercase tracking-wide text-gray-400">
                                    Updated
                                </p>

                                <p class="mt-1 text-xs font-semibold text-gray-700">
                                    {{ $state->updated_at?->format('d M Y') ?? '—' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            FORM ACTIONS
        ============================================================= --}}

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

            {{-- Cancel --}}
            <a
                href="{{ route('locations.states.index') }}"
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

                Cancel

            </a>


            {{-- Right Actions --}}
            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">

                {{-- View State --}}
                <a
                    href="{{ route('locations.states.show', $state->id) }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600 sm:w-auto"
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
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                        />
                    </svg>

                    View State

                </a>


                {{-- Update --}}
                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 py-3 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#C92F53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 sm:w-auto"
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    Update State

                </button>

            </div>

        </div>

    </form>

</div>

@endsection