<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lead', [LeadController::class, 'index'])->name('lead');
    Route::post('/lead', [LeadController::class, 'store'])->name('lead.store');
    Route::put('/lead/{id}', [LeadController::class, 'update'])->name('lead.update');
    Route::delete('/lead/{id}', [LeadController::class, 'destroy'])->name('lead.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/proyek', [ProyekController::class, 'index'])->name('proyek');
    Route::get('/proyek/create', [ProyekController::class, 'create'])->name('proyek.create');
    Route::post('/proyek', [ProyekController::class, 'store'])->name('proyek.store');
    Route::put('/proyek/{id}', [ProyekController::class, 'update'])->name('proyek.update');
    Route::delete('/proyek/{id}', [ProyekController::class, 'destroy'])->name('proyek.destroy');
    Route::put('/proyek/{proyek}/approval', [ProyekController::class, 'approval'])->name('proyek.approval');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
