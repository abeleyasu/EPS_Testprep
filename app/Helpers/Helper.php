<?php

namespace App\Helpers;

use App\Models\CollegeInformation;
use App\Models\Grade;
use App\Models\HonorCourseNameList;
use Illuminate\Support\Facades\DB;

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
}
