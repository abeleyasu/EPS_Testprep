<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses;
use App\Models\CourseManagement\Milestone;

class UpdateCourseUserTyppes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Courses::all();
        foreach ($courses as $course) { 
            $course->user_course_roles()->attach($course->user_type);
        }

        $milestones = Milestone::all();
        foreach ($milestones as $milestone) {
            $milestone->user_milestone_roles()->attach($milestone->user_type);
        }

    }
}
