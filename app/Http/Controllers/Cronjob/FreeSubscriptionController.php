<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class FreeSubscriptionController extends Controller
{
    public function index() {
        try {
            $date = Carbon::now();
            $date = Carbon::parse($date)->setTime(0, 0, 0);
            $date = $date->format('Y-m-d H:i:s');
            $users = User::where('trial_ends_at', '<=', $date)->get();
            $free_role = Role::where('name', config('constants.role_free_name'))->first();
            foreach ($users as $user) {
                Log::chanel('freesubscription')->info('User id: '.$user->id.' email: '.$user->email.' trial_ends_at: '.$user->trial_ends_at);
                $user->trial_ends_at = null;
                if ($user->hasRole($free_role)) {
                    $user->removeRole($free_role);
                }
                $user->save();
            }
        } catch (\Exception $e) {
            Log::chanel('freesubscription')->error($e->getMessage());
        }
    }
}
