<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::get('/proyek', function () {
    return view('proyek.index');
})->middleware(['auth', 'verified'])->name('proyek');

Route::get('/customer', function () {
    return view('customer.index');
})->middleware(['auth', 'verified'])->name('customer');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
