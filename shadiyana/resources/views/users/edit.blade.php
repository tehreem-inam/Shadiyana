@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div
    x-data="{
        imagePreview: '{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '' }}',
        showPassword: false,
        showPasswordConfirmation: false
    }"
    class="mx-auto max-w-6xl"
>

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6">

        {{-- Breadcrumb --}}
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-400">

            <a
                href="{{ route('users.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Management
            </a>

            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <a
                href="{{ route('users.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Users
            </a>

            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="font-medium text-gray-600">
                Edit User
            </span>

        </div>


        {{-- Heading --}}
        <div class="mt-3">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                        Edit User
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Update account information, role, status, and security settings.
                    </p>

                </div>

                {{-- User ID --}}
                <div class="text-sm text-gray-400">
                    User #{{ $user->id }}
                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3l-7.5-13a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div>

                    <h3 class="text-sm font-bold text-red-800">
                        Please fix the following errors
                    </h3>

                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
        UPDATE FORM
    ============================================================= --}}

    <form
        action="{{ route('users.update', $user->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- ========================================================
            PROFILE INFORMATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            Profile Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Update the user's personal and contact information.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="p-5 sm:p-6">

                {{-- =================================================
                    PROFILE IMAGE
                ================================================== --}}

                <div class="mb-8">

                    <label class="text-sm font-bold text-gray-800">
                        Profile Image
                    </label>

                    <p class="mt-1 text-xs text-gray-500">
                        JPG, JPEG or PNG. Maximum file size 2MB.
                    </p>


                    <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center">

                        {{-- Preview --}}
                        <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-[#FBEBEF] text-2xl font-extrabold text-[#D7385E]">

                            <template x-if="imagePreview">

                                <img
                                    :src="imagePreview"
                                    alt="Profile image"
                                    class="h-full w-full object-cover"
                                >

                            </template>

                            <template x-if="!imagePreview">

                                <span>
                                    {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}
                                </span>

                            </template>

                        </div>


                        {{-- Upload --}}
                        <div>

                            <label
                                for="profile_image"
                                class="inline-flex cursor-pointer items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-700 shadow-sm transition hover:border-[#D7385E] hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                            >

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M12 4v12m0-12l-4 4m4-4l4 4"
                                    />
                                </svg>

                                Change Image

                            </label>

                            <input
                                id="profile_image"
                                name="profile_image"
                                type="file"
                                accept="image/png,image/jpeg,image/jpg"
                                class="hidden"
                                @change="
                                    const file = $event.target.files[0];

                                    if (file) {
                                        imagePreview = URL.createObjectURL(file);
                                    }
                                "
                            >

                            <p class="mt-2 text-xs text-gray-400">
                                Leave empty to keep the current image.
                            </p>

                        </div>

                    </div>

                    @error('profile_image')

                        <p class="mt-2 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- =================================================
                    FIRST + LAST NAME
                ================================================== --}}

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

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
                            id="first_name"
                            name="first_name"
                            type="text"
                            value="{{ old('first_name', $user->first_name) }}"
                            placeholder="Enter first name"
                            autocomplete="given-name"
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('first_name') border-red-300 bg-red-50 @enderror"
                        >

                        @error('first_name')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
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
                            id="last_name"
                            name="last_name"
                            type="text"
                            value="{{ old('last_name', $user->last_name) }}"
                            placeholder="Enter last name"
                            autocomplete="family-name"
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('last_name') border-red-300 bg-red-50 @enderror"
                        >

                        @error('last_name')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- =================================================
                    EMAIL + PHONE
                ================================================== --}}

                <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Email Address
                        </label>

                        <div class="relative">

                            <svg
                                class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 7l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                                />
                            </svg>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $user->email) }}"
                                placeholder="user@example.com"
                                autocomplete="email"
                                class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 pl-10 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('email') border-red-300 bg-red-50 @enderror"
                            >

                        </div>

                        @error('email')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div>

                        <label
                            for="phone_number"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Phone Number
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="flex">

                            <input
                                id="country_code"
                                name="country_code"
                                type="text"
                                value="{{ old('country_code', $user->country_code) }}"
                                placeholder="+92"
                                class="h-11 w-20 shrink-0 rounded-l-xl border border-r-0 border-gray-200 bg-gray-50 px-3 text-sm text-gray-800 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('country_code') border-red-300 bg-red-50 @enderror"
                            >

                            <input
                                id="phone_number"
                                name="phone_number"
                                type="text"
                                value="{{ old('phone_number', $user->phone_number) }}"
                                placeholder="3001234567"
                                autocomplete="tel"
                                class="h-11 min-w-0 flex-1 rounded-r-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('phone_number') border-red-300 bg-red-50 @enderror"
                            >

                        </div>

                        @error('country_code')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        @error('phone_number')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            ACCOUNT SETTINGS
        ============================================================= --}}

        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7zM19.4 15a1.65 1.65 0 00.33 1.82l.06.06-1.8 1.8-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V20h-2.55v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06-1.8-1.8.06-.06A1.65 1.65 0 008.34 15a1.65 1.65 0 00-1.51-1H6.75v-2.55h.08a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06 1.8-1.8.06.06a1.65 1.65 0 001.82.33 1.65 1.65 0 001-1.51V5h2.55v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06 1.8 1.8-.06.06a1.65 1.65 0 00-.33 1.82 1.65 1.65 0 001.51 1h.09V14h-.09a1.65 1.65 0 00-1.51 1z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            Account Settings
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Manage role, status, verification, and password.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- =================================================
                        ROLE
                    ================================================== --}}

                    <div>

                        <label
                            for="role"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Role
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="role"
                            name="role"
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('role') border-red-300 bg-red-50 @enderror"
                        >

                            <option value="">
                                Select role
                            </option>

                            <option value="customer"
                                @selected(old('role', $user->role) === 'customer')>
                                Customer
                            </option>

                            <option value="vendor"
                                @selected(old('role', $user->role) === 'vendor')>
                                Vendor
                            </option>

                            <option value="superadmin"
                                @selected(old('role', $user->role) === 'superadmin')>
                                Super Admin
                            </option>

                        </select>

                        @error('role')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- =================================================
                        STATUS
                    ================================================== --}}

                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Account Status
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('status') border-red-300 bg-red-50 @enderror"
                        >

                            <option value="">
                                Select status
                            </option>

                            <option value="active"
                                @selected(old('status', $user->status) === 'active')>
                                Active
                            </option>

                            <option value="inactive"
                                @selected(old('status', $user->status) === 'inactive')>
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- =================================================
                        VERIFICATION
                    ================================================== --}}

                    <div class="sm:col-span-2">

                        <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 p-4">

                            <div class="flex items-start gap-3">

                                <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M9 12l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-gray-800">
                                        Account Verification
                                    </p>

                                    <p class="mt-0.5 text-xs text-gray-500">
                                        Mark this user's account as verified.
                                    </p>

                                </div>

                            </div>


                            <label class="relative inline-flex cursor-pointer items-center">

                                <input
                                    type="checkbox"
                                    name="is_verified"
                                    value="1"
                                    class="peer sr-only"
                                    @checked(old('is_verified', $user->is_verified))
                                >

                                <div class="h-6 w-11 rounded-full bg-gray-300 transition peer-checked:bg-[#D7385E] peer-focus:ring-2 peer-focus:ring-[#D7385E]/20 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:transition-all after:content-[''] peer-checked:after:translate-x-full">
                                </div>

                            </label>

                        </div>

                        @error('is_verified')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- =================================================
                        NEW PASSWORD
                    ================================================== --}}

                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            New Password
                        </label>

                        <div class="relative">

                            <input
                                id="password"
                                name="password"
                                :type="showPassword ? 'text' : 'password'"
                                placeholder="Leave blank to keep current"
                                autocomplete="new-password"
                                class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 pr-11 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('password') border-red-300 bg-red-50 @enderror"
                            >

                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 transition hover:text-[#D7385E]"
                            >

                                <svg
                                    x-show="!showPassword"
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                                    />
                                </svg>

                                <svg
                                    x-show="showPassword"
                                    x-cloak
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 3l18 18M10.58 10.58a2 2 0 102.83 2.83M9.88 5.09A9.95 9.95 0 0112 5c4.48 0 8.27 2.94 9.54 7a10.06 10.06 0 01-4.16 5.26M6.23 6.23C4.4 7.46 3.05 9.1 2.46 12c.68 2.17 2.05 3.91 4.08 5.19A9.95 9.95 0 0012 19c.74 0 1.46-.08 2.14-.23"
                                    />
                                </svg>

                            </button>

                        </div>

                        <p class="mt-1.5 text-xs text-gray-400">
                            Only enter a password when changing it.
                        </p>

                        @error('password')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- =================================================
                        PASSWORD CONFIRMATION
                    ================================================== --}}

                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Confirm New Password
                        </label>

                        <div class="relative">

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                :type="showPasswordConfirmation ? 'text' : 'password'"
                                placeholder="Confirm new password"
                                autocomplete="new-password"
                                class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 pr-11 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                            >

                            <button
                                type="button"
                                @click="showPasswordConfirmation = !showPasswordConfirmation"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 transition hover:text-[#D7385E]"
                            >

                                <svg
                                    x-show="!showPasswordConfirmation"
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                                    />
                                </svg>

                                <svg
                                    x-show="showPasswordConfirmation"
                                    x-cloak
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 3l18 18M10.58 10.58a2 2 0 102.83 2.83M9.88 5.09A9.95 9.95 0 0112 5c4.48 0 8.27 2.94 9.54 7a10.06 10.06 0 01-4.16 5.26M6.23 6.23C4.4 7.46 3.05 9.1 2.46 12c.68 2.17 2.05 3.91 4.08 5.19A9.95 9.95 0 0012 19c.74 0 1.46-.08 2.14-.23"
                                    />
                                </svg>

                            </button>

                        </div>

                        @error('password_confirmation')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            ACCOUNT INFORMATION
        ============================================================= --}}

        <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">

            <div class="mb-5">

                <h2 class="text-base font-bold text-gray-900">
                    Account Information
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    System-generated information about this account.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                {{-- Created --}}
                <div class="rounded-xl bg-gray-50 p-4">

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Created
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-800">
                        {{ $user->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                    </p>

                </div>


                {{-- Last Login --}}
                <div class="rounded-xl bg-gray-50 p-4">

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Last Login
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-800">
                        {{ $user->last_login_at?->format('d M Y, h:i A') ?? 'Never' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- ============================================================
            FORM ACTIONS
        ============================================================= --}}

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

            {{-- Cancel --}}
            <a
                href="{{ route('users.index') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-800 sm:w-auto"
            >

                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Cancel

            </a>


            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">

                {{-- View User --}}
                <a
                    href="{{ route('users.show', $user->id) }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600 sm:w-auto"
                >

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                        />
                    </svg>

                    View User

                </a>


                {{-- Update --}}
                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 py-3 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 sm:w-auto"
                >

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    Update User

                </button>

            </div>

        </div>

    </form>

</div>

@endsection