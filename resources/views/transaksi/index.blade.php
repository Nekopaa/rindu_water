@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Riwayat Transaksi</h2>

            <div class="space-y-4">
                @forelse($transaksi as $t)
                    <div class="bg-[#e0e5ec] rounded-2xl p-4 shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff] flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800">Transaksi #{{ $t->id }}</h3>
                            <p class="text-sm text-slate-500">Total: Rp {{ number_format($t->total_harga ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs">Status: {{ $t->status_pembayaran ?? 'Belum bayar' }}</p>
                        </div>
                        <a href="{{ route('transaksi.show', $t->id) }}" class="text-xs bg-blue-500 text-white px-3 py-1 rounded-lg">Detail</a>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada transaksi</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection