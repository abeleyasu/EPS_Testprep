<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athletics_positions extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'athletics_positions';

    protected $fillable = [
        'position',
    ];
}
