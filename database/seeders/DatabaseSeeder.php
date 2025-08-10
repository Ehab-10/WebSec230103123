<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // إنشاء صلاحية edit_users
        $editUsers = Permission::firstOrCreate(['name' => 'edit_users']);

        // إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // ربط الصلاحيات بالأدوار
        $adminRole->givePermissionTo($editUsers);
        $this->call(RolePermissionSeeder::class);


        // Employee و user ليس لديهم صلاحية edit_users
    }
}
