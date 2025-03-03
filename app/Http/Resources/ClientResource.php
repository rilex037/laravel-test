<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cash_loan_amount' => $this->cashLoan?->loan_amount,
            'property_value' => $this->homeLoan?->property_value,
            'down_payment_amount' => $this->homeLoan?->down_payment_amount,
            'has_cash_loan' => !is_null($this->cashLoan),
            'has_home_loan' => !is_null($this->homeLoan),
        ];
    }
}
