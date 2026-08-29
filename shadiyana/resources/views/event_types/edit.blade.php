@extends('layouts.app')

@section('title', 'Edit Event Type')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6">

        {{-- Breadcrumb --}}
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-400">

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

            <span class="font-medium text-gray-600">
                Edit
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4 flex items-center gap-3">

            <div
                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                        d="M12 20h9"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                    />
                </svg>
            </div>

            <div>

                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                    Edit Event Type
                </h1>

                <p class="mt-0.5 text-sm text-gray-500">
                    Update the event type information, description, and images.
                </p>

            </div>

        </div>

    </div>


    {{-- ============================================================
        SUCCESS MESSAGE
    ============================================================= --}}

    @if(session('success'))

        <div
            class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4"
        >

            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-600"
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
                        d="M5 13l4 4L19 7"
                    />
                </svg>
            </div>

            <div>

                <p class="text-sm font-bold text-green-800">
                    Success
                </p>

                <p class="mt-0.5 text-sm text-green-700">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600"
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
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3l-7.5-13a2 2 0 00-3.42 0z"
                        />
                    </svg>
                </div>

                <div>

                    <p class="text-sm font-bold text-red-800">
                        Please fix the following errors
                    </p>

                    <ul class="mt-1 list-disc space-y-0.5 pl-5 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
        UPDATE EVENT TYPE FORM
        IMPORTANT:
        Existing image delete forms are NOT inside this form.
    ============================================================= --}}

    <form
        action="{{ route('event-types.update', $eventType) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- ========================================================
            BASIC INFORMATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <h2 class="text-base font-extrabold text-gray-900">
                    Basic Information
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update the basic details of this event type.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2">

                {{-- Name --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Event Type Name
                        <span class="text-[#D7385E]">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $eventType->name) }}"
                        placeholder="e.g. Wedding"
                        required
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('name') border-red-300 bg-red-50 @enderror"
                    >

                    @error('name')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Slug --}}
                <div>

                    <label
                        for="slug"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Slug
                        <span class="text-[#D7385E]">*</span>
                    </label>

                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        value="{{ old('slug', $eventType->slug) }}"
                        placeholder="e.g. wedding"
                        required
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('slug') border-red-300 bg-red-50 @enderror"
                    >

                    <p class="mt-1.5 text-xs text-gray-400">
                        The URL-friendly identifier for this event type.
                    </p>

                    @error('slug')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label
                        for="status"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Status
                        <span class="text-[#D7385E]">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('status') border-red-300 bg-red-50 @enderror"
                    >

                        <option
                            value="active"
                            {{ old('status', $eventType->status) === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            {{ old('status', $eventType->status) === 'inactive' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Sort Order --}}
                <div>

                    <label
                        for="sort_order"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Sort Order
                    </label>

                    <input
                        type="number"
                        id="sort_order"
                        name="sort_order"
                        min="0"
                        value="{{ old('sort_order', $eventType->sort_order ?? 0) }}"
                        placeholder="0"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('sort_order') border-red-300 bg-red-50 @enderror"
                    >

                    <p class="mt-1.5 text-xs text-gray-400">
                        Lower numbers appear first.
                    </p>

                    @error('sort_order')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- ========================================================
            DESCRIPTION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <h2 class="text-base font-extrabold text-gray-900">
                    Description
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update the event type description using Markdown.
                </p>

            </div>


            <div class="p-5 sm:p-6">

                <div
                    id="event-type-description-editor"
                    data-markdown-editor
                    data-input="description"
                    class="event-type-markdown-editor"
                ></div>


                <input
                    type="hidden"
                    name="description"
                    id="description"
                    value="{{ old('description', $eventType->description) }}"
                >


                @error('description')
                    <p class="mt-1.5 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        {{-- ========================================================
            ADD NEW IMAGES
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <h2 class="text-base font-extrabold text-gray-900">
                            Add New Images
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Upload one or more additional images.
                        </p>

                    </div>

                    <span
                        class="hidden rounded-lg bg-[#FBEBEF] px-2.5 py-1 text-xs font-bold text-[#D7385E] sm:inline-flex"
                    >
                        Multiple allowed
                    </span>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <label
                    for="images"
                    class="flex min-h-44 cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-5 py-8 text-center transition hover:border-[#D7385E]/40 hover:bg-[#FBEBEF]/40"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                d="M12 16V4m0 0L7 9m5-5l5 5M5 20h14"
                            />
                        </svg>

                    </div>

                    <span class="mt-3 text-sm font-bold text-gray-700">
                        Choose additional images
                    </span>

                    <span class="mt-1 text-xs text-gray-400">
                        PNG, JPG, JPEG or WEBP · Multiple images allowed · Max 2MB each
                    </span>

                    <input
                        id="images"
                        name="images[]"
                        type="file"
                        accept="image/png,image/jpeg,image/webp"
                        multiple
                        class="hidden"
                    >

                </label>


                {{-- New Image Preview --}}
                <div
                    id="image-preview"
                    class="mt-5 hidden grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4"
                ></div>


                @error('images')
                    <p class="mt-1.5 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

                @error('images.*')
                    <p class="mt-1.5 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        {{-- ========================================================
            FORM ACTIONS
        ========================================================= --}}

        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-between">

            <a
                href="{{ route('event-types.index') }}"
                class="inline-flex w-full items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900 sm:w-auto"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 py-3 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 sm:w-auto"
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
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                Update Event Type

            </button>

        </div>

    </form>


    {{-- ============================================================
        EXISTING IMAGES
        IMPORTANT:
        This section is OUTSIDE the update form.
    ============================================================= --}}

    @if($eventType->images->count())

        <div class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <h2 class="text-base font-extrabold text-gray-900">
                            Existing Images
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Manage the images currently attached to this event type.
                        </p>

                    </div>

                    <span
                        class="shrink-0 rounded-lg bg-[#FBEBEF] px-2.5 py-1 text-xs font-bold text-[#D7385E]"
                    >
                        {{ $eventType->images->count() }}
                        {{ Str::plural('image', $eventType->images->count()) }}
                    </span>

                </div>

            </div>


            {{-- Images --}}
            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                    @foreach($eventType->images as $image)

                        <div
                            x-data="{ confirmDelete: false }"
                            class="min-w-0"
                        >

                            {{-- ==================================================
                                IMAGE CARD
                            =================================================== --}}

                            <div
                                class="group relative aspect-square overflow-hidden rounded-2xl border border-gray-200 bg-gray-50"
                            >

                                <img
                                    src="{{ asset('storage/' . $image->path) }}"
                                    alt="{{ $eventType->name }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                >


                                {{-- Overlay --}}
                                <div
                                    class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/20 opacity-0 transition duration-300 group-hover:opacity-100"
                                ></div>


                                {{-- Remove Button --}}
                                <button
                                    type="button"
                                    @click="confirmDelete = true"
                                    class="absolute right-2 top-2 flex h-9 w-9 items-center justify-center rounded-full bg-white/95 text-gray-600 opacity-0 shadow-md transition hover:bg-red-50 hover:text-red-600 group-hover:opacity-100"
                                    title="Remove image"
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
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>

                                </button>

                            </div>


                            {{-- ==================================================
                                DELETE CONFIRMATION
                            =================================================== --}}

                            <div
                                x-show="confirmDelete"
                                x-cloak
                                x-transition
                                class="mt-2 overflow-hidden rounded-xl border border-red-200 bg-red-50"
                            >

                                <div class="px-3 py-2.5">

                                    <p class="text-[11px] font-bold leading-4 text-red-800">
                                        Delete this image?
                                    </p>

                                    <p class="mt-0.5 text-[10px] leading-4 text-red-600">
                                        This action cannot be undone.
                                    </p>

                                </div>


                                <div
                                    class="flex items-center justify-end gap-2 border-t border-red-100 bg-white/70 px-3 py-2"
                                >

                                    {{-- Cancel --}}
                                    <button
                                        type="button"
                                        @click="confirmDelete = false"
                                        class="rounded-lg px-2.5 py-1.5 text-[10px] font-bold text-gray-600 transition hover:bg-gray-100"
                                    >
                                        Cancel
                                    </button>


                                    {{-- DELETE FORM
                                         This form is now completely
                                         outside the update form.
                                    --}}
                                    <form
                                        action="{{ route('event-types.images.destroy', [$eventType, $image]) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-red-600 px-2.5 py-1.5 text-[10px] font-bold text-white transition hover:bg-red-700"
                                        >

                                            <svg
                                                class="h-3 w-3"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M6 7h12M10 11v6M14 11v6M8 7l1 13h6l1-13M9 7V4h6v3"
                                                />
                                            </svg>

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    @endif

</div>


{{-- ================================================================
    NEW IMAGE PREVIEW
================================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('images');
    const preview = document.getElementById('image-preview');

    if (!input || !preview) {
        return;
    }

    input.addEventListener('change', function () {

        preview.innerHTML = '';

        if (!this.files.length) {
            preview.classList.add('hidden');
            return;
        }

        preview.classList.remove('hidden');

        Array.from(this.files).forEach(function (file) {

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const wrapper = document.createElement('div');

                wrapper.className =
                    'overflow-hidden rounded-2xl border border-gray-200 bg-gray-50';

                wrapper.innerHTML = `
                    <div class="aspect-square">
                        <img
                            src="${event.target.result}"
                            alt="${file.name}"
                            class="h-full w-full object-cover"
                        >
                    </div>

                    <div class="border-t border-gray-100 bg-white px-3 py-2">

                        <p class="truncate text-xs font-semibold text-gray-600">
                            ${file.name}
                        </p>

                        <p class="mt-0.5 text-[10px] text-gray-400">
                            ${(file.size / 1024 / 1024).toFixed(2)} MB
                        </p>

                    </div>
                `;

                preview.appendChild(wrapper);
            };

            reader.readAsDataURL(file);

        });

    });

});
</script>

@endsection