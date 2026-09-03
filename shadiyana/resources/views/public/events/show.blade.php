@extends('layouts.public')

@section('title', $eventType->name . ' | Shadiyana')

@section('content')

<div class="min-h-screen bg-white">

    {{-- ============================================================
        PUBLIC NAVBAR
    ============================================================= --}}

    <x-public.home-navbar
        :venue-taxonomies="$venueTaxonomies"
        :services="$services"
        :event-types="$eventTypes"
        :cities="$cities"
    />


    {{-- ============================================================
        HERO
    ============================================================= --}}

    <section class="relative overflow-hidden bg-[#FBEBEF]">

        {{-- Decorative elements --}}
        <div
            class="pointer-events-none absolute -right-20 -top-24 h-64 w-64 rounded-full bg-[#D7385E]/10 blur-3xl"
        ></div>

        <div
            class="pointer-events-none absolute -bottom-24 -left-20 h-64 w-64 rounded-full bg-[#D7385E]/10 blur-3xl"
        ></div>


        <div
            class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14"
        >

            {{-- ====================================================
                BREADCRUMB
            ===================================================== --}}

            <div class="mb-5 flex items-center gap-2 text-sm text-gray-500">

                <a
                    href="{{ url('/') }}"
                    class="transition hover:text-[#D7385E]"
                >
                    Home
                </a>

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
                        d="m9 18 6-6-6-6"
                    />
                </svg>

                <span class="font-medium text-gray-700">
                    {{ $eventType->name }}
                </span>

            </div>


            {{-- ====================================================
                HERO CONTENT
            ===================================================== --}}

            <div class="max-w-3xl">

                {{-- Small badge --}}
                <div
                    class="mb-4 inline-flex items-center gap-2 rounded-full border border-[#D7385E]/20 bg-white px-3 py-1.5 text-xs font-semibold text-[#D7385E] shadow-sm"
                >

                    <span
                        class="flex h-5 w-5 items-center justify-center rounded-full bg-[#FBEBEF]"
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
                                d="M12 3v18M3 12h18"
                            />
                        </svg>

                    </span>

                    Wedding Planning

                </div>


                {{-- =================================================
                    EVENT TITLE
                ================================================== --}}

                <h1
                    class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl"
                >
                    {{ $eventType->name }}
                </h1>


                {{-- =================================================
                    DESCRIPTION
                ================================================== --}}

                <p
                    class="mt-3 max-w-2xl text-sm leading-6 text-gray-600 sm:text-base sm:leading-7"
                >
                    Find trusted wedding vendors and services for your
                    {{ strtolower($eventType->name) }}.
                    Explore venues, photographers, makeup artists,
                    decorators and more — all in one place.
                </p>


                {{-- =================================================
                    COUNTS
                ================================================== --}}

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | Venue vendor count
                    |--------------------------------------------------------------------------
                    */

                    $venueVendorCount = $venueSections->sum(
                        fn ($section) => $section['vendors']->count()
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Service vendor count
                    |--------------------------------------------------------------------------
                    */

                    $serviceVendorCount = $serviceSections->sum(
                        fn ($section) => $section['vendors']->count()
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Total vendor count
                    |--------------------------------------------------------------------------
                    */

                    $totalVendorCount =
                        $venueVendorCount +
                        $serviceVendorCount;

                @endphp


                <div class="mt-6 flex flex-wrap gap-3">

                    {{-- Vendors --}}
                    <div
                        class="inline-flex items-center gap-3 rounded-xl bg-white px-3.5 py-2.5 shadow-sm ring-1 ring-gray-100"
                    >

                        <span
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]"
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
                                    d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2m7-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8 10v-2a4 4 0 0 0-3-3.87M17 3.13a4 4 0 0 1 0 7.75"
                                />
                            </svg>

                        </span>


                        <div>

                            <p class="text-base font-semibold text-gray-900">
                                {{ $totalVendorCount }}
                            </p>

                            <p class="text-xs text-gray-500">
                                Vendors
                            </p>

                        </div>

                    </div>


                    {{-- Services --}}
                    <div
                        class="inline-flex items-center gap-3 rounded-xl bg-white px-3.5 py-2.5 shadow-sm ring-1 ring-gray-100"
                    >

                        <span
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]"
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
                                    d="M4 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Zm4 0v14m4-10h4m-4 4h4"
                                />
                            </svg>

                        </span>


                        <div>

                            <p class="text-base font-semibold text-gray-900">
                                {{ $serviceSections->count() }}
                            </p>

                            <p class="text-xs text-gray-500">
                                Services
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- ============================================================
        MAIN CONTENT
    ============================================================= --}}

    <main
        class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14"
    >


        {{-- ========================================================
            WEDDING VENUES
        ========================================================= --}}

        @if($venueSections->isNotEmpty())

            @php

                /*
                |--------------------------------------------------------------------------
                | Combine Parent + Child Vendors
                |--------------------------------------------------------------------------
                |
                | All vendors from:
                |
                | Wedding Venues
                | + Wedding Venues children
                |
                | are displayed together in one horizontal row.
                |
                */

                $venueVendors = $venueSections
                    ->flatMap(function ($section) {
                        return $section['vendors'];
                    })
                    ->unique('id')
                    ->values();


                /*
                |--------------------------------------------------------------------------
                | Show first six cards
                |--------------------------------------------------------------------------
                */

                $visibleVenueVendors = $venueVendors->take(6);

            @endphp


            <section class="mb-14">


                {{-- =================================================
                    VENUE HEADER
                ================================================== --}}

                <div
                    class="mb-5 flex items-center justify-between gap-4"
                >

                    <div>

                        <p
                            class="mb-1 text-xs font-semibold uppercase tracking-wider text-[#D7385E]"
                        >
                            Venues
                        </p>

                        <h2
                            class="text-xl font-semibold tracking-tight text-gray-900 sm:text-2xl"
                        >
                            Wedding Venues for {{ $eventType->name }}
                        </h2>

                    </div>


                    @if($venueVendors->count() > 6)

                        <a
                            href="{{ route('public.listings.index', [
                                'taxonomy' => 'wedding-venues',
                                'event_type' => $eventType->slug,
                            ]) }}"
                            class="group inline-flex shrink-0 items-center gap-1.5 text-sm font-medium text-gray-900 transition hover:text-[#D7385E]"
                        >

                            View All

                            <svg
                                class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 12h14m-6-6 6 6"
                                />
                            </svg>

                        </a>

                    @endif

                </div>


                {{-- =================================================
                    VENUE CARDS
                ================================================== --}}

                <div
                    class="
                        flex
                        gap-3
                        overflow-x-auto
                        overflow-y-hidden
                        pb-3
                        scroll-smooth
                        snap-x
                        snap-mandatory
                        scrollbar-hide
                    "
                >

                    @foreach($visibleVenueVendors as $vendor)

                        <div
                            class="
                                w-[230px]
                                min-w-[230px]
                                shrink-0
                                snap-start
                                overflow-hidden
                                rounded-2xl
                                transition-transform
                                duration-200
                                hover:-translate-y-1

                                sm:w-[270px]
                                sm:min-w-[270px]

                                lg:w-[280px]
                                lg:min-w-[280px]
                            "
                        >

                            <x-event-vendor-card
                                :vendor="$vendor"
                            />

                        </div>

                    @endforeach

                </div>


                {{-- Mobile View All --}}
                @if($venueVendors->count() > 6)

                    <div class="mt-3 sm:hidden">

                        <a
                            href="{{ route('public.listings.index', [
                                'taxonomy' => 'wedding-venues',
                                'event_type' => $eventType->slug,
                            ]) }}"
                            class="group inline-flex items-center gap-1.5 text-sm font-semibold text-[#D7385E]"
                        >

                            View All Wedding Venues

                            <svg
                                class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 12h14m-6-6 6 6"
                                />
                            </svg>

                        </a>

                    </div>

                @endif

            </section>

        @endif



        {{-- ========================================================
            DIVIDER
        ========================================================= --}}

        @if(
            $venueSections->isNotEmpty() &&
            $serviceSections->isNotEmpty()
        )

            <div class="mb-14 h-px bg-gray-100"></div>

        @endif



        {{-- ========================================================
            SERVICES
        ========================================================= --}}

        @if($serviceSections->isNotEmpty())

            <section>


                {{-- =================================================
                    SERVICES HEADER
                ================================================== --}}

                <div class="mb-8">

                    <p
                        class="mb-1 text-xs font-semibold uppercase tracking-wider text-[#D7385E]"
                    >
                        Wedding Services
                    </p>


                    <h2
                        class="text-xl font-semibold tracking-tight text-gray-900 sm:text-2xl"
                    >
                        Find Vendors for {{ $eventType->name }}
                    </h2>


                    <p
                        class="mt-2 max-w-2xl text-sm leading-6 text-gray-500"
                    >
                        Explore trusted wedding professionals offering
                        services for your
                        {{ strtolower($eventType->name) }}.
                    </p>

                </div>



                {{-- =================================================
                    SERVICE SECTIONS
                ================================================== --}}

                <div class="space-y-12">

                    @foreach($serviceSections as $serviceSection)

                        @php

                            $service = $serviceSection['service'];

                            $vendors = $serviceSection['vendors'];

                            $visibleVendors = $vendors->take(6);

                        @endphp


                        <section>


                            {{-- =====================================
                                SERVICE HEADER
                            ====================================== --}}

                            <div
                                class="mb-5 flex items-center justify-between gap-4"
                            >

                                <h3
                                    class="text-lg font-semibold tracking-tight text-gray-900 sm:text-xl"
                                >

                                    {{ $service->name }}

                                    <span class="font-normal text-gray-400">
                                        for
                                    </span>

                                    {{ $eventType->name }}

                                </h3>


                                @if($vendors->count() > 6)

                                    <a
                                        href="{{ route('public.listings.index', [
                                            'service' => $service->slug,
                                            'event_type' => $eventType->slug,
                                        ]) }}"
                                        class="group hidden shrink-0 items-center gap-1.5 text-sm font-medium text-gray-900 transition hover:text-[#D7385E] sm:inline-flex"
                                    >

                                        View All

                                        <svg
                                            class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M5 12h14m-6-6 6 6"
                                            />
                                        </svg>

                                    </a>

                                @endif

                            </div>



                            {{-- =====================================
                                SERVICE VENDOR CARDS
                            ====================================== --}}

                            <div
                                class="
                                    flex
                                    gap-3
                                    overflow-x-auto
                                    overflow-y-hidden
                                    pb-3
                                    scroll-smooth
                                    snap-x
                                    snap-mandatory
                                    scrollbar-hide
                                "
                            >

                                @foreach($visibleVendors as $vendor)

                                    <div
                                        class="
                                            w-[230px]
                                            min-w-[230px]
                                            shrink-0
                                            snap-start
                                            overflow-hidden
                                            rounded-2xl
                                            transition-transform
                                            duration-200
                                            hover:-translate-y-1

                                            sm:w-[270px]
                                            sm:min-w-[270px]

                                            lg:w-[280px]
                                            lg:min-w-[280px]
                                        "
                                    >

                                        <x-event-vendor-card
                                            :vendor="$vendor"
                                        />

                                    </div>

                                @endforeach

                            </div>



                            {{-- =====================================
                                MOBILE VIEW ALL
                            ====================================== --}}

                            @if($vendors->count() > 6)

                                <div class="mt-3 sm:hidden">

                                    <a
                                        href="{{ route('public.listings.index', [
                                            'service' => $service->slug,
                                            'event_type' => $eventType->slug,
                                        ]) }}"
                                        class="group inline-flex items-center gap-1.5 text-sm font-semibold text-[#D7385E]"
                                    >

                                        View All {{ $service->name }}

                                        <svg
                                            class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M5 12h14m-6-6 6 6"
                                            />
                                        </svg>

                                    </a>

                                </div>

                            @endif

                        </section>

                    @endforeach

                </div>

            </section>

        @endif



        {{-- ========================================================
            EMPTY STATE
        ========================================================= --}}

        @if(
            $venueSections->isEmpty() &&
            $serviceSections->isEmpty()
        )

            <section
                class="rounded-3xl border border-gray-100 bg-gray-50 px-6 py-16 text-center"
            >

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
                            stroke-width="1.6"
                            d="M21 10.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5Z"
                        />
                    </svg>

                </div>


                <h2 class="mt-5 text-xl font-bold text-gray-900">
                    Vendors coming soon
                </h2>


                <p
                    class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500"
                >
                    We are currently adding trusted vendors for
                    {{ $eventType->name }}.
                    Please check back soon.
                </p>


                <a
                    href="{{ url('/') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c32f51]"
                >

                    Explore Shadiyana

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
                            d="M5 12h14m-6-6 6 6"
                        />
                    </svg>

                </a>

            </section>

        @endif



        {{-- ========================================================
            EVENT DESCRIPTION
        ========================================================= --}}

        @if(!empty($eventType->description))

            <section
                class="mt-14 border-t border-gray-100 pt-10"
            >

                <div class="mx-auto max-w-4xl">

                    <div class="mb-3 flex items-center gap-2">

                        <span
                            class="h-1 w-7 rounded-full bg-[#D7385E]"
                        ></span>

                        <span
                            class="text-xs font-semibold uppercase tracking-wider text-[#D7385E]"
                        >
                            About
                        </span>

                    </div>


                    <h2
                        class="text-xl font-semibold text-gray-900 sm:text-2xl"
                    >
                        About {{ $eventType->name }}
                    </h2>


                    <div
                        class="prose prose-gray mt-4 max-w-none text-sm leading-7 text-gray-600"
                    >
                        {!! $eventType->description !!}
                    </div>

                </div>

            </section>

        @endif

    </main>

</div>

@endsection