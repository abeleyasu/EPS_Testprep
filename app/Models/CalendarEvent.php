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
        'google_calendar_event_id',
        'user_calender_id'
    ];

    public function user_calendar() {
        return $this->hasOne(UserCalendar::class, 'event_id', 'id');
    }

    public function get_calender_from_list() {
        return $this->hasOne(UserCalendersList::class, 'id', 'user_calender_id');
    }
}
