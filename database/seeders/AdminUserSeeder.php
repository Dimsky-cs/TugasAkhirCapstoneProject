<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin 1
        User::updateOrCreate(
            ['email' => 'admin1@genzpsikolog.com'],
            [
                'name' => 'Admin Satu',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Admin 2
        User::updateOrCreate(
            ['email' => 'admin2@genzpsikolog.com'],
            [
                'name' => 'Admin Dua',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Admin 3
        User::updateOrCreate(
            ['email' => 'admin3@genzpsikolog.com'],
            [
                'name' => 'Admin Tiga',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Admin 4
        User::updateOrCreate(
            ['email' => 'admin4@genzpsikolog.com'],
            [
                'name' => 'Admin Empat',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
    }
}
