<?php

namespace Tests\Unit;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->country = Country::factory()->create();
    }

    public function testCreateWorker(): string
    {
        $response = $this->post('api/worker/create');

        $response->assertStatus(201);

        return $response->decodeResponseJson()['worker_id'];
    }

    /**
     * @depends testCreateWorker
     */
    public function testSendWorkerOnDelegation($workerId)
    {
        $data = [
            'worker_id' => $workerId,
            'country_code' => $this->country->code,
            'start' => '2023-02-26 08:00:00',
            'end' => '2023-02-27 12:00:00',
        ];

        $response = $this->postJson('api/assign', $data);

        $response->assertStatus(201);
    }
}
