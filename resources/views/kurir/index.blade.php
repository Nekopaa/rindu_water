@extends('layouts.admin')

@section('title', 'Kelola Staff Kurir')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm font-semibold text-slate-700">Daftar petugas pengantar (kurir) beserta info armada kendaraan dan status tugas.</p>
    <a href="{{ route('kurir.create') }}" class="px-5 py-3 border-3 border-black rounded-xl bg-[#facc15] font-black text-sm shadow-[4px_4px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[5px_5px_0px_#000000] active:translate-y-0.5 active:shadow-[2px_2px_0px_#000000] transition-all shrink-0 text-center">
        ➕ Tambah Kurir Baru
    </a>
</div>

<!-- Kurir List Table -->
<div class="neo-brutal-card p-6 bg-white space-y-6">
    <div class="border-b-3 border-black pb-4 flex justify-between items-center">
        <h3 class="text-xl font-black text-black">Direktori Armada Kurir</h3>
        <span class="px-3 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
            Aktif Tugas: {{ $kurir->where('status_kurir', 'aktif')->count() }}
        </span>
    </div>

    @if($kurir->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                    <th class="pb-3 pl-2">Nama Lengkap</th>
                    <th class="pb-3">Nomor HP</th>
                    <th class="pb-3">Armada Kendaraan</th>
                    <th class="pb-3">Plat Nomor</th>
                    <th class="pb-3">Status Kurir</th>
                    <th class="pb-3">Catatan</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y-2 divide-black/10">
                @foreach($kurir as $k)
                <tr class="hover:bg-slate-50 transition-colors">
                    <!-- Nama -->
                    <td class="py-4 pl-2 font-black text-sm text-black">
                        {{ $k->nama_kurir }}
                    </td>

                    <!-- Kontak -->
                    <td class="py-4 font-bold text-xs text-slate-600">
                        📞 {{ $k->no_hp }}
                    </td>

                    <!-- Kendaraan -->
                    <td class="py-4 font-extrabold text-xs text-slate-700 capitalize">
                        🛵 {{ $k->kendaraan }}
                    </td>

                    <!-- Plat Nomor -->
                    <td class="py-4">
                        <span class="px-3 py-1 border-2 border-black rounded bg-white text-black font-black text-xs shadow-[1.5px_1.5px_0px_#000000] tracking-wider">
                            {{ $k->plat_nomor }}
                        </span>
                    </td>

                    <!-- Status -->
                    <td class="py-4">
                        @if($k->status_kurir === 'aktif')
                            <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Aktif
                            </span>
                        @elseif($k->status_kurir === 'istirahat')
                            <span class="px-2.5 py-1 bg-[#facc15] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Istirahat
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Tidak Aktif
                            </span>
                        @endif
                    </td>

                    <!-- Catatan -->
                    <td class="py-4 font-semibold text-xs text-slate-500 max-w-xs truncate">
                        {{ $k->catatan ?? '-' }}
                    </td>

                    <!-- Actions -->
                    <td class="py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('kurir.edit', $k->id_kurir) }}" class="px-2.5 py-1 border-2 border-black rounded-lg bg-[#facc15] font-black text-[10px] shadow-[1.5px_1.5px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                                Edit
                            </a>
                            
                            <form action="{{ route('kurir.destroy', $k->id_kurir) }}" method="POST" onsubmit="return confirm('Hapus data kurir ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 border-2 border-black rounded-lg bg-[#f43f5e] text-white font-black text-[10px] shadow-[1.5px_1.5px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center py-12 space-y-4">
        <span class="text-6xl">🛵</span>
        <h4 class="font-extrabold text-lg text-black">Armada Kurir Kosong</h4>
        <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada staff kurir pengantar yang terdaftar.</p>
        <a href="{{ route('kurir.create') }}" class="inline-block px-6 py-2.5 border-3 border-black rounded-xl bg-[#facc15] font-black text-xs shadow-[3px_3px_0px_#000000]">
            Tambah Kurir Sekarang
        </a>
    </div>
    @endif
</div>
@endsection
