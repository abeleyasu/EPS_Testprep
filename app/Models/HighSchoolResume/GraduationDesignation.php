<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationDesignation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'graduation_designation';

    protected $fillable = [
        'designation',
    ];
}
