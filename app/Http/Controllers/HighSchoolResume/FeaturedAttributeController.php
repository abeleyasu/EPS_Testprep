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
        if(isset($resume_id)) {   
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
            $data['featured_skills_data'] = $request->featured_skills_data;
        }

        if(!empty($request->featured_awards_data)){
            $data['featured_awards_data'] = $request->featured_awards_data;
        }

        if(!empty($request->featured_languages_data)){
            $data['featured_languages_data'] = $request->featured_languages_data;
        }

        $data['user_id'] = Auth::id();

        $data = array_filter($data);

        if (!empty($data)) {
            FeaturedAttribute::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.preview');
        }
    }

    public function update(FeaturedAttributeRequest $request, FeaturedAttribute $featuredAttribute)
    {
                $resume_id = isset($request->resume_id) ? $request->resume_id : null;
        $data = $request->validated();

        if(!empty($request->featured_skills_data)){
            $data['featured_skills_data'] = $request->featured_skills_data;
        }

        if(!empty($request->featured_awards_data)){
            $data['featured_awards_data'] = $request->featured_awards_data;
        }

        if(!empty($request->featured_languages_data)){
            $data['featured_languages_data'] = $request->featured_languages_data;
        }

        $data = array_filter($data);

        if($data['featured_skills_data'] == "[]"){
            $data['featured_skills_data'] = null;
        } 
        
        if($data['featured_awards_data'] == "[]"){
            $data['featured_awards_data'] = null;
        } 

        if($data['featured_languages_data'] == "[]"){
            $data['featured_languages_data'] = null;
        } 
        if (!empty($data)) {
            $featuredAttribute->update($data);
             if ($resume_id != null) {
                return redirect('user/admin-dashboard/high-school-resume/preview?resume_id='.$resume_id);
            } else {
                return redirect()->route('admin-dashboard.highSchoolResume.preview');
            }
        }
    }
}
