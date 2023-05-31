<?php

namespace App\Models\CourseManagement;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'status',
        'order',
        'task_type',
        'coverimage',
        'published'
    ];

    public function section() {
        return $this->belongsTo(Section::class);
    }

    public function taskStatus() {
        return $this->hasMany(UserTaskStatus::class);
    }

    public function authTaskStatus() {
        return $this->taskStatus->where('user_id', auth()->id())->first();
    }
	public function tags() {
        return Tag::select('tags.id','tags.name')
            ->join('model_has_tags', 'tags.id','model_has_tags.tag_id')
            ->join('tasks','model_has_tags.model_id','tasks.id')
            ->where([
                ['model_has_tags.model_id', $this->id],
                ['model_has_tags.model_type', get_class($this)]
            ])->get();
    }
}
