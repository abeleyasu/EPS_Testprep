<?php

namespace App\Models\CourseManagement;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserRole;
use App\Models\Product;

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
        'published',
        'product_id',
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

    public function user_tasks_roles() {
        return $this->belongsToMany(UserRole::class,'tasks_user_types', 'task_id', 'user_role_id');
    }

    public function userHasTaskPermissionOrNot() {
        return $this->user_tasks_roles->contains(auth()->user()->role);
    }

    public function user_task_products() {
        return $this->belongsToMany(Product::class,'task_products', 'task_id', 'product_id');
    }
}
