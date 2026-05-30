<<<<<<< HEAD
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-slate-800">Kelola Pelanggan</h2>
                <a href="{{ route('tenants.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[2px_2px_4px_#a3b1c6,-2px_-2px_4px_#ffffff] transition-all">
                    Tambah Pelanggan
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse($pelanggan as $p)
                    <div class="bg-[#e0e5ec] rounded-2xl p-4 shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff] flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800">{{ $p->nama }}</h3>
                            <p class="text-sm text-slate-500">{{ $p->email ?? $p->no_hp }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('tenants.edit', $p->id) }}" class="text-xs bg-yellow-500 text-white px-3 py-1 rounded-lg">Edit</a>
                            <form action="{{ route('tenants.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-red-500 text-white px-3 py-1 rounded-lg">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada data pelanggan</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
=======
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
>>>>>>> a8c8fecf5ded5d51f8778897db1b0b3bf4da798e
