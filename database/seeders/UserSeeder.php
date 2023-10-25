<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->delete();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret'),
            'role' => '0',
            'position' => 'CEO \ Founder',
        ]);

        User::factory()
            ->count(10) // Adjust the number of employees you want to seed
            ->create();
    }
}
