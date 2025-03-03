<?php

namespace Tests\Unit\Services;

use App\Models\Client;
use App\Models\User;
use App\Services\LoanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class LoanServiceCashLoanTest extends TestCase
{
    use RefreshDatabase;

    public function testItCreatesCashLoan()
    {
        $adviser = User::factory()->create();
        Auth::shouldReceive('id')->once()->andReturn($adviser->id);

        $client = Client::factory()->create();
        $service = new LoanService();

        $service->handleLoans($client, ['cash_loan_amount' => 100000]);

        $this->assertDatabaseHas('cash_loans', [
            'client_id' => $client->id,
            'adviser_id' => $adviser->id,
            'loan_amount' => 100000,
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
