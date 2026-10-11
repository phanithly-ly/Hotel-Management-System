<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotel Management System') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@100..700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-amber-100 via-orange-50 to-stone-200 dark:from-gray-900 dark:via-stone-900 dark:to-gray-900 bg-fixed text-gray-900 dark:text-gray-100 transition-colors duration-200">

    {{-- Blurred photo background + colour overlay (glassmorphism) --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <img src="{{ asset('images/hotel.png') }}" alt="" class="absolute inset-0 h-full w-full object-cover scale-110 blur-[2px]">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-100/55 via-orange-50/45 to-stone-200/55 dark:from-gray-950/65 dark:via-stone-950/60 dark:to-gray-950/65"></div>
    </div>

    <div class="relative z-10 min-h-screen">
        @include('layouts.navigation')

        @if (isset($header))
            <header>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>