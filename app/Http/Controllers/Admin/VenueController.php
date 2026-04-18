<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues = Venue::latest()->paginate(10);
        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        return view('admin.venues.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'amenities' => 'nullable|array',
            'image' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug
        $count = Venue::where('slug', 'LIKE', "{$validated['slug']}%")->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        Venue::create($validated);

        return redirect()->route('admin.venues.index')->with('success', 'Venue created successfully.');
    }

    public function show(Venue $venue)
    {
        return view('admin.venues.show', compact('venue'));
    }

    public function edit(Venue $venue)
    {
        return view('admin.venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'amenities' => 'nullable|array',
            'image' => 'nullable|url',
        ]);

        if ($venue->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $venue->update($validated);

        return redirect()->route('admin.venues.index')->with('success', 'Venue updated successfully.');
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('admin.venues.index')->with('success', 'Venue deleted successfully.');
    }
}
