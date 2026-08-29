@extends('layouts.app')

@section('title', 'Vendors')

@section('content')

<div class="space-y-6">

    {{-- ============================================================
        Page Header
    ============================================================= --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            {{-- Breadcrumb --}}
            <div class="mb-2 flex items-center gap-2 text-xs font-medium text-gray-400">
                <a
                    href="{{ url('/') }}"
                    class="transition hover:text-[#D7385E]"
                >
                    Dashboard
                </a>

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
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                <span class="text-gray-500">
                    Vendors
                </span>
            </div>

            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">
                Vendors
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage vendors, business profiles, verification, and vendor status.
            </p>
        </div>

        {{-- Add Vendor --}}
        <a
            href="{{ route('vendors.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c52f52] focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30"
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

            Add Vendor
        </a>

    </div>


    {{-- ============================================================
        Flash Messages
    ============================================================= --}}

    @if(session('success'))
        <div
            class="flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700"
        >
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
                    d="M5 13l4 4L19 7"
                />
            </svg>

            <span>
                {{ session('success') }}
            </span>
        </div>
    @endif


    @if(session('error'))
        <div
            class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
        >
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
                    d="M12 8v4m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"
                />
            </svg>

            <span>
                {{ session('error') }}
            </span>
        </div>
    @endif


    {{-- ============================================================
        Vendor Statistics
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total Vendors --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Total Vendors
                    </p>

                    <p class="mt-2 text-2xl font-extrabold text-gray-900">
                        {{ $vendors->total() }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">
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
                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 10h.01M15 10h.01M9 14h.01M15 14h.01"
                        />
                    </svg>
                </div>

            </div>

        </div>


        {{-- Pending --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Pending
                    </p>

                    <p class="mt-2 text-2xl font-extrabold text-gray-900">
                        {{ $vendors->where('status', 'pending')->count() }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
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
                            d="M12 6v6l4 2"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke-width="1.8"
                        />
                    </svg>
                </div>

            </div>

        </div>


        {{-- Verified --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Verified
                    </p>

                    <p class="mt-2 text-2xl font-extrabold text-gray-900">
                        {{ $vendors->where('is_verified', true)->count() }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600">
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
                            d="M5 12l4 4L19 6"
                        />
                    </svg>
                </div>

            </div>

        </div>


        {{-- Premium --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Premium
                    </p>

                    <p class="mt-2 text-2xl font-extrabold text-gray-900">
                        {{ $vendors->where('is_premium', true)->count() }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
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
                            d="M12 3l2.9 5.88 6.49.94-4.7 4.58 1.11 6.47L12 17.82 6.2 20.87l1.11-6.47-4.7-4.58 6.49-.94L12 3z"
                        />
                    </svg>
                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        Filters
    ============================================================= --}}

    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">

        <form
            method="GET"
            action="{{ route('vendors.index') }}"
            class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-5"
        >

            {{-- Search --}}
            <div class="relative xl:col-span-2">

                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg
                        class="h-4 w-4 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                        />
                    </svg>
                </div>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search business, phone, email..."
                    class="h-11 w-full rounded-xl border border-gray-200 bg-gray-50 pl-10 pr-4 text-sm text-gray-700 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                >

            </div>


            {{-- Status --}}
            <select
                name="status"
                class="h-11 rounded-xl border border-gray-200 bg-gray-50 px-3 text-sm text-gray-600 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
            >
                <option value="">
                    All Statuses
                </option>

                <option value="pending" @selected(request('status') === 'pending')>
                    Pending
                </option>

                <option value="approved" @selected(request('status') === 'approved')>
                    Approved
                </option>

                <option value="rejected" @selected(request('status') === 'rejected')>
                    Rejected
                </option>

                <option value="suspended" @selected(request('status') === 'suspended')>
                    Suspended
                </option>
            </select>


            {{-- Verification --}}
            <select
                name="verification"
                class="h-11 rounded-xl border border-gray-200 bg-gray-50 px-3 text-sm text-gray-600 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
            >
                <option value="">
                    Verification
                </option>

                <option value="verified" @selected(request('verification') === 'verified')>
                    Verified
                </option>

                <option value="unverified" @selected(request('verification') === 'unverified')>
                    Unverified
                </option>
            </select>


            {{-- Featured / Premium --}}
            <select
                name="plan"
                class="h-11 rounded-xl border border-gray-200 bg-gray-50 px-3 text-sm text-gray-600 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
            >
                <option value="">
                    All Vendors
                </option>

                <option value="featured" @selected(request('plan') === 'featured')>
                    Featured
                </option>

                <option value="premium" @selected(request('plan') === 'premium')>
                    Premium
                </option>
            </select>


            {{-- Filter Buttons --}}
            <div class="flex gap-2 md:col-span-2 xl:col-span-5">

                <button
                    type="submit"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 text-sm font-bold text-white transition hover:bg-[#c52f52]"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                        />
                    </svg>

                    Apply Filters
                </button>

                @if(request()->hasAny(['search', 'status', 'verification', 'plan']))
                    <a
                        href="{{ route('vendors.index') }}"
                        class="inline-flex h-10 items-center justify-center rounded-xl border border-gray-200 px-4 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                    >
                        Clear
                    </a>
                @endif

            </div>

        </form>

    </div>


    {{-- ============================================================
        Vendors Table
    ============================================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="flex flex-col gap-2 border-b border-gray-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-sm font-extrabold text-gray-900">
                    All Vendors
                </h2>

                <p class="mt-0.5 text-xs text-gray-400">
                    Manage registered vendor businesses.
                </p>
            </div>

            @if($vendors->total() > 0)
                <span class="text-xs font-semibold text-gray-400">
                    Showing {{ $vendors->firstItem() }}–{{ $vendors->lastItem() }}
                    of {{ $vendors->total() }}
                </span>
            @endif

        </div>


        @if($vendors->count())

            {{-- Desktop Table --}}
            <div class="hidden overflow-x-auto lg:block">

                <table class="min-w-full">

                    <thead class="bg-gray-50/80">

                        <tr class="border-b border-gray-100">

                            <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                Vendor
                            </th>

                            <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                Owner
                            </th>

                            <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                Location
                            </th>

                            <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                Contact
                            </th>

                            <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                Status
                            </th>

                            <th class="px-5 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                Performance
                            </th>

                            <th class="px-5 py-3 text-right text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($vendors as $vendor)

                            <tr class="group transition hover:bg-gray-50/70">

                                {{-- Vendor --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        {{-- Logo --}}
                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]">

                                            @if($vendor->logo_image)
                                                <img
                                                    src="{{ asset('storage/' . $vendor->logo_image) }}"
                                                    alt="{{ $vendor->business_name }}"
                                                    class="h-full w-full object-cover"
                                                >
                                            @else
                                                {{ strtoupper(substr($vendor->business_name, 0, 1)) }}
                                            @endif

                                        </div>


                                        <div class="min-w-0">

                                            <div class="flex items-center gap-2">

                                                <a
                                                    href="{{ route('vendors.show', $vendor) }}"
                                                    class="truncate text-sm font-bold text-gray-900 transition hover:text-[#D7385E]"
                                                >
                                                    {{ $vendor->business_name }}
                                                </a>

                                                @if($vendor->is_verified)
                                                    <span
                                                        title="Verified"
                                                        class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600"
                                                    >
                                                        <svg
                                                            class="h-2.5 w-2.5"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="3"
                                                                d="M5 12l4 4L19 6"
                                                            />
                                                        </svg>
                                                    </span>
                                                @endif

                                            </div>


                                            <div class="mt-1 flex flex-wrap items-center gap-1.5">

                                                @if($vendor->is_featured)
                                                    <span class="rounded-md bg-amber-50 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wide text-amber-600">
                                                        Featured
                                                    </span>
                                                @endif

                                                @if($vendor->is_premium)
                                                    <span class="rounded-md bg-purple-50 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wide text-purple-600">
                                                        Premium
                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Owner --}}
                                <td class="px-5 py-4">

                                    @if($vendor->user)

                                        <p class="text-sm font-semibold text-gray-700">
                                            {{ trim($vendor->user->first_name . ' ' . $vendor->user->last_name) }}
                                        </p>

                                        @if($vendor->user->email)
                                            <p class="mt-0.5 max-w-[180px] truncate text-xs text-gray-400">
                                                {{ $vendor->user->email }}
                                            </p>
                                        @endif

                                    @else

                                        <span class="text-xs text-gray-400">
                                            No owner
                                        </span>

                                    @endif

                                </td>


                                {{-- Location --}}
                                <td class="px-5 py-4">

                                    @if($vendor->city)

                                        <div class="flex items-center gap-1.5 text-sm font-medium text-gray-600">

                                            <svg
                                                class="h-4 w-4 text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="10"
                                                    r="2.5"
                                                    stroke-width="1.8"
                                                />
                                            </svg>

                                            {{ $vendor->city->name }}

                                        </div>

                                    @else

                                        <span class="text-xs text-gray-400">
                                            Not specified
                                        </span>

                                    @endif

                                </td>


                                {{-- Contact --}}
                                <td class="px-5 py-4">

                                    @if($vendor->phone_number)

                                        <p class="text-sm font-medium text-gray-600">
                                            {{ $vendor->phone_number }}
                                        </p>

                                    @endif

                                    @if($vendor->whatsapp_number)

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            WhatsApp: {{ $vendor->whatsapp_number }}
                                        </p>

                                    @endif

                                    @if(!$vendor->phone_number && !$vendor->whatsapp_number)

                                        <span class="text-xs text-gray-400">
                                            Not specified
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4">

                                    @php
                                        $statusClasses = match($vendor->status) {
                                            'approved' => 'bg-green-50 text-green-700',
                                            'pending' => 'bg-amber-50 text-amber-700',
                                            'rejected' => 'bg-red-50 text-red-700',
                                            'suspended' => 'bg-gray-100 text-gray-600',
                                            default => 'bg-gray-100 text-gray-600',
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex items-center rounded-lg px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide {{ $statusClasses }}"
                                    >
                                        {{ ucfirst($vendor->status) }}
                                    </span>

                                </td>


                                {{-- Performance --}}
                                <td class="px-5 py-4">

                                    <div class="space-y-1">

                                        <div class="flex items-center gap-1 text-sm">

                                            <svg
                                                class="h-3.5 w-3.5 fill-current text-amber-400"
                                                viewBox="0 0 24 24"
                                            >
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>

                                            <span class="font-bold text-gray-700">
                                                {{ number_format((float) $vendor->avg_rating, 1) }}
                                            </span>

                                            <span class="text-xs text-gray-400">
                                                ({{ $vendor->review_count }})
                                            </span>

                                        </div>

                                        <p class="text-[10px] text-gray-400">
                                            {{ number_format($vendor->view_count) }} views
                                        </p>

                                    </div>

                                </td>


                                {{-- Actions --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-1">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('vendors.show', $vendor) }}"
                                            title="View Vendor"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-width="1.8"
                                                    d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="2.5"
                                                    stroke-width="1.8"
                                                />
                                            </svg>
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('vendors.edit', $vendor) }}"
                                            title="Edit Vendor"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
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
                                                    d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M17.5 2.5a2.12 2.12 0 013 3L12 14l-4 1 1-4 8.5-8.5z"
                                                />
                                            </svg>
                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('vendors.destroy', $vendor) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this vendor? This action cannot be undone.')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Delete Vendor"
                                                class="flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-50 hover:text-red-600"
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
                                                        d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m2 0v14a2 2 0 01-2 2H8a2 2 0 01-2-2V6m3 4v8m6-8v8"
                                                    />
                                                </svg>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- ====================================================
                Mobile Vendor Cards
            ===================================================== --}}

            <div class="divide-y divide-gray-100 lg:hidden">

                @foreach($vendors as $vendor)

                    <div class="p-4">

                        <div class="flex items-start gap-3">

                            {{-- Logo --}}
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]">

                                @if($vendor->logo_image)

                                    <img
                                        src="{{ asset('storage/' . $vendor->logo_image) }}"
                                        alt="{{ $vendor->business_name }}"
                                        class="h-full w-full object-cover"
                                    >

                                @else

                                    {{ strtoupper(substr($vendor->business_name, 0, 1)) }}

                                @endif

                            </div>


                            {{-- Vendor Information --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-start justify-between gap-2">

                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('vendors.show', $vendor) }}"
                                            class="block truncate text-sm font-bold text-gray-900"
                                        >
                                            {{ $vendor->business_name }}
                                        </a>

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            {{ $vendor->slug }}
                                        </p>

                                    </div>


                                    {{-- Status --}}
                                    @php
                                        $mobileStatusClasses = match($vendor->status) {
                                            'approved' => 'bg-green-50 text-green-700',
                                            'pending' => 'bg-amber-50 text-amber-700',
                                            'rejected' => 'bg-red-50 text-red-700',
                                            'suspended' => 'bg-gray-100 text-gray-600',
                                            default => 'bg-gray-100 text-gray-600',
                                        };
                                    @endphp

                                    <span
                                        class="shrink-0 rounded-lg px-2 py-1 text-[9px] font-bold uppercase {{ $mobileStatusClasses }}"
                                    >
                                        {{ ucfirst($vendor->status) }}
                                    </span>

                                </div>


                                {{-- Badges --}}
                                <div class="mt-2 flex flex-wrap gap-1.5">

                                    @if($vendor->is_verified)
                                        <span class="rounded-md bg-blue-50 px-1.5 py-0.5 text-[9px] font-bold text-blue-600">
                                            Verified
                                        </span>
                                    @endif

                                    @if($vendor->is_featured)
                                        <span class="rounded-md bg-amber-50 px-1.5 py-0.5 text-[9px] font-bold text-amber-600">
                                            Featured
                                        </span>
                                    @endif

                                    @if($vendor->is_premium)
                                        <span class="rounded-md bg-purple-50 px-1.5 py-0.5 text-[9px] font-bold text-purple-600">
                                            Premium
                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Vendor Details --}}
                        <div class="mt-4 grid grid-cols-2 gap-3 rounded-xl bg-gray-50 p-3">

                            <div>
                                <p class="text-[9px] font-bold uppercase tracking-wider text-gray-400">
                                    Owner
                                </p>

                                <p class="mt-1 truncate text-xs font-semibold text-gray-700">
                                    @if($vendor->user)
                                        {{ trim($vendor->user->first_name . ' ' . $vendor->user->last_name) }}
                                    @else
                                        No owner
                                    @endif
                                </p>
                            </div>


                            <div>
                                <p class="text-[9px] font-bold uppercase tracking-wider text-gray-400">
                                    City
                                </p>

                                <p class="mt-1 truncate text-xs font-semibold text-gray-700">
                                    {{ $vendor->city?->name ?? 'Not specified' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-[9px] font-bold uppercase tracking-wider text-gray-400">
                                    Rating
                                </p>

                                <p class="mt-1 text-xs font-semibold text-gray-700">
                                    ★ {{ number_format((float) $vendor->avg_rating, 1) }}
                                    <span class="font-normal text-gray-400">
                                        ({{ $vendor->review_count }})
                                    </span>
                                </p>
                            </div>


                            <div>
                                <p class="text-[9px] font-bold uppercase tracking-wider text-gray-400">
                                    Views
                                </p>

                                <p class="mt-1 text-xs font-semibold text-gray-700">
                                    {{ number_format($vendor->view_count) }}
                                </p>
                            </div>

                        </div>


                        {{-- Mobile Actions --}}
                        <div class="mt-3 flex items-center gap-2">

                            <a
                                href="{{ route('vendors.show', $vendor) }}"
                                class="flex flex-1 items-center justify-center gap-2 rounded-lg border border-gray-200 px-3 py-2 text-xs font-bold text-gray-600 transition hover:bg-gray-50"
                            >
                                <svg
                                    class="h-3.5 w-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-width="1.8"
                                        d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="2.5"
                                        stroke-width="1.8"
                                    />
                                </svg>

                                View
                            </a>


                            <a
                                href="{{ route('vendors.edit', $vendor) }}"
                                class="flex flex-1 items-center justify-center gap-2 rounded-lg bg-[#FBEBEF] px-3 py-2 text-xs font-bold text-[#D7385E] transition hover:bg-[#f8dce3]"
                            >
                                <svg
                                    class="h-3.5 w-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-width="1.8"
                                        d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M17.5 2.5a2.12 2.12 0 013 3L12 14l-4 1 1-4 8.5-8.5z"
                                    />
                                </svg>

                                Edit
                            </a>


                            <form
                                action="{{ route('vendors.destroy', $vendor) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this vendor? This action cannot be undone.')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="flex h-8 w-8 items-center justify-center rounded-lg border border-gray-200 text-gray-400 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600"
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
                                            d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m2 0v14a2 2 0 01-2 2H8a2 2 0 01-2-2V6m3 4v8m6-8v8"
                                        />
                                    </svg>
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- ====================================================
                Pagination
            ===================================================== --}}

            @if($vendors->hasPages())

                <div class="border-t border-gray-100 px-5 py-4">
                    {{ $vendors->withQueryString()->links() }}
                </div>

            @endif

        @else

            {{-- ====================================================
                Empty State
            ===================================================== --}}

            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

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
                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 10h.01M15 10h.01M9 14h.01M15 14h.01"
                        />
                    </svg>

                </div>

                <h3 class="mt-4 text-sm font-extrabold text-gray-900">
                    No vendors found
                </h3>

                <p class="mx-auto mt-1 max-w-sm text-xs leading-5 text-gray-500">
                    @if(request()->hasAny(['search', 'status', 'verification', 'plan']))
                        No vendors match your current filters. Try adjusting your search or filters.
                    @else
                        There are no vendors registered yet.
                    @endif
                </p>


                @if(request()->hasAny(['search', 'status', 'verification', 'plan']))

                    <a
                        href="{{ route('vendors.index') }}"
                        class="mt-5 inline-flex items-center justify-center rounded-xl border border-gray-200 px-4 py-2.5 text-xs font-bold text-gray-600 transition hover:bg-gray-50"
                    >
                        Clear Filters
                    </a>

                @else

                    <a
                        href="{{ route('vendors.create') }}"
                        class="mt-5 inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-xs font-bold text-white transition hover:bg-[#c52f52]"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-width="2"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        Add First Vendor
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>

@endsection