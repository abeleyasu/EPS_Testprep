<?php

namespace App\Http\Controllers\QuizManagemet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PracticeQuestion;

class PracticeQuestionController extends Controller
{
    public function addPracticeQuestion(Request $request) {
		$question = new PracticeQuestion();
		$question->format = $request->format;
		$question->testid = $request->practicetestid;
		$question->description = $request->description;
		$question->save();
		return "1";
	}
	
	public function updatePracticeQuestion(Request $request) {
		$question = PracticeQuestion::find($request->id);
		$question->format = $request->format;
		$question->testid = $request->practicetestid;
		$question->description = $request->description;
		$question->save();
		return "1";
	}
	
	public function deletePracticeQuestionById(Request $request) {
		PracticeQuestion::where('id', $request->id)->delete();
		return "1";
	}
	
	public function getPracticeQuestionById(Request $request) {
		$question = PracticeQuestion::find($request->id);
		return $question;
	}
}
