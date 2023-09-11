<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses;
use App\Models\CourseManagement\Milestone;
use App\Models\CourseManagement\Module;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Task;

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

        $role = ['2'];

        $modules = Module::all();
        foreach ($modules as $module) {
            $module->user_modules_roles()->attach($role);
        }

        $sections = Section::all();
        foreach ($sections as $section) {
            $section->user_sections_roles()->attach($role);
        }

        $tasks = Task::all();
        foreach ($tasks as $task) {
            $task->user_tasks_roles()->attach($role);
        }

    }
}
