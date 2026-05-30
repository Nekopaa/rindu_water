<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Rindu Water') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

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
    <body class="antialiased">
        <div class="min-h-screen" style="background: var(--neo-bg);">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b-4 border-black py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-8">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
