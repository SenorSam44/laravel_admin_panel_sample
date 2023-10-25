<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserSeeder::class]);

        $this->command->info('User table seeded!');

        $this->call([ExpenseSeeder::class]);

        $this->command->info('Expense table seeded!');
    }
}
