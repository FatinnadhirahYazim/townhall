<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venue;

class HomeController extends Controller
{
    public function index()
    {
        $venues = Venue::all();
        return view('welcome', compact('venues'));
    }
}
