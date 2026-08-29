@extends('layouts.app')

@section('title', 'Taxonomies')

@section('content')

<div
    x-data="{
        search: @js(request('search', '')),
        type: @js(request('type', '')),
        status: @js(request('status', '')),
        parent: @js(request('parent_id', ''))
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
                Catalog
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
                Taxonomies
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    {{-- Icon --}}
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
                                d="M4 6h16M4 12h16M4 18h16"
                            />

                            <circle
                                cx="7"
                                cy="6"
                                r="1.5"
                                fill="currentColor"
                                stroke="none"
                            />

                            <circle
                                cx="7"
                                cy="12"
                                r="1.5"
                                fill="currentColor"
                                stroke="none"
                            />

                            <circle
                                cx="7"
                                cy="18"
                                r="1.5"
                                fill="currentColor"
                                stroke="none"
                            />
                        </svg>

                    </div>

                    <div>

                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                            Taxonomies
                        </h1>

                        <p class="mt-0.5 text-sm text-gray-500">
                            Organize categories, services, and vendor classifications.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Add Taxonomy --}}
            <a
                href="{{ route('taxonomies.create') }}"
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

                Add Taxonomy

            </a>

        </div>

    </div>


    {{-- ============================================================
        FLASH MESSAGES
    ============================================================= --}}
<!-- 
    @if(session('success'))

        <div
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

        </div>

    @endif


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

    @endif -->


    {{-- ============================================================
        STATISTICS
    ============================================================= --}}

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Total --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Total Taxonomies
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $taxonomies->total() }}
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
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <circle
                            cx="7"
                            cy="6"
                            r="1.5"
                            fill="currentColor"
                            stroke="none"
                        />

                        <circle
                            cx="7"
                            cy="12"
                            r="1.5"
                            fill="currentColor"
                            stroke="none"
                        />

                        <circle
                            cx="7"
                            cy="18"
                            r="1.5"
                            fill="currentColor"
                            stroke="none"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Root Taxonomies --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Root Categories
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $taxonomies->whereNull('parent_id')->count() }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

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
                            d="M12 5v14M5 12h14"
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
                        {{ $taxonomies->where('status', 'active')->count() }}
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
                        {{ $taxonomies->where('status', 'inactive')->count() }}
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
                            stroke-width="1.8"
                            d="M18 6L6 18M6 6l12 12"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        TAXONOMIES TABLE CARD
    ============================================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Card Header --}}
{{-- ========================================================
    TAXONOMIES TABLE CARD
========================================================= --}}

<div >

    {{-- Card Header --}}
    <div class="border-b border-gray-100 p-5 sm:p-6">

        <div class="flex flex-col gap-5">

            {{-- Header Content --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="min-w-0">

                    <h2 class="text-base font-bold text-gray-900">
                        All Taxonomies
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        View and manage your taxonomy structure.
                    </p>

                </div>

                {{-- Optional total count --}}
                <div class="inline-flex w-fit items-center gap-2 rounded-lg bg-gray-50 px-3 py-2">

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
                            d="M4 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1V5z
                               M12 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1V5z
                               M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z
                               M12 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1v-6z"
                        />
                    </svg>

                    <span class="text-xs font-semibold text-gray-500">
                        {{ $taxonomies->total() }}
                        {{ $taxonomies->total() === 1 ? 'Taxonomy' : 'Taxonomies' }}
                    </span>

                </div>

            </div>


            {{-- ====================================================
                FILTERS
            ===================================================== --}}

            <form
                method="GET"
                action="{{ route('taxonomies.index') }}"
                class="w-full"
            >

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">

                    {{-- Search --}}
                    <div class="relative lg:col-span-2">

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
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search taxonomies..."
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 pl-10 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                    </div>


                    {{-- Type --}}
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
                                d="M4 6h16M4 12h16M4 18h10"
                            />
                        </svg>

                        <select
                            name="type"
                            class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 pl-10 pr-10 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                            <option value="">
                                All Types
                            </option>

                         @foreach($types as $type)
    <option value="{{ $type->value }}">
        {{ Str::headline($type->value) }}
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


                    {{-- Parent --}}
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
                                d="M5 6h14M5 12h10M5 18h6"
                            />
                        </svg>

                        <select
                            name="parent_id"
                            class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 pl-10 pr-10 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                            <option value="">
                                All Parents
                            </option>

                            <option
                                value="root"
                                @selected(request('parent_id') === 'root')
                            >
                                Root Taxonomies
                            </option>

                            @foreach($parents as $parent)

                                <option
                                    value="{{ $parent->id }}"
                                    @selected((string) request('parent_id') === (string) $parent->id)
                                >
                                    {{ $parent->name }}
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


                    {{-- Status --}}
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
                                d="M12 3v18M3 12h18"
                            />
                        </svg>

                        <select
                            name="status"
                            class="h-11 w-full appearance-none rounded-xl border border-gray-200 bg-gray-50 pl-10 pr-10 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                            <option value="">
                                All Status
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

                </div>


                {{-- Filter Actions --}}
                <div class="mt-3 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-end">

                    <button
                        type="submit"
                        class="inline-flex h-11 w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 sm:w-auto"
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
                                d="M3 5h18M6 12h12M10 19h4"
                            />
                        </svg>

                        Filter

                    </button>


                    {{-- Clear Filters --}}
                    @if(
                        request()->filled('search') ||
                        request()->filled('type') ||
                        request()->filled('parent_id') ||
                        request()->filled('status')
                    )

                        <a
                            href="{{ route('taxonomies.index') }}"
                            class="inline-flex h-11 w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-600 transition hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 sm:w-auto"
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
                                    d="M6 6l12 12M18 6L6 18"
                                />
                            </svg>

                            Clear

                        </a>

                    @endif

                </div>

            </form>

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
                            Taxonomy
                        </th>

                        <th class="px-6 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Parent
                        </th>

                        <th class="px-6 py-3.5 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Type
                        </th>

                        <th class="px-6 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Children
                        </th>

                        <th class="px-6 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Services
                        </th>

                        <th class="px-6 py-3.5 text-center text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            Vendors
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

                    @forelse($taxonomies as $taxonomy)

                        <tr class="transition hover:bg-gray-50/70">

                            {{-- Taxonomy --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center gap-3">

                                    {{-- Image --}}
                                    @if($taxonomy->image)

                                        <img
                                            src="{{ asset('storage/' . $taxonomy->image) }}"
                                            alt="{{ $taxonomy->name }}"
                                            class="h-10 w-10 shrink-0 rounded-xl object-cover ring-1 ring-gray-100"
                                        >

                                    @else

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]">
                                            {{ strtoupper(substr($taxonomy->name, 0, 1)) }}
                                        </div>

                                    @endif


                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('taxonomies.show', $taxonomy->id) }}"
                                            class="block truncate text-sm font-bold text-gray-900 transition hover:text-[#D7385E]"
                                        >
                                            {{ $taxonomy->name }}
                                        </a>

                                        <p class="mt-0.5 max-w-[220px] truncate text-xs text-gray-400">
                                            /{{ $taxonomy->slug }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Parent --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if($taxonomy->parent)

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
                                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"
                                                />
                                            </svg>

                                        </span>

                                        <span class="text-sm font-semibold text-gray-700">
                                            {{ $taxonomy->parent->name }}
                                        </span>

                                    </div>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                                        Root

                                    </span>

                                @endif

                            </td>


                            {{-- Type --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <span class="inline-flex items-center rounded-lg bg-gray-100 px-2.5 py-1.5 text-xs font-bold text-gray-600">
{{ ucwords(str_replace(['-', '_'], ' ', $taxonomy->type->value)) }}                                </span>

                            </td>


                            {{-- Children --}}
                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex min-w-9 items-center justify-center rounded-lg bg-gray-100 px-2.5 py-1.5 text-xs font-bold text-gray-600">
                                    {{ $taxonomy->children_count ?? 0 }}
                                </span>

                            </td>


                            {{-- Services --}}
                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex min-w-9 items-center justify-center rounded-lg bg-gray-100 px-2.5 py-1.5 text-xs font-bold text-gray-600">
                                    {{ $taxonomy->services_count ?? 0 }}
                                </span>

                            </td>


                            {{-- Vendors --}}
                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex min-w-9 items-center justify-center rounded-lg bg-gray-100 px-2.5 py-1.5 text-xs font-bold text-gray-600">
                                    {{ $taxonomy->vendors_count ?? 0 }}
                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if($taxonomy->status === 'active')

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
                                        href="{{ route('taxonomies.show', $taxonomy->id) }}"
                                        title="View Taxonomy"
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
                                        href="{{ route('taxonomies.edit', $taxonomy->id) }}"
                                        title="Edit Taxonomy"
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
                                        title="Delete Taxonomy"
                                        @click="$dispatch('confirm-delete', {
                                            url: '{{ route('taxonomies.destroy', $taxonomy->id) }}',
                                            name: '{{ addslashes($taxonomy->name) }}'
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
                                colspan="8"
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
                                                d="M4 6h16M4 12h16M4 18h16"
                                            />

                                            <circle
                                                cx="7"
                                                cy="6"
                                                r="1.5"
                                                fill="currentColor"
                                                stroke="none"
                                            />

                                            <circle
                                                cx="7"
                                                cy="12"
                                                r="1.5"
                                                fill="currentColor"
                                                stroke="none"
                                            />

                                            <circle
                                                cx="7"
                                                cy="18"
                                                r="1.5"
                                                fill="currentColor"
                                                stroke="none"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 text-base font-bold text-gray-900">
                                        No taxonomies found
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Start by creating your first taxonomy.
                                    </p>

                                    <a
                                        href="{{ route('taxonomies.create') }}"
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

                                        Add Taxonomy

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

            @forelse($taxonomies as $taxonomy)

                <div class="p-5 transition hover:bg-gray-50/70">

                    <div class="flex items-start gap-3">

                        {{-- Image --}}
                        @if($taxonomy->image)

                            <img
                                src="{{ asset('storage/' . $taxonomy->image) }}"
                                alt="{{ $taxonomy->name }}"
                                class="h-11 w-11 shrink-0 rounded-xl object-cover ring-1 ring-gray-100"
                            >

                        @else

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]">
                                {{ strtoupper(substr($taxonomy->name, 0, 1)) }}
                            </div>

                        @endif


                        {{-- Main Content --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-3">

                                <div class="min-w-0">

                                    <a
                                        href="{{ route('taxonomies.show', $taxonomy->id) }}"
                                        class="block truncate text-sm font-bold text-gray-900 hover:text-[#D7385E]"
                                    >
                                        {{ $taxonomy->name }}
                                    </a>

                                    <p class="mt-0.5 truncate text-xs text-gray-400">
                                        /{{ $taxonomy->slug }}
                                    </p>

                                </div>


                                {{-- Status --}}
                                @if($taxonomy->status === 'active')

                                    <span class="shrink-0 rounded-full bg-green-50 px-2 py-1 text-[10px] font-bold text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="shrink-0 rounded-full bg-gray-100 px-2 py-1 text-[10px] font-bold text-gray-500">
                                        Inactive
                                    </span>

                                @endif

                            </div>


                            {{-- Parent --}}
                            <div class="mt-3">

                                @if($taxonomy->parent)

                                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-500">

                                        <svg
                                            class="h-3.5 w-3.5 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"
                                            />
                                        </svg>

                                        Parent:
                                        <span class="font-semibold text-gray-700">
                                            {{ $taxonomy->parent->name }}
                                        </span>

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 text-xs text-blue-600">

                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                                        Root Taxonomy

                                    </span>

                                @endif

                            </div>


                            {{-- Type --}}
                            <div class="mt-2">

                                <span class="inline-flex items-center rounded-lg bg-gray-100 px-2.5 py-1 text-[11px] font-bold text-gray-600">

{{ ucwords(str_replace(['-', '_'], ' ', $taxonomy->type->value)) }}
                                </span>

                            </div>


                            {{-- Counts --}}
                            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-gray-500">

                                <span class="inline-flex items-center gap-1.5">

                                    <svg
                                        class="h-3.5 w-3.5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                    </svg>

                                    {{ $taxonomy->children_count ?? 0 }}
                                    {{ ($taxonomy->children_count ?? 0) === 1 ? 'Child' : 'Children' }}

                                </span>


                                <span class="inline-flex items-center gap-1.5">

                                    <svg
                                        class="h-3.5 w-3.5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                    </svg>

                                    {{ $taxonomy->services_count ?? 0 }}
                                    {{ ($taxonomy->services_count ?? 0) === 1 ? 'Service' : 'Services' }}

                                </span>


                                <span class="inline-flex items-center gap-1.5">

                                    <svg
                                        class="h-3.5 w-3.5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-5a4 4 0 11-8 0 4 4 0 018 0zm4 1a3 3 0 10-3-3"
                                        />
                                    </svg>

                                    {{ $taxonomy->vendors_count ?? 0 }}
                                    {{ ($taxonomy->vendors_count ?? 0) === 1 ? 'Vendor' : 'Vendors' }}

                                </span>

                            </div>


                            {{-- Actions --}}
                            <div class="mt-4 flex flex-wrap items-center gap-2">

                                {{-- View --}}
                                <a
                                    href="{{ route('taxonomies.show', $taxonomy->id) }}"
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
                                    href="{{ route('taxonomies.edit', $taxonomy->id) }}"
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
                                        url: '{{ route('taxonomies.destroy', $taxonomy->id) }}',
                                        name: '{{ addslashes($taxonomy->name) }}'
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
                                    d="M4 6h16M4 12h16M4 18h16"
                                />

                                <circle
                                    cx="7"
                                    cy="6"
                                    r="1.5"
                                    fill="currentColor"
                                    stroke="none"
                                />

                                <circle
                                    cx="7"
                                    cy="12"
                                    r="1.5"
                                    fill="currentColor"
                                    stroke="none"
                                />

                                <circle
                                    cx="7"
                                    cy="18"
                                    r="1.5"
                                    fill="currentColor"
                                    stroke="none"
                                />
                            </svg>

                        </div>

                        <h3 class="mt-4 text-base font-bold text-gray-900">
                            No taxonomies found
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Start by creating your first taxonomy.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- ========================================================
            PAGINATION
        ========================================================= --}}

        @if($taxonomies->hasPages())

            <div class="border-t border-gray-100 px-5 py-4 sm:px-6">

                {{ $taxonomies->links() }}

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
            taxonomyName: ''
        }"
        x-on:confirm-delete.window="
            open = true;
            deleteUrl = $event.detail.url;
            taxonomyName = $event.detail.name;
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
                    Delete Taxonomy?
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">

                    Are you sure you want to delete

                    <span
                        class="font-bold text-gray-800"
                        x-text="taxonomyName"
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
                        Delete Taxonomy
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection