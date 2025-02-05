<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('user')->get();
        foreach ($users as $user) {
            Product::factory(80)->create([
                'user_id' => $user->id,
            ]);
        }

        $sellers = User::role('seller')->get();
        foreach ($sellers as $seller) {
            Product::factory(40)->create([
                'user_id' => $seller->id,
            ]);
        }

        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            Product::factory(10)->create([
                'user_id' => $admin->id,
            ]);
        }
    }
}
