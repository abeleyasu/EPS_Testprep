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
use Illuminate\Support\Arr;

class PracticeQuestionController extends Controller
{
    public function addPracticeQuestion(Request $request) {
		$setQuestionOrder = null;
		$getTestSectionData = DB::table('practice_questions')
		->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
        ->where('practice_test_sections.id', $request->section_id)
		->get();

		$cat_array = [];
		$qt_array = [];
		
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
		if(isset($request->tags)){
			$tags = Arr::flatten(json_decode($request->tags, true));
			$question->tags = implode(",", $tags);
        } else{
			$question->tags = $request->tags;
        }
		$cat_array = $request->get_category_type_values;
		foreach ($cat_array as $key => $value) {
			$practice_category_id = PracticeCategoryType::where('category_type_title',$value)->orWhere('id',$value)->first();
			$cat_array[$key] = $practice_category_id->id;
		}
		
		$qt_array = $request->get_question_type_values;
		foreach ($qt_array as $key => $value) {
			$practice_question_id = QuestionType::where('question_type_title',$value)->orWhere('id', $value)->first();
			$qt_array[$key] = $practice_question_id->id;
		}
		$question->category_type = json_encode($cat_array);
		$question->question_type_id = json_encode($qt_array);
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
		if(isset($request->tags)){
			$tags = Arr::flatten(json_decode($request->tags, true));
			$question->tags = implode(",", $tags);
        } else{
			$question->tags = $request->tags;
        }

		$cat_array = $request->get_category_type_values;
		foreach ($cat_array as $key => $value) {
			$practice_category_id = PracticeCategoryType::where('category_type_title',$value)->orWhere('id',$value)->first();
			$cat_array[$key] = $practice_category_id->id;
		}
		
		$qt_array = $request->get_question_type_values;
		foreach ($qt_array as $key => $value) {
			$practice_question_id = QuestionType::where('question_type_title',$value)->orWhere('id', $value)->first();
			$qt_array[$key] = $practice_question_id->id;
		}
		
		$question->category_type = json_encode($cat_array);
		$question->question_type_id = json_encode($qt_array);

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

	public function getSectionQuestions(Request $request)
	{
		$sectionQuestions = $testSectionQuestions = DB::table('practice_questions')
		->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
		->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags' )
		->where('practice_test_sections.id', $request->sectionId)
		->orderBy('question_order', 'asc')
		->get(); 
		return response()->json($sectionQuestions);
	}

	public function addPracticeTestSection(Request $request) {
		$practiceSection = new PracticeTestSection();
		$practiceSection->format = $request->format;
		$practiceSection->section_title = $request->testSectionTitle;
		$practiceSection->practice_test_type = $request->testSectionType;
		$practiceSection->testid = $request->get_test_id;
		$practiceSection->section_order = $request->order;
		$practiceSection->is_section_completed = '';
		$practiceSection->save();
		return $practiceSection->id;
	}

	public function addPracticeCategoryType(Request $request)
	{
		if(!empty($request->searchValue))
		{
			$practiceCatType = PracticeCategoryType::create([
				'category_type_title' => $request->searchValue
			]);
			$id = $practiceCatType->id;
			$title = $practiceCatType->category_type_title;
			return response()->json(["success" => true, 'id' => $id, 'category_type_title' => $title]); 
		}
	}

	public function addPracticeQuestionType(Request $request)
	{
		if(!empty($request->searchValue))
		{
			$practiceQuesType = QuestionType::create([
				'question_type_title' => $request->searchValue
			]);
			$id = $practiceQuesType->id;
			$title = $practiceQuesType->question_type_title;
			return response()->json(["success" => true, 'id' => $id, 'question_type_title' => $title]); 
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

	public function getPracticeCategoryType(){
		$category_type = PracticeCategoryType::get();
		return response()->json(['success' => true, 'dropdown_list' => $category_type, 'type' => 'category_type']);
	}

	public function getPracticeQuestionType(){
		$question_type = QuestionType::get();
		return response()->json(['success' => true, 'dropdown_list' => $question_type, 'type' => 'question_type']);
	}

	//new start
	public function indexCategoryType()
	{
		$categoryTypes = DB::table('practice_category_types')->get();
		return view('admin.quiz-management.categorytypes.index', compact('categoryTypes'));
	}

	public function storeCategoryType(Request $request) {

		$category = new PracticeCategoryType();
		$category->category_type_title = $request->category_type_title;
		$category->category_type_description = $request->category_type_description;
		$category->category_type_lesson = $request->category_type_lesson;
		$category->category_type_strategies = $request->category_type_strategies;
		$category->category_type_identification_methods = $request->category_type_identification_methods;
		$category->category_type_identification_activity = $request->category_type_identification_activity;
		$category->save();
		return $category->id;
	}

	public function addCategoryType()
	{
		return view('admin.quiz-management.categorytypes.create');
	}

	public function editCategoryTypes(Request $request)
	{
		$getcategoryDetails = DB::table('practice_category_types')->where('practice_category_types.id', $request->id)->get();
		
		return view('admin.quiz-management.categorytypes.edit',['getcategoryDetails'=>$getcategoryDetails]);
	}

	public function updateCategoryType(Request $request){

		$updatecategory = DB::table('practice_category_types')
		->where('practice_category_types.id', $request->category_type_id)
		->update(['category_type_title' => $request->category_type_title,
		'category_type_description' => $request->category_type_description,
		'category_type_lesson' => $request->category_type_lesson,
		'category_type_strategies' => $request->category_type_strategies,
	    'category_type_identification_methods' => $request->category_type_identification_methods,
	    'category_type_identification_activity' => $request->category_type_identification_activity
		]);
		return $updatecategory;
	}

	public function deleteCategoryType(Request $request)
	{
		DB::delete('delete from practice_category_types where id = ?',[$request->category_type_id]);
		$categoryTypes = DB::table('practice_category_types')->get();
		return view('admin.quiz-management.categorytypes.index', compact('categoryTypes'));
	}
	
}
