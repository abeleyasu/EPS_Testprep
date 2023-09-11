<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCalendersList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_calenders_list';

    protected $fillable = [
        'user_id',
        'calender_id',
        'calender_name',
    ];
}
