<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = [
        'venue_id',
        'label',
        'start_time',
        'end_time',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
