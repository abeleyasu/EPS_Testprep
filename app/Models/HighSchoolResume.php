<?php

namespace App\Models;

use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use App\Models\HighSchoolResume\PersonalInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighSchoolResume extends Model
{
    use HasFactory;

    protected $table = "high_school_resumes";

    protected $guarded = [];

    public function personal_info()
    {
        return $this->hasOne(PersonalInfo::class, 'id', 'personal_info_id');
    }

    public function education()
    {
        return $this->hasOne(Education::class, 'id', 'education_id');
    }

    public function honor()
    {
        return $this->hasOne(Honor::class, 'id', 'honor_id');
    }

    public function activity()
    {
        return $this->hasOne(Activity::class, 'id', 'activity_id');
    }

    public function employmentCertification()
    {
        return $this->hasOne(EmploymentCertification::class, 'id', 'employment_certification_id');
    }

    public function featuredAttribute()
    {
        return $this->hasOne(FeaturedAttribute::class, 'id', 'featured_attribute_id');
    }
}
