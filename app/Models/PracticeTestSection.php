<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PracticeTestSection extends Model
{
    use HasFactory, SoftDeletes;
	
	protected $fillable = [
        'format', 'practice_test_type','testid',
    ];
	
	public function getPracticeQuestions()
    {
        return $this->hasMany(PracticeQuestion::class, 'practice_test_sections_id','id')->orderBy('question_order');
    }

}