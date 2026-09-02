@extends('layouts.app')

@section('title', 'Assign Services')

@section('content')

<div
    class="mx-auto max-w-7xl"
    x-data="vendorServicesForm()"
>

    {{-- ============================================================
        HEADER
    ============================================================= --}}

    <div class="mb-6">

        <div class="mb-3 flex flex-wrap items-center gap-2 text-sm text-gray-400">

            <a
                href="{{ route('vendors.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Vendors
            </a>

            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <a
                href="{{ route('vendors.show', $vendor) }}"
                class="max-w-[220px] truncate transition hover:text-[#D7385E]"
            >
                {{ $vendor->business_name }}
            </a>

            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="text-gray-600">
                Assign Services
            </span>

        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF]">
                    <svg
                        class="h-6 w-6 text-[#D7385E]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M20 7h-9M20 12h-9M20 17h-9M5 7h.01M5 12h.01M5 17h.01"
                        />
                    </svg>
                </div>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                        Assign Services
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Assign services from the taxonomies already assigned to this vendor.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('vendors.show', $vendor) }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Back to Vendor
            </a>

        </div>

    </div>


    {{-- ============================================================
        FLASH MESSAGE
    ============================================================= --}}

    @if(session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3">
            <div class="flex items-start gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-green-600"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l3-3z"
                        clip-rule="evenodd"
                    />
                </svg>

                <p class="text-sm font-medium text-green-700">
                    {{ session('success') }}
                </p>

            </div>
        </div>

    @endif


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

            <p class="text-sm font-bold text-red-700">
                Please correct the following errors:
            </p>

            <ul class="mt-2 space-y-1 text-sm text-red-600">

                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- ============================================================
        VENDOR SUMMARY
    ============================================================= --}}

    <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center">

            <div class="h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-gray-200 bg-[#FBEBEF]">

                @if($vendor->logo_image)

                    <img
                        src="{{ asset('storage/' . $vendor->logo_image) }}"
                        alt="{{ $vendor->business_name }}"
                        class="h-full w-full object-cover"
                    >

                @else

                    <div class="flex h-full w-full items-center justify-center">
                        <span class="text-xl font-bold text-[#D7385E]">
                            {{ strtoupper(substr($vendor->business_name, 0, 1)) }}
                        </span>
                    </div>

                @endif

            </div>

            <div class="min-w-0 flex-1">

                <p class="truncate text-base font-bold text-gray-900">
                    {{ $vendor->business_name }}
                </p>

                <p class="mt-0.5 text-sm text-gray-500">
                    Services are available according to the vendor's assigned taxonomies.
                </p>

            </div>

            <div class="flex items-center gap-2 rounded-xl bg-[#FBEBEF] px-4 py-2.5">

                <svg
                    class="h-4 w-4 text-[#D7385E]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M7 7h.01M7 3h5l9 9a2 2 0 010 3l-6 6a2 2 0 01-3 0l-9-9V7a4 4 0 014-4z"
                    />
                </svg>

                <span class="text-xs font-semibold text-gray-600">
                    Assigned Taxonomies
                </span>

                <span class="text-sm font-bold text-[#D7385E]">
                    {{ $taxonomies->count() }}
                </span>

            </div>

        </div>

    </div>


    {{-- ============================================================
        NO TAXONOMIES
    ============================================================= --}}

    @if($taxonomies->isEmpty())

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF]">

                    <svg
                        class="h-8 w-8 text-[#D7385E]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M7 7h.01M7 3h5l9 9a2 2 0 010 3l-6 6a2 2 0 01-3 0l-9-9V7a4 4 0 014-4z"
                        />
                    </svg>

                </div>

                <h2 class="mt-5 text-lg font-bold text-gray-900">
                    No Taxonomies Assigned
                </h2>

                <p class="mx-auto mt-2 max-w-lg text-sm leading-6 text-gray-500">
                    This vendor does not have any taxonomies assigned yet.
                    Assign taxonomies first to make their related services available.
                </p>

                <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">

                    <a
                        href="{{ route('vendors.taxonomies.create', $vendor) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#D7385E] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52]"
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

                        Assign Taxonomies

                    </a>

                    <a
                        href="{{ route('vendors.show', $vendor) }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                    >
                        Back to Vendor
                    </a>

                </div>

            </div>

        </div>

    @else


        {{-- ========================================================
            MAIN FORM
        ========================================================= --}}

        <form
            method="POST"
            action="{{ route('vendors.services.store', ['vendor' => $vendor]) }}"
            @submit="submitting = true"
        >

            @csrf


            {{-- ====================================================
                SERVICES
            ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Header --}}

                <div class="border-b border-gray-200 p-5 sm:p-6">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <h2 class="text-lg font-bold text-gray-900">
                                Available Services
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Select services from the taxonomies assigned to this vendor.
                            </p>

                        </div>

                        <div class="flex items-center gap-2 rounded-xl bg-[#FBEBEF] px-4 py-2.5">

                            <svg
                                class="h-4 w-4 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                            <span class="text-xs font-semibold text-gray-600">
                                Selected
                            </span>

                            <span
                                class="text-sm font-bold text-[#D7385E]"
                                x-text="selectedServices.length"
                            >
                                0
                            </span>

                        </div>

                    </div>


                    {{-- Search / Actions --}}

                    <div class="mt-5 flex flex-col gap-3 sm:flex-row">

                        <div class="relative flex-1">

                            <svg
                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M21 21l-4.35-4.35m2.1-5.15a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"
                                />
                            </svg>

                            <input
                                type="search"
                                x-model="serviceSearch"
                                placeholder="Search services..."
                                autocomplete="off"
                                class="w-full rounded-lg border border-gray-300 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                            >

                        </div>


                        <button
                            type="button"
                            @click="selectAll()"
                            class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#D7385E]/30 bg-[#FBEBEF] px-4 py-2.5 text-sm font-semibold text-[#D7385E] transition hover:bg-[#f9e2e8]"
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

                            Select All

                        </button>


                        <button
                            type="button"
                            @click="clearServices()"
                            :disabled="selectedServices.length === 0"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40"
                        >
                            Clear
                        </button>

                    </div>

                </div>


                {{-- =================================================
                    SERVICE LIST
                ================================================== --}}

                <div class="p-5 sm:p-6">

                    @foreach($taxonomies as $taxonomy)

                        @php
                            $services = $taxonomy->services;
                        @endphp

                        @if($services->isNotEmpty())

                            <section class="{{ !$loop->last ? 'mb-8' : '' }}">

                                {{-- Taxonomy Header --}}

                                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">

                                    <div class="flex min-w-0 items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF]">

                                            <svg
                                                class="h-4 w-4 text-[#D7385E]"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M7 7h.01M7 3h5l9 9a2 2 0 010 3l-6 6a2 2 0 01-3 0l-9-9V7a4 4 0 014-4z"
                                                />
                                            </svg>

                                        </div>

                                        <div class="min-w-0">

                                            <h3 class="truncate text-sm font-bold text-gray-900">
                                                {{ $taxonomy->name }}
                                            </h3>

                                            <p class="text-xs text-gray-400">
                                                {{ $services->count() }}
                                                {{ $services->count() === 1 ? 'service' : 'services' }}
                                            </p>

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        @click="toggleGroup({{ $taxonomy->id }})"
                                        class="text-xs font-semibold text-[#D7385E] hover:underline"
                                    >
                                        <span x-text="groupSelected({{ $taxonomy->id }}) ? 'Clear all' : 'Select all'">
                                            Select all
                                        </span>
                                    </button>

                                </div>


                                {{-- Services Grid --}}

                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                                    @foreach($services as $service)

                                        <label
                                            x-show="matches('{{ addslashes(strtolower($service->name)) }}')"
                                            class="group flex cursor-pointer items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4 transition hover:border-[#D7385E]/30 hover:bg-[#FBEBEF]/30"
                                            :class="selectedServices.includes({{ $service->id }})
                                                ? 'border-[#D7385E]/40 bg-[#FBEBEF]/50 ring-1 ring-[#D7385E]/20'
                                                : ''"
                                        >

                                            <input
                                                type="checkbox"
                                                name="service_ids[]"
                                                value="{{ $service->id }}"
                                                x-model="selectedServices"
                                                class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#D7385E] focus:ring-[#D7385E]"
                                            >

                                            <div class="min-w-0 flex-1">

                                                <p class="text-sm font-semibold leading-5 text-gray-800">
                                                    {{ $service->name }}
                                                </p>

                                                @if($service->description)

                                                    <p class="mt-1.5 line-clamp-2 text-xs leading-relaxed text-gray-500">
                                                        {{ $service->description }}
                                                    </p>

                                                @endif

                                            </div>

                                        </label>

                                    @endforeach

                                </div>

                            </section>

                        @endif

                    @endforeach


                    {{-- No Services --}}

                    @if($taxonomies->every(fn ($taxonomy) => $taxonomy->services->isEmpty()))

                        <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-5 py-14 text-center">

                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100">

                                <svg
                                    class="h-7 w-7 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-.647-.052-1.282-.152-1.9z"
                                    />
                                </svg>

                            </div>

                            <h3 class="mt-4 text-sm font-bold text-gray-900">
                                No Services Available
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                The assigned taxonomies currently have no services.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ====================================================
                SERVICE DETAILS
            ===================================================== --}}

            <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-200 p-5 sm:p-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FBEBEF]">

                            <svg
                                class="h-5 w-5 text-[#D7385E]"
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

                            <h2 class="text-base font-bold text-gray-900">
                                Service Details
                            </h2>

                            <p class="mt-1 text-xs text-gray-500">
                                These details will be applied to the selected services.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 lg:grid-cols-2">

                    {{-- Custom Name --}}

                    <div>

                        <label
                            for="custom_name"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Custom Name
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>
                        </label>

                        <input
                            id="custom_name"
                            type="text"
                            name="custom_name"
                            value="{{ old('custom_name') }}"
                            maxlength="255"
                            placeholder="e.g. Premium Wedding Photography"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                        <p class="mt-1.5 text-xs text-gray-400">
                            Override the default service name for this vendor.
                        </p>

                        @error('custom_name')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}

                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Status
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                        >

                            <option
                                value="active"
                                @selected(old('status', 'active') === 'active')
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                @selected(old('status') === 'inactive')
                            >
                                Inactive
                            </option>

                        </select>

                        <p class="mt-1.5 text-xs text-gray-400">
                            Controls whether these vendor services are active.
                        </p>

                        @error('status')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Description --}}

                    <div class="lg:col-span-2">

                        <label
                            for="description"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Vendor-Specific Description
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            maxlength="50000"
                            placeholder="Describe how this vendor provides the selected services..."
                            class="w-full resize-y rounded-lg border border-gray-300 bg-white px-3.5 py-3 text-sm leading-relaxed text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                        >{{ old('description') }}</textarea>

                        <div class="mt-1.5 flex items-center justify-between">

                            <p class="text-xs text-gray-400">
                                This description is specific to this vendor.
                            </p>

                            <span
                                class="text-xs text-gray-400"
                                x-text="descriptionLength + ' / 50000'"
                            >
                                {{ strlen(old('description', '')) }} / 50000
                            </span>

                        </div>

                        @error('description')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- ====================================================
                FOOTER
            ===================================================== --}}

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <p
                        x-show="selectedServices.length === 0"
                        class="text-sm text-gray-500"
                    >
                        Select at least one service to continue.
                    </p>

                    <p
                        x-show="selectedServices.length > 0"
                        x-cloak
                        class="text-sm font-medium text-[#D7385E]"
                    >
                        <span x-text="selectedServices.length"></span>

                        selected
                        service<span x-show="selectedServices.length !== 1">s</span>.
                    </p>

                </div>


                <div class="flex flex-col-reverse gap-3 sm:flex-row">

                    <a
                        href="{{ route('vendors.show', ['vendor' => $vendor]) }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        :disabled="selectedServices.length === 0 || submitting"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#D7385E] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52] disabled:cursor-not-allowed disabled:opacity-50"
                    >

                        <svg
                            x-show="!submitting"
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

                        <svg
                            x-show="submitting"
                            x-cloak
                            class="h-4 w-4 animate-spin"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            />

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            />
                        </svg>

                        <span x-text="submitting ? 'Assigning...' : 'Assign Services'">
                            Assign Services
                        </span>

                    </button>

                </div>

            </div>

        </form>

    @endif

</div>


{{-- ================================================================
    ALPINE COMPONENT
================================================================ --}}

<script>

function vendorServicesForm() {

    return {

        selectedServices: @js(
            old(
                'service_ids',
                $vendor->services->pluck('id')->values()->all()
            )
        ).map(Number),

        serviceSearch: '',

        submitting: false,

        descriptionLength: {{ strlen(old('description', '')) }},

        /*
        |--------------------------------------------------------------------------
        | Services grouped by taxonomy
        |--------------------------------------------------------------------------
        */

        groups: @js(
            $taxonomies->mapWithKeys(
                fn ($taxonomy) => [
                    $taxonomy->id => $taxonomy->services
                        ->pluck('id')
                        ->map(fn ($id) => (int) $id)
                        ->values()
                        ->all()
                ]
            )
        ),

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        matches(name) {

            const search = this.serviceSearch.trim().toLowerCase();

            return !search || name.includes(search);

        },

        /*
        |--------------------------------------------------------------------------
        | Select all services
        |--------------------------------------------------------------------------
        */

        selectAll() {

            const ids = Object.values(this.groups).flat();

            this.selectedServices = [
                ...new Set([
                    ...this.selectedServices,
                    ...ids
                ])
            ];

        },

        /*
        |--------------------------------------------------------------------------
        | Clear
        |--------------------------------------------------------------------------
        */

        clearServices() {

            this.selectedServices = [];

        },

        /*
        |--------------------------------------------------------------------------
        | Toggle taxonomy services
        |--------------------------------------------------------------------------
        */

        toggleGroup(taxonomyId) {

            const ids = this.groups[taxonomyId] || [];

            if (!ids.length) return;

            const allSelected = ids.every(
                id => this.selectedServices.includes(id)
            );

            if (allSelected) {

                this.selectedServices =
                    this.selectedServices.filter(
                        id => !ids.includes(id)
                    );

                return;

            }

            this.selectedServices = [
                ...new Set([
                    ...this.selectedServices,
                    ...ids
                ])
            ];

        },

        /*
        |--------------------------------------------------------------------------
        | Check taxonomy selection
        |--------------------------------------------------------------------------
        */

        groupSelected(taxonomyId) {

            const ids = this.groups[taxonomyId] || [];

            return ids.length > 0 &&
                ids.every(
                    id => this.selectedServices.includes(id)
                );

        },

        /*
        |--------------------------------------------------------------------------
        | Initialize
        |--------------------------------------------------------------------------
        */

        init() {

            this.selectedServices = [
                ...new Set(
                    this.selectedServices.map(Number)
                )
            ];

            const description =
                document.getElementById('description');

            if (description) {

                description.addEventListener(
                    'input',
                    event => {
                        this.descriptionLength =
                            event.target.value.length;
                    }
                );

            }

        }

    };

}

</script>


<style>

[x-cloak] {
    display: none !important;
}

</style>

@endsection