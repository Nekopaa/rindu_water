<<<<<<< HEAD
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Kelola Pengiriman</h2>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse($pengiriman as $p)
                    <div class="bg-[#e0e5ec] rounded-2xl p-4 shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff] flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800">Pengiriman #{{ $p->id }}</h3>
                            <p class="text-sm text-slate-500">{{ $p->alamat_pengiriman }}</p>
                            <p class="text-xs">Status: {{ $p->status_pengiriman ?? 'Belum dikirim' }}</p>
                        </div>
                        <a href="{{ route('pengiriman.show', $p->id) }}" class="text-xs bg-blue-500 text-white px-3 py-1 rounded-lg">Detail</a>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada data pengiriman</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
=======
@extends('layouts.admin')

@section('title', 'Status Pengiriman')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Pantau proses pengiriman pesanan air mineral dan tugaskan kurir pengantar.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4 flex justify-between items-center">
            <h3 class="text-xl font-black text-black">Registry Pengiriman Barang</h3>
            <div class="flex gap-2">
                <span class="px-3 py-1 bg-indigo-400 text-white border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
                    Dalam Pengiriman: {{ $pengiriman->where('status_pengiriman', 'dikirim')->count() }}
                </span>
                <span class="px-3 py-1 bg-slate-200 border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
                    Total Catatan: {{ $pengiriman->count() }}
                </span>
            </div>
        </div>

        @if($pengiriman->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                        <th class="pb-3 pl-2">Invoice / Ref</th>
                        <th class="pb-3">Kurir Ditugaskan</th>
                        <th class="pb-3">Alamat Tujuan</th>
                        <th class="pb-3">Tanggal Kirim</th>
                        <th class="pb-3">Status Pengiriman</th>
                        <th class="pb-3">Bukti</th>
                        <th class="pb-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($pengiriman as $ship)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Ref / Invoice -->
                        <td class="py-4 pl-2 font-black text-sm">
                            <a href="{{ route('pengiriman.show', $ship->id_pengiriman) }}" class="text-blue-600 hover:underline">
                                {{ $ship->transaksi->kode_invoice ?? 'REF-' . $ship->id_pengiriman }}
                            </a>
                        </td>

                        <!-- Kurir -->
                        <td class="py-4">
                            @if($ship->kurir)
                                <div class="font-extrabold text-sm text-black">🚴 {{ $ship->kurir->nama_kurir }}</div>
                                <div class="text-[10px] font-bold text-slate-400">{{ $ship->kurir->kendaraan }} ({{ $ship->kurir->plat_nomor }})</div>
                            @else
                                <span class="px-2 py-0.5 bg-red-100 border border-red-400 rounded text-[10px] font-extrabold text-red-600">Belum Ditugaskan</span>
                            @endif
                        </td>

                        <!-- Alamat -->
                        <td class="py-4 font-semibold text-xs text-slate-700 max-w-xs truncate">
                            {{ $ship->alamat_tujuan }}
                        </td>

                        <!-- Tanggal -->
                        <td class="py-4 font-bold text-xs text-slate-500">
                            {{ $ship->tanggal_pengiriman ? \Carbon\Carbon::parse($ship->tanggal_pengiriman)->translatedFormat('d M Y') : '-' }}
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4">
                            @if($ship->status_pengiriman === 'selesai')
                                <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Tiba</span>
                            @elseif($ship->status_pengiriman === 'dikirim')
                                <span class="px-2.5 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Jalan</span>
                            @elseif($ship->status_pengiriman === 'gagal')
                                <span class="px-2.5 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Gagal</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-200 border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Proses</span>
                            @endif
                        </td>

                        <!-- Bukti Foto -->
                        <td class="py-4">
                            @if($ship->foto_bukti_pengiriman)
                                <a href="{{ asset('storage/' . $ship->foto_bukti_pengiriman) }}" target="_blank" class="text-xs font-bold text-blue-600 hover:underline">
                                    📷 Lihat Foto
                                </a>
                            @else
                                <span class="text-xs font-bold text-slate-400">Tidak Ada</span>
                            @endif
                        </td>

                        <!-- Actions Link -->
                        <td class="py-4 text-center">
                            <a href="{{ route('pengiriman.show', $ship->id_pengiriman) }}" class="px-3 py-1 border-2 border-black rounded-lg bg-[#06b6d4] font-extrabold text-[11px] shadow-[2px_2px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                                👁️ Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 space-y-4">
            <span class="text-6xl">📦</span>
            <h4 class="font-extrabold text-lg text-black">Aktivitas Pengiriman Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada pengiriman barang yang sedang dijadwalkan.</p>
        </div>
        @endif
    </div>
</div>
@endsection
>>>>>>> a8c8fecf5ded5d51f8778897db1b0b3bf4da798e
