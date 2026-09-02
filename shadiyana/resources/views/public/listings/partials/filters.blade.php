@php
    $mobile = $mobile ?? false;
@endphp


<form
    method="GET"
    action="{{ url('/listings') }}"
    class="
        overflow-hidden
        rounded-2xl
        border
        border-gray-200
        bg-white
        shadow-[0_8px_30px_rgba(0,0,0,0.04)]
    "
>

    {{-- ============================================================
        PRESERVE CATEGORY
    ============================================================= --}}

    @if($categorySlug)

        <input
            type="hidden"
            name="category"
            value="{{ $categorySlug }}"
        >

    @endif


    {{-- ============================================================
        PRESERVE TAXONOMY
    ============================================================= --}}

    @if($taxonomySlug)

        <input
            type="hidden"
            name="slug"
            value="{{ $taxonomySlug }}"
        >

    @endif


    {{-- ============================================================
        PRESERVE SORT
    ============================================================= --}}

    @if(request('sort'))

        <input
            type="hidden"
            name="sort"
            value="{{ request('sort') }}"
        >

    @endif


    {{-- ============================================================
        FILTER HEADER
    ============================================================= --}}

    <div
        class="
            flex
            items-center
            justify-between
            border-b
            border-gray-100
            px-5
            py-5
        "
    >

        <div>

            <div class="flex items-center gap-2">

                <span
                    class="
                        flex
                        h-8
                        w-8
                        items-center
                        justify-center
                        rounded-lg
                        bg-[#fbebef]
                        text-[#D7385E]
                    "
                >

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M7 12h10M10 18h4"
                        />
                    </svg>

                </span>


                <h2
                    class="
                        text-base
                        font-bold
                        tracking-tight
                        text-[#10213A]
                    "
                >
                    Filter
                </h2>

            </div>


            <p class="mt-1 text-xs text-gray-400">
                Refine your results
            </p>

        </div>

    </div>


    {{-- ============================================================
        CITY
    ============================================================= --}}

    <div
        class="
            border-b
            border-gray-100
            px-5
            py-5
        "
    >

        <div class="mb-4 flex items-center justify-between">

            <h3
                class="
                    text-sm
                    font-bold
                    text-[#10213A]
                "
            >
                City
            </h3>

            @if(request('city'))

                <a
                    href="{{ request()->fullUrlWithoutQuery(['city']) }}"
                    class="
                        text-[11px]
                        font-medium
                        text-[#D7385E]
                        hover:underline
                    "
                >
                    Clear
                </a>

            @endif

        </div>


        <div class="space-y-2.5">

            @foreach($cities as $city)

                <label
                    class="
                        group
                        flex
                        cursor-pointer
                        items-center
                        justify-between
                        rounded-xl
                        border
                        border-transparent
                        px-3
                        py-2.5
                        transition
                        hover:border-[#f4d7df]
                        hover:bg-[#fff8fa]
                    "
                >

                    <span
                        class="
                            flex
                            items-center
                            gap-3
                            text-sm
                            text-gray-600
                            group-hover:text-[#10213A]
                        "
                    >

                        <input
                            type="radio"
                            name="city"
                            value="{{ $city->id }}"
                            @checked((string) request('city') === (string) $city->id)
                            class="
                                h-4
                                w-4
                                border-gray-300
                                text-[#D7385E]
                                focus:ring-[#D7385E]
                            "
                        >

                        {{ $city->name }}

                    </span>

                </label>

            @endforeach

        </div>

    </div>


    {{-- ============================================================
        CATEGORY
    ============================================================= --}}

    @if($category)

        <div
            class="
                border-b
                border-gray-100
                px-5
                py-5
            "
        >

            <h3
                class="
                    mb-3
                    text-sm
                    font-bold
                    text-[#10213A]
                "
            >
                Category
            </h3>


            <div
                class="
                    flex
                    items-center
                    justify-between
                    rounded-xl
                    bg-[#fff7f9]
                    px-4
                    py-3.5
                    text-sm
                    font-semibold
                    text-[#D7385E]
                "
            >

                <span>
                    {{ $category->name }}
                </span>


                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14M13 6l6 6-6 6"
                    />
                </svg>

            </div>

        </div>

    @endif


    {{-- ============================================================
        CURRENT VENDOR TYPE
    ============================================================= --}}

    @if($taxonomy)

        <div
            class="
                border-b
                border-gray-100
                px-5
                py-5
            "
        >

            <h3
                class="
                    mb-3
                    text-sm
                    font-bold
                    text-[#10213A]
                "
            >
                Vendor Type
            </h3>


            <div
                class="
                    rounded-xl
                    border
                    border-gray-100
                    bg-gray-50
                    px-4
                    py-3.5
                    text-sm
                    font-medium
                    text-gray-700
                "
            >
                {{ $taxonomy->name }}
            </div>

        </div>

    @endif


    {{-- ============================================================
        ACTION BUTTONS
    ============================================================= --}}

    <div
        class="
            space-y-2.5
            px-5
            py-5
        "
    >

        <button
            type="submit"
            @if($mobile)
                onclick="closeMobileFilter()"
            @endif
            class="
                flex
                w-full
                items-center
                justify-center
                gap-2
                rounded-xl
                bg-[#D7385E]
                px-5
                py-3
                text-sm
                font-semibold
                text-white
                shadow-sm
                transition
                hover:bg-[#c52f52]
                hover:shadow-md
                active:scale-[0.99]
            "
        >

            Apply Filters

            <svg
                class="h-4 w-4"
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

        </button>


        <a
            href="{{ url('/listings') }}{{ $categorySlug ? '?category=' . $categorySlug : '' }}"
            class="
                flex
                w-full
                items-center
                justify-center
                rounded-xl
                border
                border-gray-200
                bg-white
                px-5
                py-3
                text-sm
                font-semibold
                text-gray-600
                transition
                hover:border-[#D7385E]
                hover:text-[#D7385E]
            "
        >
            Clear Filters
        </a>

    </div>

</form>