<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'survay_type',
        'high_school_year',
        'reference_path',
        'specific_path',
        'specific_path_other_detail',
        'found_other_website_link',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function parent_student_info() {
        return $this->hasMany(UserSurveyEmails::class, 'user_surveys_id', 'id')->where('email_type', 'parent_student');
    }

    public function friends() {
        return $this->hasMany(UserSurveyEmails::class, 'user_surveys_id', 'id')->where('email_type', 'friend');
    }
}
