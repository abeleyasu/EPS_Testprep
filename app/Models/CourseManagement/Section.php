<?php

namespace App\Models\CourseManagement;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'published'
    ];

    public function tasks() {
        return $this->hasMany(Task::class);
    }


    public function taskStatus() {
        $tasks = Task::select('tasks.*','user_task_statuses.status as complete', 'user_task_statuses.user_id')
            ->join('sections', 'section_id', 'sections.id')
            ->leftjoin('user_task_statuses','tasks.id','user_task_statuses.task_id')
			->where('tasks.published',1)
            ->where('sections.id', $this->id)->get();
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
}
