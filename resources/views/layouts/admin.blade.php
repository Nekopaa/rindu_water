<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Rindu Water') }} - Admin Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/admin_dashboard.css', 'resources/js/app.js'])

        <!-- Neo-brutalism Design System -->
        <style>
            :root {
                --neo-bg: #F4F2EC;
                --neo-yellow: #facc15;
                --neo-blue: #2563eb;
                --neo-cyan: #06b6d4;
                --neo-red: #f43f5e;
                --neo-border-color: rgba(0,0,0,0.18);
                --neo-text: #000000;
                --neo-shadow-dark: rgba(0,0,0,0.18);
                --neo-shadow-light: rgba(255,255,255,0.9);
                --neo-radius: 16px;
            }

            * { font-family: 'Plus Jakarta Sans', sans-serif; }

            body {
                background: var(--neo-bg);
                color: var(--neo-text);
            }

            /* Neomorphism primitives (map old neo-brutal classes) */
            .neo-brutal-card {
                background: #ffffff;
                border: 1px solid var(--neo-border-color);
                border-radius: var(--neo-radius);
                box-shadow:
                    10px 10px 24px var(--neo-shadow-dark),
                    -10px -10px 24px var(--neo-shadow-light);
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }

            .neo-brutal-card:hover {
                transform: translateY(-2px);
                box-shadow:
                    12px 12px 28px var(--neo-shadow-dark),
                    -12px -12px 28px var(--neo-shadow-light);
            }

            .neo-brutal-btn {
                background: #f3f3f3;
                border: 1px solid rgba(0,0,0,0.12);
                border-radius: 14px;
                box-shadow:
                    6px 6px 14px rgba(0,0,0,0.16),
                    -6px -6px 14px rgba(255,255,255,0.85);
                color: #000;
                font-weight: 800;
                cursor: pointer;
                transition: all 0.15s ease;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .neo-brutal-btn:hover {
                box-shadow:
                    8px 8px 18px rgba(0,0,0,0.18),
                    -8px -8px 18px rgba(255,255,255,0.9);
            }

            .neo-brutal-btn:active {
                box-shadow:
                    inset 6px 6px 14px rgba(0,0,0,0.16),
                    inset -6px -6px 14px rgba(255,255,255,0.85);
            }

            .neo-brutal-btn-blue {
                background: var(--neo-blue);
                color: #ffffff;
                border-color: rgba(0,0,0,0.16);
                box-shadow:
                    8px 8px 18px rgba(37,99,235,0.35),
                    -8px -8px 18px rgba(255,255,255,0.25);
            }

            .neo-brutal-btn-cyan {
                background: var(--neo-cyan);
                color: #000000;
                border-color: rgba(0,0,0,0.16);
            }

            .neo-brutal-btn-red {
                background: var(--neo-red);
                color: #ffffff;
                border-color: rgba(0,0,0,0.16);
            }

            .neo-brutal-input {
                width: 100%;
                background: #f8f8f8 !important;
                border: 1px solid rgba(0,0,0,0.12) !important;
                border-radius: 14px !important;
                padding: 12px 16px !important;
                font-size: 0.95rem !important;
                font-weight: 600 !important;
                color: #000000 !important;
                outline: none !important;
                box-shadow:
                    8px 8px 18px rgba(0,0,0,0.10),
                    -8px -8px 18px rgba(255,255,255,0.8) !important;
                transition: box-shadow 0.15s ease, transform 0.15s ease;
            }

            .neo-brutal-input:hover {
                transform: translateY(-1px);
            }

            .neo-brutal-input:focus {
                box-shadow:
                    inset 6px 6px 14px rgba(0,0,0,0.14),
                    inset -6px -6px 14px rgba(255,255,255,0.85) !important;
            }

            select.neo-brutal-input {
                appearance: none !important;
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") !important;
                background-repeat: no-repeat !important;
                background-position: right 16px center !important;
                background-size: 16px !important;
                padding-right: 40px !important;
                cursor: pointer !important;
                font-weight: 800 !important;
            }

            .neo-brutal-badge {
                display: inline-block;
                padding: 4px 10px;
                background: rgba(6,182,212,0.18);
                color: #000000;
                border: 1px solid rgba(0,0,0,0.14);
                border-radius: 999px;
                font-weight: 800;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                box-shadow:
                    6px 6px 14px rgba(0,0,0,0.10),
                    -6px -6px 14px rgba(255,255,255,0.85);
            }

            .neo-border-thick {
                border: 1px solid var(--neo-border-color);
            }

            ::-webkit-scrollbar { width: 10px; }
            ::-webkit-scrollbar-track { background: var(--neo-bg); }
            ::-webkit-scrollbar-thumb { background: var(--neo-yellow); border-radius: 999px; }
        </style>

    </head>
    <body class="antialiased" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex" style="background: var(--neo-bg);">
            
            <!-- Sidebar for Admin (Mobile Drawer & Desktop Fixed) -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 w-72 bg-white border-r-4 border-black z-50 transform lg:transform-none lg:opacity-100 lg:static transition-transform duration-250 ease-out flex flex-col justify-between">
                <div>
                    <!-- Logo / Brand Header -->
                    <div class="h-20 border-b-4 border-black flex items-center px-6 bg-[#facc15] gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="block p-1 bg-white border-3 border-black rounded-full shadow-[2px_2px_0px_#000000]">
                            <x-application-logo class="h-8 w-8 text-black" />
                        </a>
                        <span class="font-extrabold text-lg text-black tracking-tight">Rindu Admin Portal</span>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="p-4 space-y-2 overflow-y-auto" style="max-height: calc(100vh - 10rem);">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('admin.dashboard') ? 'bg-[#facc15] shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            📊 Dashboard Overview
                        </a>

                        <div class="pt-2 pb-1 text-xs font-black text-slate-400 uppercase tracking-widest pl-2">Katalog & Stok</div>
                        
                        <!-- Produk Air -->
                        <a href="{{ route('produk-air.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('produk-air.*') ? 'bg-[#06b6d4] text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            💧 Produk & Stok Air
                        </a>
                        
                        <!-- Riwayat Stock -->
                        <a href="{{ route('riwayat-stock.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('riwayat-stock.*') ? 'bg-[#06b6d4] text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            📋 Log Mutasi Stok
                        </a>
                        
                        <!-- Gudang -->
                        <a href="{{ route('gudang.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('gudang.*') ? 'bg-[#06b6d4] text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            🏢 Inventaris Gudang
                        </a>

                        <div class="pt-2 pb-1 text-xs font-black text-slate-400 uppercase tracking-widest pl-2">Transaksi & Siklus</div>
                        
                        <!-- Transaksi -->
                        <a href="{{ route('transaksi.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('transaksi.*') ? 'bg-[#4ade80] text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            💸 Riwayat Transaksi
                        </a>

                        <!-- Langganan -->
                        <a href="{{ route('langganan.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('langganan.*') ? 'bg-[#4ade80] text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            📅 Paket Langganan
                        </a>

                        <div class="pt-2 pb-1 text-xs font-black text-slate-400 uppercase tracking-widest pl-2">Pengiriman & Logistik</div>

                        <!-- Kurir -->
                        <a href="{{ route('kurir.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('kurir.*') ? 'bg-indigo-400 text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            🚴 Staff Kurir
                        </a>

                        <!-- Pengiriman -->
                        <a href="{{ route('pengiriman.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('pengiriman.*') ? 'bg-indigo-400 text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            📦 Status Pengiriman
                        </a>

                        <div class="pt-2 pb-1 text-xs font-black text-slate-400 uppercase tracking-widest pl-2">Administrasi</div>

                        <!-- Pelanggan -->
                        <a href="{{ route('pelanggan.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('pelanggan.*') ? 'bg-orange-400 text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            👥 Akun Pelanggan
                        </a>

                        <!-- Users -->
                        <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('users.*') ? 'bg-orange-400 text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            🔑 Akun Pengguna
                        </a>

                        <!-- Laporan Penjualan -->
                        <a href="{{ route('laporan-penjualan.index') }}" class="flex items-center px-4 py-3 rounded-xl font-extrabold border-3 border-black {{ request()->routeIs('laporan-penjualan.*') ? 'bg-pink-400 text-black shadow-[3px_3px_0px_#000000]' : 'bg-white hover:bg-slate-100' }} text-black text-sm transition-all duration-100">
                            📈 Laporan Keuangan
                        </a>
                    </nav>
                </div>

                <!-- Footer / Profile Sign Out -->
                <div class="p-4 border-t-4 border-black bg-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full border-2 border-black bg-[#facc15] flex items-center justify-center font-black">
                            A
                        </div>
                        <div class="overflow-hidden w-36">
                            <div class="font-extrabold text-xs text-black truncate">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] font-bold text-slate-500 truncate">Administrator</div>
                        </div>
                    </div>
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 border-2 border-black rounded-lg bg-[#f43f5e] text-white hover:scale-105 active:scale-95 transition-all shadow-[2px_2px_0px_#000000]" title="Log Out">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Topbar -->
                <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-6 lg:px-8 sticky top-0 z-40">
                    <div class="flex items-center gap-4">
                        <!-- Hamburger button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2 border-3 border-black rounded-xl bg-[#facc15] shadow-[2.5px_2.5px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 lg:hidden">
                            <svg class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <h1 class="font-extrabold text-2xl text-black tracking-tight">
                            @yield('title', 'Admin Panel')
                        </h1>
                    </div>

                    <!-- Clock / Date indicator -->
                    <div class="hidden md:flex items-center gap-2 border-3 border-black bg-[#06b6d4] px-4 py-2 rounded-xl shadow-[3px_3px_0px_#000000] font-black text-xs">
                        📅 {{ now()->translatedFormat('d F Y') }}
                    </div>
                </header>

                <!-- Dynamic View Content Slot -->
                <main class="p-6 lg:p-8 flex-1 overflow-y-auto max-w-7xl w-full mx-auto space-y-8">
                    
                    <!-- Alert notification banner -->
                    @if(session('success'))
                        <div class="p-5 bg-[#4ade80] border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000] text-black font-extrabold flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="p-5 bg-[#f43f5e] border-3 border-black rounded-xl shadow-[4px_4px_0px_#000000] text-white font-extrabold flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
