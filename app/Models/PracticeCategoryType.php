<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PracticeCategoryType extends Model
{
    use HasFactory, SoftDeletes;
	
	protected $fillable = [
        'category_type_title'
    ];

}
