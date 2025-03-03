<?php

namespace App\Http\Requests;

class UpdateClientRequest extends StoreClientRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'cash_loan_amount' => ['nullable', 'numeric', 'min:0'],
            'property_value' => ['nullable', 'numeric', 'min:0', 'required_with:down_payment_amount'],
            'down_payment_amount' => ['nullable', 'numeric', 'min:0', 'required_with:property_value'],
            '_token' => ['required'],
        ];
    }
}
