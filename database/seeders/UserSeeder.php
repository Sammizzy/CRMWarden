<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- Add this line

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create a specific admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create 10 random users using the factory
        User::factory()->count(10)->create();
    }
}