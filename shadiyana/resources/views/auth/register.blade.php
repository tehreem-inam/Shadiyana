<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Account | {{ config('app.name', 'Shadiyana') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#FBEBEF] text-gray-900 antialiased">

    <div class="min-h-screen lg:grid lg:grid-cols-2">

        {{-- ============================================================
            LEFT BRANDING
        ============================================================= --}}
        <div class="relative hidden overflow-hidden bg-[#D7385E] lg:flex">

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
                        Join Shadiyana
                    </span>

                    <h2 class="text-4xl font-black leading-tight text-white xl:text-5xl">
                        Start planning your
                        <span class="text-white/80">
                            perfect celebration.
                        </span>
                    </h2>

                    <p class="mt-6 max-w-md text-sm leading-7 text-white/75">
                        Create your account and discover trusted wedding
                        vendors, services, packages, and everything you need
                        for your special day.
                    </p>

                </div>


                <p class="text-xs font-medium text-white/60">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Shadiyana') }}.
                    All rights reserved.
                </p>

            </div>

        </div>


        {{-- ============================================================
            RIGHT REGISTER PANEL
        ============================================================= --}}
        <div class="flex min-h-screen items-center justify-center overflow-y-auto bg-white px-5 py-10 sm:px-8">

            <div class="w-full max-w-md">

                {{-- Mobile Logo --}}
                <div class="mb-8 flex items-center gap-3 lg:hidden">

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
                <div class="mb-7">

                    <p class="mb-2 text-xs font-bold uppercase tracking-widest text-[#D7385E]">
                        Create Account
                    </p>

                    <h2 class="text-3xl font-black tracking-tight text-gray-900">
                        Get started
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Create your Shadiyana customer account.
                    </p>

                </div>


                {{-- Errors --}}
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


                {{-- Register Form --}}
                <form
                    method="POST"
                    action="{{ route('register.store') }}"
                    class="space-y-5"
                >

                    @csrf


                    {{-- First / Last Name --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        <div>

                            <label
                                for="first_name"
                                class="mb-2 block text-sm font-bold text-gray-700"
                            >
                                First Name
                            </label>

                            <input
                                id="first_name"
                                name="first_name"
                                type="text"
                                value="{{ old('first_name') }}"
                                required
                                autofocus
                                autocomplete="given-name"
                                placeholder="First name"
                                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                            @error('first_name')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <div>

                            <label
                                for="last_name"
                                class="mb-2 block text-sm font-bold text-gray-700"
                            >
                                Last Name
                            </label>

                            <input
                                id="last_name"
                                name="last_name"
                                type="text"
                                value="{{ old('last_name') }}"
                                required
                                autocomplete="family-name"
                                placeholder="Last name"
                                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                            @error('last_name')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Country Code / Phone --}}
                    <div>

                        <label
                            for="phone_number"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Phone Number
                        </label>

                        <div class="flex gap-2">

                            <input
                                type="text"
                                name="country_code"
                                value="{{ old('country_code', '+92') }}"
                                required
                                class="w-24 rounded-xl border border-gray-200 bg-gray-50 px-3 py-3 text-center text-sm font-medium outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                            <input
                                id="phone_number"
                                name="phone_number"
                                type="text"
                                value="{{ old('phone_number') }}"
                                required
                                autocomplete="tel"
                                placeholder="3001234567"
                                class="min-w-0 flex-1 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                            >

                        </div>

                        @error('country_code')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        @error('phone_number')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Email Address
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            placeholder="you@example.com"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >

                        @error('email')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Password
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Create a password"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >

                        @error('password')
                            <p class="mt-1.5 text-xs font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Confirm Password
                        </label>

                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >

                    </div>


                    {{-- Terms --}}
                    <div class="flex items-start gap-2">

                        <input
                            id="terms"
                            name="terms"
                            type="checkbox"
                            required
                            class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#D7385E] focus:ring-[#D7385E]"
                        >

                        <label
                            for="terms"
                            class="text-xs leading-5 text-gray-500"
                        >
                            I agree to the Shadiyana
                            <span class="font-semibold text-gray-700">
                                Terms & Conditions
                            </span>
                            and
                            <span class="font-semibold text-gray-700">
                                Privacy Policy
                            </span>.
                        </label>

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center rounded-xl bg-[#D7385E] px-4 py-3.5 text-sm font-bold text-white shadow-sm shadow-[#D7385E]/20 transition hover:bg-[#c42f52] focus:outline-none focus:ring-4 focus:ring-[#D7385E]/20"
                    >
                        Create Account
                    </button>

                </form>


                {{-- Login --}}
                <div class="mt-8 border-t border-gray-100 pt-6 text-center">

                    <p class="text-sm text-gray-500">

                        Already have an account?

                        <a
                            href="{{ route('login') }}"
                            class="font-bold text-[#D7385E] hover:underline"
                        >
                            Sign in
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</body>
</html>

