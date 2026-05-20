<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rindu Water - Purity in Every Drop</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <!-- Neo-brutalism Theme Custom Styles -->
    <style>
        :root {
            --neo-bg: #F4F2EC;
            --neo-yellow: #facc15;
            --neo-blue: #2563eb;
            --neo-cyan: #06b6d4;
            --neo-purple: #a78bfa;
            --neo-border-color: #000000;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--neo-bg);
            color: #000000;
            scroll-behavior: smooth;
        }

        /* Neo-brutalist Card */
        .neo-card {
            background: #ffffff;
            border: 3px solid var(--neo-border-color);
            box-shadow: 6px 6px 0px var(--neo-border-color);
            border-radius: 16px;
            transition: all 0.2s ease;
        }

        .neo-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px var(--neo-border-color);
        }

        /* Interactive Buttons */
        .neo-btn {
            background: #ffffff;
            color: #000000;
            border: 3px solid var(--neo-border-color);
            box-shadow: 4px 4px 0px var(--neo-border-color);
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .neo-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px var(--neo-border-color);
        }

        .neo-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px var(--neo-border-color);
        }

        .neo-btn-primary {
            background: var(--neo-blue);
            color: #ffffff;
        }

        .neo-btn-primary:hover {
            background: #1d4ed8;
        }

        .neo-btn-yellow {
            background: var(--neo-yellow);
            color: #000000;
        }

        .neo-btn-cyan {
            background: var(--neo-cyan);
            color: #000000;
        }

        /* Micro Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(0.5deg); }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <!-- Header Navigation -->
    <header class="fixed top-0 left-0 w-full z-50 py-4 bg-transparent border-b-3 border-transparent transition-all duration-300" id="main-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="main-nav-card" class="bg-white border-3 border-black shadow-[4px_4px_0px_#000000] rounded-2xl px-6 py-4 flex items-center justify-between transition-all duration-300">
                <!-- Brand Logo -->
                <a href="#" class="flex items-center space-x-2 group">
                    <span class="p-1 bg-[#facc15] border-2 border-black rounded-full text-black shadow-[2px_2px_0px_#000000] group-hover:scale-105 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                        </svg>
                    </span>
                    <span class="text-xl font-extrabold tracking-tight text-black">Rindu <span class="text-blue-600">Water</span></span>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-extrabold text-black">
                    <a href="#home" class="hover:text-blue-600 transition-colors">Home</a>
                    <a href="#keunggulan" class="hover:text-blue-600 transition-colors">Keunggulan</a>
                    <a href="#produk" class="hover:text-blue-600 transition-colors">Produk Kami</a>
                    <a href="#layanan" class="hover:text-blue-600 transition-colors">Jadwal Langganan</a>
                </nav>

                <!-- Authentication CTAs -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="neo-btn px-5 py-2.5 text-sm font-bold bg-[#facc15]">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="neo-btn px-5 py-2.5 text-sm font-bold bg-[#f43f5e] text-white">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-extrabold text-black hover:text-blue-600 transition-colors px-3 py-2">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="neo-btn neo-btn-primary px-6 py-2.5 text-sm">
                                Daftar Sekarang
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="relative pt-52 pb-44 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left Information -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <span class="inline-flex items-center px-4 py-1.5 rounded-xl text-xs font-extrabold tracking-wider text-black bg-[#facc15] border-2 border-black shadow-[2px_2px_0px_#000000] uppercase">
                        💧 KEMURNIAN TERJAMIN & STERIL
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-black leading-none sm:leading-tight lg:leading-[1.15]">
                        Kemurnian Alami dari Pegunungan,<br class="hidden sm:inline">
                        <span class="mt-3 sm:mt-4 bg-[#06b6d4] text-black px-4 py-2 border-3 border-black inline-block rounded-xl shadow-[4px_4px_0px_#000000] transform -rotate-1">
                            Langsung ke Rumah Anda
                        </span>
                    </h1>
                    <p class="text-lg text-slate-700 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-semibold">
                        Rindu Water menghadirkan air mineral pegunungan berkualitas tinggi yang steril, kaya mineral alami, serta diproses higienis untuk menjaga hidrasi terbaik keluarga tercinta.
                    </p>

                    <!-- Interactive CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#produk" class="w-full sm:w-auto px-8 py-4 rounded-xl text-center font-extrabold text-white neo-btn neo-btn-primary text-base">
                            Lihat Produk Kami
                        </a>
                        <a href="#keunggulan" class="w-full sm:w-auto px-8 py-4 rounded-xl text-center font-extrabold text-black neo-btn text-base">
                            Pelajari Keunggulan
                        </a>
                    </div>

                    <!-- Stats grid widget -->
                    <div class="grid grid-cols-3 gap-4 pt-8 max-w-lg mx-auto lg:mx-0 border-t-3 border-black">
                        <div class="text-center lg:text-left">
                            <span class="block text-2xl lg:text-3xl font-black text-black">10k+</span>
                            <span class="text-xs font-extrabold text-slate-600 uppercase tracking-wider">Pelanggan</span>
                        </div>
                        <div class="text-center lg:text-left border-x-3 border-black px-4">
                            <span class="block text-2xl lg:text-3xl font-black text-[#2563eb]">99.9%</span>
                            <span class="text-xs font-extrabold text-slate-600 uppercase tracking-wider">Kemurnian</span>
                        </div>
                        <div class="text-center lg:text-left pl-4">
                            <span class="block text-2xl lg:text-3xl font-black text-black">15+</span>
                            <span class="text-xs font-extrabold text-slate-600 uppercase tracking-wider">Wilayah</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Right outlined vector Water Bottle Graphic -->
                <div class="lg:col-span-5 flex justify-center relative">
                    <div class="floating-element w-72 sm:w-80 lg:w-96 select-none">
                        <!-- Outlined Brutalist Water Bottle Vector Graphic -->
                        <svg viewBox="0 0 500 600" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                            <!-- Background Bubbles (Brutalist Dot style) -->
                            <circle cx="100" cy="400" r="16" fill="#06b6d4" stroke="#000000" stroke-width="4"/>
                            <circle cx="420" cy="250" r="12" fill="#facc15" stroke="#000000" stroke-width="4"/>
                            <circle cx="380" cy="450" r="22" fill="#a78bfa" stroke="#000000" stroke-width="4"/>
                            
                            <!-- Sleek Outlined Brutalist Water Bottle Outer Shell -->
                            <rect x="175" y="240" width="150" height="280" rx="20" fill="#ffffff" stroke="#000000" stroke-width="6"/>
                            <!-- Neck -->
                            <path d="M220 240 L220 180 C220 160 235 160 235 160 L265 160 C265 160 280 160 280 180 L280 240" fill="#ffffff" stroke="#000000" stroke-width="6"/>
                            <!-- Cap (Bold Blue Cap) -->
                            <rect x="225" y="125" width="50" height="35" rx="6" fill="#2563eb" stroke="#000000" stroke-width="6"/>
                            
                            <!-- Water volume inside bottle -->
                            <rect x="184" y="270" width="132" height="242" rx="12" fill="#06b6d4" stroke="#000000" stroke-width="4"/>
                            <!-- Water Surface wave curve -->
                            <path d="M184 270 Q215 255 250 270 T316 270" fill="none" stroke="#000000" stroke-width="4"/>
                            
                            <!-- Stark Reflection Line -->
                            <line x1="200" y1="290" x2="200" y2="490" stroke="#ffffff" stroke-width="12" stroke-linecap="round" />
                            
                            <!-- Solid shadow drop below bottle -->
                            <ellipse cx="250" cy="545" rx="90" ry="12" fill="#000000" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section id="keunggulan" class="py-24 border-t-4 border-black bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto mb-18 space-y-4">
                <span class="text-xs font-extrabold tracking-widest text-[#2563eb] bg-[#facc15] px-3 py-1 border-2 border-black rounded-lg uppercase">✨ Mengapa Memilih Kami?</span>
                <h2 class="text-3xl sm:text-4xl font-black text-black">
                    Kualitas Terbaik untuk Hidrasi Sehat Anda
                </h2>
                <div class="w-24 h-2 bg-black rounded-full mx-auto"></div>
            </div>

            <!-- Features Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="neo-card p-8 bg-[#06b6d4] flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-xl bg-white border-3 border-black shadow-[3px_3px_0px_#000000] flex items-center justify-center text-black mb-6">
                            <!-- Mountain Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5M12 18.75V21m-7.5-7.5h1.5m12 0h1.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-black mb-3">100% Mata Air Pilihan</h3>
                        <p class="text-black font-semibold text-sm leading-relaxed">
                            Diambil langsung dari sumber mata air vulkanik alam terdalam yang kaya akan nutrisi mineral mikro penting yang dibutuhkan tubuh setiap hari.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="neo-card p-8 bg-[#facc15] flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-xl bg-white border-3 border-black shadow-[3px_3px_0px_#000000] flex items-center justify-center text-black mb-6">
                            <!-- Shield check icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-black mb-3">Filtrasi Ozon & UV</h3>
                        <p class="text-black font-semibold text-sm leading-relaxed">
                            Diproses dengan sistem filtrasi canggih multi-tahap, sterilisasi ultraviolet, serta ozonisasi murni tanpa sentuhan tangan manusia demi keamanan Anda.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="neo-card p-8 bg-[#a78bfa] flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-xl bg-white border-3 border-black shadow-[3px_3px_0px_#000000] flex items-center justify-center text-black mb-6">
                            <!-- Truck Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM19.5 18.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM2.25 15h13.5m-10.5-3h10.5m-10.5-3h10.5m-3.75-3H6.75A2.25 2.25 0 004.5 8.25V15h15V8.25A2.25 2.25 0 0017.25 6h-3.75Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-black mb-3">Layanan Pengiriman Kilat</h3>
                        <p class="text-black font-semibold text-sm leading-relaxed">
                            Sistem manajemen pengiriman otomatis terjadwal yang memastikan pasokan air bersih murni Anda selalu terisi tepat waktu tanpa hambatan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="py-24 border-t-4 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs font-extrabold tracking-widest text-[#2563eb] bg-[#facc15] px-3 py-1 border-2 border-black rounded-lg uppercase">📦 Varian Produk Air</span>
                <h2 class="text-3xl sm:text-4xl font-black text-black">
                    Produk Air Mineral Premium Rindu Water
                </h2>
                <p class="text-slate-700 font-bold max-w-lg mx-auto">
                    Pilih kemasan yang sesuai dengan kebutuhan hidrasi harian Anda, mulai dari ukuran personal praktis hingga kebutuhan galon keluarga.
                </p>
                <div class="w-24 h-2 bg-black rounded-full mx-auto"></div>
            </div>

            <!-- Products Grid -->
            @if(isset($produk) && $produk->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($produk as $p)
                        <!-- Single Product Card -->
                        <div class="neo-card p-6 flex flex-col justify-between relative overflow-hidden group">
                            <div>
                                <!-- Product Image Container (Outlined brutal style) -->
                                <div class="w-full h-56 rounded-xl mb-6 flex items-center justify-center relative overflow-hidden p-4 bg-white border-3 border-black group-hover:scale-[1.02] transition-transform duration-150">
                                    @if($p->foto_produk)
                                        <img src="{{ asset('storage/' . $p->foto_produk) }}" alt="{{ $p->nama_produk }}" class="max-h-full max-w-full object-contain" />
                                    @else
                                        <!-- Custom outlined brutalist SVGs based on kemasan type -->
                                        @if($p->jenis_kemasan == 'botol')
                                            <!-- Outlined Botol SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto">
                                                <rect x="35" y="80" width="30" height="100" rx="6" fill="#ffffff" stroke="#000000" stroke-width="4"/>
                                                <path d="M43 80 L43 50 L57 50 L57 80" fill="none" stroke="#000000" stroke-width="4"/>
                                                <rect x="42" y="38" width="16" height="12" fill="#2563eb" stroke="#000000" stroke-width="3"/>
                                                <rect x="38" y="100" width="24" height="60" rx="3" fill="#06b6d4" stroke="#000000" stroke-width="3"/>
                                            </svg>
                                        @elseif($p->jenis_kemasan == 'galon')
                                            <!-- Outlined Galon SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto">
                                                <rect x="25" y="60" width="50" height="120" rx="10" fill="#ffffff" stroke="#000000" stroke-width="5"/>
                                                <path d="M42 60 L42 35 L58 35 L58 60" fill="none" stroke="#000000" stroke-width="5"/>
                                                <rect x="40" y="20" width="20" height="15" fill="#facc15" stroke="#000000" stroke-width="4"/>
                                                <rect x="29" y="85" width="42" height="85" rx="6" fill="#06b6d4" stroke="#000000" stroke-width="4"/>
                                                <line x1="29" y1="110" x2="71" y2="110" stroke="#000000" stroke-width="3"/>
                                            </svg>
                                        @elseif($p->jenis_kemasan == 'gelas')
                                            <!-- Outlined Cup SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto">
                                                <path d="M25 60 L30 160 C30 166 40 166 40 166 L60 166 C60 166 70 166 70 160 L75 60" fill="#ffffff" stroke="#000000" stroke-width="4"/>
                                                <ellipse cx="50" cy="60" rx="25" ry="8" fill="#facc15" stroke="#000000" stroke-width="4"/>
                                                <path d="M28 85 L32 155 L68 155 L72 85 Z" fill="#06b6d4" stroke="#000000" stroke-width="3"/>
                                            </svg>
                                        @else
                                            <!-- Droplet SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto text-blue-500">
                                                <path d="M50 40C50 40 15 100 15 130C15 157.61 37.39 180 50 180C62.61 180 85 157.61 85 130C85 100 50 40 50 40Z" fill="#06b6d4" stroke="#000000" stroke-width="4"/>
                                            </svg>
                                        @endif
                                    @endif
                                    
                                    <!-- Dynamic badge on capacity -->
                                    <span class="absolute bottom-3 left-3 bg-[#facc15] text-xs font-extrabold text-black px-3 py-1 rounded border-2 border-black shadow-[2px_2px_0px_#000000]">
                                        {{ $p->kapasitas }}
                                    </span>
                                </div>

                                <!-- Product Info -->
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <!-- Packaging type badge -->
                                        <span class="text-xs font-black uppercase tracking-wider text-black bg-[#facc15] px-2.5 py-1 rounded border-2 border-black">
                                            {{ $p->jenis_kemasan }}
                                        </span>

                                        <!-- Stock status Badge -->
                                        @if($p->stok > 100)
                                            <span class="text-xs font-black text-black bg-[#4ade80] px-2.5 py-0.5 rounded border-2 border-black">
                                                Melimpah
                                            </span>
                                        @elseif($p->stok > 0)
                                            <span class="text-xs font-black text-black bg-[#fbe5c6] px-2.5 py-0.5 rounded border-2 border-black">
                                                Terbatas
                                            </span>
                                        @else
                                            <span class="text-xs font-black text-white bg-[#f43f5e] px-2.5 py-0.5 rounded border-2 border-black">
                                                Habis
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-black text-black leading-tight hover:text-blue-600 transition-colors">
                                        {{ $p->nama_produk }}
                                    </h3>
                                    <p class="text-sm font-semibold text-slate-600 line-clamp-2 h-10">
                                        {{ $p->deskripsi ?? 'Pilihan terbaik air mineral murni berkualitas tinggi untuk memenuhi hidrasi berkualitas harian Anda.' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Footer Price and Action Button -->
                            <div class="mt-8 pt-4 border-t-3 border-black flex items-center justify-between gap-4">
                                <div>
                                    <span class="block text-xs font-bold text-slate-500">Harga Per Unit</span>
                                    <span class="text-xl font-black text-black">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ url('/dashboard') }}" class="neo-btn neo-btn-primary px-4 py-3 text-center text-sm flex-1">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback Mock Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="neo-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-xl mb-6 flex items-center justify-center relative overflow-hidden p-4 bg-white border-3 border-black">
                                <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto">
                                    <rect x="25" y="60" width="50" height="120" rx="10" fill="#ffffff" stroke="#000000" stroke-width="5"/>
                                    <path d="M42 60 L42 35 L58 35 L58 60" fill="none" stroke="#000000" stroke-width="5"/>
                                    <rect x="40" y="20" width="20" height="15" fill="#facc15" stroke="#000000" stroke-width="4"/>
                                    <rect x="29" y="85" width="42" height="85" rx="6" fill="#06b6d4" stroke="#000000" stroke-width="4"/>
                                    <line x1="29" y1="110" x2="71" y2="110" stroke="#000000" stroke-width="3"/>
                                </svg>
                                <span class="absolute bottom-3 left-3 bg-[#facc15] text-xs font-extrabold text-black px-3 py-1 rounded border-2 border-black shadow-[2px_2px_0px_#000000]">19 Liter</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase tracking-wider text-black bg-[#facc15] px-2.5 py-1 rounded border-2 border-black">Galon</span>
                                    <span class="text-xs font-black text-black bg-[#4ade80] px-2.5 py-0.5 rounded border-2 border-black">Tersedia</span>
                                </div>
                                <h3 class="text-xl font-black text-black">Galon Rindu Keluarga</h3>
                                <p class="text-sm font-semibold text-slate-600 line-clamp-2">Kebutuhan hidrasi keluarga terpenuhi dengan pasokan galon 19 Liter steril, berkualitas, serta hemat.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t-3 border-black flex items-center justify-between gap-4">
                            <div><span class="block text-xs font-bold text-slate-500">Harga</span><span class="text-xl font-black text-black">Rp 19.000</span></div>
                            <a href="{{ url('/dashboard') }}" class="neo-btn neo-btn-primary px-4 py-3 text-sm flex-1">Pesan Sekarang</a>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="neo-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-xl mb-6 flex items-center justify-center relative overflow-hidden p-4 bg-white border-3 border-black">
                                <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto">
                                    <rect x="35" y="80" width="30" height="100" rx="6" fill="#ffffff" stroke="#000000" stroke-width="4"/>
                                    <path d="M43 80 L43 50 L57 50 L57 80" fill="none" stroke="#000000" stroke-width="4"/>
                                    <rect x="42" y="38" width="16" height="12" fill="#2563eb" stroke="#000000" stroke-width="3"/>
                                    <rect x="38" y="100" width="24" height="60" rx="3" fill="#06b6d4" stroke="#000000" stroke-width="3"/>
                                </svg>
                                <span class="absolute bottom-3 left-3 bg-[#facc15] text-xs font-extrabold text-black px-3 py-1 rounded border-2 border-black shadow-[2px_2px_0px_#000000]">1500ml</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase tracking-wider text-black bg-[#facc15] px-2.5 py-1 rounded border-2 border-black">Botol</span>
                                    <span class="text-xs font-black text-black bg-[#4ade80] px-2.5 py-0.5 rounded border-2 border-black">Tersedia</span>
                                </div>
                                <h3 class="text-xl font-black text-black">Rindu Premium Botol</h3>
                                <p class="text-sm font-semibold text-slate-600 line-clamp-2">Botol 1500ml untuk pemakaian harian di meja kerja atau bepergian jauh.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t-3 border-black flex items-center justify-between gap-4">
                            <div><span class="block text-xs font-bold text-slate-500">Harga</span><span class="text-xl font-black text-black">Rp 6.000</span></div>
                            <a href="{{ url('/dashboard') }}" class="neo-btn neo-btn-primary px-4 py-3 text-sm flex-1">Pesan Sekarang</a>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="neo-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-xl mb-6 flex items-center justify-center relative overflow-hidden p-4 bg-white border-3 border-black">
                                <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto">
                                    <path d="M25 60 L30 160 C30 166 40 166 40 166 L60 166 C60 166 70 166 70 160 L75 60" fill="#ffffff" stroke="#000000" stroke-width="4"/>
                                    <ellipse cx="50" cy="60" rx="25" ry="8" fill="#facc15" stroke="#000000" stroke-width="4"/>
                                    <path d="M28 85 L32 155 L68 155 L72 85 Z" fill="#06b6d4" stroke="#000000" stroke-width="3"/>
                                </svg>
                                <span class="absolute bottom-3 left-3 bg-[#facc15] text-xs font-extrabold text-black px-3 py-1 rounded border-2 border-black shadow-[2px_2px_0px_#000000]">220ml</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase tracking-wider text-black bg-[#facc15] px-2.5 py-1 rounded border-2 border-black">Gelas</span>
                                    <span class="text-xs font-black text-black bg-[#4ade80] px-2.5 py-0.5 rounded border-2 border-black">Tersedia</span>
                                </div>
                                <h3 class="text-xl font-black text-black">Rindu Cup Praktis</h3>
                                <p class="text-sm font-semibold text-slate-600 line-clamp-2">Air minum dalam kemasan gelas 220ml steril, sangat pas untuk hidrasi singkat tamu Anda.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t-3 border-black flex items-center justify-between gap-4">
                            <div><span class="block text-xs font-bold text-slate-500">Harga</span><span class="text-xl font-black text-black">Rp 1.500</span></div>
                            <a href="{{ url('/dashboard') }}" class="neo-btn neo-btn-primary px-4 py-3 text-sm flex-1">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Definitions for Card Outlines -->
    <svg class="hidden">
        <defs>
            <linearGradient id="pCardGlass" x1="0" y1="0" x2="100" y2="200" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#ffffff"/>
                <stop offset="100%" stop-color="#f8fafc"/>
            </linearGradient>
            <linearGradient id="waterDropGrad" x1="50" y1="40" x2="50" y2="180" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#2563eb"/>
                <stop offset="100%" stop-color="#06b6d4"/>
            </linearGradient>
        </defs>
    </svg>

    <!-- Layanan Langganan Section -->
    <section id="layanan" class="py-24 border-t-4 border-black bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
                <span class="text-xs font-extrabold tracking-widest text-[#2563eb] bg-[#facc15] px-3 py-1 border-2 border-black rounded-lg uppercase">📅 Jadwal Berlangganan</span>
                <h2 class="text-3xl sm:text-4xl font-black text-black">
                    Sistem Berlangganan Pintar Rindu Water
                </h2>
                <p class="text-slate-700 font-bold max-w-md mx-auto">
                    Kendalikan pasokan air bersih murni Anda secara fleksibel menggunakan fitur langganan terjadwal.
                </p>
                <div class="w-24 h-2 bg-black rounded-full mx-auto"></div>
            </div>

            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Step 1 -->
                <div class="neo-card p-8 text-center relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-xl bg-[#2563eb] text-white font-extrabold text-lg flex items-center justify-center shadow-[3px_3px_0px_#000000] border-3 border-black">
                        1
                    </span>
                    <h3 class="text-xl font-extrabold text-black mb-3 mt-4">Buat Akun</h3>
                    <p class="text-slate-700 font-bold text-sm leading-relaxed">
                        Mendaftarlah secara instan dan lengkapi alamat detail profil pengiriman Anda di sistem kami.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="neo-card p-8 text-center relative group bg-[#facc15]">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-xl bg-[#2563eb] text-white font-extrabold text-lg flex items-center justify-center shadow-[3px_3px_0px_#000000] border-3 border-black">
                        2
                    </span>
                    <h3 class="text-xl font-extrabold text-black mb-3 mt-4">Pilih Paket & Produk</h3>
                    <p class="text-black font-bold text-sm leading-relaxed">
                        Tentukan varian air mineral serta frekuensi jadwal pengantaran harian, mingguan, atau bulanan.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="neo-card p-8 text-center relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-xl bg-[#2563eb] text-white font-extrabold text-lg flex items-center justify-center shadow-[3px_3px_0px_#000000] border-3 border-black">
                        3
                    </span>
                    <h3 class="text-xl font-extrabold text-black mb-3 mt-4">Air Diantar Otomatis</h3>
                    <p class="text-slate-700 font-bold text-sm leading-relaxed">
                        Kurir profesional kami akan mengantarkan air segar steril Anda langsung ke lokasi secara berkala.
                    </p>
                </div>
            </div>

            <!-- Call to Action below steps -->
            <div class="mt-16 text-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl font-bold text-white neo-btn neo-btn-primary gap-2 group">
                    <span>Mulai Berlangganan Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-24 border-t-4 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Title Info -->
                <div class="lg:col-span-4 space-y-6 text-center lg:text-left">
                    <span class="text-xs font-extrabold tracking-widest text-[#2563eb] bg-[#facc15] px-3 py-1 border-2 border-black rounded-lg uppercase">💬 Ulasan Pengguna</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-black leading-tight">
                        Apa Kata Mereka Tentang Rindu Water?
                    </h2>
                    <p class="text-slate-700 font-bold">
                        Ribuan keluarga dan institusi telah mempercayakan kebutuhan hidrasi bersih higienis harian mereka bersama kami.
                    </p>
                    <div class="w-20 h-1 bg-black rounded-full mx-auto lg:mx-0"></div>
                </div>

                <!-- Testimonials Cards Grid -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Testi 1 -->
                    <div class="neo-card p-8 bg-[#06b6d4] flex flex-col justify-between relative">
                        <p class="text-black font-semibold text-sm italic leading-relaxed">
                            "Rindu Water benar-benar mengubah cara kami mengonsumsi air. Jadwal pengantaran mingguan sangat konsisten, dan kualitas air mineralnya benar-benar terasa segar dan murni. Sangat direkomendasikan!"
                        </p>
                        <div class="flex items-center gap-3 pt-6 mt-6 border-t-2 border-black">
                            <!-- Avatar Outlined -->
                            <div class="w-10 h-10 rounded-full bg-white border-2 border-black text-black font-black flex items-center justify-center text-xs shadow-[2px_2px_0px_#000000]">
                                AR
                            </div>
                            <div>
                                <span class="block text-sm font-black text-black">Ahmad Rian</span>
                                <span class="text-xs font-extrabold text-slate-800">Kepala Rumah Tangga, Jakarta</span>
                            </div>
                        </div>
                    </div>

                    <!-- Testi 2 -->
                    <div class="neo-card p-8 bg-[#a78bfa] flex flex-col justify-between relative">
                        <p class="text-black font-semibold text-sm italic leading-relaxed">
                            "Sangat praktis untuk kantor kami yang memiliki 50 staf. Fitur langganan bulanan di dashboard admin menghemat waktu pengadaan barang kami. Layanan kurirnya cepat dan ramah!"
                        </p>
                        <div class="flex items-center gap-3 pt-6 mt-6 border-t-2 border-black">
                            <!-- Avatar -->
                            <div class="w-10 h-10 rounded-full bg-white border-2 border-black text-black font-black flex items-center justify-center text-xs shadow-[2px_2px_0px_#000000]">
                                S
                            </div>
                            <div>
                                <span class="block text-sm font-black text-black">Sarah</span>
                                <span class="text-xs font-extrabold text-slate-800">Office Manager, PT Maju Bersama</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 border-t-4 border-black bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-12 border-b-2 border-slate-800">
                <!-- Branding info -->
                <div class="md:col-span-5 space-y-6">
                    <a href="#" class="flex items-center space-x-2">
                        <span class="p-2 bg-[#facc15] rounded-full text-black border-2 border-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                            </svg>
                        </span>
                        <span class="text-xl font-black text-white">Rindu <span class="text-[#facc15]">Water</span></span>
                    </a>
                    <p class="text-sm font-semibold text-slate-400 leading-relaxed max-w-sm">
                        Menghadirkan air mineral alami pegunungan berkualitas tinggi secara steril dan higienis untuk kesehatan hidrasi terbaik Anda setiap hari.
                    </p>
                </div>

                <!-- Footer Menu 1 -->
                <div class="md:col-span-3 space-y-4">
                    <h4 class="text-sm font-black text-[#facc15] uppercase tracking-wider">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm font-bold text-slate-300">
                        <li><a href="#home" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="#keunggulan" class="hover:text-white transition-colors">Keunggulan</a></li>
                        <li><a href="#produk" class="hover:text-white transition-colors">Produk Kami</a></li>
                        <li><a href="#layanan" class="hover:text-white transition-colors">Layanan Berlangganan</a></li>
                    </ul>
                </div>

                <!-- Footer Menu 2 -->
                <div class="md:col-span-4 space-y-4">
                    <h4 class="text-sm font-black text-[#facc15] uppercase tracking-wider">Hubungi Kami</h4>
                    <p class="text-sm text-slate-300 leading-relaxed font-semibold">
                        Alamat Pabrik Utama:<br>
                        Kawasan Industri Mata Air Pegunungan Vulkanik, Jawa Barat, Indonesia
                    </p>
                    <p class="text-sm text-slate-200 font-black">
                        Email: info@rinduwater.co.id<br>
                        Telepon: (021) 8888-9999
                    </p>
                </div>
            </div>

            <!-- Credits and copyrights -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-400 font-bold">&copy; {{ date('Y') }} Rindu Water. Hak Cipta Dilindungi.</p>
                <div class="flex items-center space-x-6 text-xs text-slate-400 font-bold">
                    <a href="#" class="hover:text-white">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-white">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Header Scroll background change script & Custom Smooth Scroll -->
    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('main-header');
            const navCard = document.getElementById('main-nav-card');
            
            if (window.scrollY > 50) {
                // Header container becomes solid cream with a bottom border
                header.classList.remove('bg-transparent', 'border-transparent');
                header.classList.add('bg-[#F4F2EC]', 'border-black');
                
                // Navbar card gets pressed down shadow
                navCard.classList.remove('shadow-[4px_4px_0px_#000000]');
                navCard.classList.add('shadow-[2px_2px_0px_#000000]', 'translate-x-[2px]', 'translate-y-[2px]');
            } else {
                // Header container becomes transparent
                header.classList.remove('bg-[#F4F2EC]', 'border-black');
                header.classList.add('bg-transparent', 'border-transparent');
                
                // Navbar card gets normal shadow
                navCard.classList.remove('shadow-[2px_2px_0px_#000000]', 'translate-x-[2px]', 'translate-y-[2px]');
                navCard.classList.add('shadow-[4px_4px_0px_#000000]');
            }
        });

        // Elegant Smooth Scroll for Anchor Links using Cubic-Bezier easing
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    
                    const headerHeight = 100; // Offset for sticky navbar
                    const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                    const startPosition = window.scrollY;
                    const distance = targetPosition - startPosition - headerHeight;
                    const duration = 1200; // Slow, luxurious scroll animation
                    let start = null;

                    // cubic-bezier easing out function: easeOutCubic
                    function easeOutCubic(t) {
                        return 1 - Math.pow(1 - t, 3);
                    }

                    function step(timestamp) {
                        if (!start) start = timestamp;
                        const progress = timestamp - start;
                        const time = Math.min(progress / duration, 1);
                        
                        window.scrollTo(0, startPosition + distance * easeOutCubic(time));
                        
                        if (progress < duration) {
                            window.requestAnimationFrame(step);
                        } else {
                            window.scrollTo(0, startPosition + distance);
                        }
                    }

                    window.requestAnimationFrame(step);
                }
            });
        });
    </script>
</body>
</html>
