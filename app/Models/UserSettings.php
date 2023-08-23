<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;

    protected $table = 'user_settings';
    
    protected $fillable = [
        'user_id',
        'application_deadline_notification',
        'is_receive_sms',
        'timezone',
        'is_receive_emails_newsletters',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
