<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/produk', function () {
    return view('produk.index');
})->middleware(['auth', 'verified'])->name('produk');

Route::get('/lead', function () {
    return view('lead.index');
})->middleware(['auth', 'verified'])->name('lead');

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
