<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PracticeTest;
use App\Models\PracticeTestSection;
use App\Models\PracticeQuestion;
use App\Models\Passage;

class TestPrepController extends Controller
{

    public function dashboard()
    {
        $getAllPracticeTests = PracticeTest::get();
        return view('student.test-prep-dashboard.dashboard' , compact('getAllPracticeTests'));
    }


    public function get_questions(Request $request)
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

            return response()->json(['success'=>'0','questions' => $testSectionQuestions,'total_question' => $get_total_question , 'get_offset' => $get_offset , 'set_next_offset' => $set_next_offset, 'set_prev_offset' => $set_prev_offset]);
    }



    public function singleSection(Request $request, $id)
    {
         $set_offset = 0;
        return view('user.practice-test' , ['id' => $id,'set_offset' => $set_offset]);
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
