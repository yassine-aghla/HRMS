<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Aside - Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-4">
            <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
            <nav>
                <ul>
                    <li><a href="{{ route('dashboard') }}" class="block py-2 hover:bg-gray-700">Dashboard</a></li>
                    <li><a href="{{ route('emplois.index') }}" class="block py-2 hover:bg-gray-700">Manage Jobs</a></li>
                     <li><a href="{{ route('formations.index') }}" class="block py-2 hover:bg-gray-700">Manage Formations</a></li> 
                    <li><a href="{{ route('departments.index') }}" class="block py-2 hover:bg-gray-700">Manage Departments</a></li>
                    <li><a href="{{ route('contrats.index') }}" class="block py-2 hover:bg-gray-700">Manage Contracts</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 p-6">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow mb-6">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
