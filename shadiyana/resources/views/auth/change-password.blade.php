```blade
@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<div class="mx-auto max-w-3xl">

    {{-- ============================================================
        Page Header
    ============================================================= --}}
    <div class="mb-8">

        {{-- Breadcrumb --}}
        <div class="mb-4 flex items-center gap-2 text-xs font-medium text-gray-400">

            <a
                href="{{ route('dashboard') }}"
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

            <span class="text-gray-600">
                Change Password
            </span>

        </div>


        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="mb-1 text-xs font-bold uppercase tracking-widest text-[#D7385E]">
                    Account Security
                </p>

                <h1 class="text-2xl font-black tracking-tight text-gray-900 sm:text-3xl">
                    Change Password
                </h1>

                <p class="mt-2 max-w-xl text-sm leading-6 text-gray-500">
                    Update your account password to keep your Shadiyana account secure.
                </p>

            </div>

        </div>

    </div>


    {{-- ============================================================
        Success Message
    ============================================================= --}}
    @if (session('success'))

        <div class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4">

            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-green-100">

                <svg
                    class="h-4 w-4 text-green-600"
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
                    Password Updated
                </p>

                <p class="mt-0.5 text-xs text-green-700">
                    {{ session('success') }}
                </p>
            </div>

        </div>

    @endif


    {{-- ============================================================
        Validation Errors
    ============================================================= --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100">

                    <svg
                        class="h-4 w-4 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v3m0 4h.01M10.29 3.86l-7.82 13a2 2 0 001.71 3h15.64a2 2 0 001.71-3l-7.82-13a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-sm font-bold text-red-800">
                        Please check the following:
                    </p>

                    <ul class="mt-1 space-y-1 text-xs text-red-700">

                        @foreach ($errors->all() as $error)

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
        Change Password Card
    ============================================================= --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Card Header --}}
        <div class="border-b border-gray-100 bg-gray-50/70 px-6 py-5 sm:px-8">

            <div class="flex items-center gap-4">

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
                            d="M15 7a5 5 0 10-9.9 1H4a2 2 0 00-2 2v2a2 2 0 002 2h3v-2h2v2h2v-2h2.17A5 5 0 0015 7z"
                        />

                        <circle
                            cx="10"
                            cy="7"
                            r="1"
                            fill="currentColor"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="text-base font-extrabold text-gray-900">
                        Update your password
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500">
                        Enter your current password and choose a new one.
                    </p>

                </div>

            </div>

        </div>


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('password.update') }}"
            class="p-6 sm:p-8"
        >

            @csrf


            {{-- Current Password --}}
            <div class="mb-6">

                <label
                    for="current_password"
                    class="mb-2 block text-sm font-bold text-gray-700"
                >
                    Current Password
                </label>

                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your current password"
                    class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                >

                @error('current_password')

                    <p class="mt-1.5 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Divider --}}
            <div class="mb-6 border-t border-gray-100"></div>


            {{-- New Password --}}
            <div class="mb-6">

                <label
                    for="password"
                    class="mb-2 block text-sm font-bold text-gray-700"
                >
                    New Password
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your new password"
                    class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                >

                @error('password')

                    <p class="mt-1.5 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>

                @enderror

                <p class="mt-2 text-xs text-gray-400">
                    Your password must contain at least 8 characters.
                </p>

            </div>


            {{-- Confirm Password --}}
            <div class="mb-8">

                <label
                    for="password_confirmation"
                    class="mb-2 block text-sm font-bold text-gray-700"
                >
                    Confirm New Password
                </label>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Re-enter your new password"
                    class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                >

                @error('password_confirmation')

                    <p class="mt-1.5 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('profile') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 transition hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c42f52] focus:outline-none focus:ring-4 focus:ring-[#D7385E]/20"
                >

                    <svg
                        class="mr-2 h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2zm10-12a4 4 0 10-8 0v3h8V7z"
                        />
                    </svg>

                    Update Password

                </button>

            </div>

        </form>

    </div>


    {{-- ============================================================
        Security Notice
    ============================================================= --}}
    <div class="mt-6 rounded-xl border border-gray-200 bg-white p-5">

        <div class="flex items-start gap-3">

            <svg
                class="mt-0.5 h-5 w-5 shrink-0 text-gray-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M12 3l7 4v5c0 4.5-3 7.8-7 9-4-1.2-7-4.5-7-9V7l7-4z"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M9 12l2 2 4-4"
                />
            </svg>

            <div>

                <p class="text-sm font-bold text-gray-700">
                    Keep your account secure
                </p>

                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Use a unique password that you do not use on other websites.
                    Never share your password with anyone.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection
```
