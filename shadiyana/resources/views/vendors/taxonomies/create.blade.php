@extends('layouts.app')

@section('title', 'Assign Taxonomies')

@section('content')

<div
    class="mx-auto max-w-5xl space-y-6"
    x-data="{
        selected: @js(old('taxonomy_ids', [])),
        selectAll: false,

        toggleAll() {
            const checkboxes = document.querySelectorAll('.taxonomy-checkbox');

            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.selectAll;

                if (this.selectAll) {
                    if (!this.selected.includes(checkbox.value)) {
                        this.selected.push(checkbox.value);
                    }
                } else {
                    this.selected = [];
                }
            });
        },

        updateSelectAll() {
            const checkboxes = document.querySelectorAll('.taxonomy-checkbox');

            this.selected = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            this.selectAll =
                checkboxes.length > 0 &&
                Array.from(checkboxes).every(checkbox => checkbox.checked);
        }
    }"
>

    {{-- ============================================================
        Breadcrumbs
    ============================================================= --}}
    <div>
        <nav class="flex flex-wrap items-center gap-2 text-sm">

            <a
                href="{{ route('dashboard') }}"
                class="font-medium text-gray-400 transition hover:text-[#D7385E]"
            >
                Dashboard
            </a>

            <svg
                class="h-4 w-4 text-gray-300"
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
                href="{{ route('vendors.index') }}"
                class="font-medium text-gray-400 transition hover:text-[#D7385E]"
            >
                Vendors
            </a>

            <svg
                class="h-4 w-4 text-gray-300"
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
                class="max-w-[180px] truncate font-medium text-gray-400 transition hover:text-[#D7385E]"
            >
                {{ $vendor->business_name }}
            </a>

            <svg
                class="h-4 w-4 text-gray-300"
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

            <span class="font-semibold text-gray-700">
                Assign Taxonomies
            </span>

        </nav>
    </div>


    {{-- ============================================================
        Header
    ============================================================= --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 7a3 3 0 013-3h10a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7z
                               M8 8h8M8 12h5M8 16h3"
                        />
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">
                        Assign Taxonomies
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Select one or more taxonomies for
                        <span class="font-semibold text-gray-700">
                            {{ $vendor->business_name }}
                        </span>.
                    </p>
                </div>

            </div>

        </div>


        {{-- Back --}}
        <a
            href="{{ route('vendors.taxonomies.index', $vendor) }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900"
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

            Back to Taxonomies

        </a>

    </div>


    {{-- ============================================================
        Vendor Information
    ============================================================= --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-100 bg-gray-50/70 px-5 py-4 sm:px-6">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-sm font-extrabold text-[#D7385E]"
                >
                    {{ strtoupper(substr($vendor->business_name ?? 'V', 0, 1)) }}
                </div>

                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Vendor
                    </p>

                    <h2 class="truncate text-sm font-bold text-gray-900 sm:text-base">
                        {{ $vendor->business_name }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="px-5 py-4 sm:px-6">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <div>
                    <p class="text-xs font-medium text-gray-400">
                        Vendor ID
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-700">
                        #{{ $vendor->id }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-400">
                        Owner
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gray-700">
                        {{ $vendor->user?->first_name }}
                        {{ $vendor->user?->last_name }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-400">
                        Status
                    </p>

                    <span
                        class="mt-1 inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold
                        {{
                            $vendor->status === 'active'
                                ? 'bg-green-50 text-green-700'
                                : 'bg-gray-100 text-gray-600'
                        }}"
                    >
                        {{ ucfirst($vendor->status ?? 'Unknown') }}
                    </span>
                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        Validation Errors
    ============================================================= --}}
    @if($errors->any())

        <div class="rounded-2xl border border-red-200 bg-red-50 p-4">

            <div class="flex gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.73 3h17.6a2 2 0 001.73-3l-8.82-15a2 2 0 00-3.46 0z"
                    />
                </svg>

                <div>

                    <h3 class="text-sm font-bold text-red-800">
                        Please correct the following errors:
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
        Assign Form
    ============================================================= --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-base font-bold text-gray-900">
                        Select Taxonomies
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Choose all taxonomies that should be associated with this vendor.
                    </p>

                </div>

                @if($taxonomies->isNotEmpty())

                    <div
                        class="inline-flex items-center rounded-full bg-[#FBEBEF] px-3 py-1.5 text-xs font-bold text-[#D7385E]"
                    >
                        <span x-text="selected.length"></span>
                        <span class="ml-1">
                            selected
                        </span>
                    </div>

                @endif

            </div>

        </div>


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('vendors.taxonomies.store', $vendor) }}"
        >

            @csrf

            @if($taxonomies->isNotEmpty())

                <div class="px-5 py-6 sm:px-6">

                    {{-- ====================================================
                        Selection Toolbar
                    ===================================================== --}}
                    <div class="mb-5 flex flex-col gap-3 rounded-xl border border-gray-200 bg-gray-50/70 p-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-sm font-bold text-gray-800">
                                Available Taxonomies
                            </p>

                            <p class="mt-0.5 text-xs text-gray-500">
                                {{ $taxonomies->count() }}
                                {{ Str::plural('taxonomy', $taxonomies->count()) }}
                                available for assignment.
                            </p>

                        </div>

                        <label class="inline-flex cursor-pointer items-center gap-2">

                            <input
                                type="checkbox"
                                x-model="selectAll"
                                @change="toggleAll()"
                                class="h-4 w-4 rounded border-gray-300 text-[#D7385E] focus:ring-[#D7385E]"
                            >

                            <span class="text-sm font-semibold text-gray-700">
                                Select All
                            </span>

                        </label>

                    </div>


                    {{-- ====================================================
                        Taxonomy List
                    ===================================================== --}}
                    <div class="space-y-3">

                        @foreach($taxonomies as $taxonomy)

                            @php
                                $isChecked = in_array(
                                    (string) $taxonomy->id,
                                    array_map('strval', old('taxonomy_ids', [])),
                                    true
                                );
                            @endphp

                            <label
                                class="group flex cursor-pointer items-start gap-4 rounded-xl border border-gray-200 bg-white p-4 transition hover:border-[#D7385E]/40 hover:bg-[#FBEBEF]/30"
                            >

                                <input
                                    type="checkbox"
                                    name="taxonomy_ids[]"
                                    value="{{ $taxonomy->id }}"
                                    class="taxonomy-checkbox mt-1 h-4 w-4 shrink-0 rounded border-gray-300 text-[#D7385E] focus:ring-[#D7385E]"
                                    @checked($isChecked)
                                    @change="updateSelectAll()"
                                >

                                <div class="min-w-0 flex-1">

                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                                        <div>

                                            <p class="text-sm font-bold text-gray-900">
                                                {{ $taxonomy->name }}
                                            </p>

                                            @if($taxonomy->parent)

                                                <p class="mt-1 text-xs text-gray-400">

                                                    <span class="font-medium">
                                                        Parent:
                                                    </span>

                                                    {{ $taxonomy->parent->name }}

                                                </p>

                                            @else

                                                <p class="mt-1 text-xs text-gray-400">
                                                    Top-level taxonomy
                                                </p>

                                            @endif

                                        </div>

                                        <span
                                            class="inline-flex w-fit shrink-0 rounded-full bg-gray-100 px-2.5 py-1 text-[11px] font-bold text-gray-500"
                                        >
                                            #{{ $taxonomy->id }}
                                        </span>

                                    </div>

                                </div>

                            </label>

                        @endforeach

                    </div>

                </div>


                {{-- ========================================================
                    Information
                ========================================================= --}}
                <div class="mx-5 mb-6 rounded-xl bg-[#FBEBEF] p-4 sm:mx-6">

                    <div class="flex gap-3">

                        <svg
                            class="mt-0.5 h-5 w-5 shrink-0 text-[#D7385E]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                d="M12 16v-4m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                        <div>

                            <p class="text-sm font-bold text-[#D7385E]">
                                About taxonomy assignments
                            </p>

                            <p class="mt-1 text-xs leading-5 text-gray-600">
                                You can select multiple taxonomies at once.
                                Taxonomies already assigned to this vendor are
                                automatically excluded from this list.
                                Assigning a taxonomy does not modify the original
                                taxonomy record.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ========================================================
                    Form Actions
                ========================================================= --}}
                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/50 px-5 py-4 sm:flex-row sm:items-center sm:justify-end sm:px-6">

                    <a
                        href="{{ route('vendors.taxonomies.index', $vendor) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-900"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        :disabled="selected.length === 0"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        <span>
                            Assign
                            <span x-show="selected.length > 0">
                                (<span x-text="selected.length"></span>)
                            </span>
                            Taxonomies
                        </span>

                    </button>

                </div>

            @else

                {{-- ========================================================
                    No Taxonomies Available
                ========================================================= --}}
                <div class="px-5 py-6 sm:px-6">

                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-5">

                        <div class="flex gap-3">

                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0 text-amber-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.73 3h17.6a2 2 0 001.73-3l-8.82-15a2 2 0 00-3.46 0z"
                                />
                            </svg>

                            <div>

                                <p class="text-sm font-bold text-amber-800">
                                    No taxonomies available
                                </p>

                                <p class="mt-1 text-xs leading-5 text-amber-700">
                                    All available taxonomies have already been
                                    assigned to this vendor.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex justify-end border-t border-gray-100 bg-gray-50/50 px-5 py-4 sm:px-6">

                    <a
                        href="{{ route('vendors.taxonomies.index', $vendor) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-900"
                    >
                        Back to Taxonomies
                    </a>

                </div>

            @endif

        </form>

    </div>

</div>

@endsection

