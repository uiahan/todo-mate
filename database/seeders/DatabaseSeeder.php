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
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'phone_number' => '095923847',
            'role' => 'admin',
            'password' => bcrypt('admin123')
        ]);

        User::create([
            'name' => 'Tasker',
            'username' => 'tasker',
            'phone_number' => '092343822',
            'role' => 'tasker',
            'password' => bcrypt('tasker123')
        ]);

        User::create([
            'name' => 'Worker',
            'username' => 'worker',
            'phone_number' => '085438973',
            'role' => 'worker',
            'password' => bcrypt('worker123')
        ]);
    }
}
