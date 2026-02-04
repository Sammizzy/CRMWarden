<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $defaults = ['Work', 'Personal', 'Urgent', 'Follow-up'];

        foreach (User::all() as $user) {
            foreach ($defaults as $name) {
                Category::firstOrCreate([
                    'user_id' => $user->id,
                    'name' => $name,
                ]);
            }
        }
    }
}
