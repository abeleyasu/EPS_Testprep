<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\HighSchoolResume\DemonstratedPositions;


class PositionController extends Controller
{
    public function getPositionsList()
    {
        // $positions = Config::get('constants.demonstrated_positions');
        $positions = DemonstratedPositions::pluck('position_name')->toArray();

        return response()->json(['success' => true, 'dropdown_list' => $positions]);
    }
}
