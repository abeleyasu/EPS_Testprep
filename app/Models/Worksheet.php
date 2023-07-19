<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sheet_name',
        'icon',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
