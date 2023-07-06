<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'reminder_name', 'reminder_type_id', 'frequency', 'method', 'when_time', 'start_date', 'end_date', 'enabled', 'location', 'type', 'college_id', 'field', 'is_send', 'next_cron_job_run_date_time'
    ];

    public function reminderType()
    {
        return $this->belongsTo(ReminderType::class, 'reminder_type_id');
    }
}
