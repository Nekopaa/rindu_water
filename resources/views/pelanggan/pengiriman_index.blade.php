@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Status Pengiriman Anda</h2>

            <div class="space-y-4">
                @forelse($pengiriman as $p)
                    <div class="bg-[#e0e5ec] rounded-2xl p-4 shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff]">
                        <h3 class="font-bold text-slate-800">Pengiriman #{{ $p->id }}</h3>
                        <p class="text-sm text-slate-500">{{ $p->alamat_pengiriman }}</p>
                        <p class="text-xs">Status: {{ $p->status_pengiriman ?? 'Belum dikirim' }}</p>
                        @if($p->catatan_kurir)
                            <p class="text-xs mt-2">Catatan: {{ $p->catatan_kurir }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada data pengiriman</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection