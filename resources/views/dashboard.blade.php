<x-app-layout>
    <style>
        .neo-brutal-input-error {
            border-color: #f43f5e !important;
            box-shadow: 4px 4px 0px #f43f5e !important;
        }
        .neo-brutal-input-error:focus, .neo-brutal-input-error:hover {
            box-shadow: 5px 5px 0px #f43f5e !important;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl text-black leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Success/Error Alerts -->
            @if(session('success'))
                <div id="success-popup" class="fixed inset-0 flex items-center justify-center bg-black/60 z-[9999] transition-all duration-300">
                    <div class="bg-white border-4 border-black p-8 rounded-[24px] shadow-[8px_8px_0px_#000000] max-w-sm w-full mx-4 text-center transform scale-100 transition-all duration-300 space-y-6">
                        <!-- Success Checkmark Graphic (Neobrutalist Check Box) -->
                        <div class="w-16 h-16 bg-[#4ade80] border-3 border-black rounded-2xl shadow-[4px_4px_0px_#000000] flex items-center justify-center mx-auto text-black text-3xl font-black">
                            ✓
                        </div>
                        
                        <div class="space-y-2">
                            <h3 class="text-2xl font-black text-black">Transaksi Berhasil</h3>
                            <p class="text-sm font-bold text-slate-600 leading-relaxed">
                                Pesanan air mineral Anda telah berhasil ditempatkan dan sedang diproses oleh kurir kami.
                            </p>
                        </div>
                        
                        <!-- Progress indicator line -->
                        <div class="w-full bg-gray-200 h-2 border-2 border-black rounded-full overflow-hidden">
                            <div class="bg-[#4ade80] h-full rounded-full transition-all duration-[3000ms] ease-linear w-full" id="popup-progress"></div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const popup = document.getElementById('success-popup');
                        const progress = document.getElementById('popup-progress');
                        
                        // Start progress bar animation by resetting and transitioning
                        if (progress) {
                            progress.style.width = '100%';
                            setTimeout(() => {
                                progress.style.transition = 'width 3s linear';
                                progress.style.width = '0%';
                            }, 50);
                        }
                        
                        // Auto-hide popup after 3 seconds
                        setTimeout(() => {
                            if (popup) {
                                popup.classList.add('opacity-0', 'pointer-events-none');
                                setTimeout(() => {
                                    popup.remove();
                                }, 300);
                            }
                        }, 3000);
                    });
                </script>
            @endif

            @if(session('error'))
                <div class="p-5 bg-[#f43f5e] border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000] text-white font-extrabold flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Main Stats Overview -->
            <div class="bg-white border-4 border-black p-8 rounded-[20px] shadow-[8px_8px_0px_#000000] space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-xl bg-[#facc15] border-3 border-black shadow-[3px_3px_0px_#000000] flex items-center justify-center text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-black">Selamat Datang, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm font-semibold text-slate-700">Kelola pemesanan air mineral dan jadwal langganan otomatis Anda di sini.</p>
                        </div>
                    </div>
                </div>
                
                <div class="h-1 bg-black rounded-full"></div>
                
                <!-- Stats Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Stat Card 1 -->
                    <div class="p-6 bg-[#06b6d4] border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000000] transition-all duration-150 flex flex-col justify-between">
                        <span class="text-xs font-black uppercase tracking-wider text-black bg-white px-2 py-1 rounded border-2 border-black self-start">Total Belanja</span>
                        <span class="text-3xl font-black text-black mt-4">
                            Rp {{ number_format($myTransactions->where('status_transaksi', 'dibayar')->sum('total_bayar'), 0, ',', '.') }}
                        </span>
                        <p class="text-xs font-bold text-black mt-2">Akumulasi seluruh pembayaran pesanan air mineral murni Anda.</p>
                    </div>
                    
                    <!-- Stat Card 2 -->
                    <div class="p-6 bg-[#facc15] border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000000] transition-all duration-150 flex flex-col justify-between">
                        <span class="text-xs font-black uppercase tracking-wider text-black bg-white px-2 py-1 rounded border-2 border-black self-start">Langganan Aktif</span>
                        <span class="text-3xl font-black text-black mt-4">
                            {{ $mySubscriptions->where('status_langganan', 'aktif')->count() }} Paket
                        </span>
                        <p class="text-xs font-bold text-black mt-2">Jumlah siklus pengiriman terjadwal otomatis yang sedang aktif.</p>
                    </div>
                    
                    <!-- Stat Card 3 -->
                    <div class="p-6 bg-[#a78bfa] border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_#000000] transition-all duration-150 flex flex-col justify-between">
                        <span class="text-xs font-black uppercase tracking-wider text-black bg-white px-2 py-1 rounded border-2 border-black self-start">Metode Pengiriman</span>
                        <span class="text-3xl font-black text-black mt-4">Kurir Kilat</span>
                        <p class="text-xs font-bold text-black mt-2">Pengantaran otomatis dari mata air pegunungan langsung ke rumah.</p>
                    </div>
                </div>
            </div>

            <!-- Main Interactive Section: Form & Profile side-by-side -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Column 1: Order Form (8 Columns) -->
                <div class="lg:col-span-8 bg-white border-4 border-black p-8 rounded-[20px] shadow-[8px_8px_0px_#000000] space-y-6">
                    <div class="flex items-center space-x-3">
                        <span class="p-1 bg-[#2563eb] border-2 border-black rounded-full text-white shadow-[2px_2px_0px_#000000]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                        </span>
                        <h3 class="text-2xl font-black text-black">Form Pemesanan Rindu Water</h3>
                    </div>
                    <div class="h-0.5 bg-black rounded-full"></div>

                    <!-- Order Form -->
                    <form id="order-form" action="{{ route('orders.store') }}" method="POST" class="space-y-6" novalidate>
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Selection -->
                            <div>
                                <label for="id_produk" class="block text-sm font-extrabold text-black mb-2">Pilih Varian Air Mineral</label>
                                
                                <select name="id_produk" id="id_produk" required style="display: none;" onchange="updateProductDetails(this)">
                                    <option value="" disabled selected>-- Pilih Produk --</option>
                                    @foreach($availableProducts as $prod)
                                        <option value="{{ $prod->id_produk }}" data-harga="{{ $prod->harga }}" data-stok="{{ $prod->stok }}" data-kapasitas="{{ $prod->kapasitas }}" data-kemasan="{{ $prod->jenis_kemasan }}">
                                            {{ $prod->nama_produk }} ({{ $prod->kapasitas }}) - Rp {{ number_format($prod->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="relative custom-dropdown" id="dropdown-id_produk">
                                    <button type="button" class="neo-brutal-input text-left flex items-center justify-between w-full font-extrabold pr-10 trigger-btn" onclick="toggleCustomDropdown('dropdown-id_produk')">
                                        <span class="selected-text text-slate-500">-- Pilih Varian Air Mineral --</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 transition-transform duration-200 chevron-icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                    <div class="absolute left-0 right-0 mt-2 bg-white border-3 border-black rounded-xl shadow-[5px_5px_0px_#000000] z-50 max-h-60 overflow-y-auto hidden options-list">
                                        @foreach($availableProducts as $prod)
                                            <div class="px-4 py-3 hover:bg-[#facc15] hover:text-black font-extrabold border-b-2 border-black last:border-b-0 cursor-pointer transition-colors option-item text-sm" 
                                                 data-value="{{ $prod->id_produk }}"
                                                 data-text="{{ $prod->nama_produk }} ({{ $prod->kapasitas }}) - Rp {{ number_format($prod->harga, 0, ',', '.') }}">
                                                {{ $prod->nama_produk }} ({{ $prod->kapasitas }}) - Rp {{ number_format($prod->harga, 0, ',', '.') }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div>
                                <label for="jumlah" class="block text-sm font-extrabold text-black mb-2">Jumlah Unit (Qty)</label>
                                <input type="number" name="jumlah" id="jumlah" min="1" value="1" required class="neo-brutal-input w-full" oninput="calculateTotal()" onchange="calculateTotal()">
                            </div>
                        </div>

                        <!-- Product sticker alert / details -->
                        <div id="product-details-sticker" class="hidden p-4 bg-[#fbe5c6] border-3 border-black rounded-xl shadow-[3px_3px_0px_#000000] text-black">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-black uppercase tracking-wider bg-white px-2 py-0.5 border-2 border-black rounded" id="sticker-kemasan">Botol</span>
                                <span class="text-xs font-black" id="sticker-stok">Stok: 0</span>
                            </div>
                            <p class="text-xs font-bold text-slate-700 mt-1" id="sticker-kapasitas">Kapasitas: 1500ml</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Payment Method -->
                            <div>
                                <label for="metode_pembayaran" class="block text-sm font-extrabold text-black mb-2">Metode Pembayaran</label>
                                
                                <select name="metode_pembayaran" id="metode_pembayaran" required style="display: none;">
                                    <option value="transfer" selected>Transfer Bank (Verifikasi Otomatis)</option>
                                    <option value="e-wallet">E-Wallet (OVO / GoPay / ShopeePay)</option>
                                    <option value="tunai">Tunai / COD (Bayar di Tempat)</option>
                                </select>

                                <div class="relative custom-dropdown" id="dropdown-metode_pembayaran">
                                    <button type="button" class="neo-brutal-input text-left flex items-center justify-between w-full font-extrabold pr-10 trigger-btn" onclick="toggleCustomDropdown('dropdown-metode_pembayaran')">
                                        <span class="selected-text text-black">Transfer Bank (Verifikasi Otomatis)</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 transition-transform duration-200 chevron-icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                    <div class="absolute left-0 right-0 mt-2 bg-white border-3 border-black rounded-xl shadow-[5px_5px_0px_#000000] z-50 max-h-60 overflow-y-auto hidden options-list">
                                        <div class="px-4 py-3 hover:bg-[#facc15] hover:text-black font-extrabold border-b-2 border-black last:border-b-0 cursor-pointer transition-colors option-item text-sm" 
                                             data-value="transfer"
                                             data-text="Transfer Bank (Verifikasi Otomatis)">
                                            Transfer Bank (Verifikasi Otomatis)
                                        </div>
                                        <div class="px-4 py-3 hover:bg-[#facc15] hover:text-black font-extrabold border-b-2 border-black last:border-b-0 cursor-pointer transition-colors option-item text-sm" 
                                             data-value="e-wallet"
                                             data-text="E-Wallet (OVO / GoPay / ShopeePay)">
                                            E-Wallet (OVO / GoPay / ShopeePay)
                                        </div>
                                        <div class="px-4 py-3 hover:bg-[#facc15] hover:text-black font-extrabold border-b-2 border-black last:border-b-0 cursor-pointer transition-colors option-item text-sm" 
                                             data-value="tunai"
                                             data-text="Tunai / COD (Bayar di Tempat)">
                                            Tunai / COD (Bayar di Tempat)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subscription Options -->
                            <div>
                                <label for="berlangganan" class="block text-sm font-extrabold text-black mb-2">Siklus Berlangganan (Opsional)</label>
                                
                                <select name="berlangganan" id="berlangganan" style="display: none;">
                                    <option value="sekali" selected>Pemesanan Sekali (Biasa)</option>
                                    <option value="harian">Siklus Harian (Setiap Hari Diantar)</option>
                                    <option value="mingguan">Siklus Mingguan (Setiap Minggu Diantar)</option>
                                    <option value="bulanan">Siklus Bulanan (Setiap Bulan Diantar)</option>
                                </select>

                                <div class="relative custom-dropdown" id="dropdown-berlangganan">
                                    <button type="button" class="neo-brutal-input text-left flex items-center justify-between w-full font-extrabold pr-10 trigger-btn" onclick="toggleCustomDropdown('dropdown-berlangganan')">
                                        <span class="selected-text text-black">Pemesanan Sekali (Biasa)</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 transition-transform duration-200 chevron-icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                    <div class="absolute left-0 right-0 mt-2 bg-white border-3 border-black rounded-xl shadow-[5px_5px_0px_#000000] z-50 max-h-60 overflow-y-auto hidden options-list">
                                        <div class="px-4 py-3 hover:bg-[#facc15] hover:text-black font-extrabold border-b-2 border-black last:border-b-0 cursor-pointer transition-colors option-item text-sm" 
                                             data-value="sekali"
                                             data-text="Pemesanan Sekali (Biasa)">
                                            Pemesanan Sekali (Biasa)
                                        </div>
                                        <div class="px-4 py-3 hover:bg-[#facc15] hover:text-black font-extrabold border-b-2 border-black last:border-b-0 cursor-pointer transition-colors option-item text-sm" 
                                             data-value="harian"
                                             data-text="Siklus Harian (Setiap Hari Diantar)">
                                            Siklus Harian (Setiap Hari Diantar)
                                        </div>
                                        <div class="px-4 py-3 hover:bg-[#facc15] hover:text-black font-extrabold border-b-2 border-black last:border-b-0 cursor-pointer transition-colors option-item text-sm" 
                                             data-value="mingguan"
                                             data-text="Siklus Mingguan (Setiap Minggu Diantar)">
                                            Siklus Mingguan (Setiap Minggu Diantar)
                                        </div>
                                        <div class="px-4 py-3 hover:bg-[#facc15] hover:text-black font-extrabold border-b-2 border-black last:border-b-0 cursor-pointer transition-colors option-item text-sm" 
                                             data-value="bulanan"
                                             data-text="Siklus Bulanan (Setiap Bulan Diantar)">
                                            Siklus Bulanan (Setiap Bulan Diantar)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Phone number -->
                            <div>
                                <label for="no_telepon" class="block text-sm font-extrabold text-black mb-2">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="no_telepon" id="no_telepon" value="{{ $pelanggan->no_telepon ?? '' }}" required placeholder="Contoh: 08123456789" class="neo-brutal-input w-full">
                            </div>

                            <!-- Alamat Pengiriman -->
                            <div>
                                <label for="alamat" class="block text-sm font-extrabold text-black mb-2">Alamat Lengkap Pengiriman</label>
                                <textarea name="alamat" id="alamat" rows="1" required placeholder="Masukkan alamat lengkap pengiriman paket air mineral..." class="neo-brutal-input w-full">{{ $pelanggan->alamat ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label for="catatan" class="block text-sm font-extrabold text-black mb-2">Catatan Tambahan (Opsional)</label>
                            <input type="text" name="catatan" id="catatan" placeholder="Contoh: Taruh di teras rumah depan pintu" class="neo-brutal-input w-full">
                        </div>

                        <!-- Live billing calculation card -->
                        <div class="p-6 bg-[#06b6d4]/10 border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000] flex justify-between items-center">
                            <div>
                                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-widest block">Total Tagihan</span>
                                <span class="text-2xl font-black text-black" id="total-tagihan-text">Rp 0</span>
                            </div>
                            <button type="submit" class="neo-brutal-btn neo-brutal-btn-blue px-6 py-3.5 text-base shadow-[3px_3px_0px_#000000]">
                                Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Column 2: Customer Profile Sticker (4 Columns) -->
                <div class="lg:col-span-4 bg-white border-4 border-black p-8 rounded-[20px] shadow-[8px_8px_0px_#000000] space-y-6">
                    <div class="flex items-center space-x-3">
                        <span class="p-1 bg-[#facc15] border-2 border-black rounded-full text-black shadow-[2px_2px_0px_#000000]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                            </svg>
                        </span>
                        <h3 class="text-xl font-black text-black">Profil Pelanggan</h3>
                    </div>
                    <div class="h-0.5 bg-black rounded-full"></div>

                    @if($pelanggan)
                        <div class="space-y-4 text-sm font-semibold">
                            <div>
                                <span class="block text-xs font-bold text-slate-500">Nama Pelanggan</span>
                                <span class="text-base font-black text-black">{{ $pelanggan->nama_pelanggan }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-500">Email Akun</span>
                                <span class="text-base font-bold text-slate-700">{{ $pelanggan->email }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-500">Nomor Telepon</span>
                                <span class="text-base font-black text-black">{{ $pelanggan->no_telepon }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-500">Alamat Pengiriman Utama</span>
                                <p class="text-sm font-bold text-slate-800 bg-[#F4F2EC] p-3 border-2 border-black rounded-lg shadow-[2px_2px_0px_#000000] mt-1 leading-relaxed">
                                    {{ $pelanggan->alamat }}
                                </p>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-500">Status Akun</span>
                                <span class="inline-block text-xs font-black text-black bg-[#4ade80] px-2.5 py-0.5 border-2 border-black rounded mt-1">
                                    {{ strtoupper($pelanggan->status_pelanggan) }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6 space-y-4">
                            <span class="inline-block p-3 bg-[#fbe5c6] border-2 border-black rounded-full text-black shadow-[2px_2px_0px_#000000]">
                                💡
                            </span>
                            <p class="text-sm font-bold text-slate-600 leading-relaxed">Anda belum menempatkan pesanan pertama Anda. Lengkapi form di sebelah kiri untuk mengisi profil Anda secara otomatis!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section: active subscriptions -->
            <div class="bg-white border-4 border-black p-8 rounded-[20px] shadow-[8px_8px_0px_#000000] space-y-6">
                <div class="flex items-center space-x-3">
                    <span class="p-1 bg-[#a78bfa] border-2 border-black rounded-full text-black shadow-[2px_2px_0px_#000000]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                    </span>
                    <h3 class="text-2xl font-black text-black">Layanan Langganan Otomatis Anda</h3>
                </div>
                <div class="h-0.5 bg-black rounded-full"></div>

                @if($mySubscriptions->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($mySubscriptions as $sub)
                            <div class="p-6 bg-[#a78bfa]/10 border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000] flex flex-col justify-between space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase tracking-wider bg-white px-2 py-0.5 border-2 border-black rounded">
                                        {{ $sub->periode_pengantaran }}
                                    </span>
                                    <span class="inline-block text-xs font-black text-black bg-[#4ade80] px-2 py-0.5 border-2 border-black rounded">
                                        {{ strtoupper($sub->status_langganan) }}
                                    </span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-black text-black leading-tight">{{ $sub->produk->nama_produk ?? 'Air Mineral Rindu' }}</h4>
                                    <p class="text-xs font-bold text-slate-600 mt-1">Kapasitas: {{ $sub->produk->kapasitas ?? '-' }} ({{ $sub->jumlah_pesanan }} Unit per kirim)</p>
                                </div>
                                <div class="pt-2 border-t-2 border-black/10 text-xs font-bold text-slate-700">
                                    <div>Tanggal Mulai: {{ \Carbon\Carbon::parse($sub->tanggal_mulai)->format('d M Y') }}</div>
                                    <div>Tanggal Berakhir: {{ \Carbon\Carbon::parse($sub->tanggal_berakhir)->format('d M Y') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 bg-[#F4F2EC] border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000]">
                        <p class="text-slate-600 font-bold text-sm">Anda belum mengaktifkan layanan langganan pengiriman rutin.</p>
                        <p class="text-slate-500 font-bold text-xs mt-1">Pesan air dengan memilih siklus langganan "Harian", "Mingguan", atau "Bulanan" pada form di atas.</p>
                    </div>
                @endif
            </div>

            <!-- Section: transaction history -->
            <div class="bg-white border-4 border-black p-8 rounded-[20px] shadow-[8px_8px_0px_#000000] space-y-6">
                <div class="flex items-center space-x-3">
                    <span class="p-1 bg-[#06b6d4] border-2 border-black rounded-full text-black shadow-[2px_2px_0px_#000000]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </span>
                    <h3 class="text-2xl font-black text-black">Riwayat Transaksi & Pembelian</h3>
                </div>
                <div class="h-0.5 bg-black rounded-full"></div>

                @if($myTransactions->isNotEmpty())
                    <div class="overflow-x-auto border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000]">
                        <table class="w-full text-left border-collapse bg-white">
                            <thead>
                                <tr class="bg-[#facc15] border-b-3 border-black text-black font-extrabold text-sm">
                                    <th class="p-4 border-r-3 border-black">Kode Invoice</th>
                                    <th class="p-4 border-r-3 border-black">Tanggal</th>
                                    <th class="p-4 border-r-3 border-black">Varian Produk</th>
                                    <th class="p-4 border-r-3 border-black text-center">Jumlah</th>
                                    <th class="p-4 border-r-3 border-black text-right">Total Bayar</th>
                                    <th class="p-4 border-r-3 border-black">Pembayaran</th>
                                    <th class="p-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-bold text-slate-800 division-y-3 division-black">
                                @foreach($myTransactions as $tx)
                                    <tr class="border-b-3 border-black/80 hover:bg-slate-50 transition-colors">
                                        <td class="p-4 border-r-3 border-black/80">
                                            <span class="px-2.5 py-1 bg-[#fbe5c6] border-2 border-black rounded text-xs font-black">
                                                {{ $tx->kode_invoice }}
                                            </span>
                                        </td>
                                        <td class="p-4 border-r-3 border-black/80 text-slate-600">
                                            {{ \Carbon\Carbon::parse($tx->tanggal_transaksi)->format('d M Y - H:i') }}
                                        </td>
                                        <td class="p-4 border-r-3 border-black/80 text-black">
                                            {{ $tx->detailPesanan->produk->nama_produk ?? 'Air Mineral Rindu' }}
                                            <span class="text-xs font-bold text-slate-500 block">({{ $tx->detailPesanan->produk->kapasitas ?? '-' }})</span>
                                        </td>
                                        <td class="p-4 border-r-3 border-black/80 text-center font-extrabold">
                                            {{ $tx->detailPesanan->jumlah ?? 1 }} Unit
                                        </td>
                                        <td class="p-4 border-r-3 border-black/80 text-right font-black text-black">
                                            Rp {{ number_format($tx->total_bayar, 0, ',', '.') }}
                                        </td>
                                        <td class="p-4 border-r-3 border-black/80 uppercase text-xs font-black">
                                            {{ $tx->metode_pembayaran }}
                                        </td>
                                        <td class="p-4">
                                            @if($tx->status_transaksi === 'dibayar' || $tx->status_transaksi === 'selesai')
                                                <span class="px-2.5 py-0.5 bg-[#4ade80] border-2 border-black rounded text-xs font-black text-black uppercase">
                                                    {{ $tx->status_transaksi }}
                                                </span>
                                            @elseif($tx->status_transaksi === 'menunggu')
                                                <span class="px-2.5 py-0.5 bg-[#facc15] border-2 border-black rounded text-xs font-black text-black uppercase">
                                                    {{ $tx->status_transaksi }}
                                                </span>
                                            @else
                                                <span class="px-2.5 py-0.5 bg-[#f43f5e] border-2 border-black rounded text-xs font-black text-white uppercase">
                                                    {{ $tx->status_transaksi }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-10 bg-[#F4F2EC] border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000]">
                        <p class="text-slate-600 font-bold text-sm">Belum ada riwayat transaksi pembayaran.</p>
                        <p class="text-slate-500 font-bold text-xs mt-1">Gunakan form di atas untuk menempatkan pembelian air mineral murni pertama Anda!</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Live calculations Javascript -->
    <script>
        // Toggle custom dropdown visibility
        function toggleCustomDropdown(dropdownId) {
            // Close all other dropdowns first
            document.querySelectorAll('.custom-dropdown').forEach(dropdown => {
                if (dropdown.id !== dropdownId) {
                    dropdown.querySelector('.options-list').classList.add('hidden');
                    dropdown.querySelector('.chevron-icon').classList.remove('rotate-180');
                }
            });

            const dropdown = document.getElementById(dropdownId);
            const list = dropdown.querySelector('.options-list');
            const chevron = dropdown.querySelector('.chevron-icon');
            
            const isHidden = list.classList.contains('hidden');
            if (isHidden) {
                list.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                list.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                document.querySelectorAll('.custom-dropdown .options-list').forEach(list => {
                    list.classList.add('hidden');
                });
                document.querySelectorAll('.custom-dropdown .chevron-icon').forEach(chevron => {
                    chevron.classList.remove('rotate-180');
                });
            }
        });

        function updateProductDetails(select) {
            const sticker = document.getElementById('product-details-sticker');
            const selectedOption = select.options[select.selectedIndex];
            
            if (select.value === '') {
                sticker.classList.add('hidden');
                return;
            }

            const harga = selectedOption.getAttribute('data-harga');
            const stok = selectedOption.getAttribute('data-stok');
            const kapasitas = selectedOption.getAttribute('data-kapasitas');
            const kemasan = selectedOption.getAttribute('data-kemasan');

            document.getElementById('sticker-kemasan').textContent = kemasan.toUpperCase();
            document.getElementById('sticker-stok').textContent = 'Stok: ' + stok;
            document.getElementById('sticker-kapasitas').textContent = 'Kapasitas Varian: ' + kapasitas;

            sticker.classList.remove('hidden');
            calculateTotal();
        }

        function calculateTotal() {
            const select = document.getElementById('id_produk');
            if (select.value === '') return;

            const selectedOption = select.options[select.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga'));
            const qtyInput = document.getElementById('jumlah');
            
            let qty = parseInt(qtyInput.value);
            if (isNaN(qty) || qty < 1) {
                qty = 1;
                qtyInput.value = 1;
            }

            const total = harga * qty;
            const formattedTotal = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('total-tagihan-text').textContent = formattedTotal;
        }

        // Initialize calculations and restrict inputs on load
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('id_produk');
            if (select && select.value !== '') {
                updateProductDetails(select);
            }

            const qtyInput = document.getElementById('jumlah');
            if (qtyInput) {
                // Block mathematical symbols and negative indicators
                qtyInput.addEventListener('keydown', function(e) {
                    if (['-', '+', 'e', 'E', '.'].includes(e.key)) {
                        e.preventDefault();
                    }
                });

                // Automatically coerce values less than 1 or non-numeric back to 1
                qtyInput.addEventListener('input', function() {
                    let val = parseInt(this.value);
                    if (this.value !== '' && (isNaN(val) || val < 1)) {
                        this.value = 1;
                    }
                    calculateTotal();
                });

                qtyInput.addEventListener('blur', function() {
                    let val = parseInt(this.value);
                    if (this.value === '' || isNaN(val) || val < 1) {
                        this.value = 1;
                    }
                    calculateTotal();
                });
            }

            // Set up custom dropdown clicks and synchronization
            document.querySelectorAll('.custom-dropdown').forEach(dropdown => {
                const selectId = dropdown.id.replace('dropdown-', '');
                const nativeSelect = document.getElementById(selectId);
                const triggerBtn = dropdown.querySelector('.trigger-btn');
                const selectedTextSpan = dropdown.querySelector('.selected-text');
                
                dropdown.querySelectorAll('.option-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const val = this.getAttribute('data-value');
                        const text = this.getAttribute('data-text');
                        
                        // Update native select
                        nativeSelect.value = val;
                        // Fire change event on native select to trigger Laravel calculations
                        nativeSelect.dispatchEvent(new Event('change'));
                        
                        // Update UI trigger button text
                        selectedTextSpan.textContent = text;
                        selectedTextSpan.classList.remove('text-slate-500');
                        selectedTextSpan.classList.add('text-black');
                        
                        // Hide options list
                        dropdown.querySelector('.options-list').classList.add('hidden');
                        dropdown.querySelector('.chevron-icon').classList.remove('rotate-180');
                    });
                });

                // Clear dropdown validation errors on change
                if (nativeSelect) {
                    nativeSelect.addEventListener('change', function() {
                        triggerBtn.classList.remove('neo-brutal-input-error');
                        const errMsg = dropdown.querySelector('.error-msg');
                        if (errMsg) errMsg.remove();
                    });
                }
            });

            // Premium Form Validation on Submit
            const orderForm = document.getElementById('order-form');
            if (orderForm) {
                orderForm.addEventListener('submit', function(e) {
                    // Clear previous errors
                    document.querySelectorAll('.neo-brutal-input-error').forEach(el => {
                        el.classList.remove('neo-brutal-input-error');
                    });
                    document.querySelectorAll('.error-msg').forEach(el => {
                        el.remove();
                    });
                    
                    const errors = [];
                    let firstInvalidEl = null;

                    // 1. Validate Product Varian
                    const idProduk = document.getElementById('id_produk');
                    const dropdownProduk = document.getElementById('dropdown-id_produk');
                    if (idProduk && idProduk.value === "") {
                        const triggerBtn = dropdownProduk.querySelector('.trigger-btn');
                        triggerBtn.classList.add('neo-brutal-input-error');
                        
                        const errMsg = document.createElement('p');
                        errMsg.className = 'error-msg text-xs font-black text-[#f43f5e] mt-1';
                        errMsg.textContent = 'Silakan pilih varian air mineral terlebih dahulu!';
                        dropdownProduk.appendChild(errMsg);
                        
                        errors.push({ element: triggerBtn, name: 'Varian Air Mineral' });
                        if (!firstInvalidEl) firstInvalidEl = triggerBtn;
                    }

                    // 2. Validate Qty (jumlah)
                    const jumlah = document.getElementById('jumlah');
                    if (jumlah) {
                        const qtyVal = parseInt(jumlah.value);
                        if (isNaN(qtyVal) || qtyVal < 1) {
                            jumlah.classList.add('neo-brutal-input-error');
                            
                            const errMsg = document.createElement('p');
                            errMsg.className = 'error-msg text-xs font-black text-[#f43f5e] mt-1';
                            errMsg.textContent = 'Jumlah unit wajib diisi dan minimal 1!';
                            jumlah.parentNode.appendChild(errMsg);
                            
                            errors.push({ element: jumlah, name: 'Jumlah Unit' });
                            if (!firstInvalidEl) firstInvalidEl = jumlah;
                        }
                    }

                    // 3. Validate Metode Pembayaran
                    const metodePembayaran = document.getElementById('metode_pembayaran');
                    const dropdownMetode = document.getElementById('dropdown-metode_pembayaran');
                    if (metodePembayaran && metodePembayaran.value === "") {
                        const triggerBtn = dropdownMetode.querySelector('.trigger-btn');
                        triggerBtn.classList.add('neo-brutal-input-error');
                        
                        const errMsg = document.createElement('p');
                        errMsg.className = 'error-msg text-xs font-black text-[#f43f5e] mt-1';
                        errMsg.textContent = 'Silakan pilih metode pembayaran!';
                        dropdownMetode.appendChild(errMsg);
                        
                        errors.push({ element: triggerBtn, name: 'Metode Pembayaran' });
                        if (!firstInvalidEl) firstInvalidEl = triggerBtn;
                    }

                    // 4. Validate Nomor Telepon
                    const noTelepon = document.getElementById('no_telepon');
                    if (noTelepon && noTelepon.value.trim() === "") {
                        noTelepon.classList.add('neo-brutal-input-error');
                        
                        const errMsg = document.createElement('p');
                        errMsg.className = 'error-msg text-xs font-black text-[#f43f5e] mt-1';
                        errMsg.textContent = 'Nomor telepon / WhatsApp wajib diisi!';
                        noTelepon.parentNode.appendChild(errMsg);
                        
                        errors.push({ element: noTelepon, name: 'Nomor Telepon' });
                        if (!firstInvalidEl) firstInvalidEl = noTelepon;
                    }

                    // 5. Validate Alamat Lengkap Pengiriman
                    const alamat = document.getElementById('alamat');
                    if (alamat && alamat.value.trim() === "") {
                        alamat.classList.add('neo-brutal-input-error');
                        
                        const errMsg = document.createElement('p');
                        errMsg.className = 'error-msg text-xs font-black text-[#f43f5e] mt-1';
                        errMsg.textContent = 'Alamat lengkap pengiriman wajib diisi!';
                        alamat.parentNode.appendChild(errMsg);
                        
                        errors.push({ element: alamat, name: 'Alamat Pengiriman' });
                        if (!firstInvalidEl) firstInvalidEl = alamat;
                    }

                    // If there are errors, stop form submission and focus/scroll
                    if (errors.length > 0) {
                        e.preventDefault();
                        
                        // Scroll to the first invalid element container smoothly and center it
                        if (firstInvalidEl) {
                            firstInvalidEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            
                            // Focus after scrolling completes (approx 300ms)
                            setTimeout(() => {
                                firstInvalidEl.focus();
                            }, 300);
                        }
                    }
                });

                // Real-time error removal when user starts typing/editing
                const inputsToWatch = [
                    { id: 'jumlah', type: 'input' },
                    { id: 'no_telepon', type: 'input' },
                    { id: 'alamat', type: 'input' }
                ];
                
                inputsToWatch.forEach(item => {
                    const el = document.getElementById(item.id);
                    if (el) {
                        el.addEventListener(item.type, function() {
                            if (this.value.trim() !== "") {
                                this.classList.remove('neo-brutal-input-error');
                                const errMsg = this.parentNode.querySelector('.error-msg');
                                if (errMsg) errMsg.remove();
                            }
                        });
                    }
                });
            }
        });
    </script>
</x-app-layout>
