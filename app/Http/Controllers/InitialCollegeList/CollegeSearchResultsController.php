<?php

namespace App\Http\Controllers\InitialCollegeList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollegeSearchResultsController extends Controller
{
    public function index()
    {
        return view('user.admin-dashboard.initial-college-list.college-search-results');
    }
}
