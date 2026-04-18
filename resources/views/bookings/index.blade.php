<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight font-outfit">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                @if($bookings->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No bookings yet</h3>
                        <p class="text-gray-500 mb-8">Ready to host your next event? Explore our premium venues.</p>
                        <a href="{{ route('home') }}" class="inline-flex px-8 py-4 bg-brand-600 text-white rounded-2xl font-bold hover:bg-brand-700 transition-all">Browse Venues</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Venue</th>
                                    <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date & Slot</th>
                                    <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Guests</th>
                                    <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">Requested On</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ $booking->venue->image }}" class="w-12 h-12 rounded-xl object-cover">
                                                <span class="font-bold text-gray-900">{{ $booking->venue->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <p class="font-bold text-gray-900">{{ $booking->event_date->format('M d, Y') }}</p>
                                            <p class="text-xs text-gray-400">{{ $booking->timeSlot->label }}</p>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="font-bold text-gray-900">{{ $booking->guest_count }}</span>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter bg-{{ $booking->status->color() }}-100 text-{{ $booking->status->color() }}-700">
                                                {{ $booking->status->label() }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <span class="text-gray-400 text-sm">{{ $booking->created_at->format('M d, Y') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
