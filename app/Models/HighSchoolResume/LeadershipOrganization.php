<?php

namespace App\Models\HighSchoolResume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipOrganization extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'leadership_organization';

    protected $fillable = [
        'name',
    ];
}
