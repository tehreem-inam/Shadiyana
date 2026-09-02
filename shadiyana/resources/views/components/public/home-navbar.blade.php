@php
    $weddingVenues = $venueTaxonomies->firstWhere('slug', 'wedding-venues');
@endphp

<header
    x-data="{ mobileMenu: false }"
    class="sticky top-0 z-50 border-b border-gray-100 bg-white/95 backdrop-blur-xl"
>
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        <div class="flex h-20 items-center justify-between">

            {{-- ============================================================
                LOGO
            ============================================================= --}}

            <a
                href="{{ route('home') }}"
                class="group flex items-center"
            >
                <span class="text-2xl font-bold tracking-tight text-[#D7385E]">
                    Shadiyana
                </span>
            </a>


            {{-- ============================================================
                DESKTOP NAVIGATION
            ============================================================= --}}

            <nav class="hidden items-center gap-8 lg:flex">

{{-- ========================================================
    VENUES
========================================================= --}}

<div
    x-data="{ open: false }"
    class="relative"
    @mouseenter="open = true"
    @mouseleave="open = false"
>

    <button
        type="button"
        class="flex items-center gap-1.5 py-7 text-[13px] font-medium text-gray-700 transition hover:text-[#D7385E]"
    >

        Venues

        {{-- ====================================================
            SIMPLE DOWN ARROW ICON
        ===================================================== --}}

        <svg
            class="h-4 w-4 transition-transform duration-200"
            :class="{ 'rotate-180': open }"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M6 9l6 6 6-6"/>
        </svg>

    </button>


    {{-- ========================================================
        VENUE DROPDOWN
        ONLY WEDDING VENUES + ITS CHILDREN
    ========================================================= --}}

    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute left-1/2 top-full z-50 w-80 -translate-x-1/2 rounded-2xl border border-gray-100 bg-white p-3 shadow-xl"
    >

        @if($weddingVenues)

            {{-- ==================================================
                WEDDING VENUES
            =================================================== --}}

            <div class="mb-2">

                <a
                    href="{{ route('public.listings.index', [
                        'category' => 'wedding-venues',
                    ]) }}"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-[13px] font-semibold text-gray-800 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >

                    <span>
                        {{ $weddingVenues->name }}
                    </span>

                    @if($weddingVenues->children->isNotEmpty())

                        {{-- Right Arrow --}}

                        <svg
                            class="h-4 w-4 text-gray-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M9 6l6 6-6 6"/>
                        </svg>

                    @endif

                </a>


                {{-- ==================================================
                    WEDDING VENUE CHILDREN
                =================================================== --}}

                @if($weddingVenues->children->isNotEmpty())

                    <div class="ml-3 border-l border-gray-100 pl-2">

                        @foreach($weddingVenues->children as $child)

                            <a
                                href="{{ route('public.listings.index', [
                                    'category' => 'wedding-venues',
                                    'slug' => $child->slug,
                                ]) }}"
                                class="block rounded-lg px-3 py-2 text-[13px] text-gray-500 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                            >
                                {{ $child->name }}
                            </a>

                        @endforeach

                    </div>

                @endif

            </div>

        @else

            <p class="px-4 py-3 text-[13px] text-gray-400">
                No venue categories available.
            </p>

        @endif

    </div>

</div>

                {{-- ========================================================
                    SERVICES
                ========================================================= --}}

                <div
                    x-data="{ open: false }"
                    class="relative"
                    @mouseenter="open = true"
                    @mouseleave="open = false"
                >

                    <button
                        type="button"
                        class="flex items-center gap-1.5 py-7 text-[13px] font-medium text-gray-700 transition hover:text-[#D7385E]"
                    >
                        Services

                        <svg
                            class="h-4 w-4 transition-transform"
                            :class="{ 'rotate-180': open }"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>


                    <div
                        x-show="open"
                        x-cloak
                        x-transition
                        class="absolute left-1/2 top-full z-50 w-72 -translate-x-1/2 rounded-2xl border border-gray-100 bg-white p-3 shadow-xl"
                    >

                        @forelse ($services as $service)

                            <a
                                href="{{ route('public.listings.index', [
                                    'category' => 'services',
                                    'slug' => $service->slug,
                                ]) }}"
                                class="block rounded-xl px-4 py-3 text-[13px] text-gray-600 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                            >
                                {{ $service->name }}
                            </a>

                        @empty

                            <p class="px-4 py-3 text-[13px] text-gray-400">
                                No services available.
                            </p>

                        @endforelse

                    </div>

                </div>


                {{-- ========================================================
                    EVENTS
                ========================================================= --}}

                <div
                    x-data="{ open: false }"
                    class="relative"
                    @mouseenter="open = true"
                    @mouseleave="open = false"
                >

                    <button
                        type="button"
                        class="flex items-center gap-1.5 py-7 text-[13px] font-medium text-gray-700 transition hover:text-[#D7385E]"
                    >
                        Events

                        {{-- SAME ARROW AS VENUES --}}

                       <svg
    class="h-4 w-4 text-gray-700 transition-transform duration-200"
    :class="{ 'rotate-180': open }"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
>
    <path d="M6 9l6 6 6-6" />
</svg>
                    </button>


                    <div
                        x-show="open"
                        x-cloak
                        x-transition
                        class="absolute left-1/2 top-full z-50 w-64 -translate-x-1/2 rounded-2xl border border-gray-100 bg-white p-3 shadow-xl"
                    >

                        @forelse ($eventTypes as $eventType)

                            <a
                                href="{{ route('public.listings.index', [
                                    'category' => 'events',
                                    'slug' => $eventType->slug,
                                ]) }}"
                                class="block rounded-xl px-4 py-3 text-[13px] text-gray-600 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                            >
                                {{ $eventType->name }}
                            </a>

                        @empty

                            <p class="px-4 py-3 text-[13px] text-gray-400">
                                No event types available.
                            </p>

                        @endforelse

                    </div>

                </div>


                {{-- ========================================================
                    AREAS WE SERVE
                ========================================================= --}}

                <div
                    x-data="{ open: false }"
                    class="relative"
                    @mouseenter="open = true"
                    @mouseleave="open = false"
                >

                    <button
                        type="button"
                        class="flex items-center gap-1.5 py-7 text-[13px] font-medium text-gray-700 transition hover:text-[#D7385E]"
                    >
                        Areas We Serve

                        {{-- SAME ARROW AS VENUES --}}

                       <svg
    class="h-4 w-4 text-gray-700 transition-transform duration-200"
    :class="{ 'rotate-180': open }"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
>
    <path d="M6 9l6 6 6-6" />
</svg>
                    </button>


                    <div
                        x-show="open"
                        x-cloak
                        x-transition
                        class="absolute left-1/2 top-full z-50 w-64 -translate-x-1/2 rounded-2xl border border-gray-100 bg-white p-3 shadow-xl"
                    >

                        @forelse ($cities as $city)

                            <a
                                href="#"
                                class="block rounded-xl px-4 py-3 text-[13px] text-gray-600 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                            >
                                {{ $city->name }}
                            </a>

                        @empty

                            <p class="px-4 py-3 text-[13px] text-gray-400">
                                No cities available.
                            </p>

                        @endforelse

                    </div>

                </div>


                {{-- ========================================================
                    ABOUT US
                ========================================================= --}}

                <a
                    href="#about"
                    class="py-7 text-[13px] font-medium text-gray-700 transition hover:text-[#D7385E]"
                >
                    About Us
                </a>

            </nav>


            {{-- ============================================================
                DESKTOP ACTIONS
            ============================================================= --}}

            <div class="hidden items-center gap-4 lg:flex">

                <a
                    href="{{ url('/login') }}"
                    class="text-[13px] font-medium text-gray-600 transition hover:text-[#D7385E]"
                >
                    Sign In
                </a>

                <a
                    href="{{ url('/vendor/register') }}"
                    class="rounded-full bg-[#D7385E] px-5 py-2.5 text-[13px] font-semibold text-white shadow-sm transition hover:bg-[#B92D4E] hover:shadow-md"
                >
                    List Your Business
                </a>

            </div>


            {{-- ============================================================
                MOBILE MENU BUTTON
            ============================================================= --}}

            <button
                type="button"
                @click="mobileMenu = !mobileMenu"
                class="inline-flex items-center justify-center rounded-xl p-2 text-gray-700 transition hover:bg-[#FBEBEF] hover:text-[#D7385E] lg:hidden"
            >

                <svg
                    x-show="!mobileMenu"
                    class="h-6 w-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg
                    x-show="mobileMenu"
                    x-cloak
                    class="h-6 w-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>

            </button>

        </div>


        {{-- ================================================================
            MOBILE NAVIGATION
        ================================================================= --}}

        <div
            x-show="mobileMenu"
            x-cloak
            x-transition
            class="border-t border-gray-100 py-4 lg:hidden"
        >

            <div class="space-y-1">

                <a
                    href="{{ route('home') }}"
                    class="block rounded-xl px-4 py-3 text-[13px] font-medium text-gray-700 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >
                    Home
                </a>

                <a
                    href="#services"
                    class="block rounded-xl px-4 py-3 text-[13px] font-medium text-gray-700 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >
                    Services
                </a>

                <a
                    href="#events"
                    class="block rounded-xl px-4 py-3 text-[13px] font-medium text-gray-700 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >
                    Events
                </a>

                <a
                    href="#cities"
                    class="block rounded-xl px-4 py-3 text-[13px] font-medium text-gray-700 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >
                    Areas We Serve
                </a>

                <a
                    href="#about"
                    class="block rounded-xl px-4 py-3 text-[13px] font-medium text-gray-700 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >
                    About Us
                </a>

            </div>


            <div class="mt-4 border-t border-gray-100 pt-4">

                <a
                    href="{{ url('/login') }}"
                    class="block rounded-xl px-4 py-3 text-[13px] font-medium text-gray-700 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >
                    Sign In
                </a>

                <a
                    href="{{ url('/vendor/register') }}"
                    class="mt-2 block rounded-xl bg-[#D7385E] px-4 py-3 text-center text-[13px] font-semibold text-white"
                >
                    List Your Business
                </a>

            </div>

        </div>

    </div>
</header>