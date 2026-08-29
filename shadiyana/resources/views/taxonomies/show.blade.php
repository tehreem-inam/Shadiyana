@extends('layouts.app')

@section('title', $taxonomy->name)

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

            <a
                href="{{ route('taxonomies.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Taxonomies
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
                {{ $taxonomy->name }}
            </span>

        </div>


        {{-- Header --}}
        <div class="mt-4 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div class="flex min-w-0 items-center gap-4">

               {{-- Taxonomy Icon / Image --}}
@if($taxonomy->image)

    <div class="h-14 w-14 shrink-0 overflow-hidden rounded-2xl border border-gray-200 bg-gray-50">

        <img
            src="{{ Storage::disk('public')->url($taxonomy->image) }}"
            alt="{{ $taxonomy->name }}"
            class="h-full w-full object-cover"
        >

    </div>

@else

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
                d="M4 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1V5z
                   M12 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1V5z
                   M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z
                   M12 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1v-6z"
            />
        </svg>

    </div>

@endif


                <div class="min-w-0">

                    <div class="flex flex-wrap items-center gap-2">

                        <h1 class="truncate text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                            {{ $taxonomy->name }}
                        </h1>


                        {{-- Status --}}
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

                    </div>


                    <p class="mt-1 text-sm text-gray-500">
                        Manage and view details for this taxonomy.
                    </p>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex flex-col gap-2 sm:flex-row">

                {{-- Back --}}
                <a
                    href="{{ route('taxonomies.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-800"
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
                            d="M15 18l-6-6 6-6"
                        />
                    </svg>

                    Back

                </a>


                {{-- Edit --}}
                <a
                    href="{{ route('taxonomies.edit', $taxonomy->id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30"
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

                    Edit Taxonomy

                </a>

            </div>

        </div>

    </div>


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

    <div class="mb-6 grid grid-cols-2 gap-4 lg:grid-cols-4">

        {{-- Children --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between gap-3">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Children
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $taxonomy->children->count() }}
                    </p>

                </div>

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
                            d="M6 4h12M6 10h8M6 16h12M6 22h8"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Services --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between gap-3">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Services
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $taxonomy->services->count() }}
                    </p>

                </div>

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

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
                            d="M9 6h11M9 12h11M9 18h11M4 6h.01M4 12h.01M4 18h.01"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Vendors --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between gap-3">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Vendors
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $taxonomy->vendors->count() }}
                    </p>

                </div>

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-5a4 4 0 11-8 0 4 4 0 018 0zm4 1a3 3 0 10-3-3"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Sort Order --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between gap-3">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Sort Order
                    </p>

                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">
                        {{ $taxonomy->sort_order ?? 0 }}
                    </p>

                </div>

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

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
                            d="M4 6h16M4 12h10M4 18h6"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        MAIN CONTENT
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- ========================================================
            LEFT / MAIN DETAILS
        ========================================================= --}}

        <div class="space-y-6 lg:col-span-2">


            {{-- Basic Information --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-4 sm:px-6">

                    <h2 class="text-base font-bold text-gray-900">
                        Basic Information
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500">
                        General information about this taxonomy.
                    </p>

                </div>


                <div class="p-5 sm:p-6">

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                        {{-- Name --}}
                        <div>

                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Name
                            </p>

                            <p class="mt-1.5 text-sm font-bold text-gray-900">
                                {{ $taxonomy->name }}
                            </p>

                        </div>


                        {{-- Slug --}}
                        <div>

                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Slug
                            </p>

                            <p class="mt-1.5 break-all text-sm font-semibold text-gray-700">
                                /{{ $taxonomy->slug }}
                            </p>

                        </div>


                        {{-- Type --}}
                        <div>

                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Type
                            </p>

                            <div class="mt-1.5">

                                @if($taxonomy->type)

                                    <span class="inline-flex items-center rounded-lg bg-[#FBEBEF] px-2.5 py-1 text-xs font-bold capitalize text-[#D7385E]">
{{ ucwords(str_replace(['-', '_'], ' ', $taxonomy->type->value)) }}                                    </span>

                                @else

                                    <span class="text-sm text-gray-400">
                                        —
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Status
                            </p>

                            <div class="mt-1.5">

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

                            </div>

                        </div>


                        {{-- Parent --}}
                        <div class="sm:col-span-2">

                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Parent Taxonomy
                            </p>

                            <div class="mt-2">

                                @if($taxonomy->parent)

                                    <a
                                        href="{{ route('taxonomies.show', $taxonomy->parent->id) }}"
                                        class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-bold text-gray-700 transition hover:border-[#D7385E]/20 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                    >

                                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white text-[#D7385E]">

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
                                                    d="M5 6h14M5 12h10M5 18h6"
                                                />
                                            </svg>

                                        </span>

                                        {{ $taxonomy->parent->name }}

                                    </a>

                                @else

                                    <span class="inline-flex items-center gap-2 rounded-xl bg-gray-50 px-3 py-2 text-sm font-semibold text-gray-500">

                                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white text-gray-400">

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
                                                    d="M5 12h14"
                                                />
                                            </svg>

                                        </span>

                                        Root Taxonomy

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Description --}}
                        <div class="sm:col-span-2">

                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Description
                            </p>

                            @if($taxonomy->description)

                                <div class="mt-2 rounded-xl bg-gray-50 p-4">

                                    <p class="whitespace-pre-line text-sm leading-6 text-gray-600">
                                        {{ $taxonomy->description }}
                                    </p>

                                </div>

                            @else

                                <p class="mt-2 text-sm italic text-gray-400">
                                    No description provided.
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- Child Taxonomies --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-4 sm:px-6">

                    <div class="flex items-center justify-between gap-3">

                        <div>

                            <h2 class="text-base font-bold text-gray-900">
                                Child Taxonomies
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Taxonomies directly under this parent.
                            </p>

                        </div>

                        <span class="inline-flex min-w-8 items-center justify-center rounded-lg bg-[#FBEBEF] px-2.5 py-1.5 text-xs font-bold text-[#D7385E]">
                            {{ $taxonomy->children->count() }}
                        </span>

                    </div>

                </div>


                @if($taxonomy->children->count())

                    <div class="divide-y divide-gray-100">

                        @foreach($taxonomy->children as $child)

                            <div class="flex items-center justify-between gap-4 px-5 py-4 transition hover:bg-gray-50/70 sm:px-6">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]">
                                        {{ strtoupper(substr($child->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('taxonomies.show', $child->id) }}"
                                            class="block truncate text-sm font-bold text-gray-900 transition hover:text-[#D7385E]"
                                        >
                                            {{ $child->name }}
                                        </a>

                                        <p class="mt-0.5 truncate text-xs text-gray-400">
                                            /{{ $child->slug }}
                                        </p>

                                    </div>

                                </div>


                                <div class="flex shrink-0 items-center gap-2">

                                    @if($child->status === 'active')

                                        <span class="hidden rounded-full bg-green-50 px-2.5 py-1 text-xs font-bold text-green-700 sm:inline-flex">
                                            Active
                                        </span>

                                    @else

                                        <span class="hidden rounded-full bg-gray-100 px-2.5 py-1 text-xs font-bold text-gray-500 sm:inline-flex">
                                            Inactive
                                        </span>

                                    @endif


                                    <a
                                        href="{{ route('taxonomies.show', $child->id) }}"
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

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-12 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-400">

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
                                    d="M5 12h14"
                                />
                            </svg>

                        </div>

                        <h3 class="mt-3 text-sm font-bold text-gray-900">
                            No child taxonomies
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            This taxonomy does not have any child taxonomies yet.
                        </p>

                    </div>

                @endif

            </div>


            {{-- Services --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-4 sm:px-6">

                    <div class="flex items-center justify-between gap-3">

                        <div>

                            <h2 class="text-base font-bold text-gray-900">
                                Services
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Services associated with this taxonomy.
                            </p>

                        </div>

                        <span class="inline-flex min-w-8 items-center justify-center rounded-lg bg-blue-50 px-2.5 py-1.5 text-xs font-bold text-blue-600">
                            {{ $taxonomy->services->count() }}
                        </span>

                    </div>

                </div>


                @if($taxonomy->services->count())

                    <div class="divide-y divide-gray-100">

                        @foreach($taxonomy->services as $service)

                            <div class="flex items-center gap-3 px-5 py-4 sm:px-6">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

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
                                            d="M9 6h11M9 12h11M9 18h11M4 6h.01M4 12h.01M4 18h.01"
                                        />
                                    </svg>

                                </div>

                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-sm font-bold text-gray-900">
                                        {{ $service->name ?? 'Service #' . $service->id }}
                                    </p>

                                    @if(isset($service->slug))

                                        <p class="mt-0.5 truncate text-xs text-gray-400">
                                            /{{ $service->slug }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-12 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-400">

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
                                    d="M9 6h11M9 12h11M9 18h11"
                                />
                            </svg>

                        </div>

                        <h3 class="mt-3 text-sm font-bold text-gray-900">
                            No services assigned
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            There are no services associated with this taxonomy.
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================
            RIGHT / SIDEBAR
        ========================================================= --}}

        <div class="space-y-6">


            {{-- Image --}}
            @if($taxonomy->image)

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-5 py-4">

                        <h2 class="text-base font-bold text-gray-900">
                            Taxonomy Image
                        </h2>

                    </div>

                    <div class="p-4">

                        <div class="overflow-hidden rounded-xl bg-gray-100">

                            <img
                                src="{{ asset($taxonomy->image) }}"
                                alt="{{ $taxonomy->name }}"
                                class="max-h-72 w-full object-cover"
                            >

                        </div>

                    </div>

                </div>

            @endif


            {{-- Taxonomy Details --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-4">

                    <h2 class="text-base font-bold text-gray-900">
                        Taxonomy Details
                    </h2>

                </div>


                <div class="divide-y divide-gray-100">


                    {{-- ID --}}
                    <div class="flex items-center justify-between gap-4 px-5 py-4">

                        <span class="text-xs font-semibold text-gray-500">
                            ID
                        </span>

                        <span class="text-sm font-bold text-gray-900">
                            #{{ $taxonomy->id }}
                        </span>

                    </div>


                    {{-- Type --}}
                    <div class="flex items-center justify-between gap-4 px-5 py-4">

                        <span class="text-xs font-semibold text-gray-500">
                            Type
                        </span>

                        <span class="text-sm font-bold capitalize text-gray-800">
                            {{ ucwords(str_replace(['-', '_'], ' ', $taxonomy->type->value)) }}
                        </span>

                    </div>


                    {{-- Parent --}}
                    <div class="flex items-center justify-between gap-4 px-5 py-4">

                        <span class="text-xs font-semibold text-gray-500">
                            Parent
                        </span>

                        <span class="max-w-[180px] truncate text-right text-sm font-bold text-gray-800">
                            {{ $taxonomy->parent?->name ?? 'Root' }}
                        </span>

                    </div>


                    {{-- Sort Order --}}
                    <div class="flex items-center justify-between gap-4 px-5 py-4">

                        <span class="text-xs font-semibold text-gray-500">
                            Sort Order
                        </span>

                        <span class="text-sm font-bold text-gray-800">
                            {{ $taxonomy->sort_order ?? 0 }}
                        </span>

                    </div>


                    {{-- Created --}}
                    <div class="flex items-center justify-between gap-4 px-5 py-4">

                        <span class="text-xs font-semibold text-gray-500">
                            Created
                        </span>

                        <span class="text-right text-sm font-semibold text-gray-700">
                            {{ $taxonomy->created_at?->format('M d, Y') ?? '—' }}
                        </span>

                    </div>


                    {{-- Updated --}}
                    <div class="flex items-center justify-between gap-4 px-5 py-4">

                        <span class="text-xs font-semibold text-gray-500">
                            Updated
                        </span>

                        <span class="text-right text-sm font-semibold text-gray-700">
                            {{ $taxonomy->updated_at?->format('M d, Y') ?? '—' }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- Vendors --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-4">

                    <div class="flex items-center justify-between">

                        <h2 class="text-base font-bold text-gray-900">
                            Vendors
                        </h2>

                        <span class="inline-flex min-w-8 items-center justify-center rounded-lg bg-purple-50 px-2.5 py-1.5 text-xs font-bold text-purple-600">
                            {{ $taxonomy->vendors->count() }}
                        </span>

                    </div>

                </div>


                @if($taxonomy->vendors->count())

                    <div class="divide-y divide-gray-100">

                        @foreach($taxonomy->vendors->take(5) as $vendor)

                            <div class="flex items-center gap-3 px-5 py-4">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-purple-50 text-xs font-extrabold text-purple-600">
                                    {{ strtoupper(substr($vendor->business_name ?? 'V', 0, 1)) }}
                                </div>

                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-sm font-bold text-gray-800">
                                        {{ $vendor->business_name ?? 'Vendor #' . $vendor->id }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    @if($taxonomy->vendors->count() > 5)

                        <div class="border-t border-gray-100 px-5 py-3">

                            <p class="text-center text-xs font-semibold text-gray-400">
                                Showing 5 of {{ $taxonomy->vendors->count() }} vendors
                            </p>

                        </div>

                    @endif

                @else

                    <div class="px-5 py-8 text-center">

                        <p class="text-sm text-gray-400">
                            No vendors assigned.
                        </p>

                    </div>

                @endif

            </div>


            {{-- Danger Zone --}}
            <div class="overflow-hidden rounded-2xl border border-red-200 bg-white shadow-sm">

                <div class="border-b border-red-100 bg-red-50/50 px-5 py-4">

                    <h2 class="text-base font-bold text-red-700">
                        Danger Zone
                    </h2>

                    <p class="mt-0.5 text-xs text-red-500">
                        Permanent actions for this taxonomy.
                    </p>

                </div>

                <div class="p-5">

                    @if($taxonomy->children->count() || $taxonomy->services->count())

                        <p class="text-xs leading-5 text-gray-500">
                            This taxonomy cannot be deleted while it has child taxonomies or assigned services.
                        </p>

                        <button
                            type="button"
                            disabled
                            class="mt-4 inline-flex w-full cursor-not-allowed items-center justify-center gap-2 rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-bold text-gray-400"
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

                            Delete Unavailable

                        </button>

                    @else

                        <p class="text-xs leading-5 text-gray-500">
                            Deleting this taxonomy is permanent and cannot be undone.
                        </p>

                        <button
                            type="button"
                            @click="$dispatch('confirm-delete', {
                                url: '{{ route('taxonomies.destroy', $taxonomy->id) }}',
                                name: '{{ addslashes($taxonomy->name) }}'
                            })"
                            class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/30"
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

                            Delete Taxonomy

                        </button>

                    @endif

                </div>

            </div>

        </div>

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

            {{-- Modal Content --}}
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