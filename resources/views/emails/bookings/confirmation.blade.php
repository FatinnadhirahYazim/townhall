<x-mail::message>
# Permohonan Tempahan Diterima!

Terima kasih **{{ $booking->name }}**,

Kami telah menerima permohonan tempahan anda untuk **{{ $booking->venue->name }}**.

Pasukan kami sedang menyemak ketersediaan ruang untuk tarikh dan masa yang anda pilih. Kami akan menghantar emel makluman sebaik sahaja status tempahan anda dikemaskini.

**Ringkasan Tempahan:**
- **Ruang:** {{ $booking->venue->name }}
- **Tarikh:** {{ $booking->event_date->format('d/m/Y') }}
- **Sesi:** {{ $booking->timeSlot->label }}
- **Bilangan Tetamu:** {{ $booking->guest_count }} orang

Status semasa: **Menunggu Pengesahan (Pending)**

<x-mail::button :url="route('bookings.index')">
Lihat Status Tempahan Saya
</x-mail::button>

Terima kasih kerana memilih kami.

Salam mesra,<br>
Pasukan {{ config('app.name') }}
</x-mail::message>
