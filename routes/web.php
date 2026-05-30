<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukAirController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\RiwayatStockController;
use App\Http\Controllers\LaporanPenjualanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);



use App\Http\Controllers\OrderController;

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    try {
        if (\App\Models\ProdukAir::count() === 0) {
            \App\Models\ProdukAir::create([
                'nama_produk' => 'Galon Rindu Keluarga',
                'jenis_kemasan' => 'galon',
                'kapasitas' => '1500ml',
                'harga' => 15000.00,
                'stok' => 50,
                'status_produk' => 'tersedia',
                'tanggal_ditambahkan' => now(),
                'deskripsi' => 'Air mineral galon higienis ukuran keluarga dari mata air pegunungan pilihan.',
            ]);
            \App\Models\ProdukAir::create([
                'nama_produk' => 'Rindu Premium Botol',
                'jenis_kemasan' => 'botol',
                'kapasitas' => '600ml',
                'harga' => 5000.00,
                'stok' => 100,
                'status_produk' => 'tersedia',
                'tanggal_ditambahkan' => now(),
                'deskripsi' => 'Botol 600ml praktis untuk menemani aktivitas harian Anda dengan kesegaran maksimal.',
            ]);
            \App\Models\ProdukAir::create([
                'nama_produk' => 'Rindu Cup Praktis',
                'jenis_kemasan' => 'gelas',
                'kapasitas' => '220ml',
                'harga' => 2000.00,
                'stok' => 200,
                'status_produk' => 'tersedia',
                'tanggal_ditambahkan' => now(),
                'deskripsi' => 'Gelas plastik 220ml steril, cocok untuk acara keluarga dan konsumsi cepat.',
            ]);
        }
    } catch (\Exception $e) {
        // Silently catch database issues
    }

    $availableProducts = \App\Models\ProdukAir::where('status_produk', 'tersedia')->get();
    $pelanggan = \App\Models\Pelanggan::where('email', auth()->user()->email)->first();
    
    $myTransactions = collect();
    $mySubscriptions = collect();
    
    if ($pelanggan) {
        $myTransactions = \App\Models\Transaksi::where('id_pelanggan', $pelanggan->id_pelanggan)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $mySubscriptions = \App\Models\Langganan::where('id_pelanggan', $pelanggan->id_pelanggan)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    return view('dashboard', compact('availableProducts', 'myTransactions', 'mySubscriptions', 'pelanggan'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    // User Water Order Route
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('produk-air', ProdukAirController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class)->only(['index', 'show', 'update']);
    Route::resource('langganan', LanggananController::class);
    Route::resource('kurir', KurirController::class);
    Route::resource('pengiriman', PengirimanController::class)->only(['index', 'show', 'update']);
    Route::resource('gudang', GudangController::class);
    Route::resource('riwayat-stock', RiwayatStockController::class)->only(['index', 'show']);
    Route::resource('laporan-penjualan', LaporanPenjualanController::class)->only(['index', 'show']);
});

require __DIR__.'/auth.php';