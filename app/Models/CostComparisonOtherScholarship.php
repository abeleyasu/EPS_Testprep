<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostComparisonOtherScholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost_comparison_id',
        'scholarship_name',
        'scholarship_amount',
    ];
}
