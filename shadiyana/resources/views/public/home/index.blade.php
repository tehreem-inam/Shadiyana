@extends('layouts.public')

@section('title', 'Shadiyana — Plan Your Perfect Wedding')

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
    HERO / SEARCH
    Single background image version
============================================================= --}}
<section
    class="relative z-30 overflow-visible bg-transparent bg-cover bg-center bg-no-repeat py-10 md:py-14 lg:py-16"
    style="background-image: url('{{ asset('images/home/home-section.png') }}');"
    x-data="{
        tab: 'cityService',

        serviceOpen: false,
        cityOpen: false,

        service: '',
        serviceLabel: 'Select Service',

        city: '',
        cityLabel: 'Select City',
    }"
>

    {{-- ========================================================
        SOFT BACKGROUND OVERLAY
        Keeps the search UI and text readable over the image.
    ========================================================= --}}
    <div
        class="pointer-events-none absolute inset-0 z-0 bg-gradient-to-b from-white/10 via-transparent to-white/40"
        aria-hidden="true"
    ></div>


    {{-- ========================================================
        CONTENT
    ========================================================= --}}
    <div class="relative z-20 mx-auto max-w-[760px] px-5 sm:px-6">

        {{-- ====================================================
            HEADING
        ===================================================== --}}
        <h1
            class="mb-4 text-center text-[22px] font-semibold leading-tight tracking-tight text-[#132743] sm:text-[28px] md:mb-5 md:text-[32px]"
        >
            Plan your
            <span class="text-[#D7385E]">Shadi</span>
            in 3 minutes
        </h1>


        {{-- ====================================================
            SEARCH CARD
        ===================================================== --}}
        <div
    class="relative z-50 rounded-[22px] border border-white/70 bg-white/90 px-4 pb-4 pt-4 shadow-[0_14px_36px_rgba(19,39,67,0.14)] backdrop-blur-md sm:px-6 md:px-7 md:pb-5 md:pt-5"
>

            {{-- ==================================================
                TABS
            =================================================== --}}
            <div
                class="mb-3 flex justify-center gap-6 border-b border-[#EDEDED]"
            >

                {{-- Service & City --}}
                <button
                    type="button"
                    @click="
                        tab = 'cityService';
                        serviceOpen = false;
                        cityOpen = false;
                    "
                    class="relative pb-2 text-[13px] font-semibold transition-colors md:text-[14px]"
                    :class="
                        tab === 'cityService'
                            ? 'text-[#132743]'
                            : 'text-[#9AA3AC]'
                    "
                >
                    Service &amp; City

                    <span
                        class="absolute -bottom-px left-0 h-[2px] w-full rounded-full bg-[#D7385E] transition-opacity"
                        :class="
                            tab === 'cityService'
                                ? 'opacity-100'
                                : 'opacity-0'
                        "
                    ></span>
                </button>


                {{-- Search By Name --}}
                <button
                    type="button"
                    @click="
                        tab = 'name';
                        serviceOpen = false;
                        cityOpen = false;
                    "
                    class="relative pb-2 text-[13px] font-semibold transition-colors md:text-[14px]"
                    :class="
                        tab === 'name'
                            ? 'text-[#132743]'
                            : 'text-[#9AA3AC]'
                    "
                >
                    Search By Name

                    <span
                        class="absolute -bottom-px left-0 h-[2px] w-full rounded-full bg-[#D7385E] transition-opacity"
                        :class="
                            tab === 'name'
                                ? 'opacity-100'
                                : 'opacity-0'
                        "
                    ></span>
                </button>

            </div>


            {{-- ==================================================
                SERVICE & CITY FORM
            =================================================== --}}
            <form
                x-show="tab === 'cityService'"
                action="{{ route('public.listings.index') }}"
                method="GET"
            >

                <div
                    class="relative flex flex-col overflow-visible rounded-[16px] border border-[#ECECEC] bg-white md:flex-row md:items-stretch md:rounded-full"
                >

                    {{-- ==================================================
                        SERVICE DROPDOWN
                    =================================================== --}}
                    <div
                        class="relative flex-1"
                        @click.outside="serviceOpen = false"
                    >

                        {{-- Service Trigger --}}
                        <button
                            type="button"
                            @click="
                                serviceOpen = !serviceOpen;
                                cityOpen = false;
                            "
                            class="flex h-11 w-full items-center justify-between px-4 text-[14px] transition-colors md:h-12 md:px-5"
                            :class="
                                service
                                    ? 'text-[#132743]'
                                    : 'text-[rgba(68,68,68,0.6)]'
                            "
                        >

                            <div class="flex min-w-0 items-center gap-2.5">

                                {{-- Service Icon --}}
                                <span
                                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]"
                                >
                                    <svg
                                        class="h-[14px] w-[14px]"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="8"
                                        />
                                        <path d="M12 8v8"/>
                                        <path d="M8 12h8"/>
                                    </svg>
                                </span>

                                <span
                                    class="truncate"
                                    x-text="serviceLabel"
                                ></span>

                            </div>


                            {{-- Arrow --}}
                            <svg
                                class="h-3.5 w-3.5 shrink-0 text-[#6B7983] transition-transform duration-200"
                                :class="serviceOpen && 'rotate-180'"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="m6 9 6 6 6-6"/>
                            </svg>

                        </button>


                        {{-- Hidden Value --}}
                        <input
                            type="hidden"
                            name="service"
                            :value="service"
                        >


                        {{-- ==================================================
                            SERVICES DROPDOWN PANEL
                        =================================================== --}}
                        <div
                            x-show="serviceOpen"
                            x-cloak
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute left-0 top-[calc(100%+10px)] z-[9999] w-[min(78vw,264px)] overflow-hidden rounded-[16px] border border-[#ECECEC] bg-white shadow-[0_16px_36px_rgba(19,39,67,0.14)]"
                        >

                            @if($services->count())

                                {{-- Dropdown Header --}}
                                <div
                                    class="flex items-center justify-between gap-2 border-b border-[#F1F1F1] bg-white px-3.5 py-2.5"
                                >

                                    <div class="min-w-0">

                                        <h3
                                            class="text-[13px] font-bold text-[#132743]"
                                        >
                                            Choose a service
                                        </h3>

                                        <p
                                            class="mt-0.5 truncate text-[11px] text-[#89939D]"
                                        >
                                            {{ $services->count() }} {{ Str::plural('option', $services->count()) }} available
                                        </p>

                                    </div>

                                    <span
                                        class="shrink-0 rounded-full bg-[#FBEBEF] px-2 py-0.5 text-[11px] font-bold text-[#D7385E]"
                                    >
                                        {{ $services->count() }}
                                    </span>

                                </div>


                                {{-- Dropdown Items --}}
                                <div
                                    class="max-h-[264px] overflow-y-auto p-1.5 [scrollbar-width:thin]"
                                >

                                    <div
                                        class="space-y-0.5"
                                    >

                                        @foreach($services as $serviceItem)

                                            <button
                                                type="button"
                                                @click="
                                                    service = @js($serviceItem->slug);
                                                    serviceLabel = @js($serviceItem->name);
                                                    serviceOpen = false;
                                                "
                                                class="group relative flex w-full items-center gap-2 rounded-lg py-2 pl-3 pr-2 text-left transition-colors duration-150 hover:bg-[#FBEBEF]"
                                                :class="
                                                    service === @js($serviceItem->slug)
                                                        ? 'bg-[#FBEBEF]'
                                                        : ''
                                                "
                                            >

                                                {{-- Selected accent --}}
                                                <span
                                                    x-show="service === @js($serviceItem->slug)"
                                                    x-cloak
                                                    class="absolute inset-y-1.5 left-0 w-[3px] rounded-full bg-[#D7385E]"
                                                ></span>

                                                {{-- Icon --}}
                                                <span
                                                    class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E] transition-colors duration-150 group-hover:bg-[#D7385E] group-hover:text-white"
                                                    :class="
                                                        service === @js($serviceItem->slug)
                                                            ? 'bg-[#D7385E] text-white'
                                                            : ''
                                                    "
                                                >
                                                    <svg
                                                        class="h-[11px] w-[11px]"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    >
                                                        <circle
                                                            cx="12"
                                                            cy="12"
                                                            r="8"
                                                        />
                                                        <path d="M12 8v8"/>
                                                        <path d="M8 12h8"/>
                                                    </svg>
                                                </span>


                                                {{-- Name --}}
                                                <span
                                                    class="min-w-0 flex-1 truncate text-[12.5px] font-medium text-[#242424] transition-colors group-hover:text-[#D7385E]"
                                                >
                                                    {{ $serviceItem->name }}
                                                </span>


                                                {{-- Selected Check --}}
                                                <svg
                                                    x-show="service === @js($serviceItem->slug)"
                                                    x-cloak
                                                    class="h-3.5 w-3.5 shrink-0 text-[#D7385E]"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                >
                                                    <path d="m5 12 4 4L19 6"/>
                                                </svg>

                                            </button>

                                        @endforeach

                                    </div>

                                </div>

                            @else

                                {{-- Empty State --}}
                                <div class="px-5 py-7 text-center">

                                    <div
                                        class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]"
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <path d="M12 3v18"/>
                                            <path d="M3 12h18"/>
                                        </svg>
                                    </div>

                                    <p
                                        class="mt-2 text-sm font-semibold text-[#132743]"
                                    >
                                        No services available
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Please check back later.
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- Divider --}}
                    <div
                        class="mx-4 h-px bg-[#ECECEC] md:my-3 md:mx-0 md:h-auto md:w-px"
                    ></div>


                    {{-- ==================================================
                        CITY DROPDOWN
                    =================================================== --}}
                    <div
                        class="relative flex-1"
                        @click.outside="cityOpen = false"
                    >

                        {{-- City Trigger --}}
                        <button
                            type="button"
                            @click="
                                cityOpen = !cityOpen;
                                serviceOpen = false;
                            "
                            class="flex h-11 w-full items-center justify-between px-4 text-[14px] transition-colors md:h-12 md:px-5"
                            :class="
                                city
                                    ? 'text-[#132743]'
                                    : 'text-[rgba(68,68,68,0.6)]'
                            "
                        >

                            <div class="flex min-w-0 items-center gap-2.5">

                                {{-- Location Icon --}}
                                <span
                                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]"
                                >
                                    <svg
                                        class="h-[14px] w-[14px]"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1116 0z"
                                        />
                                        <circle
                                            cx="12"
                                            cy="10"
                                            r="2.5"
                                        />
                                    </svg>
                                </span>

                                <span
                                    class="truncate"
                                    x-text="cityLabel"
                                ></span>

                            </div>


                            {{-- Arrow --}}
                            <svg
                                class="h-3.5 w-3.5 shrink-0 text-[#6B7983] transition-transform duration-200"
                                :class="cityOpen && 'rotate-180'"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="m6 9 6 6 6-6"/>
                            </svg>

                        </button>


                        {{-- Hidden Value --}}
                        <input
                            type="hidden"
                            name="city"
                            :value="city"
                        >


                        {{-- ==================================================
                            CITIES DROPDOWN PANEL
                        =================================================== --}}
                        <div
                            x-show="cityOpen"
                            x-cloak
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute left-0 top-[calc(100%+10px)] z-[9999] w-[min(78vw,220px)] overflow-hidden rounded-[16px] border border-[#ECECEC] bg-white shadow-[0_16px_36px_rgba(19,39,67,0.14)] md:left-auto md:right-0"
                        >

                            @if($cities->count())

                                {{-- Dropdown Header --}}
                                <div
                                    class="flex items-center justify-between gap-2 border-b border-[#F1F1F1] bg-white px-3.5 py-2.5"
                                >

                                    <div class="min-w-0">

                                        <h3
                                            class="text-[13px] font-bold text-[#132743]"
                                        >
                                            Choose a city
                                        </h3>

                                        <p
                                            class="mt-0.5 truncate text-[11px] text-[#89939D]"
                                        >
                                            Vendors near you
                                        </p>

                                    </div>

                                    <span
                                        class="shrink-0 rounded-full bg-[#FBEBEF] px-2 py-0.5 text-[11px] font-bold text-[#D7385E]"
                                    >
                                        {{ $cities->count() }}
                                    </span>

                                </div>


                                {{-- City Items --}}
                                <div class="max-h-[264px] overflow-y-auto p-1.5 [scrollbar-width:thin]">

                                    <div class="grid grid-cols-1 gap-0.5">

                                        @foreach($cities as $cityItem)

                                            <button
                                                type="button"
                                                @click="
                                                    city = @js($cityItem->slug);
                                                    cityLabel = @js($cityItem->name);
                                                    cityOpen = false;
                                                "
                                                class="group relative flex w-full items-center gap-2 rounded-lg py-2 pl-3 pr-2 text-left transition-colors duration-150 hover:bg-[#FBEBEF]"
                                                :class="
                                                    city === @js($cityItem->slug)
                                                        ? 'bg-[#FBEBEF]'
                                                        : ''
                                                "
                                            >

                                                {{-- Selected accent --}}
                                                <span
                                                    x-show="city === @js($cityItem->slug)"
                                                    x-cloak
                                                    class="absolute inset-y-1.5 left-0 w-[3px] rounded-full bg-[#D7385E]"
                                                ></span>

                                                {{-- Location Icon --}}
                                                <span
                                                    class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#FBEBEF] text-[#132743] transition-colors duration-150 group-hover:bg-[#D7385E] group-hover:text-white"
                                                    :class="
                                                        city === @js($cityItem->slug)
                                                            ? 'bg-[#D7385E] text-white'
                                                            : ''
                                                    "
                                                >
                                                    <svg
                                                        class="h-[11px] w-[11px]"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    >
                                                        <path
                                                            d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1116 0z"
                                                        />
                                                        <circle
                                                            cx="12"
                                                            cy="10"
                                                            r="2.5"
                                                        />
                                                    </svg>
                                                </span>


                                                {{-- City Name --}}
                                                <span
                                                    class="min-w-0 flex-1 truncate text-[12.5px] font-medium text-[#242424] transition-colors group-hover:text-[#D7385E]"
                                                >
                                                    {{ $cityItem->name }}
                                                </span>


                                                {{-- Selected Check --}}
                                                <svg
                                                    x-show="city === @js($cityItem->slug)"
                                                    x-cloak
                                                    class="h-3.5 w-3.5 shrink-0 text-[#D7385E]"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                >
                                                    <path d="m5 12 4 4L19 6"/>
                                                </svg>

                                            </button>

                                        @endforeach

                                    </div>

                                </div>

                            @else

                                {{-- Empty State --}}
                                <div class="px-5 py-7 text-center">

                                    <div
                                        class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]"
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <path
                                                d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1116 0z"
                                            />
                                            <circle
                                                cx="12"
                                                cy="10"
                                                r="2.5"
                                            />
                                        </svg>
                                    </div>

                                    <p
                                        class="mt-2 text-sm font-semibold text-[#132743]"
                                    >
                                        No cities available
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Please check back later.
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- ==================================================
                        SEARCH BUTTON
                    =================================================== --}}
                    <div class="flex items-center justify-center p-1.5">

                        <button
                            type="submit"
                            :disabled="!service && !city"
                            class="flex h-10 w-full items-center justify-center gap-2 rounded-full px-6 text-[14px] font-semibold text-white transition-all duration-200 md:h-9 md:w-32"
                            :class="
                                (!service && !city)
                                    ? 'cursor-not-allowed bg-[#E9A0B6] opacity-80'
                                    : 'bg-[#D7385E] hover:bg-[#C22C50] hover:shadow-lg'
                            "
                        >

                            {{-- Search Icon --}}
                            <svg
                                class="h-[14px] w-[14px] shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <circle
                                    cx="11"
                                    cy="11"
                                    r="7"
                                />
                                <path d="m20 20-4-4"/>
                            </svg>

                            <span>Search</span>

                        </button>

                    </div>

                </div>

            </form>


            {{-- ==================================================
                SEARCH BY NAME FORM
            =================================================== --}}
            <form
                x-show="tab === 'name'"
                x-cloak
                action="{{ route('public.listings.index') }}"
                method="GET"
            >

                <div
                    class="flex flex-col overflow-hidden rounded-[16px] border border-[#ECECEC] md:h-12 md:flex-row md:items-stretch md:rounded-full"
                >

                    <input
                        type="text"
                        name="q"
                        placeholder="Search a vendor or business name"
                        class="h-11 flex-1 border-0 bg-transparent px-4 text-[14px] text-[#242424] outline-none placeholder:text-[rgba(68,68,68,0.6)] md:h-full md:px-5"
                    >


                    <div class="flex items-center justify-center p-1.5">

                        <button
                            type="submit"
                            class="flex h-10 w-full items-center justify-center gap-2 rounded-full bg-[#D7385E] px-6 text-[14px] font-semibold text-white transition duration-200 hover:bg-[#C22C50] hover:shadow-lg md:h-9 md:w-32"
                        >

                            <svg
                                class="h-[14px] w-[14px] shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <circle
                                    cx="11"
                                    cy="11"
                                    r="7"
                                />
                                <path d="m20 20-4-4"/>
                            </svg>

                            <span>Search</span>

                        </button>

                    </div>

                </div>

            </form>

        </div>


        {{-- ====================================================
            POPULAR SEARCHES
        ===================================================== --}}
        <div
            class="mt-3 flex flex-wrap items-center justify-center gap-x-2.5 gap-y-1.5 text-center md:mt-4"
        >

            <span class="text-[13px] font-semibold text-[#111111]">
                Popular Searches :
            </span>


            <a
                href="{{ route('public.listings.index', [
                    'category' => 'wedding-venues',
                    'slug' => 'lahore'
                ]) }}"
                class="text-[13px] font-medium text-[#D7385E] underline-offset-2 transition hover:underline"
            >
                Wedding Venues Lahore
            </a>


            <a
                href="{{ route('public.listings.index', [
                    'category' => 'wedding-venues',
                    'slug' => 'islamabad'
                ]) }}"
                class="text-[13px] font-medium text-[#D7385E] underline-offset-2 transition hover:underline"
            >
                Wedding Venues Islamabad
            </a>


            <a
                href="{{ route('public.listings.index', [
                    'category' => 'wedding-venues',
                    'slug' => 'karachi'
                ]) }}"
                class="text-[13px] font-medium text-[#D7385E] underline-offset-2 transition hover:underline"
            >
                Wedding Venues Karachi
            </a>

        </div>

    </div>

</section>

{{-- ============================================================
    SERVICES
============================================================= --}}
<section
    id="services"
    class="relative z-0 w-full bg-white py-10 lg:py-14"
>

    {{-- Header --}}
    <div class="mx-auto mb-6 max-w-2xl px-5 text-center lg:mb-8">

        <h2
            class="text-2xl font-bold tracking-tight text-[#12365C] sm:text-3xl lg:text-[32px]"
        >
            Find every wedding service
        </h2>

        <p class="mt-2 text-sm leading-6 text-[#5B6B7A] sm:text-base">
            From venues to vendors, everything you need is a search away.
        </p>

    </div>


    @if ($services->isNotEmpty())

        @php
            $palette = [
                ['bg' => 'rgba(255, 199, 120, 0.3)', 'deco' => 'rgb(254, 245, 230)'],
                ['bg' => 'rgb(255, 231, 211)', 'deco' => 'rgb(255, 241, 229)'],
                ['bg' => 'rgba(255, 27, 32, 0.15)', 'deco' => 'rgb(255, 234, 235)'],
                ['bg' => 'rgb(255, 218, 198)', 'deco' => 'rgb(255, 232, 222)'],
                ['bg' => 'rgb(255, 211, 186)', 'deco' => 'rgb(255, 228, 214)'],
                ['bg' => 'rgb(255, 218, 198)', 'deco' => 'rgb(255, 232, 222)'],
                ['bg' => 'rgb(255, 226, 196)', 'deco' => 'rgb(255, 238, 220)'],
                ['bg' => 'rgb(255, 210, 204)', 'deco' => 'rgb(255, 228, 224)'],
            ];
        @endphp


        <div class="mx-auto grid max-w-6xl grid-cols-2 gap-3 px-5 sm:grid-cols-3 md:px-8 lg:grid-cols-4 lg:gap-4 lg:px-12 xl:grid-cols-8">

            @foreach ($services->take(8) as $service)

                @php
                    $tone = $palette[$loop->index % count($palette)];
                @endphp

                <a
                    href="{{ url('/listings?category=services&slug=' . $service->slug) }}"
                    class="group relative flex h-16 w-full items-center justify-between overflow-hidden rounded-2xl pl-3 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md lg:h-[76px]"
                    style="background-color: {{ $tone['bg'] }};"
                >

                    {{-- Decorative Circle --}}
                    <div
                        class="pointer-events-none absolute -left-[35px] -top-[35px] h-12 w-20 rounded-full"
                        style="background-color: {{ $tone['deco'] }};"
                    ></div>


                    {{-- Decorative Corner --}}
                    <div
                        class="pointer-events-none absolute right-0 top-0 h-12 w-12 rounded-bl-full"
                        style="background-color: {{ $tone['deco'] }};"
                    ></div>


                    {{-- Label --}}
                    <div class="relative flex flex-col justify-center pr-1.5 font-[Poppins]">

                        <p
                            class="text-left text-[12px] leading-snug text-[#1A1A1A] lg:text-[14px]"
                        >
                            {{ $service->name }}
                        </p>

                    </div>


                    {{-- Service Image --}}
                    <div
                        class="relative h-[46px] w-[46px] shrink-0 lg:h-[56px] lg:w-[56px]"
                    >

                        @if ($service->image)

                            <img
                                src="{{ asset('storage/' . $service->image) }}"
                                alt="{{ $service->name }}"
                                width="56"
                                height="56"
                                loading="lazy"
                                class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                            >

                        @endif

                    </div>

                </a>

            @endforeach

        </div>


        {{-- View All --}}
        <div class="mt-6 text-center lg:mt-8">

            <a
                href="{{ url('/listings?category=services') }}"
                class="group inline-flex items-center gap-2 text-sm font-bold text-[#D7385E] transition-colors hover:text-[#B92D4E]"
            >

                <span>View all services</span>

                <svg
                    class="h-4 w-4 transition-transform group-hover:translate-x-1"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.21 14.77a.75.75 0 010-1.06L10.94 10 7.21 6.29a.75.75 0 111.06-1.06l4.24 4.24a.75.75 0 010 1.06l-4.24 4.24a.75.75 0 01-1.06 0z"
                        clip-rule="evenodd"
                    />
                </svg>

            </a>

        </div>

    @else

        <div class="mx-auto max-w-7xl px-5">

            <div
                class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-10 text-center"
            >
                <p class="text-sm font-medium text-gray-500">
                    No services are available yet.
                </p>
            </div>

        </div>

    @endif

</section>



{{-- ============================================================
    EVENTS
============================================================= --}}
<section
    id="events"
    class="relative z-0 w-full bg-[#FAFAFA] py-10 lg:py-14"
>

    {{-- Header --}}
    <div class="mx-auto mb-6 max-w-2xl px-5 text-center lg:mb-8">

        <h2
            class="text-2xl font-bold tracking-tight text-[#12365C] sm:text-3xl lg:text-[32px]"
        >
            Celebrate every moment
        </h2>

        <p class="mt-2 text-sm leading-6 text-[#5B6B7A] sm:text-base">
            Mehndi, baraat, walima — vendors for every event on your calendar.
        </p>

    </div>


    @if ($eventTypes->isNotEmpty())

        @php
            $palette = [
                ['bg' => 'rgb(255, 218, 198)', 'deco' => 'rgb(255, 232, 222)'],
                ['bg' => 'rgba(255, 27, 32, 0.15)', 'deco' => 'rgb(255, 234, 235)'],
                ['bg' => 'rgb(255, 231, 211)', 'deco' => 'rgb(255, 241, 229)'],
                ['bg' => 'rgb(255, 210, 204)', 'deco' => 'rgb(255, 228, 224)'],
                ['bg' => 'rgba(255, 199, 120, 0.3)', 'deco' => 'rgb(254, 245, 230)'],
                ['bg' => 'rgb(255, 226, 196)', 'deco' => 'rgb(255, 238, 220)'],
                ['bg' => 'rgb(255, 211, 186)', 'deco' => 'rgb(255, 228, 214)'],
                ['bg' => 'rgb(255, 218, 198)', 'deco' => 'rgb(255, 232, 222)'],
            ];
        @endphp


        <div class="mx-auto grid max-w-6xl grid-cols-2 gap-3 px-5 sm:grid-cols-3 md:px-8 lg:grid-cols-4 lg:gap-4 lg:px-12 xl:grid-cols-8">

            @foreach ($eventTypes->take(8) as $eventType)

                @php
                    $tone = $palette[$loop->index % count($palette)];
                @endphp

                <a
                    href="{{ url('/events/' . $eventType->slug) }}"
                    class="group relative flex h-16 w-full items-center justify-between overflow-hidden rounded-2xl pl-3 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md lg:h-[76px]"
                    style="background-color: {{ $tone['bg'] }};"
                >

                    {{-- Decorative Circle --}}
                    <div
                        class="pointer-events-none absolute -left-[35px] -top-[35px] h-12 w-20 rounded-full"
                        style="background-color: {{ $tone['deco'] }};"
                    ></div>


                    {{-- Decorative Corner --}}
                    <div
                        class="pointer-events-none absolute right-0 top-0 h-12 w-12 rounded-bl-full"
                        style="background-color: {{ $tone['deco'] }};"
                    ></div>


                    {{-- Label --}}
                    <div class="relative flex flex-col justify-center pr-1.5 font-[Poppins]">

                        <p
                            class="text-left text-[12px] leading-snug text-[#1A1A1A] lg:text-[14px]"
                        >
                            {{ $eventType->name }}
                        </p>

                    </div>


                    {{-- Icon --}}
                    <div
                        class="relative flex h-[46px] w-[46px] shrink-0 items-center justify-center lg:h-[56px] lg:w-[56px]"
                    >

                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-white/70 text-[#D7385E] transition group-hover:bg-[#D7385E] group-hover:text-white lg:h-9 lg:w-9"
                        >

                            <svg
                                class="h-4 w-4 lg:h-[18px] lg:w-[18px]"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                            >
                                <path d="M8 2v4M16 2v4"/>
                                <rect x="3" y="4" width="18" height="17" rx="2"/>
                                <path d="M3 10h18"/>
                                <path d="M8 14h.01M12 14h.01M16 14h.01"/>
                            </svg>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>


        {{-- View All --}}
        <div class="mt-6 text-center lg:mt-8">

            <a
                href="{{ url('/events') }}"
                class="group inline-flex items-center gap-2 text-sm font-bold text-[#D7385E] transition-colors hover:text-[#B92D4E]"
            >

                <span>View all events</span>

                <svg
                    class="h-4 w-4 transition-transform group-hover:translate-x-1"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.21 14.77a.75.75 0 010-1.06L10.94 10 7.21 6.29a.75.75 0 011.06-1.06l4.24 4.24a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0z"
                        clip-rule="evenodd"
                    />
                </svg>

            </a>

        </div>

    @else

        <div class="mx-auto max-w-7xl px-5">

            <div
                class="rounded-2xl border border-dashed border-gray-200 bg-white p-10 text-center"
            >
                <p class="text-sm font-medium text-gray-500">
                    No event types are available yet.
                </p>
            </div>

        </div>

    @endif

</section>


{{-- ============================================================
    WHY SHADIYANA — STATIC STATS
============================================================= --}}
<section
    id="why-shadiyana"
    class="bg-white py-10 lg:py-14"
>

    <div
        class="mx-auto max-w-6xl px-5 text-center sm:px-6 lg:px-8"
    >

        {{-- Section Heading --}}
        <h2
            class="mb-6 text-2xl font-bold tracking-tight text-[#12365C] sm:mb-8 sm:text-3xl lg:text-[32px]"
        >
            Why Shadiyana?
        </h2>


        {{-- Stats Container --}}
        <div
            class="rounded-[28px] bg-[#FCEEF0] px-5 py-8 sm:px-8 sm:py-10 lg:py-12"
        >

            <div
                class="grid grid-cols-2 gap-y-6 sm:flex sm:items-center sm:justify-between sm:gap-0"
            >

                {{-- ==================================================
                    HAPPY USERS
                =================================================== --}}
                <div
                    class="flex flex-1 flex-col items-center gap-2.5"
                >

                    {{-- Icon --}}
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F8D9DE] text-[#D7385E] sm:h-14 sm:w-14"
                    >

                        <svg
                            class="h-5 w-5 sm:h-6 sm:w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M8.5 10.5h.01M15.5 10.5h.01"/>
                            <path d="M8.5 14.5c1 1 2.2 1.5 3.5 1.5s2.5-.5 3.5-1.5"/>
                        </svg>

                    </div>


                    {{-- Animated Number --}}
                    <p
                        class="stat-number text-2xl font-extrabold text-[#12365C] sm:text-3xl"
                        data-target="500000"
                        data-suffix="+"
                    >
                        0+
                    </p>


                    {{-- Label --}}
                    <p class="text-xs text-[#12365C]/75 sm:text-sm">
                        Happy Users
                    </p>

                </div>


                {{-- Divider --}}
                <div
                    class="hidden h-12 w-px shrink-0 bg-[#12365C]/15 sm:block"
                ></div>


                {{-- ==================================================
                    VERIFIED VENDORS
                =================================================== --}}
                <div
                    class="flex flex-1 flex-col items-center gap-2.5"
                >

                    {{-- Icon --}}
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F8D9DE] text-[#D7385E] sm:h-14 sm:w-14"
                    >

                        <svg
                            class="h-5 w-5 sm:h-6 sm:w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M4 17h16"/>
                            <path d="M4 17 3 8l5 4 4-6 4 6 5-4-1 9"/>
                        </svg>

                    </div>


                    {{-- Animated Number --}}
                    <p
                        class="stat-number text-2xl font-extrabold text-[#12365C] sm:text-3xl"
                        data-target="600"
                        data-suffix="+"
                    >
                        0+
                    </p>


                    {{-- Label --}}
                    <p class="text-xs text-[#12365C]/75 sm:text-sm">
                        Verified Vendors
                    </p>

                </div>


                {{-- Divider --}}
                <div
                    class="hidden h-12 w-px shrink-0 bg-[#12365C]/15 sm:block"
                ></div>


                {{-- ==================================================
                    SECURE PAYMENT
                =================================================== --}}
                <div
                    class="flex flex-1 flex-col items-center gap-2.5"
                >

                    {{-- Icon --}}
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F8D9DE] text-[#D7385E] sm:h-14 sm:w-14"
                    >

                        <svg
                            class="h-5 w-5 sm:h-6 sm:w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect
                                x="5"
                                y="11"
                                width="14"
                                height="9"
                                rx="2"
                            />

                            <path
                                d="M8 11V7a4 4 0 0 1 8 0v4"
                            />
                        </svg>

                    </div>


                    {{-- Animated Number --}}
                    <p
                        class="stat-number text-2xl font-extrabold text-[#12365C] sm:text-3xl"
                        data-target="100"
                        data-suffix="%"
                    >
                        0%
                    </p>


                    {{-- Label --}}
                    <p class="text-xs text-[#12365C]/75 sm:text-sm">
                        Secure Payment
                    </p>

                </div>


                {{-- Divider --}}
                <div
                    class="hidden h-12 w-px shrink-0 bg-[#12365C]/15 sm:block"
                ></div>


                {{-- ==================================================
                    WEDDINGS PLANNED
                =================================================== --}}
                <div
                    class="flex flex-1 flex-col items-center gap-2.5"
                >

                    {{-- Icon --}}
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-[#F8D9DE] text-[#D7385E] sm:h-14 sm:w-14"
                    >

                        <svg
                            class="h-5 w-5 sm:h-6 sm:w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <circle cx="9" cy="14" r="4.5"/>
                            <circle cx="15" cy="14" r="4.5"/>
                        </svg>

                    </div>


                    {{-- Animated Number --}}
                    <p
                        class="stat-number text-2xl font-extrabold text-[#12365C] sm:text-3xl"
                        data-target="30000"
                        data-suffix="+"
                    >
                        0+
                    </p>


                    {{-- Label --}}
                    <p class="text-xs text-[#12365C]/75 sm:text-sm">
                        Weddings Planned
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
    FINAL CTA
============================================================= --}}
<section
    class="relative z-0 border-t border-gray-100 bg-gradient-to-b from-white to-[#FCEEF0]"
>

    <div
        class="mx-auto max-w-4xl px-5 py-10 text-center sm:px-6 lg:px-8 lg:py-14"
    >

        {{-- Icon --}}
        <div
            class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#D7385E] shadow-sm"
        >

            <svg
                class="h-6 w-6"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
            >
                <path d="M20 12v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8"/>
                <path d="M2 7h20v5H2z"/>
                <path d="M12 22V7"/>
                <path d="M12 7H8.5a2.5 2.5 0 110-5C12 2 12 7 12 7z"/>
                <path d="M12 7h3.5a2.5 2.5 0 100-5C12 2 12 7 12 7z"/>
            </svg>

        </div>


        {{-- Heading --}}
        <h2
            class="mt-5 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"
        >
            Ready to plan your big day?
        </h2>


        {{-- Description --}}
        <p
            class="mx-auto mt-3 max-w-xl text-sm leading-6 text-gray-500 sm:text-base"
        >
            Start exploring wedding venues, services and vendors today.
        </p>


        {{-- Buttons --}}
        <div
            class="mt-6 flex flex-col justify-center gap-3 sm:flex-row"
        >

            <a
                href="{{ url('/listings') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#B92D4E] hover:shadow-lg"
            >

                Explore vendors

                <svg
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.21 14.77a.75.75 0 010-1.06L10.94 10 7.21 6.29a.75.75 0 011.06 1.06l4.24 4.24a.75.75 0 010 1.06l-4.24 4.24a.75.75 0 01-1.06 0z"
                        clip-rule="evenodd"
                    />
                </svg>

            </a>


            <a
                href="{{ url('/vendor/register') }}"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-bold text-gray-700 transition hover:border-[#D7385E]/20 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
            >
                List your business
            </a>

        </div>

    </div>

</section>

</div>



{{-- ============================================================
    STATIC COUNT-UP ANIMATION
============================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const counters = document.querySelectorAll('.stat-number');

    if (!counters.length) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Fallback
    |--------------------------------------------------------------------------
    | If IntersectionObserver is not supported, immediately show
    | the final static values.
    |--------------------------------------------------------------------------
    */

    if (!('IntersectionObserver' in window)) {

        counters.forEach(function (counter) {

            const target = parseInt(
                counter.dataset.target,
                10
            ) || 0;

            const suffix =
                counter.dataset.suffix || '';

            counter.textContent =
                target.toLocaleString('en-US') + suffix;

        });

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Intersection Observer
    |--------------------------------------------------------------------------
    */

    const observer = new IntersectionObserver(
        function (entries) {

            entries.forEach(function (entry) {

                if (entry.isIntersecting) {

                    animateCounter(entry.target);

                    observer.unobserve(entry.target);
                }

            });

        },
        {
            threshold: 0.4
        }
    );


    /*
    |--------------------------------------------------------------------------
    | Observe Counters
    |--------------------------------------------------------------------------
    */

    counters.forEach(function (counter) {
        observer.observe(counter);
    });


    /*
    |--------------------------------------------------------------------------
    | Counter Animation
    |--------------------------------------------------------------------------
    */

    function animateCounter(element) {

        const target =
            parseInt(element.dataset.target, 10) || 0;

        const suffix =
            element.dataset.suffix || '';

        const duration = 1600;

        let startTime = null;


        function step(timestamp) {

            if (startTime === null) {
                startTime = timestamp;
            }


            const elapsed =
                timestamp - startTime;


            const progress =
                Math.min(elapsed / duration, 1);


            /*
            |----------------------------------------------------------
            | Ease Out Cubic
            |----------------------------------------------------------
            */

            const eased =
                1 - Math.pow(1 - progress, 3);


            const currentValue =
                Math.floor(eased * target);


            element.textContent =
                currentValue.toLocaleString('en-US') + suffix;


            if (progress < 1) {

                window.requestAnimationFrame(step);

            } else {

                /*
                |------------------------------------------------------
                | Always make sure the final exact value is displayed.
                |------------------------------------------------------
                */

                element.textContent =
                    target.toLocaleString('en-US') + suffix;

            }

        }


        window.requestAnimationFrame(step);
    }

});
</script>

@endsection