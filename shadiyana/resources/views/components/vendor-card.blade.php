{{--
    Uses "Fraunces" as the display serif for the business name and price
    figure. Add this once in your layout <head> if it isn't already there:

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">
--}}

@props(['vendor'])

@php

    /*
    |--------------------------------------------------------------------------
    | Cover Image
    |--------------------------------------------------------------------------
    */

    $coverImage = $vendor->cover_image
        ? asset('storage/' . $vendor->cover_image)
        : asset('images/vendor-placeholder.jpg');


    /*
    |--------------------------------------------------------------------------
    | Location
    |--------------------------------------------------------------------------
    */

    $locationParts = [];

    if ($vendor->address) {
        $locationParts[] = $vendor->address;
    }

    if ($vendor->city?->name) {
        $locationParts[] = $vendor->city->name;
    }

    $location = implode(', ', $locationParts);


    /*
    |--------------------------------------------------------------------------
    | Rating
    |--------------------------------------------------------------------------
    */

    $rating = (float) ($vendor->avg_rating ?? 0);

    $ratingFormatted = number_format($rating, 1);

    $reviewCount = (int) ($vendor->review_count ?? 0);


    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    */

    $vendorTaxonomies = $vendor->taxonomies->take(4);


    /*
    |--------------------------------------------------------------------------
    | Vendor URL
    |--------------------------------------------------------------------------
    */

    $vendorUrl = url('/vendors/' . $vendor->slug);


    /*
    |--------------------------------------------------------------------------
    | Starting Price
    |--------------------------------------------------------------------------
    */

    $startingPrice = null;

    if ($vendor->relationLoaded('packages')) {

        $startingPrice = $vendor->packages
            ->where('status', 'active')
            ->pluck('price')
            ->filter(fn ($price) => is_numeric($price))
            ->min();

    }


    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    */

    $features = [];

    foreach ($vendorTaxonomies->take(1) as $vendorTaxonomy) {

        $features[] = [
            'name' => $vendorTaxonomy->name,
            'icon' => 'category',
        ];

    }


    $defaultFeatures = [

        [
            'name' => 'Professional Team',
            'icon' => 'team',
        ],

        [
            'name' => 'On-time Delivery',
            'icon' => 'calendar',
        ],

        [
            'name' => 'Quality Service',
            'icon' => 'quality',
        ],

    ];


    foreach ($defaultFeatures as $feature) {

        if (count($features) >= 3) {
            break;
        }

        $features[] = $feature;

    }

    $features = collect($features)->take(3);

@endphp


<a
    href="{{ $vendorUrl }}"
    class="
        group
        block
        rounded-[22px]
        focus-visible:outline-none
        focus-visible:ring-2
        focus-visible:ring-[#D7385E]
        focus-visible:ring-offset-2
    "
>

    <article
        class="
            relative
            overflow-hidden
            rounded-[22px]
            border
            border-[#ECE1E5]
            bg-white
            shadow-[0_4px_24px_rgba(19,27,46,0.05)]
            transition-[border-color,box-shadow]
            duration-300
            motion-reduce:transition-none
            group-hover:border-[#E7C9A8]
            group-hover:shadow-[0_14px_36px_rgba(19,27,46,0.09)]
        "
    >

        <div class="flex min-h-[236px] flex-col md:flex-row">

            {{-- =========================================================
                IMAGE
            ========================================================== --}}

            <div class="relative w-full shrink-0 md:w-[240px] lg:w-[264px] xl:w-[284px]">

                <div class="relative h-[188px] overflow-hidden md:h-full md:min-h-[236px]">

                    <img
                        src="{{ $coverImage }}"
                        alt="{{ $vendor->business_name }}"
                        class="
                            absolute
                            inset-0
                            h-full
                            w-full
                            object-cover
                            transition-transform
                            duration-700
                            ease-out
                            motion-reduce:transition-none
                            group-hover:scale-[1.05]
                        "
                        loading="lazy"
                    >

                    {{-- Image overlay --}}

                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/30 via-black/0 to-transparent"></div>


                    {{-- =================================================
                        FEATURED
                    ================================================== --}}

                    @if($vendor->is_featured)

                        <div class="absolute left-0 top-4 z-10">

                            <div class="flex items-center gap-1.5 rounded-r-full bg-[#131B2E] py-1.5 pl-3 pr-3.5 text-[11px] font-medium text-white shadow-md">

                                <svg class="h-3 w-3 text-[#E4B673]" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 1.5l2.47 5 5.53.8-4 3.9.94 5.5L10 14.1l-4.94 2.6.94-5.5-4-3.9 5.53-.8L10 1.5z"/>
                                </svg>

                                Top Pick

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                        VERIFIED
                    ================================================== --}}

                    @if($vendor->is_verified)

                        <div class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-full bg-white/95 py-1 pl-1 pr-2.5 text-[11px] font-medium text-[#131B2E] shadow-sm backdrop-blur">

                            <span class="flex h-[18px] w-[18px] items-center justify-center rounded-full bg-[#F4E8D9]">
                                <svg class="h-2.5 w-2.5 text-[#B8894C]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>

                            Verified

                        </div>

                    @endif

                </div>

            </div>


            {{-- =========================================================
                INFORMATION
            ========================================================== --}}

            <div class="flex min-w-0 flex-1 flex-col px-4 py-4 lg:px-5">

                <div>

                    <div class="flex items-center gap-2">

                        <h2
                            class="min-w-0 truncate text-[22px] font-semibold leading-tight tracking-tight text-[#131B2E] transition-colors duration-200 group-hover:text-[#B92D4E]"
                            style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                        >
                            {{ $vendor->business_name }}
                        </h2>

                        @if($vendor->is_verified)

                            <span class="flex h-[19px] w-[19px] shrink-0 items-center justify-center rounded-full bg-[#F4E8D9]">
                                <svg class="h-2.5 w-2.5 text-[#B8894C]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>

                        @endif

                    </div>


                    {{-- Location --}}

                    @if($location)

                        <div class="mt-1 flex items-center gap-1.5 text-[13px] text-[#6B7A99]">

                            <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-6.2 7-12a7 7 0 10-14 0c0 5.8 7 12 7 12z"/>
                                <circle cx="12" cy="9" r="2.2"/>
                            </svg>

                            <span class="truncate">{{ $location }}</span>

                        </div>

                    @endif


                    {{-- Rating --}}

                    <div class="mt-1.5 flex items-center gap-1.5 text-[13px]">

                        <svg class="h-3.5 w-3.5 text-[#B8894C]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 1.5l2.47 5 5.53.8-4 3.9.94 5.5L10 14.1l-4.94 2.6.94-5.5-4-3.9 5.53-.8L10 1.5z"/>
                        </svg>

                        <span class="font-semibold text-[#131B2E]">{{ $ratingFormatted }}</span>

                        <span class="text-[#D8DEE9]">·</span>

                        <span class="text-[#6B7A99]">
                            {{ number_format($reviewCount) }} {{ $reviewCount === 1 ? 'review' : 'reviews' }}
                        </span>

                    </div>

                </div>


                {{-- =====================================================
                    TAXONOMY
                ====================================================== --}}

                @if($vendorTaxonomies->count())

                    <div class="mt-2.5 flex flex-wrap gap-1.5">

                        @foreach($vendorTaxonomies->take(2) as $vendorTaxonomy)

                            <span class="inline-flex items-center rounded-full border border-[#F0DCE2] px-2 py-0.5 text-[11px] font-medium text-[#B92D4E]">

                                @if($vendorTaxonomy->parent)
                                    {{ $vendorTaxonomy->parent->name }}
                                    <span class="mx-1 text-[#E7B9C4]">·</span>
                                @endif

                                {{ $vendorTaxonomy->name }}

                            </span>

                        @endforeach

                    </div>

                @endif


                {{-- =====================================================
                    FEATURES — inline spec strip, not boxed chiclets
                ====================================================== --}}

                <div class="mt-auto flex items-center gap-2.5 border-t border-[#F1EDEC] pt-2.5 text-[12px] text-[#4B5872]">

                    @foreach($features as $index => $feature)

                        @if($index > 0)
                            <span class="h-3 w-px shrink-0 bg-[#E5E1DE]"></span>
                        @endif

                        <span class="flex items-center gap-1.5">

                            @if($feature['icon'] === 'category')

                                <svg class="h-3.5 w-3.5 shrink-0 text-[#B8894C]" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>

                            @elseif($feature['icon'] === 'team')

                                <svg class="h-3.5 w-3.5 shrink-0 text-[#B8894C]" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                                </svg>

                            @elseif($feature['icon'] === 'calendar')

                                <svg class="h-3.5 w-3.5 shrink-0 text-[#B8894C]" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                                    <path stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>

                            @else

                                <svg class="h-3.5 w-3.5 shrink-0 text-[#B8894C]" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                                </svg>

                            @endif

                            <span class="truncate">{{ $feature['name'] }}</span>

                        </span>

                    @endforeach

                </div>

            </div>


            {{-- =========================================================
                PRICE / CTA — styled as a ticket stub
            ========================================================== --}}

            <div
                class="
                    flex
                    w-full
                    shrink-0
                    flex-col
                    justify-center
                    border-t
                    border-dashed
                    border-[#E2D7C9]
                   
                    px-4
                    py-4
                    md:w-[188px]
                    md:border-l
                    md:border-t-0
                    lg:w-[208px]
                    xl:w-[222px]
                "
            >

                {{-- Pricing --}}

                @if($startingPrice !== null)

                    <p class="text-[11px] font-medium text-[#8A7A63]">Starting from</p>

                    <p
                        class="mt-0.5 text-[21px] font-semibold text-[#131B2E]"
                        style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                    >
                        PKR {{ number_format($startingPrice) }}
                    </p>

                @else

                    <p class="text-[11px] font-medium text-[#8A7A63]">Pricing</p>

                    <p
                        class="mt-0.5 text-[21px] font-semibold text-[#B92D4E]"
                        style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                    >
                        View packages
                    </p>

                @endif


                {{-- CTA --}}

                <span
                    class="
                        mt-3
                        flex
                        w-full
                        items-center
                        justify-between
                        gap-2
                        rounded-full
                        bg-[#D7385E]
                        px-3.5
                        py-2.5
                        text-[12.5px]
                        font-semibold
                        text-white
                        shadow-sm
                        transition-colors
                        duration-200
                        motion-reduce:transition-none
                        group-hover:bg-[#B92D4E]
                    "
                >

                    <span>
                        Check Availability
                        <br>
                        & Pricing
                    </span>

                    <svg
                        class="h-4 w-4 shrink-0 transition-transform duration-300 motion-reduce:transition-none group-hover:translate-x-1"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>

                </span>


                {{-- Secure booking --}}

                <div class="mt-2 flex items-center gap-1.5 text-[10.5px] text-[#9A8B75]">

                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                    </svg>

                    Secure Booking

                </div>

            </div>

        </div>

    </article>

</a>