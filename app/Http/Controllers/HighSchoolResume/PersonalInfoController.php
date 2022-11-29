<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\PersonalInfoRequest;
use App\Models\HighSchoolResume\PersonalInfo;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
    public function index()
    {
        $personal_info = PersonalInfo::latest()->first();
        return view('user.admin-dashboard.high-school-resume.personal-info', compact('personal_info'));
    }

    public function store(PersonalInfoRequest $request)
    {
        $data = $request->validated();

        if (!empty($data)) {
            PersonalInfo::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.educationInfo');
        }
    }

    public function update(PersonalInfoRequest $request, PersonalInfo $personalInfo)
    {
        $data = $request->validated();

        if (!empty($data)) {
            $personalInfo->update($data);
            return redirect()->route('admin-dashboard.highSchoolResume.educationInfo');
        }
    }
}
