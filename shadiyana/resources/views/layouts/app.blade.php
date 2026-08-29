<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @hasSection('title')
            @yield('title') - {{ config('app.name', 'Laravel') }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link
    rel="stylesheet"
    href="{{ asset('vendor/markdown-wysiwyg/editor.css') }}"
>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<script src="{{ asset('vendor/markdown-wysiwyg/editor.js') }}"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <div
        x-data="{ sidebarOpen: false }"
        class="min-h-screen"
    >

        {{-- Mobile Overlay --}}
        <div
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm lg:hidden"
            x-cloak
        ></div>

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Area --}}
        <div class="lg:pl-64">

            {{-- Navbar --}}
            @include('layouts.navbar')

            {{-- Page Content --}}
            <main class="min-h-[calc(100vh-72px)] px-4 py-6 sm:px-6 lg:px-8">

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        class="mb-6 flex items-start justify-between gap-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700"
                    >
                        <div class="flex items-center gap-3">
                            <svg
                                class="h-5 w-5 shrink-0"
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

                            <span>{{ session('success') }}</span>
                        </div>

                        <button
                            @click="show = false"
                            class="text-green-600 hover:text-green-800"
                        >
                            &times;
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        class="mb-6 flex items-start justify-between gap-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                    >
                        <div class="flex items-center gap-3">
                            <svg
                                class="h-5 w-5 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>

                            <span>{{ session('error') }}</span>
                        </div>

                        <button
                            @click="show = false"
                            class="text-red-600 hover:text-red-800"
                        >
                            &times;
                        </button>
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div
                        class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700"
                    >
                        <div class="mb-2 flex items-center gap-2 font-semibold">
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
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                            Please fix the following errors:
                        </div>

                        <ul class="ml-7 list-disc space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

    @stack('scripts')

</body>
</html>