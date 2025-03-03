<?php

namespace Tests\Unit\Models;

use App\Models\CashLoan;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CashLoanTest extends TestCase
{
    use RefreshDatabase;

    public function testItBelongsToAdviser()
    {
        $client = Client::factory()->create();
        $adviser = User::factory()->create();
        $loan = CashLoan::factory()->create([
            'client_id' => $client->id,
            'adviser_id' => $adviser->id,
        ]);
        $this->assertInstanceOf(User::class, $loan->adviser);
    }
}