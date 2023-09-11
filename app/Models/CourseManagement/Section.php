<?php

namespace App\Models\CourseManagement;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRole;
use App\Models\Product;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'module_id',
        'order',
        'status',
        'coverimage',
        'published',
        'product_id',
    ];

    public function tasks() {
        return $this->hasMany(Task::class)->orderBy('order');
    }
	public function totalTasks() {
        return $this->tasks()->where('published','=', 1)->whereHas('user_tasks_roles', function ($q) {
            $q->where('user_role_id', auth()->user()->role);
        });
    }


    public function taskStatus() {
        $tasks = Task::select('tasks.*','user_task_statuses.status as complete', 'user_task_statuses.user_id')
            ->join('sections', 'section_id', 'sections.id')
            ->leftjoin('user_task_statuses','tasks.id','user_task_statuses.task_id')
			->where('tasks.published',1)
            ->where('sections.id', $this->id)
			->orderBy('order')->whereHas('user_tasks_roles', function ($q) {
                $q->where('user_role_id', auth()->user()->role);
            })->get();
        return $tasks;
    }
    public function module() {
        return $this->belongsTo(Module::class);
    }
	public function tags() {
        return Tag::select('tags.id','tags.name')
            ->join('model_has_tags', 'tags.id','model_has_tags.tag_id')
            ->join('sections','model_has_tags.model_id','sections.id')
            ->where([
                ['model_has_tags.model_id', $this->id],
                ['model_has_tags.model_type', get_class($this)]
            ])->get();
    }
	public function sectionTasks($userId) {
        $tasks = Task::select('tasks.*')
				->join('sections', 'section_id', 'sections.id')
				->where('tasks.published', 1)
				->where('sections.id', $this->id)->get();
        return $tasks;
    }
    public function sectionCompleteTasks($userId) {
        $tasks = Task::select('tasks.*','user_task_statuses.status as complete', 'user_task_statuses.user_id as user_id')
            ->join('sections', 'section_id', 'sections.id')
            ->leftjoin('user_task_statuses','tasks.id','user_task_statuses.task_id')
            ->where('sections.id', $this->id)
            ->where('user_task_statuses.status', 1)
            ->where('tasks.published', 1)
			->where('user_task_statuses.user_id', $userId)->get();
        return $tasks;
    }

    public function user_sections_roles() {
        return $this->belongsToMany(UserRole::class,'sections_user_types', 'section_id', 'user_role_id');
    }

    public static function getUserTypeWiseSections($moduleId) {
        return Section::where('module_id', $moduleId)->where('published', 1)->whereHas('user_sections_roles', function ($q) {
            $q->where('user_role_id', auth()->user()->role);
        })->orderBy('order');
    }

    public function userHasSectionsPermissionOrNot() {
        return $this->user_sections_roles()->where('user_role_id', auth()->user()->role)->exists();
    }

    public function user_section_products() {
        return $this->belongsToMany(Product::class,'section_products', 'section_id', 'product_id');
    }
}
