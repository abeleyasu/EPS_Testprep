<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AwardController extends Controller
{
    public function getAwardList()
    {
        $awards = Config::get('constants.honor_achievement_awards');

        return response()->json(['success' => true, 'dropdown_list' => $awards]);
    }
}
