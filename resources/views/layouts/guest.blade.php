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

        <!-- Neo-brutalism Styles -->
        <style>
            :root {
                --neo-bg: #F4F2EC;
                --neo-yellow: #facc15;
                --neo-border-color: #000000;
            }

            * { font-family: 'Plus Jakarta Sans', sans-serif; }

            body {
                background-color: var(--neo-bg);
                color: #000000;
            }

            .neo-container {
                background-color: #ffffff;
                border: 4px solid var(--neo-border-color);
                border-radius: 16px;
                box-shadow: 8px 8px 0px var(--neo-border-color);
            }

            .neo-logo-wrapper {
                width: 76px;
                height: 76px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                background-color: var(--neo-yellow);
                border: 3px solid var(--neo-border-color);
                box-shadow: 4px 4px 0px var(--neo-border-color);
                transition: all 0.2s ease;
            }

            .neo-logo-wrapper:hover {
                transform: translate(-2px, -2px);
                box-shadow: 6px 6px 0px var(--neo-border-color);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F4F2EC]">
            <div class="mb-8">
                <a href="/" class="block">
                    <div class="neo-logo-wrapper">
                        <x-application-logo class="w-10 h-10 text-black" />
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 neo-container mx-4 sm:mx-0">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
