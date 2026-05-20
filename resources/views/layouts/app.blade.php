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
                --neo-border-color: #000000;
                --neo-text: #000000;
            }

            * { font-family: 'Plus Jakarta Sans', sans-serif; }

            body {
                background: var(--neo-bg);
                color: var(--neo-text);
            }

            /* Neo-brutalist Card */
            .neo-brutal-card {
                background: #ffffff;
                border: 3px solid var(--neo-border-color);
                box-shadow: 5px 5px 0px var(--neo-border-color);
                border-radius: 12px;
                transition: all 0.2s ease;
            }

            .neo-brutal-card:hover {
                transform: translate(-2px, -2px);
                box-shadow: 7px 7px 0px var(--neo-border-color);
            }

            /* Neo-brutalist Button */
            .neo-brutal-btn {
                background: var(--neo-yellow);
                color: #000000;
                border: 3px solid var(--neo-border-color);
                box-shadow: 4px 4px 0px var(--neo-border-color);
                border-radius: 10px;
                font-weight: 800;
                cursor: pointer;
                transition: all 0.15s ease;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .neo-brutal-btn:hover {
                transform: translate(-2px, -2px);
                box-shadow: 6px 6px 0px var(--neo-border-color);
            }

            .neo-brutal-btn:active {
                transform: translate(2px, 2px);
                box-shadow: 2px 2px 0px var(--neo-border-color);
            }

            .neo-brutal-btn-blue {
                background: var(--neo-blue);
                color: #ffffff;
            }

            .neo-brutal-btn-cyan {
                background: var(--neo-cyan);
                color: #000000;
            }

            .neo-brutal-btn-red {
                background: var(--neo-red);
                color: #ffffff;
            }

            /* Neo-brutalist Input */
            .neo-brutal-input {
                width: 100%;
                background: #ffffff !important;
                border: 3px solid var(--neo-border-color) !important;
                border-radius: 10px !important;
                padding: 12px 16px !important;
                font-size: 0.95rem !important;
                font-weight: 600 !important;
                color: #000000 !important;
                outline: none !important;
                box-shadow: 4px 4px 0px var(--neo-border-color) !important;
                transition: all 0.15s ease !important;
            }

            .neo-brutal-input:hover {
                transform: translate(-1px, -1px) !important;
                box-shadow: 5px 5px 0px var(--neo-border-color) !important;
            }

            .neo-brutal-input:focus {
                box-shadow: 6px 6px 0px var(--neo-border-color) !important;
                transform: translate(-2px, -2px) !important;
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

            /* Badge */
            .neo-brutal-badge {
                display: inline-block;
                padding: 4px 10px;
                background: var(--neo-cyan);
                color: #000000;
                border: 2px solid var(--neo-border-color);
                border-radius: 6px;
                font-weight: 800;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                box-shadow: 2px 2px 0px var(--neo-border-color);
            }

            /* Thick Border Rule */
            .neo-border-thick {
                border: 3px solid var(--neo-border-color);
            }

            /* Custom scrollbar matching neo-brutalist theme */
            ::-webkit-scrollbar { width: 10px; }
            ::-webkit-scrollbar-track { background: var(--neo-bg); border-left: 3px solid var(--neo-border-color); }
            ::-webkit-scrollbar-thumb { background: var(--neo-yellow); border: 2px solid var(--neo-border-color); border-radius: 4px; }
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
