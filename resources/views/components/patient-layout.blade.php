<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ILAB</title>

    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">


    <style>
        [x-cloak] {
            display: none;
        }

        #logo {
            font-family: "Anton", sans-serif;
            font-weight: 600;
            font-size: 30px;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @wireUiScripts
</head>

<body class="font-sans antialiased h-screen bg-gradient-to-tr from-bermuda via-white to-blue-100">
    @livewireScripts
    <x-dialog />
    <x-notifications position="top-left" />

    <!-- Navbar -->
    <div class="w-full bg-cyan-700">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="ILAB Logo" class="w-12 h-12">
                <span id="logo" class="text-orange-500 text-lg lg:text-2xl ml-3">ILAB</span>
            </a>

            <!-- Navbar Links (Hidden on Mobile) -->
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('user-dashboard') }}" class="text-white text-sm hover:text-cyan-300">Home</a>
                <a href="{{ route('user.services') }}" class="text-white text-sm hover:text-cyan-300">Services</a>
                <a href="{{ route('app') }}" class="text-white text-sm hover:text-cyan-300">Appointment</a>
                <a href="#" class="text-white text-sm hover:text-cyan-300">Medical History</a>
                <a href="{{ route('payment') }}" class="text-white text-sm hover:text-cyan-300">Payment</a>

            </nav>

            <!-- User Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
              <a href="{{ route('logout') }}" class="text-white bg-red-700 p-1 rounded-md hover:bg-red-800">Logout</a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="text-white md:hidden" @click="open = !open">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    <path x-show="open" d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
            </button>

            <!-- Mobile Menu (Dropdown) -->
            <nav x-show="open" x-cloak class="absolute top-full left-0 w-full bg-cyan-700 shadow-lg md:hidden">
                <a href="{{ route('user.services') }}" class="block px-4 py-2 text-white hover:bg-cyan-600">Services</a>
                <a href="{{route('app')}}" class="block px-4 py-2 text-white hover:bg-cyan-600">Appointment</a>
                <a href="#" class="block px-4 py-2 text-white hover:bg-cyan-600">Medical History</a>
                <a href="#" class="block px-4 py-2 text-white hover:bg-cyan-600">Payment</a>
                <a href="{{ route('user-dashboard') }}" class="block px-4 py-2 text-white hover:bg-cyan-600">Home</a>
            </nav>
        </div>
    </div>


    <div class="relative flex justify-center mt-8">
        <div class="border-gray-200 rounded-lg dark:border-gray-700">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script> --}}
</body>


</html>

