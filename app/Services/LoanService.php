<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CashLoan;
use App\Models\Client;
use App\Models\HomeLoan;

class LoanService
{
    public function handleLoans(Client $client, array $data, int $adviserId): void
    {
        $this->handleCashLoan($client, $data, $adviserId);
        $this->handleHomeLoan($client, $data, $adviserId);
    }

 
    private function handleCashLoan(Client $client, array $data, int $adviserId): void
    {
        $existingCashLoan = $client->cashLoan;

        if (!empty($data['cash_loan_amount'])) {
            if ($existingCashLoan && $existingCashLoan->adviser_id !== $adviserId) {
                return;
            }
            CashLoan::updateOrCreate(
                ['client_id' => $client->id],
                ['adviser_id' => $adviserId, 'loan_amount' => $data['cash_loan_amount']]
            );
        } elseif ($existingCashLoan && $existingCashLoan->adviser_id === $adviserId) {
            $existingCashLoan->delete();
        }
    }

    private function handleHomeLoan(Client $client, array $data, int $adviserId): void
    {
        $existingHomeLoan = $client->homeLoan;

        if (!empty($data['property_value']) && !empty($data['down_payment_amount'])) {
            if ($existingHomeLoan && $existingHomeLoan->adviser_id !== $adviserId) {
                return;
            }
            HomeLoan::updateOrCreate(
                ['client_id' => $client->id],
                [
                    'adviser_id' => $adviserId,
                    'property_value' => $data['property_value'],
                    'down_payment_amount' => $data['down_payment_amount'],
                ]
            );
        } elseif ($existingHomeLoan && $existingHomeLoan->adviser_id === $adviserId) {
            $existingHomeLoan->delete();
        }
    }
}
