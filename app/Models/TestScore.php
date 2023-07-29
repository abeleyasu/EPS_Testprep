<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestScore extends Model
{
    use HasFactory;
    protected $table = 'test_scores';

    protected $fillable = [
        'user_id',
        'primary_test_type',
        'initial_score',
        'last_test_score',
        'goal_score',
    ];
}
