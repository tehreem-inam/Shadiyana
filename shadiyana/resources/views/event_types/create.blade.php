@extends('layouts.app')

@section('title', 'Add Event Type')

@section('content')

<div
    x-data="{
        name: @js(old('name', '')),
        slug: @js(old('slug', '')),
        files: [],
        previews: [],

        generateSlug() {
            this.slug = this.name
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        },

        handleFiles(event) {
            this.files = Array.from(event.target.files);
            this.previews = [];

            this.files.forEach((file) => {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.previews.push({
                        name: file.name,
                        url: e.target.result
                    });
                };

                reader.readAsDataURL(file);
            });
        },

        removeFile(index) {
            this.files.splice(index, 1);
            this.previews.splice(index, 1);

            const input = this.$refs.imageInput;

            const dataTransfer = new DataTransfer();

            this.files.forEach(file => {
                dataTransfer.items.add(file);
            });

            input.files = dataTransfer.files;
        }
    }"
    x-init="
        initializeMarkdownEditor(
            'event-type-description-editor',
            'description',
            @js(old('description', ''))
        )
    "
    class="mx-auto max-w-5xl"
>

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6">

        {{-- Breadcrumb --}}
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

            <span class="text-gray-400">
                Add Event Type
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

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
                            d="M4 6h16M4 12h16M4 18h10"
                        />
                    </svg>
                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                        Add Event Type
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Create and organize a new event type for your platform.
                    </p>

                </div>

            </div>


            {{-- Back --}}
            <a
                href="{{ route('event-types.index') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-900 sm:w-auto"
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
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Back to Event Types

            </a>

        </div>

    </div>


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4"
        >

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
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3l-7.5-13a2 2 0 00-3.42 0z"
                        />
                    </svg>
                </div>

                <div class="min-w-0 flex-1">

                    <p class="text-sm font-bold text-red-800">
                        Please check the following errors
                    </p>

                    <ul class="mt-2 space-y-1 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li class="flex items-start gap-2">

                                <span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-red-500"></span>

                                <span>{{ $error }}</span>

                            </li>

                        @endforeach

                    </ul>

                </div>

                <button
                    type="button"
                    @click="show = false"
                    class="shrink-0 text-red-500 transition hover:text-red-700"
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
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>

        </div>

    @endif


    {{-- ============================================================
        FORM
    ============================================================= --}}

    <form
        action="{{ route('event-types.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


            {{-- ====================================================
                FORM HEADER
            ===================================================== --}}

            <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                d="M4 6h16M4 12h16M4 18h10"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            Event Type Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Configure the event type details, description, images and visibility.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                FORM BODY
            ===================================================== --}}

            <div class="space-y-7 p-5 sm:p-6">


                {{-- ==================================================
                    BASIC INFORMATION
                =================================================== --}}

                <div>

                    <div class="mb-5">

                        <h3 class="text-sm font-extrabold text-gray-900">
                            Basic Information
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Provide the primary information for this event type.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- Name --}}
                        <div>

                            <label
                                for="name"
                                class="mb-2 block text-sm font-bold text-gray-700"
                            >
                                Name
                                <span class="text-[#D7385E]">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                x-model="name"
                                value="{{ old('name') }}"
                                placeholder="e.g. Wedding Ceremony"
                                maxlength="255"
                                required
                                autofocus
                                class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('name') border-red-300 bg-red-50/30 @enderror"
                            >

                            @error('name')

                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Slug --}}
                        <div>

                            <div class="mb-2 flex items-center justify-between gap-3">

                                <label
                                    for="slug"
                                    class="block text-sm font-bold text-gray-700"
                                >
                                    Slug
                                    <span class="text-[#D7385E]">*</span>
                                </label>

                                <button
                                    type="button"
                                    @click="generateSlug()"
                                    class="text-xs font-bold text-[#D7385E] transition hover:text-[#c92f53]"
                                >
                                    Generate from name
                                </button>

                            </div>

                            <div class="relative">

                                <span
                                    class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-gray-400"
                                >
                                    /
                                </span>

                                <input
                                    type="text"
                                    id="slug"
                                    name="slug"
                                    x-model="slug"
                                    value="{{ old('slug') }}"
                                    placeholder="wedding-ceremony"
                                    maxlength="255"
                                    required
                                    class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 pl-8 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('slug') border-red-300 bg-red-50/30 @enderror"
                                >

                            </div>

                            <p class="mt-1.5 text-xs text-gray-400">
                                Use lowercase letters, numbers and hyphens.
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
                                class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('status') border-red-300 bg-red-50/30 @enderror"
                            >

                                <option
                                    value="active"
                                    {{ old('status', 'active') === 'active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    {{ old('status') === 'inactive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                            </select>

                            <p class="mt-1.5 text-xs text-gray-400">
                                Inactive event types can remain stored without being publicly active.
                            </p>

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
                                value="{{ old('sort_order', 0) }}"
                                min="0"
                                placeholder="0"
                                class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('sort_order') border-red-300 bg-red-50/30 @enderror"
                            >

                            <p class="mt-1.5 text-xs text-gray-400">
                                Lower numbers appear first in the event type listing.
                            </p>

                            @error('sort_order')

                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


{{-- ==================================================
    DESCRIPTION
=================================================== --}}

<div class="border-t border-gray-100 pt-7">

    <div class="mb-5">

        <h3 class="text-sm font-extrabold text-gray-900">
            Description
        </h3>

        <p class="mt-1 text-xs text-gray-500">
            Add a detailed description for this event type using headings,
            paragraphs, lists and other formatting.
        </p>

    </div>

    <div>

        <label
            for="description"
            class="mb-2 block text-sm font-bold text-gray-700"
        >
            Description
        </label>

        {{-- Markdown WYSIWYG Editor --}}
        <div
            id="event-type-description-editor"
            data-markdown-editor
            data-input="description"
            class="service-markdown-editor"
        ></div>

        {{-- Hidden input submitted to Laravel --}}
        <input
            type="hidden"
            name="description"
            id="description"
            value="{{ old('description') }}"
        >

        <p class="mt-1.5 text-xs text-gray-400">
            Use the editor to add headings, paragraphs, lists, links and other
            formatting to the event type description.
        </p>

        @error('description')

            <p class="mt-1.5 text-xs font-medium text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>

</div>


{{-- ==================================================
    IMAGES
=================================================== --}}

<div class="border-t border-gray-100 pt-7">

    <div class="mb-5">

        <h3 class="text-sm font-extrabold text-gray-900">
            Event Type Images
        </h3>

        <p class="mt-1 text-xs text-gray-500">
            Upload one or more images for this event type.
        </p>

    </div>

    <div>

        <label
            for="images"
            class="flex min-h-40 cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-5 py-8 text-center transition hover:border-[#D7385E]/40 hover:bg-[#FBEBEF]/40"
        >

            <div
                class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                Choose event type images
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

                {{-- ==================================================
                    INFORMATION NOTE
                =================================================== --}}

                <div class="rounded-2xl border border-[#D7385E]/10 bg-[#FBEBEF] p-4">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[#D7385E]"
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
                                    d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-bold text-gray-800">
                                About Event Types
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-600">
                                Event types help organize different kinds of wedding and
                                celebration events. For example,
                                <span class="font-semibold">Wedding Ceremony</span>,
                                <span class="font-semibold">Mehndi</span>,
                                <span class="font-semibold">Barat</span> and
                                <span class="font-semibold">Walima</span>
                                can be managed as separate event types.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                FORM ACTIONS
            ===================================================== --}}

            <div
                class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/50 px-5 py-4 sm:flex-row sm:items-center sm:justify-end sm:px-6"
            >

                <a
                    href="{{ route('event-types.index') }}"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-800 sm:w-auto"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 sm:w-auto"
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
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Create Event Type

                </button>

            </div>

        </div>

    </form>

</div>

@endsection