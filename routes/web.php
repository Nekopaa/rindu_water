<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukAirController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);



Route::get('/dashboard', function () {
    $availableProperties = \App\Models\ProdukAir::where('status', 'available')->get();
    $myApplications = \App\Models\Pelanggan::with('property')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();
    return view('dashboard', compact('availableProperties', 'myApplications'));
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\RentalApplicationController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    // User Rental Application Route
    Route::post('/applications', [RentalApplicationController::class, 'store'])->name('applications.store');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('properties',ProdukAirController::class);
    Route::resource('tenants', PelangganController::class);
   
    // Admin Rental Application Routes
    Route::get('/applications', [RentalApplicationController::class, 'adminIndex'])->name('admin.applications.index');
    Route::patch('/applications/{application}', [RentalApplicationController::class, 'adminUpdate'])->name('admin.applications.update');
});

require __DIR__.'/auth.php';