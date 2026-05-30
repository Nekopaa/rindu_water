@extends('layouts.admin')

@section('title', 'Log Mutasi Stok')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Audit trail riwayat penambahan atau pengurangan stok untuk setiap katalog air mineral.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4 flex justify-between items-center">
            <h3 class="text-xl font-black text-black">Log Perubahan Inventaris</h3>
            <span class="px-3 py-1 bg-slate-200 border-2 border-black rounded-lg text-xs font-black">
                Total Catatan: {{ $riwayat->count() }}
            </span>
        </div>

        @if($riwayat->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                        <th class="pb-3 pl-2">Tanggal</th>
                        <th class="pb-3">Produk</th>
                        <th class="pb-3 text-center">Tipe Perubahan</th>
                        <th class="pb-3 text-center">Jumlah</th>
                        <th class="pb-3">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($riwayat as $r)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 pl-2 font-extrabold text-sm text-black">
                            {{ $r->tanggal_perubahan ? \Carbon\Carbon::parse($r->tanggal_perubahan)->translatedFormat('d M Y, H:i') : ($r->created_at ? $r->created_at->translatedFormat('d M Y, H:i') : '-') }}
                        </td>
                        <td class="py-4">
                            <div class="font-extrabold text-sm text-black">{{ $r->produk->nama_produk ?? 'Produk Dihapus' }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase">{{ $r->produk->jenis_kemasan ?? '' }} ({{ $r->produk->kapasitas ?? '' }})</div>
                        </td>
                        <td class="py-4 text-center">
                            @if(in_array(strtolower($r->jenis_perubahan), ['penambahan', 'tambah', 'in']))
                                <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    📈 Masuk
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    📉 Keluar
                                </span>
                            @endif
                        </td>
                        <td class="py-4 text-center font-black text-sm text-black">
                            {{ $r->jumlah }} Unit
                        </td>
                        <td class="py-4 font-semibold text-xs text-slate-600 leading-relaxed max-w-xs">
                            {{ $r->keterangan ?? '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 space-y-4">
            <span class="text-6xl">📝</span>
            <h4 class="font-extrabold text-lg text-black">Log Mutasi Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada aktivitas penambahan atau pengurangan inventaris produk air mineral.</p>
        </div>
        @endif
    </div>
</div>
@endsection
