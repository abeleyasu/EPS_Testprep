<?php

namespace App\Helpers;

use App\Models\CollegeInformation;
use App\Models\Grade;

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
        $collegeInfo = CollegeInformation::whereIn('id', $id_array)->pluck('name')->toArray();

        return !empty($collegeInfo) ? implode(',', $collegeInfo) : "-";
    }

    public static function getGradeByIdArray($id_array)
    {
        $grade = Grade::whereIn('id', $id_array)->pluck('name')->toArray();

        return !empty($grade) ? implode(',', $grade) : "-";
    }
}
