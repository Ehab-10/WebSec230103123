<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => bcrypt('password'), 'admin' => 1]
        );
        $admin->assignRole('admin');

        // user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'Normal User', 'password' => bcrypt('password'), 'admin' => 0]
        );
        $user->assignRole('user');

        // emp ✅
        $emp = User::firstOrCreate(
            ['email' => 'emp@example.com'],
            ['name' => 'Employee User', 'password' => bcrypt('password'), 'admin' => 0]
        );
        $emp->assignRole('emp');
    }
}
