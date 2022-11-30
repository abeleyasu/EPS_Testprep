<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\EducationRequest;
use App\Models\HighSchoolResume\Education;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function index()
    {
        $education  = Education::where('user_id', Auth::id())->where('is_draft',0)->first();
        return view('user.admin-dashboard.high-school-resume.education-info', compact('education'));
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

        $data = array_filter($data);

        if (!empty($data)) {
            $education->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.honors');
        }
    }
}
