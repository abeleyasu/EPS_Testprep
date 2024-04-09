<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestProgress extends Model
{
    use HasFactory;
    protected $table = 'test_progress';

    protected $fillable = [
        'user_id',
        'section_id',
        'question_id',
        'selected_answer',
        'guess',
        'flag',
        'skip',
        'test_id',
        'time_left',
        'actual_time',
        'is_submit',
    ];
}
