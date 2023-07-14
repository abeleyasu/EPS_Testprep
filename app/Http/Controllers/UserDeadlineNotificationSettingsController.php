<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNotificationRequest;
use App\Models\UserDeadlineNotificationSettings;

class UserDeadlineNotificationSettingsController extends Controller
{

    public function index(Request $request) {
        try {
            $notifications = UserDeadlineNotificationSettings::where('user_id', auth()->user()->id)->get();
            $totalPlanCount = count($notifications);
            $data = [];
            foreach ($notifications as $notification) {
                $data[] = [
                    'id' => $notification->id,
                    'frequency' => $notification->frequency,
                    'when' => $notification->when,
                    'action' => '<div class="btn-group">
                                    <button class="btn btn-sm btn-alt-secondary edit-notification" data-id="' . $notification->id . '" data-bs-toggle="tooltip" title="Edit Notification Frequency">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-alt-secondary delete-notifiction" data-id="' . $notification->id . '" data-bs-toggle="tooltip" title="Delete Notification Frequency">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>'
                ];
            }

            $json_data = [
                "draw"            => intval( $request->draw ),   
                "recordsTotal"    => $totalPlanCount,  
                "recordsFiltered" => $totalPlanCount,
                "data"            => $data
            ];
            return response()->json($json_data);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error getting notification settings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function get($id) {
        try {
            $notification = UserDeadlineNotificationSettings::where('id', $id)->first();
            if ($notification) {
                return response()->json([
                    'success' => true,
                    'data' => $notification
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Notification settings not found'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error getting notification settings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create(StoreNotificationRequest $request) {
        try {
            $check_is_values_already_exists = UserDeadlineNotificationSettings::where([
                'user_id' => auth()->user()->id,
                'frequency' => $request->frequency,
                'when' => $request->when
            ])->first();
            if ($check_is_values_already_exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Notification settings already exists'
                ], 200);
            }
            $data = $request->all();
            $data['user_id'] = auth()->user()->id;
            if (isset($request->id)) {
                $update = UserDeadlineNotificationSettings::where('id', $request->id)->update($data);
                if ($update) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Notification settings updated successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error updating notification settings'
                    ], 200);
                }
            } else {
                $create = UserDeadlineNotificationSettings::create($data);
                if ($create) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Notification settings created successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error creating notification settings'
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating notification settings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request) {
        try {
            $delete = UserDeadlineNotificationSettings::where('id', $request->id)->delete();
            if ($delete) {
                return response()->json([
                    'success' => true,
                    'message' => 'Notification settings deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting notification settings'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting notification settings',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
