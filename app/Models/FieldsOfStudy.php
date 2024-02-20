<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldsOfStudy extends Model
{
    use HasFactory;
    protected $table = 'fields_of_study';
    protected $fillable = [
        'code', 'description', 'median_earning', 'debt_after_graduation', 'college_id', 'college_information_id', 'title'
    ];

    public function collegeInformation()
    {
        return $this->belongsTo(CollegeInformation::class);
    }
}
