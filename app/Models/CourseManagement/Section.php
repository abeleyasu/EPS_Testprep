<?php

namespace App\Models\CourseManagement;

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
            ->where('sections.id', $this->id)->get();
        return $tasks;
    }
    public function module() {
        return $this->belongsTo(Module::class);
    }
}
