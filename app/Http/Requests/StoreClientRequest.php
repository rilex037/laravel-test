<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (empty($this->email) && empty($this->phone)) {
                $validator->errors()->add('contact', __('clients.contact_required'));
            }
        });
    }

    public function validatedClientData(): array
    {
        return $this->only(['first_name', 'last_name', 'email', 'phone']);
    }

    public function validatedLoanData(): array
    {
        return $this->only(['cash_loan_amount', 'property_value', 'down_payment_amount']);
    }
}