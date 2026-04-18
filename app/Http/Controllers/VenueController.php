<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venue;

class VenueController extends Controller
{
    public function show(Venue $venue)
    {
        $venue->load('timeSlots');
        return view('venues.show', compact('venue'));
    }
}
