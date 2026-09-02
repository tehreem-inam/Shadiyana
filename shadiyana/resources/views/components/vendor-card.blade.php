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
    class="group block"
>

    <article
        class="
            relative
            overflow-hidden
            rounded-[20px]
            border
            border-gray-200
            bg-white
            shadow-[0_4px_20px_rgba(16,33,58,0.05)]
            transition-all
            duration-300
            hover:-translate-y-0.5
            hover:border-[#efd3db]
            hover:shadow-[0_12px_32px_rgba(16,33,58,0.10)]
        "
    >

        <div
            class="
                flex
                min-h-[265px]
                flex-col
                md:flex-row
            "
        >

            {{-- =========================================================
                IMAGE
            ========================================================== --}}

            <div
                class="
                    relative
                    w-full
                    shrink-0
                    md:w-[245px]
                    lg:w-[270px]
                    xl:w-[290px]
                "
            >

                <div
                    class="
                        relative
                        h-[210px]
                        overflow-hidden
                        md:h-full
                        md:min-h-[265px]
                    "
                >

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
                            group-hover:scale-[1.045]
                        "
                        loading="lazy"
                    >


                    {{-- Image overlay --}}

                    <div
                        class="
                            pointer-events-none
                            absolute
                            inset-0
                            bg-gradient-to-t
                            from-black/25
                            via-transparent
                            to-transparent
                        "
                    ></div>


                    {{-- =================================================
                        FEATURED
                    ================================================== --}}

                    @if($vendor->is_featured)

                        <div
                            class="
                                absolute
                                left-0
                                top-4
                                z-10
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-1.5
                                    rounded-r-full
                                    bg-[#10213A]
                                    px-3
                                    py-1.5
                                    text-[10px]
                                    font-bold
                                    text-white
                                    shadow-md
                                "
                            >

                                <svg
                                    class="h-3.5 w-3.5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M10 1.5l2.47 5 5.53.8-4 3.9.94 5.5L10 14.1l-4.94 2.6.94-5.5-4-3.9 5.53-.8L10 1.5z"
                                    />
                                </svg>

                                Top Pick

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                        VERIFIED
                    ================================================== --}}

                    @if($vendor->is_verified)

                        <div
                            class="
                                absolute
                                bottom-3
                                left-3
                                inline-flex
                                items-center
                                gap-1.5
                                rounded-full
                                bg-white/95
                                px-2.5
                                py-1
                                text-[10px]
                                font-semibold
                                text-[#10213A]
                                shadow-sm
                                backdrop-blur
                            "
                        >

                            <span
                                class="
                                    flex
                                    h-4
                                    w-4
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-[#D7385E]
                                    text-white
                                "
                            >

                                <svg
                                    class="h-2.5 w-2.5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="3"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 13l4 4L19 7"
                                    />
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

            <div
                class="
                    flex
                    min-w-0
                    flex-1
                    flex-col
                    px-5
                    py-5
                    lg:px-6
                "
            >

                {{-- Header --}}

                <div>

                    <div
                        class="
                            flex
                            items-center
                            gap-2
                        "
                    >

                        <h2
                            class="
                                min-w-0
                                truncate
                                text-[21px]
                                font-bold
                                leading-tight
                                tracking-tight
                                text-[#10213A]
                                transition-colors
                                group-hover:text-[#D7385E]
                            "
                        >
                            {{ $vendor->business_name }}
                        </h2>


                        @if($vendor->is_verified)

                            <span
                                class="
                                    flex
                                    h-[19px]
                                    w-[19px]
                                    shrink-0
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-[#10213A]
                                    text-white
                                "
                            >

                                <svg
                                    class="h-2.5 w-2.5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="3"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                            </span>

                        @endif

                    </div>


                    {{-- Location --}}

                    @if($location)

                        <div
                            class="
                                mt-2
                                flex
                                items-center
                                gap-2
                                text-[13px]
                                text-[#71829B]
                            "
                        >

                            <svg
                                class="h-4 w-4 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 21s7-6.2 7-12a7 7 0 10-14 0c0 5.8 7 12 7 12z"
                                />

                                <circle
                                    cx="12"
                                    cy="9"
                                    r="2.2"
                                />
                            </svg>

                            <span class="truncate">
                                {{ $location }}
                            </span>

                        </div>

                    @endif


                    {{-- Rating --}}

                    <div
                        class="
                            mt-2.5
                            flex
                            items-center
                            gap-2
                            text-xs
                        "
                    >

                        <svg
                            class="h-4 w-4 text-amber-400"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M10 1.5l2.47 5 5.53.8-4 3.9.94 5.5L10 14.1l-4.94 2.6.94-5.5-4-3.9 5.53-.8L10 1.5z"
                            />
                        </svg>

                        <span class="font-bold text-gray-900">
                            {{ $ratingFormatted }}
                        </span>

                        <span class="text-gray-300">
                            •
                        </span>

                        <span class="text-gray-500">
                            {{ number_format($reviewCount) }}
                            {{ $reviewCount === 1 ? 'review' : 'reviews' }}
                        </span>

                    </div>

                </div>


                {{-- =====================================================
                    DESCRIPTION
                ====================================================== --}}

                <div
                    class="
                        mt-3
                        border-t
                        border-gray-100
                        pt-3
                    "
                >

                    @if($vendor->description)

                        <p
                            class="
                                line-clamp-2
                                text-[13px]
                                leading-5
                                text-gray-600
                            "
                        >
                            {{ \Illuminate\Support\Str::limit(
                                strip_tags($vendor->description),
                                135
                            ) }}
                        </p>

                    @else

                        <p
                            class="
                                text-[13px]
                                leading-5
                                text-gray-400
                            "
                        >
                            Discover more about this wedding vendor
                            and their services.
                        </p>

                    @endif

                </div>


                {{-- =====================================================
                    TAXONOMY
                ====================================================== --}}

                @if($vendorTaxonomies->count())

                    <div
                        class="
                            mt-3
                            flex
                            flex-wrap
                            gap-1.5
                        "
                    >

                        @foreach($vendorTaxonomies->take(2) as $vendorTaxonomy)

                            <span
                                class="
                                    inline-flex
                                    items-center
                                    gap-1
                                    rounded-md
                                    bg-[#fff5f7]
                                    px-2
                                    py-1
                                    text-[9px]
                                    font-medium
                                    text-[#b82f50]
                                "
                            >

                                @if($vendorTaxonomy->parent)

                                    {{ $vendorTaxonomy->parent->name }}

                                    <svg
                                        class="h-2.5 w-2.5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>

                                @endif

                                {{ $vendorTaxonomy->name }}

                            </span>

                        @endforeach

                    </div>

                @endif


                {{-- =====================================================
                    FEATURES
                ====================================================== --}}

                <div
                    class="
                        mt-auto
                        grid
                        grid-cols-3
                        gap-2
                        pt-3
                    "
                >

                    @foreach($features as $feature)

                        <div
                            class="
                                flex
                                min-h-[48px]
                                items-center
                                justify-center
                                gap-1.5
                                rounded-lg
                                border
                                border-gray-100
                                bg-gray-50/70
                                px-2
                                py-1.5
                                text-center
                            "
                        >

                            {{-- Category --}}

                            @if($feature['icon'] === 'category')

                                <svg
                                    class="h-3.5 w-3.5 shrink-0 text-[#D7385E]"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                </svg>


                            {{-- Team --}}

                            @elseif($feature['icon'] === 'team')

                                <svg
                                    class="h-3.5 w-3.5 shrink-0 text-[#D7385E]"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                    />

                                    <circle
                                        cx="9"
                                        cy="7"
                                        r="4"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                    />
                                </svg>


                            {{-- Calendar --}}

                            @elseif($feature['icon'] === 'calendar')

                                <svg
                                    class="h-3.5 w-3.5 shrink-0 text-[#D7385E]"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    viewBox="0 0 24 24"
                                >
                                    <rect
                                        x="3"
                                        y="4"
                                        width="18"
                                        height="17"
                                        rx="2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M16 2v4M8 2v4M3 10h18"
                                    />
                                </svg>


                            {{-- Quality --}}

                            @else

                                <svg
                                    class="h-3.5 w-3.5 shrink-0 text-[#D7385E]"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12l2 2 4-4"
                                    />
                                </svg>

                            @endif


                            <span
                                class="
                                    line-clamp-1
                                    text-[9px]
                                    font-medium
                                    text-gray-600
                                "
                            >
                                {{ $feature['name'] }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- =========================================================
                PRICE / CTA
            ========================================================== --}}

            <div
                class="
                    flex
                    w-full
                    shrink-0
                    flex-col
                    justify-center
                    border-t
                    border-gray-100
                    px-5
                    py-5
                    md:w-[185px]
                    md:border-l
                    md:border-t-0
                    lg:w-[205px]
                    xl:w-[220px]
                "
            >

                {{-- Pricing --}}

                @if($startingPrice !== null)

                    <p
                        class="
                            text-[11px]
                            font-medium
                            text-[#71829B]
                        "
                    >
                        Starting from
                    </p>

                    <p
                        class="
                            mt-1
                            text-[19px]
                            font-bold
                            text-[#10213A]
                        "
                    >
                        PKR {{ number_format($startingPrice) }}
                    </p>

                @else

                    <p
                        class="
                            text-[11px]
                            font-medium
                            text-[#71829B]
                        "
                    >
                        Pricing
                    </p>

                    <p
                        class="
                            mt-1
                            text-[19px]
                            font-bold
                            text-[#D7385E]
                        "
                    >
                        View Packages
                    </p>

                @endif


                {{-- CTA --}}

                <span
                    class="
                        mt-4
                        flex
                        w-full
                        items-center
                        justify-between
                        gap-2
                        rounded-xl
                        bg-[#D7385E]
                        px-4
                        py-3
                        text-xs
                        font-semibold
                        leading-4
                        text-white
                        shadow-sm
                        transition-all
                        duration-200
                        group-hover:bg-[#c52f52]
                        group-hover:shadow-md
                    "
                >

                    <span>
                        Check Availability
                        <br>
                        & Pricing
                    </span>

                    <svg
                        class="
                            h-4
                            w-4
                            shrink-0
                            transition-transform
                            duration-300
                            group-hover:translate-x-1
                        "
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12h14M13 6l6 6-6 6"
                        />
                    </svg>

                </span>


                {{-- Secure booking --}}

                <div
                    class="
                        mt-3
                        flex
                        items-center
                        gap-1.5
                        text-[10px]
                        text-gray-400
                    "
                >

                    <svg
                        class="h-3.5 w-3.5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.6"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4"
                        />
                    </svg>

                    Secure Booking

                </div>

            </div>

        </div>

    </article>

</a>