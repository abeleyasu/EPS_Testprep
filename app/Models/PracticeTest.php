<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PracticeTest extends Model
{
    use HasFactory, SoftDeletes;
	
	protected $fillable = [
        'title', 
        'format',
        'test_source', 
        'description',
        'tags',
        'is_test_completed',
        'user_id',
        'status',
    ];

    public function getPracticeSections()
    {
        return $this->hasMany(PracticeTestSection::class, 'testid','id');
    }

    public function userAnswers(){
        return $this->hasMany(UserAnswers::class,'test_id','id');
    }

    public function practice_tests_products() {
        return $this->belongsToMany(Product::class);
    }
}
