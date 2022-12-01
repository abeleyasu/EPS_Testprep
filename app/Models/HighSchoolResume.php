<?php

namespace App\Models;

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
}
