<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukAirController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PelangganDashboardController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\RentalApplicationController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\KurirController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/dashboard', function () {
    return redirect()->route('dashboard.redirect');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard-redirect', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('pelanggan.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard.redirect');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('properties', ProdukAirController::class);
    Route::resource('tenants', PelangganController::class);
    Route::resource('langganan', LanggananController::class)->names([
        'index' => 'admin.langganan.index',
        'create' => 'admin.langganan.create',
        'store' => 'admin.langganan.store',
        'show' => 'admin.langganan.show',
        'edit' => 'admin.langganan.edit',
        'update' => 'admin.langganan.update',
        'destroy' => 'admin.langganan.destroy',
    ]);
    Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('admin.laporan-penjualan');
    Route::resource('pengiriman', PengirimanController::class)->names([
        'index' => 'admin.pengiriman.index',
    ])->only(['index', 'show']);
    Route::resource('kurir', KurirController::class)->names([
        'index' => 'admin.kurir.index',
    ])->only(['index', 'show']);
    
    // Admin Rental Application Routes
    Route::get('/applications', [RentalApplicationController::class, 'adminIndex'])->name('admin.applications.index');
    Route::patch('/applications/{application}', [RentalApplicationController::class, 'adminUpdate'])->name('admin.applications.update');
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');
Route::get('/pelanggan/dashboard', [PelangganDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('pelanggan.dashboard');
Route::get('/pelanggan/langganan/create', function () {
    return view('pelanggan.create_langganan');
})->middleware(['auth', 'verified'])->name('pelanggan.langganan.create');
Route::post('/pelanggan/langganan', [LanggananController::class, 'store'])->middleware(['auth', 'verified'])->name('pelanggan.langganan.store');
Route::get('/pelanggan/pengiriman', [PengirimanController::class, 'index'])->middleware(['auth', 'verified'])->name('pelanggan.pengiriman');
Route::get('/transaksi', [TransaksiController::class, 'index'])->middleware(['auth', 'verified'])->name('transaksi.index');

require __DIR__.'/auth.php';