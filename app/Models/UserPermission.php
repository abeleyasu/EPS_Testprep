<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'name',
        'slug',
        'guard_name',
        'protected_routes',
        'redirect_route',
    ];

    public function roles() {
        return $this->belongsToMany(UserRole::class,'user_role_has_permissions', 'permission_id', 'role_id');
    }

    public function module() {
        return $this->hasOne(PermissionModule::class, 'id', 'module_id');
    }
}
