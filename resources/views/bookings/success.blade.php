<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Success - TownHall</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background: #fafafa; }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center p-6">
    <div class="max-w-xl w-full bg-white rounded-[3rem] shadow-2xl p-12 text-center border border-gray-100">
        <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
        </div>
        
        <h1 class="text-4xl font-bold font-outfit text-gray-900 mb-4">Request Sent!</h1>
        <p class="text-gray-600 mb-10 leading-relaxed text-lg">
            Thank you, <span class="font-bold text-gray-900">{{ $booking->name }}</span>. Your booking request for <span class="font-bold text-gray-900">{{ $booking->venue->name }}</span> has been submitted successfully.
        </p>

        <div class="bg-gray-50 rounded-3xl p-6 mb-10 text-left space-y-4 border border-gray-100">
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Date</span>
                <span class="text-gray-900 font-bold">{{ $booking->event_date->format('F d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Time Slot</span>
                <span class="text-gray-900 font-bold">{{ $booking->timeSlot->label }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-400 font-medium">Status</span>
                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold uppercase tracking-widest">Pending</span>
            </div>
        </div>

        <div class="space-y-4">
            <a href="{{ route('home') }}" class="block w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-lg hover:bg-black transition-all">
                Back to Explorer
            </a>
            <p class="text-gray-400 text-sm">
                We'll contact you at <span class="text-gray-600 font-medium">{{ $booking->email }}</span> once the admin reviews your request.
            </p>
        </div>
    </div>
</body>
</html>
