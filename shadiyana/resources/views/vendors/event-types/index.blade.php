@extends('layouts.app')

@section('title', 'Vendor Event Types')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            {{-- Breadcrumb --}}
            <div class="mb-2 flex flex-wrap items-center gap-2 text-sm text-gray-400">
                <a
                    href="{{ url('/') }}"
                    class="transition hover:text-[#D7385E]"
                >
                    Dashboard
                </a>

                <svg
                    class="h-4 w-4 text-gray-300"
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
                    href="{{ route('vendors.index') }}"
                    class="transition hover:text-[#D7385E]"
                >
                    Vendors
                </a>

                <svg
                    class="h-4 w-4 text-gray-300"
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
                    Event Types
                </span>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FBEBEF]">
                    <svg
                        class="h-5 w-5 text-[#D7385E]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 21s8-4.5 8-10V5l-8-3-8 3v6c0 5.5 8 10 8 10z"
                        />
                    </svg>
                </div>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                        Event Types
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Manage event types assigned to
                        <span class="font-medium text-gray-700">
                            {{ $vendor->business_name }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Add Event Type --}}
        @if(
            auth()->check() &&
            in_array(auth()->user()->role, ['super_admin', 'superadmin'], true)
        )
            <a
                href="{{ route('vendors.event-types.create', ['vendor' => $vendor->id]) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52] focus:outline-none focus:ring-2 focus:ring-[#D7385E] focus:ring-offset-2"
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

                Assign Event Type
            </a>
        @endif

    </div>


    <!-- {{-- ============================================================
        FLASH SUCCESS
    ============================================================= --}}
    @if(session('success'))
        <div
            class="flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm text-green-700"
        >
            <svg
                class="mt-0.5 h-5 w-5 shrink-0 text-green-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>

            <span>{{ session('success') }}</span>
        </div>
    @endif -->


    {{-- ============================================================
        VALIDATION / ERROR ALERT
    ============================================================= --}}
    @if($errors->any())
        <div
            class="rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-700"
        >
            <div class="flex items-start gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.64h15.58a2 2 0 001.74-2.64l-7.82-14a2 2 0 00-3.48 0z"
                    />
                </svg>

                <div>
                    <p class="font-semibold">
                        Something went wrong
                    </p>

                    <ul class="mt-1 list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    @endif


    {{-- ============================================================
        SUMMARY CARD
    ============================================================= --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

        {{-- Vendor --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF]">
                    <svg
                        class="h-6 w-6 text-[#D7385E]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M9 10h.01M12 10h.01M15 10h.01"
                        />
                    </svg>
                </div>

                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                        Vendor
                    </p>

                    <p class="mt-1 truncate text-base font-semibold text-gray-900">
                        {{ $vendor->business_name }}
                    </p>
                </div>

            </div>
        </div>


        {{-- Total Event Types --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gray-100">
                    <svg
                        class="h-6 w-6 text-gray-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8 7V3m8 4V3M4 11h16M5 21h14a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                        Assigned Event Types
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-900">
                        {{ $eventTypes->total() }}
                    </p>
                </div>

            </div>
        </div>

    </div>


    {{-- ============================================================
        SEARCH / FILTER
    ============================================================= --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <form
            method="GET"
            action="{{ route('vendors.event-types.index', ['vendor' => $vendor->id]) }}"
            class="flex flex-col gap-3 sm:flex-row"
        >

            {{-- Search --}}
            <div class="relative flex-1">

                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg
                        class="h-5 w-5 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </div>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search event types..."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-11 pr-4 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#FBEBEF]"
                >

            </div>

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
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
                        d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                </svg>

                Search
            </button>

            @if(request('search'))
                <a
                    href="{{ route('vendors.event-types.index', ['vendor' => $vendor->id]) }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                >
                    Clear
                </a>
            @endif

        </form>

    </div>


    {{-- ============================================================
        EVENT TYPES TABLE
    ============================================================= --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="border-b border-gray-100 px-5 py-4 sm:px-6">
            <div class="flex items-center justify-between gap-4">

                <div>
                    <h2 class="text-base font-semibold text-gray-900">
                        Assigned Event Types
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Event types currently associated with this vendor.
                    </p>
                </div>

                @if($eventTypes->total() > 0)
                    <span class="rounded-full bg-[#FBEBEF] px-3 py-1 text-xs font-semibold text-[#D7385E]">
                        {{ $eventTypes->total() }}
                        {{ Str::plural('event type', $eventTypes->total()) }}
                    </span>
                @endif

            </div>
        </div>


        {{-- ========================================================
            EMPTY STATE
        ========================================================= --}}
        @if($eventTypes->isEmpty())

            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF]">
                    <svg
                        class="h-8 w-8 text-[#D7385E]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.6"
                            d="M8 7V3m8 4V3M4 11h16M5 21h14a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"
                        />
                    </svg>
                </div>

                <h3 class="mt-5 text-lg font-semibold text-gray-900">
                    No event types found
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                    @if(request('search'))
                        No event types match your search.
                    @else
                        This vendor does not have any event types assigned yet.
                    @endif
                </p>

                @if(request('search'))
                    <a
                        href="{{ route('vendors.event-types.index', ['vendor' => $vendor->id]) }}"
                        class="mt-5 inline-flex items-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                    >
                        Clear Search
                    </a>
                @elseif(
                    auth()->check() &&
                    in_array(auth()->user()->role, ['super_admin', 'superadmin'], true)
                )
                    <a
                        href="{{ route('vendors.event-types.create', ['vendor' => $vendor->id]) }}"
                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#c52f52]"
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

                        Assign Event Type
                    </a>
                @endif

            </div>

        @else

            {{-- ====================================================
                DESKTOP TABLE
            ===================================================== --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full divide-y divide-gray-100">

                    <thead class="bg-gray-50/80">
                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Event Type
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Slug
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Description
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Assigned
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @foreach($eventTypes as $eventType)

                            <tr class="group transition hover:bg-gray-50/70">

                                {{-- Event Type --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        {{-- Image --}}
                                        <div class="h-12 w-12 shrink-0 overflow-hidden rounded-xl bg-[#FBEBEF]">

                                            @if($eventType->image)
                                                <img
                                                    src="{{ asset('storage/' . $eventType->image) }}"
                                                    alt="{{ $eventType->name }}"
                                                    class="h-full w-full object-cover"
                                                >
                                            @else
                                                <div class="flex h-full w-full items-center justify-center">
                                                    <svg
                                                        class="h-5 w-5 text-[#D7385E]"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.7"
                                                            d="M4 7h16M4 7l2-3h12l2 3M5 7v12a2 2 0 002 2h10a2 2 0 002-2V7M9 11h6"
                                                        />
                                                    </svg>
                                                </div>
                                            @endif

                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate font-semibold text-gray-900">
                                                {{ $eventType->name }}
                                            </p>

                                            <p class="mt-1 text-xs text-gray-400">
                                                Event Type #{{ $eventType->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Slug --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <span class="rounded-lg bg-gray-100 px-2.5 py-1.5 text-xs font-medium text-gray-600">
                                        {{ $eventType->slug }}
                                    </span>

                                </td>


                                {{-- Description --}}
                                <td class="max-w-sm px-6 py-5">

                                    <p class="line-clamp-2 text-sm leading-6 text-gray-500">
                                        {{ $eventType->description ?: 'No description available.' }}
                                    </p>

                                </td>


                                {{-- Assigned Date --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    @if($eventType->pivot?->created_at)
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">
                                                {{ $eventType->pivot->created_at->format('d M Y') }}
                                            </p>

                                            <p class="mt-1 text-xs text-gray-400">
                                                {{ $eventType->pivot->created_at->format('h:i A') }}
                                            </p>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">
                                            —
                                        </span>
                                    @endif

                                </td>


{{-- Actions --}}
<td class="whitespace-nowrap px-6 py-5">

    <div class="flex items-center justify-end gap-2">

        @if(
            auth()->check() &&
            in_array(auth()->user()->role, ['super_admin', 'superadmin'], true)
        )

            {{-- Remove --}}
            <form
                method="POST"
                action="{{ route('vendors.event-types.destroy', [
                    'vendor' => $vendor->id,
                    'vendorEventType' => $eventType->pivot->id,
                ]) }}"
                onsubmit="return confirm('Are you sure you want to remove this event type from the vendor?');"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    title="Remove event type"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 text-gray-500 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600"
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
                            d="M6 7h12M9 7V4h6v3m2 0v13H7V7m3 4v6m4-6v6"
                        />
                    </svg>
                </button>

            </form>

        @endif

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

                        <div class="flex items-start gap-4">

                            {{-- Image --}}
                            <div class="h-14 w-14 shrink-0 overflow-hidden rounded-xl bg-[#FBEBEF]">

                                @if($eventType->image)
                                    <img
                                        src="{{ asset('storage/' . $eventType->image) }}"
                                        alt="{{ $eventType->name }}"
                                        class="h-full w-full object-cover"
                                    >
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <svg
                                            class="h-6 w-6 text-[#D7385E]"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.7"
                                                d="M4 7h16M4 7l2-3h12l2 3M5 7v12a2 2 0 002 2h10a2 2 0 002-2V7M9 11h6"
                                            />
                                        </svg>
                                    </div>
                                @endif

                            </div>


                            {{-- Main Info --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-start justify-between gap-3">

                                    <div class="min-w-0">

                                        <h3 class="truncate font-semibold text-gray-900">
                                            {{ $eventType->name }}
                                        </h3>

                                        <p class="mt-1 truncate text-xs text-gray-400">
                                            {{ $eventType->slug }}
                                        </p>

                                    </div>

                                    <span class="shrink-0 rounded-full bg-green-50 px-2.5 py-1 text-[11px] font-semibold text-green-600">
                                        Assigned
                                    </span>

                                </div>


                                {{-- Description --}}
                                <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-500">
                                    {{ $eventType->description ?: 'No description available.' }}
                                </p>


                                {{-- Assigned Date --}}
                                @if($eventType->pivot?->created_at)
                                    <div class="mt-3 flex items-center gap-2 text-xs text-gray-400">
                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.7"
                                                d="M8 7V3m8 4V3M4 11h16M5 21h14a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"
                                            />
                                        </svg>

                                        Assigned
                                        {{ $eventType->pivot->created_at->format('d M Y') }}
                                    </div>
                                @endif


                                {{-- Actions --}}
                                @if(
                                    auth()->check() &&
                                    in_array(auth()->user()->role, ['super_admin', 'superadmin'], true)
                                )

                                    <div class="mt-4 flex items-center gap-2">

                                        <a
                                            href="{{ route('vendors.event-types.edit', [
                                                'vendor' => $vendor->id,
                                                'vendorEventType' => $eventType->pivot->id,
                                            ]) }}"
                                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:border-[#D7385E] hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-7.5a2.121 2.121 0 013 3L12 16l-4 1 1-4 7.5-7.5z"
                                                />
                                            </svg>

                                            Edit
                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('vendors.event-types.destroy', [
                                                'vendor' => $vendor->id,
                                                'vendorEventType' => $eventType->pivot->id,
                                            ]) }}"
                                            class="flex-1"
                                            onsubmit="return confirm('Are you sure you want to remove this event type from the vendor?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50"
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
                                                        d="M6 7h12M9 7V4h6v3m2 0v13H7V7m3 4v6m4-6v6"
                                                    />
                                                </svg>

                                                Remove
                                            </button>
                                        </form>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif


        {{-- ========================================================
            PAGINATION
        ========================================================= --}}
        @if($eventTypes->hasPages())

            <div class="border-t border-gray-100 px-5 py-4 sm:px-6">
                {{ $eventTypes->links() }}
            </div>

        @endif

    </div>

</div>

@endsection