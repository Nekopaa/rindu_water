<?php

namespace Database\Seeders;

use App\Models\ProdukAir;
use Illuminate\Database\Seeder;

class ProdukAirSeeder extends Seeder
{
    public function run(): void
    {
        ProdukAir::firstOrCreate(
            ['nama_produk' => 'Rindu Pure Botol'],
            [
                'jenis_kemasan' => 'botol',
                'kapasitas' => '1500ml',
                'harga' => 6000,
                'stok' => 150,
                'status_produk' => 'tersedia',
                'deskripsi' => 'Air mineral premium Rindu Water ukuran 1500ml, diproses dengan teknologi filtrasi tingkat tinggi untuk kesegaran murni keluarga Anda.',
                'foto_produk' => null,
            ]
        );

        ProdukAir::firstOrCreate(
            ['nama_produk' => 'Rindu Active Botol'],
            [
                'jenis_kemasan' => 'botol',
                'kapasitas' => '600ml',
                'harga' => 3500,
                'stok' => 300,
                'status_produk' => 'tersedia',
                'deskripsi' => 'Kemasan praktis 600ml untuk menemani aktivitas harian Anda. Hidrasi cepat, segar, dan murni kapan saja.',
                'foto_produk' => null,
            ]
        );

        ProdukAir::firstOrCreate(
            ['nama_produk' => 'Rindu Cup Higienis'],
            [
                'jenis_kemasan' => 'gelas',
                'kapasitas' => '220ml',
                'harga' => 1500,
                'stok' => 500,
                'status_produk' => 'tersedia',
                'deskripsi' => 'Air minum dalam kemasan gelas 220ml yang higienis dan praktis. Sangat cocok untuk acara keluarga, rapat, maupun konsumsi harian.',
                'foto_produk' => null,
            ]
        );
    }
}
