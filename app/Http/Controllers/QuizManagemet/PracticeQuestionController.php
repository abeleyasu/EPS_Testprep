<?php

namespace App\Http\Controllers\QuizManagemet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PracticeQuestion;
use App\Models\PracticeTestSection;
use App\Models\Passage;

class PracticeQuestionController extends Controller
{
    public function addPracticeQuestion(Request $request) {
		
		$question = new PracticeQuestion();
		$question->format = $request->format;
		$question->title = $request->question;
		$question->type = $request->question_type;
		$question->passages = $request->passages;
		$question->practice_test_sections_id = $request->section_id;
		$question->passages_id = $request->passages_id;
		$question->passage_number = $request->passage_number;
		$question->answer = $request->answer;
		$question->answer_content = $request->answer_content;
		$question->fill = $request->fill;
		$question->fillType = $request->fillType;
		$question->multiChoice = $request->multiChoice;
		if(is_array($request->tags)){
            $question->tags = implode(",", $request->tags);
        } else{
            $question->tags = $request->tags;
        }
        
		$question->save();
		return $question->id;
	}
	
	public function updatePracticeQuestion(Request $request) {
		$question = PracticeQuestion::find($request->id);
		$question->format = $request->format;
		$question->title = $request->question;
		$question->type = $request->question_type;
		$question->passages = $request->passages;
		$question->practice_test_sections_id = $request->section_id;
		$question->passages_id = $request->passages_id;
		$question->passage_number = $request->passage_number;
		$question->answer = $request->answer; 
		$question->answer_content = $request->answer_content;
		$question->fill = $request->fill;
		$question->fillType = $request->fillType;
		$question->multiChoice = $request->multiChoice;
		if(is_array($request->tags)){
            $question->tags = implode(",", $request->tags);
        } else{
            $question->tags = $request->tags;
        }
		$question->save(); 
		return $question->id;
	}
	
	public function deletePracticeQuestionById(Request $request) {
		PracticeQuestion::where('id', $request->id)->delete();
		return "1";
	}
	public function getPracticePassage(Request $request) {
		$passages = Passage::where('type', $request->format)->get();
		return $passages;
	}
	
	public function getPracticeQuestionById(Request $request) {
		
		$question = PracticeQuestion::where('id', $request->question_id)->get();
		return response()->json($question);

	}
	public function addPracticeTestSection(Request $request) {
		$practiceSection = new PracticeTestSection();
		$practiceSection->format = $request->format;
		$practiceSection->practice_test_type = $request->testSectionType;
		$practiceSection->testid = 0;
		$practiceSection->section_order = $request->order;
		$practiceSection->is_section_completed = '';
		$practiceSection->save();
		return $practiceSection->id;
	}
	public function sectionOrder(Request $request){
		$partSection = PracticeTestSection::find($request->section_id);
		$partSection->section_order = $request->section_order;
		$partSection->save(); 
		return $partSection->id;  
	}
	public function questionOrder(Request $request){
		$question = PracticeQuestion::find($request->question_id);
		$question->question_order = $request->question_order;
		$question->save(); 
		return $question->id;  
	}
}
