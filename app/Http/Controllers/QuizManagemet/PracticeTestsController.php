<?php

namespace App\Http\Controllers\QuizManagemet;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\CRUD;
use App\Models\PracticeTest;
use App\Models\PracticeQuestion;
use App\Models\PracticeTestSection;
use App\Models\QuestionType;
use App\Models\Passage;
use App\Models\PracticeCategoryType;
use App\Models\Score;
use App\Models\SuperCategory;
use App\Models\UserAnswers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class PracticeTestsController extends Controller
{
    use CRUD;
	public $testformat = [
        'SAT'=>'SAT PRACTICE TEST',
        'ACT'=>'ACT PRACTICE TEST', 
        'PSAT' => 'PSAT PRACTICE TEST',
        'DSAT' => 'Digital SAT',
        'DPSAT' => 'Digital PSAT'
    ];
	public $questionformat = [
        'ACT'=> 'ACT Question', 
        'SAT'=>'SAT Question', 
        'PSAT'=>'PSAT Question',
        'DSAT' => 'Digital SAT Question',
        'DPSAT' => 'Digital PSAT Question'
    ];
    public $testSource = ['0' => 'College Prep System Practice Test', '1' => 'Official Released Practice Test', '2' => 'Quiz Questions'];
	public function __construct(){
		View::share('testformats', $this->testformat);
		View::share('questionformats', $this->questionformat);
        View::share('passages', Passage::get());
        View::share('testsources', $this->testSource);
    }
	
	public function index()
    {
        $tests = PracticeTest::orderBy('id', 'DESC')->get();
        $getQuestionTypes = PracticeTest::get();
        return view('admin.quiz-management.practicetests.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
		$tests = PracticeTest::get();
        $getQuestionTypes = QuestionType::get();
        $getCategoryTypes = PracticeCategoryType::get();
        return view('admin.quiz-management.practicetests.create' ,  ['tests' => $tests , 'getCategoryTypes' => $getCategoryTypes ,'getQuestionTypes' => $getQuestionTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        
        if(!empty($request->get_question_id))
        {
            $practices = PracticeTest::where('id', $request->get_question_id)->get();
            
            foreach($practices as $practice) {
                $practice->description = $request->description;
                $practice->save();
            }
            
        }
		// $practice = new PracticeTest();
		// $practice->title = $request->title;
		// $practice->format = $request->format;
		// $practice->description = $request->description;
        // $practice->is_test_completed = '';
        
        // $practice->save();
		
		// $sections = PracticeTestSection::where('testid', 0)->get();
		// foreach($sections as $section) {
		// 	$section->testid = $practice->id;
		// 	$section->save();
		// }
		
        return redirect()->route('practicetests.index')->with('message','Test created successfully');
    }

    public function addPracticeTest(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'title' => 'required',
                'format' => 'required',
                'source' => 'required',
                'status' => 'required',
                'products' => 'required_if:status,paid|array|min:1',
            ];
    
            $customMessages = [
                'title.required' => 'Title is required',
                'format.required' => 'Test type is required',
                'source.required' => 'Test source is required',
                'status.required' => 'Test status is required',
                'products.required_if' => 'Product is required',
                'products.min' => 'Product is required',
                'products.array' => 'Product is required',
            ];
    
            $validate = Validator::make($request->all(), $rules, $customMessages);
            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first(),
                ]);
            }
            if(empty($request->get_test_id)) {
                $practice = new PracticeTest();
                $practice->title = $request->title;
                $practice->format = $request->format;
                $practice->test_source = $request->source;
                $practice->is_test_completed = '';
                $practice->status = $request->status;
                $practice->save();
    
                if ($request->status == 'paid') {
                    $practice->practice_tests_products()->attach($request->products);
                }
    
            } else if(!empty($request->get_test_id)) {
                $practice = PracticeTest::where('id', $request->get_test_id)->first();
                
                if (!$practice) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Test not found',
                    ]);
                }
                $practice->title = $request->title;
                $practice->format = $request->format;
                $practice->test_source = $request->source;
                $practice->status = $request->status;
                $practice->save();

                $get_all_attach_products = $practice->practice_tests_products()->pluck('product_id')->toArray();
                if (count($get_all_attach_products) > 0) {
                    $practice->practice_tests_products()->detach($get_all_attach_products);
                }
                if ($request->status == 'paid') {
                    $practice->practice_tests_products()->attach($request->products);
                }

            }
            DB::commit();
            return response()->json([
                'success' => true,
                'test_id' => $practice->id,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $practicetests = PracticeTest::find($id);
		$tests = PracticeTest::get();
        $p_test_section = PracticeTestSection::find($id);
        if(!empty($p_test_section)) {
            $testQuestions = $p_test_section->getPracticeQuestions;
        } else {
            $testQuestions = null;
        }
        $testsections = PracticeTestSection::where('testid', $id)->orderBy('section_order')->get();

        $getQuestionTypes = QuestionType::get();
        $getCategoryTypes = PracticeCategoryType::get();

        return view('admin.quiz-management.practicetests.edit', compact('practicetests', 'tests', 'testQuestions', 'testsections','getQuestionTypes', 'getCategoryTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PracticeTest $practicetests)
    {
        $tags = '';
        if(is_array($request->tags)){
            $tags = implode(",", $request->tags);
        }
		$practice = PracticeTest::find($request->id);
		$practice->title = $request->title;
		/*$practice->format = $request->format;*/
		$practice->description = $request->description;
        $practice->tags = $tags;
        // $practice->category_type = $request->category_type;
		$practice->save();
        return redirect()->route('practicetests.index')->with('message','Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PracticeTest $practicetests, $id)
    {
        UserAnswers::where('test_id',$id)->delete();
		Score::where('test_id',$id)->delete();
        PracticeTestSection::where('testid',$id)->delete();
		$practicetests = PracticeTest::find($id);
        $practicetests->practice_tests_products()->detach();
        $practicetests->delete();
        return redirect()->route('practicetests.index')->with('message','Question deleted successfully');
    }

    public function addDropdownOption(Request $request){
        $super_option = SuperCategory::where('format',$request['format'])->get();
        $category = PracticeCategoryType::where('format',$request['format'])->get();
        $questionType = QuestionType::where('format',$request['format'])->get();
        
        return response()->json(['super' => $super_option,'category' => $category, 'questionType' => $questionType]);
    }
}
