@extends('layouts.app')

@section('title', 'Vendor Gallery')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                @if($isAdmin)
                    <a
                        href="{{ route('vendors.index') }}"
                        class="transition hover:text-[#D7385E]"
                    >
                        Vendors
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
                            d="m9 18 6-6-6-6"
                        />
                    </svg>
                @endif

                <span class="text-gray-500">Gallery</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Vendor Gallery
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage and organize vendor gallery images.
            </p>
        </div>

        @if($vendor)
            <a
                href="{{ route('vendors.images.create', ['vendor' => $vendor->id]) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52] hover:shadow-md"
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
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Add Images
            </a>
        @endif

    </div>


    {{-- ============================================================
        ADMIN VENDOR SELECTOR
    ============================================================= --}}
    @if($isAdmin)

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1m-6 4h1m4 0h1m-6 4h1m4 0h1"
                        />
                    </svg>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-900">
                        Select Vendor
                    </h2>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Choose a vendor to manage their gallery.
                    </p>
                </div>

            </div>

            <form method="GET" action="{{ route('vendors.images.index') }}">

                <div class="flex flex-col gap-3 sm:flex-row">

                    <select
                        name="vendor"
                        onchange="this.form.submit()"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10 sm:flex-1"
                    >
                        <option value="">
                            Select a vendor
                        </option>

                        @foreach($vendors as $item)
                            <option
                                value="{{ $item->id }}"
                                @selected($vendor && $vendor->id === $item->id)
                            >
                                {{ $item->business_name }}
                                @if($item->city)
                                    — {{ $item->city->name }}
                                @endif
                            </option>
                        @endforeach
                    </select>

                    @if($vendor)
                        <a
                            href="{{ route('vendors.images.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-200 px-5 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
                        >
                            Clear
                        </a>
                    @endif

                </div>

            </form>

        </div>

    @endif


    {{-- ============================================================
        NO VENDOR SELECTED
    ============================================================= --}}
    @if(!$vendor)

        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center shadow-sm">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

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
                        d="m3 16 5-5 4 4 3-3 6 6M3 19h18M5 5h.01M5 5a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"
                    />
                </svg>

            </div>

            <h2 class="mt-5 text-lg font-semibold text-gray-900">
                Select a vendor
            </h2>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                Select a vendor above to view and manage their gallery images.
            </p>

        </div>

        @if($isAdmin)
            @return
        @endif

    @endif


    @if($vendor)

        {{-- ========================================================
            VENDOR INFORMATION
        ========================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex min-w-0 items-center gap-4">

                    {{-- Vendor Logo --}}
                    <div class="h-16 w-16 shrink-0 overflow-hidden rounded-2xl bg-gray-100">

                        @if($vendor->logo_image)
                            <img
                                src="{{ asset('storage/' . $vendor->logo_image) }}"
                                alt="{{ $vendor->business_name }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-[#FBEBEF] text-xl font-bold text-[#D7385E]">
                                {{ strtoupper(substr($vendor->business_name, 0, 1)) }}
                            </div>
                        @endif

                    </div>

                    <div class="min-w-0">

                        <div class="flex flex-wrap items-center gap-2">

                            <h2 class="truncate text-lg font-bold text-gray-900">
                                {{ $vendor->business_name }}
                            </h2>

                            @if($vendor->is_verified)
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                    <svg
                                        class="h-3.5 w-3.5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.707-9.293a1 1 0 0 0-1.414-1.414L9 10.586 7.707 9.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l3-3Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    Verified
                                </span>
                            @endif

                        </div>

                        <div class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-gray-500">

                            @if($vendor->city)
                                <span class="inline-flex items-center gap-1.5">
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
                                            d="M17.657 16.657 13.414 20.9a2 2 0 0 1-2.828 0l-4.243-4.243a8 8 0 1 1 11.314 0Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                        />
                                    </svg>

                                    {{ $vendor->city->name }}
                                </span>
                            @endif

                            <span>
                                {{ $images?->total() ?? 0 }}
                                {{ ($images?->total() ?? 0) === 1 ? 'image' : 'images' }}
                            </span>

                        </div>

                    </div>

                </div>


                <div class="flex items-center gap-2">

                    <a
                        href="{{ route('vendors.show', $vendor->id) }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
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
                                stroke-width="2"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"
                            />
                        </svg>

                        View Vendor
                    </a>

                </div>

            </div>

        </div>


        {{-- ========================================================
            GALLERY TOOLBAR
        ========================================================= --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    Gallery
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Drag images to change their order.
                </p>
            </div>

            {{-- Automatic save status --}}
            <div
                id="orderStatus"
                class="inline-flex min-h-[38px] items-center gap-2 self-start rounded-xl bg-gray-50 px-3.5 py-2 text-xs font-medium text-gray-500 transition sm:self-auto"
            >
                <span
                    id="orderStatusDot"
                    class="h-2 w-2 rounded-full bg-gray-300"
                ></span>

                <span id="orderStatusText">
                    Order saved
                </span>
            </div>

        </div>


        {{-- ========================================================
            GALLERY GRID
        ========================================================= --}}
        @if($images && $images->count())

            <div
                id="galleryGrid"
                class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
            >

                @foreach($images as $image)

                    <article
                        class="gallery-card group relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg"
                        draggable="true"
                        data-image-id="{{ $image->id }}"
                        data-sort-order="{{ $image->sort_order }}"
                    >

                        {{-- Image --}}
                        <button
                            type="button"
                            class="preview-image relative block aspect-[4/3] w-full cursor-zoom-in overflow-hidden bg-gray-100 text-left"
                            data-image-url="{{ asset('storage/' . $image->image_url) }}"
                            data-image-title="{{ $image->title ?: 'Gallery Image' }}"
                            data-image-description="{{ $image->description ?: '' }}"
                            aria-label="Preview image"
                        >

                            <img
                                src="{{ asset('storage/' . $image->image_url) }}"
                                alt="{{ $image->title ?: 'Gallery Image' }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >

                            {{-- Hover overlay --}}
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>

                            {{-- Preview icon --}}
                            <span class="pointer-events-none absolute left-1/2 top-1/2 flex h-11 w-11 -translate-x-1/2 -translate-y-1/2 scale-90 items-center justify-center rounded-full bg-white/95 text-gray-700 opacity-0 shadow-lg transition duration-200 group-hover:scale-100 group-hover:opacity-100">
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
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"
                                    />
                                </svg>
                            </span>

                            {{-- Status --}}
                            <span class="absolute right-3 top-3 rounded-full px-2.5 py-1 text-[11px] font-semibold shadow-sm
                                {{ $image->status === 'active'
                                    ? 'bg-green-500 text-white'
                                    : 'bg-gray-800/80 text-white'
                                }}"
                            >
                                {{ ucfirst($image->status) }}
                            </span>

                        </button>


                        {{-- Card Body --}}
                        <div class="p-4">

                            <div class="flex items-start justify-between gap-3">

                                <div class="min-w-0">

                                    <h3 class="truncate text-sm font-semibold text-gray-900">
                                        {{ $image->title ?: 'Untitled Image' }}
                                    </h3>

                                    @if($image->description)
                                        <p class="mt-1 line-clamp-2 text-xs leading-5 text-gray-500">
                                            {{ $image->description }}
                                        </p>
                                    @else
                                        <p class="mt-1 text-xs text-gray-400">
                                            No description
                                        </p>
                                    @endif

                                </div>


                                {{-- Drag Handle --}}
                                <div
                                    class="drag-handle flex h-8 w-8 shrink-0 cursor-grab items-center justify-center rounded-lg bg-gray-50 text-gray-400 transition hover:bg-[#FBEBEF] hover:text-[#D7385E] active:cursor-grabbing"
                                    title="Drag to reorder"
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
                                            stroke-width="2"
                                            d="M8 6h.01M8 12h.01M8 18h.01M16 6h.01M16 12h.01M16 18h.01"
                                        />
                                    </svg>
                                </div>

                            </div>


                            {{-- Bottom Actions --}}
                            <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3">

                                <span class="order-badge inline-flex items-center gap-1.5 text-xs font-medium text-gray-400">

                                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-gray-100 text-[10px] font-bold text-gray-500">
                                        {{ $loop->iteration }}
                                    </span>

                                    Position
                                </span>


                                <div class="flex items-center gap-1">

     


                                    {{-- Delete --}}
                                    <button
                                        type="button"
                                        class="delete-image flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                        title="Delete image"
                                        data-delete-url="{{ route('vendors.images.destroy', [
                                            'image' => $image->id,
                                            'vendor' => $vendor->id,
                                        ]) }}"
                                        data-image-title="{{ $image->title ?: 'Untitled Image' }}"
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
                                                d="M6 7h12m-9 0v10m6-10v10M9 7V4h6v3m-8 0 .7 12.1A2 2 0 0 0 9.7 21h4.6a2 2 0 0 0 1.99-1.9L17 7"
                                            />
                                        </svg>
                                    </button>

                                </div>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- ====================================================
                PAGINATION
            ===================================================== --}}
            @if($images->hasPages())

                <div class="pt-2">
                    {{ $images->links() }}
                </div>

            @endif

        @else

            {{-- ====================================================
                EMPTY GALLERY
            ===================================================== --}}
            <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center shadow-sm">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

                    <svg
                        class="h-8 w-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.6"
                            d="m3 16 5-5 4 4 3-3 6 6M3 19h18M5 5h.01M5 5a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"
                        />
                    </svg>

                </div>

                <h2 class="mt-5 text-lg font-semibold text-gray-900">
                    No gallery images yet
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                    Upload beautiful images of this vendor's work, venue,
                    decorations, events, or services.
                </p>

                <a
                    href="{{ route('vendors.images.create', ['vendor' => $vendor->id]) }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52] hover:shadow-md"
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
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Upload First Image
                </a>

            </div>

        @endif

    @endif

</div>


{{-- ================================================================
    IMAGE PREVIEW MODAL
================================================================= --}}
<div
    id="imagePreviewModal"
    class="fixed inset-0 z-50 hidden"
    aria-hidden="true"
>

    <div
        id="previewBackdrop"
        class="absolute inset-0 bg-black/75 backdrop-blur-sm"
    ></div>

    <div class="relative flex min-h-full items-center justify-center p-4 sm:p-8">

        <div class="relative w-full max-w-5xl overflow-hidden rounded-2xl bg-white shadow-2xl">

            {{-- Close --}}
            <button
                type="button"
                id="closePreviewModal"
                class="absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-black/50 text-white backdrop-blur transition hover:bg-black/70"
                aria-label="Close preview"
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
                        stroke-width="2"
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>
            </button>


            {{-- Image --}}
            <div class="flex min-h-[300px] items-center justify-center bg-gray-950">

                <img
                    id="previewModalImage"
                    src=""
                    alt=""
                    class="max-h-[75vh] max-w-full object-contain"
                >

            </div>


            {{-- Details --}}
            <div class="border-t border-gray-100 bg-white p-5 sm:p-6">

                <h3
                    id="previewModalTitle"
                    class="text-lg font-bold text-gray-900"
                ></h3>

                <p
                    id="previewModalDescription"
                    class="mt-1 text-sm leading-6 text-gray-500"
                ></p>

            </div>

        </div>

    </div>

</div>


{{-- ================================================================
    DELETE MODAL
================================================================= --}}
<div
    id="deleteModal"
    class="fixed inset-0 z-50 hidden"
    aria-hidden="true"
>

    <div
        id="deleteBackdrop"
        class="absolute inset-0 bg-black/60 backdrop-blur-sm"
    ></div>

    <div class="relative flex min-h-full items-center justify-center p-4">

        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-red-600">

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
                        d="M12 9v4m0 4h.01M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                    />
                </svg>

            </div>

            <h3 class="mt-5 text-lg font-bold text-gray-900">
                Delete gallery image?
            </h3>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Are you sure you want to delete
                <span
                    id="deleteImageTitle"
                    class="font-semibold text-gray-700"
                ></span>?
                This action cannot be undone.
            </p>


            <div class="mt-6 flex justify-end gap-3">

                <button
                    type="button"
                    id="cancelDelete"
                    class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                >
                    Cancel
                </button>

                <form
                    id="deleteForm"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700"
                    >
                        Delete Image
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- ================================================================
    JAVASCRIPT
================================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const galleryGrid = document.getElementById('galleryGrid');

    const orderStatus = document.getElementById('orderStatus');
    const orderStatusDot = document.getElementById('orderStatusDot');
    const orderStatusText = document.getElementById('orderStatusText');

    const previewModal = document.getElementById('imagePreviewModal');
    const previewBackdrop = document.getElementById('previewBackdrop');
    const closePreviewModal = document.getElementById('closePreviewModal');

    const previewModalImage = document.getElementById('previewModalImage');
    const previewModalTitle = document.getElementById('previewModalTitle');
    const previewModalDescription = document.getElementById('previewModalDescription');

    const deleteModal = document.getElementById('deleteModal');
    const deleteBackdrop = document.getElementById('deleteBackdrop');
    const cancelDelete = document.getElementById('cancelDelete');

    const deleteForm = document.getElementById('deleteForm');
    const deleteImageTitle = document.getElementById('deleteImageTitle');


    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    */

    const vendorId = @json($vendor?->id);
    const csrfToken = @json(csrf_token());

    const reorderUrl = @json(
        $vendor
            ? route('vendors.images.reorder', ['vendor' => $vendor->id])
            : null
    );


    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    function setOrderStatus(type, message)
    {
        if (!orderStatus || !orderStatusDot || !orderStatusText) {
            return;
        }

        orderStatusText.textContent = message;

        orderStatus.className =
            'inline-flex min-h-[38px] items-center gap-2 self-start rounded-xl px-3.5 py-2 text-xs font-medium transition sm:self-auto';

        if (type === 'saving') {

            orderStatus.classList.add(
                'bg-amber-50',
                'text-amber-700'
            );

            orderStatusDot.className =
                'h-2 w-2 rounded-full bg-amber-500 animate-pulse';

        } else if (type === 'success') {

            orderStatus.classList.add(
                'bg-green-50',
                'text-green-700'
            );

            orderStatusDot.className =
                'h-2 w-2 rounded-full bg-green-500';

        } else if (type === 'error') {

            orderStatus.classList.add(
                'bg-red-50',
                'text-red-700'
            );

            orderStatusDot.className =
                'h-2 w-2 rounded-full bg-red-500';

        } else {

            orderStatus.classList.add(
                'bg-gray-50',
                'text-gray-500'
            );

            orderStatusDot.className =
                'h-2 w-2 rounded-full bg-gray-300';

        }
    }


    function getCards()
    {
        if (!galleryGrid) {
            return [];
        }

        return Array.from(
            galleryGrid.querySelectorAll('.gallery-card')
        );
    }


    function updatePositionBadges()
    {
        getCards().forEach((card, index) => {

            const badge = card.querySelector('.order-badge span');

            if (badge) {
                badge.textContent = index + 1;
            }

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Drag & Drop
    |--------------------------------------------------------------------------
    */

    let draggedCard = null;

    let saveTimer = null;
    let saveInProgress = false;
    let saveQueued = false;


    function buildOrderPayload()
    {
        const formData = new FormData();

        formData.append('_token', csrfToken);
        formData.append('vendor', vendorId);

        getCards().forEach((card, index) => {

            const imageId = card.dataset.imageId;

            /*
             * Preserve the original sort-order range of the current page.
             * This prevents page 2 from suddenly receiving positions 1–24.
             */
            const originalSortOrder =
                parseInt(card.dataset.sortOrder || '', 10);

            const fallbackSortOrder = index + 1;

            const sortOrder =
                Number.isFinite(originalSortOrder)
                    ? originalSortOrder
                    : fallbackSortOrder;

            formData.append(
                `images[${imageId}][id]`,
                imageId
            );

            /*
             * The actual position is based on the card's original
             * sort-order values after the drag operation.
             *
             * We temporarily collect the values below and sort them.
             */
        });


        /*
         * Preserve the existing sort-order values and assign them
         * according to the newly dragged visual order.
         */
        const sortOrders = getCards()
            .map(card => parseInt(card.dataset.sortOrder || '', 10))
            .filter(value => Number.isFinite(value))
            .sort((a, b) => a - b);


        getCards().forEach((card, index) => {

            const imageId = card.dataset.imageId;

            const sortOrder =
                sortOrders[index] ??
                (index + 1);

            formData.set(
                `images[${imageId}][sort_order]`,
                sortOrder
            );

        });


        return formData;
    }


    async function saveGalleryOrder()
    {
        if (!galleryGrid || !vendorId || !reorderUrl) {
            return;
        }

        if (saveInProgress) {

            saveQueued = true;

            return;
        }

        saveInProgress = true;
        saveQueued = false;

        setOrderStatus(
            'saving',
            'Saving order...'
        );


        try {

            const response = await fetch(
                reorderUrl,
                {
                    method: 'POST',

                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html,application/xhtml+xml'
                    },

                    body: buildOrderPayload()
                }
            );


            if (!response.ok) {
                throw new Error(
                    `Request failed with status ${response.status}`
                );
            }


            setOrderStatus(
                'success',
                'Order saved'
            );

        } catch (error) {

            console.error(
                'Gallery reorder failed:',
                error
            );

            setOrderStatus(
                'error',
                'Unable to save order'
            );

        } finally {

            saveInProgress = false;

            /*
             * If the user dragged another image while the previous
             * request was still running, save the newest order.
             */
            if (saveQueued) {
                saveQueued = false;

                setTimeout(() => {
                    saveGalleryOrder();
                }, 150);
            }

        }
    }


    function queueOrderSave()
    {
        clearTimeout(saveTimer);

        saveTimer = setTimeout(() => {
            saveGalleryOrder();
        }, 250);
    }


    if (galleryGrid) {

        galleryGrid.addEventListener(
            'dragstart',
            event => {

                const card =
                    event.target.closest('.gallery-card');

                if (!card) {
                    return;
                }

                draggedCard = card;

                card.classList.add(
                    'opacity-50',
                    'scale-[0.98]'
                );

                event.dataTransfer.effectAllowed = 'move';

            }
        );


        galleryGrid.addEventListener(
            'dragend',
            () => {

                if (draggedCard) {

                    draggedCard.classList.remove(
                        'opacity-50',
                        'scale-[0.98]'
                    );

                }

                draggedCard = null;

                updatePositionBadges();

                queueOrderSave();

            }
        );


        galleryGrid.addEventListener(
            'dragover',
            event => {

                event.preventDefault();

                if (!draggedCard) {
                    return;
                }


                const targetCard =
                    event.target.closest('.gallery-card');


                if (
                    !targetCard ||
                    targetCard === draggedCard
                ) {
                    return;
                }


                const rect =
                    targetCard.getBoundingClientRect();

                const mouseY =
                    event.clientY - rect.top;

                const shouldInsertAfter =
                    mouseY > rect.height / 2;


                if (shouldInsertAfter) {

                    targetCard.after(draggedCard);

                } else {

                    targetCard.before(draggedCard);

                }

                updatePositionBadges();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Image Preview Modal
    |--------------------------------------------------------------------------
    */

    function openPreview(button)
    {
        if (!previewModal) {
            return;
        }

        const imageUrl =
            button.dataset.imageUrl || '';

        const title =
            button.dataset.imageTitle || 'Gallery Image';

        const description =
            button.dataset.imageDescription || '';


        previewModalImage.src = imageUrl;
        previewModalImage.alt = title;

        previewModalTitle.textContent = title;

        previewModalDescription.textContent =
            description;


        if (description.trim() === '') {
            previewModalDescription.classList.add(
                'hidden'
            );
        } else {
            previewModalDescription.classList.remove(
                'hidden'
            );
        }


        previewModal.classList.remove(
            'hidden'
        );

        previewModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'overflow-hidden'
        );
    }


    function closePreview()
    {
        if (!previewModal) {
            return;
        }

        previewModal.classList.add(
            'hidden'
        );

        previewModal.setAttribute(
            'aria-hidden',
            'true'
        );

        previewModalImage.src = '';

        document.body.classList.remove(
            'overflow-hidden'
        );
    }


    document.querySelectorAll(
        '.preview-image'
    ).forEach(button => {

        button.addEventListener(
            'click',
            event => {

                /*
                 * Do not trigger drag behaviour when
                 * clicking the image preview.
                 */
                event.stopPropagation();

                openPreview(button);

            }
        );

    });


    if (closePreviewModal) {

        closePreviewModal.addEventListener(
            'click',
            closePreview
        );

    }


    if (previewBackdrop) {

        previewBackdrop.addEventListener(
            'click',
            closePreview
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Delete Modal
    |--------------------------------------------------------------------------
    */

    function openDeleteModal(button)
    {
        if (!deleteModal || !deleteForm) {
            return;
        }

        deleteForm.action =
            button.dataset.deleteUrl || '';

        deleteImageTitle.textContent =
            button.dataset.imageTitle || 'this image';


        deleteModal.classList.remove(
            'hidden'
        );

        deleteModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'overflow-hidden'
        );
    }


    function closeDeleteModal()
    {
        if (!deleteModal) {
            return;
        }

        deleteModal.classList.add(
            'hidden'
        );

        deleteModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'overflow-hidden'
        );
    }


    document.querySelectorAll(
        '.delete-image'
    ).forEach(button => {

        button.addEventListener(
            'click',
            event => {

                event.preventDefault();
                event.stopPropagation();

                openDeleteModal(button);

            }
        );

    });


    if (cancelDelete) {

        cancelDelete.addEventListener(
            'click',
            closeDeleteModal
        );

    }


    if (deleteBackdrop) {

        deleteBackdrop.addEventListener(
            'click',
            closeDeleteModal
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Keyboard Controls
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        event => {

            if (event.key === 'Escape') {

                closePreview();
                closeDeleteModal();

            }

        }
    );


});

</script>

@endsection