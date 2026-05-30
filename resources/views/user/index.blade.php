@extends('layouts.admin')

@section('title', 'Kelola Akun Pengguna')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm font-semibold text-slate-700">Daftar pengguna (akun) terdaftar di sistem Rindu Water.</p>
    <a href="{{ route('users.create') }}" class="px-5 py-3 border-3 border-black rounded-xl bg-[#facc15] font-black text-sm shadow-[4px_4px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[5px_5px_0px_#000000] active:translate-y-0.5 active:shadow-[2px_2px_0px_#000000] transition-all shrink-0 text-center">
        ➕ Tambah Pengguna Baru
    </a>
</div>

<!-- Users List -->
<div class="neo-brutal-card p-6 bg-white space-y-6">
    <div class="border-b-3 border-black pb-4 flex justify-between items-center">
        <h3 class="text-xl font-black text-black">Direktori Akun Pengguna</h3>
        <span class="px-3 py-1 bg-slate-200 border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
            Total Pengguna: {{ $user->count() }}
        </span>
    </div>

    @if($user->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                    <th class="pb-3 pl-2">Nama Akun</th>
                    <th class="pb-3">Email Pengguna</th>
                    <th class="pb-3">Peran (Role)</th>
                    <th class="pb-3">Tanggal Dibuat</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y-2 divide-black/10">
                @foreach($user as $u)
                <tr class="hover:bg-slate-50 transition-colors">
                    <!-- Nama -->
                    <td class="py-4 pl-2 font-black text-sm text-black">
                        {{ $u->name }}
                    </td>

                    <!-- Email -->
                    <td class="py-4 font-bold text-xs text-slate-600">
                        ✉️ {{ $u->email }}
                    </td>

                    <!-- Role -->
                    <td class="py-4 font-extrabold text-xs">
                        @if($u->role === 'admin')
                            <span class="px-2.5 py-1 bg-purple-500 text-white border-2 border-black rounded-lg text-[10px] uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Admin Portal
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-slate-100 border-2 border-black rounded-lg text-[10px] text-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                                Pembeli (User)
                            </span>
                        @endif
                    </td>

                    <!-- Tanggal Dibuat -->
                    <td class="py-4 font-semibold text-xs text-slate-500">
                        {{ $u->created_at ? $u->created_at->translatedFormat('d M Y') : '-' }}
                    </td>

                    <!-- Actions -->
                    <td class="py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('users.edit', $u->id) }}" class="px-2.5 py-1 border-2 border-black rounded-lg bg-[#facc15] font-black text-[10px] shadow-[1.5px_1.5px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                                Edit
                            </a>
                            
                            <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus akun pengguna ini?')">
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
        <span class="text-6xl">👥</span>
        <h4 class="font-extrabold text-lg text-black">Daftar Pengguna Kosong</h4>
        <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada akun pengguna terdaftar.</p>
        <a href="{{ route('users.create') }}" class="inline-block px-6 py-2.5 border-3 border-black rounded-xl bg-[#facc15] font-black text-xs shadow-[3px_3px_0px_#000000]">
            Tambah Pengguna Sekarang
        </a>
    </div>
    @endif
</div>
@endsection
