<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionConsumedHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'hours',
        'note',
        'date',
        'consumed_type',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'subscription_id'
    ];
}
