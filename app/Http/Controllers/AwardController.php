<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\HighSchoolResume\HonorsAchievementAwards;

class AwardController extends Controller
{
    public function getAwardList()
    {
        // $awards = Config::get('constants.honor_achievement_awards');
        $awards = HonorsAchievementAwards::pluck('award')->toArray();

        return response()->json(['success' => true, 'dropdown_list' => $awards]);
    }
}
