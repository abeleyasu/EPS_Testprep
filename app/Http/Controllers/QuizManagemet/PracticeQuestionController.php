<?php

namespace App\Http\Controllers\QuizManagemet;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PracticeQuestion;
use App\Models\PracticeTestSection;
use App\Models\PracticeCategoryType;
use App\Models\QuestionType;
use App\Models\Passage;

class PracticeQuestionController extends Controller
{
    public function addPracticeQuestion(Request $request) {

		$setQuestionOrder = null;
		$getTestSectionData = DB::table('practice_questions')
		->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
        ->where('practice_test_sections.id', $request->section_id)
		->get();
		
		if(!$getTestSectionData->isEmpty())
		{
			foreach($getTestSectionData as $singleTestSectionData)
			{
				if ($setQuestionOrder === null || $singleTestSectionData->question_order > $setQuestionOrder) {
					$setQuestionOrder = $singleTestSectionData->question_order;
				}
			}
			$setQuestionOrder = $setQuestionOrder + 1;
		}
		else
		{
			$setQuestionOrder = 1;
		}
		
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
		$question->question_order = $setQuestionOrder;
		if(is_array($request->tags)){
            $question->tags = implode(",", $request->tags);
        } else{
            $question->tags = $request->tags;
        }
		$question->question_type_id = json_encode($request->get_question_type_values);
		$question->category_type = json_encode($request->get_category_type_values);
        $question->save();

		return response()->json(['question_id'=>$question->id,'question_order' => $question->question_order]);
	}

	public function indexQuestionType()
	{
		$questionTypes = DB::table('question_types')->get();
		return view('admin.quiz-management.questiontypes.index', compact('questionTypes'));
	}
	public function storeQuestionType(Request $request) {
		$question = new QuestionType();
		$question->question_type_title = $request->question_type_title;
		$question->question_type_description = $request->question_type_description;
		$question->question_type_lesson = $request->question_type_lesson;
		$question->question_type_strategies = $request->question_type_strategies;
		$question->question_type_identification_methods = $request->question_type_identification_methods;
		$question->question_type_identification_activity = $request->question_type_identification_activity;
		$question->save();
		return $question->id;
	}

	public function addQuestionType()
	{
		return view('admin.quiz-management.questiontypes.create');
	}

	public function editQuestionTypes(Request $request)
	{
		$getquestionDetails = DB::table('question_types')->where('question_types.id', $request->id)->get();
		
		return view('admin.quiz-management.questiontypes.edit',['getquestionDetails'=>$getquestionDetails]);
	}
	public function updateQuestionType(Request $request){

		$updatequestion = DB::table('question_types')
		->where('question_types.id', $request->question_type_id)
		->update(['question_type_title' => $request->question_type_title,
		'question_type_description' => $request->question_type_description,
		'question_type_lesson' => $request->question_type_lesson,
		'question_type_strategies' => $request->question_type_strategies,
	    'question_type_identification_methods' => $request->question_type_identification_methods,
	    'question_type_identification_activity' => $request->question_type_identification_activity
		]);
		return $updatequestion;
	}

	public function deleteQuestionType(Request $request)
	{
		DB::delete('delete from question_types where id = ?',[$request->question_type_id]);
		$questionTypes = DB::table('question_types')->get();
		return view('admin.quiz-management.questiontypes.index', compact('questionTypes'));
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
		$question->question_type_id = $request->new_question_type_select;
		$question->category_type = $request->new_question_category_type_value;
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
		$practiceSection->section_title = $request->testSectionTitle;
		$practiceSection->practice_test_type = $request->testSectionType;
		$practiceSection->testid = 0;
		$practiceSection->section_order = $request->order;
		$practiceSection->is_section_completed = '';
		$practiceSection->save();
		return $practiceSection->id;
	}

	public function addPracticeCategoryType(Request $request)
	{
		if(empty($request->searchId))
		{
			$practiceCatType = new PracticeCategoryType();
			$practiceCatType->category_type_title = $request->searchValue;
			$practiceCatType->save();
			return $practiceCatType->id;
		}
	}

	public function addPracticeQuestionType(Request $request)
	{
		if(empty($request->searchId))
		{
			$practiceQuesType = new QuestionType();
			$practiceQuesType->question_type_title = $request->searchValue;
			$practiceQuesType->save();
			return $practiceQuesType->id;
		}
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
