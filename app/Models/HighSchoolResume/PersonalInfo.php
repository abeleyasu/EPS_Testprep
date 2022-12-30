<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $table = "personal_info";

    protected $guarded = [];

    protected $casts = [
        'social_links' => 'array'
    ];

    /**
     * Get the social links.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function socialLinks(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 
}
