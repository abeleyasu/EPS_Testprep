<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestPrepController extends Controller
{

    public function dashboard()
    {
        return view('student.test-prep-dashboard.dashboard');
    }

}
