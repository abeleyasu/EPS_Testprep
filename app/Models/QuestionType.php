<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionType extends Model
{
    use HasFactory, SoftDeletes;
	
	protected $fillable = [
        'question_type_title','question_type_description','question_type_lesson','question_type_strategies','question_type_identification_methods','question_type_identification_activity'
    ];
}
