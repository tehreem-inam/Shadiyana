@extends('layouts.app')

@section('title', 'Service Details')

@section('content')

<div class="mx-auto max-w-6xl">

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

            <a
                href="{{ route('services.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Catalog
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

            <span class="text-gray-500">
                Service Details
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
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 5a3 3 0 016 0v1H9V5z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12h6M9 16h4"
                        />
                    </svg>
                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                        Service Details
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        View service information, taxonomy and assigned vendors.
                    </p>

                </div>

            </div>


            {{-- Header Actions --}}
            <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">

                <a
                    href="{{ route('services.index') }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-900 sm:w-auto"
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
                            d="M19 12H5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 19l-7-7 7-7"
                        />
                    </svg>

                    Back

                </a>

                <a
                    href="{{ route('services.edit', $service->id) }}"
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
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                        />
                    </svg>

                    Edit Service

                </a>

            </div>

        </div>

    </div>


    {{-- ============================================================
        SERVICE HERO
    ============================================================= --}}

    <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr]">

            {{-- Image --}}
            <div class="relative h-64 bg-gray-100 lg:h-full lg:min-h-[280px]">

                @if($service->image)

                    <img
                        src="{{ asset('storage/' . $service->image) }}"
                        alt="{{ $service->name }}"
                        class="h-full w-full object-cover"
                    >

                @else

                    <div class="flex h-full min-h-[260px] items-center justify-center">

                        <div class="text-center">

                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]"
                            >
                                <svg
                                    class="h-8 w-8"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"
                                    />

                                    <circle
                                        cx="8.5"
                                        cy="8.5"
                                        r="1.5"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M4 16l5-5 3 3 2-2 6 6"
                                    />
                                </svg>
                            </div>

                            <p class="mt-3 text-sm font-semibold text-gray-400">
                                No image available
                            </p>

                        </div>

                    </div>

                @endif

            </div>


            {{-- Main Information --}}
            <div class="flex flex-col justify-center p-6 sm:p-8">

                <div class="flex flex-wrap items-center gap-2">

                    @if($service->status === 'active')

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-green-700"
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                            Active
                        </span>

                    @else

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-600"
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                            Inactive
                        </span>

                    @endif

                    @if($service->taxonomy)

                        <span
                            class="inline-flex items-center rounded-full bg-[#FBEBEF] px-3 py-1 text-xs font-bold text-[#D7385E]"
                        >
                            {{ $service->taxonomy->name }}
                        </span>

                    @endif

                </div>


                <h2 class="mt-4 text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                    {{ $service->name }}
                </h2>


                <p class="mt-2 text-sm text-gray-400">
                    /{{ $service->slug }}
                </p>


                @if($service->description)

                    <p class="mt-5 max-w-3xl text-sm leading-7 text-gray-600">
                        {{ $service->description }}
                    </p>

                @else

                    <p class="mt-5 text-sm italic text-gray-400">
                        No description has been provided for this service.
                    </p>

                @endif


                {{-- Quick Stats --}}
                <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3">

                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                        <p class="text-xs font-semibold text-gray-400">
                            Vendors
                        </p>

                        <p class="mt-1 text-xl font-extrabold text-gray-900">
                            {{ $service->vendors->count() }}
                        </p>

                    </div>


                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                        <p class="text-xs font-semibold text-gray-400">
                            Taxonomy
                        </p>

                        <p class="mt-1 truncate text-sm font-extrabold text-gray-900">
                            {{ $service->taxonomy?->name ?? 'Unassigned' }}
                        </p>

                    </div>


                    <div class="col-span-2 rounded-xl border border-gray-100 bg-gray-50 p-4 sm:col-span-1">

                        <p class="text-xs font-semibold text-gray-400">
                            Service ID
                        </p>

                        <p class="mt-1 text-xl font-extrabold text-gray-900">
                            #{{ $service->id }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        DETAILS + VENDORS
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- ========================================================
            SERVICE INFORMATION
        ========================================================= --}}

        <div class="lg:col-span-2">

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Card Header --}}
                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                    d="M13 16h-1v-4h-1m1-4h.01"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                    stroke-width="1.8"
                                />
                            </svg>
                        </div>

                        <div>

                            <h2 class="text-base font-bold text-gray-900">
                                Service Information
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Complete information about this service.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Details --}}
                <div class="divide-y divide-gray-100">

                    {{-- Name --}}
                    <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-3 sm:px-6">

                        <div class="text-xs font-bold uppercase tracking-wide text-gray-400">
                            Name
                        </div>

                        <div class="text-sm font-semibold text-gray-800 sm:col-span-2">
                            {{ $service->name }}
                        </div>

                    </div>


                    {{-- Slug --}}
                    <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-3 sm:px-6">

                        <div class="text-xs font-bold uppercase tracking-wide text-gray-400">
                            Slug
                        </div>

                        <div class="break-all font-mono text-sm text-gray-700 sm:col-span-2">
                            {{ $service->slug }}
                        </div>

                    </div>


                    {{-- Taxonomy --}}
                    <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-3 sm:px-6">

                        <div class="text-xs font-bold uppercase tracking-wide text-gray-400">
                            Taxonomy
                        </div>

                        <div class="sm:col-span-2">

                            @if($service->taxonomy)

                                <a
                                    href="{{ route('taxonomies.show', $service->taxonomy->id) }}"
                                    class="inline-flex items-center gap-2 text-sm font-bold text-[#D7385E] transition hover:text-[#c92f53]"
                                >
                                    {{ $service->taxonomy->name }}

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

                                </a>

                            @else

                                <span class="text-sm text-gray-400">
                                    No taxonomy assigned
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-3 sm:px-6">

                        <div class="text-xs font-bold uppercase tracking-wide text-gray-400">
                            Status
                        </div>

                        <div class="sm:col-span-2">

                            @if($service->status === 'active')

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-green-700"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Active
                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-600"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Created --}}
                    <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-3 sm:px-6">

                        <div class="text-xs font-bold uppercase tracking-wide text-gray-400">
                            Created
                        </div>

                        <div class="text-sm text-gray-700 sm:col-span-2">
                            {{ $service->created_at?->format('d M Y, h:i A') ?? '—' }}
                        </div>

                    </div>


                    {{-- Updated --}}
                    <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-3 sm:px-6">

                        <div class="text-xs font-bold uppercase tracking-wide text-gray-400">
                            Last Updated
                        </div>

                        <div class="text-sm text-gray-700 sm:col-span-2">
                            {{ $service->updated_at?->format('d M Y, h:i A') ?? '—' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                DESCRIPTION
            ===================================================== --}}

            <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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

                            <h2 class="text-base font-bold text-gray-900">
                                Description
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Service description and additional information.
                            </p>

                        </div>

                    </div>

                </div>


<div class="p-5 sm:p-6">

    @if($descriptionHtml)

        <div class="service-description text-sm leading-7 text-gray-600">

            {!! $descriptionHtml !!}

        </div>

    @else

        <div class="rounded-xl border border-dashed border-gray-200 bg-gray-50 px-5 py-8 text-center">

            <p class="text-sm font-semibold text-gray-400">
                No description available.
            </p>

        </div>

    @endif

</div>

            </div>

        </div>


        {{-- ========================================================
            VENDORS
        ========================================================= --}}

        <div>

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Card Header --}}
                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5">

                    <div class="flex items-center justify-between gap-3">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1M12 12a4 4 0 100-8 4 4 0 000 8z"
                                    />
                                </svg>
                            </div>

                            <div>

                                <h2 class="text-base font-bold text-gray-900">
                                    Vendors
                                </h2>

                                <p class="mt-0.5 text-xs text-gray-500">
                                    Assigned to this service.
                                </p>

                            </div>

                        </div>


                        <span
                            class="inline-flex h-8 min-w-8 items-center justify-center rounded-lg bg-[#FBEBEF] px-2 text-xs font-extrabold text-[#D7385E]"
                        >
                            {{ $service->vendors->count() }}
                        </span>

                    </div>

                </div>


                {{-- Vendor List --}}
                <div class="p-4">

                    @forelse($service->vendors as $vendor)

                        <div
                            class="flex items-center gap-3 rounded-xl border border-gray-100 p-3 transition hover:border-[#FBEBEF] hover:bg-[#FBEBEF]/30"
                        >

                            {{-- Vendor Avatar --}}
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]"
                            >

                                @if($vendor->logo_image)

                                    <img
                                        src="{{ asset('storage/' . $vendor->logo_image) }}"
                                        alt="{{ $vendor->business_name }}"
                                        class="h-full w-full object-cover"
                                    >

                                @else

                                    {{ strtoupper(substr($vendor->business_name ?? 'V', 0, 1)) }}

                                @endif

                            </div>


                            {{-- Vendor Information --}}
                            <div class="min-w-0 flex-1">

                                <p class="truncate text-sm font-bold text-gray-800">
                                    {{ $vendor->business_name ?? 'Unnamed Vendor' }}
                                </p>

                                @if($vendor->status)

                                    <p class="mt-0.5 text-xs text-gray-400">
                                        {{ ucfirst($vendor->status) }}
                                    </p>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="px-3 py-8 text-center">

                            <div
                                class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-400"
                            >
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
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1M12 12a4 4 0 100-8 4 4 0 000 8z"
                                    />
                                </svg>
                            </div>

                            <p class="mt-3 text-sm font-bold text-gray-500">
                                No vendors assigned
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                Vendors assigned to this service will appear here.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- ====================================================
                ACTION CARD
            ===================================================== --}}

            <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="p-5">

                    <p class="text-xs font-bold uppercase tracking-wide text-gray-400">
                        Service Actions
                    </p>


                    <div class="mt-4 space-y-2">

                        <a
                            href="{{ route('services.edit', $service->id) }}"
                            class="flex w-full items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 text-sm font-bold text-gray-700 transition hover:border-[#FBEBEF] hover:bg-[#FBEBEF]/50 hover:text-[#D7385E]"
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
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                />
                            </svg>

                            Edit Service

                        </a>


                        <form
                            action="{{ route('services.destroy', $service->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this service?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 rounded-xl border border-red-100 px-4 py-3 text-left text-sm font-bold text-red-600 transition hover:bg-red-50"
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
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10"
                                    />
                                </svg>

                                Delete Service

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection