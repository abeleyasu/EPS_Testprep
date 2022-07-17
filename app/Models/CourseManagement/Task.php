<?php

namespace App\Models\CourseManagement;

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
}
