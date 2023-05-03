<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_id',
        'type_of_application',
        'admission_option',
        'number_of_essaya',
        'admissions_deadline',
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
        'application_checklist'
    ];
}
