@extends('layouts.app')

@section('title', 'Event Types')

@section('content')

<div
    x-data="{
        deleteModal: false,
        deleteUrl: '',
        deleteName: '',

        openDeleteModal(url, name) {
            this.deleteUrl = url;
            this.deleteName = name;
            this.deleteModal = true;
        },

        closeDeleteModal() {
            this.deleteModal = false;
            this.deleteUrl = '';
            this.deleteName = '';
        }
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
                Event Types
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
                            d="M8 3v4M16 3v4M4 9h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8 13h2M14 13h2M8 17h2"
                        />
                    </svg>

                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                        Event Types
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Manage the different types of events available on Shadiyana.
                    </p>

                </div>

            </div>


            {{-- Add Event Type --}}
            <a
                href="{{ route('event-types.create') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 sm:w-auto"
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

                Add Event Type

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

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-600"
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
                            class="h-5 w-5"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
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

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600"
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

        <form
            action="{{ route('event-types.index') }}"
            method="GET"
            class="p-4 sm:p-5"
        >

            <div class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_180px_auto]">

                {{-- Search --}}
                <div>

                    <label
                        for="search"
                        class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-500"
                    >
                        Search
                    </label>

                    <div class="relative">

                        <div
                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"
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
                                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>

                        </div>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search event types..."
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 pl-11 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                    </div>

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


                {{-- Actions --}}
                <div class="flex items-end gap-2">

                    <button
                        type="submit"
                        class="inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-xl bg-gray-900 px-5 text-sm font-bold text-white transition hover:bg-gray-800 md:flex-none"
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
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>

                        Filter

                    </button>

                    @if(request()->hasAny(['search', 'status']))

                        <a
                            href="{{ route('event-types.index') }}"
                            class="inline-flex h-11 items-center justify-center rounded-xl border border-gray-200 bg-white px-4 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
                        >
                            Clear
                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>


    {{-- ============================================================
        EVENT TYPES TABLE
    ============================================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="flex flex-col gap-2 border-b border-gray-100 bg-gray-50/50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <div>

                <h2 class="text-sm font-extrabold text-gray-900">
                    All Event Types
                </h2>

                <p class="mt-0.5 text-xs text-gray-500">
                    {{ $eventTypes->total() }}
                    {{ Str::plural('event type', $eventTypes->total()) }}
                    found.
                </p>

            </div>

        </div>


        @if($eventTypes->count())

            {{-- ====================================================
                DESKTOP TABLE
            ===================================================== --}}

            <div class="hidden overflow-x-auto md:block">

                <table class="w-full min-w-[800px]">

                    <thead>

                        <tr class="border-b border-gray-100 bg-gray-50/70">

                            <th class="px-6 py-3 text-left text-xs font-extrabold uppercase tracking-wide text-gray-400">
                                Event Type
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-extrabold uppercase tracking-wide text-gray-400">
                                Vendors
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-extrabold uppercase tracking-wide text-gray-400">
                                Sort
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-extrabold uppercase tracking-wide text-gray-400">
                                Status
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-extrabold uppercase tracking-wide text-gray-400">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($eventTypes as $eventType)

                            <tr class="group transition hover:bg-gray-50/70">

                                {{-- Event Type --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        {{-- Image --}}
                                        @if($eventType->images->count())

                                            @php
                                                $thumbnail = $eventType->images->first();
                                            @endphp

                                            <div class="relative h-12 w-12 shrink-0 overflow-hidden rounded-xl border border-gray-200 bg-gray-50">

                                                <img
                                                    src="{{ asset('storage/' . $thumbnail->path) }}"
                                                    alt="{{ $eventType->name }}"
                                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                                    loading="lazy"
                                                >

                                                @if($eventType->images->count() > 1)

                                                    <span class="absolute bottom-1 right-1 rounded-md bg-black/70 px-1.5 py-0.5 text-[9px] font-bold text-white">
                                                        +{{ $eventType->images->count() - 1 }}
                                                    </span>

                                                @endif

                                            </div>

                                        @else

                                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                                                        d="M4 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM12 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM12 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1v-6z"
                                                    />
                                                </svg>

                                            </div>

                                        @endif


                                        <div class="min-w-0">

                                            <a
                                                href="{{ route('event-types.show', $eventType) }}"
                                                class="block truncate text-sm font-bold text-gray-900 transition hover:text-[#D7385E]"
                                            >
                                                {{ $eventType->name }}
                                            </a>

                                            <p class="mt-0.5 truncate text-xs text-gray-400">
                                                /{{ $eventType->slug }}
                                            </p>

                                            @if($eventType->images->count())

                                                <p class="mt-1 text-[11px] font-semibold text-gray-400">
                                                    {{ $eventType->images->count() }}
                                                    {{ Str::plural('image', $eventType->images->count()) }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Vendors --}}
                                <td class="px-6 py-4 text-center">

                                    <span class="inline-flex min-w-9 items-center justify-center rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-bold text-gray-600">
                                        {{ $eventType->vendors_count }}
                                    </span>

                                </td>


                                {{-- Sort Order --}}
                                <td class="px-6 py-4 text-center">

                                    <span class="text-sm font-semibold text-gray-600">
                                        {{ $eventType->sort_order }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4 text-center">

                                    @if($eventType->status === 'active')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-green-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                            Active

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-500">

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
                                            href="{{ route('event-types.show', $eventType) }}"
                                            title="View"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-blue-50 hover:text-blue-600"
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
                                            href="{{ route('event-types.edit', $eventType) }}"
                                            title="Edit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                                            title="Delete"
                                            @click="openDeleteModal('{{ route('event-types.destroy', $eventType) }}', @js($eventType->name))"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-50 hover:text-red-600"
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

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- ====================================================
                MOBILE CARDS
            ===================================================== --}}

            <div class="divide-y divide-gray-100 md:hidden">

                @foreach($eventTypes as $eventType)

                    <div class="p-5">

                        <div class="flex items-start gap-3">

                            {{-- Image --}}
                            @if($eventType->images->count())

                                @php
                                    $thumbnail = $eventType->images->first();
                                @endphp

                                <div class="relative h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-gray-200 bg-gray-50">

                                    <img
                                        src="{{ asset('storage/' . $thumbnail->path) }}"
                                        alt="{{ $eventType->name }}"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >

                                    @if($eventType->images->count() > 1)

                                        <span class="absolute bottom-1 right-1 rounded-md bg-black/70 px-1 py-0.5 text-[9px] font-bold text-white">
                                            +{{ $eventType->images->count() - 1 }}
                                        </span>

                                    @endif

                                </div>

                            @else

                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                                            d="M4 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM12 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM12 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1-1h-6a1 1 0 01-1-1v-6z"
                                        />
                                    </svg>

                                </div>

                            @endif


                            <div class="min-w-0 flex-1">

                                <div class="flex items-start justify-between gap-3">

                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('event-types.show', $eventType) }}"
                                            class="block truncate text-sm font-bold text-gray-900 hover:text-[#D7385E]"
                                        >
                                            {{ $eventType->name }}
                                        </a>

                                        <p class="mt-0.5 truncate text-xs text-gray-400">
                                            /{{ $eventType->slug }}
                                        </p>

                                    </div>


                                    @if($eventType->status === 'active')

                                        <span class="shrink-0 rounded-full bg-green-50 px-2.5 py-1 text-[10px] font-bold text-green-700">
                                            Active
                                        </span>

                                    @else

                                        <span class="shrink-0 rounded-full bg-gray-100 px-2.5 py-1 text-[10px] font-bold text-gray-500">
                                            Inactive
                                        </span>

                                    @endif

                                </div>


                                {{-- Meta --}}
                                <div class="mt-3 flex flex-wrap items-center gap-2">

                                    <span class="rounded-lg bg-gray-100 px-2.5 py-1 text-[10px] font-bold text-gray-500">
                                        {{ $eventType->vendors_count }}
                                        {{ Str::plural('vendor', $eventType->vendors_count) }}
                                    </span>

                                    <span class="rounded-lg bg-gray-100 px-2.5 py-1 text-[10px] font-bold text-gray-500">
                                        Sort: {{ $eventType->sort_order }}
                                    </span>

                                    @if($eventType->images->count())

                                        <span class="rounded-lg bg-[#FBEBEF] px-2.5 py-1 text-[10px] font-bold text-[#D7385E]">
                                            {{ $eventType->images->count() }}
                                            {{ Str::plural('image', $eventType->images->count()) }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Mobile Actions --}}
                        <div class="mt-4 flex items-center justify-end gap-2 border-t border-gray-100 pt-3">

                            <a
                                href="{{ route('event-types.show', $eventType) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-600 transition hover:bg-gray-50"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('event-types.edit', $eventType) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-[#D7385E]/20 bg-[#FBEBEF] px-3 py-2 text-xs font-bold text-[#D7385E] transition hover:bg-[#f8dfe6]"
                            >
                                Edit
                            </a>

                            <button
                                type="button"
                                @click="openDeleteModal('{{ route('event-types.destroy', $eventType) }}', @js($eventType->name))"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-red-100 bg-red-50 px-3 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100"
                            >
                                Delete
                            </button>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- ====================================================
                PAGINATION
            ===================================================== --}}

            @if($eventTypes->hasPages())

                <div class="border-t border-gray-100 px-5 py-4 sm:px-6">

                    {{ $eventTypes->links() }}

                </div>

            @endif

        @else

            {{-- ====================================================
                EMPTY STATE
            ===================================================== --}}

            <div class="px-5 py-16 text-center sm:px-6">

                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]"
                >

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
                            d="M8 3v4M16 3v4M4 9h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8 13h2M14 13h2M8 17h2"
                        />
                    </svg>

                </div>


                @if(request()->hasAny(['search', 'status']))

                    <h3 class="mt-5 text-base font-extrabold text-gray-900">
                        No event types found
                    </h3>

                    <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
                        No event types match your current search or filters.
                        Try changing the filters and search again.
                    </p>

                    <a
                        href="{{ route('event-types.index') }}"
                        class="mt-5 inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
                    >
                        Clear Filters
                    </a>

                @else

                    <h3 class="mt-5 text-base font-extrabold text-gray-900">
                        No event types yet
                    </h3>

                    <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
                        Create your first event type to start organizing
                        the events available on your platform.
                    </p>

                    <a
                        href="{{ route('event-types.create') }}"
                        class="mt-5 inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-2.5 text-sm font-bold text-white transition hover:bg-[#c92f53]"
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

                        Add Event Type

                    </a>

                @endif

            </div>

        @endif

    </div>


    {{-- ============================================================
        DELETE MODAL
    ============================================================= --}}

    <div
        x-show="deleteModal"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4 backdrop-blur-sm"
    >

        <div
            x-show="deleteModal"
            x-transition
            @click.outside="closeDeleteModal()"
            class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            {{-- Modal Header --}}
            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600"
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
                                d="M6 7h12M10 11v6M14 11v6M8 7l1 13h6l1-13M9 7V4h6v3"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="text-base font-extrabold text-gray-900">
                            Delete Event Type
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            This action cannot be undone.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Modal Body --}}
            <div class="px-5 py-5 sm:px-6">

                <p class="text-sm leading-6 text-gray-600">

                    Are you sure you want to delete

                    <span
                        class="font-bold text-gray-900"
                        x-text="deleteName"
                    ></span>

                    ?

                </p>

            </div>


            {{-- Modal Actions --}}
            <div class="flex flex-col-reverse gap-2 border-t border-gray-100 bg-gray-50/50 px-5 py-4 sm:flex-row sm:justify-end sm:px-6">

                <button
                    type="button"
                    @click="closeDeleteModal()"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 sm:w-auto"
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
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-red-700 sm:w-auto"
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
                                d="M6 7h12M10 11v6M14 11v6M8 7l1 13h6l1-13M9 7V4h6v3"
                            />
                        </svg>

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection