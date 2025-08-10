<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // مسح الكاش الخاص بالصلاحيات
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // انشاء الصلاحيات
        $permissions = [
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // انشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'web']);
 

        // في تهيئة الأدوار والصلاحيات
        $roleEmployee = Role::findByName('employee');
        $roleEmployee->givePermissionTo('edit_users');
 
        // ربط الصلاحيات بالدور الادمن (كل الصلاحيات)
        $adminRole->syncPermissions(Permission::all());

        // ربط صلاحية عرض فقط للموظف
        $employeeRole->syncPermissions(['view_users', 'edit_users']);


        // انشاء مستخدم ادمن
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'], 
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
            ]
        );

        // ربط المستخدم بدور الادمن
        $adminUser->assignRole($adminRole);

        // انشاء مستخدم موظف
        $employeeUser = User::firstOrCreate(
            ['email' => 'employee@example.com'],
            [
                'name' => 'Employee User',
                'password' => Hash::make('password123'),
            ]
        );

        // ربط المستخدم بدور الموظف
        $employeeUser->assignRole($employeeRole);
    }
}
