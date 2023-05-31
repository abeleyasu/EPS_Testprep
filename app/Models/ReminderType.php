<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderType extends Model
{
    use HasFactory;
    protected $table = 'reminder_types';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
