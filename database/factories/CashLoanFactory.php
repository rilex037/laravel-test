<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CashLoanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => null,
            'adviser_id' => null,
            'loan_amount' => fake()->numberBetween(100000, 5000000),
        ];
    }
}
