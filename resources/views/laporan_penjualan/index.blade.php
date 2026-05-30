@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Laporan Penjualan</h2>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse($laporan as $l)
                    <div class="bg-[#e0e5ec] rounded-2xl p-4 shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff] flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800">Periode: {{ $l->periode }}</h3>
                            <p class="text-sm text-slate-500">Total Penjualan: Rp {{ number_format($l->total_penjualan, 0, ',', '.') }}</p>
                            <p class="text-xs">Tanggal: {{ $l->created_at->format('d M Y') }}</p>
                        </div>
                        <a href="{{ route('admin.laporan-penjualan.show', $l->id) }}" class="text-xs bg-blue-500 text-white px-3 py-1 rounded-lg">Detail</a>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada laporan penjualan</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection