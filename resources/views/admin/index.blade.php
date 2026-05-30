@extends('layouts.admin')

@section('title', 'Kelola Akun Staff')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm font-semibold text-slate-700">Daftar akun administrative (Staff / Operator) yang mengelola transaksi dan stok.</p>
    <a href="{{ route('admin.create') }}" class="px-5 py-3 border-3 border-black rounded-xl bg-[#facc15] font-black text-sm shadow-[4px_4px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[5px_5px_0px_#000000] active:translate-y-0.5 active:shadow-[2px_2px_0px_#000000] transition-all shrink-0 text-center">
        ➕ Tambah Staff Baru
    </a>
</div>

<!-- Admin Staff Directory -->
<div class="neo-brutal-card p-6 bg-white space-y-6">
    <div class="border-b-3 border-black pb-4 flex justify-between items-center">
        <h3 class="text-xl font-black text-black">Direktori Staff & Admin</h3>
        <span class="px-3 py-1 bg-slate-200 border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
            Total Staff: {{ $admin->count() }}
        </span>
    </div>

    @if($admin->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                    <th class="pb-3 pl-2">Nama Staff</th>
                    <th class="pb-3">Username</th>
                    <th class="pb-3">Email</th>
                    <th class="pb-3">Nomor HP</th>
                    <th class="pb-3">Peran (Role)</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y-2 divide-black/10">
                @foreach($admin as $a)
                <tr class="hover:bg-slate-50 transition-colors">
                    <!-- Nama -->
                    <td class="py-4 pl-2 font-black text-sm text-black">
                        {{ $a->nama_admin }}
                    </td>

                    <!-- Username -->
                    <td class="py-4 font-extrabold text-xs text-indigo-600">
                        @<span>{{ $a->username }}</span>
                    </td>

                    <!-- Email -->
                    <td class="py-4 font-semibold text-xs text-slate-600">
                        ✉️ {{ $a->email }}
                    </td>

                    <!-- Kontak -->
                    <td class="py-4 font-bold text-xs text-slate-500">
                        📞 {{ $a->no_hp ?? '-' }}
                    </td>

                    <!-- Peran -->
                    <td class="py-4">
                        @if($a->role === 'super admin')
                            <span class="px-2.5 py-1 bg-red-400 text-black border-2 border-black rounded-lg text-[9px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Super Admin
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-[9px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Staff Operator
                            </span>
                        @endif
                    </td>

                    <!-- Status -->
                    <td class="py-4">
                        @if($a->status_admin === 'aktif')
                            <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Aktif
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Nonaktif
                            </span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.edit', $a->id_admin) }}" class="px-2.5 py-1 border-2 border-black rounded-lg bg-[#facc15] font-black text-[10px] shadow-[1.5px_1.5px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.destroy', $a->id_admin) }}" method="POST" onsubmit="return confirm('Hapus data staff admin ini?')">
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
        <span class="text-6xl">🔑</span>
        <h4 class="font-extrabold text-lg text-black">Daftar Staff Kosong</h4>
        <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada staff administrative terdaftar.</p>
        <a href="{{ route('admin.create') }}" class="inline-block px-6 py-2.5 border-3 border-black rounded-xl bg-[#facc15] font-black text-xs shadow-[3px_3px_0px_#000000]">
            Tambah Staff Sekarang
        </a>
    </div>
    @endif
</div>
@endsection
