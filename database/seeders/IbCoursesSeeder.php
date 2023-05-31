<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\EducationCourse;



class IbCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ib_courses = Config::get('constants.ib_courses');

        foreach($ib_courses as $ib_course){
            EducationCourse::create([
                "name" => $ib_course,
                "course_type" => 1,
            ]);
        }  
    }
}
