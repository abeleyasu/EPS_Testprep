<?php

namespace App\Models\CourseManagement;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserRole;

class Module extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'title',
        'description',
        'content',
        'order',
        'status',
        'added_by',
        'milestone_id',
        'coverimage',
        'published',
        'product_id',
    ];

    public function milestone() {
        return $this->belongsTo(Milestone::class);
    }

    public function sections() {
        return $this->hasMany(Section::class)->orderBy('order');
    }
	public function tasks() {
        $tasks = Task::select('tasks.*')
				->join('sections', 'section_id', 'sections.id')
				->join('modules','sections.module_id','modules.id')
				->where('tasks.published', 1)
				->where('modules.id', $this->id)->get();
        return $tasks;
    }
    public function completeTasks($userId) {
        $tasks = Task::select('tasks.*','user_task_statuses.status as complete', 'user_task_statuses.user_id as user_id')
            ->join('sections', 'section_id', 'sections.id')
            ->join('modules','sections.module_id','modules.id')
            ->leftjoin('user_task_statuses','tasks.id','user_task_statuses.task_id')
            ->where('modules.id', $this->id)
            ->where('user_task_statuses.status', 1)
            ->where('tasks.published', 1)
			->where('user_task_statuses.user_id', $userId)->get();
        return $tasks;
    }
	
    public function tags() {
        return Tag::select('tags.id','tags.name')
            ->join('model_has_tags', 'tags.id','model_has_tags.tag_id')
            ->join('modules','model_has_tags.model_id','modules.id')
            ->where([
                ['model_has_tags.model_id', $this->id],
                ['model_has_tags.model_type', get_class($this)]
            ])->get();
    }

    public function user_modules_roles() {
        return $this->belongsToMany(UserRole::class,'modules_user_types', 'module_id', 'user_role_id');
    }

}
