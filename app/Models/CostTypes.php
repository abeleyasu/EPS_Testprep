<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cost_type',
        'total_field_name',
        'total_field_key',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function data() {
        return $this->hasMany(CostComparisonOtherScholarship::class, 'cost_aid_type_id', 'id');
    }
}
