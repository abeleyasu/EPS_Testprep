<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class StatusController extends Controller
{
    public function getStatusList()
    {
        $status = Config::get('constants.status');

        return response()->json(['success' => true, 'dropdown_list' => $status]);
    }
}
