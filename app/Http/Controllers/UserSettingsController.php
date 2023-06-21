<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller
{
    public function updateUserSettings(Request $request) {
        try {
            $user_setting = UserSettings::where('user_id', Auth::user()->id)->first();
            if ($user_setting) {
                $user_setting->fill($request->all());
                $user_setting->save();
                return response()->json([
                    'success' => true,
                    'message' => 'User settings updated successfully.',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating user settings.',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating user settings.',
            ], 200);
        }
    }
}
