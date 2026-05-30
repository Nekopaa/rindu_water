@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Pantau seluruh catatan transaksi, pembayaran, dan atur status pemrosesan pesanan pelanggan.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h3 class="text-xl font-black text-black">Daftar Transaksi Pelanggan</h3>
            <div class="flex gap-2">
                <span class="px-3 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
                    Berhasil: Rp {{ number_format($transaksi->whereIn('status_transaksi', ['dibayar', 'dikirim', 'selesai'])->sum('total_bayar'), 0, ',', '.') }}
                </span>
                <span class="px-3 py-1 bg-[#facc15] border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
                    Total Catatan: {{ $transaksi->count() }}
                </span>
            </div>
        </div>

        @if($transaksi->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                        <th class="pb-3 pl-2">Invoice</th>
                        <th class="pb-3">Pelanggan</th>
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Total Bayar</th>
                        <th class="pb-3">Metode</th>
                        <th class="pb-3">Status Transaksi</th>
                        <th class="pb-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($transaksi as $tx)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Invoice -->
                        <td class="py-4 pl-2 font-black text-sm">
                            <a href="{{ route('transaksi.show', $tx->id_transaksi) }}" class="text-blue-600 hover:underline">
                                {{ $tx->kode_invoice }}
                            </a>
                        </td>
                        
                        <!-- Pelanggan -->
                        <td class="py-4">
                            <div class="font-extrabold text-sm text-black">{{ $tx->pelanggan->nama_pelanggan ?? 'Umum' }}</div>
                            <div class="text-xs font-semibold text-slate-500">{{ $tx->pelanggan->no_telepon ?? '' }}</div>
                        </td>

                        <!-- Tanggal -->
                        <td class="py-4 font-semibold text-xs text-slate-600">
                            {{ $tx->tanggal_transaksi ? \Carbon\Carbon::parse($tx->tanggal_transaksi)->translatedFormat('d M Y, H:i') : ($tx->created_at ? $tx->created_at->translatedFormat('d M Y, H:i') : '-') }}
                        </td>

                        <!-- Total Bayar -->
                        <td class="py-4 font-black text-sm text-black">
                            Rp {{ number_format($tx->total_bayar, 0, ',', '.') }}
                        </td>

                        <!-- Metode Pembayaran -->
                        <td class="py-4 font-bold text-xs capitalize text-black">
                            💳 {{ $tx->metode_pembayaran }}
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4">
                            @if($tx->status_transaksi === 'selesai')
                                <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Selesai</span>
                            @elseif($tx->status_transaksi === 'dikirim')
                                <span class="px-2.5 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Dikirim</span>
                            @elseif($tx->status_transaksi === 'dibayar')
                                <span class="px-2.5 py-1 bg-[#facc15] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Dibayar</span>
                            @elseif($tx->status_transaksi === 'dibatalkan')
                                <span class="px-2.5 py-1 bg-[#f43f5e] border-2 border-black rounded-lg text-[10px] font-black uppercase text-white shadow-[1.5px_1.5px_0px_#000000]">Batal</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-200 border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Menunggu</span>
                            @endif
                        </td>

                        <!-- Action Status Form -->
                        <td class="py-4 text-center">
                            <div class="inline-block" x-data="{ editing: false }">
                                <button @click="editing = !editing" class="px-3 py-1 border-2 border-black rounded-lg bg-[#facc15] font-extrabold text-[11px] shadow-[2px_2px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                                    ⚙️ Atur
                                </button>
                                
                                <!-- Toggle status modal inline -->
                                <div x-show="editing" @click.away="editing = false" class="absolute bg-white border-3 border-black p-4 rounded-xl shadow-[6px_6px_0px_#000000] z-50 mt-2 right-4 w-56 text-left space-y-3" x-cloak>
                                    <h4 class="font-extrabold text-xs text-black border-b-2 border-black pb-1.5">Ubah Status Transaksi</h4>
                                    <form action="{{ route('transaksi.update', $tx->id_transaksi) }}" method="POST" class="space-y-3">
                                        @csrf
                                        @method('PUT')
                                        <select name="status_transaksi" class="w-full border-2 border-black rounded-lg p-1.5 text-xs font-bold outline-none">
                                            <option value="menunggu" {{ $tx->status_transaksi === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="dibayar" {{ $tx->status_transaksi === 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                            <option value="dikirim" {{ $tx->status_transaksi === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ $tx->status_transaksi === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dibatalkan" {{ $tx->status_transaksi === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                        <div class="flex gap-2">
                                            <button type="submit" class="flex-1 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black text-center shadow-[1.5px_1.5px_0px_#000000]">
                                                Simpan
                                            </button>
                                            <button type="button" @click="editing = false" class="flex-1 py-1 bg-slate-200 border-2 border-black rounded-lg text-[10px] font-black text-center shadow-[1.5px_1.5px_0px_#000000]">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 space-y-4">
            <span class="text-6xl">🏜️</span>
            <h4 class="font-extrabold text-lg text-black">Aktivitas Transaksi Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada transaksi pembelian air mineral yang terdata.</p>
        </div>
        @endif
    </div>
</div>
@endsection
