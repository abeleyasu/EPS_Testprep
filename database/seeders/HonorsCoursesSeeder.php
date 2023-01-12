<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\HonorCourseNameList;

class HonorsCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $honors_courses_name = Config::get('constants.honors_courses_name');

        foreach($honors_courses_name as $honor_course){
            HonorCourseNameList::create([
                "name" => $honor_course,
            ]);
        }  
    }
}
