<?php

namespace App\Models\CourseManagement;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'description',
        'content',
        'user_type',
        'duration',
        'order',
        'status',
        'added_by',
        'content_category_id',
        'course_id',
        'coverimage',
        'published'
    ];

    public function hasTags() {
        return $this->hasMany(ModelTag::class);
    }

    public function modules() {
        return $this->hasMany(Module::class)->where('published', true);
    }

    public function tags() {
        return Tag::select('tags.id','tags.name')
            ->join('model_has_tags', 'tags.id','model_has_tags.tag_id')
            ->join('milestones','model_has_tags.model_id','milestones.id')
            ->where([
                ['model_has_tags.model_id', $this->id],
                ['model_has_tags.model_type', get_class($this)]
            ])->get();
    }
	public function tasks(){
		$tasks = Task::select('tasks.*')
				->join('sections', 'section_id', 'sections.id')
				->join('modules','sections.module_id','modules.id')
				->where('tasks.published', 1)
				->where('modules.deleted_at', NULL)
				->where('modules.milestone_id', $this->id)->get();
        return $tasks;
	}
	public function completeTasks($userId) {
        $tasks = Task::select('tasks.*','user_task_statuses.status as complete', 'user_task_statuses.user_id as user_id')
            ->join('sections', 'section_id', 'sections.id')
            ->join('modules','sections.module_id','modules.id')
            ->leftjoin('user_task_statuses','tasks.id','user_task_statuses.task_id')
            ->where('modules.milestone_id', $this->id)
			->where('modules.deleted_at', NULL)
            ->where('user_task_statuses.status', 1)
            ->where('tasks.published', 1)
			->where('user_task_statuses.user_id', $userId)->get();
        return $tasks;
    }

}
