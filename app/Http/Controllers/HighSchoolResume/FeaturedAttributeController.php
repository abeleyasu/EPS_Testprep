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

        if(!empty($request->dual_citizenship_data)){
            $data['dual_citizenship_data'] = array_values($request->dual_citizenship_data);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {
            FeaturedAttribute::create($data);
            return redirect()->route('admin-dashboard.highSchoolResume.preview');
        }
    }

    public function update(FeaturedAttributeRequest $request, FeaturedAttribute $featuredAttribute)
    {
        $data = $request->validated();
        $resume_id = isset($request->resume_id) ? $request->resume_id : null;

        if(!empty($request->featured_skills_data)){
            $data['featured_skills_data'] = array_values($request->featured_skills_data);
        }

        if(!empty($request->featured_awards_data)){
            $data['featured_awards_data'] = array_values($request->featured_awards_data);
        }

        if(!empty($request->featured_languages_data)){
            $data['featured_languages_data'] = array_values($request->featured_languages_data);
        }

        if(!empty($request->dual_citizenship_data)){
            $data['dual_citizenship_data'] = array_values($request->dual_citizenship_data);
        }

        if (!empty($data)) {
            $featuredAttribute->update($data);

            //SBZ starts here
            //old logic starts
            // if($resume_id != null)
            // {
            //     return redirect("user/admin-dashboard/high-school-resume/preview?resume_id=".$resume_id);
            // }else{
            //     return redirect()->route('admin-dashboard.highSchoolResume.preview');
            // }
            //old logic ends

            // new logic starts
            $redirect_link = $request->redirect_link;
            // echo "redirect_link = $redirect_link";
            // exit;
            if(!empty($redirect_link)){
                if (strpos($redirect_link, 'personal') !== false) {
                    if ($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/personal-info?resume_id=" . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.personalInfo');
                    }
                }
                else if (strpos($redirect_link, 'education') !== false) {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/education-info?resume_id=".$resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.educationInfo');
                    }
                }
                else if (strpos($redirect_link, 'honors') !== false) {
                    if ($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/honors?resume_id=" . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.honors');
                    }
                }
                else if (strpos($redirect_link, 'activities') !== false) {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/activities?resume_id=".$resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.activities');
                    }
                }
                else if (strpos($redirect_link, 'employment') !== false) {
                    if ($resume_id != null) {
                        return redirect('user/admin-dashboard/high-school-resume/employment-certifications?resume_id=' . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.employmentCertification');
                    }
                }
                else if (strpos($redirect_link, 'preview') !== false) {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/preview?resume_id=".$resume_id);
                    } else{
                        return redirect()->route('admin-dashboard.highSchoolResume.preview');
                    }
                }
                else {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/preview?resume_id=".$resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.preview');
                    }
                }
            }
            else {
                if($resume_id != null) {
                    return redirect("user/admin-dashboard/high-school-resume/preview?resume_id=".$resume_id);
                } else {
                    return redirect()->route('admin-dashboard.highSchoolResume.preview');
                }
            }
            // new logic ends
            //SBZ ends here
        }
    }
}
