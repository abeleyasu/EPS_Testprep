<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelTag extends Model
{
    use HasFactory;
    
    protected $table = 'model_has_tags';

    protected $guarded = [];

    public function milestone() {
        return $this->belongsTo(Milestone::class);
    }
}
