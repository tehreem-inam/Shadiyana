@extends('layouts.app')

@section('title', 'Edit Taxonomy')

@section('content')

<div
    x-data="{
        name: @js(old('name', $taxonomy->name)),
        slug: @js(old('slug', $taxonomy->slug))
    }"
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

            <span class="font-medium text-gray-500">
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
                href="{{ route('taxonomies.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Taxonomies
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

            <span class="text-gray-500">
                Edit
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
                            d="M12 20h9"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1-1 1 1-4L16.5 3.5z"
                        />
                    </svg>
                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                        Edit Taxonomy
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Update taxonomy information, hierarchy and visibility.
                    </p>

                </div>

            </div>


            {{-- Back --}}
            <a
                href="{{ route('taxonomies.index') }}"
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
                        d="M19 12H5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 19l-7-7 7-7"
                    />
                </svg>

                Back to Taxonomies

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

                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-500"></span>

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
        EDIT FORM
    ============================================================= --}}

    <form
        action="{{ route('taxonomies.update', $taxonomy) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        {{-- ========================================================
            BASIC INFORMATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Card Header --}}
            <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

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
                                stroke-width="1.8"
                                d="M4 6h16M4 12h16M4 18h10"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            Taxonomy Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Update the taxonomy details, classification and hierarchy.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Card Body --}}
            <div class="space-y-7 p-5 sm:p-6">


                {{-- ==================================================
                    BASIC DETAILS
                =================================================== --}}

                <div>

                    <div class="mb-5">

                        <h3 class="text-sm font-extrabold text-gray-900">
                            Basic Details
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Update the primary information for this taxonomy.
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
                                value="{{ old('name', $taxonomy->name) }}"
                                maxlength="255"
                                required
                                autofocus
                                placeholder="e.g. Wedding Venues"
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
                                    @click="
                                        slug = name
                                            .toLowerCase()
                                            .trim()
                                            .replace(/[^a-z0-9\s-]/g, '')
                                            .replace(/\s+/g, '-')
                                            .replace(/-+/g, '-')
                                    "
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
                                    value="{{ old('slug', $taxonomy->slug) }}"
                                    maxlength="255"
                                    required
                                    placeholder="wedding-venues"
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


                        {{-- Type --}}
                        <div>

                            <label
                                for="type"
                                class="mb-2 block text-sm font-bold text-gray-700"
                            >
                                Type
                                <span class="text-[#D7385E]">*</span>
                            </label>

                            <select
                                id="type"
                                name="type"
                                required
                                class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('type') border-red-300 bg-red-50/30 @enderror"
                            >

                                <option value="">
                                    Select taxonomy type
                                </option>

                                <option
                                    value="category"
                                    @selected(old('type', $taxonomy->type) === 'category')
                                >
                                    Category
                                </option>

                                <option
                                    value="vendor"
                                    @selected(old('type', $taxonomy->type) === 'vendor')
                                >
                                    Vendor
                                </option>

                                <option
                                    value="venue"
                                    @selected(old('type', $taxonomy->type) === 'venue')
                                >
                                    Venue
                                </option>

                                <option
                                    value="location"
                                    @selected(old('type', $taxonomy->type) === 'location')
                                >
                                    Location
                                </option>

                                <option
                                    value="service"
                                    @selected(old('type', $taxonomy->type) === 'service')
                                >
                                    Service
                                </option>

                                <option
                                    value="event"
                                    @selected(old('type', $taxonomy->type) === 'event')
                                >
                                    Event
                                </option>

                                <option
                                    value="other"
                                    @selected(old('type', $taxonomy->type) === 'other')
                                >
                                    Other
                                </option>

                            </select>

                            <p class="mt-1.5 text-xs text-gray-400">
                                Select the classification of this taxonomy.
                            </p>

                            @error('type')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Parent Taxonomy --}}
                        <div>

                            <label
                                for="parent_id"
                                class="mb-2 block text-sm font-bold text-gray-700"
                            >
                                Parent Taxonomy
                            </label>

                            <select
                                id="parent_id"
                                name="parent_id"
                                class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('parent_id') border-red-300 bg-red-50/30 @enderror"
                            >

                                <option value="">
                                    None — Root Taxonomy
                                </option>

                                @foreach($parents as $parent)

                                    <option
                                        value="{{ $parent->id }}"
                                        @selected(
                                            (string) old(
                                                'parent_id',
                                                $taxonomy->parent_id
                                            ) === (string) $parent->id
                                        )
                                    >
                                        {{ $parent->name }}
                                    </option>

                                @endforeach

                            </select>

                            <p class="mt-1.5 text-xs text-gray-400">
                                Leave empty if this taxonomy should remain at the root level.
                            </p>

                            @error('parent_id')
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
                            Provide additional information about this taxonomy.
                        </p>

                    </div>

                    <div>

                        <label
                            for="description"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Write a short description about this taxonomy..."
                            class="w-full resize-y rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm leading-6 text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('description') border-red-300 bg-red-50/30 @enderror"
                        >{{ old('description', $taxonomy->description) }}</textarea>

                        <p class="mt-1.5 text-xs text-gray-400">
                            A short description helps administrators understand the purpose of this taxonomy.
                        </p>

                        @error('description')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
            IMAGE
        ========================================================= --}}

        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

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
                                stroke-width="1.8"
                                d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"
                            />

                            <circle
                                cx="8.5"
                                cy="8.5"
                                r="1.5"
                                stroke-width="1.8"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M4 16l5-5 3 3 2-2 6 6"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            Taxonomy Image
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Update the stored image path or URL for this taxonomy.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <label
                    for="image"
                    class="mb-2 block text-sm font-bold text-gray-700"
                >
                    Image Path / URL
                </label>

                <input
                    type="text"
                    id="image"
                    name="image"
                    value="{{ old('image', $taxonomy->image) }}"
                    maxlength="255"
                    placeholder="e.g. taxonomies/wedding-venues.jpg"
                    class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('image') border-red-300 bg-red-50/30 @enderror"
                >

                <p class="mt-1.5 text-xs text-gray-400">
                    Enter the stored image path or image URL.
                </p>

                @if($taxonomy->image)

                    <div class="mt-4 rounded-2xl border border-gray-100 bg-gray-50 p-4">

                        <div class="flex items-center gap-4">

                            <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-gray-200 bg-white">

                                <img
                                    src="{{ $taxonomy->image }}"
                                    alt="{{ $taxonomy->name }}"
                                    class="h-full w-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');"
                                >

                                <svg
                                    class="hidden h-6 w-6 text-gray-300"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"
                                    />
                                </svg>

                            </div>

                            <div class="min-w-0">

                                <p class="text-sm font-bold text-gray-700">
                                    Current Image
                                </p>

                                <p class="mt-1 truncate text-xs text-gray-400">
                                    {{ $taxonomy->image }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endif

                @error('image')
                    <p class="mt-1.5 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        {{-- ========================================================
            DISPLAY SETTINGS
        ========================================================= --}}

        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

                <div class="flex items-start gap-3">

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
                                stroke-width="1.8"
                                d="M12 8v4l3 2"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                stroke-width="1.8"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            Display Settings
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Configure the display order and current visibility status.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2">


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
                        value="{{ old('sort_order', $taxonomy->sort_order ?? 0) }}"
                        min="0"
                        step="1"
                        placeholder="0"
                        class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('sort_order') border-red-300 bg-red-50/30 @enderror"
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
                            @selected(old('status', $taxonomy->status) === 'active')
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            @selected(old('status', $taxonomy->status) === 'inactive')
                        >
                            Inactive
                        </option>

                    </select>

                    <p class="mt-1.5 text-xs text-gray-400">
                        Inactive taxonomies remain stored but are not considered active.
                    </p>

                    @error('status')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- ========================================================
            INFORMATION NOTE
        ========================================================= --}}

        <div class="mt-6 rounded-2xl border border-[#D7385E]/10 bg-[#FBEBEF] p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[#D7385E]">

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
                        Taxonomy hierarchy
                    </p>

                    <p class="mt-1 text-xs leading-5 text-gray-600">
                        Use the
                        <span class="font-semibold">Parent Taxonomy</span>
                        field to organize taxonomies into a hierarchy.
                        Root taxonomies have no parent, while child taxonomies
                        belong under an existing root taxonomy.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================
            FORM ACTIONS
        ========================================================= --}}

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

            <a
                href="{{ route('taxonomies.index') }}"
                class="inline-flex w-full items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900 sm:w-auto"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 py-3 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 sm:w-auto"
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
                        d="M5 12l4 4L19 6"
                    />
                </svg>

                Update Taxonomy

            </button>

        </div>

    </form>

</div>

@endsection