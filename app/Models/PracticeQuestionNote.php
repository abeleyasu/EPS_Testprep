<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeQuestionNote extends Model
{
    use HasFactory;

    protected $table = 'practice_question_notes';

    protected $fillable = [
        'practice_question_id',
        'user_id',
        'notes'
    ];
}
