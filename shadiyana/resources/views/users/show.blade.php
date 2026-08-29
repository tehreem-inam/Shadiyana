@extends('layouts.app')

@section('title', 'User Details')

@section('content')

<div class="mx-auto max-w-6xl">

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
                User Details
            </span>

        </div>


        {{-- Title + Actions --}}
        <div class="mt-3 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                    User Details
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    View complete information about this user.
                </p>

            </div>


            {{-- Actions --}}
            <div class="flex flex-wrap gap-2">

                {{-- Back --}}
                <a
                    href="{{ route('users.index') }}"
                    class="inline-flex h-10 items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 text-sm font-bold text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
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

                    Back

                </a>


                {{-- Edit --}}
                <a
                    href="{{ route('users.edit', $user->id) }}"
                    class="inline-flex h-10 items-center gap-2 rounded-xl bg-[#D7385E] px-4 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53]"
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
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 013 3L12 14l-4 1 1-4 7.5-7.5z"
                        />
                    </svg>

                    Edit User

                </a>

            </div>

        </div>

    </div>


    {{-- ============================================================
        PROFILE HERO
    ============================================================= --}}

    <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Top Accent --}}
        <div class="h-2 bg-[#D7385E]"></div>


        <div class="p-5 sm:p-6 lg:p-8">

            <div class="flex flex-col gap-6 sm:flex-row sm:items-center">

                {{-- Profile Image --}}
                <div class="shrink-0">

                    @if($user->profile_image)

                        <img
                            src="{{ asset('storage/' . $user->profile_image) }}"
                            alt="{{ $user->first_name }} {{ $user->last_name }}"
                            class="h-28 w-28 rounded-2xl object-cover ring-4 ring-[#FBEBEF] sm:h-32 sm:w-32"
                        >

                    @else

                        <div class="flex h-28 w-28 items-center justify-center rounded-2xl bg-[#FBEBEF] text-3xl font-extrabold text-[#D7385E] ring-4 ring-[#FBEBEF] sm:h-32 sm:w-32 sm:text-4xl">

                            {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}

                        </div>

                    @endif

                </div>


                {{-- User Info --}}
                <div class="min-w-0 flex-1">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                        <div>

                            <h2 class="text-2xl font-extrabold text-gray-900">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h2>

                            <p class="mt-1 break-all text-sm text-gray-500">
                                {{ $user->email }}
                            </p>

                        </div>


                        {{-- Status --}}
                        @if($user->status === 'active')

                            <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                Active

                            </span>

                        @else

                            <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-600">

                                <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                Inactive

                            </span>

                        @endif

                    </div>


                    {{-- Badges --}}
                    <div class="mt-4 flex flex-wrap gap-2">

                        @if($user->role === 'vendor')

                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-[#FBEBEF] px-3 py-1.5 text-xs font-bold text-[#D7385E]">

                                <svg
                                    class="h-3.5 w-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 9l1-5h16l1 5M5 9v10h14V9M3 9h18M9 19v-6h6v6"
                                    />
                                </svg>

                                Vendor

                            </span>

                        @elseif($user->role === 'customer')

                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-600">

                                <svg
                                    class="h-3.5 w-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M20 21a8 8 0 00-16 0M12 13a5 5 0 100-10 5 5 0 000 10z"
                                    />
                                </svg>

                                Customer

                            </span>

                        @else

                            <span class="inline-flex rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-bold capitalize text-gray-600">
                                {{ $user->role }}
                            </span>

                        @endif


                        {{-- Verification --}}
                        @if($user->is_verified)

                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-green-50 px-3 py-1.5 text-xs font-bold text-green-700">

                                <svg
                                    class="h-3.5 w-3.5"
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

                                Verified

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700">

                                <svg
                                    class="h-3.5 w-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 9v3m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                                    />
                                </svg>

                                Not Verified

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        INFORMATION GRID
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- ========================================================
            CONTACT INFORMATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm lg:col-span-2">

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
                                d="M21 10c0 7-9 12-9 12S3 17 3 10a9 9 0 1118 0z"
                            />

                            <circle
                                cx="12"
                                cy="10"
                                r="3"
                                stroke-width="1.8"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-gray-900">
                            Contact Information
                        </h2>

                        <p class="text-xs text-gray-500">
                            User's contact details
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 divide-y divide-gray-100 sm:grid-cols-2 sm:divide-x sm:divide-y-0">

                {{-- Email --}}
                <div class="p-5 sm:p-6">

                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Email Address
                    </p>

                    <div class="mt-2 flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gray-50 text-gray-500">

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.8"
                                    d="M4 6h16v12H4z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 7l8 6 8-6"
                                />
                            </svg>

                        </div>

                        <span class="break-all text-sm font-semibold text-gray-800">
                            {{ $user->email ?: 'Not provided' }}
                        </span>

                    </div>

                </div>


                {{-- Phone --}}
                <div class="p-5 sm:p-6">

                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Phone Number
                    </p>

                    <div class="mt-2 flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gray-50 text-gray-500">

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
                                    d="M5 4h4l2 5-2.5 2a16 16 0 006.5 6.5l2-2.5 5 2v4a2 2 0 01-2 2C11.163 23 1 12.837 1 2a2 2 0 012-2h2z"
                                />
                            </svg>

                        </div>

                        <span class="text-sm font-semibold text-gray-800">
                            {{ $user->country_code }} {{ $user->phone_number }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
            ACCOUNT SUMMARY
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-4">

                <h2 class="text-sm font-bold text-gray-900">
                    Account Summary
                </h2>

                <p class="mt-0.5 text-xs text-gray-500">
                    Account information
                </p>

            </div>


            <div class="divide-y divide-gray-100">

                {{-- User ID --}}
                <div class="flex items-center justify-between gap-4 px-5 py-4">

                    <span class="text-xs font-medium text-gray-500">
                        User ID
                    </span>

                    <span class="text-sm font-bold text-gray-800">
                        #{{ $user->id }}
                    </span>

                </div>


                {{-- Role --}}
                <div class="flex items-center justify-between gap-4 px-5 py-4">

                    <span class="text-xs font-medium text-gray-500">
                        Role
                    </span>

                    <span class="text-sm font-bold capitalize text-gray-800">
                        {{ $user->role }}
                    </span>

                </div>


                {{-- Status --}}
                <div class="flex items-center justify-between gap-4 px-5 py-4">

                    <span class="text-xs font-medium text-gray-500">
                        Status
                    </span>

                    <span
                        class="text-sm font-bold capitalize {{ $user->status === 'active' ? 'text-green-600' : 'text-gray-500' }}"
                    >
                        {{ $user->status }}
                    </span>

                </div>


                {{-- Created --}}
                <div class="flex items-center justify-between gap-4 px-5 py-4">

                    <span class="text-xs font-medium text-gray-500">
                        Created
                    </span>

                    <span class="text-right text-xs font-semibold text-gray-700">
                        {{ $user->created_at?->format('d M Y, h:i A') ?? '—' }}
                    </span>

                </div>

            </div>

        </div>


        {{-- ========================================================
            LOGIN ACTIVITY
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm lg:col-span-2">

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
                                d="M12 8v4l3 3M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-gray-900">
                            Account Activity
                        </h2>

                        <p class="text-xs text-gray-500">
                            User account timeline
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 divide-y divide-gray-100 sm:grid-cols-2 sm:divide-x sm:divide-y-0">

                {{-- Last Login --}}
                <div class="p-5 sm:p-6">

                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Last Login
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-800">

                        {{ $user->last_login_at?->format('d M Y, h:i A') ?? 'Never logged in' }}

                    </p>

                </div>


                {{-- Registered --}}
                <div class="p-5 sm:p-6">

                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Registered On
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-800">

                        {{ $user->created_at?->format('d M Y, h:i A') ?? '—' }}

                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================
            VERIFICATION
        ========================================================= --}}

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-4">

                <h2 class="text-sm font-bold text-gray-900">
                    Verification
                </h2>

                <p class="mt-0.5 text-xs text-gray-500">
                    Account verification status
                </p>

            </div>


            <div class="p-5">

                @if($user->is_verified)

                    <div class="rounded-xl bg-green-50 p-4">

                        <div class="flex items-start gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-600">

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

                            </div>

                            <div>

                                <p class="text-sm font-bold text-green-800">
                                    Verified Account
                                </p>

                                <p class="mt-1 text-xs leading-5 text-green-700">
                                    This user's account has been verified.
                                </p>

                            </div>

                        </div>

                    </div>

                @else

                    <div class="rounded-xl bg-amber-50 p-4">

                        <div class="flex items-start gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-600">

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
                                        d="M12 9v3m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71 3L13.71 3.86a2 2 0 00-3.42 0z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-bold text-amber-800">
                                    Verification Pending
                                </p>

                                <p class="mt-1 text-xs leading-5 text-amber-700">
                                    This user's account has not been verified yet.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================
        VENDOR INFORMATION
    ============================================================= --}}

    @if($user->isVendor() && $user->vendor)

        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

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
                                d="M3 9l1-5h16l1 5M5 9v10h14V9M3 9h18"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-gray-900">
                            Vendor Information
                        </h2>

                        <p class="text-xs text-gray-500">
                            Business information associated with this user.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Vendor Body --}}
            <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6 lg:grid-cols-3">

                @if(isset($user->vendor->business_name))

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Business Name
                        </p>

                        <p class="mt-2 text-sm font-bold text-gray-800">
                            {{ $user->vendor->business_name }}
                        </p>

                    </div>

                @endif


                @if(isset($user->vendor->category))

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Category
                        </p>

                        <p class="mt-2 text-sm font-bold text-gray-800">
                            {{ $user->vendor->category->name ?? '—' }}
                        </p>

                    </div>

                @endif


                @if(isset($user->vendor->status))

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Vendor Status
                        </p>

                        <p class="mt-2 text-sm font-bold capitalize text-gray-800">
                            {{ $user->vendor->status }}
                        </p>

                    </div>

                @endif

            </div>

        </div>

    @endif


    {{-- ============================================================
        DELETE USER
    ============================================================= --}}

    <div class="mt-6 flex flex-col gap-3 rounded-2xl border border-red-100 bg-red-50 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">

        <div>

            <h3 class="text-sm font-bold text-red-800">
                Delete this user
            </h3>

            <p class="mt-1 text-xs leading-5 text-red-600">
                Permanently remove this user and their associated account data.
                This action cannot be undone.
            </p>

        </div>


        <form
            action="{{ route('users.destroy', $user->id) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');"
        >

            @csrf

            @method('DELETE')

            <button
                type="submit"
                class="inline-flex h-10 w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 text-sm font-bold text-red-600 transition hover:bg-red-600 hover:text-white sm:w-auto"
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
                        d="M6 7h12M9 7V4h6v3m-8 0l1 13h8l1-13M10 11v6m4-6v6"
                    />
                </svg>

                Delete User

            </button>

        </form>

    </div>

</div>

@endsection