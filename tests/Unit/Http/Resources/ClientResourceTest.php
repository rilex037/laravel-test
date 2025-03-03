<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientResourceTest extends TestCase
{
    use RefreshDatabase;

    public function testItTransformsClientWithoutLoansCorrectly()
    {
        $client = Client::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ]);

        $resource = new ClientResource($client);
        $array = $resource->toArray(request());

        $this->assertEquals([
            'id' => $client->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'cash_loan_amount' => null,
            'property_value' => null,
            'down_payment_amount' => null,
            'has_cash_loan' => false,
            'has_home_loan' => false,
        ], $array);
    }
}