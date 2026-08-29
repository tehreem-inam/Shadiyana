@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-gray-400">

            <a
                href="{{ route('users.index') }}"
                class="transition hover:text-[#D7385E]"
            >
                Users
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

            <span class="text-gray-600">
                Create User
            </span>

        </div>


        {{-- Title --}}
        <div class="mt-3">

            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                Create User
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Add a new customer or vendor to your system.
            </p>

        </div>

    </div>


    {{-- ============================================================
        FORM
    ============================================================= --}}

    <form
        action="{{ route('users.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf


        {{-- ========================================================
            PROFILE SECTION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Section Header --}}
            <div class="border-b border-gray-100 px-5 py-4 sm:px-6">

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
                                d="M15 19a6 6 0 00-12 0M9 10a4 4 0 100-8 4 4 0 000 8zm8-5v6m3-3h-6"
                            />
                        </svg>

                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-gray-900">
                            Profile Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Add the user's basic profile information.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Section Body --}}
            <div class="p-5 sm:p-6">

                <div
                    x-data="{ preview: null }"
                    class="flex flex-col gap-6 sm:flex-row sm:items-center"
                >

                    {{-- Profile Preview --}}
                    <div class="shrink-0">

                        <div class="relative">

                            <div
                                class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-2xl bg-[#FBEBEF] text-[#D7385E]"
                            >

                                <template x-if="preview">

                                    <img
                                        :src="preview"
                                        alt="Profile preview"
                                        class="h-full w-full object-cover"
                                    >

                                </template>

                                <template x-if="!preview">

                                    <svg
                                        class="h-10 w-10"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M20 21a8 8 0 00-16 0M12 13a5 5 0 100-10 5 5 0 000 10z"
                                        />
                                    </svg>

                                </template>

                            </div>


                            {{-- Camera Badge --}}
                            <label
                                for="profile_image"
                                class="absolute -bottom-2 -right-2 flex h-9 w-9 cursor-pointer items-center justify-center rounded-xl border-4 border-white bg-[#D7385E] text-white shadow-sm transition hover:bg-[#c92f53]"
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
                                        stroke-width="1.8"
                                        d="M3 7h4l2-3h6l2 3h4a1 1 0 011 1v11a1 1 0 01-1 1H3a1 1 0 01-1-1V8a1 1 0 011-1z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="13"
                                        r="3"
                                        stroke-width="1.8"
                                    />
                                </svg>

                            </label>

                        </div>

                    </div>


                    {{-- Upload Info --}}
                    <div class="flex-1">

                        <h3 class="text-sm font-bold text-gray-900">
                            Profile Photo
                        </h3>

                        <p class="mt-1 max-w-md text-xs leading-5 text-gray-500">
                            Upload a profile photo for this user. Recommended
                            size is 400 × 400 pixels.
                        </p>

                        <div class="mt-3 flex flex-wrap items-center gap-3">

                            <label
                                for="profile_image"
                                class="inline-flex cursor-pointer items-center gap-2 rounded-xl border border-gray-200 bg-white px-3.5 py-2 text-xs font-bold text-gray-700 transition hover:border-[#D7385E] hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                                        stroke-width="1.8"
                                        d="M12 16V4m0 0L8 8m4-4l4 4M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3"
                                    />
                                </svg>

                                Choose Photo

                            </label>

                            <input
                                id="profile_image"
                                name="profile_image"
                                type="file"
                                accept="image/*"
                                class="hidden"
                                @change="
                                    const file = $event.target.files[0];
                                    if (file) {
                                        preview = URL.createObjectURL(file);
                                    }
                                "
                            >

                            <span class="text-[11px] text-gray-400">
                                JPG, PNG or WEBP · Max 2MB
                            </span>

                        </div>

                        @error('profile_image')
                            <p class="mt-2 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
            PERSONAL INFORMATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-5 py-4 sm:px-6">

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
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zm13 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-gray-900">
                            Personal Information
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Enter the user's name and contact details.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- First Name --}}
                    <div>

                        <label
                            for="first_name"
                            class="mb-2 block text-xs font-bold text-gray-700"
                        >
                            First Name
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <input
                            id="first_name"
                            name="first_name"
                            type="text"
                            value="{{ old('first_name') }}"
                            placeholder="Enter first name"
                            required
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-3.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('first_name') border-red-400 @enderror"
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
                            class="mb-2 block text-xs font-bold text-gray-700"
                        >
                            Last Name
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <input
                            id="last_name"
                            name="last_name"
                            type="text"
                            value="{{ old('last_name') }}"
                            placeholder="Enter last name"
                            required
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-3.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('last_name') border-red-400 @enderror"
                        >

                        @error('last_name')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-xs font-bold text-gray-700"
                        >
                            Email Address
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="john@example.com"
                            required
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-3.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('email') border-red-400 @enderror"
                        >

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
                            class="mb-2 block text-xs font-bold text-gray-700"
                        >
                            Phone Number
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <div class="flex">

                            <select
                                name="country_code"
                                class="h-11 w-[105px] rounded-l-xl border border-r-0 border-gray-200 bg-gray-50 px-3 text-sm text-gray-700 outline-none focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                            >
                                <option value="+92" {{ old('country_code', '+92') === '+92' ? 'selected' : '' }}>
                                    +92
                                </option>

                                <option value="+1" {{ old('country_code') === '+1' ? 'selected' : '' }}>
                                    +1
                                </option>

                                <option value="+44" {{ old('country_code') === '+44' ? 'selected' : '' }}>
                                    +44
                                </option>

                                <option value="+971" {{ old('country_code') === '+971' ? 'selected' : '' }}>
                                    +971
                                </option>
                            </select>

                            <input
                                id="phone_number"
                                name="phone_number"
                                type="text"
                                value="{{ old('phone_number') }}"
                                placeholder="300 1234567"
                                required
                                class="h-11 min-w-0 flex-1 rounded-r-xl border border-gray-200 bg-gray-50 px-3.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('phone_number') border-red-400 @enderror"
                            >

                        </div>

                        @error('phone_number')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
            ACCOUNT SETTINGS
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-5 py-4 sm:px-6">

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
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V7a4 4 0 10-8 0v3h8z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-gray-900">
                            Account Settings
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Configure the user's role and account access.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- Role --}}
                    <div>

                        <label
                            for="role"
                            class="mb-2 block text-xs font-bold text-gray-700"
                        >
                            User Role
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <select
                            id="role"
                            name="role"
                            required
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-3.5 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('role') border-red-400 @enderror"
                        >

                            <option value="">
                                Select user role
                            </option>

                            <option
                                value="customer"
                                {{ old('role') === 'customer' ? 'selected' : '' }}
                            >
                                Customer
                            </option>

                            <option
                                value="vendor"
                                {{ old('role') === 'vendor' ? 'selected' : '' }}
                            >
                                Vendor
                            </option>

                        </select>

                        <p class="mt-1.5 text-xs text-gray-400">
                            Choose whether this account belongs to a customer or vendor.
                        </p>

                        @error('role')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-xs font-bold text-gray-700"
                        >
                            Account Status
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-3.5 text-sm text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('status') border-red-400 @enderror"
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
                            Inactive users will not be able to access the system.
                        </p>

                        @error('status')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
            PASSWORD
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-gray-100 px-5 py-4 sm:px-6">

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
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-9V7a4 4 0 10-8 0v3h8z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-gray-900">
                            Password
                        </h2>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Create a secure password for this account.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="p-5 sm:p-6">

                <div
                    x-data="{ showPassword: false, showConfirmation: false }"
                    class="grid grid-cols-1 gap-5 sm:grid-cols-2"
                >

                    {{-- Password --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-xs font-bold text-gray-700"
                        >
                            Password
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <div class="relative">

                            <input
                                id="password"
                                name="password"
                                :type="showPassword ? 'text' : 'password'"
                                placeholder="Enter password"
                                required
                                class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-3.5 pr-11 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 @error('password') border-red-400 @enderror"
                            >

                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-0 top-0 flex h-11 w-11 items-center justify-center text-gray-400 transition hover:text-[#D7385E]"
                            >

                                <svg
                                    x-show="!showPassword"
                                    class="h-4 w-4"
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
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.314-3.912M6.228 6.228A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.132 5.411M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 3l18 18"
                                    />
                                </svg>

                            </button>

                        </div>

                        @error('password')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-xs font-bold text-gray-700"
                        >
                            Confirm Password
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <div class="relative">

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                :type="showConfirmation ? 'text' : 'password'"
                                placeholder="Confirm password"
                                required
                                class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 px-3.5 pr-11 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                            >

                            <button
                                type="button"
                                @click="showConfirmation = !showConfirmation"
                                class="absolute right-0 top-0 flex h-11 w-11 items-center justify-center text-gray-400 transition hover:text-[#D7385E]"
                            >

                                <svg
                                    x-show="!showConfirmation"
                                    class="h-4 w-4"
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
                                    x-show="showConfirmation"
                                    x-cloak
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.314-3.912M6.228 6.228A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.132 5.411M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 3l18 18"
                                    />
                                </svg>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
            FORM ACTIONS
        ========================================================= --}}

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">

            {{-- Cancel --}}
            <a
                href="{{ route('users.index') }}"
                class="inline-flex h-11 items-center justify-center rounded-xl border border-gray-200 bg-white px-5 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
            >
                Cancel
            </a>


            {{-- Create --}}
            <button
                type="submit"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30"
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
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Create User

            </button>

        </div>

    </form>

</div>

@endsection