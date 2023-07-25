<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRolehHasPermission extends Model
{
    use HasFactory;

    protected $table = 'user_role_has_permissions';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];
}
