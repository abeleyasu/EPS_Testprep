<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Models\EducationCourse;
use App\Models\HighSchoolResume;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use App\Models\HighSchoolResume\PersonalInfo;
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
        // dd($resume_id);
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
            $personal_info = PersonalInfo::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $education = Education::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $honor = Honor::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $activity = Activity::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $employmentCertification = EmploymentCertification::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
            $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft', 0)->latest()->first();
                       
        }
        $details = 0;

        $ib_courses = [];
        $ap_courses = [];

        foreach ((json_decode($education->ib_courses)) as $ib) {
            array_push($ib_courses, EducationCourse::whereId($ib)->first());
        }
        foreach ((json_decode($education->ap_courses)) as $ib) {
            array_push($ap_courses, EducationCourse::whereId($ib)->first());
        }
        return view('user.admin-dashboard.high-school-resume.preview', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute","details",'ib_courses','ap_courses','resume_id'));
    }

    public function resumePreview()
    {
        $personal_info = PersonalInfo::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $education = Education::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $honor = Honor::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $activity = Activity::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $employmentCertification = EmploymentCertification::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();
        $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft',0)->latest()->first();

        $ib_courses = [];
        $ap_courses = [];

        foreach ((json_decode($education->ib_courses)) as $ib) {
            array_push($ib_courses, EducationCourse::whereId($ib)->first());
        }
        foreach((json_decode($education->ap_courses)) as $ib){
            array_push($ap_courses, EducationCourse::whereId($ib)->first());
        }

        $options = new Options(); 
        $options->set('isPhpEnabled', 'true'); 
        $dompdf = new Dompdf($options);
        
        $html = View::make('user.admin-dashboard.high-school-resume.resume_preview', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute","dompdf",'ib_courses','ap_courses'))->render();
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
        $highSchoolResume =  HighSchoolResume::with('personal_info')->get();

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
        $ib_courses = [];
        $ap_courses = [];

        foreach ((json_decode($education->ib_courses)) as $ib) {
            array_push($ib_courses, EducationCourse::whereId($ib)->first());
        }
        foreach((json_decode($education->ap_courses)) as $ib){
            array_push($ap_courses, EducationCourse::whereId($ib)->first());
        }

        $html = View::make('user.admin-dashboard.high-school-resume.resume_preview', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute",'ib_courses','ap_courses'))->render();
        $pdf->loadHTML($html);
        $pdf->render();
        return $type == 'download' ? $pdf->stream('resume_'.$id.'.pdf') : $pdf->stream('resume_'.$id.'.pdf', array('Attachment' => 0));
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

        $ib_courses = [];
        $ap_courses = [];

        foreach ((json_decode($education->ib_courses)) as $ib) {
            array_push($ib_courses, EducationCourse::whereId($ib)->first());
        }
        foreach((json_decode($education->ap_courses)) as $ib){
            array_push($ap_courses, EducationCourse::whereId($ib)->first());
        }
        $html = View::make('user.admin-dashboard.high-school-resume.resume-preview-modal', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute","ib_courses","ap_courses"))->render();
        
        return response()->json(["success" => true, "html" => $html]);
    }
}
