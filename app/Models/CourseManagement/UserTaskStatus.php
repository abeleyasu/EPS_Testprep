<?php

namespace App\Models\CourseManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTaskStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'user_id',
        'status'
    ];

    const INCOMPLETE = 0;
    const COMPLETE = 1;
}
