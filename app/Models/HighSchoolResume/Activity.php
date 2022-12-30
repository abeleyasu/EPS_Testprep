<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Activity extends Model
{
    use HasFactory;

    protected $table = "activities";

    protected $guarded = [];

    protected $casts = [
        'demonstrated_data' => 'array',
        'leadership_data' => 'array',
        'activities_data' => 'array',
        'athletics_data' => 'array',
        'community_service_data' => 'array'
    ];

    protected function demonstratedData(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    protected function leadershipData(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    protected function activitiesData(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    protected function athleticsData(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    protected function communityServiceData(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 
}
