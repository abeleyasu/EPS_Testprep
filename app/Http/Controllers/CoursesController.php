<?php

namespace App\Http\Controllers;
use App\Http\Requests\CoursesRequest;
use Illuminate\Http\Request;
use App\Models\Courses;
use Redirect;


class CoursesController extends Controller
{
    public function index()
    {
        $courses = Courses::orderBy('updated_at')->get();

        return view('admin.courses.index', compact('courses'));
    }
    public function store(Request $request)
    {
        $course = Courses::create([
            'title' => $request->name,
            'description' => $request->description
        ]);
		return redirect('admin/course-management/courses/'.$course->id.'/edit')->with('success', 'Milestone created successfully');
    }
    public function edit($id)
    {
		$course = Courses::findorfail($id);
		return view('admin.courses.edit',
            compact('course'));
	}
    public function courseupdate(Request $request, $id)
    {
		$course = Courses::findorfail($id);
        
        $course->update([
            'title' => $request->name,
            'description' => $request->description
        ]);

        //return redirect()->route('courses.index')->with('success', 'Milestone updated successfully');
        return Redirect::back()->withErrors(['msg' => 'The Message']);
    }
}
