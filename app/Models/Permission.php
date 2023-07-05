<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as Permissions;

class Permission extends Permissions
{
    use HasFactory;

    public function modules() {
        return $this->hasOne(PermissionModule::class, 'id', 'permision_module_id');
    }
}
