<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\CashLoan;
use App\Models\HomeLoan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adviser1 = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
        ]);

        $adviser2 = User::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
        ]);

        $adviser3 = User::factory()->create([
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'email' => 'alice@example.com',
        ]);

        Client::factory(5)
            ->has(
                CashLoan::factory()->state(function (array $attributes, Client $client) use ($adviser1) {
                    return [
                        'adviser_id' => $adviser1->id,
                        'client_id' => $client->id,
                        'loan_amount' => fake()->numberBetween(100000, 5000000),
                    ];
                }),
                'cashLoan'
            )
            ->has(
                HomeLoan::factory()->state(function (array $attributes, Client $client) use ($adviser1) {
                    $property_value = fake()->numberBetween(5000000, 100000000);
                    return [
                        'adviser_id' => $adviser1->id,
                        'client_id' => $client->id,
                        'property_value' => $property_value,
                        'down_payment_amount' => fake()->numberBetween(500000, (int)($property_value * 0.2)),
                    ];
                }),
                'homeLoan'
            )
            ->create();

        Client::factory()
            ->has(
                CashLoan::factory()->state([
                    'adviser_id' => $adviser2->id,
                    'loan_amount' => fake()->numberBetween(100000, 5000000),
                ]),
                'cashLoan'
            )
            ->create([
                'first_name' => 'Bob',
                'last_name' => 'Brown',
                'email' => 'bob@example.com',
                'phone' => '+1-555-123-4567',
            ]);
    }
}