<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_list_returns_data_successfully(): void
    {
        Service::factory()->count(3)->create();
        $response = $this->getJson('/api/services');
        $response->assertOk()
            ->assertJsonCount(3, 'data.data');
    }
}
