<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseManagement\UserTaskStatus;

class UserController extends Controller
{
    public function dashboard(){
        return view('user/dashboard');
    }
	public function resume(){
		$userId = auth()->id();
		if($userId){
			
		}
		$userTaskStatus = UserTaskStatus::where('user_id', $userId)->orderBy('updated_at', 'DESC')->first();
		if($userTaskStatus && $userTaskStatus->task_id){
			return redirect('/user/tasks/'.$userTaskStatus->task_id.'/detail');	
		} else {
			return redirect('/user/dashboard');
		}		
    }
	
	public function clearCache()
    {
        \Artisan::call('optimize:clear');
		echo 'Cache Removed';
    }
}
