<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonorsAchievementAwards extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'honors_achievement_awards';

    protected $fillable = [
        'award',
    ];
}
