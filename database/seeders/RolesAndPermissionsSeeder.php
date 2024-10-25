<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::create(['name' => 'admin']);
        $publisher_role = Role::create(['name' => 'publisher']);

        $permission1 = Permission::create(['name' => 'create post']);
        $permission2 = Permission::create(['name' => 'no check post']);
        $permission3 = Permission::create(['name' => 'create user']);
        $permission4 = Permission::create(['name' => 'edit user']);

        $admin_role->syncPermissions([$permission1, $permission2, $permission3, $permission4]);
        $publisher_role->syncPermissions([$permission1, $permission2]);
    }
}
