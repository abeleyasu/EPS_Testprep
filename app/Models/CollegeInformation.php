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
        'petersons_id',
        'TUIT_STATE_FT_D',
        'TUIT_NRES_FT_D',
        'TUIT_OVERALL_FT_D',
        'FEES_FT_D',
        'BOOKS_RES_D',
        'TRANSPORT_RES_D',
        'AP_RECD_1ST_N',
        'AD_DIFF_ALL',
        'AP_DL_EACT_MON',
        'AP_DL_EACT_DAY',
        'AP_DL_FRSH_MON',
        'AP_DL_FRSH_DAY',
        'LIFE_SOR_NAT' , 
        'LIFE_SOR_LOCAL', 
        'LIFE_FRAT_NAT', 
        'LIFE_FRAT_LOCAL' ,
        'SORO_1ST_P',
        'FRAT_1ST_P',
        'CMPS_METRO_T',
        'HOUS_FRSH_POLICY',
        'HOUS_SPACES_OCCUP',
        'MAIN_CALENDER',
        'MAIN_CALENDAR',
        'RM_BD_D',
        'rolling_admission_deadline',
        'FRSH_GPA',
        'FRSH_GPA_WEIGHTED',
        'pvt_coa',
        'public_coa_in_state',
        'public_coa_out_state',
        'display_peterson_weighted_gpa',
        'display_peterson_unweighted_gpa',
        'AP_DL_EDEC_1_MON',
        'AP_DL_EDEC_1_DAY',
        'AP_DL_EDEC_2_DAY',
        'AP_DL_EDEC_2_MON',
        'has_national_fraternities',
        'has_local_fraternities',
        'percent_freshmen_join_fraternities',
        'percent_men_join_fraternities',
        'academic_calendar_system',
        'percent_women_join_sororities',
        'percent_freshmen_join_sororities',
        'has_local_sororities',
        'has_national_sororities',
        'ncaa',
        'naia',
        'nccaa',
        'njcaa',
        'num_students_in_housing',
        'freshman_housing_guarantee',
        'nearest_metropolitan_area',
        'city_population',
        'entrance_difficulty_out_of_state',
        'entrance_difficulty_overall',
        'average_weighted_gpa',
        'average_unweighted_gpa',
        'css_profile_deadline',
        'fafsa_deadline',
        'competitive_scholarship_deadline',
        'rolling_admission',
        'rolling_admission_day',
        'rolling_admission_month',
        'rolling_admission_month_day',
        'regular_decision',
        'regular_decision_day',
        'regular_decision_month',
        'early_decision_ii',
        'early_decision_ii_day',
        'early_decision_ii_month',
        'early_decision_i',
        'early_decision_i_day',
        'early_decision_i_month',
        'early_action',
        'early_action_day',
        'early_action_month',
        'num_applications',
        'overall_admission_rate',
        'early_decision_1_deadline',
        'early_decision_2_deadline'

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function college_details() {
        return $this->hasOne(CollegeDetails::class, 'college_id', 'id');
    }
    public function fieldsOfStudy()
    {
        return $this->hasMany(FieldsOfStudy::class);
    }
}