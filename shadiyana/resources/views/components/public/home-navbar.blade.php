@php
    $weddingVenues = $venueTaxonomies->firstWhere('slug', 'wedding-venues');
@endphp

<header
    x-data="{ mobileMenu: false, mobileSection: 'venues' }"
    x-effect="document.documentElement.style.overflow = mobileMenu ? 'hidden' : ''"
    @keydown.escape.window="mobileMenu = false"
    class="sticky top-0 z-50 border-b border-gray-100 bg-white/95 backdrop-blur-xl"
>
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between">

            {{-- ============================================================
                LOGO
            ============================================================= --}}

            <a
                href="{{ route('home') }}"
                class="group flex items-center gap-2"
            >
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#D7385E] text-sm font-bold text-white">
                    S
                </span>

                <span class="text-lg font-bold tracking-tight text-[#132743]">
                    Shadiyana
                </span>
            </a>


            {{-- ============================================================
                DESKTOP NAVIGATION
            ============================================================= --}}

            <nav class="hidden items-center gap-1 lg:flex">

{{-- ========================================================
    VENUES
========================================================= --}}

<div
    x-data="{ open: false }"
    class="group relative"
    @mouseenter="open = true"
    @mouseleave="open = false"
>

    <button
        type="button"
        class="relative flex items-center gap-1 rounded-lg px-3 py-2 text-[13px] font-medium text-gray-700 transition-colors hover:text-[#D7385E]"
    >

        Venues

        <svg
            class="h-3.5 w-3.5 transition-transform duration-200"
            :class="{ 'rotate-180': open }"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M6 9l6 6 6-6"/>
        </svg>

        <span
            class="pointer-events-none absolute inset-x-3 -bottom-px h-[2px] scale-x-0 rounded-full bg-[#D7385E] transition-transform duration-200 group-hover:scale-x-100"
        ></span>

    </button>


    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute left-1/2 top-[calc(100%+10px)] z-50 w-60 -translate-x-1/2 rounded-xl border border-gray-100 bg-white p-2 shadow-lg shadow-gray-900/5"
    >

        <span class="absolute -top-1.5 left-1/2 h-3 w-3 -translate-x-1/2 rotate-45 border-l border-t border-gray-100 bg-white"></span>

        @if($weddingVenues)

            <div>

                <a
                    href="{{ route('public.listings.index', [
                        'category' => 'wedding-venues',
                    ]) }}"
                    class="flex items-center justify-between rounded-lg px-3 py-2.5 text-[13px] font-semibold text-gray-800 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >

                    <span>
                        {{ $weddingVenues->name }}
                    </span>

                    @if($weddingVenues->children->isNotEmpty())

                        <svg
                            class="h-3.5 w-3.5 text-gray-400"
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

                @if($weddingVenues->children->isNotEmpty())

                    <div class="ml-2.5 space-y-0.5 border-l border-gray-100 pl-2">

                        @foreach($weddingVenues->children as $child)

                            <a
                                href="{{ route('public.listings.index', [
                                    'category' => 'wedding-venues',
                                    'slug' => $child->slug,
                                ]) }}"
                                class="block rounded-lg px-2.5 py-1.5 text-[12.5px] text-gray-500 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                            >
                                {{ $child->name }}
                            </a>

                        @endforeach

                    </div>

                @endif

            </div>

        @else

            <p class="px-3 py-2.5 text-[13px] text-gray-400">
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
                    class="group relative"
                    @mouseenter="open = true"
                    @mouseleave="open = false"
                >

                    <button
                        type="button"
                        class="relative flex items-center gap-1 rounded-lg px-3 py-2 text-[13px] font-medium text-gray-700 transition-colors hover:text-[#D7385E]"
                    >
                        Services

                        <svg
                            class="h-3.5 w-3.5 transition-transform"
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

                        <span
                            class="pointer-events-none absolute inset-x-3 -bottom-px h-[2px] scale-x-0 rounded-full bg-[#D7385E] transition-transform duration-200 group-hover:scale-x-100"
                        ></span>
                    </button>


                    <div
                        x-show="open"
                        x-cloak
                        x-transition
                        class="absolute left-1/2 top-[calc(100%+10px)] z-50 w-56 -translate-x-1/2 rounded-xl border border-gray-100 bg-white p-2 shadow-lg shadow-gray-900/5"
                    >

                        <span class="absolute -top-1.5 left-1/2 h-3 w-3 -translate-x-1/2 rotate-45 border-l border-t border-gray-100 bg-white"></span>

                        <div class="max-h-[320px] space-y-0.5 overflow-y-auto [scrollbar-width:thin]">

                            @forelse ($services as $service)

                                <a
                                    href="{{ route('public.listings.index', [
                                        'category' => 'services',
                                        'slug' => $service->slug,
                                    ]) }}"
                                    class="block rounded-lg px-3 py-2 text-[12.5px] text-gray-600 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                >
                                    {{ $service->name }}
                                </a>

                            @empty

                                <p class="px-3 py-2.5 text-[13px] text-gray-400">
                                    No services available.
                                </p>

                            @endforelse

                        </div>

                    </div>

                </div>

{{-- ========================================================
    EVENTS
========================================================= --}}

<div
    x-data="{ open: false }"
    class="group relative"
    @mouseenter="open = true"
    @mouseleave="open = false"
>

    <button
        type="button"
        class="relative flex items-center gap-1 rounded-lg px-3 py-2 text-[13px] font-medium text-gray-700 transition-colors hover:text-[#D7385E]"
    >

        Events

        <svg
            class="h-3.5 w-3.5 transition-transform duration-200"
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

        <span
            class="pointer-events-none absolute inset-x-3 -bottom-px h-[2px] scale-x-0 rounded-full bg-[#D7385E] transition-transform duration-200 group-hover:scale-x-100"
        ></span>

    </button>


    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute left-1/2 top-[calc(100%+10px)] z-50 w-56 -translate-x-1/2 rounded-xl border border-gray-100 bg-white p-2 shadow-lg shadow-gray-900/5"
    >

        <span class="absolute -top-1.5 left-1/2 h-3 w-3 -translate-x-1/2 rotate-45 border-l border-t border-gray-100 bg-white"></span>

        <div class="max-h-[280px] space-y-0.5 overflow-y-auto [scrollbar-width:thin]">

            @forelse ($eventTypes as $eventType)

                <a
                    href="{{ route('events.show', [
                        'slug' => $eventType->slug,
                    ]) }}"
                    class="group/item flex items-center justify-between rounded-lg px-3 py-2 text-[12.5px] text-gray-600 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >

                    <span>
                        {{ $eventType->name }}
                    </span>

                    <svg
                        class="h-3.5 w-3.5 -translate-x-1 text-gray-300 opacity-0 transition-all duration-200 group-hover/item:translate-x-0 group-hover/item:text-[#D7385E] group-hover/item:opacity-100"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>

                </a>

            @empty

                <p class="px-3 py-2.5 text-[13px] text-gray-400">
                    No event types available.
                </p>

            @endforelse

        </div>


        <div class="my-1.5 border-t border-gray-100"></div>

        <a
            href="{{ url('/events') }}"
            class="group/item flex items-center justify-between rounded-lg px-3 py-2 text-[12.5px] font-semibold text-[#D7385E] transition hover:bg-[#FBEBEF]"
        >

            <span>
                View All Events
            </span>

            <svg
                class="h-3.5 w-3.5 text-[#D7385E] transition-transform duration-200 group-hover/item:translate-x-0.5"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M5 12h14M13 6l6 6-6 6"/>
            </svg>

        </a>

    </div>

</div>

                {{-- ========================================================
                    AREAS WE SERVE
                ========================================================= --}}

                <div
                    x-data="{ open: false }"
                    class="group relative"
                    @mouseenter="open = true"
                    @mouseleave="open = false"
                >

                    <button
                        type="button"
                        class="relative flex items-center gap-1 rounded-lg px-3 py-2 text-[13px] font-medium text-gray-700 transition-colors hover:text-[#D7385E]"
                    >
                        Areas We Serve

                       <svg
    class="h-3.5 w-3.5 text-gray-700 transition-transform duration-200"
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

                        <span
                            class="pointer-events-none absolute inset-x-3 -bottom-px h-[2px] scale-x-0 rounded-full bg-[#D7385E] transition-transform duration-200 group-hover:scale-x-100"
                        ></span>
                    </button>


                    <div
                        x-show="open"
                        x-cloak
                        x-transition
                        class="absolute left-1/2 top-[calc(100%+10px)] z-50 w-48 -translate-x-1/2 rounded-xl border border-gray-100 bg-white p-2 shadow-lg shadow-gray-900/5"
                    >

                        <span class="absolute -top-1.5 left-1/2 h-3 w-3 -translate-x-1/2 rotate-45 border-l border-t border-gray-100 bg-white"></span>

                        <div class="max-h-[280px] space-y-0.5 overflow-y-auto [scrollbar-width:thin]">

@forelse ($cities as $city)

<a
    href="{{ route('public.listings.index', [
        'city' => $city->id,
    ]) }}"
    class="block rounded-lg px-3 py-2 text-[12.5px] text-gray-600 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
>
    {{ $city->name }}
</a>

@empty

                            <p class="px-3 py-2.5 text-[13px] text-gray-400">
                                No cities available.
                            </p>

                        @endforelse

                        </div>

                    </div>

                </div>


                {{-- ========================================================
                    ABOUT US
                ========================================================= --}}

                <a
                    href="#about"
                    class="relative rounded-lg px-3 py-2 text-[13px] font-medium text-gray-700 transition-colors hover:text-[#D7385E]"
                >
                    About Us
                </a>

            </nav>


            {{-- ============================================================
                DESKTOP ACTIONS
            ============================================================= --}}

            <div class="hidden items-center gap-3 lg:flex">

                <a
                    href="{{ url('/login') }}"
                    class="rounded-lg px-3 py-2 text-[13px] font-medium text-gray-600 transition hover:bg-gray-50 hover:text-[#D7385E]"
                >
                    Sign In
                </a>

                <a
                    href="{{ url('/vendor/register') }}"
                    class="rounded-full bg-[#D7385E] px-4 py-2 text-[13px] font-semibold text-white shadow-sm transition hover:bg-[#B92D4E] hover:shadow-md"
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
                class="inline-flex items-center justify-center rounded-lg p-2 text-gray-700 transition hover:bg-[#FBEBEF] hover:text-[#D7385E] lg:hidden"
            >

                <svg
                    x-show="!mobileMenu"
                    class="h-5 w-5"
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
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>

            </button>

        </div>

    </div>


    {{-- ====================================================================
        MOBILE NAVIGATION — FULL-SCREEN ACCORDION PANEL
        Teleported to <body> so it is never clipped/mispositioned by the
        header's `backdrop-blur-xl` (filter creates a containing block for
        `position: fixed` descendants — this escapes that trap entirely).
    ===================================================================== --}}

    <template x-teleport="body">

    <div
        x-show="mobileMenu"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] lg:hidden"
    >

        {{-- Backdrop --}}
        <div
            class="absolute inset-0 bg-black/30"
            @click="mobileMenu = false"
        ></div>

        {{-- Sliding panel --}}
        <div
            x-show="mobileMenu"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="absolute inset-y-0 left-0 flex w-[88%] max-w-sm flex-col overflow-y-auto bg-white shadow-xl"
        >

            {{-- Close button --}}
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">

                <span class="text-sm font-semibold text-gray-400">
                    Menu
                </span>

                <button
                    type="button"
                    @click="mobileMenu = false"
                    class="rounded-lg p-1.5 text-gray-500 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <path d="M6 6l12 12M18 6L6 18"/>
                    </svg>
                </button>

            </div>

            <div class="flex-1 px-3 py-2">

                {{-- ==================================================
                    VENUES ACCORDION
                =================================================== --}}

                <div class="border-b border-gray-100">

                    <button
                        type="button"
                        @click="mobileSection = (mobileSection === 'venues' ? null : 'venues')"
                        class="flex w-full items-center justify-between px-3 py-3.5 text-left text-[15px] font-semibold text-gray-800"
                    >
                        Venues

                        <svg
                            class="h-4 w-4 text-gray-500 transition-transform duration-200"
                            :class="{ 'rotate-180': mobileSection === 'venues' }"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                        >
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>

                    <div
                        class="grid transition-[grid-template-rows] duration-300 ease-in-out"
                        :class="mobileSection === 'venues' ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
                    >
                        <div class="overflow-hidden">
                            <div class="pb-3">
                                @if($weddingVenues && $weddingVenues->children->isNotEmpty())

                                    @foreach($weddingVenues->children as $child)

                                        <a
                                            href="{{ route('public.listings.index', [
                                                'category' => 'wedding-venues',
                                                'slug' => $child->slug,
                                            ]) }}"
                                            @click="mobileMenu = false"
                                            class="block rounded-lg px-6 py-2.5 text-[13.5px] text-gray-500 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                        >
                                            {{ $child->name }}
                                        </a>

                                    @endforeach

                                @else

                                    <p class="px-6 py-2 text-[13px] text-gray-400">
                                        No venue categories available.
                                    </p>

                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ==================================================
                    SERVICES ACCORDION
                =================================================== --}}

                <div class="border-b border-gray-100">

                    <button
                        type="button"
                        @click="mobileSection = (mobileSection === 'services' ? null : 'services')"
                        class="flex w-full items-center justify-between px-3 py-3.5 text-left text-[15px] font-semibold text-gray-800"
                    >
                        Services

                        <svg
                            class="h-4 w-4 text-gray-500 transition-transform duration-200"
                            :class="{ 'rotate-180': mobileSection === 'services' }"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                        >
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>

                    <div
                        class="grid transition-[grid-template-rows] duration-300 ease-in-out"
                        :class="mobileSection === 'services' ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
                    >
                        <div class="overflow-hidden">
                            <div class="pb-3">
                                @forelse ($services as $service)

                                    <a
                                        href="{{ route('public.listings.index', [
                                            'category' => 'services',
                                            'slug' => $service->slug,
                                        ]) }}"
                                        @click="mobileMenu = false"
                                        class="block rounded-lg px-6 py-2.5 text-[13.5px] text-gray-500 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                    >
                                        {{ $service->name }}
                                    </a>

                                @empty

                                    <p class="px-6 py-2 text-[13px] text-gray-400">
                                        No services available.
                                    </p>

                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ==================================================
                    EVENTS ACCORDION
                =================================================== --}}

                <div class="border-b border-gray-100">

                    <button
                        type="button"
                        @click="mobileSection = (mobileSection === 'events' ? null : 'events')"
                        class="flex w-full items-center justify-between px-3 py-3.5 text-left text-[15px] font-semibold text-gray-800"
                    >
                        Events

                        <svg
                            class="h-4 w-4 text-gray-500 transition-transform duration-200"
                            :class="{ 'rotate-180': mobileSection === 'events' }"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                        >
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>

                    <div
                        class="grid transition-[grid-template-rows] duration-300 ease-in-out"
                        :class="mobileSection === 'events' ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
                    >
                        <div class="overflow-hidden">
                            <div class="pb-3">
                                @forelse ($eventTypes as $eventType)

                                    <a
                                        href="{{ route('events.show', [
                                            'slug' => $eventType->slug,
                                        ]) }}"
                                        @click="mobileMenu = false"
                                        class="block rounded-lg px-6 py-2.5 text-[13.5px] text-gray-500 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                    >
                                        {{ $eventType->name }}
                                    </a>

                                @empty

                                    <p class="px-6 py-2 text-[13px] text-gray-400">
                                        No event types available.
                                    </p>

                                @endforelse

                                <a
                                    href="{{ url('/events') }}"
                                    @click="mobileMenu = false"
                                    class="mt-1 block rounded-lg px-6 py-2.5 text-[13.5px] font-semibold text-[#D7385E] transition hover:bg-[#FBEBEF]"
                                >
                                    View All Events
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ==================================================
                    AREAS WE SERVE ACCORDION
                =================================================== --}}

                <div class="border-b border-gray-100">

                    <button
                        type="button"
                        @click="mobileSection = (mobileSection === 'areas' ? null : 'areas')"
                        class="flex w-full items-center justify-between px-3 py-3.5 text-left text-[15px] font-semibold text-gray-800"
                    >
                        Areas We Serve

                        <svg
                            class="h-4 w-4 text-gray-500 transition-transform duration-200"
                            :class="{ 'rotate-180': mobileSection === 'areas' }"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                        >
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>

                    <div
                        class="grid transition-[grid-template-rows] duration-300 ease-in-out"
                        :class="mobileSection === 'areas' ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
                    >
                        <div class="overflow-hidden">
                            <div class="pb-3">
                                @forelse ($cities as $city)

                                    <a
                                        href="{{ route('public.listings.index', [
                                            'city' => $city->id,
                                        ]) }}"
                                        @click="mobileMenu = false"
                                        class="block rounded-lg px-6 py-2.5 text-[13.5px] text-gray-500 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                    >
                                        {{ $city->name }}
                                    </a>

                                @empty

                                    <p class="px-6 py-2 text-[13px] text-gray-400">
                                        No cities available.
                                    </p>

                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ==================================================
                    ABOUT US (plain link, no accordion)
                =================================================== --}}

                <a
                    href="#about"
                    @click="mobileMenu = false"
                    class="block px-3 py-3.5 text-[15px] font-semibold text-gray-800 border-b border-gray-100"
                >
                    About Us
                </a>

            </div>

            {{-- Bottom actions --}}
            <div class="border-t border-gray-100 px-5 py-4">

                <a
                    href="{{ url('/login') }}"
                    @click="mobileMenu = false"
                    class="block rounded-lg px-3.5 py-2.5 text-center text-[13px] font-medium text-gray-700 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                >
                    Sign In
                </a>

                <a
                    href="{{ url('/vendor/register') }}"
                    @click="mobileMenu = false"
                    class="mt-2 block rounded-full bg-[#D7385E] px-3.5 py-2.5 text-center text-[13px] font-semibold text-white shadow-sm"
                >
                    List Your Business
                </a>

            </div>

        </div>

    </div>

    </template>

</header>