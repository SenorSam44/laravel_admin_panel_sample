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

        $class_array = [
            'user' => UserSeeder::class,
            'expense' => ExpenseSeeder::class,
            'client' => ClientSeeder::class,
            'project' => ProjectSeeder::class,

        ];

        foreach ($class_array as $key => $value){
            $this->call([$value]);

            $this->command->info(ucfirst($key).' table seeded!');
        }
    }
}
