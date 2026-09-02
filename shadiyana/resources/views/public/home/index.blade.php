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
    class="relative z-30 overflow-visible bg-transparent bg-cover bg-center bg-no-repeat py-[60px] md:py-[75px]"
    style="background-image: url('{{ asset('images/home/chatgptimage.png') }}');"
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
        class="pointer-events-none absolute inset-0 z-0 "
        aria-hidden="true"
    ></div>


    {{-- ========================================================
        CONTENT
    ========================================================= --}}
    <div class="relative z-20 mx-auto max-w-[900px] px-5">

        {{-- ====================================================
            HEADING
        ===================================================== --}}
        <h1
            class="mb-6 text-center text-[20px] font-semibold leading-tight text-[#132743] md:text-[30px]"
        >
            Plan your
            <span class="text-[#D7385E]">Shadi</span>
            in 3 minutes
        </h1>


        {{-- ====================================================
            SEARCH CARD
        ===================================================== --}}
        <div
    class="relative z-50 rounded-[28px] border border-white/70 bg-white/88 px-5 pb-6 pt-5 shadow-[0_16px_40px_rgba(19,39,67,0.12)] backdrop-blur-sm md:px-8"
>

            {{-- ==================================================
                TABS
            =================================================== --}}
            <div
                class="mb-4 flex justify-center gap-8 border-b border-[#EDEDED]"
            >

                {{-- Service & City --}}
                <button
                    type="button"
                    @click="
                        tab = 'cityService';
                        serviceOpen = false;
                        cityOpen = false;
                    "
                    class="relative pb-3 text-[15px] font-semibold transition-colors"
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
                    class="relative pb-3 text-[15px] font-semibold transition-colors"
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
                    class="relative flex flex-col overflow-visible rounded-[20px] border border-[#ECECEC] bg-white md:flex-row md:items-stretch md:rounded-full"
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
                            class="flex h-[62px] w-full items-center justify-between px-6 text-[16px] transition-colors md:px-8"
                            :class="
                                service
                                    ? 'text-[#132743]'
                                    : 'text-[rgba(68,68,68,0.6)]'
                            "
                        >

                            <div class="flex min-w-0 items-center gap-4">

                                {{-- Service Icon --}}
                                <span
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]"
                                >
                                    <svg
                                        class="h-[17px] w-[17px]"
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
                                class="h-4 w-4 shrink-0 text-[#6B7983] transition-transform duration-200"
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
                            class="absolute left-0 top-[calc(100%+14px)] z-[9999] w-[min(90vw,560px)] overflow-hidden rounded-[24px] border border-[#ECECEC] bg-white shadow-[0_24px_60px_rgba(19,39,67,0.18)]"
                        >

                            @if($services->count())

                                {{-- Dropdown Header --}}
                                <div
                                    class="flex items-center justify-between border-b border-[#F1F1F1] bg-white px-5 py-4"
                                >

                                    <div>

                                        <h3
                                            class="text-[16px] font-bold text-[#132743]"
                                        >
                                            Choose a service
                                        </h3>

                                        <p
                                            class="mt-0.5 text-[13px] text-[#89939D]"
                                        >
                                            Select the service you're looking for
                                        </p>

                                    </div>

                                    <span
                                        class="shrink-0 rounded-full bg-[#FBEBEF] px-3 py-1.5 text-[12px] font-bold text-[#D7385E]"
                                    >
                                        {{ $services->count() }}
                                        {{ Str::plural('SERVICE', $services->count()) }}
                                    </span>

                                </div>


                                {{-- Dropdown Items --}}
                                <div
                                    class="max-h-[360px] overflow-y-auto p-3"
                                >

                                    <div
                                        class="space-y-5"
                                    >

                                        @foreach($services as $serviceItem)

                                            <button
                                                type="button"
                                                @click="
                                                    service = @js($serviceItem->slug);
                                                    serviceLabel = @js($serviceItem->name);
                                                    serviceOpen = false;
                                                "
                                                class="group flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-left transition-all duration-150 hover:bg-[#FBEBEF]"
                                                :class="
                                                    service === @js($serviceItem->slug)
                                                        ? 'bg-[#FBEBEF]'
                                                        : ''
                                                "
                                            >

                                                {{-- Icon --}}
                                                <span
                                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E] transition-colors duration-150 group-hover:bg-[#D7385E] group-hover:text-white"
                                                    :class="
                                                        service === @js($serviceItem->slug)
                                                            ? 'bg-[#D7385E] text-white'
                                                            : ''
                                                    "
                                                >
                                                    <svg
                                                        class="h-[17px] w-[17px]"
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


                                                {{-- Name --}}
                                                <span
                                                    class="min-w-0 flex-1 truncate text-[15px] font-medium text-[#242424] transition-colors group-hover:text-[#D7385E]"
                                                >
                                                    {{ $serviceItem->name }}
                                                </span>


                                                {{-- Selected Check --}}
                                                <svg
                                                    x-show="service === @js($serviceItem->slug)"
                                                    x-cloak
                                                    class="h-4 w-4 shrink-0 text-[#D7385E]"
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
                                <div class="px-5 py-8 text-center">

                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]"
                                    >
                                        <svg
                                            class="h-5 w-5"
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
                                        class="mt-3 text-sm font-semibold text-[#132743]"
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
                        class="mx-6 h-px bg-[#ECECEC] md:my-[18px] md:mx-0 md:h-auto md:w-px"
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
                            class="flex h-[62px] w-full items-center justify-between px-6 text-[16px] transition-colors md:px-8"
                            :class="
                                city
                                    ? 'text-[#132743]'
                                    : 'text-[rgba(68,68,68,0.6)]'
                            "
                        >

                            <div class="flex min-w-0 items-center gap-4">

                                {{-- Location Icon --}}
                                <span
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]"
                                >
                                    <svg
                                        class="h-[17px] w-[17px]"
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
                                class="h-4 w-4 shrink-0 text-[#6B7983] transition-transform duration-200"
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
                            class="absolute left-0 top-[calc(100%+14px)] z-[9999] w-[min(90vw,360px)] overflow-hidden rounded-[24px] border border-[#ECECEC] bg-white shadow-[0_24px_60px_rgba(19,39,67,0.18)] md:left-auto md:right-0"
                        >

                            @if($cities->count())

                                {{-- Dropdown Header --}}
                                <div
                                    class="flex items-center justify-between border-b border-[#F1F1F1] bg-white px-5 py-4"
                                >

                                    <div>

                                        <h3
                                            class="text-[16px] font-bold text-[#132743]"
                                        >
                                            Choose a city
                                        </h3>

                                        <p
                                            class="mt-0.5 text-[13px] text-[#89939D]"
                                        >
                                            Find wedding vendors near you
                                        </p>

                                    </div>

                                    <span
                                        class="shrink-0 rounded-full bg-[#FBEBEF] px-3 py-1.5 text-[12px] font-bold text-[#D7385E]"
                                    >
                                        {{ $cities->count() }}
                                        {{ Str::plural('CITY', $cities->count()) }}
                                    </span>

                                </div>


                                {{-- City Items --}}
                                <div class="max-h-[360px] overflow-y-auto p-3">

                                    <div class="grid grid-cols-1 gap-1">

                                        @foreach($cities as $cityItem)

                                            <button
                                                type="button"
                                                @click="
                                                    city = @js($cityItem->slug);
                                                    cityLabel = @js($cityItem->name);
                                                    cityOpen = false;
                                                "
                                                class="group flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-left transition-all duration-150 hover:bg-[#FBEBEF]"
                                                :class="
                                                    city === @js($cityItem->slug)
                                                        ? 'bg-[#FBEBEF]'
                                                        : ''
                                                "
                                            >

                                                {{-- Location Icon --}}
                                                <span
                                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#FBEBEF] text-[#132743] transition-colors duration-150 group-hover:bg-[#D7385E] group-hover:text-white"
                                                    :class="
                                                        city === @js($cityItem->slug)
                                                            ? 'bg-[#D7385E] text-white'
                                                            : ''
                                                    "
                                                >
                                                    <svg
                                                        class="h-[17px] w-[17px]"
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


                                                {{-- City Name --}}
                                                <span
                                                    class="min-w-0 flex-1 truncate text-[15px] font-medium text-[#242424] transition-colors group-hover:text-[#D7385E]"
                                                >
                                                    {{ $cityItem->name }}
                                                </span>


                                                {{-- Selected Check --}}
                                                <svg
                                                    x-show="city === @js($cityItem->slug)"
                                                    x-cloak
                                                    class="h-4 w-4 shrink-0 text-[#D7385E]"
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
                                <div class="px-5 py-8 text-center">

                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]"
                                    >
                                        <svg
                                            class="h-5 w-5"
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
                                        class="mt-3 text-sm font-semibold text-[#132743]"
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
                    <div class="flex items-center justify-center p-2">

                        <button
                            type="submit"
                            :disabled="!service && !city"
                            class="flex h-[54px] w-full items-center justify-center gap-2.5 rounded-full px-8 text-[16px] font-semibold text-white transition-all duration-200 md:w-[160px]"
                            :class="
                                (!service && !city)
                                    ? 'cursor-not-allowed bg-[#E9A0B6] opacity-80'
                                    : 'bg-[#D7385E] hover:bg-[#C22C50] hover:shadow-lg'
                            "
                        >

                            {{-- Search Icon --}}
                            <svg
                                class="h-[17px] w-[17px] shrink-0"
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
                    class="flex flex-col overflow-hidden rounded-[20px] border border-[#ECECEC] md:h-[62px] md:flex-row md:items-stretch md:rounded-full"
                >

                    <input
                        type="text"
                        name="q"
                        placeholder="Search a vendor or business name"
                        class="h-[62px] flex-1 border-0 bg-transparent px-6 text-[16px] text-[#242424] outline-none placeholder:text-[rgba(68,68,68,0.6)] md:h-full md:px-8"
                    >


                    <div class="flex items-center justify-center p-2">

                        <button
                            type="submit"
                            class="flex h-[54px] w-full items-center justify-center gap-2.5 rounded-full bg-[#D7385E] px-8 text-[16px] font-semibold text-white transition duration-200 hover:bg-[#C22C50] hover:shadow-lg md:w-[160px]"
                        >

                            <svg
                                class="h-[17px] w-[17px] shrink-0"
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
            class="mt-5 flex flex-wrap items-center justify-center gap-x-2 gap-y-2 text-center"
        >

            <span class="text-[15px] font-semibold text-[#111111]">
                Popular Searches :
            </span>


            <a
                href="{{ route('public.listings.index', [
                    'category' => 'wedding-venues',
                    'slug' => 'lahore'
                ]) }}"
                class="text-[15px] font-medium text-[#D7385E] underline-offset-2 transition hover:underline"
            >
                Wedding Venues Lahore
            </a>


            <a
                href="{{ route('public.listings.index', [
                    'category' => 'wedding-venues',
                    'slug' => 'islamabad'
                ]) }}"
                class="text-[15px] font-medium text-[#D7385E] underline-offset-2 transition hover:underline"
            >
                Wedding Venues Islamabad
            </a>


            <a
                href="{{ route('public.listings.index', [
                    'category' => 'wedding-venues',
                    'slug' => 'karachi'
                ]) }}"
                class="text-[15px] font-medium text-[#D7385E] underline-offset-2 transition hover:underline"
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
    class="relative z-0 w-full bg-white py-16 lg:py-20"
>

    {{-- Header --}}
    <div class="mb-10 px-5 text-center">

        <h2
            class="text-3xl font-bold tracking-tight text-[#12365C] sm:text-4xl"
        >
            Find every wedding service
        </h2>

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


        <div class="flex flex-wrap justify-center gap-4 px-0 lg:gap-8 lg:px-12">

            @foreach ($services->take(8) as $service)

                @php
                    $tone = $palette[$loop->index % count($palette)];
                @endphp

                <a
                    href="{{ url('/shadiyana/list/services/' . $service->slug) }}"
                    class="group relative flex h-[60px] w-full max-w-[9.37rem] items-center justify-between overflow-hidden rounded-2xl pl-2 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-md lg:h-[80px] lg:max-w-60 lg:pl-4"
                    style="background-color: {{ $tone['bg'] }};"
                >

                    {{-- Decorative Circle --}}
                    <div
                        class="pointer-events-none absolute -left-[45px] -top-[45px] h-16 w-24 rounded-full"
                        style="background-color: {{ $tone['deco'] }};"
                    ></div>


                    {{-- Decorative Corner --}}
                    <div
                        class="pointer-events-none absolute right-0 top-0 h-16 w-16 rounded-bl-full"
                        style="background-color: {{ $tone['deco'] }};"
                    ></div>


                    {{-- Label --}}
                    <div class="relative flex flex-col justify-center pl-2 font-[Poppins]">

                        <p
                            class="text-left text-[13px] leading-tight text-[#1A1A1A] lg:text-[16px]"
                        >
                            {{ $service->name }}
                        </p>

                    </div>


                    {{-- Service Image --}}
                    <div
                        class="relative h-[60px] w-[60px] shrink-0 lg:h-[75px] lg:w-[75px]"
                    >

                        @if ($service->image)

                            <img
                                src="{{ asset('storage/' . $service->image) }}"
                                alt="{{ $service->name }}"
                                width="75"
                                height="75"
                                loading="lazy"
                                class="h-full w-full object-contain transition-transform duration-200 group-hover:scale-105"
                            >

                        @endif

                    </div>

                </a>

            @endforeach

        </div>


        {{-- View All --}}
        <div class="mt-10 text-center">

            <a
                href="{{ url('/shadiyana/list/services') }}"
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
                class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-12 text-center"
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
    class="relative z-0 w-full bg-white py-16 lg:py-16"
>

    {{-- Header --}}
    <div class="mb-10 px-5 text-center">

        <h2
            class="text-3xl font-bold tracking-tight text-[#12365C] sm:text-4xl"
        >
            Celebrate every moment
        </h2>

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


        <div class="flex flex-wrap justify-center gap-4 px-0 lg:gap-8 lg:px-12">

            @foreach ($eventTypes->take(8) as $eventType)

                @php
                    $tone = $palette[$loop->index % count($palette)];
                @endphp

                <a
                    href="{{ url('/shadiyana/list/events/' . $eventType->slug) }}"
                    class="group relative flex h-[60px] w-full max-w-[9.37rem] items-center justify-between overflow-hidden rounded-2xl pl-2 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-md lg:h-[80px] lg:max-w-60 lg:pl-4"
                    style="background-color: {{ $tone['bg'] }};"
                >

                    {{-- Decorative Circle --}}
                    <div
                        class="pointer-events-none absolute -left-[45px] -top-[45px] h-16 w-24 rounded-full"
                        style="background-color: {{ $tone['deco'] }};"
                    ></div>


                    {{-- Decorative Corner --}}
                    <div
                        class="pointer-events-none absolute right-0 top-0 h-16 w-16 rounded-bl-full"
                        style="background-color: {{ $tone['deco'] }};"
                    ></div>


                    {{-- Label --}}
                    <div class="relative flex flex-col justify-center pl-2 font-[Poppins]">

                        <p
                            class="text-left text-[13px] leading-tight text-[#1A1A1A] lg:text-[16px]"
                        >
                            {{ $eventType->name }}
                        </p>

                    </div>


                    {{-- Icon --}}
                    <div
                        class="relative flex h-[60px] w-[60px] shrink-0 items-center justify-center lg:h-[75px] lg:w-[75px]"
                    >

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-white/70 text-[#D7385E] transition group-hover:bg-[#D7385E] group-hover:text-white lg:h-11 lg:w-11"
                        >

                            <svg
                                class="h-5 w-5 lg:h-6 lg:w-6"
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
        <div class="mt-10 text-center">

            <a
                href="{{ url('/shadiyana/list/events') }}"
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
                        d="M7.21 14.77a.75.75 0 010-1.06L10.94 10 7.21 6.29a.75.75 0 111.06-1.06l4.24 4.24a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0z"
                        clip-rule="evenodd"
                    />
                </svg>

            </a>

        </div>

    @else

        <div class="mx-auto max-w-7xl px-5">

            <div
                class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-12 text-center"
            >
                <p class="text-sm font-medium text-gray-500">
                    No event types are available yet.
                </p>
            </div>

        </div>

    @endif

</section>


<!-- 
{{-- ============================================================
    CITIES
============================================================= --}}
<section
    id="cities"
    class="relative z-0 bg-gray-50"
>

    <div
        class="mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8 lg:py-20"
    >

        <div>

            <span
                class="text-xs font-bold uppercase tracking-[0.15em] text-[#D7385E]"
            >
                Find vendors near you
            </span>

            <h2
                class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
            >
                Areas we serve
            </h2>

            <p
                class="mt-3 max-w-xl text-sm leading-6 text-gray-500"
            >
                Explore wedding vendors and services in cities across Pakistan.
            </p>

        </div>


        @if ($cities->isNotEmpty())

            <div
                class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4"
            >

                @foreach ($cities->take(8) as $city)

                    <a
                        href="{{ url('/shadiyana/list?city=' . $city->slug) }}"
                        class="group flex items-center justify-between rounded-2xl border border-gray-100 bg-white px-5 py-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-[#D7385E]/20 hover:bg-[#FBEBEF] hover:shadow-md"
                    >

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-50 text-gray-400 transition group-hover:bg-white group-hover:text-[#D7385E]"
                            >

                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1116 0z"/>
                                    <circle cx="12" cy="10" r="2.5"/>
                                </svg>

                            </div>


                            <div>

                                <h3
                                    class="text-sm font-bold text-gray-800 transition group-hover:text-[#D7385E]"
                                >
                                    {{ $city->name }}
                                </h3>

                                <p class="mt-0.5 text-xs text-gray-400">
                                    Explore wedding vendors
                                </p>

                            </div>

                        </div>


                        <svg
                            class="h-4 w-4 text-gray-300 transition group-hover:translate-x-0.5 group-hover:text-[#D7385E]"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.21 14.77a.75.75 0 010-1.06L10.94 10 7.21 6.29a.75.75 0 011.06-1.06l4.24 4.24a.75.75 0 010 1.06l-4.24 4.24a.75.75 0 01-1.06-1.06z"
                                clip-rule="evenodd"
                            />
                        </svg>

                    </a>

                @endforeach

            </div>

        @else

            <div
                class="mt-10 rounded-2xl border border-dashed border-gray-200 bg-white p-12 text-center"
            >
                <p class="text-sm font-medium text-gray-500">
                    No cities are available yet.
                </p>
            </div>

        @endif

    </div>

</section>
 -->


{{-- ============================================================
    WHY SHADIYANA — STATIC STATS
============================================================= --}}
<section
    id="why-shadiyana"
    class="bg-white py-16 lg:py-20"
>

    <div
        class="mx-auto max-w-6xl px-5 text-center sm:px-6 lg:px-8"
    >

        {{-- Section Heading --}}
        <h2
            class="mb-10 text-3xl font-bold tracking-tight text-[#12365C] sm:mb-14 sm:text-4xl"
        >
            Why Shadiyana?
        </h2>


        {{-- Stats Container --}}
        <div
            class="rounded-[40px] bg-[#FCEEF0] px-6 py-10 sm:px-10 sm:py-14"
        >

            <div
                class="flex flex-col gap-10 sm:flex-row sm:items-center sm:justify-between sm:gap-0"
            >

                {{-- ==================================================
                    HAPPY USERS
                =================================================== --}}
                <div
                    class="flex flex-1 flex-col items-center gap-3"
                >

                    {{-- Icon --}}
                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#F8D9DE] text-[#D7385E] sm:h-16 sm:w-16"
                    >

                        <svg
                            class="h-6 w-6 sm:h-7 sm:w-7"
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
                        class="stat-number text-3xl font-bold text-[#12365C] sm:text-4xl"
                        data-target="500000"
                        data-suffix="+"
                    >
                        0+
                    </p>


                    {{-- Label --}}
                    <p class="text-sm text-[#12365C]/75 sm:text-base">
                        Happy Users
                    </p>

                </div>


                {{-- Divider --}}
                <div
                    class="hidden h-16 w-px shrink-0 bg-[#12365C]/15 sm:block"
                ></div>


                {{-- ==================================================
                    VERIFIED VENDORS
                =================================================== --}}
                <div
                    class="flex flex-1 flex-col items-center gap-3"
                >

                    {{-- Icon --}}
                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#F8D9DE] text-[#D7385E] sm:h-16 sm:w-16"
                    >

                        <svg
                            class="h-6 w-6 sm:h-7 sm:w-7"
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
                        class="stat-number text-3xl font-bold text-[#12365C] sm:text-4xl"
                        data-target="600"
                        data-suffix="+"
                    >
                        0+
                    </p>


                    {{-- Label --}}
                    <p class="text-sm text-[#12365C]/75 sm:text-base">
                        Verified Vendors
                    </p>

                </div>


                {{-- Divider --}}
                <div
                    class="hidden h-16 w-px shrink-0 bg-[#12365C]/15 sm:block"
                ></div>


                {{-- ==================================================
                    SECURE PAYMENT
                =================================================== --}}
                <div
                    class="flex flex-1 flex-col items-center gap-3"
                >

                    {{-- Icon --}}
                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#F8D9DE] text-[#D7385E] sm:h-16 sm:w-16"
                    >

                        <svg
                            class="h-6 w-6 sm:h-7 sm:w-7"
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
                        class="stat-number text-3xl font-bold text-[#12365C] sm:text-4xl"
                        data-target="100"
                        data-suffix="%"
                    >
                        0%
                    </p>


                    {{-- Label --}}
                    <p class="text-sm text-[#12365C]/75 sm:text-base">
                        Secure Payment
                    </p>

                </div>


                {{-- Divider --}}
                <div
                    class="hidden h-16 w-px shrink-0 bg-[#12365C]/15 sm:block"
                ></div>


                {{-- ==================================================
                    WEDDINGS PLANNED
                =================================================== --}}
                <div
                    class="flex flex-1 flex-col items-center gap-3"
                >

                    {{-- Icon --}}
                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#F8D9DE] text-[#D7385E] sm:h-16 sm:w-16"
                    >

                        <svg
                            class="h-6 w-6 sm:h-7 sm:w-7"
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
                        class="stat-number text-3xl font-bold text-[#12365C] sm:text-4xl"
                        data-target="30000"
                        data-suffix="+"
                    >
                        0+
                    </p>


                    {{-- Label --}}
                    <p class="text-sm text-[#12365C]/75 sm:text-base">
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
    class="relative z-0 border-t border-gray-100 bg-white"
>

    <div
        class="mx-auto max-w-4xl px-5 py-16 text-center sm:px-6 lg:px-8 lg:py-20"
    >

        {{-- Icon --}}
        <div
            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]"
        >

            <svg
                class="h-7 w-7"
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
            class="mt-6 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
        >
            Ready to plan your big day?
        </h2>


        {{-- Description --}}
        <p
            class="mx-auto mt-4 max-w-xl text-sm leading-6 text-gray-500 sm:text-base"
        >
            Start exploring wedding venues, services and vendors today.
        </p>


        {{-- Buttons --}}
        <div
            class="mt-7 flex flex-col justify-center gap-3 sm:flex-row"
        >

            <a
                href="{{ url('/shadiyana/list') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#B92D4E] hover:shadow-lg"
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