<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING => 'amber',
            self::APPROVED => 'emerald',
            self::REJECTED => 'rose',
        };
    }
}
