<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'sanctum',
        ]);

        $customer = Role::firstOrCreate([
            'name' => 'customer',
            'guard_name' => 'sanctum',
        ]);

        $vendor = Role::firstOrCreate([
            'name' => 'vendor',
            'guard_name' => 'sanctum',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            'view-profile',
            'update-profile',
            'delete-account',
            'manage-users',
            'manage-vendors',
            'manage-roles',
            'manage-permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'sanctum',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Role Permissions
        |--------------------------------------------------------------------------
        */

        $superAdmin->syncPermissions([
            'view-profile',
            'update-profile',
            'manage-users',
            'manage-vendors',
            'manage-roles',
            'manage-permissions',
        ]);

        $customer->syncPermissions([
            'view-profile',
            'update-profile',
            'delete-account',
        ]);

        $vendor->syncPermissions([
            'view-profile',
            'update-profile',
        ]);
    }
}