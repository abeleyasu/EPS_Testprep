<?php 

namespace App\Service;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;
use Exception;
use App\Models\HighSchoolResume\GraduationDesignation;
use App\Models\IntendedCollegeList;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ResumeService 
{
    public function createGraduationDesignation($graduation_designation) {
        $existingGraduations = GraduationDesignation::whereNull('user_id')->orWhere('user_id' , Auth::id())->get()->pluck('designation')->toArray();
        if (!in_array($graduation_designation, $existingGraduations)) {
            GraduationDesignation::create([
                'designation' => $graduation_designation,
                'user_id' => Auth::id()
            ]);
        }
    }

    public function CreateIntendedCollegeList($intendend_list, $type) {
        $major_array_ids = array();
        $intended_major_ids = IntendedCollegeList::whereNull('user_id')->orWhere('user_id' , Auth::id())->whereType($type)->pluck('id')->toArray();
        foreach ($intendend_list as $major) {
            if (!in_array($major, $intended_major_ids)) {                
                $major_info = IntendedCollegeList::create([
                    'name' => $major,
                    'type' => $type,
                    'user_id' => Auth::id()
                ]);              
                if ($major_info) {
                    array_push($major_array_ids, $major_info->id);
                }  
            } else {
                $major_info = IntendedCollegeList::where('id', '=', $major)->where(function (Builder $query) {
                    $query->whereNull('user_id')->orWhere('user_id', Auth::id());
                })->first();
                if ($major_info) {
                    array_push($major_array_ids, $major_info->id);
                }
            }
        }
        return $major_array_ids;
    }

    public function createGrade($grades) {
        $grade_array_ids = array();
        $grade_ids = Grade::where('user_id', Auth::id())->pluck('id')->toArray();
        foreach ($grades as $grade) {
            if (!in_array($grade, $grade_ids)) {
                $grade_info = Grade::create([
                    'name' => $grade,
                    'user_id' => Auth::id()
                ]);
                array_push($grade_array_ids, $grade_info->id);
            } else {
                $grade_info = Grade::where('id', '=', $grade)->where('user_id', Auth::id())->first();
                if ($grade_info) {
                    array_push($grade_array_ids, $grade_info->id);
                }
            }
        }
        return $grade_array_ids;
    }
}
?>