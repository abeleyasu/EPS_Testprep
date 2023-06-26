<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeUserStatistics extends Model
{
    use HasFactory;

    protected $table = 'college_user_statistiscs';

    protected $fillable = [
        'college_lists_id',
        'unweighted_gpa',
        'weighted_gpa',
        'goal_psat_score',
        'goal_act_score',
        'goal_sat_score',
        'final_act_score',
        'final_sat_score',
        'final_psat_score',
    ];
}
