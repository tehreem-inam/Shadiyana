@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="min-h-screen bg-gray-50">

    {{-- ================================================================
         Header
    ================================================================= --}}

    <div class="mb-8">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span>Dashboard</span>
                </div>

                <h1 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                    {{ $stats['title'] }}
                </h1>

                <p class="mt-2 text-sm text-gray-600 sm:text-base">
                    {{ $stats['description'] }}
                </p>

            </div>

            {{-- User Badge --}}

            <div class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#FBEBEF] text-sm font-bold text-[#D7385E]">
                    {{ strtoupper(substr($user->first_name ?? 'U', 0, 1)) }}
                </div>

                <div class="min-w-0">

                    <p class="truncate text-sm font-semibold text-gray-900">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </p>

                    <p class="text-xs font-medium capitalize text-gray-500">
                        {{ $user->role }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ================================================================
         Super Admin Dashboard
    ================================================================= --}}

    @if($user->isSuperAdmin())

        <div class="mb-8">

            <div class="mb-5">
                <h2 class="text-lg font-semibold text-gray-900">
                    Administration
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Manage the Shadiyana marketplace and its users.
                </p>
            </div>


            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

                {{-- Users --}}

                <a
                    href="{{ route('users.index') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-[#D7385E]/30 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 0a3 3 0 100-6 3 3 0 000 6zM9 14a4 4 0 014 4v2"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 text-base font-semibold text-gray-900">
                        Users
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Manage customer, vendor and administrative accounts.
                    </p>

                </a>


                {{-- Vendors --}}

                <a
                    href="{{ route('vendors.index') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-[#D7385E]/30 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 10l9-7 9 7M5 9v10a2 2 0 002 2h10a2 2 0 002-2V9M9 21v-6h6v6"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 text-base font-semibold text-gray-900">
                        Vendors
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Manage vendors, assignments, moderation and marketplace content.
                    </p>

                </a>


                {{-- Taxonomies --}}

                <a
                    href="{{ route('taxonomies.index') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-[#D7385E]/30 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg
                            class="h-6 w-6"
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

                    <h3 class="mt-5 text-base font-semibold text-gray-900">
                        Taxonomies
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Manage the taxonomy structure used across the marketplace.
                    </p>

                </a>


                {{-- Services --}}

                <a
                    href="{{ route('services.index') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-[#D7385E]/30 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 3v18M3 12h18M5.5 5.5l13 13M18.5 5.5l-13 13"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 text-base font-semibold text-gray-900">
                        Services
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Manage the services vendors can offer to customers.
                    </p>

                </a>

            </div>

        </div>


        {{-- Vendor Administration --}}

        <div>

            <div class="mb-5">

                <h2 class="text-lg font-semibold text-gray-900">
                    Vendor Operations
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Monitor and manage vendor marketplace activity.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <a
                    href="{{ route('event-types.index') }}"
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-[#D7385E]/30 hover:shadow-md"
                >

                    <h3 class="font-semibold text-gray-900">
                        Event Types
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Manage event types available to vendors.
                    </p>

                </a>


                <a
                    href="{{ route('locations.cities.index') }}"
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-[#D7385E]/30 hover:shadow-md"
                >

                    <h3 class="font-semibold text-gray-900">
                        Locations
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Manage cities and location data.
                    </p>

                </a>


                <a
                    href="{{ route('vendors.index') }}"
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-[#D7385E]/30 hover:shadow-md"
                >

                    <h3 class="font-semibold text-gray-900">
                        Vendor Management
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Review vendor profiles and marketplace assignments.
                    </p>

                </a>

            </div>

        </div>


    {{-- ================================================================
         Vendor Dashboard
    ================================================================= --}}

    @elseif($user->isVendor())

        <div class="mb-8">

            @if($vendor)

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Your Business
                            </p>

                            <h2 class="mt-1 text-xl font-bold text-gray-900">
                                {{ $vendor->business_name }}
                            </h2>

                            <p class="mt-2 text-sm text-gray-500">
                                Manage your Shadiyana vendor profile and services.
                            </p>

                        </div>

                        <a
                            href="{{ route('vendors.show', $vendor) }}"
                            class="inline-flex items-center justify-center rounded-lg bg-[#D7385E] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#c42f52]"
                        >
                            View Profile
                        </a>

                    </div>

                </div>

            @else

                <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-6">

                    <h2 class="font-semibold text-yellow-900">
                        Vendor profile not found
                    </h2>

                    <p class="mt-2 text-sm text-yellow-800">
                        Your vendor account does not currently have an associated vendor profile.
                    </p>

                </div>

            @endif

        </div>


        {{-- Vendor Modules --}}

        <div>

            <div class="mb-5">

                <h2 class="text-lg font-semibold text-gray-900">
                    My Vendor
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Manage your business information and marketplace presence.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">


                {{-- Profile --}}

                @if($vendor)

                    <a
                        href="{{ route('vendors.show', $vendor) }}"
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-[#D7385E]/30 hover:shadow-md"
                    >

                        <h3 class="font-semibold text-gray-900">
                            Profile
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            View and manage your vendor profile.
                        </p>

                    </a>


                    {{-- Services --}}

                    <a
                        href="{{ route('vendors.services.index', $vendor) }}"
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-[#D7385E]/30 hover:shadow-md"
                    >

                        <h3 class="font-semibold text-gray-900">
                            My Services
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Select and manage services offered by your business.
                        </p>

                    </a>


                    {{-- Event Types --}}

                    <a
                        href="{{ route('vendors.event-types.index', $vendor) }}"
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-[#D7385E]/30 hover:shadow-md"
                    >

                        <h3 class="font-semibold text-gray-900">
                            My Event Types
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Select the events your business provides services for.
                        </p>

                    </a>


                    {{-- Gallery --}}

                    <a
                        href="{{ route('vendors.images.index', $vendor) }}"
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-[#D7385E]/30 hover:shadow-md"
                    >

                        <h3 class="font-semibold text-gray-900">
                            My Gallery
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Upload and manage your business images.
                        </p>

                    </a>


                    {{-- Taxonomies --}}

                    <a
                        href="{{ route('vendors.taxonomies.index', $vendor) }}"
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-[#D7385E]/30 hover:shadow-md"
                    >

                        <h3 class="font-semibold text-gray-900">
                            My Taxonomies
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Manage the categories associated with your business.
                        </p>

                    </a>

                @endif


                {{-- Packages --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                    <h3 class="font-semibold text-gray-900">
                        Packages
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Create and manage your service packages.
                    </p>

                    <span class="mt-4 inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                        Coming next
                    </span>

                </div>


                {{-- Availability --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                    <h3 class="font-semibold text-gray-900">
                        Availability
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Manage your available dates and booking capacity.
                    </p>

                    <span class="mt-4 inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                        Coming next
                    </span>

                </div>


                {{-- Deals --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                    <h3 class="font-semibold text-gray-900">
                        Deals
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Create and manage special offers.
                    </p>

                    <span class="mt-4 inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                        Coming next
                    </span>

                </div>


                {{-- Inquiries --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                    <h3 class="font-semibold text-gray-900">
                        Inquiries
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Respond to customer inquiries.
                    </p>

                    <span class="mt-4 inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                        Coming next
                    </span>

                </div>


                {{-- Bookings --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                    <h3 class="font-semibold text-gray-900">
                        Bookings
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Manage your customer bookings.
                    </p>

                    <span class="mt-4 inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                        Coming next
                    </span>

                </div>


                {{-- Reviews --}}

                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                    <h3 class="font-semibold text-gray-900">
                        Reviews
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        View and respond to customer reviews.
                    </p>

                    <span class="mt-4 inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                        Coming next
                    </span>

                </div>

            </div>

        </div>


    {{-- ================================================================
         Customer Dashboard
    ================================================================= --}}

    @elseif($user->isCustomer())

        <div class="rounded-2xl border border-gray-200 bg-white p-8 text-center shadow-sm">

            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E]">

                <svg
                    class="h-7 w-7"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M5.121 17.804A9 9 0 1118.88 6.196 9 9 0 015.12 17.804z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15 9a3 3 0 11-6 0 3 3 0 016 0zm-7 8a4 4 0 018 0"
                    />
                </svg>

            </div>

            <h2 class="mt-5 text-xl font-bold text-gray-900">
                Welcome, {{ $user->first_name }}!
            </h2>

            <p class="mx-auto mt-2 max-w-xl text-sm text-gray-500">
                Your customer dashboard is ready for future inquiries,
                bookings and reviews functionality.
            </p>

        </div>

    @endif

</div>

@endsection

