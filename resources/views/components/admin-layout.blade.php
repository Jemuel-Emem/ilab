<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ILAB - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none;
        }

        #logo {
            font-family: "Anton", sans-serif;
            font-weight: 600;
            font-size: 30px;
            font-style: normal;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gradient-to-tr from-bermuda via-white to-blue-100">
    <x-notifications position="top-right" />
    <x-dialog />
    <!-- Sidebar -->
    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-cyan-600">
        <div class="h-full px-3 py-4 overflow-y-auto">

            <div class="flex flex-col items-center  mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="ILAB Logo" class="w-20 h-20">
                <span id="logo" class="mt-2 text-white text-xl">ILAB</span>
            </div>


            <ul class="space-y-4">
                <li>
                    <a href="{{ route('Admindashboard') }}"
                        class="flex items-center p-3 text-white rounded-lg hover:bg-cyan-700 hover:shadow-lg transition">
                        <i class="ri-dashboard-fill text-xl"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminadd') }}" class="flex items-center p-3 text-white rounded-lg hover:bg-cyan-700 hover:shadow-lg transition">
                        <i class="ri-survey-line text-xl"></i>
                        <span class="ml-4">Add Services</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-white rounded-lg hover:bg-cyan-700 hover:shadow-lg transition">
                        <i class="ri-profile-fill text-xl"></i>
                        <span class="ml-4">Patient Information</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="flex items-center p-3 text-white rounded-lg hover:bg-cyan-700 hover:shadow-lg transition">
                        <i class="ri-projector-fill text-xl"></i>
                        <span class="ml-4">Daily Transaction</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin-billing') }}" class="flex items-center p-3 text-white rounded-lg hover:bg-cyan-700 hover:shadow-lg transition">
                        <i class="ri-bill-fill text-xl"></i>
                        <span class="ml-4">Billing</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="sm:ml-64">
        <!-- Header -->
        <header class="flex items-center justify-between bg-cyan-700 text-white px-8 py-4">
            <div class="flex items-center">
                {{-- <img src="{{ asset('images/sksu1.png') }}" alt="Logo" class="h-12 w-12"> --}}
                <h1 class="ml-4 text-xl font-semibold">Admin Panel</h1>
            </div>
            <div class="flex items-center">
                <span class="text-sm font-medium">Welcome, {{ Auth::user()->name }}</span>
                <x-dropdown>
                    <x-dropdown.item label="Logout" href="{{ route('logout') }}" />
                </x-dropdown>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-8 bg-white shadow-md rounded-lg mt-6 mx-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
