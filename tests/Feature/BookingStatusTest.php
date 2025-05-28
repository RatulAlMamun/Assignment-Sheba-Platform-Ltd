<?php

namespace Tests\Feature;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_status_can_be_retrieved(): void
    {
        $booking = Booking::factory()->create([
            'status' => BookingStatus::CONFIRMED,
        ]);
        $response = $this->getJson("/api/booking/" . $booking->uuid);
        $response->assertOk()
            ->assertJsonPath('data.status', BookingStatus::CONFIRMED);
    }
}
