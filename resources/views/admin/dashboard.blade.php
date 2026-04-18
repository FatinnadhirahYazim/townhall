<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight font-outfit">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="flex gap-4">
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">View Site</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Total Bookings</p>
                    <p class="text-3xl font-bold font-outfit text-gray-900">{{ $stats['total_bookings'] }}</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <p class="text-amber-500 text-xs font-bold uppercase tracking-widest mb-1">Pending</p>
                    <p class="text-3xl font-bold font-outfit text-gray-900">{{ $stats['pending_bookings'] }}</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Active Venues</p>
                    <p class="text-3xl font-bold font-outfit text-gray-900">{{ $stats['total_venues'] }}</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <p class="text-green-500 text-xs font-bold uppercase tracking-widest mb-1">Est. Revenue</p>
                    <p class="text-3xl font-bold font-outfit text-gray-900">${{ number_format($stats['total_revenue'], 0) }}</p>
                </div>
            </div>

            <!-- Recent Bookings Table -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-xl font-bold font-outfit text-gray-900">Recent Booking Requests</h3>
                    <button class="text-brand-600 font-bold text-sm">View All</button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Venue</th>
                                <th class="px-8 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Client</th>
                                <th class="px-8 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date & Slot</th>
                                <th class="px-8 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-8 py-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($recentBookings as $booking)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $booking->venue->image }}" class="w-10 h-10 rounded-lg object-cover">
                                            <span class="font-bold text-gray-900">{{ $booking->venue->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="font-bold text-gray-900">{{ $booking->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $booking->email }}</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="font-medium text-gray-900">{{ $booking->event_date->format('M d, Y') }}</p>
                                        <p class="text-xs text-gray-400">{{ $booking->timeSlot->label }}</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter bg-{{ $booking->status->color() }}-100 text-{{ $booking->status->color() }}-700">
                                            {{ $booking->status->label() }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        @if($booking->status->value == 'pending')
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('admin.bookings.status', [$booking->id, 'approved']) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-all">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.bookings.status', [$booking->id, 'rejected']) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-300 text-xs italic">No actions</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
