<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class FeaturedAttribute extends Model
{
    use HasFactory;

    protected $table = "featured_attributes";

    protected $guarded = [];

    protected $casts = [
        'featured_skills_data' => 'array',
        'featured_awards_data' => 'array',
        'featured_languages_data' => 'array'
    ];

    protected function featuredSkillsData(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    protected function featuredAwardsData(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    protected function featuredLanguagesData(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 
}
