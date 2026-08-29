@extends('layouts.app')

@section('title', 'Vendor Taxonomies')

@section('content')

<div
    class="mx-auto max-w-7xl space-y-6"
    x-data="{
        deleteModal: false,
        deleteUrl: '',
        deleteTaxonomy: '',
        deleteForm: null,

        openDeleteModal(url, taxonomy, form) {
            this.deleteUrl = url;
            this.deleteTaxonomy = taxonomy;
            this.deleteForm = form;
            this.deleteModal = true;
        },

        closeDeleteModal() {
            this.deleteModal = false;
            this.deleteUrl = '';
            this.deleteTaxonomy = '';
            this.deleteForm = null;
        },

        confirmDelete() {
            if (this.deleteForm) {
                this.deleteForm.submit();
            }
        }
    }"
    @keydown.escape.window="closeDeleteModal()"
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
            Taxonomies
        </span>

    </nav>
</div>


{{-- ============================================================
    Header
============================================================= --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

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
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z
                       M8 8h8M8 12h5M8 16h3"
                />
            </svg>

        </div>

        <div class="min-w-0">

            <h1
                class="text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl"
            >
                Vendor Taxonomies
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage the taxonomies associated with
                <span class="font-semibold text-gray-700">
                    {{ $vendor->business_name }}
                </span>.
            </p>

        </div>

    </div>


    {{-- Add Taxonomies --}}
    <a
        href="{{ route('vendors.taxonomies.create', $vendor) }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30 focus:ring-offset-2"
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

        Assign Taxonomies

    </a>

</div>


{{-- ============================================================
    Flash Message
============================================================= --}}
@if(session('success'))

    <div class="rounded-2xl border border-green-200 bg-green-50 p-4">

        <div class="flex items-start gap-3">

            <div
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600"
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

            </div>

            <div>

                <p class="text-sm font-bold text-green-800">
                    Success
                </p>

                <p class="mt-0.5 text-sm text-green-700">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    </div>

@endif


{{-- ============================================================
    Vendor Summary
============================================================= --}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    <div class="border-b border-gray-100 bg-gray-50/70 px-5 py-4 sm:px-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex min-w-0 items-center gap-3">

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


            <div class="flex items-center gap-2">

                <span
                    class="rounded-full bg-[#FBEBEF] px-3 py-1 text-xs font-bold text-[#D7385E]"
                >
                    {{ $vendorTaxonomies->total() }}
                    {{ Str::plural('Taxonomy', $vendorTaxonomies->total()) }}
                </span>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================
    Taxonomies
============================================================= --}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    <div
        class="flex flex-col gap-4 border-b border-gray-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6"
    >

        <div>

            <h2 class="text-base font-bold text-gray-900">
                Assigned Taxonomies
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Taxonomies currently associated with this vendor.
            </p>

        </div>


        @if($vendorTaxonomies->total() > 0)

            <a
                href="{{ route('vendors.taxonomies.create', $vendor) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#D7385E]/20 bg-[#FBEBEF] px-4 py-2 text-sm font-bold text-[#D7385E] transition hover:bg-[#f8dfe5]"
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

                Add More

            </a>

        @endif

    </div>


    @if($vendorTaxonomies->isNotEmpty())

        {{-- ========================================================
            Desktop Table
        ========================================================= --}}
        <div class="hidden overflow-x-auto md:block">

            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50/70">

                    <tr>

                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-400"
                        >
                            Taxonomy
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-400"
                        >
                            Parent
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-400"
                        >
                            Assigned
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-gray-400"
                        >
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($vendorTaxonomies as $vendorTaxonomy)

                        <tr class="transition hover:bg-gray-50/70">

                            {{-- Taxonomy --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#FBEBEF] text-[#D7385E]"
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
                                                d="M7 7h10M7 12h10M7 17h6"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-sm font-bold text-gray-900">
                                            {{ $vendorTaxonomy->taxonomy?->name ?? 'Unknown Taxonomy' }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            ID #{{ $vendorTaxonomy->taxonomy?->id ?? '—' }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Parent --}}
                            <td class="px-6 py-4">

                                @if($vendorTaxonomy->taxonomy?->parent)

                                    <span
                                        class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600"
                                    >
                                        {{ $vendorTaxonomy->taxonomy->parent->name }}
                                    </span>

                                @else

                                    <span class="text-sm text-gray-400">
                                        Root taxonomy
                                    </span>

                                @endif

                            </td>


                            {{-- Assigned --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <span class="text-sm text-gray-500">
                                    {{ $vendorTaxonomy->created_at?->format('d M Y') ?? '—' }}
                                </span>

                            </td>


                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('vendors.taxonomies.edit', [$vendor, $vendorTaxonomy]) }}"
                                        title="Edit taxonomy"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 transition hover:border-[#D7385E]/30 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                                   M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Remove --}}
                                    <form
                                        method="POST"
                                        action="{{ route('vendors.taxonomies.destroy', [$vendor, $vendorTaxonomy]) }}"
                                        x-ref="deleteForm{{ $vendorTaxonomy->id }}"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            title="Remove taxonomy"
                                            @click="openDeleteModal(
                                                '{{ route('vendors.taxonomies.destroy', [$vendor, $vendorTaxonomy]) }}',
                                                @js($vendorTaxonomy->taxonomy?->name ?? 'Unknown Taxonomy'),
                                                $refs.deleteForm{{ $vendorTaxonomy->id }}
                                            )"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600"
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
                                                    d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2
                                                       M10 11v6M14 11v6M5 7l1 13h12l1-13"
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


        {{-- ========================================================
            Mobile Cards
        ========================================================= --}}
        <div class="divide-y divide-gray-100 md:hidden">

            @foreach($vendorTaxonomies as $vendorTaxonomy)

                <div class="p-5">

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex min-w-0 items-start gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FBEBEF] text-[#D7385E]"
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
                                        d="M7 7h10M7 12h10M7 17h6"
                                    />
                                </svg>

                            </div>

                            <div class="min-w-0">

                                <h3 class="truncate text-sm font-bold text-gray-900">
                                    {{ $vendorTaxonomy->taxonomy?->name ?? 'Unknown Taxonomy' }}
                                </h3>

                                @if($vendorTaxonomy->taxonomy?->parent)

                                    <p class="mt-1 text-xs text-gray-500">
                                        Parent:
                                        <span class="font-semibold text-gray-700">
                                            {{ $vendorTaxonomy->taxonomy->parent->name }}
                                        </span>
                                    </p>

                                @else

                                    <p class="mt-1 text-xs text-gray-400">
                                        Root taxonomy
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>


                    <div class="mt-4 flex items-center justify-between gap-3">

                        <p class="text-xs text-gray-400">
                            Assigned
                            {{ $vendorTaxonomy->created_at?->format('d M Y') ?? '—' }}
                        </p>


                        <div class="flex items-center gap-2">

                            {{-- Edit --}}
                            <a
                                href="{{ route('vendors.taxonomies.edit', [$vendor, $vendorTaxonomy]) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-600 transition hover:border-[#D7385E]/30 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                            >

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
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                           M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                    />
                                </svg>

                                Edit

                            </a>


                            {{-- Remove --}}
                            <form
                                method="POST"
                                action="{{ route('vendors.taxonomies.destroy', [$vendor, $vendorTaxonomy]) }}"
                                x-ref="deleteFormMobile{{ $vendorTaxonomy->id }}"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="button"
                                    @click="openDeleteModal(
                                        '{{ route('vendors.taxonomies.destroy', [$vendor, $vendorTaxonomy]) }}',
                                        @js($vendorTaxonomy->taxonomy?->name ?? 'Unknown Taxonomy'),
                                        $refs.deleteFormMobile{{ $vendorTaxonomy->id }}
                                    )"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                >

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
                                            d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2
                                               M10 11v6M14 11v6M5 7l1 13h12l1-13"
                                        />
                                    </svg>

                                    Remove

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- ========================================================
            Pagination
        ========================================================= --}}
        @if($vendorTaxonomies->hasPages())

            <div class="border-t border-gray-100 px-5 py-4 sm:px-6">
                {{ $vendorTaxonomies->links() }}
            </div>

        @endif

    @else

        {{-- ========================================================
            Empty State
        ========================================================= --}}
        <div class="px-5 py-14 text-center sm:px-6">

            <div
                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]"
            >

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
                        d="M7 7h10M7 12h10M7 17h6"
                    />
                </svg>

            </div>

            <h3 class="mt-4 text-base font-bold text-gray-900">
                No taxonomies assigned
            </h3>

            <p class="mx-auto mt-1 max-w-md text-sm leading-6 text-gray-500">
                This vendor does not have any taxonomies assigned yet.
                Assign one or multiple taxonomies to categorize the vendor's services.
            </p>

            <div class="mt-5">

                <a
                    href="{{ route('vendors.taxonomies.create', $vendor) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#c92f53]"
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

                    Assign Taxonomies

                </a>

            </div>

        </div>

    @endif

</div>


{{-- ============================================================
    Back to Vendor
============================================================= --}}
<div>

    <a
        href="{{ route('vendors.show', $vendor) }}"
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

        Back to Vendor

    </a>

</div>


{{-- ============================================================
    Delete Confirmation Modal
============================================================= --}}
<div
    x-cloak
    x-show="deleteModal"
    x-transition.opacity.duration.200ms
    class="fixed inset-0 z-[9999] flex items-center justify-center px-4 sm:px-6"
    role="dialog"
    aria-modal="true"
    aria-labelledby="delete-taxonomy-title"
    @click.self="closeDeleteModal()"
>

    {{-- Backdrop --}}
    <div
        class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"
        x-show="deleteModal"
        x-transition.opacity
        @click="closeDeleteModal()"
    ></div>


    {{-- Modal --}}
    <div
        x-show="deleteModal"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
        class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
        @click.stop
    >

        {{-- Modal Header --}}
        <div class="px-5 pt-6 sm:px-6">

            <div class="flex items-start gap-4">

                {{-- Warning Icon --}}
                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600"
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
                            d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.73 3h17.6a2 2 0 001.73-3l-8.82-15a2 2 0 00-3.46 0z"
                        />
                    </svg>

                </div>


                <div class="min-w-0 flex-1">

                    <h2
                        id="delete-taxonomy-title"
                        class="text-base font-extrabold text-gray-900"
                    >
                        Remove Taxonomy?
                    </h2>

                    <p class="mt-1 text-sm leading-6 text-gray-500">
                        Are you sure you want to remove
                        <span
                            class="font-bold text-gray-800"
                            x-text="deleteTaxonomy"
                        ></span>
                        from this vendor?
                    </p>

                </div>

            </div>

        </div>


        {{-- Warning --}}
        <div class="mx-5 mt-5 rounded-xl bg-red-50 px-4 py-3 sm:mx-6">

            <div class="flex gap-3">

                <svg
                    class="mt-0.5 h-4 w-4 shrink-0 text-red-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 9v4m0 4h.01"
                    />
                </svg>

                <p class="text-xs leading-5 text-red-700">
                    This will remove the taxonomy association from this vendor.
                    The original taxonomy will not be deleted.
                </p>

            </div>

        </div>


        {{-- Modal Actions --}}
        <div
            class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/70 px-5 py-4 sm:flex-row sm:justify-end sm:px-6"
        >

            {{-- Cancel --}}
            <button
                type="button"
                @click="closeDeleteModal()"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2"
            >
                Cancel
            </button>


            {{-- Confirm Delete --}}
            <button
                type="button"
                @click="confirmDelete()"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:ring-offset-2"
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
                        d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2
                           M10 11v6M14 11v6M5 7l1 13h12l1-13"
                    />
                </svg>

                Delete Taxonomy

            </button>

        </div>

    </div>

</div>


</div>

@endsection

