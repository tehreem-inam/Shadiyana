@extends('layouts.app')

@section('title', 'Assign Event Types')

@section('content')

<div class="mx-auto max-w-6xl">

    {{-- ============================================================
        BREADCRUMB
    ============================================================= --}}
    <div class="mb-5 flex flex-wrap items-center gap-2 text-sm text-gray-400">

        <a
            href="{{ route('vendors.index') }}"
            class="transition-colors hover:text-[#D7385E]"
        >
            Vendors
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
                stroke-width="1.8"
                d="m9 18 6-6-6-6"
            />
        </svg>

        <a
            href="{{ route('vendors.show', $vendor) }}"
            class="max-w-[220px] truncate transition-colors hover:text-[#D7385E]"
        >
            {{ $vendor->business_name }}
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
                stroke-width="1.8"
                d="m9 18 6-6-6-6"
            />
        </svg>

        <span class="text-gray-600">
            Assign Event Types
        </span>

    </div>


    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}
    <div class="mb-7 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

        <div class="flex items-start gap-4">

            {{-- Icon --}}
            <div
                class="
                    flex h-14 w-14 shrink-0 items-center justify-center
                    rounded-2xl
                    bg-[#FBEBEF]
                    text-[#D7385E]
                    shadow-sm
                "
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
                        d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                </svg>
            </div>

            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Assign Event Types
                </h1>

                <p class="mt-1 text-sm leading-6 text-gray-500">
                    Select the event types supported by this vendor.
                </p>
            </div>

        </div>


        {{-- Back Button --}}
        <a
            href="{{ route('vendors.event-types.index', ['vendor' => $vendor]) }}"
            class="
                inline-flex items-center justify-center gap-2
                rounded-xl
                border border-gray-200
                bg-white
                px-4 py-2.5
                text-sm font-semibold text-gray-700
                shadow-sm
                transition-all
                hover:border-gray-300
                hover:bg-gray-50
                hover:text-gray-900
            "
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
                    d="M15 19l-7-7 7-7"
                />
            </svg>

            Back to Event Types

        </a>

    </div>


    {{-- ============================================================
        VENDOR CONTEXT CARD
    ============================================================= --}}
    <div
        class="
            mb-6 overflow-hidden rounded-2xl
            border border-gray-200
            bg-white
            shadow-sm
        "
    >

        <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">

            <div class="flex min-w-0 items-center gap-4">

                {{-- Vendor Logo --}}
                @if($vendor->logo_image)

                    <div
                        class="
                            h-14 w-14 shrink-0 overflow-hidden
                            rounded-xl
                            border border-gray-200
                            bg-gray-50
                        "
                    >
                        <img
                            src="{{ asset('storage/' . $vendor->logo_image) }}"
                            alt="{{ $vendor->business_name }}"
                            class="h-full w-full object-cover"
                        >
                    </div>

                @else

                    <div
                        class="
                            flex h-14 w-14 shrink-0 items-center justify-center
                            rounded-xl
                            bg-[#FBEBEF]
                            text-[#D7385E]
                        "
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
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0h-5m-9 0H3m2 0h5m-3-9h6m-6 4h6"
                            />
                        </svg>
                    </div>

                @endif


                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Vendor
                    </p>

                    <h2 class="mt-0.5 truncate text-lg font-bold text-gray-900">
                        {{ $vendor->business_name }}
                    </h2>

                    @if($vendor->city)

                        <div class="mt-1 flex items-center gap-1.5 text-sm text-gray-500">

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
                                    d="M12 21s8-6.2 8-12a8 8 0 10-16 0c0 5.8 8 12 8 12z"
                                />

                                <circle
                                    cx="12"
                                    cy="9"
                                    r="2.5"
                                    stroke-width="1.8"
                                />
                            </svg>

                            {{ $vendor->city->name }}

                        </div>

                    @endif

                </div>

            </div>


            {{-- Available Count --}}
            <div
                class="
                    inline-flex shrink-0 items-center gap-2
                    self-start
                    rounded-xl
                    bg-[#FBEBEF]
                    px-3.5 py-2
                    text-sm font-semibold
                    text-[#D7385E]
                    sm:self-auto
                "
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
                        d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                </svg>

                {{ $eventTypes->count() }} available

            </div>

        </div>

    </div>


    {{-- ============================================================
        ASSIGNMENT FORM
    ============================================================= --}}
    <form
        action="{{ route('vendors.event-types.store', $vendor) }}"
        method="POST"
        x-data="{
            selected: @js(array_map('strval', old('event_type_ids', []))),
            search: '',

            isSelected(id) {
                return this.selected.includes(String(id));
            },

            toggle(id) {
                id = String(id);

                if (this.selected.includes(id)) {
                    this.selected = this.selected.filter(
                        item => item !== id
                    );
                } else {
                    this.selected.push(id);
                }
            },

            clearSearch() {
                this.search = '';
            }
        }"
    >

        @csrf


        {{-- ========================================================
            VALIDATION ERRORS
        ========================================================= --}}
        @if($errors->any())

            <div
                class="
                    mb-6 rounded-2xl
                    border border-red-200
                    bg-red-50
                    p-5
                "
            >

                <div class="flex items-start gap-3">

                    <div
                        class="
                            flex h-9 w-9 shrink-0 items-center justify-center
                            rounded-xl
                            bg-red-100
                            text-red-600
                        "
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
                                d="M12 9v4m0 4h.01M10.3 3.9l-7.1 12.3A2 2 0 005 19h14a2 2 0 001.8-2.8L13.7 3.9a2 2 0 00-3.4 0z"
                            />
                        </svg>
                    </div>

                    <div class="min-w-0">

                        <h3 class="font-semibold text-red-800">
                            Please fix the following errors
                        </h3>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">

                            @foreach($errors->all() as $error)

                                <li class="flex items-start gap-2">

                                    <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-500"></span>

                                    <span>{{ $error }}</span>

                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- ========================================================
            MAIN SELECTION CARD
        ========================================================= --}}
        <div
            class="
                overflow-hidden rounded-2xl
                border border-gray-200
                bg-white
                shadow-sm
            "
        >

            {{-- ====================================================
                SECTION HEADER
            ===================================================== --}}
            <div
                class="
                    border-b border-gray-100
                    px-5 py-5
                    sm:px-6
                "
            >

                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="text-lg font-bold text-gray-900">
                            Available Event Types
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Choose one or more event types for this vendor.
                        </p>

                    </div>


                    {{-- Selected Counter --}}
                    <div
                        class="
                            inline-flex items-center gap-2
                            self-start
                            rounded-full
                            bg-gray-100
                            px-3.5 py-2
                            text-sm font-semibold
                            text-gray-600
                            transition-all duration-200
                        "
                        :class="
                            selected.length > 0
                                ? 'bg-[#FBEBEF] text-[#D7385E]'
                                : 'bg-gray-100 text-gray-600'
                        "
                    >

                        <span
                            class="
                                flex h-5 w-5 items-center justify-center
                                rounded-full
                                bg-white
                                text-[11px]
                                font-bold
                                shadow-sm
                            "
                            x-text="selected.length"
                        >
                            0
                        </span>

                        <span>
                            selected
                        </span>

                    </div>

                </div>


                {{-- =================================================
                    SEARCH
                ================================================== --}}
                <div class="mt-5">

                    <div class="relative">

                        <div
                            class="
                                pointer-events-none
                                absolute inset-y-0 left-0
                                flex items-center
                                pl-4
                                text-gray-400
                            "
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
                                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                                />
                            </svg>

                        </div>


                        <input
                            type="text"
                            x-model="search"
                            placeholder="Search event types..."
                            class="
                                w-full
                                rounded-xl
                                border border-gray-200
                                bg-gray-50
                                py-3 pl-11 pr-11
                                text-sm text-gray-900
                                outline-none
                                transition-all
                                placeholder:text-gray-400
                                focus:border-[#D7385E]
                                focus:bg-white
                                focus:ring-4
                                focus:ring-[#D7385E]/10
                            "
                        >


                        {{-- Clear Search --}}
                        <button
                            type="button"
                            x-show="search.length > 0"
                            x-cloak
                            @click="clearSearch()"
                            class="
                                absolute inset-y-0 right-0
                                flex items-center
                                pr-4
                                text-gray-400
                                transition-colors
                                hover:text-gray-700
                            "
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
                                    stroke-width="2"
                                    d="M6 6l12 12M18 6L6 18"
                                />
                            </svg>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                EVENT TYPE LIST
            ===================================================== --}}
            <div class="p-5 sm:p-6">

                @if($eventTypes->count())

                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">

                        @foreach($eventTypes as $eventType)

                            <label
                                data-event-type-card
                                x-show="
                                    search.trim() === '' ||
                                    @js(strtolower($eventType->name)).includes(
                                        search.toLowerCase().trim()
                                    )
                                "
                                class="group relative block cursor-pointer"
                            >

                                {{-- =====================================
                                    REAL CHECKBOX
                                ====================================== --}}
                                <input
                                    type="checkbox"
                                    name="event_type_ids[]"
                                    value="{{ $eventType->id }}"
                                    class="sr-only"
                                    x-model="selected"
                                >


                                {{-- =====================================
                                    SELECTABLE CARD
                                ====================================== --}}
                                <div
                                    class="
                                        relative overflow-hidden
                                        rounded-2xl
                                        border-2
                                        transition-all duration-200
                                    "
                                    :class="
                                        isSelected('{{ $eventType->id }}')
                                            ? 'border-[#D7385E] bg-[#FFF8FA] shadow-[0_8px_30px_rgba(215,56,94,0.12)]'
                                            : 'border-gray-100 bg-white hover:-translate-y-0.5 hover:border-[#E8A7B5] hover:shadow-md'
                                    "
                                >

                                    {{-- =================================
                                        TOP SELECTED ACCENT
                                    ================================== --}}
                                    <div
                                        class="
                                            absolute inset-x-0 top-0
                                            h-1
                                            transition-colors duration-200
                                        "
                                        :class="
                                            isSelected('{{ $eventType->id }}')
                                                ? 'bg-[#D7385E]'
                                                : 'bg-transparent'
                                        "
                                    ></div>


                                    <div class="p-5">

                                        <div class="flex items-start gap-4">

                                            {{-- =================================
                                                EVENT TYPE IMAGE
                                            ================================== --}}
                                            <div class="shrink-0">

                                                @if($eventType->image)

                                                    <div
                                                        class="
                                                            h-20 w-20
                                                            overflow-hidden
                                                            rounded-2xl
                                                            ring-1
                                                            transition-all duration-200
                                                        "
                                                        :class="
                                                            isSelected('{{ $eventType->id }}')
                                                                ? 'ring-2 ring-[#D7385E]'
                                                                : 'ring-gray-200 group-hover:ring-[#E8A7B5]'
                                                        "
                                                    >

                                                        <img
                                                            src="{{ asset('storage/' . $eventType->image) }}"
                                                            alt="{{ $eventType->name }}"
                                                            class="
                                                                h-full w-full
                                                                object-cover
                                                                transition duration-300
                                                                group-hover:scale-105
                                                            "
                                                        >

                                                    </div>

                                                @else

                                                    <div
                                                        class="
                                                            flex h-20 w-20
                                                            items-center justify-center
                                                            rounded-2xl
                                                            text-[#D7385E]
                                                            transition-all duration-200
                                                        "
                                                        :class="
                                                            isSelected('{{ $eventType->id }}')
                                                                ? 'bg-[#F8D5DE]'
                                                                : 'bg-[#FBEBEF] group-hover:bg-[#F9DDE5]'
                                                        "
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
                                                                stroke-width="1.7"
                                                                d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                            />
                                                        </svg>

                                                    </div>

                                                @endif

                                            </div>


                                            {{-- =================================
                                                CONTENT
                                            ================================== --}}
                                            <div class="min-w-0 flex-1">

                                                <div class="flex items-start justify-between gap-3">

                                                    {{-- Event Type Name --}}
                                                    <div class="min-w-0">

                                                        <h3
                                                            class="
                                                                truncate pr-1
                                                                text-base font-bold
                                                                transition-colors duration-200
                                                            "
                                                            :class="
                                                                isSelected('{{ $eventType->id }}')
                                                                    ? 'text-[#C52F52]'
                                                                    : 'text-gray-900 group-hover:text-[#D7385E]'
                                                            "
                                                        >
                                                            {{ $eventType->name }}
                                                        </h3>


                                                        {{-- Active Status --}}
                                                        <div class="mt-1.5">

                                                            <span
                                                                class="
                                                                    inline-flex
                                                                    items-center gap-1.5
                                                                    rounded-full
                                                                    bg-green-50
                                                                    px-2 py-0.5
                                                                    text-[11px]
                                                                    font-semibold
                                                                    text-green-700
                                                                "
                                                            >

                                                                <span
                                                                    class="
                                                                        h-1.5 w-1.5
                                                                        rounded-full
                                                                        bg-green-500
                                                                    "
                                                                ></span>

                                                                Active

                                                            </span>

                                                        </div>

                                                    </div>


                                                    {{-- =================================
                                                        CUSTOM CHECKBOX
                                                    ================================== --}}
                                                    <div class="relative shrink-0">

                                                        <div
                                                            class="
                                                                flex h-8 w-8
                                                                items-center justify-center
                                                                rounded-xl
                                                                border-2
                                                                shadow-sm
                                                                transition-all duration-200
                                                            "
                                                            :class="
                                                                isSelected('{{ $eventType->id }}')
                                                                    ? 'border-[#D7385E] bg-[#D7385E] text-white shadow-[0_4px_14px_rgba(215,56,94,0.28)]'
                                                                    : 'border-gray-300 bg-white text-transparent group-hover:border-[#D7385E]'
                                                            "
                                                        >

                                                            {{-- Tick --}}
                                                            <svg
                                                                x-show="isSelected('{{ $eventType->id }}')"
                                                                x-cloak
                                                                class="h-4 w-4"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="3"
                                                                    d="m5 12 4 4L19 6"
                                                                />
                                                            </svg>

                                                        </div>

                                                    </div>

                                                </div>


                                                {{-- =================================
                                                    DESCRIPTION
                                                ================================== --}}
                                                @if($eventType->description)

                                                    <p
                                                        class="
                                                            mt-3
                                                            line-clamp-2
                                                            text-sm
                                                            leading-5
                                                            text-gray-500
                                                        "
                                                    >
                                                        {{ $eventType->description }}
                                                    </p>

                                                @else

                                                    <p
                                                        class="
                                                            mt-3
                                                            text-sm
                                                            italic
                                                            text-gray-400
                                                        "
                                                    >
                                                        No description available.
                                                    </p>

                                                @endif


                                                {{-- =================================
                                                    BOTTOM STATUS
                                                ================================== --}}
                                                <div
                                                    class="
                                                        mt-4
                                                        flex items-center justify-between
                                                        border-t border-gray-100
                                                        pt-3
                                                    "
                                                >

                                                    {{-- Left Text --}}
                                                    <span
                                                        class="
                                                            text-xs font-medium
                                                            transition-colors duration-200
                                                        "
                                                        :class="
                                                            isSelected('{{ $eventType->id }}')
                                                                ? 'text-[#D7385E]'
                                                                : 'text-gray-400'
                                                        "
                                                    >

                                                        <span
                                                            x-show="!isSelected('{{ $eventType->id }}')"
                                                        >
                                                            Click to select
                                                        </span>

                                                        <span
                                                            x-show="isSelected('{{ $eventType->id }}')"
                                                            x-cloak
                                                        >
                                                            Event type selected
                                                        </span>

                                                    </span>


                                                    {{-- Right Selected Status --}}
                                                    <span
                                                        x-show="isSelected('{{ $eventType->id }}')"
                                                        x-cloak
                                                        class="
                                                            inline-flex
                                                            items-center gap-1.5
                                                            text-xs font-semibold
                                                            text-[#D7385E]
                                                        "
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
                                                                stroke-width="2.5"
                                                                d="m5 12 4 4L19 6"
                                                            />
                                                        </svg>

                                                        Selected

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </label>

                        @endforeach

                    </div>


                    {{-- =================================================
                        NO SEARCH RESULTS
                    ================================================== --}}
                    <div
                        x-show="
                            search.trim() !== '' &&
                            !Array.from(
                                document.querySelectorAll('[data-event-type-card]')
                            ).some(el => el.style.display !== 'none')
                        "
                        x-cloak
                        class="
                            py-14
                            text-center
                        "
                    >

                        <div
                            class="
                                mx-auto flex h-14 w-14
                                items-center justify-center
                                rounded-2xl
                                bg-gray-100
                                text-gray-400
                            "
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
                                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                                />
                            </svg>
                        </div>

                        <h3 class="mt-4 text-base font-semibold text-gray-900">
                            No event types found
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Try searching with a different event type name.
                        </p>

                        <button
                            type="button"
                            @click="clearSearch()"
                            class="
                                mt-4
                                text-sm font-semibold
                                text-[#D7385E]
                                hover:underline
                            "
                        >
                            Clear search
                        </button>

                    </div>

                @else

                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}
                    <div class="py-16 text-center">

                        <div
                            class="
                                mx-auto flex h-16 w-16
                                items-center justify-center
                                rounded-2xl
                                bg-[#FBEBEF]
                                text-[#D7385E]
                            "
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
                                    stroke-width="1.7"
                                    d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>

                        </div>

                        <h3 class="mt-5 text-lg font-bold text-gray-900">
                            No event types available
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                            There are currently no active event types available
                            for assignment. Create an active event type first.
                        </p>

                        <a
                            href="{{ route('event-types.create') }}"
                            class="
                                mt-5 inline-flex items-center gap-2
                                rounded-xl
                                bg-[#D7385E]
                                px-4 py-2.5
                                text-sm font-semibold
                                text-white
                                shadow-sm
                                transition-all
                                hover:bg-[#C52F52]
                                hover:shadow-md
                            "
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

                            Create Event Type

                        </a>

                    </div>

                @endif

            </div>


            {{-- ====================================================
                FORM FOOTER
            ===================================================== --}}
            <div
                class="
                    flex flex-col gap-4
                    border-t border-gray-100
                    bg-gray-50/70
                    px-5 py-4
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    sm:px-6
                "
            >

                {{-- Selection Summary --}}
                <div class="flex items-center gap-3">

                    <div
                        class="
                            flex h-9 w-9
                            items-center justify-center
                            rounded-xl
                            bg-[#FBEBEF]
                            text-[#D7385E]
                        "
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
                                stroke-width="2"
                                d="m5 12 4 4L19 6"
                            />
                        </svg>
                    </div>

                    <div>

                        <p
                            class="text-sm font-semibold text-gray-800"
                            x-text="
                                selected.length === 0
                                    ? 'No event types selected'
                                    : selected.length === 1
                                        ? '1 event type selected'
                                        : selected.length + ' event types selected'
                            "
                        >
                            No event types selected
                        </p>

                        <p class="text-xs text-gray-400">
                            Select the services this vendor supports.
                        </p>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex items-center gap-3">

                    <a
                        href="{{ route('vendors.event-types.index', ['vendor' => $vendor]) }}"
                        class="
                            inline-flex items-center justify-center
                            rounded-xl
                            border border-gray-200
                            bg-white
                            px-4 py-2.5
                            text-sm font-semibold
                            text-gray-700
                            shadow-sm
                            transition-all
                            hover:border-gray-300
                            hover:bg-gray-50
                        "
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        :disabled="selected.length === 0"
                        class="
                            inline-flex items-center justify-center gap-2
                            rounded-xl
                            px-5 py-2.5
                            text-sm font-semibold
                            text-white
                            shadow-sm
                            transition-all duration-200
                            disabled:cursor-not-allowed
                            disabled:opacity-50
                        "
                        :class="
                            selected.length > 0
                                ? 'bg-[#D7385E] hover:bg-[#C52F52] hover:shadow-md'
                                : 'bg-gray-300'
                        "
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
                                d="m5 12 4 4L19 6"
                            />
                        </svg>

                        Assign Selected

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection