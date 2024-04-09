<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\GoogleService;
use App\Models\UserGoogleAccount;
use App\Models\UserCalendersList;
use App\Models\CalendarEvent;
use App\Models\UserCalendar;
use Illuminate\Support\Arr;
use DB;

class GoogleController extends Controller
{
    protected $googleService;
    public function __construct(GoogleService $googleService) {
        $this->googleService = $googleService;
    }
    
    public function google() {
        return redirect($this->googleService->getAuthUrl());
    }

    public function googleCallback(Request $request) {
        if($request->has('code')){
            $client = $this->googleService->client;
            $client->authenticate($request->input('code'));
            $user = $this->googleService->oauth_user();
            $is_existing_user = UserGoogleAccount::where('google_id', $user->id)->first();
            if ($is_existing_user) {
                return redirect(route('user-dashboard'))->with('error_google', 'Google account already connected with another account.');
            }
            $token = $client->getAccessToken();
            $scope = explode(' ', $token['scope']);
            if (($key = array_search('openid', $scope)) == true) {
                unset($scope[$key]);
            }
            $difference = array_diff(config('google-laravel.GOOGLE_SCOPES'), $scope);
            if (count($difference) > 0) {
                $client->revokeToken($token);
                return redirect(route('user-dashboard'))->with('error_google', 'Please check the permissions of google account to access the calendar.');
            }
            $google_user = UserGoogleAccount::create([
                'user_id' => auth()->user()->id,
                'google_id' => $user->id,
                'google_access_token' => $token['access_token'],
                'google_refresh_token' => $token['refresh_token'],
                'google_token_type' => $token['token_type'],
                'google_expires_in' => $token['expires_in'],
                'google_id_token' => $token['id_token'],
                'google_token_created' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $this->googleService->attachRequiredGoogleCalendarService($token);
            return redirect(route('user-dashboard'))->with('success_google', 'Google account connected successfully.');
        } else {
            return redirect(route('user-dashboard'))->with('error_google', 'Google account connection failed.');
        }
    }

    public function disconnect() {
        $this->googleService->disconnect();
        return redirect()->route('user-dashboard')->with('success_google', 'Google account disconnected successfully.');
    }

    public function getCalenders(Request $request) {
        try {
            $calendars = $this->googleService->calendars();

            $total = count($calendars);

            $calendarIds = collect($calendars)->where('summary', '!=', $this->googleService->calender_name)->pluck('id')->toArray();

            if (count($calendars) > 0) {
                $data = [];
                foreach ($calendars as $key => $calendar) {
                    $usercalendar = UserCalendersList::withTrashed()->where('user_id', auth()->user()->id)->where('calender_id', $calendar->id)->first();
                    if ($usercalendar) {
                        $usercalendar->update([
                            'calender_name' => $calendar->summary
                        ]);
                    } else {
                        $usercalendar = UserCalendersList::create([
                            'user_id' => auth()->user()->id,
                            'calender_id' => $calendar->id,
                            'calender_name' => $calendar->summary
                        ]);
                    }
                    if ($usercalendar) {
                        $dData = [
                            'name' => $calendar->summary
                        ];
                        if (!$usercalendar->trashed()) {
                            if ($calendar->summary == $this->googleService->calender_name) {
                                continue;
                            } else {
                                $dData['action'] = '
                                    <button class="btn btn-sm btn-alt-danger delete-specific-college" data-id="'.$calendar->id.'">Hide</button>
                                ';
                            }
                        } else {
                            $dData['action'] = '
                                <button class="btn btn-sm btn-alt-success show-specific-college" data-id="'.$calendar->id.'">Show</button>
                            ';
                        }
                        $data[] = $dData;
                    }
                }
                $deletedCalendars = UserCalendersList::where('user_id', auth()->user()->id)->whereNotIn('calender_id', $calendarIds)->get();
                if (count($deletedCalendars) > 0) {
                    foreach ($deletedCalendars as $key => $deletedCalendar) {
                        $deletedCalendar->forceDelete();
                    }
                }
                $calendars = $data;
            } else {
                $calendars = [];
            }

            $json_data = [
                "draw"            => intval( $request->draw ),   
                "recordsTotal"    => $total,  
                "recordsFiltered" => $total,
                "data"            => $calendars
            ];
            return response()->json($json_data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteCalender(Request $request) {
        DB::beginTransaction();
        try {
            $calender = UserCalendersList::where([
                'user_id' => auth()->user()->id,
                'calender_id' => $request->id
            ])->first();

            if ($calender) {
                $calendar = CalendarEvent::where([
                    'user_id' => auth()->user()->id,
                    'user_calender_id' => $calender->id
                ])->get();
                if (count($calendar) > 0) {
                    foreach ($calendar as $key => $event) {
                        $event->user_calendar()->delete();
                        $event->delete();
                    }
                }
                $calender->delete();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Calender hide successfully.'
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Calender not found.'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function showCalender(Request $request) {
        DB::beginTransaction();
        try {
            $calender = UserCalendersList::withTrashed()->where([
                'user_id' => auth()->user()->id,
                'calender_id' => $request->id
            ])->first();

            if ($calender) {
                $calender->restore();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Calender restored successfully.'
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Calender not found.'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function storeUserCalender(Request $request) {
        try {
            $create = $this->googleService->createCalender($this->googleService->service());
            $this->googleService->createCPSCalendarEventsOnGoogleCalendar();
            if ($create) {
                return redirect()->route('home')->with('success', 'Calender created successfully.');
            } else {
                return redirect()->route('home')->with('error', 'Calender creation failed.');
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }
}
