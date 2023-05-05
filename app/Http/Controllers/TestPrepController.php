<?php

namespace App\Http\Controllers;
use App\Models\CalendarEvent;
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
use App\Models\User;
use App\Models\UserScrollPosition;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class TestPrepController extends Controller
{
    /* Fetch all event and display in calendar */

    public function dashboard()
    {
        $getAllPracticeTests = PracticeTest::get();
        
        $events = CalendarEvent::where('user_id', Auth::id())->where('is_assigned',0)->get();
        $all_events = UserCalendar::with(['event' => function($query){
            $query->where('user_id', Auth::id());
        }])->get();

        $final_arr = [];
        
        foreach($all_events as $event) {
            if(!empty($event->event)) {
                $event_arr['id'] = $event->id;
                $event_arr['title'] = $event->event->title;
                $event_arr['description'] = $event->event->description;
                $event_arr['time'] = $event->event->event_time;
                $event_arr['start'] = $event->start_date;
                $event_arr['color'] = $this->findColor($event->event->color);
                $event_arr['end'] = isset($event->end_date) ? date('Y-m-d H:i:s', strtotime('+1 day', strtotime($event->end_date))) : null;
                $event_arr['allDay'] = date('H:i:s', strtotime($event->start_date)) == "00:00:00" ? true : false;
                array_push($final_arr, $event_arr);
            }
        }
        // echo '<pre>';print_r($final_arr);exit;

        return view('student.test-prep-dashboard.dashboard' , compact('getAllPracticeTests'), compact('events', 'final_arr'));
    }

    /* Find color by color class */

    public function findColor($color)
    {
        if($color == "info") {
            $c_code = "#0891b2";
        } else if($color == "warning") {
            $c_code = "#e04f1a";
        } else if($color == "success") {
            $c_code = "#82b54b";
        } else if($color == "danger") {
            $c_code = "#dc2626";
        } else {
            $c_code = "#4c78dd";
        }

        return $c_code;
    }

    public function array_flatten($array) {
        $return = array();
        foreach ($array as $key => $value) {
            if (is_array($value)){
                $return = $return + $this->array_flatten($value);
            } else {
                $return[$key] = $value;
            }
        }
        return $return;
    }

    public function singleReview(Request $request , $test , $id)
    {   
        $current_user_id = Auth::id();
        $get_test_name = $test;
        $set_get_question_category = array();
        $test_category_type = array();
        
        if(isset($_GET['test_id']) && !empty($_GET['test_id']))
        {
            $test_id = $_GET['test_id'];
            $test_category_type = DB::table('practice_questions')
            ->join('practice_test_sections','practice_test_sections.id','=','practice_questions.practice_test_sections_id')
            ->select('category_type','question_type_id')
            ->where('practice_test_sections.testid',$test_id)
            ->get();

            $test_details = PracticeTest::find($test_id);
            
            if($_GET['type'] == 'all')
            {
                $store_all_data = array();
                $question_tags_all = [];
                $store_question_type_data = array();
                $check_question_answers = [];
                $get_test_questions = DB::table('practice_questions')
                ->join('practice_test_sections','practice_test_sections.id','=','practice_questions.practice_test_sections_id')
                ->join('practice_tests','practice_tests.id','=','practice_test_sections.testid')
                ->select('practice_questions.id as test_question_id','practice_questions.question_type_id','practice_questions.category_type', 'practice_questions.tags as tags', 'practice_questions.answer as answer')
                ->where('practice_tests.id',$test_id)
                ->orderBy('practice_questions.question_order', 'ASC')
                ->get();

                $get_all_cat_type = DB::table('practice_category_types')->get();

                $user_answers_data = DB::table('user_answers')->where('test_id', $test_id)->get();
                $answer_arr = [];
                foreach($user_answers_data as $user_answer) {
                    $answers = json_decode($user_answer->answer, true);
                    $answer_arr[] = $answers;
                }
                $answer_arr = $this->array_flatten($answer_arr);
                foreach($get_test_questions as $question) {
                    if(isset($answer_arr[$question->test_question_id])  && !empty($answer_arr[$question->test_question_id])){
                        if($answer_arr[$question->test_question_id] == $question->answer){
                            $check_question_answers[$question->test_question_id] = true;
                        } else {
                            $check_question_answers[$question->test_question_id] = false;
                        }
                    }
                }
               
                if(!$get_test_questions->isEmpty())
                {
                    $percentage_arr_all = [];
                    foreach($get_test_questions as $get_single_test_questions)
                    {
                        $array_ques_type = json_decode($get_single_test_questions->question_type_id, true);

                        $array_cat_type = json_decode($get_single_test_questions->category_type, true);
                        $percentage_arr = [];
                        if(isset($array_cat_type) && !empty($array_cat_type) && isset($array_ques_type) && !empty($array_ques_type))
                        {
                            $mergedArray = [];

                            for ($i=0; $i < count($array_ques_type); $i++) { 
                                $mergedArray[$i] = [
                                    'category_type' => $array_cat_type[$i],
                                    'question_type' => $array_ques_type[$i]
                                ];
                            }

                            foreach($check_question_answers as $q_id => $check_question_answer) {
                                if($get_single_test_questions->test_question_id == $q_id){
                                    $percentage_arr = [
                                        $q_id => $check_question_answer
                                    ];
                                }
                            }
                            
                            foreach($mergedArray as $type)
                            {
                                $get_cat_name_by_id = DB::table('practice_category_types')
                                ->where('id',$type['category_type'])
                                ->get();

                                $get_ques_type_name_by_id = DB::table('question_types')
                                ->where('id',$type['question_type'])
                                ->get();

                                if(isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)){
                                    $percentage_arr_all[$get_cat_name_by_id[0]->category_type_title][] = $percentage_arr;
                                    $question_tags_all[$get_cat_name_by_id[0]->category_type_title][] = isset($get_single_test_questions->tags) ? explode(",", $get_single_test_questions->tags) : [];
                                }
                                if(isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title) && isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title)){
                                    $store_all_data[$get_cat_name_by_id[0]->category_type_title][$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id,'category_title'=>$get_cat_name_by_id[0]->category_type_title,'category_description'=>$get_cat_name_by_id[0]->category_type_description,"category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson,"category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies,"category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods,"category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity,"question_desc" => $get_ques_type_name_by_id[0]->question_type_description,"question_type_title" => $get_ques_type_name_by_id[0]->question_type_title , "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson,"question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies, "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods , "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }

                        if(isset($array_ques_type) && !empty($array_ques_type))
                        {
                            foreach($array_ques_type as $single_ques_type)
                            {
                                $get_ques_type_name_by_id = DB::table('question_types')
                                ->where('id',$single_ques_type)
                                ->get();

                                if(isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title) && isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)){
                                    $store_question_type_data[$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id,'category_title'=>$get_cat_name_by_id[0]->category_type_title,'category_description'=>$get_cat_name_by_id[0]->category_type_description,"category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson,"category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies,"category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods,"category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity,"question_desc" => $get_ques_type_name_by_id[0]->question_type_description,"question_type_title" => $get_ques_type_name_by_id[0]->question_type_title , "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson,"question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies , "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods , "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }
                    }
                }
            } else if($_GET['type'] == 'single') {
                
                $store_all_data = array();
                $question_tags = [];
                $check_question_answers = [];
                $store_question_type_data = array();
                $get_test_questions = DB::table('practice_questions')
                ->join('practice_test_sections','practice_test_sections.id','=','practice_questions.practice_test_sections_id')
                ->select('practice_questions.id as test_question_id','practice_questions.question_type_id','practice_questions.category_type', 'practice_questions.tags as tags', 'practice_questions.answer as answer')
                ->where('practice_test_sections.id',$id)
                ->orderBy('practice_questions.question_order', 'ASC')
                ->get();

                $user_answers_data = DB::table('user_answers')->where('test_id', $test_id)->get();
                $answer_arr = [];
                foreach($user_answers_data as $user_answer) {
                    $answers = json_decode($user_answer->answer, true);
                    $answer_arr[] = $answers;
                }
                $answer_arr = $this->array_flatten($answer_arr);
                foreach($get_test_questions as $question) {
                    if(isset($answer_arr[$question->test_question_id])  && !empty($answer_arr[$question->test_question_id])){
                        if($answer_arr[$question->test_question_id] == $question->answer){
                            $check_question_answers[$question->test_question_id] = true;
                        } else {
                            $check_question_answers[$question->test_question_id] = false;
                        }
                    } else {
                        $check_question_answers[$question->test_question_id] = false;
                    }
                    
                }

                $get_all_cat_type = DB::table('practice_category_types')->get();
               
                if(!$get_test_questions->isEmpty())
                {
                    $percentage_arr_all = [];
                    foreach($get_test_questions as $get_single_test_questions)
                    {
                        $array_ques_type = json_decode($get_single_test_questions->question_type_id, true);

                        $array_cat_type = json_decode($get_single_test_questions->category_type, true);
                        
                        if(isset($array_cat_type) && !empty($array_cat_type) && isset($array_ques_type) && !empty($array_ques_type) )
                        {
                            $mergedArray = [];

                            for ($i=0; $i < count($array_ques_type); $i++) { 
                                $mergedArray[$i] = [
                                    'category_type' => $array_cat_type[$i],
                                    'question_type' => $array_ques_type[$i]
                                ];
                            }

                            foreach($check_question_answers as $q_id => $check_question_answer) {
                                if($get_single_test_questions->test_question_id == $q_id){
                                    $percentage_arr = [
                                        $q_id => $check_question_answer
                                    ];
                                }
                            }

                            foreach($mergedArray as $type)
                            {
                                $get_cat_name_by_id = DB::table('practice_category_types')
                                ->where('id',$type['category_type'])
                                ->get();
                                
                                $get_ques_type_name_by_id = DB::table('question_types')
                                ->where('id',$type['question_type'])
                                ->get();
                                if(isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)){
                                    $percentage_arr_all[$get_cat_name_by_id[0]->category_type_title][] = $percentage_arr;
                                    $question_tags[$get_cat_name_by_id[0]->category_type_title] = isset($get_single_test_questions->tags) ? explode(",", $get_single_test_questions->tags) : [];
                                }
                                if(isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title) && isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title)){
                                    $store_all_data[$get_cat_name_by_id[0]->category_type_title][$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id,'category_title'=>$get_cat_name_by_id[0]->category_type_title,'category_description'=>$get_cat_name_by_id[0]->category_type_description,"category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson,"category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies,"category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods,"category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity,"question_desc" => $get_ques_type_name_by_id[0]->question_type_description,"question_type_title" => $get_ques_type_name_by_id[0]->question_type_title,"question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson,"question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies , "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods , "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }

                        if(isset($array_ques_type) && !empty($array_ques_type))
                        {
                            foreach($array_ques_type as $single_ques_type)
                            {
                                $get_ques_type_name_by_id = DB::table('question_types')
                                ->where('id',$single_ques_type)
                                ->get();
                                if(isset($get_ques_type_name_by_id[0]->question_type_title) && !empty($get_ques_type_name_by_id[0]->question_type_title) && isset($get_cat_name_by_id[0]->category_type_title) && !empty($get_cat_name_by_id[0]->category_type_title)){
                                    $store_question_type_data[$get_ques_type_name_by_id[0]->question_type_title][] = array($get_single_test_questions->test_question_id,'category_description'=>$get_cat_name_by_id[0]->category_type_description,'category_title'=>$get_cat_name_by_id[0]->category_type_title,"category_type_lesson" => $get_cat_name_by_id[0]->category_type_lesson,"category_type_strategies" => $get_cat_name_by_id[0]->category_type_strategies,"category_type_identification_methods" => $get_cat_name_by_id[0]->category_type_identification_methods,"category_type_identification_activity" => $get_cat_name_by_id[0]->category_type_identification_activity,"question_desc" => $get_ques_type_name_by_id[0]->question_type_description,"question_type_title" => $get_ques_type_name_by_id[0]->question_type_title , "question_type_lesson" => $get_ques_type_name_by_id[0]->question_type_lesson , "question_type_strategies" => $get_ques_type_name_by_id[0]->question_type_strategies , "question_type_identification_methods" => $get_ques_type_name_by_id[0]->question_type_identification_methods , "question_type_identification_activity" => $get_ques_type_name_by_id[0]->question_type_identification_activity);
                                }
                            }
                        }
                    }
                }
            } 
        }
        if(isset($_GET['type']) && !empty($_GET['type']))
        {
            if($_GET['type'] == 'all')
            {
                $get_all_section = DB::table('practice_test_sections')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select('practice_test_sections.*')
                ->where('practice_tests.id', $id)
                ->get();
               
                if(!$get_all_section->isEmpty())
                {
                    foreach($get_all_section as $get_single_section)
                    {   
                        $user_selected_answers = DB::table('user_answers')->where('user_id', $current_user_id)->where('section_id', $get_single_section->id)->get();
                        if(isset($user_selected_answers[0]) && !empty($user_selected_answers[0]))
                        {
                            $decoded_answers = [];
                            $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
                            $question_order = PracticeQuestion::where('practice_test_sections_id',$get_single_section->id)->orderBy('question_order', 'ASC')->pluck('id')->toArray();
                            if(isset($question_order) && !empty($question_order)){
                                foreach($question_order as $order) {
                                    $decoded_answers[$order] = $json_decoded_answers->{$order};
                                }
                            }
                            $json_decoded_guess = json_decode($user_selected_answers[0]->guess);
                            $json_decoded_flag = json_decode($user_selected_answers[0]->flag);
                            
                            foreach($decoded_answers as $question_id => $json_decoded_single_answers)
                            {
                                $get_question_details = DB::table('practice_questions')
                                // ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                                ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' ,'practice_questions.tags', 'practice_questions.category_type as category_type', 'practice_questions.question_type_id as question_type_id' , 'practice_questions.answer_exp as answer_exp')
                                ->where('practice_questions.id', $question_id)
                                ->orderBy('practice_questions.question_order', 'ASC')
                                ->get();
                                $store_sections_details[] = array('user_selected_answer' => $json_decoded_single_answers,'user_selected_guess' => $json_decoded_guess->$question_id,'user_selected_flag' => $json_decoded_flag->$question_id,'get_question_details' => $get_question_details , 'all_sections' => $get_all_section , 'date_taken' => $user_selected_answers , 'type' =>$_GET['type']); 
                            }
                        }
                    }
                }
            } else if($_GET['type'] == 'single') {
                $user_selected_answers = DB::table('user_answers')->where('user_id', $current_user_id)->where('section_id', $id)->get();
                $test_section = PracticeTestSection::where('testid', $test_details->id)->where('id',$id)->get('practice_test_type');
                $store_user_answers_details = array();
                if(isset($user_selected_answers[0]) && !empty($user_selected_answers[0]))
                {
                    $decoded_answers = [];
                    $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
                    $question_order = PracticeQuestion::where('practice_test_sections_id',$id)->orderBy('question_order', 'ASC')->pluck('id')->toArray();
                    if(isset($question_order) && !empty($question_order)){
                        foreach($question_order as $order) {
                            $decoded_answers[$order] = $json_decoded_answers->{$order};
                        }
                    }    
                    $json_decoded_guess = json_decode($user_selected_answers[0]->guess);
                    $json_decoded_flag = json_decode($user_selected_answers[0]->flag);
                    foreach($decoded_answers as $question_id => $json_decoded_single_answers)
                    {
                        $get_question_details = DB::table('practice_questions')
                        // ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                        ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order','practice_questions.tags', 'practice_questions.category_type as category_type', 'practice_questions.question_type_id as question_type_id', 'practice_questions.answer_exp as answer_exp')
                        ->where('practice_questions.id', $question_id)
                        ->orderBy('practice_questions.question_order', 'ASC')
                        ->get();
                        $store_sections_details[] = array('user_selected_answer' => $json_decoded_single_answers,'user_selected_guess' => (isset($json_decoded_guess) && !empty($json_decoded_guess)) ? $json_decoded_guess->$question_id : null,'user_selected_flag' => (isset($json_decoded_flag) && !empty($json_decoded_flag)) ? $json_decoded_flag->$question_id : null,'get_question_details' => $get_question_details , 'sections' => $test_section , 'date_taken' => $user_selected_answers , 'type' => $_GET['type']); 
                    }
                }
            }
        }
        if($_GET['type'] == 'all') {
            $question_tags = [];
            foreach($question_tags_all as $key => $question_tag) {
                $question_tags[$key] = array_unique(Arr::flatten($question_tag));
            }
        }
        foreach($percentage_arr_all as $key => $percentage) {
            $correct_ans = 0;
            $wrong_ans = 0;
            $total_question = $this->array_flatten(array_map("unserialize", array_unique(array_map("serialize", $percentage))));
            $count = count($total_question);
            foreach ($total_question as $value) {    
                if($value == true) {
                    $correct_ans++;
                }

                if($value == false) {
                    $wrong_ans++;
                }
            }
            if($count !== 0){
                $percentage_arr_all[$key] = [
                    "correct_ans" => $correct_ans,
                    "wrong_ans" => $wrong_ans,
                    "percentage" => 100 * $correct_ans / $count .'%',
                    "percentage_label" => ( $correct_ans > $wrong_ans ? $correct_ans : $wrong_ans) ."/". $count .( $correct_ans > $wrong_ans ? ' Correct' : ' Incorrect'),
                ];
            }
        }

        $count_right_answer = 0;
        $count_total_question = 0;
        foreach($store_sections_details as $store_sections_detail){
            if(isset($store_sections_detail['user_selected_answer']) && !empty($store_sections_detail['user_selected_answer']) && isset($store_sections_detail['get_question_details'][0]->question_answer) && !empty($store_sections_detail['get_question_details'][0]->question_answer)){
                if($store_sections_detail['user_selected_answer'] == $store_sections_detail['get_question_details'][0]->question_answer){
                    $count_right_answer ++;
                    $count_total_question ++;
                } else {
                    $count_total_question ++;
                }
            }
        }

        return view('user.test-review.question_concepts_review' ,  ['test_details' => $test_details, 'section_id' => $id , 'user_selected_answers' => $store_sections_details ,'get_test_name' => $get_test_name ,'store_all_data'=>$store_all_data,'store_question_type_data' => $store_question_type_data, 'question_tags' => $question_tags, 'percentage_arr_all' => $percentage_arr_all , 'right_answers' => $count_right_answer , 'total_questions' => $count_total_question]);
    }

    public function set_answers(Request $request)
    {
        $current_user_id = Auth::id();
        $get_section_id = $request->get_section_id;
        $get_question_type = $request->get_question_type;
        $get_practice_id = $request->get_practice_id;

        if(isset($get_question_type ) && !empty($get_question_type) && $get_question_type == 'single')
        {
            $get_question_title = DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_tests.id', '=', 'practice_test_sections.testid')
            ->join('practice_questions', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->select('practice_tests.*')
            ->where('practice_questions.practice_test_sections_id', $get_section_id)->get(); 
        }
        else if(isset($get_question_type ) && !empty($get_question_type) && $get_question_type == 'all')
        {
            $get_question_title = DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_tests.id', '=', 'practice_test_sections.testid')
            ->join('practice_questions', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->select('practice_tests.*','practice_test_sections.id as test_section_id','practice_questions.id as test_question_id')
            ->where('practice_tests.id', $get_section_id)->get(); 
        }

        $get_test_name = $get_question_title[0]->title;

        $filtered_answers = array_filter($request->selected_answer);
        $filtered_guess = isset($request->selected_gusess_details) ? array_filter($request->selected_gusess_details) : [];
        $filtered_flag = isset($request->selected_flag_details) ? array_filter($request->selected_flag_details) : [];
        
        if(isset($get_question_type) && !empty($get_question_type) && $get_question_type == 'single')
        {
            if(isset($filtered_answers) && !empty($filtered_answers))
            {
                $get_question_ids_array = array_keys($filtered_answers);
            }
           
            if (DB::table('user_answers')->where('section_id', $get_section_id)->where('user_id', $current_user_id)->exists()) {
                DB::table('user_answers')
                ->where('section_id', $get_section_id)
                ->update(['question_id'=> json_encode($get_question_ids_array) ,'answer' => json_encode($filtered_answers),'guess' => json_encode($filtered_guess),'flag' => json_encode($filtered_flag),'test_id' => $get_practice_id]);
            }
            else
            {
                $userAnswers = new UserAnswers();
                $userAnswers->user_id = $current_user_id;
                $userAnswers->section_id = $get_section_id;
                $userAnswers->question_id = json_encode($get_question_ids_array);
                $userAnswers->answer = json_encode($filtered_answers);
                $userAnswers->guess = json_encode($filtered_guess);
                $userAnswers->flag = json_encode($filtered_flag);
                $userAnswers->test_id = $get_practice_id;
                $userAnswers->save();
            }
        }
        else if(isset($get_question_type) && !empty($get_question_type) && $get_question_type == 'all')
        {
            $store_querstion_answer_details = array();
            if(isset($get_question_title) && !empty($get_question_title))
            {
                foreach($get_question_title as $single_get_questions_title)
                {
                    if(isset($filtered_answers) && !empty($filtered_answers))
                    {
                        foreach($filtered_answers as $user_question_id => $single_filtered_answers)
                        {
                            if($single_get_questions_title->test_question_id == $user_question_id )
                            {
                                $store_querstion_answer_details[$single_get_questions_title->test_section_id]['answers'][$single_get_questions_title->test_question_id] = $single_filtered_answers;
                            }
                        }
                    }
                }
            }
            if(isset($get_question_title) && !empty($get_question_title))
            {
                foreach($get_question_title as $single_get_questions_title)
                {
                    if(isset($filtered_guess) && !empty($filtered_guess))
                    {
                        foreach($filtered_guess as $user_question_id => $single_filtered_guess)
                        {
                            if($single_get_questions_title->test_question_id == $user_question_id )
                            {
                                $store_querstion_answer_details[$single_get_questions_title->test_section_id]['guess'][$single_get_questions_title->test_question_id] = $single_filtered_guess;
                            }
                        }
                    }
                }
            }

            if(isset($get_question_title) && !empty($get_question_title))
            {
                foreach($get_question_title as $single_get_questions_title)
                {
                    if(isset($filtered_flag) && !empty($filtered_flag))
                    {
                        foreach($filtered_flag as $user_question_id => $single_filtered_flag)
                        {
                            if($single_get_questions_title->test_question_id == $user_question_id )
                            {
                                $store_querstion_answer_details[$single_get_questions_title->test_section_id]['flag'][$single_get_questions_title->test_question_id] = $single_filtered_flag;
                            }
                        }
                    }
                }
            }
            if(isset($store_querstion_answer_details) && !empty($store_querstion_answer_details))
            {
                foreach($store_querstion_answer_details as $key => $values)
                {
                    $get_question_ids_array = array_keys($values['answers']);
                    if (DB::table('user_answers')->where('section_id', $key)->where('user_id', $current_user_id)->exists()) {
                        DB::table('user_answers')
                        ->where('section_id', $key)
                        ->update(['question_id'=> json_encode($get_question_ids_array) ,'answer' => json_encode($values['answers']),'guess' => json_encode($values['guess']),'flag' => json_encode($values['flag']),'test_id' => $get_practice_id]);
                    }
                    else
                    {
                        $userAnswers = new UserAnswers();
                        $userAnswers->user_id = $current_user_id;
                        $userAnswers->section_id = $key;
                        $userAnswers->question_id = json_encode($get_question_ids_array);
                        $userAnswers->answer = json_encode($values['answers']);
                        $userAnswers->guess = json_encode($values['guess']);
                        $userAnswers->flag = json_encode($values['flag']);
                        $userAnswers->test_id = $get_practice_id;
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
            if(!$get_users_answers_section_id->isEmpty())
            {
                foreach($get_users_answers_section_id as $key => $single_values)
                {
                    array_push($set_completed_section_id,$single_values->section_id);
                }
            }else{
                $set_completed_section_id = array();
            }                          

        $get_total_question = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*' ,'practice_tests.*' ,'practice_test_sections.*' )
                ->where('practice_tests.id', $request->get_section_id)
                ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                ->count();

       return response()->json(['success'=>'0','section_id' => $get_section_id  , 'get_test_type' => $get_question_type, 'get_test_name' => $get_test_name, 'total_question'=>$get_total_question]);
    }

    public function get_questions(Request $request)
    {
            $practice_test_id = '';
            $current_user_id = Auth::id();
            $question = PracticeQuestion::where('id',$request->question_id)->first();
            if($request->question_type == 'all')
            {
                $practice_test_id = $request->section_id;
                $set_completed_section_id = DB::table('user_answers')
                ->select('user_answers.section_id')
                ->where('user_answers.user_id', $current_user_id)
                ->where('user_answers.test_id', $practice_test_id)
                ->pluck('user_answers.section_id')
                ->toArray();

                $get_offset = $request->get_offset;
                if(is_null($question->passages_id)){
                    $get_total_question = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' ,'practice_questions.tags' ,'practice_tests.*' ,'practice_test_sections.*' )
                    ->where('practice_tests.id', $practice_test_id)
                    ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                    ->count();

                    $testSectionQuestions = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' ,'practice_questions.tags','practice_tests.*' ,'practice_test_sections.*' )
                    ->where('practice_questions.id', $request->question_id)
                    ->where('practice_tests.id', $practice_test_id)
                    ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                    ->orderBy('question_order', 'ASC')
                    ->limit(1)->get();

                } else {
                    $get_total_question = DB::table('practice_questions')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' ,'practice_questions.tags' ,'practice_tests.*' ,'practice_test_sections.*' )
                    ->where('practice_tests.id', $practice_test_id)
                    ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                    ->count();

                    $testSectionQuestions = DB::table('practice_questions')
                    ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                    ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                    ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                    ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.title as passage_title', 'passages.description as passage_description', 'passages.type as passage_type' ,'practice_tests.*' ,'practice_test_sections.*' )
                    ->where('practice_questions.id', $request->question_id)
                    ->where('practice_tests.id', $practice_test_id)
                    ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                    ->orderBy('question_order', 'ASC')
                    ->limit(1)->get();
                }

                if($testSectionQuestions->isEmpty())
                {
                    $testSectionQuestions = 0;
                }

                if($get_offset >= $get_total_question)
                {
                    $set_next_offset = $get_offset;
                    $set_prev_offset = $get_offset - 1;
                }
                else
                {
                    $set_next_offset = $get_offset + 1;
                    $set_prev_offset = $get_offset - 1;
                }
                
            }
            else if($request->question_type == 'single')
            {

                $get_section_details = DB::table('practice_test_sections')
                ->select('practice_test_sections.testid')
                ->where('practice_test_sections.id',$request->section_id)->first();

                $practice_test_id = $get_section_details->testid;
                $get_offset = $request->get_offset;
                if(is_null($question->passages_id)){
                    $get_total_question  = DB::table('practice_questions')
                    ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order', 'practice_questions.tags')
                    ->where('practice_questions.practice_test_sections_id', $request->section_id)->count();
                    
                    $testSectionQuestions = DB::table('practice_questions')
                    ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order', 'practice_questions.tags')
                    // ->where('practice_questions.practice_test_sections_id', $request->section_id)
                    ->where('practice_questions.id', $request->question_id)
                    ->orderBy('question_order', 'ASC')
                    ->limit(1)->get();
                } else {
                    $get_total_question  = DB::table('practice_questions')
                    ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags')
                    ->where('practice_questions.practice_test_sections_id', $request->section_id)->count();
                    
                    $testSectionQuestions = DB::table('practice_questions')
                    ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                    ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.title as passage_title', 'passages.description as passage_description', 'passages.type as passage_type')
                    // ->where('practice_questions.practice_test_sections_id', $request->section_id)
                    ->where('practice_questions.id', $request->question_id)
                    ->orderBy('question_order', 'ASC')
                    ->limit(1)->get();
                }
                if($testSectionQuestions->isEmpty())
                {
                    $testSectionQuestions = 0;
                }

                if($get_offset >= $get_total_question)
                {
                    $set_next_offset = $get_offset;
                    $set_prev_offset = $get_offset - 1;
                }
                else
                {
                    $set_next_offset = $get_offset + 1;
                    $set_prev_offset = $get_offset - 1;
                }

            }
            return response()->json(['success'=>'0','questions' => $testSectionQuestions,'total_question' => $get_total_question , 'get_offset' => $get_offset , 'set_next_offset' => $set_next_offset, 'set_prev_offset' => $set_prev_offset,'practice_test_id' => $practice_test_id]);
    }

    public function singleSection(Request $request, $id)
    {   
        $set_offset = 0;
        $total_questions = PracticeQuestion::where('practice_test_sections_id',$id)->orderBy('question_order','ASC')->pluck('id')->toArray();
        $testSection = DB::table('practice_test_sections')
        ->where('practice_test_sections.id', $id)
        ->get();
        return view('user.practice-test' , ['section_id' => $id,'set_offset' => $set_offset,'question_type' => 'single', 'total_questions' => $total_questions , 'testSection' => $testSection]);
    }

    public function allSection(Request $request, $id)
    {
        $set_offset = 0;
        $practice_test_section = PracticeTestSection::where('testid',$id)->pluck('id')->toArray();
        $total_questions = PracticeQuestion::whereIn('practice_test_sections_id',$practice_test_section)->orderBy('question_order','ASC')->pluck('id')->toArray();
        $testSection = DB::table('practice_test_sections')
        ->where('practice_test_sections.testid', $id)
        ->get();
        return view('user.practice-test' , ['section_id' => $id,'set_offset' => $set_offset, 'question_type' => 'all', 'total_questions' => $total_questions , 'testSection' => $testSection]);
    }

    public function singleTest(Request $request, $id)
    {

       $current_user_id = Auth::id();
       
       $store_sections_details = array();
       $get_total_sections = 0;
       $get_total_questions = 0;
       $check_test_completed = 'no';
       
       $get_all_section_id = DB::table('practice_tests')
       ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
       ->select('practice_test_sections.id')
       ->where('practice_test_sections.testid', $id)
       ->count();

       $get_test_description = DB::table('practice_tests')
       ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
       ->select('practice_tests.description')
       ->where('practice_tests.id', $id)
       ->get();

       $get_users_answers_section_id = DB::table('user_answers')
       ->select('user_answers.section_id')
       ->where('user_answers.user_id', $current_user_id)
       ->where('user_answers.test_id', $id)
       ->count();
    
       if($get_all_section_id === $get_users_answers_section_id){

         $check_test_completed = 'yes';

       } else if($get_users_answers_section_id >= 1) {

        $check_test_completed = 'Yes';

       }

       $checkTestQuestion = DB::table('practice_questions')
       ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
       ->where('practice_test_sections.testid', $id)
       ->count();

       $testSections = DB::table('practice_tests')
        ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
        ->select('practice_test_sections.*', 'practice_tests.title' , 'practice_tests.is_test_completed' , 'practice_tests.format' ,  'practice_tests.description' , 'practice_tests.tags' /*, 'practice_questions.*'*/ )
        ->where('practice_test_sections.testid', $id)
        ->orderBy('section_order', 'ASC')
        ->get();

        $get_total_sections = DB::table('practice_tests')
        ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
        ->select('practice_test_sections.*', 'practice_tests.title' , 'practice_tests.format' ,  'practice_tests.description' , 'practice_tests.tags' /*, 'practice_questions.*'*/ )
        ->where('practice_test_sections.testid', $id)
        ->count();

        $testSection = DB::table('practice_tests')
        ->where('practice_tests.id', $id)
        ->get();

        if($testSection->isEmpty())
        {
            $testSectionName = 0;
        }
        else
        {
            $testSectionName = $testSection[0]->title;
        }
       
        if($testSections->isEmpty())
        {
            $testSections =  0;
        }
        else if(!$testSections->isEmpty())
        {
            $total_all_section_question = 0;

            foreach($testSections as $single_test_sections)
            {
                $testSectionQuestions = DB::table('practice_questions')
                ->select('practice_questions.*')
                ->where('practice_questions.practice_test_sections_id', $single_test_sections->id)
                ->get();

                $check_if_section_completed = 'no';
                
                if (DB::table('user_answers')->where('section_id', $single_test_sections->id)->where('user_id', $current_user_id)->exists()) {
                    $check_if_section_completed = 'yes';
                }
                else
                {
                    $check_if_section_completed = 'no';
                }

                $get_total_questions = DB::table('practice_questions')
                ->select('practice_questions.*')
                ->where('practice_questions.practice_test_sections_id', $single_test_sections->id)
                ->count();

                $total_all_section_question = $total_all_section_question + $get_total_questions;
                
                $store_sections_details[$single_test_sections->id]['check_if_section_completed'][] = $check_if_section_completed;
                $store_sections_details[$single_test_sections->id]['Sections'][] = array("id" => $single_test_sections->id,"format" => $single_test_sections->format,"practice_test_type" => $single_test_sections->practice_test_type,"testid" => $single_test_sections->testid,"section_order" => $single_test_sections->section_order,"title" => $single_test_sections->title,"description" => $single_test_sections->description);
                
                if(!$testSections->isEmpty() &&  !$testSectionQuestions->isEmpty())
                {
                    foreach($testSectionQuestions as $singletestSectionQuestions)
                    {
                        $store_sections_details[$single_test_sections->id]['Sections_question'][] = array("id" => $singletestSectionQuestions->id , "title" => $singletestSectionQuestions->title , "format" => $singletestSectionQuestions->format , "practice_test_sections_id" => $singletestSectionQuestions->practice_test_sections_id , "type" => $singletestSectionQuestions->type , "passages_id" => $singletestSectionQuestions->passages_id , "passages" => $singletestSectionQuestions->passages , "passage_number" => $singletestSectionQuestions->passage_number , "answer" => $singletestSectionQuestions->answer , "answer_content" => $singletestSectionQuestions->answer_content , "fill" => $singletestSectionQuestions->fill , "fillType" => $singletestSectionQuestions->fillType , "multiChoice" => $singletestSectionQuestions->multiChoice , "question_order" => $singletestSectionQuestions->question_order , "tags" => $singletestSectionQuestions->tags) ;
                    }
                }
            }
        }

        return view('user.practice-test-sections' , ['selected_test_id' => $id , 'testSections' => $testSections,'testSectionName' => $testSectionName , 'testSection' => $testSection, 'testSectionsDetails' => $store_sections_details , 'get_total_sections' => $get_total_sections ,'get_total_questions' => $get_total_questions,'check_test_completed' => $check_test_completed , 'checkTestQuestion' => $checkTestQuestion, 'get_test_description' => $get_test_description , 'total_all_section_question' => isset($total_all_section_question) ? $total_all_section_question : '0']);
    }

    public function set_scrollPosition(Request $request){
        $current_user_id = Auth::id();
        $get_question_id = $request->get_question_id;
        $scroll_position =number_format($request->scroll_position,2,'.');

        if(DB::table('user_scroll_positions')->where('user_id',$current_user_id)->where('question_id',$get_question_id)->exists()){
            DB::table('user_scroll_positions')->where('user_id',$current_user_id)->where('question_id',$get_question_id)->update(['scroll_position'=>$scroll_position]);
        }else{
        $UserScrollPosition = new UserScrollPosition;
        $UserScrollPosition->user_id = $current_user_id;
        $UserScrollPosition->question_id = $get_question_id;
        $UserScrollPosition->scroll_position = $scroll_position;
        $UserScrollPosition->save();
        }
    }

    public function get_scrollPosition(Request $request){
        $current_user_id = Auth::id();
        $get_question_id = $request->get_question_id;

        $scroll_position = DB::table('user_scroll_positions')->where('user_id',$current_user_id)->where('question_id',$get_question_id)->get();
        return response()->json(['success'=>'0','scroll_position' => $scroll_position]);
        
    }

    public function resetTest(Request $request, $id){
        UserAnswers::where('user_id', Auth::id())->where('test_id', $request->test_id)->delete();
        return redirect(url('user/practice-test-sections/'.$request['test_id']));
    }

    public function resetSection(Request $request, $testId, $id){
        UserAnswers::where('section_id',$id)->where('user_id',Auth::id())->delete();
        return redirect(url('user/practice-test-sections/'.$testId));

    }

}
