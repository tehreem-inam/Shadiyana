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
                CONTACT & LOCATION
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
                                    d="M17.657 16.657L13.414 21a2 2 0 01-2.828 0l-4.243-4.343a8 8 0 1111.314 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-base font-bold text-gray-900">
                                Contact & Location
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Update the vendor's business contact details and location.
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
                    <div>

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



                    {{-- City --}}
                    <div>

                        <label
                            for="city_id"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            City
                        </label>

                        <select
                            id="city_id"
                            name="city_id"
                            class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
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

                        @error('city_id')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Address --}}
                    <div class="sm:col-span-2">

                        <label
                            for="address"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            maxlength="1000"
                            placeholder="Enter complete business address"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm leading-6 shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#FBEBEF]"
                        >{{ old('address', $vendor->address) }}</textarea>

                        <p class="mt-2 text-xs text-gray-500">
                            Vendor coordinates will be refreshed automatically from the address and selected city.
                        </p>

                        @error('address')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>



                    {{-- Current Coordinates --}}
                    @if ($vendor->latitude && $vendor->longitude)

                        <div class="sm:col-span-2">

                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white shadow-sm">

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
                                                d="M9 20l-5-2V6l5 2m0 12l6-2m-6 2V8m6 10l5 2V8l-5-2m0 12V6m0 0L9 8"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-sm font-semibold text-gray-800">
                                            Current Coordinates
                                        </p>

                                        <p class="mt-0.5 text-xs text-gray-500">
                                            Latitude:
                                            {{ $vendor->latitude }}
                                            &nbsp; • &nbsp;
                                            Longitude:
                                            {{ $vendor->longitude }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif

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
    ALPINE COMPONENT
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

@endsection