<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HighSchoolResume\States;
use App\Models\HighSchoolResume\Cities;

class StateCityController extends Controller
{
    public function states(Request $request) {
        $page = isset($request->page) ? $request->page : 1;
        $search = isset($request->search) ? $request->search : null;
        $limit = $page * 25;
        $states = States::select('id', 'state_name as text');
        if (!empty($search)) {
            $states = $states->where(function ($state) use ($search) {
                return $state->where('state_name', 'LIKE', "%{$search}%");
            });
        }
        $states = $states->paginate($limit);
        $states = $states->toArray();
        return response()->json([
            'data' => $states['data'],
            'total' => $states['total']
        ]);
    }

    public function city(Request $request, $id) {
        return Cities::select('id', 'city_name as text')->where('state_id', $id)->get();
        // $page = isset($request->page) ? $request->page : 1;
        // $search = isset($request->search) ? $request->search : null;
        // $limit = $page * 25;
        // $cities = Cities::select('id', 'city_name as text')->where('state_id', $id);
        // if (!empty($search)) {
        //     $cities = $cities->where(function ($cities) use ($search) {
        //         return $cities->where('city_name', 'LIKE', "%{$search}%");
        //     });
        // }
        // $cities = $cities->paginate($limit);
        // $cities = $cities->toArray();
        // return response()->json([
        //     'data' => $cities['data'],
        //     'total' => $cities['total']
        // ]);
    }
}
