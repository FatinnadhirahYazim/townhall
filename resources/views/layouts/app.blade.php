<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            outfit: ['Outfit', 'sans-serif'],
                            inter: ['Inter', 'sans-serif'],
                        },
                        boxShadow: {
                            'neo': '4px 4px 0px 0px rgba(0,0,0,1)',
                            'neo-hover': '8px 8px 0px 0px rgba(0,0,0,1)',
                        }
                    }
                }
            }
        </script>
        <style>
            .neo-border { border: 3px solid #1a1a1a; }
            .neo-shadow { box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }
            .neo-shadow-lg { box-shadow: 8px 8px 0px 0px rgba(0,0,0,1); }
        </style>
    </head>
    <body class="font-inter antialiased bg-[#fcfcf9] text-[#1a1a1a]">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
