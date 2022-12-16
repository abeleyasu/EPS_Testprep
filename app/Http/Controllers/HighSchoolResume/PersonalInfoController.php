<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\PersonalInfoRequest;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use App\Models\HighSchoolResume\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PersonalInfoController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $personal_info = PersonalInfo::whereUserId($user_id)->where('is_draft', 0)->first();
        $education = Education::whereUserId($user_id)->where('is_draft', 0)->first();
        $honor = Honor::whereUserId($user_id)->where('is_draft', 0)->first();
        $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
        $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
        $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();

        $details = 0;

        if (empty($personal_info) && empty($education) && empty($honor) && empty($activity) && empty($employmentCertification) && empty($featuredAttribute)) {
            $details = 1;
        }

        return view('user.admin-dashboard.high-school-resume.personal-info', compact('personal_info', 'education', 'honor', 'activity', 'employmentCertification', 'featuredAttribute', 'details'));
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

    public function discard_drafts()
    {
        $user_id = Auth::id();
        $personal_info = PersonalInfo::whereUserId($user_id)->where('is_draft', 0)->first();
        $education = Education::whereUserId($user_id)->where('is_draft', 0)->first();
        $honor = Honor::whereUserId($user_id)->where('is_draft', 0)->first();
        $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
        $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
        $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();

        if (!empty($personal_info)) {
            PersonalInfo::where('id', $personal_info->id)->delete();
        }
        if (!empty($education)) {
            Education::where('id', $education->id)->delete();
        }
        if (!empty($honor)) {
            Honor::where('id', $honor->id)->delete();
        }
        if (!empty($activity)) {
            Activity::where('id', $activity->id)->delete();
        }
        if (!empty($employmentCertification)) {
            EmploymentCertification::where('id', $employmentCertification->id)->delete();
        }
        if (!empty($featuredAttribute)) {
            FeaturedAttribute::where('id', $featuredAttribute->id)->delete();
        }
        Session::put(['success' => true, "message" => "Resume data has been cleaned now!"]);
        // return redirect()->route('admin-dashboard.highSchoolResume.personalInfo')->with(["success" => true, "message" => "Resume data has been cleaned now!"]);
        return response()->json(['success' => true, "message" => "Resume data has been cleaned now!"]);
    }
}
