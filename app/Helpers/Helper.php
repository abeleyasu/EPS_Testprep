<?php

namespace App\Helpers;

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
}
