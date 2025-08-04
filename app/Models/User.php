<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // علاقات
// App\Models\User.php
public function roles()
{
    return $this->belongsToMany(Role::class, 'role_user');
}


public function hasPermission($permissionName)
{
    foreach ($this->roles as $role) {
        if ($role->permissions->contains('name', $permissionName)) {
            return true;
        }
    }
    return false;
}


}
