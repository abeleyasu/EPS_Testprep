<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PracticeTest extends Model
{
    use HasFactory, SoftDeletes;
	
	protected $fillable = [
        'title', 'format', 'description',
    ];

    public function getPracticeSections()
    {
        return $this->hasMany(PracticeTestSection::class, 'testid','id');
    }
}
