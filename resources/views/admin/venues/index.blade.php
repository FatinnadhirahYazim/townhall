<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight font-outfit">
                {{ __('Manage Venues') }}
            </h2>
            <a href="{{ route('admin.venues.create') }}" class="px-6 py-3 bg-brand-600 text-white rounded-2xl font-bold flex items-center gap-2 hover:bg-brand-700 transition-all shadow-lg shadow-brand-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Add Venue
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl text-green-600 font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Venue</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Location</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Capacity</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Price</th>
                                <th class="px-8 py-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($venues as $venue)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            @if($venue->image)
                                                <img src="{{ $venue->image }}" class="w-12 h-12 rounded-xl object-cover shadow-sm">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 font-bold">H</div>
                                            @endif
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $venue->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $venue->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-gray-600 font-medium">{{ $venue->location }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="font-bold text-gray-900">{{ $venue->capacity }}</span>
                                        <span class="text-gray-400 text-xs"> guests</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="font-bold text-brand-600">${{ number_format($venue->price_per_hour, 0) }}</span>
                                        <span class="text-gray-400 text-xs">/hr</span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('admin.venues.edit', $venue->id) }}" class="p-2 text-gray-400 hover:text-brand-600 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('admin.venues.destroy', $venue->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-12 text-center text-gray-400 italic">No venues found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($venues->hasPages())
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $venues->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
