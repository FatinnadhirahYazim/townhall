<x-mail::message>
# Booking Status Updated

Dear **{{ $booking->name }}**,

Your booking request for **{{ $booking->venue->name }}** on **{{ $booking->event_date->format('F d, Y') }}** has been **{{ $booking->status->value }}**.

@if($booking->status->value == 'approved')
We are excited to host your event! Our team will contact you shortly with the next steps regarding payment and access.
@else
Unfortunately, we are unable to accommodate your request at this time. Please feel free to explore other available dates or venues.
@endif

**Booking Summary:**
- **Venue:** {{ $booking->venue->name }}
- **Date:** {{ $booking->event_date->format('F d, Y') }}
- **Time Slot:** {{ $booking->timeSlot->label }}
- **Status:** {{ ucfirst($booking->status->value) }}

<x-mail::button :url="route('home')">
Return to Site
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
