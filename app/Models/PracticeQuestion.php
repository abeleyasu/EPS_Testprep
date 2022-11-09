<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeQuestion extends Model
{
    use HasFactory;
	protected $fillable = [
        'title','format','practice_test_sections_id', 'order', 'passage_number', 'passages_id', 'answer', 'fill', 'type', 'multiChoice', 'passages', 'answer_content', 'fillType'
    ];

    public function getpassage(){
        return $this->hasOne(Passage::class,'id', 'passages_id');
    }
	
}
