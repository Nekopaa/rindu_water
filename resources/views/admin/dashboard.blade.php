@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<!-- Metric Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Revenue -->
    <div class="p-6 bg-[#4ade80] border-4 border-black rounded-[20px] shadow-[6px_6px_0px_#000000] hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[8px_8px_0px_#000000] transition-all duration-150 flex flex-col justify-between h-40">
        <div class="flex justify-between items-start">
            <span class="text-xs font-black uppercase tracking-wider text-black/60">Total Pendapatan</span>
            <div class="p-2 border-2 border-black rounded-lg bg-white shadow-[2px_2px_0px_#000000] font-black text-sm">💰</div>
        </div>
        <div>
            <h3 class="text-3xl font-black text-black">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            <p class="text-xs font-bold text-black/80 mt-1">Akumulasi transaksi berhasil</p>
        </div>
    </div>

    <!-- Transactions -->
    <div class="p-6 bg-[#facc15] border-4 border-black rounded-[20px] shadow-[6px_6px_0px_#000000] hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[8px_8px_0px_#000000] transition-all duration-150 flex flex-col justify-between h-40">
        <div class="flex justify-between items-start">
            <span class="text-xs font-black uppercase tracking-wider text-black/60">Total Transaksi</span>
            <div class="p-2 border-2 border-black rounded-lg bg-white shadow-[2px_2px_0px_#000000] font-black text-sm">📦</div>
        </div>
        <div>
            <h3 class="text-3xl font-black text-black">{{ $totalTransaksi }}</h3>
            <p class="text-xs font-bold text-black/80 mt-1">Jumlah pesanan pelanggan</p>
        </div>
    </div>

    <!-- Active Subscriptions -->
    <div class="p-6 bg-[#06b6d4] border-4 border-black rounded-[20px] shadow-[6px_6px_0px_#000000] hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[8px_8px_0px_#000000] transition-all duration-150 flex flex-col justify-between h-40">
        <div class="flex justify-between items-start">
            <span class="text-xs font-black uppercase tracking-wider text-black/60">Pelanggan Aktif</span>
            <div class="p-2 border-2 border-black rounded-lg bg-white shadow-[2px_2px_0px_#000000] font-black text-sm">📅</div>
        </div>
        <div>
            <h3 class="text-3xl font-black text-black">{{ $totalLangganan }}</h3>
            <p class="text-xs font-bold text-black/80 mt-1">Siklus langganan mingguan/bulanan</p>
        </div>
    </div>

    <!-- Active Shipments -->
    <div class="p-6 bg-indigo-400 border-4 border-black rounded-[20px] shadow-[6px_6px_0px_#000000] hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[8px_8px_0px_#000000] transition-all duration-150 flex flex-col justify-between h-40">
        <div class="flex justify-between items-start">
            <span class="text-xs font-black uppercase tracking-wider text-white/60">Pengiriman Aktif</span>
            <div class="p-2 border-2 border-black rounded-lg bg-white shadow-[2px_2px_0px_#000000] font-black text-sm">🚴</div>
        </div>
        <div>
            <h3 class="text-3xl font-black text-white">{{ $activeShipments }}</h3>
            <p class="text-xs font-bold text-white/80 mt-1">Pesanan dalam proses pengiriman</p>
        </div>
    </div>
</div>

<!-- Low Stock & Alert Section -->
@if($lowStockProducts->count() > 0)
<div class="neo-brutal-card border-4 border-black bg-[#f43f5e] p-6 text-white space-y-4">
    <div class="flex items-center space-x-3">
        <div class="w-12 h-12 bg-white border-3 border-black rounded-xl shadow-[3px_3px_0px_#000000] flex items-center justify-center text-2xl">
            ⚠️
        </div>
        <div>
            <h3 class="text-xl font-black text-white">Peringatan: Stok Menipis!</h3>
            <p class="text-sm font-semibold text-white/90">Beberapa produk air mineral berada di bawah ambang batas stok aman (15 unit).</p>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 pt-2">
        @foreach($lowStockProducts as $prod)
        <div class="p-4 bg-white border-3 border-black rounded-xl shadow-[3px_3px_0px_#000000] text-black flex justify-between items-center">
            <div>
                <h4 class="font-extrabold text-sm text-black">{{ $prod->nama_produk }}</h4>
                <p class="text-xs font-bold text-slate-500 capitalize">{{ $prod->jenis_kemasan }} ({{ $prod->kapasitas }})</p>
            </div>
            <div class="px-3 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg font-black text-sm shadow-[2px_2px_0px_#000000]">
                Stok: {{ $prod->stok }}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Dynamic Content Tables Split -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Recent Transactions -->
    <div class="neo-brutal-card p-6 space-y-6 lg:col-span-7">
        <div class="flex justify-between items-center border-b-3 border-black pb-4">
            <div class="flex items-center space-x-2">
                <span class="text-xl">💸</span>
                <h3 class="text-lg font-black text-black">Transaksi Terbaru</h3>
            </div>
            <a href="{{ route('transaksi.index') }}" class="px-3 py-1.5 border-2 border-black rounded-lg bg-[#facc15] font-extrabold text-xs shadow-[2px_2px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                Semua Transaksi
            </a>
        </div>

        @if($recentTransactions->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                        <th class="pb-3 pl-2">Invoice</th>
                        <th class="pb-3">Pelanggan</th>
                        <th class="pb-3">Total</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($recentTransactions as $tx)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 pl-2 font-black text-sm">
                            <a href="{{ route('transaksi.show', $tx->id_transaksi) }}" class="text-blue-600 hover:underline">
                                {{ $tx->kode_invoice }}
                            </a>
                        </td>
                        <td class="py-4">
                            <div class="font-extrabold text-sm text-black">{{ $tx->pelanggan->nama_pelanggan }}</div>
                            <div class="text-xs font-bold text-slate-400">{{ $tx->pelanggan->no_telepon }}</div>
                        </td>
                        <td class="py-4 font-black text-sm text-black">
                            Rp {{ number_format($tx->total_bayar, 0, ',', '.') }}
                        </td>
                        <td class="py-4">
                            @if($tx->status_transaksi === 'selesai')
                                <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Selesai</span>
                            @elseif($tx->status_transaksi === 'dikirim')
                                <span class="px-2.5 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Dikirim</span>
                            @elseif($tx->status_transaksi === 'dibayar')
                                <span class="px-2.5 py-1 bg-[#facc15] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Dibayar</span>
                            @elseif($tx->status_transaksi === 'dibatalkan')
                                <span class="px-2.5 py-1 bg-[#f43f5e] border-2 border-black rounded-lg text-[10px] font-black uppercase text-white shadow-[1.5px_1.5px_0px_#000000]">Batal</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-200 border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-sm font-semibold text-slate-500 py-8 text-center">Belum ada aktivitas transaksi yang tercatat.</p>
        @endif
    </div>

    <!-- Active Shipments -->
    <div class="neo-brutal-card p-6 space-y-6 lg:col-span-5">
        <div class="flex justify-between items-center border-b-3 border-black pb-4">
            <div class="flex items-center space-x-2">
                <span class="text-xl">🚴</span>
                <h3 class="text-lg font-black text-black">Pengiriman Terakhir</h3>
            </div>
            <a href="{{ route('pengiriman.index') }}" class="px-3 py-1.5 border-2 border-black rounded-lg bg-[#06b6d4] font-extrabold text-xs shadow-[2px_2px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                Semua Pengiriman
            </a>
        </div>

        @if($recentShipments->count() > 0)
        <div class="space-y-4">
            @foreach($recentShipments as $ship)
            <div class="p-4 bg-slate-50 border-3 border-black rounded-xl shadow-[3px_3px_0px_#000000] flex justify-between items-center gap-4">
                <div class="min-w-0">
                    <span class="text-xs font-black uppercase text-indigo-500 tracking-wider">INV: {{ $ship->transaksi->kode_invoice }}</span>
                    <h4 class="font-extrabold text-sm text-black truncate mt-1">Tujuan: {{ $ship->alamat_tujuan }}</h4>
                    <p class="text-xs font-semibold text-slate-500 mt-1">Kurir: {{ $ship->kurir->nama_kurir ?? 'Belum ditentukan' }}</p>
                </div>
                <div class="shrink-0">
                    @if($ship->status_pengiriman === 'selesai')
                        <span class="px-2 py-1 bg-[#4ade80] border-2 border-black rounded-md text-[9px] font-black uppercase shadow-[1px_1px_0px_#000000]">Tiba</span>
                    @elseif($ship->status_pengiriman === 'dikirim')
                        <span class="px-2 py-1 bg-[#06b6d4] border-2 border-black rounded-md text-[9px] font-black uppercase shadow-[1px_1px_0px_#000000]">Jalan</span>
                    @elseif($ship->status_pengiriman === 'gagal')
                        <span class="px-2 py-1 bg-[#f43f5e] border-2 border-black rounded-md text-[9px] font-black uppercase text-white shadow-[1px_1px_0px_#000000]">Gagal</span>
                    @else
                        <span class="px-2 py-1 bg-slate-200 border-2 border-black rounded-md text-[9px] font-black uppercase shadow-[1px_1px_0px_#000000]">Proses</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-sm font-semibold text-slate-500 py-8 text-center">Belum ada riwayat pengiriman barang.</p>
        @endif
    </div>
</div>
@endsection
