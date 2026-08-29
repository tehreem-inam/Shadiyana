<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | {{ config('app.name', 'Shadiyana') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#FBEBEF] text-gray-900 antialiased">

    <div class="min-h-screen lg:grid lg:grid-cols-2">

        {{-- ============================================================
            LEFT BRANDING PANEL
        ============================================================= --}}
        <div class="relative hidden overflow-hidden bg-[#D7385E] lg:flex">

            {{-- Decorative circles --}}
            <div class="absolute -left-24 -top-24 h-72 w-72 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-32 -right-20 h-96 w-96 rounded-full bg-white/10"></div>

            <div class="relative z-10 flex w-full flex-col justify-between p-12 xl:p-16">

                {{-- Logo --}}
                <div class="flex items-center gap-3">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-[#D7385E] shadow-lg">
                        <span class="text-lg font-black">
                            {{ strtoupper(substr(config('app.name', 'Shadiyana'), 0, 1)) }}
                        </span>
                    </div>

                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight text-white">
                            {{ config('app.name', 'Shadiyana') }}
                        </h1>

                        <p class="text-xs font-medium text-white/70">
                            Wedding Marketplace
                        </p>
                    </div>

                </div>


                {{-- Main Message --}}
                <div class="max-w-lg">

                    <span
                        class="mb-5 inline-flex rounded-full bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-white"
                    >
                        Welcome Back
                    </span>

                    <h2 class="text-4xl font-black leading-tight text-white xl:text-5xl">
                        Everything for your
                        <span class="text-white/80">
                            perfect celebration.
                        </span>
                    </h2>

                    <p class="mt-6 max-w-md text-sm leading-7 text-white/75">
                        Manage your Shadiyana account, connect with vendors,
                        and make every wedding detail easier to organize.
                    </p>

                </div>


                {{-- Footer --}}
                <p class="text-xs font-medium text-white/60">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Shadiyana') }}.
                    All rights reserved.
                </p>

            </div>

        </div>


        {{-- ============================================================
            RIGHT LOGIN PANEL
        ============================================================= --}}
        <div class="flex min-h-screen items-center justify-center bg-white px-5 py-10 sm:px-8">

            <div class="w-full max-w-md">

                {{-- Mobile Logo --}}
                <div class="mb-10 flex items-center gap-3 lg:hidden">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#D7385E] text-white">
                        <span class="text-base font-black">
                            {{ strtoupper(substr(config('app.name', 'Shadiyana'), 0, 1)) }}
                        </span>
                    </div>

                    <div>
                        <h1 class="text-lg font-extrabold text-gray-900">
                            {{ config('app.name', 'Shadiyana') }}
                        </h1>

                        <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-400">
                            Wedding Marketplace
                        </p>
                    </div>

                </div>


                {{-- Heading --}}
                <div class="mb-8">

                    <p class="mb-2 text-xs font-bold uppercase tracking-widest text-[#D7385E]">
                        Account Login
                    </p>

                    <h2 class="text-3xl font-black tracking-tight text-gray-900">
                        Welcome back
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Sign in to continue to your Shadiyana dashboard.
                    </p>

                </div>


                {{-- Validation Errors --}}
                @if ($errors->any())

                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                        <div class="flex gap-3">

                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
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

                            <div>

                                <p class="text-sm font-bold text-red-800">
                                    Please check the following:
                                </p>

                                <ul class="mt-1 space-y-1 text-xs text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- Success Message --}}
                @if (session('success'))

                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3">

                        <p class="text-sm font-medium text-green-700">
                            {{ session('success') }}
                        </p>

                    </div>

                @endif


                {{-- Login Form --}}
                <form
                    method="POST"
                    action="{{ route('login.store') }}"
                    class="space-y-5"
                >

                    @csrf


                    {{-- Email / Phone --}}
                    <div>

                        <label
                            for="login"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Email or Phone Number
                        </label>

                        <input
                            id="login"
                            name="login"
                            type="text"
                            value="{{ old('login') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email or phone number"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >

                        @error('login')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <label
                                for="password"
                                class="block text-sm font-bold text-gray-700"
                            >
                                Password
                            </label>

                        </div>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >

                        @error('password')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Remember --}}
                    <div class="flex items-center">

                        <label class="inline-flex cursor-pointer items-center gap-2">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                class="h-4 w-4 rounded border-gray-300 text-[#D7385E] focus:ring-[#D7385E]"
                            >

                            <span class="text-sm text-gray-500">
                                Remember me
                            </span>

                        </label>

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center rounded-xl bg-[#D7385E] px-4 py-3.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c42f52] focus:outline-none focus:ring-4 focus:ring-[#D7385E]/20"
                    >
                        Sign In
                    </button>

                </form>


                {{-- Register --}}
                <div class="mt-8 border-t border-gray-100 pt-6 text-center">

                    <p class="text-sm text-gray-500">
                        Don't have an account?

                        <a
                            href="{{ route('register') }}"
                            class="font-bold text-[#D7385E] hover:underline"
                        >
                            Create an account
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</body>
</html>

