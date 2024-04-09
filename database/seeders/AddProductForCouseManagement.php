<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses;
use App\Models\CourseManagement\Milestone;
use App\Models\CourseManagement\Module;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Task;

class AddProductForCouseManagement extends Seeder
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
            $course->user_course_products()->attach($course->product_id);
        }

        $milestones = Milestone::all();
        foreach ($milestones as $milestone) {
            $milestone->user_milestone_products()->attach($milestone->product_id);
        }

        $modules = Module::all();
        foreach ($modules as $module) {
            $module->user_module_products()->attach($module->product_id);
        }

        $sections = Section::all();
        foreach ($sections as $section) {
            $section->user_section_products()->attach($module->product_id);
        }

        $tasks = Task::all();
        foreach ($tasks as $task) {
            $task->user_task_products()->attach($module->product_id);
        }
    }
}
