<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        function createPermissionIfNotExists($name) {
            if (!Permission::where('name', $name)->exists()) {
                Permission::create(['name' => $name]);
            }
        }

        // الصلاحيات الجديدة
        createPermissionIfNotExists('buy products');
        createPermissionIfNotExists('view own profile');
        createPermissionIfNotExists('list purchased products');
        createPermissionIfNotExists('add products');
        createPermissionIfNotExists('edit products');
        createPermissionIfNotExists('delete products');
        createPermissionIfNotExists('list customers');
        createPermissionIfNotExists('add credit');

        // التأكد أن الأدوار موجودة
        $roleUser = Role::firstOrCreate(['name' => 'user']);
        $roleEmployee = Role::firstOrCreate(['name' => 'employee']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);

        // إضافة الصلاحيات بدون حذف القديمة
        $roleUser->givePermissionTo(['buy products', 'view own profile', 'list purchased products']);
        $roleEmployee->givePermissionTo(['add products', 'edit products', 'delete products', 'list customers', 'add credit']);
        $roleAdmin->givePermissionTo(Permission::all());
    }
}


