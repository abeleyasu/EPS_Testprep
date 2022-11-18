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

                $get_total_questions = DB::table('practice_questions')
                ->select('practice_questions.*')
                ->where('practice_questions.practice_test_sections_id', $single_test_sections->id)
                ->count();
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
        return view('user.practice-test-sections' , ['testSections' => $testSections,'testSectionName' => $testSectionName , 'testSectionsDetails' => $store_sections_details , 'get_total_sections' => $get_total_sections ,'get_total_questions' => $get_total_questions]);
    }

}
