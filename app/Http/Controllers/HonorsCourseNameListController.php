<?php

namespace App\Http\Controllers;

use App\Models\HonorCourseNameList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HonorsCourseNameListController extends Controller
{
    public function getCourseNameList()
    {
        $user = Auth::user();

        if($user->role == 1) {   
            $CourseList = HonorCourseNameList::all();
        } else {
            $CourseList = HonorCourseNameList::whereNull('user_id')->orWhere('user_id' , Auth::id())->get();
        }

        return response()->json(['success' => true, 'dropdown_list' => $CourseList]);
    }
}
