<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCalendar extends Model
{
    use HasFactory;

    protected $table = 'user_calendars';
    
    protected $fillable = [
        'event_id',
        'start_date',
        'end_date'
    ];

    public function event()
    {
        return $this->hasOne(CalendarEvent::class, 'id', 'event_id');
    }
}
