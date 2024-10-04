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
        $roles = [
            'admin',
            'manager',
            'user',
        ];
    
        $permissions = [
            'edit',
            'delete',
        ];
    
        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName]);
            $rolePermissions = [];
    
            foreach ($permissions as $permission){
                $rolePermissions[] = Permission::firstOrCreate(['name' => $permission]);
                $role->givePermissionTo($rolePermissions[count($rolePermissions) - 1]);
                }
            }
        }
    }