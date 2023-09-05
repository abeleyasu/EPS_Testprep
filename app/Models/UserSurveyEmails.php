<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSurveyEmails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_surveys_id',
        'email',
        'email_type',
    ];
}
