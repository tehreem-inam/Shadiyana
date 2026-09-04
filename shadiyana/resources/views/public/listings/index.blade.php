{{--
    Uses "Fraunces" for the page headline, matching the vendor card.
    Add this once in your layout <head> if it isn't already there:

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">
--}}

@extends('layouts.public')


@section(
    'title',

    $service
        ? $service->name
        : (
            $taxonomy
                ? (
                    $category
                        ? $category->name . ' - ' . $taxonomy->name
                        : $taxonomy->name
                )
                : ($category?->name ?? 'Wedding Vendors')
        )
)


@section('content')


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
        PAGE
    ============================================================= --}}

    <main class="min-h-screen bg-[#FAF8F6]">

        <div class="mx-auto max-w-[1500px] px-4 py-6 sm:px-6 sm:py-8 lg:px-8 xl:px-10">


            {{-- ====================================================
                BREADCRUMB
            ===================================================== --}}

            <div class="mb-4 flex flex-wrap items-center gap-2 text-xs sm:text-sm">

                {{-- Home --}}

                <a
                    href="{{ url('/') }}"
                    class="text-[#6B7A99] transition hover:text-[#B92D4E]"
                >
                    Home
                </a>


                <svg class="h-3.5 w-3.5 text-[#D8DEE9] sm:h-4 sm:w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L10.94 10 7.23 6.29a.75.75 0 111.06-1.06l4.24 4.24a.75.75 0 010 1.06l-4.24 4.24a.75.75 0 01-1.08 0z" clip-rule="evenodd"/>
                </svg>


                {{-- ==================================================
                    SERVICE BREADCRUMB
                =================================================== --}}

                @if($service)

                    <a
                        href="{{ route('public.listings.index', [
                            'category' => 'services',
                        ]) }}"
                        class="font-medium text-[#6B7A99] transition hover:text-[#B92D4E]"
                    >
                        Services
                    </a>


                    <svg class="h-3.5 w-3.5 text-[#D8DEE9] sm:h-4 sm:w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L10.94 10 7.23 6.29a.75.75 0 111.06-1.06l4.24 4.24a.75.75 0 010 1.06l-4.24-4.24a.75.75 0 01-1.08 0z" clip-rule="evenodd"/>
                    </svg>


                    <span class="font-semibold text-[#131B2E]">
                        {{ $service->name }}
                    </span>


                {{-- ==================================================
                    TAXONOMY / CATEGORY BREADCRUMB
                =================================================== --}}

                @else

                    @if($category)

                        <a
                            href="{{ route('public.listings.index', [
                                'category' => $category->slug,
                            ]) }}"
                            class="font-medium text-[#6B7A99] transition hover:text-[#B92D4E]"
                        >
                            {{ $category->name }}
                        </a>

                    @endif


                    @if($taxonomy)

                        <svg class="h-3.5 w-3.5 text-[#D8DEE9] sm:h-4 sm:w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L10.94 10 7.23 6.29a.75.75 0 111.06-1.06l4.24 4.24a.75.75 0 010 1.06l-4.24 4.24a.75.75 0 01-1.08 0z" clip-rule="evenodd"/>
                        </svg>


                        <span class="font-semibold text-[#131B2E]">
                            {{ $taxonomy->name }}
                        </span>

                    @endif

                @endif

            </div>


            {{-- ====================================================
                PAGE HEADER
            ===================================================== --}}

            <div class="mb-6 flex flex-col gap-4 border-b border-[#ECE1E5] pb-6 sm:mb-7 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    {{-- Page Title --}}

                    <h1
                        class="text-[26px] font-semibold tracking-tight text-[#131B2E] sm:text-[32px] lg:text-[38px]"
                        style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                    >

                        {{ $service?->name
                            ?? $taxonomy?->name
                            ?? $category?->name
                            ?? 'Wedding Vendors'
                        }}

                    </h1>


                    {{-- Page Description --}}

                    <p class="mt-1.5 max-w-2xl text-sm leading-6 text-[#6B7A99] sm:text-base">

                        @if($service)

                            Discover trusted
                            <span class="font-medium text-[#4B5872]">
                                {{ $service->name }}
                            </span>
                            vendors for your special day.

                        @elseif($taxonomy && $category)

                            Discover
                            {{ $taxonomy->name }}
                            vendors under
                            {{ $category->name }}.

                        @elseif($category)

                            Discover the best
                            {{ $category->name }}
                            vendors.

                        @else

                            Discover trusted wedding vendors
                            for your special day.

                        @endif

                    </p>

                </div>


                {{-- ==================================================
                    DESKTOP VENDOR COUNT
                =================================================== --}}

                <div class="hidden shrink-0 text-sm text-[#6B7A99] sm:block">

                    <span class="font-semibold text-[#131B2E]">
                        {{ $vendors->total() }}
                    </span>

                    {{ $vendors->total() === 1 ? 'vendor' : 'vendors' }}

                </div>

            </div>


            {{-- ====================================================
                MOBILE FILTER BUTTON
            ===================================================== --}}

            <div class="mb-4 flex items-center justify-between gap-3 lg:hidden">

                <div class="text-sm text-[#6B7A99]">

                    <span class="font-semibold text-[#131B2E]">
                        {{ $vendors->total() }}
                    </span>

                    {{ $vendors->total() === 1 ? 'vendor' : 'vendors' }}

                </div>


                <button
                    type="button"
                    onclick="openMobileFilter()"
                    class="inline-flex items-center gap-2 rounded-full border border-[#ECE1E5] bg-white px-4 py-2 text-sm font-medium text-[#131B2E] shadow-sm transition hover:border-[#D7385E] hover:text-[#D7385E]"
                >

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M7 12h10M10 18h4"/>
                    </svg>

                    Filter

                </button>

            </div>


            {{-- ====================================================
                MAIN LISTING AREA
                LEFT  = CARDS
                RIGHT = FILTER
            ===================================================== --}}

            <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-[minmax(0,1fr)_300px] xl:grid-cols-[minmax(0,1fr)_320px] xl:gap-8">


                {{-- ==================================================
                    LEFT — VENDOR CARDS
                =================================================== --}}

                <section class="min-w-0">


                    {{-- =================================================
                        SORT BAR
                    ================================================== --}}

                    <div class="mb-4 flex flex-col gap-3 rounded-2xl border border-[#ECE1E5] bg-white px-4 py-3 shadow-[0_2px_14px_rgba(19,27,46,0.035)] sm:flex-row sm:items-center sm:justify-between sm:px-5 sm:py-3">

                        {{-- Result Count --}}

                        <p class="text-xs text-[#6B7A99] sm:text-sm">

                            Showing

                            <span class="font-semibold text-[#131B2E]">
                                {{ $vendors->firstItem() ?? 0 }}
                            </span>

                            –

                            <span class="font-semibold text-[#131B2E]">
                                {{ $vendors->lastItem() ?? 0 }}
                            </span>

                            of

                            <span class="font-semibold text-[#131B2E]">
                                {{ $vendors->total() }}
                            </span>

                            results

                        </p>


                        {{-- Sort Form --}}

                        <form
                            method="GET"
                            action="{{ url('/listings') }}"
                            class="flex items-center gap-2"
                        >

                            {{-- Preserve Category --}}

                            @if($categorySlug)

                                <input
                                    type="hidden"
                                    name="category"
                                    value="{{ $categorySlug }}"
                                >

                            @endif


                            {{-- Preserve Slug --}}

                            @if($taxonomySlug)

                                <input
                                    type="hidden"
                                    name="slug"
                                    value="{{ $taxonomySlug }}"
                                >

                            @endif


                            {{-- Preserve City --}}

                            @if(request('city'))

                                <input
                                    type="hidden"
                                    name="city"
                                    value="{{ request('city') }}"
                                >

                            @endif


                            <label for="sort" class="hidden text-xs text-[#6B7A99] sm:block">
                                Sort by
                            </label>


                            <select
                                id="sort"
                                name="sort"
                                onchange="this.form.submit()"
                                class="w-full rounded-xl border border-[#ECE1E5] bg-white px-3 py-2 text-xs font-medium text-[#131B2E] outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10 sm:w-auto sm:px-4 sm:py-2 sm:text-sm"
                            >

                                <option
                                    value="relevance"
                                    @selected(
                                        request('sort', 'relevance') === 'relevance'
                                    )
                                >
                                    Relevance
                                </option>


                                <option
                                    value="rating"
                                    @selected(
                                        request('sort') === 'rating'
                                    )
                                >
                                    Highest Rated
                                </option>


                                <option
                                    value="reviews"
                                    @selected(
                                        request('sort') === 'reviews'
                                    )
                                >
                                    Most Reviewed
                                </option>


                                <option
                                    value="newest"
                                    @selected(
                                        request('sort') === 'newest'
                                    )
                                >
                                    Newest
                                </option>

                            </select>

                        </form>

                    </div>


                    {{-- =================================================
                        VENDOR CARDS
                    ================================================== --}}

                    @if($vendors->count())

                        <div class="space-y-4 sm:space-y-4">

                            @foreach($vendors as $vendor)

                                <x-vendor-card :vendor="$vendor" />

                            @endforeach

                        </div>


                        {{-- =================================================
                            PAGINATION
                        ================================================== --}}

                        @if($vendors->hasPages())

                            <div class="mt-8 sm:mt-10">

                                {{ $vendors->withQueryString()->links() }}

                            </div>

                        @endif


                    @else

                        {{-- =================================================
                            EMPTY STATE
                        ================================================== --}}

                        <div class="rounded-3xl border border-[#ECE1E5] bg-white px-5 py-14 text-center sm:px-6 sm:py-16">

                            {{-- Empty State Icon --}}

                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

                                @if($service)

                                    {{-- Service Icon --}}

                                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7V5a3 3 0 016 0v2m-9 0h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6"/>
                                    </svg>

                                @else

                                    {{-- Vendor Icon --}}

                                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7a2 2 0 012-2h10a2 2 0 012 2v14M8 9h1M8 13h1M8 17h1M15 9h1M15 13h1M15 17h1"/>
                                    </svg>

                                @endif

                            </div>


                            {{-- Empty State Heading --}}

                            <h2
                                class="mt-5 text-xl font-semibold text-[#131B2E]"
                                style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                            >
                                No vendors found
                            </h2>


                            {{-- Empty State Description --}}

                            <p class="mx-auto mt-2 max-w-lg text-sm leading-6 text-[#6B7A99]">

                                @if($service)

                                    No vendors are currently available
                                    for

                                    <strong class="font-medium text-[#4B5872]">
                                        {{ $service->name }}
                                    </strong>.

                                @elseif($taxonomy)

                                    No vendors are currently available in

                                    <strong class="font-medium text-[#4B5872]">
                                        {{ $taxonomy->name }}
                                    </strong>.

                                @elseif($category)

                                    No vendors are currently available in

                                    <strong class="font-medium text-[#4B5872]">
                                        {{ $category->name }}
                                    </strong>.

                                @else

                                    No vendors are currently available.

                                @endif

                            </p>


                            {{-- Back Home --}}

                            <a
                                href="{{ url('/') }}"
                                class="mt-6 inline-flex items-center rounded-full bg-[#D7385E] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#B92D4E]"
                            >
                                Back to Home
                            </a>

                        </div>

                    @endif

                </section>


                {{-- ==================================================
                    DESKTOP RIGHT FILTER
                =================================================== --}}

                <aside class="hidden lg:sticky lg:top-5 lg:block">

                    @include(
                        'public.listings.partials.filters'
                    )

                </aside>

            </div>

        </div>

    </main>


    {{-- ============================================================
        MOBILE FILTER OVERLAY
    ============================================================= --}}

    <div
        id="mobileFilterOverlay"
        class="fixed inset-0 z-[999] hidden"
    >

        {{-- ========================================================
            DARK BACKDROP
        ========================================================= --}}

        <div
            id="mobileFilterBackdrop"
            onclick="closeMobileFilter()"
            class="absolute inset-0 bg-[#131B2E]/40 backdrop-blur-[2px]"
        ></div>


        {{-- ========================================================
            FILTER DRAWER
        ========================================================= --}}

        <div
            id="mobileFilterDrawer"
            class="absolute right-0 top-0 h-full w-[88%] max-w-[380px] translate-x-full overflow-y-auto bg-[#FAF8F6] shadow-2xl transition-transform duration-300 ease-out"
        >

            {{-- ====================================================
                MOBILE FILTER HEADER
            ===================================================== --}}

            <div class="sticky top-0 z-10 flex items-center justify-between border-b border-[#ECE1E5] bg-white px-5 py-4">

                <div>

                    <h2 class="text-lg font-semibold text-[#131B2E]">
                        Filters
                    </h2>

                    <p class="mt-0.5 text-xs text-[#9AA5BB]">
                        Refine your results
                    </p>

                </div>


                {{-- Close Button --}}

                <button
                    type="button"
                    onclick="closeMobileFilter()"
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-[#F5F2F0] text-[#6B7A99] transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                    aria-label="Close filters"
                >

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/>
                    </svg>

                </button>

            </div>


            {{-- ====================================================
                ACTUAL FILTER
            ===================================================== --}}

            <div class="p-4">

                @include(
                    'public.listings.partials.filters',
                    [
                        'mobile' => true,
                    ]
                )

            </div>

        </div>

    </div>


    {{-- ============================================================
        MOBILE FILTER JAVASCRIPT
    ============================================================= --}}

    <script>

        /*
        |--------------------------------------------------------------------------
        | Open Mobile Filter
        |--------------------------------------------------------------------------
        */

        function openMobileFilter() {

            const overlay =
                document.getElementById('mobileFilterOverlay');

            const drawer =
                document.getElementById('mobileFilterDrawer');


            if (!overlay || !drawer) {
                return;
            }


            overlay.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');


            requestAnimationFrame(() => {

                drawer.classList.remove('translate-x-full');

                drawer.classList.add('translate-x-0');

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Close Mobile Filter
        |--------------------------------------------------------------------------
        */

        function closeMobileFilter() {

            const overlay =
                document.getElementById('mobileFilterOverlay');

            const drawer =
                document.getElementById('mobileFilterDrawer');


            if (!overlay || !drawer) {
                return;
            }


            drawer.classList.remove('translate-x-0');

            drawer.classList.add('translate-x-full');

            document.body.classList.remove('overflow-hidden');


            setTimeout(() => {

                overlay.classList.add('hidden');

            }, 300);

        }


        /*
        |--------------------------------------------------------------------------
        | Escape Key
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {

                    closeMobileFilter();

                }

            }
        );

    </script>


@endsection