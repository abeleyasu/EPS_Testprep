<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGoogleAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'google_id',
        'google_access_token',
        'google_refresh_token',
        'google_token_type',
        'google_expires_in',
        'google_id_token',
        'google_calendar_id',
        'google_token_created',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getCalenderName() {
        $calender = $this->google_calendar_id;
        dd($calender);
        // if ($calender) {
        //     $calender = explode('@', $calender);
        //     $calender = $calender[0];
        // }
        // return $calender;
    }
}
