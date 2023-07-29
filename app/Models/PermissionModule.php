<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Permission\Models\Permission;

class PermissionModule extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function permission() {
        return $this->hasMany(Permission::class, 'permision_module_id', 'id');
    }

    public function userPermission() {
        return $this->hasMany(UserPermission::class, 'module_id', 'id');
    }
}
