
@extends('layouts.app')

@section('title', $vendor->business_name)

@section('content')

<div class="min-h-screen bg-gray-50">

    {{-- ================================================================
        PAGE HEADER / BREADCRUMB
    ================================================================= --}}
    <div class="bg-white border-b border-gray-200">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    {{-- Breadcrumb --}}
                    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">

                        <a
                            href="{{ route('vendors.index') }}"
                            class="hover:text-[#D7385E] transition"
                        >
                            Vendors
                        </a>

                        <svg
                            class="w-4 h-4"
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

                        <span class="text-gray-700">
                            {{ $vendor->business_name }}
                        </span>

                    </nav>


                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                        {{ $vendor->business_name }}
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Vendor profile and business details
                    </p>

                </div>


                <div class="flex items-center gap-3">

                    {{-- Edit Vendor --}}
                    <a
                        href="{{ route('vendors.edit', $vendor) }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-[#D7385E] text-white text-sm font-semibold hover:bg-[#c52f52] transition shadow-sm"
                    >

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                            />
                        </svg>

                        Edit Vendor

                    </a>


                    {{-- Back --}}
                    <a
                        href="{{ route('vendors.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm font-semibold hover:bg-gray-50 transition"
                    >
                        Back
                    </a>

                </div>

            </div>

        </div>

    </div>

    {{-- ================================================================
        MAIN CONTENT
    ================================================================= --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- ========================================================
                LEFT COLUMN
            ========================================================= --}}
            <div class="lg:col-span-2 space-y-6">


                {{-- ====================================================
                    COVER / BUSINESS HERO
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                    {{-- Cover --}}
                    <div class="relative h-56 sm:h-72 bg-gradient-to-r from-[#D7385E] to-[#FBEBEF]">

                        @if($vendor->cover_image)

                            <img
                                src="{{ asset('storage/' . $vendor->cover_image) }}"
                                alt="{{ $vendor->business_name }}"
                                class="w-full h-full object-cover"
                            >

                        @else

                            <div class="w-full h-full flex items-center justify-center">

                                <div class="text-center">

                                    <div class="w-20 h-20 mx-auto rounded-2xl bg-white/80 flex items-center justify-center shadow-sm">

                                        <svg
                                            class="w-10 h-10 text-[#D7385E]"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M4 16l4-4a2 2 0 012.828 0L16 17m-2-2l1.172-1.172a2 2 0 012.828 0L20 16M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-3 text-sm font-medium text-gray-600">
                                        No cover image
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- Status --}}
                        <div class="absolute top-4 right-4">

                            @php

                                $statusClasses = match($vendor->status) {

                                    'active' =>
                                        'bg-green-100 text-green-700 border-green-200',

                                    'pending' =>
                                        'bg-yellow-100 text-yellow-700 border-yellow-200',

                                    'inactive' =>
                                        'bg-gray-100 text-gray-700 border-gray-200',

                                    'suspended' =>
                                        'bg-orange-100 text-orange-700 border-orange-200',

                                    'rejected' =>
                                        'bg-red-100 text-red-700 border-red-200',

                                    default =>
                                        'bg-gray-100 text-gray-700 border-gray-200',

                                };

                            @endphp

                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full border text-xs font-bold uppercase {{ $statusClasses }}"
                            >
                                {{ ucfirst($vendor->status) }}
                            </span>

                        </div>

                    </div>


                    {{-- Business Information --}}
                    <div class="px-5 sm:px-8 pb-7">

                        <div class="relative -mt-12 sm:-mt-14">

                            {{-- Logo --}}
                            <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl border-4 border-white bg-white shadow-lg overflow-hidden">

                                @if($vendor->logo_image)

                                    <img
                                        src="{{ asset('storage/' . $vendor->logo_image) }}"
                                        alt="{{ $vendor->business_name }}"
                                        class="w-full h-full object-cover"
                                    >

                                @else

                                    <div class="w-full h-full bg-[#FBEBEF] flex items-center justify-center">

                                        <span class="text-3xl sm:text-4xl font-bold text-[#D7385E]">
                                            {{ strtoupper(substr($vendor->business_name, 0, 1)) }}
                                        </span>

                                    </div>

                                @endif

                            </div>

                        </div>


                        <div class="mt-4 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                            <div>

                                <div class="flex flex-wrap items-center gap-2">

                                    <h2 class="text-2xl font-bold text-gray-900">
                                        {{ $vendor->business_name }}
                                    </h2>


                                    @if($vendor->is_verified)

                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">

                                            <svg
                                                class="w-4 h-4"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l3-3z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>

                                            Verified

                                        </span>

                                    @endif


                                    @if($vendor->is_featured)

                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-[#FBEBEF] text-[#D7385E] text-xs font-semibold">
                                            Featured
                                        </span>

                                    @endif


                                    @if($vendor->is_premium)

                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold">
                                            Premium
                                        </span>

                                    @endif

                                </div>


                                <p class="mt-1 text-sm text-gray-500">
                                    /{{ $vendor->slug }}
                                </p>

                            </div>


                            {{-- Rating --}}
                            <div class="flex items-center gap-3">

                                <div class="flex items-center gap-1">

                                    <svg
                                        class="w-5 h-5 text-yellow-400"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.036a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.802-2.036a1 1 0 00-1.176 0l-2.802 2.036c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.713 8.719c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                    </svg>

                                    <span class="font-bold text-gray-900">
                                        {{ number_format((float) $vendor->avg_rating, 2) }}
                                    </span>

                                </div>

                                <span class="text-sm text-gray-500">
                                    {{ $vendor->review_count }} reviews
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    DESCRIPTION
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-7">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center">

                            <svg
                                class="w-5 h-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h10"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-lg font-bold text-gray-900">
                                About Vendor
                            </h3>

                            <p class="text-sm text-gray-500">
                                Business description
                            </p>

                        </div>

                    </div>


                    @if($descriptionHtml)

                        <div class="prose prose-sm sm:prose max-w-none text-gray-700">
                            {!! $descriptionHtml !!}
                        </div>

                    @else

                        <div class="py-8 text-center text-gray-500">

                            <p class="text-sm">
                                No description has been added for this vendor.
                            </p>

                        </div>

                    @endif

                </div>


                {{-- ====================================================
                    CONTACT INFORMATION
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-7">

                    <div class="flex items-center gap-3 mb-6">

                        <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center">

                            <svg
                                class="w-5 h-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.129a11.042 11.042 0 005.516 5.516l1.129-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.611 21 3 14.389 3 6V5z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-lg font-bold text-gray-900">
                                Contact Information
                            </h3>

                            <p class="text-sm text-gray-500">
                                Vendor business contact details
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Phone --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Phone Number
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $vendor->phone_number ?: 'Not provided' }}
                            </p>

                        </div>


                        {{-- WhatsApp --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                WhatsApp
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $vendor->whatsapp_number ?: 'Not provided' }}
                            </p>

                        </div>


                        {{-- Email --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Business Email
                            </p>

                            @if($vendor->email)

                                <a
                                    href="mailto:{{ $vendor->email }}"
                                    class="mt-1 block text-sm font-medium text-[#D7385E] hover:underline break-all"
                                >
                                    {{ $vendor->email }}
                                </a>

                            @else

                                <p class="mt-1 text-sm font-medium text-gray-900">
                                    Not provided
                                </p>

                            @endif

                        </div>


                        {{-- Address --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Address
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $vendor->address ?: 'Not provided' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    TAXONOMIES
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-7">

                    {{-- Section Header --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-[#D7385E]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M7 7h.01M7 3h5l9 9a2 2 0 010 3l-6 6a2 2 0 01-3 0l-9-9V7a4 4 0 014-4z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <div class="flex items-center gap-2">

                                    <h3 class="text-lg font-bold text-gray-900">
                                        Taxonomies
                                    </h3>

                                    <span class="inline-flex min-w-6 items-center justify-center rounded-full bg-[#FBEBEF] px-2 py-0.5 text-xs font-bold text-[#D7385E]">
                                        {{ $vendor->taxonomies->count() }}
                                    </span>

                                </div>

                                <p class="text-sm text-gray-500">
                                    Categories and specialties assigned to this vendor
                                </p>

                            </div>

                        </div>


                        {{-- Taxonomy Actions --}}
                        <div class="flex items-center gap-2">

                            {{-- Assign Taxonomy --}}
                            <a
                                href="{{ route('vendors.taxonomies.create', ['vendor' => $vendor]) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#D7385E] px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52]"
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

                                Assign Taxonomy

                            </a>


                            {{-- Manage All --}}
                            @if($vendor->taxonomies->count())

                                <a
                                    href="{{ route('vendors.taxonomies.index', ['vendor' => $vendor]) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 hover:text-gray-900"
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
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                    </svg>

                                    Manage All

                                </a>

                            @endif

                        </div>

                    </div>


                    {{-- Assigned Taxonomies --}}
                    @if($vendor->taxonomies->count())

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                            @foreach($vendor->taxonomies as $taxonomy)

                                <div
                                    class="group flex items-center gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4 transition hover:border-[#FBEBEF] hover:bg-[#FBEBEF]/30"
                                >

                                    {{-- Icon --}}
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                                d="M7 7h.01M7 3h5l9 9a2 2 0 010 3l-6 6a2 2 0 01-3 0l-9-9V7a4 4 0 014-4z"
                                            />
                                        </svg>

                                    </div>


                                    {{-- Taxonomy Information --}}
                                    <div class="min-w-0 flex-1">

                                        <p class="truncate text-sm font-bold text-gray-900">
                                            {{ $taxonomy->name }}
                                        </p>

                                        @if($taxonomy->parent)

                                            <p class="mt-0.5 truncate text-xs text-gray-500">
                                                {{ $taxonomy->parent->name }}
                                            </p>

                                        @else

                                            <p class="mt-0.5 text-xs text-gray-400">
                                                Top-level taxonomy
                                            </p>

                                        @endif

                                    </div>


                                    {{-- Assigned Indicator --}}
                                    <span
                                        class="inline-flex shrink-0 items-center rounded-full bg-green-50 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-green-700"
                                    >
                                        Assigned
                                    </span>

                                </div>

                            @endforeach

                        </div>

                    @else

                        {{-- Empty State --}}
                        <div
                            class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-5 py-10 text-center"
                        >

                            <div
                                class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                        d="M7 7h.01M7 3h5l9 9a2 2 0 010 3l-6 6a2 2 0 01-3 0l-9-9V7a4 4 0 014-4z"
                                    />
                                </svg>

                            </div>

                            <h4 class="mt-4 text-sm font-bold text-gray-900">
                                No taxonomies assigned
                            </h4>

                            <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
                                Assign categories or specialties to help define what this vendor offers.
                            </p>

                            <a
                                href="{{ route('vendors.taxonomies.create', ['vendor' => $vendor]) }}"
                                class="mt-5 inline-flex items-center justify-center gap-2 rounded-lg bg-[#D7385E] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52]"
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

                                Assign First Taxonomy

                            </a>

                        </div>

                    @endif

                </div>


{{-- ====================================================
SERVICES
===================================================== --}}

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-7">


{{-- Section Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    {{-- Title --}}
    <div class="flex items-center gap-3">

        <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center">

            <svg
                class="w-5 h-5 text-[#D7385E]"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-.647-.052-1.282-.152-1.9z"
                />
            </svg>

        </div>

        <div>

            <div class="flex items-center gap-2">

                <h3 class="text-lg font-bold text-gray-900">
                    Services
                </h3>

                <span
                    class="inline-flex min-w-6 items-center justify-center rounded-full bg-[#FBEBEF] px-2 py-0.5 text-xs font-bold text-[#D7385E]"
                >
                    {{ $vendor->services->count() }}
                </span>

            </div>

            <p class="text-sm text-gray-500">
                Services offered by this vendor
            </p>

        </div>

    </div>


    {{-- Service Actions --}}
    <div class="flex flex-wrap items-center gap-2">

        {{-- Assign Services --}}
        <a
            href="{{ route('vendors.services.create', ['vendor' => $vendor]) }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#D7385E] px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52]"
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

            Assign Services

        </a>


        {{-- Manage All --}}
        @if($vendor->services->count())

            <a
                href="{{ route('vendors.services.index', ['vendor' => $vendor]) }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 hover:text-gray-900"
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
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                Manage All

            </a>

        @endif

    </div>

</div>


{{-- Assigned Services --}}
@if($vendor->services->count())

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

        @foreach($vendor->services as $service)

            <div
                class="group rounded-xl border border-gray-200 bg-gray-50 p-4 transition hover:border-[#FBEBEF] hover:bg-[#FBEBEF]/30"
            >

                <div class="flex items-start gap-3">

                    {{-- Service Icon --}}
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-.647-.052-1.282-.152-1.9z"
                            />
                        </svg>

                    </div>


                    {{-- Service Information --}}
                    <div class="min-w-0 flex-1">

                        <div class="flex items-start justify-between gap-3">

                            <div class="min-w-0">

                                <p class="truncate text-sm font-bold text-gray-900">
                                    {{ $service->pivot->custom_name ?: $service->name }}
                                </p>

                                {{-- Original Service Name --}}
                                @if($service->pivot->custom_name)

                                    <p class="mt-0.5 truncate text-xs text-gray-400">
                                        Original: {{ $service->name }}
                                    </p>

                                @endif

                            </div>


                            {{-- Status --}}
                            @if($service->pivot->status)

                                @php

                                    $serviceStatusClasses = match(
                                        $service->pivot->status
                                    ) {

                                        'active' =>
                                            'bg-green-50 text-green-700 border-green-200',

                                        'inactive' =>
                                            'bg-gray-100 text-gray-600 border-gray-200',

                                        default =>
                                            'bg-gray-100 text-gray-600 border-gray-200',

                                    };

                                @endphp

                                <span
                                    class="inline-flex shrink-0 items-center rounded-full border px-2 py-1 text-[10px] font-bold uppercase tracking-wide {{ $serviceStatusClasses }}"
                                >
                                    {{ ucfirst($service->pivot->status) }}
                                </span>

                            @endif

                        </div>


                        {{-- Taxonomy --}}
                        @if($service->taxonomy)

                            <div class="mt-2 flex items-center gap-1.5">

                                <svg
                                    class="h-3.5 w-3.5 shrink-0 text-[#D7385E]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M7 7h.01M7 3h5l9 9a2 2 0 010 3l-6 6a2 2 0 01-3 0l-9-9V7a4 4 0 014-4z"
                                    />
                                </svg>

                                <span class="truncate text-xs font-medium text-gray-500">
                                    {{ $service->taxonomy->name }}
                                </span>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- Vendor Description --}}
                @if($service->pivot->description)

                    <div class="mt-3 border-t border-gray-200 pt-3">

                        <p class="text-xs leading-relaxed text-gray-500">
                            {{ $service->pivot->description }}
                        </p>

                    </div>

                @elseif($service->description)

                    <div class="mt-3 border-t border-gray-200 pt-3">

                        <p class="text-xs leading-relaxed text-gray-500">
                            {{ $service->description }}
                        </p>

                    </div>

                @endif

            </div>

        @endforeach

    </div>

@else

    {{-- Empty State --}}
    <div
        class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-5 py-10 text-center"
    >

        <div
            class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-.647-.052-1.282-.152-1.9z"
                />
            </svg>

        </div>


        <h4 class="mt-4 text-sm font-bold text-gray-900">
            No services assigned
        </h4>


        <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
            Assign services related to the taxonomies assigned to this vendor.
        </p>


        <a
            href="{{ route('vendors.services.create', ['vendor' => $vendor]) }}"
            class="mt-5 inline-flex items-center justify-center gap-2 rounded-lg bg-[#D7385E] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52]"
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

            Assign First Services

        </a>

    </div>

@endif


</div>


{{-- ====================================================
    EVENT TYPES
===================================================== --}}
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-7">

    {{-- Section Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        {{-- Title --}}
        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center">

                <svg
                    class="w-5 h-5 text-[#D7385E]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                </svg>

            </div>

            <div>

                <div class="flex items-center gap-2">

                    <h3 class="text-lg font-bold text-gray-900">
                        Event Types
                    </h3>

                    <span
                        class="inline-flex min-w-6 items-center justify-center rounded-full bg-[#FBEBEF] px-2 py-0.5 text-xs font-bold text-[#D7385E]"
                    >
                        {{ $vendor->eventTypes->count() }}
                    </span>

                </div>

                <p class="text-sm text-gray-500">
                    Event types supported by this vendor
                </p>

            </div>

        </div>


        {{-- Event Type Actions --}}
        <div class="flex flex-wrap items-center gap-2">

            {{-- Assign Event Types --}}
            <a
                href="{{ route('vendors.event-types.create', ['vendor' => $vendor]) }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#D7385E] px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52]"
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

                Assign Event Types

            </a>


            {{-- Manage All --}}
            @if($vendor->eventTypes->count())

                <a
                    href="{{ route('vendors.event-types.index', ['vendor' => $vendor]) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 hover:text-gray-900"
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
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    Manage All

                </a>

            @endif

        </div>

    </div>


    {{-- Assigned Event Types --}}
    @if($vendor->eventTypes->count())

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

            @foreach($vendor->eventTypes as $eventType)

                <div
                    class="group flex items-center gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4 transition hover:border-[#FBEBEF] hover:bg-[#FBEBEF]/30"
                >

                    {{-- Event Type Image / Icon --}}
                    <div class="shrink-0">

                        @if($eventType->image)

                            <img
                                src="{{ asset('storage/' . $eventType->image) }}"
                                alt="{{ $eventType->name }}"
                                class="h-11 w-11 rounded-xl object-cover border border-gray-200"
                            >

                        @else

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
                                        d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>

                            </div>

                        @endif

                    </div>


                    {{-- Event Type Information --}}
                    <div class="min-w-0 flex-1">

                        <div class="flex items-start justify-between gap-3">

                            <div class="min-w-0">

                                <p class="truncate text-sm font-bold text-gray-900">
                                    {{ $eventType->name }}
                                </p>

                                @if($eventType->description)

                                    <p class="mt-1 line-clamp-2 text-xs leading-relaxed text-gray-500">
                                        {{ $eventType->description }}
                                    </p>

                                @else

                                    <p class="mt-1 text-xs text-gray-400">
                                        No description available
                                    </p>

                                @endif

                            </div>


                            {{-- Assigned Badge --}}
                            <span
                                class="inline-flex shrink-0 items-center rounded-full bg-green-50 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-green-700"
                            >
                                Assigned
                            </span>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- Empty State --}}
        <div
            class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-5 py-10 text-center"
        >

            <div
                class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                        d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 002 2v10a2 2 0 01-2 2H5z"
                    />
                </svg>

            </div>


            <h4 class="mt-4 text-sm font-bold text-gray-900">
                No event types assigned
            </h4>


            <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
                Assign event types to define the occasions and events this vendor can provide services for.
            </p>


            <a
                href="{{ route('vendors.event-types.create', ['vendor' => $vendor]) }}"
                class="mt-5 inline-flex items-center justify-center gap-2 rounded-lg bg-[#D7385E] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52]"
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

                Assign First Event Type

            </a>

        </div>

    @endif

</div>

{{-- ====================================================
    GALLERY
===================================================== --}}
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-7">

    {{-- ====================================================
        HEADER
    ===================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center shrink-0">
                <svg
                    class="w-5 h-5 text-[#D7385E]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M4 16l4-4a2 2 0 012.828 0L16 17m-2-2l1.172-1.172a2 2 0 012.828 0L20 16M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2v12a2 2 0 002 2z"
                    />
                </svg>
            </div>

            <div>

                <div class="flex items-center gap-2">

                    <h3 class="text-lg font-bold text-gray-900">
                        Gallery
                    </h3>

                    <span class="inline-flex items-center justify-center min-w-6 h-6 px-2 rounded-full bg-[#FBEBEF] text-[#D7385E] text-xs font-bold">
                        {{ $vendor->images->count() }}
                    </span>

                </div>

                <p class="text-sm text-gray-500">
                    Photos showcasing this vendor's work
                </p>

            </div>

        </div>


        {{-- Manage Gallery --}}
        <a
            href="{{ route('vendors.images.index', ['vendor' => $vendor->id]) }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-gray-200 bg-white text-sm font-semibold text-gray-700 transition hover:border-[#D7385E] hover:text-[#D7385E] hover:bg-[#FBEBEF]/40"
        >

            <svg
                class="w-4 h-4"
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

            Manage Gallery

        </a>

    </div>


    {{-- ====================================================
        IMAGES
    ===================================================== --}}
    @if($vendor->images->isNotEmpty())

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">

            @foreach($vendor->images->take(8) as $image)

                <div
                    class="group relative aspect-square overflow-hidden rounded-xl border border-gray-200 bg-gray-100"
                >

                    <img
                        src="{{ asset('storage/' . $image->image_url) }}"
                        alt="{{ $image->title ?: $vendor->business_name }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">

                        <div class="absolute bottom-0 left-0 right-0 p-3">

                            @if($image->title)

                                <p class="text-sm font-semibold text-white truncate">
                                    {{ $image->title }}
                                </p>

                            @endif

                            <a
                                href="{{ route('vendors.images.show', [
                                    'image' => $image->id,
                                    'vendor' => $vendor->id,
                                ]) }}"
                                class="inline-flex items-center gap-1.5 mt-1 text-xs font-semibold text-white hover:text-[#FBEBEF]"
                            >
                                View image

                                <svg
                                    class="w-3.5 h-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- ====================================================
            VIEW ALL
        ===================================================== --}}
        @if($vendor->images->count() > 8)

            <div class="flex justify-center mt-6">

                <a
                    href="{{ route('vendors.images.index', ['vendor' => $vendor->id]) }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-[#D7385E] hover:text-[#c52f52] transition"
                >

                    View all {{ $vendor->images->count() }} photos

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>

                </a>

            </div>

        @endif


    {{-- ====================================================
        EMPTY STATE
    ===================================================== --}}
    @else

        <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-6 py-10 text-center">

            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FBEBEF]">

                <svg
                    class="w-7 h-7 text-[#D7385E]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.6"
                        d="M4 16l4-4a2 2 0 012.828 0L16 17m-2-2l1.172-1.172a2 2 0 012.828 0L20 16M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                    />
                </svg>

            </div>

            <h4 class="mt-4 text-sm font-bold text-gray-900">
                No gallery images yet
            </h4>

            <p class="mt-1 text-sm text-gray-500">
                This vendor hasn't added any gallery photos yet.
            </p>

            <a
                href="{{ route('vendors.images.create', ['vendor' => $vendor->id]) }}"
                class="inline-flex items-center gap-2 mt-5 px-4 py-2.5 rounded-lg bg-[#D7385E] text-white text-sm font-semibold shadow-sm hover:bg-[#c52f52] transition"
            >

                <svg
                    class="w-4 h-4"
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

                Add First Image

            </a>

        </div>

    @endif

</div>

            </div>


            {{-- ========================================================
                RIGHT SIDEBAR
            ========================================================= --}}
            <div class="space-y-6">


                {{-- ====================================================
                    VENDOR OWNER
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center">

                            <svg
                                class="w-5 h-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-bold text-gray-900">
                                Vendor Owner
                            </h3>

                            <p class="text-xs text-gray-500">
                                Account information
                            </p>

                        </div>

                    </div>


                    @if($vendor->user)

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-full bg-[#FBEBEF] flex items-center justify-center flex-shrink-0">

                                <span class="font-bold text-[#D7385E]">
                                    {{ strtoupper(substr($vendor->user->first_name ?? 'U', 0, 1)) }}
                                </span>

                            </div>


                            <div class="min-w-0">

                                <p class="font-semibold text-gray-900 truncate">
                                    {{ $vendor->user->first_name }}
                                    {{ $vendor->user->last_name }}
                                </p>

                                <p class="text-sm text-gray-500 truncate">
                                    {{ $vendor->user->email ?: $vendor->user->phone_number }}
                                </p>

                            </div>

                        </div>


                        <div class="mt-5 pt-5 border-t border-gray-100 space-y-3">

                            <div class="flex items-center justify-between gap-3">

                                <span class="text-sm text-gray-500">
                                    Account Status
                                </span>

                                <span class="text-sm font-semibold text-gray-900">
                                    {{ ucfirst($vendor->user->status ?? 'N/A') }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between gap-3">

                                <span class="text-sm text-gray-500">
                                    Role
                                </span>

                                <span class="text-sm font-semibold text-gray-900">
                                    {{ ucfirst($vendor->user->role ?? 'Vendor') }}
                                </span>

                            </div>

                        </div>

                    @else

                        <p class="text-sm text-gray-500">
                            No owner account found.
                        </p>

                    @endif

                </div>


                {{-- ====================================================
                    LOCATION
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center">

                            <svg
                                class="w-5 h-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-bold text-gray-900">
                                Location
                            </h3>

                            <p class="text-xs text-gray-500">
                                Business location
                            </p>

                        </div>

                    </div>


                    @if($vendor->city)

                        <div class="space-y-3">

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    City
                                </p>

                                <p class="mt-1 text-sm font-semibold text-gray-900">
                                    {{ $vendor->city->name }}
                                </p>

                            </div>


                            @if($vendor->city->state)

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                        State
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-gray-900">
                                        {{ $vendor->city->state->name }}
                                    </p>

                                </div>

                            @endif


                            @if($vendor->address)

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                        Address
                                    </p>

                                    <p class="mt-1 text-sm text-gray-700 leading-relaxed">
                                        {{ $vendor->address }}
                                    </p>

                                </div>

                            @endif

                        </div>

                    @else

                        <p class="text-sm text-gray-500">
                            Location has not been provided.
                        </p>

                    @endif


                    @if($vendor->latitude && $vendor->longitude)

                        <div class="mt-5 pt-5 border-t border-gray-100">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Coordinates
                            </p>

                            <p class="mt-1 text-sm text-gray-700">
                                {{ $vendor->latitude }},
                                {{ $vendor->longitude }}
                            </p>

                        </div>

                    @endif

                </div>


                {{-- ====================================================
                    STATISTICS
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-10 h-10 rounded-xl bg-[#FBEBEF] flex items-center justify-center">

                            <svg
                                class="w-5 h-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-bold text-gray-900">
                                Statistics
                            </h3>

                            <p class="text-xs text-gray-500">
                                Vendor performance
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-2 gap-3">

                        {{-- Views --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs text-gray-500">
                                Views
                            </p>

                            <p class="mt-1 text-xl font-bold text-gray-900">
                                {{ number_format($vendor->view_count) }}
                            </p>

                        </div>


                        {{-- Reviews --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs text-gray-500">
                                Reviews
                            </p>

                            <p class="mt-1 text-xl font-bold text-gray-900">
                                {{ number_format($vendor->review_count) }}
                            </p>

                        </div>


                        {{-- Rating --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs text-gray-500">
                                Rating
                            </p>

                            <p class="mt-1 text-xl font-bold text-gray-900">
                                {{ number_format((float) $vendor->avg_rating, 2) }}
                            </p>

                        </div>


                        {{-- Verified --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs text-gray-500">
                                Verified
                            </p>

                            <p class="mt-1 text-xl font-bold text-gray-900">
                                {{ $vendor->is_verified ? 'Yes' : 'No' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    DATES
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                    <div class="space-y-4">

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Created
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $vendor->created_at?->format('d M Y, h:i A') }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Last Updated
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $vendor->updated_at?->format('d M Y, h:i A') }}
                            </p>

                        </div>


                        @if($vendor->is_verified && $vendor->verified_at)

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Verified At
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-900">
                                    {{ $vendor->verified_at->format('d M Y, h:i A') }}
                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- ====================================================
                    DELETE
                ===================================================== --}}
                <div class="bg-white rounded-2xl border border-red-200 shadow-sm p-5">

                    <div>

                        <h3 class="font-bold text-gray-900">
                            Danger Zone
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Permanently delete this vendor and its profile.
                        </p>

                    </div>


                    <form
                        action="{{ route('vendors.destroy', $vendor) }}"
                        method="POST"
                        class="mt-4"
                        onsubmit="return confirm('Are you sure you want to permanently delete this vendor? This action cannot be undone.');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition"
                        >

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                />
                            </svg>

                            Delete Vendor

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

