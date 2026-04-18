<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\BookingStatus;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'venue_id',
        'time_slot_id',
        'name',
        'email',
        'phone',
        'event_date',
        'event_type',
        'guest_count',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => BookingStatus::class,
            'event_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', BookingStatus::PENDING);
    }
}
