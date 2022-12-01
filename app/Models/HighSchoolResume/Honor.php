<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Honor extends Model
{
    use HasFactory;

    protected $table = "honors";

    protected $guarded = [];

    protected $casts = [
        'honors_data' => 'array'
    ];

    /**
     * Get the honors.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function honorsData(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 
}
