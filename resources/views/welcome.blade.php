<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to PT. Smart CRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Tailwind / Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        
        .wrapper {
            min-height: 100vh; /* Viewport height */
            display: flex;
            flex-direction: column;
        }
        
        .content {
            flex: 1;
        }
        
        .footer {
            position: sticky;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body class="antialiased bg-gray-100 font-sans">
    <div class="wrapper">
        <!-- Navigation -->
        <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-gray-800">
                <i class="bi bi-globe2 mr-2 text-blue-600"></i> PT. Smart CRM
            </div>
            <div class="space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 font-medium hover:text-blue-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 font-medium hover:text-blue-600">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 font-medium bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 transition">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="content flex items-center justify-center text-center p-6">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                    Selamat Datang di <span class="text-blue-600">CRM PT. Smart</span>
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Sistem manajemen relasi pelanggan untuk layanan Internet Service Provider yang lebih profesional dan terorganisir.
                </p>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer text-center text-gray-500 text-sm py-4 bg-white shadow-inner">
            &copy; {{ date('Y') }} PT. Smart. All rights reserved.
        </footer>
    </div>
</body>
</html>