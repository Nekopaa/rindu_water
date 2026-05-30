@extends('layouts.admin')

@section('title', 'Siklus Paket Langganan')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Daftar pelanggan Rindu Water yang mengaktifkan siklus pengantaran otomatis secara berkala.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4 flex justify-between items-center">
            <h3 class="text-xl font-black text-black">Aktivitas Paket Langganan</h3>
            <span class="px-3 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
                Langganan Aktif: {{ $langganan->where('status_langganan', 'aktif')->count() }}
            </span>
        </div>

        @if($langganan->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                        <th class="pb-3 pl-2">Pelanggan</th>
                        <th class="pb-3">Produk Air</th>
                        <th class="pb-3 text-center">Siklus</th>
                        <th class="pb-3 text-center">Qty / Pengiriman</th>
                        <th class="pb-3">Rentang Tanggal</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($langganan as $lang)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Pelanggan -->
                        <td class="py-4 pl-2">
                            <div class="font-extrabold text-sm text-black">{{ $lang->pelanggan->nama_pelanggan ?? 'Umum' }}</div>
                            <div class="text-[10px] font-bold text-slate-400">{{ $lang->pelanggan->no_telepon ?? '' }}</div>
                        </td>

                        <!-- Produk Air -->
                        <td class="py-4">
                            <div class="font-extrabold text-sm text-black">{{ $lang->produk->nama_produk ?? 'Air Mineral' }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase">
                                {{ $lang->produk->jenis_kemasan ?? '' }} ({{ $lang->produk->kapasitas ?? '' }})
                            </div>
                        </td>

                        <!-- Siklus Periode -->
                        <td class="py-4 text-center">
                            @if(strtolower($lang->periode_pengantaran) === 'mingguan')
                                <span class="px-2.5 py-1 bg-[#facc15] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Mingguan
                                </span>
                            @elseif(strtolower($lang->periode_pengantaran) === 'bulanan')
                                <span class="px-2.5 py-1 bg-indigo-400 text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Bulanan
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-200 border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    {{ $lang->periode_pengantaran }}
                                </span>
                            @endif
                        </td>

                        <!-- Qty -->
                        <td class="py-4 text-center font-black text-sm text-black">
                            {{ $lang->jumlah_pesanan }} Galon / Botol
                        </td>

                        <!-- Rentang Tanggal -->
                        <td class="py-4 font-semibold text-xs text-slate-600">
                            <div>Mulai: {{ \Carbon\Carbon::parse($lang->tanggal_mulai)->translatedFormat('d M Y') }}</div>
                            <div class="text-[10px] font-bold text-slate-400 mt-0.5">Selesai: {{ \Carbon\Carbon::parse($lang->tanggal_berakhir)->translatedFormat('d M Y') }}</div>
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4">
                            @if(strtolower($lang->status_langganan) === 'aktif')
                                <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Aktif
                                </span>
                            @elseif(strtolower($lang->status_langganan) === 'selesai')
                                <span class="px-2.5 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Selesai
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Tidak Aktif
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 space-y-4">
            <span class="text-6xl">📅</span>
            <h4 class="font-extrabold text-lg text-black">Daftar Langganan Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada pelanggan yang membeli paket langganan air mineral mingguan atau bulanan.</p>
        </div>
        @endif
    </div>
</div>
@endsection
