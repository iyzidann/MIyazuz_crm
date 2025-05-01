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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content {
            flex: 1;
        }
        
        .footer {
            margin-top: auto;
            width: 100%;
        }
    </style>
</head>
<body class="antialiased bg-white font-sans flex flex-col">
    <div class="wrapper flex flex-col min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-gray-800">
                <i class="bi bi-globe2 mr-2 text-blue-600"></i> PT. Smart CRM
            </div>
            <div class="space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-m text-gray-700 font-medium hover:text-blue-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-m text-gray-700 font-medium hover:text-blue-600">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-m text-gray-700 font-medium hover:text-blue-600">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            <!-- Hero Section -->
            <div class="bg-white">
                <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-12 lg:px-8">
                    <div class="relative isolate overflow-hidden bg-gray-900 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                        <svg viewBox="0 0 1024 1024" class="absolute top-1/2 left-1/2 -z-10 size-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0" aria-hidden="true">
                            <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)" fill-opacity="0.7" />
                            <defs>
                                <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                                    <stop stop-color="#1e40af" />
                                    <stop offset="1" stop-color="#2563eb" />
                                </radialGradient>
                            </defs>
                        </svg>
                        <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                            <h2 class="text-3xl font-semibold tracking-tight text-balance text-white sm:text-4xl">
                                Tingkatkan Efisiensi Operasional ISP Anda
                            </h2>
                            <p class="mt-6 text-lg/8 text-pretty text-blue-100">
                                Solusi CRM terintegrasi untuk mengelola pelanggan, penjualan, dan layanan internet dengan lebih efisien dan paperless.
                            </p>
                            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 lg:justify-start">
                                <a href="{{ route('register') }}" class="rounded-md bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                                    Mulai Sekarang
                                </a>
                            </div>
                        </div>
                        <div class="relative mt-16 h-80 lg:mt-8 flex items-center justify-center">
                            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                <div class="grid grid-cols-2 gap-8">
                                    <img class="absolute top-12 left-0 w-[57rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10" src="{{ asset('img/image.png') }}" width="1824" height="1080">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer bg-white shadow-inner py-4">
            <div class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} PT. Smart. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>