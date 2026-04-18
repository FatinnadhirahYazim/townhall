<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->constrained()->onDelete('cascade');
            $table->foreignId('time_slot_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('event_date');
            $table->string('event_type');
            $table->integer('guest_count');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();

            $table->unique(['venue_id', 'time_slot_id', 'event_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
