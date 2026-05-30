@extends('layouts.admin')

@section('title', 'Detail Pengiriman')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <!-- Actions -->
    <div>
        <a href="{{ route('pengiriman.index') }}" class="inline-flex items-center px-4 py-2 border-3 border-black rounded-xl bg-white font-extrabold text-xs shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all gap-2">
            ⬅️ Daftar Pengiriman
        </a>
    </div>

    <!-- Details Sheet -->
    <div class="neo-brutal-card p-8 bg-white border-4 border-black space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between gap-6 border-b-3 border-black pb-6">
            <div class="space-y-2">
                <span class="px-3 py-1 bg-indigo-400 text-white border-2 border-black rounded-md text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                    Pelacakan Logistik
                </span>
                <h2 class="text-3xl font-black text-black">PENGIRIMAN</h2>
                <p class="text-sm font-extrabold text-indigo-600">REF: {{ $pengiriman->transaksi->kode_invoice ?? 'REF-' . $pengiriman->id_pengiriman }}</p>
            </div>
            
            <div class="text-left md:text-right space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase">Jadwal Pengiriman</p>
                <p class="text-sm font-black text-black">
                    {{ $pengiriman->tanggal_pengiriman ? \Carbon\Carbon::parse($pengiriman->tanggal_pengiriman)->translatedFormat('d F Y') : '-' }}
                </p>
                <div class="pt-2">
                    @if($pengiriman->status_pengiriman === 'selesai')
                        <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-xs font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Tiba</span>
                    @elseif($pengiriman->status_pengiriman === 'dikirim')
                        <span class="px-2.5 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-xs font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Jalan</span>
                    @elseif($pengiriman->status_pengiriman === 'gagal')
                        <span class="px-2.5 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg text-xs font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Gagal</span>
                    @else
                        <span class="px-2.5 py-1 bg-slate-200 border-2 border-black rounded-lg text-xs font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Proses</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-b-3 border-black pb-6">
            <!-- Kurir Info -->
            <div class="space-y-3">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Kurir yang Mengirim:</h4>
                @if($pengiriman->kurir)
                <div class="space-y-1">
                    <p class="font-extrabold text-base text-black">🚴 {{ $pengiriman->kurir->nama_kurir }}</p>
                    <p class="text-xs font-semibold text-slate-600">📞 {{ $pengiriman->kurir->no_hp }}</p>
                    <p class="text-xs font-extrabold text-slate-700 pt-1">
                        Armada: <span class="px-2 py-0.5 border border-black bg-slate-100 rounded text-[10px]">{{ $pengiriman->kurir->kendaraan }} ({{ $pengiriman->kurir->plat_nomor }})</span>
                    </p>
                </div>
                @else
                <p class="text-xs font-bold text-red-600">⚠️ Belum ada kurir ditugaskan untuk pengiriman ini.</p>
                @endif
            </div>

            <!-- Alamat Info -->
            <div class="space-y-3">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Tujuan Pengiriman:</h4>
                <div class="space-y-1">
                    <p class="font-extrabold text-base text-black">{{ $pengiriman->transaksi->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
                    <p class="text-xs font-semibold text-slate-600">📞 {{ $pengiriman->transaksi->pelanggan->no_telepon ?? '' }}</p>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed pt-1">
                        📍 {{ $pengiriman->alamat_tujuan }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Detail Item -->
        @if($pengiriman->transaksi && $pengiriman->transaksi->detailPesanan)
        <div class="p-4 bg-slate-50 border-2 border-black rounded-xl space-y-2">
            <h5 class="text-xs font-black text-black">Item yang Dikirim:</h5>
            <div class="flex justify-between items-center text-xs">
                <span class="font-extrabold text-slate-700">
                    💧 {{ $pengiriman->transaksi->detailPesanan->produk->nama_produk ?? 'Air Mineral' }}
                </span>
                <span class="font-black text-black">
                    {{ $pengiriman->transaksi->detailPesanan->jumlah }} Unit
                </span>
            </div>
        </div>
        @endif

        <!-- Bukti Photo & Catatan Kurir -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
            <!-- Bukti Gambar -->
            <div class="space-y-2">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Foto Bukti Pengiriman:</h4>
                @if($pengiriman->foto_bukti_pengiriman)
                <div class="w-full h-48 border-3 border-black rounded-xl overflow-hidden shadow-[3px_3px_0px_#000000]">
                    <img src="{{ asset('storage/' . $pengiriman->foto_bukti_pengiriman) }}" alt="Bukti" class="w-full h-full object-cover">
                </div>
                @else
                <div class="w-full h-48 border-3 border-black border-dashed rounded-xl flex items-center justify-center text-slate-400 font-bold text-xs">
                    📷 Belum ada unggahan foto dari kurir
                </div>
                @endif
            </div>

            <!-- Catatan Driver -->
            <div class="space-y-2">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Catatan Petugas Kurir:</h4>
                <div class="p-4 bg-[#facc15]/10 border-2 border-black rounded-xl h-48 overflow-y-auto">
                    <p class="text-xs font-semibold text-slate-700 leading-relaxed">
                        {{ $pengiriman->catatan_kurir ?? 'Tidak ada catatan khusus dari kurir pengantar.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update Panel for Admin -->
    <div class="neo-brutal-card p-6 bg-white space-y-4">
        <h3 class="font-extrabold text-sm text-black">Perbarui Status Logistik & Catatan</h3>
        
        <form action="{{ route('pengiriman.update', $pengiriman->id_pengiriman) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="status_pengiriman" class="block font-black text-xs text-black">Status Pengiriman</label>
                    <select id="status_pengiriman" name="status_pengiriman" class="neo-brutal-input py-2.5">
                        <option value="proses" {{ $pengiriman->status_pengiriman === 'proses' ? 'selected' : '' }}>Proses Penyiapan Barang</option>
                        <option value="dikirim" {{ $pengiriman->status_pengiriman === 'dikirim' ? 'selected' : '' }}>Sedang di Perjalanan (Jalan)</option>
                        <option value="selesai" {{ $pengiriman->status_pengiriman === 'selesai' ? 'selected' : '' }}>Tiba di Lokasi (Selesai)</option>
                        <option value="gagal" {{ $pengiriman->status_pengiriman === 'gagal' ? 'selected' : '' }}>Pengiriman Gagal</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="catatan_kurir" class="block font-black text-xs text-black">Perbarui Catatan Kurir</label>
                    <input type="text" id="catatan_kurir" name="catatan_kurir" class="neo-brutal-input py-2.5" value="{{ old('catatan_kurir', $pengiriman->catatan_kurir) }}" placeholder="Contoh: Diterima oleh satpam setempat">
                </div>
            </div>

            <button type="submit" class="w-full py-3 border-3 border-black rounded-xl bg-[#4ade80] font-black text-sm shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                💾 Simpan Perubahan Pengiriman
            </button>
        </form>
    </div>
</div>
@endsection
