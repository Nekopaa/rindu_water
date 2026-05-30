<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px] mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm font-medium text-slate-500">Anda masuk sebagai Administrator Rindu Water.</p>
                    </div>
                </div>
            </div>

            <!-- Admin Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Kelola Produk -->
                <a href="{{ route('produk-air.index') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632A2.25 2.25 0 0118 18.75v-7.5M4.5 7.5l.625 10.632A2.25 2.25 0 006 18.75v-7.5M15 7.5V4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v2.625M4.5 7.5V4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v2.625" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Kelola Produk</h4>
                            <p class="text-sm text-slate-500">Tambah, ubah, hapus produk air</p>
                        </div>
                    </div>
                </a>

                <!-- Kelola Stok -->
                <a href="{{ route('users.index') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m0-18a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 0011.25 21h4.5A2.25 2.25 0 0018 18.75V5.25A2.25 2.25 0 0015.75 3h-4.5z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Kelola Pengguna</h4>
                            <p class="text-sm text-slate-500">Kelola data pelanggan dan admin</p>
                        </div>
                    </div>
                </a>

                <!-- Kelola Langganan -->
                <a href="{{ route('admin.langganan.index') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625c0-.66-.56-1.125-1.125-1.125h-12c-.56 0-1.125.465-1.125 1.125v2.625m16.5 0v5.25c0 .621-.504 1.125-1.125 1.125H4.5c-.621 0-1.125-.504-1.125-1.125v-5.25M19.5 14.25v-2.625c0-.66-.56-1.125-1.125-1.125h-12c-.56 0-1.125.465-1.125 1.125v2.625M19.5 14.25v-2.625c0-.66-.56-1.125-1.125-1.125h-12c-.56 0-1.125.465-1.125 1.125v2.625" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Kelola Langganan</h4>
                            <p class="text-sm text-slate-500">Kelola paket langganan pelanggan</p>
                        </div>
                    </div>
                </a>

                <!-- Kelola Pengiriman -->
                <a href="{{ route('admin.pengiriman.index') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zm0-12.5a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zm0 15.5v-12.5m13.5 0v12.5m0 0a3.75 3.75 0 10-7.5 0 3.75 3.75 0 007.5 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Kelola Pengiriman</h4>
                            <p class="text-sm text-slate-500">Data pengiriman ke pelanggan</p>
                        </div>
                    </div>
                </a>

                <!-- Kelola Kurir -->
                <a href="{{ route('admin.kurir.index') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.388 9.388 0 001.689-3.567 8.428 8.428 0 01-2.455-.674 4.25 4.25 0 00-1.294.754 6.75 6.75 0 01-2.905-2.425 4.25 4.25 0 001.294-.754A8.428 8.428 0 017.5 15.66M12 21a9.388 9.388 0 01-7.689-4.123 10.725 10.725 0 0117.311 0A9.388 9.388 0 0112 21z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Kelola Kurir</h4>
                            <p class="text-sm text-slate-500">Data kurir pengiriman</p>
                        </div>
                    </div>
                </a>

                <!-- Laporan Penjualan -->
                <a href="{{ route('admin.laporan-penjualan') }}" class="block p-6 bg-[#e0e5ec] rounded-2xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[6px_6px_10px_#a3b1c6,-6px_-6px_10px_#ffffff] transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5V9a2.25 2.25 0 012.25-2.25h6.75v1.5M3 13.5V9a2.25 2.25 0 012.25-2.25h6.75v12.75M12.75 21H7.5A2.25 2.25 0 015.25 18.75V9M12.75 21V5.25A2.25 2.25 0 0010.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 004.5 21h6m6-12V6a2.25 2.25 0 00-2.25-2.25h-6a2.25 2.25 0 00-2.25 2.25v12.75A2.25 2.25 0 0010.5 21h6a2.25 2.25 0 002.25-2.25V9z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800">Laporan Penjualan</h4>
                            <p class="text-sm text-slate-500">Statistik dan laporan penjualan</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>