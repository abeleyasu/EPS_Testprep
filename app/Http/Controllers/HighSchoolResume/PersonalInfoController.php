<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Http\Requests\HighSchoolResume\PersonalInfoRequest;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use App\Models\HighSchoolResume\PersonalInfo;
use App\Models\HighSchoolResume\States;
use App\Models\HighSchoolResume\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class PersonalInfoController extends Controller
{
    public function index(Request $request)
    {
        //$states = Config::get('constants.states');
        //$cities = Config::get('constants.cities');
		$states = States::select('id','state_name')->orderBY('state_name', 'asc')->get();
		$cities = array();
		//$data = compact('states');
        //return response()->json($data);
		
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

            if(isset($personal_info->state) && !empty($personal_info->state)){
                $cities = Cities::from('cities as ct')
						->join('states as st', function ($join) use($personal_info){
									$join->on('ct.state_id', '=', 'st.id')
										 ->where('st.state_name', '=',$personal_info->state);
						})
						->select('ct.id', 'ct.city_name')
						->get();
            }
        } else {
            $user_id = Auth::id();
            $personal_info = PersonalInfo::whereUserId($user_id)->where('is_draft', 0)->first();
			
			if (!empty($personal_info))
			{
				$cities = Cities::from('cities as ct')
						->join('states as st', function ($join) use($personal_info){
									$join->on('ct.state_id', '=', 'st.id')
										 ->where('st.state_name', '=',$personal_info->state)
										 ->where('ct.city_name', '=',$personal_info->city);
						})
						->select('ct.id', 'ct.city_name')
						->get();
			}
			
            $education = Education::whereUserId($user_id)->where('is_draft', 0)->first();
            $honor = Honor::whereUserId($user_id)->where('is_draft', 0)->first();
            $activity = Activity::whereUserId($user_id)->where('is_draft', 0)->first();
            $employmentCertification = EmploymentCertification::whereUserId($user_id)->where('is_draft', 0)->first();
            $featuredAttribute = FeaturedAttribute::whereUserId($user_id)->where('is_draft', 0)->first();
        }

        $validations_rules = Config::get('validation.personal_info.rules');
        $validations_messages = Config::get('validation.personal_info.messages');

        $details = 0;

        if (empty($personal_info) && empty($education) && empty($honor) && empty($activity) && empty($employmentCertification) && empty($featuredAttribute)) {
            $details = 1;
        }

        return view('user.admin-dashboard.high-school-resume.personal-info', compact('personal_info', 'education', 'honor', 'activity', 'employmentCertification', 'featuredAttribute', 'details', 'resume_id', 'validations_rules', 'validations_messages','states','cities'));
    }

    public function store(PersonalInfoRequest $request)
    {
        $data = $request->validated();

        if(!empty($request->social_links)){
            $data['social_links'] = array_values($request->social_links);
        }

        $data['user_id'] = Auth::id();

        if (!empty($data)) {

			// Retrieve the city and state names based on their IDs
			$city = Cities::findOrFail($data['city']);
			$state = States::findOrFail($data['state']);

			// Update the city and state properties in the $data array with their respective names
			$data['city'] = $city->city_name;
			$data['state'] = $state->state_name;
			
            PersonalInfo::create($data);
			
            return redirect()->route('admin-dashboard.highSchoolResume.educationInfo');
        }
    }

    public function update(PersonalInfoRequest $request, PersonalInfo $personalInfo)
    {
        $data = $request->validated();
        $resume_id = isset($request->resume_id) ? $request->resume_id : null;

        if(!empty($request->social_links)){
            $data['social_links'] = array_values($request->social_links);
        }

        if (!empty($data)) {
			// Retrieve the city and state names based on their IDs
			$city = Cities::findOrFail($data['city']);
			$state = States::findOrFail($data['state']);

			// Update the city and state properties in the $data array with their respective names
			$data['city'] = $city->city_name;
			$data['state'] = $state->state_name;
			
            $personalInfo->update($data);

            //SBZ starts here
            //old logic starts
            // if($resume_id != null) {
            //     return redirect("user/admin-dashboard/high-school-resume/education-info?resume_id=".$resume_id);
            // } else {
            //     return redirect()->route('admin-dashboard.highSchoolResume.educationInfo');
            // }
            // old logic ends

            // new logic starts
            $redirect_link = $request->redirect_link;
            // echo "redirect_link = $redirect_link";
            // exit;
            if(!empty($redirect_link)){
                if (strpos($redirect_link, 'education') !== false) {
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
                    if($resume_id != null)
                    {
                        return redirect("user/admin-dashboard/high-school-resume/activities?resume_id=".$resume_id);
                    }else{
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
                else if (strpos($redirect_link, 'features') !== false) {
                    if ($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/features-attributes?resume_id=" . $resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.featuresAttributes');
                    }
                } 
                else if (strpos($redirect_link, 'preview') !== false) {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/preview?resume_id=".$resume_id);
                    } else{
                        return redirect()->route('admin-dashboard.highSchoolResume.preview');
                    }
                } else {
                    if($resume_id != null) {
                        return redirect("user/admin-dashboard/high-school-resume/education-info?resume_id=".$resume_id);
                    } else {
                        return redirect()->route('admin-dashboard.highSchoolResume.educationInfo');
                    }
                }
            } else {
                if($resume_id != null) {
                    return redirect("user/admin-dashboard/high-school-resume/education-info?resume_id=".$resume_id);
                } else {
                    return redirect()->route('admin-dashboard.highSchoolResume.educationInfo');
                }
            }
            // new logic starts

            //SBZ ends here
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
        return response()->json(['success' => true, "message" => "Resume data has been cleaned now!"]);
    }
    public function editFetch(Request $request ,$id)
    {
        return redirect('user/admin-dashboard/high-school-resume/personal-info?resume_id='.$id);
    }
	
	public function getCity($state_id)
    {
	
        $data['cities'] = Cities::where("state_id",$state_id)
                    ->get(["city_name","id"]);
				//$data['cities'] = ['city_name' => 'anc','id' => 1];
				
        return response()->json($data);
    } 
}
