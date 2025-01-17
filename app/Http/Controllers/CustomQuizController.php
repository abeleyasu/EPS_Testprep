<?php

namespace App\Http\Controllers;

use App\Models\PracticeTest;
use App\Models\User;
use Illuminate\Http\Request;

class CustomQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customQuizzes = User::selectRaw("users.id as user_id,users.name as name,practice_tests.id as practice_test_id")
            ->join("practice_tests", "users.id", "=", "practice_tests.user_id")
            ->get()
            ->toArray();

        $temp = array_unique(array_column($customQuizzes, 'user_id'));
        $customQuizzes = array_intersect_key($customQuizzes, $temp);
        return view("admin.custom-quizzes.index", compact('customQuizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customQuizzes = User::selectRaw("
        users.id as user_id,
        users.name as name,
        practice_tests.id as practice_test_id,
        practice_tests.title as title,
        practice_tests.format as format,
        practice_tests.created_at as created_at
        ")
            ->join("practice_tests", "users.id", "=", "practice_tests.user_id")
            ->where("practice_tests.user_id", $id)
            ->get()
            ->toArray();
        // dd($customQuizzes);
        return view("admin.custom-quizzes.show", compact('customQuizzes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
