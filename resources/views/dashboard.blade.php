<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-lg font-semibold">
                    Selamat datang, {{ Auth::user()->name }}! <br>
                    <span class="text-sm font-normal text-gray-600">
                        Ini adalah halaman utama Sistem CRM.
                    </span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Statistik</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600">{{ $leadCount }}</p>
                            <p class="text-sm text-gray-500">Calon Customer</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-purple-600">{{ $customerCount }}</p>
                            <p class="text-sm text-gray-500">Customer</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600">{{ $proyekCount }}</p>
                            <p class="text-sm text-gray-500">Total Proyek</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-red-600">{{ $produkCount }}</p>
                            <p class="text-sm text-gray-500">Total Produk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
