<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HomeLoanFactory extends Factory
{
    public function definition(): array
    {
        $property_value = fake()->numberBetween(5000000, 100000000);

        return [
            'client_id' => null,
            'adviser_id' => null,
            'property_value' => $property_value,
            'down_payment_amount' => fake()->numberBetween(500000, (int)($property_value * 0.2)),
        ];
    }
}
