<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'user_id',
        'state'
    ];

    public function college_details() {
        return $this->hasOne(CollegeDetails::class, 'college_id', 'id');
    }
}