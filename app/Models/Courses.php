<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CourseManagement\Milestone;
use App\Models\CourseManagement\Module;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Task;

class Courses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'published',
        'content',
        'user_type',
        'duration',
        'order',
        'status',
        'coverimage'
    ];
	public function milestones() {
        return $this->hasMany(Milestone::class)->where('published', true);
    }
	public function getmilestones(){
		return Milestone::where('course_id',$this->id)->where('published',1)->get();
	}
	
	public function tasks(){
		$tasks = Task::select('tasks.*')
				->join('sections', 'section_id', 'sections.id')
				->join('modules','sections.module_id','modules.id')
				->join('milestones','modules.milestone_id','milestones.id')
				->join('courses','milestones.course_id','courses.id')
				->where('tasks.published', 1)
				->where('milestones.deleted_at', NULL)
				->where('modules.deleted_at', NULL)
				->where('courses.id', $this->id)->get();
        return $tasks;
	}
	public function completeTasks($userId) {
        $tasks = Task::select('tasks.*','user_task_statuses.status as complete', 'user_task_statuses.user_id as user_id')
            ->join('sections', 'section_id', 'sections.id')
            ->join('modules','sections.module_id','modules.id')
            ->join('milestones','modules.milestone_id','milestones.id')
				->join('courses','milestones.course_id','courses.id')
            ->leftjoin('user_task_statuses','tasks.id','user_task_statuses.task_id')
            ->where('courses.id', $this->id)
			->where('milestones.deleted_at', NULL)
			->where('modules.deleted_at', NULL)
            ->where('user_task_statuses.status', 1)
            ->where('tasks.published', 1)
			->where('user_task_statuses.user_id', $userId)->get();
        return $tasks;
    }
}
