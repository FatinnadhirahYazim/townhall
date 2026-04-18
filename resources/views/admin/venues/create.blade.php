<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.venues.index') }}" class="p-2 text-gray-400 hover:text-gray-900 bg-white shadow-sm border border-gray-100 rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight font-outfit">
                {{ __('New Venue') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="mb-6 p-6 bg-red-50 border border-red-100 rounded-[2rem] text-red-600 shadow-sm">
                    <p class="font-bold mb-2">Please fix the following errors:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.venues.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Basic Information -->
                <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold font-outfit text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center text-sm">1</span>
                        Basic Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-3">Venue Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-brand-500 outline-none transition-all font-medium text-gray-700" placeholder="e.g. Majestic Grand Hall" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-brand-500 outline-none transition-all font-medium text-gray-700" placeholder="e.g. City Center, NY" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Capacity (Guests)</label>
                            <input type="number" name="capacity" value="{{ old('capacity') }}" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-brand-500 outline-none transition-all font-medium text-gray-700" placeholder="500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Price Per Hour ($)</label>
                            <input type="number" step="0.01" name="price_per_hour" value="{{ old('price_per_hour') }}" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-brand-500 outline-none transition-all font-medium text-gray-700" placeholder="150.00" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Cover Image URL</label>
                            <input type="url" name="image" value="{{ old('image') }}" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-brand-500 outline-none transition-all font-medium text-gray-700" placeholder="https://images.unsplash.com/...">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-3">Description</label>
                            <textarea name="description" rows="5" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-brand-500 outline-none transition-all font-medium text-gray-700" placeholder="Tell us about this amazing space..." required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold font-outfit text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center text-sm">2</span>
                        Amenities
                    </h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @php
                            $commonAmenities = ['Stage', 'Sound System', 'Projector', 'WiFi', 'Parking', 'Catering', 'VIP Room', 'Kitchenette'];
                        @endphp
                        @foreach($commonAmenities as $amenity)
                            <label class="flex items-center gap-3 p-4 bg-gray-50 rounded-2xl border border-gray-100 cursor-pointer hover:bg-brand-50 transition-all group">
                                <input type="checkbox" name="amenities[]" value="{{ $amenity }}" class="w-5 h-5 rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                                <span class="text-sm font-medium text-gray-700 group-hover:text-brand-900">{{ $amenity }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-4 pb-12">
                    <a href="{{ route('admin.venues.index') }}" class="px-8 py-4 bg-white text-gray-700 border border-gray-200 rounded-2xl font-bold hover:bg-gray-50 transition-all">Cancel</a>
                    <button type="submit" class="px-12 py-4 bg-brand-600 text-white rounded-2xl font-bold hover:bg-brand-700 transition-all shadow-xl shadow-brand-500/20">Create Venue</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
