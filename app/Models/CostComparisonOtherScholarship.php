<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostComparisonOtherScholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost_comparison_id',
        'cost_aid_type_id',
        'name',
        'amount',
    ];

    public function costtype() {
        return $this->hasOne(CostTypes::class, 'id', 'cost_aid_type_id');
    }
}
