<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TownHall - Simple Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        outfit: ['Outfit', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fdf8f6',
                            900: '#1a1a1a',
                        }
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
        body { font-family: 'Inter', sans-serif; background-color: #fcfcf9; color: #1a1a1a; }
        .neo-border { border: 3px solid #1a1a1a; }
        .neo-shadow { box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }
        .neo-shadow-lg { box-shadow: 8px 8px 0px 0px rgba(0,0,0,1); }
        .venue-card:hover { transform: translate(-2px, -2px); box-shadow: 8px 8px 0px 0px rgba(0,0,0,1); }
        .btn-neo:active { transform: translate(2px, 2px); box-shadow: 0px 0px 0px 0px rgba(0,0,0,1); }
    </style>
</head>
<body class="antialiased selection:bg-black selection:text-white">
    <nav class="sticky top-0 z-50 bg-[#fcfcf9] border-b-[3px] border-black">
        <div class="max-w-6xl mx-auto px-6 h-20 flex justify-between items-center text-lg font-black tracking-tight uppercase">
            <a href="/" class="text-2xl font-black font-outfit">TownHall</a>
            <div class="hidden md:flex gap-10 text-sm font-black uppercase tracking-widest">
                <a href="#" class="hover:underline underline-offset-8 decoration-[3px]">Browse</a>
                <a href="#" class="hover:underline underline-offset-8 decoration-[3px]">About</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:underline underline-offset-8 decoration-[3px]">Account</a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline underline-offset-8 decoration-[3px]">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <header class="max-w-6xl mx-auto px-6 py-16 md:py-24">
        <div class="mb-4 flex items-center gap-2">
            <span class="w-8 h-[3px] bg-black"></span>
            <span class="text-xs font-black uppercase tracking-[0.2em]">Tempahan Ruang Acara Malaysia</span>
        </div>
        <h1 class="text-5xl md:text-8xl font-black font-outfit uppercase leading-[0.9] mb-6">
            Sewa Dewan<br>
            <span class="text-gray-400">Mudah & Cepat</span>
        </h1>
        <p class="text-xl md:text-2xl font-medium text-gray-500 max-w-2xl mb-12 lowercase">
            Cari dan tempah dewan orang ramai, bilik mesyuarat, atau ruang kreatif untuk sebarang majlis. telus, senang, dan lokal.
        </p>
    </header>

    <main class="max-w-4xl mx-auto px-6 pb-24 space-y-8">
        @foreach($venues as $venue)
            <div class="venue-card neo-border neo-shadow bg-white p-6 md:p-8 flex flex-col md:flex-row gap-8 transition-all duration-200">
                <!-- Thumbnail -->
                <div class="w-full md:w-32 h-32 flex-shrink-0 neo-border overflow-hidden">
                    <img src="{{ $venue->image }}" class="w-full h-full object-cover">
                </div>

                <!-- Info -->
                <div class="flex-grow flex flex-col">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-2 mb-4">
                        <div>
                            <h3 class="text-2xl md:text-2xl font-black font-outfit uppercase leading-tight">{{ $venue->name }}</h3>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $venue->location }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="inline-block bg-gray-50 neo-border px-3 py-1 font-bold text-[10px] uppercase tracking-tighter mb-2">Venue</span>
                        </div>
                    </div>

                    <p class="text-gray-500 font-medium text-sm leading-relaxed mb-6 line-clamp-2">{{ $venue->description }}</p>

                    <div class="mt-auto flex flex-col md:flex-row gap-6 md:items-center justify-between">
                        <div class="text-xl md:text-2xl font-black font-outfit">
                            ${{ number_format($venue->price_per_hour, 0) }}
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">/ Hr</span>
                        </div>
                        
                        <a href="{{ route('venues.show', $venue->slug) }}" class="btn-neo neo-border neo-shadow px-6 py-3 bg-black text-white font-black uppercase text-xs tracking-widest hover:bg-gray-800 transition-all text-center">
                            Lihat Butiran
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </main>

    <footer class="border-t-[3px] border-black bg-white py-12">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-2xl font-black font-outfit uppercase">TownHall</div>
            <p class="text-gray-400 font-bold text-sm uppercase tracking-widest">© 2026 TownHall Inc. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
