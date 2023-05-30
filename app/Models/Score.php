<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'section_id',
        'question_id',
        'actual_score',
        'converted_score',
        'section_type',
        'test_id'
    ];
}
