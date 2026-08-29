@extends('layouts.app')

@section('title', 'Edit Vendor Taxonomy')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

```
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

        <svg class="h-4 w-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

        <svg class="h-4 w-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

        <svg class="h-4 w-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
            />
        </svg>

        <a
            href="{{ route('vendors.taxonomies.index', $vendor) }}"
            class="font-medium text-gray-400 transition hover:text-[#D7385E]"
        >
            Taxonomies
        </a>

        <svg class="h-4 w-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
            />
        </svg>

        <span class="font-semibold text-gray-700">
            Edit
        </span>

    </nav>
</div>


{{-- ============================================================
    Header
============================================================= --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div class="flex items-center gap-3">

        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                       M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                />
            </svg>

        </div>

        <div class="min-w-0">

            <h1 class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">
                Edit Vendor Taxonomy
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Change the taxonomy assigned to
                <span class="font-semibold text-gray-700">
                    {{ $vendor->business_name }}
                </span>.
            </p>

        </div>

    </div>


    <a
        href="{{ route('vendors.taxonomies.index', $vendor) }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-600 transition hover:border-[#D7385E]/30 hover:bg-[#FBEBEF] hover:text-[#D7385E] focus:outline-none focus:ring-2 focus:ring-[#D7385E]/20"
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
    Validation Errors
============================================================= --}}
@if($errors->any())

    <div class="rounded-2xl border border-red-200 bg-red-50 p-4">

        <div class="flex items-start gap-3">

            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">

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
                        d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z"
                    />
                </svg>

            </div>

            <div class="min-w-0">

                <p class="text-sm font-bold text-red-800">
                    Please fix the following error
                </p>

                <ul class="mt-1 list-disc space-y-1 pl-5 text-sm text-red-700">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif


{{-- ============================================================
    Current Assignment
============================================================= --}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    <div class="border-b border-gray-100 bg-gray-50/70 px-5 py-4 sm:px-6">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]">

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
                        d="M7 7h10M7 12h10M7 17h6"
                    />
                </svg>

            </div>

            <div class="min-w-0">

                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Current Assignment
                </p>

                <h2 class="mt-0.5 truncate text-sm font-bold text-gray-900 sm:text-base">
                    {{ $vendorTaxonomy->taxonomy?->name ?? 'Unknown Taxonomy' }}
                </h2>

            </div>

        </div>

    </div>


    <div class="px-5 py-5 sm:px-6">

        <div class="grid gap-4 sm:grid-cols-2">

            <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Vendor
                </p>

                <p class="mt-1 text-sm font-bold text-gray-900">
                    {{ $vendor->business_name }}
                </p>

            </div>


            <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Current Taxonomy
                </p>

                <p class="mt-1 text-sm font-bold text-gray-900">
                    {{ $vendorTaxonomy->taxonomy?->name ?? 'Unknown Taxonomy' }}
                </p>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================
    Edit Form
============================================================= --}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

        <h2 class="text-base font-bold text-gray-900">
            Change Taxonomy
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Select a different taxonomy for this vendor.
        </p>

    </div>


    <form
        method="POST"
        action="{{ route('vendors.taxonomies.update', [$vendor, $vendorTaxonomy]) }}"
    >

        @csrf
        @method('PUT')


        <div class="space-y-6 px-5 py-6 sm:px-6">

            {{-- Taxonomy Selection --}}
            <div>

                <label
                    for="taxonomy_id"
                    class="mb-2 block text-sm font-bold text-gray-700"
                >
                    Taxonomy
                    <span class="text-[#D7385E]">*</span>
                </label>

                <select
                    id="taxonomy_id"
                    name="taxonomy_id"
                    required
                    class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#D7385E] focus:ring-2 focus:ring-[#D7385E]/20 @error('taxonomy_id') border-red-300 ring-2 ring-red-100 @enderror"
                >

                    <option value="">
                        Select a taxonomy
                    </option>

                    @php
                        $currentTaxonomyId = old(
                            'taxonomy_id',
                            $vendorTaxonomy->taxonomy_id
                        );
                    @endphp

                    @foreach($taxonomies as $taxonomy)

                        @php
                            $isSelected = (string) $currentTaxonomyId === (string) $taxonomy->id;
                        @endphp

                        <option
                            value="{{ $taxonomy->id }}"
                            @selected($isSelected)
                        >
                            {{ $taxonomy->name }}
                            @if($taxonomy->parent)
                                — {{ $taxonomy->parent->name }}
                            @endif
                        </option>

                    @endforeach

                </select>


                @error('taxonomy_id')

                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>

                @else

                    <p class="mt-2 text-xs text-gray-400">
                        The selected taxonomy will replace the current assignment.
                    </p>

                @enderror

            </div>


            {{-- Selected Taxonomy Preview --}}
            <div class="rounded-2xl border border-[#D7385E]/10 bg-[#FBEBEF] p-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-[#D7385E] shadow-sm">

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
                                d="M7 7h10M7 12h10M7 17h6"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-[#D7385E]">
                            About this assignment
                        </p>

                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            Changing the taxonomy only updates the relationship
                            between this vendor and the taxonomy. The original
                            taxonomy record will not be deleted or modified.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Form Actions --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/50 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <a
                href="{{ route('vendors.taxonomies.index', $vendor) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-600 transition hover:border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2"
            >

                Cancel

            </a>


            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 focus:ring-offset-2"
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
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                Update Taxonomy

            </button>

        </div>

    </form>

</div>


{{-- ============================================================
    Information
============================================================= --}}
<div class="rounded-2xl border border-blue-100 bg-blue-50 p-4">

    <div class="flex items-start gap-3">

        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-100 text-blue-600">

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-width="1.8"
                    d="M12 16v-4m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>

        </div>

        <div>

            <p class="text-sm font-bold text-blue-800">
                Taxonomy assignment
            </p>

            <p class="mt-1 text-sm leading-6 text-blue-700">
                A vendor can only have one assignment for the same taxonomy.
                Selecting a taxonomy already assigned to this vendor will
                prevent the update.
            </p>

        </div>

    </div>

</div>


{{-- ============================================================
    Back Link
============================================================= --}}
<div class="pb-2">

    <a
        href="{{ route('vendors.taxonomies.index', $vendor) }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 transition hover:text-[#D7385E]"
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

        Back to Vendor Taxonomies

    </a>

</div>
```

</div>

@endsection
