@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Buat Langganan Baru</h2>

            <form action="{{ route('pelanggan.langganan.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Periode Pengantaran</label>
                    <select name="periode_pengantaran" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                        <option value="">Pilih Periode</option>
                        <option value="Mingguan">Mingguan</option>
                        <option value="Bulanan">Bulanan</option>
                        <option value="Harian">Harian</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Tanggal Berakhir</label>
                    <input type="date" name="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700">Jumlah Pesanan (Galon)</label>
                    <input type="number" name="jumlah_pesanan" value="{{ old('jumlah_pesanan', 1) }}" min="1" class="mt-1 block w-full rounded-xl border-gray-300 shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff]" required>
                </div>
                
                <div class="flex justify-end">
                    <a href="{{ route('pelanggan.dashboard') }}" class="px-4 py-2 bg-gray-300 text-slate-700 rounded-xl mr-2">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-xl">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection