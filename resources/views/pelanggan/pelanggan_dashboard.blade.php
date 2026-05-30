<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px] mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM18.75 21H5.25A2.25 2.25 0 013 18.75V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm font-medium text-slate-500">Anda masuk sebagai Pelanggan Rindu Water.</p>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px] mb-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Produk Tersedia</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse(\App\Models\ProdukAir::where('status_produk', 'available')->get() as $produk)
                        <div class="bg-[#e0e5ec] rounded-2xl p-4 shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff]">
                            @if($produk->foto_produk)
                                <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}" class="w-full h-32 object-cover rounded-xl mb-3">
                            @endif
                            <h4 class="font-bold text-slate-800">{{ $produk->nama_produk }}</h4>
                            <p class="text-sm text-slate-500">{{ $produk->jenis_kemasan }} - {{ $produk->kapasitas }}</p>
                            <p class="text-lg font-extrabold text-blue-600 mt-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <p class="text-xs text-slate-500">Stok: {{ $produk->stok }}</p>
                        </div>
                    @empty
                        <p class="text-slate-500">Tidak ada produk tersedia</p>
                    @endforelse
                </div>
            </div>

            <!-- Customer Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Buat Langganan -->
                <a href="{{ route('pelanggan.langganan.create') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625c0-.66-.56-1.125-1.125-1.125h-12c-.56 0-1.125.465-1.125 1.125v2.625m16.5 0v5.25c0 .621-.504 1.125-1.125 1.125H4.5c-.621 0-1.125-.504-1.125-1.125v-5.25" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Buat Langganan</h4>
                            <p class="text-sm text-slate-500">Pesan paket langganan air</p>
                        </div>
                    </div>
                </a>

                <!-- Status Pengiriman -->
                <a href="{{ route('pelanggan.pengiriman') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zm0-12.5a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Status Pengiriman</h4>
                            <p class="text-sm text-slate-500">Lacak pengiriman air</p>
                        </div>
                    </div>
                </a>

                <!-- Riwayat Pemesanan -->
                <a href="{{ route('transaksi.index') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5V9a2.25 2.25 0 012.25-2.25h6.75v12.75A2.25 2.25 0 018.25 21H4.5A2.25 2.25 0 012.25 18.75V9a2.25 2.25 0 012.25-2.25h6.75v1.5" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Riwayat Pemesanan</h4>
                            <p class="text-sm text-slate-500">Lihat riwayat pembelian</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>