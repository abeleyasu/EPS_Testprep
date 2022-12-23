<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\FeaturedAttributeRequest;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\FeaturedAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeaturedAttributeController extends Controller
{
    public function index(Request $request)
    {
        $resume_id = $request->resume_id;
        if(isset($resume_id) && $resume_id != null) {   
            $resumedata = HighSchoolResume::where('id',$resume_id)->with([
                'personal_info', 
                'education',
                'honor',
                'activity',
                'employmentCertification',
                'featuredAttribute'
            ])->first();
            $personal_info = $resumedata->personal_info; 
            $education = $resumedata->education; 
            $honor = $resumedata->honor; 
            $activity = $resumedata->activity; 
            $employmentCertification = $resumedata->employmentCertification; 
            $featuredAttribute = $resumedata->featuredAttribute;
        } else {
            $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
        }
        $details =0;
        return view('user.admin-dashboard.high-school-resume.features-attributes', compact('featuredAttribute','details','resume_id'));
    }

    public function store(FeaturedAttributeRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->featured_skills_data)){
            $data['featured_skills_data'] = array_values($request->featured_skills_data);
        }

        if(!empty($request->featured_awards_data)){
            $data['featured_awards_data'] = array_values($request->featured_awards_data);
        }

        if(!empty($request->featured_languages_data)){
            $data['featured_languages_data'] = array_values($request->featured_languages_data);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            FeaturedAttribute::create($data);
            return response()->json(["success" => true, "data" => $data]);
        }
    }

    public function update(FeaturedAttributeRequest $request, FeaturedAttribute $featuredAttribute)
    {
        $data = $request->validated();

        if(!empty($request->featured_skills_data)){
            $data['featured_skills_data'] = array_values($request->featured_skills_data);
        }

        if(!empty($request->featured_awards_data)){
            $data['featured_awards_data'] = array_values($request->featured_awards_data);
        }

        if(!empty($request->featured_languages_data)){
            $data['featured_languages_data'] = array_values($request->featured_languages_data);
        }

        if (!empty($data)) {
            $featuredAttribute->update($data);
            return response()->json(["success" => true, "data" => $data]);
        }
    }
}
