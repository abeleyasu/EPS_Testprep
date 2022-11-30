<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\PersonalInfoRequest;
use App\Models\HighSchoolResume\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalInfoController extends Controller
{
    public function index()
    {
        $personal_info = PersonalInfo::where('user_id', Auth::id())->where('is_draft',0)->first();
        return view('user.admin-dashboard.high-school-resume.personal-info', compact('personal_info'));
    }

    public function store(PersonalInfoRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

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
