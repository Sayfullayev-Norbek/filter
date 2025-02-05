<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 4; $i++) {
            $admin = User::create([
                'name' => 'Admin ' . $i,
                'email' => 'admin' . $i . '@example.com',
                'password' => Hash::make('password123'),
            ]);

            $admin->assignRole('admin');
        }

        for ($i = 1; $i <= 8; $i++) {
            $seller = User::create([
                'name' => 'Seller ' . $i,
                'email' => 'seller' . $i . '@example.com',
                'password' => Hash::make('password123'),
            ]);

            $seller->assignRole('seller');
        }

        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password123'),
            ]);

            $user->assignRole('user');
        }

    }
}
