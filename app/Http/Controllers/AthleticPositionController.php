<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


class AthleticPositionController extends Controller
{
    public function getAthleticPositionsList()
    {
        $positions = Config::get('constants.athletics_position');

        return response()->json(['success' => true, 'dropdown_list' => $positions]);
    } 
}
