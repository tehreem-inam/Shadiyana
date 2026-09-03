@extends('layouts.app')

@section('title', 'Edit Vendor')

@section('content')

<div class="min-h-screen bg-gray-50">

    {{-- ================================================================
        PAGE HEADER
    ================================================================= --}}

    <div class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            {{-- Breadcrumbs --}}
            <nav class="mb-4 flex items-center gap-2 text-sm text-gray-500">

                <a
                    href="{{ route('vendors.index') }}"
                    class="transition hover:text-[#D7385E]"
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
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                <a
                    href="{{ route('vendors.show', $vendor) }}"
                    class="max-w-[180px] truncate transition hover:text-[#D7385E]"
                >
                    {{ $vendor->business_name }}
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
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                <span class="font-medium text-gray-700">
                    Edit
                </span>

            </nav>


            {{-- Heading --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FBEBEF]">
                            <svg
                                class="h-6 w-6 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                                Edit Vendor
                            </h1>

                            <p class="mt-1 text-sm text-gray-500">
                                Update vendor account and business information.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="flex items-center gap-2">

                    <a
                        href="{{ route('vendors.show', $vendor) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
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
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>

                        Cancel
                    </a>

                </div>

            </div>

        </div>
    </div>



    {{-- ================================================================
        MAIN CONTENT
    ================================================================= --}}

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Global Validation Errors --}}
        @if ($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="mt-0.5 shrink-0">
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
                                d="M12 8v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-semibold text-red-800">
                            Please correct the following errors:
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



        {{-- ============================================================
            FORM
        ============================================================= --}}

        <form
            action="{{ route('vendors.update', $vendor) }}"
            method="POST"
            enctype="multipart/form-data"
            x-data="vendorEditForm()"
            id="vendor-edit-form"
            class="space-y-6"
        >

            @csrf
            @method('PUT')



            {{-- ========================================================
                ACCOUNT INFORMATION
            ========================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF]">
                            <svg
                                class="h-5 w-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-base font-bold text-gray-900">
                                Vendor Account
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Select the user account that owns this vendor profile.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid gap-6 px-5 py-6 sm:grid-cols-2 sm:px-6">

                    {{-- Vendor Owner --}}
                    <div class="sm:col-span-2">

                        <label
                            for="user_id"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Vendor Owner
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="user_id"
                            name="user_id"
                            required
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                            <option value="">
                                Select vendor owner
                            </option>

                            @foreach ($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    @selected(old('user_id', $vendor->user_id) == $user->id)
                                >
                                    {{ $user->first_name }}
                                    {{ $user->last_name }}

                                    @if ($user->phone_number)
                                        — {{ $user->phone_number }}
                                    @endif

                                    @if ($user->email)
                                        — {{ $user->email }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        @error('user_id')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



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
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name', $vendor->user?->first_name) }}"
                            required
                            maxlength="100"
                            placeholder="Enter first name"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('first_name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
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
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name', $vendor->user?->last_name) }}"
                            required
                            maxlength="100"
                            placeholder="Enter last name"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('last_name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Account Phone --}}
                    <div>

                        <label
                            for="account_phone_number"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Account Phone
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="account_phone_number"
                            name="account_phone_number"
                            value="{{ old('account_phone_number', $vendor->user?->phone_number) }}"
                            required
                            maxlength="30"
                            placeholder="e.g. 03001234567"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('account_phone_number')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
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
                            id="country_code"
                            name="country_code"
                            value="{{ old('country_code', $vendor->user?->country_code ?? '+92') }}"
                            required
                            maxlength="10"
                            placeholder="+92"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('country_code')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Account Email --}}
                    <div class="sm:col-span-2">

                        <label
                            for="account_email"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Account Email
                        </label>

                        <input
                            type="email"
                            id="account_email"
                            name="account_email"
                            value="{{ old('account_email', $vendor->user?->email) }}"
                            placeholder="vendor@example.com"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('account_email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Password --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            New Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter new password"
                            autocomplete="new-password"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        <p class="mt-2 text-xs text-gray-500">
                            Leave blank if you do not want to change the password.
                        </p>

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Confirm Password --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm new password"
                            autocomplete="new-password"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                    </div>

                </div>

            </section>



            {{-- ========================================================
                BUSINESS INFORMATION
            ========================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF]">
                            <svg
                                class="h-5 w-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 21h18M5 21V7l8-4 8 4v14M9 21v-8h6v8"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-base font-bold text-gray-900">
                                Business Information
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Manage the vendor's public business profile.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid gap-6 px-5 py-6 sm:grid-cols-2 sm:px-6">

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
                            id="business_name"
                            name="business_name"
                            value="{{ old('business_name', $vendor->business_name) }}"
                            required
                            maxlength="255"
                            placeholder="Enter business name"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('business_name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Slug --}}
                    <div>

                        <label
                            for="slug"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            URL Slug
                        </label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug', $vendor->slug) }}"
                            maxlength="255"
                            placeholder="business-name"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        <p class="mt-2 text-xs text-gray-500">
                            Leave blank to automatically generate the slug from the business name.
                        </p>

                        @error('slug')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Description --}}
                    <div class="sm:col-span-2">

                        <label
                            for="description"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="7"
                            maxlength="50000"
                            placeholder="Write a description about this vendor..."
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm leading-6 shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >{{ old('description', $vendor->description) }}</textarea>

                        <p class="mt-2 text-xs text-gray-500">
                            Markdown is supported.
                        </p>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>



            {{-- ========================================================
                CONTACT INFORMATION
            ========================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF]">
                            <svg
                                class="h-5 w-5 text-[#D7385E]"
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
                            <h2 class="text-base font-bold text-gray-900">
                                Business Contact
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Update the contact details customers use to reach this business.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid gap-6 px-5 py-6 sm:grid-cols-2 sm:px-6">

                    {{-- Business Phone --}}
                    <div>

                        <label
                            for="phone_number"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business Phone
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="phone_number"
                            name="phone_number"
                            value="{{ old('phone_number', $vendor->phone_number) }}"
                            required
                            maxlength="30"
                            placeholder="03123456789"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('phone_number')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
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
                            id="whatsapp_number"
                            name="whatsapp_number"
                            value="{{ old('whatsapp_number', $vendor->whatsapp_number) }}"
                            maxlength="30"
                            placeholder="03123456789"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('whatsapp_number')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
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
                            id="email"
                            name="email"
                            value="{{ old('email', $vendor->email) }}"
                            placeholder="business@example.com"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>



            {{-- ========================================================
                LOCATION
            ========================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Section Header --}}
                <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF]">

                            <svg
                                class="h-5 w-5 text-[#D7385E]"
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

                            <h2 class="text-base font-bold text-gray-900">
                                Business Location
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Select the city, update the business address, and pinpoint
                                the exact business location on the map.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Location Content --}}
                <div class="p-5 sm:p-6">

                    <div class="grid grid-cols-1 gap-7 lg:grid-cols-12">

                        {{-- ====================================================
                            LEFT — LOCATION DETAILS
                        ===================================================== --}}
                        <div class="space-y-6 lg:col-span-5">

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
                                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                                >

                                    <option value="">
                                        Select city
                                    </option>

                                    @foreach ($cities as $city)

                                        <option
                                            value="{{ $city->id }}"
                                            @selected(old('city_id', $vendor->city_id) == $city->id)
                                        >
                                            {{ $city->name }}

                                            @if ($city->state)
                                                — {{ $city->state->name }}
                                            @endif
                                        </option>

                                    @endforeach

                                </select>

                                <p
                                    id="city-location-help"
                                    class="mt-2 text-xs leading-5 text-gray-400"
                                >
                                    Select a city before choosing a business location.
                                </p>

                                @error('city_id')
                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
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
                                    rows="5"
                                    maxlength="1000"
                                    placeholder="Enter complete business address, street, market, building, area, etc."
                                    class="block w-full resize-y rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                                >{{ old('address', $vendor->address) }}</textarea>

                                <div class="mt-2 flex items-start justify-between gap-3">

                                    <p class="text-xs leading-5 text-gray-400">
                                        Example: Gulberg III, Lahore
                                    </p>

                                    <button
                                        type="button"
                                        id="resolve-vendor-location"
                                        class="shrink-0 text-xs font-semibold text-[#D7385E] transition hover:text-[#b72d4d] disabled:cursor-not-allowed disabled:opacity-50"
                                    >
                                        Find on map
                                    </button>

                                </div>

                                @error('address')
                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Search Location --}}
                            <div>

                                <label
                                    for="location-search"
                                    class="mb-2 block text-sm font-semibold text-gray-700"
                                >
                                    Search Location
                                </label>

                                <div class="flex gap-2">

                                    <div class="relative min-w-0 flex-1">

                                        <svg
                                            class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                                            />
                                        </svg>

                                        <input
                                            type="text"
                                            id="location-search"
                                            placeholder="Search business location..."
                                            class="block w-full rounded-xl border border-gray-300 bg-white py-3 pl-11 pr-4 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/10"
                                        >

                                    </div>

                                    <button
                                        type="button"
                                        id="location-search-button"
                                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52] disabled:cursor-not-allowed disabled:opacity-50"
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
                                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                                            />
                                        </svg>

                                        <span>
                                            Search
                                        </span>

                                    </button>

                                </div>


                                <p
                                    id="location-search-message"
                                    class="mt-2 hidden text-xs leading-5"
                                ></p>

                            </div>


                            {{-- Coordinates --}}
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                {{-- Latitude --}}
                                <div>

                                    <label
                                        for="latitude"
                                        class="mb-2 block text-sm font-semibold text-gray-700"
                                    >
                                        Latitude
                                    </label>

                                    <div class="relative">

                                        <input
                                            type="text"
                                            name="latitude"
                                            id="latitude"
                                            value="{{ old('latitude', $vendor->latitude) }}"
                                            readonly
                                            placeholder="Select from map"
                                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 text-sm font-medium text-gray-700 outline-none"
                                        >

                                        <span
                                            class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 rounded-lg bg-white px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-gray-400 shadow-sm"
                                        >
                                            LAT
                                        </span>

                                    </div>

                                    @error('latitude')
                                        <p class="mt-1.5 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Longitude --}}
                                <div>

                                    <label
                                        for="longitude"
                                        class="mb-2 block text-sm font-semibold text-gray-700"
                                    >
                                        Longitude
                                    </label>

                                    <div class="relative">

                                        <input
                                            type="text"
                                            name="longitude"
                                            id="longitude"
                                            value="{{ old('longitude', $vendor->longitude) }}"
                                            readonly
                                            placeholder="Select from map"
                                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 text-sm font-medium text-gray-700 outline-none"
                                        >

                                        <span
                                            class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 rounded-lg bg-white px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-gray-400 shadow-sm"
                                        >
                                            LNG
                                        </span>

                                    </div>

                                    @error('longitude')
                                        <p class="mt-1.5 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>


                            {{-- Location validation status --}}
                            <div
                                id="city-location-status"
                                class="hidden rounded-xl border p-4"
                            >

                                <div class="flex items-start gap-3">

                                    <div
                                        id="city-location-status-icon"
                                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg"
                                    >
                                    </div>

                                    <div class="min-w-0">

                                        <p
                                            id="city-location-status-title"
                                            class="text-sm font-semibold"
                                        ></p>

                                        <p
                                            id="city-location-status-message"
                                            class="mt-1 text-xs leading-5"
                                        ></p>

                                    </div>

                                </div>

                            </div>


                            {{-- Instructions --}}
                            <div class="rounded-xl border border-[#D7385E]/10 bg-[#FBEBEF]/60 p-4">

                                <div class="flex items-start gap-3">

                                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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
                                                d="M12 11V7m0 8h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-sm font-semibold text-gray-800">
                                            Pin the exact business location
                                        </p>

                                        <p class="mt-1 text-xs leading-5 text-gray-500">
                                            Select a city first. Search for the location,
                                            click directly on the map, or drag the marker.
                                            Locations outside the selected city will not be accepted.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ====================================================
                            RIGHT — LEAFLET MAP
                        ===================================================== --}}
                        <div class="lg:col-span-7">

                            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-gray-100 shadow-sm">

                                {{-- Map Header --}}
                                <div class="flex flex-col gap-2 border-b border-gray-200 bg-white px-4 py-3 sm:flex-row sm:items-center sm:justify-between">

                                    <div>

                                        <p class="text-sm font-bold text-gray-900">
                                            Business Location Map
                                        </p>

                                        <p
                                            id="map-subtitle"
                                            class="text-xs text-gray-500"
                                        >
                                            Select a city to enable location selection
                                        </p>

                                    </div>

                                    <div
                                        id="map-coordinate-status"
                                        class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-400"
                                    >

                                        <span
                                            id="map-status-dot"
                                            class="h-2 w-2 rounded-full bg-gray-300"
                                        ></span>

                                        <span id="map-status-text">
                                            Location not selected
                                        </span>

                                    </div>

                                </div>


                                {{-- Map --}}
                                <div
                                    id="vendor-map"
                                    class="h-[420px] w-full sm:h-[500px]"
                                ></div>


                                {{-- Map Footer --}}
                                <div class="border-t border-gray-200 bg-white px-4 py-3">

                                    <div class="flex flex-wrap items-center justify-between gap-2">

                                        <div class="flex items-center gap-2 text-xs text-gray-500">

                                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]">

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
                                                        d="M12 21s8-4.438 8-11a8 8 0 10-16 0c0 6.562 8 11 8 11z"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="10"
                                                        r="2.5"
                                                    />

                                                </svg>

                                            </span>

                                            <span>
                                                Only locations within the selected city are accepted.
                                            </span>

                                        </div>

                                        <button
                                            type="button"
                                            id="reset-vendor-map"
                                            class="text-xs font-semibold text-gray-500 transition hover:text-[#D7385E]"
                                        >
                                            Reset map
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ========================================================
                MEDIA
            ========================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF]">

                            <svg
                                class="h-5 w-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>

                        </div>

                        <div>
                            <h2 class="text-base font-bold text-gray-900">
                                Vendor Media
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Replace the vendor logo or cover image.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid gap-8 px-5 py-6 sm:grid-cols-2 sm:px-6">


                    {{-- ==================================================
                        LOGO
                    =================================================== --}}

                    <div>

                        <label class="mb-3 block text-sm font-semibold text-gray-700">
                            Vendor Logo
                        </label>


                        @if ($vendor->logo_image)

                            <div class="mb-4 overflow-hidden rounded-xl border border-gray-200 bg-gray-50">

                                <div class="relative aspect-square max-h-64">

                                    <img
                                        src="{{ asset('storage/' . $vendor->logo_image) }}"
                                        alt="{{ $vendor->business_name }} logo"
                                        class="h-full w-full object-contain p-5"
                                    >

                                </div>

                                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3">

                                    <span class="text-xs font-medium text-gray-500">
                                        Current logo
                                    </span>

                                    <button
                                        type="button"
                                        @click="confirmDelete('logo')"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 transition hover:text-red-700"
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"
                                            />
                                        </svg>

                                        Remove
                                    </button>

                                </div>

                            </div>

                        @endif


                        {{-- New Logo --}}
                        <label
                            for="logo_image"
                            class="group relative flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 px-5 py-8 text-center transition hover:border-[#D7385E] hover:bg-[#FBEBEF]"
                        >

                            <template x-if="logoPreview">

                                <div class="mb-4">
                                    <img
                                        :src="logoPreview"
                                        class="mx-auto h-32 w-32 rounded-xl object-contain bg-white p-2 shadow-sm"
                                    >
                                </div>

                            </template>

                            <template x-if="!logoPreview">

                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-[#FBEBEF]">
                                    <svg
                                        class="h-6 w-6 text-[#D7385E]"
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
                                </div>

                            </template>

                            <span class="text-sm font-semibold text-gray-700">
                                <span x-text="logoPreview ? 'Change selected logo' : 'Upload new logo'"></span>
                            </span>

                            <span class="mt-1 text-xs text-gray-500">
                                JPG, JPEG, PNG or WEBP • Max 2MB
                            </span>

                            <input
                                id="logo_image"
                                name="logo_image"
                                type="file"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="hidden"
                                @change="previewLogo($event)"
                            >

                        </label>

                        @error('logo_image')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- ==================================================
                        COVER
                    =================================================== --}}

                    <div>

                        <label class="mb-3 block text-sm font-semibold text-gray-700">
                            Cover Image
                        </label>


                        @if ($vendor->cover_image)

                            <div class="mb-4 overflow-hidden rounded-xl border border-gray-200 bg-gray-50">

                                <div class="aspect-video">

                                    <img
                                        src="{{ asset('storage/' . $vendor->cover_image) }}"
                                        alt="{{ $vendor->business_name }} cover"
                                        class="h-full w-full object-cover"
                                    >

                                </div>

                                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3">

                                    <span class="text-xs font-medium text-gray-500">
                                        Current cover
                                    </span>

                                    <button
                                        type="button"
                                        @click="confirmDelete('cover')"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 transition hover:text-red-700"
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"
                                            />
                                        </svg>

                                        Remove
                                    </button>

                                </div>

                            </div>

                        @endif


                        {{-- New Cover --}}
                        <label
                            for="cover_image"
                            class="group relative flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 px-5 py-8 text-center transition hover:border-[#D7385E] hover:bg-[#FBEBEF]"
                        >

                            <template x-if="coverPreview">

                                <div class="mb-4 w-full">
                                    <img
                                        :src="coverPreview"
                                        class="mx-auto aspect-video w-full rounded-xl object-cover shadow-sm"
                                    >
                                </div>

                            </template>

                            <template x-if="!coverPreview">

                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-[#FBEBEF]">
                                    <svg
                                        class="h-6 w-6 text-[#D7385E]"
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
                                </div>

                            </template>

                            <span class="text-sm font-semibold text-gray-700">
                                <span x-text="coverPreview ? 'Change selected cover' : 'Upload new cover image'"></span>
                            </span>

                            <span class="mt-1 text-xs text-gray-500">
                                JPG, JPEG, PNG or WEBP • Max 4MB
                            </span>

                            <input
                                id="cover_image"
                                name="cover_image"
                                type="file"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="hidden"
                                @change="previewCover($event)"
                            >

                        </label>

                        @error('cover_image')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>



            {{-- ========================================================
                STATUS & VISIBILITY
            ========================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF]">

                            <svg
                                class="h-5 w-5 text-[#D7385E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 5.591 3.824 10.291 9 11.623C17.176 22.291 21 17.591 21 12c0-1.042-.133-2.052-.382-3.016z"
                                />
                            </svg>

                        </div>

                        <div>
                            <h2 class="text-base font-bold text-gray-900">
                                Status & Visibility
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Control the vendor's account status and platform visibility.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid gap-6 px-5 py-6 sm:grid-cols-2 sm:px-6">

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
                            id="status"
                            name="status"
                            required
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-900 shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >

                            @foreach ([
                                'pending' => 'Pending',
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'suspended' => 'Suspended',
                                'rejected' => 'Rejected',
                            ] as $value => $label)

                                <option
                                    value="{{ $value }}"
                                    @selected(old('status', $vendor->status) === $value)
                                >
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>

                        @error('status')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Status Info --}}
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500">
                            Current Status
                        </p>

                        <div class="mt-2 flex items-center gap-2">

                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'active' => 'bg-green-100 text-green-800',
                                    'inactive' => 'bg-gray-100 text-gray-700',
                                    'suspended' => 'bg-orange-100 text-orange-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                ];

                                $currentStatusClass =
                                    $statusClasses[$vendor->status]
                                    ?? 'bg-gray-100 text-gray-700';
                            @endphp

                            <span
                                class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold uppercase {{ $currentStatusClass }}"
                            >
                                {{ $vendor->status }}
                            </span>

                        </div>

                    </div>



                    {{-- Verification --}}
                    <label
                        class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 bg-white p-4 transition hover:border-[#D7385E] hover:bg-[#FBEBEF]"
                    >

                        <div class="pr-4">

                            <p class="text-sm font-bold text-gray-800">
                                Verified Vendor
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                Mark this vendor as verified.
                            </p>

                        </div>

                        <div class="relative shrink-0">

                            <input
                                type="checkbox"
                                name="is_verified"
                                value="1"
                                class="peer sr-only"
                                @checked(old('is_verified', $vendor->is_verified))
                            >

                            <div class="h-6 w-11 rounded-full bg-gray-300 transition peer-checked:bg-[#D7385E] peer-focus:ring-4 peer-focus:ring-[#FBEBEF]"></div>

                            <div class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-sm transition peer-checked:translate-x-5"></div>

                        </div>

                    </label>



                    {{-- Featured --}}
                    <label
                        class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 bg-white p-4 transition hover:border-[#D7385E] hover:bg-[#FBEBEF]"
                    >

                        <div class="pr-4">

                            <p class="text-sm font-bold text-gray-800">
                                Featured Vendor
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                Show this vendor in featured sections.
                            </p>

                        </div>

                        <div class="relative shrink-0">

                            <input
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                class="peer sr-only"
                                @checked(old('is_featured', $vendor->is_featured))
                            >

                            <div class="h-6 w-11 rounded-full bg-gray-300 transition peer-checked:bg-[#D7385E] peer-focus:ring-4 peer-focus:ring-[#FBEBEF]"></div>

                            <div class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-sm transition peer-checked:translate-x-5"></div>

                        </div>

                    </label>



                    {{-- Premium --}}
                    <label
                        class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 bg-white p-4 transition hover:border-[#D7385E] hover:bg-[#FBEBEF] sm:col-span-2"
                    >

                        <div class="pr-4">

                            <p class="text-sm font-bold text-gray-800">
                                Premium Vendor
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                Mark this vendor as a premium business.
                            </p>

                        </div>

                        <div class="relative shrink-0">

                            <input
                                type="checkbox"
                                name="is_premium"
                                value="1"
                                class="peer sr-only"
                                @checked(old('is_premium', $vendor->is_premium))
                            >

                            <div class="h-6 w-11 rounded-full bg-gray-300 transition peer-checked:bg-[#D7385E] peer-focus:ring-4 peer-focus:ring-[#FBEBEF]"></div>

                            <div class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-sm transition peer-checked:translate-x-5"></div>

                        </div>

                    </label>

                </div>

            </section>



            {{-- ========================================================
                ACTION BAR
            ========================================================= --}}

            <div class="sticky bottom-0 z-20 -mx-4 border-t border-gray-200 bg-white/95 px-4 py-4 backdrop-blur sm:static sm:mx-0 sm:rounded-2xl sm:border sm:px-6">

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div class="text-xs text-gray-500">
                        Last updated
                        {{ $vendor->updated_at?->format('M d, Y h:i A') ?? '—' }}
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">

                        <a
                            href="{{ route('vendors.show', $vendor) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#c42f52] focus:outline-none focus:ring-4 focus:ring-[#FBEBEF]"
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

                            Update Vendor

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>



{{-- ================================================================
    DELETE IMAGE CONFIRMATION MODAL
================================================================= --}}

<div
    x-data="{
        open: false,
        type: null,
        title: '',
        message: '',
        action: ''
    }"
    x-show="open"
    x-cloak
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-50 overflow-y-auto"
>

    {{-- Backdrop --}}
    <div
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"
        @click="open = false"
    ></div>


    <div class="flex min-h-full items-center justify-center p-4">

        <div
            @click.stop
            class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl"
        >

            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100">

                <svg
                    class="h-6 w-6 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"
                    />
                </svg>

            </div>

            <h3
                class="mt-4 text-lg font-bold text-gray-900"
                x-text="title"
            ></h3>

            <p
                class="mt-2 text-sm leading-6 text-gray-500"
                x-text="message"
            ></p>


            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    @click="open = false"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Cancel
                </button>

                <form
                    method="POST"
                    :action="action"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center rounded-xl bg-red-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-red-700 sm:w-auto"
                    >
                        Remove Image
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>



{{-- ================================================================
    ALPINE COMPONENT (media previews / delete modal)
================================================================= --}}

<script>
    function vendorEditForm() {
        return {
            logoPreview: null,
            coverPreview: null,

            previewLogo(event) {
                const file = event.target.files[0];

                if (!file) {
                    this.logoPreview = null;
                    return;
                }

                this.logoPreview = URL.createObjectURL(file);
            },

            previewCover(event) {
                const file = event.target.files[0];

                if (!file) {
                    this.coverPreview = null;
                    return;
                }

                this.coverPreview = URL.createObjectURL(file);
            },

            confirmDelete(type) {

                const modal = document.querySelector(
                    '[x-data*="type: null"]'
                );

                if (!modal || !modal.__x) {
                    return;
                }

                const component = Alpine.$data(modal);

                component.type = type;
                component.open = true;

                if (type === 'logo') {

                    component.title = 'Remove vendor logo?';

                    component.message =
                        'The current vendor logo will be permanently removed from storage.';

                    component.action =
                        @js(route('vendors.logo.destroy', $vendor));

                } else {

                    component.title = 'Remove cover image?';

                    component.message =
                        'The current vendor cover image will be permanently removed from storage.';

                    component.action =
                        @js(route('vendors.cover.destroy', $vendor));
                }
            }
        }
    }
</script>


{{-- ================================================================
    LOCATION / LEAFLET
================================================================= --}}

@vite('resources/js/app.js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const form = document.getElementById('vendor-edit-form');

    const citySelect =
        document.getElementById('city_id');

    const addressInput =
        document.getElementById('address');

    const searchInput =
        document.getElementById('location-search');

    const searchButton =
        document.getElementById('location-search-button');

    const resolveButton =
        document.getElementById('resolve-vendor-location');

    const latitudeInput =
        document.getElementById('latitude');

    const longitudeInput =
        document.getElementById('longitude');

    const resetButton =
        document.getElementById('reset-vendor-map');

    const searchMessage =
        document.getElementById('location-search-message');

    const cityLocationHelp =
        document.getElementById('city-location-help');

    const cityLocationStatus =
        document.getElementById('city-location-status');

    const cityLocationStatusIcon =
        document.getElementById('city-location-status-icon');

    const cityLocationStatusTitle =
        document.getElementById('city-location-status-title');

    const cityLocationStatusMessage =
        document.getElementById('city-location-status-message');

    const mapSubtitle =
        document.getElementById('map-subtitle');

    const mapStatusText =
        document.getElementById('map-status-text');

    const mapStatusDot =
        document.getElementById('map-status-dot');


    /*
    |--------------------------------------------------------------------------
    | Make sure Leaflet exists
    |--------------------------------------------------------------------------
    */

    if (!window.L) {

        console.error(
            'Leaflet is not available. Make sure it is imported in resources/js/app.js.'
        );

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Default Pakistan Location
    |--------------------------------------------------------------------------
    */

    const pakistanCenter = [30.1575, 71.5249];


    /*
    |--------------------------------------------------------------------------
    | Map
    |--------------------------------------------------------------------------
    */

    const mapElement =
        document.getElementById('vendor-map');

    if (!mapElement) {
        return;
    }


    const map = L.map(mapElement, {
        center: pakistanCenter,
        zoom: 6,
        zoomControl: true,
        attributionControl: true,
    });


    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,

            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors',
        }
    ).addTo(map);


    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    let marker = null;

    let selectedCityName = '';

    let cityBounds = null;

    let cityCenter = null;

    let cityZoom = 12;

    let cityLoading = false;

    let lastValidPosition = null;


    /*
    |--------------------------------------------------------------------------
    | Utility — Get Selected City Name
    |--------------------------------------------------------------------------
    */

    function getSelectedCityName() {

        if (!citySelect || !citySelect.value) {
            return '';
        }

        const option =
            citySelect.options[
                citySelect.selectedIndex
            ];

        if (!option) {
            return '';
        }

        /*
        | Remove state part:
        |
        | Lahore — Punjab
        |
        | becomes:
        |
        | Lahore
        */

        return option.text
            .split(' — ')[0]
            .trim();
    }


    /*
    |--------------------------------------------------------------------------
    | Utility — Messages
    |--------------------------------------------------------------------------
    */

    function showSearchMessage(message, type = 'info') {

        if (!searchMessage) {
            return;
        }

        searchMessage.textContent = message;

        searchMessage.classList.remove(
            'hidden',
            'text-gray-500',
            'text-red-600',
            'text-green-600',
            'text-amber-600'
        );

        if (type === 'error') {

            searchMessage.classList.add(
                'text-red-600'
            );

        } else if (type === 'success') {

            searchMessage.classList.add(
                'text-green-600'
            );

        } else if (type === 'warning') {

            searchMessage.classList.add(
                'text-amber-600'
            );

        } else {

            searchMessage.classList.add(
                'text-gray-500'
            );

        }

    }


    function clearSearchMessage() {

        if (!searchMessage) {
            return;
        }

        searchMessage.textContent = '';

        searchMessage.classList.add('hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | City Status
    |--------------------------------------------------------------------------
    */

    function showCityStatus(
        type,
        title,
        message
    ) {

        if (!cityLocationStatus) {
            return;
        }

        cityLocationStatus.classList.remove(
            'hidden',
            'border-red-200',
            'bg-red-50',
            'border-green-200',
            'bg-green-50',
            'border-amber-200',
            'bg-amber-50'
        );

        cityLocationStatusIcon.className =
            'flex h-8 w-8 shrink-0 items-center justify-center rounded-lg';

        cityLocationStatusTitle.className =
            'text-sm font-semibold';

        cityLocationStatusMessage.className =
            'mt-1 text-xs leading-5';


        if (type === 'success') {

            cityLocationStatus.classList.add(
                'border-green-200',
                'bg-green-50'
            );

            cityLocationStatusIcon.classList.add(
                'bg-green-100',
                'text-green-600'
            );

            cityLocationStatusTitle.classList.add(
                'text-green-800'
            );

            cityLocationStatusMessage.classList.add(
                'text-green-700'
            );

            cityLocationStatusIcon.innerHTML = `
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
            `;

        } else if (type === 'error') {

            cityLocationStatus.classList.add(
                'border-red-200',
                'bg-red-50'
            );

            cityLocationStatusIcon.classList.add(
                'bg-red-100',
                'text-red-600'
            );

            cityLocationStatusTitle.classList.add(
                'text-red-800'
            );

            cityLocationStatusMessage.classList.add(
                'text-red-700'
            );

            cityLocationStatusIcon.innerHTML = `
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
            `;

        } else {

            cityLocationStatus.classList.add(
                'border-amber-200',
                'bg-amber-50'
            );

            cityLocationStatusIcon.classList.add(
                'bg-amber-100',
                'text-amber-600'
            );

            cityLocationStatusTitle.classList.add(
                'text-amber-800'
            );

            cityLocationStatusMessage.classList.add(
                'text-amber-700'
            );

            cityLocationStatusIcon.innerHTML = `
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
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 2.98h15.58a2 2 0 001.74-2.98l-7.82-14a2 2 0 00-3.42 0z"
                    />
                </svg>
            `;

        }


        cityLocationStatusTitle.textContent =
            title;

        cityLocationStatusMessage.textContent =
            message;

    }


    function hideCityStatus() {

        cityLocationStatus?.classList.add(
            'hidden'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Map Status
    |--------------------------------------------------------------------------
    */

    function setMapStatus(
        text,
        type = 'neutral'
    ) {

        if (!mapStatusText || !mapStatusDot) {
            return;
        }

        mapStatusText.textContent = text;

        mapStatusDot.classList.remove(
            'bg-gray-300',
            'bg-green-500',
            'bg-red-500',
            'bg-amber-500'
        );


        if (type === 'success') {

            mapStatusDot.classList.add(
                'bg-green-500'
            );

        } else if (type === 'error') {

            mapStatusDot.classList.add(
                'bg-red-500'
            );

        } else if (type === 'warning') {

            mapStatusDot.classList.add(
                'bg-amber-500'
            );

        } else {

            mapStatusDot.classList.add(
                'bg-gray-300'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Disable / Enable Location Controls
    |--------------------------------------------------------------------------
    */

    function updateControls() {

        const hasCity =
            Boolean(citySelect?.value);

        const disabled =
            !hasCity || cityLoading;


        if (searchInput) {
            searchInput.disabled = disabled;
        }

        if (searchButton) {
            searchButton.disabled = disabled;
        }

        if (resolveButton) {
            resolveButton.disabled = disabled;
        }

        if (citySelect) {
            citySelect.disabled = cityLoading;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Coordinate Validation
    |--------------------------------------------------------------------------
    */

    function validCoordinates(
        latitude,
        longitude
    ) {

        return (
            Number.isFinite(latitude) &&
            Number.isFinite(longitude) &&
            latitude >= -90 &&
            latitude <= 90 &&
            longitude >= -180 &&
            longitude <= 180
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Check Coordinate Against City Bounds
    |--------------------------------------------------------------------------
    */

    function isInsideSelectedCity(
        latitude,
        longitude
    ) {

        if (!validCoordinates(latitude, longitude)) {
            return false;
        }

        if (!cityBounds) {
            return false;
        }

        return (
            latitude >= cityBounds.south &&
            latitude <= cityBounds.north &&
            longitude >= cityBounds.west &&
            longitude <= cityBounds.east
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Clear Coordinates
    |--------------------------------------------------------------------------
    */

    function clearCoordinates() {

        if (latitudeInput) {
            latitudeInput.value = '';
        }

        if (longitudeInput) {
            longitudeInput.value = '';
        }

        lastValidPosition = null;

        setMapStatus(
            'Location not selected',
            'neutral'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Remove Marker
    |--------------------------------------------------------------------------
    */

    function removeMarker() {

        if (marker) {

            map.removeLayer(marker);

            marker = null;

        }

        clearCoordinates();

    }


    /*
    |--------------------------------------------------------------------------
    | Set Coordinates
    |--------------------------------------------------------------------------
    */

    function setCoordinates(
        latitude,
        longitude,
        moveMap = true
    ) {

        latitude = Number(latitude);
        longitude = Number(longitude);


        if (!validCoordinates(
            latitude,
            longitude
        )) {

            return false;

        }


        if (!selectedCityName || !cityBounds) {

            showCityStatus(
                'warning',
                'Select a city first',
                'Please select the vendor city before choosing a location.'
            );

            showSearchMessage(
                'Please select a city before choosing a location.',
                'warning'
            );

            return false;

        }


        if (!isInsideSelectedCity(
            latitude,
            longitude
        )) {

            showCityStatus(
                'error',
                'Location outside selected city',
                `The selected location is outside ${selectedCityName}. Please choose a location within ${selectedCityName}.`
            );

            showSearchMessage(
                `This location is outside ${selectedCityName}. Please select a location within ${selectedCityName}.`,
                'error'
            );

            setMapStatus(
                'Outside selected city',
                'error'
            );

            return false;

        }


        if (latitudeInput) {
            latitudeInput.value =
                latitude.toFixed(8);
        }

        if (longitudeInput) {
            longitudeInput.value =
                longitude.toFixed(8);
        }


        if (!marker) {

            marker = L.marker(
                [latitude, longitude],
                {
                    draggable: true
                }
            ).addTo(map);


            marker.on(
                'dragstart',
                function () {

                    if (marker) {

                        const position =
                            marker.getLatLng();

                        lastValidPosition = {
                            lat: position.lat,
                            lng: position.lng
                        };

                    }

                }
            );


            marker.on(
                'dragend',
                function (event) {

                    const position =
                        event.target.getLatLng();


                    if (
                        !isInsideSelectedCity(
                            position.lat,
                            position.lng
                        )
                    ) {

                        if (lastValidPosition) {

                            marker.setLatLng([
                                lastValidPosition.lat,
                                lastValidPosition.lng
                            ]);

                        }

                        showCityStatus(
                            'error',
                            'Location outside selected city',
                            `The marker cannot be moved outside ${selectedCityName}.`
                        );

                        showSearchMessage(
                            `The marker must remain within ${selectedCityName}.`,
                            'error'
                        );

                        return;

                    }


                    setCoordinates(
                        position.lat,
                        position.lng,
                        false
                    );

                    showCityStatus(
                        'success',
                        'Location verified',
                        `The selected location is within ${selectedCityName}.`
                    );

                    showSearchMessage(
                        'Marker location updated successfully.',
                        'success'
                    );

                }
            );

        } else {

            marker.setLatLng([
                latitude,
                longitude
            ]);

        }


        lastValidPosition = {
            lat: latitude,
            lng: longitude
        };


        if (moveMap) {

            map.setView(
                [latitude, longitude],
                Math.max(
                    map.getZoom(),
                    14
                ),
                {
                    animate: true
                }
            );

        }


        setMapStatus(
            `${selectedCityName} location selected`,
            'success'
        );

        showCityStatus(
            'success',
            'Location verified',
            `The selected location is within ${selectedCityName}.`
        );

        return true;

    }


    /*
    |--------------------------------------------------------------------------
    | Load City Boundary
    |--------------------------------------------------------------------------
    */

    async function loadCityBoundary() {

        selectedCityName =
            getSelectedCityName();


        cityBounds = null;
        cityCenter = null;


        if (!selectedCityName) {

            hideCityStatus();

            clearCoordinates();

            removeMarker();

            map.setView(
                pakistanCenter,
                6,
                {
                    animate: true
                }
            );

            if (mapSubtitle) {

                mapSubtitle.textContent =
                    'Select a city to enable location selection';

            }

            if (cityLocationHelp) {

                cityLocationHelp.textContent =
                    'Select a city before choosing a business location.';

            }

            setMapStatus(
                'Location not selected',
                'neutral'
            );

            updateControls();

            return;

        }


        cityLoading = true;

        updateControls();

        hideCityStatus();

        clearSearchMessage();

        setMapStatus(
            `Loading ${selectedCityName}...`,
            'warning'
        );


        if (mapSubtitle) {

            mapSubtitle.textContent =
                `Loading ${selectedCityName} map boundary...`;

        }


        try {

            const query =
                `${selectedCityName}, Pakistan`;


            const url =
                'https://nominatim.openstreetmap.org/search?' +
                new URLSearchParams({

                    q: query,

                    format: 'json',

                    limit: '1',

                    countrycodes: 'pk',

                    addressdetails: '1',

                    polygon_geojson: '0'

                });


            const response =
                await fetch(
                    url,
                    {
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            if (!response.ok) {

                throw new Error(
                    'Unable to load city boundary.'
                );

            }


            const results =
                await response.json();


            if (!results.length) {

                throw new Error(
                    `Could not locate ${selectedCityName}.`
                );

            }


            const result =
                results[0];


            if (
                !result.boundingbox ||
                result.boundingbox.length !== 4
            ) {

                throw new Error(
                    'City boundary information is unavailable.'
                );

            }


            const south =
                Number(result.boundingbox[0]);

            const north =
                Number(result.boundingbox[1]);

            const west =
                Number(result.boundingbox[2]);

            const east =
                Number(result.boundingbox[3]);


            if (
                !Number.isFinite(south) ||
                !Number.isFinite(north) ||
                !Number.isFinite(west) ||
                !Number.isFinite(east)
            ) {

                throw new Error(
                    'Invalid city boundary information.'
                );

            }


            cityBounds = {
                south,
                north,
                west,
                east
            };


            const centerLat =
                Number(result.lat);

            const centerLng =
                Number(result.lon);


            if (
                Number.isFinite(centerLat) &&
                Number.isFinite(centerLng)
            ) {

                cityCenter = [
                    centerLat,
                    centerLng
                ];

            } else {

                cityCenter = [
                    (south + north) / 2,
                    (west + east) / 2
                ];

            }


            cityZoom = 12;


            map.fitBounds(
                [
                    [south, west],
                    [north, east]
                ],
                {
                    padding: [25, 25]
                }
            );


            /*
            |--------------------------------------------------------------------------
            | Restore Existing / Old Coordinates
            |--------------------------------------------------------------------------
            |
            | On the edit form this restores the vendor's saved coordinates
            | (or, after a validation error, the previously submitted ones)
            | as long as they fall within the newly loaded city bounds.
            |
            */

            const existingLatitude =
                parseFloat(
                    latitudeInput?.value
                );

            const existingLongitude =
                parseFloat(
                    longitudeInput?.value
                );


            if (
                validCoordinates(
                    existingLatitude,
                    existingLongitude
                ) &&
                isInsideSelectedCity(
                    existingLatitude,
                    existingLongitude
                )
            ) {

                setCoordinates(
                    existingLatitude,
                    existingLongitude,
                    true
                );

            } else {

                clearCoordinates();

                map.fitBounds(
                    [
                        [south, west],
                        [north, east]
                    ],
                    {
                        padding: [25, 25]
                    }
                );

            }


            if (mapSubtitle) {

                mapSubtitle.textContent =
                    `${selectedCityName} · Select or search a location`;

            }


            if (cityLocationHelp) {

                cityLocationHelp.textContent =
                    `Locations must be within ${selectedCityName}.`;

            }


            showCityStatus(
                'success',
                `${selectedCityName} selected`,
                `The map is now restricted to locations within ${selectedCityName}.`
            );


            setMapStatus(
                `${selectedCityName} ready`,
                'success'
            );


        } catch (error) {

            console.error(
                'City boundary error:',
                error
            );


            cityBounds = null;

            cityCenter = null;

            hideCityStatus();

            setMapStatus(
                'Unable to load city boundary',
                'error'
            );


            showSearchMessage(
                `Unable to load ${selectedCityName}. Please try selecting the city again.`,
                'error'
            );


            if (mapSubtitle) {

                mapSubtitle.textContent =
                    'Unable to load selected city';

            }

        } finally {

            cityLoading = false;

            updateControls();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Search Location
    |--------------------------------------------------------------------------
    */

    async function searchLocation(
        customQuery = ''
    ) {

        if (!selectedCityName) {

            showSearchMessage(
                'Please select a city first.',
                'warning'
            );

            return;

        }


        if (!cityBounds) {

            showSearchMessage(
                `Please wait while ${selectedCityName} is being prepared.`,
                'warning'
            );

            return;

        }


        const searchValue =
            customQuery.trim();


        if (!searchValue) {

            showSearchMessage(
                'Please enter a location to search.',
                'warning'
            );

            return;

        }


        searchButton.disabled = true;

        resolveButton.disabled = true;


        showSearchMessage(
            `Searching within ${selectedCityName}...`,
            'info'
        );


        try {

            const query =
                `${searchValue}, ${selectedCityName}, Pakistan`;


            const url =
                'https://nominatim.openstreetmap.org/search?' +
                new URLSearchParams({

                    q: query,

                    format: 'json',

                    limit: '5',

                    countrycodes: 'pk',

                    addressdetails: '1'

                });


            const response =
                await fetch(
                    url,
                    {
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            if (!response.ok) {

                throw new Error(
                    'Unable to search location.'
                );

            }


            const results =
                await response.json();


            if (!results.length) {

                showSearchMessage(
                    `No location was found within ${selectedCityName}. Try a more specific address.`,
                    'error'
                );

                return;

            }


            const matchingResult =
                results.find(
                    function (result) {

                        const latitude =
                            Number(result.lat);

                        const longitude =
                            Number(result.lon);

                        return isInsideSelectedCity(
                            latitude,
                            longitude
                        );

                    }
                );


            if (!matchingResult) {

                clearCoordinates();

                removeMarker();

                showCityStatus(
                    'error',
                    'Location mismatch',
                    `The searched location is outside ${selectedCityName}. Please search for an address within ${selectedCityName}.`
                );

                showSearchMessage(
                    `The searched location is outside ${selectedCityName}. Please choose a location within ${selectedCityName}.`,
                    'error'
                );

                setMapStatus(
                    'Outside selected city',
                    'error'
                );

                return;

            }


            const latitude =
                Number(
                    matchingResult.lat
                );

            const longitude =
                Number(
                    matchingResult.lon
                );


            const accepted =
                setCoordinates(
                    latitude,
                    longitude,
                    true
                );


            if (!accepted) {
                return;
            }


            if (
                addressInput &&
                !addressInput.value.trim()
            ) {

                addressInput.value =
                    matchingResult.display_name || '';

            }


            if (
                searchInput &&
                matchingResult.display_name
            ) {

                searchInput.value =
                    matchingResult.display_name;

            }


            showSearchMessage(
                `Location found successfully within ${selectedCityName}.`,
                'success'
            );

        } catch (error) {

            console.error(
                'Location search error:',
                error
            );

            showSearchMessage(
                'Unable to search for this location right now. Please try again.',
                'error'
            );

        } finally {

            searchButton.disabled =
                !citySelect.value ||
                cityLoading;

            resolveButton.disabled =
                !citySelect.value ||
                cityLoading;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Find on Map — Address
    |--------------------------------------------------------------------------
    */

    async function resolveAddress() {

        if (!selectedCityName) {

            showSearchMessage(
                'Please select a city first.',
                'warning'
            );

            return;

        }


        const address =
            addressInput?.value.trim() || '';


        if (!address) {

            showSearchMessage(
                'Please enter the business address first.',
                'warning'
            );

            addressInput?.focus();

            return;

        }


        await searchLocation(
            address
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Map Click
    |--------------------------------------------------------------------------
    */

    map.on(
        'click',
        function (event) {

            if (!selectedCityName) {

                showCityStatus(
                    'warning',
                    'Select a city first',
                    'Please select the vendor city before placing a marker.'
                );

                showSearchMessage(
                    'Please select a city before placing a location on the map.',
                    'warning'
                );

                return;

            }


            if (!cityBounds) {

                showSearchMessage(
                    `Please wait for ${selectedCityName} to finish loading.`,
                    'warning'
                );

                return;

            }


            const latitude =
                event.latlng.lat;

            const longitude =
                event.latlng.lng;


            if (
                !isInsideSelectedCity(
                    latitude,
                    longitude
                )
            ) {

                showCityStatus(
                    'error',
                    'Location outside selected city',
                    `You cannot place the vendor location outside ${selectedCityName}.`
                );

                showSearchMessage(
                    `This location is outside ${selectedCityName}. Please click within the selected city.`,
                    'error'
                );

                setMapStatus(
                    'Outside selected city',
                    'error'
                );

                return;

            }


            setCoordinates(
                latitude,
                longitude,
                false
            );

            showSearchMessage(
                'Location selected successfully.',
                'success'
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | City Changed
    |--------------------------------------------------------------------------
    */

    citySelect?.addEventListener(
        'change',
        async function () {

            /*
            | Clear previous location immediately.
            */

            clearCoordinates();

            removeMarker();

            clearSearchMessage();

            hideCityStatus();


            if (searchInput) {
                searchInput.value = '';
            }


            /*
            | Load new city boundary.
            */

            await loadCityBoundary();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Search Button
    |--------------------------------------------------------------------------
    */

    searchButton?.addEventListener(
        'click',
        function () {

            searchLocation(
                searchInput?.value || ''
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Enter key search
    |--------------------------------------------------------------------------
    */

    searchInput?.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                searchLocation(
                    searchInput.value
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Find on Map
    |--------------------------------------------------------------------------
    */

    resolveButton?.addEventListener(
        'click',
        resolveAddress
    );


    /*
    |--------------------------------------------------------------------------
    | Reset Map
    |--------------------------------------------------------------------------
    */

    resetButton?.addEventListener(
        'click',
        function () {

            clearCoordinates();

            removeMarker();

            clearSearchMessage();

            hideCityStatus();


            if (searchInput) {
                searchInput.value = '';
            }


            if (cityCenter && cityBounds) {

                map.fitBounds(
                    [
                        [
                            cityBounds.south,
                            cityBounds.west
                        ],
                        [
                            cityBounds.north,
                            cityBounds.east
                        ]
                    ],
                    {
                        padding: [25, 25]
                    }
                );

            } else {

                map.setView(
                    pakistanCenter,
                    6,
                    {
                        animate: true
                    }
                );

            }


            if (selectedCityName) {

                setMapStatus(
                    `${selectedCityName} ready`,
                    'success'
                );

            } else {

                setMapStatus(
                    'Location not selected',
                    'neutral'
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Form Submit Protection
    |--------------------------------------------------------------------------
    |
    | Frontend-only restriction.
    |
    | The form cannot submit a coordinate that was selected
    | outside the selected city.
    |
    */

    form?.addEventListener(
        'submit',
        function (event) {

            const city =
                getSelectedCityName();

            const latitude =
                parseFloat(
                    latitudeInput?.value
                );

            const longitude =
                parseFloat(
                    longitudeInput?.value
                );


            if (city) {

                if (
                    !validCoordinates(
                        latitude,
                        longitude
                    )
                ) {

                    event.preventDefault();

                    showCityStatus(
                        'error',
                        'Business location required',
                        `Please select a valid business location within ${city}.`
                    );

                    showSearchMessage(
                        `Please select a business location within ${city} before updating the vendor.`,
                        'error'
                    );

                    document
                        .getElementById('vendor-map')
                        ?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                    return;

                }


                if (
                    !isInsideSelectedCity(
                        latitude,
                        longitude
                    )
                ) {

                    event.preventDefault();

                    showCityStatus(
                        'error',
                        'Invalid business location',
                        `The selected coordinates are outside ${city}. Please select a location within ${city}.`
                    );

                    showSearchMessage(
                        `The selected location is outside ${city}. Please select a valid location within ${city}.`,
                        'error'
                    );

                    document
                        .getElementById('vendor-map')
                        ?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                    return;

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Initial State
    |--------------------------------------------------------------------------
    |
    | On the edit form, a city is very likely already selected and the
    | vendor already has coordinates saved — load the boundary immediately
    | so the existing marker/pin appears without any extra interaction.
    |
    */

    updateControls();


    if (citySelect?.value) {

        loadCityBoundary();

    } else {

        map.setView(
            pakistanCenter,
            6
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Fix Leaflet rendering after layout
    |--------------------------------------------------------------------------
    */

    setTimeout(
        function () {

            map.invalidateSize();

        },
        300
    );

});

</script>

@endsection