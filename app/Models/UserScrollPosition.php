<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScrollPosition extends Model
{
    use HasFactory;

    protected $table = 'user_scroll_positions';

    protected $primaryKey = 'user_id';

}
