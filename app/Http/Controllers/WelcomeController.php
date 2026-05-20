<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProdukAir;

class WelcomeController extends Controller
{
    /**
     * Show the welcome landing page.
     */
    public function index()
    {
        try {
            if (ProdukAir::count() === 0) {
                ProdukAir::create([
                    'nama_produk' => 'Galon Rindu Keluarga',
                    'jenis_kemasan' => 'galon',
                    'kapasitas' => '1500ml',
                    'harga' => 15000.00,
                    'stok' => 50,
                    'status_produk' => 'tersedia',
                    'tanggal_ditambahkan' => now(),
                    'deskripsi' => 'Air mineral galon higienis ukuran keluarga dari mata air pegunungan pilihan.',
                ]);
                ProdukAir::create([
                    'nama_produk' => 'Rindu Premium Botol',
                    'jenis_kemasan' => 'botol',
                    'kapasitas' => '600ml',
                    'harga' => 5000.00,
                    'stok' => 100,
                    'status_produk' => 'tersedia',
                    'tanggal_ditambahkan' => now(),
                    'deskripsi' => 'Botol 600ml praktis untuk menemani aktivitas harian Anda dengan kesegaran maksimal.',
                ]);
                ProdukAir::create([
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
            $produk = ProdukAir::where('status_produk', 'tersedia')->get();
        } catch (\Exception $e) {
            $produk = collect();
        }
        return view('welcomeblade', compact('produk'));
    }
}
