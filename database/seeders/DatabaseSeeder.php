<?php

namespace Database\Seeders;

use App\Models\{User, client};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        client::factory()->create([
            'name' => 'Test User',
            'email' => 'client@gmail.com',
            'password' => '12345',
        ]);

    }
}
