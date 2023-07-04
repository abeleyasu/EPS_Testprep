<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $table = 'calendar_events';
    
    protected $fillable = [
        'user_id',
        'reminders_id',
        'title',
        'description',
        'is_assigned',
        'color',
        'event_time',
        'google_calendar_event_id'
    ];
}
