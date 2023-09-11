<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPracticeTestQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'practice_test_id',
        'practice_questions_id',
        'temp_id',
        'answer',
        'guess',
        'flag',
        'skip',
        'actual_time',
    ];
}
