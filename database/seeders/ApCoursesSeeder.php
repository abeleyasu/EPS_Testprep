<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\EducationCourse;

class ApCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ap_courses = Config::get('constants.ap_courses');

        foreach($ap_courses as $ap_course){
            EducationCourse::create([
                "name" => $ap_course,
                "course_type" => 2,
            ]);
        }
    }
}
