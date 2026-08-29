@extends('layouts.app')

@section('title', 'Services')

@section('content')

<div class="mx-auto max-w-7xl">

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
                Services
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                            d="M4 6h16M4 12h16M4 18h10"
                        />
                    </svg>
                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                        All Services
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        View and manage all services in your catalog.
                    </p>

                </div>

            </div>


            {{-- Add Service --}}
            <a
                href="{{ route('services.create') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md sm:w-auto"
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

                Add Service

            </a>

        </div>

    </div>

<!-- 
    {{-- ============================================================
        FLASH MESSAGES
    ============================================================= --}}

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
                            stroke-width="1.8"
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
        FILTERS
    ============================================================= --}}

    <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4 sm:px-6">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]">

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
                            d="M3 5h18M6 12h12M10 19h4"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="text-sm font-bold text-gray-900">
                        Filter Services
                    </h2>

                    <p class="text-xs text-gray-500">
                        Search and filter services by taxonomy or status.
                    </p>

                </div>

            </div>

        </div>


        <form
            method="GET"
            action="{{ route('services.index') }}"
            class="p-5 sm:p-6"
        >

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">


                {{-- Search --}}
                <div class="lg:col-span-2">

                    <label
                        for="search"
                        class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-500"
                    >
                        Search
                    </label>

                    <div class="relative">

                        <svg
                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M21 21l-4.35-4.35m2.35-5.15a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                            />
                        </svg>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search by name, slug or description..."
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 pl-11 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                    </div>

                </div>


                {{-- Taxonomy --}}
                <div>

                    <label
                        for="taxonomy_id"
                        class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-500"
                    >
                        Taxonomy
                    </label>

                    <select
                        id="taxonomy_id"
                        name="taxonomy_id"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                    >

                        <option value="">
                            All Taxonomies
                        </option>

                        @foreach($taxonomies as $taxonomy)

                            <option
                                value="{{ $taxonomy->id }}"
                                {{ (string) request('taxonomy_id') === (string) $taxonomy->id ? 'selected' : '' }}
                            >
                                {{ $taxonomy->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label
                        for="status"
                        class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-500"
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                    >

                        <option value="">
                            All Statuses
                        </option>

                        <option
                            value="active"
                            {{ request('status') === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            {{ request('status') === 'inactive' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            {{-- Filter Actions --}}
            <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('services.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
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

                    Clear

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53]"
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
                            d="M3 5h18M6 12h12M10 19h4"
                        />
                    </svg>

                    Filter

                </button>

            </div>

        </form>

    </div>


    {{-- ============================================================
        SERVICES TABLE
    ============================================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="border-b border-gray-100 bg-white px-5 py-4 sm:px-6">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-base font-bold text-gray-900">
                        All Services
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500">
                        Showing
                        <span class="font-semibold text-gray-700">
                            {{ $services->firstItem() ?? 0 }}
                        </span>
                        to
                        <span class="font-semibold text-gray-700">
                            {{ $services->lastItem() ?? 0 }}
                        </span>
                        of
                        <span class="font-semibold text-gray-700">
                            {{ $services->total() }}
                        </span>
                        services
                    </p>

                </div>

                @if(request()->hasAny(['search', 'taxonomy_id', 'status']))

                    <span class="inline-flex w-fit items-center rounded-full bg-[#FBEBEF] px-3 py-1 text-xs font-bold text-[#D7385E]">
                        Filters Applied
                    </span>

                @endif

            </div>

        </div>


        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto md:block">

            <table class="min-w-full">

                <thead>

                    <tr class="border-b border-gray-100 bg-gray-50/70">

                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            Service
                        </th>

                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            Taxonomy
                        </th>

                        <th class="px-6 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            Slug
                        </th>

                        <th class="px-6 py-3 text-center text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            Vendors
                        </th>

                        <th class="px-6 py-3 text-center text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            Status
                        </th>

                        <th class="px-6 py-3 text-right text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($services as $service)

                        <tr class="group transition hover:bg-gray-50/70">

                            {{-- Service --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    {{-- Image --}}
                                    <div class="h-11 w-11 shrink-0 overflow-hidden rounded-xl border border-gray-100 bg-[#FBEBEF]">

                                        @if($service->image)

                                            <img
                                                src="{{ asset('storage/' . $service->image) }}"
                                                alt="{{ $service->name }}"
                                                class="h-full w-full object-cover"
                                            >

                                        @else

                                            <div class="flex h-full w-full items-center justify-center text-[#D7385E]">

                                                <svg
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.7"
                                                        d="M4 16l4.5-4.5a2 2 0 012.83 0L15 15l2-2a2 2 0 012.83 0L21 14.17M4 19h16a1 1 0 001-1V6a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1z"
                                                    />
                                                    <circle
                                                        cx="8.5"
                                                        cy="8.5"
                                                        r="1.5"
                                                        stroke-width="1.5"
                                                    />
                                                </svg>

                                            </div>

                                        @endif

                                    </div>


                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('services.show', $service) }}"
                                            class="block truncate text-sm font-bold text-gray-900 transition hover:text-[#D7385E]"
                                        >
                                            {{ $service->name }}
                                        </a>

                                        @if($service->description)

                                            <p class="mt-0.5 max-w-xs truncate text-xs text-gray-400">
                                                {{ $service->description }}
                                            </p>

                                        @else

                                            <p class="mt-0.5 text-xs text-gray-400">
                                                No description
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Taxonomy --}}
                            <td class="px-6 py-4">

                                @if($service->taxonomy)

                                    <span class="inline-flex items-center rounded-lg bg-[#FBEBEF] px-2.5 py-1 text-xs font-semibold text-[#D7385E]">
                                        {{ $service->taxonomy->name }}
                                    </span>

                                @else

                                    <span class="text-xs text-gray-400">
                                        No taxonomy
                                    </span>

                                @endif

                            </td>


                            {{-- Slug --}}
                            <td class="px-6 py-4">

                                <code class="rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">
                                    {{ $service->slug }}
                                </code>

                            </td>


                            {{-- Vendors --}}
                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex min-w-8 items-center justify-center rounded-lg bg-gray-100 px-2 py-1 text-xs font-bold text-gray-600">
                                    {{ $service->vendors_count }}
                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">

                                @if($service->status === 'active')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-bold text-green-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-bold text-gray-600">

                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-1">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('services.show', $service) }}"
                                        title="View Service"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                    >

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
                                                d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                                stroke-width="1.8"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('services.edit', $service) }}"
                                        title="Edit Service"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-blue-50 hover:text-blue-600"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M12 20h9"
                                            />

                                            <path
                                                stroke="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('services.destroy', $service) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this service?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete Service"
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

                                    </form>

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

                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

                                        <svg
                                            class="h-7 w-7"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.6"
                                                d="M4 6h16M4 12h16M4 18h10"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 text-sm font-bold text-gray-900">
                                        No services found
                                    </h3>

                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        There are no services matching your current filters.
                                    </p>

                                    <a
                                        href="{{ route('services.create') }}"
                                        class="mt-4 inline-flex items-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-xs font-bold text-white transition hover:bg-[#c92f53]"
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

                                        Add First Service
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

            @forelse($services as $service)

                <div class="p-4">

                    <div class="flex items-start gap-3">

                        {{-- Image --}}
                        <div class="h-12 w-12 shrink-0 overflow-hidden rounded-xl border border-gray-100 bg-[#FBEBEF]">

                            @if($service->image)

                                <img
                                    src="{{ asset('storage/' . $service->image) }}"
                                    alt="{{ $service->name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                <div class="flex h-full w-full items-center justify-center text-[#D7385E]">

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.7"
                                            d="M4 16l4.5-4.5a2 2 0 012.83 0L15 15l2-2a2 2 0 012.83 0L21 14.17M4 19h16a1 1 0 001-1V6a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1z"
                                        />
                                        <circle
                                            cx="8.5"
                                            cy="8.5"
                                            r="1.5"
                                            stroke-width="1.5"
                                        />
                                    </svg>

                                </div>

                            @endif

                        </div>


                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-3">

                                <div class="min-w-0">

                                    <a
                                        href="{{ route('services.show', $service) }}"
                                        class="block truncate text-sm font-bold text-gray-900 hover:text-[#D7385E]"
                                    >
                                        {{ $service->name }}
                                    </a>

                                    <p class="mt-0.5 truncate text-xs text-gray-400">
                                        /{{ $service->slug }}
                                    </p>

                                </div>


                                @if($service->status === 'active')

                                    <span class="shrink-0 inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2 py-1 text-[10px] font-bold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Active
                                    </span>

                                @else

                                    <span class="shrink-0 inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2 py-1 text-[10px] font-bold text-gray-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                        Inactive
                                    </span>

                                @endif

                            </div>


                            <div class="mt-3 flex flex-wrap items-center gap-2">

                                @if($service->taxonomy)

                                    <span class="inline-flex items-center rounded-lg bg-[#FBEBEF] px-2 py-1 text-[10px] font-bold text-[#D7385E]">
                                        {{ $service->taxonomy->name }}
                                    </span>

                                @endif

                                <span class="inline-flex items-center rounded-lg bg-gray-100 px-2 py-1 text-[10px] font-bold text-gray-600">
                                    {{ $service->vendors_count }}
                                    {{ $service->vendors_count == 1 ? 'Vendor' : 'Vendors' }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Mobile Actions --}}
                    <div class="mt-4 flex items-center justify-end gap-2 border-t border-gray-100 pt-3">

                        <a
                            href="{{ route('services.show', $service) }}"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 px-3 py-2 text-xs font-bold text-gray-600 transition hover:bg-gray-50"
                        >
                            View
                        </a>

                        <a
                            href="{{ route('services.edit', $service) }}"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-xs font-bold text-blue-600 transition hover:bg-blue-100"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('services.destroy', $service) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Are you sure you want to delete this service?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="px-5 py-14 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="M4 6h16M4 12h16M4 18h10"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 text-sm font-bold text-gray-900">
                        No services found
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Try changing your filters or create a new service.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- ========================================================
            PAGINATION
        ========================================================= --}}

        @if($services->hasPages())

            <div class="border-t border-gray-100 px-5 py-4 sm:px-6">

                {{ $services->links() }}

            </div>

        @endif

    </div>

</div>

@endsection