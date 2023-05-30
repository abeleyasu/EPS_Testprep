<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\HighSchoolResume\LeadershipOrganization;

class OrganizationController extends Controller
{
    public function getOrganizationList()
    {
        // $organizations = Config::get('constants.leadership_organization');
        $organizations = LeadershipOrganization::pluck('name')->toArray();

        return response()->json(['success' => true, 'dropdown_list' => $organizations]);
    }
}
