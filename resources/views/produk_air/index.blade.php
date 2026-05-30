@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-slate-800">Kelola Produk Air</h2>
                <a href="{{ route('admin.properties.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[2px_2px_4px_#a3b1c6,-2px_-2px_4px_#ffffff] transition-all">
                    Tambah Produk
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($produk as $item)
                    <div class="bg-[#e0e5ec] rounded-2xl p-4 shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff]">
                        @if($item->foto_produk)
                            <img src="{{ asset('storage/' . $item->foto_produk) }}" alt="{{ $item->nama_produk }}" class="w-full h-32 object-cover rounded-xl mb-3">
                        @endif
                        <h3 class="font-bold text-slate-800">{{ $item->nama_produk }}</h3>
                        <p class="text-sm text-slate-500">{{ $item->jenis_kemasan }} - {{ $item->kapasitas }}</p>
                        <p class="text-lg font-extrabold text-blue-600 mt-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500">Stok: {{ $item->stok }}</p>
                        <div class="flex space-x-2 mt-4">
                            <a href="{{ route('admin.properties.edit', $item->id) }}" class="text-xs bg-yellow-500 text-white px-3 py-1 rounded-lg">Edit</a>
                            <form action="{{ route('admin.properties.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-red-500 text-white px-3 py-1 rounded-lg">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 col-span-3">Belum ada produk</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection