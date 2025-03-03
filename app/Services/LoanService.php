<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CashLoan;
use App\Models\Client;
use App\Models\HomeLoan;
use Exception;

class LoanService
{
    public function handleLoans(Client $client, array $data, int $adviserId): void
    {
        if (isset($data['cash_loan_amount'])) {
            $this->handleCashLoan($client, $data['cash_loan_amount'], $adviserId);
        }

        if (isset($data['property_value']) && isset($data['down_payment_amount'])) {
            $this->handleHomeLoan($client, $data['property_value'], $data['down_payment_amount'], $adviserId);
        }
    }

    private function handleCashLoan(Client $client, $amount, int $adviserId): void
    {
        $amount = (int)$amount;
        $existing = $client->cashLoan;

        if ($amount <= 0 || ($existing && $amount === $existing->loan_amount)) {
            return;
        }

        if ($existing && $existing->adviser_id !== $adviserId) {
            throw new Exception('Cannot update a cash loan assigned to another adviser.');
        }

        CashLoan::updateOrCreate(
            ['client_id' => $client->id],
            ['adviser_id' => $adviserId, 'loan_amount' => $amount]
        );
    }

    private function handleHomeLoan(Client $client, $propertyValue, $downPayment, int $adviserId): void
    {
        $propertyValue = (int)$propertyValue;
        $downPayment = (int)$downPayment;
        $existing = $client->homeLoan;

        if (
            $propertyValue <= 0 || $downPayment <= 0 ||
            ($existing && $propertyValue === $existing->property_value && $downPayment === $existing->down_payment_amount)
        ) {
            return;
        }

        if ($existing && $existing->adviser_id !== $adviserId) {
            throw new Exception('Cannot update a home loan assigned to another adviser.');
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
