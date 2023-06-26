<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCollgeScore extends Model
{
    use HasFactory;

    protected $table = 'user_collge_scores';

    protected $fillable = [
        'college_list_id',
        'test_type',
        'test_date',
        'english_score',
        'math_score',
        'reading_score',
        'science_score',
        'composite_score',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'college_list_id'
    ];
}
