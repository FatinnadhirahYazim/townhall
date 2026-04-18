<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Venue;

use App\Mail\BookingStatusUpdated;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_venues' => Venue::count(),
            'total_revenue' => Booking::where('status', 'approved')->join('venues', 'bookings.venue_id', '=', 'venues.id')->sum('venues.price_per_hour'), // Simple calculation
        ];

        $recentBookings = Booking::with(['venue', 'timeSlot'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }

    public function updateBookingStatus(Booking $booking, $status)
    {
        if (!in_array($status, ['approved', 'rejected'])) {
            return back()->with('error', 'Invalid status.');
        }

        $booking->update(['status' => $status]);

        // Send email to client
        Mail::to($booking->email)->send(new BookingStatusUpdated($booking));

        return back()->with('success', "Booking {$status} successfully.");
    }
}
