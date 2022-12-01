<?php

namespace App\Http\Controllers\HighSchoolResume;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolResume\Activity;
use App\Models\HighSchoolResume\Education;
use App\Models\HighSchoolResume\EmploymentCertification;
use App\Models\HighSchoolResume\FeaturedAttribute;
use App\Models\HighSchoolResume\Honor;
use App\Models\HighSchoolResume\PersonalInfo;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PreviewController extends Controller
{
    public function index()
    {
        $personal_info = PersonalInfo::where('user_id', Auth::id())->where('is_draft',0)->first();
        $education = Education::where('user_id', Auth::id())->where('is_draft',0)->first();
        $honor = Honor::where('user_id', Auth::id())->where('is_draft',0)->first();
        $activity = Activity::where('user_id', Auth::id())->where('is_draft',0)->first();
        $employmentCertification = EmploymentCertification::where('user_id', Auth::id())->where('is_draft',0)->first();
        $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft',0)->first();
        return view('user.admin-dashboard.high-school-resume.preview', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute"));
    }

    public function resumePreview()
    {
        $pdf = new Dompdf();
        $personal_info = PersonalInfo::where('user_id', Auth::id())->where('is_draft',0)->first();
        $education = Education::where('user_id', Auth::id())->where('is_draft',0)->first();
        $honor = Honor::where('user_id', Auth::id())->where('is_draft',0)->first();
        $activity = Activity::where('user_id', Auth::id())->where('is_draft',0)->first();
        $employmentCertification = EmploymentCertification::where('user_id', Auth::id())->where('is_draft',0)->first();
        $featuredAttribute = FeaturedAttribute::where('user_id', Auth::id())->where('is_draft',0)->first();
        $html = View::make('user.admin-dashboard.high-school-resume.resume_preview', compact("personal_info", "education", "honor", "activity", "employmentCertification", "featuredAttribute"))->render();
        $pdf->loadHTML($html);
        $pdf->render();
        return $pdf->stream();
    }

    public function resumeComplete()
    {
        PersonalInfo::where('user_id', Auth::id())->update([
            "is_draft" => 1
        ]);

        Education::where('user_id', Auth::id())->update([
            "is_draft" => 1
        ]);

        Honor::where('user_id', Auth::id())->update([
            "is_draft" => 1
        ]);

        Activity::where('user_id', Auth::id())->update([
            "is_draft" => 1
        ]);

        EmploymentCertification::where('user_id', Auth::id())->update([
            "is_draft" => 1
        ]);

        FeaturedAttribute::where('user_id', Auth::id())->update([
            "is_draft" => 1
        ]);

        return redirect()->route('admin-dashboard.highSchoolResume.personalInfo');
    }
}
