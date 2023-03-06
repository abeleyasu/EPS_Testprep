<?php

namespace App\Http\Controllers\QuizManagemet;

use App\Helpers\Helper;
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
		
		// if(!$getTestSectionData->isEmpty())
		// {
		// 	foreach($getTestSectionData as $singleTestSectionData)
		// 	{
		// 		if ($setQuestionOrder === null || $singleTestSectionData->question_order > $setQuestionOrder) {
		// 			$setQuestionOrder = $singleTestSectionData->question_order;
		// 		}
		// 	}
		// 	$setQuestionOrder = $setQuestionOrder + 1;
		// }
		// else
		// {
		// 	$setQuestionOrder = 1;
		// }
		
		$question = new PracticeQuestion();
		$question->format = $request->format;
		$question->title = $request->question;
		$question->type = $request->question_type;
		$question->passages = $request->passages;
		$question->practice_test_sections_id = $request->section_id;
		$question->passages_id = $request->passages_id;
		$question->passages = Helper::getPassageById($request->passages_id);
		$question->passage_number = $request->passage_number;
		$question->answer = $request->answer;
		$question->answer_content = $request->answer_content;
		$question->answer_exp = $request->answer_exp;
		$question->fill = $request->fill;
		$question->fillType = $request->fillType;
		$question->multiChoice = $request->multiChoice;
		$question->question_order = $request->question_order;
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

		return response()->json(['question_id'=>$question->id,'question_order' => $question->question_order,'section_id' => $question->practice_test_sections_id]);
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
		// $get_order = DB::table('practice_questions')->where('id',$request->id)->get();

		// $answer_arr = ['a'=>'f','b'=>'g','c'=>'h','d'=>'j','e'=>'k'];

		$question = PracticeQuestion::find($request->id);
		$question->format = $request->format;
		$question->title = $request->question;
		$question->question_order = $request->question_order;
		$question->type = $request->question_type;
		$question->passages = $request->passages;
		$question->practice_test_sections_id = $request->section_id;
		$question->passages_id = $request->passages_id;
		$question->passage_number = $request->passage_number;
		$question->answer = $request->answer; 
		// if($request->format == "ACT" && $get_order[0]->question_order % 2 == 0){
		// 	$question->answer = $answer_arr[$request->answer];
		// } else {
		// 	$question->answer = $request->answer;
		// }
		$question->answer_content = $request->answer_content;
		$question->answer_exp = $request->answer_exp;
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
		return response()->json(['question_id' => $question->id, 'question_order' => $question->question_order]);
	}

	public function orderQuestion($question_id){
		$question_ids = [];
		$question_delete = PracticeQuestion::where('id', $question_id)->first();
		$section_id = $question_delete->practice_test_sections_id;
		$questions = PracticeQuestion::where('practice_test_sections_id', $section_id)->get();
		$question_arr = [
			"a" => "f",
			"b" => "g",
			"c" => "h",
			"d" => "j",
			"e" => "k",
			"f" => "a",
			"g" => "b",
			"h" => "c",
			"j" => "d",
			"k" => "e"
		];
		$question_type_arr = [
			"choiceOneInFour_Odd" => "choiceOneInFour_Even",
			"choiceOneInFour_Even" => "choiceOneInFour_Odd",
			"choiceOneInFourPass_Odd" => "choiceOneInFourPass_Even",
			"choiceOneInFourPass_Even" => "choiceOneInFour_Odd",
			"choiceOneInFive_Odd" => "choiceOneInFive_Even",
			"choiceOneInFive_Even" => "choiceOneInFive_Odd",
		];

		for($i = 0; $i < count($questions); $i++){
			if($questions[$i]->question_order > $question_delete->question_order){
				$new_order = $questions[$i]->question_order - 1;
				if($questions[$i]->format == "ACT") {
					$answer = $question_arr[$questions[$i]->answer];
					$questionType = $question_type_arr[$questions[$i]->type];
				} else {
					$answer = $questions[$i]->answer;
					$questionType = $questions[$i]->type;
				}
				PracticeQuestion::where('id', $questions[$i]->id)->update([
					'question_order' => $new_order,
					'answer' => $answer,
					'type' => $questionType
				]);
			}
		}
		$question_ids = PracticeQuestion::where('practice_test_sections_id', $section_id)->get();
		$question_ids_arr = $question_ids->reduce(function ($question_ids_arr, $question) {
			$question_ids_arr[$question->id]['id'] = $question->id;
			$question_ids_arr[$question->id]['question_order'] = $question->question_order;
			$question_ids_arr[$question->id]['answer'] = $question->answer;
			$question_ids_arr[$question->id]['type'] = $question->type;
			return $question_ids_arr;
		 }, []);
		return $question_ids_arr;
	}
	
	public function deletePracticeQuestionById(Request $request) {
		$question_delete = PracticeQuestion::where('id', $request->id)->first();
		$question_ids = $this->orderQuestion($question_delete->id);
		PracticeQuestion::where('id', $request->id)->delete();
		return response()->json(['question_ids' => $question_ids]);
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
		return response()->json(['question'=>$question]);  
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

	public function editSection(Request $request){
		$sectionDetails = PracticeTestSection::where('id', $request->sectionId)->first();
		return response()->json(['sectionDetails' => $sectionDetails]);
	}

	public function updateSection(Request $request){
		PracticeTestSection::where('id',$request->sectionId)->update([
			"section_title" => $request->sectionTitle,
			"practice_test_type" => $request->sectionType
		]);

		$updatedSection = PracticeTestSection::where('id',$request->sectionId)->first();

		return response()->json(['updatedSection' => $updatedSection]);

	}

	public function deleteSection(Request $request){
		PracticeTestSection::where('id',$request->sectionId)->delete();																																															
		return redirect(url('admin/practicetests/create'));
	}

	
}
