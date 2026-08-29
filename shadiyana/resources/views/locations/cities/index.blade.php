@extends('layouts.app')

@section('title', 'Cities')

@section('content')

<div
    x-data="{
        search: '',
        status: 'all'
    }"
    class="mx-auto max-w-7xl"
>

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6">

        {{-- Breadcrumb --}}
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-400">

            <a
                href="{{ url('/') }}"
                class="transition hover:text-[#D7385E]"
            >
                Management
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

            <span class="font-medium text-gray-600">
                Locations
            </span>

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

            <span class="text-gray-400">
                Cities
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    {{-- City Icon --}}
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                stroke-width="1.8"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 10h.01M15 10h.01M9 14h.01M15 14h.01"
                            />
                        </svg>

                    </div>

                    <div>

                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                            Cities
                        </h1>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Manage cities and locations across your states and provinces.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Add City --}}
            <a
                href="{{ route('locations.cities.create') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 sm:w-auto"
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
                        d="M12 5v14M5 12h14"
                    />
                </svg>

                Add City

            </a>

        </div>

    </div>


    {{-- ============================================================
        FLASH MESSAGES
    ============================================================= --}}

    <!-- @if(session('success'))

        <!-- <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4"
        >

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-600">

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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

                <div class="min-w-0 flex-1">

                    <p class="text-sm font-bold text-green-800">
                        Success
                    </p>

                    <p class="mt-0.5 text-sm text-green-700">
                        {{ session('success') }}
                    </p>

                </div>

                <button
                    type="button"
                    @click="show = false"
                    class="text-green-500 transition hover:text-green-700"
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

        </div> -->

    @endif -->


    @if(session('error'))

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
                            stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3l-7.5-13a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div class="min-w-0 flex-1">

                    <p class="text-sm font-bold text-red-800">
                        Action could not be completed
                    </p>

                    <p class="mt-0.5 text-sm text-red-700">
                        {{ session('error') }}
                    </p>

                </div>

                <button
                    type="button"
                    @click="show = false"
                    class="text-red-500 transition hover:text-red-700"
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
        STATISTICS
    ============================================================= --}}

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- Total Cities --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Total Cities
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $cities->total() }}
                    </p>

                </div>

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
                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 10h.01M15 10h.01M9 14h.01M15 14h.01"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Active --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Active
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $cities->where('status', 'active')->count() }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600">

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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Inactive --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Inactive
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $cities->where('status', 'inactive')->count() }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

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
                            d="M18 6L6 18M6 6l12 12"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        CITIES TABLE CARD
    ============================================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Card Header --}}
        <div class="border-b border-gray-100 p-5 sm:p-6">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <h2 class="text-base font-bold text-gray-900">
                        All Cities
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500">
                        View and manage all registered cities.
                    </p>

                </div>


                {{-- Filters --}}
                <div class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto">

                    {{-- Search --}}
                    <div class="relative sm:min-w-[280px]">

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
                                d="M21 21l-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                            />
                        </svg>

                        <input
                            type="search"
                            x-model="search"
                            placeholder="Search cities..."
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 pl-10 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                    </div>


                    {{-- Status --}}
                    <select
                        x-model="status"
                        class="h-11 rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                    >

                        <option value="all">
                            All Status
                        </option>

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>

            </div>

        </div>


        {{-- ========================================================
            DESKTOP TABLE
        ========================================================= --}}

        <div class="hidden overflow-x-auto md:block">

            <table class="min-w-full">

                <thead>

                    <tr class="border-b border-gray-100 bg-gray-50/70">

                        <th class="px-6 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            City
                        </th>

                        <th class="px-6 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            State / Province
                        </th>

                        <th class="px-6 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Country
                        </th>

                        <th class="px-6 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Coordinates
                        </th>

                        <th class="px-6 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Status
                        </th>

                        <th class="px-6 py-3.5 text-right text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($cities as $city)

                        <tr
                            x-show="
                                (
                                    search === '' ||
                                    '{{ strtolower($city->name) }}'.includes(search.toLowerCase()) ||
                                    '{{ strtolower($city->state?->name ?? '') }}'.includes(search.toLowerCase()) ||
                                    '{{ strtolower($city->state?->country?->name ?? '') }}'.includes(search.toLowerCase())
                                )
                                &&
                                (status === 'all' || status === '{{ $city->status }}')
                            "
                            class="transition hover:bg-gray-50/70"
                        >

                            {{-- City --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]">
                                        {{ strtoupper(substr($city->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('locations.cities.show', $city->id) }}"
                                            class="block truncate text-sm font-bold text-gray-900 transition hover:text-[#D7385E]"
                                        >
                                            {{ $city->name }}
                                        </a>

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            /{{ $city->slug }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- State --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-500">

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
                                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4"
                                            />
                                        </svg>

                                    </span>

                                    <div>

                                        <p class="text-sm font-semibold text-gray-700">
                                            {{ $city->state?->name ?? '—' }}
                                        </p>

                                        @if($city->state?->slug)

                                            <p class="text-xs text-gray-400">
                                                /{{ $city->state->slug }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Country --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-500">

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
                                                d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="10"
                                                r="2.5"
                                                stroke-width="1.8"
                                            />
                                        </svg>

                                    </span>

                                    <div>

                                        <p class="text-sm font-semibold text-gray-700">
                                            {{ $city->state?->country?->name ?? '—' }}
                                        </p>

                                        @if($city->state?->country?->code)

                                            <p class="text-xs text-gray-400">
                                                {{ strtoupper($city->state->country->code) }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Coordinates --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if($city->latitude !== null || $city->longitude !== null)

                                    <div class="text-xs">

                                        <p class="font-semibold text-gray-700">
                                            {{ $city->latitude ?? '—' }}
                                        </p>

                                        <p class="mt-0.5 text-gray-400">
                                            {{ $city->longitude ?? '—' }}
                                        </p>

                                    </div>

                                @else

                                    <span class="text-xs text-gray-400">
                                        Not provided
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if($city->status === 'active')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-bold text-green-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-bold text-gray-500">

                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center justify-end gap-1">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('locations.cities.show', $city->id) }}"
                                        title="View City"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-blue-50 hover:text-blue-600"
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

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="3"
                                                stroke-width="1.8"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('locations.cities.edit', $city->id) }}"
                                        title="Edit City"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                                                d="M12 20h9"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <button
                                        type="button"
                                        title="Delete City"
                                        @click="$dispatch('confirm-delete', {
                                            url: '{{ route('locations.cities.destroy', $city->id) }}',
                                            name: '{{ addslashes($city->name) }}'
                                        })"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-50 hover:text-red-600"
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
                                                d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                            />
                                        </svg>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

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

                                    <h3 class="mt-4 text-base font-bold text-gray-900">
                                        No cities found
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Get started by adding your first city.
                                    </p>

                                    <a
                                        href="{{ route('locations.cities.create') }}"
                                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#c92f53]"
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
                                                d="M12 5v14M5 12h14"
                                            />
                                        </svg>

                                        Add City

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ========================================================
            MOBILE CARDS
        ========================================================= --}}

        <div class="divide-y divide-gray-100 md:hidden">

            @forelse($cities as $city)

                <div
                    x-show="
                        (
                            search === '' ||
                            '{{ strtolower($city->name) }}'.includes(search.toLowerCase()) ||
                            '{{ strtolower($city->state?->name ?? '') }}'.includes(search.toLowerCase()) ||
                            '{{ strtolower($city->state?->country?->name ?? '') }}'.includes(search.toLowerCase())
                        )
                        &&
                        (status === 'all' || status === '{{ $city->status }}')
                    "
                    class="p-5 transition hover:bg-gray-50/70"
                >

                    <div class="flex items-start gap-3">

                        {{-- Avatar --}}
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]">
                            {{ strtoupper(substr($city->name, 0, 1)) }}
                        </div>


                        {{-- Main Content --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-3">

                                <div class="min-w-0">

                                    <a
                                        href="{{ route('locations.cities.show', $city->id) }}"
                                        class="truncate text-sm font-bold text-gray-900 hover:text-[#D7385E]"
                                    >
                                        {{ $city->name }}
                                    </a>

                                    <p class="mt-0.5 text-xs text-gray-400">
                                        /{{ $city->slug }}
                                    </p>

                                </div>


                                {{-- Status --}}
                                @if($city->status === 'active')

                                    <span class="shrink-0 rounded-full bg-green-50 px-2 py-1 text-[10px] font-bold text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="shrink-0 rounded-full bg-gray-100 px-2 py-1 text-[10px] font-bold text-gray-500">
                                        Inactive
                                    </span>

                                @endif

                            </div>


                            {{-- Details --}}
                            <div class="mt-3 space-y-2 text-xs text-gray-500">

                                {{-- State --}}
                                <span class="flex items-center gap-1.5">

                                    <svg
                                        class="h-3.5 w-3.5 shrink-0 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4"
                                        />
                                    </svg>

                                    <span>
                                        {{ $city->state?->name ?? 'State not assigned' }}
                                    </span>

                                </span>


                                {{-- Country --}}
                                <span class="flex items-center gap-1.5">

                                    <svg
                                        class="h-3.5 w-3.5 shrink-0 text-gray-400"
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

                                    <span>
                                        {{ $city->state?->country?->name ?? 'Country not assigned' }}
                                    </span>

                                </span>


                                {{-- Coordinates --}}
                                @if($city->latitude !== null || $city->longitude !== null)

                                    <span class="flex items-center gap-1.5">

                                        <svg
                                            class="h-3.5 w-3.5 shrink-0 text-gray-400"
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

                                        {{ $city->latitude ?? '—' }},
                                        {{ $city->longitude ?? '—' }}

                                    </span>

                                @endif

                            </div>


                            {{-- Actions --}}
                            <div class="mt-4 flex items-center gap-2">

                                {{-- View --}}
                                <a
                                    href="{{ route('locations.cities.show', $city->id) }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-600 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600"
                                >

                                    <svg
                                        class="h-3.5 w-3.5"
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

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3"
                                            stroke-width="1.8"
                                        />
                                    </svg>

                                    View

                                </a>


                                {{-- Edit --}}
                                <a
                                    href="{{ route('locations.cities.edit', $city->id) }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-600 transition hover:border-[#D7385E]/20 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                >

                                    <svg
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M12 20h9"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                                        />
                                    </svg>

                                    Edit

                                </a>


                                {{-- Delete --}}
                                <button
                                    type="button"
                                    @click="$dispatch('confirm-delete', {
                                        url: '{{ route('locations.cities.destroy', $city->id) }}',
                                        name: '{{ addslashes($city->name) }}'
                                    })"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                >

                                    <svg
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                        />
                                    </svg>

                                    Delete

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="px-6 py-16 text-center">

                    <div class="mx-auto flex max-w-sm flex-col items-center">

                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

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

                        <h3 class="mt-4 text-base font-bold text-gray-900">
                            No cities found
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Start by adding your first city.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- ========================================================
            PAGINATION
        ========================================================= --}}

        @if($cities->hasPages())

            <div class="border-t border-gray-100 px-5 py-4 sm:px-6">

                {{ $cities->links() }}

            </div>

        @endif

    </div>


    {{-- ============================================================
        DELETE CONFIRMATION MODAL
    ============================================================= --}}

    <div
        x-data="{
            open: false,
            deleteUrl: '',
            cityName: ''
        }"
        x-on:confirm-delete.window="
            open = true;
            deleteUrl = $event.detail.url;
            cityName = $event.detail.name;
        "
        x-show="open"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/50 p-4 backdrop-blur-sm"
    >

        <div
            @click.outside="open = false"
            x-transition
            class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            {{-- Modal Header --}}
            <div class="p-6">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-red-600">

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3l-7.5-13a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>


                <h3 class="mt-4 text-lg font-extrabold text-gray-900">
                    Delete City?
                </h3>


                <p class="mt-2 text-sm leading-6 text-gray-500">

                    Are you sure you want to delete

                    <span
                        class="font-bold text-gray-800"
                        x-text="cityName"
                    ></span>?

                    This action cannot be undone.

                </p>

            </div>


            {{-- Modal Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/70 px-6 py-4 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    @click="open = false"
                    class="w-full rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-800 sm:w-auto"
                >
                    Cancel
                </button>


                <form
                    :action="deleteUrl"
                    method="POST"
                    class="w-full sm:w-auto"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-red-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/30 sm:w-auto"
                    >
                        Delete City
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection