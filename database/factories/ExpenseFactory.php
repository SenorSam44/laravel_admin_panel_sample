<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [Expense::TYPE_EXPENSE, Expense::TYPE_INCOME];
        return [
            'date' => fake()->date(),
            'type' => $types[fake()->numberBetween(0,1)],
            'description' => fake()->sentence(),
            'category' => fake()->word(),
            'amount' => fake()->randomFloat(2, 1, 1000),
        ];
    }
}
