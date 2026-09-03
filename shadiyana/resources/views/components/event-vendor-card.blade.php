@props(['vendor'])

@php
    $image = $vendor->cover_image
        ? asset('storage/' . $vendor->cover_image)
        : ($vendor->logo_image
            ? asset('storage/' . $vendor->logo_image)
            : null);
@endphp

<div
    class="
        group
        relative
        w-[260px]
        shrink-0
        overflow-hidden
        rounded-2xl
        border
        border-gray-200
        bg-white
        shadow-[0_4px_20px_rgba(16,33,58,0.05)]
        transition-all
        duration-300
        hover:-translate-y-1
        hover:shadow-[0_12px_35px_rgba(16,33,58,0.12)]
    "
>

    {{-- ============================================================
        IMAGE
    ============================================================= --}}

    <div class="relative h-48 overflow-hidden bg-[#f7f7f7]">

        @if($image)

            <img
                src="{{ $image }}"
                alt="{{ $vendor->business_name }}"
                class="
                    h-full
                    w-full
                    object-cover
                    transition
                    duration-500
                    group-hover:scale-105
                "
                loading="lazy"
            >

        @else

            <div
                class="
                    flex
                    h-full
                    w-full
                    items-center
                    justify-center
                    bg-[#fbebef]
                    text-[#D7385E]
                "
            >

                <svg
                    class="h-12 w-12"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 21h18M5 21V7a2 2 0 012-2h10a2 2 0 012 2v14M8 9h1M8 13h1M8 17h1M15 9h1M15 13h1M15 17h1"
                    />
                </svg>

            </div>

        @endif


        {{-- Image overlay --}}

        <div
            class="
                absolute
                inset-x-0
                bottom-0
                h-20
                bg-gradient-to-t
                from-black/40
                to-transparent
                opacity-0
                transition
                duration-300
                group-hover:opacity-100
            "
        ></div>

    </div>


    {{-- ============================================================
        BUSINESS INFORMATION
    ============================================================= --}}

    <div class="px-4 py-4">

        <h3
            class="
                truncate
                text-base
                font-bold
                text-[#10213A]
                transition
                group-hover:text-[#D7385E]
            "
            title="{{ $vendor->business_name }}"
        >
            {{ $vendor->business_name }}
        </h3>


        {{-- City --}}

        @if($vendor->city)

            <div
                class="
                    mt-2
                    flex
                    items-center
                    gap-1.5
                    text-xs
                    text-[#71829B]
                "
            >

                <svg
                    class="h-3.5 w-3.5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
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
                    {{ $vendor->city->name }}
                </span>

            </div>

        @endif


        {{-- Rating --}}

        <div class="mt-3 flex items-center gap-2">

            <div class="flex items-center gap-1">

                <svg
                    class="h-4 w-4 fill-current text-amber-400"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 1.8l2.47 5.01 5.53.8-4 3.9.94 5.51L10 14.42 5.06 17l.94-5.49-4-3.9 5.53-.8L10 1.8z"
                    />
                </svg>

                <span class="text-sm font-semibold text-[#10213A]">
                    {{ number_format((float) $vendor->avg_rating, 1) }}
                </span>

            </div>


            <span class="text-gray-300">
                •
            </span>


            <span class="text-xs text-[#71829B]">
                {{ $vendor->review_count ?? 0 }}
                {{ ($vendor->review_count ?? 0) === 1 ? 'review' : 'reviews' }}
            </span>

        </div>

    </div>

</div>