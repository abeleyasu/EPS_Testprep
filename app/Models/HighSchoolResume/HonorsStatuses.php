<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonorsStatuses extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'honors_statuses';

    protected $fillable = [
        'status',
    ];
}
