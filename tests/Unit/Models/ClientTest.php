<?php

namespace Tests\Unit\Models;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function testItHasCashLoanRelationship()
    {
        $client = Client::factory()->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasOne', $client->cashLoan());
    }
}