<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Hotel Management System') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@100..700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex relative overflow-hidden bg-gradient-to-br from-stone-50 via-amber-50 to-orange-50">

        {{-- Decorative blobs --}}
        <div class="hidden lg:block absolute -top-20 -right-20 w-72 h-72 rounded-full bg-amber-200/30"></div>
        <div class="hidden lg:block absolute -bottom-24 right-40 w-56 h-56 rounded-full bg-orange-200/30"></div>

        {{-- LEFT: Curved Hotel Image --}}
        <div class="hidden lg:block lg:w-1/2 relative">
            <div class="absolute inset-0 overflow-hidden border-r-[6px] border-amber-500 rounded-r-[50%/40%] shadow-2xl">
                <img src="{{ asset('images/hotel.png') }}" alt="Hotel Management System" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-black/40"></div>

                {{-- Logo --}}
                <div class="absolute top-8 left-8 flex items-center gap-3 text-white">
                    <svg class="w-9 h-9 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2c-2 3-2 5-2 7 0 2 1 3 2 3s2-1 2-3c0-2 0-4-2-7z"/>
                        <path opacity=".8" d="M6 9c-1 2-1 3.5-1 5 0 1.5.8 2.5 2 2.5s2-1 2-2.5c0-1.5-.3-3-1-5-.7 1-1.3 1-2 0z"/>
                        <path opacity=".8" d="M18 9c1 2 1 3.5 1 5 0 1.5-.8 2.5-2 2.5s-2-1-2-2.5c0-1.5.3-3 1-5 .7 1 1.3 1 2 0z"/>
                        <path d="M4 21c1.5-3 4-4 8-4s6.5 1 8 4"/>
                    </svg>
                    <div class="leading-tight">
                        <div class="font-serif text-xl tracking-wide">HOTEL</div>
                        <div class="text-[10px] tracking-[0.3em] text-amber-300">MANAGEMENT SYSTEM</div>
                    </div>
                </div>

                {{-- Headline --}}
                <div class="absolute bottom-28 left-8 right-8 text-white">
                    <h2 class="font-serif text-3xl">Luxury Stay, <span class="italic text-amber-400">Simplified</span></h2>
                    <p class="mt-2 text-sm text-gray-200 max-w-xs">Manage rooms, bookings, and guests all in one place.</p>
                </div>

                {{-- Feature icons --}}
                <div class="absolute bottom-6 left-8 right-10 flex justify-between text-white text-[11px]">
                    <div class="flex flex-col items-center gap-1 w-16">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 18v-6a2 2 0 012-2h14a2 2 0 012 2v6M3 18h18M3 18v2M21 18v2M6 10V7a2 2 0 012-2h2a2 2 0 012 2v3"/></svg>
                        <span class="text-center">Room Management</span>
                    </div>
                    <div class="flex flex-col items-center gap-1 w-16">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-center">Booking System</span>
                    </div>
                    <div class="flex flex-col items-center gap-1 w-16">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m5-3.13a4 4 0 100-8 4 4 0 000 8zm6 3.13a4 4 0 00-2-3.13M4 8.87a4 4 0 012-3.13"/></svg>
                        <span class="text-center">Guest Management</span>
                    </div>
                    <div class="flex flex-col items-center gap-1 w-16">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2zM7 15h4"/></svg>
                        <span class="text-center">Payment Tracking</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: Form --}}
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 py-12 relative z-10">
            <div class="w-full sm:max-w-md">
                <div class="mb-6">
                    <span class="block w-10 h-1 bg-amber-500 rounded mb-4"></span>
                    <p class="text-gray-500 text-sm">Welcome to</p>
                    <h1 class="font-serif text-3xl font-bold text-stone-800">Hotel Management System</h1>
                    <p class="italic text-gray-400 text-sm mt-1">Your hotel, our priority.</p>
                </div>

                <div class="bg-white shadow-xl rounded-2xl px-6 py-8">
                    {{ $slot }}
                </div>

                <p class="text-center text-xs text-gray-400 mt-6 tracking-wide">
                    Better Stays &nbsp;•&nbsp; Happier Guests &nbsp;•&nbsp; Greater Success
                </p>
            </div>
        </div>
    </div>
</body>
</html>