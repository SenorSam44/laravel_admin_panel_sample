<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'to_name' => fake()->name,
            'to_address' => fake()->address,
            'to_phone_number' => fake()->phoneNumber,
            'invoice_number' => fake()->unique()->randomNumber(),
            'vat_percentage' => fake()->randomFloat(2, 5, 20),
            'payment_method' => fake()->randomElement(['Cash', 'Bank Transfer']),
            'account_no' => fake()->bankAccountNumber, // Assuming you have a faker provider for this
            'account_name' => fake()->name,
            'account_bank' => fake()->name." Bank" ,
            'transaction_number' => fake()->unique()->randomNumber(),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;

            },
        ];
    }
}
