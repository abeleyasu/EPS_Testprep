<?php

namespace App\Http\Controllers;

use App\Models\EducationCourse;
use Illuminate\Http\Request;

class ResumeSettingsController extends Controller
{
    public function index()
    {
        $educationCourses = EducationCourse::all();
        return view('admin.high-school-resume.settings', compact('educationCourses'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
