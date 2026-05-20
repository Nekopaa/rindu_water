<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\ProdukAir;
use App\Models\Transaksi;
use App\Models\DetailPesanan;
use App\Models\Langganan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a newly created order (transaksi + detail_pesanan) in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk_air,id_produk',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:transfer,tunai,e-wallet',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'catatan' => 'nullable|string',
            'berlangganan' => 'nullable|in:sekali,harian,mingguan,bulanan',
        ]);

        try {
            DB::beginTransaction();

            $produk = ProdukAir::findOrFail($request->id_produk);

            if ($produk->stok < $request->jumlah) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi untuk jumlah pesanan Anda.');
            }

            // Get or create Pelanggan profile for the logged in user
            $pelanggan = Pelanggan::firstOrCreate(
                ['email' => auth()->user()->email],
                [
                    'nama_pelanggan' => auth()->user()->name,
                    'penanggung_jawab' => auth()->user()->name,
                    'jenis_pelanggan' => 'individu',
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                    'status_pelanggan' => 'aktif',
                    'tanggal_daftar' => now(),
                ]
            );

            // Update details if they have changed
            if ($pelanggan->alamat !== $request->alamat || $pelanggan->no_telepon !== $request->no_telepon) {
                $pelanggan->update([
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                ]);
            }

            $totalBayar = $produk->harga * $request->jumlah;
            $kodeInvoice = 'INV-' . time() . '-' . rand(100, 999);

            // Create Transaksi
            $transaksi = Transaksi::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_langganan' => null,
                'tanggal_transaksi' => now(),
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_bayar' => $totalBayar,
                'status_transaksi' => 'dibayar', // Auto-approve payment in mock flow
                'kode_invoice' => $kodeInvoice,
                'catatan' => $request->catatan,
            ]);

            // Create DetailPesanan
            DetailPesanan::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $produk->id_produk,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $produk->harga,
            ]);

            // Adjust Product Stock
            $produk->decrement('stok', $request->jumlah);

            // Handle optional Langganan (Subscription)
            if ($request->has('berlangganan') && in_array($request->berlangganan, ['harian', 'mingguan', 'bulanan'])) {
                $langganan = Langganan::create([
                    'id_pelanggan' => $pelanggan->id_pelanggan,
                    'id_produk' => $produk->id_produk,
                    'periode_pengantaran' => $request->berlangganan,
                    'tanggal_mulai' => now(),
                    'tanggal_berakhir' => now()->addMonths(1),
                    'jumlah_pesanan' => $request->jumlah,
                    'status_langganan' => 'aktif',
                ]);

                // Link the transaksi to this subscription
                $transaksi->update(['id_langganan' => $langganan->id_langganan]);
            }

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Pesanan Anda dengan Invoice ' . $kodeInvoice . ' berhasil ditempatkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda: ' . $e->getMessage());
        }
    }
}
