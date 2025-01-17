<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Helpers\Helper;
use App\Models\Category;
use App\Models\DiffRating;
use App\Models\UserCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PracticeTest;
use App\Models\PracticeTestSection;
use App\Models\PracticeQuestion;
use App\Models\UserAnswers;
use App\Models\Passage;
use App\Models\PracticeCategoryType;
use App\Models\PracticeQuestionNote;
use App\Models\QuestionDetails;
use App\Models\QuestionType;
use App\Models\Score;
use App\Models\SuperCategory;
use App\Models\TestProgress;
use App\Models\TestScore;
use App\Models\User;
use App\Models\UserPracticeTestQuestion;
use App\Models\UserScrollPosition;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Psy\VarDumper\Dumper;

class TestPrepController extends Controller
{
    /* Fetch all event and display in calendar */
    public function get_test_score($testid)
    {
        $user_id = auth()->id();

        $helper = new Helper();
        $sections = PracticeTestSection::join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
            ->select('practice_test_sections.*')
            ->where('practice_tests.id', $testid)
            ->get();

        foreach ($sections as $section) {
            $count_right_question[$section['id']] = [];
            $sectionQuestions = PracticeQuestion::where('practice_test_sections_id', $section['id'])->get();
            $userAnswer = UserAnswers::where('section_id', $section['id'])->where('user_id', $user_id)->get('answer');

            if (isset($userAnswer[0]['answer'])) {
                $decodedUserAnswer = json_decode($userAnswer[0]['answer'], true);

                foreach ($sectionQuestions as $sectionQuestion) {
                    if (isset($decodedUserAnswer[$sectionQuestion['id']])) {
                        if ($sectionQuestion['multiChoice'] == 2) {
                            $correct[$sectionQuestion['id']] = $sectionQuestion['answer'];
                            if ($helper->stringExactMatch($correct[$sectionQuestion['id']], $decodedUserAnswer[$sectionQuestion['id']])) {
                                array_push($count_right_question[$section['id']], $sectionQuestion['id']);
                            }
                        } else {
                            if (str_replace(' ', '', $sectionQuestion['answer']) == str_replace(' ', '', $decodedUserAnswer[$sectionQuestion['id']])) {
                                array_push($count_right_question[$section['id']], $sectionQuestion['id']);
                            }
                        }
                    }
                }
            }
        }

        $section_score = [];
        foreach ($sections as $section) {
            $testId = DB::table('practice_test_sections')
                ->where('id', $section['id'])
                ->value('testid');

            if ($section['practice_test_type'] == 'Math_no_calculator') {
                $other_section = PracticeTestSection::where('testid', $testId)->whereIn('practice_test_type', ['Math_with_calculator', 'Math_no_calculator'])->whereNotIn('id', [$section['id']])->pluck('id')->toArray();
                $other_right = 0;
                foreach ($other_section as $sec) {
                    $other_right += count($count_right_question[$sec]);
                }
                $total_right = count($count_right_question[$section['id']]) + $other_right;
                $scaled_score = Score::where('section_id', $section['id'])->where('actual_score', $total_right)->get('converted_score');
                if (isset($scaled_score[0]['converted_score'])) {
                    $section_score[$section['id']] = $scaled_score[0]['converted_score'];
                } else {
                    $section_score[$section['id']] = 0;
                }
            } else if ($section['practice_test_type'] == 'Math_with_calculator') {
                $other_section = PracticeTestSection::where('testid', $testId)->whereIn('practice_test_type', ['Math_no_calculator', 'Math_with_calculator'])->whereNotIn('id', [$section['id']])->pluck('id')->toArray();
                $other_right = 0;
                foreach ($other_section as $sec) {
                    $other_right += count($count_right_question[$sec]);
                }
                $total_right = count($count_right_question[$section['id']]) + $other_right;
                $scaled_score = Score::where('section_id', $section['id'])->where('actual_score', $total_right)->get('converted_score');
                if (isset($scaled_score[0]['converted_score'])) {
                    $section_score[$section['id']] = $scaled_score[0]['converted_score'];
                } else {
                    $section_score[$section['id']] = 0;
                }
            } else {
                $scaled_sco = Score::where('section_id', $section['id'])->where('actual_score', count($count_right_question[$section['id']]))->get('converted_score');
                if (isset($scaled_sco[0]['converted_score'])) {
                    $section_score[$section['id']] = $scaled_sco[0]['converted_score'];
                } else {
                    $section_score[$section['id']] = 0;
                }
            }
        }

        $scaled_score = 0;
        $math_score = 0;
        foreach ($sections as $section) {
            if ($section['practice_test_type'] == 'Math_no_calculator' || $section['practice_test_type'] == 'Math_with_calculator') {
                $math_score = $section_score[$section['id']];
            } else {
                $scaled_score += $section_score[$section['id']];
            }
        }
        $scaled_score = $scaled_score + ($math_score);
        if (isset($sections[0]['format']) && $sections[0]['format'] == 'ACT') {
            $scaled_score = $scaled_score / ($sections->count());
        } else {
            $scaled_score = $scaled_score;
        }
        return $scaled_score;
    }

    public function get_last_testid($format)
    {
        $user_id = auth()->id();
        $latestTestId = PracticeTest::where('format', $format)
            ->where('user_id', $user_id)
            ->orderBy('updated_at', 'desc')
            ->value('id') ?? 0;
        return $latestTestId;
    }

    public function update_test_type(Request $request)
    {
        // Get the authenticated user's ID
        $user_id = auth()->id();

        $updtvalue = $request->updtvalue;
        $field_value = $request->field_value;

        // Find the user's test score record
        $testScore = TestScore::where('user_id', $user_id)->first();
        if ($testScore) {
            if ($updtvalue == 'primary_test_type') {

                //Get Score of the last test
                $latestTestId = $this->get_last_testid($field_value);
                if ($latestTestId > 0) {
                    $scaled_score = $this->get_test_score($latestTestId);

                    $testScore->primary_test_type = $field_value;
                    $testScore->last_test_score = $scaled_score;
                    $testScore->save();

                    return response()->json(['success' => '1', 'scaled_score' => $scaled_score]);
                } else {
                    $testScore->primary_test_type = $field_value;
                    $testScore->last_test_score = 0;
                    $testScore->save();

                    return response()->json(['success' => '1', 'scaled_score' => 0]);
                }
            } else if ($updtvalue == 'initial_score') {
                $testScore->initial_score = $field_value;
                $testScore->save();
            } else if ($updtvalue == 'goal_score') {
                $testScore->goal_score = $field_value;
                $testScore->save();
            }
        } else {
            $testScore = new TestScore();
            $testScore->user_id = $user_id;
            if ($updtvalue == 'primary_test_type') {

                //Get Score of the last test
                $latestTestId = $this->get_last_testid($field_value);
                $scaled_score = 0;
                if ($latestTestId > 0) {
                    $scaled_score = $this->get_test_score($latestTestId);
                }
                $testScore->primary_test_type = $field_value;
                $testScore->initial_score = 0;
                $testScore->last_test_score = $scaled_score;
                $testScore->goal_score = 0;
                $testScore->save();

                return response()->json(['success' => '1', 'scaled_score' => $scaled_score]);
            } else if ($updtvalue == 'initial_score') {
                $testScore->primary_test_type = '';
                $testScore->initial_score = $field_value;
                $testScore->last_test_score = 0;
                $testScore->goal_score = 0;
            } else if ($updtvalue == 'goal_score') {
                $testScore->primary_test_type = '';
                $testScore->initial_score = 0;
                $testScore->last_test_score = 0;
                $testScore->goal_score = $field_value;
            }
            $testScore->save();
        }

        return response()->json('success');
    }

    /* Find color by color class */

    public function findColor($color)
    {
        if ($color == "info") {
            $c_code = "#0891b2";
        } else if ($color == "warning") {
            $c_code = "#e04f1a";
        } else if ($color == "success") {
            $c_code = "#82b54b";
        } else if ($color == "danger") {
            $c_code = "#dc2626";
        } else {
            $c_code = "#4c78dd";
        }

        return $c_code;
    }

    public function array_flatten($array)
    {
        $return = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return = $return + $this->array_flatten($value);
            } else {
                $return[$key] = $value;
            }
        }
        return $return;
    }

    public function singleReview(Request $request, $test, $id)
    {
        $current_user_id = Auth::id();
        $practice_test_section_id = $id;
        $get_test_name = $test;
        $category_data = array();
        $percentage_arr_all = array();
        $store_sections_details = array();
        $categoryTypeData = [];
        $questionTypeData = [];
        $count = 0;
        $checkboxData = [];

        if (isset($_GET['test_id']) && !empty($_GET['test_id'])) {
            $test_id = $_GET['test_id'];
            $test_category_type = DB::table('practice_questions')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->select('category_type', 'question_type_id')
                ->where('practice_test_sections.testid', $test_id)
                ->get();

            $test_details = PracticeTest::find($test_id);

            if ($_GET['type'] == 'all') {
                $store_all_data = array();
                $question_tags_all = [];
                $store_question_type_data = array();
                $check_question_answers = [];
                $get_test_questions = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select(
                        'practice_questions.id as test_question_id',
                        'practice_questions.question_type_id',
                        'practice_questions.category_type',
                        'practice_questions.mistake_type',
                        'practice_questions.tags as tags',
                        'practice_questions.answer as answer',
                        'practice_questions.category_type_values as category_type_values',
                        'practice_questions.question_type_values as question_type_values',
                        'practice_questions.checkbox_values as checkbox_values',
                        // 'practice_questions.notes',
                    )
                    ->where('practice_tests.id', $test_id)
                    ->orderBy('practice_questions.question_order', 'ASC')
                    ->get();

                foreach ($get_test_questions as $question) {
                    $questionDetails = QuestionDetails::where("question_id", $question->test_question_id)->get();
                    $questionTypeData[$question->test_question_id] = json_decode($question->question_type_values ?? '', true);
                    $categoryTypeData[$question->test_question_id] = json_decode($question->category_type_values ?? '', true);
                    $checkboxData[$question->test_question_id] = json_decode($question->checkbox_values ?? '', true);
                }

                $user_answers_data = DB::table('user_answers')
                    ->where('user_id', $current_user_id)
                    ->where('test_id', $test_id)
                    ->latest()
                    ->get();
                $answer_arr = [];
                foreach ($user_answers_data as $user_answer) {
                    $answers = json_decode($user_answer->answer, true);
                    $answer_arr[] = $answers;
                }
                $answer_arr = $this->array_flatten($answer_arr);
                foreach ($get_test_questions as $question) {
                    if (isset($answer_arr[$question->test_question_id])  && !empty($answer_arr[$question->test_question_id])) {
                        if ($answer_arr[$question->test_question_id] == $question->answer) {
                            $check_question_answers[$question->test_question_id] = true;
                        } else {
                            $check_question_answers[$question->test_question_id] = false;
                        }
                    }
                }

                if (!$get_test_questions->isEmpty()) {
                    $percentage_arr_all = [];

                    foreach ($get_test_questions as $get_single_test_questions) {
                        $questionDetails = QuestionDetails::where("question_id", $get_single_test_questions->test_question_id)->get(['question_type', 'category_type'])->toArray();

                        $array_ques_type = array_map(function ($item) {
                            return $item['question_type'];
                        }, $questionDetails);

                        $array_cat_type = array_map(function ($item) {
                            return $item['category_type'];
                        }, $questionDetails);

                        $percentage_arr = [];

                        if (isset($array_cat_type) && !empty($array_cat_type) && isset($array_ques_type) && !empty($array_ques_type)) {
                            $mergedArray = [];

                            for ($i = 0; $i < count($array_ques_type); $i++) {
                                $mergedArray[$i] = [
                                    'category_type' => $array_cat_type[$i],
                                    'question_type' => $array_ques_type[$i]
                                ];
                            }

                            foreach ($check_question_answers as $q_id => $check_question_answer) {
                                if ($get_single_test_questions->test_question_id == $q_id) {
                                    $percentage_arr = [
                                        $q_id => $check_question_answer
                                    ];
                                }
                            }

                            foreach ($mergedArray as $type) {
                                $get_cat_name_by_id = DB::table('practice_category_types')
                                    ->where('id', $type['category_type'])
                                    ->get();

                                $get_ques_type_name_by_id = DB::table('question_types')
                                    ->where('id', $type['question_type'])
                                    ->get();

                                if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                    $percentage_arr_all[$get_cat_name_by_id[0]->category_type_title][] = $percentage_arr;
                                    $question_tags_all[$get_cat_name_by_id[0]->category_type_title][] = isset($get_single_test_questions->tags) ? explode(",", $get_single_test_questions->tags) : [];
                                }
                                if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title) && isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title)) {
                                    $store_all_data[$get_cat_name_by_id[0]->category_type_title][$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }

                        if (isset($array_ques_type) && !empty($array_ques_type)) {
                            foreach ($array_ques_type as $single_ques_type) {
                                $get_ques_type_name_by_id = DB::table('question_types')
                                    ->where('id', $single_ques_type)
                                    ->get();

                                if (isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title) && isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                    $store_question_type_data[$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }
                    }
                }
            } else if ($_GET['type'] == 'single') {

                $store_all_data = array();
                $question_tags = [];
                $check_question_answers = [];
                $store_question_type_data = array();
                $get_test_questions = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->select(
                        'practice_questions.id as test_question_id',
                        'practice_questions.category_type',
                        'practice_questions.mistake_type',
                        'practice_questions.tags as tags',
                        'practice_questions.answer as answer',
                        'practice_questions.category_type_values as category_type_values',
                        'practice_questions.question_type_values as question_type_values',
                        'practice_questions.checkbox_values as checkbox_values',
                        // 'practice_questions.notes',
                    )
                    ->where('practice_test_sections.id', $id)
                    ->orderBy('practice_questions.question_order', 'ASC')
                    ->get();

                $user_answers_data = DB::table('user_answers')
                    ->where('user_id', $current_user_id)
                    ->where('section_id', $id)
                    ->latest()
                    ->get();
                foreach ($get_test_questions as $question) {
                    $questionDetails = QuestionDetails::where("question_id", $question->test_question_id)->get();
                    $questionTypeData[$question->test_question_id] = json_decode($question->question_type_values ?? '', true);
                    $categoryTypeData[$question->test_question_id] = json_decode($question->category_type_values ?? '', true);
                    $checkboxData[$question->test_question_id] = json_decode($question->checkbox_values ?? '', true);
                }
                $answer_arr = [];
                foreach ($user_answers_data as $user_answer) {
                    $answers = json_decode($user_answer->answer, true);
                    $answer_arr[] = $answers;
                }
                $answer_arr = $this->array_flatten($answer_arr);
                foreach ($get_test_questions as $question) {
                    if (isset($answer_arr[$question->test_question_id])  && !empty($answer_arr[$question->test_question_id])) {
                        if ($answer_arr[$question->test_question_id] == $question->answer) {
                            $check_question_answers[$question->test_question_id] = true;
                        } else {
                            $check_question_answers[$question->test_question_id] = false;
                        }
                    } else {
                        $check_question_answers[$question->test_question_id] = false;
                    }
                }

                $get_all_cat_type = DB::table('practice_category_types')->get();

                if (!$get_test_questions->isEmpty()) {
                    $percentage_arr_all = [];
                    foreach ($get_test_questions as $get_single_test_questions) {

                        $questionDetails = QuestionDetails::where("question_id", $get_single_test_questions->test_question_id)->get(['question_type', 'category_type'])->toArray();

                        $array_ques_type = array_map(function ($item) {
                            return $item['question_type'];
                        }, $questionDetails);

                        // $array_cat_type = json_decode($get_single_test_questions->category_type, true);
                        $array_cat_type = array_map(function ($item) {
                            return $item['category_type'];
                        }, $questionDetails);

                        if (isset($array_cat_type) && !empty($array_cat_type) && isset($array_ques_type) && !empty($array_ques_type)) {
                            $mergedArray = [];
                            for ($i = 0; $i < count($array_ques_type); $i++) {
                                $mergedArray[$i] = [
                                    'category_type' => $array_cat_type[$i],
                                    'question_type' => $array_ques_type[$i]
                                ];
                            }

                            foreach ($check_question_answers as $q_id => $check_question_answer) {
                                if ($get_single_test_questions->test_question_id == $q_id) {
                                    $percentage_arr = [
                                        $q_id => $check_question_answer
                                    ];
                                }
                            }

                            foreach ($mergedArray as $type) {
                                $get_cat_name_by_id = DB::table('practice_category_types')
                                    ->where('id', $type['category_type'])
                                    ->get();

                                $get_ques_type_name_by_id = DB::table('question_types')
                                    ->where('id', $type['question_type'])
                                    ->get();
                                if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                    $percentage_arr_all[$get_cat_name_by_id[0]->category_type_title][] = $percentage_arr;
                                    $question_tags[$get_cat_name_by_id[0]->category_type_title] = isset($get_single_test_questions->tags) ? explode(",", $get_single_test_questions->tags) : [];
                                }
                                if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title) && isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title)) {
                                    $store_all_data[$get_cat_name_by_id[0]->category_type_title][$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }

                        if (isset($array_ques_type) && !empty($array_ques_type)) {
                            foreach ($array_ques_type as $single_ques_type) {
                                $get_ques_type_name_by_id = DB::table('question_types')
                                    ->where('id', $single_ques_type)
                                    ->get();
                                if (isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title) && isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                    $store_question_type_data[$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_description' => $get_cat_name_by_id[0]->category_type_description, 'category_title' => $get_cat_name_by_id[0]->category_type_title, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }
                    }
                }
            }
        }
        if (isset($_GET['type']) && !empty($_GET['type'])) {
            $helper = new Helper();
            if ($_GET['type'] == 'all') {
                $get_all_section = DB::table('practice_test_sections')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_test_sections.*')
                    ->where('practice_tests.id', $id)
                    ->get();

                if (!$get_all_section->isEmpty()) {
                    foreach ($get_all_section as $get_single_section) {

                        $user_selected_answers = DB::table('user_answers')
                            ->where('user_id', $current_user_id)
                            ->where('section_id', $get_single_section->id)
                            ->latest()
                            ->get();

                        if (isset($user_selected_answers[0]) && !empty($user_selected_answers[0])) {
                            $decoded_answers = [];
                            $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
                            $question_order = PracticeQuestion::where('practice_test_sections_id', $get_single_section->id)->orderBy('question_order', 'ASC')->pluck('id')->toArray();

                            if (isset($question_order) && !empty($question_order)) {
                                foreach ($question_order as $order) {
                                    if (isset($json_decoded_answers->{$order})) {
                                        $decoded_answers[$order] = $json_decoded_answers->{$order};
                                    } else {
                                        $decoded_answers[$order] = '';
                                    }
                                }
                            }
                            $json_decoded_guess = json_decode($user_selected_answers[0]->guess);
                            $json_decoded_flag = json_decode($user_selected_answers[0]->flag);
                            $json_decoded_skip = json_decode($user_selected_answers[0]->skip);

                            foreach ($decoded_answers as $question_id => $json_decoded_single_answers) {
                                $get_question_details = DB::table('practice_questions')
                                    // ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                                    ->select(
                                        'practice_questions.id as question_id',
                                        'practice_questions.practice_test_sections_id as section_id',
                                        'practice_questions.title as question_title',
                                        'practice_questions.type as practice_type',
                                        'practice_questions.mistake_type as mistake_type',
                                        'practice_questions.answer as question_answer',
                                        'practice_questions.answer_content as question_answer_options',
                                        'practice_questions.multiChoice as is_multiple_choice',
                                        'practice_questions.question_order',
                                        'practice_questions.passages_id',
                                        'practice_questions.tags',
                                        'passages.title',
                                        // 'practice_questions.notes',
                                        'passages.description',
                                        'practice_questions.category_type as category_type',
                                        'practice_questions.question_type_id as question_type_id',
                                        'practice_questions.answer_exp as answer_exp'
                                    )
                                    ->where('practice_questions.id', $question_id)
                                    ->leftJoin("passages", "passages.id", "=", "practice_questions.passages_id")
                                    ->orderBy('practice_questions.question_order', 'ASC')
                                    ->get();

                                $store_sections_details[] = array(
                                    'user_selected_answer' => $json_decoded_single_answers,
                                    'user_selected_guess' => $json_decoded_guess->$question_id ?? '',
                                    'user_selected_flag' => $json_decoded_flag->$question_id ?? '',
                                    'user_selected_skip' => $json_decoded_skip->$question_id ?? '',
                                    'get_question_details' => $get_question_details,
                                    'all_sections' => $get_all_section,
                                    'date_taken' => $user_selected_answers,
                                    'type' => $_GET['type']
                                );
                            }
                        }
                    }
                }
            } else if ($_GET['type'] == 'single') {
                $user_selected_answers = DB::table('user_answers')
                    ->where('user_id', $current_user_id)
                    ->where('section_id', $id)
                    ->latest()
                    ->get();
                $test_section = PracticeTestSection::where('testid', $test_details->id)->where('id', $id)->get();
                $store_user_answers_details = array();
                if (isset($user_selected_answers[0]) && !empty($user_selected_answers[0])) {
                    $decoded_answers = [];
                    $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
                    $question_order = PracticeQuestion::where('practice_test_sections_id', $id)->orderBy('question_order', 'ASC')->pluck('id')->toArray();

                    if (isset($question_order) && !empty($question_order)) {
                        foreach ($question_order as $order) {
                            if (isset($json_decoded_answers->{$order})) {
                                $decoded_answers[$order] = $json_decoded_answers->{$order};
                            } else {
                                $decoded_answers[$order] = '';
                            }
                        }
                    }
                    $json_decoded_guess = json_decode($user_selected_answers[0]->guess);
                    $json_decoded_flag = json_decode($user_selected_answers[0]->flag);
                    $json_decoded_skip = json_decode($user_selected_answers[0]->skip);
                    foreach ($decoded_answers as $question_id => $json_decoded_single_answers) {
                        $get_question_details = DB::table('practice_questions')
                            // ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                            ->select(
                                'practice_questions.id as question_id',
                                'practice_questions.practice_test_sections_id as section_id',
                                'practice_questions.title as question_title',
                                'practice_questions.type as practice_type',
                                'practice_questions.answer as question_answer',
                                'practice_questions.answer_content as question_answer_options',
                                'practice_questions.multiChoice as is_multiple_choice',
                                'practice_questions.question_order',
                                'practice_questions.mistake_type',
                                'practice_questions.tags',
                                'practice_questions.passages_id',
                                'passages.title',
                                // 'practice_questions.notes',
                                'passages.description',
                                'practice_questions.category_type as category_type',
                                'practice_questions.question_type_id as question_type_id',
                                'practice_questions.answer_exp as answer_exp'
                            )
                            ->where('practice_questions.id', $question_id)
                            ->leftJoin("passages", "passages.id", "=", "practice_questions.passages_id")
                            ->orderBy('practice_questions.question_order', 'ASC')
                            ->get();

                        $store_sections_details[] = array(
                            'user_selected_answer' => $json_decoded_single_answers,
                            'user_selected_guess' => (isset($json_decoded_guess) && !empty($json_decoded_guess)) ? $json_decoded_guess->$question_id ?? '' : null,
                            'user_selected_flag' => (isset($json_decoded_flag) && !empty($json_decoded_flag)) ? $json_decoded_flag->$question_id ?? '' : null,
                            'user_selected_skip' => (isset($json_decoded_skip) && !empty($json_decoded_skip)) ? $json_decoded_skip->$question_id ?? '' : null,
                            'get_question_details' => $get_question_details,
                            'sections' => $test_section,
                            'date_taken' => $user_selected_answers,
                            'type' => $_GET['type']
                        );
                    }
                }
            }
        }
        if ($_GET['type'] == 'all') {
            $question_tags = [];
            foreach ($question_tags_all as $key => $question_tag) {
                $question_tags[$key] = array_unique(Arr::flatten($question_tag));
            }
        }
        foreach ($percentage_arr_all as $key => $percentage) {
            $correct_ans = 0;
            $wrong_ans = 0;
            $total_question = $this->array_flatten(array_map("unserialize", array_unique(array_map("serialize", $percentage))));
            $count = count($total_question);
            $allCorrect = true;
            foreach ($total_question as $value) {
                if ($value == true) {
                    $correct_ans++;
                }

                if ($value == false) {
                    $allCorrect = false;
                    $wrong_ans++;
                }
            }
            if ($count !== 0) {
                $percentage_arr_all[$key] = [
                    "correct_ans" => $correct_ans,
                    "wrong_ans" => $wrong_ans,
                    "percentage" => 100 * $wrong_ans / $count . '%',
                    "percentage_label" => ($correct_ans > $wrong_ans ? $correct_ans : $wrong_ans) . "/" . $count . ($correct_ans > $wrong_ans ? ' Correct' : ' Incorrect'),
                    "all_correct" => $allCorrect
                ];
                if ($allCorrect) {
                    $percentage_arr_all[$key]['percentage_label'] = 'No Incorrect Answer';
                }
            }
        }
        foreach ($store_sections_details as $store_sections_detail) {
            if ($_GET['type'] == "single") {
                $section_id = $store_sections_detail['get_question_details'][0]->section_id;
                $section_type = $store_sections_detail['sections'][0]->practice_test_type;
                $count_right_answer[$section_id][$section_type] = [];
                $count_total_question[$section_id][$section_type] = [];
            } else {
                foreach ($store_sections_detail['all_sections'] as $section) {
                    // $section_id = $store_sections_detail['get_question_details'][0]->section_id;
                    $section_id = $section->id;
                    $section_type = $section->practice_test_type;
                    $count_right_answer[$section_id][$section_type] = [];
                    $count_total_question[$section_id][$section_type] = [];
                }
            }
        }

        foreach ($store_sections_details as $store_sections_detail) {
            if ($_GET['type'] == "single") {
                if (isset($store_sections_detail['user_selected_answer']) && !empty($store_sections_detail['user_selected_answer']) && isset($store_sections_detail['get_question_details'][0]->question_answer) && !empty($store_sections_detail['get_question_details'][0]->question_answer)) {
                    if ($store_sections_detail['get_question_details'][0]->is_multiple_choice == 2) {
                        $correct_answer[$id] =  $store_sections_detail['get_question_details'][0]->question_answer;
                        // if(in_array(str_replace(' ','',$store_sections_detail['user_selected_answer']),$correct_answer) || in_array(str_replace(' ','',$store_sections_detail['user_selected_answer']),explode(',',$correct_answer[$id])) || Str::contains($correct_answer[$id],explode(',',str_replace(' ','',$store_sections_detail['user_selected_answer'])))){
                        if ($helper->stringExactMatch($correct_answer[$id], $store_sections_detail['user_selected_answer'])) {
                            $section_id = $store_sections_detail['get_question_details'][0]->section_id;
                            $section_type = $store_sections_detail['sections'][0]->practice_test_type;
                            array_push($count_right_answer[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                            array_push($count_total_question[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                        } else {
                            array_push($count_total_question[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                        }
                    } else {
                        if (str_replace(' ', '', $store_sections_detail['user_selected_answer']) == str_replace(' ', '', $store_sections_detail['get_question_details'][0]->question_answer)) {
                            $section_id = $store_sections_detail['get_question_details'][0]->section_id;
                            $section_type = $store_sections_detail['sections'][0]->practice_test_type;
                            array_push($count_right_answer[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                            array_push($count_total_question[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                        } else {
                            array_push($count_total_question[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                        }
                    }
                }
            } else {
                if (isset($store_sections_detail['user_selected_answer']) && !empty($store_sections_detail['user_selected_answer']) && isset($store_sections_detail['get_question_details'][0]->question_answer) && !empty($store_sections_detail['get_question_details'][0]->question_answer)) {
                    foreach ($store_sections_detail['all_sections'] as $section) {
                        $section_id = $section->id;
                        $section_type = $section->practice_test_type;
                        if ($section_id == $store_sections_detail['get_question_details'][0]->section_id) {
                            if ($store_sections_detail['get_question_details'][0]->is_multiple_choice == 2) {
                                $correct_answer[$section_id] =  $store_sections_detail['get_question_details'][0]->question_answer;
                                // if(in_array(str_replace(' ','',$store_sections_detail['user_selected_answer']),explode(',',$correct_answer[$section_id])) || in_array(str_replace(' ','',$store_sections_detail['user_selected_answer']),$correct_answer) || Str::contains($correct_answer[$section_id],explode(',',str_replace(' ','',$store_sections_detail['user_selected_answer'])))){
                                if ($helper->stringExactMatch($correct_answer[$section_id], $store_sections_detail['user_selected_answer'])) {
                                    array_push($count_right_answer[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                                    array_push($count_total_question[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                                } else {
                                    array_push($count_total_question[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                                }
                            } else {
                                if (str_replace(' ', '', $store_sections_detail['user_selected_answer']) == str_replace(' ', '', $store_sections_detail['get_question_details'][0]->question_answer)) {
                                    array_push($count_right_answer[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                                    array_push($count_total_question[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                                } else {
                                    array_push($count_total_question[$section_id][$section_type], $store_sections_detail['get_question_details'][0]->question_id);
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($_GET['type'] == "single") {
            $right_answer = count($count_right_answer[$id][$store_sections_detail['sections'][0]['practice_test_type']]);
            $scaled_score = Score::where(['section_id' => $id, 'actual_score' => $right_answer])->get('converted_score');
            if (isset($scaled_score[0]['converted_score'])) {
                $total_scaled_score[$id][$store_sections_detail['sections'][0]['practice_test_type']] = $scaled_score[0]['converted_score'];
            } else {
                $total_scaled_score[$id][$store_sections_detail['sections'][0]['practice_test_type']] = 0;
            }
        } else {
            foreach ($store_sections_details as $store_sections_detail) {
                $old_section_id = 0;
                foreach ($store_sections_detail['all_sections'] as $section) {
                    $section_id = $section->id;
                    $section_type = $section->practice_test_type;
                    $total_scaled_score[$section_id][$section_type] = [];
                    //new
                    if ($section_type == 'Math_no_calculator') {
                        $total_other_right = 0;
                        $other_section = PracticeTestSection::where('testid', $id)->where('practice_test_type', 'Math_with_calculator')->get();
                        foreach ($other_section as $sec) {
                            $total_other_right += count($count_right_answer[$sec['id']][$sec['practice_test_type']]);
                        }
                        $total_right = $total_other_right + count($count_right_answer[$section_id][$section_type]);
                        $converted_score = Score::where('section_id', $section_id)->where('actual_score', $total_right)->get('converted_score');
                        if (isset($converted_score[0]['converted_score'])) {
                            array_push($total_scaled_score[$section_id][$section_type], $converted_score[0]['converted_score']);
                        } else {
                            array_push($total_scaled_score[$section_id][$section_type], 0);
                        }
                    } else if ($section_type == 'Math_with_calculator') {
                        $total_other_right = 0;
                        $other_section = PracticeTestSection::where('testid', $id)->where('practice_test_type', 'Math_no_calculator')->get();
                        foreach ($other_section as $sec) {
                            $total_other_right += count($count_right_answer[$sec['id']][$sec['practice_test_type']]);
                        }
                        $total_right = $total_other_right + count($count_right_answer[$section_id][$section_type]);
                        $converted_score = Score::where('section_id', $section_id)->where('actual_score', $total_right)->get('converted_score');
                        if (isset($converted_score[0]['converted_score'])) {
                            array_push($total_scaled_score[$section_id][$section_type], $converted_score[0]['converted_score']);
                        } else {
                            array_push($total_scaled_score[$section_id][$section_type], 0);
                        }
                    } else {
                        $right_answer = count($count_right_answer[$section_id][$section_type]);
                        $scaled_score = Score::where(['section_id' => $section_id, 'actual_score' => $right_answer])->get('converted_score');
                        if ($old_section_id != $section_id && isset($scaled_score[0]['converted_score'])) {
                            array_push($total_scaled_score[$section_id][$section_type], $scaled_score[0]['converted_score']);
                        } else {
                            array_push($total_scaled_score[$section_id][$section_type], 0);
                        }
                        $old_section_id = $section_id;
                    }
                }
            }
        }

        if ($test_details->format == 'ACT') {
            if ($_GET['type'] == 'single') {
                $section_type = $store_sections_detail['sections'][0]['practice_test_type'];
                $right_answers = count($count_right_answer[$id][$section_type]);
                $total_questions = count($count_total_question[$id][$section_type]);
                $scaled_score = $total_scaled_score[$id][$section_type];
            } else {
                $right_answers = 0;
                $total_questions = 0;
                $scaled_scores = 0;
                $count = 0;
                foreach ($store_sections_detail['all_sections'] as $section) {
                    $count++;
                    $section_id = $section->id;
                    $section_type = $section->practice_test_type;
                    $right_answers += count($count_right_answer[$section->id][$section->practice_test_type]);
                    $total_questions += count($count_total_question[$section->id][$section->practice_test_type]);
                    $scaled_scores += $total_scaled_score[$section->id][$section->practice_test_type][0];
                }
                $scaled_score = $scaled_scores / $count;
            }
        } else {
            if ($_GET['type'] == 'single') {
                $section_type = $store_sections_detail['sections'][0]['practice_test_type'];
                if ($section_type == 'Math_no_calculator') {
                    $test_id = $test_details->id;
                    $sections = PracticeTestSection::where('testid', $test_id)->where('practice_test_type', 'Math_with_calculator')->get();
                    if (isset($sections[0]->id)) {
                        $section_id = $sections[0]->id;
                        $questions = PracticeQuestion::where('practice_test_sections_id', $section_id)->get();

                        foreach ($questions as $question) {
                            $questionDetails = QuestionDetails::where("question_id", $question->test_question_id)->get();

                            foreach ($questionDetails as $value) {
                                # code...
                                $superCategory = SuperCategory::find($value->super_category);
                                $categoryType = PracticeCategoryType::find($value->category_type);
                                $questionType = QuestionType::find($value->question_type);
                                $category_data[$question->id][] = [
                                    'superCategory' => $superCategory,
                                    'categoryType' => $categoryType,
                                    'questionType' => $questionType
                                ];
                            }
                        }

                        $question_count = $questions->count();
                        $answer_data = UserAnswers::where('section_id', $section_id)->where('user_id', $current_user_id)->get();
                        $count_right_answer[$section_id][$sections[0]->practice_test_type] = [];
                        $total_scaled_score[$section_id][$sections[0]->practice_test_type] = [];
                        if (isset($answer_data[0]->answer)) {
                            $decode_answers = json_decode($answer_data[0]->answer, true);
                            foreach ($questions as $question) {
                                if ($question['multiChoice'] == 2) {
                                    $correct[$question['id']] = $question['answer'];
                                    // if( in_array(str_replace(' ','',$decode_answers[$question['id']]),$correct) || in_array(str_replace(' ','',$decode_answers[$question['id']]),explode(',',$correct[$question['id']])) || Str::contains($correct[$question['id']],explode(',',str_replace(' ','',$decode_answers[$question['id']])))){
                                    if ($helper->stringExactMatch($correct[$question['id']], $decode_answers[$question['id']])) {
                                        array_push($count_right_answer[$section_id][$sections[0]->practice_test_type], $question->id);
                                    }
                                } else {
                                    if (isset($decode_answers[$question->id])) {
                                        if (str_replace(' ', '', $question->answer) == str_replace(' ', '', $decode_answers[$question->id])) {
                                            array_push($count_right_answer[$section_id][$sections[0]->practice_test_type], $question->id);
                                        }
                                    }
                                }
                            }
                            $count_right = count($count_right_answer[$section_id][$sections[0]->practice_test_type]) + count($count_right_answer[$id][$section_type]);
                            $scaled_for_math = Score::where('section_id', $id)->where('actual_score', $count_right)->get('converted_score');
                            if (isset($scaled_for_math[0]['converted_score']) && !empty($scaled_for_math[0]['converted_score'])) {
                                array_push($total_scaled_score[$section_id][$sections[0]->practice_test_type], $scaled_for_math[0]['converted_score']);
                            } else {
                                array_push($total_scaled_score[$section_id][$sections[0]->practice_test_type], 0);
                            }
                            $total_questions = count($count_total_question[$id][$section_type]) + $question_count;
                            $right_answers = $count_right;
                            $scaled_score = $total_scaled_score[$section_id][$sections[0]->practice_test_type][0];
                        } else {
                            $total_questions = count($count_total_question[$id][$section_type]) + (isset($question_count) ? $question_count : 0);
                            $right_answers = count($count_right_answer[$id][$section_type]);
                            $scaled_score = $total_scaled_score[$id][$section_type];
                        }
                    } else {
                        $total_questions = count($count_total_question[$id][$section_type]);
                        $right_answers = count($count_right_answer[$id][$section_type]);
                        $scaled_score = $total_scaled_score[$id][$section_type];
                    }
                } else if ($section_type == 'Math_with_calculator') {
                    $test_id = $test_details->id;
                    $sections = PracticeTestSection::where('testid', $test_id)->where('practice_test_type', 'Math_no_calculator')->get();
                    if (isset($sections[0]->id)) {
                        $section_id = $sections[0]->id;
                        $questions = PracticeQuestion::where('practice_test_sections_id', $section_id)->get();
                        $question_count = $questions->count();
                        $answer_data = UserAnswers::where('section_id', $section_id)->where('user_id', $current_user_id)->get();
                        if (isset($answer_data[0]->answer)) {
                            $count_right_answer[$section_id][$sections[0]->practice_test_type] = [];
                            $total_scaled_score[$section_id][$sections[0]->practice_test_type] = [];
                            $decode_answers = json_decode($answer_data[0]->answer, true);
                            foreach ($questions as $question) {
                                if ($question['multiChoice'] == 2) {
                                    $correct[$question['id']] = $question['answer'];
                                    // if( in_array(str_replace(' ','',$decode_answers[$question['id']]),$correct) || in_array(str_replace(' ','',$decode_answers[$question['id']]),explode(',',$correct[$question['id']])) || Str::contains($correct[$question['id']],explode(',',str_replace(' ','',$decode_answers[$question['id']])))){
                                    if ($helper->stringExactMatch($correct[$question['id']], $decode_answers[$question['id']])) {
                                        array_push($count_right_answer[$section_id][$sections[0]->practice_test_type], $question->id);
                                    }
                                } else {
                                    if (str_replace(' ', '', $question->answer) == str_replace(' ', '', $decode_answers[$question->id])) {
                                        array_push($count_right_answer[$section_id][$sections[0]->practice_test_type], $question->id);
                                    }
                                }
                            }
                            $count_right = count($count_right_answer[$section_id][$sections[0]->practice_test_type]) + count($count_right_answer[$id][$section_type]);
                            $scaled_for_math = Score::where('section_id', $id)->where('actual_score', $count_right)->get('converted_score');
                            if (isset($scaled_for_math[0]['converted_score']) && !empty($scaled_for_math[0]['converted_score'])) {
                                array_push($total_scaled_score[$section_id][$sections[0]->practice_test_type], $scaled_for_math[0]['converted_score']);
                            } else {
                                array_push($total_scaled_score[$section_id][$sections[0]->practice_test_type], 0);
                            }
                            $total_questions = count($count_total_question[$id][$section_type]) + $question_count;
                            $right_answers = $count_right;
                            $scaled_score = $total_scaled_score[$section_id][$sections[0]->practice_test_type][0];
                        } else {
                            $total_questions = count($count_total_question[$id][$section_type]) + (isset($question_count) ? $question_count : 0);
                            $right_answers = count($count_right_answer[$id][$section_type]);
                            $scaled_score = $total_scaled_score[$id][$section_type];
                        }
                    } else {
                        $total_questions = count($count_total_question[$id][$section_type]);
                        $right_answers = count($count_right_answer[$id][$section_type]);
                        $scaled_score = $total_scaled_score[$id][$section_type];
                    }
                } else {
                    $right_answers = count($count_right_answer[$id][$section_type]);
                    $total_questions = count($count_total_question[$id][$section_type]);
                    $scaled_score = $total_scaled_score[$id][$section_type];
                }
            } else {
                $right_answers = 0;
                $total_questions = 0;
                $scaled_scores = 0;
                $math_scaled_score = 0;
                foreach ($store_sections_detail['all_sections'] as $section) {
                    $section_id = $section->id;
                    $section_type = $section->practice_test_type;
                    $right_answers += count($count_right_answer[$section_id][$section_type]);
                    $total_questions += count($count_total_question[$section_id][$section_type]);
                    if ($section->practice_test_type == 'Math_no_calculator' || $section->practice_test_type == 'Math_with_calculator') {
                        $math_scaled_score = $total_scaled_score[$section_id][$section_type][0];
                    } else {
                        $scaled_scores += $total_scaled_score[$section_id][$section_type][0];
                    }
                }

                if ($count > 0) {
                    $scaled_score = $scaled_scores + $math_scaled_score;
                } else {
                    $scaled_score = $scaled_scores;
                }
            }
        }

        if ($_GET['type'] == 'all') {
            $high_score = 0;
            $low_score = 0;
            if (Score::where('test_id', $test_details['id'])->exists()) {
                $section_id_array = PracticeTestSection::where('testid', $test_details['id'])->pluck('id')->toArray();
                foreach ($section_id_array as $section) {
                    $section_type = PracticeTestSection::where('id', $section)->value('practice_test_type');
                    if ($section_type == 'Math_with_calculator' && Score::where('test_id', $test_details['id'])->where('section_type', 'Math_no_calculator')->exists()) {
                        continue;
                    }
                    $ind_high_score = Score::where('section_id', $section)->max('converted_score');
                    $ind_low_score = Score::where('section_id', $section)->min('converted_score');
                    if (isset($ind_high_score) && isset($ind_low_score)) {
                        $high_score += $ind_high_score;
                        $low_score += $ind_low_score;
                    } else {
                        $high_score += 0;
                        $low_score += 0;
                    }
                }
            } else {
                $high_score = 0;
                $low_score = 0;
            }
        } else {
            if (Score::where('section_id', $id)->exists()) {
                if ($test_details['test_source'] == 1 && ($test_details['format'] == 'DSAT' || $test_details['format'] == 'DPSAT')) {
                    $high_reading_score = Score::where('test_id', $test_details['id'])
                        ->where(function ($query) {
                            $query->where('section_type', 'Reading_And_Writing')
                                ->orWhere('section_type', 'Easy_Reading_And_Writing')
                                ->orWhere('section_type', 'Hard_Reading_And_Writing');
                        })
                        ->max('converted_score');
                    $low_reading_score = Score::where('test_id', $test_details['id'])
                        ->where(function ($query) {
                            $query->where('section_type', 'Reading_And_Writing')
                                ->orWhere('section_type', 'Easy_Reading_And_Writing')
                                ->orWhere('section_type', 'Hard_Reading_And_Writing');
                        })
                        ->min('converted_score');

                    $high_math_score = Score::where('test_id', $test_details['id'])
                        ->where(function ($query) {
                            $query->where('section_type', 'Math')
                                ->orWhere('section_type', 'Math_with_calculator')
                                ->orWhere('section_type', 'Math_no_calculator');
                        })
                        ->max('converted_score');
                    $low_math_score = Score::where('test_id', $test_details['id'])
                        ->where(function ($query) {
                            $query->where('section_type', 'Math')
                                ->orWhere('section_type', 'Math_with_calculator')
                                ->orWhere('section_type', 'Math_no_calculator');
                        })
                        ->min('converted_score');
                    $high_score = 0;
                    $low_score = 0;
                } else {
                    $high_score = Score::where('section_id', $id)->max('converted_score');
                    $low_score = Score::where('section_id', $id)->min('converted_score');
                }
                // $high_score = Score::where('section_id', $id)->max('converted_score');
                // $low_score = Score::where('section_id', $id)->min('converted_score');

            } else {
                $high_score = 0;
                $low_score = 0;
                $high_reading_score = 0;
                $low_reading_score = 0;
                $high_math_score = 0;
                $low_math_score = 0;
            }
        }

        if ($_GET['type'] == 'all' && $test_details['format'] == 'ACT') {
            $high_score = $high_score / (count($store_sections_detail['all_sections']) == 0 ? 1 : count($store_sections_detail['all_sections']));
            $low_score = $low_score / (count($store_sections_detail['all_sections']) == 0 ? 1 : count($store_sections_detail['all_sections']));
        } elseif ($test_details['test_source'] == 1 && ($test_details['format'] == 'DSAT' || $test_details['format'] == 'DPSAT')) {
            $high_reading_score = $high_reading_score;
            $low_reading_score =  $low_reading_score;
            $high_math_score = $high_math_score;
            $low_math_score = $low_math_score;
        } else {
            $high_score = $high_score;
            $low_score = $low_score;
            $high_reading_score = 0;
            $low_reading_score = 0;
            $high_math_score = 0;
            $low_math_score = 0;
        }

        $checkData = [];
        $ctData = [];
        // dd($categoryTypeData);
        foreach ($categoryTypeData as $key => $catData) {
            $initializedValues = [];

            foreach ($catData as $catKey => $cat) {
                $answer_arr = $answer_arr ?? [];

                // if ($key && array_key_exists($key, $answer_arr) && $answer_arr[$key] == "-") {
                //     // Replace "-" with $catKey value
                //     if ($catKey == 'F' || $catKey == 'G' || $catKey == 'H' || $catKey == 'J' || $catKey == 'K') {
                //         $answer_arr[$key] = 'f';
                //     } elseif ($catKey == 'A' || $catKey == 'B' || $catKey == 'C' || $catKey == 'D' || $catKey == 'E') {
                //         $answer_arr[$key] = 'a';
                //     }
                // }
                // dd($answer_arr);
                $selected_answer = $answer_arr[$key] ?? '';

                if ($selected_answer != "-") {
                    // dump($selected_answer.'_'.$key);

                    $answers = explode(",", $selected_answer);

                    // dump($catKey);
                    // dump($answers);
                    if (in_array(strtolower($catKey), $answers) || empty($selected_answer)) {
                        $pq = PracticeQuestion::where("id", $key)->first();


                        foreach ($cat as $catKey1 => $catId) {
                            $tmp = $ctData[$key][$catId] ?? [];

                            if (!in_array($catKey, $tmp)) {
                                $ctData[$key][$catId][] = $catKey;
                            }


                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] ?? 0;
                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] ?? 0;
                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] ?? 0;
                            $count = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['count'] ?? 0;

                            $conceptCorrect = $checkboxData[$key][$catKey][$catKey1] ?? "0";

                            if (empty($selected_answer)) {
                                // $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;
                                $uniqueValue = $questionTypeData[$key][$catKey][$catKey1];

                                // Check if initialization has occurred for this unique value across all iterations
                                if (!isset($initializedValues[$uniqueValue])) {
                                    // Perform the initialization
                                    $checkData[$catId][$uniqueValue]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;

                                    // Set the flag to indicate that initialization has occurred for this unique value
                                    $initializedValues[$uniqueValue] = true;
                                }
                            } else {
                                if ($conceptCorrect == "1") {
                                    $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] + 1;
                                } else {
                                    $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] + 1;
                                }
                            }

                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['count'] = $count + 1;
                        }
                    }
                }
            }
        }

        $catFinal = [];

        $questionsCtPresent = [];
        // foreach ($ctData as $ctDataKey => $ctDataValue) {
        //     // dump($ctDataValue);
        //     $ctDataUniqueValue = array_unique(array_keys($ctDataValue));
        //     foreach ($ctDataUniqueValue as $uniqueData) {
        //         $ct = $questionsCtPresent[$uniqueData] ?? 0;
        //         $questionsCtPresent[$uniqueData] = $ct + 1;
        //     }
        //     // dump($questionsCtPresent[$uniqueData]);
        //     foreach ($ctDataValue as $ctDataValueKey => $ctDataValueValue) {
        //         $answer_arr = $answer_arr ?? [];
        //         $selectedAnswer = $answer_arr[$ctDataKey] ?? '';
        //         if (empty($selectedAnswer) || $selectedAnswer != "-") {
        //             $answers = explode(",", $answer_arr[$ctDataKey] ?? '');
        //             $pq = PracticeQuestion::where("id", $ctDataKey)->first();

        //             foreach ($ctDataValueValue as $ctDataValueValueKey => $ctDataValueValueValue)
        //                 $conceptCorrect = $checkboxData[$ctDataKey][$ctDataValueValueValue];
        //             $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
        //             $missed = $catFinal[$ctDataValueKey]['missed'] ?? 0;
        //             if (empty($selectedAnswer)) {
        //                 $catFinal[$ctDataValueKey]['missed'] = $missed + 1;
        //             } else {
        //                 foreach ($conceptCorrect as $cp) {
        //                     if ($cp === "1") {
        //                         $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
        //                         $catFinal[$ctDataValueKey]['correct'] = $crt + 1;
        //                     } else {
        //                         $nocrt = $catFinal[$ctDataValueKey]['incorrect'] ?? 0;
        //                         $catFinal[$ctDataValueKey]['incorrect'] = $nocrt + 1;
        //                     }
        //                 }
        //             }
        //         }
        //     }




        // }
        foreach ($ctData as $ctDataKey => $ctDataValue) {
            $ctDataUniqueValue = array_unique(array_keys($ctDataValue));

            foreach ($ctDataUniqueValue as $uniqueData) {
                $ct = $questionsCtPresent[$uniqueData] ?? ['count' => 0, 'missed' => [], 'incorrect' => []];
                $questionsCtPresent[$uniqueData] = $ct;
                $questionsCtPresent[$uniqueData]['count']++;

                // Initialize missed and incorrect arrays if they don't exist
                if (!isset($questionsCtPresent[$uniqueData]['missed'])) {
                    $questionsCtPresent[$uniqueData]['missed'] = [];
                }
                if (!isset($questionsCtPresent[$uniqueData]['incorrect'])) {
                    $questionsCtPresent[$uniqueData]['incorrect'] = [];
                }
            }

            foreach ($ctDataValue as $ctDataValueKey => $ctDataValueValue) {
                $answer_arr = $answer_arr ?? [];
                $selectedAnswer = $answer_arr[$ctDataKey] ?? '';

                if (empty($selectedAnswer) || $selectedAnswer != "-") {
                    $answers = explode(",", $answer_arr[$ctDataKey] ?? '');
                    $pq = PracticeQuestion::where("id", $ctDataKey)->first();

                    foreach ($ctDataValueValue as $ctDataValueValueKey => $ctDataValueValueValue) {
                        $conceptCorrect = $checkboxData[$ctDataKey][$ctDataValueValueValue];
                        $missed = $catFinal[$ctDataValueKey]['missed'] ?? 0;
                        if (empty($selectedAnswer)) {
                            $catFinal[$ctDataValueKey]['missed'] = $missed + 1;
                        } else {
                            foreach ($conceptCorrect as $cp) {
                                if ($cp === "1") {
                                    $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
                                    $catFinal[$ctDataValueKey]['correct'] = $crt + 1;
                                } else {
                                    $nocrt = $catFinal[$ctDataValueKey]['incorrect'] ?? 0;
                                    $catFinal[$ctDataValueKey]['incorrect'] = $nocrt + 1;
                                }
                            }
                        }

                        // Track missed or incorrect questions
                        if (empty($selectedAnswer)) {
                            if (!in_array($ctDataKey, $questionsCtPresent[$ctDataValueKey]['missed'])) {
                                $questionsCtPresent[$ctDataValueKey]['missed'][] = $ctDataKey;
                            }
                        } else {
                            if (in_array("0", $conceptCorrect)) {
                                // if (!in_array($ctDataKey, $questionsCtPresent[$ctDataValueKey]['incorrect'])) {
                                $questionsCtPresent[$ctDataValueKey]['incorrect'][] = $ctDataKey;
                                // }
                            }
                        }
                    }
                }
            }
        }

        // dd($questionsCtPresent);


        // dump($checkData);
        // dump($catFinal);
        $categoryAndQuestionTypeSummaryData = [];

        if (!empty($checkData)) {
            $i = 0;
            foreach ($checkData as $key => $data) {
                $correct = $catFinal[$key]['correct'] ?? 0;
                $incorrect = $catFinal[$key]['incorrect'] ?? 0;
                $missed = $catFinal[$key]['missed'] ?? 0;

                $dataArray = [
                    'ct' => $key,
                    'qt' => $data,
                    'count' => $correct + $incorrect + $missed,
                    'correct' => $correct,
                    'incorrect' => $incorrect,
                    'missed' => $missed
                ];
                $total_qts = 0;
                $total_incorrect_qts = 0;
                $total_correct_qts = 0;
                foreach ($data as $dt) {
                    $total_incorrect_qts += $dt['incorrect'];
                    $total_correct_qts += $dt['correct'];
                    $total_qts += $dt['count'];
                }
                $dataArray['total_qts'] = $total_qts;
                $dataArray['total_incorrect_qts'] = $total_incorrect_qts;
                $dataArray['total_correct_qts'] = $total_correct_qts;
                $categoryAndQuestionTypeSummaryData[$i] = $dataArray;
                $i++;
            }

            if (!empty($categoryAndQuestionTypeSummaryData)) {
                $keys = array_column($categoryAndQuestionTypeSummaryData, 'incorrect');
                array_multisort($keys, SORT_DESC, $categoryAndQuestionTypeSummaryData);
            }
        }
        // dd($categoryAndQuestionTypeSummaryData);

        $real_total_questions = DB::table('practice_questions')->where('practice_test_sections_id', $practice_test_section_id)->count();


        return view('user.test-review.question_concepts_review',  [
            'category_data' => $category_data,
            'questionTypeData' => $questionTypeData,
            'questionsCtPresent' => $questionsCtPresent,
            'categoryTypeData' => $categoryTypeData,
            'checkboxData' => $checkboxData,
            'test_details' => $test_details,
            'section_id' => $id,
            'user_selected_answers' => $store_sections_details,
            'get_test_name' => $get_test_name,
            'store_all_data' => $store_all_data,
            'store_question_type_data' => $store_question_type_data,
            'question_tags' => $question_tags,
            'percentage_arr_all' => $percentage_arr_all,
            'right_answers' => $right_answers,
            'total_questions' => $total_questions,
            'real_total_questions' => $real_total_questions,
            'scaled_score' => $scaled_score,
            'high_score' => $high_score,
            'low_score' => $low_score,
            'practice_test_section_id' => $practice_test_section_id,
            'categoryAndQuestionTypeSummaryData' => $categoryAndQuestionTypeSummaryData,
            'high_reading_score' => $high_reading_score,
            'low_reading_score' => $low_reading_score,
            'high_math_score' => $high_math_score,
            'low_math_score' => $low_math_score
        ]);
    }

    public function singleReviewShow(Request $request)
    {
        $current_user_id = Auth::id();
        // $practice_test_section_id = $id;
        $get_test_name = 'name';
        $category_data = array();
        $percentage_arr_all = array();
        $store_sections_details = array();
        $categoryTypeData = [];
        $questionTypeData = [];
        $count = 0;
        $checkboxData = [];
        // $testid = 553;
        $types = 'all';

        if ($request->input('testid') != null) {
            $testid = $request->query('testid');
        } else {
            return response()->json([
                'error' => 'No test was found with this format!!!'
            ]);
        }
        // $allTestsByUser = DB::table('practice_tests')->where('user_id', $current_user_id)->where('format', $testType)->pluck('id')->toArray();
        // // dump($current_user_id);
        // // dd($allTestsByUser);
        // if (empty($allTestsByUser)) {
        //     return to_route('test-prep-insights')->with('error', 'No test was found with this format!!!');
        // }

        $test_id = $testid;
        // dd($testid);
        $test_category_type = DB::table('practice_questions')
            ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->select('category_type', 'question_type_id')
            ->where('practice_test_sections.testid', $test_id)
            ->get();

        $test_details = PracticeTest::find($test_id);

        // dd($test_details);
        // dd($request->input('section_id'));
        $sectionId = $request->input('section_id');
        $getTestSection = DB::table('practice_test_sections')->where('id', $sectionId)->first();
        // dd($getTestSection);

        if ($getTestSection->practice_test_type == 'Math' || $getTestSection->practice_test_type == 'Math_no_calculator' || $getTestSection->practice_test_type == 'Math_with_calculator') {
            $mareSections =  DB::table('practice_test_sections')->where('testid', $test_id)->whereIn('practice_test_type', ['Math', 'Math_no_calculator', 'Math_with_calculator'])->pluck('id')->toArray();
            // dd($mareSections);
        } elseif ($getTestSection->practice_test_type == 'Reading_And_Writing' || $getTestSection->practice_test_type == 'Easy_Reading_And_Writing' || $getTestSection->practice_test_type == 'Hard_Reading_And_Writing') {
            $mareSections = DB::table('practice_test_sections')->where('testid', $test_id)->whereIn('practice_test_type', ['Reading_And_Writing', 'Easy_Reading_And_Writing', 'Hard_Reading_And_Writing'])->pluck('id')->toArray();
            // dd($mareSections);
        } else {
        }
        if ($types == 'all') {
            $store_all_data = array();
            $question_tags_all = [];
            $store_question_type_data = array();
            $check_question_answers = [];
            $get_test_questions = DB::table('practice_questions')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select(
                    'practice_questions.id as test_question_id',
                    'practice_questions.question_type_id',
                    'practice_questions.category_type',
                    'practice_questions.mistake_type',
                    'practice_questions.tags as tags',
                    'practice_questions.answer as answer',
                    'practice_questions.category_type_values as category_type_values',
                    'practice_questions.question_type_values as question_type_values',
                    'practice_questions.checkbox_values as checkbox_values'
                )
                ->where('practice_tests.id', $test_id)
                ->whereIn('practice_test_sections.id', function ($query) use ($current_user_id, $test_id, $mareSections) {
                    $query->select('section_id')
                        ->from('user_answers')
                        ->whereIn('section_id', $mareSections)
                        ->where('user_id', $current_user_id)
                        ->where('test_id', $test_id);
                })
                ->orderBy('practice_questions.question_order', 'ASC')
                ->get();


            // dd($get_test_questions);



            foreach ($get_test_questions as $question) {
                $questionDetails = QuestionDetails::where("question_id", $question->test_question_id)->get();
                $questionTypeData[$question->test_question_id] = json_decode($question->question_type_values ?? '', true);
                $categoryTypeData[$question->test_question_id] = json_decode($question->category_type_values ?? '', true);
                $checkboxData[$question->test_question_id] = json_decode($question->checkbox_values ?? '', true);
            }

            $user_answers_data = DB::table('user_answers')
                ->where('user_id', $current_user_id)
                ->where('test_id', $test_id)
                ->latest()
                ->get();
            // dd($user_answers_data);
            $answer_arr = [];
            foreach ($user_answers_data as $user_answer) {
                $answers = json_decode($user_answer->answer, true);
                $answer_arr[] = $answers;
            }
            $answer_arr = $this->array_flatten($answer_arr);
            foreach ($get_test_questions as $question) {
                if (isset($answer_arr[$question->test_question_id])  && !empty($answer_arr[$question->test_question_id])) {
                    if ($answer_arr[$question->test_question_id] == $question->answer) {
                        $check_question_answers[$question->test_question_id] = true;
                    } else {
                        $check_question_answers[$question->test_question_id] = false;
                    }
                }
            }

            if (!$get_test_questions->isEmpty()) {
                $percentage_arr_all = [];

                foreach ($get_test_questions as $get_single_test_questions) {
                    $questionDetails = QuestionDetails::where("question_id", $get_single_test_questions->test_question_id)->get(['question_type', 'category_type'])->toArray();

                    $array_ques_type = array_map(function ($item) {
                        return $item['question_type'];
                    }, $questionDetails);

                    $array_cat_type = array_map(function ($item) {
                        return $item['category_type'];
                    }, $questionDetails);

                    $percentage_arr = [];

                    if (isset($array_cat_type) && !empty($array_cat_type) && isset($array_ques_type) && !empty($array_ques_type)) {
                        $mergedArray = [];

                        for ($i = 0; $i < count($array_ques_type); $i++) {
                            $mergedArray[$i] = [
                                'category_type' => $array_cat_type[$i],
                                'question_type' => $array_ques_type[$i]
                            ];
                        }

                        foreach ($check_question_answers as $q_id => $check_question_answer) {
                            if ($get_single_test_questions->test_question_id == $q_id) {
                                $percentage_arr = [
                                    $q_id => $check_question_answer
                                ];
                            }
                        }

                        foreach ($mergedArray as $type) {
                            $get_cat_name_by_id = DB::table('practice_category_types')
                                ->where('id', $type['category_type'])
                                ->get();

                            $get_ques_type_name_by_id = DB::table('question_types')
                                ->where('id', $type['question_type'])
                                ->get();

                            if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                $percentage_arr_all[$get_cat_name_by_id[0]->category_type_title][] = $percentage_arr;
                                $question_tags_all[$get_cat_name_by_id[0]->category_type_title][] = isset($get_single_test_questions->tags) ? explode(",", $get_single_test_questions->tags) : [];
                            }
                            if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title) && isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title)) {
                                $store_all_data[$get_cat_name_by_id[0]->category_type_title][$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                            }
                        }
                    }

                    if (isset($array_ques_type) && !empty($array_ques_type)) {
                        foreach ($array_ques_type as $single_ques_type) {
                            $get_ques_type_name_by_id = DB::table('question_types')
                                ->where('id', $single_ques_type)
                                ->get();

                            if (isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title) && isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                $store_question_type_data[$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                            }
                        }
                    }
                }
            }
        }
        if (isset($types) && !empty($types)) {
            $helper = new Helper();
            if ($types == 'all') {
                $get_all_section = DB::table('practice_test_sections')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_test_sections.*')
                    ->where('practice_tests.id', $test_id)
                    ->get();

                if (!$get_all_section->isEmpty()) {
                    foreach ($get_all_section as $get_single_section) {

                        $user_selected_answers = DB::table('user_answers')
                            ->where('user_id', $current_user_id)
                            ->where('section_id', $get_single_section->id)
                            ->latest()
                            ->get();

                        if (isset($user_selected_answers[0]) && !empty($user_selected_answers[0])) {
                            $decoded_answers = [];
                            $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
                            $question_order = PracticeQuestion::where('practice_test_sections_id', $get_single_section->id)->orderBy('question_order', 'ASC')->pluck('id')->toArray();

                            if (isset($question_order) && !empty($question_order)) {
                                foreach ($question_order as $order) {
                                    if (isset($json_decoded_answers->{$order})) {
                                        $decoded_answers[$order] = $json_decoded_answers->{$order};
                                    } else {
                                        $decoded_answers[$order] = '';
                                    }
                                }
                            }
                            $json_decoded_guess = json_decode($user_selected_answers[0]->guess);
                            $json_decoded_flag = json_decode($user_selected_answers[0]->flag);
                            $json_decoded_skip = json_decode($user_selected_answers[0]->skip);

                            foreach ($decoded_answers as $question_id => $json_decoded_single_answers) {
                                $get_question_details = DB::table('practice_questions')
                                    // ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                                    ->select(
                                        'practice_questions.id as question_id',
                                        'practice_questions.practice_test_sections_id as section_id',
                                        'practice_questions.title as question_title',
                                        'practice_questions.type as practice_type',
                                        'practice_questions.mistake_type as mistake_type',
                                        'practice_questions.answer as question_answer',
                                        'practice_questions.answer_content as question_answer_options',
                                        'practice_questions.multiChoice as is_multiple_choice',
                                        'practice_questions.question_order',
                                        'practice_questions.passages_id',
                                        'practice_questions.tags',
                                        'passages.title',
                                        // 'practice_questions.notes',
                                        'passages.description',
                                        'practice_questions.category_type as category_type',
                                        'practice_questions.question_type_id as question_type_id',
                                        'practice_questions.answer_exp as answer_exp'
                                    )
                                    ->where('practice_questions.id', $question_id)
                                    ->leftJoin("passages", "passages.id", "=", "practice_questions.passages_id")
                                    ->orderBy('practice_questions.question_order', 'ASC')
                                    ->get();


                                $store_sections_details[] = array(
                                    'user_selected_answer' => $json_decoded_single_answers,
                                    'user_selected_guess' => $json_decoded_guess->$question_id ?? '',
                                    'user_selected_flag' => $json_decoded_flag->$question_id ?? '',
                                    'user_selected_skip' => $json_decoded_skip->$question_id ?? '',
                                    'get_question_details' => $get_question_details,
                                    'all_sections' => $get_all_section,
                                    'date_taken' => $user_selected_answers,
                                    'type' => $types
                                );
                            }
                        }
                    }
                }
            }
        }

        // if ($types == 'all') {
        //     $question_tags = [];
        //     foreach ($question_tags_all as $key => $question_tag) {
        //         $question_tags[$key] = array_unique(Arr::flatten($question_tag));
        //     }
        // }
        foreach ($percentage_arr_all as $key => $percentage) {
            $correct_ans = 0;
            $wrong_ans = 0;
            $total_question = $this->array_flatten(array_map("unserialize", array_unique(array_map("serialize", $percentage))));
            // dump($total_question);
            $count = count($total_question);

            $allCorrect = true;
            foreach ($total_question as $value) {
                if ($value == true) {
                    $correct_ans++;
                }

                if ($value == false) {
                    $allCorrect = false;
                    $wrong_ans++;
                }
            }
            if ($count !== 0) {
                $percentage_arr_all[$key] = [
                    "correct_ans" => $correct_ans,
                    "wrong_ans" => $wrong_ans,
                    "percentage" => 100 * $wrong_ans / $count . '%',
                    "percentage_label" => ($correct_ans > $wrong_ans ? $correct_ans : $wrong_ans) . "/" . $count . ($correct_ans > $wrong_ans ? ' Correct' : ' Incorrect'),
                    "all_correct" => $allCorrect
                ];
                if ($allCorrect) {
                    $percentage_arr_all[$key]['percentage_label'] = 'No Incorrect Answer';
                }
            }
        }

        $checkData = [];
        $ctData = [];

        foreach ($categoryTypeData as $key => $catData) {
            $initializedValues = [];

            foreach ($catData as $catKey => $cat) {
                $answer_arr = $answer_arr ?? [];
                // if ($key && array_key_exists($key, $answer_arr) && $answer_arr[$key] == "-") {
                //     // Replace "-" with $catKey value
                //     if ($catKey == 'F' || $catKey == 'G' || $catKey == 'H' || $catKey == 'J' || $catKey == 'K') {
                //         $answer_arr[$key] = 'f';
                //     } elseif ($catKey == 'A' || $catKey == 'B' || $catKey == 'C' || $catKey == 'D' || $catKey == 'E') {
                //         $answer_arr[$key] = 'a';
                //     }
                // }
                $selected_answer = $answer_arr[$key] ?? '';

                if ($selected_answer != "-") {
                    $answers = explode(",", $selected_answer);
                    if (in_array(strtolower($catKey), $answers) || empty($selected_answer)) {
                        $pq = PracticeQuestion::where("id", $key)->first();

                        foreach ($cat as $catKey1 => $catId) {
                            $tmp = $ctData[$key][$catId] ?? [];
                            if (!in_array($catKey, $tmp)) {
                                $ctData[$key][$catId][] = $catKey;
                            }

                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] ?? 0;
                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] ?? 0;
                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] ?? 0;
                            $count = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['count'] ?? 0;

                            $conceptCorrect = $checkboxData[$key][$catKey][$catKey1] ?? "0";

                            if (empty($selected_answer)) {
                                // $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;
                                $uniqueValue = $questionTypeData[$key][$catKey][$catKey1];

                                // Check if initialization has occurred for this unique value across all iterations
                                if (!isset($initializedValues[$uniqueValue])) {
                                    // Perform the initialization
                                    $checkData[$catId][$uniqueValue]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;

                                    // Set the flag to indicate that initialization has occurred for this unique value
                                    $initializedValues[$uniqueValue] = true;
                                }
                            } else {
                                if ($conceptCorrect == "1") {
                                    $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] + 1;
                                } else {
                                    $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] + 1;
                                }
                            }

                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['count'] = $count + 1;
                        }
                    }
                }
            }
        }

        $catFinal = [];

        $questionsCtPresent = [];

        // foreach ($ctData as $ctDataKey => $ctDataValue) {
        //     $ctDataUniqueValue = array_unique(array_keys($ctDataValue));

        //     foreach ($ctDataUniqueValue as $uniqueData) {
        //         $ct = $questionsCtPresent[$uniqueData] ?? 0;
        //         $questionsCtPresent[$uniqueData] = $ct + 1;
        //     }
        //     foreach ($ctDataValue as $ctDataValueKey => $ctDataValueValue) {
        //         $answer_arr = $answer_arr ?? [];
        //         $selectedAnswer = $answer_arr[$ctDataKey] ?? '';
        //         if (empty($selectedAnswer) || $selectedAnswer != "-") {
        //             $answers = explode(",", $answer_arr[$ctDataKey] ?? '');
        //             $pq = PracticeQuestion::where("id", $ctDataKey)->first();
        //             foreach ($ctDataValueValue as $ctDataValueValueKey => $ctDataValueValueValue)
        //                 $conceptCorrect = $checkboxData[$ctDataKey][$ctDataValueValueValue];
        //             $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
        //             $missed = $catFinal[$ctDataValueKey]['missed'] ?? 0;
        //             if (empty($selectedAnswer)) {
        //                 $catFinal[$ctDataValueKey]['missed'] = $missed + 1;
        //             } else {
        //                 foreach ($conceptCorrect as $cp) {
        //                     if ($cp === "1") {
        //                         $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
        //                         $catFinal[$ctDataValueKey]['correct'] = $crt + 1;
        //                     } else {
        //                         $nocrt = $catFinal[$ctDataValueKey]['incorrect'] ?? 0;
        //                         $catFinal[$ctDataValueKey]['incorrect'] = $nocrt + 1;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        foreach ($ctData as $ctDataKey => $ctDataValue) {
            $ctDataUniqueValue = array_unique(array_keys($ctDataValue));

            foreach ($ctDataUniqueValue as $uniqueData) {
                $ct = $questionsCtPresent[$uniqueData] ?? ['count' => 0, 'missed' => [], 'incorrect' => []];
                $questionsCtPresent[$uniqueData] = $ct;
                $questionsCtPresent[$uniqueData]['count']++;

                // Initialize missed and incorrect arrays if they don't exist
                if (!isset($questionsCtPresent[$uniqueData]['missed'])) {
                    $questionsCtPresent[$uniqueData]['missed'] = [];
                }
                if (!isset($questionsCtPresent[$uniqueData]['incorrect'])) {
                    $questionsCtPresent[$uniqueData]['incorrect'] = [];
                }
            }

            foreach ($ctDataValue as $ctDataValueKey => $ctDataValueValue) {
                $answer_arr = $answer_arr ?? [];
                $selectedAnswer = $answer_arr[$ctDataKey] ?? '';

                if (empty($selectedAnswer) || $selectedAnswer != "-") {
                    $answers = explode(",", $answer_arr[$ctDataKey] ?? '');
                    $pq = PracticeQuestion::where("id", $ctDataKey)->first();

                    foreach ($ctDataValueValue as $ctDataValueValueKey => $ctDataValueValueValue) {
                        $conceptCorrect = $checkboxData[$ctDataKey][$ctDataValueValueValue];
                        $missed = $catFinal[$ctDataValueKey]['missed'] ?? 0;
                        if (empty($selectedAnswer)) {
                            $catFinal[$ctDataValueKey]['missed'] = $missed + 1;
                        } else {
                            foreach ($conceptCorrect as $cp) {
                                if ($cp === "1") {
                                    $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
                                    $catFinal[$ctDataValueKey]['correct'] = $crt + 1;
                                } else {
                                    $nocrt = $catFinal[$ctDataValueKey]['incorrect'] ?? 0;
                                    $catFinal[$ctDataValueKey]['incorrect'] = $nocrt + 1;
                                }
                            }
                        }

                        // Track missed or incorrect questions
                        if (empty($selectedAnswer)) {
                            if (!in_array($ctDataKey, $questionsCtPresent[$ctDataValueKey]['missed'])) {
                                $questionsCtPresent[$ctDataValueKey]['missed'][] = $ctDataKey;
                            }
                        } else {
                            if (in_array("0", $conceptCorrect)) {
                                // if (!in_array($ctDataKey, $questionsCtPresent[$ctDataValueKey]['incorrect'])) {
                                $questionsCtPresent[$ctDataValueKey]['incorrect'][] = $ctDataKey;
                                // }
                            }
                        }
                    }
                }
            }
        }

        $categoryAndQuestionTypeSummaryDataMultiple = [];

        if (!empty($checkData)) {
            $i = 0;
            foreach ($checkData as $key => $data) {
                $correct = $catFinal[$key]['correct'] ?? 0;
                $incorrect = $catFinal[$key]['incorrect'] ?? 0;
                $missed = $catFinal[$key]['missed'] ?? 0;

                $dataArray = [
                    'ct' => $key,
                    'qt' => $data,
                    'count' => $correct + $incorrect + $missed,
                    'correct' => $correct,
                    'incorrect' => $incorrect,
                    'missed' => $missed
                ];
                $total_qts = 0;
                $total_incorrect_qts = 0;
                $total_correct_qts = 0;
                foreach ($data as $dt) {
                    $total_incorrect_qts += $dt['incorrect'];
                    $total_correct_qts += $dt['correct'];
                    $total_qts += $dt['count'];
                }
                $dataArray['total_qts'] = $total_qts;
                $dataArray['total_incorrect_qts'] = $total_incorrect_qts;
                $dataArray['total_correct_qts'] = $total_correct_qts;
                $categoryAndQuestionTypeSummaryDataMultiple[$i] = $dataArray;
                $i++;
            }

            if (!empty($categoryAndQuestionTypeSummaryDataMultiple)) {
                $keys = array_column($categoryAndQuestionTypeSummaryDataMultiple, 'incorrect');
                array_multisort($keys, SORT_DESC, $categoryAndQuestionTypeSummaryDataMultiple);
            }
        }
        // dd($questionsCtPresent);

        // dd($categoryAndQuestionTypeSummaryDataMultiple);

        $html = view('user.test-review.question_concept_review_multiple',  [
            'category_data' => $category_data,
            'questionTypeData' => $questionTypeData,
            'questionsCtPresent' => $questionsCtPresent,
            'categoryTypeData' => $categoryTypeData,
            'checkboxData' => $checkboxData,
            'test_details' => $test_details,
            'section_id' => $sectionId,
            'user_selected_answers' => $store_sections_details,
            'get_test_name' => $get_test_name,
            'store_all_data' => $store_all_data,
            'store_question_type_data' => $store_question_type_data,
            // 'question_tags' => $question_tags,
            'percentage_arr_all' => $percentage_arr_all,
            'test_det' => 'single',
            // 'right_answers' => $right_answers,
            // 'total_questions' => $total_questions,
            // 'scaled_score' => $scaled_score,
            // 'high_score' => $high_score,
            // 'low_score' => $low_score,
            // 'practice_test_section_id' => $practice_test_section_id,
            'categoryAndQuestionTypeSummaryDataMultiple' => $categoryAndQuestionTypeSummaryDataMultiple
        ])->render();
        return response()->json(['html' => $html]);
    }

    public function selectFormat()
    {
        return view('user.test-review.select_qt');
    }
    public function getAllTest(Request $request)
    {
        $current_user_id = Auth::id();
        if ($request->format != null) {
            $testType = $request->format;
        } else {
            return to_route('test-prep-insights')->with('error', 'Please select a Test Format!!!');
        }
        $user_tests = DB::table('user_answers')->where('user_id', $current_user_id)->pluck('test_id')->toArray();
        $allTestsByUser = DB::table('practice_tests')->where('user_id', $current_user_id)->where('format', $testType)->whereIn('id', $user_tests)->get()->toArray();
        //    dd(count($allTestsByUser));
        return response()->json($allTestsByUser);
    }
    public function getSingleTestInsight(Request $request)
    {
        $current_user_id = Auth::id();
        // $practice_test_section_id = $id;
        $get_test_name = 'name';
        $category_data = array();
        $percentage_arr_all = array();
        $store_sections_details = array();
        $categoryTypeData = [];
        $questionTypeData = [];
        $count = 0;
        $checkboxData = [];
        // $testid = 553;
        $types = 'all';
        if ($request->query('testType') != null) {
            $testType = $request->query('testType');
        } else {
            return response()->json([
                'error' => 'Please select a Test Format!!!'
            ]);
        }

        if ($request->query('testid') != null) {
            $testid = $request->query('testid');
        } else {
            return response()->json([
                'error' => 'No test was found with this format!!!'
            ]);
        }
        // $allTestsByUser = DB::table('practice_tests')->where('user_id', $current_user_id)->where('format', $testType)->pluck('id')->toArray();
        // // dump($current_user_id);
        // // dd($allTestsByUser);
        // if (empty($allTestsByUser)) {
        //     return to_route('test-prep-insights')->with('error', 'No test was found with this format!!!');
        // }

        $test_id = $testid;
        $test_category_type = DB::table('practice_questions')
            ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->select('category_type', 'question_type_id')
            ->where('practice_test_sections.testid', $test_id)
            ->get();

        $test_details = PracticeTest::find($test_id);

        // dump($test_details);
        if ($types == 'all') {
            $store_all_data = array();
            $question_tags_all = [];
            $store_question_type_data = array();
            $check_question_answers = [];
            $get_test_questions = DB::table('practice_questions')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select(
                    'practice_questions.id as test_question_id',
                    'practice_questions.question_type_id',
                    'practice_questions.category_type',
                    'practice_questions.mistake_type',
                    'practice_questions.tags as tags',
                    'practice_questions.answer as answer',
                    'practice_questions.category_type_values as category_type_values',
                    'practice_questions.question_type_values as question_type_values',
                    'practice_questions.checkbox_values as checkbox_values'
                )
                ->where('practice_tests.id', $test_id)
                ->whereIn('practice_test_sections.id', function ($query) use ($current_user_id, $test_id) {
                    $query->select('section_id')
                        ->from('user_answers')
                        ->where('user_id', $current_user_id)
                        ->where('test_id', $test_id);
                })
                ->orderBy('practice_questions.question_order', 'ASC')
                ->get();


            // dd($get_test_questions);



            foreach ($get_test_questions as $question) {
                $questionDetails = QuestionDetails::where("question_id", $question->test_question_id)->get();
                $questionTypeData[$question->test_question_id] = json_decode($question->question_type_values ?? '', true);
                $categoryTypeData[$question->test_question_id] = json_decode($question->category_type_values ?? '', true);
                $checkboxData[$question->test_question_id] = json_decode($question->checkbox_values ?? '', true);
            }

            $user_answers_data = DB::table('user_answers')
                ->where('user_id', $current_user_id)
                ->where('test_id', $test_id)
                ->latest()
                ->get();
            // dd($user_answers_data);
            $answer_arr = [];
            foreach ($user_answers_data as $user_answer) {
                $answers = json_decode($user_answer->answer, true);
                $answer_arr[] = $answers;
            }
            $answer_arr = $this->array_flatten($answer_arr);
            foreach ($get_test_questions as $question) {
                if (isset($answer_arr[$question->test_question_id])  && !empty($answer_arr[$question->test_question_id])) {
                    if ($answer_arr[$question->test_question_id] == $question->answer) {
                        $check_question_answers[$question->test_question_id] = true;
                    } else {
                        $check_question_answers[$question->test_question_id] = false;
                    }
                }
            }

            if (!$get_test_questions->isEmpty()) {
                $percentage_arr_all = [];

                foreach ($get_test_questions as $get_single_test_questions) {
                    $questionDetails = QuestionDetails::where("question_id", $get_single_test_questions->test_question_id)->get(['question_type', 'category_type'])->toArray();

                    $array_ques_type = array_map(function ($item) {
                        return $item['question_type'];
                    }, $questionDetails);

                    $array_cat_type = array_map(function ($item) {
                        return $item['category_type'];
                    }, $questionDetails);

                    $percentage_arr = [];

                    if (isset($array_cat_type) && !empty($array_cat_type) && isset($array_ques_type) && !empty($array_ques_type)) {
                        $mergedArray = [];

                        for ($i = 0; $i < count($array_ques_type); $i++) {
                            $mergedArray[$i] = [
                                'category_type' => $array_cat_type[$i],
                                'question_type' => $array_ques_type[$i]
                            ];
                        }

                        foreach ($check_question_answers as $q_id => $check_question_answer) {
                            if ($get_single_test_questions->test_question_id == $q_id) {
                                $percentage_arr = [
                                    $q_id => $check_question_answer
                                ];
                            }
                        }

                        foreach ($mergedArray as $type) {
                            $get_cat_name_by_id = DB::table('practice_category_types')
                                ->where('id', $type['category_type'])
                                ->get();

                            $get_ques_type_name_by_id = DB::table('question_types')
                                ->where('id', $type['question_type'])
                                ->get();

                            if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                $percentage_arr_all[$get_cat_name_by_id[0]->category_type_title][] = $percentage_arr;
                                $question_tags_all[$get_cat_name_by_id[0]->category_type_title][] = isset($get_single_test_questions->tags) ? explode(",", $get_single_test_questions->tags) : [];
                            }
                            if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title) && isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title)) {
                                $store_all_data[$get_cat_name_by_id[0]->category_type_title][$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                            }
                        }
                    }

                    if (isset($array_ques_type) && !empty($array_ques_type)) {
                        foreach ($array_ques_type as $single_ques_type) {
                            $get_ques_type_name_by_id = DB::table('question_types')
                                ->where('id', $single_ques_type)
                                ->get();

                            if (isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title) && isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                $store_question_type_data[$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                            }
                        }
                    }
                }
            }
        }
        if (isset($types) && !empty($types)) {
            $helper = new Helper();
            if ($types == 'all') {
                $get_all_section = DB::table('practice_test_sections')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_test_sections.*')
                    ->where('practice_tests.id', $test_id)
                    ->get();

                if (!$get_all_section->isEmpty()) {
                    foreach ($get_all_section as $get_single_section) {

                        $user_selected_answers = DB::table('user_answers')
                            ->where('user_id', $current_user_id)
                            ->where('section_id', $get_single_section->id)
                            ->latest()
                            ->get();

                        if (isset($user_selected_answers[0]) && !empty($user_selected_answers[0])) {
                            $decoded_answers = [];
                            $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
                            $question_order = PracticeQuestion::where('practice_test_sections_id', $get_single_section->id)->orderBy('question_order', 'ASC')->pluck('id')->toArray();

                            if (isset($question_order) && !empty($question_order)) {
                                foreach ($question_order as $order) {
                                    if (isset($json_decoded_answers->{$order})) {
                                        $decoded_answers[$order] = $json_decoded_answers->{$order};
                                    } else {
                                        $decoded_answers[$order] = '';
                                    }
                                }
                            }
                            $json_decoded_guess = json_decode($user_selected_answers[0]->guess);
                            $json_decoded_flag = json_decode($user_selected_answers[0]->flag);
                            $json_decoded_skip = json_decode($user_selected_answers[0]->skip);

                            foreach ($decoded_answers as $question_id => $json_decoded_single_answers) {
                                $get_question_details = DB::table('practice_questions')
                                    // ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                                    ->select(
                                        'practice_questions.id as question_id',
                                        'practice_questions.practice_test_sections_id as section_id',
                                        'practice_questions.title as question_title',
                                        'practice_questions.type as practice_type',
                                        'practice_questions.mistake_type as mistake_type',
                                        'practice_questions.answer as question_answer',
                                        'practice_questions.answer_content as question_answer_options',
                                        'practice_questions.multiChoice as is_multiple_choice',
                                        'practice_questions.question_order',
                                        'practice_questions.passages_id',
                                        'practice_questions.tags',
                                        'passages.title',
                                        // 'practice_questions.notes',
                                        'passages.description',
                                        'practice_questions.category_type as category_type',
                                        'practice_questions.question_type_id as question_type_id',
                                        'practice_questions.answer_exp as answer_exp'
                                    )
                                    ->where('practice_questions.id', $question_id)
                                    ->leftJoin("passages", "passages.id", "=", "practice_questions.passages_id")
                                    ->orderBy('practice_questions.question_order', 'ASC')
                                    ->get();


                                $store_sections_details[] = array(
                                    'user_selected_answer' => $json_decoded_single_answers,
                                    'user_selected_guess' => $json_decoded_guess->$question_id ?? '',
                                    'user_selected_flag' => $json_decoded_flag->$question_id ?? '',
                                    'user_selected_skip' => $json_decoded_skip->$question_id ?? '',
                                    'get_question_details' => $get_question_details,
                                    'all_sections' => $get_all_section,
                                    'date_taken' => $user_selected_answers,
                                    'type' => $types
                                );
                            }
                        }
                    }
                }
            }
        }

        if ($types == 'all') {
            $question_tags = [];
            foreach ($question_tags_all as $key => $question_tag) {
                $question_tags[$key] = array_unique(Arr::flatten($question_tag));
            }
        }
        foreach ($percentage_arr_all as $key => $percentage) {
            $correct_ans = 0;
            $wrong_ans = 0;
            $total_question = $this->array_flatten(array_map("unserialize", array_unique(array_map("serialize", $percentage))));
            // dump($total_question);
            $count = count($total_question);

            $allCorrect = true;
            foreach ($total_question as $value) {
                if ($value == true) {
                    $correct_ans++;
                }

                if ($value == false) {
                    $allCorrect = false;
                    $wrong_ans++;
                }
            }
            if ($count !== 0) {
                $percentage_arr_all[$key] = [
                    "correct_ans" => $correct_ans,
                    "wrong_ans" => $wrong_ans,
                    "percentage" => 100 * $wrong_ans / $count . '%',
                    "percentage_label" => ($correct_ans > $wrong_ans ? $correct_ans : $wrong_ans) . "/" . $count . ($correct_ans > $wrong_ans ? ' Correct' : ' Incorrect'),
                    "all_correct" => $allCorrect
                ];
                if ($allCorrect) {
                    $percentage_arr_all[$key]['percentage_label'] = 'No Incorrect Answer';
                }
            }
        }

        $checkData = [];
        $ctData = [];

        foreach ($categoryTypeData as $key => $catData) {
            $initializedValues = [];

            foreach ($catData as $catKey => $cat) {
                $answer_arr = $answer_arr ?? [];
                // if ($key && array_key_exists($key, $answer_arr) && $answer_arr[$key] == "-") {
                //     // Replace "-" with $catKey value
                //     if ($catKey == 'F' || $catKey == 'G' || $catKey == 'H' || $catKey == 'J' || $catKey == 'K') {
                //         $answer_arr[$key] = 'f';
                //     } elseif ($catKey == 'A' || $catKey == 'B' || $catKey == 'C' || $catKey == 'D' || $catKey == 'E') {
                //         $answer_arr[$key] = 'a';
                //     }
                // }
                $selected_answer = $answer_arr[$key] ?? '';

                if ($selected_answer != "-") {
                    $answers = explode(",", $selected_answer);
                    if (in_array(strtolower($catKey), $answers) || empty($selected_answer)) {
                        $pq = PracticeQuestion::where("id", $key)->first();

                        foreach ($cat as $catKey1 => $catId) {
                            $tmp = $ctData[$key][$catId] ?? [];
                            if (!in_array($catKey, $tmp)) {
                                $ctData[$key][$catId][] = $catKey;
                            }

                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] ?? 0;
                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] ?? 0;
                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] ?? 0;
                            $count = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['count'] ?? 0;

                            $conceptCorrect = $checkboxData[$key][$catKey][$catKey1] ?? "0";

                            if (empty($selected_answer)) {
                                // $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;
                                $uniqueValue = $questionTypeData[$key][$catKey][$catKey1];

                                // Check if initialization has occurred for this unique value across all iterations
                                if (!isset($initializedValues[$uniqueValue])) {
                                    // Perform the initialization
                                    $checkData[$catId][$uniqueValue]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;

                                    // Set the flag to indicate that initialization has occurred for this unique value
                                    $initializedValues[$uniqueValue] = true;
                                }
                            } else {
                                if ($conceptCorrect == "1") {
                                    $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] + 1;
                                } else {
                                    $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] + 1;
                                }
                            }

                            $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['count'] = $count + 1;
                        }
                    }
                }
            }
        }

        $catFinal = [];

        $questionsCtPresent = [];

        // foreach ($ctData as $ctDataKey => $ctDataValue) {
        //     $ctDataUniqueValue = array_unique(array_keys($ctDataValue));

        //     foreach ($ctDataUniqueValue as $uniqueData) {
        //         $ct = $questionsCtPresent[$uniqueData] ?? 0;
        //         $questionsCtPresent[$uniqueData] = $ct + 1;
        //     }
        //     foreach ($ctDataValue as $ctDataValueKey => $ctDataValueValue) {
        //         $answer_arr = $answer_arr ?? [];
        //         $selectedAnswer = $answer_arr[$ctDataKey] ?? '';
        //         if (empty($selectedAnswer) || $selectedAnswer != "-") {
        //             $answers = explode(",", $answer_arr[$ctDataKey] ?? '');
        //             $pq = PracticeQuestion::where("id", $ctDataKey)->first();
        //             foreach ($ctDataValueValue as $ctDataValueValueKey => $ctDataValueValueValue)
        //                 $conceptCorrect = $checkboxData[$ctDataKey][$ctDataValueValueValue];
        //             $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
        //             $missed = $catFinal[$ctDataValueKey]['missed'] ?? 0;
        //             if (empty($selectedAnswer)) {
        //                 $catFinal[$ctDataValueKey]['missed'] = $missed + 1;
        //             } else {
        //                 foreach ($conceptCorrect as $cp) {
        //                     if ($cp === "1") {
        //                         $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
        //                         $catFinal[$ctDataValueKey]['correct'] = $crt + 1;
        //                     } else {
        //                         $nocrt = $catFinal[$ctDataValueKey]['incorrect'] ?? 0;
        //                         $catFinal[$ctDataValueKey]['incorrect'] = $nocrt + 1;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        foreach ($ctData as $ctDataKey => $ctDataValue) {
            $ctDataUniqueValue = array_unique(array_keys($ctDataValue));

            foreach ($ctDataUniqueValue as $uniqueData) {
                $ct = $questionsCtPresent[$uniqueData] ?? ['count' => 0, 'missed' => [], 'incorrect' => []];
                $questionsCtPresent[$uniqueData] = $ct;
                $questionsCtPresent[$uniqueData]['count']++;

                // Initialize missed and incorrect arrays if they don't exist
                if (!isset($questionsCtPresent[$uniqueData]['missed'])) {
                    $questionsCtPresent[$uniqueData]['missed'] = [];
                }
                if (!isset($questionsCtPresent[$uniqueData]['incorrect'])) {
                    $questionsCtPresent[$uniqueData]['incorrect'] = [];
                }
            }

            foreach ($ctDataValue as $ctDataValueKey => $ctDataValueValue) {
                $answer_arr = $answer_arr ?? [];
                $selectedAnswer = $answer_arr[$ctDataKey] ?? '';

                if (empty($selectedAnswer) || $selectedAnswer != "-") {
                    $answers = explode(",", $answer_arr[$ctDataKey] ?? '');
                    $pq = PracticeQuestion::where("id", $ctDataKey)->first();

                    foreach ($ctDataValueValue as $ctDataValueValueKey => $ctDataValueValueValue) {
                        $conceptCorrect = $checkboxData[$ctDataKey][$ctDataValueValueValue];
                        $missed = $catFinal[$ctDataValueKey]['missed'] ?? 0;
                        if (empty($selectedAnswer)) {
                            $catFinal[$ctDataValueKey]['missed'] = $missed + 1;
                        } else {
                            foreach ($conceptCorrect as $cp) {
                                if ($cp === "1") {
                                    $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
                                    $catFinal[$ctDataValueKey]['correct'] = $crt + 1;
                                } else {
                                    $nocrt = $catFinal[$ctDataValueKey]['incorrect'] ?? 0;
                                    $catFinal[$ctDataValueKey]['incorrect'] = $nocrt + 1;
                                }
                            }
                        }

                        // Track missed or incorrect questions
                        if (empty($selectedAnswer)) {
                            if (!in_array($ctDataKey, $questionsCtPresent[$ctDataValueKey]['missed'])) {
                                $questionsCtPresent[$ctDataValueKey]['missed'][] = $ctDataKey;
                            }
                        } else {
                            if (in_array("0", $conceptCorrect)) {
                                // if (!in_array($ctDataKey, $questionsCtPresent[$ctDataValueKey]['incorrect'])) {
                                $questionsCtPresent[$ctDataValueKey]['incorrect'][] = $ctDataKey;
                                // }
                            }
                        }
                    }
                }
            }
        }

        $categoryAndQuestionTypeSummaryData = [];

        if (!empty($checkData)) {
            $i = 0;
            foreach ($checkData as $key => $data) {
                $correct = $catFinal[$key]['correct'] ?? 0;
                $incorrect = $catFinal[$key]['incorrect'] ?? 0;
                $missed = $catFinal[$key]['missed'] ?? 0;

                $dataArray = [
                    'ct' => $key,
                    'qt' => $data,
                    'count' => $correct + $incorrect + $missed,
                    'correct' => $correct,
                    'incorrect' => $incorrect,
                    'missed' => $missed
                ];
                $total_qts = 0;
                $total_incorrect_qts = 0;
                $total_correct_qts = 0;
                foreach ($data as $dt) {
                    $total_incorrect_qts += $dt['incorrect'];
                    $total_correct_qts += $dt['correct'];
                    $total_qts += $dt['count'];
                }
                $dataArray['total_qts'] = $total_qts;
                $dataArray['total_incorrect_qts'] = $total_incorrect_qts;
                $dataArray['total_correct_qts'] = $total_correct_qts;
                $categoryAndQuestionTypeSummaryData[$i] = $dataArray;
                $i++;
            }

            if (!empty($categoryAndQuestionTypeSummaryData)) {
                $keys = array_column($categoryAndQuestionTypeSummaryData, 'incorrect');
                array_multisort($keys, SORT_DESC, $categoryAndQuestionTypeSummaryData);
            }
        }
        // dd($questionsCtPresent);

        // dd($categoryAndQuestionTypeSummaryData);

        $html = view('user.test-review.all',  [
            'category_data' => $category_data,
            'questionTypeData' => $questionTypeData,
            'questionsCtPresent' => $questionsCtPresent,
            'categoryTypeData' => $categoryTypeData,
            'checkboxData' => $checkboxData,
            'test_details' => $test_details,
            // 'section_id' => $id,
            'user_selected_answers' => $store_sections_details,
            'get_test_name' => $get_test_name,
            'store_all_data' => $store_all_data,
            'store_question_type_data' => $store_question_type_data,
            'question_tags' => $question_tags,
            'percentage_arr_all' => $percentage_arr_all,
            'test_det' => 'single',
            // 'right_answers' => $right_answers,
            // 'total_questions' => $total_questions,
            // 'scaled_score' => $scaled_score,
            // 'high_score' => $high_score,
            // 'low_score' => $low_score,
            // 'practice_test_section_id' => $practice_test_section_id,
            'categoryAndQuestionTypeSummaryData' => $categoryAndQuestionTypeSummaryData
        ])->render();
        return response()->json(['html' => $html]);
    }

    public function allTestInsights(Request $request)
    {
        $current_user_id = Auth::id();
        // $practice_test_section_id = $id;
        $get_test_name = 'name';
        $category_data = array();
        $percentage_arr_all = array();
        $store_sections_details = array();
        $categoryTypeData = [];
        $questionTypeData = [];
        $count = 0;
        $checkboxData = [];
        $categoryAndQuestionTypeSummaryData = [];
        // $testid = 553;
        $types = 'all';
        if ($request->query('testType') != null) {
            $testType = $request->query('testType');
        } else {
            return response()->json([
                'error' => 'Please select a Test Format!!!'
            ]);
        }
        $user_tests = DB::table('user_answers')->where('user_id', $current_user_id)->pluck('test_id')->toArray();

        $allTestsOfUser = DB::table('practice_tests')->where('user_id', $current_user_id)->where('format', $testType)->whereIn('id', $user_tests)->pluck('id')->toArray();

        $allTestsByUser = DB::table('user_answers')->whereIn('test_id', $allTestsOfUser)->distinct()->pluck('test_id')->toArray();

        // dump($current_user_id);
        // dd($allTestsByUser);
        if (empty($allTestsByUser)) {
            return response()->json([
                'error' => 'No test was found with this format!!!'
            ]);
            // return to_route('test-prep-insights')->with('error', 'No test was found with this format!!!');
        }
        $questionsCtPresent = [];
        $catFinal = [];

        foreach ($allTestsByUser as $testid) {
            $test_id = $testid;
            $test_category_type = DB::table('practice_questions')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->select('category_type', 'question_type_id')
                ->where('practice_test_sections.testid', $test_id)
                ->get();

            $test_details = PracticeTest::find($test_id);

            // dump($test_details);
            if ($types == 'all') {
                $store_all_data = array();
                $question_tags_all = [];
                $store_question_type_data = array();
                $check_question_answers = [];
                $get_test_questions = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select(
                        'practice_questions.id as test_question_id',
                        'practice_questions.question_type_id',
                        'practice_questions.category_type',
                        'practice_questions.mistake_type',
                        'practice_questions.tags as tags',
                        'practice_questions.answer as answer',
                        'practice_questions.category_type_values as category_type_values',
                        'practice_questions.question_type_values as question_type_values',
                        'practice_questions.checkbox_values as checkbox_values',
                        // 'practice_questions.notes',
                    )
                    ->where('practice_tests.id', $test_id)
                    ->whereIn('practice_test_sections.id', function ($query) use ($current_user_id, $test_id) {
                        $query->select('section_id')
                            ->from('user_answers')
                            ->where('user_id', $current_user_id)
                            ->where('test_id', $test_id);
                    })
                    ->orderBy('practice_questions.question_order', 'ASC')
                    ->get();
                // dump($get_test_questions);
                // foreach ($get_test_questions as $question) {
                //     $questionDetails = QuestionDetails::where("question_id", $question->test_question_id)->get();
                //     $questionTypeData[$question->test_question_id] = json_decode($question->question_type_values ?? '', true);
                //     $categoryTypeData[$question->test_question_id] = json_decode($question->category_type_values ?? '', true);
                //     $checkboxData[$question->test_question_id] = json_decode($question->checkbox_values ?? '', true);
                // }

                $questionTypeData = [];
                $categoryTypeData = [];
                $checkboxData = [];

                foreach ($get_test_questions as $question) {
                    // Fetch additional details only if details haven't been fetched already
                    if (!isset($questionTypeData[$question->test_question_id])) {
                        // Fetch additional details
                        $questionDetails = QuestionDetails::where("question_id", $question->test_question_id)->get();
                        $questionTypeData[$question->test_question_id] = json_decode($question->question_type_values ?? '', true);
                        $categoryTypeData[$question->test_question_id] = json_decode($question->category_type_values ?? '', true);
                        $checkboxData[$question->test_question_id] = json_decode($question->checkbox_values ?? '', true);
                    }
                }

                // Dump the category type data
                // dump($categoryTypeData);

                $user_answers_data = DB::table('user_answers')
                    ->where('user_id', $current_user_id)
                    ->where('test_id', $test_id)
                    ->latest()
                    ->get();
                $answer_arr = [];
                foreach ($user_answers_data as $user_answer) {
                    $answers = json_decode($user_answer->answer, true);
                    $answer_arr[] = $answers;
                }
                $answer_arr = $this->array_flatten($answer_arr);
                foreach ($get_test_questions as $question) {
                    if (isset($answer_arr[$question->test_question_id])  && !empty($answer_arr[$question->test_question_id])) {
                        if ($answer_arr[$question->test_question_id] == $question->answer) {
                            $check_question_answers[$question->test_question_id] = true;
                        } else {
                            $check_question_answers[$question->test_question_id] = false;
                        }
                    }
                }

                if (!$get_test_questions->isEmpty()) {
                    $percentage_arr_all = [];

                    foreach ($get_test_questions as $get_single_test_questions) {
                        $questionDetails = QuestionDetails::where("question_id", $get_single_test_questions->test_question_id)->get(['question_type', 'category_type'])->toArray();

                        $array_ques_type = array_map(function ($item) {
                            return $item['question_type'];
                        }, $questionDetails);

                        $array_cat_type = array_map(function ($item) {
                            return $item['category_type'];
                        }, $questionDetails);

                        $percentage_arr = [];

                        if (isset($array_cat_type) && !empty($array_cat_type) && isset($array_ques_type) && !empty($array_ques_type)) {
                            $mergedArray = [];

                            for ($i = 0; $i < count($array_ques_type); $i++) {
                                $mergedArray[$i] = [
                                    'category_type' => $array_cat_type[$i],
                                    'question_type' => $array_ques_type[$i]
                                ];
                            }

                            foreach ($check_question_answers as $q_id => $check_question_answer) {
                                if ($get_single_test_questions->test_question_id == $q_id) {
                                    $percentage_arr = [
                                        $q_id => $check_question_answer
                                    ];
                                }
                            }

                            foreach ($mergedArray as $type) {
                                $get_cat_name_by_id = DB::table('practice_category_types')
                                    ->where('id', $type['category_type'])
                                    ->get();

                                $get_ques_type_name_by_id = DB::table('question_types')
                                    ->where('id', $type['question_type'])
                                    ->get();

                                if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                    $percentage_arr_all[$get_cat_name_by_id[0]->category_type_title][] = $percentage_arr;
                                    $question_tags_all[$get_cat_name_by_id[0]->category_type_title][] = isset($get_single_test_questions->tags) ? explode(",", $get_single_test_questions->tags) : [];
                                }
                                if (isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title) && isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title)) {
                                    $store_all_data[$get_cat_name_by_id[0]->category_type_title][$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }

                        if (isset($array_ques_type) && !empty($array_ques_type)) {
                            foreach ($array_ques_type as $single_ques_type) {
                                $get_ques_type_name_by_id = DB::table('question_types')
                                    ->where('id', $single_ques_type)
                                    ->get();

                                if (isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title) && isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)) {
                                    $store_question_type_data[$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id, 'category_title' => $get_cat_name_by_id[0]->category_type_title, 'category_description' => $get_cat_name_by_id[0]->category_type_description, "category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson, "category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies, "category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods, "category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity, "question_desc" => $get_ques_type_name_by_id[0]->question_type_description, "question_type_title" => $get_ques_type_name_by_id[0]->question_type_title, "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson, "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods, "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }
                    }
                }
            }

            if ($types == 'all') {
                $question_tags = [];
                foreach ($question_tags_all as $key => $question_tag) {
                    $question_tags[$key] = array_unique(Arr::flatten($question_tag));
                }
            }
            // dump($percentage_arr_all);
            foreach ($percentage_arr_all as $key => $percentage) {
                $correct_ans = 0;
                $wrong_ans = 0;
                $total_question = $this->array_flatten(array_map("unserialize", array_unique(array_map("serialize", $percentage))));
                $count = count($total_question);
                $allCorrect = true;
                foreach ($total_question as $value) {
                    if ($value == true) {
                        $correct_ans++;
                    }

                    if ($value == false) {
                        $allCorrect = false;
                        $wrong_ans++;
                    }
                }
                if ($count !== 0) {
                    $percentage_arr_all[$key] = [
                        "correct_ans" => $correct_ans,
                        "wrong_ans" => $wrong_ans,
                        "percentage" => 100 * $wrong_ans / $count . '%',
                        "percentage_label" => ($correct_ans > $wrong_ans ? $correct_ans : $wrong_ans) . "/" . $count . ($correct_ans > $wrong_ans ? ' Correct' : ' Incorrect'),
                        "all_correct" => $allCorrect
                    ];
                    if ($allCorrect) {
                        $percentage_arr_all[$key]['percentage_label'] = 'No Incorrect Answer';
                    }
                }
            }
            $checkData = [];
            $ctData = [];

            // dump($categoryTypeData);

            foreach ($categoryTypeData as $key => $catData) {
                $initializedValues = [];

                foreach ($catData as $catKey => $cat) {
                    $answer_arr = $answer_arr ?? [];

                    // if ($key && array_key_exists($key, $answer_arr) && $answer_arr[$key] == "-") {
                    //     // Replace "-" with $catKey value
                    //     if ($catKey == 'F' || $catKey == 'G' || $catKey == 'H' || $catKey == 'J' || $catKey == 'K') {
                    //         $answer_arr[$key] = 'f';
                    //     } elseif ($catKey == 'A' || $catKey == 'B' || $catKey == 'C' || $catKey == 'D' || $catKey == 'E') {
                    //         $answer_arr[$key] = 'a';
                    //     }
                    // }
                    $selected_answer = $answer_arr[$key] ?? '';

                    if ($selected_answer != "-") {
                        $answers = explode(",", $selected_answer);
                        if (in_array(strtolower($catKey), $answers) || empty($selected_answer)) {
                            $pq = PracticeQuestion::where("id", $key)->first();

                            foreach ($cat as $catKey1 => $catId) {
                                $tmp = $ctData[$key][$catId] ?? [];
                                if (!in_array($catKey, $tmp)) {
                                    $ctData[$key][$catId][] = $catKey;
                                }

                                $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] ?? 0;
                                $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] ?? 0;
                                $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] ?? 0;
                                $count = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['count'] ?? 0;

                                $conceptCorrect = $checkboxData[$key][$catKey][$catKey1] ?? "0";

                                if (empty($selected_answer)) {
                                    // $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;
                                    // $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;
                                    $uniqueValue = $questionTypeData[$key][$catKey][$catKey1];

                                    // Check if initialization has occurred for this unique value across all iterations
                                    if (!isset($initializedValues[$uniqueValue])) {
                                        // Perform the initialization
                                        $checkData[$catId][$uniqueValue]['missed'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['missed'] + 1;

                                        // Set the flag to indicate that initialization has occurred for this unique value
                                        $initializedValues[$uniqueValue] = true;
                                    }
                                } else {
                                    if ($conceptCorrect == "1") {
                                        $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['correct'] + 1;
                                    } else {
                                        $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] = $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['incorrect'] + 1;
                                    }
                                }

                                $checkData[$catId][$questionTypeData[$key][$catKey][$catKey1]]['count'] = $count + 1;
                            }
                        }
                    }
                }
            }

            // dump($ctData);
            // foreach ($ctData as $ctDataKey => $ctDataValue) {
            //     $ctDataUniqueValue = array_unique(array_keys($ctDataValue));

            //     foreach ($ctDataUniqueValue as $uniqueData) {
            //         $ct = $questionsCtPresent[$uniqueData] ?? 0;
            //         $questionsCtPresent[$uniqueData] = $ct + 1;
            //     }
            //     foreach ($ctDataValue as $ctDataValueKey => $ctDataValueValue) {
            //         $answer_arr = $answer_arr ?? [];
            //         $selectedAnswer = $answer_arr[$ctDataKey] ?? '';
            //         if (empty($selectedAnswer) || $selectedAnswer != "-") {
            //             $answers = explode(",", $answer_arr[$ctDataKey] ?? '');
            //             $pq = PracticeQuestion::where("id", $ctDataKey)->first();
            //             foreach ($ctDataValueValue as $ctDataValueValueKey => $ctDataValueValueValue)
            //                 $conceptCorrect = $checkboxData[$ctDataKey][$ctDataValueValueValue];
            //             $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
            //             $missed = $catFinal[$ctDataValueKey]['missed'] ?? 0;
            //             if (empty($selectedAnswer)) {
            //                 $catFinal[$ctDataValueKey]['missed'] = $missed + 1;
            //             } else {
            //                 foreach ($conceptCorrect as $cp) {
            //                     if ($cp === "1") {
            //                         $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
            //                         $catFinal[$ctDataValueKey]['correct'] = $crt + 1;
            //                     } else {
            //                         $nocrt = $catFinal[$ctDataValueKey]['incorrect'] ?? 0;
            //                         $catFinal[$ctDataValueKey]['incorrect'] = $nocrt + 1;
            //                     }
            //                 }
            //             }
            //         }
            //     }
            // }

            foreach ($ctData as $ctDataKey => $ctDataValue) {
                $ctDataUniqueValue = array_unique(array_keys($ctDataValue));

                foreach ($ctDataUniqueValue as $uniqueData) {
                    $ct = $questionsCtPresent[$uniqueData] ?? ['count' => 0, 'missed' => [], 'incorrect' => []];
                    $questionsCtPresent[$uniqueData] = $ct;
                    $questionsCtPresent[$uniqueData]['count']++;

                    // Initialize missed and incorrect arrays if they don't exist
                    if (!isset($questionsCtPresent[$uniqueData]['missed'])) {
                        $questionsCtPresent[$uniqueData]['missed'] = [];
                    }
                    if (!isset($questionsCtPresent[$uniqueData]['incorrect'])) {
                        $questionsCtPresent[$uniqueData]['incorrect'] = [];
                    }
                }

                foreach ($ctDataValue as $ctDataValueKey => $ctDataValueValue) {
                    $answer_arr = $answer_arr ?? [];
                    $selectedAnswer = $answer_arr[$ctDataKey] ?? '';

                    if (empty($selectedAnswer) || $selectedAnswer != "-") {
                        $answers = explode(",", $answer_arr[$ctDataKey] ?? '');
                        $pq = PracticeQuestion::where("id", $ctDataKey)->first();

                        foreach ($ctDataValueValue as $ctDataValueValueKey => $ctDataValueValueValue) {
                            $conceptCorrect = $checkboxData[$ctDataKey][$ctDataValueValueValue];
                            $missed = $catFinal[$ctDataValueKey]['missed'] ?? 0;
                            if (empty($selectedAnswer)) {
                                $catFinal[$ctDataValueKey]['missed'] = $missed + 1;
                            } else {
                                foreach ($conceptCorrect as $cp) {
                                    if ($cp === "1") {
                                        $crt = $catFinal[$ctDataValueKey]['correct'] ?? 0;
                                        $catFinal[$ctDataValueKey]['correct'] = $crt + 1;
                                    } else {
                                        $nocrt = $catFinal[$ctDataValueKey]['incorrect'] ?? 0;
                                        $catFinal[$ctDataValueKey]['incorrect'] = $nocrt + 1;
                                    }
                                }
                            }

                            // Track missed or incorrect questions
                            if (empty($selectedAnswer)) {
                                if (!in_array($ctDataKey, $questionsCtPresent[$ctDataValueKey]['missed'])) {
                                    $questionsCtPresent[$ctDataValueKey]['missed'][] = $ctDataKey;
                                }
                            } else {
                                if (in_array("0", $conceptCorrect)) {
                                    // if (!in_array($ctDataKey, $questionsCtPresent[$ctDataValueKey]['incorrect'])) {
                                    $questionsCtPresent[$ctDataValueKey]['incorrect'][] = $ctDataKey;
                                    // }
                                }
                            }
                        }
                    }
                }
            }


            // dump($checkData);
            if (!empty($checkData)) {
                foreach ($checkData as $key => $data) {
                    $correct = $catFinal[$key]['correct'] ?? 0;
                    $incorrect = $catFinal[$key]['incorrect'] ?? 0;
                    $missed = $catFinal[$key]['missed'] ?? 0;

                    $dataArray = [
                        'ct' => $key,
                        'correct' => $correct,
                        'incorrect' => $incorrect,
                        'missed' => $missed,
                        'count' => $correct + $incorrect + $missed, // Include count here
                    ];

                    $total_qts = 0;
                    $total_incorrect_qts = 0;
                    $total_correct_qts = 0;

                    foreach ($data as $dt) {
                        $total_incorrect_qts += $dt['incorrect'];
                        $total_correct_qts += $dt['correct'];
                        $total_qts += $dt['count'];
                    }

                    $dataArray['total_qts'] = $total_qts;
                    $dataArray['total_incorrect_qts'] = $total_incorrect_qts;
                    $dataArray['total_correct_qts'] = $total_correct_qts;

                    // Check if an entry with the same 'ct' key already exists
                    $existingKey = array_search($key, array_column($categoryAndQuestionTypeSummaryData, 'ct'));
                    if ($existingKey !== false) {
                        // Update the counts in the existing entry
                        $categoryAndQuestionTypeSummaryData[$existingKey]['correct'] += $correct;
                        $categoryAndQuestionTypeSummaryData[$existingKey]['incorrect'] += $incorrect;
                        $categoryAndQuestionTypeSummaryData[$existingKey]['missed'] += $missed;
                        $categoryAndQuestionTypeSummaryData[$existingKey]['total_qts'] += $total_qts;
                        $categoryAndQuestionTypeSummaryData[$existingKey]['total_incorrect_qts'] += $total_incorrect_qts;
                        $categoryAndQuestionTypeSummaryData[$existingKey]['total_correct_qts'] += $total_correct_qts;
                        $categoryAndQuestionTypeSummaryData[$existingKey]['count'] = $dataArray['count']; // Update count

                        // Append the new 'qt' data if it's not already present
                        foreach ($data as $qtKey => $qtData) {
                            if (!isset($categoryAndQuestionTypeSummaryData[$existingKey]['qt'][$qtKey])) {
                                $categoryAndQuestionTypeSummaryData[$existingKey]['qt'][$qtKey] = $qtData;
                            } else {
                                // If the 'qt' data already exists, update it
                                $categoryAndQuestionTypeSummaryData[$existingKey]['qt'][$qtKey]['correct'] += $qtData['correct'];
                                $categoryAndQuestionTypeSummaryData[$existingKey]['qt'][$qtKey]['incorrect'] += $qtData['incorrect'];
                                $categoryAndQuestionTypeSummaryData[$existingKey]['qt'][$qtKey]['missed'] += $qtData['missed'];
                                $categoryAndQuestionTypeSummaryData[$existingKey]['qt'][$qtKey]['count'] += $qtData['count'];
                            }
                        }
                    } else {
                        // Append the new entry
                        $dataArray['qt'] = $data; // Include 'qt' data
                        $categoryAndQuestionTypeSummaryData[] = $dataArray;
                    }
                }

                if (!empty($categoryAndQuestionTypeSummaryData)) {
                    // Sort the array based on 'incorrect' count
                    $keys = array_column($categoryAndQuestionTypeSummaryData, 'incorrect');
                    array_multisort($keys, SORT_DESC, $categoryAndQuestionTypeSummaryData);
                }
            }
        }
        // dd($questionsCtPresent);
        // dd($categoryAndQuestionTypeSummaryData);


        $html = view('user.test-review.all',  [
            'category_data' => $category_data,
            'questionTypeData' => $questionTypeData,
            'questionsCtPresent' => $questionsCtPresent,
            'categoryTypeData' => $categoryTypeData,
            'checkboxData' => $checkboxData,
            'test_details' => $test_details,
            // 'section_id' => $id,
            'user_selected_answers' => $store_sections_details,
            'get_test_name' => $get_test_name,
            'store_all_data' => $store_all_data,
            'store_question_type_data' => $store_question_type_data,
            'question_tags' => $question_tags,
            'percentage_arr_all' => $percentage_arr_all,
            'test_det' => 'all',
            // 'right_answers' => $right_answers,
            // 'total_questions' => $total_questions,
            // 'scaled_score' => $scaled_score,
            // 'high_score' => $high_score,
            // 'low_score' => $low_score,
            // 'practice_test_section_id' => $practice_test_section_id,
            'categoryAndQuestionTypeSummaryData' => $categoryAndQuestionTypeSummaryData
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function addNotesToQuestionReview(Request $request)
    {
        $notes = $request->notes ?? "";
        $questionId = $request->questionId ?? "";

        if (!empty($notes) && !empty($questionId)) {
            $practiceQuestion = new PracticeQuestionNote;
            $practiceQuestion->practice_question_id = $questionId;
            $practiceQuestion->user_id = Auth::user()->id;
            $practiceQuestion->notes = $notes;
            $practiceQuestion->save();
            return response()->json(['message' => 'success', 'data' => ['practiceQuestion' => $practiceQuestion]]);
        }
        return response()->json(['message' => 'failed']);
    }

    public function test_progress_store(Request $request)
    {
        $current_user_id = Auth::id();
        $get_section_id = $request->get_section_id;
        $get_question_type = $request->get_question_type;
        $get_practice_id = $request->get_practice_id;
        $progress_index = $request->progress_index;
        $actual_time = $request->actual_time;
        $time_left = $request->time_left;
        $curr_question_id = $request->curr_question_id;

        $selected_flag_val = $request->selected_flag_val;
        $selected_skip_val = $request->selected_skip_val;
        $selected_guess_val = $request->selected_guess_val;


        $filtered_answers = isset($request->selected_answer) ? array_filter($request->selected_answer) : [];

        $get_question_ids_array = [];

        if (isset($filtered_answers) && !empty($filtered_answers)) {
            $get_question_ids_array = array_keys($filtered_answers);
            if (!in_array($curr_question_id, $get_question_ids_array)) {
                array_push($get_question_ids_array, $curr_question_id);
                $filtered_answers[$curr_question_id] = '-';
            }
        }

        $existingRecord = TestProgress::where('section_id', $get_section_id)
            ->where('user_id', $current_user_id)
            ->first();


        if ($existingRecord) {
            $get_question_ids_array = json_decode($existingRecord->question_id);
            if ($existingRecord->is_submit) {
                // $existingRecord->delete();
                return response()->json(['message' => 'delete', 'data' => ['selected_answer' => json_decode($existingRecord->selected_answer, true)]]);
            }

            $filtered_guess = [];

            if (!empty($existingRecord->guess)) {
                $filtered_guess = json_decode($existingRecord->guess, true);
            }
            $filtered_guess[$curr_question_id] = $selected_guess_val;
            ksort($filtered_guess);

            $filtered_flag = [];
            if (!empty($existingRecord->flag)) {
                $filtered_flag = json_decode($existingRecord->flag, true);
            }
            $filtered_flag[$curr_question_id] = $selected_flag_val;
            ksort($filtered_flag);

            $filtered_skip = [];
            if (!empty($existingRecord->skip)) {
                $filtered_skip = json_decode($existingRecord->skip, true);
            }
            $filtered_skip[$curr_question_id] = $selected_skip_val;
            ksort($filtered_skip);

            $new_answered = [];
            if (!empty($existingRecord->selected_answer)) {
                $new_answered = json_decode($existingRecord->selected_answer, true);
            }
            if (array_key_exists($curr_question_id, $filtered_answers)) {
                $new_answered[$curr_question_id] = $filtered_answers[$curr_question_id];
            }

            ksort($new_answered);

            $updates = [
                'question_id' => json_encode($get_question_ids_array),
                'selected_answer' => json_encode($new_answered),
                'guess' => json_encode($filtered_guess),
                'flag' => json_encode($filtered_flag),
                'skip' => json_encode($filtered_skip),
                'test_id' => $get_practice_id,
                'progress_index' => $progress_index,
                'actual_time' => $actual_time,
                'time_left' => $time_left,
            ];

            TestProgress::where('section_id', $get_section_id)
                ->where('user_id', $current_user_id)
                ->update($updates);
            // $existingRecord->update($updates);
        } else {
            $filtered_guess = $filtered_flag = $filtered_skip = [];
            foreach ($get_question_ids_array as $key => $question_id) {
                if ($question_id == $curr_question_id) {
                    $filtered_guess[$curr_question_id] = $selected_guess_val;
                    $filtered_flag[$curr_question_id] = $selected_flag_val;
                    $filtered_skip[$curr_question_id] = $selected_skip_val;
                } else {
                    $filtered_guess[$question_id] = 'no';
                    $filtered_flag[$question_id] = 'no';
                    $filtered_skip[$question_id] = 'no';
                }
            }

            ksort($get_question_ids_array);
            ksort($filtered_answers);
            ksort($filtered_guess);
            ksort($filtered_flag);
            ksort($filtered_skip);

            $testProgress = new TestProgress();
            $testProgress->user_id = $current_user_id;
            $testProgress->section_id = $get_section_id;
            $testProgress->question_id = json_encode($get_question_ids_array);
            $testProgress->selected_answer = json_encode($filtered_answers);
            $testProgress->guess = json_encode($filtered_guess);
            $testProgress->flag = json_encode($filtered_flag);
            $testProgress->skip = json_encode($filtered_skip);
            $testProgress->test_id = $get_practice_id;
            $testProgress->progress_index = $progress_index;
            $testProgress->actual_time = $actual_time;
            $testProgress->time_left = $time_left;
            $testProgress->save();
            $existingRecord = $testProgress;
        }
        dump($existingRecord);
        return response()->json(['message' => 'success', 'data' => [
            'selected_answer' => json_decode($existingRecord->selected_answer, true)
        ]]);
    }

    public function check_progress(Request $request)
    {
        $userId = Auth::id();
        $sectionId = $request->sectionId;
        $progressFlag = false;

        $existingProgress = TestProgress::where('section_id', $sectionId)
            ->where('user_id', $userId)
            ->first();
        if ($existingProgress) {
            $progressFlag = true;
            $timeLeft = $existingProgress->time_left;
        }


        return response()->json(['existingProgress' => $existingProgress ?? null, 'progressFlag' => $progressFlag]);
    }

    // calc section score and redirect.
    public function set_answers(Request $request)
    {
        // dd($request);
        $current_user_id = Auth::id();
        $get_section_id = $request->get_section_id;
        $get_question_type = $request->get_question_type;
        $get_practice_id = $request->get_practice_id;
        $actual_time = $request->actual_time;
        $user_reading_score = $request->userReadingActualScore;
        // dd($user_reading_score);
        $user_math_score = $request->userMathActualScore;
        // $user_total_score = $request->userTotalActualScore;
        $user_hour = $request->userHour;
        $user_mins = $request->userMinutes;
        $user_secs = $request->userSeconds;

        $user_math_hour = $request->userMathHour;
        $user_math_mins = $request->userMathMinutes;
        $user_math_secs = $request->userMathSeconds;

        $test = DB::table('practice_tests')->where('id', $get_practice_id)->first();
        // dd($test);
        $is_proctored = 0;
        if ($test->test_source == 1 && ($test->format == 'DSAT' || $test->format == 'DPSAT')) {
            if ($user_reading_score > 0 || $user_hour || $user_mins || $user_secs) {
                // dd($test->test_source);
                $readingTest = DB::table('practice_test_sections')
                    ->select('id', 'testid', 'practice_test_type')
                    ->where('testid', $test->id)
                    ->where(function ($query) {
                        $query
                            ->where('practice_test_type', 'Reading_And_Writing')
                            ->orWhere('practice_test_type', 'Easy_Reading_And_Writing')
                            ->orWhere('practice_test_type', 'Hard_Reading_And_Writing');
                    })
                    ->get();
                foreach ($readingTest as $score) {
                    $scoreValue = DB::table('user_answers')
                        ->where('section_id', $score->id)
                        ->update(['reading_and_writing_score' => $user_reading_score, 'hours' => $user_hour, 'minutes' => $user_mins, 'seconds' => $user_secs, 'deleted_at' => null]);
                }
                // dd($scoreValue);
            }


            if ($user_math_score > 0 || $user_math_hour > 0 || $user_math_mins > 0 || $user_math_secs > 0) {
                // dd($user_math_hour );
                $mathTest = DB::table('practice_test_sections')
                    ->select('id', 'testid', 'practice_test_type')
                    ->where('testid', $test->id)
                    ->where(function ($query) {
                        $query
                            ->where('practice_test_type', 'Math')
                            ->orWhere('practice_test_type', 'Math_no_calculator')
                            ->orWhere('practice_test_type', 'Math_with_calculator');
                    })
                    ->get();


                // dd($mathTest);
                foreach ($mathTest as $scoreMa) {
                    $scoreValueMa = DB::table('user_answers')
                        ->where('section_id', $scoreMa->id)
                        ->update(['math_score' => $user_reading_score, 'hours' => $user_math_hour, 'minutes' => $user_math_mins, 'seconds' => $user_math_secs, 'deleted_at' => null]);
                }
            }

            if ($request->test_type == 'proctored') {
                $is_proctored = 1;
            } else {
                $is_proctored = 0;
            }
        }
        // if ($user_actual_time  &&  $user_actual_score == null) {
        //     return response()->json(
        //         [
        //             'error' => '1',
        //         ]
        //     );
        // }


        if (isset($get_question_type) && !empty($get_question_type) && $get_question_type == 'single') {
            $get_question_title = DB::table('practice_tests')
                ->join('practice_test_sections', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->join('practice_questions', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->select('practice_tests.*')
                ->where('practice_questions.practice_test_sections_id', $get_section_id)->get();
        } else if (isset($get_question_type) && !empty($get_question_type) && $get_question_type == 'all') {
            $get_question_title = DB::table('practice_tests')
                ->join('practice_test_sections', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->join('practice_questions', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->select('practice_tests.*', 'practice_test_sections.id as test_section_id', 'practice_questions.id as test_question_id')
                ->where('practice_tests.id', $get_section_id)->get();
        }

        $get_test_name = $get_question_title[0]->title;

        //$filtered_answers = array_filter($request->selected_answer);
        $filtered_answers = isset($request->selected_answer) ? array_filter($request->selected_answer) : [];
        $filtered_guess = isset($request->selected_gusess_details) ? array_filter($request->selected_gusess_details) : [];
        $filtered_flag = isset($request->selected_flag_details) ? array_filter($request->selected_flag_details) : [];
        $filtered_skip = isset($request->selected_skip_details) ? array_filter($request->selected_skip_details) : [];

        $get_question_ids_array = [];
        if (isset($get_question_type) && !empty($get_question_type) && $get_question_type == 'single') {
            if (isset($filtered_answers) && !empty($filtered_answers)) {
                $get_question_ids_array = array_keys($filtered_answers);
            }

            if (DB::table('user_answers')->where('section_id', $get_section_id)->where('user_id', $current_user_id)->exists()) {
                DB::table('user_answers')
                    ->where('section_id', $get_section_id)
                    ->update(['question_id' => json_encode($get_question_ids_array), 'answer' => json_encode($filtered_answers), 'guess' => json_encode($filtered_guess), 'flag' => json_encode($filtered_flag), 'test_id' => $get_practice_id, 'actual_time' => $actual_time]);
            } else {
                $userAnswers = new UserAnswers();
                $userAnswers->user_id = $current_user_id;
                $userAnswers->section_id = $get_section_id;
                $userAnswers->skip = '';
                $userAnswers->question_id = json_encode($get_question_ids_array);
                $userAnswers->answer = json_encode($filtered_answers);
                $userAnswers->guess = json_encode($filtered_guess);
                $userAnswers->flag = json_encode($filtered_flag);
                $userAnswers->skip = json_encode($filtered_skip);
                $userAnswers->test_id = $get_practice_id;
                $userAnswers->actual_time = $actual_time;
                $userAnswers->reading_and_writing_score = $user_reading_score;
                $userAnswers->math_score = $user_math_score;
                // $userAnswers->total_score = $user_total_score;

                if ($user_hour || $user_mins || $user_secs) {
                    $userAnswers->hours = $user_hour;
                    $userAnswers->minutes = $user_mins;
                    $userAnswers->seconds = $user_secs;
                }

                if ($user_math_hour || $user_math_mins || $user_math_secs) {
                    $userAnswers->hours = $user_math_hour;
                    $userAnswers->minutes = $user_math_mins;
                    $userAnswers->seconds = $user_math_secs;
                }

                $userAnswers->is_proctored = $is_proctored;
                $userAnswers->save();
            }
        } else if (isset($get_question_type) && !empty($get_question_type) && $get_question_type == 'all') {
            $store_querstion_answer_details = array();
            if (isset($get_question_title) && !empty($get_question_title)) {
                foreach ($get_question_title as $single_get_questions_title) {
                    if (isset($filtered_answers) && !empty($filtered_answers)) {
                        foreach ($filtered_answers as $user_question_id => $single_filtered_answers) {
                            if ($single_get_questions_title->test_question_id == $user_question_id) {
                                $store_querstion_answer_details[$single_get_questions_title->test_section_id]['answers'][$single_get_questions_title->test_question_id] = $single_filtered_answers;
                            }
                        }
                    }
                }
            }
            if (isset($get_question_title) && !empty($get_question_title)) {
                foreach ($get_question_title as $single_get_questions_title) {
                    if (isset($filtered_guess) && !empty($filtered_guess)) {
                        foreach ($filtered_guess as $user_question_id => $single_filtered_guess) {
                            if ($single_get_questions_title->test_question_id == $user_question_id) {
                                $store_querstion_answer_details[$single_get_questions_title->test_section_id]['guess'][$single_get_questions_title->test_question_id] = $single_filtered_guess;
                            }
                        }
                    }
                }
            }

            if (isset($get_question_title) && !empty($get_question_title)) {
                foreach ($get_question_title as $single_get_questions_title) {
                    if (isset($filtered_flag) && !empty($filtered_flag)) {
                        foreach ($filtered_flag as $user_question_id => $single_filtered_flag) {
                            if ($single_get_questions_title->test_question_id == $user_question_id) {
                                $store_querstion_answer_details[$single_get_questions_title->test_section_id]['flag'][$single_get_questions_title->test_question_id] = $single_filtered_flag;
                            }
                        }
                    }
                }
            }

            if (isset($get_question_title) && !empty($get_question_title)) {
                foreach ($get_question_title as $single_get_questions_title) {
                    if (isset($filtered_skip) && !empty($filtered_skip)) {
                        foreach ($filtered_skip as $user_question_id => $single_filtered_skip) {
                            if ($single_get_questions_title->test_question_id == $user_question_id) {
                                $store_querstion_answer_details[$single_get_questions_title->test_section_id]['skip'][$single_get_questions_title->test_question_id] = $single_filtered_skip;
                            }
                        }
                    }
                }
            }

            if (isset($store_querstion_answer_details) && !empty($store_querstion_answer_details)) {
                foreach ($store_querstion_answer_details as $key => $values) {
                    $get_question_ids_array = array_keys($values['answers']);
                    if (DB::table('user_answers')->where('section_id', $key)->where('user_id', $current_user_id)->exists()) {
                        DB::table('user_answers')
                            ->where('section_id', $key)
                            ->update(['question_id' => json_encode($get_question_ids_array), 'answer' => json_encode($values['answers']), 'guess' => json_encode($values['guess']), 'flag' => json_encode($values['flag']), 'test_id' => $get_practice_id, 'actual_time' => $actual_time]);
                    } else {
                        $userAnswers = new UserAnswers();
                        $userAnswers->user_id = $current_user_id;
                        $userAnswers->section_id = $key;
                        $userAnswers->question_id = json_encode($get_question_ids_array);
                        $userAnswers->answer = json_encode($values['answers']);
                        $userAnswers->guess = json_encode($values['guess']);
                        $userAnswers->flag = json_encode($values['flag']);
                        $userAnswers->skip = json_encode($values['skip']);
                        $userAnswers->test_id = $get_practice_id;
                        $userAnswers->actual_time = $actual_time;
                        $userAnswers->reading_and_writing_score = $user_reading_score;
                        $userAnswers->math_score = $user_math_score;
                        // $userAnswers->total_score = $user_total_score;
                        if ($user_hour || $user_mins || $user_secs) {
                            $userAnswers->hours = $user_hour;
                            $userAnswers->minutes = $user_mins;
                            $userAnswers->seconds = $user_secs;
                        }

                        if ($user_math_hour || $user_math_mins || $user_math_secs) {
                            $userAnswers->hours = $user_math_hour;
                            $userAnswers->minutes = $user_math_mins;
                            $userAnswers->seconds = $user_math_secs;
                        }
                        $userAnswers->is_proctored = $is_proctored;
                        $userAnswers->save();
                    }
                }
            }
        }
        $set_completed_section_id = array();
        $get_users_answers_section_id = DB::table('user_answers')
            ->select('user_answers.section_id')
            ->where('user_answers.user_id', $current_user_id)
            ->where('user_answers.test_id', $get_practice_id)
            ->get();
        if (!$get_users_answers_section_id->isEmpty()) {
            foreach ($get_users_answers_section_id as $key => $single_values) {
                array_push($set_completed_section_id, $single_values->section_id);
            }
        } else {
            $set_completed_section_id = array();
        }

        $get_total_question = DB::table('practice_questions')
            ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
            ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
            ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.tags', 'passages.*', 'practice_tests.*', 'practice_test_sections.*')
            ->where('practice_tests.id', $request->get_section_id)
            ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
            ->count();

        DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_tests.id', '=', 'practice_test_sections.testid')
            ->where('practice_test_sections.id', '=', $request->get_section_id)
            ->update([
                'practice_tests.user_id' => $current_user_id,
                'practice_tests.updated_at' => DB::raw('NOW()')
            ]);

        $existingRecord = TestProgress::where('section_id', $get_section_id)
            ->where('user_id', $current_user_id)
            ->first();

        if ($existingRecord) {
            $existingRecord->update([
                'is_submit' => 1,
            ]);
        }

        $id = $request->section_id;

        $testSection = DB::table('practice_test_sections')
            ->where('practice_test_sections.id', $id)
            ->get();

        $toSeciton = '';
        $breakTime = 0;
        $totalScore = 0;
        $requiredScore = 0;
        $next_section_id = 0;
        $redirectUrl = 0;
        $redirectFromWhere = 0;
        $answers = $request->selected_answer;

        // lets calculate the score and redirect to other sections based on the required_number_of_correct_answers.
        $checkTestFormat = DB::table('practice_tests')->where('id', $testSection[0]->testid)->first();
        if ($checkTestFormat->test_source == 0 || $request->test_type == 'proctored') {
            // dd('hey');
            if (isset($testSection[0]->id)) {
                if (($testSection[0]->format == 'DSAT') ||  ($testSection[0]->format == 'DPSAT')) {
                    $currectSection = DB::table('practice_test_sections')
                        ->where('id', $id)
                        ->first();

                    $requiredScore = $testSection[0]->required_number_of_correct_answers ? $testSection[0]->required_number_of_correct_answers : 0;

                    if ($answers) {
                        foreach ($answers as $key => $answer) {
                            $is_correct = PracticeQuestion::where('practice_test_sections_id', $id)
                                ->where('id', $key)
                                ->where('answer', $answer)
                                ->first('id');
                            if ($is_correct) {
                                $totalScore++;
                                // $totalScore = 10;
                            }
                        }
                    }

                    // dump($currectSection);
                    // dump('Total Score: '.$totalScore);
                    // dump('Required Score: '.$requiredScore);

                    // redirect to easy or hard section.
                    if ($totalScore >= $requiredScore) {
                        // redirect to hard section
                        $toSeciton = 'hard';
                        $engSeciton = 'Hard_Reading_And_Writing';
                        $mathSeciton = 'Math_no_calculator';
                    } else {
                        // redirect to easy section.
                        $toSeciton = 'easy';
                        $engSeciton = 'Easy_Reading_And_Writing';
                        $mathSeciton = 'Math_with_calculator';
                    }

                    // dump('Redirect to which section: '.$toSeciton);
                    if ($request->section_size == 'all') {
                        // dump('All section test');
                        if ($request->test_type == 'proctored') {
                            $redirectUrl = '/user/official-practice-test/';
                        } else {
                            $redirectUrl = '/user/practice-test/';
                        }
                        // redirect to hard module
                        $allTestSection = DB::table('practice_test_sections')
                            ->where('practice_test_sections.testid', $testSection[0]->testid)
                            ->where('practice_test_sections.section_title', 'LIKE', '%' . $toSeciton . '%')
                            ->first();

                        if ($allTestSection) {
                            if ($request->section_size == 'all') {
                                $redirectUrl .= $allTestSection->id . '?test_id=' . $testSection[0]->testid . '&time=regular&section=all';
                            } else {
                                $redirectUrl .= $allTestSection->id . '?test_id=' . $testSection[0]->testid . '&time=regular';
                            }
                        } else {
                            $redirectUrl = 0;
                        }
                    } else {
                        // dump('Single section test');
                        if ($request->test_type == 'proctored') {
                            $redirectUrl = '/user/official-practice-test/';
                        } else {
                            $redirectUrl = '/user/practice-test/';
                        }
                        // redirect to easy module
                        if (in_array($currectSection->practice_test_type, ['Math', 'Math_with_calculator', 'Math_no_calculator'])) {
                            $allTestSection = DB::table('practice_test_sections')
                                ->where('practice_test_sections.testid', $testSection[0]->testid)
                                ->where('practice_test_sections.practice_test_type', $mathSeciton)
                                // ->where('practice_test_sections.section_title','LIKE', '%easy%')
                                ->where('practice_test_sections.section_title', 'LIKE', '%' . $toSeciton . '%')
                                ->first();
                        }

                        if (in_array($currectSection->practice_test_type, ['Reading_And_Writing', 'Easy_Reading_And_Writing', 'Hard_Reading_And_Writing'])) {
                            $allTestSection = DB::table('practice_test_sections')
                                ->where('practice_test_sections.testid', $testSection[0]->testid)
                                ->where('practice_test_sections.practice_test_type', $engSeciton)
                                // ->where('practice_test_sections.section_title','LIKE', '%easy%')
                                ->where('practice_test_sections.section_title', 'LIKE', '%' . $toSeciton . '%')
                                ->first();
                        }

                        if ($allTestSection) {
                            // section=all
                            if ($request->section_size == 'all') {
                                $redirectUrl .= $allTestSection->id . '?test_id=' . $testSection[0]->testid . '&time=regular&section=all';
                            } else {
                                $redirectUrl .= $allTestSection->id . '?test_id=' . $testSection[0]->testid . '&time=regular';
                            }
                        } else {
                            $redirectUrl = 0;
                        }
                    }
                    // dump($allTestSection);
                    // dump($redirectUrl);
                    $currectSection->section_title = strtolower($currectSection->section_title);
                    // dump($currectSection);
                    // check here the number of sections.
                    // then check if there are two module sections and then set the time break.
                    $sectionIds = DB::table('practice_test_sections')
                        ->where('practice_test_sections.testid', $testSection[0]->testid)
                        ->pluck('id');

                    // if (strpos($currectSection->practice_test_type, 'easy') == true) {
                    if (strpos($currectSection->section_title, 'easy') == true) {
                        $redirectUrl = 0;

                        // section=all
                        if ($request->section_size == 'all') {
                            if (count($sectionIds) > 2) {
                                $mathSectionId = DB::table('practice_test_sections')
                                    ->where('practice_test_sections.testid', $testSection[0]->testid)
                                    ->where('practice_test_sections.practice_test_type', 'Math')
                                    ->first();
                                // dump($mathSectionId);
                                $rwSectionId = DB::table('practice_test_sections')
                                    ->where('practice_test_sections.testid', $testSection[0]->testid)
                                    ->where('practice_test_sections.practice_test_type', 'Reading_And_Writing')
                                    ->first();
                                // dump($rwSectionId);
                                $breakTime = 1;
                                if ($currectSection->practice_test_type == 'Math_with_calculator') {
                                    // $next_section_id = $mathSectionId->id;
                                    $next_section_id = $rwSectionId->id;
                                } else {
                                    // $next_section_id = $mathSectionId->id;
                                    $next_section_id = $mathSectionId->id;
                                }
                            }
                        }
                    }
                    // dump($next_section_id);
                    if (strpos($currectSection->section_title, 'hard') == true) {
                        $redirectUrl = 0;

                        // section=all
                        if ($request->section_size == 'all') {
                            if (count($sectionIds) > 2) {
                                $mathSectionId = DB::table('practice_test_sections')
                                    ->where('practice_test_sections.testid', $testSection[0]->testid)
                                    ->where('practice_test_sections.practice_test_type', 'Math')
                                    ->first();
                                // dump($mathSectionId);
                                $rwSectionId = DB::table('practice_test_sections')
                                    ->where('practice_test_sections.testid', $testSection[0]->testid)
                                    ->where('practice_test_sections.practice_test_type', 'Reading_And_Writing')
                                    ->first();
                                // dump($rwSectionId);

                                $breakTime = 1;
                                if (in_array($currectSection->practice_test_type, ['Math_with_calculator', 'Math_no_calculator'])) {
                                    $next_section_id = $rwSectionId->id;
                                    // dump($next_section_id);
                                } else {
                                    $next_section_id = $mathSectionId->id;
                                    // dump($next_section_id);
                                }
                            }
                        }
                    }
                }
            }
        }

        // dump($next_section_id);
        // dump($redirectUrl);
        return response()->json(
            [
                'success' => '0',
                'break_time' => $breakTime,
                'next_section_id' => $next_section_id,
                'section_id' => $get_section_id,
                'redirect_url' => $redirectUrl,
                'get_test_type' => $get_question_type,
                'get_test_name' => $get_test_name,
                'total_question' => $get_total_question,
                'test_type' => $request->test_type
            ]
        );
    }

    public function get_questions(Request $request)
    {
        $practice_test_id = '';
        $current_user_id = Auth::id();
        $question = PracticeQuestion::where('id', $request->question_id)->first();
        if ($request->question_type == 'all') {
            $practice_test_id = $request->section_id;
            $set_completed_section_id = DB::table('user_answers')
                ->select('user_answers.section_id')
                ->where('user_answers.user_id', $current_user_id)
                ->where('user_answers.test_id', $practice_test_id)
                ->pluck('user_answers.section_id')
                ->toArray();

            $get_offset = $request->get_offset;
            if (is_null($question->passages_id)) {
                $get_total_question = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags', 'practice_tests.*', 'practice_test_sections.*')
                    ->where('practice_tests.id', $practice_test_id)
                    ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                    ->count();

                $testSectionQuestions = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags', 'practice_tests.*', 'practice_test_sections.*')
                    ->where('practice_questions.id', $request->question_id)
                    ->where('practice_tests.id', $practice_test_id)
                    ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                    ->orderBy('question_order', 'ASC')
                    ->limit(1)->get();
            } else {
                $get_total_question = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags', 'practice_tests.*', 'practice_test_sections.*')
                    ->where('practice_tests.id', $practice_test_id)
                    ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                    ->count();

                $testSectionQuestions = DB::table('practice_questions')
                    ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.tags', 'passages.title as passage_title', 'passages.description as passage_description', 'passages.type as passage_type', 'practice_tests.*', 'practice_test_sections.*')
                    ->where('practice_questions.id', $request->question_id)
                    ->where('practice_tests.id', $practice_test_id)
                    ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                    ->orderBy('question_order', 'ASC')
                    ->limit(1)->get();
            }

            if ($testSectionQuestions->isEmpty()) {
                $testSectionQuestions = 0;
            }

            if ($get_offset >= $get_total_question) {
                $set_next_offset = $get_offset;
                $set_prev_offset = $get_offset - 1;
            } else {
                $set_next_offset = $get_offset + 1;
                $set_prev_offset = $get_offset - 1;
            }
        } else if ($request->question_type == 'single') {

            $get_section_details = DB::table('practice_test_sections')
                ->select('practice_test_sections.testid')
                ->where('practice_test_sections.id', $request->section_id)->first();

            $practice_test_id = $get_section_details->testid;
            $get_offset = $request->get_offset;
            if (is_null($question->passages_id)) {
                $get_total_question  = DB::table('practice_questions')
                    ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags')
                    ->where('practice_questions.practice_test_sections_id', $request->section_id)->count();

                $testSectionQuestions = DB::table('practice_questions')
                    ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags')
                    // ->where('practice_questions.practice_test_sections_id', $request->section_id)
                    ->where('practice_questions.id', $request->question_id)
                    ->orderBy('question_order', 'ASC')
                    ->limit(1)->get();
            } else {
                $get_total_question  = DB::table('practice_questions')
                    ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.tags')
                    ->where('practice_questions.practice_test_sections_id', $request->section_id)->count();

                $testSectionQuestions = DB::table('practice_questions')
                    ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                    ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.tags', 'passages.title as passage_title', 'passages.description as passage_description', 'passages.type as passage_type')
                    // ->where('practice_questions.practice_test_sections_id', $request->section_id)
                    ->where('practice_questions.id', $request->question_id)
                    ->orderBy('question_order', 'ASC')
                    ->limit(1)->get();
            }
            if ($testSectionQuestions->isEmpty()) {
                $testSectionQuestions = 0;
            }

            if ($get_offset >= $get_total_question) {
                $set_next_offset = $get_offset;
                $set_prev_offset = $get_offset - 1;
            } else {
                $set_next_offset = $get_offset + 1;
                $set_prev_offset = $get_offset - 1;
            }
        }
        return response()->json(['success' => '0', 'questions' => $testSectionQuestions, 'total_question' => $get_total_question, 'get_offset' => $get_offset, 'set_next_offset' => $set_next_offset, 'set_prev_offset' => $set_prev_offset, 'practice_test_id' => $practice_test_id]);
    }

    public function get_official_questions(Request $request)
    {
        // dd($request);
        $practice_test_id = '';
        $current_user_id = Auth::id();
        $question = PracticeQuestion::select('id', 'practice_test_sections_id', 'passages_id')
            ->where('practice_test_sections_id', $request->section_id)
            ->get();
        // dd($question);
        if ($request->question_type == 'all') {
            $practice_test_id = $request->section_id;
            $set_completed_section_id = DB::table('user_answers')
                ->select('user_answers.section_id')
                ->where('user_answers.user_id', $current_user_id)
                ->where('user_answers.test_id', $practice_test_id)
                ->pluck('user_answers.section_id')
                ->toArray();


            // $get_offset = $request->get_offset;
            // if (is_null($question->passages_id)) {
            $get_total_question = DB::table('practice_questions')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags', 'practice_tests.*', 'practice_test_sections.*')
                ->where('practice_tests.id', $practice_test_id)
                ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                ->get();

            $total_question = DB::table('practice_questions')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags', 'practice_tests.*', 'practice_test_sections.*')
                ->where('practice_tests.id', $practice_test_id)
                ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                ->count();

            //     $testSectionQuestions = DB::table('practice_questions')
            //         ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            //         ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
            //         ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags', 'practice_tests.*', 'practice_test_sections.*')
            //         ->where('practice_questions.id', $request->question_id)
            //         ->where('practice_tests.id', $practice_test_id)
            //         ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
            //         ->orderBy('question_order', 'ASC')
            //         ->limit(1)->get();
            // } else {
            //     $get_total_question = DB::table('practice_questions')
            //         ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            //         ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
            //         ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags', 'practice_tests.*', 'practice_test_sections.*')
            //         ->where('practice_tests.id', $practice_test_id)
            //         ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
            //         ->count();

            //     $testSectionQuestions = DB::table('practice_questions')
            //         ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
            //         ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            //         ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
            //         ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.tags', 'passages.title as passage_title', 'passages.description as passage_description', 'passages.type as passage_type', 'practice_tests.*', 'practice_test_sections.*')
            //         ->where('practice_questions.id', $request->question_id)
            //         ->where('practice_tests.id', $practice_test_id)
            //         ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
            //         ->orderBy('question_order', 'ASC')
            //         ->limit(1)->get();
            // }

            if ($get_total_question->isEmpty()) {
                $get_total_question = 0;
            }

            // if ($get_offset >= $get_total_question) {
            //     $set_next_offset = $get_offset;
            //     $set_prev_offset = $get_offset - 1;
            // } else {
            //     $set_next_offset = $get_offset + 1;
            //     $set_prev_offset = $get_offset - 1;
            // }
        } else if ($request->question_type == 'single') {

            $get_section_details = DB::table('practice_test_sections')
                ->select('practice_test_sections.testid')
                ->where('practice_test_sections.id', $request->section_id)->first();
            // dd($get_section_details);
            $practice_test_id = $get_section_details->testid;
            $get_offset = $request->get_offset;

            // if (is_null($question->passages_id)) {
            //     $get_total_question  = DB::table('practice_questions')
            //         ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags')
            //         ->where('practice_questions.practice_test_sections_id', $request->section_id)->get();

            //     $testSectionQuestions = DB::table('practice_questions')
            //         ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.tags')
            //         // ->where('practice_questions.practice_test_sections_id', $request->section_id)
            //         ->where('practice_questions.id', $request->question_id)
            //         ->orderBy('question_order', 'ASC')
            //         ->get();
            // } else {
            $get_total_question  = DB::table('practice_questions')
                ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.id')
                ->where('practice_questions.practice_test_sections_id', $request->section_id)->get();

            $total_question  = DB::table('practice_questions')
                ->select('practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.id')
                ->where('practice_questions.practice_test_sections_id', $request->section_id)->count();
            // $testSectionQuestions = DB::table('practice_questions')
            //     ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
            //     ->select('practice_questions.id as question_id', 'practice_questions.title as question_title', 'practice_questions.type as practice_type', 'practice_questions.answer as question_answer', 'practice_questions.answer_content as question_answer_options', 'practice_questions.multiChoice as is_multiple_choice', 'practice_questions.question_order', 'practice_questions.passages_id', 'practice_questions.tags', 'passages.title as passage_title', 'passages.description as passage_description', 'passages.type as passage_type')
            //     // ->where('practice_questions.practice_test_sections_id', $request->section_id)
            //     ->where('practice_questions.id', $request->question_id)
            //     ->orderBy('question_order', 'ASC')
            //     ->get();
            // dd( $get_total_question);
            // }
            if ($get_total_question->isEmpty()) {
                $get_total_question = 0;
            }

            // if ($get_offset >= $get_total_question) {
            //     $set_next_offset = $get_offset;
            //     $set_prev_offset = $get_offset - 1;
            // } else {
            //     $set_next_offset = $get_offset + 1;
            //     $set_prev_offset = $get_offset - 1;
            // }
        }
        // return response()->json(['success' => '0', 'questions' => $testSectionQuestions, 'total_question' => $get_total_question, 'get_offset' => $get_offset, 'set_next_offset' => $set_next_offset, 'set_prev_offset' => $set_prev_offset, 'practice_test_id' => $practice_test_id]);
        return response()->json(['success' => '0', 'questions' => $get_total_question, 'total_question' => $total_question, 'practice_test_id' => $practice_test_id]);
    }

    public function startAllSections(Request $request)
    {
        // reset all the setion first.
        UserAnswers::where('user_id', Auth::id())->where('test_id', $request->id)->delete();
        $current_user_id = Auth::id();
        $existingRecord = TestProgress::where('test_id', $request->id)
            ->where('user_id', $current_user_id)
            ->delete();
        // dump($request);
        // dump($request->sec_id);
        // dump($request->str);
        // dump($request->id);
        return redirect()->to('/user/practice-test/' . $request->sec_id . '?' . $request->str);
    }
    public function singleSection(Request $request, $id)
    {
        $testSection = DB::table('practice_test_sections')
            ->where('practice_test_sections.id', $id)
            ->get();

        // if (strpos($request->getRequestUri(), 'all') !== false) {
        //     if( in_array($testSection[0]->practice_test_type, ['Math' ,'Reading_And_Writing'])){
        //         // reset all the setion first.
        //         UserAnswers::where('user_id', Auth::id())->where('test_id', $request->test_id)->delete();
        //         $current_user_id = Auth::id();
        //         $existingRecord = TestProgress::where('test_id', $request->test_id)
        //             ->where('user_id', $current_user_id)
        //             ->delete();
        //     }
        // }

        $set_offset = 0;
        $test_id = $request->test_id ?? '';
        $testSection = DB::table('practice_test_sections')
            ->where('practice_test_sections.id', $id)
            ->get();

        $total_questions = PracticeQuestion::where('practice_test_sections_id', $id)
            ->orderBy('question_order', 'ASC')
            ->pluck('id')
            ->toArray();

        $testQuestion = DB::table('practice_tests')
            ->where('id', $test_id)
            ->first();

        $isSubmitted = 0;
        if (!empty($test_id)) {
            $testProgress = TestProgress::where(
                [
                    "test_id" => $test_id,
                    "section_id" => $id,
                    "user_id" => Auth::user()->id
                ]
            )->first();
            // dump($testProgress);
            if (!empty($testProgress)) {
                $isSubmitted = $testProgress->is_submit;
                $testProgress->question_id = json_encode($total_questions);
                $testProgress->save();
            }
        }

        // update this part.
        if ($isSubmitted == 1) {
            return redirect()->route('single_test', $test_id);
            // return back();
            // $url = route('single_review',['test' => $testQuestion->title ,'id' => $id]). '?test_id=' . $test_id . '&type=single';
            // return redirect($url);
        }
        // dd($isSubmitted);
        return view(
            'user.practice-test',
            [
                'section_id' => $id,
                'set_offset' => $set_offset,
                'question_type' => 'single',
                'total_questions' => $total_questions,
                'testSection' => $testSection,
                'isSubmitted' => $isSubmitted
            ]
        );
    }

    public function singleOfficeSection(Request $request, $id)
    {
        $testSection = DB::table('practice_test_sections')
            ->where('practice_test_sections.id', $id)
            ->get();

        // if (strpos($request->getRequestUri(), 'all') !== false) {
        //     if( in_array($testSection[0]->practice_test_type, ['Math' ,'Reading_And_Writing'])){
        //         // reset all the setion first.
        //         UserAnswers::where('user_id', Auth::id())->where('test_id', $request->test_id)->delete();
        //         $current_user_id = Auth::id();
        //         $existingRecord = TestProgress::where('test_id', $request->test_id)
        //             ->where('user_id', $current_user_id)
        //             ->delete();
        //     }
        // }

        $testType = $request->session()->get('testType');
        $set_offset = 0;
        $test_id = $request->test_id ?? '';
        // dd($test_id);
        $testSection = DB::table('practice_test_sections')
            ->where('practice_test_sections.id', $id)
            ->get();
        // dd( $testSection);

        $total_questions = PracticeQuestion::where('practice_test_sections_id', $id)
            ->orderBy('question_order', 'ASC')
            ->pluck('id')
            ->toArray();
        $testQuestion = DB::table('practice_tests')
            ->where('id', $test_id)
            ->first();

        $isSubmitted = 0;
        if (!empty($test_id)) {
            $testProgress = TestProgress::where(
                [
                    "test_id" => $test_id,
                    "section_id" => $id,
                    "user_id" => Auth::user()->id
                ]
            )->first();
            // dump($testProgress);
            if (!empty($testProgress)) {
                $isSubmitted = $testProgress->is_submit;
                $testProgress->question_id = json_encode($total_questions);
                $testProgress->save();
            }
        }

        // update this part.
        if ($isSubmitted == 1) {
            return redirect()->route('single_test', $test_id);
            // return back();
            // $url = route('single_review',['test' => $testQuestion->title ,'id' => $id]). '?test_id=' . $test_id . '&type=single';
            // return redirect($url);
        }
        // dd($isSubmitted);
        return view(
            'user.official_practice_test',
            [
                'section_id' => $id,
                'set_offset' => $set_offset,
                'question_type' => 'single',
                'total_questions' => $total_questions,
                'testSection' => $testSection,
                'isSubmitted' => $isSubmitted,
                'test_id' => $test_id,
                'test_type' => $testType,
            ]
        );
    }

    public function singleModuleOfficeSection(Request $request, $id)
    {
        // $testSection = DB::table('practice_test_sections')
        //     ->where('practice_test_sections.id', $id)
        //     ->get();

        // if (strpos($request->getRequestUri(), 'all') !== false) {
        //     if( in_array($testSection[0]->practice_test_type, ['Math' ,'Reading_And_Writing'])){
        //         // reset all the setion first.
        //         UserAnswers::where('user_id', Auth::id())->where('test_id', $request->test_id)->delete();
        //         $current_user_id = Auth::id();
        //         $existingRecord = TestProgress::where('test_id', $request->test_id)
        //             ->where('user_id', $current_user_id)
        //             ->delete();
        //     }
        // }

        // $set_offset = 0;
        $sectionId = $id;
        $test_id = $request->test_id ?? '';
        $testSections = DB::table('practice_test_sections')
            ->where('practice_test_sections.testid', $test_id)
            ->get();

        // dd($sectionId);
        // $testSection = DB::table('practice_test_sections')
        //     ->where('practice_test_sections.id', $id)
        //     ->get();

        // $total_questions = PracticeQuestion::where('practice_test_sections_id', $id)
        //     ->orderBy('question_order', 'ASC')
        //     ->pluck('id')
        //     ->toArray();
        // $testQuestion = DB::table('practice_tests')
        //     ->where('id', $test_id)
        //     ->first();

        $isSubmitted = 0;
        // if (!empty($test_id)) {
        //     $testProgress = TestProgress::where(
        //         [
        //             "test_id" => $test_id,
        //             "section_id" => $id,
        //             "user_id" => Auth::user()->id
        //         ]
        //     )->first();
        //     // dump($testProgress);
        //     if (!empty($testProgress)) {
        //         $isSubmitted = $testProgress->is_submit;
        //         $testProgress->question_id = json_encode($total_questions);
        //         $testProgress->save();
        //     }
        // }

        // update this part.
        if ($isSubmitted == 1) {
            return redirect()->route('single_test', $test_id);
            // return back();
            // $url = route('single_review',['test' => $testQuestion->title ,'id' => $id]). '?test_id=' . $test_id . '&type=single';
            // return redirect($url);
        }
        // dd($isSubmitted);

        return view('user.official_practice_test_module', [
            'test_id' => $test_id,
            'testSections' => $testSections,
            'sectionId' => $sectionId
        ]);

        // return view(
        //     'user.official_practice_test',
        //     [
        //         'section_id' => $id,
        //         'set_offset' => $set_offset,
        //         'question_type' => 'single',
        //         'total_questions' => $total_questions,
        //         'testSection' => $testSection,
        //         'isSubmitted' => $isSubmitted
        //     ]
        // );
    }

    public function getQuestionSection(Request $request)
    {
        // dd($request);
        $testSection = DB::table('practice_test_sections')
            ->where('practice_test_sections.id', $request->sectionId)
            ->get();

        // if (strpos($request->getRequestUri(), 'all') !== false) {
        //     if( in_array($testSection[0]->practice_test_type, ['Math' ,'Reading_And_Writing'])){
        //         // reset all the setion first.
        //         UserAnswers::where('user_id', Auth::id())->where('test_id', $request->test_id)->delete();
        //         $current_user_id = Auth::id();
        //         $existingRecord = TestProgress::where('test_id', $request->test_id)
        //             ->where('user_id', $current_user_id)
        //             ->delete();
        //     }
        // }

        $set_offset = 0;
        $test_id = $request->test_id ?? '';
        $testSection = DB::table('practice_test_sections')
            ->where('practice_test_sections.id', $request->sectionId)
            ->get();

        $total_questions = PracticeQuestion::where('practice_test_sections_id', $request->sectionId)
            ->orderBy('question_order', 'ASC')
            ->pluck('id')
            ->toArray();
        $testQuestion = DB::table('practice_tests')
            ->where('id', $test_id)
            ->first();

        $isSubmitted = 0;
        if (!empty($test_id)) {
            $testProgress = TestProgress::where(
                [
                    "test_id" => $test_id,
                    "section_id" => $request->sectionId,
                    "user_id" => Auth::user()->id
                ]
            )->first();
            // dump($testProgress);
            if (!empty($testProgress)) {
                $isSubmitted = $testProgress->is_submit;
                $testProgress->question_id = json_encode($total_questions);
                $testProgress->save();
            }
        }

        // update this part.
        if ($isSubmitted == 1) {
            return redirect()->route('single_test', $test_id);
            // return back();
            // $url = route('single_review',['test' => $testQuestion->title ,'id' => $id]). '?test_id=' . $test_id . '&type=single';
            // return redirect($url);
        }
        // dd($isSubmitted);
        $data = [
            'test_id' => $test_id,
            'section_id' => $request->sectionId,
            'set_offset' => $set_offset,
            'question_type' => 'single',
            'total_questions' => $total_questions,
            'testSection' => $testSection,
            'isSubmitted' => $isSubmitted
        ];

        return response()->json(['data' => $data]);
    }

    public function testBreak(Request $request, $id)
    {

        return view(
            'user.test-break',
            [
                // 'test_id' => $id,
                'test_id' => $request->test_id,
                'section_id' => $id,
            ]
        );
    }

    public function allSection(Request $request, $id)
    {
        $set_offset = 0;
        $practice_test_section = PracticeTestSection::where('testid', $id)->pluck('id')->toArray();

        $sections_without_records = PracticeTestSection::whereNotIn('id', function ($query) {
            $query->select('section_id')->from('user_answers')->where('user_id', Auth::id());
        })->whereIn('id', $practice_test_section)->get();

        $section_ids_without_records = $sections_without_records->pluck('id')->toArray();

        $total_questions = [];
        foreach ($section_ids_without_records as $section) {
            $section_questions = PracticeQuestion::whereIn('practice_test_sections_id', $section_ids_without_records)->orderBy('question_order', 'ASC')->pluck('id')->toArray();
            $total_questions = array_merge($total_questions, $section_questions);
        }

        $testSection = DB::table('practice_test_sections')
            ->where('practice_test_sections.testid', $id)
            ->get();
        // dd($testSection);
        return view('user.practice-test', ['section_id' => $id, 'set_offset' => $set_offset, 'question_type' => 'all', 'total_questions' => $total_questions, 'testSection' => $testSection]);
    }

    public function singleTest(Request $request, $id)
    {
        $practice_test = PracticeTest::where('id', $id)->first();
        if (!$practice_test) {
            return redirect(route('test_home_page'))->with('error', 'Test not found');
        }

        $test_type  = $request->query('test_section');
        // dd($test_type);
        if ($test_type !== null) {
            // dd($test_type);
            $request->session()->put('testType', $test_type);
        } else {
            $request->session()->put('testType', 'graded');
        }
        // dd($test_type);
        // if ($practice_test->status == 'paid' && !auth()->user()->isUserSubscibedToTheProduct($practice_test->practice_tests_products()->pluck('product_id')->toArray())) {
        //     return redirect(route('test_home_page'))->with('error', 'You are not authorized to access this test');
        // }

        $current_user_id = Auth::id();

        $store_sections_details = array();
        $get_total_sections = 0;
        $get_total_questions = 0;
        $check_test_completed = 'no';

        $get_all_sections_id = DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
            ->select('practice_test_sections.id')
            ->where('practice_test_sections.testid', $id)
            ->pluck('id');

        $get_all_section_id = count($get_all_sections_id);

        $get_test_description = DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
            ->select('practice_tests.description')
            ->where('practice_tests.id', $id)
            ->get();

        $get_users_answers_section_id = DB::table('user_answers')
            ->select('user_answers.section_id')
            ->where('user_answers.user_id', $current_user_id)
            ->where('user_answers.test_id', $id)
            ->whereIn('user_answers.section_id', $get_all_sections_id)
            ->count();


        if ($get_all_section_id === $get_users_answers_section_id) {
            $check_test_completed = 'yes';
        } else if ($get_all_section_id > $get_users_answers_section_id) {
            $check_test_completed = 'Yes';
        }

        $checkTestQuestion = DB::table('practice_questions')
            ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->where('practice_test_sections.testid', $id)
            ->where('practice_test_sections.is_active', "1")
            ->count();

        $testSections = DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
            ->select('practice_test_sections.*', 'practice_tests.title', 'practice_tests.is_test_completed', 'practice_tests.format',  'practice_tests.description', 'practice_tests.tags' /*, 'practice_questions.*'*/)
            ->where('practice_test_sections.testid', $id)
            ->where('practice_test_sections.is_active', "1")
            ->orderBy('section_order', 'ASC')
            ->get();

        $get_total_sections = DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
            ->select('practice_test_sections.*', 'practice_tests.title', 'practice_tests.format',  'practice_tests.description', 'practice_tests.tags' /*, 'practice_questions.*'*/)
            ->where('practice_test_sections.testid', $id)
            ->where('practice_test_sections.is_active', "1")
            ->count();

        $testSection = DB::table('practice_tests')
            ->where('practice_tests.id', $id)
            ->get();

        if ($testSection->isEmpty()) {
            $testSectionName = 0;
        } else {
            $testSectionName = $testSection[0]->title;
        }

        if ($testSections->isEmpty()) {
            $testSections =  0;
        } else if (!$testSections->isEmpty()) {
            $total_all_section_question = 0;

            foreach ($testSections as $single_test_sections) {
                $testSectionQuestions = DB::table('practice_questions')
                    ->select('practice_questions.*')
                    ->where('practice_questions.practice_test_sections_id', $single_test_sections->id)
                    ->get();
                // dump($single_test_sections);

                $check_if_section_completed = 'no';
                // dump(DB::table('user_answers')->where('section_id', $single_test_sections->id)->where('user_id', $current_user_id)->exists());
                if (DB::table('user_answers')->where('section_id', $single_test_sections->id)->where('user_id', $current_user_id)->exists()) {
                    $check_if_section_completed = 'yes';
                } else {
                    $check_if_section_completed = 'no';
                }

                $get_total_questions = DB::table('practice_questions')
                    ->select('practice_questions.*')
                    ->where('practice_questions.practice_test_sections_id', $single_test_sections->id)
                    ->count();

                $total_all_section_question = $total_all_section_question + $get_total_questions;

                $store_sections_details[$single_test_sections->id]['check_if_section_completed'][] = $check_if_section_completed;
                $store_sections_details[$single_test_sections->id]['Sections'][] = array("id" => $single_test_sections->id, "format" => $single_test_sections->format, "practice_test_type" => $single_test_sections->practice_test_type, "testid" => $single_test_sections->testid, "section_order" => $single_test_sections->section_order, "title" => $single_test_sections->title, "description" => $single_test_sections->description);

                if (!$testSections->isEmpty() &&  !$testSectionQuestions->isEmpty()) {
                    foreach ($testSectionQuestions as $singletestSectionQuestions) {
                        $store_sections_details[$single_test_sections->id]['Sections_question'][] = array("id" => $singletestSectionQuestions->id, "title" => $singletestSectionQuestions->title, "format" => $singletestSectionQuestions->format, "practice_test_sections_id" => $singletestSectionQuestions->practice_test_sections_id, "type" => $singletestSectionQuestions->type, "passages_id" => $singletestSectionQuestions->passages_id, "passages" => $singletestSectionQuestions->passages, "passage_number" => $singletestSectionQuestions->passage_number, "answer" => $singletestSectionQuestions->answer, "answer_content" => $singletestSectionQuestions->answer_content, "fill" => $singletestSectionQuestions->fill, "fillType" => $singletestSectionQuestions->fillType, "multiChoice" => $singletestSectionQuestions->multiChoice, "question_order" => $singletestSectionQuestions->question_order, "tags" => $singletestSectionQuestions->tags);
                    }
                }
            }
        }

        $helper = new Helper();
        $sections = PracticeTestSection::where('testid', $id)->get();
        foreach ($sections as $section) {
            $count_right_question[$section['id']] = [];
            $sectionQuestions = PracticeQuestion::where('practice_test_sections_id', $section['id'])->get();
            $userAnswer = UserAnswers::where('section_id', $section['id'])->where('user_id', $current_user_id)->get('answer');
            if (isset($userAnswer[0]['answer'])) {
                $decodedUserAnswer = json_decode($userAnswer[0]['answer'], true);
                foreach ($sectionQuestions as $sectionQuestion) {
                    if (isset($decodedUserAnswer[$sectionQuestion['id']])) {
                        if ($sectionQuestion['multiChoice'] == 2) {
                            $correct[$sectionQuestion['id']] = $sectionQuestion['answer'];
                            // if(in_array(str_replace(' ','',$decodedUserAnswer[$sectionQuestion['id']]),$correct) || in_array(str_replace(' ','',$decodedUserAnswer[$sectionQuestion['id']]),explode(',',$correct[$sectionQuestion['id']])) || Str::contains($correct[$sectionQuestion['id']],explode(',',str_replace(' ','',$decodedUserAnswer[$sectionQuestion['id']])))){
                            if ($helper->stringExactMatch($correct[$sectionQuestion['id']], $decodedUserAnswer[$sectionQuestion['id']])) {
                                array_push($count_right_question[$section['id']], $sectionQuestion['id']);
                            }
                        } else {
                            if (str_replace(' ', '', $sectionQuestion['answer']) == str_replace(' ', '', $decodedUserAnswer[$sectionQuestion['id']])) {
                                array_push($count_right_question[$section['id']], $sectionQuestion['id']);
                            }
                        }
                    }
                }
            }
        }
        // dump($count_right_question);
        // dump($sectionQuestion);
        // dump($sections);
        $section_score = [];
        foreach ($sections as $section) {
            if ($section['practice_test_type'] == 'Math_no_calculator') {
                $other_section = PracticeTestSection::where('testid', $id)->whereIn('practice_test_type', ['Math_with_calculator', 'Math_no_calculator'])->whereNotIn('id', [$section['id']])->pluck('id')->toArray();
                $other_right = 0;
                foreach ($other_section as $sec) {
                    $other_right += count($count_right_question[$sec]);
                }
                $total_right = count($count_right_question[$section['id']]) + $other_right;
                $scaled_score = Score::where('section_id', $section['id'])->where('actual_score', $total_right)->get('converted_score');
                if (isset($scaled_score[0]['converted_score'])) {
                    $section_score[$section['id']] = $scaled_score[0]['converted_score'];
                } else {
                    $section_score[$section['id']] = 0;
                }
            } else if ($section['practice_test_type'] == 'Math_with_calculator') {
                $other_section = PracticeTestSection::where('testid', $id)->whereIn('practice_test_type', ['Math_no_calculator', 'Math_with_calculator'])->whereNotIn('id', [$section['id']])->pluck('id')->toArray();
                $other_right = 0;
                foreach ($other_section as $sec) {
                    $other_right += count($count_right_question[$sec]);
                }
                $total_right = count($count_right_question[$section['id']]) + $other_right;
                $scaled_score = Score::where('section_id', $section['id'])->where('actual_score', $total_right)->get('converted_score');
                if (isset($scaled_score[0]['converted_score'])) {
                    $section_score[$section['id']] = $scaled_score[0]['converted_score'];
                } else {
                    $section_score[$section['id']] = 0;
                }
            } else {
                $scaled_sco = Score::where('section_id', $section['id'])->where('actual_score', count($count_right_question[$section['id']]))->get('converted_score');
                if (isset($scaled_sco[0]['converted_score'])) {
                    $section_score[$section['id']] = $scaled_sco[0]['converted_score'];
                } else {
                    $section_score[$section['id']] = 0;
                }
            }
        }

        $total_score = 0;
        $math_score = 0;
        foreach ($sections as $section) {
            if (
                $section['practice_test_type'] == 'Math' ||
                $section['practice_test_type'] == 'Math_no_calculator' ||
                $section['practice_test_type'] == 'Math_with_calculator' ||
                $section['practice_test_type'] == 'Reading_And_Writing' ||
                $section['practice_test_type'] == 'Easy_Reading_And_Writing' ||
                $section['practice_test_type'] == 'Hard_Reading_And_Writing'
            ) {
                $math_score = $section_score[$section['id']];
            } else {
                $total_score += $section_score[$section['id']];
            }
        }

        $total_score = $total_score + ($math_score);
        // dd($total_score);

        if (isset($sections[0]['format']) && $sections[0]['format'] == 'ACT') {
            $total_score = $total_score / ($sections->count());
        } else {
            // dd($total_score);
            $total_score = $total_score;
        }

        // also put this check for other type of tests.
        $mainSectionsCount = 0;
        $mathSectionID = 0;
        $rwSectionID = 0;

        $reviewUrl = '';
        $rwUrl = '';
        $mathUrl = '';

        $readingSectionCount = 0;
        $readingQuestCount = 0;
        $mathSectionCount = 0;
        $mathQuestCount = 0;
        $mathValue = 1;
        $rwValue = 1;
        $compositeScore = 0;
        $newRwScore = 0;
        $newMathScore = 0;
        $rwCScore = 0;
        $mathCScore = 0;
        $mathIdsArr = [];
        $rwIdsArr = [];

        // new calculation score for DSAT/DPSAT only
        // dump($count_right_question);
        // dump($store_sections_details);

        foreach ($store_sections_details as $key => $sections) {

            if (isset($sections['Sections_question'])) {

                if (strpos($sections['Sections'][0]['practice_test_type'], 'Reading') !== false) {
                    array_push($rwIdsArr, $key);
                    // dd($rwIdsArr);
                }

                if (strpos($sections['Sections'][0]['practice_test_type'], 'Math') !== false) {
                    array_push($mathIdsArr, $key);
                    // dump($mathIdsArr);
                }

                if ($sections['Sections'][0]['format'] == 'ACT') {
                    $mainSectionsCount++;
                }

                if ($sections['Sections'][0]['format'] == 'SAT') {
                    $mainSectionsCount++;
                }

                if ($sections['Sections'][0]['format'] == 'PSAT') {
                    $mainSectionsCount++;
                }

                if ($sections['Sections'][0]['practice_test_type'] == 'Math') {
                    $mainSectionsCount++;
                    $mathSectionID = $sections['Sections'][0]['id'];
                }

                if ($sections['Sections'][0]['practice_test_type'] == 'Reading_And_Writing') {
                    $mainSectionsCount++;
                    $rwSectionID = $sections['Sections'][0]['id'];
                }

                if ($sections['Sections'][0]['id'] == $rwSectionID) {
                    $rwValue = 1;
                } else {
                    $rwValue = 2;
                }
                if ($sections['Sections'][0]['id'] == $mathSectionID) {
                    $mathValue = 1;
                } else {
                    $mathValue = 2;
                }

                if ($sections['Sections'][0]['format'] == 'DPSAT' || $sections['Sections'][0]['format'] == 'DSAT') {
                    // update section count.
                    if ((isset($sections['check_if_section_completed'])) && ($sections['check_if_section_completed'][0] == 'yes')) {

                        if (strpos($sections['Sections'][0]['practice_test_type'], 'Reading') !== false) {

                            $url = route('single_review', ['test' => $sections['Sections'][0]['title'], 'id' => $sections['Sections'][0]['id']]) . '?test_id=' . $id . '&type=single';
                            $rwUrl .= "<a href='" . $url . "' style='padding: 5px 20px fs-5' class='btn btn-alt-success text-success 2'><i class='fa-solid fa-circle-check' style='margin-right:5px'></i>Review Module " . $rwValue . " </a> ";
                            $store_sections_details[$rwSectionID]['Sections'][0]['reviewUrls'] = $rwUrl;

                            $secCount = count($sections['Sections_question']);
                            $readingSectionCount = ($readingSectionCount + $secCount);
                            $store_sections_details[$rwSectionID]['Sections'][0]['yesSectionCount'] = $readingSectionCount;
                            // $totalAttempetdQuestions = $totalAttempetdQuestions + $readingSectionCount;
                            // $readingSectionCount = 0;

                            // calculate Score for reading.
                            //Old code
                            // if (count($count_right_question[$key]) != 0) {
                            //     foreach ($count_right_question[$key] as $questions) {
                            //         $newRwScore++;
                            //         // dump($newRwScore);
                            //     }
                            // }

                            //New code starts
                            $nonEmptyKeysCount = 0; // Initialize count of non-empty keys
                            $newRwScore = 0; // Initialize count of non-empty data

                            foreach ($rwIdsArr as $value) {
                                // Check if the key exists in $count_right_question
                                if (isset($count_right_question[$value])) {
                                    $nonEmptyKeysCount++; // Increment count of non-empty keys

                                    // Check if the value associated with the key is not empty
                                    if (is_array($count_right_question[$value])) {
                                        // If the value is an array, increment the count by the number of non-empty elements
                                        $newRwScore += count(array_filter($count_right_question[$value]));
                                    } else {
                                        // If the value is not an array, increment the count if it's not empty
                                        if (!empty($count_right_question[$value])) {
                                            $newRwScore++;
                                        }
                                    }
                                }
                            }

                            // dump($nonEmptyKeysCount);
                            // dump($nonEmptyDataCount);
                            //New Code end

                            $eachScore = DB::table('scores')
                                ->whereIn('section_id', $rwIdsArr)
                                ->where('test_id', $id)
                                ->where('actual_score', $newRwScore)
                                ->orderBy('created_at', 'desc')
                                ->first('converted_score');

                            // dump($eachScore);
                            if ($eachScore) {
                                $rwCScore = $eachScore->converted_score;
                                // $compositeScore =  $compositeScore + $rwCScore;
                            } else {
                                $rwCScore = 0;
                            }

                            // dd($eachScore);
                            $store_sections_details[$rwSectionID]['Sections'][0]['newScore'] = $rwCScore;
                        }

                        if (strpos($sections['Sections'][0]['practice_test_type'], 'Math') !== false) {

                            $url = route('single_review', ['test' => $sections['Sections'][0]['title'], 'id' => $sections['Sections'][0]['id']]) . '?test_id=' . $id . '&type=single';
                            $mathUrl .= "<a href='" . $url . "' style='padding: 5px 20px fs-5' class='btn btn-alt-success text-success 2'><i class='fa-solid fa-circle-check' style='margin-right:5px'></i>Review Module " . $mathValue . " </a> ";
                            $store_sections_details[$mathSectionID]['Sections'][0]['reviewUrls'] = $mathUrl;

                            $secCount = count($sections['Sections_question']);
                            $mathSectionCount = ($mathSectionCount + $secCount);
                            $store_sections_details[$mathSectionID]['Sections'][0]['yesSectionCount'] = $mathSectionCount;
                            // $mathSectionCount = 0;
                            // $totalAttempetdQuestions = $totalAttempetdQuestions + $mathSectionCount;

                            // calculate Score for math.
                            // if(count($count_right_question[$key]) != 0) {
                            //     foreach($count_right_question[$key] as $questions){
                            //         $eachScore = DB::table('scores')
                            //                         ->where('section_id',$key)
                            //                         ->where('question_id',$questions)
                            //                         ->where('test_id', $id)
                            //                         ->first(['actual_score','converted_score']);
                            //         if($eachScore) {
                            //             $compositeScore =  $compositeScore + $eachScore->converted_score;
                            //             $newMathScore = $newMathScore + $eachScore->converted_score;
                            //         }
                            //     }
                            // }
                            // dd($count_right_question);
                            //     dump(count($count_right_question[$key]));

                            //Old code
                            // if (count($count_right_question[$key]) != 0) {
                            //     foreach ($count_right_question[$key] as $questions) {
                            //         $newMathScore++;
                            //         // dump($newMathScore);
                            //     }
                            // }

                            //NewCode
                            $nonEmptyKeysCount = 0; // Initialize count of non-empty keys
                            $newMathScore = 0; // Initialize count of non-empty data
                            foreach ($mathIdsArr as $value) {
                                // Check if the key exists in $count_right_question
                                if (isset($count_right_question[$value])) {
                                    $nonEmptyKeysCount++; // Increment count of non-empty keys

                                    // Check if the value associated with the key is not empty
                                    if (is_array($count_right_question[$value])) {
                                        // If the value is an array, increment the count by the number of non-empty elements
                                        $newMathScore += count(array_filter($count_right_question[$value]));
                                    } else {
                                        // If the value is not an array, increment the count if it's not empty
                                        if (!empty($count_right_question[$value])) {
                                            $newMathScore++;
                                        }
                                    }
                                }
                            }
                            // dd($newMathScore);
                            //New Code end

                            $eachMathScore = DB::table('scores')
                                ->whereIn('section_id', $mathIdsArr)
                                ->where('test_id', $id)
                                ->where('actual_score', $newMathScore)
                                ->orderBy('created_at', 'desc')
                                ->first('converted_score');

                            // dump($eachMathScore);
                            if ($eachMathScore) {
                                $mathCScore = $eachMathScore->converted_score;
                                // $compositeScore =  $compositeScore + $mathCScore;
                            } else {
                                $mathCScore = 0;
                            }
                            // dd($mathCScore);
                            $store_sections_details[$mathSectionID]['Sections'][0]['newScore'] = $mathCScore;
                        }
                    }

                    if (strpos($sections['Sections'][0]['practice_test_type'], 'Reading') !== false) {
                        $readingQuestCount = (count($sections['Sections_question']) + $readingQuestCount);
                        $store_sections_details[$rwSectionID]['Sections'][0]['noSectionCount'] = $readingQuestCount;
                    }

                    if (strpos($sections['Sections'][0]['practice_test_type'], 'Math') !== false) {
                        $count = count($sections['Sections_question']);
                        $mathQuestCount = ($mathQuestCount + $count);
                        $store_sections_details[$mathSectionID]['Sections'][0]['noSectionCount'] = $mathQuestCount;
                    }
                }
            }
        }


        // dump($newRwScore);
        $totalAttempetdQuestions = 0;
        $totalNonAttempetdQuestions = 0;
        $totalQuestions = 0;
        $totalQuest = 0;
        $firstSectionId = 0;
        $sectionIdsArray = [];
        $i = 0;

        $newTotal = 0;
        $mathCount = 0;
        $rwCount = 0;
        $count1 = 0;
        $count2 = 0;
        $count3 = 0;
        $count4 = 0;
        $whichSection = 0;
        // dump($compositeScore);
        // dd($store_sections_details);
        foreach ($store_sections_details as $key => $singletestSections) {
            if (in_array($singletestSections['Sections'][0]['format'], ['DSAT', 'DPSAT'])) {



                if (isset($singletestSections['Sections'][0]['newScore'])) {
                    $compositeScore = $compositeScore + $singletestSections['Sections'][0]['newScore'];

                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Reading_And_Writing' || $singletestSections['Sections'][0]['practice_test_type'] == 'Easy_Reading_And_Writing' || $singletestSections['Sections'][0]['practice_test_type'] == 'Hard_Reading_And_Writing') {
                        session()->forget('reading_and_writing');
                        session()->push('reading_and_writing', [
                            'userId' => Auth::user()->id,
                            'testId' => $singletestSections['Sections'][0]['testid'],
                            'format' => $singletestSections['Sections'][0]['format'],
                            'score' => $singletestSections['Sections'][0]['newScore'],
                            'test_type' => $singletestSections['Sections'][0]['practice_test_type']
                        ]);
                    }

                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Math' || $singletestSections['Sections'][0]['practice_test_type'] == 'Math_with_calculator' || $singletestSections['Sections'][0]['practice_test_type'] == 'Math_no_calculator') {
                        session()->forget('math');
                        session()->push('math', [
                            'userId' => Auth::user()->id,
                            'testId' => $singletestSections['Sections'][0]['testid'],
                            'format' => $singletestSections['Sections'][0]['format'],
                            'score' => $singletestSections['Sections'][0]['newScore'],
                            'test_type' => $singletestSections['Sections'][0]['practice_test_type']
                        ]);
                    }
                }

                // dump($singletestSections['Sections'][0]['newScore']);
                $whichSection = 1;

                if (isset($singletestSections['Sections']) && isset($singletestSections['Sections_question'])) {
                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Math') {
                        $mathCount = count($singletestSections['Sections_question']);
                    }

                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Math_with_calculator') {
                        $count1 = count($singletestSections['Sections_question']);
                    }

                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Math_no_calculator') {
                        $count2 = count($singletestSections['Sections_question']);
                    }

                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Reading_And_Writing') {
                        $rwCount = count($singletestSections['Sections_question']);
                    }

                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Easy_Reading_And_Writing') {
                        $count3 = count($singletestSections['Sections_question']);
                    }

                    if ($singletestSections['Sections'][0]['practice_test_type'] == 'Hard_Reading_And_Writing') {
                        $count4 = count($singletestSections['Sections_question']);
                    }
                }

                if (isset($singletestSections['Sections'])) {
                    array_push($sectionIdsArray, (int) $singletestSections['Sections'][0]['id']);
                    if ($i == 0) {

                        $firstSectionId = $singletestSections['Sections'][0]['id'];
                        $i++;
                    }
                }

                if (in_array($singletestSections['Sections'][0]['format'], ['DSAT', 'DPSAT'])) {
                    if (isset($singletestSections['Sections_question'])) {
                        if (
                            isset($singletestSections['check_if_section_completed']) &&
                            $singletestSections['check_if_section_completed'][0] == 'yes'
                        ) {
                            if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math', 'Reading_And_Writing'])) {
                                $totalQuest = $totalQuest + (isset($singletestSections['Sections'][0]['yesSectionCount']) ? $singletestSections['Sections'][0]['yesSectionCount'] : 0);
                            }
                        }
                    }
                }

                if (isset($singletestSections['Sections_question'])) {
                    if (
                        isset($singletestSections['check_if_section_completed']) &&
                        $singletestSections['check_if_section_completed'][0] == 'no'
                    ) {
                        if (in_array($singletestSections['Sections'][0]['practice_test_type'], ['Math', 'Reading_And_Writing'])) {
                            $totalQuest = $totalQuest + (isset($singletestSections['Sections'][0]['noSectionCount']) ? $singletestSections['Sections'][0]['noSectionCount'] : 0);
                        }
                    }
                }
            } else {
                $whichSection = 0;
            }
        }
        // dump($mathCount);
        // dump($count1);
        // dump($count2);
        if ($count1 >= $count2) {
            $mathCount = $mathCount + $count1;
        } else {
            $mathCount = $mathCount + $count2;
        }
        if ($count3 >= $count4) {
            $rwCount = $rwCount + $count3;
        } else {
            $rwCount = $rwCount + $count4;
        }

        // dump($mathCount);
        $newTotal = $mathCount + $rwCount;

        if ($whichSection == 1) {
            if ($rwCount != 0) {
                $store_sections_details[$rwSectionID]['Sections'][0]['section_quest_count'] = $rwCount;
            }
            if ($mathCount != 0) {
                $store_sections_details[$mathSectionID]['Sections'][0]['section_quest_count'] = $mathCount;
            }
        }
        $readingScore = 0;
        $mathScore = 0;

        if ($sections['Sections'][0]['format'] == 'DPSAT' || $sections['Sections'][0]['format'] == 'DSAT') {
            $scoreCalculations = UserAnswers::where('test_id', $id)->where('user_id', $current_user_id)->get();
            $readingScore = $scoreCalculations->where('reading_and_writing_score', '!=', null)->first();
            $mathScore = $scoreCalculations->where('math_score', '!=', null)->first();
            if ($readingScore !== null) {
                $readingScore = $readingScore->reading_and_writing_score;
            } else {
                $readingScore = 0;
            }

            if ($mathScore !== null) {
                $mathScore = $mathScore->math_score;
            } else {
                $mathScore = 0;
            }
        }


        // dump($mathSectionCount);
        // dump($readingSectionCount);
        // dump($store_sections_details);
        // dump($testSection);
        // dump($testSections);
        // dump($testSectionName);
        // dd($store_sections_details);
        return view('user.practice-test-sections', [
            'selected_test_id' => $id,
            'reviewUrl' => $reviewUrl,
            'compositeScore' => $compositeScore,
            'whichSection' => $whichSection,
            'testSections' => $testSections,
            'testSectionName' => $testSectionName,
            'testSection' => $testSection,
            'testSectionsDetails' => $store_sections_details,
            'get_total_sections' => $get_total_sections,
            'mainSectionsCount' => $mainSectionsCount,
            'get_total_questions' => $get_total_questions,
            'check_test_completed' => $check_test_completed,
            'checkTestQuestion' => $checkTestQuestion,
            'get_test_description' => $get_test_description,
            'score' => $section_score,
            'total_score' => $total_score,
            'totalQuest' => $totalQuest,
            'firstSectionId' => $firstSectionId,
            'sectionIdsArray' => $sectionIdsArray,
            'newTotal' => $newTotal,
            'mathCount' => $mathCount,
            'rwCount' => $rwCount,
            'totalAttempetdQuestions' => $totalAttempetdQuestions,
            'totalNonAttempetdQuestions' => $totalNonAttempetdQuestions,
            'practice_test' => $practice_test,
            'test_type' => $test_type,
            'readingScore' => $readingScore,
            'mathScore' => $mathScore,
            'total_all_section_question' => isset($total_all_section_question) ? $total_all_section_question : '0'
        ]);
    }

    public function set_scrollPosition(Request $request)
    {
        $current_user_id = Auth::id();
        $get_question_id = $request->get_question_id;
        $scroll_position = number_format($request->scroll_position, 2, '.');

        if (DB::table('user_scroll_positions')->where('user_id', $current_user_id)->where('question_id', $get_question_id)->exists()) {
            DB::table('user_scroll_positions')->where('user_id', $current_user_id)->where('question_id', $get_question_id)->update(['scroll_position' => $scroll_position]);
        } else {
            $UserScrollPosition = new UserScrollPosition;
            $UserScrollPosition->user_id = $current_user_id;
            $UserScrollPosition->question_id = $get_question_id;
            $UserScrollPosition->scroll_position = $scroll_position;
            $UserScrollPosition->save();
        }
    }

    public function get_scrollPosition(Request $request)
    {
        $current_user_id = Auth::id();
        $get_question_id = $request->get_question_id;

        $scroll_position = DB::table('user_scroll_positions')->where('user_id', $current_user_id)->where('question_id', $get_question_id)->get();
        return response()->json(['success' => '0', 'scroll_position' => $scroll_position]);
    }

    public function resetTest(Request $request, $id)
    {
        UserAnswers::where('user_id', Auth::id())->where('test_id', $request->test_id)->delete();
        $current_user_id = Auth::id();
        $existingRecord = TestProgress::where('test_id', $request->test_id)
            ->where('user_id', $current_user_id)
            ->delete();

        // if ($existingRecord) {
        //     $existingRecord->delete();
        // }
        if ($request->session()->has('testType')) {
            $request->session()->forget('testType');
        }

        $data = DB::table('practice_tests')->where('id', $request['test_id'])->first();
        // dd($data);
        if ($data->test_source == 1 && ($data->format == 'ACT' || $data->format == 'SAT' || $data->format == 'PSAT' || $data->format == 'DSAT' || $data->format == 'DPSAT')) {
            return redirect(url('user/select-test-page/' . $request['test_id']));
        } else {
            return redirect(url('user/practice-test-sections/' . $request['test_id']));
        }
    }

    public function resetSection($testId, $sectionId)
    {
        $current_sections = DB::table('practice_test_sections')
            ->where('id', $sectionId)
            ->first();
        // dump($current_sections);
        // test section not found
        if ($current_sections == null) {
            return redirect(url('user/practice-test-sections/' . $testId));
        }

        $all_sections  = [];
        if ($current_sections->practice_test_type == 'Reading_And_Writing') {
            $all_sections = DB::table('practice_test_sections')
                ->where('testid', $testId)
                ->whereIn('practice_test_type', ['Reading_And_Writing', 'Easy_Reading_And_Writing', 'Hard_Reading_And_Writing'])
                ->pluck('id');
        } elseif ($current_sections->practice_test_type == 'Math') {
            $all_sections = DB::table('practice_test_sections')
                ->where('testid', $testId)
                ->whereIn('practice_test_type', ['Math', 'Math_with_calculator', 'Math_no_calculator'])
                ->pluck('id');
        } else {
            $all_sections = DB::table('practice_test_sections')
                ->where('testid', $testId)
                ->whereIn('practice_test_type', [$current_sections->practice_test_type])
                ->pluck('id');
        }
        // dump($testId);
        // dd($all_sections);
        $user_id = Auth::id();
        foreach ($all_sections as $section_id) {
            $user_answers = UserAnswers::where('user_id', $user_id)
                ->where('test_id', $testId)
                ->where('section_id', $section_id)
                ->delete();

            $test_progress = TestProgress::where('user_id', $user_id)
                ->where('test_id', $testId)
                ->where('section_id', $section_id)
                ->delete();
        }
        return redirect(url('user/practice-test-sections/' . $testId));
    }

    public function resetProctoredSection($testId, $sectionId)
    {
        $current_sections = DB::table('practice_test_sections')
            ->where('id', $sectionId)
            ->first();
        // dump($current_sections);
        // test section not found
        if ($current_sections == null) {
            return redirect(url('user/practice-test-sections/' . $testId));
        }

        $all_sections  = [];
        if ($current_sections->practice_test_type == 'Reading_And_Writing') {
            $all_sections = DB::table('practice_test_sections')
                ->where('testid', $testId)
                ->whereIn('practice_test_type', ['Reading_And_Writing', 'Easy_Reading_And_Writing', 'Hard_Reading_And_Writing'])
                ->pluck('id');
        } elseif ($current_sections->practice_test_type == 'Math') {
            $all_sections = DB::table('practice_test_sections')
                ->where('testid', $testId)
                ->whereIn('practice_test_type', ['Math', 'Math_with_calculator', 'Math_no_calculator'])
                ->pluck('id');
        } else {
            $all_sections = DB::table('practice_test_sections')
                ->where('testid', $testId)
                ->whereIn('practice_test_type', [$current_sections->practice_test_type])
                ->pluck('id');
        }
        // dump($testId);
        // dd($all_sections);
        $user_id = Auth::id();
        foreach ($all_sections as $section_id) {
            $user_answers = UserAnswers::where('user_id', $user_id)
                ->where('test_id', $testId)
                ->where('section_id', $section_id)
                ->delete();

            $test_progress = TestProgress::where('user_id', $user_id)
                ->where('test_id', $testId)
                ->where('section_id', $section_id)
                ->delete();
        }
        return redirect(url('user/practice-test-sections/' . $testId . '?test_section=proctored'));
    }

    public function resetSectionBkp($testId, $id)
    {
        // dd('here');
        $practiceTest = PracticeTest::where("id", $testId)->first(
            [
                "title",
                "format",
                "test_source",
                "description",
                "tags",
                "is_test_completed",
                "user_id"
            ]
        );

        if (!empty($practiceTest)) {
            $practiceTest = $practiceTest->toArray();
            $newPracticeTest = PracticeTest::create($practiceTest);

            if (!empty($newPracticeTest)) {
                $allSections = PracticeTestSection::where(
                    [
                        ["testid", "=", $testId]
                    ]
                )->get([
                    "format",
                    "practice_test_type",
                    "testid",
                    "section_order",
                    "is_section_completed",
                    "section_title",
                    "regular_time",
                    "fifty_per_extended",
                    "hundred_per_extended"
                ]);

                // dd($allSections);

                foreach ($allSections as $section) {
                    $section_type = $section->toArray();
                    $section_type["testid"] = $newPracticeTest->id;
                    $newPracticeTestSection = PracticeTestSection::create($section_type);
                    $questions = PracticeQuestion::where("practice_test_sections_id", $id)->get([
                        'title',
                        'format',
                        'practice_test_sections_id',
                        'type',
                        'passages_id',
                        'passages',
                        'passage_number',
                        'answer',
                        'answer_content',
                        'answer_exp',
                        'fill',
                        'fillType',
                        'multiChoice',
                        'tags',
                        'question_type_id',
                        'category_type',
                        'diff_rating',
                        'super_category',
                        'category_type_values',
                        'super_category_values',
                        'checkbox_values',
                        'question_type_values',
                        'question_order',
                        'parent_id',
                        'selfMade'
                    ]);

                    foreach ($questions as $question) {
                        $question = $question->toArray();
                        $question['practice_test_sections_id'] = $newPracticeTestSection->id;
                        PracticeQuestion::create($question);
                    }
                }
            }
            return redirect(url('user/practice-test-sections/' . $newPracticeTest->id));
        }
    }

    public function testHomePage()
    {
        $user_id = Auth::id();
        // $getAllPracticeTests = PracticeTest::where('test_source', 0)->whereDoesntHave('userAnswers')->get();
        // $getOfficialPracticeTests = PracticeTest::where('test_source', 1)->whereDoesntHave('userAnswers')->get();

        $getOfficialPracticeTests = [];
        $getAllPracticeTests = [];

        $getAllPracticeTests['ACT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 0)
            ->where('practice_tests.format', 'ACT')
            ->whereNull('user_answers.user_id')
            ->get();
        // dd($getAllPracticeTests['ACT']);

        $getAllPracticeTests['SAT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 0)
            ->where('practice_tests.format', 'SAT')
            ->whereNull('user_answers.user_id')
            ->get();

        $getAllPracticeTests['PSAT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 0)
            ->where('practice_tests.format', 'PSAT')
            ->whereNull('user_answers.user_id')
            ->get();

        $getAllPracticeTests['DSAT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 0)
            ->where('practice_tests.format', 'DSAT')
            ->whereNull('user_answers.user_id')
            ->get();

        $getAllPracticeTests['DPSAT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 0)
            ->where('practice_tests.format', 'DPSAT')
            ->whereNull('user_answers.user_id')
            ->get();

        $getOfficialPracticeTests['ACT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 1)
            ->where('practice_tests.format', 'ACT')
            ->whereNull('user_answers.user_id')
            ->get();

        $getOfficialPracticeTests['SAT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 1)
            ->where('practice_tests.format', 'SAT')
            ->whereNull('user_answers.user_id')
            ->get();

        $getOfficialPracticeTests['PSAT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 1)
            ->where('practice_tests.format', 'PSAT')
            ->whereNull('user_answers.user_id')
            ->get();

        $getOfficialPracticeTests['DSAT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 1)
            ->where('practice_tests.format', 'DSAT')
            ->whereNull('user_answers.user_id')
            ->get();

        $getOfficialPracticeTests['DPSAT'] = PracticeTest::select('practice_tests.id', 'practice_tests.title', 'practice_tests.status', 'practice_tests.created_at', 'practice_tests.format', 'practice_tests.test_source')
            ->leftJoin('user_answers', function ($join) use ($user_id) {
                $join->on('practice_tests.id', '=', 'user_answers.test_id')
                    ->where('user_answers.user_id', '=', $user_id);
            })
            ->where('practice_tests.test_source', 1)
            ->where('practice_tests.format', 'DPSAT')
            ->whereNull('user_answers.user_id')
            ->get();

        //Test in Progress
        $formats = ['ACT', 'SAT', 'PSAT', 'DSAT', 'DPSAT'];
        $getAllProgressPracticeTests = [];
        foreach ($formats as $format) {
            $getAllProgressPracticeTests[$format] = PracticeTest::select('practice_tests.*')
                ->distinct()
                ->join('test_progress', function ($join) use ($user_id) {
                    $join->on('test_progress.test_id', '=', 'practice_tests.id')
                        ->where('test_progress.user_id', '=', $user_id);
                })
                ->leftJoin('user_answers', function ($join) use ($user_id) {
                    $join->on('practice_tests.id', '=', 'user_answers.test_id')
                        ->where('user_answers.user_id', '=', $user_id);
                })
                ->where(function ($query) use ($user_id) {
                    $query->where('practice_tests.user_id', '=', $user_id)
                        ->orWhereNull('practice_tests.user_id');
                })
                ->where('practice_tests.format', $format)
                ->whereNull('user_answers.user_id')
                ->get();
        }
        // dump($getAllPracticeTests);
        // dump($getAllProgressPracticeTests);

        // dump($dsat_details_array);
        // dump($all_dsat_details_array);
        // dump($dsat_custom_details);

        // dump($act_details_array);
        // dump($all_sat_details_array);
        // dump($dsat_custom_details);

        return view('student.test-home-page.test_home_page', compact(
            'getAllPracticeTests',
            'getOfficialPracticeTests',
            'getAllProgressPracticeTests'
        ));
    }

    public function testHomePageHistory()
    {
        $user_id = Auth::id();


        $getCustomQuiz['SAT'] = PracticeTest::select('id', 'title')->where('user_id', $user_id)->where('format', 'SAT')->where('test_source', 2)->get();
        $getCustomQuiz['ACT'] = PracticeTest::select('id', 'title')->where('user_id', $user_id)->where('format', 'ACT')->where('test_source', 2)->get();
        // dd($getCustomQuiz['ACT']);
        $getCustomQuiz['PSAT'] = PracticeTest::select('id', 'title')->where('user_id', $user_id)->where('format', 'PSAT')->where('test_source', 2)->get();
        $getCustomQuiz['DSAT'] = PracticeTest::select('id', 'title')->where('user_id', $user_id)->where('format', 'DSAT')->where('test_source', 2)->get();
        $getCustomQuiz['DPSAT'] = PracticeTest::select('id', 'title')->where('user_id', $user_id)->where('format', 'DPSAT')->where('test_source', 2)->get();

        //SAT Custom Quiz
        $sat_custom_details = [];
        foreach ($getCustomQuiz['SAT'] as $key => $value) {
            $sat_custom_details[$value['id']]['test_name'] = $value['title'];
            $sat_custom_details[$value['id']]['id'] = $value['id'];
            $sections = PracticeTestSection::where('testid', $value['id'])->get();
            foreach ($sections as $section) {
                $sat_custom_details[$value['id']]['section_type'] = $section['practice_test_type'];
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section['id'])->get();
                $answer_detail = UserAnswers::where('section_id', $section['id'])->where('user_id', $user_id)->get();
                if (isset($answer_detail[0]['answer'])) {
                    $sat_custom_details[$value['id']]['date_taken'] = $answer_detail[0]['created_at']->format('m/d/y');
                    $answer_data = json_decode($answer_detail[0]['answer'], true);
                    $right = 0;
                    $total = 0;
                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                $right++;
                                $total++;
                            } else {
                                $total++;
                            }
                        }
                    }
                    $sat_custom_details[$value['id']]['right_question'] = $right;
                    $sat_custom_details[$value['id']]['total_question'] = $total;
                } else {
                    $sat_custom_details[$value['id']]['right_question'] = 0;
                    $sat_custom_details[$value['id']]['total_question'] = 0;
                    $sat_custom_details[$value['id']]['date_taken'] = '-';
                }
                if (isset($answer_detail[0]['actual_time'])) {
                    $actual_time = $answer_detail[0]['actual_time'] ?? '';
                } else {
                    $actual_time = '';
                }
                $sat_custom_details[$value['id']][$section['practice_test_type'] . "_actual_time"] = $actual_time;
            }
        }

        //PSAT Custom Quiz
        $psat_custom_details = [];
        foreach ($getCustomQuiz['PSAT'] as $key => $value) {
            $psat_custom_details[$value['id']]['test_name'] = $value['title'];
            $psat_custom_details[$value['id']]['id'] = $value['id'];
            $sections = PracticeTestSection::where('testid', $value['id'])->get();
            foreach ($sections as $section) {
                $psat_custom_details[$value['id']]['section_type'] = $section['practice_test_type'];
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section['id'])->get();
                $answer_detail = UserAnswers::where('section_id', $section['id'])->where('user_id', $user_id)->get();
                if (isset($answer_detail[0]['answer'])) {
                    $psat_custom_details[$value['id']]['date_taken'] = $answer_detail[0]['created_at']->format('m/d/y');
                    $answer_data = json_decode($answer_detail[0]['answer'], true);
                    $right = 0;
                    $total = 0;
                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                $right++;
                                $total++;
                            } else {
                                $total++;
                            }
                        }
                    }
                    $psat_custom_details[$value['id']]['right_question'] = $right;
                    $psat_custom_details[$value['id']]['total_question'] = $total;
                } else {
                    $psat_custom_details[$value['id']]['right_question'] = 0;
                    $psat_custom_details[$value['id']]['total_question'] = 0;
                    $psat_custom_details[$value['id']]['date_taken'] = '-';
                }
                if (isset($answer_detail[0]['actual_time'])) {
                    $actual_time = $answer_detail[0]['actual_time'] ?? '';
                } else {
                    $actual_time = '';
                }
                $psat_custom_details[$value['id']][$section['practice_test_type'] . "_actual_time"] = $actual_time;
            }
        }

        //ACT Custom Quiz
        $act_custom_details = [];
        foreach ($getCustomQuiz['ACT'] as $key => $value) {
            $act_custom_details[$value['id']]['test_name'] = $value['title'];
            $act_custom_details[$value['id']]['id'] = $value['id'];
            $sections = PracticeTestSection::where('testid', $value['id'])->get();
            foreach ($sections as $section) {
                $act_custom_details[$value['id']]['section_type'] = $section['practice_test_type'];
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section['id'])->get();
                $answer_detail = UserAnswers::where('section_id', $section['id'])->where('user_id', $user_id)->get();
                if (isset($answer_detail[0]['answer'])) {
                    $act_custom_details[$value['id']]['date_taken'] = $answer_detail[0]['created_at']->format('m/d/y');
                    $answer_data = json_decode($answer_detail[0]['answer'], true);
                    $right = 0;
                    $total = 0;
                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                $right++;
                                $total++;
                            } else {
                                $total++;
                            }
                        }
                    }
                    $act_custom_details[$value['id']]['right_question'] = $right;
                    $act_custom_details[$value['id']]['total_question'] = $total;
                } else {
                    $act_custom_details[$value['id']]['right_question'] = 0;
                    $act_custom_details[$value['id']]['total_question'] = 0;
                    $act_custom_details[$value['id']]['date_taken'] = '-';
                }
                if (isset($answer_detail[0]['actual_time'])) {
                    $actual_time = $answer_detail[0]['actual_time'] ?? '';
                } else {
                    $actual_time = '';
                }
                $act_custom_details[$value['id']][$section['practice_test_type'] . "_actual_time"] = $actual_time;
            }
        }

        //DSAT Custom Quiz
        $dsat_custom_details = [];
        foreach ($getCustomQuiz['DSAT'] as $key => $value) {
            $dsat_custom_details[$value['id']]['test_name'] = $value['title'];
            $dsat_custom_details[$value['id']]['id'] = $value['id'];
            $sections = PracticeTestSection::where('testid', $value['id'])->get();
            foreach ($sections as $section) {
                $dsat_custom_details[$value['id']]['section_type'] = $section['practice_test_type'];
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section['id'])->get();
                $answer_detail = UserAnswers::where('section_id', $section['id'])->where('user_id', $user_id)->get();
                if (isset($answer_detail[0]['answer'])) {
                    $dsat_custom_details[$value['id']]['date_taken'] = $answer_detail[0]['created_at']->format('m/d/y');
                    $answer_data = json_decode($answer_detail[0]['answer'], true);

                    $right = 0;
                    $total = 0;

                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                $right++;
                                $total++;
                            } else {
                                $total++;
                            }
                        }
                    }

                    $dsat_custom_details[$value['id']]['right_question'] = $right;
                    $dsat_custom_details[$value['id']]['total_question'] = $total;
                } else {
                    $dsat_custom_details[$value['id']]['right_question'] = 0;
                    $dsat_custom_details[$value['id']]['total_question'] = 0;
                    $dsat_custom_details[$value['id']]['date_taken'] = '-';
                }
                if (isset($answer_detail[0]['actual_time'])) {
                    $actual_time = $answer_detail[0]['actual_time'] ?? '';
                } else {
                    $actual_time = '';
                }
                $dsat_custom_details[$value['id']][$section['practice_test_type'] . "_actual_time"] = $actual_time;
            }
        }

        //DPSAT Custom Quiz
        $dpsat_custom_details = [];
        foreach ($getCustomQuiz['DPSAT'] as $key => $value) {
            $dpsat_custom_details[$value['id']]['test_name'] = $value['title'];
            $dpsat_custom_details[$value['id']]['id'] = $value['id'];
            $sections = PracticeTestSection::where('testid', $value['id'])->get();
            foreach ($sections as $section) {
                $dpsat_custom_details[$value['id']]['section_type'] = $section['practice_test_type'];
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section['id'])->get();
                $answer_detail = UserAnswers::where('section_id', $section['id'])->where('user_id', $user_id)->get();
                if (isset($answer_detail[0]['answer'])) {
                    $dpsat_custom_details[$value['id']]['date_taken'] = $answer_detail[0]['created_at']->format('m/d/y');
                    $answer_data = json_decode($answer_detail[0]['answer'], true);
                    $right = 0;
                    $total = 0;
                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                $right++;
                                $total++;
                            } else {
                                $total++;
                            }
                        }
                    }
                    $dpsat_custom_details[$value['id']]['right_question'] = $right;
                    $dpsat_custom_details[$value['id']]['total_question'] = $total;
                } else {
                    $dpsat_custom_details[$value['id']]['right_question'] = 0;
                    $dpsat_custom_details[$value['id']]['total_question'] = 0;
                    $dpsat_custom_details[$value['id']]['date_taken'] = '-';
                }
                if (isset($answer_detail[0]['actual_time'])) {
                    $actual_time = $answer_detail[0]['actual_time'] ?? '';
                } else {
                    $actual_time = '';
                }
                $dpsat_custom_details[$value['id']][$section['practice_test_type'] . "_actual_time"] = $actual_time;
            }
        }

        $helper = new Helper();
        //DSAT
        $dsat_test = PracticeTest::where('format', 'DSAT')->whereNotIn('test_source', [2])->get();
        $dsat_details_array = $this->getDsatDetailsArray($dsat_test, $user_id, $helper);

        $all_dsat_test = PracticeTest::where('format', 'DSAT')->get();
        $all_dsat_details_array = $this->getDsatDetailsArray($all_dsat_test, $user_id, $helper);

        //DPSAT
        $dpsat_test = PracticeTest::where('format', 'DPSAT')->whereNotIn('test_source', [2])->get();
        $dpsat_details_array = $this->getDpsatDetailsArray($dpsat_test, $user_id, $helper);

        $all_dpsat_test = PracticeTest::where('format', 'DPSAT')->get();
        $all_dpsat_details_array = $this->getDpsatDetailsArray($all_dpsat_test, $user_id, $helper);

        //ACT
        $act_test = PracticeTest::where('format', 'ACT')->whereNotIn('test_source', [2])->get();
        $act_details_array = $this->getActDetailsArray($act_test, $user_id);

        $all_act_test = PracticeTest::where('format', 'ACT')->get();
        $all_act_details_array = $this->getActDetailsArray($all_act_test, $user_id);

        //SAT
        // $sat_test = PracticeTest::where('format','SAT')->where('test_source',0)->get();
        // $sat_details_array = [];
        // foreach($sat_test as $test){
        //     $sat_details_array[$test->id]['test_id'] = $test->id;
        //     $sat_details_array[$test->id]['test_name'] = $test->title;
        //     $sections_details = PracticeTestSection::where('testid',$test->id)->where('format','SAT')->get();
        //     foreach($sections_details as $section_detail){
        //         $practice_questions = PracticeQuestion::where('practice_test_sections_id',$section_detail->id)->get();
        //         $answer_details = UserAnswers::where('section_id',$section_detail->id)->get();
        //         if(isset($answer_details[0]['answer'])){
        //             $sat_details_array[$test->id]['date_taken'] = $answer_details[0]['created_at']->format('m/d/Y');
        //             $answer_data = json_decode($answer_details[0]['answer'],true);
        //             $right_question = 0;
        //             foreach($practice_questions as $practice_question){
        //                 if(isset($answer_data[$practice_question->id])){
        //                     if(str_replace(' ','',$practice_question->answer) == str_replace(' ','',$answer_data[$practice_question->id])){
        //                         $right_question++;
        //                     }
        //                 }
        //             }
        //         } else {
        //             $sat_details_array[$test->id]['date_taken'] = '-';
        //             $right_question = 0;
        //         }
        //         $scaled_score_for_section = Score::where('section_id',$section_detail->id)->where('actual_score',$right_question)->get('converted_score');
        //         if(isset($scaled_score_for_section[0]['converted_score'])){
        //             $sat_details_array[$test->id][$section_detail->practice_test_type] = $scaled_score_for_section[0]['converted_score'];
        //         } else {
        //             $sat_details_array[$test->id][$section_detail->practice_test_type] = 0;
        //         }
        //     }
        // }

        //PSAT
        // $psat_test = PracticeTest::where('format','PSAT')->where('test_source',0)->get();
        // $psat_details_array = [];
        // foreach($psat_test as $test){
        //     $psat_details_array[$test->id]['test_id'] = $test->id;
        //     $psat_details_array[$test->id]['test_name'] = $test->title;
        //     $sections_details = PracticeTestSection::where('testid',$test->id)->where('format','PSAT')->get();
        //     foreach($sections_details as $section_detail){
        //         $practice_questions = PracticeQuestion::where('practice_test_sections_id',$section_detail->id)->get();
        //         $answer_details = UserAnswers::where('section_id',$section_detail->id)->get();
        //         $right_question = 0;
        //         if(isset($answer_details[0]['answer'])){
        //             $psat_details_array[$test->id]['date_taken'] = $answer_details[0]['created_at']->format('m/d/Y');
        //             $answer_data = json_decode($answer_details[0]['answer'],true);
        //             foreach($practice_questions as $practice_question){
        //                 if(isset($answer_data[$practice_question->id])){
        //                     if(str_replace(' ','',$practice_question->answer) == str_replace(' ','',$answer_data[$practice_question->id])){
        //                         $right_question++;
        //                     }
        //                 }
        //             }
        //         } else {
        //             $psat_details_array[$test->id]['date_taken'] = '-';
        //             $right_question = 0;
        //         }
        //         $scaled_score_for_section = Score::where('section_id',$section_detail->id)->where('actual_score',$right_question)->get('converted_score');
        //         if(isset($scaled_score_for_section[0]['converted_score'])){
        //             $psat_details_array[$test->id][$section_detail->practice_test_type] = $scaled_score_for_section[0]['converted_score'];
        //         } else {
        //             $psat_details_array[$test->id][$section_detail->practice_test_type] = 0;
        //         }
        //     }
        // }

        //PSAT
        $psat_test = PracticeTest::where('format', 'PSAT')->whereNotIn('test_source', [2])->get();
        $psat_details_array = $this->getPsatDetailsArray($psat_test, $user_id, $helper);

        $all_psat_test = PracticeTest::where('format', 'PSAT')->get();
        $all_psat_details_array = $this->getPsatDetailsArray($all_psat_test, $user_id, $helper);

        //SAT
        $sat_test = PracticeTest::where('format', 'SAT')->whereNotIn('test_source', [2])->get();
        $sat_details_array = $this->getSatDetailsArray($sat_test, $user_id, $helper);

        $all_sat_test = PracticeTest::where('format', 'SAT')->get();
        $all_sat_details_array = $this->getSatDetailsArray($all_sat_test, $user_id, $helper);

        $html = view('student.test-home-page.test_home_page_history',  compact(
            'act_details_array',
            'all_act_details_array',

            'sat_details_array',
            'all_sat_details_array',

            'psat_details_array',
            'all_psat_details_array',

            'dsat_details_array',
            'all_dsat_details_array',

            'dpsat_details_array',
            'all_dpsat_details_array',

            'dsat_custom_details',
            'dpsat_custom_details',
            'sat_custom_details',
            'psat_custom_details',
            'act_custom_details',
        ))->render();
        return response()->json(['html' => $html]);
    }



    // public function testHomePage()
    // {
    //     $user_id = Auth::id();
    //     $formats = ['ACT', 'SAT', 'PSAT', 'DSAT', 'DPSAT'];
    //     $cacheKey = 'test_home_page_data_' . $user_id;

    //     // Attempt to retrieve data from cache
    //     $cachedData = Cache::get($cacheKey);

    //     if ($cachedData) {
    //         // If cached data is available, return it
    //         return view('student.test-home-page.test_home_page', $cachedData);
    //     }

    //     // Data is not in cache, retrieve and process data
    //     $getAllPracticeTests = [];
    //     $getOfficialPracticeTests = [];

    //     $getCustomQuiz = $this->getCustomQuiz($user_id, $formats);

    //     foreach ($formats as $format) {
    //         $getAllPracticeTests[$format] = $this->getPracticeTests($user_id, $format, 0);
    //         $getOfficialPracticeTests[$format] = $this->getPracticeTests($user_id, $format, 1);
    //     }

    //     // $getCustomQuiz = $this->getCustomQuiz($user_id, $formats);

    //     // $sat_custom_details = $this->getCustomDetails($getCustomQuiz['SAT'], $user_id);
    //     // $psat_custom_details = $this->getCustomDetails($getCustomQuiz['PSAT'], $user_id);
    //     // $act_custom_details = $this->getCustomDetails($getCustomQuiz['ACT'], $user_id);
    //     // $dsat_custom_details = $this->getCustomDetails($getCustomQuiz['DSAT'], $user_id);
    //     // $dpsat_custom_details = $this->getCustomDetails($getCustomQuiz['DPSAT'], $user_id);

    //     foreach ($formats as $quizType) {
    //         $customDetails[$quizType] = $this->getCustomDetails($getCustomQuiz[$quizType], $user_id);

    //         // Capture specific variables if needed
    //         ${strtolower($quizType) . '_custom_details'} = $customDetails[$quizType];
    //     }

    //     $helper = new Helper();

    //     //DSAT
    //     $dsat_test = DB::table('practice_tests')->where('format', 'DSAT')->whereNotIn('test_source', [2])->get();
    //     $dsat_details_array = $this->getDsatDetailsArray($dsat_test, $user_id, $helper);

    //     $all_dsat_test = DB::table('practice_tests')->where('format', 'DSAT')->get();
    //     $all_dsat_details_array = $this->getDsatDetailsArray($all_dsat_test, $user_id, $helper);

    //     //DPSAT
    //     $dpsat_test = DB::table('practice_tests')->where('format', 'DPSAT')->whereNotIn('test_source', [2])->get();
    //     $dpsat_details_array = $this->getDpsatDetailsArray($dpsat_test, $user_id, $helper);

    //     $all_dpsat_test = DB::table('practice_tests')->where('format', 'DPSAT')->get();
    //     $all_dpsat_details_array = $this->getDpsatDetailsArray($all_dpsat_test, $user_id, $helper);

    //     //ACT
    //     $act_test = DB::table('practice_tests')->where('format', 'ACT')->whereNotIn('test_source', [2])->get();
    //     $act_details_array = $this->getActDetailsArray($act_test, $user_id);

    //     $all_act_test = DB::table('practice_tests')->where('format', 'ACT')->get();
    //     $all_act_details_array = $this->getActDetailsArray($all_act_test, $user_id);


    //     //PSAT
    //     $psat_test = DB::table('practice_tests')->where('format', 'PSAT')->whereNotIn('test_source', [2])->get();
    //     $psat_details_array = $this->getPsatDetailsArray($psat_test, $user_id, $helper);

    //     $all_psat_test = DB::table('practice_tests')->where('format', 'PSAT')->get();
    //     $all_psat_details_array = $this->getPsatDetailsArray($all_psat_test, $user_id, $helper);

    //     //SAT
    //     $sat_test = DB::table('practice_tests')->where('format', 'SAT')->whereNotIn('test_source', [2])->get();
    //     $sat_details_array = $this->getSatDetailsArray($sat_test, $user_id, $helper);

    //     $all_sat_test = DB::table('practice_tests')->where('format', 'SAT')->get();
    //     $all_sat_details_array = $this->getSatDetailsArray($all_sat_test, $user_id, $helper);

    //     $getAllProgressPracticeTests = $this->getAllProgressPracticeTests($user_id, $formats);

    //     if (request()->session()->has('testType')) {
    //         request()->session()->forget('testType');
    //     }

    //     // Combine data for caching
    //     $cachedData = compact(
    //         'getAllPracticeTests',
    //         'getOfficialPracticeTests',
    //         'act_details_array',
    //         'all_act_details_array',
    //         'sat_details_array',
    //         'all_sat_details_array',
    //         'psat_details_array',
    //         'all_psat_details_array',
    //         'dsat_details_array',
    //         'all_dsat_details_array',
    //         'dpsat_details_array',
    //         'all_dpsat_details_array',
    //         'dsat_custom_details',
    //         'dpsat_custom_details',
    //         'sat_custom_details',
    //         'psat_custom_details',
    //         'act_custom_details',
    //         'getAllProgressPracticeTests'
    //     );

    //     // Cache the data for 2 minutes
    //     Cache::put($cacheKey, $cachedData, now()->addMinutes(1));

    //     return view('student.test-home-page.test_home_page', $cachedData);
    // }

    public function selectTestPage($id)
    {
        $test_info = DB::table('practice_tests')
            ->where('id', $id)
            ->first();
        // dd($test_info);
        return view('student.test-home-page.select_test')->with('test_info', $test_info);
    }

    // Common method to fetch practice tests
    private function getPracticeTests($user_id, $format, $test_source)
    {
        $cacheKey = 'practice_tests_' . $user_id . '_' . $format . '_' . $test_source;

        return Cache::remember($cacheKey, now()->addMinutes(2), function () use ($user_id, $format, $test_source) {
            return PracticeTest::select('practice_tests.*')
                ->leftJoin('user_answers', function ($join) use ($user_id) {
                    $join->on('practice_tests.id', '=', 'user_answers.test_id')
                        ->where('user_answers.user_id', '=', $user_id);
                })
                ->where('practice_tests.test_source', $test_source)
                ->where('practice_tests.format', $format)
                ->whereNull('user_answers.user_id')
                ->get();
        });
    }

    // Common method to fetch custom quiz
    private function getCustomQuiz($user_id, $formats)
    {
        $cacheKey = 'custom_quiz_' . $user_id . '_' . implode('_', $formats);

        return Cache::remember($cacheKey, now()->addMinutes(2), function () use ($user_id, $formats) {
            $customQuizzes = [];

            foreach ($formats as $format) {
                $customQuizzes[$format] = PracticeTest::where('user_id', $user_id)
                    ->where('format', $format)
                    ->where('test_source', 2)
                    ->get();
            }

            return $customQuizzes;
        });
    }

    // Common method to fetch custom details
    private function getCustomDetails($customQuiz, $user_id)
    {
        $custom_details = [];
        foreach ($customQuiz as $value) {
            $custom_details[$value['id']]['test_name'] = $value['title'];
            $custom_details[$value['id']]['id'] = $value['id'];

            $sections = PracticeTestSection::where('testid', $value['id'])->get();

            foreach ($sections as $section) {
                $custom_details[$value['id']]['section_type'] = $section['practice_test_type'];
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section['id'])->get();
                $answer_detail = UserAnswers::where('section_id', $section['id'])->where('user_id', $user_id)->first();

                if ($answer_detail) {
                    $custom_details[$value['id']]['date_taken'] = $answer_detail['created_at']->format('m/d/y');
                    $answer_data = json_decode($answer_detail['answer'], true);

                    $right = 0;
                    $total = 0;

                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                $right++;
                            }
                            $total++;
                        }
                    }

                    $custom_details[$value['id']]['right_question'] = $right;
                    $custom_details[$value['id']]['total_question'] = $total;
                } else {
                    $custom_details[$value['id']]['right_question'] = 0;
                    $custom_details[$value['id']]['total_question'] = 0;
                    $custom_details[$value['id']]['date_taken'] = '-';
                }

                $actual_time = $answer_detail['actual_time'] ?? '';
                $custom_details[$value['id']][$section['practice_test_type'] . "_actual_time"] = $actual_time;
            }
        }

        return $custom_details;
    }


    // Common method to fetch all progress practice tests
    private function getAllProgressPracticeTests($user_id, $formats)
    {
        $cacheKey = 'all_progress_practice_tests_' . $user_id;

        return Cache::remember($cacheKey, now()->addMinutes(2), function () use ($user_id, $formats) {
            $getAllProgressPracticeTests = [];

            foreach ($formats as $format) {
                $getAllProgressPracticeTests[$format] = DB::table('practice_tests')->select('practice_tests.*')
                    ->distinct()
                    ->join('test_progress', function ($join) use ($user_id) {
                        $join->on('test_progress.test_id', '=', 'practice_tests.id')
                            ->where('test_progress.user_id', '=', $user_id);
                    })
                    ->leftJoin('user_answers', function ($join) use ($user_id) {
                        $join->on('practice_tests.id', '=', 'user_answers.test_id')
                            ->where('user_answers.user_id', '=', $user_id);
                    })
                    ->where(function ($query) use ($user_id) {
                        $query->where('practice_tests.user_id', '=', $user_id)
                            ->orWhereNull('practice_tests.user_id');
                    })
                    ->where('practice_tests.format', $format)
                    ->whereNull('user_answers.user_id')
                    ->get();
            }

            return $getAllProgressPracticeTests;
        });
    }


    public function getActDetailsArray($act_test, $user_id)
    {
        $act_details_array = [];
        foreach ($act_test as $test) {
            $act_details_array[$test->id]['test_id'] = $test->id;
            $act_details_array[$test->id]['test_name'] = $test->title;
            $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'ACT')->get();
            $act_details_array[$test->id]['section_count'] = $sections_details->count();
            $date_taken = UserAnswers::where('test_id', $test->id)->where('user_id', $user_id)->get('created_at');
            if (isset($date_taken[0]->created_at)) {
                $act_details_array[$test->id]['date_taken'] = $date_taken[0]->created_at->format('m/d/y');
            } else {
                $act_details_array[$test->id]['date_taken'] = '-';
            }
            foreach ($sections_details as $section_detail) {
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section_detail->id)->get();
                $answer_details = UserAnswers::where('section_id', $section_detail->id)->where('user_id', $user_id)->get();
                if (isset($answer_details[0]['answer'])) {
                    // $act_details_array[$test->id]['date_taken'] = $answer_details[0]['created_at']->format('m/d/Y');
                    $answer_data = json_decode($answer_details[0]['answer'], true);
                    $right_questions = 0;
                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                $right_questions++;
                            }
                        }
                    }
                } else {
                    // $act_details_array[$test->id]['date_taken'] = '-';
                    $right_questions = 0;
                }

                if (isset($answer_details[0]['actual_time'])) {
                    $actual_time = $answer_details[0]['actual_time'] ?? '';
                } else {
                    $actual_time = '';
                }
                $act_details_array[$test->id][$section_detail->practice_test_type . "_actual_time"] = $actual_time;

                $scaled_score_for_section = Score::where('section_id', $section_detail->id)->where('actual_score', $right_questions)->get('converted_score');
                if (isset($scaled_score_for_section[0]['converted_score'])) {
                    $act_details_array[$test->id][$section_detail->practice_test_type] = $scaled_score_for_section[0]['converted_score'];
                } else {
                    $act_details_array[$test->id][$section_detail->practice_test_type] = 0;
                }
            }
        }
        return $act_details_array;
    }

    public function getPsatDetailsArray($psat_test, $user_id, $helper)
    {
        $psat_details_array = [];
        foreach ($psat_test as $test) {
            $psat_details_array[$test->id]['test_id'] = $test->id;
            $psat_details_array[$test->id]['test_name'] = $test->title;
            $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'PSAT')->get();
            $date_taken = UserAnswers::where('test_id', $test->id)->where('user_id', $user_id)->get('created_at');
            if (isset($date_taken[0]->created_at)) {
                $psat_details_array[$test->id]['date_taken'] = $date_taken[0]->created_at->format('m/d/y');
            } else {
                $psat_details_array[$test->id]['date_taken'] = '-';
            }
            foreach ($sections_details as $section_detail) {
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section_detail->id)->get();
                $answer_details = UserAnswers::where('section_id', $section_detail->id)->where('user_id', $user_id)->get();
                $right_question[$test->id][$section_detail->practice_test_type] = [];
                if (isset($answer_details[0]['answer'])) {
                    // $psat_details_array[$test->id]['date_taken'] = $answer_details[0]['created_at']->format('m/d/Y');
                    $answer_data = json_decode($answer_details[0]['answer'], true);
                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if ($practice_question->multiChoice == 2) {
                                $correct[$practice_question->id] = $practice_question->answer;
                                // if(in_array(str_replace(' ','',$answer_data[$practice_question->id]),$correct) || in_array(str_replace(' ','',$answer_data[$practice_question->id]),explode(',',$correct[$practice_question->id])) || Str::contains($correct[$practice_question->id], explode(',',str_replace(' ','',$answer_data[$practice_question->id])))){
                                if ($helper->stringExactMatch($correct[$practice_question->id], $answer_data[$practice_question->id])) {
                                    array_push($right_question[$test->id][$section_detail->practice_test_type], $practice_question->id);
                                }
                            } else {
                                if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                    array_push($right_question[$test->id][$section_detail->practice_test_type], $practice_question->id);
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach ($psat_test as $test) {
            $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'PSAT')->get();
            foreach ($sections_details as $section_detail) {
                $answers = UserAnswers::select('actual_time')
                    ->where('user_id', $user_id)
                    ->where('section_id', $section_detail['id'])
                    ->where('test_id', $test->id)
                    ->get();
                if ($answers->isNotEmpty()) {
                    $actual_time = $answers[0]->actual_time ?? '';
                } else {
                    $actual_time = '';
                }
                $psat_details_array[$test->id][$section_detail['practice_test_type'] . "_actual_time"] = $actual_time;

                if ($section_detail['practice_test_type'] == 'Math_no_calculator') {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]) + (isset($right_question[$test->id]['Math_with_calculator']) ? count($right_question[$test->id]['Math_with_calculator']) : 0);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $psat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $psat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                } else if ($section_detail['practice_test_type'] == 'Math_with_calculator') {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]) + (isset($right_question[$test->id]['Math_no_calculator']) ? count($right_question[$test->id]['Math_no_calculator']) : 0);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $psat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $psat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                } else {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $psat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $psat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                }
            }
        }
        return $psat_details_array;
    }

    public function getDsatDetailsArray($sat_test, $user_id, $helper)
    {
        $sat_details_array = [];
        $right_question = [];

        foreach ($sat_test as $test) {
            $sat_details_array[$test->id]['test_id'] = $test->id;
            $sat_details_array[$test->id]['test_name'] = $test->title;
            $sections_details = $this->getSectionsDetails($test->id);
            $date_taken = UserAnswers::where('test_id', $test->id)->where('user_id', $user_id)->get();
            $readingScore = $date_taken->where('reading_and_writing_score', '!=', null)->first();
            $mathScore = $date_taken->where('math_score', '!=', null)->first();

            if ($readingScore !== null) {
                $readingScore = $readingScore->reading_and_writing_score;
            } else {
                $readingScore = 0;
            }

            if ($mathScore !== null) {
                $mathScore = $mathScore->math_score;
            } else {
                $mathScore = 0;
            }

            if (isset($date_taken[0]->created_at)) {
                $sat_details_array[$test->id]['date_taken'] = $date_taken[0]->created_at->format('m/d/y');
                $sat_details_array[$test->id]['is_proctored'] = $date_taken[0]->is_proctored;
                $sat_details_array[$test->id]['reading_score'] = $readingScore;
                $sat_details_array[$test->id]['math_score'] = $mathScore;
                $sat_details_array[$test->id]['actual_total_score'] = $readingScore + $mathScore;
            } else {
                $sat_details_array[$test->id]['date_taken'] = '-';
                $sat_details_array[$test->id]['is_proctored'] = 0;
                $sat_details_array[$test->id]['reading_score'] = 0;
                $sat_details_array[$test->id]['math_score'] = 0;
                $sat_details_array[$test->id]['actual_total_score'] = 0;
            }

            foreach ($sections_details as $section_detail) {
                // $right_question[$section_detail->practice_test_type] = [];
                $right_question[$section_detail->id] = [];

                $answers = UserAnswers::select('answer', 'actual_time')
                    ->where('user_id', $user_id)
                    ->where('section_id', $section_detail['id'])
                    ->where('test_id', $test->id)
                    ->get();


                if ($answers->isNotEmpty()) {
                    $sat_details_array[$test->id][$section_detail['practice_test_type'] . "_actual_time"] = $answers[0]->actual_time;
                    $answer_data = json_decode($answers[0]->answer, true);
                    if (isset($answer_data)) {
                        $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section_detail->id)->get();
                        foreach ($practice_questions as $practice_question) {
                            if (isset($answer_data[$practice_question->id])) {
                                if ($practice_question->multiChoice == 2) {
                                    $correct[$practice_question->id] = $practice_question->answer;
                                    if ($helper->stringExactMatch($correct[$practice_question->id], $answer_data[$practice_question->id])) {
                                        array_push($right_question[$section_detail->practice_test_type], $practice_question->id);
                                    }
                                } else {
                                    // dd($section_detail->id);
                                    // dump($answer_data[$practice_question->id]);
                                    if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                        array_push($right_question[$section_detail->id], $practice_question->id);
                                        // array_push($right_question[$section_detail->practice_test_type], $practice_question->id);
                                        // dump($right_question);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        // $right_question = array_filter($right_question);
        // dd($right_question);

        // $section_types = array_keys($right_question);
        // // dump($section_types);
        // $section_ids_reading = array_map(function ($section_type) use ($sat_test, $user_id) {
        //     return PracticeTestSection::where('testid', $sat_test[0]->id)
        //         ->where('practice_test_type', 'LIKE', '%Reading%')
        //         ->pluck('id')
        //         ->toArray();
        // }, $section_types);

        // $reading_section_ids = isset($section_ids_reading[0]) ? $section_ids_reading[0] : [];

        // // dd($reading_section_ids);
        // $section_ids_math = array_map(function ($section_type) use ($sat_test, $user_id) {
        //     return PracticeTestSection::where('testid', $sat_test[0]->id)
        //         ->where('practice_test_type', 'LIKE', '%Math%')
        //         ->pluck('id')
        //         ->toArray();
        // }, $section_types);

        // $math_section_ids = isset($section_ids_math[0]) ? $section_ids_math[0] : [];

        // // $mathScoreCount = array_map(function ($section_type) use ($right_question) {
        // //     return count($right_question[$section_type]);
        // // }, $section_types);

        // if (!empty($reading_section_ids)) {
        //     $mathScoreCount = array_map(function ($section_type) use ($right_question, $math_section_ids) {
        //         return isset($math_section_ids) ? count($right_question[$section_type]) : 0;
        //     }, $math_section_ids);
        // }

        // if (!empty($reading_section_ids)) {
        //     $readingScoreCount = array_map(function ($section_type) use ($right_question, $reading_section_ids) {
        //         return isset($reading_section_ids) ? count($right_question[$section_type]) : 0;
        //     }, $reading_section_ids);
        // }
        // // dump($mathScoreCount);
        // // dd(array_sum($readingScoreCount));

        // // dump($mathScoreCount);
        // // dd($readingScoreCount);
        // $eachReadingScore = DB::table('scores')
        //     ->whereIn('section_id', $reading_section_ids)
        //     ->where('actual_score', array_sum($readingScoreCount))
        //     ->orderBy('created_at', 'desc')
        //     ->first('converted_score');

        // // $eachReadingScore = array_map(function ($section_ids_reading, $section_type, $readingScoreCount) {
        // //     return DB::table('scores')
        // //         ->where('section_id', $section_ids_reading)
        // //         ->where('actual_score', $readingScoreCount)
        // //         ->first('converted_score');
        // // }, $section_ids_reading, $section_types, $readingScoreCount);

        // // $eachMathScore = array_map(function ($section_ids_math, $section_type, $mathScoreCount) {
        // //     return DB::table('scores')
        // //         ->where('section_id', $section_ids_math)
        // //         ->where('actual_score', $mathScoreCount)
        // //         ->first('converted_score');
        // // }, $section_ids_math, $section_types, $mathScoreCount);

        // $eachMathScore = DB::table('scores')
        // ->whereIn('section_id', $math_section_ids)
        // ->where('actual_score', array_sum($mathScoreCount))
        // ->orderBy('created_at', 'desc')
        // ->first('converted_score');


        // // dump($eachReadingScore);
        // // dd($eachMathScore);

        // // $score = array_map(function ($eachScore, $mathScoreCount) {
        // //     return $eachScore ? $eachScore->converted_score : 0;
        // // }, $eachScore, $mathScoreCount);



        // // $mathSection = isset($score[0]) ? $score[0] : 0;
        // // $readSection = isset($score[1]) ? $score[1] : 0;

        // $mathSection = isset($eachMathScore) ? $eachMathScore : 0;
        // $readSection = isset($eachReadingScore) ? $eachReadingScore : 0;

        // foreach ($sat_test as $test) {
        //     $sat_details_array[$test->id]["MathSectionsScore"] = $mathSection;
        //     $sat_details_array[$test->id]["ReadSectionsScore"] = $readSection;
        //     $sat_details_array[$test->id]["CompSectionsScore"] = $mathSection + $readSection;
        // }

        $section_types = array_keys($right_question);
        // dump($section_types);
        // Iterate over each test ID
        foreach ($sat_test as $test) {
            // Calculate section IDs for Reading and Math separately for the current test ID
            $section_ids_reading = PracticeTestSection::where('testid', $test->id)
                ->where('practice_test_type', 'LIKE', '%Reading%')
                ->pluck('id')
                ->toArray();

            $section_ids_math = PracticeTestSection::where('testid', $test->id)
                ->where('practice_test_type', 'LIKE', '%Math%')
                ->pluck('id')
                ->toArray();


            // Calculate scores for Reading and Math sections for the current test ID
            $readingScoreCount = array_map(function ($section_type) use ($right_question, $section_ids_reading) {
                return isset($section_ids_reading) ? count($right_question[$section_type]) : 0;
            }, $section_ids_reading);

            // dump($readingScoreCount);

            $mathScoreCount = array_map(function ($section_type) use ($right_question, $section_ids_math) {
                return isset($section_ids_math) ? count($right_question[$section_type]) : 0;
            }, $section_ids_math);

            // Calculate the total score for Reading and Math sections for the current test ID
            $eachReadingScore = DB::table('scores')
                ->whereIn('section_id', $section_ids_reading)
                ->where('actual_score', array_sum($readingScoreCount))
                ->orderBy('created_at', 'desc')
                ->first('converted_score');

            $eachMathScore = DB::table('scores')
                ->whereIn('section_id', $section_ids_math)
                ->where('actual_score', array_sum($mathScoreCount))
                ->orderBy('created_at', 'desc')
                ->first('converted_score');

            // Assign the calculated scores to the corresponding test ID
            $sat_details_array[$test->id]["MathSectionsScore"] = isset($eachMathScore) ? $eachMathScore->converted_score : 0;
            $sat_details_array[$test->id]["ReadSectionsScore"] = isset($eachReadingScore) ? $eachReadingScore->converted_score : 0;
            $sat_details_array[$test->id]["CompSectionsScore"] = $sat_details_array[$test->id]["MathSectionsScore"] + $sat_details_array[$test->id]["ReadSectionsScore"];
        }
        // Calculate other scores or perform further processing as needed


        return $sat_details_array;
    }

    private function getSectionsDetails($test_id)
    {
        return PracticeTestSection::where('testid', $test_id)->where('format', 'DSAT')->get();
    }

    public function getDpsatDetailsArray($sat_test, $user_id, $helper)
    {
        $sat_details_array = [];
        $right_question = [];

        foreach ($sat_test as $test) {
            $sat_details_array[$test->id]['test_id'] = $test->id;
            $sat_details_array[$test->id]['test_name'] = $test->title;
            $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'DPSAT')->get();
            $date_taken = UserAnswers::where('test_id', $test->id)->where('user_id', $user_id)->get();
            $right_question[$test->id]['readSecIDs1'] = [];
            $right_question[$test->id]['mathSecIDs1'] = [];
            $readingScore = $date_taken->where('reading_and_writing_score', '!=', null)->first();
            $mathScore = $date_taken->where('math_score', '!=', null)->first();

            if ($readingScore !== null) {
                $readingScore = $readingScore->reading_and_writing_score;
            } else {
                $readingScore = 0;
            }

            if ($mathScore !== null) {
                $mathScore = $mathScore->math_score;
            } else {
                $mathScore = 0;
            }


            // if ($date_taken) {
            //     $sat_details_array[$test->id]['date_taken'] = $date_taken->format('m/d/y');
            //     $sat_details_array[$test->id]['is_proctored'] = $date_taken[0]->is_proctored;
            // } else {
            //     $sat_details_array[$test->id]['date_taken'] = '-';
            //     $sat_details_array[$test->id]['is_proctored'] = 0;
            // }
            if (isset($date_taken[0]->created_at)) {
                $sat_details_array[$test->id]['date_taken'] = $date_taken[0]->created_at->format('m/d/y');
                $sat_details_array[$test->id]['is_proctored'] = $date_taken[0]->is_proctored;
                $sat_details_array[$test->id]['reading_score'] = $readingScore;
                $sat_details_array[$test->id]['math_score'] = $mathScore;
                $sat_details_array[$test->id]['actual_total_score'] = $readingScore + $mathScore;
            } else {
                $sat_details_array[$test->id]['date_taken'] = '-';
                $sat_details_array[$test->id]['is_proctored'] = 0;
                $sat_details_array[$test->id]['reading_score'] = 0;
                $sat_details_array[$test->id]['math_score'] = 0;
                $sat_details_array[$test->id]['actual_total_score'] = 0;
            }
            // foreach ($sections_details as $section_detail) {
            //     $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section_detail->id)->get();
            //     $answer_details = UserAnswers::where('section_id', $section_detail->id)->where('user_id', $user_id)->first();
            //     $right_question[$test->id][$section_detail->practice_test_type] = [];

            //     if ($answer_details) {
            //         $answer_data = json_decode($answer_details->answer, true);
            //         foreach ($practice_questions as $practice_question) {
            //             if (isset($answer_data[$practice_question->id])) {
            //                 if ($practice_question->multiChoice == 2) {
            //                     $correct[$practice_question->id] = $practice_question->answer;
            //                     if ($helper->stringExactMatch($correct[$practice_question->id], $answer_data[$practice_question->id])) {
            //                         array_push($right_question[$test->id][$section_detail->practice_test_type], $practice_question->id);
            //                     }
            //                 } else {
            //                     if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
            //                         array_push($right_question[$test->id][$section_detail->practice_test_type], $practice_question->id);
            //                     }
            //                 }
            //             }
            //         }
            //     }

            //     if (in_array($section_detail->practice_test_type, ['Math', 'Math_with_calculator', 'Math_no_calculator'])) {
            //         array_push($right_question[$test->id]['mathSecIDs1'], $section_detail->id);
            //     }
            //     if (in_array($section_detail->practice_test_type, ['Reading_And_Writing', 'Easy_Reading_And_Writing', 'Hard_Reading_And_Writing'])) {
            //         array_push($right_question[$test->id]['readSecIDs1'], $section_detail->id);
            //     }
            // }

            foreach ($sections_details as $section_detail) {
                // $right_question[$section_detail->practice_test_type] = [];
                $right_question[$section_detail->id] = [];

                $answers = UserAnswers::select('answer', 'actual_time')
                    ->where('user_id', $user_id)
                    ->where('section_id', $section_detail['id'])
                    ->where('test_id', $test->id)
                    ->get();


                if ($answers->isNotEmpty()) {
                    $sat_details_array[$test->id][$section_detail['practice_test_type'] . "_actual_time"] = $answers[0]->actual_time;
                    $answer_data = json_decode($answers[0]->answer, true);
                    if (isset($answer_data)) {
                        $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section_detail->id)->get();
                        foreach ($practice_questions as $practice_question) {
                            if (isset($answer_data[$practice_question->id])) {
                                if ($practice_question->multiChoice == 2) {
                                    $correct[$practice_question->id] = $practice_question->answer;
                                    if ($helper->stringExactMatch($correct[$practice_question->id], $answer_data[$practice_question->id])) {
                                        array_push($right_question[$section_detail->practice_test_type], $practice_question->id);
                                    }
                                } else {
                                    // dd($section_detail->id);
                                    // dump($answer_data[$practice_question->id]);
                                    if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                        array_push($right_question[$section_detail->id], $practice_question->id);
                                        // array_push($right_question[$section_detail->practice_test_type], $practice_question->id);
                                        // dump($right_question);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // foreach ($right_question as $k => $answerCount) {
        //     $mathScoreCount = 0;
        //     $readScoreCount = 0;

        //     $mathSecIDs = [];
        //     $readSecIDs = [];

        //     if (isset($answerCount['Math'])) {
        //         $mathScoreCount += count($answerCount['Math']);
        //         $mathSecIDs = array_merge($mathSecIDs, array_values($answerCount['Math']));
        //     }
        //     if (isset($answerCount['Math_with_calculator'])) {
        //         $mathScoreCount += count($answerCount['Math_with_calculator']);
        //         $mathSecIDs = array_merge($mathSecIDs, array_values($answerCount['Math_with_calculator']));
        //     }
        //     if (isset($answerCount['Math_no_calculator'])) {
        //         $mathScoreCount += count($answerCount['Math_no_calculator']);
        //         $mathSecIDs = array_merge($mathSecIDs, array_values($answerCount['Math_no_calculator']));
        //     }
        //     if (isset($answerCount['Reading_And_Writing'])) {
        //         $readScoreCount += count($answerCount['Reading_And_Writing']);
        //         $readSecIDs = array_merge($readSecIDs, array_values($answerCount['Reading_And_Writing']));
        //     }
        //     if (isset($answerCount['Easy_Reading_And_Writing'])) {
        //         $readScoreCount += count($answerCount['Easy_Reading_And_Writing']);
        //         $readSecIDs = array_merge($readSecIDs, array_values($answerCount['Easy_Reading_And_Writing']));
        //     }
        //     if (isset($answerCount['Hard_Reading_And_Writing'])) {
        //         $readScoreCount += count($answerCount['Hard_Reading_And_Writing']);
        //         $readSecIDs = array_merge($readSecIDs, array_values($answerCount['Hard_Reading_And_Writing']));
        //     }
        //     // dump($mathScoreCount);
        //     $right_question[$k]['MathScoreCount'] = $mathScoreCount;
        //     $right_question[$k]['ReadScoreCount'] = $readScoreCount;

        //     $right_question[$k]['mathSecIDs'] = $mathSecIDs;
        //     $right_question[$k]['readSecIDs'] = $readSecIDs;
        // }

        // foreach ($sat_test as $test) {
        //     $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'DPSAT')->get();
        //     foreach ($sections_details as $section_detail) {
        //         $answers = UserAnswers::select('actual_time')
        //             ->where('user_id', $user_id)
        //             ->where('section_id', $section_detail['id'])
        //             ->where('test_id', $test->id)
        //             ->first();

        //         $actual_time = $answers->actual_time ?? '';
        //         $sat_details_array[$test->id][$section_detail['practice_test_type'] . "_actual_time"] = $actual_time;

        //         $eachMathScore = DB::table('scores')
        //             ->whereIn('section_id', $right_question[$test->id]['mathSecIDs1'])
        //             ->where('test_id', $test->id)
        //             ->where('actual_score', $right_question[$test->id]['MathScoreCount'])
        //             ->first('converted_score');

        //         $mathSection = $eachMathScore->converted_score ?? 0;

        //         $eachReadScore = DB::table('scores')
        //             ->whereIn('section_id', $right_question[$test->id]['readSecIDs1'])
        //             ->where('test_id', $test->id)
        //             ->where('actual_score', $right_question[$test->id]['ReadScoreCount'])
        //             ->first('converted_score');

        //         $readSection = $eachReadScore->converted_score ?? 0;

        //         $sat_details_array[$test->id]["MathSectionsScore"] = $mathSection;
        //         $sat_details_array[$test->id]["ReadSectionsScore"] = $readSection;
        //         $sat_details_array[$test->id]["CompSectionsScore"] = $mathSection + $readSection;
        //     }
        // }

        $section_types = array_keys($right_question);
        // dump($section_types);
        // Iterate over each test ID
        foreach ($sat_test as $test) {
            // Calculate section IDs for Reading and Math separately for the current test ID
            $section_ids_reading = PracticeTestSection::where('testid', $test->id)
                ->where('practice_test_type', 'LIKE', '%Reading%')
                ->pluck('id')
                ->toArray();

            $section_ids_math = PracticeTestSection::where('testid', $test->id)
                ->where('practice_test_type', 'LIKE', '%Math%')
                ->pluck('id')
                ->toArray();


            // Calculate scores for Reading and Math sections for the current test ID
            $readingScoreCount = array_map(function ($section_type) use ($right_question, $section_ids_reading) {
                return isset($section_ids_reading) ? count($right_question[$section_type]) : 0;
            }, $section_ids_reading);

            // dump($readingScoreCount);

            $mathScoreCount = array_map(function ($section_type) use ($right_question, $section_ids_math) {
                return isset($section_ids_math) ? count($right_question[$section_type]) : 0;
            }, $section_ids_math);

            // Calculate the total score for Reading and Math sections for the current test ID
            $eachReadingScore = DB::table('scores')
                ->whereIn('section_id', $section_ids_reading)
                ->where('actual_score', array_sum($readingScoreCount))
                ->orderBy('created_at', 'desc')
                ->first('converted_score');

            $eachMathScore = DB::table('scores')
                ->whereIn('section_id', $section_ids_math)
                ->where('actual_score', array_sum($mathScoreCount))
                ->orderBy('created_at', 'desc')
                ->first('converted_score');

            // Assign the calculated scores to the corresponding test ID
            $sat_details_array[$test->id]["MathSectionsScore"] = isset($eachMathScore) ? $eachMathScore->converted_score : 0;
            $sat_details_array[$test->id]["ReadSectionsScore"] = isset($eachReadingScore) ? $eachReadingScore->converted_score : 0;
            $sat_details_array[$test->id]["CompSectionsScore"] = $sat_details_array[$test->id]["MathSectionsScore"] + $sat_details_array[$test->id]["ReadSectionsScore"];
        }

        return $sat_details_array;
    }

    public function getDpsatDetailsArrayBkp($sat_test, $user_id, $helper)
    {
        $sat_details_array = [];
        foreach ($sat_test as $test) {
            $sat_details_array[$test->id]['test_id'] = $test->id;
            $sat_details_array[$test->id]['test_name'] = $test->title;
            $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'DPSAT')->get();
            $date_taken = UserAnswers::where('test_id', $test->id)->where('user_id', $user_id)->get('created_at');
            if (isset($date_taken[0]->created_at)) {
                $sat_details_array[$test->id]['date_taken'] = $date_taken[0]->created_at->format('m/d/y');
            } else {
                $sat_details_array[$test->id]['date_taken'] = '-';
            }
            foreach ($sections_details as $section_detail) {
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section_detail->id)->get();
                $answer_details = UserAnswers::where('section_id', $section_detail->id)->where('user_id', $user_id)->get();
                $right_question[$test->id][$section_detail->practice_test_type] = [];
                if (isset($answer_details[0]['answer'])) {
                    // $sat_details_array[$test->id]['date_taken'] = $answer_details[0]['created_at']->format('m/d/Y');
                    $answer_data = json_decode($answer_details[0]['answer'], true);
                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if ($practice_question->multiChoice == 2) {
                                $correct[$practice_question->id] = $practice_question->answer;
                                // if(in_array(str_replace(' ','',$answer_data[$practice_question->id]),$correct) || in_array(str_replace(' ','',$answer_data[$practice_question->id]),explode(',',$correct[$practice_question->id])) || Str::contains($correct[$practice_question->id],explode(',',str_replace(' ','',$answer_data[$practice_question->id])))){
                                if ($helper->stringExactMatch($correct[$practice_question->id], $answer_data[$practice_question->id])) {
                                    array_push($right_question[$test->id][$section_detail->practice_test_type], $practice_question->id);
                                }
                            } else {
                                if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                    array_push($right_question[$test->id][$section_detail->practice_test_type], $practice_question->id);
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach ($sat_test as $test) {
            $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'DPSAT')->get();
            foreach ($sections_details as $section_detail) {
                $answers = UserAnswers::select('actual_time')
                    ->where('user_id', $user_id)
                    ->where('section_id', $section_detail['id'])
                    ->where('test_id', $test->id)
                    ->get();
                if ($answers->isNotEmpty()) {
                    $actual_time = $answers[0]->actual_time ?? '';
                } else {
                    $actual_time = '';
                }
                $sat_details_array[$test->id][$section_detail['practice_test_type'] . "_actual_time"] = $actual_time;

                if ($section_detail['practice_test_type'] == 'Math_no_calculator') {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]) + (isset($right_question[$test->id]['Math_with_calculator']) ? count($right_question[$test->id]['Math_with_calculator']) : 0);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                } else if ($section_detail['practice_test_type'] == 'Math_with_calculator') {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]) + (isset($right_question[$test->id]['Math_no_calculator']) ? count($right_question[$test->id]['Math_no_calculator']) : 0);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                } else {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                }
            }
        }
        return $sat_details_array;
    }

    public function getSatDetailsArray($sat_test, $user_id, $helper)
    {
        $sat_details_array = [];
        foreach ($sat_test as $test) {
            $sat_details_array[$test->id]['test_id'] = $test->id;
            $sat_details_array[$test->id]['test_name'] = $test->title;
            $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'SAT')->get();
            $date_taken = UserAnswers::where('test_id', $test->id)->where('user_id', $user_id)->get('created_at');
            if (isset($date_taken[0]->created_at)) {
                $sat_details_array[$test->id]['date_taken'] = $date_taken[0]->created_at->format('m/d/y');
            } else {
                $sat_details_array[$test->id]['date_taken'] = '-';
            }
            foreach ($sections_details as $section_detail) {
                $practice_questions = PracticeQuestion::where('practice_test_sections_id', $section_detail->id)->get();
                $answer_details = UserAnswers::where('section_id', $section_detail->id)->where('user_id', $user_id)->get();
                $right_question[$test->id][$section_detail->practice_test_type] = [];
                if (isset($answer_details[0]['answer'])) {
                    // $sat_details_array[$test->id]['date_taken'] = $answer_details[0]['created_at']->format('m/d/Y');
                    $answer_data = json_decode($answer_details[0]['answer'], true);
                    foreach ($practice_questions as $practice_question) {
                        if (isset($answer_data[$practice_question->id])) {
                            if ($practice_question->multiChoice == 2) {
                                $correct[$practice_question->id] = $practice_question->answer;
                                // if(in_array(str_replace(' ','',$answer_data[$practice_question->id]),$correct) || in_array(str_replace(' ','',$answer_data[$practice_question->id]),explode(',',$correct[$practice_question->id])) || Str::contains($correct[$practice_question->id],explode(',',str_replace(' ','',$answer_data[$practice_question->id])))){
                                if ($helper->stringExactMatch($correct[$practice_question->id], $answer_data[$practice_question->id])) {
                                    array_push($right_question[$test->id][$section_detail->practice_test_type], $practice_question->id);
                                }
                            } else {
                                if (str_replace(' ', '', $practice_question->answer) == str_replace(' ', '', $answer_data[$practice_question->id])) {
                                    array_push($right_question[$test->id][$section_detail->practice_test_type], $practice_question->id);
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach ($sat_test as $test) {
            $sections_details = PracticeTestSection::where('testid', $test->id)->where('format', 'SAT')->get();
            foreach ($sections_details as $section_detail) {
                $answers = UserAnswers::select('actual_time')
                    ->where('user_id', $user_id)
                    ->where('section_id', $section_detail['id'])
                    ->where('test_id', $test->id)
                    ->get();
                if ($answers->isNotEmpty()) {
                    $actual_time = $answers[0]->actual_time ?? '';
                } else {
                    $actual_time = '';
                }
                $sat_details_array[$test->id][$section_detail['practice_test_type'] . "_actual_time"] = $actual_time;

                if ($section_detail['practice_test_type'] == 'Math_no_calculator') {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]) + (isset($right_question[$test->id]['Math_with_calculator']) ? count($right_question[$test->id]['Math_with_calculator']) : 0);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                } else if ($section_detail['practice_test_type'] == 'Math_with_calculator') {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]) + (isset($right_question[$test->id]['Math_no_calculator']) ? count($right_question[$test->id]['Math_no_calculator']) : 0);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                } else {
                    $tot_right = count($right_question[$test->id][$section_detail['practice_test_type']]);
                    $converted = Score::where('section_id', $section_detail['id'])->where('actual_score', $tot_right)->get('converted_score');
                    if (isset($converted[0]['converted_score'])) {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = $converted[0]['converted_score'];
                    } else {
                        $sat_details_array[$test->id][$section_detail['practice_test_type']] = 0;
                    }
                }
            }
        }
        return $sat_details_array;
    }

    public function generateCustomQuiz(Request $request)
    {
        $selectedCategories = $request->input("selectedCategories") ?? [];
        $selectedQuestionTypes = $request->input("selectedQuestionTypes") ?? [];
        $test_type = $request->input("test_type") ?? '';
        $test_id = $request->input("test_id") ?? '';

        if (!empty($selectedCategories)) {

            $query = PracticeQuestion::query()->select('practice_questions.*');

            $query->leftJoin('question_details', 'question_details.question_id', '=', 'practice_questions.id');

            $query->whereIn("question_details.category_type", $selectedCategories);
            $query->whereIn("question_details.question_type", $selectedQuestionTypes);
            $query->where("practice_questions.selfMade", "0");

            $questions = $query->get();

            if (isset($questions) && !$questions->isEmpty()) {
                $new_test = PracticeTest::create([
                    'title' => $test_type . ' ' . Carbon::now()->format('m-d-y') . ' ' . Carbon::now()->format('H-i-s'),
                    'format' => $test_type,
                    'user_id' => Auth::id(),
                    'test_source' => 2
                ]);

                $section_type = PracticeTestSection::where("testid", $test_id)->first();

                $new_section = PracticeTestSection::create([
                    'format' => $test_type,
                    'practice_test_type' => $section_type->practice_test_type ?? '',
                    'testid' => $new_test['id'],
                    'section_title' => $section_type->section_title ?? ''
                ]);

                foreach ($questions as $index => $question) {
                    $questionOrder = $index + 1;

                    $pq = PracticeQuestion::create([
                        'title' => $question['title'],
                        'format' => $test_type,
                        'practice_test_sections_id' => $new_section['id'],
                        'type' => $question['type'],
                        'passages_id' => $question['passages_id'],
                        'passages' => $request['passages'],
                        'passage_number' => $question['passage_number'],
                        'answer' => $question['answer'],
                        'answer_content' => $question['answer_content'],
                        'answer_exp' => $question['answer_exp'],
                        'fill' => $question['fill'],
                        'fillType' => $question['fillType'],
                        'multiChoice' => $question['multiChoice'],
                        'tags' => $question['tags'],
                        'question_type_id' => $question['question_type_id'],
                        'category_type' => $question['category_type'],
                        'diff_rating' => $question['diff_rating'],
                        'super_category' => $question['super_category'],
                        'category_type_values' => $question['category_type_values'],
                        'super_category_values' => $question['super_category_values'],
                        'checkbox_values' => $question['checkbox_values'],
                        'question_type_values' => $question['question_type_values'],
                        'question_order' => $questionOrder,
                        'parent_id' => $question['id'],
                        'selfMade' => "1"
                    ]);

                    UserPracticeTestQuestion::create(['practice_test_id' => $new_test['id'], 'temp_id' => $pq->id, 'practice_questions_id' => $question['id']]);
                }
            } else {
                $message = "No questions available for the given criteria.";

                return response()->json(['message' => $message, 'status' => false]);
            }

            return response()->json(['questions' => $questions, 'test_id' => $new_test->id, 'status' => true]);
        }
    }

    public function getAllTypes(Request $request)
    {
        $section_type = $request['section_type'];
        $format = $request['test_type'];

        $super_category = SuperCategory::where('format', $format)
            ->where('section_type', $section_type)
            ->where('selfMade', 1)
            ->get();
        $category = [];
        $questionType = [];
        foreach ($super_category as $super) {
            $superId = array($super->id);
            $category[$super->id] = PracticeCategoryType::whereIn('super_category_id', $superId)
                ->where('section_type', $section_type)
                ->where('selfMade', 1)
                ->get();
            foreach ($category[$super->id] as $categories) {
                $categoryId = array($categories['id']);
                $questionType[$categories['id']] = QuestionType::where('section_type', $section_type)
                    ->where('selfMade', 1)
                    ->whereIn('category_id', $categoryId)
                    ->get();
            }
        }
        return response()->json(
            [
                'super_category' => $super_category,
                'category' => $category,
                'questionType' => $questionType
            ]
        );
    }

    public function getDSAAllTypes(Request $request)
    {

        $section_type = $request['section_type'];
        $format = $request['test_type'];

        if ($format == 'DSAT' || $format == 'DPSAT') {
            if ($section_type == 'Reading / Writing') {
                $section_type = ['Reading_And_Writing', 'Easy_Reading_And_Writing', 'Hard_Reading_And_Writing'];
                $super_category = SuperCategory::where('format', $format)
                    ->whereIn('section_type', $section_type)
                    ->where('selfMade', 1)
                    ->get();
                $category = [];
                $questionType = [];
                foreach ($super_category as $super) {
                    $superId = array($super->id);
                    $category[$super->id] = PracticeCategoryType::whereIn('super_category_id', $superId)
                        ->where('section_type', $section_type)
                        ->where('selfMade', 1)
                        ->get();

                    foreach ($category[$super->id] as $categories) {
                        $categoryId = array($categories['id']);
                        $questionType[$categories['id']] = QuestionType::where('section_type', $section_type)
                            ->where('selfMade', 1)
                            ->whereIn('category_id', $categoryId)
                            ->get();
                    }
                }
                return response()->json(
                    [
                        'super_category' => $super_category,
                        'category' => $category,
                        'questionType' => $questionType
                    ]
                );
            } elseif ($section_type == 'Math') {
                $section_type = ['Math', 'Math_with_calculator', 'Math_no_calculator'];
                $super_category = SuperCategory::where('format', $format)
                    ->whereIn('section_type', $section_type)
                    ->where('selfMade', 1)
                    ->get();
                $category = [];
                $questionType = [];
                foreach ($super_category as $super) {
                    $superId = array($super->id);
                    $category[$super->id] = PracticeCategoryType::whereIn('super_category_id', $superId)
                        ->where('section_type', $section_type)
                        ->where('selfMade', 1)
                        ->get();
                    foreach ($category[$super->id] as $categories) {
                        $categoryId = array($categories['id']);
                        $questionType[$categories['id']] = QuestionType::where('section_type', $section_type)
                            ->where('selfMade', 1)
                            ->whereIn('category_id', $categoryId)
                            ->get();
                    }
                }
                return response()->json(
                    [
                        'super_category' => $super_category,
                        'category' => $category,
                        'questionType' => $questionType
                    ]
                );
            } else {
            }
        }
    }

    public function gettypes(Request $request)
    {
        $format = $request['test_type'];
        $section_type = $request['section_type'];
        $questionTypeData = $request['question_type'] ?? [];
        $subCategory = $request['question_category'] ?? [];
        $superCategory = $request['super_category'] ?? [];
        $diff_rating_input = $request['diff_rating'] ?? [];
        $user_id = Auth::user()->id;
        $category_value = [];
        if (!empty($subCategory)) {
            $category_value = array_values($subCategory);
        }
        $question_type_value = [];
        if (!empty($questionTypeData)) {
            $question_type_value = array_values($questionTypeData);
        }
        $super_category_value = [];
        if (!empty($superCategory)) {
            $super_category_value = array_values($superCategory);
        }

        $diff_rating_value = [];
        if (!empty($diff_rating_input)) {
            $diff_rating_value = array_values($diff_rating_input);
        }

        $countQuestion = [];
        $diff_ratings = DiffRating::all();
        $all = 0;
        $allUnaswered = 0;
        $allUnasweredArray = [];
        // dd($diff_ratings);
        foreach ($diff_ratings as $diff_rating) {
            $query = PracticeQuestion::query()->select('practice_questions.*', "practice_tests.test_source as test_source");
            $query->where('practice_questions.format', $format)
                ->where('practice_questions.diff_rating', $diff_rating->id)
                ->where('practice_questions.selfMade', '0')
                ->where('practice_questions.test_source', 2);

            if (!empty($diff_rating_value)) {
                $query->whereIn("diff_rating", $diff_rating_value);
            }
            $query->leftJoin('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id');
            $query->leftJoin('question_details', 'question_details.question_id', '=', 'practice_questions.id');
            $query->leftJoin('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid');
            $no_section = false;
            if (isset($request['section_type']) && !empty($request['section_type'])) {
                if ($format == 'DSAT' || $format == 'DPSAT') {
                    if ($request['section_type'] == 'Reading / Writing') {
                        $query->whereIn('practice_test_sections.practice_test_type', ['Reading_And_Writing', 'Easy_Reading_And_Writing', 'Hard_Reading_And_Writing']);
                    } elseif ($request['section_type'] == 'Math') {
                        $query->where('practice_test_sections.practice_test_type', ['Math', 'Math_with_calculator', 'Math_no_calculator']);
                    } else {
                    }
                } else {
                    $query->where('practice_test_sections.practice_test_type', $request['section_type']);
                }
            }

            if (count($super_category_value) == 0 && count($category_value) == 0 && count($question_type_value) == 0) {
                $no_section = true;
            }

            $query->where(function ($query) use ($super_category_value, $category_value, $question_type_value) {
                if (!empty($super_category_value)) {
                    $query->orWhereIn("question_details.super_category", $super_category_value);
                }

                if (!empty($category_value)) {
                    $query->orWhereIn("question_details.category_type", $category_value);
                }

                if (!empty($question_type_value)) {
                    $query->orWhereIn("question_details.question_type", $question_type_value);
                }
            });


            $userAnswers = UserAnswers::where("user_id", $user_id)->get();


            $allQuestionsAnswered = [];

            foreach ($userAnswers as $answers) {
                if (!empty($answers->answer)) {
                    $answer = json_decode($answers->answer, 1);
                    $answer = array_filter($answer, function ($val) {
                        return !empty($val) && $val !== "-";
                    });
                    $keys = array_keys($answer);
                    array_push($allQuestionsAnswered, ...$keys);
                }
            }
            $questionsData = $query->inRandomOrder()->pluck('id');
            // dd($questionsData);
            $questionsData = $questionsData->toArray() ?? [];
            $questions = array_unique($questionsData);



            foreach ($questions as $que) {
                $pq = PracticeQuestion::select("id", "parent_id")->whereIn("id", $allQuestionsAnswered)->get();
                $pq = array_map(
                    function ($item) {
                        return $item["parent_id"] ?? $item["id"];
                    },
                    $pq->toArray()
                );
                if (!in_array($que, $pq)) {
                    $allUnaswered = $allUnaswered + 1;
                    array_push($allUnasweredArray, $que);
                }
            }
            $questions = array_values($questions);


            $questionsCount = count($questions);
            $all = $all + $questionsCount;

            $countQuestion[$diff_rating->id] = [
                'count' => $no_section ? 0 : $questionsCount,
                'questions' => $no_section ? [] : $questions,
                'type' => $diff_rating->title
            ];
        }
        $countQuestion[] = [
            'count' => $no_section ? 0 : $allUnaswered,
            'questions' => $no_section ? [] : $allUnasweredArray,
            'type' => 'unanswered'
        ];

        $countQuestion[] = [
            'count' => $no_section ? 0 : $all,
            'questions' => '',
            'type' => 'all'
        ];
        return response()->json(
            [
                'count' => $countQuestion
            ]
        );
    }

    public function getSelfMadeTestQuestion(Request $request)
    {
        $question_ids = $request['question_ids'] ?? [];
        $no_of_questions = $request['no_of_questions'] ?? [];
        // dd($question_ids);
        if (empty($question_ids)) {
            return response()->json(['questions' => '', 'message' => 'No Questions Available', 'status' => false]);
        }
        $query = PracticeQuestion::query()->select('practice_questions.*');

        $query->leftJoin('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id');

        $query->whereIn("practice_questions.id", $question_ids);

        if (!empty($no_of_questions)) {
            $query->limit($no_of_questions);
        }
        $questions = $query->get();

        if (isset($questions) && !$questions->isEmpty()) {
            $new_test = PracticeTest::create([
                'title' => $request['test_type'] . ' ' . Carbon::now()->format('m-d-y') . ' ' . Carbon::now()->format('H-i-s'),
                'format' => $request['test_type'],
                'user_id' => Auth::id(),
                'test_source' => 2
            ]);

            //    dd($request['test_type']);
            if ($request['test_type'] == 'DSAT' || $request['test_type'] == 'DPSAT') {
                if ($request['section_type'][0] == 'Reading / Writing') {
                    $new_section = PracticeTestSection::create([
                        'format' => $request['test_type'],
                        'practice_test_type' => 'Reading_And_Writing',
                        'testid' => $new_test['id'],
                        'section_title' => $request['section_type'][0]
                    ]);
                } else {
                    $new_section = PracticeTestSection::create([
                        'format' => $request['test_type'],
                        'practice_test_type' => $request['section_type'][0],
                        'testid' => $new_test['id'],
                        'section_title' => $request['section_type'][0]
                    ]);
                }
            } else {
                $new_section = PracticeTestSection::create([
                    'format' => $request['test_type'],
                    'practice_test_type' => $request['section_type'][0],
                    'testid' => $new_test['id'],
                    'section_title' => $request['section_type'][0]
                ]);
            }
            // $new_section = PracticeTestSection::create([
            //     'format' => $request['test_type'],
            //     'practice_test_type' => $request['section_type'][0],
            //     'testid' => $new_test['id'],
            //     'section_title' => $request['section_type'][0]
            // ]);

            $super = [];
            foreach ($questions as $index => $question) {
                $super_category_values = [];
                if (!empty($question['super_category_values'])) {
                    $super_category_values = json_decode($question['super_category_values'], 1);
                    $super_category_values = array_values($super_category_values);
                    $super_category_values = array_merge(...$super_category_values);
                }
                $category_type_values = [];
                if (!empty($question['category_type_values'])) {
                    $category_type_values = json_decode($question['category_type_values'], 1);
                    $category_type_values = array_values($category_type_values);
                    $category_type_values = array_merge(...$category_type_values);
                }

                $question_type_values = [];
                if (!empty($question['question_type_values'])) {
                    $question_type_values = json_decode($question['question_type_values'], 1);
                    $question_type_values = array_values($question_type_values);
                    $question_type_values = array_merge(...$question_type_values);
                }

                $questionOrder = $index + 1;

                $practiceQuestion = PracticeQuestion::create([
                    'title' => $question['title'],
                    'format' => $request['test_type'],
                    'practice_test_sections_id' => $new_section['id'],
                    'type' => $question['type'],
                    'passages_id' => $question['passages_id'],
                    'passages' => $request['passages'],
                    'passage_number' => $question['passage_number'],
                    'answer' => $question['answer'],
                    'answer_content' => $question['answer_content'],
                    'answer_exp' => $question['answer_exp'],
                    'fill' => $question['fill'],
                    'fillType' => $question['fillType'],
                    'multiChoice' => $question['multiChoice'],
                    'tags' => $question['tags'],
                    'question_type_id' => $question['question_type_id'],
                    'category_type' => $question['category_type'],
                    'diff_rating' => $question['diff_rating'],
                    'super_category' => $question['super_category'],
                    'category_type_values' => $question['category_type_values'],
                    'super_category_values' => $question['super_category_values'],
                    'checkbox_values' => $question['checkbox_values'],
                    'question_type_values' => $question['question_type_values'],
                    'question_order' => $questionOrder,
                    'parent_id' => $question['id'],
                    'selfMade' => "1"
                ]);

                UserPracticeTestQuestion::create(['practice_test_id' => $new_test['id'], 'temp_id' => $practiceQuestion->id, 'practice_questions_id' => $question['id']]);

                foreach ($super_category_values as $key => $val) {
                    $temp = [
                        'question_id' => $practiceQuestion->id,
                        'super_category' => $val,
                        'category_type' => $category_type_values[$key],
                        'question_type' => $question_type_values[$key]
                    ];

                    array_push($super, $temp);
                }
            }
            QuestionDetails::insert($super);
        } else {
            $message = "No questions available for the given criteria.";

            return response()->json(['message' => $message, 'status' => false]);
        }

        return response()->json(['questions' => $questions, 'test_id' => $new_test->id, 'status' => true]);
    }

    public function changeTitleSelfMade(Request $request)
    {
        PracticeTest::where('id', $request['test_id'])->update(['title' => $request['test_name']]);
    }

    public function get_time(Request $request)
    {
        $sectionId = $request['section_id'];
        $userId = Auth::id();
        $progressFlag = false;
        $timeLeft = '';

        if ($request['question_type'] == 'single') {
            $time = PracticeTestSection::where('id', $sectionId)->first();
        }

        $existingRecord = TestProgress::where('section_id', $sectionId)
            ->where('user_id', $userId)
            ->first();
        if ($existingRecord) {
            $progressFlag = true;
            $timeLeft = $existingRecord->time_left;
        }

        return response()->json(['time' => $time ?? null, 'progressFlag' => $progressFlag, 'time_left' => $timeLeft]);
    }

    public function addMistakeType(Request $request)
    {
        $questions = PracticeQuestion::where('id', $request['question_id'])->first();
        $practice_test_section_id = $request['practice_test_section_id'];

        if (!empty($questions)) {
            $questions->mistake_type = $request['mistake_type'];
            $questions->save();
        }

        $practice_questions = PracticeQuestion::whereIn("practice_test_sections_id", $practice_test_section_id)->get();
        $mistake_type_count = [];
        foreach ($practice_questions as $question) {
            if (!empty($question->mistake_type)) {
                $mistake_type = PracticeQuestion::MISTAKE_TYPES[$question->mistake_type];
                $num = $mistake_type_count[$mistake_type] ?? 0;
                $mistake_type_count[$mistake_type] = $num + 1;
            }
        }
        return response()->json(['questions' => $questions, 'mistake_type_count' => $mistake_type_count, 'status' => true]);
    }
}
