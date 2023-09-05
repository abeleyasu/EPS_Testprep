<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\GoogleService;
use App\Models\UserGoogleAccount;

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
            $store_token = $this->googleService->setupTokenFirstTime();
            return redirect()->route('home')->with('success', 'Google account connected successfully.');
        } else {
            return redirect()->route('home')->with('error', 'Google account connection failed.');
        }
    }

    public function disconnect() {
        $this->googleService->disconnect();
        return redirect()->route('home')->with('success', 'Google account disconnected successfully.');
    }

    public function getCalenders(Request $request) {
        try {
            $search = isset($request->search) ? $request->search : '';
            $calendars = $this->googleService->calendars();
            if (!empty($search)) { 
                $calendars = $calendars->filter(function ($value, $key) use ($search) {
                    return str_contains(strtolower($value->summary), strtolower($search));
                });
            }

            if (count($calendars) > 0) {
                $data = [];
                foreach ($calendars as $key => $calendar) {
                    $data[] = [
                        'id' => $calendar->id,
                        'text' => $calendar->summary,
                    ];
                }
                $calendars = $data;
            } else {
                $calendars = [];
            }
            return $calendars;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function storeUserCalender(Request $request) {
        try {
            $create = $this->googleService->createCalender($this->googleService->service());
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
