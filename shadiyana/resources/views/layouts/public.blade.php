<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Shadiyana')
    </title>

    <meta
        name="description"
        content="@yield(
            'meta_description',
            'Discover trusted wedding venues, services and vendors across Pakistan with Shadiyana.'
        )"
    >

    {{-- ============================================================
        VITE
    ============================================================= --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    {{-- ============================================================
        ALPINE CLOAK
    ============================================================= --}}

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- ============================================================
        ADDITIONAL PAGE STYLES
    ============================================================= --}}

    @stack('styles')

</head>


<body class="min-h-screen bg-white font-sans text-gray-900 antialiased">

    {{-- ============================================================
        MAIN CONTENT
    ============================================================= --}}

    <main class="min-h-screen">

        @yield('content')

    </main>


    {{-- ============================================================
        PUBLIC FOOTER
    ============================================================= --}}

    <x-public.footer />


    {{-- ============================================================
        ADDITIONAL PAGE SCRIPTS
    ============================================================= --}}

    @stack('scripts')

</body>

</html>