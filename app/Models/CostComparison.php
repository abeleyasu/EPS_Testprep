<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostComparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'college_list_id',
        'college_id',
        'total_direct_cost',
        'total_merit_aid',
        'total_need_based_aid',
        'total_outside_scholarship',
        'total_cost_attendance',
    ];

    public function costcomparisondetail() {
        return $this->hasOne(CostComparisonDetail::class, 'cost_comparison_id', 'id');
    }

    public function costcomparisonotherscholarship() {
        return $this->hasMany(CostComparisonOtherScholarship::class, 'cost_comparison_id', 'id');
    }

    public function college_search_add() {
        return $this->belongsTo(CollegeSearchAdd::class, 'college_list_id', 'id');
    }
}
