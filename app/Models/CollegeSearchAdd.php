<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeSearchAdd extends Model
{
    use HasFactory;

    protected $table = 'college_search_adds';

    protected $fillable = [
        'college_lists_id',
        'college_id',
        'college_name',
        'size',
        'type_of_school',
        'urbanicity',
        'college_acceptance_rate',
        'college_average_anual_cost',
        'college_median_earnings',
        'order_index',
        'option',
        'avg_gpa',
        'avg_sat',
        'avg_act',
    ];
}
