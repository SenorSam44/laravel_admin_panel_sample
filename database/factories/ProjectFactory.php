<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'client_id' => fake()->numberBetween(1, 10), // Adjust as needed
            'start_date' => fake()->date,
            'end_date' => fake()->optional(0.5)->date, // 20% chance of being nullable
            'status' => fake()->randomElement(['ongoing', 'completed', 'pending']),
            'category' => fake()->word,
            'team_members' => fake()->sentence,
            'budget' => fake()->optional(0.3)->randomFloat(2, 1000, 10000), // 30% chance of being nullable
            'tags' => fake()->words(3, true),
            'progress' => fake()->numberBetween(0, 100),
            'published' => fake()->boolean(),
        ];
    }
}
