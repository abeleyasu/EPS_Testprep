<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Education extends Model
{
    use HasFactory;

    protected $table = "educations";

    protected $guarded = [];

    protected $casts = [
        'course_data' => 'array',
        'honor_course_data' => 'array',
        'testing_data' => 'array'
    ];

    protected function courseData(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    protected function honorCourseData(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    protected function testingData(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 
}
