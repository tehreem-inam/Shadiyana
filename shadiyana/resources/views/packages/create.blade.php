@extends('layouts.app')

@section('title', 'Create Package')

@section('content')

<div
    x-data="packageForm()"
    class="mx-auto w-full max-w-7xl px-4 pb-32 sm:px-6 lg:px-8"
>

    {{-- ============================================================
        BREADCRUMB
    ============================================================= --}}
    <div class="flex items-center gap-2 pt-2 text-sm">

        <a
            href="{{ route('vendors.packages.index', ['vendor' => $vendor]) }}"
            class="text-gray-400 transition hover:text-[#D7385E]"
        >
            Packages
        </a>

        <svg
            class="h-4 w-4 shrink-0 text-gray-300"
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
            Create Package
        </span>

    </div>


    {{-- ============================================================
        HEADER
    ============================================================= --}}
    <div class="mt-6 mb-6 rounded-3xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">

        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex min-w-0 items-center gap-4">

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

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
                            d="M20 7.5L12 3 4 7.5m16 0v9L12 21l-8-4.5v-9m16 0L12 12 4 7.5M12 12v9"
                        />
                    </svg>

                </div>

                <div class="min-w-0">

                    <h1 class="text-xl font-bold text-gray-900 sm:text-2xl">
                        Create Package
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Create a package for
                        <span class="font-semibold text-gray-700">
                            {{ $vendor->business_name }}
                        </span>
                    </p>

                </div>

            </div>


            <a
                href="{{ route('vendors.packages.index', ['vendor' => $vendor]) }}"
                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
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
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Back

            </a>

        </div>

    </div>


    {{-- ============================================================
        ERRORS
    ============================================================= --}}
    @if ($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

            <div class="flex items-start gap-3">

                <div class="mt-0.5 shrink-0 text-red-500">

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
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3.14l-7.5-13a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-sm font-bold text-red-800">
                        Please fix the following errors
                    </p>

                    <ul class="mt-2 space-y-1 text-sm text-red-700">

                        @foreach ($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <form
        action="{{ route('vendors.packages.store', ['vendor' => $vendor]) }}"
        method="POST"
        @submit="submitting = true"
    >

        @csrf


        {{-- ========================================================
            PACKAGE INFORMATION
        ========================================================= --}}
        <section class="mb-6 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <h2 class="text-base font-bold text-gray-900">
                    Package Information
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Basic information about your package.
                </p>

            </div>


            <div class="grid gap-6 p-5 sm:p-6 lg:grid-cols-2">

                {{-- Name --}}
                <div class="lg:col-span-2">

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Package Name
                        <span class="text-[#D7385E]">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        maxlength="255"
                        placeholder="e.g. Premium Wedding Package"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                    >

                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="lg:col-span-2">

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Describe what customers will receive..."
                        class="w-full resize-y rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1.5 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Duration --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Duration
                    </label>

                    <input
                        type="text"
                        name="duration"
                        value="{{ old('duration') }}"
                        maxlength="255"
                        placeholder="e.g. 8 hours"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                    >

                </div>


                {{-- Guests --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Guest Capacity
                    </label>

                    <input
                        type="number"
                        name="guest_capacity"
                        value="{{ old('guest_capacity') }}"
                        min="1"
                        placeholder="e.g. 300"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                    >

                </div>

            </div>

        </section>


        {{-- ========================================================
            PRICING
        ========================================================= --}}
        <section class="mb-6 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <h2 class="text-base font-bold text-gray-900">
                    Package Pricing
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Select how you want to display your package price.
                </p>

            </div>


            <div class="p-5 sm:p-6">

                {{-- ==================================================
                    PRICING TYPE
                =================================================== --}}
                <div>

                    <label class="mb-3 block text-sm font-semibold text-gray-700">
                        Pricing Type
                        <span class="text-[#D7385E]">*</span>
                    </label>


                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-5">

                        @php
                            $pricingOptions = [
                                [
                                    'value' => 'fixed',
                                    'title' => 'Fixed Price',
                                    'description' => 'One complete price for the package.',
                                    'symbol' => '₨',
                                ],
                                [
                                    'value' => 'starting_from',
                                    'title' => 'Starting From',
                                    'description' => 'Show the minimum starting price.',
                                    'symbol' => '↗',
                                ],
                                [
                                    'value' => 'price_range',
                                    'title' => 'Price Range',
                                    'description' => 'Show minimum and maximum price.',
                                    'symbol' => '↔',
                                ],
                                [
                                    'value' => 'per_person',
                                    'title' => 'Per Person',
                                    'description' => 'Charge according to each guest.',
                                    'symbol' => 'P',
                                ],
                                [
                                    'value' => 'custom',
                                    'title' => 'Custom',
                                    'description' => 'Discuss the price directly.',
                                    'symbol' => '…',
                                ],
                            ];
                        @endphp


                        @foreach ($pricingOptions as $option)

                            <button
                                type="button"
                                @click="setPricingType('{{ $option['value'] }}')"
                                :class="pricingType === '{{ $option['value'] }}'
                                    ? 'border-[#D7385E] bg-[#FBEBEF] shadow-sm'
                                    : 'border-gray-200 bg-white hover:border-gray-300'"
                                class="relative min-h-[145px] rounded-2xl border p-4 text-left transition"
                            >

                                <div class="flex items-start justify-between gap-3">

                                    <div
                                        :class="pricingType === '{{ $option['value'] }}'
                                            ? 'bg-[#D7385E] text-white'
                                            : 'bg-gray-100 text-gray-500'"
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-sm font-bold"
                                    >
                                        {{ $option['symbol'] }}
                                    </div>


                                    <div
                                        :class="pricingType === '{{ $option['value'] }}'
                                            ? 'border-[#D7385E] bg-[#D7385E] text-white'
                                            : 'border-gray-300 bg-white text-transparent'"
                                        class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border"
                                    >

                                        <svg
                                            class="h-3 w-3"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 12l4 4L19 6"
                                            />
                                        </svg>

                                    </div>

                                </div>


                                <div class="mt-5">

                                    <p class="text-sm font-bold leading-5 text-gray-900">
                                        {{ $option['title'] }}
                                    </p>

                                    <p class="mt-1.5 text-xs leading-5 text-gray-500">
                                        {{ $option['description'] }}
                                    </p>

                                </div>

                            </button>

                        @endforeach

                    </div>


                    <input
                        type="hidden"
                        name="pricing_type"
                        x-model="pricingType"
                    >

                    @error('pricing_type')
                        <p class="mt-2 text-xs font-medium text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- ==================================================
                    PRICE INPUT AREA
                =================================================== --}}
                <div class="mt-6 rounded-2xl border border-gray-200 bg-gray-50 p-5 sm:p-6">

                    {{-- Fixed --}}
                    <div
                        x-show="pricingType === 'fixed'"
                        x-cloak
                    >

                        <div class="max-w-lg">

                            <div class="mb-4">

                                <h3 class="text-sm font-bold text-gray-900">
                                    Fixed Package Price
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-gray-500">
                                    Enter the complete price customers will pay for this package.
                                </p>

                            </div>


                            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Amount
                            </label>

                            <div class="flex overflow-hidden rounded-xl border border-gray-200 bg-white focus-within:border-[#D7385E] focus-within:ring-4 focus-within:ring-[#D7385E]/10">

                                <div class="flex shrink-0 items-center border-r border-gray-200 bg-gray-50 px-4 text-sm font-bold text-gray-500">
                                    PKR
                                </div>

                                <input
                                    type="number"
                                    name="price"
                                    x-model="price"
                                    min="0"
                                    step="0.01"
                                    placeholder="0.00"
                                    class="min-w-0 flex-1 border-0 px-4 py-3.5 text-sm font-semibold text-gray-900 outline-none focus:ring-0"
                                >

                            </div>

                            @error('price')
                                <p class="mt-1.5 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Starting From --}}
                    <div
                        x-show="pricingType === 'starting_from'"
                        x-cloak
                    >

                        <div class="max-w-lg">

                            <div class="mb-4">

                                <h3 class="text-sm font-bold text-gray-900">
                                    Starting Price
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-gray-500">
                                    Customers will see this amount as the starting price.
                                </p>

                            </div>


                            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Starting From
                            </label>

                            <div class="flex overflow-hidden rounded-xl border border-gray-200 bg-white focus-within:border-[#D7385E] focus-within:ring-4 focus-within:ring-[#D7385E]/10">

                                <div class="flex shrink-0 items-center border-r border-gray-200 bg-gray-50 px-4 text-sm font-bold text-gray-500">
                                    PKR
                                </div>

                                <input
                                    type="number"
                                    name="min_price"
                                    x-model="minPrice"
                                    min="0"
                                    step="0.01"
                                    placeholder="50,000"
                                    class="min-w-0 flex-1 border-0 px-4 py-3.5 text-sm font-semibold text-gray-900 outline-none focus:ring-0"
                                >

                            </div>

                            @error('min_price')
                                <p class="mt-1.5 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Price Range --}}
                    <div
                        x-show="pricingType === 'price_range'"
                        x-cloak
                    >

                        <div class="mb-5">

                            <h3 class="text-sm font-bold text-gray-900">
                                Package Price Range
                            </h3>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                Set the lowest and highest possible price for this package.
                            </p>

                        </div>


                        <div class="grid gap-5 md:grid-cols-2">

                            {{-- Minimum --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Minimum Price
                                </label>

                                <div class="flex overflow-hidden rounded-xl border border-gray-200 bg-white focus-within:border-[#D7385E] focus-within:ring-4 focus-within:ring-[#D7385E]/10">

                                    <div class="flex shrink-0 items-center border-r border-gray-200 bg-gray-50 px-4 text-sm font-bold text-gray-500">
                                        PKR
                                    </div>

                                    <input
                                        type="number"
                                        name="min_price"
                                        x-model="minPrice"
                                        min="0"
                                        step="0.01"
                                        placeholder="50,000"
                                        class="min-w-0 flex-1 border-0 px-4 py-3.5 text-sm font-semibold text-gray-900 outline-none focus:ring-0"
                                    >

                                </div>

                                @error('min_price')
                                    <p class="mt-1.5 text-xs text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Maximum --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Maximum Price
                                </label>

                                <div class="flex overflow-hidden rounded-xl border border-gray-200 bg-white focus-within:border-[#D7385E] focus-within:ring-4 focus-within:ring-[#D7385E]/10">

                                    <div class="flex shrink-0 items-center border-r border-gray-200 bg-gray-50 px-4 text-sm font-bold text-gray-500">
                                        PKR
                                    </div>

                                    <input
                                        type="number"
                                        name="max_price"
                                        x-model="maxPrice"
                                        min="0"
                                        step="0.01"
                                        placeholder="150,000"
                                        class="min-w-0 flex-1 border-0 px-4 py-3.5 text-sm font-semibold text-gray-900 outline-none focus:ring-0"
                                    >

                                </div>

                                @error('max_price')
                                    <p class="mt-1.5 text-xs text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- Range Preview --}}
                        <div
                            x-show="minPrice || maxPrice"
                            x-cloak
                            class="mt-5 rounded-xl border border-[#D7385E]/10 bg-[#FBEBEF] px-4 py-3"
                        >

                            <div class="flex flex-wrap items-center gap-2 text-sm">

                                <span class="font-medium text-gray-600">
                                    Customer-facing range:
                                </span>

                                <span class="font-bold text-[#D7385E]">
                                    PKR
                                    <span x-text="formatPrice(minPrice) || '0'"></span>
                                </span>

                                <span class="text-gray-400">
                                    —
                                </span>

                                <span class="font-bold text-[#D7385E]">
                                    PKR
                                    <span x-text="formatPrice(maxPrice) || '0'"></span>
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Per Person --}}
                    <div
                        x-show="pricingType === 'per_person'"
                        x-cloak
                    >

                        <div class="max-w-lg">

                            <div class="mb-4">

                                <h3 class="text-sm font-bold text-gray-900">
                                    Price Per Person
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-gray-500">
                                    Enter the amount charged for each guest.
                                </p>

                            </div>


                            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Price Per Guest
                            </label>

                            <div class="flex overflow-hidden rounded-xl border border-gray-200 bg-white focus-within:border-[#D7385E] focus-within:ring-4 focus-within:ring-[#D7385E]/10">

                                <div class="flex shrink-0 items-center border-r border-gray-200 bg-gray-50 px-4 text-sm font-bold text-gray-500">
                                    PKR
                                </div>

                                <input
                                    type="number"
                                    name="price"
                                    x-model="price"
                                    min="0"
                                    step="0.01"
                                    placeholder="2,500"
                                    class="min-w-0 flex-1 border-0 px-4 py-3.5 text-sm font-semibold text-gray-900 outline-none focus:ring-0"
                                >

                                <div class="flex shrink-0 items-center border-l border-gray-200 bg-gray-50 px-4 text-xs font-semibold text-gray-400">
                                    / person
                                </div>

                            </div>

                            @error('price')
                                <p class="mt-1.5 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Custom --}}
                    <div
                        x-show="pricingType === 'custom'"
                        x-cloak
                    >

                        <div class="flex max-w-2xl items-start gap-4 rounded-2xl border border-gray-200 bg-white p-5">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

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
                                        d="M8 10h8M8 14h5m-1 7a9 9 0 110-18 9 9 0 010 18z"
                                    />
                                </svg>

                            </div>

                            <div class="min-w-0">

                                <h3 class="text-sm font-bold text-gray-900">
                                    Custom Pricing
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-gray-500">
                                    No amount will be displayed. Customers can contact
                                    your business to discuss the package price.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================
            SERVICES
        ========================================================= --}}
        <section class="mb-6 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="text-base font-bold text-gray-900">
                            Included Services
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Select services that are included in this package.
                        </p>

                    </div>


                    <div
                        x-show="services.length > 0"
                        x-cloak
                        class="w-fit rounded-full bg-[#FBEBEF] px-3 py-1 text-xs font-bold text-[#D7385E]"
                    >
                        <span x-text="services.length"></span>
                        selected
                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                {{-- Search --}}
                <div class="relative mb-5">

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
                        x-model="serviceSearch"
                        placeholder="Search services..."
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3.5 pl-12 pr-4 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                    >

                </div>


                @if ($services->count())

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">

                        @foreach ($services as $service)

                            <button
                                type="button"
                                @click="toggleService({{ $service->id }}, @js($service->name))"
                                x-show="matchesService({{ $service->id }})"
                                :class="isServiceSelected({{ $service->id }})
                                    ? 'border-[#D7385E] bg-[#FBEBEF]'
                                    : 'border-gray-200 bg-white hover:border-gray-300'"
                                class="flex min-h-[62px] w-full items-center gap-3 rounded-xl border p-3.5 text-left transition"
                            >

                                <div
                                    :class="isServiceSelected({{ $service->id }})
                                        ? 'border-[#D7385E] bg-[#D7385E] text-white'
                                        : 'border-gray-300 bg-white text-transparent'"
                                    class="flex h-5 w-5 shrink-0 items-center justify-center rounded-md border"
                                >

                                    <svg
                                        class="h-3 w-3"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 12l4 4L19 6"
                                        />
                                    </svg>

                                </div>

                                <span class="min-w-0 flex-1 break-words text-sm font-semibold text-gray-700">
                                    {{ $service->name }}
                                </span>

                            </button>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-6 py-10 text-center">

                        <p class="text-sm font-semibold text-gray-700">
                            No active services available
                        </p>

                        <p class="mt-1 text-xs text-gray-400">
                            Add active services before creating a package.
                        </p>

                    </div>

                @endif


                {{-- Selected services --}}
                <div
                    x-show="services.length"
                    x-cloak
                    class="mt-7 border-t border-gray-100 pt-6"
                >

                    <div class="mb-4">

                        <h3 class="text-sm font-bold text-gray-900">
                            Selected Services
                        </h3>

                        <p class="mt-1 text-xs text-gray-400">
                            Add quantity and optional details for each service.
                        </p>

                    </div>


                    <div class="space-y-3">

                        <template
                            x-for="(service, index) in services"
                            :key="service.service_id"
                        >

                            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">

                                <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_130px_minmax(0,1.5fr)_44px]">

                                    {{-- Service --}}
                                    <div class="min-w-0">

                                        <label class="mb-2 block text-xs font-semibold text-gray-500">
                                            Service
                                        </label>

                                        <div class="flex min-h-[44px] items-center rounded-xl border border-gray-200 bg-white px-3">

                                            <span
                                                class="break-words text-sm font-semibold text-gray-800"
                                                x-text="service.name"
                                            ></span>

                                        </div>

                                        <input
                                            type="hidden"
                                            :name="`services[${index}][service_id]`"
                                            :value="service.service_id"
                                        >

                                    </div>


                                    {{-- Quantity --}}
                                    <div>

                                        <label class="mb-2 block text-xs font-semibold text-gray-500">
                                            Quantity
                                        </label>

                                        <input
                                            type="number"
                                            min="1"
                                            :name="`services[${index}][quantity]`"
                                            x-model="service.quantity"
                                            class="min-h-[44px] w-full rounded-xl border border-gray-200 bg-white px-3 text-sm font-semibold text-gray-900 outline-none focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                                        >

                                    </div>


                                    {{-- Description --}}
                                    <div class="min-w-0">

                                        <label class="mb-2 block text-xs font-semibold text-gray-500">
                                            Description
                                        </label>

                                        <input
                                            type="text"
                                            maxlength="1000"
                                            :name="`services[${index}][description]`"
                                            x-model="service.description"
                                            placeholder="Optional details..."
                                            class="min-h-[44px] w-full rounded-xl border border-gray-200 bg-white px-3 text-sm text-gray-900 outline-none placeholder:text-gray-400 focus:border-[#D7385E] focus:ring-4 focus:ring-[#D7385E]/10"
                                        >

                                    </div>


                                    {{-- Remove --}}
                                    <div class="flex items-end">

                                        <button
                                            type="button"
                                            @click="removeService(index)"
                                            class="flex h-11 w-full items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-400 transition hover:border-red-200 hover:bg-red-50 hover:text-red-500 lg:w-11"
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
                                                    stroke-width="1.8"
                                                    d="M6 7h12M10 11v6m4-6v6M9 7l1-3h4l1 3m-8 0l1 14h8l1-14"
                                                />
                                            </svg>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </template>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================
            STATUS
        ========================================================= --}}
        <section class="mb-6 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                <h2 class="text-base font-bold text-gray-900">
                    Publishing Status
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Choose whether customers can see this package.
                </p>

            </div>


            <div class="grid gap-4 p-5 sm:p-6 md:grid-cols-2">

                {{-- Active --}}
                <label class="block cursor-pointer">

                    <input
                        type="radio"
                        name="status"
                        value="active"
                        class="peer sr-only"
                        {{ old('status', 'active') === 'active' ? 'checked' : '' }}
                    >

                    <div class="flex min-h-[125px] items-start gap-4 rounded-2xl border border-gray-200 bg-white p-5 transition hover:border-gray-300 peer-checked:border-emerald-300 peer-checked:bg-emerald-50">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

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


                        <div class="min-w-0 flex-1">

                            <div class="flex flex-wrap items-center gap-2">

                                <h3 class="text-sm font-bold text-gray-900">
                                    Active
                                </h3>

                                <span class="rounded-full bg-emerald-100 px-2 py-0.5 text-[10px] font-bold uppercase text-emerald-700">
                                    Visible
                                </span>

                            </div>

                            <p class="mt-2 text-sm leading-5 text-gray-500">
                                Customers can view and inquire about this package.
                            </p>

                        </div>


                        <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-gray-300 text-transparent peer-checked:border-emerald-500 peer-checked:bg-emerald-500 peer-checked:text-white">

                            <svg
                                class="h-3 w-3"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 12l4 4L19 6"
                                />
                            </svg>

                        </div>

                    </div>

                </label>


                {{-- Inactive --}}
                <label class="block cursor-pointer">

                    <input
                        type="radio"
                        name="status"
                        value="inactive"
                        class="peer sr-only"
                        {{ old('status') === 'inactive' ? 'checked' : '' }}
                    >

                    <div class="flex min-h-[125px] items-start gap-4 rounded-2xl border border-gray-200 bg-white p-5 transition hover:border-gray-300 peer-checked:border-gray-400 peer-checked:bg-gray-50">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-500">

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
                                    d="M18 12H6"
                                />
                            </svg>

                        </div>


                        <div class="min-w-0 flex-1">

                            <div class="flex flex-wrap items-center gap-2">

                                <h3 class="text-sm font-bold text-gray-900">
                                    Inactive
                                </h3>

                                <span class="rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-bold uppercase text-gray-500">
                                    Hidden
                                </span>

                            </div>

                            <p class="mt-2 text-sm leading-5 text-gray-500">
                                Keep the package saved but hide it from customers.
                            </p>

                        </div>


                        <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-gray-300 text-transparent peer-checked:border-gray-600 peer-checked:bg-gray-600 peer-checked:text-white">

                            <svg
                                class="h-3 w-3"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 12l4 4L19 6"
                                />
                            </svg>

                        </div>

                    </div>

                </label>

            </div>

        </section>


        {{-- ========================================================
            ACTION BAR
        ========================================================= --}}
        <div class="fixed inset-x-0 bottom-0 z-40 border-t border-gray-200 bg-white/95 shadow-lg backdrop-blur">

            <div class="mx-auto flex max-w-7xl items-center justify-end gap-3 px-4 py-3 sm:px-6 lg:px-8">

                <a
                    href="{{ route('vendors.packages.index', ['vendor' => $vendor]) }}"
                    class="rounded-xl border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    :disabled="submitting"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#C52F52] focus:outline-none focus:ring-4 focus:ring-[#D7385E]/20 disabled:cursor-not-allowed disabled:opacity-70"
                >

                    <svg
                        x-show="submitting"
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
                        />

                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                        />
                    </svg>

                    <svg
                        x-show="!submitting"
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    <span x-text="submitting ? 'Creating...' : 'Create Package'"></span>

                </button>

            </div>

        </div>

    </form>

</div>


{{-- ================================================================
    ALPINE
================================================================ --}}
@push('scripts')

<script>

function packageForm() {

    return {

        /*
        |--------------------------------------------------------------------------
        | Pricing
        |--------------------------------------------------------------------------
        */

        pricingType: @js(old('pricing_type', 'fixed')),

        price: @js(old('price', '')),

        minPrice: @js(old('min_price', '')),

        maxPrice: @js(old('max_price', '')),


        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        serviceSearch: '',

        services: @js(
            collect(old('services', []))
                ->map(function ($service) use ($services) {

                    $serviceModel = $services->firstWhere(
                        'id',
                        $service['service_id'] ?? null
                    );

                    return [
                        'service_id' => (int) ($service['service_id'] ?? 0),
                        'name' => $serviceModel?->name ?? 'Selected Service',
                        'quantity' => (int) ($service['quantity'] ?? 1),
                        'description' => $service['description'] ?? '',
                    ];

                })
                ->values()
        ),

        availableServices: @js(
            $services->map(function ($service) {

                return [
                    'id' => $service->id,
                    'name' => $service->name,
                ];

            })->values()
        ),


        /*
        |--------------------------------------------------------------------------
        | Form
        |--------------------------------------------------------------------------
        */

        submitting: false,


        /*
        |--------------------------------------------------------------------------
        | Pricing Type
        |--------------------------------------------------------------------------
        */

        setPricingType(type) {

            this.pricingType = type;

            /*
             * Clear values that do not belong to the selected
             * pricing structure.
             */
            if (type === 'fixed' || type === 'per_person') {

                this.minPrice = '';
                this.maxPrice = '';

            }

            if (type === 'starting_from') {

                this.price = '';
                this.maxPrice = '';

            }

            if (type === 'price_range') {

                this.price = '';

            }

            if (type === 'custom') {

                this.price = '';
                this.minPrice = '';
                this.maxPrice = '';

            }

        },


        /*
        |--------------------------------------------------------------------------
        | Price Formatting
        |--------------------------------------------------------------------------
        */

        formatPrice(value) {

            if (!value) {
                return '';
            }

            const number = Number(value);

            if (Number.isNaN(number)) {
                return '';
            }

            return new Intl.NumberFormat('en-PK').format(number);

        },


        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        matchesService(id) {

            const service = this.availableServices.find(
                item => Number(item.id) === Number(id)
            );

            if (!service) {
                return false;
            }

            return service.name
                .toLowerCase()
                .includes(this.serviceSearch.toLowerCase());

        },


        isServiceSelected(id) {

            return this.services.some(
                service => Number(service.service_id) === Number(id)
            );

        },


        toggleService(id, name) {

            const index = this.services.findIndex(
                service => Number(service.service_id) === Number(id)
            );

            if (index !== -1) {

                this.services.splice(index, 1);

                return;

            }

            this.services.push({

                service_id: Number(id),

                name: name,

                quantity: 1,

                description: '',

            });

        },


        removeService(index) {

            this.services.splice(index, 1);

        },

    };

}

</script>

@endpush

@endsection