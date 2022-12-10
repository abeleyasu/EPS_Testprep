<?php

namespace App\Http\Controllers\InitialCollegeList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicStatisticsController extends Controller
{
    public function index()
    {
        return view('user.admin-dashboard.initial-college-list.academic-statistics');
    }
}
