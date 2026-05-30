@extends('layouts.admin')

@section('title', 'Detail Invoice')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <!-- Actions -->
    <div class="flex justify-between items-center">
        <a href="{{ route('transaksi.index') }}" class="inline-flex items-center px-4 py-2 border-3 border-black rounded-xl bg-white font-extrabold text-xs shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all gap-2">
            ⬅️ Daftar Transaksi
        </a>
        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border-3 border-black rounded-xl bg-[#06b6d4] font-extrabold text-xs shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all gap-2">
            🖨️ Cetak Invoice
        </button>
    </div>

    <!-- Invoice Sheet -->
    <div class="neo-brutal-card p-8 bg-white border-4 border-black space-y-8" id="printable-area">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between gap-6 border-b-3 border-black pb-6">
            <div class="space-y-2">
                <span class="px-3 py-1 bg-[#facc15] border-2 border-black rounded-md text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                    Rindu Water Delivery
                </span>
                <h2 class="text-3xl font-black text-black">INVOICE</h2>
                <p class="text-sm font-extrabold text-blue-600">{{ $transaksi->kode_invoice }}</p>
            </div>
            
            <div class="text-left md:text-right space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase">Tanggal Transaksi</p>
                <p class="text-sm font-black text-black">
                    {{ $transaksi->tanggal_transaksi ? \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('d F Y, H:i') : ($transaksi->created_at ? $transaksi->created_at->translatedFormat('d F Y, H:i') : '-') }}
                </p>
                <div class="pt-2">
                    @if($transaksi->status_transaksi === 'selesai')
                        <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-xs font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Selesai</span>
                    @elseif($transaksi->status_transaksi === 'dikirim')
                        <span class="px-2.5 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-xs font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Dikirim</span>
                    @elseif($transaksi->status_transaksi === 'dibayar')
                        <span class="px-2.5 py-1 bg-[#facc15] border-2 border-black rounded-lg text-xs font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Dibayar</span>
                    @elseif($transaksi->status_transaksi === 'dibatalkan')
                        <span class="px-2.5 py-1 bg-[#f43f5e] border-2 border-black rounded-lg text-xs font-black uppercase text-white shadow-[1.5px_1.5px_0px_#000000]">Batal</span>
                    @else
                        <span class="px-2.5 py-1 bg-slate-200 border-2 border-black rounded-lg text-xs font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Menunggu</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profiles Split -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-b-3 border-black pb-6">
            <!-- Pelanggan Info -->
            <div class="space-y-3">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Ditagihkan Kepada:</h4>
                <div class="space-y-1">
                    <p class="font-extrabold text-base text-black">{{ $transaksi->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
                    <p class="text-xs font-semibold text-slate-600">📞 {{ $transaksi->pelanggan->no_telepon ?? '' }}</p>
                    <p class="text-xs font-semibold text-slate-600">✉️ {{ $transaksi->pelanggan->email ?? '-' }}</p>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed pt-1">
                        📍 {{ $transaksi->pelanggan->alamat ?? '-' }}
                    </p>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="space-y-3">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Rincian Pembayaran:</h4>
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs">
                        <span class="font-semibold text-slate-500">Metode Pembayaran:</span>
                        <span class="font-black text-black capitalize">{{ $transaksi->metode_pembayaran }}</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="font-semibold text-slate-500">Siklus Transaksi:</span>
                        <span class="font-black text-black">
                            {{ $transaksi->id_langganan ? 'Paket Berlangganan' : 'Pemesanan Sekali Beli' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Itemized Table -->
        <div class="space-y-4">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Item Pesanan:</h4>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-black text-xs font-black text-black pb-2">
                            <th>Deskripsi Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-right">Harga Satuan</th>
                            <th class="text-right pl-4">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transaksi->detailPesanan)
                        <tr class="font-semibold text-sm">
                            <td class="py-4">
                                <div class="font-extrabold text-black">{{ $transaksi->detailPesanan->produk->nama_produk ?? 'Produk Air Mineral' }}</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">
                                    {{ $transaksi->detailPesanan->produk->jenis_kemasan ?? '' }} ({{ $transaksi->detailPesanan->produk->kapasitas ?? '' }})
                                </div>
                            </td>
                            <td class="py-4 text-center font-bold text-black">
                                {{ $transaksi->detailPesanan->jumlah }} Unit
                            </td>
                            <td class="py-4 text-right text-slate-600">
                                Rp {{ number_format($transaksi->detailPesanan->harga_satuan, 0, ',', '.') }}
                            </td>
                            <td class="py-4 text-right font-black text-black pl-4">
                                Rp {{ number_format($transaksi->detailPesanan->jumlah * $transaksi->detailPesanan->harga_satuan, 0, ',', '.') }}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="4" class="py-4 text-center text-xs font-bold text-slate-400">Tidak ada rincian item untuk pesanan ini.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Total Sheet -->
            <div class="flex justify-end pt-4 border-t-2 border-black/10">
                <div class="w-full md:w-80 space-y-2">
                    <div class="flex justify-between items-center text-xs">
                        <span class="font-semibold text-slate-500">Subtotal:</span>
                        <span class="font-bold text-black">
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="font-semibold text-slate-500">Biaya Pengiriman:</span>
                        <span class="font-bold text-[#4ade80] uppercase text-[10px] pl-2">Gratis Ongkir</span>
                    </div>
                    <div class="h-0.5 bg-black my-2"></div>
                    <div class="flex justify-between items-center">
                        <span class="font-black text-sm text-black">Total Pembayaran:</span>
                        <span class="font-black text-lg text-black">
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        @if($transaksi->catatan)
        <div class="p-4 bg-slate-50 border-2 border-black rounded-xl space-y-1">
            <h5 class="text-xs font-black text-black">Catatan Pembeli:</h5>
            <p class="text-xs font-semibold text-slate-600 leading-relaxed">{{ $transaksi->catatan }}</p>
        </div>
        @endif
    </div>

    <!-- Status Process Card for Admin -->
    <div class="neo-brutal-card p-6 bg-white space-y-4">
        <h4 class="font-extrabold text-sm text-black">Perbarui Status Pemrosesan</h4>
        <form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST" class="flex flex-col sm:flex-row gap-4">
            @csrf
            @method('PUT')
            
            <div class="flex-1">
                <select name="status_transaksi" class="neo-brutal-input py-3">
                    <option value="menunggu" {{ $transaksi->status_transaksi === 'menunggu' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="dibayar" {{ $transaksi->status_transaksi === 'dibayar' ? 'selected' : '' }}>Sudah Dibayar (Proses)</option>
                    <option value="dikirim" {{ $transaksi->status_transaksi === 'dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                    <option value="selesai" {{ $transaksi->status_transaksi === 'selesai' ? 'selected' : '' }}>Selesai Terkirim</option>
                    <option value="dibatalkan" {{ $transaksi->status_transaksi === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            
            <button type="submit" class="px-6 py-3 border-3 border-black rounded-xl bg-[#4ade80] font-black text-sm shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all shrink-0">
                💾 Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-area, #printable-area * {
            visibility: visible;
        }
        #printable-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection
