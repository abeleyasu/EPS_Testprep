<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeList extends Model
{
    use HasFactory;

    protected $table = 'college_lists';

    protected $fillable = [
        'user_id',
        'last_search_string',
        // for high school test score
        'high_school_test_type',
        'high_school_test_date',
        'high_school_english_score',
        'high_school_math_score',
        'high_school_reading_score',
        'high_school_science_score',
        'high_school_composite_score',
        // for Goal score
        'goal_test_type',
        'goal_test_date',
        'goal_english_score',
        'goal_math_score',
        'goal_reading_score',
        'goal_science_score',
        'goal_composite_score',
        // final score
        'final_test_type',
        'final_test_date',
        'final_english_score',
        'final_math_score',
        'final_reading_score',
        'final_science_score',
        'final_composite_score',
        // end
        'active_step',
        'status',
        'unweighted_gpa',
        'weighted_gpa',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'status',
        'last_search_string',
        'user_id'
    ];

    public function college_list_details() {
        return $this->hasMany(CollegeSearchAdd::class, 'college_lists_id', 'id');
    }
}
