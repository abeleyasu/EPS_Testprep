<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Models\EducationCourse;
use App\Models\Grade;
use App\Models\HighSchoolResume;
use App\Models\HonorCourseNameList;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use App\Models\HighSchoolResume\PersonalInfo;
use App\Models\IntendedCollegeList;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PreviewController extends Controller
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
            $personal_info = PersonalInfo::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $education = Education::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $honor = Honor::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $activity = Activity::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $employmentCertification = EmploymentCertification::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();        
        }
        $details = 0;

        $social_links = [];

        if(!empty($personal_info->social_links)){
            foreach($personal_info->social_links as $social_link){
                if($social_link['link'] != null){
                    array_push($social_links , ($social_link['link']));
                }
            }
        }

        $testing_data = [];

        if(!empty($education->testing_data)){
            foreach($education->testing_data as $data){
                $filterTest = array_filter($data);
                if($filterTest != null ){
                    array_push($testing_data, $filterTest);
                }
            }
        }

        $demonstrated_data = $this->array_empty($activity->demonstrated_data);
        $leadership_data = $this->array_empty($activity->leadership_data);
        $athletics_data = $this->array_empty($activity->athletics_data);
        $activities_data = $this->array_empty($activity->activities_data);
        $community_service_data = $this->array_empty($activity->community_service_data);

        $significant_data = $this->array_empty($employmentCertification->significant_data);
        $employment_data = $this->array_empty($employmentCertification->employment_data);

        $featured_skills_data = $this->array_empty($featuredAttribute->featured_skills_data);
        $featured_awards_data = $this->array_empty($featuredAttribute->featured_awards_data);
        $featured_languages_data = $this->array_empty($featuredAttribute->featured_languages_data);
        $dual_citizenship_data = $this->array_empty($featuredAttribute->dual_citizenship_data);

        if(empty($demonstrated_data) && empty($leadership_data) && empty($community_service_data) && empty($activities_data) && empty($activities_data))
        {
            $activity = null;
        }

        if(empty($featured_skills_data) && empty($featured_awards_data) && empty($featured_languages_data) && empty($dual_citizenship_data))
        {
            $featuredAttribute = null;
        }
        
        $ib_courses = [];
        $ap_courses = [];

        if(!empty($education->ib_courses)){
            foreach ((json_decode($education->ib_courses)) as $ib) {
                $ib_course = EducationCourse::whereId($ib)->first();
                $ib_courses[] = $ib_course->name;
            }
        }
        
        if(!empty($education->ap_courses)){
            foreach ((json_decode($education->ap_courses)) as $ap) {
                $ap_course = EducationCourse::whereId($ap)->first();
                $ap_courses[] = $ap_course->name;
            }
        }

        $intended_major = [];
        $intended_minor = [];

        if(!empty($education->intended_college_major)){
            foreach ((json_decode($education->intended_college_major)) as $major) {
                $major_data = IntendedCollegeList::whereId($major)->first();
                $intended_major[] = $major_data->name;
            }
        }
        if(!empty($education->intended_college_minor)){
            foreach ((json_decode($education->intended_college_minor)) as $minor) {
                $minor_data = IntendedCollegeList::whereId($minor)->first();
                $intended_minor[] = $minor_data->name;
            }
        }

        $current_grade = [];

        if(!empty($education->current_grade)){
            foreach ((json_decode($education->current_grade)) as $grade) {
                $grade_data = Grade::whereId($grade)->first();
                $current_grade[] = $grade_data->name;
            }
        }

        // Incomplate***
        // For Honors Course name data get from table 

        // if(!empty($education['honor_course_data'])){
        //     foreach($education['honor_course_data'] as $key => $courses_name) {
        //         $honors_course_name = HonorCourseNameList::whereIn('id', $courses_name['course_data'])->pluck('name')->toArray();                
        //     }
        // }
        
        return view('user.admin-dashboard.high-school-resume.preview', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute","details",'ib_courses','ap_courses','resume_id','demonstrated_data','leadership_data','athletics_data','activities_data','community_service_data','significant_data','employment_data','featured_skills_data','featured_awards_data','featured_languages_data', 'dual_citizenship_data','intended_major','intended_minor','current_grade','social_links','testing_data'));
    }

    public function array_empty($mixed) {
        $check_empty_arr = [];
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                if (!empty(array_filter($value))) {
                    $check_empty_arr[$key] = $value;
                }
            }
        }
        return $check_empty_arr;
    }

    public function resumePreview()
    {
        $personal_info = PersonalInfo::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $education = Education::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $honor = Honor::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $activity = Activity::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $employmentCertification = EmploymentCertification::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();

        $demonstrated_data = $this->array_empty($activity->demonstrated_data);
        $leadership_data = $this->array_empty($activity->leadership_data);
        $athletics_data = $this->array_empty($activity->athletics_data);
        $activities_data = $this->array_empty($activity->activities_data);
        $community_service_data = $this->array_empty($activity->community_service_data);

        $significant_data = $this->array_empty($employmentCertification->significant_data);
        $employment_data = $this->array_empty($employmentCertification->employment_data);

        $featured_skills_data = $this->array_empty($featuredAttribute->featured_skills_data);
        $featured_awards_data = $this->array_empty($featuredAttribute->featured_awards_data);
        $featured_languages_data = $this->array_empty($featuredAttribute->featured_languages_data);
        $dual_citizenship_data = $this->array_empty($featuredAttribute->dual_citizenship_data);

        if(empty($demonstrated_data) && empty($leadership_data) && empty($community_service_data) && empty($activities_data) && empty($activities_data))
        {
            $activity = null;
        }

        if(empty($featured_skills_data) && empty($featured_awards_data) && empty($featured_languages_data) && empty($dual_citizenship_data))
        {
            $featuredAttribute = null;
        }

        $social_links = [];

        if(!empty($personal_info->social_links)){
            foreach($personal_info->social_links as $social_link){
                if($social_link['link'] != null){
                    array_push($social_links , ($social_link['link']));
                }
            }
        }

         $testing_data = [];

        if(!empty($education->testing_data)){
            foreach($education->testing_data as $data){
                $filterTest = array_filter($data);
                if($filterTest != null ){
                    array_push($testing_data, $filterTest);
                }
            }
        }
        $intended_major = [];
        $intended_minor = [];

        if(!empty($education->intended_college_major)){
            foreach ((json_decode($education->intended_college_major)) as $major) {
                $major_data = IntendedCollegeList::whereId($major)->first();
                $intended_major[] = $major_data->name;
            }
        }
        if(!empty($education->intended_college_minor)){
            foreach ((json_decode($education->intended_college_minor)) as $minor) {
                $minor_data = IntendedCollegeList::whereId($minor)->first();
                $intended_minor[] = $minor_data->name;
            }
        }

        $current_grade = [];

        if(!empty($education->current_grade)){
            foreach ((json_decode($education->current_grade)) as $grade) {
                $grade_data = Grade::whereId($grade)->first();
                $current_grade[] = $grade_data->name;
            }
        }   

        $ib_courses = [];
        $ap_courses = [];

        if(!empty($education->ib_courses))
        {            
            foreach ((json_decode($education->ib_courses)) as $ib) {
                $ib_course = EducationCourse::whereId($ib)->first();
                $ib_courses[] = $ib_course->name;
            }
        } 
        if(!empty($education->ap_courses)){
            foreach ((json_decode($education->ap_courses)) as $ap) {
                $ap_course = EducationCourse::whereId($ap)->first();
                $ap_courses[] = $ap_course->name;
            }
        }

        $options = new Options(); 
        $options->set('isPhpEnabled', 'true'); 
        $dompdf = new Dompdf($options);
        
        $html = View::make('user.admin-dashboard.high-school-resume.resume_preview', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute","dompdf","ib_courses","ap_courses",'demonstrated_data','leadership_data','athletics_data','activities_data','community_service_data','significant_data','employment_data','featured_skills_data','featured_awards_data','featured_languages_data', 'dual_citizenship_data','intended_major','intended_minor','current_grade','social_links','testing_data'))->render();
        $dompdf->loadHTML($html);
        $dompdf->setPaper('a4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('resume.pdf',array('Attachment' => 0));
    }
    public function resumeComplete()
    {
        $personal_info = PersonalInfo::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $education = Education::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $honor = Honor::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $activity = Activity::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $employmentCertification = EmploymentCertification::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();

        HighSchoolResume::create([
            "user_id" => Auth::id(),
            "personal_info_id" => $personal_info->id,
            "education_id" => $education->id,
            "honor_id" => $honor->id,
            "activity_id" => $activity->id,
            "employment_certification_id" => $employmentCertification->id,
            "featured_attribute_id" => $featuredAttribute->id
        ]);

        $personal_info->update([
            "is_draft" => 1
        ]);

        $education->update([
            "is_draft" => 1
        ]);

        $honor->update([
            "is_draft" => 1
        ]);

        $activity->update([
            "is_draft" => 1
        ]);

        $employmentCertification->update([
            "is_draft" => 1
        ]);

        $featuredAttribute->update([
            "is_draft" => 1
        ]);

        return redirect()->route('admin-dashboard.highSchoolResume.list');
    }
    public function list()
    {
        $highSchoolResume =  HighSchoolResume::with('personal_info')->whereUserId(Auth::id())->get();
        return view('user.admin-dashboard.high-school-resume.resume-list',compact('highSchoolResume'));
    }
    public function resumeDownload($id, $type)
    {
        $highSchoolResume =  HighSchoolResume::find($id);
        $pdf = new Dompdf();
        $personal_info = PersonalInfo::find($highSchoolResume->personal_info_id);
        $education = Education::find($highSchoolResume->education_id);
        $honor = Honor::find($highSchoolResume->honor_id);
        $activity = Activity::find($highSchoolResume->activity_id);
        $employmentCertification = EmploymentCertification::find($highSchoolResume->employment_certification_id);
        $featuredAttribute = FeaturedAttribute::find($highSchoolResume->featured_attribute_id);

        $demonstrated_data = $this->array_empty($activity->demonstrated_data);
        $leadership_data = $this->array_empty($activity->leadership_data);
        $athletics_data = $this->array_empty($activity->athletics_data);
        $activities_data = $this->array_empty($activity->activities_data);
        $community_service_data = $this->array_empty($activity->community_service_data);

        $significant_data = $this->array_empty($employmentCertification->significant_data);
        $employment_data = $this->array_empty($employmentCertification->employment_data);

        $featured_skills_data = $this->array_empty($featuredAttribute->featured_skills_data);
        $featured_awards_data = $this->array_empty($featuredAttribute->featured_awards_data);
        $featured_languages_data = $this->array_empty($featuredAttribute->featured_languages_data);
        $dual_citizenship_data = $this->array_empty($featuredAttribute->dual_citizenship_data);

        if(empty($demonstrated_data) && empty($leadership_data) && empty($community_service_data) && empty($activities_data) && empty($activities_data))
        {
            $activity = null;
        }

        if(empty($featured_skills_data) && empty($featured_awards_data) && empty($featured_languages_data) && empty($dual_citizenship_data))
        {
            $featuredAttribute = null;
        }

        $social_links = [];

        if(!empty($personal_info->social_links)){
            foreach($personal_info->social_links as $social_link){
                if($social_link['link'] != null){
                    array_push($social_links , ($social_link['link']));
                }
            }
        }

        $testing_data = [];

        if(!empty($education->testing_data)){
            foreach($education->testing_data as $data){
                $filterTest = array_filter($data);
                if($filterTest != null ){
                    array_push($testing_data, $filterTest);
                }
            }
        }
        $ib_courses = [];
        $ap_courses = [];

        if(!empty($education->ib_courses)){
            foreach ((json_decode($education->ib_courses)) as $ib) {
                $ib_course = EducationCourse::whereId($ib)->first();
                $ib_courses[] = $ib_course->name;
            }
        }
        if(!empty($education->ap_courses)){
            foreach ((json_decode($education->ap_courses)) as $ap) {
                $ap_course = EducationCourse::whereId($ap)->first();
                $ap_courses[] = $ap_course->name;
            }
        }
        $intended_major = [];
        $intended_minor = [];

        if(!empty($education->intended_college_major)){
            foreach ((json_decode($education->intended_college_major)) as $major) {
                $major_data = IntendedCollegeList::whereId($major)->first();
                $intended_major[] = $major_data->name;
            }
        }
        if(!empty($education->intended_college_minor)){
            foreach ((json_decode($education->intended_college_minor)) as $minor) {
                $minor_data = IntendedCollegeList::whereId($minor)->first();
                $intended_minor[] = $minor_data->name;
            }
        }

        $current_grade = [];

        if(!empty($education->current_grade)){
            foreach ((json_decode($education->current_grade)) as $grade) {
                $grade_data = Grade::whereId($grade)->first();
                $current_grade[] = $grade_data->name;
            }
        }

        $html = View::make('user.admin-dashboard.high-school-resume.resume_preview', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute","ib_courses","ap_courses",'demonstrated_data','leadership_data','athletics_data','activities_data','community_service_data','significant_data','employment_data','featured_skills_data','featured_awards_data','featured_languages_data', 'dual_citizenship_data','intended_major','intended_minor','current_grade','social_links','testing_data'))->render();
        $pdf->loadHTML($html);
        $pdf->render();

        if($type == 'download')
        {
            $pdf->stream('resume_' . $id . '.pdf');
        }else {
            return $pdf->stream('resume_'.$id.'.pdf', array('Attachment' => 0));
        }
        // return $type == 'download' ? $pdf->stream('resume_'.$id.'.pdf') : $pdf->stream('resume_'.$id.'.pdf', array('Attachment' => 0));
    }
    public function destroy($id)
    {
        $highSchoolResume =  HighSchoolResume::find($id);
        PersonalInfo::find($highSchoolResume->personal_info_id)->delete();
        Education::find($highSchoolResume->education_id)->delete();
        Honor::find($highSchoolResume->honor_id)->delete();
        Activity::find($highSchoolResume->activity_id)->delete();
        EmploymentCertification::find($highSchoolResume->employment_certification_id)->delete();
        FeaturedAttribute::find($highSchoolResume->featured_attribute_id)->delete();
        $highSchoolResume->delete();
        return response()->json(['success' => true, 'id' => $id, 'message' => 'Resume Deleted successfully']);
    }
    public function fetchResume($id)
    {
        $highSchoolResume =  HighSchoolResume::find($id);
        $personal_info = PersonalInfo::find($highSchoolResume->personal_info_id);
        $education = Education::find($highSchoolResume->education_id);
        $honor = Honor::find($highSchoolResume->honor_id);
        $activity = Activity::find($highSchoolResume->activity_id);
        $employmentCertification = EmploymentCertification::find($highSchoolResume->employment_certification_id);
        $featuredAttribute = FeaturedAttribute::find($highSchoolResume->featured_attribute_id);

        $demonstrated_data = $this->array_empty($activity->demonstrated_data);
        $leadership_data = $this->array_empty($activity->leadership_data);
        $athletics_data = $this->array_empty($activity->athletics_data  );
        $activities_data = $this->array_empty($activity->activities_data);
        $community_service_data = $this->array_empty($activity->community_service_data);

        $significant_data = $this->array_empty($employmentCertification->significant_data);
        $employment_data = $this->array_empty($employmentCertification->employment_data);

        $featured_skills_data = $this->array_empty($featuredAttribute->featured_skills_data);
        $featured_awards_data = $this->array_empty($featuredAttribute->featured_awards_data);
        $featured_languages_data = $this->array_empty($featuredAttribute->featured_languages_data);
        $dual_citizenship_data = $this->array_empty($featuredAttribute->dual_citizenship_data);
        // dd($leadership_data);

        if(empty($demonstrated_data) && empty($leadership_data) && empty($community_service_data) && empty($activities_data) && empty($activities_data))
        {
            $activity = null;
        }

        if(empty($featured_skills_data) && empty($featured_awards_data) && empty($featured_languages_data) && empty($dual_citizenship_data))
        {
            $featuredAttribute = null;
        }
        
        $social_links = [];

        if(!empty($personal_info->social_links)){
            foreach($personal_info->social_links as $social_link){
                if($social_link['link'] != null){
                    array_push($social_links , ($social_link['link']));
                }
            }
        }

        $ib_courses = [];
        $ap_courses = [];
        if(!empty($education->ib_courses)){
            foreach ((json_decode($education->ib_courses)) as $ib) {
                $ib_course = EducationCourse::whereId($ib)->first();
                $ib_courses[] = $ib_course->name;
            }
        }
        if(!empty($education->ap_courses)){
            foreach ((json_decode($education->ap_courses)) as $ap) {
                $ap_course = EducationCourse::whereId($ap)->first();
                $ap_courses[] = $ap_course->name;
            }
        }

        $intended_major = [];
        $intended_minor = [];

        if(!empty($education->intended_college_major)){
            foreach ((json_decode($education->intended_college_major)) as $major) {
                $major_data = IntendedCollegeList::whereId($major)->first();
                $intended_major[] = $major_data->name;
            }
        }
        if(!empty($education->intended_college_minor)){
            foreach ((json_decode($education->intended_college_minor)) as $minor) {
                $minor_data = IntendedCollegeList::whereId($minor)->first();
                $intended_minor[] = $minor_data->name;
            }
        }

        $current_grade = [];
        if(!empty($education->current_grade)){
            foreach ((json_decode($education->current_grade)) as $grade) {
                $grade_data = Grade::whereId($grade)->first();
                $current_grade[] = $grade_data->name;
            }
        }

        $testing_data = [];

        if(!empty($education->testing_data)){
            foreach($education->testing_data as $data){
                $filterTest = array_filter($data);
                if($filterTest != null ){
                    array_push($testing_data, $filterTest);
                }
            }
        }
        $html = View::make('user.admin-dashboard.high-school-resume.resume-preview-modal', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute","ib_courses","ap_courses",'demonstrated_data','leadership_data','athletics_data','activities_data','community_service_data','significant_data','employment_data','featured_skills_data','featured_awards_data','featured_languages_data','intended_major','intended_minor','current_grade','social_links','testing_data'))->render();
        
        return response()->json(["success" => true, "html" => $html]);
    }
}
