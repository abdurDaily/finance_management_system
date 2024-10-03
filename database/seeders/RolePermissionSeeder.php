<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole =  Role::create(['name' => 'admin']);
        $adminRole =  Role::create(['name' => 'editor']);

        $permissions = Permission::create(['name' => 'edit']);
        $permissions = Permission::create(['name' => 'delete']);

        // $adminRole->givePermissionTo($permission);
        // $permission->assignRole($adminRole);

        $adminRole->syncPermissions($permissions);
        $permissions->syncRoles($adminRole);
    }
}