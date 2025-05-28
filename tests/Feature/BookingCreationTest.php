<?php

namespace Tests\Feature;

use App\Enums\BookingStatus;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_can_be_created_successfully(): void
    {
        $service = Service::factory()->create();
        $payload = [
            'customer_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone_number' => '1234567890',
            'service_id' => $service->id,
            'schedule_time' => now()->addDay()->toDateString(),
        ];
        $response = $this->postJson('/api/book', $payload);

        $response->assertCreated(201)
            ->assertJsonPath('data.status', BookingStatus::PENDING)
            ->assertJsonPath('success', true);
    }
}
