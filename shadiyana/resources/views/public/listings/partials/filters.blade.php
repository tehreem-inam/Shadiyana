@php
    $mobile = $mobile ?? false;
@endphp


<form
    method="GET"
    action="{{ url('/listings') }}"
    class="overflow-hidden rounded-2xl border border-[#ECE1E5] bg-white shadow-[0_6px_26px_rgba(19,27,46,0.045)]"
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

    <div class="flex items-center justify-between border-b border-[#F1EDEC] px-5 py-4">

        <div>

            <div class="flex items-center gap-2.5">

                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]">

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M7 12h10M10 18h4"/>
                    </svg>

                </span>


                <h2
                    class="text-base font-semibold tracking-tight text-[#131B2E]"
                    style="font-family: 'Fraunces', ui-serif, Georgia, serif;"
                >
                    Filter
                </h2>

            </div>


            <p class="mt-1 text-xs text-[#9AA5BB]">
                Refine your results
            </p>

        </div>

    </div>


    {{-- ============================================================
        CITY
    ============================================================= --}}

    <div class="border-b border-[#F1EDEC] px-5 py-4">

        <div class="mb-3 flex items-center justify-between">

            <h3 class="text-[13px] font-semibold text-[#131B2E]">
                City
            </h3>

            @if(request('city'))

                <a
                    href="{{ request()->fullUrlWithoutQuery(['city']) }}"
                    class="text-[11px] font-medium text-[#B92D4E] hover:underline"
                >
                    Clear
                </a>

            @endif

        </div>


        <div class="space-y-1.5">

            @foreach($cities as $city)

                <label
                    class="group flex cursor-pointer items-center justify-between rounded-xl border border-transparent px-3 py-2 transition hover:border-[#F0DCE2] hover:bg-[#FFF8FA]"
                >

                    <span class="flex items-center gap-2.5 text-sm text-[#4B5872] group-hover:text-[#131B2E]">

                        <input
                            type="radio"
                            name="city"
                            value="{{ $city->id }}"
                            @checked((string) request('city') === (string) $city->id)
                            class="h-4 w-4 border-[#D8DEE9] text-[#D7385E] focus:ring-[#D7385E]"
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

        <div class="border-b border-[#F1EDEC] px-5 py-4">

            <h3 class="mb-2.5 text-[13px] font-semibold text-[#131B2E]">
                Category
            </h3>


            <div class="flex items-center justify-between rounded-xl bg-[#FFF7F9] px-4 py-3 text-sm font-semibold text-[#D7385E]">

                <span>
                    {{ $category->name }}
                </span>


                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                </svg>

            </div>

        </div>

    @endif


    {{-- ============================================================
        CURRENT VENDOR TYPE
    ============================================================= --}}

    @if($taxonomy)

        <div class="border-b border-[#F1EDEC] px-5 py-4">

            <h3 class="mb-2.5 text-[13px] font-semibold text-[#131B2E]">
                Vendor Type
            </h3>


            <div class="rounded-xl border border-[#ECE1E5] bg-[#FAF8F6] px-4 py-3 text-sm font-medium text-[#4B5872]">
                {{ $taxonomy->name }}
            </div>

        </div>

    @endif


    {{-- ============================================================
        ACTION BUTTONS
    ============================================================= --}}

    <div class="space-y-2 px-5 py-4">

        <button
            type="submit"
            @if($mobile)
                onclick="closeMobileFilter()"
            @endif
            class="flex w-full items-center justify-center gap-2 rounded-full bg-[#D7385E] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#B92D4E] hover:shadow-md active:scale-[0.99]"
        >

            Apply Filters

            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
            </svg>

        </button>


        <a
            href="{{ url('/listings') }}{{ $categorySlug ? '?category=' . $categorySlug : '' }}"
            class="flex w-full items-center justify-center rounded-full border border-[#ECE1E5] bg-white px-5 py-2.5 text-sm font-semibold text-[#4B5872] transition hover:border-[#D7385E] hover:text-[#D7385E]"
        >
            Clear Filters
        </a>

    </div>

</form>