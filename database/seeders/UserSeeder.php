<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StaffProvince;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Staff User with Province
        $staff = User::create([
            'email' => 'staff@example.com',
            'password' => Hash::make('password123'),
            'role' => 'STAFF',
        ]);
        
        StaffProvince::create([
            'user_id' => $staff->id,
            'province' => 'DKI Jakarta',
        ]);

        // Create Head Staff User
        User::create([
            'email' => 'headstaff@example.com',
            'password' => Hash::make('password123'),
            'role' => 'HEAD_STAFF',
        ]);

        // Create additional staff users with provinces
        $provinces = ['Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Sumatera Utara', 'Bali'];
        
        for ($i = 0; $i < 5; $i++) {
            $staffUser = User::factory()->create(['role' => 'STAFF']);
            StaffProvince::create([
                'user_id' => $staffUser->id,
                'province' => $provinces[$i],
            ]);
        }

        // Create additional head staff users
        User::factory()->count(2)->create(['role' => 'HEAD_STAFF']);
    }
}
