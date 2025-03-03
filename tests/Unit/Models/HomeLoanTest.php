<?php

namespace Tests\Unit\Models;

use App\Models\HomeLoan;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeLoanTest extends TestCase
{
    use RefreshDatabase;

    public function testItBelongsToClient()
    {
        $client = Client::factory()->create();
        $adviser = User::factory()->create();
        $loan = HomeLoan::factory()->create([
            'client_id' => $client->id,
            'adviser_id' => $adviser->id,
        ]);
        $this->assertInstanceOf(Client::class, $loan->client);
    }
}