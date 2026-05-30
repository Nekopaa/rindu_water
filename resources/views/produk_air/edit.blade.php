@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Edit Produk Air</h2>

            <form action="{{ route('admin.properties.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Jenis Kemasan</label>
                    <input type="text" name="jenis_kemasan" value="{{ old('jenis_kemasan', $produk->jenis_kemasan) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Kapasitas</label>
                    <input type="text" name="kapasitas" value="{{ old('kapasitas', $produk->kapasitas) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Status Produk</label>
                    <input type="text" name="status_produk" value="{{ old('status_produk', $produk->status_produk) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Foto Produk</label>
                    @if($produk->foto_produk)
                        <img src="{{ asset('storage/' . $produk->foto_produk) }}" class="w-32 h-32 object-cover rounded-xl mb-2">
                    @endif
                    <input type="file" name="foto_produk" class="mt-1 block w-full" accept="image/*">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Deskripsi</label>
                    <textarea name="deskripsi" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>
                
                <div class="flex justify-end">
                    <a href="{{ route('admin.properties.index') }}" class="px-4 py-2 bg-gray-300 text-slate-700 rounded-xl mr-2">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-xl">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection