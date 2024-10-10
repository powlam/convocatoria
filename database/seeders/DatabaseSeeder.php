<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Paul Albandoz',
            'email' => 'palbandoz@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'Álex Cruz',
            'email' => 'alex.cruz@example.com',
        ]);
    }
}
