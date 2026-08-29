@extends('layouts.app')

@section('title', $eventType->name)

@section('content')

<div
    x-data="{
        imageModal: false,
        activeImage: 0,

        images: @js(
            $eventType->images->map(function ($image) use ($eventType) {
                return [
                    'url' => asset('storage/' . $image->path),
                    'alt' => $eventType->name
                ];
            })->values()
        ),

        openImage(index) {
            this.activeImage = index;
            this.imageModal = true;
            document.body.classList.add('overflow-hidden');
        },

        closeImage() {
            this.imageModal = false;
            document.body.classList.remove('overflow-hidden');
        },

        nextImage() {
            if (this.images.length > 1) {
                this.activeImage =
                    (this.activeImage + 1) % this.images.length;
            }
        },

        previousImage() {
            if (this.images.length > 1) {
                this.activeImage =
                    (this.activeImage - 1 + this.images.length)
                    % this.images.length;
            }
        },

        handleKeydown(event) {
            if (!this.imageModal) return;

            if (event.key === 'Escape') {
                this.closeImage();
            }

            if (event.key === 'ArrowRight') {
                this.nextImage();
            }

            if (event.key === 'ArrowLeft') {
                this.previousImage();
            }
        }
    }"
    @keydown.window="handleKeydown($event)"
    class="mx-auto max-w-7xl"
>

    {{-- ============================================================
        BREADCRUMB
    ============================================================= --}}

    <div class="mb-6">

        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-400">

            <a
                href="{{ url('/') }}"
                class="transition hover:text-[#D7385E]"
            >
                Management
            </a>

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="font-medium text-gray-600">
                Catalog
            </span>

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <a
                href="{{ route('event-types.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Event Types
            </a>

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="truncate text-gray-400">
                {{ $eventType->name }}
            </span>

        </div>

    </div>


    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div class="flex items-center gap-3">

            <div
                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]"
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
                        d="M8 3v4M16 3v4M4 9h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M8 13h2M14 13h2M8 17h2"
                    />
                </svg>

            </div>

            <div class="min-w-0">

                <h1 class="truncate text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                    {{ $eventType->name }}
                </h1>

                <p class="mt-0.5 text-sm text-gray-500">
                    Event type details and information.
                </p>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex w-full gap-2 sm:w-auto">

            <a
                href="{{ route('event-types.index') }}"
                class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900 sm:flex-none"
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
                        d="M15 18l-6-6 6-6"
                    />
                </svg>

                Back

            </a>


            <a
                href="{{ route('event-types.edit', $eventType) }}"
                class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md sm:flex-none"
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
                        d="M12 20h9"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1 1 1-4L16.5 3.5z"
                    />
                </svg>

                Edit

            </a>

        </div>

    </div>


    {{-- ============================================================
        MAIN GRID
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- ========================================================
            LEFT / MAIN CONTENT
        ========================================================= --}}

        <div class="space-y-6 lg:col-span-2">


            {{-- ====================================================
                IMAGE GALLERY
            ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4 sm:px-6">

                    <div class="flex items-center justify-between gap-3">

                        <div>

                            <h2 class="text-sm font-extrabold text-gray-900">
                                Event Type Images
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Click an image to view it.
                            </p>

                        </div>


                        @if($eventType->images->count())

                            <span class="rounded-lg bg-[#FBEBEF] px-2.5 py-1 text-xs font-bold text-[#D7385E]">

                                {{ $eventType->images->count() }}

                                {{ Str::plural('image', $eventType->images->count()) }}

                            </span>

                        @endif

                    </div>

                </div>


                <div class="p-5 sm:p-6">

                    @if($eventType->images->count())

                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">

                            @foreach($eventType->images as $index => $image)

                                <button
                                    type="button"
                                    @click="openImage({{ $index }})"
                                    class="group relative aspect-square overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 text-left focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30"
                                >

                                    <img
                                        src="{{ asset('storage/' . $image->path) }}"
                                        alt="{{ $eventType->name }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                    >


                                    {{-- Hover Overlay --}}
                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-black/0 transition duration-300 group-hover:bg-black/30"
                                    >

                                        <div
                                            class="flex h-10 w-10 scale-90 items-center justify-center rounded-full bg-white/90 text-gray-800 opacity-0 shadow-lg transition duration-300 group-hover:scale-100 group-hover:opacity-100"
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
                                                    d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"
                                                />
                                            </svg>

                                        </div>

                                    </div>

                                </button>

                            @endforeach

                        </div>

                    @else

                        <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 px-5 py-12 text-center">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]"
                            >

                                <svg
                                    class="h-7 w-7"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M4 16l4-4 4 4 3-3 5 5M4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1z"
                                    />
                                </svg>

                            </div>

                            <p class="mt-4 text-sm font-bold text-gray-500">
                                No images available.
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                Add images by editing this event type.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ====================================================
                DESCRIPTION
            ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4 sm:px-6">

                    <h2 class="text-sm font-extrabold text-gray-900">
                        Description
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500">
                        Detailed information about this event type.
                    </p>

                </div>


                <div class="p-5 sm:p-6">

                    @if($descriptionHtml)

                        <article
                            class="event-description max-w-none text-sm leading-7 text-gray-600"
                        >

                            {!! $descriptionHtml !!}

                        </article>

                    @else

                        <div class="rounded-xl border border-dashed border-gray-200 bg-gray-50 px-5 py-10 text-center">

                            <p class="text-sm font-semibold text-gray-400">
                                No description available.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ====================================================
                VENDORS
            ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4 sm:px-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="text-sm font-extrabold text-gray-900">
                                Assigned Vendors
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Vendors associated with this event type.
                            </p>

                        </div>

                        <span class="rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-bold text-gray-600">
                            {{ $eventType->vendors->count() }}
                        </span>

                    </div>

                </div>


                <div class="p-5 sm:p-6">

                    @if($eventType->vendors->count())

                        <div class="divide-y divide-gray-100">

                            @foreach($eventType->vendors as $vendor)

                                <div class="flex items-center justify-between gap-4 py-3 first:pt-0 last:pb-0">

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-bold text-gray-900">
                                            {{ $vendor->business_name ?? $vendor->name ?? 'Vendor' }}
                                        </p>

                                        @if(isset($vendor->slug))

                                            <p class="mt-0.5 truncate text-xs text-gray-400">
                                                /{{ $vendor->slug }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="rounded-xl border border-dashed border-gray-200 bg-gray-50 px-5 py-8 text-center">

                            <p class="text-sm font-semibold text-gray-400">
                                No vendors assigned.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- ========================================================
            RIGHT / SIDEBAR
        ========================================================= --}}

        <div class="space-y-6">


            {{-- ====================================================
                EVENT TYPE INFORMATION
            ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4">

                    <h2 class="text-sm font-extrabold text-gray-900">
                        Event Type Information
                    </h2>

                </div>


                <div class="divide-y divide-gray-100">

                    {{-- Name --}}
                    <div class="px-5 py-4">

                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">
                            Name
                        </p>

                        <p class="mt-1 text-sm font-bold text-gray-900">
                            {{ $eventType->name }}
                        </p>

                    </div>


                    {{-- Slug --}}
                    <div class="px-5 py-4">

                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">
                            Slug
                        </p>

                        <p class="mt-1 break-all text-sm font-semibold text-gray-600">
                            /{{ $eventType->slug }}
                        </p>

                    </div>


                    {{-- Status --}}
                    <div class="px-5 py-4">

                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">
                            Status
                        </p>

                        <div class="mt-2">

                            @if($eventType->status === 'active')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                    Active

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-500">

                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                    Inactive

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Sort Order --}}
                    <div class="px-5 py-4">

                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">
                            Sort Order
                        </p>

                        <p class="mt-1 text-sm font-bold text-gray-700">
                            {{ $eventType->sort_order ?? 0 }}
                        </p>

                    </div>


                    {{-- Vendors --}}
                    <div class="px-5 py-4">

                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">
                            Vendors
                        </p>

                        <p class="mt-1 text-sm font-bold text-gray-700">
                            {{ $eventType->vendors->count() }}
                            {{ Str::plural('vendor', $eventType->vendors->count()) }}
                        </p>

                    </div>


                    {{-- Images --}}
                    <div class="px-5 py-4">

                        <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">
                            Images
                        </p>

                        <p class="mt-1 text-sm font-bold text-gray-700">
                            {{ $eventType->images->count() }}
                            {{ Str::plural('image', $eventType->images->count()) }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                QUICK ACTIONS
            ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-4">

                    <h2 class="text-sm font-extrabold text-gray-900">
                        Quick Actions
                    </h2>

                </div>


                <div class="space-y-2 p-4">

                    <a
                        href="{{ route('event-types.edit', $eventType) }}"
                        class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-bold text-gray-600 transition hover:border-[#D7385E]/20 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                    >

                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]">

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
                                    d="M12 20h9"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1 1 1-4L16.5 3.5z"
                                />
                            </svg>

                        </span>

                        Edit Event Type

                    </a>


                    <a
                        href="{{ route('event-types.index') }}"
                        class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
                    >

                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-500">

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
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>

                        </span>

                        All Event Types

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        IMAGE LIGHTBOX
    ============================================================= --}}

    <div
        x-show="imageModal"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 px-4 py-6"
        @click.self="closeImage()"
    >

        <div
            class="relative flex h-full w-full items-center justify-center"
        >

            {{-- Close --}}
            <button
                type="button"
                @click="closeImage()"
                class="absolute right-2 top-2 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/20 sm:right-4 sm:top-4"
                aria-label="Close image"
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
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

            </button>


            {{-- Previous --}}
            <button
                x-show="images.length > 1"
                type="button"
                @click.stop="previousImage()"
                class="absolute left-1 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/20 sm:left-4"
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
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

            </button>


            {{-- Image --}}
            <div class="flex h-full w-full items-center justify-center px-12 py-12 sm:px-20">

                <template x-for="(image, index) in images" :key="index">

                    <img
                        x-show="activeImage === index"
                        :src="image.url"
                        :alt="image.alt"
                        x-transition.opacity
                        class="max-h-full max-w-full rounded-xl object-contain shadow-2xl"
                    >

                </template>

            </div>


            {{-- Next --}}
            <button
                x-show="images.length > 1"
                type="button"
                @click.stop="nextImage()"
                class="absolute right-1 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/20 sm:right-4"
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
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    />
                </svg>

            </button>


            {{-- Counter --}}
            <div
                x-show="images.length > 1"
                class="absolute bottom-3 left-1/2 -translate-x-1/2 rounded-full bg-black/60 px-4 py-2 text-xs font-bold text-white backdrop-blur"
            >

                <span x-text="activeImage + 1"></span>

                <span class="mx-1 text-white/50">
                    /
                </span>

                <span x-text="images.length"></span>

            </div>

        </div>

    </div>

</div>


{{-- ================================================================
    MARKDOWN / DESCRIPTION STYLING
================================================================ --}}

<style>

    .event-description h1 {
        margin-bottom: 1rem;
        font-size: 1.75rem;
        line-height: 2.25rem;
        font-weight: 800;
        color: #111827;
    }

    .event-description h2 {
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
        font-size: 1.35rem;
        line-height: 1.9rem;
        font-weight: 800;
        color: #111827;
    }

    .event-description h3 {
        margin-top: 1.5rem;
        margin-bottom: 0.6rem;
        font-size: 1.1rem;
        line-height: 1.6rem;
        font-weight: 800;
        color: #111827;
    }

    .event-description p {
        margin-bottom: 1rem;
    }

    .event-description strong {
        font-weight: 800;
        color: #1f2937;
    }

    .event-description em {
        font-style: italic;
    }

    .event-description ul {
        margin: 1rem 0;
        padding-left: 1.5rem;
        list-style-type: disc;
    }

    .event-description ol {
        margin: 1rem 0;
        padding-left: 1.5rem;
        list-style-type: decimal;
    }

    .event-description li {
        margin-bottom: 0.4rem;
    }

    .event-description blockquote {
        margin: 1.25rem 0;
        border-left: 4px solid #D7385E;
        padding: 0.75rem 1rem;
        background: #FBEBEF;
        color: #4b5563;
        border-radius: 0 0.75rem 0.75rem 0;
    }

    .event-description code {
        border-radius: 0.375rem;
        background: #f3f4f6;
        padding: 0.15rem 0.4rem;
        font-size: 0.875em;
        color: #374151;
    }

    .event-description pre {
        margin: 1rem 0;
        overflow-x: auto;
        border-radius: 0.75rem;
        background: #111827;
        padding: 1rem;
        color: #f9fafb;
    }

    .event-description pre code {
        background: transparent;
        padding: 0;
        color: inherit;
    }

    .event-description a {
        color: #D7385E;
        font-weight: 700;
        text-decoration: underline;
    }

    .event-description hr {
        margin: 1.5rem 0;
        border-color: #e5e7eb;
    }

    .event-description img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
    }

</style>

@endsection