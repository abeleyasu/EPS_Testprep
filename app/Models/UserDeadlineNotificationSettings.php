<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeadlineNotificationSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'frequency',
        'when',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id'
    ];
}
