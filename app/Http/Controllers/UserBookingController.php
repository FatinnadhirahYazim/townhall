<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class UserBookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()->with(['venue', 'timeSlot'])->latest()->get();
        return view('bookings.index', compact('bookings'));
    }
}
