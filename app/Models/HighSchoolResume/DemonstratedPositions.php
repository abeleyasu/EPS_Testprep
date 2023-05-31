<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemonstratedPositions extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'demonstrated_positions';

    protected $fillable = [
        'position_name',
    ];
}
