<?php

namespace Database\Seeders;

use App\Models\{User, client, kategori};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        client::factory()->create([
            'name' => 'Test User',
            'email' => 'client@gmail.com',
            'password' => '12345',
        ]);

        kategori::factory()->create([
            'key' => 'programming', 'kategori' => 'Programming',
            'key' => 'web-development', 'kategori' => 'Web Development',
            'key' => 'mobile-development', 'kategori' => 'Mobile Development',
            'key' => 'database', 'kategori' => 'Database Management',
            'key' => 'ui-ux', 'kategori' => 'UI/UX Design',
            'key' => 'graphic-design', 'kategori' => 'Graphic Design',
            'key' => 'network-security', 'kategori' => 'Network & Security',
            'key' => 'data-analysis', 'kategori' => 'Data Analysis',
            'key' => 'project-management', 'kategori' => 'Project Management',
            'key' => 'communication', 'kategori' => 'Communication',
            'key' => 'problem-solving', 'kategori' => 'Problem Solving',
            'key' => 'leadership', 'kategori' => 'Leadership',
            'key' => 'time-management', 'kategori' => 'Time Management',
            'key' => 'machine-learning', 'kategori' => 'Machine Learning',
            'key' => 'devops', 'kategori' => 'DevOps',
        ]);

        

    }
}
