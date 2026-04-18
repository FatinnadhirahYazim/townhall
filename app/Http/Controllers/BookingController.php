<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Venue;
use App\Models\TimeSlot;
use App\Mail\BookingRequested;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'event_date' => 'required|date|after_or_equal:today',
            'guest_count' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Check availability
        $exists = Booking::where('venue_id', $validated['venue_id'])
            ->where('time_slot_id', $validated['time_slot_id'])
            ->where('event_date', $validated['event_date'])
            ->where('status', '!=', 'rejected')
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['time_slot_id' => 'This slot is already booked for the selected date.']);
        }

        $validated['user_id'] = auth()->id();
        $booking = Booking::create($validated);

        // Send email to admin
        Mail::to('admin@example.com')->send(new BookingRequested($booking));

        // Send confirmation email to client
        Mail::to($booking->email)->send(new BookingConfirmation($booking));

        return redirect()->route('bookings.success', $booking->id);
    }

    public function success(Booking $booking)
    {
        return view('bookings.success', compact('booking'));
    }
}
