<?php

namespace App\Http\Controllers\QuizManagemet;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DiffRating;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PracticeQuestion;
use App\Models\PracticeTestSection;
use App\Models\PracticeCategoryType;
use App\Models\QuestionType;
use App\Models\Passage;
use App\Models\PracticeTest;
use App\Models\QuestionDetails;
use App\Models\QuestionTag;
use App\Models\Score;
use App\Models\SuperCategory;
use App\Models\UserAnswers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PracticeQuestionController extends Controller
{
    public function addPracticeQuestion(Request $request)
    {
        $setQuestionOrder = null;
        $getTestSectionData = DB::table('practice_questions')
            ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->where('practice_test_sections.id', $request->section_id)
            ->get();

        $cat_array = [];
        $qt_array = [];

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

        $question->disc_value = $request->diffValue;
        $question->diff_value = $request->discValue;
        // $question->guessing_value = $request->guessingValue;

        $rating_array = $request->diff_rating ?? ['2'];

        if (in_array($request->testSectionType, ['Reading', 'Writing'])) {
            $question->multiChoice = "0";
        }

        if (strpos($request->testSectionType, 'Reading') !== false) {
            $question->multiChoice = NULL;
        }

        foreach ($rating_array as $key => $value) {
            $rating_id = DiffRating::where('title', $value)->orWhere('id', $value)->first();
        }
        $question->diff_rating = $rating_id['id'] ?? '';

        $tag_array = $request->tags;
        foreach ($tag_array as $key => $value) {
            $tag_id = QuestionTag::where('title', $value)->orWhere('id', $value)->first();
        }
        $question->tags = $tag_id['id'];

        $question_type = $request->question_type;
        if ($question_type == 'choiceOneInFive_Odd') {
            $ans_choices = ['A', 'B', 'C', 'D', 'E'];
        } else if ($question_type == 'choiceOneInFourPass_Odd' || $question_type == 'choiceOneInFour_Odd') {
            $ans_choices = ['A', 'B', 'C', 'D'];
        } else if ($question_type == 'choiceOneInFour_Even' || $question_type == 'choiceOneInFourPass_Even') {
            $ans_choices = ['F', 'G', 'H', 'J'];
        } else if ($question_type == 'choiceOneInFive_Even') {
            $ans_choices = ['F', 'G', 'H', 'J', 'K'];
        } else if ($question_type == 'choiceMultInFourFill') {
            if ($request->multiChoice == '2') {
                $ans_choices = ['A'];
            } else {
                $ans_choices = ['A', 'B', 'C', 'D'];
            }
        }

        $checkbox_values = [];
        foreach ($ans_choices as $choice) {
            // $ctValue = $request->{"ct_checkbox_values_$choice"};
            $ctValue = $request->input('ct_checkbox_values')[$choice];
            $checkbox_values[$choice] = $ctValue;
        }
        $question->checkbox_values = json_encode($checkbox_values);
        $question->guessing_value = json_encode($request->guessing_value);


        $super_category_values = [];

        $insertValues = [];
        foreach ($ans_choices as $key => $choice) {
            // $categoryValue = $request->{"super_category_values_$choice"};
            $categoryValue = $request->input('super_category_values')[$choice];
            $super_category_array = $categoryValue;
            foreach ($super_category_array as $innerKey => $innerValue) {
                $super_category_id = SuperCategory::where('title', $innerValue)->orWhere('id', $innerValue)->first();
                $super_category_array[$innerKey] = $super_category_id->id;
                // $insertValues['super_category_values'][$key][$innerKey] = $super_category_id->id;
            }

            $super_category_values[$choice] = $super_category_array;
        }
        $question->super_category_values = json_encode($super_category_values);

        $category_type_values = [];
        foreach ($ans_choices as $choice) {
            // $categoryTypeValue = $request->{"get_category_type_values_$choice"};
            $categoryTypeValue = $request->input('get_category_type_values')[$choice];

            $category_type_array = $categoryTypeValue;
            foreach ($category_type_array as $innerKey => $innerValue) {
                $practice_category_id = PracticeCategoryType::where('category_type_title', $innerValue)->orWhere('id', $innerValue)->first();
                $category_type_array[$innerKey] = $practice_category_id->id;
                // $insertValues['category_type_title'][$key][$innerKey] = $practice_category_id->id;
            }
            $category_type_values[$choice] = $category_type_array;
        }
        // dd($category_type_values);
        $question->category_type_values = json_encode($category_type_values);


        $question_type_values = [];
        foreach ($ans_choices as $choice) {
            // $questionTypeValue = $request->{"get_question_type_values_$choice"};
            $questionTypeValue = $request->input('get_question_type_values')[$choice];

            $question_type_array = $questionTypeValue;
            foreach ($question_type_array as $innerKey => $innerValue) {
                $practice_question_id = QuestionType::where('question_type_title', $innerValue)->orWhere('id', $innerValue)->first();
                $question_type_array[$innerKey] = $practice_question_id->id;
                // $insertValues['question_type_title'][$key][$innerKey] = $practice_question_id->id;
            }
            $question_type_values[$choice] = $question_type_array;
        }
        $question->question_type_values = json_encode($question_type_values);
        $question->test_source = $request->test_source;
        $question->save();

        $i = 0;
        foreach ($super_category_values as $key => $val) {
            foreach ($val as $k => $v) {
                $insertValues[] = [
                    'question_id' => $question->id,
                    'super_category' => $v,
                    'category_type' => $category_type_values[$ans_choices[$i]][$k] ?? '',
                    'question_type' => $question_type_values[$ans_choices[$i]][$k] ?? '',
                    'concept_correct' => $checkbox_values[$ans_choices[$i]][$k] ?? ''
                ];
            }
            $i++;
        }

        QuestionDetails::insert($insertValues);

        $test_id = PracticeTestSection::where('id', $request->section_id)->get('testid');
        $count = PracticeQuestion::where('practice_test_sections_id', $request->section_id)->count();
        // Score::create([
        // 	// 'question_id' => $question->id,
        // 	'question_id' => $count,
        // 	'section_id' => $question->practice_test_sections_id,
        // 	'section_type' => $request->testSectionType,
        // 	'test_id' => $test_id[0]->testid
        // ]);

        if (UserAnswers::where('section_id', $request->section_id)->exists()) {
            $answers = UserAnswers::where('section_id', $request->section_id)->get();
            $answer_data = json_decode($answers[0]->answer, true);
            $flag_data = json_decode($answers[0]->flag, true);
            $guess_data = json_decode($answers[0]->guess, true);
            $answer_data[$question->id] = '-';
            $flag_data[$question->id] = 'no';
            $guess_data[$question->id] = 'no';
            UserAnswers::where('section_id', $request->section_id)->update(['answer' => json_encode($answer_data), 'flag' => json_encode($flag_data), 'guess' => json_encode($guess_data)]);
        }

        return response()->json(['question_id' => $question->id, 'question_order' => $question->question_order, 'section_id' => $question->practice_test_sections_id]);
    }


    public function indexQuestionType()
    {
        $questionTypes = DB::table('question_types')->get();
        return view('admin.quiz-management.questiontypes.index', compact('questionTypes'));
    }
    public function storeQuestionType(Request $request)
    {
        $question = new QuestionType();
        $question->question_type_title = $request->question_type_title;
        $question->question_type_description = $request->question_type_description;
        $question->question_type_lesson = $request->question_type_lesson;
        $question->question_type_strategies = $request->question_type_strategies;
        $question->question_type_identification_methods = $request->question_type_identification_methods;
        $question->question_type_identification_activity = $request->question_type_identification_activity;
        $question->format = $request->test_format;
        $question->super_category_id = $request->super_category;
        $question->category_id = $request->category_id;
        $question->section_type = $request->section_type;
        $question->save();
        return $question->id;
    }

    public function addQuestionType()
    {
        return view('admin.quiz-management.questiontypes.create');
    }

    public function editQuestionTypes(Request $request)
    {
        $getquestionDetails = DB::table('question_types')->where('question_types.id', $request->id)->first();
        $getSuperCategory = SuperCategory::where('format', $getquestionDetails->format)->get();
        $getCategory = PracticeCategoryType::where('format', $getquestionDetails->format)->get();

        return view('admin.quiz-management.questiontypes.edit', ['getquestionDetails' => $getquestionDetails, 'getSuperCategory' => $getSuperCategory, 'getCategory' => $getCategory]);
    }
    public function updateQuestionType(Request $request)
    {
        $updatequestion = DB::table('question_types')
            ->where('question_types.id', $request->question_type_id)
            ->update([
                'question_type_title' => $request->question_type_title,
                'question_type_description' => $request->question_type_description,
                'question_type_lesson' => $request->question_type_lesson,
                'question_type_strategies' => $request->question_type_strategies,
                'question_type_identification_methods' => $request->question_type_identification_methods,
                'question_type_identification_activity' => $request->question_type_identification_activity,
                'format' => $request->format,
                'super_category_id' => $request->super_category,
                'category_id' => $request->category_id,
                'section_type' => $request->section_type
            ]);
        return $updatequestion;
    }

    public function deleteQuestionType(Request $request)
    {
        DB::delete('delete from question_types where id = ?', [$request->question_type_id]);
        $questionTypes = DB::table('question_types')->get();
        return view('admin.quiz-management.questiontypes.index', compact('questionTypes'));
    }
    public function updatePracticeQuestion(Request $request)
    {
        // dump($request->id);
        // dump($request->guessingValue);
        // dd($request);
        $question = PracticeQuestion::find($request->id);
        $question->format = $request->format;
        $question->test_source = $request->test_source;
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

        $question->disc_value = $request->disc_value;
        $question->diff_value = $request->diff_value;

        $rating_array = $request->diff_rating;
        foreach ($rating_array as $key => $value) {
            $rating_id = DiffRating::where('title', $value)->orWhere('id', $value)->first();
        }
        $question->diff_rating = $rating_id['id'];

        $tag_array = $request->tags;
        foreach ($tag_array as $key => $value) {
            $tag_id = QuestionTag::where('title', $value)->orWhere('id', $value)->first();
        }
        $question->tags = $tag_id['id'];

        $question_type = $request->question_type;
        if ($question_type == 'choiceOneInFive_Odd') {
            $ans_choices = ['A', 'B', 'C', 'D', 'E'];
        } else if ($question_type == 'choiceOneInFourPass_Odd' || $question_type == 'choiceOneInFour_Odd') {
            $ans_choices = ['A', 'B', 'C', 'D'];
        } else if ($question_type == 'choiceOneInFour_Even' || $question_type == 'choiceOneInFourPass_Even') {
            $ans_choices = ['F', 'G', 'H', 'J'];
        } else if ($question_type == 'choiceOneInFive_Even') {
            $ans_choices = ['F', 'G', 'H', 'J', 'K'];
        } else if ($question_type == 'choiceMultInFourFill') {
            if ($request->multiChoice == '2') {
                $ans_choices = ['A'];
            } else {
                $ans_choices = ['A', 'B', 'C', 'D'];
            }
        }

        if (strpos($request->testSectionType, 'Reading') !== false) {
            $question->multiChoice = NULL;
        }


        $checkbox_values = [];
        foreach ($ans_choices as $choice) {
            $ctValue = $request->input('ct_checkbox_values')[$choice];
            $checkbox_values[$choice] = $ctValue;
        }
        $question->checkbox_values = json_encode($checkbox_values);


        $super_category_values = [];
        foreach ($ans_choices as $choice) {
            // $categoryValue = $request->{"super_category_values_$choice"};
            $categoryValue = $request->input('super_category_values')[$choice];

            $super_category_array = $categoryValue;
            foreach ($super_category_array as $innerKey => $innerValue) {
                $super_category_id = SuperCategory::where('title', $innerValue)->orWhere('id', $innerValue)->first();
                $super_category_array[$innerKey] = $super_category_id->id;
            }

            $super_category_values[$choice] = $super_category_array;
        }
        $question->super_category_values = json_encode($super_category_values);
        $question->guessing_value = json_encode($request->guessingValue);


        $category_type_values = [];
        foreach ($ans_choices as $choice) {
            // $categoryTypeValue = $request->{"get_category_type_values_$choice"};
            $categoryTypeValue = $request->input('get_category_type_values')[$choice];

            $category_type_array = $categoryTypeValue;
            foreach ($category_type_array as $innerKey => $innerValue) {
                $practice_category_id = PracticeCategoryType::where('category_type_title', $innerValue)->orWhere('id', $innerValue)->first();
                $category_type_array[$innerKey] = $practice_category_id->id;
            }
            $category_type_values[$choice] = $category_type_array;
        }
        $question->category_type_values = json_encode($category_type_values);


        $question_type_values = [];
        foreach ($ans_choices as $choice) {
            // $questionTypeValue = $request->{"get_question_type_values_$choice"};
            $questionTypeValue = $request->input('get_question_type_values')[$choice];

            $question_type_array = $questionTypeValue;
            foreach ($question_type_array as $innerKey => $innerValue) {
                $practice_question_id = QuestionType::where('question_type_title', $innerValue)->orWhere('id', $innerValue)->first();
                $question_type_array[$innerKey] = $practice_question_id->id;
            }
            $question_type_values[$choice] = $question_type_array;
        }
        $question->question_type_values = json_encode($question_type_values);

        $question->save();

        $insertValues = [];
        $i = 0;
        foreach ($super_category_values as $key => $val) {
            foreach ($val as $k => $v) {
                $insertValues[] = [
                    'question_id' => $question->id,
                    'super_category' => $v,
                    'category_type' => $category_type_values[$ans_choices[$i]][$k] ?? '',
                    'question_type' => $question_type_values[$ans_choices[$i]][$k] ?? '',
                    'concept_correct' => $checkbox_values[$ans_choices[$i]][$k] ?? ''
                ];
            }
            $i++;
        }
        $question_details = QuestionDetails::where('question_id', $question->id);
        if ($question_details->count()) {
            $question_details->delete();
        }
        QuestionDetails::insert($insertValues);

        return response()->json(['question_id' => $question->id, 'question_order' => $question->question_order]);
    }

    public function orderQuestion($question_id)
    {
        $question_ids = [];
        $question_delete = PracticeQuestion::where('id', $question_id)->first();
        $section_id = $question_delete->practice_test_sections_id;
        //new
        $userAnswer = UserAnswers::where('section_id', $section_id)->first();
        if (isset($userAnswer) && !empty($userAnswer)) {
            $decoded_answer = json_decode($userAnswer->answer, true);
        }

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
            "choiceOneInFourPass_Even" => "choiceOneInFourPass_Odd",
            "choiceOneInFive_Odd" => "choiceOneInFive_Even",
            "choiceOneInFive_Even" => "choiceOneInFive_Odd",
        ];

        for ($i = 0; $i < count($questions); $i++) {
            if ($questions[$i]->question_order > $question_delete->question_order) {
                $new_order = $questions[$i]->question_order - 1;
                if ($questions[$i]->format == "ACT") {
                    $answer = $question_arr[$questions[$i]->answer];
                    $questionType = $question_type_arr[$questions[$i]->type];
                    // new
                    if (isset($decoded_answer) && !empty($decoded_answer)) {
                        $decoded_answer[$questions[$i]['id']] = $answer;
                        $decoded_answer = json_encode($decoded_answer);
                        UserAnswers::where('section_id', $section_id)->update([
                            "answer" => $decoded_answer
                        ]);
                    }
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

    public function deletePracticeQuestionById(Request $request)
    {
        $question_delete = PracticeQuestion::where('id', $request->id)->first();
        $question_ids = $this->orderQuestion($question_delete->id);
        PracticeQuestion::where('id', $request->id)->delete();
        $sec_id = $question_delete['practice_test_sections_id'];
        $remaining_question = PracticeQuestion::where('practice_test_sections_id', $sec_id)->count();
        $sec = PracticeTestSection::where('id', $sec_id)->get(['practice_test_type', 'testid']);
        $sec_type = $sec[0]['practice_test_type'];
        $test_id = $sec[0]['testid'];
        if ($sec_type == 'Math_no_calculator' || $sec_type == 'Math_with_calculator') {
            $section = PracticeTestSection::where('testid', $test_id)->whereIn('practice_test_type', ['Math_no_calculator', 'Math_with_calculator'])->pluck('id')->toArray();
            $remaining_question = PracticeQuestion::whereIn('practice_test_sections_id', $section)->count();
            Score::where('test_id', $test_id)->whereIn('section_type', ['Math_no_calculator', 'Math_with_calculator'])->where('question_id', '>', $remaining_question)->delete();
        } else {
            Score::where('test_id', $test_id)->where('section_type', $sec_type)->where('question_id', '>', $remaining_question)->delete();
        }
        return response()->json(['question_ids' => $question_ids]);
    }

    public function getPracticePassage(Request $request)
    {
        $passages = Passage::where('type', $request->format)->get();
        return $passages;
    }

    public function getPracticeQuestionById(Request $request)
    {
        $question = PracticeQuestion::where('id', $request->question_id)->get();
        return response()->json(['question' => $question]);
    }

    public function getSectionQuestions(Request $request)
    {
        $sectionQuestions = $testSectionQuestions = DB::table('practice_questions')
            ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.tags')
            ->where('practice_test_sections.id', $request->sectionId)
            ->orderBy('question_order', 'asc')
            ->get();
        return response()->json($sectionQuestions);
    }

    public function addPracticeTestSection(Request $request)
    {

        $practiceTestSection = [];
        
        $practiceSection = new PracticeTestSection();
        $practiceSection->format = $request->format;
        $practiceSection->section_title = $request->testSectionTitle;
        $practiceSection->practice_test_type = $request->testSectionType;
        $practiceSection->testid = $request->get_test_id;
        $practiceSection->section_order = $request->order;
        $practiceSection->is_section_completed = '';
        $practiceSection->regular_time = $request->regular;
        $practiceSection->fifty_per_extended = $request->fifty;
        $practiceSection->hundred_per_extended = $request->hundred;
        $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
        $practiceSection->save();
        $data[] = [
            'id' => $practiceSection->id,
            'section' => $practiceSection->practice_test_type,
            'order' => $practiceSection->section_order,
        ];

        DB::select("DELETE FROM `user_answers` where section_id NOT in (select id from practice_test_sections)");
        if ($request->testSectionType == 'Math_with_calculator') {
            $exist_section = Score::where('test_id', $request->get_test_id)->where('section_type', 'Math_no_calculator')->get();
            if (isset($exist_section) && !empty($exist_section)) {
                foreach ($exist_section as $section) {
                    Score::create([
                        'section_id' => $practiceSection->id, 
                        'question_id' => $section['question_id'], 
                        'actual_score' => $section['actual_score'], 
                        'converted_score' => $section['converted_score'], 
                        'section_type' => $request->testSectionType, 
                        'test_id' => $request->get_test_id
                    ]);
                }
            }
        } else if ($request->testSectionType == 'Math_no_calculator') {
            $exist_section = Score::where('test_id', $request->get_test_id)->where('section_type', 'Math_with_calculator')->get();
            if (isset($exist_section) && !empty($exist_section)) {
                foreach ($exist_section as $section) {
                    Score::create([
                        'section_id' => $practiceSection->id, 
                        'question_id' => $section['question_id'], 
                        'actual_score' => $section['actual_score'], 
                        'converted_score' => $section['converted_score'], 
                        'section_type' => $request->testSectionType, 
                        'test_id' => $request->get_test_id
                    ]);
                }
            }
        }

        // Automatically generate two more sections when Type of question is Digital SAT/PSAT.
        if ($request->question_type == 'DSAT') {
            if ($request->testSectionType == 'Reading_And_Writing') {
                $practiceSection = new PracticeTestSection();
                $practiceSection->format = $request->format;
                $practiceSection->section_title = 'Module 2A (Easy) - Reading & Writing';
                $practiceSection->practice_test_type = 'Easy_Reading_And_Writing';
                $practiceSection->testid = $request->get_test_id;
                $practiceSection->section_order = $request->order+1;
                $practiceSection->is_section_completed = '';
                $practiceSection->regular_time = $request->regular;
                $practiceSection->fifty_per_extended = $request->fifty;
                $practiceSection->hundred_per_extended = $request->hundred;
                $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
                $practiceSection->save();
                $data[] = [
                    'id' => $practiceSection->id,
                    'section' => $practiceSection->section_title,
                    'order' => $practiceSection->section_order,
                ];
                // array_push($practiceTestSection, $data);
                // array_push($practiceTestSection,$practiceSection->id);

                $practiceSection = new PracticeTestSection();
                $practiceSection->format = $request->format;
                $practiceSection->section_title = 'Module 2B (Hard) - Reading & Writing';
                $practiceSection->practice_test_type = 'Hard_Reading_And_Writing';
                $practiceSection->testid = $request->get_test_id;
                $practiceSection->section_order = $request->order+2;
                $practiceSection->is_section_completed = '';
                $practiceSection->regular_time = $request->regular;
                $practiceSection->fifty_per_extended = $request->fifty;
                $practiceSection->hundred_per_extended = $request->hundred;
                $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
                $practiceSection->save();
                $data[] = [
                    'id' => $practiceSection->id,
                    'section' => $practiceSection->section_title,
                    'order' => $practiceSection->section_order,
                ];
                // array_push($practiceTestSection, $data);
                // array_push($practiceTestSection,$practiceSection->id);
                
            }elseif($request->testSectionType == 'Math') {
                $practiceSection = new PracticeTestSection();
                $practiceSection->format = $request->format;
                $practiceSection->section_title = 'Module 2A (Easy) - Math';
                $practiceSection->practice_test_type = 'Math_with_calculator';
                $practiceSection->testid = $request->get_test_id;
                $practiceSection->section_order = $request->order+1;
                $practiceSection->is_section_completed = '';
                $practiceSection->regular_time = $request->regular;
                $practiceSection->fifty_per_extended = $request->fifty;
                $practiceSection->hundred_per_extended = $request->hundred;
                $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
                $practiceSection->save();
                $data[] = [
                    'id' => $practiceSection->id,
                    'section' => $practiceSection->section_title,
                    'order' => $practiceSection->section_order,
                ];
                // array_push($practiceTestSection, $data);
                // array_push($practiceTestSection,$practiceSection->id);

                DB::select("DELETE FROM `user_answers` where section_id NOT in (select id from practice_test_sections)");

                $exist_section = Score::where('test_id', $request->get_test_id)->where('section_type', 'Math_no_calculator')->get();
                if (isset($exist_section) && !empty($exist_section)) {
                    foreach ($exist_section as $section) {
                        Score::create([
                            'section_id' => $practiceSection->id, 
                            'question_id' => $section['question_id'], 
                            'actual_score' => $section['actual_score'], 
                            'converted_score' => $section['converted_score'], 
                            'section_type' => $request->testSectionType, 
                            'test_id' => $request->get_test_id
                        ]);
                    }
                }

                $practiceSection = new PracticeTestSection();
                $practiceSection->format = $request->format;
                $practiceSection->section_title = 'Module 2B (Hard) - Math';
                $practiceSection->practice_test_type = 'Math_no_calculator';
                $practiceSection->testid = $request->get_test_id;
                $practiceSection->section_order = $request->order+2;
                $practiceSection->is_section_completed = '';
                $practiceSection->regular_time = $request->regular;
                $practiceSection->fifty_per_extended = $request->fifty;
                $practiceSection->hundred_per_extended = $request->hundred;
                $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
                $practiceSection->save();
                $data[] = [
                    'id' => $practiceSection->id,
                    'section' => $practiceSection->section_title,
                    'order' => $practiceSection->section_order,
                ];
                // array_push($practiceTestSection, $data);
                // array_push($practiceTestSection,$practiceSection->id);

                DB::select("DELETE FROM `user_answers` where section_id NOT in (select id from practice_test_sections)");
                $exist_section = Score::where('test_id', $request->get_test_id)->where('section_type', 'Math_with_calculator')->get();
                if (isset($exist_section) && !empty($exist_section)) {
                    foreach ($exist_section as $section) {
                        Score::create([
                            'section_id' => $practiceSection->id, 
                            'question_id' => $section['question_id'], 
                            'actual_score' => $section['actual_score'], 
                            'converted_score' => $section['converted_score'], 
                            'section_type' => $request->testSectionType, 
                            'test_id' => $request->get_test_id
                        ]);
                    }
                }
                

            }else{
                // no such case
            }

            
        }elseif($request->question_type == 'DPSAT'){
            if ($request->testSectionType == 'Reading_And_Writing') {
                $practiceSection = new PracticeTestSection();
                $practiceSection->format = $request->format;
                $practiceSection->section_title = 'Module 2A (Easy) - Reading & Writing';
                $practiceSection->practice_test_type = 'Easy_Reading_And_Writing';
                $practiceSection->testid = $request->get_test_id;
                $practiceSection->section_order = $request->order+1;
                $practiceSection->is_section_completed = '';
                $practiceSection->regular_time = $request->regular;
                $practiceSection->fifty_per_extended = $request->fifty;
                $practiceSection->hundred_per_extended = $request->hundred;
                $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
                $practiceSection->save();
                $data[] = [
                    'id' => $practiceSection->id,
                    'section' => $practiceSection->section_title,
                    'order' => $practiceSection->section_order,
                ];
                // array_push($practiceTestSection, $data);
                // array_push($practiceTestSection,$practiceSection->id);

                $practiceSection = new PracticeTestSection();
                $practiceSection->format = $request->format;
                $practiceSection->section_title = 'Module 2B (Hard) - Reading & Writing';
                $practiceSection->practice_test_type = 'Hard_Reading_And_Writing';
                $practiceSection->testid = $request->get_test_id;
                $practiceSection->section_order = $request->order+2;
                $practiceSection->is_section_completed = '';
                $practiceSection->regular_time = $request->regular;
                $practiceSection->fifty_per_extended = $request->fifty;
                $practiceSection->hundred_per_extended = $request->hundred;
                $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
                $practiceSection->save();
                $data[] = [
                    'id' => $practiceSection->id,
                    'section' => $practiceSection->section_title,
                    'order' => $practiceSection->section_order,
                ];
                // array_push($practiceTestSection, $data);
                // array_push($practiceTestSection,$practiceSection->id);
                
            }elseif($request->testSectionType == 'Math') {
                $practiceSection = new PracticeTestSection();
                $practiceSection->format = $request->format;
                $practiceSection->section_title = 'Module 2A (Easy) - Math';
                $practiceSection->practice_test_type = 'Math_with_calculator';
                $practiceSection->testid = $request->get_test_id;
                $practiceSection->section_order = $request->order+1;
                $practiceSection->is_section_completed = '';
                $practiceSection->regular_time = $request->regular;
                $practiceSection->fifty_per_extended = $request->fifty;
                $practiceSection->hundred_per_extended = $request->hundred;
                $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
                $practiceSection->save();
                $data[] = [
                    'id' => $practiceSection->id,
                    'section' => $practiceSection->section_title,
                    'order' => $practiceSection->section_order,
                ];
                // array_push($practiceTestSection, $data);
                // array_push($practiceTestSection,$practiceSection->id);

                DB::select("DELETE FROM `user_answers` where section_id NOT in (select id from practice_test_sections)");

                $exist_section = Score::where('test_id', $request->get_test_id)->where('section_type', 'Math_no_calculator')->get();
                if (isset($exist_section) && !empty($exist_section)) {
                    foreach ($exist_section as $section) {
                        Score::create([
                            'section_id' => $practiceSection->id, 
                            'question_id' => $section['question_id'], 
                            'actual_score' => $section['actual_score'], 
                            'converted_score' => $section['converted_score'], 
                            'section_type' => $request->testSectionType, 
                            'test_id' => $request->get_test_id
                        ]);
                    }
                }

                $practiceSection = new PracticeTestSection();
                $practiceSection->format = $request->format;
                $practiceSection->section_title = 'Module 2B (Hard) - Math';
                $practiceSection->practice_test_type = 'Math_no_calculator';
                $practiceSection->testid = $request->get_test_id;
                $practiceSection->section_order = $request->order+2;
                $practiceSection->is_section_completed = '';
                $practiceSection->regular_time = $request->regular;
                $practiceSection->fifty_per_extended = $request->fifty;
                $practiceSection->hundred_per_extended = $request->hundred;
                $practiceSection->required_number_of_correct_answers = $request->required_number_of_correct_answers;
                $practiceSection->save();
                $data[] = [
                    'id' => $practiceSection->id,
                    'section' => $practiceSection->section_title,
                    'order' => $practiceSection->section_order,
                ];
                // array_push($practiceTestSection, $data);
                // array_push($practiceTestSection,$practiceSection->id);

                DB::select("DELETE FROM `user_answers` where section_id NOT in (select id from practice_test_sections)");
                $exist_section = Score::where('test_id', $request->get_test_id)->where('section_type', 'Math_with_calculator')->get();
                if (isset($exist_section) && !empty($exist_section)) {
                    foreach ($exist_section as $section) {
                        Score::create([
                            'section_id' => $practiceSection->id, 
                            'question_id' => $section['question_id'], 
                            'actual_score' => $section['actual_score'], 
                            'converted_score' => $section['converted_score'], 
                            'section_type' => $request->testSectionType, 
                            'test_id' => $request->get_test_id
                        ]);
                    }
                }

            }else{
                // no such case
            }
        }else{
            // no such case.
        }
        array_push($practiceTestSection, $data);
        return $practiceTestSection;
        // return $practiceSection->id;
    }

    public function addPracticeCategoryType(Request $request)
    {
        if (isset($request->searchValue) && !empty($request->searchValue)) {
            $super_category_id = SuperCategory::where('id', $request['super_category'][0])
                ->orWhere('title', $request['super_category'][0])
                ->first();
            $practiceCatType = PracticeCategoryType::create([
                'category_type_title' => $request->searchValue,
                'format' => $request->format,
                'super_category_id' => $super_category_id->id,
                'section_type' => $request->section_type
            ]);
            $id = $practiceCatType->id;
            $title = $practiceCatType->category_type_title;
            return response()->json(["success" => true, 'id' => $id, 'category_type_title' => $title]);
        }
    }

    public function addPracticeQuestionType(Request $request)
    {
        if (isset($request->searchValue) && !empty($request->searchValue)) {
            $super_category_id = SuperCategory::where('id', $request['super_category'][0])->orWhere('title', $request['super_category'][0])->first();
            $category_id = PracticeCategoryType::where('id', $request['category'][0])->orWhere('category_type_title', $request['category'][0])->first();
            $practiceQuesType = QuestionType::create([
                'question_type_title' => $request->searchValue,
                'format' => $request->format,
                'super_category_id' => isset($super_category_id->id) ? $super_category_id->id : null,
                'section_type' => $request->section_type,
                'category_id' => isset($category_id->id) ? $category_id->id : null
            ]);
            $id = $practiceQuesType->id;
            $title = $practiceQuesType->question_type_title;
            return response()->json(["success" => true, 'id' => $id, 'question_type_title' => $title]);
        }
    }

    public function sectionOrder(Request $request)
    {
        $partSection = PracticeTestSection::find($request->section_id);
        $partSection->section_order = $request->section_order;
        $partSection->save();
        return $partSection->id;
    }

    public function questionOrder(Request $request)
    {
        $question = PracticeQuestion::find($request->question_id);
        $question->question_order = $request->question_order;

        $section_id = $question->practice_test_sections_id;
        $userAnswer = UserAnswers::where('section_id', $section_id)->first();
        if (isset($userAnswer) && !empty($userAnswer)) {
            $decoded_answer = json_decode($userAnswer->answer, true);
        }
        $question_arr_odd = [
            "f" => "a",
            "g" => "b",
            "h" => "c",
            "j" => "d",
            "k" => "e",
            "a" => "a",
            "b" => "b",
            "c" => "c",
            "d" => "d",
            "e" => "e"
        ];
        $question_arr_even = [
            "a" => "f",
            "b" => "g",
            "c" => "h",
            "d" => "j",
            "e" => "k",
            "f" => "f",
            "g" => "g",
            "h" => "h",
            "j" => "j",
            "k" => "k"
        ];
        $user_answer_arr = [
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
        $question_type_arr_odd = [
            "choiceOneInFour_Odd" => "choiceOneInFour_Even",
            "choiceOneInFourPass_Odd" => "choiceOneInFourPass_Even",
            "choiceOneInFive_Odd" => "choiceOneInFive_Even",
            "choiceOneInFour_Even" => "choiceOneInFour_Even",
            "choiceOneInFourPass_Even" => "choiceOneInFourPass_Even",
            "choiceOneInFive_Even" => "choiceOneInFive_Even"
        ];
        $question_type_arr_even = [
            "choiceOneInFour_Even" => "choiceOneInFour_Odd",
            "choiceOneInFourPass_Even" => "choiceOneInFourPass_Odd",
            "choiceOneInFive_Even" => "choiceOneInFive_Odd",
            "choiceOneInFour_Odd" => "choiceOneInFour_Odd",
            "choiceOneInFourPass_Odd" => "choiceOneInFourPass_Odd",
            "choiceOneInFive_Odd" => "choiceOneInFive_Odd"
        ];
        if ($question->format == 'ACT' && $request->question_order % 2 == 0) {
            $answer = $question_arr_even[$question->answer];
            $question_type = $question_type_arr_odd[$question->type];
            if (isset($decoded_answer) && !empty($decoded_answer)) {
                $decoded_answer[$request->question_id] = $answer;
                $decoded_answer = json_encode($decoded_answer);
                UserAnswers::where('section_id', $section_id)->update([
                    "answer" => $decoded_answer
                ]);
            }
            $question->answer = $answer;
            $question->type = $question_type;
        } else if ($question->format == 'ACT' && $request->question_order % 2 != 0) {
            $answer = $question_arr_odd[$question->answer];
            $question_type = $question_type_arr_even[$question->type];
            if (isset($decoded_answer) && !empty($decoded_answer)) {
                $decoded_answer[$request->question_id] = $answer;
                $decoded_answer = json_encode($decoded_answer);
                UserAnswers::where('section_id', $section_id)->update([
                    "answer" => $decoded_answer
                ]);
            }
            $question->answer = $answer;
            $question->type = $question_type;
        }

        // $single_answer = $decoded_answer[$request->question_id];
        // $updated_answer = $user_answer_arr[$single_answer];



        $question->save();
        return response()->json(['question' => $question]);
    }

    public function getPracticeCategoryType()
    {
        if (isset($_GET['testType']) && !empty($_GET['testType'])) {
            $category_type = PracticeCategoryType::where('format', $_GET['testType'])->get();
        } else {
            $category_type = PracticeCategoryType::get();
        }
        return response()->json(['success' => true, 'dropdown_list' => $category_type, 'type' => 'category_type']);
    }

    public function getPracticeQuestionType()
    {
        if (isset($_GET['testType']) && !empty($_GET['testType'])) {
            $question_type = QuestionType::where('format', $_GET['testType'])->get();
        } else {
            $question_type = QuestionType::get();
        }
        return response()->json(['success' => true, 'dropdown_list' => $question_type, 'type' => 'question_type']);
    }

    public function getSuperCategory()
    {
        if (isset($_GET['testType']) && !empty($_GET['testType'])) {
            $super_categories = SuperCategory::where('format', $_GET['testType'])->get();
        } else {
            $super_categories = SuperCategory::get();
        }
        return response()->json(['success' => true, 'dropdown_list' => $super_categories, 'type' => 'super_categories']);
    }

    //new start
    public function indexCategoryType()
    {
        $categoryTypes = DB::table('practice_category_types')->get();
        return view('admin.quiz-management.categorytypes.index', compact('categoryTypes'));
    }

    public function storeCategoryType(Request $request)
    {
        $category = new PracticeCategoryType();
        $category->category_type_title = $request->category_type_title;
        $category->format = $request->format;
        $category->section_type = $request->section_type;
        $category->super_category_id = $request->super_category;
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
        $getcategoryDetails = DB::table('practice_category_types')->where('practice_category_types.id', $request->id)->first();
        $getSuperCategory = SuperCategory::where('format', $getcategoryDetails->format)->get();

        return view('admin.quiz-management.categorytypes.edit', ['getcategoryDetails' => $getcategoryDetails, 'getSuperCategory' => $getSuperCategory]);
    }

    public function updateCategoryType(Request $request)
    {

        $updatecategory = DB::table('practice_category_types')
            ->where('practice_category_types.id', $request->category_type_id)
            ->update([
                'category_type_title' => $request->category_type_title,
                'category_type_description' => $request->category_type_description,
                'category_type_lesson' => $request->category_type_lesson,
                'category_type_strategies' => $request->category_type_strategies,
                'category_type_identification_methods' => $request->category_type_identification_methods,
                'category_type_identification_activity' => $request->category_type_identification_activity,
                'format' => $request->format,
                'super_category_id' => $request->super_category,
                'section_type' => $request->section_type
            ]);
        return $updatecategory;
    }

    public function deleteCategoryType(Request $request)
    {
        DB::delete('delete from practice_category_types where id = ?', [$request->category_type_id]);
        $categoryTypes = DB::table('practice_category_types')->get();
        return view('admin.quiz-management.categorytypes.index', compact('categoryTypes'));
    }

    public function editSection(Request $request)
    {
        $sectionDetails = PracticeTestSection::where('id', $request->sectionId)->first();
        return response()->json(['sectionDetails' => $sectionDetails]);
    }

    public function updateSection(Request $request)
    {
        // if(isset($request->regular)){
        // 	$regular = Helper::TimeChangeInMinutes($request->regular);
        // } else {
        // 	$regular = null;
        // }
        // if(isset($request->fifty)){
        // 	$fifty_extended = Helper::TimeChangeInMinutes($request->fifty);
        // } else {
        // 	$fifty_extended = null;
        // }
        // if(isset($request->hundred)){
        // 	$hundred_extended = Helper::TimeChangeInMinutes($request->hundred);
        // } else {
        // 	$hundred_extended = null;
        // }

        PracticeTestSection::where('id', $request->sectionId)->update([
            "section_title" => $request->sectionTitle,
            "practice_test_type" => $request->sectionType,
            "regular_time" => $request->regular,
            "fifty_per_extended" => $request->fifty,
            "required_number_of_correct_answers" => $request->required_number_of_correct_answers,
            "hundred_per_extended" => $request->hundred
        ]);

        $updatedSection = PracticeTestSection::where('id', $request->sectionId)->first();
        return response()->json(['updatedSection' => $updatedSection]);
    }

    public function deleteSection(Request $request)
    {
        // $testid = [];
        $testid = Score::where('section_id', $request->sectionId)->get('test_id');
        // dd($testid);
        if(count($testid) == 0) {
            $id = PracticeTestSection::where('id', $request->sectionId)->first('testid');
            $all_section = PracticeTestSection::where('testid', $id->testid)
                ->whereIn('practice_test_type', ['Math_with_calculator', 'Math_no_calculator'])
                ->pluck('id')->toArray();
        }else{
            $all_section = PracticeTestSection::where('testid', $testid[0]['test_id'])
                ->whereIn('practice_test_type', ['Math_with_calculator', 'Math_no_calculator'])
                ->pluck('id')->toArray();
        }
        // dd($all_section);
        $total_test_question = PracticeQuestion::whereIn('practice_test_sections_id', $all_section)->count();
        $count_section_questions = PracticeQuestion::where('practice_test_sections_id', $request->sectionId)->count();
        $final_count =  $total_test_question - $count_section_questions;

        if(count($testid) == 0) {
            if ($request->sectionType == 'Math_with_calculator' || $request->sectionType == 'Math_no_calculator') {
                Score::where('test_id', $id->testid)
                ->whereNotIn('section_id', [$request->sectionId])
                ->where('question_id', '>', $final_count)->delete();
            }
        }else{
            if ($request->sectionType == 'Math_with_calculator' || $request->sectionType == 'Math_no_calculator') {
                Score::where('test_id', $testid[0]['test_id'])
                ->whereNotIn('section_id', [$request->sectionId])
                ->where('question_id', '>', $final_count)->delete();
            }
        }
        Score::where('section_id', $request->sectionId)->delete();
        PracticeTestSection::where('id', $request->sectionId)->delete();
        UserAnswers::where('section_id', $request->sectionId)->delete();
        return redirect(url('admin/practicetests/create'));
    }

    public function saveScore(Request $request)
    {
        $section_id = $request['scores'][0]['sectionId'];
        $section_type = $request['scores'][0]['sectionType'];
        $test_id = PracticeTestSection::where('id', $section_id)->get('testid');
        if ($section_type == 'Math_no_calculator') {
            $section_ava = PracticeTestSection::where('testid', $test_id[0]['testid'])->whereIn('practice_test_type', ['Math_with_calculator', 'Math_no_calculator'])->whereNotIn('id', [$section_id])->get();
        } else if ($section_type == 'Math_with_calculator') {
            $section_ava = PracticeTestSection::where('testid', $test_id[0]['testid'])->whereIn('practice_test_type', ['Math_no_calculator', 'Math_with_calculator'])->whereNotIn('id', [$section_id])->get();
        }

        $datas = $request->all();
        if ($section_type == 'Math_no_calculator' || $section_type == 'Math_with_calculator') {
            foreach ($datas['scores'] as $data) {
                if ($data['questionId'] == 'undefined') {
                    $data['questionId'] = $data['sectionId'];
                }
                Score::updateOrCreate(
                    ['section_id' => $data['sectionId'], 'question_id' => $data['questionId']],
                    ['actual_score' => $data['actualScore'], 'converted_score' => $data['convertedScore'], 'section_type' => $data['sectionType'], 'test_id' => $data['testId']]
                );
                if (isset($section_ava[0]['id']) && !empty($section_ava[0]['id'])) {
                    foreach ($section_ava as $section) {
                        Score::updateOrCreate(
                            ['section_id' => $section->id, 'question_id' => $data['questionId']],
                            ['actual_score' => $data['actualScore'], 'converted_score' => $data['convertedScore'], 'section_type' => $section->practice_test_type, 'test_id' => $data['testId']]
                        );
                    }
                }
            }
        } else {
            foreach ($datas['scores'] as $data) {
                if ($data['questionId'] == 'undefined') {
                    $data['questionId'] = $data['sectionId'];
                }
                Score::updateOrCreate(
                    ['section_id' => $data['sectionId'], 'question_id' => $data['questionId']],
                    ['actual_score' => $data['actualScore'], 'converted_score' => $data['convertedScore'], 'section_type' => $data['sectionType'], 'test_id' => $data['testId']]
                );
            }
        }

        return response()->json(['datas' => $datas]);
    }

    public function checkScore(Request $request)
    {
        $section_id = $request['section_id'];
        $records = Score::where(['section_id' => $section_id])->get();
        return response()->json(['records' => $records]);
    }

    public function digiCheckScore(Request $request)
    {
        $test_id = $request->test_id;
        $section_type = $request->section_type;

        if (in_array($section_type, ['Math_no_calculator','Math_with_calculator','Math'])) {
            $section_name = 'Math';
        }

        if (in_array($section_type, ['Hard_Reading_And_Writing','Easy_Reading_And_Writing','Reading_And_Writing'])) {
            $section_name = 'Reading';
        }

        $main_section_id = 0;
        $numberOfQuestions = 0;
        $allScores = Score::where(['test_id' => $test_id])->get();
        // dump($allScores);
        $practice_test_sections = \DB::table('practice_test_sections')
                                        ->where(['testid' => $test_id])
                                        ->where('practice_test_type','LIKE', '%'.$section_name.'%')
                                        ->get();
        
        // foreach($practice_test_sections as $sections) {
        //     $questions = \DB::table('practice_questions')->where(['practice_test_sections_id' => $sections->id])->count();
        //     $numberOfQuestions = $numberOfQuestions + $questions;
        // }

        return view('admin.quiz-management.practicetests.digiCheckScore',  [
            'test_id' => $test_id,
            'main_section_id' => $main_section_id,
            'section_name' => $section_name,
            'allScores' => $allScores,
            'numberOfQuestions' => $numberOfQuestions,
            'practice_test_sections' => $practice_test_sections,
        ]);
    }

    public function checkSectionType(Request $request)
    {
        $section_id = $request['section_id'];
        $test_id = $request['test_id'];
        $records = Score::where('test_id', $test_id)->whereIn('section_type', ['Math_no_calculator', 'Math_with_calculator'])->get();
        return response()->json(['records' => $records]);
    }

    public function addDiffRating(Request $request)
    {
        if (isset($request->searchValue) && !empty($request->searchValue)) {
            $diffRating = DiffRating::updateOrCreate([
                'title' => $request->searchValue[0]
            ]);
            $id = $diffRating->id;
            $title = $diffRating->title;
            return response()->json(["success" => true, 'id' => $id, 'diff_rating_title' => $title]);
        }
    }

    public function addQuestionTag(Request $request)
    {
        if (isset($request->searchValue) && !empty($request->searchValue)) {
            $questionTag = QuestionTag::updateOrCreate([
                'title' => $request->searchValue[0]
            ]);
            $id = $questionTag->id;
            $title = $questionTag->title;
            return response()->json(["success" => true, 'id' => $id, 'question_tag' => $title]);
        }
    }

    public function getCategoryType(Request $request)
    {
        $category = PracticeCategoryType::where('format', $request['format'])->get();
        return response()->json(['category' => $category]);
    }

    public function addSuperCategory(Request $request)
    {
        if (isset($request->searchValue) && !empty($request->searchValue)) {
            $superCategory = SuperCategory::updateOrCreate([
                'title' => $request->searchValue,
                'format' => $request->format,
                'section_type' => $request->section_type
            ]);
            $id = $superCategory->id;
            $title = $superCategory->title;
            return response()->json(["success" => true, 'id' => $id, 'super_category_title' => $title]);
        }
    }

    public function findSuperCategory(Request $request)
    {
        $super_categories = SuperCategory::where('format', $request['format'])
            ->where('section_type', $request['section_type'])
            ->get();
        $categories = PracticeCategoryType::where('format', $request['format'])
            ->where('section_type', $request['section_type'])
            ->get();
        return response()->json(['superCategory' => $super_categories, 'categories' => $categories]);
    }

    public function findCategory(Request $request)
    {
        $categories = PracticeCategoryType::where('section_type', $request['section_type'])->get();
        return response()->json(['categories' => $categories]);
    }

    public function addSelfMadeCategory(Request $request)
    {
        PracticeCategoryType::where('id', $request['searchValue'])->update(['selfMade' => 1]);
    }

    public function removeSelfMadeCategory(Request $request)
    {
        PracticeCategoryType::where('id', $request['searchValue'])->update(['selfMade' => 0]);
    }

    public function addSelfMadeQuestionType(Request $request)
    {
        QuestionType::where('id', $request['searchValue'])->update(['selfMade' => 1]);
    }

    public function removeSelfMadeQuestionType(Request $request)
    {
        QuestionType::where('id', $request['searchValue'])->update(['selfMade' => 0]);
    }

    public function addSelfMadeQuestionTag(Request $request)
    {
        QuestionTag::where('id', $request['searchValue'])->update(['selfMade' => 1]);
    }

    public function removeSelfMadeQuestionTag(Request $request)
    {
        QuestionTag::where('id', $request['searchValue'])->update(['selfMade' => 0]);
    }
}
