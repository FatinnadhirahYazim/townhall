<x-mail::message>
# New Booking Request

You have received a new booking request for **{{ $booking->venue->name }}**.

**Client Details:**
- **Name:** {{ $booking->name }}
- **Email:** {{ $booking->email }}
- **Phone:** {{ $booking->phone }}

**Event Details:**
- **Date:** {{ $booking->event_date->format('F d, Y') }}
- **Time Slot:** {{ $booking->timeSlot->label }}
- **Guests:** {{ $booking->guest_count }}
- **Type:** {{ $booking->event_type }}

**Notes:**
{{ $booking->notes ?? 'No special notes provided.' }}

<x-mail::button :url="route('admin.dashboard')">
View in Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
