<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeSearchAdd extends Model
{
    use HasFactory, SoftDeletes;

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
        'is_active',
    ];

    public function costcomparison() {
        return $this->hasOne(CostComparison::class, 'college_list_id', 'id');
    }

    public function collegeInformation() {
        return $this->hasOne(CollegeInformation::class, 'college_id', 'college_id');
    }

    public function collegeDeadline() {
        return $this->hasOne(CollegeDetails::class, 'college_id', 'id');
    }

    public function signle_college_information() {
        return $this->hasOne(CollegeList::class, 'id', 'college_lists_id');
    }
}
