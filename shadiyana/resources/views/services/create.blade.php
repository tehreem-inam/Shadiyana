@extends('layouts.app')

@section('title', 'Add Service')

@section('content')

<div
    x-data="{
        name: @js(old('name', '')),
        slug: @js(old('slug', '')),
        fileName: '',
        preview: null,

        generateSlug() {
            this.slug = this.name
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        },

        handleFile(event) {
            const file = event.target.files[0];

            if (!file) {
                this.preview = null;
                this.fileName = '';
                return;
            }

            this.fileName = file.name;

            const reader = new FileReader();

            reader.onload = (e) => {
                this.preview = e.target.result;
            };

            reader.readAsDataURL(file);
        }
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

            <span class="text-gray-400">
                Add Service
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
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 5a3 3 0 016 0v1H9V5z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M8 12h8M8 16h5"
                        />
                    </svg>

                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                        Add Service
                    </h1>

                    <p class="mt-0.5 text-sm text-gray-500">
                        Create and organize a new service for your catalog.
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
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Back to Services

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
        action="{{ route('services.store') }}"
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
                            Service Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Configure the service details, taxonomy and visibility.
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
                            Provide the primary information for this service.
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
                                placeholder="e.g. Wedding Photography"
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
                                    placeholder="wedding-photography"
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


                        {{-- Taxonomy --}}
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
                                class="h-12 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('taxonomy_id') border-red-300 bg-red-50/30 @enderror"
                            >

                                <option value="">
                                    Select taxonomy
                                </option>

                                @foreach($taxonomies as $taxonomy)

                                    <option
                                        value="{{ $taxonomy->id }}"
                                        {{ (string) old('taxonomy_id') === (string) $taxonomy->id ? 'selected' : '' }}
                                    >
                                        {{ $taxonomy->name }}
                                    </option>

                                @endforeach

                            </select>

                            <p class="mt-1.5 text-xs text-gray-400">
                                Select the taxonomy that this service belongs to.
                            </p>

                            @error('taxonomy_id')

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
                                Inactive services can remain stored without being displayed as active.
                            </p>

                            @error('status')

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
                            Add additional information to describe this service.
                        </p>

                    </div>

                    <div>

                        <label
                            for="description"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Description
                        </label>

<div
    id="service-description-editor"
    data-markdown-editor
    data-input="description"
    class="service-markdown-editor"
></div>

<input
    type="hidden"
    name="description"
    id="description"
    value="{{ old('description') }}"
>

                        @error('description')

                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- ==================================================
                    IMAGE
                =================================================== --}}

                <div class="border-t border-gray-100 pt-7">

                    <div class="mb-5">

                        <h3 class="text-sm font-extrabold text-gray-900">
                            Service Image
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Upload an optional image to visually represent this service.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-[160px_1fr]">


                        {{-- Preview --}}
                        <div class="flex items-start justify-center sm:justify-start">

                            <div
                                class="flex h-36 w-36 items-center justify-center overflow-hidden rounded-2xl border border-dashed border-gray-300 bg-gray-50"
                            >

                                <template x-if="preview">

                                    <img
                                        :src="preview"
                                        alt="Service preview"
                                        class="h-full w-full object-cover"
                                    >

                                </template>

                                <template x-if="!preview">

                                    <div class="flex flex-col items-center text-center">

                                        <svg
                                            class="h-8 w-8 text-gray-300"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M4 16l4.5-4.5a2 2 0 012.83 0L15 15l2-2a2 2 0 012.83 0L21 14.17M4 19h16a1 1 0 001-1V6a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1z"
                                            />

                                            <circle
                                                cx="8.5"
                                                cy="8.5"
                                                r="1.5"
                                                stroke-width="1.5"
                                            />
                                        </svg>

                                        <span class="mt-2 text-[10px] font-semibold text-gray-400">
                                            Image Preview
                                        </span>

                                    </div>

                                </template>

                            </div>

                        </div>


                        {{-- Upload --}}
                        <div>

                            <label
                                for="image"
                                class="flex min-h-36 cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-5 py-6 text-center transition hover:border-[#D7385E]/40 hover:bg-[#FBEBEF]/40"
                            >

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
                                            d="M12 16V4m0 0L7 9m5-5l5 5M5 20h14"
                                        />
                                    </svg>

                                </div>

                                <span class="mt-3 text-sm font-bold text-gray-700">
                                    Choose an image
                                </span>

                                <span class="mt-1 text-xs text-gray-400">
                                    PNG, JPG or WEBP · Max 2MB
                                </span>

                                <span
                                    x-show="fileName"
                                    x-text="fileName"
                                    class="mt-2 max-w-full truncate text-xs font-semibold text-[#D7385E]"
                                ></span>

                                <input
                                    id="image"
                                    name="image"
                                    type="file"
                                    accept="image/png,image/jpeg,image/webp"
                                    class="hidden"
                                    @change="handleFile"
                                >

                            </label>

                            @error('image')

                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

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
                                About services
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-600">
                                Services belong to a taxonomy and can later be assigned
                                to vendors. For example,
                                <span class="font-semibold">Wedding Photography</span>
                                can belong to a
                                <span class="font-semibold">Photography</span>
                                taxonomy.
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
                    href="{{ route('services.index') }}"
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

                    Create Service

                </button>

            </div>

        </div>

    </form>

</div>

@endsection