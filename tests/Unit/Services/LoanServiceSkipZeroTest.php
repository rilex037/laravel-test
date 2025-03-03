<?php

namespace Tests\Unit\Services;

use App\Models\Client;
use App\Models\User;
use App\Services\LoanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class LoanServiceSkipZeroTest extends TestCase
{
    use RefreshDatabase;

    public function testItSkipsZeroAmountCashLoan()
    {
        $adviser = User::factory()->create();
        Auth::shouldReceive('id')->once()->andReturn($adviser->id);

        $client = Client::factory()->create();
        $service = new LoanService();

        $service->handleLoans($client, ['cash_loan_amount' => 0]);

        $this->assertDatabaseMissing('cash_loans', ['client_id' => $client->id]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}