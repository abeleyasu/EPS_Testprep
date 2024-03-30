<?php

namespace App\Helpers;

use App\Models\CollegeInformation;
use App\Models\DiffRating;
use App\Models\Grade;
use App\Models\HonorCourseNameList;
use App\Models\Passage;
use App\Models\PracticeCategoryType;
use App\Models\PracticeQuestion;
use App\Models\QuestionTag;
use App\Models\QuestionType;
use App\Models\SuperCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Helper
{
    public static function objectToArray ($object)
    {
        return @json_decode(json_encode($object), true);
    }

    public static function convertMultidimensionalToString($array, $keyword, $comaSeparate)
    {
        $main_array = [];
        foreach($array as $a){
            $main_array[] = $a[$keyword];
        }
        return implode($comaSeparate, $main_array);
    }

    public static function getCollegeNameByIdArray($id_array)
    {
        // $collegeInfo = CollegeInformation::whereIn('id', $id_array)->pluck('name')->toArray();

        // return !empty($collegeInfo) ? implode(',', $collegeInfo) : "-";

        /* -----------------------------------------------------------------------------------------
           For get single college name by passing id , which is passed as a parameter of function
        ------------------------------------------------------------------------------------------ */

        $collegeInfo = CollegeInformation::where('id', $id_array)->first();

        return $collegeInfo['name'];
    }

    public static function getGradeByIdArray($id_array)
    {
        $grade = Grade::whereIn('id', $id_array)->pluck('name')->toArray();

        return !empty($grade) ? implode(',', $grade) : "-";
    }

    public static function getGradeAllByIdArray($id_array)
    {
        $grade = [];
        foreach ($id_array as $a) {
            $grade = Grade::whereIn('id', $a)->pluck('name')->toArray();
        }

        return !empty($grade) ? implode(',', $grade) : "-";
    }

    public static function getHonorCourseByIdArray($id_array)
    {
        $honor_course_array = HonorCourseNameList::whereIn('id', $id_array)->pluck('name')->toArray();

        return !empty($honor_course_array) ? implode(',', $honor_course_array) : "-";
    }

    public static function getCategoryNameByID($id)
    {
        $category_info = DB::table('practice_category_types')->where('id',$id)->first();
        // return [isset($category_info->category_type_title) ? $category_info->category_type_title : '-' , isset($category_info->category_type_description) ? $category_info->category_type_description : '-'] ;
        return $category_info;
    }

    public static function getQuestionNameByID($id)
    {
        $question_types = DB::table('question_types')->where('id',$id)->first();
        // return isset($question_types->question_type_title) ? $question_types->question_type_title : '-';
        return $question_types;
    }

    public static function getPassageById($id)
    {
        $passage = Passage::find($id);

        if(!empty($passage)) {
            return $passage->title;
        } else {
            return '';
        }
    }

    public function stringExactMatch($correctString, $string)
    {
        if(Str::contains($string, ",")) {
            $string = explode(",",$string);
            foreach($string as $str) {
                if(in_array($str,explode(",",$correctString))) {
                    $status = true;
                } else {
                    $status = false;
                }
            }
        } else {
            if(in_array($string,explode(",",$correctString))) {
                $status = true;
            } else {
                $status = false;
            }
        }
        return $status;
    }

    public function getAllDifficultyRating(){
        $ratings = DiffRating::all();
        $questions = [];
        foreach($ratings as $rating){
            $questions[$rating->id] = PracticeQuestion::where('diff_rating',$rating->id)->where('test_source','2')->count();
        }

        return ['ratings' => $ratings, 'questions' => $questions];
    }

    public function getAllQuestionTags(){
        $tags = QuestionTag::all();

        return $tags;
    }

    public function getSelfMadeCategory(){
        $category = PracticeCategoryType::where('selfMade',1)->get();

        return $category;
    }

    public function getSelfMadeQuestionType(){
        $questionType = QuestionType::where('selfMade',1)->get();

        return $questionType;
    }

    public function getSelfMadeTags(){
        $tags = QuestionTag::where('selfMade',1)->get();

        return $tags;
    }

    public function getSuperCategory($format){
        $super_categories = SuperCategory::where('format',$format)->get();

        return $super_categories;
    }

    public function getCategory($format){
        $categories = PracticeCategoryType::where('format',$format)->get();

        return $categories;
    }

    public function getQuestionType($format){
        $questionTypes = QuestionType::where('format',$format)->get();

        return $questionTypes;
    }

    public static function TimeChangeInMinutes($timeString){
        [$hours,$minutes] = explode(':', $timeString);
        return ($hours * 60) + $minutes;
    }

    public static function isPrivateCollege ($collegeInformation) {
        // return $collegeInformation['ownership'] != 1;
        return (isset($collegeInformation['TUIT_OVERALL_FT_D']) && $collegeInformation['TUIT_OVERALL_FT_D'] > 0) || $collegeInformation['ownership'] != 1;
    }

    public static function isInStateCollege ($collegeInformation, $stateCode) {
        return $collegeInformation['state'] === $stateCode;
    }

    public static function isInPublicStateCollege ($collegeInformation, $stateCode) {
        return !self::isPrivateCollege($collegeInformation) && self::isInStateCollege($collegeInformation, $stateCode);
    }

}
