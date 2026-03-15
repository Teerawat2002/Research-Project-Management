<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Research exam</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c2d79c304b.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans text-gray-900 antialiased">
    <div x-data="{ open: false }" class="flex min-h-screen bg-slate-900 flex-col">
        <!-- Sidebar -->
        @include('layouts.navigation')
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div :class="open ? 'ml-64' : 'ml-0 sm:ml-64'" class="flex-1 transition-all duration-200 ease-in-out">
            <!-- Hamburger Menu for Mobile -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:hidden">
                <!-- Hamburger Menu for Mobile (Three Lines) -->
                <button @click="open = !open"
                    class="h-full text-gray-500 hover:text-gray-700 focus:outline-none flex items-center justify-center">
                    <!-- Hamburger Icon (Three Lines) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="text-lg font-bold">{{ config('app.name', 'Laravel') }}</div>
            </header>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>

</html>
