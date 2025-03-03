<?php

namespace App\Services;

use App\Models\CashLoan;
use App\Models\Client;
use App\Models\HomeLoan;
use Illuminate\Support\Facades\Auth;

class LoanService
{
    public function handleLoans(Client $client, array $data): void
    {
        $adviserId = Auth::id();

        if (isset($data['cash_loan_amount'])) {
            $this->handleCashLoan($client, (int) $data['cash_loan_amount'], $adviserId);
        }

        if (isset($data['property_value']) && isset($data['down_payment_amount'])) {
            $this->handleHomeLoan($client, (int) $data['property_value'], (int) $data['down_payment_amount'], $adviserId);
        }
    }

    protected function handleCashLoan(Client $client, int $amount, int $adviserId): void
    {
        if ($amount <= 0) {
            return;
        }

        $existing = $client->cashLoan;
        if ($existing && $existing->loan_amount === $amount) {
            return;
        }

        if ($existing && $existing->adviser_id !== $adviserId) {
            throw new \Exception(__('loans.cash_loan_adviser_mismatch'));
        }

        CashLoan::updateOrCreate(
            ['client_id' => $client->id],
            ['adviser_id' => $adviserId, 'loan_amount' => $amount]
        );
    }

    protected function handleHomeLoan(Client $client, int $propertyValue, int $downPayment, int $adviserId): void
    {
        if ($propertyValue <= 0 || $downPayment <= 0) {
            return;
        }

        $existing = $client->homeLoan;
        if ($existing && $existing->property_value === $propertyValue && $existing->down_payment_amount === $downPayment) {
            return;
        }

        if ($existing && $existing->adviser_id !== $adviserId) {
            throw new \Exception(__('loans.home_loan_adviser_mismatch'));
        }

        HomeLoan::updateOrCreate(
            ['client_id' => $client->id],
            [
                'adviser_id' => $adviserId,
                'property_value' => $propertyValue,
                'down_payment_amount' => $downPayment,
            ]
        );
    }
}