@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="mx-auto max-w-7xl">

    {{-- Breadcrumb --}}
    <div class="mb-6 flex items-center gap-2 text-sm">

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

        <span class="font-medium text-gray-700">
            My Profile
        </span>

    </div>


    {{-- Page Header --}}
    <div class="mb-8">

        <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D7385E]">
            Account
        </p>

        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            My Profile
        </h1>

        <p class="mt-2 text-sm text-gray-500 sm:text-base">
            View your account information and manage your security settings.
        </p>

    </div>


    {{-- Profile Card --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Profile Banner --}}
        <div class="relative overflow-hidden bg-[#D7385E] px-6 py-8 sm:px-10 sm:py-10">

            {{-- Decorative circles --}}
            <div
                class="absolute -right-10 -top-24 h-72 w-72 rounded-full bg-white/10"
            ></div>

            <div
                class="absolute -bottom-28 right-24 h-64 w-64 rounded-full bg-white/5"
            ></div>

            <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center">

                {{-- Avatar --}}
                <div
                    class="flex h-28 w-28 shrink-0 items-center justify-center
                           overflow-hidden rounded-2xl border-4 border-white/30
                           bg-white text-3xl font-extrabold text-[#D7385E]
                           shadow-lg"
                >

                    @if($user->profile_image)

                        <img
                            src="{{ asset('storage/' . $user->profile_image) }}"
                            alt="{{ $user->first_name }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        {{ strtoupper(substr($user->first_name ?? 'U', 0, 1)) }}

                    @endif

                </div>


                {{-- User Info --}}
                <div class="min-w-0 text-white">

                    <h2 class="truncate text-2xl font-extrabold sm:text-3xl">
                        {{ $user->first_name }}
                        {{ $user->last_name }}
                    </h2>

                    @if($user->email)
                        <p class="mt-1 text-sm text-white/80 sm:text-base">
                            {{ $user->email }}
                        </p>
                    @endif


                    {{-- Status Badges --}}
                    <div class="mt-4 flex flex-wrap gap-2">

                        {{-- Role --}}
                        <span
                            class="inline-flex items-center rounded-full bg-white/15
                                   px-3 py-1 text-xs font-bold uppercase tracking-wide
                                   text-white"
                        >
                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                        </span>


                        {{-- Account Status --}}
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full
                                   bg-white/15 px-3 py-1 text-xs font-semibold text-white"
                        >

                            <span
                                class="h-2 w-2 rounded-full
                                {{ $user->status === 'active'
                                    ? 'bg-green-300'
                                    : 'bg-yellow-300' }}"
                            ></span>

                            {{ ucfirst($user->status ?? 'active') }}

                        </span>


                        {{-- Verified --}}
                        @if($user->is_verified)

                            <span
                                class="inline-flex items-center gap-1.5 rounded-full
                                       bg-white/15 px-3 py-1 text-xs font-semibold text-white"
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
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                                Verified

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Profile Details --}}
        <div class="p-6 sm:p-8">

            <div class="mb-6 flex items-center justify-between">

                <div>
                    <h3 class="text-lg font-bold text-gray-900">
                        Account Information
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Your basic account details.
                    </p>
                </div>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                {{-- First Name --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        First Name
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-900">
                        {{ $user->first_name ?: '—' }}
                    </p>
                </div>


                {{-- Last Name --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Last Name
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-900">
                        {{ $user->last_name ?: '—' }}
                    </p>
                </div>


                {{-- Email --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Email Address
                    </p>

                    <p class="mt-2 break-all text-sm font-bold text-gray-900">
                        {{ $user->email ?: '—' }}
                    </p>
                </div>


                {{-- Phone --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Phone Number
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-900">
                        {{ $user->phone_number ?: '—' }}
                    </p>
                </div>


                {{-- Country Code --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Country Code
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-900">
                        {{ $user->country_code ?: '—' }}
                    </p>
                </div>


                {{-- Role --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Role
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-900">
                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </p>
                </div>


                {{-- Account Status --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Account Status
                    </p>

                    <div class="mt-2 flex items-center gap-2">

                        <span
                            class="h-2 w-2 rounded-full
                            {{ $user->status === 'active'
                                ? 'bg-green-500'
                                : 'bg-yellow-500' }}"
                        ></span>

                        <span class="text-sm font-bold text-gray-900">
                            {{ ucfirst($user->status ?? 'active') }}
                        </span>

                    </div>
                </div>


                {{-- Verification --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Verification
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-900">
                        {{ $user->is_verified ? 'Verified' : 'Not Verified' }}
                    </p>
                </div>


                {{-- Last Login --}}
                <div
                    class="rounded-xl border border-gray-100 bg-gray-50 p-4"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                        Last Login
                    </p>

                    <p class="mt-2 text-sm font-bold text-gray-900">
                        {{ $user->last_login_at?->format('M d, Y h:i A') ?? '—' }}
                    </p>
                </div>

            </div>


            {{-- Security Section --}}
            <div class="mt-8 border-t border-gray-100 pt-8">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h3 class="text-lg font-bold text-gray-900">
                            Security
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Keep your account secure by updating your password regularly.
                        </p>

                    </div>


                    @if(Route::has('password.change'))

                        <a
                            href="{{ route('password.change') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl
                                   border border-gray-200 bg-white px-5 py-3 text-sm
                                   font-bold text-gray-700 shadow-sm transition
                                   hover:border-[#D7385E] hover:bg-[#FBEBEF]
                                   hover:text-[#D7385E]"
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
                                    d="M15 7a4 4 0 10-5.2 3.8L4 16.6V20h3.4l1.5-1.5H11V16h2.5l1.8-1.8A4 4 0 0015 7z"
                                />
                            </svg>

                            Change Password

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection