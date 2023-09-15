<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeQuestion extends Model
{
    use HasFactory;

    const MISTAKE_TYPES = [
        'content_misunderstanding' => 'Content Misunderstanding',
        'random_error' => 'Random Error',
        'timing_issue' => 'Timing Issue',
    ];

    protected $fillable = [
        'title',
        'format',
        'practice_test_sections_id',
        'type',
        'passages_id',
        'passages',
        'passage_number',
        'answer',
        'answer_content',
        'answer_exp',
        'fill',
        'fillType',
        'multiChoice',
        'question_order',
        'tags',
        'question_type_id',
        'category_type',
        'diff_rating',
        'super_category',
        'selfMade',
        'checkbox_values',
        'super_category_values',
        'category_type_values',
        'question_type_values',
        'parent_id'
    ];

    public function getpassage()
    {
        return $this->hasOne(Passage::class, 'id', 'passages_id');
    }
}
