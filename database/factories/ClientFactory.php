<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->unique()->safeEmail,
            'phone_number' => fake()->phoneNumber,
            'address' => fake()->address,
            'logo' => 'path/to/default-logo.png', // Set a default logo path or URL
            'company_name' => fake()->company,
            'contact_name' => fake()->name,
            'contact_email' => fake()->unique()->safeEmail,
            'website' => fake()->url,
            'industry' => fake()->word,
            'description' => fake()->paragraph(),
            'published' => fake()->boolean(),
            'status' => 'active', // Set a default status
        ];
    }
}
