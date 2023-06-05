<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostComparisonDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost_comparison_id',
        'direct_tuition_free_year',
        'direct_room_board_year',
        'institutional_academic_merit_aid',
        'institutional_exchange_program_scho',
        'institutional_honors_col_program',
        'institutional_academic_department_scho',
        'institutional_atheletic_scho',
        'institutional_other_talent_scho',
        'institutional_diversity_scho',
        'institutional_legacy_scho',
        'institutional_other_scho',
        'need_base_federal_grants',
        'need_base_institutional_grants',
        'need_base_state_grants',
        'need_base_work_study_grants',
        'need_base_student_loans_grants',
        'need_base_parent_plus_grants',
        'need_base_other_grants',
        'cost_of_attendance_year'
    ];
}
