<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::findByName('admin');
        $admin->syncPermissions(Permission::all());

        $seller = Role::findByName('seller');
        $seller->syncPermissions(['view products', 'create products', 'edit products']);

        $user = Role::findByName('user');
        $user->syncPermissions(['view products']);
    }
}
