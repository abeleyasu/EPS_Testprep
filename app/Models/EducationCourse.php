<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'course_type'
    ];
}
