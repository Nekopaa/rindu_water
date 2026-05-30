@extends('layouts.admin')

@section('title', 'Kelola Pelanggan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <p class="text-sm font-semibold text-slate-700">Daftar lengkap pelanggan Rindu Water baik kategori Individu maupun Lembaga/Instansi.</p>
        <span class="px-4 py-2 border-3 border-black rounded-xl bg-white font-black text-xs shadow-[3px_3px_0px_#000000] shrink-0">
            Total Pelanggan: {{ $pelanggan->count() }}
        </span>
    </div>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4 flex justify-between items-center">
            <h3 class="text-xl font-black text-black">Direktori Pelanggan</h3>
        </div>

        @if($pelanggan->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                        <th class="pb-3 pl-2">Jenis</th>
                        <th class="pb-3">Nama Pelanggan</th>
                        <th class="pb-3">Lembaga / Penanggung Jawab</th>
                        <th class="pb-3">Info Kontak</th>
                        <th class="pb-3">Alamat</th>
                        <th class="pb-3">Tanggal Daftar</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($pelanggan as $p)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Jenis Pelanggan -->
                        <td class="py-4 pl-2">
                            @if($p->jenis_pelanggan === 'lembaga')
                                <span class="px-2.5 py-1 bg-indigo-400 text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Lembaga
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-[#facc15] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Individu
                                </span>
                            @endif
                        </td>

                        <!-- Nama Pelanggan -->
                        <td class="py-4 font-black text-sm text-black">
                            {{ $p->nama_pelanggan }}
                        </td>

                        <!-- Lembaga / PJ -->
                        <td class="py-4 font-semibold text-xs text-slate-700">
                            @if($p->jenis_pelanggan === 'lembaga')
                                <div class="font-extrabold text-black">{{ $p->nama_lembaga ?? '-' }}</div>
                                <div class="text-[10px] text-slate-400">PJ: {{ $p->penanggung_jawab }}</div>
                            @else
                                <span class="text-slate-400">Personal (PJ: {{ $p->penanggung_jawab }})</span>
                            @endif
                        </td>

                        <!-- Info Kontak -->
                        <td class="py-4 font-bold text-xs text-slate-600 space-y-0.5">
                            <div>📞 {{ $p->no_telepon }}</div>
                            @if($p->email)
                                <div class="text-[10px] font-bold text-slate-400 truncate">✉️ {{ $p->email }}</div>
                            @endif
                        </td>

                        <!-- Alamat -->
                        <td class="py-4 font-semibold text-xs text-slate-500 max-w-xs truncate">
                            {{ $p->alamat ?? '-' }}
                        </td>

                        <!-- Tanggal Daftar -->
                        <td class="py-4 font-semibold text-xs text-slate-600">
                            {{ $p->tanggal_daftar ? \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d M Y') : '-' }}
                        </td>

                        <!-- Status -->
                        <td class="py-4">
                            @if($p->status_pelanggan === 'aktif')
                                <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Aktif
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                    Nonaktif
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
            <span class="text-6xl">👥</span>
            <h4 class="font-extrabold text-lg text-black">Direktori Pelanggan Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada pelanggan terdaftar di dalam sistem.</p>
        </div>
        @endif
    </div>
</div>
@endsection
