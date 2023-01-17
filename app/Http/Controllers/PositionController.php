<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


class PositionController extends Controller
{
    public function getPositionsList()
    {
        $positions = Config::get('constants.demonstrated_positions');

        return response()->json(['success' => true, 'dropdown_list' => $positions]);
    }
}
