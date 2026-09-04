@extends('layouts.public')

@section('title', $vendor->business_name . ' | Shadiyana')

@section('content')

@php
    $coverImage = $vendor->cover_image
        ? asset('storage/' . $vendor->cover_image)
        : null;

    $logoImage = $vendor->logo_image
        ? asset('storage/' . $vendor->logo_image)
        : null;

    $galleryImages = $vendor->images;

    $whatsappNumber = preg_replace(
        '/[^0-9]/',
        '',
        $vendor->whatsapp_number ?? $vendor->phone_number ?? ''
    );

    $primaryTaxonomy = $vendor->taxonomies->first();

    $locationText = $vendor->city?->name;

    if (!$locationText && $vendor->address) {
        $locationText = $vendor->address;
    }

    // ================================================================
    // CENTRALIZED WHATSAPP LEAD ROUTING
    // Both "Contact vendor" and "WhatsApp" buttons send the user to
    // a single business WhatsApp number, with a pre-filled message
    // containing this vendor's details.
    // ================================================================

    // Central lead number in full international format (no +, no leading 0)
    $leadWhatsappNumber = '923156093767';

    $waMessageLines = [
        "Hi! I'm interested in *{$vendor->business_name}*",
    ];

    if ($primaryTaxonomy) {
        $waMessageLines[] = "Category: {$primaryTaxonomy->name}";
    }

    if ($locationText) {
        $waMessageLines[] = "Location: {$locationText}";
    }

    $waMessageLines[] = "Vendor page: " . route('public.vendors.show', $vendor->slug);
    $waMessageLines[] = "Please share more details / availability.";

    $waMessage = implode("\n", $waMessageLines);

    $leadWhatsappLink = 'https://wa.me/' . $leadWhatsappNumber . '?text=' . rawurlencode($waMessage);
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,450;9..144,550;9..144,650&family=Inter:wght@400;500;600;700&display=swap');

    .font-display { font-family: 'Fraunces', ui-serif, Georgia, serif; }
    .font-body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
</style>

{{-- ============================================================
    PUBLIC NAVBAR
============================================================= --}}

<x-public.home-navbar
    :venue-taxonomies="$venueTaxonomies"
    :services="$services"
    :event-types="$eventTypes"
    :cities="$cities"
/>

{{-- ================================================================
    PAGE
================================================================ --}}

<div class="min-h-screen bg-[#FFFBF6] font-body text-[#241019]">

    {{-- ============================================================
        BREADCRUMB
    ============================================================= --}}

    <section class="border-b border-[#F0DCE1] bg-white">

        <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">

            <nav class="flex flex-wrap items-center gap-2 text-sm">

                <a
                    href="{{ url('/') }}"
                    class="text-gray-400 transition hover:text-[#D7385E]"
                >
                    Home
                </a>

                <span class="text-gray-300">
                    /
                </span>

                <a
                    href="{{ route('public.listings.index') }}"
                    class="text-gray-400 transition hover:text-[#D7385E]"
                >
                    Vendors
                </a>

                <span class="text-gray-300">
                    /
                </span>

                <span class="font-medium text-[#7A1030]">
                    {{ $vendor->business_name }}
                </span>

            </nav>

        </div>

    </section>


    {{-- ============================================================
        HERO
    ============================================================= --}}

    <section class="bg-white">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-[1.15fr_.85fr]">

                {{-- ==================================================
                    GALLERY
                =================================================== --}}

                <div class="py-5 lg:py-7">

                    @if($galleryImages->count() > 0)

                        <div
                            class="grid h-[340px] gap-3 overflow-hidden rounded-3xl sm:h-[420px]"
                            style="
                                grid-template-columns:
                                {{ $galleryImages->count() > 1 ? '1.5fr 1fr' : '1fr' }};
                            "
                        >

                            {{-- Main Image --}}
                            <button
                                type="button"
                                onclick="openGallery(0)"
                                class="group relative min-h-0 overflow-hidden rounded-3xl bg-[#FBEBEF] text-left"
                            >

                                <img
                                    src="{{ asset('storage/' . $galleryImages[0]->image_url) }}"
                                    alt="{{ $galleryImages[0]->title ?: $vendor->business_name }}"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                >

                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>

                                <div class="absolute bottom-5 left-5">

                                    <span class="inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-semibold text-[#241019] shadow-sm backdrop-blur">

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
                                                d="M4 16l4.586-4.586a2 2 0 016.828 0L20 16M14 14l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                        View gallery

                                    </span>

                                </div>

                            </button>


                            {{-- Secondary Images --}}
                            @if($galleryImages->count() > 1)

                                <div class="grid min-h-0 grid-rows-2 gap-3">

                                    @foreach($galleryImages->skip(1)->take(2) as $index => $galleryImage)

                                        <button
                                            type="button"
                                            onclick="openGallery({{ $index + 1 }})"
                                            class="group relative min-h-0 overflow-hidden rounded-3xl bg-[#FBEBEF]"
                                        >

                                            <img
                                                src="{{ asset('storage/' . $galleryImage->image_url) }}"
                                                alt="{{ $galleryImage->title ?: $vendor->business_name }}"
                                                class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                            >

                                            @if(
                                                $index === 1 &&
                                                $galleryImages->count() > 3
                                            )

                                                <div class="absolute inset-0 flex items-center justify-center bg-black/35">

                                                    <span class="rounded-full bg-white/95 px-4 py-2 text-sm font-semibold text-[#241019] shadow">
                                                        +{{ $galleryImages->count() - 3 }} more
                                                    </span>

                                                </div>

                                            @endif

                                        </button>

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    @else

                        {{-- Empty Gallery --}}
                        <div class="flex h-[340px] items-center justify-center rounded-3xl bg-[#FBEBEF] sm:h-[420px]">

                            <div class="text-center">

                                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-[#D7385E] shadow-sm">

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
                                            d="M4 16l4.586-4.586a2 2 0 016.828 0L20 16M14 14l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>

                                </div>

                                <p class="font-semibold text-[#241019]">
                                    Gallery coming soon
                                </p>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- ==================================================
                    VENDOR INFORMATION
                =================================================== --}}

                <div class="flex flex-col justify-center px-0 py-6 lg:px-10 lg:py-10">

                    {{-- Category --}}
                    @if($primaryTaxonomy)

                        <div class="mb-3">

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-[#FBEBEF] px-4 py-1.5 text-xs font-semibold text-[#D7385E]">

                                <svg class="h-3 w-3" viewBox="0 0 64 64" fill="none">
                                    <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="6" stroke-linecap="round" />
                                    <circle cx="19" cy="46" r="5" fill="currentColor" />
                                </svg>

                                {{ $primaryTaxonomy->name }}

                            </span>

                        </div>

                    @endif


                    {{-- Vendor Name --}}
                    <div class="flex items-start gap-4">

                        @if($logoImage)

                            <img
                                src="{{ $logoImage }}"
                                alt="{{ $vendor->business_name }}"
                                class="h-16 w-16 shrink-0 rounded-2xl border border-[#EEE1CB] object-cover shadow-sm"
                            >

                        @endif

                        <div>

                            <div class="flex flex-wrap items-center gap-2">

                                <h1 class="font-display text-3xl font-medium tracking-tight text-[#241019] sm:text-4xl">
                                    {{ $vendor->business_name }}
                                </h1>

                                @if($vendor->is_verified)

                                    <span
                                        class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-[#D7385E] text-white"
                                        title="Verified vendor"
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
                                                stroke-width="2.3"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                    </span>

                                @endif

                            </div>


                            {{-- Rating --}}
                            <div class="mt-2 flex flex-wrap items-center gap-3">

                                <div class="flex items-center gap-1">

                                    <svg
                                        class="h-5 w-5 fill-current text-[#C6952F]"
                                        viewBox="0 0 20 20"
                                    >
                                        <path d="M10 1.7l2.47 5 5.53.8-4 3.9.94 5.5L10 14.3l-4.94 2.6.94-5.5-4-3.9 5.53-.8L10 1.7z"/>
                                    </svg>

                                    <span class="font-semibold text-[#241019]">
                                        {{ number_format((float) $vendor->avg_rating, 1) }}
                                    </span>

                                </div>

                                <span class="text-gray-300">
                                    •
                                </span>

                                <span class="text-sm text-gray-500">
                                    {{ number_format((int) $vendor->review_count) }} reviews
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Location --}}
                    @if($locationText)

                        <div class="mt-5 flex items-start gap-3 text-gray-600">

                            <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                                        d="M12 21s7-6.1 7-12a7 7 0 10-14 0c0 5.9 7 12 7 12z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="9"
                                        r="2.2"
                                        stroke-width="1.8"
                                    />
                                </svg>

                            </div>

                            <div>

                                <p class="text-xs font-medium text-gray-400">
                                    Location
                                </p>

                                <p class="mt-0.5 font-medium text-[#241019]">
                                    {{ $locationText }}
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- Taxonomies --}}
                    @if($vendor->taxonomies->isNotEmpty())

                        <div class="mt-4 flex flex-wrap gap-2">

                            @foreach($vendor->taxonomies->take(6) as $taxonomy)

                                <span class="rounded-full border border-[#EEE1CB] bg-white px-3 py-1.5 text-xs font-medium text-gray-600">
                                    {{ $taxonomy->name }}
                                </span>

                            @endforeach

                        </div>

                    @endif


                    {{-- Description --}}
                    @if($vendor->description)

                        <p class="mt-5 max-w-xl text-[15px] leading-7 text-gray-500">

                            {{ \Illuminate\Support\Str::limit(
                                strip_tags($vendor->description),
                                230
                            ) }}

                        </p>

                    @endif


                    {{-- Actions --}}
                    <div class="mt-7 flex flex-col gap-3 sm:flex-row">

                        {{--
                            Both actions below route through the centralized
                            business WhatsApp number ($leadWhatsappLink),
                            pre-filled with this vendor's details, instead of
                            dialing the vendor directly or opening the
                            vendor's own WhatsApp number.
                        --}}

                        @if($vendor->phone_number)

                            <a
                                href="{{ $leadWhatsappLink }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 rounded-full bg-[#D7385E] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#A62347] hover:shadow-md"
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
                                        d="M3 5.5A2.5 2.5 0 015.5 3h2l2 5-2.5 1.5a13 13 0 005.5 5.5L14 12.5l5 2v2A2.5 2.5 0 0116.5 19C9.596 19 4 13.404 4 6.5A2.5 2.5 0 013 5.5z"
                                    />
                                </svg>

                                Contact vendor

                            </a>

                        @endif


                        @if($whatsappNumber)

                            <a
                                href="{{ $leadWhatsappLink }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 rounded-full border border-[#D7385E] bg-white px-6 py-3 text-sm font-semibold text-[#D7385E] transition hover:bg-[#FBEBEF]"
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M20.5 3.5A11.8 11.8 0 0012.1 0C5.6 0 .3 5.3.3 11.8c0 2.1.6 4.1 1.3 5.9L.2 24l6.5-1.7a11.8 11.8 0 005.4 1.3h.1c6.5 0 11.8-5.3 11.8-11.8 0-3.2-1.2-6.1-3.5-8.3zM12.1 21.5h-.1c-1.8 0-3.6-.5-5.1-1.4l-.4-.2-3.9 1 1-3.8-.3-.4a9.7 9.7 0 01-1.5-5.1C1.8 6.2 6.4 1.8 12 1.8c2.7 0 5.1 1 7 2.9s2.9 4.3 2.9 7c0 5.4-4.4 9.8-9.8 9.8z"/>
                                </svg>

                                WhatsApp

                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
        STICKY SECTION NAVIGATION
    ============================================================= --}}

    <div
        id="stickyNav"
        class="sticky top-0 z-30 border-y border-[#F0DCE1] bg-white/95 shadow-sm backdrop-blur transition-shadow duration-300"
    >

        <div class="mx-auto max-w-7xl overflow-x-auto px-4 sm:px-6 lg:px-8">

            <nav
                id="tabNav"
                class="relative flex min-w-max items-center gap-7"
            >

                <a
                    href="#about"
                    data-tab-link
                    class="tab-link relative py-3.5 text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-[#D7385E]"
                >
                    About
                </a>

                <a
                    href="#services"
                    data-tab-link
                    class="tab-link relative py-3.5 text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-[#D7385E]"
                >
                    Services
                </a>

                <a
                    href="#packages"
                    data-tab-link
                    class="tab-link relative py-3.5 text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-[#D7385E]"
                >
                    Packages
                </a>

                <a
                    href="#location"
                    data-tab-link
                    class="tab-link relative py-3.5 text-sm font-medium text-gray-500 transition-colors duration-200 hover:text-[#D7385E]"
                >
                    Location
                </a>

                <span
                    id="tabIndicator"
                    class="pointer-events-none absolute bottom-0 h-0.5 rounded-full bg-[#D7385E] transition-all duration-300 ease-out"
                ></span>

            </nav>

        </div>

    </div>


    {{-- ============================================================
        MAIN CONTENT
    ============================================================= --}}

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- ========================================================
            ABOUT
        ========================================================= --}}

        <section
            id="about"
            class="scroll-mt-24"
        >

            <div class="max-w-4xl">

                <div class="flex items-center gap-2 text-sm font-medium text-[#C6952F]">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 64 64" fill="none">
                        <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="5" stroke-linecap="round" />
                        <circle cx="19" cy="46" r="4.5" fill="currentColor" />
                    </svg>
                    About the vendor
                </div>

                <h2 class="mt-2 font-display text-3xl font-medium tracking-tight text-[#241019]">
                    About {{ $vendor->business_name }}
                </h2>

                @if($vendor->description)

                    <div class="mt-5 text-[15px] leading-8 text-gray-600">
                        {!! nl2br(e(strip_tags($vendor->description))) !!}
                    </div>

                @else

                    <p class="mt-5 text-gray-500">
                        Information about this vendor will be available soon.
                    </p>

                @endif

            </div>

        </section>


        {{-- ========================================================
            SERVICES
        ========================================================= --}}

        <section
            id="services"
            class="mt-14 scroll-mt-24"
        >

            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

                <div>

                    <div class="flex items-center gap-2 text-sm font-medium text-[#C6952F]">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 64 64" fill="none">
                            <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="5" stroke-linecap="round" />
                            <circle cx="19" cy="46" r="4.5" fill="currentColor" />
                        </svg>
                        What they offer
                    </div>

                    <h2 class="mt-2 font-display text-3xl font-medium tracking-tight text-[#241019]">
                        Services
                    </h2>

                </div>

                <p class="max-w-md text-sm leading-6 text-gray-500">
                    Explore the services offered by {{ $vendor->business_name }}.
                </p>

            </div>


            @if($vendor->services->isNotEmpty())

                <div class="mt-7 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach($vendor->services as $service)

                        <div class="group rounded-2xl border border-[#EEE1CB] bg-white p-5 transition duration-300 hover:-translate-y-1 hover:border-[#C6952F]/60 hover:shadow-[0_16px_32px_-16px_rgba(122,16,48,0.2)]">

                            <div class="flex items-start gap-4">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E] transition group-hover:bg-[#D7385E] group-hover:text-white">

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.7"
                                            d="M5 12h14M12 5v14"
                                        />
                                    </svg>

                                </div>

                                <div class="min-w-0">

                                    <h3 class="font-semibold text-[#241019]">
                                        {{ $service->name }}
                                    </h3>

                                    @if($service->description)

                                        <p class="mt-1 line-clamp-2 text-sm leading-6 text-gray-500">
                                            {{ $service->description }}
                                        </p>

                                    @elseif($service->pivot?->description)

                                        <p class="mt-1 line-clamp-2 text-sm leading-6 text-gray-500">
                                            {{ $service->pivot->description }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="mt-7 rounded-2xl border border-dashed border-[#EEE1CB] bg-[#FFFCF8] p-8 text-center">

                    <p class="text-sm text-gray-500">
                        Services information will be available soon.
                    </p>

                </div>

            @endif

        </section>


        {{-- ========================================================
            EVENT TYPES
        ========================================================= --}}

        @if($vendor->eventTypes->isNotEmpty())

            <section class="mt-14">

                <div class="flex items-center gap-2 text-sm font-medium text-[#C6952F]">

                    <svg class="h-3.5 w-3.5" viewBox="0 0 64 64" fill="none">
                        <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="5" stroke-linecap="round" />
                        <circle cx="19" cy="46" r="4.5" fill="currentColor" />
                    </svg>

                    Perfect for

                </div>

                <h2 class="mt-2 font-display text-3xl font-medium tracking-tight text-[#241019]">
                    Events we cover
                </h2>

                <div class="mt-6 flex flex-wrap gap-3">

                    @foreach($vendor->eventTypes as $eventType)

                        <span class="rounded-full border border-[#EEE1CB] bg-white px-5 py-2.5 text-sm font-medium text-gray-700">
                            {{ $eventType->name }}
                        </span>

                    @endforeach

                </div>

            </section>

        @endif


        {{-- ========================================================
            PACKAGES
        ========================================================= --}}

        <section
            id="packages"
            class="mt-14 scroll-mt-24"
        >

            <div>

                <div class="flex items-center gap-2 text-sm font-medium text-[#C6952F]">

                    <svg class="h-3.5 w-3.5" viewBox="0 0 64 64" fill="none">
                        <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="5" stroke-linecap="round" />
                        <circle cx="19" cy="46" r="4.5" fill="currentColor" />
                    </svg>

                    Pricing

                </div>

                <h2 class="mt-2 font-display text-3xl font-medium tracking-tight text-[#241019]">
                    Packages
                </h2>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                    Choose from the packages offered by {{ $vendor->business_name }}.
                </p>

            </div>


            @if($vendor->packages->isNotEmpty())

                <div class="mt-7 grid gap-5 lg:grid-cols-2">

                    @foreach($vendor->packages as $package)

                        @php

                            $pricingType = strtolower(
                                str_replace(
                                    ['_', '-'],
                                    ' ',
                                    $package->pricing_type ?? ''
                                )
                            );

                        @endphp

                        <article class="group relative overflow-hidden rounded-3xl border border-[#EEE1CB] bg-white p-5 transition duration-300 hover:-translate-y-1 hover:border-[#C6952F]/60 hover:shadow-[0_20px_40px_-20px_rgba(122,16,48,0.25)]">

                            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#D7385E] to-[#C6952F]"></div>

                            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                                <div class="min-w-0">

                                    <h3 class="font-display text-xl font-medium text-[#241019]">
                                        {{ $package->name }}
                                    </h3>

                                    @if($package->description)

                                        <p class="mt-1.5 text-sm leading-6 text-gray-500">
                                            {{ $package->description }}
                                        </p>

                                    @endif

                                </div>


                                {{-- Price --}}
                                <div class="shrink-0 sm:text-right">

                                    @if(
                                        $package->min_price !== null &&
                                        $package->max_price !== null
                                    )

                                        <p class="font-display text-2xl font-medium text-[#D7385E]">
                                            PKR
                                            {{ number_format((float) $package->min_price) }}
                                            -
                                            {{ number_format((float) $package->max_price) }}
                                        </p>

                                    @elseif($package->price !== null)

                                        <p class="font-display text-2xl font-medium text-[#D7385E]">
                                            PKR
                                            {{ number_format((float) $package->price) }}
                                        </p>

                                    @elseif($package->min_price !== null)

                                        <p class="font-display text-2xl font-medium text-[#D7385E]">
                                            From PKR
                                            {{ number_format((float) $package->min_price) }}
                                        </p>

                                    @else

                                        <p class="text-sm font-semibold text-gray-500">
                                            Contact for pricing
                                        </p>

                                    @endif

                                    @if($pricingType)

                                        <p class="mt-1 text-xs capitalize text-gray-400">
                                            {{ $pricingType }}
                                        </p>

                                    @endif

                                </div>

                            </div>


                            {{-- Package Meta --}}
                            @if(
                                $package->duration ||
                                $package->guest_capacity
                            )

                                <div class="mt-4 flex flex-wrap gap-2">

                                    @if($package->duration)

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#FFFBF6] px-3 py-1.5 text-xs font-medium text-gray-600">

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="9"
                                                    stroke-width="1.7"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-width="1.7"
                                                    d="M12 7v5l3 2"
                                                />
                                            </svg>

                                            {{ $package->duration }}

                                        </span>

                                    @endif


                                    @if($package->guest_capacity)

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#FFFBF6] px-3 py-1.5 text-xs font-medium text-gray-600">

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
                                                    d="M16 20v-1a4 4 0 00-4-4H7a4 4 0 00-4 4v1M9.5 11a4 4 0 100-8 4 4 0 000 8zM21 20v-1a4 4 0 00-3-3.87M16.5 3.13a4 4 0 013 6.74"
                                                />
                                            </svg>

                                            Up to {{ $package->guest_capacity }} guests

                                        </span>

                                    @endif

                                </div>

                            @endif


                            {{-- Included Services --}}
                            @if($package->services->isNotEmpty())

                                <div class="mt-5 border-t border-dashed border-[#EEE1CB] pt-4">

                                    <p class="mb-3 text-xs font-semibold text-gray-400">
                                        Includes
                                    </p>

                                    <div class="grid gap-2 sm:grid-cols-2">

                                        @foreach($package->services->take(6) as $packageService)

                                            <div class="flex items-start gap-2 text-sm text-gray-600">

                                                <svg
                                                    class="mt-0.5 h-4 w-4 shrink-0 text-[#D7385E]"
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

                                                <span>
                                                    {{ $packageService->name }}
                                                </span>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            @endif

                        </article>

                    @endforeach

                </div>

            @else

                <div class="mt-7 rounded-2xl border border-dashed border-[#EEE1CB] bg-[#FFFCF8] p-8 text-center">

                    <p class="text-sm text-gray-500">
                        Package information will be available soon.
                    </p>

                </div>

            @endif

        </section>


        {{-- ========================================================
            LOCATION
        ========================================================= --}}

        <section
            id="location"
            class="mt-14 scroll-mt-24"
        >

            <div>

                <div class="flex items-center gap-2 text-sm font-medium text-[#C6952F]">

                    <svg class="h-3.5 w-3.5" viewBox="0 0 64 64" fill="none">
                        <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="5" stroke-linecap="round" />
                        <circle cx="19" cy="46" r="4.5" fill="currentColor" />
                    </svg>

                    Find us

                </div>

                <h2 class="mt-2 font-display text-3xl font-medium tracking-tight text-[#241019]">
                    Location
                </h2>

            </div>


            <div class="mt-7 grid overflow-hidden rounded-3xl border border-[#EEE1CB] bg-white lg:grid-cols-[.7fr_1.3fr]">

                {{-- Address --}}
                <div class="p-6 sm:p-7">

                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

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
                                d="M12 21s7-6.1 7-12a7 7 0 10-14 0c0 5.9 7 12 7 12z"
                            />

                            <circle
                                cx="12"
                                cy="9"
                                r="2.2"
                                stroke-width="1.8"
                            />

                        </svg>

                    </div>


                    @if($vendor->city)

                        <p class="mt-4 text-xs font-medium text-gray-400">
                            City
                        </p>

                        <p class="mt-1 font-display text-lg font-medium text-[#241019]">
                            {{ $vendor->city->name }}
                        </p>

                    @endif


                    @if($vendor->address)

                        <p class="mt-4 text-xs font-medium text-gray-400">
                            Address
                        </p>

                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            {{ $vendor->address }}
                        </p>

                    @endif


                    {{-- ====================================================
                        VIEW LOCATION LINK
                        Uses vendor's stored coordinates
                    ===================================================== --}}

                    @if($vendor->latitude !== null && $vendor->longitude !== null)

                        <a
                            href="https://www.openstreetmap.org/?mlat={{ (float) $vendor->latitude }}&mlon={{ (float) $vendor->longitude }}#map=16/{{ (float) $vendor->latitude }}/{{ (float) $vendor->longitude }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-[#D7385E] transition hover:text-[#A62347] hover:underline"
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
                                    d="M12 21s7-6.1 7-12a7 7 0 10-14 0c0 5.9 7 12 7 12z"
                                />

                                <circle
                                    cx="12"
                                    cy="9"
                                    r="2.2"
                                    stroke-width="1.8"
                                />

                            </svg>

                            View exact location

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
                                    d="M5 12h14M13 6l6 6-6 6"
                                />
                            </svg>

                        </a>

                    @endif


                    <!-- @if($vendor->phone_number)

                        <a
                            href="tel:{{ $vendor->phone_number }}"
                            class="mt-7 inline-flex items-center gap-2 text-sm font-semibold text-[#D7385E] hover:underline"
                        >

                            {{ $vendor->phone_number }}

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
                                    d="M5 12h14M13 6l6 6-6 6"
                                />
                            </svg>

                        </a>

                    @endif -->

                </div>


                {{-- Map --}}
{{-- Map --}}
<div class="min-h-[260px] bg-[#FBEBEF]">

    @if(
        $vendor->latitude !== null &&
        $vendor->longitude !== null &&
        is_numeric($vendor->latitude) &&
        is_numeric($vendor->longitude)
    )

        @php
            $latitude = (float) $vendor->latitude;
            $longitude = (float) $vendor->longitude;

            $bbox = implode(',', [
                $longitude - 0.03,
                $latitude - 0.03,
                $longitude + 0.03,
                $latitude + 0.03,
            ]);

            $mapUrl =
                'https://www.openstreetmap.org/export/embed.html'
                . '?bbox=' . urlencode($bbox)
                . '&layer=mapnik'
                . '&marker=' . $latitude . ',' . $longitude;

            $locationUrl =
                'https://www.openstreetmap.org/'
                . '?mlat=' . $latitude
                . '&mlon=' . $longitude
                . '#map=16/' . $latitude . '/' . $longitude;
        @endphp

        <div class="relative h-full min-h-[260px]">

            <iframe
                title="Location of {{ $vendor->business_name }}"
                src="{{ $mapUrl }}"
                class="h-full min-h-[260px] w-full border-0"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>

            {{-- Open in OpenStreetMap --}}
            <a
                href="{{ $locationUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="absolute bottom-3 right-3 inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-xs font-semibold text-[#241019] shadow-lg transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                        d="M12 6v12M6 12h12"
                    />
                </svg>

                Open in OpenStreetMap

            </a>

        </div>

    @else

        <div class="flex h-full min-h-[260px] items-center justify-center">

            <div class="text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-gray-400 shadow-sm">

                    <svg
                        class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M12 21s7-6.1 7-12a7 7 0 10-14 0c0 5.9 7 12 7 12z"
                        />

                        <circle
                            cx="12"
                            cy="9"
                            r="2"
                            stroke-width="1.7"
                        />

                    </svg>

                </div>

                <p class="mt-3 text-sm font-medium text-gray-500">
                    Map location not available
                </p>

            </div>

        </div>

    @endif

</div>

            </div>

        </section>


        {{-- ========================================================
            RELATED VENDORS
        ========================================================= --}}

        @if($relatedVendors->isNotEmpty())

            <section class="mt-16">

                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">

                    <div>

                        <div class="flex items-center gap-2 text-sm font-medium text-[#C6952F]">

                            <svg class="h-3.5 w-3.5" viewBox="0 0 64 64" fill="none">
                                <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="5" stroke-linecap="round" />
                                <circle cx="19" cy="46" r="4.5" fill="currentColor" />
                            </svg>

                            You may also like

                        </div>

                        <h2 class="mt-2 font-display text-3xl font-medium tracking-tight text-[#241019]">
                            Similar vendors
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            More vendors you may want to explore.
                        </p>

                    </div>

                </div>


                <div class="mt-7 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                    @foreach($relatedVendors as $relatedVendor)

                        @php

                            $relatedImage = $relatedVendor->images->first();

                            $relatedImageUrl = $relatedImage
                                ? asset('storage/' . $relatedImage->image_url)
                                : (
                                    $relatedVendor->cover_image
                                        ? asset('storage/' . $relatedVendor->cover_image)
                                        : null
                                );

                        @endphp


                        <a
                            href="{{ route('public.vendors.show', $relatedVendor->slug) }}"
                            class="group overflow-hidden rounded-2xl border border-[#EEE1CB] bg-white transition duration-300 hover:-translate-y-1 hover:border-[#C6952F]/60 hover:shadow-[0_20px_40px_-20px_rgba(122,16,48,0.25)]"
                        >

                            {{-- Image --}}
                            <div class="relative h-48 overflow-hidden bg-[#FBEBEF]">

                                @if($relatedImageUrl)

                                    <img
                                        src="{{ $relatedImageUrl }}"
                                        alt="{{ $relatedVendor->business_name }}"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                    >

                                @else

                                    <div class="flex h-full items-center justify-center">

                                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#D7385E] shadow-sm">

                                            <svg
                                                class="h-7 w-7"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.7"
                                                    d="M4 16l4.586-4.586a2 2 0 016.828 0L20 16M14 14l1.586-1.586a2 2 0 012.828 0L20 14"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="8"
                                                    r="1.5"
                                                />

                                            </svg>

                                        </div>

                                    </div>

                                @endif


                                @if($relatedVendor->is_verified)

                                    <span class="absolute left-3 top-3 inline-flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1 text-[11px] font-semibold text-[#D7385E] shadow-sm backdrop-blur">

                                        <svg
                                            class="h-3.5 w-3.5"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.7-9.7a1 1 0 00-1.4-1.4L9 10.2 7.7 8.9a1 1 0 00-1.4 1.4l2 2a1 1 0 001.4 0l4-4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>

                                        Verified

                                    </span>

                                @endif

                            </div>


                            {{-- Content --}}
                            <div class="p-4">

                                <div class="flex items-start justify-between gap-3">

                                    <h3 class="line-clamp-2 font-semibold text-[#241019] transition group-hover:text-[#A62347]">
                                        {{ $relatedVendor->business_name }}
                                    </h3>

                                    <svg
                                        class="mt-1 h-4 w-4 shrink-0 text-gray-300 transition group-hover:translate-x-1 group-hover:text-[#D7385E]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.7"
                                            d="M5 12h14M13 6l6 6-6 6"
                                        />
                                    </svg>

                                </div>


                                <div class="mt-2.5 flex items-center gap-2 text-sm">

                                    <span class="flex items-center gap-1 font-semibold text-[#241019]">

                                        <svg
                                            class="h-4 w-4 fill-current text-[#C6952F]"
                                            viewBox="0 0 20 20"
                                        >
                                            <path d="M10 1.7l2.47 5 5.53.8-.94 5.5L10 14.3l-4.94 2.6.94-5.5-4-3.9 5.53-.8L10 1.7z"/>
                                        </svg>

                                        {{ number_format((float) $relatedVendor->avg_rating, 1) }}

                                    </span>

                                    <span class="text-gray-300">
                                        •
                                    </span>

                                    <span class="text-gray-400">
                                        {{ $relatedVendor->review_count }} reviews
                                    </span>

                                </div>


                                @if($relatedVendor->city)

                                    <div class="mt-2.5 flex items-center gap-1.5 text-xs text-gray-500">

                                        <svg
                                            class="h-4 w-4 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.7"
                                                d="M12 21s7-6.1 7-12a7 7 0 10-14 0c0 5.9 7 12 7 12z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="9"
                                                r="2"
                                                stroke-width="1.7"
                                            />

                                        </svg>

                                        {{ $relatedVendor->city->name }}

                                    </div>

                                @endif

                            </div>

                        </a>

                    @endforeach

                </div>

            </section>

        @endif

    </main>


    {{-- ============================================================
        GALLERY MODAL
    ============================================================= --}}

    @if($galleryImages->isNotEmpty())

        <div
            id="galleryModal"
            class="fixed inset-0 z-[100] hidden bg-black/90 p-4 backdrop-blur-sm sm:p-8"
        >

            <div class="relative flex h-full items-center justify-center">

                {{-- Close --}}
                <button
                    type="button"
                    onclick="closeGallery()"
                    class="absolute right-2 top-2 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 sm:right-4 sm:top-4"
                    aria-label="Close gallery"
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
                            d="M6 6l12 12M18 6L6 18"
                        />
                    </svg>

                </button>


                {{-- Previous --}}
                <button
                    type="button"
                    onclick="previousGalleryImage()"
                    class="absolute left-2 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 sm:left-5"
                    aria-label="Previous image"
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
                            d="M15 18l-6-6 6-6"
                        />
                    </svg>

                </button>


                {{-- Image --}}
                <div class="flex max-h-full max-w-6xl flex-col items-center">

                    <img
                        id="galleryModalImage"
                        src=""
                        alt=""
                        class="max-h-[82vh] max-w-full rounded-2xl object-contain shadow-2xl"
                    >

                    <p
                        id="galleryModalTitle"
                        class="mt-4 text-center text-sm font-medium text-white/80"
                    ></p>

                </div>


                {{-- Next --}}
                <button
                    type="button"
                    onclick="nextGalleryImage()"
                    class="absolute right-2 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 sm:right-5"
                    aria-label="Next image"
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
                            d="M9 18l6-6-6-6"
                        />
                    </svg>

                </button>

            </div>

        </div>

    @endif

</div>


{{-- ================================================================
    GALLERY JAVASCRIPT
================================================================ --}}

@if($galleryImages->isNotEmpty())

    <script>
        const galleryImages = @json(
            $galleryImages->map(function ($image) {
                return [
                    'url' => asset('storage/' . $image->image_url),
                    'title' => $image->title ?: '',
                ];
            })->values()
        );

        let currentGalleryIndex = 0;

        function openGallery(index) {

            if (!galleryImages.length) {
                return;
            }

            currentGalleryIndex = index;

            updateGalleryModal();

            const modal = document.getElementById('galleryModal');

            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');
        }


        function closeGallery() {

            const modal = document.getElementById('galleryModal');

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');
        }


        function updateGalleryModal() {

            const image = galleryImages[currentGalleryIndex];

            document.getElementById('galleryModalImage').src = image.url;

            document.getElementById('galleryModalImage').alt =
                image.title || '{{ addslashes($vendor->business_name) }}';

            document.getElementById('galleryModalTitle').textContent =
                image.title || '';
        }


        function previousGalleryImage() {

            currentGalleryIndex =
                (currentGalleryIndex - 1 + galleryImages.length)
                % galleryImages.length;

            updateGalleryModal();
        }


        function nextGalleryImage() {

            currentGalleryIndex =
                (currentGalleryIndex + 1)
                % galleryImages.length;

            updateGalleryModal();
        }


        document.addEventListener('keydown', function (event) {

            const modal = document.getElementById('galleryModal');

            if (!modal || modal.classList.contains('hidden')) {
                return;
            }

            if (event.key === 'Escape') {
                closeGallery();
            }

            if (event.key === 'ArrowLeft') {
                previousGalleryImage();
            }

            if (event.key === 'ArrowRight') {
                nextGalleryImage();
            }

        });


        document
            .getElementById('galleryModal')
            ?.addEventListener('click', function (event) {

                if (event.target === this) {
                    closeGallery();
                }

            });
    </script>

@endif


{{-- ================================================================
    SECTION TABS — SCROLLSPY + SLIDING INDICATOR + STICKY SHADOW
================================================================ --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const tabLinks   = Array.from(document.querySelectorAll('.tab-link'));
        const indicator  = document.getElementById('tabIndicator');
        const stickyNav  = document.getElementById('stickyNav');

        if (!tabLinks.length || !indicator) {
            return;
        }

        const sections = tabLinks
            .map(function (link) {
                return document.querySelector(link.getAttribute('href'));
            })
            .filter(Boolean);


        function setActiveTab(link) {

            tabLinks.forEach(function (l) {
                l.classList.remove('text-[#D7385E]');
                l.classList.add('text-gray-500');
            });

            link.classList.remove('text-gray-500');
            link.classList.add('text-[#D7385E]');

            moveIndicator(link);
        }


        function moveIndicator(link) {

            if (!link) {
                return;
            }

            indicator.style.width = link.offsetWidth + 'px';
            indicator.style.transform = 'translateX(' + link.offsetLeft + 'px)';
        }


        requestAnimationFrame(function () {
            setActiveTab(tabLinks[0]);
        });


        tabLinks.forEach(function (link) {

            link.addEventListener('click', function (event) {

                event.preventDefault();

                const target = document.querySelector(
                    this.getAttribute('href')
                );

                if (target) {

                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });

                }

                setActiveTab(this);

            });

        });


        if ('IntersectionObserver' in window) {

            const observer = new IntersectionObserver(
                function (entries) {

                    entries.forEach(function (entry) {

                        if (!entry.isIntersecting) {
                            return;
                        }

                        const activeLink = tabLinks.find(function (link) {
                            return link.getAttribute('href') ===
                                '#' + entry.target.id;
                        });

                        if (activeLink) {
                            setActiveTab(activeLink);
                        }

                    });

                },
                {
                    rootMargin: '-45% 0px -50% 0px',
                    threshold: 0,
                }
            );

            sections.forEach(function (section) {
                observer.observe(section);
            });

        }


        window.addEventListener('scroll', function () {

            if (!stickyNav) {
                return;
            }

            if (window.scrollY > 80) {
                stickyNav.classList.add('shadow-md');
                stickyNav.classList.remove('shadow-sm');
            } else {
                stickyNav.classList.add('shadow-sm');
                stickyNav.classList.remove('shadow-md');
            }

        });


        window.addEventListener('resize', function () {

            const active = tabLinks.find(function (link) {
                return link.classList.contains('text-[#D7385E]');
            });

            if (active) {
                moveIndicator(active);
            }

        });

    });
</script>

@endsection