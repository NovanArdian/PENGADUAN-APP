<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Staff Users
        User::create([
            'email' => 'staff@example.com',
            'password' => Hash::make('password123'),
            'role' => 'STAFF',
        ]);

        // Create Head Staff Users
        User::create([
            'email' => 'headstaff@example.com',
            'password' => Hash::make('password123'),
            'role' => 'HEAD_STAFF',
        ]);

        // Add more staff users if needed
        User::factory()->count(5)->create(['role' => 'STAFF']);

        // Add more head staff users if needed
        User::factory()->count(2)->create(['role' => 'HEAD_STAFF']);
    }
}
