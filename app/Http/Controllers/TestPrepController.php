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
        //$user_selected_answers =  UserAnswers::get();
        $user_selected_answers = DB::table('user_answers')->where('user_id', $current_user_id)->where('section_id', $id)->get();
        $store_user_answers_details = array();
        if(isset($user_selected_answers) && !empty($user_selected_answers))
        {
            $json_decoded_answers = json_decode($user_selected_answers[0]->answer);
            foreach($json_decoded_answers as $question_id => $json_decoded_single_answers)
            {
                $get_question_details = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*')
                ->where('practice_questions.id', $question_id)
                ->get();
                $store_sections_details[] = array('user_selected_answer' => $json_decoded_single_answers,'get_question_details' => $get_question_details); 
               
            }
        }
        return view('user.student-view-dashboard' ,  ['section_id' => $id , 'user_selected_answers' => $store_sections_details ,'get_test_name' => $get_test_name]);
    }

    public function set_answers(Request $request)
    {
        $current_user_id = Auth::id();
        $get_section_id = $request->get_section_id;

        $get_question_title = DB::table('practice_tests')
        ->join('practice_test_sections', 'practice_tests.id', '=', 'practice_test_sections.testid')
        ->join('practice_questions', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
        ->select('practice_tests.*')
        ->where('practice_questions.practice_test_sections_id', $get_section_id)->get(); 

        $get_test_name = $get_question_title[0]->title;
        // echo "<pre>";
        // print_r($get_question_title);
        // echo "</pre>";
        // die();
       
        $filtered_answers = array_filter($request->selected_answer);
       
        if(isset($filtered_answers) && !empty($filtered_answers))
        {
            $get_question_ids_array = array_keys($filtered_answers);
        }
       
        if (DB::table('user_answers')->where('section_id', $get_section_id)->exists()) {
            
            DB::table('user_answers')
            ->where('section_id', $get_section_id)
            ->update(['question_id'=> json_encode($get_question_ids_array) ,'answer' => json_encode($filtered_answers)]);
        }
        else
        {
            $userAnswers = new UserAnswers();
            $userAnswers->user_id = $current_user_id;
            $userAnswers->section_id = $get_section_id;
            $userAnswers->question_id = json_encode($get_question_ids_array);
            $userAnswers->answer = json_encode($filtered_answers);
            $userAnswers->save();
        }

        return response()->json(['success'=>'0','section_id' => $get_section_id  , 'get_test_name' => $get_test_name]);
    }

    public function get_questions(Request $request)
    {
        
            if($request->question_type == 'all')
            {
               
                $get_total_question = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*' ,'practice_tests.*' ,'practice_test_sections.*' )
                ->where('practice_tests.id', $request->section_id)->count();
                
                $get_offset = $request->get_offset;

                $testSectionQuestions = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->join('practice_test_sections', 'practice_test_sections.id', '=', 'practice_questions.practice_test_sections_id')
                ->join('practice_tests', 'practice_tests.id', '=', 'practice_test_sections.testid')
                ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*' ,'practice_tests.*' ,'practice_test_sections.*' )
                ->where('practice_tests.id', $request->section_id)
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
                $get_total_question  = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->select('practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*')
                ->where('practice_questions.practice_test_sections_id', $request->section_id)->count();

            
                $get_offset = $request->get_offset;
                

                $testSectionQuestions = DB::table('practice_questions')
                ->join('passages', 'practice_questions.passages_id', '=', 'passages.id')
                ->select('practice_questions.id as question_id','practice_questions.title as question_title','practice_questions.type as practice_type' ,'practice_questions.answer as question_answer' ,'practice_questions.answer_content as question_answer_options' ,'practice_questions.multiChoice as is_multiple_choice' ,'practice_questions.question_order' , 'practice_questions.passages_id' ,'practice_questions.tags','passages.*')
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

            
            return response()->json(['success'=>'0','questions' => $testSectionQuestions,'total_question' => $get_total_question , 'get_offset' => $get_offset , 'set_next_offset' => $set_next_offset, 'set_prev_offset' => $set_prev_offset]);
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
       $store_sections_details = array();
       $get_total_sections = 0;
       $get_total_questions = 0;
       $testSections = DB::table('practice_tests')
        ->join('practice_test_sections', 'practice_test_sections.testid', '=', 'practice_tests.id')
        ->select('practice_test_sections.*', 'practice_tests.title' , 'practice_tests.format' ,  'practice_tests.description' , 'practice_tests.tags' /*, 'practice_questions.*'*/ )
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

                if (DB::table('user_answers')->where('section_id', $single_test_sections->id)->exists()) {
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
        // echo "<pre>";
        // print_r($store_sections_details);
        // echo "</pre>";
        // die();
        return view('user.practice-test-sections' , ['selected_test_id' => $id , 'testSections' => $testSections,'testSectionName' => $testSectionName , 'testSectionsDetails' => $store_sections_details , 'get_total_sections' => $get_total_sections ,'get_total_questions' => $get_total_questions]);
    }

}
