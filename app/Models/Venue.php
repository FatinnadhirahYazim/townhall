<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'location',
        'capacity',
        'price_per_hour',
        'amenities',
        'image',
    ];

    protected $casts = [
        'amenities' => 'array',
    ];

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
