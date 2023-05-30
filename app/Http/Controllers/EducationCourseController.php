<?php

namespace App\Http\Controllers;

use App\Models\EducationCourse;
use Illuminate\Http\Request;

class EducationCourseController extends Controller
{
    public function store(Request $request)
    {
        $course_name = $request->course_name;
        $course_type = $request->course_type;

        $educationCourse = EducationCourse::create([
            "name" => $course_name, 
            "course_type" => $course_type
        ]);

        return response()->json(['success' => true, 'message' => "Course added successfully", 'education_course' => $educationCourse]);
    }

    public function fetchAllCourse(Request $request)
    {
        $all_courses = EducationCourse::all();

        return response()->json(['success' => true, 'education_courses' => $all_courses]);
    }

    public function edit(EducationCourse $educationCourse)
    {
        return response()->json(['success' => true, 'educationCourse' => $educationCourse]);
    }

    public function update(Request $request, EducationCourse $educationCourse)
    {
        
        $course_name = $request->course_name;
        $course_type = $request->course_type;
        
        $educationCourse->update([
            "name" => $course_name, 
            "course_type" => $course_type
        ]);
        
        return response()->json(['success' => true, 'message' => "Course updated successfully", 'education_course' => $educationCourse]);
    }

    public function destroy($id)
    {
        EducationCourse::whereId($id)->delete();

        return response()->json(['success' => true, 'message' => "Course deleted successfully", 'id' => $id]);
    }
}
