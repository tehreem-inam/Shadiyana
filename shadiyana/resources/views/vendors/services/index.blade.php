@extends('layouts.app')

@section('title', 'Vendor Services')

@section('content')

<div class="mx-auto w-full max-w-7xl">

    {{-- ============================================================
        BREADCRUMB
    ============================================================= --}}

    <div class="mb-4 flex flex-wrap items-center gap-2 text-sm text-gray-400">

        <a
            href="{{ route('vendors.index') }}"
            class="transition hover:text-[#D7385E]"
        >
            Vendors
        </a>

        <svg
            class="h-4 w-4 shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
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

        <svg
            class="h-4 w-4 shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.8"
                d="M9 5l7 7-7 7"
            />
        </svg>

        <span class="font-medium text-gray-600">
            Services
        </span>

    </div>


    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6 rounded-3xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            {{-- Left --}}

            <div class="flex min-w-0 items-center gap-4">

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#FBEBEF]">

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
                            d="M5 7h14M5 12h14M5 17h9"
                        />
                    </svg>

                </div>

                <div class="min-w-0">

                    <div class="flex flex-wrap items-center gap-2">

                        <h1 class="text-xl font-bold tracking-tight text-gray-900 sm:text-2xl">
                            Vendor Services
                        </h1>

                        <span class="rounded-full bg-[#FBEBEF] px-2.5 py-1 text-xs font-bold text-[#D7385E]">
                            {{ $vendor->services->count() }}
                        </span>

                    </div>

                    <p class="mt-1 text-sm text-gray-500">
                        Manage services assigned to
                        <span class="font-semibold text-gray-700">
                            {{ $vendor->business_name }}
                        </span>
                    </p>

                </div>

            </div>


            {{-- Actions --}}

            <div class="flex flex-col gap-2 sm:flex-row">

                <a
                    href="{{ route('vendors.show', $vendor) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
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
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>

                    Back to Vendor

                </a>

                <a
                    href="{{ route('vendors.services.create', $vendor) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52] focus:outline-none focus:ring-4 focus:ring-[#D7385E]/20"
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

                    Assign Services

                </a>

            </div>

        </div>

    </div>


    {{-- ============================================================
        FLASH MESSAGE
    ============================================================= --}}

    @if(session('success'))

        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3">

            <div class="flex items-start gap-3">

                <div class="mt-0.5 shrink-0">

                    <svg
                        class="h-5 w-5 text-green-600"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l3-3z"
                            clip-rule="evenodd"
                        />
                    </svg>

                </div>

                <p class="text-sm font-medium text-green-700">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- ============================================================
        VENDOR SUMMARY
    ============================================================= --}}

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- Vendor --}}

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF]">

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
                            d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"
                        />
                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Vendor
                    </p>

                    <p class="mt-0.5 truncate text-sm font-bold text-gray-900">
                        {{ $vendor->business_name }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Total Services --}}

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF]">

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
                            d="M5 7h14M5 12h14M5 17h9"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Assigned Services
                    </p>

                    <p class="mt-0.5 text-xl font-bold text-gray-900">
                        {{ $services->total() }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Status --}}

        @php
            $activeCount = $vendor->services
                ->filter(fn ($service) => ($service->pivot->status ?? 'active') === 'active')
                ->count();

            $inactiveCount = $vendor->services
                ->filter(fn ($service) => ($service->pivot->status ?? 'active') === 'inactive')
                ->count();
        @endphp

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-50">

                    <svg
                        class="h-5 w-5 text-green-600"
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

                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Active / Inactive
                    </p>

                    <div class="mt-1 flex items-center gap-2">

                        <span class="text-sm font-bold text-green-600">
                            {{ $activeCount }} Active
                        </span>

                        <span class="text-gray-300">
                            /
                        </span>

                        <span class="text-sm font-bold text-gray-500">
                            {{ $inactiveCount }} Inactive
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        FILTER / SEARCH BAR
    ============================================================= --}}

    <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <form
            method="GET"
            action="{{ route('vendors.services.index', $vendor) }}"
        >

            <div class="flex flex-col gap-4 p-4 lg:flex-row lg:items-center">

                {{-- Search --}}

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
                            stroke-width="1.8"
                            d="M21 21l-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                        />
                    </svg>

                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search services..."
                        autocomplete="off"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-12 pr-4 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                    >

                </div>


                {{-- Status --}}

                <div class="relative">

                    <select
                        name="status"
                        class="w-full min-w-[170px] appearance-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-10 text-sm font-medium text-gray-700 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                    >

                        <option value="">
                            All Statuses
                        </option>

                        <option
                            value="active"
                            @selected(request('status') === 'active')
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            @selected(request('status') === 'inactive')
                        >
                            Inactive
                        </option>

                    </select>

                    <svg
                        class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 9l6 6 6-6"
                        />
                    </svg>

                </div>


                {{-- Filter --}}

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#c52f52] focus:outline-none focus:ring-4 focus:ring-[#D7385E]/20"
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
                            d="M3 5h18M6 12h12M10 19h4"
                        />
                    </svg>

                    Filter

                </button>


                {{-- Reset --}}

                @if(request()->hasAny(['search', 'status']))

                    <a
                        href="{{ route('vendors.services.index', $vendor) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                    >
                        Reset
                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- ============================================================
        SERVICES
    ============================================================= --}}

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

        {{-- Table Header --}}

        <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-base font-bold text-gray-900">
                        Assigned Services
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Services currently assigned to this vendor.
                    </p>

                </div>

                @if($services->total() > 0)

                    <p class="text-xs font-medium text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-600">
                            {{ $services->firstItem() }}
                        </span>
                        –
                        <span class="font-semibold text-gray-600">
                            {{ $services->lastItem() }}
                        </span>
                        of
                        <span class="font-semibold text-gray-600">
                            {{ $services->total() }}
                        </span>
                    </p>

                @endif

            </div>

        </div>


        @if($services->count())

            {{-- ====================================================
                DESKTOP TABLE
            ===================================================== --}}

            <div class="hidden overflow-x-auto lg:block">

                <table class="w-full min-w-[900px]">

                    <thead>

                        <tr class="border-b border-gray-100 bg-gray-50/70">

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-400">
                                Service
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-400">
                                Custom Name
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-400">
                                Description
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-400">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide text-gray-400">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($services as $service)

                            @php
                                $pivot = $service->pivot;

                                $serviceName = $pivot->custom_name ?: $service->name;

                                $status = $pivot->status ?? 'active';
                            @endphp

                            <tr class="group transition hover:bg-gray-50/70">

                                {{-- Service --}}

                                <td class="px-6 py-5">

                                    <div class="flex min-w-0 items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF]">

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
                                                    d="M5 7h14M5 12h14M5 17h9"
                                                />
                                            </svg>

                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-bold text-gray-900">
                                                {{ $service->name }}
                                            </p>

                                            <p class="mt-0.5 text-xs text-gray-400">
                                                Service #{{ $service->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Custom Name --}}

                                <td class="px-6 py-5">

                                    @if($pivot->custom_name)

                                        <div>

                                            <p class="max-w-[220px] truncate text-sm font-semibold text-gray-800">
                                                {{ $pivot->custom_name }}
                                            </p>

                                            <span class="mt-1 inline-flex rounded-full bg-[#FBEBEF] px-2 py-0.5 text-[10px] font-bold text-[#D7385E]">
                                                Custom
                                            </span>

                                        </div>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Description --}}

                                <td class="px-6 py-5">

                                    @if($pivot->description)

                                        <p class="max-w-[300px] truncate text-sm text-gray-600">
                                            {{ $pivot->description }}
                                        </p>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            No description
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}

                                <td class="px-6 py-5">

                                    @if($status === 'active')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-bold text-green-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                            Active

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-bold text-gray-600">

                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}

                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-2">

                                        <a
                                            href="{{ route('vendors.services.edit', [$vendor, $service]) }}"
                                            class="inline-flex h-9 items-center justify-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 text-xs font-semibold text-gray-600 transition hover:border-[#D7385E]/30 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 3.5a2.121 2.121 0 013 3L12 16l-4 1 1-4 9.5-9.5z"
                                                />
                                            </svg>

                                            Edit

                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('vendors.services.destroy', [$vendor, $service]) }}"
                                            onsubmit="return confirm('Are you sure you want to remove this service from the vendor?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex h-9 items-center justify-center gap-1.5 rounded-lg border border-red-200 bg-white px-3 text-xs font-semibold text-red-500 transition hover:bg-red-50"
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
                                                        d="M6 7h12M10 11v6m4-6v6M9 7l1-3h4l1 3m-8 0l1 14h8l1-14"
                                                    />
                                                </svg>

                                                Remove

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
                MOBILE / TABLET CARDS
            ===================================================== --}}

            <div class="divide-y divide-gray-100 lg:hidden">

                @foreach($services as $service)

                    @php
                        $pivot = $service->pivot;

                        $serviceName = $pivot->custom_name ?: $service->name;

                        $status = $pivot->status ?? 'active';
                    @endphp

                    <div class="p-5 sm:p-6">

                        <div class="flex items-start gap-3">

                            {{-- Icon --}}

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF]">

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
                                        d="M5 7h14M5 12h14M5 17h9"
                                    />
                                </svg>

                            </div>


                            {{-- Content --}}

                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-start justify-between gap-3">

                                    <div class="min-w-0">

                                        <h3 class="break-words text-sm font-bold text-gray-900">
                                            {{ $service->name }}
                                        </h3>

                                        @if($pivot->custom_name)

                                            <div class="mt-1 flex flex-wrap items-center gap-2">

                                                <span class="text-xs text-gray-400">
                                                    Display name:
                                                </span>

                                                <span class="break-words text-xs font-semibold text-[#D7385E]">
                                                    {{ $pivot->custom_name }}
                                                </span>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- Status --}}

                                    @if($status === 'active')

                                        <span class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-bold text-green-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                            Active

                                        </span>

                                    @else

                                        <span class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-bold text-gray-600">

                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                            Inactive

                                        </span>

                                    @endif

                                </div>


                                {{-- Description --}}

                                <div class="mt-4 rounded-xl bg-gray-50 p-3">

                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                        Description
                                    </p>

                                    @if($pivot->description)

                                        <p class="mt-1 text-sm leading-6 text-gray-600">
                                            {{ $pivot->description }}
                                        </p>

                                    @else

                                        <p class="mt-1 text-sm text-gray-400">
                                            No vendor-specific description.
                                        </p>

                                    @endif

                                </div>


                                {{-- Actions --}}

                                <div class="mt-4 flex flex-col gap-2 sm:flex-row">

                                    <a
                                        href="{{ route('vendors.services.edit', [$vendor, $service]) }}"
                                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:border-[#D7385E]/30 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 3.5a2.121 2.121 0 013 3L12 16l-4 1 1-4 9.5-9.5z"
                                            />
                                        </svg>

                                        Edit Service

                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('vendors.services.destroy', [$vendor, $service]) }}"
                                        class="flex-1"
                                        onsubmit="return confirm('Are you sure you want to remove this service from the vendor?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-500 transition hover:bg-red-50"
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
                                                    d="M6 7h12M10 11v6m4-6v6M9 7l1-3h4l1 3m-8 0l1 14h8l1-14"
                                                />
                                            </svg>

                                            Remove

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- ====================================================
                PAGINATION
            ===================================================== --}}

            @if($services->hasPages())

                <div class="border-t border-gray-100 px-5 py-4 sm:px-6">

                    {{ $services->withQueryString()->links() }}

                </div>

            @endif

        @else

            {{-- ====================================================
                EMPTY STATE
            ===================================================== --}}

            <div class="px-6 py-16 text-center sm:py-20">

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
                            d="M5 7h14M5 12h14M5 17h9"
                        />
                    </svg>

                </div>

                <h3 class="mt-5 text-lg font-bold text-gray-900">
                    No Services Found
                </h3>

                @if(request()->hasAny(['search', 'status']))

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        No services match your current search or status filter.
                        Try changing the filters.
                    </p>

                    <div class="mt-6">

                        <a
                            href="{{ route('vendors.services.index', $vendor) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        >
                            Clear Filters
                        </a>

                    </div>

                @else

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        This vendor does not have any services assigned yet.
                        Assign services from the available vendor taxonomies.
                    </p>

                    <div class="mt-6">

                        <a
                            href="{{ route('vendors.services.create', $vendor) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#c52f52]"
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

                            Assign Services

                        </a>

                    </div>

                @endif

            </div>

        @endif

    </div>

</div>

@endsection