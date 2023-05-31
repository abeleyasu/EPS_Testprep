<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HighSchoolResume\HonorsStatuses;
use Illuminate\Support\Facades\Config;

class StatusController extends Controller
{
    public function getStatusList()
    {
        // $status = Config::get('constants.status');
        $status = HonorsStatuses::pluck('status')->toArray();

        return response()->json(['success' => true, 'dropdown_list' => $status]);
    }
}
