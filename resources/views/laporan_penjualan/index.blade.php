@extends('layouts.admin')

@section('title', 'Laporan Keuangan & Penjualan')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Rangkuman performa penjualan air mineral Rindu Water berdasarkan periode pembukuan aktif.</p>

    <!-- Metrics row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Sales Volume -->
        <div class="p-6 bg-pink-400 border-4 border-black rounded-[20px] shadow-[6px_6px_0px_#000000] flex justify-between items-center text-black">
            <div>
                <span class="text-xs font-black uppercase text-black/60 tracking-wider">Total Volume Buku</span>
                <h3 class="text-3xl font-black mt-2">{{ $laporan->count() }} Laporan</h3>
                <p class="text-[10px] font-bold text-black/80 mt-1">Periode laporan keuangan tercatat</p>
            </div>
            <div class="text-4xl">📈</div>
        </div>

        <!-- Accrued Revenue -->
        <div class="p-6 bg-[#4ade80] border-4 border-black rounded-[20px] shadow-[6px_6px_0px_#000000] flex justify-between items-center text-black">
            <div>
                <span class="text-xs font-black uppercase text-black/60 tracking-wider">Akumulasi Omset Buku</span>
                <h3 class="text-3xl font-black mt-2">Rp {{ number_format($laporan->sum('total_pendapatan'), 0, ',', '.') }}</h3>
                <p class="text-[10px] font-bold text-black/80 mt-1">Total seluruh pendapatan laporan</p>
            </div>
            <div class="text-4xl">💰</div>
        </div>

        <!-- Accrued Transactions -->
        <div class="p-6 bg-[#facc15] border-4 border-black rounded-[20px] shadow-[6px_6px_0px_#000000] flex justify-between items-center text-black">
            <div>
                <span class="text-xs font-black uppercase text-black/60 tracking-wider">Akumulasi Transaksi Buku</span>
                <h3 class="text-3xl font-black mt-2">{{ $laporan->sum('total_transaksi') }} Order</h3>
                <p class="text-[10px] font-bold text-black/80 mt-1">Total volume order tercatat</p>
            </div>
            <div class="text-4xl">📦</div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4 flex justify-between items-center">
            <h3 class="text-xl font-black text-black">Arsip Laporan Penjualan</h3>
        </div>

        @if($laporan->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                        <th class="pb-3 pl-2">Periode Laporan</th>
                        <th class="pb-3">Tanggal Dibuat</th>
                        <th class="pb-3 text-center">Jumlah Transaksi</th>
                        <th class="pb-3">Total Pendapatan</th>
                        <th class="pb-3">Produk Terlaris</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($laporan as $lap)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Periode -->
                        <td class="py-4 pl-2 font-black text-sm text-black">
                            📅 {{ $lap->periode_laporan }}
                        </td>

                        <!-- Tanggal Dibuat -->
                        <td class="py-4 font-bold text-xs text-slate-600">
                            {{ $lap->tanggal_dibuat ? \Carbon\Carbon::parse($lap->tanggal_dibuat)->translatedFormat('d M Y') : ($lap->created_at ? $lap->created_at->translatedFormat('d M Y') : '-') }}
                        </td>

                        <!-- Qty Transaksi -->
                        <td class="py-4 text-center font-extrabold text-sm text-black">
                            {{ $lap->total_transaksi }} Order
                        </td>

                        <!-- Total Pendapatan -->
                        <td class="py-4 font-black text-sm text-black">
                            Rp {{ number_format($lap->total_pendapatan, 0, ',', '.') }}
                        </td>

                        <!-- Produk Terlaris -->
                        <td class="py-4 font-extrabold text-xs text-indigo-600">
                            🏆 {{ $lap->produk_terlaris ?? '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 space-y-4">
            <span class="text-6xl">📈</span>
            <h4 class="font-extrabold text-lg text-black">Arsip Laporan Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada arsip laporan bulanan atau tahunan yang dibuat.</p>
        </div>
        @endif
    </div>
</div>
@endsection
