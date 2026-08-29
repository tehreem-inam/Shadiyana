@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div
    x-data="{
        search: '',
        role: '',
        status: '',
        deleteModal: false,
        deleteUrl: ''
    }"
    class="mx-auto max-w-7xl"
>

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="flex items-center gap-2 text-sm text-gray-400">
                <span>Management</span>

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

                <span class="text-gray-600">Users</span>
            </div>

            <div class="mt-2">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                    Users
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Manage customers, vendors, and user accounts.
                </p>
            </div>
        </div>


        {{-- Add User --}}
        <a
            href="{{ route('users.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c92f53] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#D7385E]/30"
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
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Add User
        </a>

    </div>


    {{-- ============================================================
        SUMMARY CARD
    ============================================================= --}}

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- Total Users --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Users
                    </p>

                    <p class="mt-2 text-2xl font-extrabold text-gray-900">
                        {{ $users->count() }}
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
                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-5a4 4 0 11-8 0 4 4 0 018 0zm4 1a3 3 0 10-3-3"
                        />
                    </svg>
                </div>

            </div>

        </div>


        {{-- Vendors --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Vendors
                    </p>

                    <p class="mt-2 text-2xl font-extrabold text-gray-900">
                        {{ $users->where('role', 'vendor')->count() }}
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
                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 10h.01M15 10h.01M9 14h.01M15 14h.01"
                        />
                    </svg>
                </div>

            </div>

        </div>


        {{-- Customers --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Customers
                    </p>

                    <p class="mt-2 text-2xl font-extrabold text-gray-900">
                        {{ $users->where('role', 'customer')->count() }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
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

            </div>

        </div>

    </div>


    {{-- ============================================================
        USERS CARD
    ============================================================= --}}

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Card Header / Filters --}}
        <div class="border-b border-gray-100 p-4 sm:p-5">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h2 class="text-base font-bold text-gray-900">
                        All Users
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        View and manage all registered users.
                    </p>
                </div>


                {{-- Filters --}}
                <div class="flex flex-col gap-3 sm:flex-row">

                    {{-- Search --}}
                    <div class="relative">

                        <svg
                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                            />
                        </svg>

                        <input
                            type="text"
                            x-model="search"
                            placeholder="Search users..."
                            class="h-10 w-full rounded-xl border border-gray-200 bg-gray-50 pl-9 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10 sm:w-64"
                        >

                    </div>


                    {{-- Role --}}
                    <select
                        x-model="role"
                        class="h-10 rounded-xl border border-gray-200 bg-gray-50 px-3 text-sm text-gray-600 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                    >
                        <option value="">All Roles</option>
                        <option value="vendor">Vendor</option>
                        <option value="customer">Customer</option>
                        <option value="superadmin">Super Admin</option>
                    </select>


                    {{-- Status --}}
                    <select
                        x-model="status"
                        class="h-10 rounded-xl border border-gray-200 bg-gray-50 px-3 text-sm text-gray-600 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-2 focus:ring-[#D7385E]/10"
                    >
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>

                </div>

            </div>

        </div>


        {{-- ========================================================
            DESKTOP TABLE
        ========================================================= --}}

        <div class="hidden overflow-x-auto md:block">

            <table class="w-full text-left">

                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/70">

                        <th class="px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-gray-400">
                            User
                        </th>

                        <th class="px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-gray-400">
                            Contact
                        </th>

                        <th class="px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-gray-400">
                            Role
                        </th>

                        <th class="px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-gray-400">
                            Status
                        </th>

                        <th class="px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-gray-400">
                            Joined
                        </th>

                        <th class="px-6 py-3.5 text-right text-xs font-bold uppercase tracking-wider text-gray-400">
                            Actions
                        </th>

                    </tr>
                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($users as $user)

                        <tr
                            x-show="
                                (
                                    '{{ strtolower($user->first_name . ' ' . $user->last_name . ' ' . $user->email) }}'
                                ).includes(search.toLowerCase())
                                &&
                                (role === '' || role === '{{ $user->role }}')
                                &&
                                (status === '' || status === '{{ $user->status }}')
                            "
                            class="group transition hover:bg-gray-50/70"
                        >

                            {{-- User --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-[#FBEBEF] font-bold text-[#D7385E]">

                                        @if($user->profile_image)

                                            <img
                                                src="{{ asset('storage/' . $user->profile_image) }}"
                                                alt="{{ $user->first_name }}"
                                                class="h-full w-full object-cover"
                                            >

                                        @else

                                            {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}

                                        @endif

                                    </div>

                                    <div>
                                        <p class="text-sm font-bold text-gray-900">
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-gray-400">
                                            ID #{{ $user->id }}
                                        </p>
                                    </div>

                                </div>

                            </td>


                            {{-- Contact --}}
                            <td class="px-6 py-4">

                                <p class="text-sm text-gray-700">
                                    {{ $user->email }}
                                </p>

                                <p class="mt-0.5 text-xs text-gray-400">
                                    {{ $user->country_code }} {{ $user->phone_number }}
                                </p>

                            </td>


                            {{-- Role --}}
                            <td class="px-6 py-4">

                                @if($user->role === 'vendor')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-purple-50 px-2.5 py-1 text-xs font-bold text-purple-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-purple-500"></span>
                                        Vendor
                                    </span>

                                @elseif($user->role === 'customer')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                        Customer
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#FBEBEF] px-2.5 py-1 text-xs font-bold text-[#D7385E]">
                                        <span class="h-1.5 w-1.5 rounded-full bg-[#D7385E]"></span>
                                        Super Admin
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if($user->status === 'active')

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


                            {{-- Joined --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $user->created_at?->format('d M Y') }}
                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-1">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('users.show', $user->id) }}"
                                        title="View"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-blue-50 hover:text-blue-600"
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
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                                            />
                                        </svg>
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('users.edit', $user->id) }}"
                                        title="Edit"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                            />
                                        </svg>
                                    </a>


                                    {{-- Delete --}}
                                    <button
                                        type="button"
                                        title="Delete"
                                        @click="
                                            deleteModal = true;
                                            deleteUrl = '{{ route('users.destroy', $user->id) }}';
                                        "
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-50 hover:text-red-600"
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
                                                d="M6 7h12M10 11v6M14 11v6M9 7V4h6v3m-8 0l1 13h8l1-13"
                                            />
                                        </svg>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

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
                                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-5a4 4 0 11-8 0 4 4 0 018 0zm4 1a3 3 0 10-3-3"
                                        />
                                    </svg>

                                </div>

                                <h3 class="mt-4 text-sm font-bold text-gray-900">
                                    No users found
                                </h3>

                                <p class="mx-auto mt-1 max-w-sm text-sm text-gray-500">
                                    There are currently no users registered in the system.
                                </p>

                                <a
                                    href="{{ route('users.create') }}"
                                    class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#c92f53]"
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

                                    Add First User
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ========================================================
            MOBILE USER CARDS
        ========================================================= --}}

        <div class="divide-y divide-gray-100 md:hidden">

            @forelse($users as $user)

                <div
                    x-show="
                        (
                            '{{ strtolower($user->first_name . ' ' . $user->last_name . ' ' . $user->email) }}'
                        ).includes(search.toLowerCase())
                        &&
                        (role === '' || role === '{{ $user->role }}')
                        &&
                        (status === '' || status === '{{ $user->status }}')
                    "
                    class="p-4"
                >

                    <div class="flex items-start gap-3">

                        {{-- Avatar --}}
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-[#FBEBEF] font-bold text-[#D7385E]">

                            @if($user->profile_image)

                                <img
                                    src="{{ asset('storage/' . $user->profile_image) }}"
                                    alt="{{ $user->first_name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}

                            @endif

                        </div>


                        {{-- User Info --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-3">

                                <div class="min-w-0">
                                    <h3 class="truncate text-sm font-bold text-gray-900">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </h3>

                                    <p class="mt-0.5 truncate text-xs text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>

                                {{-- Status --}}
                                @if($user->status === 'active')

                                    <span class="shrink-0 rounded-full bg-green-50 px-2 py-1 text-[10px] font-bold text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="shrink-0 rounded-full bg-gray-100 px-2 py-1 text-[10px] font-bold text-gray-600">
                                        Inactive
                                    </span>

                                @endif

                            </div>


                            <div class="mt-3 flex flex-wrap items-center gap-2">

                                {{-- Role --}}
                                @if($user->role === 'vendor')

                                    <span class="rounded-full bg-purple-50 px-2 py-1 text-[10px] font-bold text-purple-700">
                                        Vendor
                                    </span>

                                @elseif($user->role === 'customer')

                                    <span class="rounded-full bg-blue-50 px-2 py-1 text-[10px] font-bold text-blue-700">
                                        Customer
                                    </span>

                                @else

                                    <span class="rounded-full bg-[#FBEBEF] px-2 py-1 text-[10px] font-bold text-[#D7385E]">
                                        Super Admin
                                    </span>

                                @endif

                                <span class="text-[10px] text-gray-400">
                                    {{ $user->country_code }} {{ $user->phone_number }}
                                </span>

                            </div>


                            {{-- Actions --}}
                            <div class="mt-3 flex items-center gap-2">

                                <a
                                    href="{{ route('users.show', $user->id) }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-gray-50 px-3 py-2 text-xs font-semibold text-gray-600 transition hover:bg-blue-50 hover:text-blue-600"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('users.edit', $user->id) }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-[#FBEBEF] px-3 py-2 text-xs font-semibold text-[#D7385E] transition hover:bg-[#f8dce3]"
                                >
                                    Edit
                                </a>

                                <button
                                    type="button"
                                    @click="
                                        deleteModal = true;
                                        deleteUrl = '{{ route('users.destroy', $user->id) }}';
                                    "
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100"
                                >
                                    Delete
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="px-6 py-16 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

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
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-5a4 4 0 11-8 0 4 4 0 018 0zm4 1a3 3 0 10-3-3"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 text-sm font-bold text-gray-900">
                        No users found
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Start by adding your first user.
                    </p>

                    <a
                        href="{{ route('users.create') }}"
                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#D7385E] px-4 py-2.5 text-sm font-bold text-white"
                    >
                        Add User
                    </a>

                </div>

            @endforelse

        </div>


        {{-- ========================================================
            FOOTER
        ========================================================= --}}

        @if($users->count() > 0)

            <div class="flex flex-col gap-3 border-t border-gray-100 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                <p class="text-xs text-gray-500">
                    Showing
                    <span class="font-semibold text-gray-700">
                        {{ $users->count() }}
                    </span>
                    {{ $users->count() === 1 ? 'user' : 'users' }}
                </p>

            </div>

        @endif

    </div>


    {{-- ============================================================
        DELETE CONFIRMATION MODAL
    ============================================================= --}}

    <div
        x-show="deleteModal"
        x-cloak
        class="fixed inset-0 z-[100] flex items-center justify-center px-4"
    >

        {{-- Overlay --}}
        <div
            x-show="deleteModal"
            x-transition.opacity
            @click="deleteModal = false"
            class="absolute inset-0 bg-black/40 backdrop-blur-sm"
        ></div>


        {{-- Modal --}}
        <div
            x-show="deleteModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl"
        >

            {{-- Icon --}}
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-red-600">

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
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.53 20h14.94a2 2 0 001.74-3l-7.5-13a2 2 0 00-3.42 0z"
                    />
                </svg>

            </div>


            <h3 class="mt-5 text-lg font-extrabold text-gray-900">
                Delete this user?
            </h3>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                This action cannot be undone. The user's account and
                associated information will be permanently deleted.
            </p>


            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    @click="deleteModal = false"
                    class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-gray-50"
                >
                    Cancel
                </button>

                <form
                    :action="deleteUrl"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-red-700 sm:w-auto"
                    >
                        Delete User
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection