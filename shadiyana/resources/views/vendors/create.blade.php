@extends('layouts.app')

@section('title', 'Create Vendor')

@section('content')

<div class="min-h-screen bg-gray-50">

    {{-- ================================================================
        HEADER
    ================================================================= --}}
    <div class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="mb-4 flex items-center gap-2 text-sm text-gray-500">
                <a
                    href="{{ route('vendors.index') }}"
                    class="transition hover:text-[#d7385e]"
                >
                    Vendors
                </a>

                <svg
                    class="h-4 w-4 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m9 5 7 7-7 7"
                    />
                </svg>

                <span class="font-medium text-gray-700">
                    Create Vendor
                </span>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Create Vendor
                    </h1>

                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Create a complete vendor account and business profile from scratch.
                    </p>
                </div>

                <a
                    href="{{ route('vendors.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
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
                            d="M10 19l-7-7m0 0 7-7m-7 7h18"
                        />
                    </svg>

                    Back to Vendors
                </a>

            </div>
        </div>
    </div>


    {{-- ================================================================
        FORM
    ================================================================= --}}
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">
                <div class="flex gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100">
                        <svg
                            class="h-5 w-5 text-red-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.98h15.58a2 2 0 001.74-2.98l-7.82-14a2 2 0 00-3.42 0z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-semibold text-red-800">
                            Please correct the following errors
                        </h3>

                        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        @endif


        <form
            method="POST"
            action="{{ route('vendors.store') }}"
            enctype="multipart/form-data"
            x-data="vendorCreateForm()"
            @submit="prepareLocation()"
            class="space-y-6"
        >

            @csrf


            {{-- ========================================================
                SECTION 1 — VENDOR ACCOUNT
            ========================================================= --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-7">
                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#fbebef]">
                            <svg
                                class="h-6 w-6 text-[#d7385e]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-6a4 4 0 100-8 4 4 0 000 8zm10 6v-2a4 4 0 00-3-3.87m-1-9a4 4 0 010 7.75"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Vendor Account
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Create the user account that will own this vendor profile.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="grid grid-cols-1 gap-6 p-5 sm:grid-cols-2 sm:p-7">

                    {{-- First Name --}}
                    <div>
                        <label
                            for="first_name"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            First Name
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="first_name"
                            id="first_name"
                            value="{{ old('first_name') }}"
                            required
                            maxlength="100"
                            autocomplete="given-name"
                            placeholder="Enter first name"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('first_name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Last Name --}}
                    <div>
                        <label
                            for="last_name"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Last Name
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="last_name"
                            id="last_name"
                            value="{{ old('last_name') }}"
                            required
                            maxlength="100"
                            autocomplete="family-name"
                            placeholder="Enter last name"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('last_name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Country Code --}}
                    <div>
                        <label
                            for="country_code"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Country Code
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="country_code"
                            id="country_code"
                            value="{{ old('country_code', '+92') }}"
                            required
                            maxlength="10"
                            placeholder="+92"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('country_code')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Account Phone --}}
                    <div>
                        <label
                            for="account_phone_number"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Account Phone Number
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="account_phone_number"
                            id="account_phone_number"
                            value="{{ old('account_phone_number') }}"
                            required
                            maxlength="30"
                            autocomplete="tel"
                            placeholder="3001234567"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        <p class="mt-1.5 text-xs text-gray-400">
                            This number is used for the vendor login/account.
                        </p>

                        @error('account_phone_number')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Email --}}
                    <div>
                        <label
                            for="account_email"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Account Email
                        </label>

                        <input
                            type="email"
                            name="account_email"
                            id="account_email"
                            value="{{ old('account_email') }}"
                            maxlength="255"
                            autocomplete="email"
                            placeholder="vendor@example.com"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('account_email')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Password --}}
                    <div>
                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Password
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            autocomplete="new-password"
                            placeholder="Create a secure password"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Password Confirmation --}}
                    <div>
                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Confirm Password
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm password"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >
                    </div>

                </div>
            </div>


            {{-- ========================================================
                SECTION 2 — BUSINESS INFORMATION
            ========================================================= --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-7">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#fbebef]">
                            <svg
                                class="h-6 w-6 text-[#d7385e]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 21h18M5 21V7l8-4 6 4v14M9 21v-6h6v6"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Business Information
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Basic information about the vendor's business.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="space-y-6 p-5 sm:p-7">

                    {{-- Business Name --}}
                    <div>
                        <label
                            for="business_name"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business Name
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="business_name"
                            id="business_name"
                            value="{{ old('business_name') }}"
                            required
                            maxlength="255"
                            placeholder="e.g. Royal Wedding Photography"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('business_name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Slug --}}
                    <div>
                        <label
                            for="slug"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            value="{{ old('slug') }}"
                            maxlength="255"
                            placeholder="royal-wedding-photography"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        <p class="mt-1.5 text-xs text-gray-400">
                            Leave empty to automatically generate the slug from the business name.
                        </p>

                        @error('slug')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Description --}}
                    <div>

                        <label
                            for="description"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business Description
                        </label>

                        {{-- Existing Markdown Editor Integration --}}
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
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-2 text-xs text-gray-400">
                            Use Markdown to format your business description with headings,
                            lists, bold text, links, and more.
                        </p>

                    </div>

                </div>
            </div>


            {{-- ========================================================
                SECTION 3 — CONTACT INFORMATION
            ========================================================= --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-7">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#fbebef]">
                            <svg
                                class="h-6 w-6 text-[#d7385e]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a2 2 0 011.94 1.515l.82 3.28a2 2 0 01-.52 1.906l-1.82 1.82a16.001 16.001 0 006.78 6.78l1.82-1.82a2 2 0 011.906-.52l3.28.82A2 2 0 0121 18.72V22a2 2 0 01-2 2C9.611 24 0 14.389 0 2a2 2 0 012-2h3z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Business Contact
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Contact details customers can use to reach this business.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="grid grid-cols-1 gap-6 p-5 sm:grid-cols-2 sm:p-7">

                    {{-- Business Phone --}}
                    <div>
                        <label
                            for="phone_number"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business Phone Number
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="phone_number"
                            id="phone_number"
                            value="{{ old('phone_number') }}"
                            required
                            maxlength="30"
                            placeholder="0611234567"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('phone_number')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- WhatsApp --}}
                    <div>
                        <label
                            for="whatsapp_number"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            WhatsApp Number
                        </label>

                        <input
                            type="text"
                            name="whatsapp_number"
                            id="whatsapp_number"
                            value="{{ old('whatsapp_number') }}"
                            maxlength="30"
                            placeholder="03001234567"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('whatsapp_number')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Business Email --}}
                    <div class="sm:col-span-2">
                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            maxlength="255"
                            placeholder="business@example.com"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>


            {{-- ========================================================
                SECTION 4 — LOCATION
            ========================================================= --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-7">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#fbebef]">
                            <svg
                                class="h-6 w-6 text-[#d7385e]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 21s8-4.438 8-11a8 8 0 10-16 0c0 6.562 8 11 8 11z"
                                />
                                <circle
                                    cx="12"
                                    cy="10"
                                    r="2.5"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Business Location
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Select the city and enter the business address.
                                Coordinates will be resolved automatically.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="space-y-6 p-5 sm:p-7">

                    {{-- City --}}
                    <div>

                        <label
                            for="city_id"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            City
                        </label>

                        <select
                            name="city_id"
                            id="city_id"
                            x-model="cityId"
                            @change="resolveLocation()"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                            <option value="">
                                Select city
                            </option>

                            @foreach ($cities as $city)
                                <option
                                    value="{{ $city->id }}"
                                    @selected(old('city_id') == $city->id)
                                >
                                    {{ $city->name }}
                                    @if ($city->state)
                                        — {{ $city->state->name }}
                                    @endif
                                </option>
                            @endforeach

                        </select>

                        @error('city_id')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- Address --}}
                    <div>

                        <label
                            for="address"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business Address
                        </label>

                        <textarea
                            name="address"
                            id="address"
                            rows="4"
                            x-model="address"
                            @input.debounce.1000ms="resolveLocation()"
                            maxlength="1000"
                            placeholder="Enter complete business address, street, market, building, area, etc."
                            class="block w-full resize-y rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >{{ old('address') }}</textarea>

                        @error('address')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="mt-2 flex flex-wrap items-center justify-between gap-2">

                            <p class="text-xs text-gray-400">
                                Example: Hussain Agahi Road, Multan
                            </p>

                            <button
                                type="button"
                                @click="resolveLocation(true)"
                                :disabled="geocoding"
                                class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#d7385e] transition hover:text-[#b72d4d] disabled:cursor-not-allowed disabled:opacity-50"
                            >

                                <svg
                                    x-show="!geocoding"
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 19V5m0 0l-6 6m6-6l6 6"
                                    />
                                </svg>

                                <svg
                                    x-show="geocoding"
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
                                    ></circle>

                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                                    ></path>
                                </svg>

                                <span x-text="geocoding ? 'Finding location...' : 'Resolve coordinates'"></span>

                            </button>

                        </div>

                    </div>


                    {{-- Coordinates --}}
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                        {{-- Latitude --}}
                        <div>

                            <label
                                for="latitude"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Latitude
                            </label>

                            <input
                                type="text"
                                name="latitude"
                                id="latitude"
                                x-model="latitude"
                                value="{{ old('latitude') }}"
                                readonly
                                placeholder="Automatically detected"
                                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none"
                            >

                        </div>


                        {{-- Longitude --}}
                        <div>

                            <label
                                for="longitude"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Longitude
                            </label>

                            <input
                                type="text"
                                name="longitude"
                                id="longitude"
                                x-model="longitude"
                                value="{{ old('longitude') }}"
                                readonly
                                placeholder="Automatically detected"
                                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none"
                            >

                        </div>

                    </div>


                    {{-- Location Status --}}
                    <div
                        x-show="locationMessage"
                        x-cloak
                        class="rounded-xl border p-4"
                        :class="locationSuccess
                            ? 'border-green-200 bg-green-50 text-green-700'
                            : 'border-amber-200 bg-amber-50 text-amber-700'"
                    >

                        <div class="flex items-start gap-3">

                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                            <p
                                class="text-sm font-medium"
                                x-text="locationMessage"
                            ></p>

                        </div>

                    </div>

                </div>
            </div>


            {{-- ========================================================
                SECTION 5 — MEDIA
            ========================================================= --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-7">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#fbebef]">
                            <svg
                                class="h-6 w-6 text-[#d7385e]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L22 14m-5-9h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Business Media
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Upload a logo and cover image for the vendor profile.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="grid grid-cols-1 gap-6 p-5 sm:grid-cols-2 sm:p-7">

                    {{-- Logo --}}
                    <div>

                        <label
                            for="logo_image"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business Logo
                        </label>

                        <label
                            for="logo_image"
                            class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-6 py-10 text-center transition hover:border-[#d7385e] hover:bg-[#fbebef]/40"
                        >

                            <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm">
                                <svg
                                    class="h-7 w-7 text-gray-400 transition group-hover:text-[#d7385e]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L22 14m-5-9h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>

                            <span class="text-sm font-semibold text-gray-700">
                                Click to upload logo
                            </span>

                            <span class="mt-1 text-xs text-gray-400">
                                JPG, JPEG, PNG or WEBP · Max 2MB
                            </span>

                            <input
                                type="file"
                                name="logo_image"
                                id="logo_image"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="sr-only"
                            >

                        </label>

                        @error('logo_image')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- Cover --}}
                    <div>

                        <label
                            for="cover_image"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Cover Image
                        </label>

                        <label
                            for="cover_image"
                            class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-6 py-10 text-center transition hover:border-[#d7385e] hover:bg-[#fbebef]/40"
                        >

                            <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm">
                                <svg
                                    class="h-7 w-7 text-gray-400 transition group-hover:text-[#d7385e]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L22 14m-5-9h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2H6a2 2 0 00-2-2V6a2 2 0 002-2z"
                                    />
                                </svg>
                            </div>

                            <span class="text-sm font-semibold text-gray-700">
                                Click to upload cover
                            </span>

                            <span class="mt-1 text-xs text-gray-400">
                                JPG, JPEG, PNG or WEBP · Max 4MB
                            </span>

                            <input
                                type="file"
                                name="cover_image"
                                id="cover_image"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="sr-only"
                            >

                        </label>

                        @error('cover_image')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                </div>
            </div>


            {{-- ========================================================
                SECTION 6 — STATUS & SETTINGS
            ========================================================= --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-7">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#fbebef]">
                            <svg
                                class="h-6 w-6 text-[#d7385e]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-900">
                                Vendor Status & Settings
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Configure the initial state and visibility of the vendor.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="space-y-6 p-5 sm:p-7">

                    {{-- Status --}}
                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Vendor Status
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="status"
                            id="status"
                            required
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#d7385e] focus:ring-2 focus:ring-[#d7385e]/10"
                        >

                            <option
                                value="pending"
                                @selected(old('status', 'active') === 'pending')
                            >
                                Pending
                            </option>

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

                            <option
                                value="suspended"
                                @selected(old('status') === 'suspended')
                            >
                                Suspended
                            </option>

                            <option
                                value="rejected"
                                @selected(old('status') === 'rejected')
                            >
                                Rejected
                            </option>

                        </select>

                        @error('status')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- Toggle Settings --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                        {{-- Verified --}}
                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-gray-200 p-4 transition hover:border-[#d7385e]/40 hover:bg-[#fbebef]/30">

                            <input
                                type="checkbox"
                                name="is_verified"
                                value="1"
                                @checked(old('is_verified'))
                                class="mt-1 h-4 w-4 rounded border-gray-300 text-[#d7385e] focus:ring-[#d7385e]"
                            >

                            <span>
                                <span class="block text-sm font-semibold text-gray-800">
                                    Verified
                                </span>

                                <span class="mt-1 block text-xs leading-5 text-gray-500">
                                    Mark this vendor as verified.
                                </span>
                            </span>

                        </label>


                        {{-- Featured --}}
                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-gray-200 p-4 transition hover:border-[#d7385e]/40 hover:bg-[#fbebef]/30">

                            <input
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                @checked(old('is_featured'))
                                class="mt-1 h-4 w-4 rounded border-gray-300 text-[#d7385e] focus:ring-[#d7385e]"
                            >

                            <span>
                                <span class="block text-sm font-semibold text-gray-800">
                                    Featured
                                </span>

                                <span class="mt-1 block text-xs leading-5 text-gray-500">
                                    Highlight this vendor in featured listings.
                                </span>
                            </span>

                        </label>


                        {{-- Premium --}}
                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-gray-200 p-4 transition hover:border-[#d7385e]/40 hover:bg-[#fbebef]/30">

                            <input
                                type="checkbox"
                                name="is_premium"
                                value="1"
                                @checked(old('is_premium'))
                                class="mt-1 h-4 w-4 rounded border-gray-300 text-[#d7385e] focus:ring-[#d7385e]"
                            >

                            <span>
                                <span class="block text-sm font-semibold text-gray-800">
                                    Premium
                                </span>

                                <span class="mt-1 block text-xs leading-5 text-gray-500">
                                    Mark this vendor as a premium business.
                                </span>
                            </span>

                        </label>

                    </div>

                </div>
            </div>


            {{-- ========================================================
                ACTION BAR
            ========================================================= --}}
            <div class="sticky bottom-0 z-20 -mx-4 border-t border-gray-200 bg-white/95 px-4 py-4 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] backdrop-blur sm:mx-0 sm:rounded-2xl sm:border sm:px-6">

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <p class="text-xs text-gray-400">
                        <span class="text-red-500">*</span>
                        Required fields
                    </p>

                    <div class="flex flex-col gap-3 sm:flex-row">

                        <a
                            href="{{ route('vendors.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#d7385e] px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52] focus:outline-none focus:ring-2 focus:ring-[#d7385e]/30"
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

                            Create Vendor
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>


{{-- ================================================================
    LOCATION / GEOCODING
================================================================= --}}
<script>
    function vendorCreateForm() {
        return {
            cityId: @js(old('city_id', '')),
            address: @js(old('address', '')),

            latitude: @js(old('latitude', '')),
            longitude: @js(old('longitude', '')),

            geocoding: false,
            locationMessage: '',
            locationSuccess: false,

            async resolveLocation(force = false) {

                /*
                |--------------------------------------------------------------------------
                | Do not geocode when there is not enough information
                |--------------------------------------------------------------------------
                */

                if (!this.address && !this.cityId) {
                    this.locationMessage = '';
                    this.latitude = '';
                    this.longitude = '';
                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | Avoid unnecessary requests while typing
                |--------------------------------------------------------------------------
                */

                if (!force && !this.address && !this.cityId) {
                    return;
                }

                this.geocoding = true;
                this.locationMessage = 'Finding business location...';
                this.locationSuccess = false;

                try {

                    const selectedCity =
                        document.getElementById('city_id')
                            ?.options[
                                document.getElementById('city_id').selectedIndex
                            ]?.text || '';

                    let queryParts = [];

                    if (this.address) {
                        queryParts.push(this.address.trim());
                    }

                    if (selectedCity) {
                        queryParts.push(selectedCity.replace(' — ', ', '));
                    }

                    queryParts.push('Pakistan');

                    const query = queryParts.join(', ');

                    const url =
                        'https://nominatim.openstreetmap.org/search?' +
                        new URLSearchParams({
                            q: query,
                            format: 'json',
                            limit: '1',
                            countrycodes: 'pk',
                        });

                    const response = await fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Unable to resolve location.');
                    }

                    const results = await response.json();

                    if (!results.length) {

                        this.latitude = '';
                        this.longitude = '';

                        this.locationMessage =
                            'Location could not be found. Please provide a more specific address.';

                        this.locationSuccess = false;

                        return;
                    }

                    const location = results[0];

                    this.latitude = location.lat;
                    this.longitude = location.lon;

                    this.locationMessage =
                        'Location found successfully. Latitude and longitude have been detected automatically.';

                    this.locationSuccess = true;

                } catch (error) {

                    this.locationMessage =
                        'Unable to resolve coordinates automatically. The server will try to geocode the location when the vendor is saved.';

                    this.locationSuccess = false;

                } finally {

                    this.geocoding = false;

                }
            },

            prepareLocation() {

                /*
                |--------------------------------------------------------------------------
                | Coordinates are sent as hidden/read-only fields for the form.
                | The VendorController can still perform its own server-side
                | geocoding, which is the authoritative fallback.
                |--------------------------------------------------------------------------
                */

                return true;
            }
        };
    }
</script>

@endsection