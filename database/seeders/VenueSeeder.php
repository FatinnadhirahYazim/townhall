<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venues = [
            [
                'name' => 'Dewan Perdana Kuala Lumpur',
                'slug' => 'dewan-perdana-kl',
                'description' => 'Dewan acara mewah di tengah pusat bandar Kuala Lumpur, sesuai untuk majlis perkahwinan dan seminar korporat skala besar.',
                'location' => 'Bukit Bintang, Kuala Lumpur',
                'capacity' => 800,
                'price_per_hour' => 250.00,
                'amenities' => ['Sistem Bunyi Professional', 'Pentas Utama', 'Bilik Menunggu VIP', 'Parkir Percuma'],
                'image' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Bangsar Creative Studio',
                'slug' => 'bangsar-creative-studio',
                'description' => 'Ruang kreatif minimalis untuk workshop, kelas seni, dan sesi brainstorming. Suasana santai dan inspiratif.',
                'location' => 'Telawi, Bangsar',
                'capacity' => 40,
                'price_per_hour' => 70.00,
                'amenities' => ['Papan Tulis', 'WiFi Berkelajuan Tinggi', 'Penyaman Udara', 'Mesin Kopi'],
                'image' => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Bilik Mesyuarat Putrajaya',
                'slug' => 'bilik-mesyuarat-putrajaya',
                'description' => 'Ruang mesyuarat eksklusif dengan pemandangan tasik Putrajaya, dilengkapi kemudahan video konferens terkini.',
                'location' => 'Presint 1, Putrajaya',
                'capacity' => 15,
                'price_per_hour' => 120.00,
                'amenities' => ['Video Conferencing', 'Smart TV', 'Jamuan Ringan', 'Mesra OKU'],
                'image' => 'https://images.unsplash.com/photo-1431540015161-0bf868a2d407?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($venues as $venueData) {
            $venue = \App\Models\Venue::create($venueData);

            // Add standard time slots for each venue
            $venue->timeSlots()->createMany([
                ['label' => 'Sesi Pagi (8:00 AM - 12:00 PM)', 'start_time' => '08:00:00', 'end_time' => '12:00:00'],
                ['label' => 'Sesi Petang (1:00 PM - 5:00 PM)', 'start_time' => '13:00:00', 'end_time' => '17:00:00'],
                ['label' => 'Sesi Malam (6:00 PM - 10:00 PM)', 'start_time' => '18:00:00', 'end_time' => '22:00:00'],
            ]);
        }
    }
}
