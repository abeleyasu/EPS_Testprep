<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAnswers extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_answers';
	
	protected $fillable = [
        'user_id', 'section_id','question_id',
    ];
	
}
