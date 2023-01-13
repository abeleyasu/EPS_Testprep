<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


class OrganizationController extends Controller
{
    public function getOrganizationList()
    {
        $organizations = Config::get('constants.leadership_organization');

        return response()->json(['success' => true, 'dropdown_list' => $organizations]);
    }
}
