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
use App\Models\User;
use App\Models\UserScrollPosition;

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
                $event_arr['start'] = $event->start_date;
                $event_arr['color'] = $this->findColor($event->event->color);
                $event_arr['end'] = isset($event->end_date) ? date('Y-m-d H:i:s', strtotime('+1 day', strtotime($event->end_date))) : null;
                $event_arr['allDay'] = date('H:i:s', strtotime($event->start_date)) == "00:00:00" ? true : false;
                array_push($final_arr, $event_arr);
            }
        }

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
            ->select('category_type')
            ->distinct()
            ->where('practice_test_sections.testid',$test_id)
            ->get();
            
            if($_GET['type'] == 'all')
            {
                $get_question_category = DB::table('question_types')
                ->join('practice_questions','practice_questions.question_type_id','=','question_types.id')
                ->join('practice_test_sections','practice_test_sections.id','=','practice_questions.practice_test_sections_id')
                ->join('practice_tests','practice_tests.id','=','practice_test_sections.testid')
                ->select('practice_questions.id as test_question_id','practice_questions.question_type_id','question_types.*')
                ->where('practice_tests.id',$test_id)
                ->get();

                if($get_question_category->count()>0)
                {
                    foreach($get_question_category as $get_single_question_cat)
                    {
                        $set_get_question_category[$get_single_question_cat->question_type_id]['question_id'][] =  $get_single_question_cat->test_question_id;
                        $set_get_question_category[$get_single_question_cat->question_type_id]['type_details'] = array("question_type_title" => $get_single_question_cat->question_type_title,"question_type_description" => $get_single_question_cat->question_type_description,"question_type_lesson" => $get_single_question_cat->question_type_lesson,"question_type_strategies" => $get_single_question_cat->question_type_strategies,"question_type_identification_methods" => $get_single_question_cat->question_type_identification_methods,"question_type_identification_activity" => $get_single_question_cat->question_type_identification_activity );
                    }
                }
            }
            else if($_GET['type'] == 'single'){
                
                if(!$test_category_type->isEmpty())
                {
                    foreach($test_category_type as $single_cat_type)
                    {

                        $get_question_category = DB::table('practice_questions')
                        ->join('question_types','practice_questions.question_type_id','=','question_types.id')
                        ->join('practice_test_sections','practice_test_sections.id','=','practice_questions.practice_test_sections_id')
                        ->join('practice_tests','practice_tests.id','=','practice_test_sections.testid')
                        ->select('practice_questions.id as test_question_id','practice_questions.question_type_id','question_types.*','practice_questions.category_type')
                        ->where('practice_test_sections.id',$id)
                        ->where('practice_questions.category_type',$single_cat_type->category_type)
                        ->get();
                        if(!$get_question_category->isEmpty())
                        {
                            foreach($get_question_category as $single_question_category)
                            {
                                $set_get_question_category[$single_cat_type->category_type][$single_question_category->question_type_title][] = $single_question_category;
                            }
                        }
                    }
                }
                // echo "<pre>";
                // print_r($set_get_question_category);
                // echo "</pre>";
                // die();
                
                // $get_question_category = DB::table('question_types')
                //     ->join('practice_questions','practice_questions.question_type_id','=','question_types.id')
                //     ->join('practice_test_sections','practice_test_sections.id','=','practice_questions.practice_test_sections_id')
                //     ->select('practice_questions.id as test_question_id','practice_questions.question_type_id','question_types.*')
                //     ->where('practice_test_sections.id',$id)
                //     ->get();
                    
                // if($get_question_category->count()>0)
                // {
                //     foreach($get_question_category as $get_single_question_cat)
                //     {
                //         $set_get_question_category[$get_single_question_cat->question_type_id]['question_id'][] =  $get_single_question_cat->test_question_id;
                //         $set_get_question_category[$get_single_question_cat->question_type_id]['type_details'] = array("question_type_title" => $get_single_question_cat->question_type_title,"question_type_description" => $get_single_question_cat->question_type_description,"question_type_lesson" => $get_single_question_cat->question_type_lesson,"question_type_strategies" => $get_single_question_cat->question_type_strategies,"question_type_identification_methods" => $get_single_question_cat->question_type_identification_methods,"question_type_identification_activity" => $get_single_question_cat->question_type_identification_activity );
                //     }
                // }
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
                        if(isset($user_selected_answers) && !empty($user_selected_answers))
                        {
                            $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
                            $json_decoded_guess = json_decode($user_selected_answers[0]->guess);
                            $json_decoded_flag = json_decode($user_selected_answers[0]->flag);
                            
                            foreach($json_decoded_answers as $question_id => $json_decoded_single_answers)
                            {
                                $get_question_details = DB::table('practice_questions')
                                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                                ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*')
                                ->where('practice_questions.id', $question_id)
                                ->get();
                                $store_sections_details[] = array('user_selected_answer' => $json_decoded_single_answers,'user_selected_guess' => $json_decoded_guess->$question_id,'user_selected_flag' => $json_decoded_flag->$question_id,'get_question_details' => $get_question_details); 
                            }
                        }
                    }
                }
            }
            else if($_GET['type'] == 'single')
            {
                $user_selected_answers = DB::table('user_answers')->where('user_id', $current_user_id)->where('section_id', $id)->get();
                $store_user_answers_details = array();
                if(isset($user_selected_answers) && !empty($user_selected_answers))
                {
                    $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
                    $json_decoded_guess = json_decode($user_selected_answers[0]->guess);
                    $json_decoded_flag = json_decode($user_selected_answers[0]->flag);
                    foreach($json_decoded_answers as $question_id => $json_decoded_single_answers)
                    {
                        $get_question_details = DB::table('practice_questions')
                        ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                        ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*')
                        ->where('practice_questions.id', $question_id)
                        ->get();
                        $store_sections_details[] = array('user_selected_answer' => $json_decoded_single_answers,'user_selected_guess' => $json_decoded_guess->$question_id,'user_selected_flag' => $json_decoded_flag->$question_id,'get_question_details' => $get_question_details); 
                    }
                }
            }
        }
        return view('user.test-review.question_concepts_review' ,  ['section_id' => $id , 'user_selected_answers' => $store_sections_details ,'get_test_name' => $get_test_name , 'set_get_question_category' => $set_get_question_category,'test_category_type'=>$test_category_type]);
    }

    public function set_answers(Request $request)
    {
        $current_user_id = Auth::id();
        $get_section_id = $request->get_section_id;
        $get_question_type = $request->get_question_type;
        $get_practice_id = $request->get_practice_id;
        

        if($get_question_type == 'single')
        {
            $get_question_title = DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_tests.id', '=', 'practice_test_sections.testid')
            ->join('practice_questions', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->select('practice_tests.*')
            ->where('practice_questions.practice_test_sections_id', $get_section_id)->get(); 
        }
        else if($get_question_type == 'all')
        {
            $get_question_title = DB::table('practice_tests')
            ->join('practice_test_sections', 'practice_tests.id', '=', 'practice_test_sections.testid')
            ->join('practice_questions', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
            ->select('practice_tests.*','practice_test_sections.id as test_section_id','practice_questions.id as test_question_id')
            ->where('practice_tests.id', $get_section_id)->get(); 
        }
        

        $get_test_name = $get_question_title[0]->title;
        
        $filtered_answers = array_filter($request->selected_answer);
        $filtered_guess = array_filter($request->selected_gusess_details);
        $filtered_flag = array_filter($request->selected_flag_details);
        

        if($get_question_type == 'single')
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
        else if($get_question_type == 'all')
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
            if($request->question_type == 'all')
            {
                $practice_test_id = $request->section_id;

                $set_completed_section_id = array();
                $get_users_answers_section_id = DB::table('user_answers')
                ->select('user_answers.section_id')
                ->where('user_answers.user_id', $current_user_id)
                ->where('user_answers.test_id', $practice_test_id)
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
                ->where('practice_tests.id', $request->section_id)
                ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                ->count();

                $get_offset = $request->get_offset;

                $testSectionQuestions = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.title as passage_title', 'passages.description as passage_description', 'passages.type as passage_type' ,'practice_tests.*' ,'practice_test_sections.*' )
                ->where('practice_tests.id', $request->section_id)
                ->whereNotIn('practice_test_sections.id', $set_completed_section_id)
                ->offset($get_offset)->limit(1)->get(); 

                
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
                ->where('practice_test_sections.id',$request->section_id)->get();
                $practice_test_id = $get_section_details[0]->testid;

                $get_total_question  = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*')
                ->where('practice_questions.practice_test_sections_id', $request->section_id)->count();

            
                $get_offset = $request->get_offset;
                

                $testSectionQuestions = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.title as passage_title', 'passages.description as passage_description', 'passages.type as passage_type')
                ->where('practice_questions.practice_test_sections_id', $request->section_id)
                ->offset($get_offset)->limit(1)->get(); 

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
        return view('user.practice-test' , ['section_id' => $id,'set_offset' => $set_offset,'question_type' => 'single']);
    }

    public function allSection(Request $request, $id)
    {
        $set_offset = 0;
        return view('user.practice-test' , ['section_id' => $id,'set_offset' => $set_offset, 'question_type' => 'all']);
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

       $get_users_answers_section_id = DB::table('user_answers')
       ->select('user_answers.section_id')
       ->where('user_answers.user_id', $current_user_id)
       ->where('user_answers.test_id', $id)
       ->count();
    
       if($get_all_section_id === $get_users_answers_section_id)
       {
         $check_test_completed = 'yes';
       }

       
       $testSections = DB::table('practice_tests')
        ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
        ->select('practice_test_sections.*', 'practice_tests.title' , 'practice_tests.is_test_completed' , 'practice_tests.format' ,  'practice_tests.description' , 'practice_tests.tags' /*, 'practice_questions.*'*/ )
        ->where('practice_test_sections.testid', $id)
        ->get();

        $get_total_sections = DB::table('practice_tests')
        ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
        ->select('practice_test_sections.*', 'practice_tests.title' , 'practice_tests.format' ,  'practice_tests.description' , 'practice_tests.tags' /*, 'practice_questions.*'*/ )
        ->where('practice_test_sections.testid', $id)
        ->count();

        $testSectionName = DB::table('practice_tests')
        ->select('practice_tests.title')
        ->where('practice_tests.id', $id)
        ->get();

        if($testSectionName->isEmpty())
        {
            $testSectionName = 0;
        }
        else
        {
            $testSectionName = $testSectionName[0]->title;
        }
       
        if($testSections->isEmpty())
        {
            $testSections =  0;
        }
        else if(!$testSections->isEmpty())
        {
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
        return view('user.practice-test-sections' , ['selected_test_id' => $id , 'testSections' => $testSections,'testSectionName' => $testSectionName , 'testSectionsDetails' => $store_sections_details , 'get_total_sections' => $get_total_sections ,'get_total_questions' => $get_total_questions,'check_test_completed' => $check_test_completed]);
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

}
