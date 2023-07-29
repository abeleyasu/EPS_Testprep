<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'state',
        'user_id',
        'college_id',
        'sat_math_average',
        'sat_reading_writing_average',
        'act_composite_average',
        'cost_of_attendance',
        'tution_and_fess',
        'room_and_board',
        'average_percent_of_need_met',
        'average_freshman_award',
        'entrance_difficulty',
        'overall_admission_rate',
        'early_action_offerd',
        'early_decision_offerd',
        'regular_admission_deadline',
        'locale',
        'ownership',
        'size',
        'consumer_rate',
        'earnings_median',
        'avg_net_price_overall',
        'gpa_average',
        'sat_composite_score',
        'description',
        'college_icon',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function college_details() {
        return $this->hasOne(CollegeDetails::class, 'college_id', 'id');
    }
}