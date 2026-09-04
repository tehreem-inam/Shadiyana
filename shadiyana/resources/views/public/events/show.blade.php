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

    <section class="relative overflow-hidden bg-[#FBF3F2]">

        {{-- Decorative rule instead of gradient blobs --}}
        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-px bg-[#EFD9DF]"></div>

        <div class="pointer-events-none absolute -right-16 top-0 hidden h-full w-[420px] opacity-[0.55] md:block">
            <svg viewBox="0 0 420 420" class="h-full w-full" fill="none">
                <circle
                    cx="360"
                    cy="60"
                    r="220"
                    stroke="#D7385E"
                    stroke-opacity="0.08"
                    stroke-width="1.5"
                />

                <circle
                    cx="360"
                    cy="60"
                    r="150"
                    stroke="#D7385E"
                    stroke-opacity="0.1"
                    stroke-width="1.5"
                />
            </svg>
        </div>


        <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16">

            {{-- ====================================================
                BREADCRUMB
            ===================================================== --}}

            <div class="mb-6 flex items-center gap-2 text-sm text-[#8A7C86]">

                <a
                    href="{{ url('/') }}"
                    class="transition hover:text-[#D7385E]"
                >
                    Home
                </a>

                <svg
                    class="h-4 w-4 text-[#D9C2C9]"
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

                <span class="font-medium text-[#131B2E]">
                    {{ $eventType->name }}
                </span>

            </div>


            {{-- ====================================================
                HERO CONTENT
            ===================================================== --}}

            <div class="max-w-3xl">

                {{-- Small badge --}}
                <div
                    class="mb-5 inline-flex items-center gap-2 rounded-full border border-[#EFD9DF] bg-white px-3 py-1.5 text-xs font-medium text-[#D7385E] shadow-sm"
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

                    Wedding planning

                </div>


                {{-- =================================================
                    EVENT TITLE
                ================================================== --}}

                <h1
                    class="text-[34px] font-semibold leading-[1.1] tracking-tight text-[#131B2E] sm:text-[42px] lg:text-[50px]"
                    style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                >
                    {{ $eventType->name }}
                </h1>


                {{-- =================================================
                    DESCRIPTION
                ================================================== --}}

                <p
                    class="mt-4 max-w-2xl text-sm leading-6 text-[#6B7A99] sm:text-base sm:leading-7"
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


                <div class="mt-7 flex flex-wrap gap-3">

                    {{-- Vendors --}}
                    <div
                        class="inline-flex items-center gap-3 rounded-2xl border border-[#ECE1E5] bg-white px-4 py-3 shadow-[0_4px_18px_rgba(19,27,46,0.05)]"
                    >

                        <span
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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

                            <p
                                class="text-lg font-semibold leading-none text-[#131B2E]"
                                style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                            >
                                {{ $totalVendorCount }}
                            </p>

                            <p class="mt-1 text-xs text-[#9AA5BB]">
                                Vendors
                            </p>

                        </div>

                    </div>


                    {{-- Services --}}
                    <div
                        class="inline-flex items-center gap-3 rounded-2xl border border-[#ECE1E5] bg-white px-4 py-3 shadow-[0_4px_18px_rgba(19,27,46,0.05)]"
                    >

                        <span
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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

                            <p
                                class="text-lg font-semibold leading-none text-[#131B2E]"
                                style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                            >
                                {{ $serviceSections->count() }}
                            </p>

                            <p class="mt-1 text-xs text-[#9AA5BB]">
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
        class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-16"
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


            <section class="mb-16">


                {{-- =================================================
                    VENUE HEADER
                ================================================== --}}

                <div
                    class="mb-5 flex items-center justify-between gap-4"
                >

                    <div>

                        <div class="mb-1.5 flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#D7385E]"></span>

                            <span class="text-[13px] font-medium text-[#B92D4E]">
                                Venues
                            </span>

                        </div>

                        <h2
                            class="text-xl font-semibold tracking-tight text-[#131B2E] sm:text-2xl"
                            style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                        >
                            Wedding venues for {{ $eventType->name }}
                        </h2>

                    </div>


                    @if($venueVendors->count() > 6)

                        <a
                            href="{{ route('public.listings.index', [
                                'taxonomy' => 'wedding-venues',
                                'event_type' => $eventType->slug,
                            ]) }}"
                            class="group inline-flex shrink-0 items-center gap-1.5 text-sm font-medium text-[#131B2E] transition hover:text-[#D7385E]"
                        >

                            View all

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
                    VENUE CARDS — edge-fade hints at horizontal scroll
                ================================================== --}}

                <div class="relative">

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

                            {{-- =================================================
                                VENUE CARD
                                Dynamic vendor profile link
                            ================================================== --}}

                            <a
                                href="{{ url('/vendors/' . $vendor->slug) }}"
                                class="
                                    block
                                    w-[230px]
                                    min-w-[230px]
                                    shrink-0
                                    snap-start
                                    overflow-hidden
                                    rounded-2xl
                                    transition-transform
                                    duration-200
                                    motion-reduce:transition-none
                                    hover:-translate-y-1
                                    focus:outline-none
                                    focus-visible:ring-2
                                    focus-visible:ring-[#D7385E]
                                    focus-visible:ring-offset-2

                                    sm:w-[270px]
                                    sm:min-w-[270px]

                                    lg:w-[280px]
                                    lg:min-w-[280px]
                                "
                            >

                                <x-event-vendor-card
                                    :vendor="$vendor"
                                />

                            </a>

                        @endforeach

                    </div>

                    <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-16 bg-gradient-to-l from-white to-transparent sm:block"></div>

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

                            View all wedding venues

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

            <div class="mb-16 h-px bg-[#F1EDEC]"></div>

        @endif



        {{-- ========================================================
            SERVICES
        ========================================================= --}}

        @if($serviceSections->isNotEmpty())

            <section>


                {{-- =================================================
                    SERVICES HEADER
                ================================================== --}}

                <div class="mb-9">

                    <div class="mb-1.5 flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-[#D7385E]"></span>

                        <span class="text-[13px] font-medium text-[#B92D4E]">
                            Wedding services
                        </span>

                    </div>


                    <h2
                        class="text-xl font-semibold tracking-tight text-[#131B2E] sm:text-2xl"
                        style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                    >
                        Find vendors for {{ $eventType->name }}
                    </h2>


                    <p
                        class="mt-2 max-w-2xl text-sm leading-6 text-[#6B7A99]"
                    >
                        Explore trusted wedding professionals offering
                        services for your
                        {{ strtolower($eventType->name) }}.
                    </p>

                </div>



                {{-- =================================================
                    SERVICE SECTIONS
                ================================================== --}}

                <div class="space-y-14">

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
                                    class="text-lg font-semibold tracking-tight text-[#131B2E] sm:text-xl"
                                >

                                    {{ $service->name }}

                                    <span class="font-normal text-[#9AA5BB]">
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
                                        class="group hidden shrink-0 items-center gap-1.5 text-sm font-medium text-[#131B2E] transition hover:text-[#D7385E] sm:inline-flex"
                                    >

                                        View all

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

                            <div class="relative">

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

                                        {{-- =====================================
                                            SERVICE CARD
                                            Dynamic vendor profile link
                                        ====================================== --}}

                                        <a
                                            href="{{ url('/vendors/' . $vendor->slug) }}"
                                            class="
                                                block
                                                w-[230px]
                                                min-w-[230px]
                                                shrink-0
                                                snap-start
                                                overflow-hidden
                                                rounded-2xl
                                                transition-transform
                                                duration-200
                                                motion-reduce:transition-none
                                                hover:-translate-y-1
                                                focus:outline-none
                                                focus-visible:ring-2
                                                focus-visible:ring-[#D7385E]
                                                focus-visible:ring-offset-2

                                                sm:w-[270px]
                                                sm:min-w-[270px]

                                                lg:w-[280px]
                                                lg:min-w-[280px]
                                            "
                                        >

                                            <x-event-vendor-card
                                                :vendor="$vendor"
                                            />

                                        </a>

                                    @endforeach

                                </div>

                                <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-16 bg-gradient-to-l from-white to-transparent sm:block"></div>

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

                                        View all {{ $service->name }}

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
                class="rounded-3xl border border-[#ECE1E5] bg-[#FAF8F6] px-6 py-16 text-center"
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


                <h2
                    class="mt-5 text-xl font-semibold text-[#131B2E]"
                    style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                >
                    Vendors coming soon
                </h2>


                <p
                    class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#6B7A99]"
                >
                    We are currently adding trusted vendors for
                    {{ $eventType->name }}.
                    Please check back soon.
                </p>


                <a
                    href="{{ url('/') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-full bg-[#D7385E] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#B92D4E]"
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
                class="mt-16 border-t border-[#F1EDEC] pt-10"
            >

                <div class="mx-auto max-w-4xl">

                    <div class="mb-2 flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-[#D7385E]"></span>

                        <span class="text-[13px] font-medium text-[#B92D4E]">
                            About
                        </span>

                    </div>


                    <h2
                        class="text-xl font-semibold text-[#131B2E] sm:text-2xl"
                        style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                    >
                        About {{ $eventType->name }}
                    </h2>


                    <div
                        class="prose prose-sm mt-4 max-w-none leading-7 text-[#4B5872] prose-headings:font-semibold prose-headings:text-[#131B2E] prose-a:text-[#D7385E] prose-a:no-underline hover:prose-a:underline prose-strong:text-[#131B2E]"
                    >
                        {!! $eventType->description !!}
                    </div>

                </div>

            </section>

        @endif

    </main>

</div>

@endsection