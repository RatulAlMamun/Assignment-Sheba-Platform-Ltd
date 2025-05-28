<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Support\Str;
use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'service_id' => Service::factory(),
            'customer_name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'schedule_time' => $this->faker->date(),
            'status' => BookingStatus::PENDING,
        ];
    }
}
