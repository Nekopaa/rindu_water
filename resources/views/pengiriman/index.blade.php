@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Kelola Pengiriman</h2>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse($pengiriman as $p)
                    <div class="bg-[#e0e5ec] rounded-2xl p-4 shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff] flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800">Pengiriman #{{ $p->id }}</h3>
                            <p class="text-sm text-slate-500">{{ $p->alamat_pengiriman }}</p>
                            <p class="text-xs">Status: {{ $p->status_pengiriman ?? 'Belum dikirim' }}</p>
                        </div>
                        <a href="{{ route('pengiriman.show', $p->id) }}" class="text-xs bg-blue-500 text-white px-3 py-1 rounded-lg">Detail</a>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada data pengiriman</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection