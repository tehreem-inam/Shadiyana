@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')

<div
    x-data="{
        name: @js(old('name', $service->name)),
        slug: @js(old('slug', $service->slug))
    }"
    class="mx-auto max-w-4xl"
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

            <a
                href="{{ route('services.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Catalog
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

            <a
                href="{{ route('services.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Services
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
                            d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                        />
                    </svg>
                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                        Edit Service
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Update service information, category and availability.
                    </p>

                </div>

            </div>


            {{-- Back --}}
            <a
                href="{{ route('services.index') }}"
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

                Back to Services

            </a>

        </div>

    </div>

<!-- 
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
                            stroke-width="2"
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
                    class="text-red-500 transition hover:text-red-700"
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

    @endif -->


    {{-- ============================================================
        EDIT FORM
    ============================================================= --}}

 <form
    action="{{ route('services.update', $service->id) }}"
    method="POST"
    enctype="multipart/form-data"
>

        @csrf
        @method('PUT')


        {{-- ========================================================
            BASIC INFORMATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                            Basic Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Update the service name, taxonomy and description.
                        </p>

                    </div>

                </div>

            </div>


            <div class="space-y-6 p-5 sm:p-6">

                {{-- =================================================
                    Service Name
                ================================================== --}}

                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Service Name
                        <span class="text-[#D7385E]">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        x-model="name"
                        maxlength="255"
                        required
                        placeholder="e.g. Wedding Photography"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('name') border-red-300 bg-red-50 @enderror"
                    >

                    @error('name')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- =================================================
                    Slug
                ================================================== --}}

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

                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        x-model="slug"
                        maxlength="255"
                        required
                        placeholder="e.g. wedding-photography"
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('slug') border-red-300 bg-red-50 @enderror"
                    >

                    <p class="mt-1.5 text-xs text-gray-400">
                        Use lowercase letters, numbers and hyphens.
                    </p>

                    @error('slug')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- =================================================
                    Taxonomy
                ================================================== --}}

                <div>

                    <label
                        for="taxonomy_id"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Taxonomy
                        <span class="text-[#D7385E]">*</span>
                    </label>

                    <select
                        id="taxonomy_id"
                        name="taxonomy_id"
                        required
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('taxonomy_id') border-red-300 bg-red-50 @enderror"
                    >

                        <option value="">
                            Select taxonomy
                        </option>

                        @foreach($taxonomies as $taxonomyOption)

                            <option
                                value="{{ $taxonomyOption->id }}"
                                @selected(
                                    (string) old(
                                        'taxonomy_id',
                                        $service->taxonomy_id
                                    ) === (string) $taxonomyOption->id
                                )
                            >
                                {{ $taxonomyOption->name }}
                            </option>

                        @endforeach

                    </select>

                    <p class="mt-1.5 text-xs text-gray-400">
                        Select the taxonomy this service belongs to.
                    </p>

                    @error('taxonomy_id')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- =================================================
                    Description
                ================================================== --}}
<div>

    <label
        for="description"
        class="mb-2 block text-sm font-bold text-gray-700"
    >
        Description
    </label>

    {{-- Markdown WYSIWYG Editor --}}
    <div
        id="service-description-editor"
        data-markdown-editor
        data-input="description"
        class="service-markdown-editor"
    ></div>

    {{-- Hidden input submitted to Laravel --}}
    <input
        type="hidden"
        name="description"
        id="description"
        value="{{ old('description', $service->description) }}"
    >

    <p class="mt-1.5 text-xs text-gray-400">
        Provide a detailed description to help vendors and customers understand this service.
    </p>

    @error('description')
        <p class="mt-1.5 text-xs font-medium text-red-600">
            {{ $message }}
        </p>
    @enderror

</div>
            </div>

        </div>


  
{{-- ========================================================
    IMAGE
========================================================= --}}

<div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

        <div class="flex items-center gap-3">

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                    Service Image
                </h2>

                <p class="mt-0.5 text-xs text-gray-500">
                    Upload a new image for this service.
                </p>
            </div>

        </div>

    </div>


    <div class="p-5 sm:p-6">

        {{-- Current Image --}}
        @if($service->image)

            <div class="mb-5">

                <p class="mb-2 text-sm font-bold text-gray-700">
                    Current Image
                </p>

                <div class="flex flex-col gap-4 rounded-xl border border-gray-100 bg-gray-50 p-4 sm:flex-row sm:items-center">

                    <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl border border-gray-200 bg-white">

                        <img
                            src="{{ asset('storage/' . $service->image) }}"
                            alt="{{ $service->name }}"
                            class="h-full w-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >

                        <div class="hidden h-full w-full items-center justify-center">

                            <svg
                                class="h-8 w-8 text-gray-300"
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

                    </div>


                    <div class="min-w-0">

                        <p class="text-sm font-bold text-gray-700">
                            {{ $service->name }}
                        </p>

                        <p class="mt-1 break-all text-xs text-gray-400">
                            {{ $service->image }}
                        </p>

                        <p class="mt-2 text-xs text-gray-400">
                            Uploading a new image will replace this image.
                        </p>

                    </div>

                </div>

            </div>

        @endif


        {{-- Upload New Image --}}
        <div>

            <label
                for="image"
                class="mb-2 block text-sm font-bold text-gray-700"
            >
                {{ $service->image ? 'Replace Image' : 'Service Image' }}
            </label>

            <input
                type="file"
                id="image"
                name="image"
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                class="block w-full cursor-pointer rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-600 outline-none transition file:mr-4 file:border-0 file:bg-[#FBEBEF] file:px-4 file:py-3 file:text-sm file:font-bold file:text-[#D7385E] hover:file:bg-[#f8dfe5] focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('image') border-red-300 bg-red-50 @enderror"
            >

            <p class="mt-1.5 text-xs text-gray-400">
                Accepted formats: JPG, JPEG, PNG and WEBP. Maximum size: 2 MB.
            </p>

            @error('image')
                <p class="mt-1.5 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

    </div>

</div>


        {{-- ========================================================
            SETTINGS
        ========================================================= --}}

        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                            Settings
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Configure the current availability of this service.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

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
                        class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('status') border-red-300 bg-red-50 @enderror"
                    >

                        <option
                            value="active"
                            @selected(old('status', $service->status) === 'active')
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            @selected(old('status', $service->status) === 'inactive')
                        >
                            Inactive
                        </option>

                    </select>

                    <p class="mt-1.5 text-xs text-gray-400">
                        Inactive services remain stored but will not be treated as currently available.
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
            FORM ACTIONS
        ========================================================= --}}

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

            {{-- Cancel --}}
            <a
                href="{{ route('services.index') }}"
                class="inline-flex w-full items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900 sm:w-auto"
            >
                Cancel
            </a>


            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">

                {{-- View Service --}}
                <a
                    href="{{ route('services.show', $service->id) }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-900 sm:w-auto"
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
                            d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="2.5"
                            stroke-width="1.8"
                        />
                    </svg>

                    View Service

                </a>


                {{-- Update --}}
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

                    Update Service

                </button>

            </div>

        </div>

    </form>

</div>

@endsection