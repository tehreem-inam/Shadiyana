@extends('layouts.app')

@section('title', 'Packages')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            {{-- Breadcrumb --}}
            <div class="mb-3 flex items-center gap-2 text-xs font-medium text-gray-400">

                <a
                    href="{{ route('vendors.packages.index', ['vendor' => $vendor]) }}"
                    class="transition hover:text-[#D7385E]"
                >
                    Vendor
                </a>

                <svg
                    class="h-3.5 w-3.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m9 5 7 7-7 7"
                    />
                </svg>

                <span class="text-gray-500">
                    Packages
                </span>

            </div>

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">
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
                            d="M20 7.5 12 3 4 7.5m16 0v9L12 21l-8-4.5v-9m16 0-8 4.5m-8-4.5 8 4.5m0 0V21"
                        />
                    </svg>
                </div>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                        Packages
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Manage packages offered by
                        <span class="font-semibold text-gray-700">
                            {{ $vendor->business_name }}
                        </span>
                    </p>
                </div>

            </div>

        </div>


        {{-- Add Package --}}
        <a
            href="{{ route('vendors.packages.create', ['vendor' => $vendor]) }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30"
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
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Add Package
        </a>

    </div>




    {{-- ============================================================
        FILTER PANEL
    ============================================================= --}}
    <div
        x-data="{ filtersOpen: true }"
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
    >

        {{-- Filter Header --}}
        <div class="flex flex-col gap-4 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

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
                            d="M3 5h18M6 12h12m-8 7h4"
                        />
                    </svg>

                </div>

                <div>
                    <h2 class="text-sm font-bold text-gray-900">
                        Find a package
                    </h2>

                    <p class="text-xs text-gray-400">
                        Search and refine your packages
                    </p>
                </div>

            </div>


            <div class="flex items-center gap-2">

                @if(request()->hasAny(['search', 'pricing_type', 'status', 'sort']))

                    <a
                        href="{{ route('vendors.packages.index', ['vendor' => $vendor]) }}"
                        class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold text-gray-500 transition hover:bg-gray-50 hover:text-[#D7385E]"
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
                                stroke-width="2"
                                d="M6 6l12 12M18 6 6 18"
                            />
                        </svg>

                        Clear all
                    </a>

                @endif

                <button
                    type="button"
                    @click="filtersOpen = !filtersOpen"
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-600 transition hover:border-gray-300 hover:bg-gray-50"
                >
                    <span x-text="filtersOpen ? 'Hide filters' : 'Show filters'"></span>

                    <svg
                        class="h-4 w-4 transition-transform duration-200"
                        :class="{ 'rotate-180': filtersOpen }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m6 9 6 6 6-6"
                        />
                    </svg>
                </button>

            </div>

        </div>


        {{-- Filter Body --}}
        <div
            x-show="filtersOpen"
            x-transition
            class="border-t border-gray-100 bg-gray-50/60 px-5 py-5"
        >

            <form
                method="GET"
                action="{{ route('vendors.packages.index', ['vendor' => $vendor]) }}"
            >

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">

                    {{-- Search --}}
                    <div class="lg:col-span-6">

                        <label
                            for="search"
                            class="mb-1.5 block text-xs font-semibold text-gray-500"
                        >
                            Search packages
                        </label>

                        <div class="relative">

                            <svg
                                class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                />
                            </svg>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search by package name or description..."
                                class="h-11 w-full rounded-xl border border-gray-200 bg-white pl-11 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                        </div>

                    </div>


                    {{-- Pricing --}}
                    <div class="lg:col-span-2">

                        <label
                            for="pricing_type"
                            class="mb-1.5 block text-xs font-semibold text-gray-500"
                        >
                            Pricing
                        </label>

                        <div class="relative">

                            <select
                                id="pricing_type"
                                name="pricing_type"
                                class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-white px-3.5 pr-9 text-sm text-gray-700 outline-none transition hover:border-gray-300 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                                <option value="">
                                    All pricing
                                </option>

                                <option
                                    value="fixed"
                                    @selected(request('pricing_type') === 'fixed')
                                >
                                    Fixed
                                </option>

                                <option
                                    value="starting_from"
                                    @selected(request('pricing_type') === 'starting_from')
                                >
                                    Starting from
                                </option>

                                <option
                                    value="price_range"
                                    @selected(request('pricing_type') === 'price_range')
                                >
                                    Price range
                                </option>

                                <option
                                    value="per_person"
                                    @selected(request('pricing_type') === 'per_person')
                                >
                                    Per person
                                </option>

                                <option
                                    value="custom"
                                    @selected(request('pricing_type') === 'custom')
                                >
                                    Custom
                                </option>

                            </select>

                            <svg
                                class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m6 9 6 6 6-6"
                                />
                            </svg>

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="lg:col-span-2">

                        <label
                            for="status"
                            class="mb-1.5 block text-xs font-semibold text-gray-500"
                        >
                            Status
                        </label>

                        <div class="relative">

                            <select
                                id="status"
                                name="status"
                                class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-white px-3.5 pr-9 text-sm text-gray-700 outline-none transition hover:border-gray-300 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                                <option value="">
                                    All status
                                </option>

                                <option
                                    value="active"
                                    @selected(request('status') === 'active')
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    @selected(request('status') === 'inactive')
                                >
                                    Inactive
                                </option>

                            </select>

                            <svg
                                class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m6 9 6 6 6-6"
                                />
                            </svg>

                        </div>

                    </div>


                    {{-- Sort --}}
                    <div class="lg:col-span-2">

                        <label
                            for="sort"
                            class="mb-1.5 block text-xs font-semibold text-gray-500"
                        >
                            Sort by
                        </label>

                        <div class="relative">

                            <select
                                id="sort"
                                name="sort"
                                class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-white px-3.5 pr-9 text-sm text-gray-700 outline-none transition hover:border-gray-300 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                                <option value="latest" @selected(request('sort', 'latest') === 'latest')>
                                    Latest
                                </option>

                                <option value="oldest" @selected(request('sort') === 'oldest')>
                                    Oldest
                                </option>

                                <option value="name_asc" @selected(request('sort') === 'name_asc')>
                                    Name A-Z
                                </option>

                                <option value="name_desc" @selected(request('sort') === 'name_desc')>
                                    Name Z-A
                                </option>

                                <option value="price_low" @selected(request('sort') === 'price_low')>
                                    Price: Low to High
                                </option>

                                <option value="price_high" @selected(request('sort') === 'price_high')>
                                    Price: High to Low
                                </option>

                            </select>

                            <svg
                                class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m6 9 6 6 6-6"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Filter Footer --}}
                <div class="mt-5 flex flex-col gap-4 border-t border-gray-200 pt-4 sm:flex-row sm:items-center sm:justify-between">

                    {{-- Active Filters --}}
                    <div class="flex min-h-7 flex-wrap items-center gap-2">

                        <span class="mr-1 text-xs font-medium text-gray-400">
                            Active filters
                        </span>

                        @if(request('search'))

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white px-3 py-1.5 text-xs font-medium text-gray-600 ring-1 ring-gray-200">

                                <svg
                                    class="h-3 w-3 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                    />
                                </svg>

                                {{ request('search') }}

                            </span>

                        @endif


                        @if(request('pricing_type'))

                            <span class="inline-flex items-center rounded-full bg-[#FBEBEF] px-3 py-1.5 text-xs font-semibold text-[#D7385E]">
                                {{ ucwords(str_replace('_', ' ', request('pricing_type'))) }}
                            </span>

                        @endif


                        @if(request('status'))

                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold
                                {{ request('status') === 'active'
                                    ? 'bg-green-50 text-green-700'
                                    : 'bg-gray-100 text-gray-600'
                                }}"
                            >

                                <span
                                    class="h-1.5 w-1.5 rounded-full
                                    {{ request('status') === 'active'
                                        ? 'bg-green-500'
                                        : 'bg-gray-400'
                                    }}"
                                ></span>

                                {{ ucfirst(request('status')) }}

                            </span>

                        @endif


                        @if(!request('search') && !request('pricing_type') && !request('status'))

                            <span class="text-xs text-gray-400">
                                No filters applied
                            </span>

                        @endif

                    </div>


                    {{-- Apply --}}
                    <button
                        type="submit"
                        class="inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30"
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
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                            />
                        </svg>

                        Apply Filters

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ============================================================
        RESULTS SUMMARY
    ============================================================= --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <div class="flex items-center gap-3">

            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-500">

                <svg
                    class="h-4.5 w-4.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M4 6h16M4 12h16M4 18h10"
                    />
                </svg>

            </div>

            <div>

                <p class="text-sm font-semibold text-gray-800">
                    Your packages
                </p>

                <p class="text-xs text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-600">
                        {{ $packages->firstItem() ?? 0 }}
                    </span>
                    -
                    <span class="font-semibold text-gray-600">
                        {{ $packages->lastItem() ?? 0 }}
                    </span>
                    of
                    <span class="font-semibold text-gray-600">
                        {{ $packages->total() }}
                    </span>
                </p>

            </div>

        </div>


        @if(request()->hasAny(['search', 'pricing_type', 'status']))

            <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-[#FBEBEF] px-3 py-1.5 text-xs font-semibold text-[#D7385E]">

                <svg
                    class="h-3.5 w-3.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 5h18M6 12h12m-8 7h4"
                    />
                </svg>

                Filtered results

            </span>

        @endif

    </div>


    {{-- ============================================================
        PACKAGE LIST
    ============================================================= --}}
    @if($packages->count())

        <div class="grid grid-cols-1 gap-4">

            @foreach($packages as $package)

                <article
                    class="group rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-md"
                >

                    <div class="p-5">

                        <div class="flex flex-col gap-5 xl:flex-row xl:items-center">

                            {{-- ====================================================
                                LEFT: PACKAGE INFORMATION
                            ===================================================== --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-center gap-2">

                                    <a
                                        href="{{ route('vendors.packages.show', [
                                            'vendor' => $vendor,
                                            'package' => $package
                                        ]) }}"
                                        class="truncate text-lg font-bold text-gray-900 transition hover:text-[#D7385E]"
                                    >
                                        {{ $package->name }}
                                    </a>


                                    {{-- Status --}}
                                    @if($package->status === 'active')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-[11px] font-bold text-green-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                            Active
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-[11px] font-bold text-gray-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                            Inactive
                                        </span>

                                    @endif

                                </div>


                                {{-- Description --}}
                                @if($package->description)

                                    <p class="mt-2 max-w-3xl line-clamp-2 text-sm leading-6 text-gray-500">
                                        {{ $package->description }}
                                    </p>

                                @else

                                    <p class="mt-2 text-sm italic text-gray-400">
                                        No description added.
                                    </p>

                                @endif


                                {{-- Package Meta --}}
                                <div class="mt-4 flex flex-wrap gap-2">

                                    {{-- Price --}}
                                    <div class="inline-flex items-center gap-2 rounded-xl bg-gray-50 px-3 py-2">

                                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]">

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
                                                    d="M12 8c-2.2 0-4 1.1-4 2.5S9.8 13 12 13s4 1.1 4 2.5S14.2 18 12 18m0-14v2m0 12v2M7 8h10"
                                                />
                                            </svg>

                                        </span>

                                        <div>

                                            <p class="text-[10px] font-medium uppercase tracking-wide text-gray-400">
                                                Price
                                            </p>

                                            <p class="text-sm font-bold text-gray-800">

                                                @if($package->pricing_type === 'fixed' && $package->price !== null)

                                                    PKR {{ number_format((float) $package->price) }}

                                                @elseif($package->pricing_type === 'starting_from' && $package->min_price !== null)

                                                    From PKR {{ number_format((float) $package->min_price) }}

                                                @elseif($package->pricing_type === 'price_range' && $package->min_price !== null && $package->max_price !== null)

                                                    PKR {{ number_format((float) $package->min_price) }}
                                                    -
                                                    {{ number_format((float) $package->max_price) }}

                                                @elseif($package->pricing_type === 'per_person' && $package->price !== null)

                                                    PKR {{ number_format((float) $package->price) }}
                                                    <span class="font-normal text-gray-400">/ person</span>

                                                @else

                                                    Custom Pricing

                                                @endif

                                            </p>

                                        </div>

                                    </div>


                                    {{-- Duration --}}
                                    @if($package->duration)

                                        <div class="inline-flex items-center gap-2 rounded-xl bg-gray-50 px-3 py-2">

                                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white text-gray-500 shadow-sm">

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
                                                        d="M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                                    />
                                                </svg>

                                            </span>

                                            <div>

                                                <p class="text-[10px] font-medium uppercase tracking-wide text-gray-400">
                                                    Duration
                                                </p>

                                                <p class="text-sm font-bold text-gray-800">
                                                    {{ $package->duration }}
                                                </p>

                                            </div>

                                        </div>

                                    @endif


                                    {{-- Guests --}}
                                    @if($package->guest_capacity)

                                        <div class="inline-flex items-center gap-2 rounded-xl bg-gray-50 px-3 py-2">

                                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white text-gray-500 shadow-sm">

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
                                                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m8-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6 3a4 4 0 0 1 4 4v2m-4-6a4 4 0 0 0-3-3.87"
                                                    />
                                                </svg>

                                            </span>

                                            <div>

                                                <p class="text-[10px] font-medium uppercase tracking-wide text-gray-400">
                                                    Capacity
                                                </p>

                                                <p class="text-sm font-bold text-gray-800">
                                                    {{ number_format($package->guest_capacity) }}
                                                    guests
                                                </p>

                                            </div>

                                        </div>

                                    @endif


                                    {{-- Services --}}
                                    <div class="inline-flex items-center gap-2 rounded-xl bg-gray-50 px-3 py-2">

                                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white text-gray-500 shadow-sm">

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
                                                    d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a3 3 0 0 0 6 0M9 5h6"
                                                />
                                            </svg>

                                        </span>

                                        <div>

                                            <p class="text-[10px] font-medium uppercase tracking-wide text-gray-400">
                                                Services
                                            </p>

                                            <p class="text-sm font-bold text-gray-800">
                                                {{ $package->package_services_count ?? 0 }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- ====================================================
                                RIGHT: ACTIONS
                            ===================================================== --}}
                            <div class="flex shrink-0 items-center justify-between gap-2 border-t border-gray-100 pt-4 xl:border-l xl:border-t-0 xl:pl-5 xl:pt-0">

                                <a
                                    href="{{ route('vendors.packages.show', [
                                        'vendor' => $vendor,
                                        'package' => $package
                                    ]) }}"
                                    class="inline-flex h-10 items-center justify-center gap-2 rounded-xl border border-gray-200 px-3.5 text-sm font-semibold text-gray-600 transition hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900"
                                    title="View package"
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
                                            d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"
                                        />
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                            stroke-width="1.8"
                                        />
                                    </svg>

                                    <span class="hidden sm:inline">
                                        View
                                    </span>

                                </a>


                                <a
                                    href="{{ route('vendors.packages.edit', [
                                        'vendor' => $vendor,
                                        'package' => $package
                                    ]) }}"
                                    class="inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-[#FBEBEF] px-3.5 text-sm font-semibold text-[#D7385E] transition hover:bg-[#f8dce4]"
                                    title="Edit package"
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
                                            d="m16.862 4.487 1.687-1.687a2.25 2.25 0 1 1 3.182 3.182l-1.687 1.687M16.862 4.487 3.5 17.85l-1 4 4-1L19.544 7.669m-2.682-3.182 3.182 3.182"
                                        />
                                    </svg>

                                    <span class="hidden sm:inline">
                                        Edit
                                    </span>

                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('vendors.packages.destroy', [
                                        'vendor' => $vendor,
                                        'package' => $package
                                    ]) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this package? This action cannot be undone.');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-red-100 text-red-500 transition hover:bg-red-50 hover:text-red-600"
                                        title="Delete package"
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
                                                d="M6 7h12m-9 0V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2m-5 4v6m4-6v6m5-10v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7h14Z"
                                            />
                                        </svg>

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>


        {{-- ============================================================
            PAGINATION
        ============================================================= --}}
        @if($packages->hasPages())

            <div class="rounded-2xl border border-gray-200 bg-white px-5 py-4 shadow-sm">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <p class="text-xs text-gray-400">
                        Page
                        <span class="font-semibold text-gray-600">
                            {{ $packages->currentPage() }}
                        </span>
                        of
                        <span class="font-semibold text-gray-600">
                            {{ $packages->lastPage() }}
                        </span>
                    </p>

                    <div>
                        {{ $packages->withQueryString()->links() }}
                    </div>

                </div>

            </div>

        @endif


    @else

        {{-- ============================================================
            EMPTY STATE
        ============================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="px-6 py-20 text-center">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-[#FBEBEF] text-[#D7385E]">

                    <svg
                        class="h-9 w-9"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.6"
                            d="M20 7.5 12 3 4 7.5m16 0v9L12 21l-8-4.5v-9m16 0-8 4.5m-8-4.5 8 4.5m0 0V21"
                        />
                    </svg>

                </div>


                @if(request()->hasAny(['search', 'pricing_type', 'status']))

                    <h2 class="mt-6 text-xl font-bold text-gray-900">
                        No packages found
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        We couldn't find any packages matching your current filters.
                        Try adjusting your search or filter options.
                    </p>

                @else

                    <h2 class="mt-6 text-xl font-bold text-gray-900">
                        No packages yet
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        Create your first package and give customers an easy way
                        to discover your wedding services.
                    </p>

                @endif


                <div class="mt-7 flex flex-wrap justify-center gap-3">

                    @if(request()->hasAny(['search', 'pricing_type', 'status']))

                        <a
                            href="{{ route('vendors.packages.index', ['vendor' => $vendor]) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        >
                            Clear Filters
                        </a>

                    @endif

                    <a
                        href="{{ route('vendors.packages.create', ['vendor' => $vendor]) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#c52f53]"
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
                                d="M12 4v16m8-8H4"
                            />
                        </svg>

                        Create Package

                    </a>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection