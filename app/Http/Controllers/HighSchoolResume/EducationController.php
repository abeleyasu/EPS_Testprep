<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EducationRequest;
use App\Models\EducationCourse;
use App\Models\HighSchoolResume\Education;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $education  = Education::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $courses_list = EducationCourse::all();
        return view('user.admin-dashboard.high-school-resume.education-info', compact('education', 'courses_list'));
    }

    public function store(EducationRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->course_data)){
            $data['course_data'] = $request->course_data;
        }

        if(!empty($request->honor_course_data)){
            $data['honor_course_data'] = $request->honor_course_data;
        }

        if(!empty($request->testing_data)){
            $data['testing_data'] = $request->testing_data;
        }

        if(!empty($request->ib_courses)){
            $data['ib_courses'] = json_encode($request->ib_courses);
        }

        if(!empty($request->ap_courses)){
            $data['ap_courses'] = json_encode($request->ap_courses);
        }

        $data['user_id'] = Auth::id();

        $data = array_filter($data);

        if (!empty($data)) {
            Education::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.honors');
        }
    }

    public function update(EducationRequest $request, Education $education)
    {
        $data = $request->validated();

        if(!empty($request->course_data)){
            $data['course_data'] = $request->course_data;
        }

        if(!empty($request->honor_course_data)){
            $data['honor_course_data'] = $request->honor_course_data;
        }

        if(!empty($request->testing_data)){
            $data['testing_data'] = $request->testing_data;
        }

        if(!empty($request->ib_courses)){
            $data['ib_courses'] = json_encode($request->ib_courses);
        }

        if(!empty($request->ap_courses)){
            $data['ap_courses'] = json_encode($request->ap_courses);
        }

        $data = array_filter($data);

        if (!empty($data)) {
            $education->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.honors');
        }
    }
}
