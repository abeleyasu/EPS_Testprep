<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeDetails extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
    ];

    protected $fillable = [
        'user_id',
        'college_id',
        'type_of_application',

        'admission_option',
        'admissions_deadline',
        'is_admission_deadline_from_user',

        'number_of_essaya',
        'ad_status',
        'competitive_scholarship_deadline',
        'csd_status',
        'departmental_scholarship_deadline',
        'dsd_status',
        'honors_college_deadline',
        'hcd_status',
        'fafsa_deadline',
        'fafsa_status',
        'css_profile_deadline',
        'css_status',
        'direct_cost',
        'merit_aid',
        'need_based_aid',
        'outside_schlorship_aid',
        'cost_of_attendence',
        'final_admissions_decision',
        'is_application_checklist',
        'is_completed_application',
        'is_request_pay',
        'is_high_school_transcript',
        'is_letter_of_recommedation',
        'is_your_offical_high_school_transcripts',
        'is_school_report_and_counselor',
        'is_test_scores_sent',
        'is_letters_of_recommendation_submitted',
        'is_pay_application_fee',
        'is_submit_application',
        'is_received_application',
        'is_complete_application_type',
        'is_complete_admission_open',
        'is_complete_number_of_essays',
        'is_complete_admission_deadline',
        'is_complete_competitive_scholarship_deadline',
        'is_complete_scholarship_deadline',
        'is_completed_honors_college_deadline',
        'is_completed_fafsa_deadline',
        'is_completed_css_profile_deadline',
        'is_completed_final_admissions_decision',
        'is_completed_all_process'
    ];

    protected $cats = [
        'is_application_checklist' => 'boolean',
        'is_completed_application' => 'boolean',
        'is_request_pay' => 'boolean',
        'is_high_school_transcript' => 'boolean',
        'is_letter_of_recommedation' => 'boolean',
        'is_your_offical_high_school_transcripts' => 'boolean',
        'is_school_report_and_counselor' => 'boolean',
        'is_test_scores_sent' => 'boolean',
        'is_letters_of_recommendation_submitted' => 'boolean',
        'is_pay_application_fee' => 'boolean',
        'is_submit_application' => 'boolean',
        'is_received_application' => 'boolean',
        'is_complete_application_type' => 'boolean',
        'is_complete_admission_open' => 'boolean',
        'is_complete_number_of_essays' => 'boolean',
        'is_complete_admission_deadline' => 'boolean',
        'is_complete_competitive_scholarship_deadline' => 'boolean',
        'is_complete_scholarship_deadline' => 'boolean',
        'is_completed_honors_college_deadline' => 'boolean',
        'is_completed_fafsa_deadline' => 'boolean',
        'is_completed_css_profile_deadline' => 'boolean',
        'is_completed_final_admissions_decision' => 'boolean',
        'is_completed_all_process' => 'boolean'
    ];

    public function college_details() {
        return $this->hasOne(CollegeSearchAdd::class, 'id', 'college_id');
    }
}
