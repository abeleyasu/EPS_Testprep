<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserRole extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissions() {
        return $this->belongsToMany(UserPermission::class,'user_role_has_permissions', 'role_id', 'permission_id');
    }

    public function users_roles_course() {
        return $this->belongsToMany(Courses::class,'course_user_types', 'user_role_id', 'course_id');
    }

    public function users_roles_milestone() {
        return $this->belongsToMany(Milestone::class,'milestones_user_types', 'user_role_id', 'milestone_id');
    }

    public function users_roles_modules() {
        return $this->belongsToMany(Module::class,'modules_user_types', 'user_role_id', 'module_id');
    }

    public function user_roles_sections() {
        return $this->belongsToMany(Section::class,'sections_user_types', 'user_role_id', 'section_id');
    }

    public function user_roles_tasks() {
        return $this->belongsToMany(Task::class,'tasks_user_types', 'user_role_id', 'task_id');
    }
}
