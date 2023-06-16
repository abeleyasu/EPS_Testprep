<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeMajorInformation extends Model
{
    use HasFactory;

    protected $table = 'college_major_information';
    protected $fillable = [
        'title',
        'code',
    ];
}
