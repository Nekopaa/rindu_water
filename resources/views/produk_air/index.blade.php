@extends('layouts.admin')

@section('title', 'Kelola Produk & Stok Air')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm font-semibold text-slate-700">Daftar katalog produk air mineral beserta pemantauan stok saat ini.</p>
    <a href="{{ route('produk-air.create') }}" class="px-5 py-3 border-3 border-black rounded-xl bg-[#facc15] font-black text-sm shadow-[4px_4px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[5px_5px_0px_#000000] active:translate-y-0.5 active:shadow-[2px_2px_0px_#000000] transition-all">
        ➕ Tambah Produk Baru
    </a>
</div>

<!-- Product Table Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($produk as $p)
    <div class="neo-brutal-card p-6 flex flex-col justify-between space-y-6 @if($p->stok < 15) border-[#f43f5e] bg-red-50/10 @endif">
        
        <!-- Product Head -->
        <div class="space-y-4">
            @if($p->foto_produk)
            <div class="w-full h-44 rounded-xl border-3 border-black overflow-hidden bg-slate-100 shadow-[3px_3px_0px_#000000]">
                <img src="{{ asset('storage/' . $p->foto_produk) }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover">
            </div>
            @else
            <!-- Standard Placeholder Icon for Water -->
            <div class="w-full h-44 rounded-xl border-3 border-black bg-sky-100 flex items-center justify-center shadow-[3px_3px_0px_#000000] text-6xl">
                💧
            </div>
            @endif

            <div class="flex justify-between items-start pt-2">
                <div>
                    <h3 class="font-extrabold text-xl text-black leading-tight">{{ $p->nama_produk }}</h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="px-2 py-0.5 border-2 border-black rounded bg-slate-100 font-bold text-[10px] uppercase">{{ $p->jenis_kemasan }}</span>
                        <span class="px-2 py-0.5 border-2 border-black rounded bg-slate-100 font-bold text-[10px] uppercase">{{ $p->kapasitas }}</span>
                    </div>
                </div>
                <div class="px-3 py-1.5 border-2 border-black rounded-xl bg-[#4ade80] font-black text-sm shadow-[2px_2px_0px_#000000]">
                    Rp {{ number_format($p->harga, 0, ',', '.') }}
                </div>
            </div>

            <p class="text-xs font-semibold text-slate-600 leading-relaxed line-clamp-2">
                {{ $p->deskripsi ?? 'Tidak ada deskripsi untuk produk air mineral ini.' }}
            </p>
        </div>

        <!-- Stock Indicator -->
        <div class="space-y-2 border-t-2 border-black/10 pt-4">
            <div class="flex justify-between items-center text-xs">
                <span class="font-bold text-slate-500">Tingkat Stok Saat Ini:</span>
                <span class="font-black @if($p->stok < 15) text-[#f43f5e] @else text-black @endif">
                    {{ $p->stok }} Unit
                </span>
            </div>
            
            <!-- Progress Bar -->
            <div class="w-full h-4 bg-slate-100 border-2 border-black rounded-full overflow-hidden">
                @php
                    $percent = min(100, max(0, ($p->stok / 200) * 100));
                    $barColor = $p->stok < 15 ? 'bg-[#f43f5e]' : ($p->stok < 50 ? 'bg-[#facc15]' : 'bg-[#4ade80]');
                @endphp
                <div class="{{ $barColor }} h-full border-r-2 border-black rounded-full transition-all duration-300" style="width: {{ $percent }}%"></div>
            </div>

            <div class="flex justify-between items-center text-[10px] font-bold text-slate-400">
                <span>Kosong (0)</span>
                <span>Maks Ideal (200)</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3 pt-2">
            <a href="{{ route('produk-air.edit', $p->id_produk) }}" class="flex-1 px-4 py-2.5 border-2 border-black rounded-xl bg-[#facc15] font-black text-xs text-center shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                ✏️ Edit
            </a>
            
            <form action="{{ route('produk-air.destroy', $p->id_produk) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2.5 border-2 border-black rounded-xl bg-[#f43f5e] text-white font-black text-xs shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                    🗑️ Hapus
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="neo-brutal-card p-12 text-center lg:col-span-3 space-y-4">
        <div class="text-6xl">🏜️</div>
        <h3 class="font-extrabold text-xl text-black">Katalog Produk Kosong</h3>
        <p class="text-sm font-semibold text-slate-500 max-w-md mx-auto">Silakan tambahkan produk air mineral pertama Anda ke dalam sistem.</p>
        <a href="{{ route('produk-air.create') }}" class="inline-block px-6 py-3 border-3 border-black rounded-xl bg-[#facc15] font-black text-sm shadow-[4px_4px_0px_#000000]">
            Tambah Produk Sekarang
        </a>
    </div>
    @endforelse
</div>
@endsection
