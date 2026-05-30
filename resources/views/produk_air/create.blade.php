<<<<<<< HEAD
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Tambah Produk Air</h2>

            <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Jenis Kemasan</label>
                    <input type="text" name="jenis_kemasan" value="{{ old('jenis_kemasan') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Kapasitas</label>
                    <input type="text" name="kapasitas" value="{{ old('kapasitas') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Status Produk</label>
                    <input type="text" name="status_produk" value="{{ old('status_produk') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Foto Produk</label>
                    <input type="file" name="foto_produk" class="mt-1 block w-full" accept="image/*">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Deskripsi</label>
                    <textarea name="deskripsi" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" rows="3">{{ old('deskripsi') }}</textarea>
                </div>
                
                <div class="flex justify-end">
                    <a href="{{ route('admin.properties.index') }}" class="px-4 py-2 bg-gray-300 text-slate-700 rounded-xl mr-2">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-xl">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
=======
@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('produk-air.index') }}" class="inline-flex items-center px-4 py-2 border-3 border-black rounded-xl bg-white font-extrabold text-xs shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all mb-6 gap-2">
        ⬅️ Kembali ke Katalog
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4">
            <h3 class="text-xl font-black text-black">Formulir Tambah Produk Air Mineral</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Masukkan informasi produk air mineral baru secara teliti.</p>
        </div>

        <form action="{{ route('produk-air.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="nama_produk" class="block font-black text-sm text-black">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" id="nama_produk" name="nama_produk" class="neo-brutal-input @error('nama_produk') border-red-500 @enderror" value="{{ old('nama_produk') }}" required placeholder="Contoh: Galon Rindu Premium">
                @error('nama_produk') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jenis Kemasan -->
                <div class="space-y-2">
                    <label for="jenis_kemasan" class="block font-black text-sm text-black">Jenis Kemasan <span class="text-red-500">*</span></label>
                    <select id="jenis_kemasan" name="jenis_kemasan" class="neo-brutal-input" required>
                        <option value="galon" {{ old('jenis_kemasan') === 'galon' ? 'selected' : '' }}>Galon</option>
                        <option value="botol" {{ old('jenis_kemasan') === 'botol' ? 'selected' : '' }}>Botol</option>
                        <option value="gelas" {{ old('jenis_kemasan') === 'gelas' ? 'selected' : '' }}>Gelas</option>
                    </select>
                    @error('jenis_kemasan') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kapasitas -->
                <div class="space-y-2">
                    <label for="kapasitas" class="block font-black text-sm text-black">Kapasitas (Volume) <span class="text-red-500">*</span></label>
                    <input type="text" id="kapasitas" name="kapasitas" class="neo-brutal-input" value="{{ old('kapasitas') }}" required placeholder="Contoh: 15L, 600ml, 220ml">
                    @error('kapasitas') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Harga -->
                <div class="space-y-2">
                    <label for="harga" class="block font-black text-sm text-black">Harga Jual (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" id="harga" name="harga" class="neo-brutal-input" value="{{ old('harga') }}" required placeholder="Contoh: 15000">
                    @error('harga') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Stok -->
                <div class="space-y-2">
                    <label for="stok" class="block font-black text-sm text-black">Stok Awal <span class="text-red-500">*</span></label>
                    <input type="number" id="stok" name="stok" class="neo-brutal-input" value="{{ old('stok', 0) }}" required placeholder="Contoh: 100">
                    @error('stok') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Status & Photo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="status_produk" class="block font-black text-sm text-black">Status Produk <span class="text-red-500">*</span></label>
                    <select id="status_produk" name="status_produk" class="neo-brutal-input" required>
                        <option value="tersedia" {{ old('status_produk') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="kosong" {{ old('status_produk') === 'kosong' ? 'selected' : '' }}>Kosong</option>
                    </select>
                    @error('status_produk') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="foto_produk" class="block font-black text-sm text-black">Foto Produk</label>
                    <input type="file" id="foto_produk" name="foto_produk" class="neo-brutal-input" accept="image/*">
                    <p class="text-[10px] font-bold text-slate-400">Rekomendasi file JPEG/PNG ukuran maks 2MB</p>
                    @error('foto_produk') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label for="deskripsi" class="block font-black text-sm text-black">Deskripsi Produk</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="neo-brutal-input" placeholder="Tuliskan spesifikasi produk, kelebihan, atau petunjuk penggunaan...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-4 border-3 border-black rounded-xl bg-[#4ade80] font-black text-sm text-black shadow-[4px_4px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                💾 Simpan Produk Air
            </button>
        </form>
    </div>
</div>
@endsection
>>>>>>> a8c8fecf5ded5d51f8778897db1b0b3bf4da798e
