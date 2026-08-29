@extends('layouts.app')

@section('title', 'City Details')

@section('content')

<div class="mx-auto max-w-5xl">

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
                {{ $city->name }}
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                    City Details
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    View detailed information about this city and its location.
                </p>

            </div>


            {{-- Header Actions --}}
            <div class="flex w-full gap-3 sm:w-auto">

                <a
                    href="{{ route('locations.cities.index') }}"
                    class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-800 sm:flex-none"
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

                    Back

                </a>


                <a
                    href="{{ route('locations.cities.edit', $city->id) }}"
                    class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#C92F53] hover:shadow-md sm:flex-none"
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
                            d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.464 4 19.5l1.036-4.25L16.862 3.487z"
                        />
                    </svg>

                    Edit City

                </a>

            </div>

        </div>

    </div>


    {{-- ============================================================
        CITY OVERVIEW
    ============================================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Card Header --}}
        <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-4">

                    {{-- City Icon --}}
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg
                            class="h-7 w-7"
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


                    <div class="min-w-0">

                        <h2 class="truncate text-xl font-extrabold text-gray-900">
                            {{ $city->name }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            City ID #{{ $city->id }}
                        </p>

                    </div>

                </div>


                {{-- Status --}}
                @if($city->status === 'active')

                    <span class="inline-flex w-fit items-center gap-2 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700">

                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                        Active

                    </span>

                @else

                    <span class="inline-flex w-fit items-center gap-2 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-600">

                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                        Inactive

                    </span>

                @endif

            </div>

        </div>


        {{-- ========================================================
            DETAILS
        ========================================================= --}}

        <div class="p-5 sm:p-6">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">


                {{-- State --}}
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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
                                    d="M4 20h16M6 20V8l6-4 6 4v12M9 20v-4h6v4M9 10h.01M15 10h.01M9 13h.01M15 13h.01"
                                />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                State
                            </p>

                            @if($city->state)

                                <p class="mt-1 truncate text-sm font-bold text-gray-900">
                                    {{ $city->state->name }}
                                </p>

                            @else

                                <p class="mt-1 text-sm font-medium text-gray-400">
                                    Not assigned
                                </p>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Country --}}
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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

                        <div class="min-w-0">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Country
                            </p>

                            @if($city->state?->country)

                                <p class="mt-1 truncate text-sm font-bold text-gray-900">
                                    {{ $city->state->country->name }}
                                </p>

                            @else

                                <p class="mt-1 text-sm font-medium text-gray-400">
                                    Not assigned
                                </p>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Slug --}}
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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
                                    d="M10 13a5 5 0 007.54.54l2-2a5 5 0 00-7.07-7.07l-1.14 1.14M14 11a5 5 0 00-7.54-.54l-2 2a5 5 0 007.07 7.07l1.14-1.14"
                                />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Slug
                            </p>

                            <p class="mt-1 truncate text-sm font-bold text-gray-900">
                                {{ $city->slug }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Latitude --}}
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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
                                    d="M12 3v18M3 12h18"
                                />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Latitude
                            </p>

                            <p class="mt-1 truncate text-sm font-bold text-gray-900">
                                {{ $city->latitude ?? '—' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Longitude --}}
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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
                                    d="M12 3v18M3 12h18"
                                />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Longitude
                            </p>

                            <p class="mt-1 truncate text-sm font-bold text-gray-900">
                                {{ $city->longitude ?? '—' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Status --}}
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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
                                    d="M9 12l2 2 4-4m5.5 2a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0z"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Status
                            </p>

                            <p class="mt-1 text-sm font-bold capitalize text-gray-900">
                                {{ $city->status }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Vendors --}}
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4 sm:col-span-2 lg:col-span-3">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Vendors
                            </p>

                            <p class="mt-1 text-sm font-bold text-gray-900">
                                {{ $city->vendors->count() }}
                                {{ $city->vendors->count() === 1 ? 'Vendor' : 'Vendors' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        SYSTEM INFORMATION
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
                            d="M12 8v4m0 4h.01M4.93 4.93a10 10 0 0114.14 0M4.93 19.07a10 10 0 0114.14 0"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="text-base font-bold text-gray-900">
                        System Information
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500">
                        Record creation and modification details.
                    </p>

                </div>

            </div>

        </div>


        <div class="p-5 sm:p-6">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                {{-- Created At --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Created At
                    </p>

                    <p class="mt-1.5 text-sm font-semibold text-gray-800">
                        {{ $city->created_at?->format('d M Y, h:i A') ?? '—' }}
                    </p>

                </div>


                {{-- Updated At --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Last Updated
                    </p>

                    <p class="mt-1.5 text-sm font-semibold text-gray-800">
                        {{ $city->updated_at?->format('d M Y, h:i A') ?? '—' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        DELETE CITY
    ============================================================= --}}

    <div class="mt-6 flex flex-col gap-3 rounded-2xl border border-red-100 bg-red-50 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">

        <div>

            <h3 class="text-sm font-bold text-red-800">
                Delete this city
            </h3>

            <p class="mt-1 max-w-2xl text-xs leading-5 text-red-600">
                Permanently remove this city from the location management system.
                This action cannot be undone.
            </p>

        </div>


        <form
            action="{{ route('locations.cities.destroy', $city->id) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete {{ $city->name }}? This action cannot be undone.');"
        >

            @csrf

            @method('DELETE')

            <button
                type="submit"
                class="inline-flex h-10 w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 text-sm font-bold text-red-600 transition hover:bg-red-600 hover:text-white sm:w-auto"
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
                        d="M6 7h12M9 7V4h6v3m-8 0l1 13h8l1-13M10 11v6m4-6v6"
                    />
                </svg>

                Delete City

            </button>

        </form>

    </div>

</div>

@endsection