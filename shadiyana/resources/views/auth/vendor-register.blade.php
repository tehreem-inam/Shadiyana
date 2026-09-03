@extends('layouts.public')

@section('title', 'Register Your Business | Shadiyana')

@section('content')

<div
    class="min-h-screen bg-[#faf7f8] flex items-center justify-center px-4 py-10 sm:px-6 lg:px-8"
>
    <div
        class="w-full max-w-6xl overflow-hidden rounded-3xl bg-white shadow-[0_25px_80px_rgba(0,0,0,0.10)]"
    >

        <div class="grid lg:grid-cols-2">

            {{-- ============================================================
                LEFT BRAND PANEL
            ============================================================= --}}

            <div
                class="relative hidden min-h-[760px] overflow-hidden bg-[#D7385E] lg:flex lg:flex-col lg:justify-between"
            >

                {{-- Decorative circles --}}

                <div
                    class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/10"
                ></div>

                <div
                    class="absolute -bottom-32 -left-24 h-96 w-96 rounded-full bg-white/10"
                ></div>

                <div
                    class="absolute right-20 top-1/2 h-32 w-32 -translate-y-1/2 rounded-full border border-white/10"
                ></div>

                {{-- Brand --}}

                <div class="relative z-10 p-10">

                    <a href="{{ url('/') }}" class="inline-flex items-center">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Shadiyana"
                            class="h-12 w-auto object-contain brightness-0 invert"
                        >
                    </a>

                </div>

                {{-- Main content --}}

                <div class="relative z-10 px-10 pb-16">

                    <div
                        class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15"
                    >
                        <svg
                            class="h-7 w-7 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-7h6v7M8 9h.01M12 9h.01M16 9h.01"
                            />
                        </svg>
                    </div>

                    <h1
                        class="max-w-lg text-4xl font-bold leading-tight tracking-tight text-white xl:text-5xl"
                    >
                        Grow your wedding business with Shadiyana.
                    </h1>

                    <p
                        class="mt-6 max-w-md text-base leading-7 text-white/80"
                    >
                        Create your business profile, showcase your services
                        and connect with couples planning their perfect wedding.
                    </p>

                    {{-- Benefits --}}

                    <div class="mt-10 space-y-5">

                        <div class="flex items-start gap-4">

                            <div
                                class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/15"
                            >
                                <svg
                                    class="h-4 w-4 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m5 12 4 4L19 6"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="font-semibold text-white">
                                    Build your business profile
                                </p>

                                <p class="mt-1 text-sm text-white/65">
                                    Present your brand and services professionally.
                                </p>
                            </div>

                        </div>

                        <div class="flex items-start gap-4">

                            <div
                                class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/15"
                            >
                                <svg
                                    class="h-4 w-4 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m5 12 4 4L19 6"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="font-semibold text-white">
                                    Reach more couples
                                </p>

                                <p class="mt-1 text-sm text-white/65">
                                    Get discovered by people planning weddings.
                                </p>
                            </div>

                        </div>

                        <div class="flex items-start gap-4">

                            <div
                                class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/15"
                            >
                                <svg
                                    class="h-4 w-4 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m5 12 4 4L19 6"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="font-semibold text-white">
                                    Manage your services
                                </p>

                                <p class="mt-1 text-sm text-white/65">
                                    Add services, packages, galleries and more.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ============================================================
                RIGHT REGISTRATION PANEL
            ============================================================= --}}

            <div class="px-6 py-10 sm:px-10 lg:px-12 xl:px-16">

                {{-- Mobile logo --}}

                <div class="mb-8 flex justify-center lg:hidden">

                    <a href="{{ url('/') }}">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Shadiyana"
                            class="h-11 w-auto object-contain"
                        >
                    </a>

                </div>


                {{-- Header --}}

                <div class="mb-8">

                    <div
                        class="mb-4 inline-flex items-center gap-2 rounded-full bg-[#fbebef] px-3 py-1.5 text-xs font-semibold text-[#D7385E]"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-[#D7385E]"></span>
                        Business Registration
                    </div>

                    <h2
                        class="text-3xl font-bold tracking-tight text-gray-900"
                    >
                        Register your business
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Create your vendor account and start building your
                        presence on Shadiyana.
                    </p>

                </div>


                {{-- ========================================================
                    VALIDATION ERRORS
                ========================================================= --}}

                @if ($errors->any())

                    <div
                        class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4"
                    >

                        <div class="flex gap-3">

                            <div class="shrink-0">

                                <svg
                                    class="h-5 w-5 text-red-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-red-700">
                                    Please fix the following errors:
                                </p>

                                <ul class="mt-2 space-y-1 text-sm text-red-600">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- Success message --}}

                @if (session('success'))

                    <div
                        class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm text-green-700"
                    >
                        {{ session('success') }}
                    </div>

                @endif


                {{-- ========================================================
                    FORM
                ========================================================= --}}

                <form
                    method="POST"
                    action="{{ route('vendor.register.store') }}"
                    class="space-y-6"
                >

                    @csrf


                    {{-- ====================================================
                        OWNER INFORMATION
                    ===================================================== --}}

                    <div>

                        <h3 class="text-sm font-bold text-gray-900">
                            Owner information
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Enter the details of the person managing this business.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        {{-- First Name --}}

                        <div>

                            <label
                                for="first_name"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                First name
                                <span class="text-[#D7385E]">*</span>
                            </label>

                            <input
                                id="first_name"
                                name="first_name"
                                type="text"
                                value="{{ old('first_name') }}"
                                required
                                autocomplete="given-name"
                                placeholder="Enter first name"
                                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                            @error('first_name')
                                <p class="mt-1.5 text-xs text-red-500">
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
                                Last name
                                <span class="text-[#D7385E]">*</span>
                            </label>

                            <input
                                id="last_name"
                                name="last_name"
                                type="text"
                                value="{{ old('last_name') }}"
                                required
                                autocomplete="family-name"
                                placeholder="Enter last name"
                                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                            @error('last_name')
                                <p class="mt-1.5 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- ====================================================
                        BUSINESS INFORMATION
                    ===================================================== --}}

                    <div class="border-t border-gray-100 pt-6">

                        <h3 class="text-sm font-bold text-gray-900">
                            Business information
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Tell us about the business you want to list.
                        </p>

                    </div>


                    {{-- Business Name --}}

                    <div>

                        <label
                            for="business_name"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Business name
                            <span class="text-[#D7385E]">*</span>
                        </label>

                        <input
                            id="business_name"
                            name="business_name"
                            type="text"
                            value="{{ old('business_name') }}"
                            required
                            autocomplete="organization"
                            placeholder="e.g. Royal Palace Marquee"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >

                        @error('business_name')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- ====================================================
                        CONTACT INFORMATION
                    ===================================================== --}}

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

                        {{-- Country Code --}}

                        <div>

                            <label
                                for="country_code"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Country code
                                <span class="text-[#D7385E]">*</span>
                            </label>

                            <select
                                id="country_code"
                                name="country_code"
                                required
                                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-3 text-sm text-gray-900 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                                <option
                                    value="+92"
                                    {{ old('country_code', '+92') === '+92' ? 'selected' : '' }}
                                >
                                    Pakistan (+92)
                                </option>

                                <option
                                    value="+91"
                                    {{ old('country_code') === '+91' ? 'selected' : '' }}
                                >
                                    India (+91)
                                </option>

                                <option
                                    value="+971"
                                    {{ old('country_code') === '+971' ? 'selected' : '' }}
                                >
                                    UAE (+971)
                                </option>

                                <option
                                    value="+966"
                                    {{ old('country_code') === '+966' ? 'selected' : '' }}
                                >
                                    Saudi Arabia (+966)
                                </option>

                                <option
                                    value="+44"
                                    {{ old('country_code') === '+44' ? 'selected' : '' }}
                                >
                                    UK (+44)
                                </option>

                                <option
                                    value="+1"
                                    {{ old('country_code') === '+1' ? 'selected' : '' }}
                                >
                                    USA (+1)
                                </option>

                            </select>

                            @error('country_code')
                                <p class="mt-1.5 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Phone --}}

                        <div class="sm:col-span-2">

                            <label
                                for="phone_number"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Phone number
                                <span class="text-[#D7385E]">*</span>
                            </label>

                            <input
                                id="phone_number"
                                name="phone_number"
                                type="tel"
                                value="{{ old('phone_number') }}"
                                required
                                autocomplete="tel"
                                placeholder="03XXXXXXXXX"
                                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                            @error('phone_number')
                                <p class="mt-1.5 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Email --}}

                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Email address
                            <span class="font-normal text-gray-400">
                                (optional)
                            </span>
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            placeholder="business@example.com"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >

                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- ====================================================
                        PASSWORD
                    ===================================================== --}}

                    <div
                        x-data="{ showPassword: false, showConfirm: false }"
                        class="grid grid-cols-1 gap-5 sm:grid-cols-2"
                    >

                        {{-- Password --}}

                        <div>

                            <label
                                for="password"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Password
                                <span class="text-[#D7385E]">*</span>
                            </label>

                            <div class="relative">

                                <input
                                    id="password"
                                    name="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Minimum 8 characters"
                                    class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                                >

                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 transition hover:text-[#D7385E]"
                                    aria-label="Toggle password visibility"
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
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
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
                                            d="m3 3 18 18"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M10.584 10.587a2 2 0 0 0 2.829 2.829"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M9.88 4.24A9.9 9.9 0 0 1 12 4c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 0 1-4.12 5.27M6.61 6.61A10.05 10.05 0 0 0 2.458 12c1.274 4.057 5.064 7 9.542 7 1.61 0 3.12-.38 4.46-1.05"
                                        />
                                    </svg>

                                </button>

                            </div>

                            @error('password')
                                <p class="mt-1.5 text-xs text-red-500">
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
                                Confirm password
                                <span class="text-[#D7385E]">*</span>
                            </label>

                            <div class="relative">

                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    :type="showConfirm ? 'text' : 'password'"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Re-enter password"
                                    class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                                >

                                <button
                                    type="button"
                                    @click="showConfirm = !showConfirm"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 transition hover:text-[#D7385E]"
                                    aria-label="Toggle password visibility"
                                >

                                    <svg
                                        x-show="!showConfirm"
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                        />
                                    </svg>

                                    <svg
                                        x-show="showConfirm"
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
                                            d="m3 3 18 18"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M10.584 10.587a2 2 0 0 0 2.829 2.829"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M9.88 4.24A9.9 9.9 0 0 1 12 4c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 0 1-4.12 5.27M6.61 6.61A10.05 10.05 0 0 0 2.458 12c1.274 4.057 5.064 7 9.542 7 1.61 0 3.12-.38 4.46-1.05"
                                        />
                                    </svg>

                                </button>

                            </div>

                        </div>

                    </div>


                    {{-- ====================================================
                        APPROVAL NOTICE
                    ===================================================== --}}

                    <div
                        class="flex gap-3 rounded-2xl border border-[#D7385E]/15 bg-[#fbebef] p-4"
                    >

                        <div class="shrink-0">

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
                                    d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-gray-800">
                                Your business will be reviewed
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-600">
                                After registration, your business profile will
                                remain pending until it is reviewed and approved
                                by the Shadiyana administration team.
                            </p>

                        </div>

                    </div>


                    {{-- ====================================================
                        SUBMIT
                    ===================================================== --}}

                    <button
                        type="submit"
                        class="group flex w-full items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#D7385E]/20 transition duration-200 hover:-translate-y-0.5 hover:bg-[#c62f53] hover:shadow-xl hover:shadow-[#D7385E]/25 focus:outline-none focus:ring-4 focus:ring-[#D7385E]/20"
                    >

                        <span>
                            Create Business Account
                        </span>

                        <svg
                            class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 12h14M13 6l6 6-6 6"
                            />
                        </svg>

                    </button>


                    {{-- Login --}}

                    <p class="text-center text-sm text-gray-500">

                        Already have an account?

                        <a
                            href="{{ route('login') }}"
                            class="font-bold text-[#D7385E] transition hover:text-[#b92d4d]"
                        >
                            Sign in
                        </a>

                    </p>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection