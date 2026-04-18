<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $venue->name }} - TownHall</title>
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
        .btn-neo:active { transform: translate(2px, 2px); box-shadow: 0px 0px 0px 0px rgba(0,0,0,1); }
    </style>
</head>
<body class="antialiased selection:bg-black selection:text-white pb-24">
    <nav class="sticky top-0 z-50 bg-[#fcfcf9] border-b-[3px] border-black">
        <div class="max-w-6xl mx-auto px-6 h-20 flex justify-between items-center text-lg font-black tracking-tight uppercase">
            <a href="/" class="text-2xl font-black font-outfit">TownHall</a>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="neo-border neo-shadow px-6 py-2 bg-white font-black uppercase text-xs tracking-widest hover:bg-gray-50 transition-all">Back</a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 pt-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Side: Venue Info -->
            <div class="lg:col-span-2 space-y-8">
                <div class="neo-border neo-shadow overflow-hidden bg-white">
                    <img src="{{ $venue->image }}" alt="{{ $venue->name }}" class="w-full h-[450px] object-cover">
                </div>

                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-gray-400 font-bold uppercase tracking-widest text-xs">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        {{ $venue->location }}
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black font-outfit uppercase leading-none">{{ $venue->name }}</h1>
                    
                    <div class="flex gap-4">
                        <div class="neo-border px-4 py-2 bg-gray-50 font-black uppercase text-xs tracking-tighter">
                            {{ $venue->capacity }} Guests
                        </div>
                        <div class="neo-border px-4 py-2 bg-gray-50 font-black uppercase text-xs tracking-tighter">
                            RM {{ number_format($venue->price_per_hour, 2) }} / Hr
                        </div>
                    </div>
                </div>

                <div class="neo-border neo-shadow bg-white p-8 space-y-6">
                    <h2 class="text-2xl font-black font-outfit uppercase">Mengenai Ruang Ini</h2>
                    <p class="text-gray-600 font-medium leading-relaxed">
                        {{ $venue->description }}
                    </p>
                    
                    <h2 class="text-2xl font-black font-outfit uppercase pt-4">Kemudahan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($venue->amenities ?? [] as $amenity)
                            <div class="flex items-center gap-3 font-bold text-sm lowercase italic">
                                <div class="w-2 h-2 bg-black"></div>
                                {{ $amenity }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Side: Booking Form -->
            <div class="lg:col-span-1">
                <div class="neo-border neo-shadow bg-white p-8 lg:sticky lg:top-32">
                    <h2 class="text-2xl font-black font-outfit uppercase mb-8">Tempah Sekarang</h2>

                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="venue_id" value="{{ $venue->id }}">
                        
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Nama Penuh</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()?->name) }}" class="w-full neo-border px-4 py-3 bg-gray-50 focus:bg-white outline-none font-bold text-sm" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Alamat Emel</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()?->email) }}" class="w-full neo-border px-4 py-3 bg-gray-50 focus:bg-white outline-none font-bold text-sm" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Tarikh Acara</label>
                            <input type="date" name="event_date" value="{{ old('event_date') }}" class="w-full neo-border px-4 py-3 bg-gray-50 focus:bg-white outline-none font-bold text-sm" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">No. Telefon</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full neo-border px-4 py-3 bg-gray-50 focus:bg-white outline-none font-bold text-sm" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Bilangan Tetamu</label>
                                <input type="number" name="guest_count" value="{{ old('guest_count') }}" min="1" max="{{ $venue->capacity }}" class="w-full neo-border px-4 py-3 bg-gray-50 focus:bg-white outline-none font-bold text-sm" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Jenis Acara</label>
                            <input type="text" name="event_type" value="{{ old('event_type') }}" class="w-full neo-border px-4 py-3 bg-gray-50 focus:bg-white outline-none font-bold text-sm" placeholder="Contoh: Kenduri, Meeting" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Nota Tambahan</label>
                            <textarea name="notes" class="w-full neo-border px-4 py-3 bg-gray-50 focus:bg-white outline-none font-bold text-sm min-h-[80px]">{{ old('notes') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Pilih Sesi</label>
                            <div class="space-y-2">
                                @foreach($venue->timeSlots as $slot)
                                    <label class="block neo-border p-3 cursor-pointer hover:bg-gray-50 transition-all peer-checked:bg-black">
                                        <input type="radio" name="time_slot_id" value="{{ $slot->id }}" class="mr-2 accent-black" required>
                                        <span class="text-xs font-black uppercase tracking-tighter">{{ $slot->label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="w-full btn-neo neo-border neo-shadow py-5 bg-black text-white font-black uppercase text-sm tracking-widest hover:bg-gray-800 transition-all">
                            Hantar Permohonan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
