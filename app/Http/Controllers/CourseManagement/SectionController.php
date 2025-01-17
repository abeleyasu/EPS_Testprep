<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CRUD;
use App\Http\Requests\CourseManagement\SectionRequest;
use App\Models\CourseManagement\Milestone;
use App\Models\CourseManagement\Module;
use App\Models\CourseManagement\Section;
use App\Models\ModelTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Courses;

class SectionController extends Controller
{
    use CRUD;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::orderBy('order')->get();
        return view('admin.courses.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::orderBy('order')->get();
		$sections = Section::count();
        $tags = Tag::all();
        return view('admin.courses.sections.create', compact('modules', 'tags','sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        $order = $request->order;
        if(!$order || $order == 0) {
            $request->request->add(['order' => Section::where('module_id','=', $request->module_id)->count() + 1]);
        } else {
            $this->reorderOnCreate($request);
        }

        if ($request->product) {
            $request->request->add(['product_id' => $request->product]);
            unset($request['product']);
        }

        $section = $this->createFromRequest(app('App\Models\CourseManagement\Section'),$request);

        $section->user_sections_roles()->attach($request->user_type);

        if ($request->status == 'paid') {
            $section->user_section_products()->attach($request->products);
        }

		/**********Order reset**********/
		/*$sections = Section::orderBy('order')->get();
		$currentId = $section->id;
		$currentOrder = $section->order;
		$orderInd=1;
		
		foreach($sections as $sectio){
			$sectio->update([
				'order' => $orderInd
			]);
			$orderInd++;
		}*/
		
        if($request->tags) {
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $section->id,
                    'model_type' => get_class($section),
                    'tag_id' => $tag
                ]);
            }
        }
		return redirect()->route('sections.edit',['section'=>$section->id])->with('success', 'Section created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseManagement\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $section = Section::findOrFail($id);
        $is_course_permission = Courses::userHasCoursePermissionOrNot($section->module->milestone->course_id);
        if (!$is_course_permission) {
            return redirect()->route('courses.index')->with('error', 'You are not authorized to access this course');
        }
		if(!$section->userHasSectionsPermissionOrNot() || $section->status == 'paid' && !$user->isUserSubscibedToTheProduct($section->user_section_products()->pluck('product_id')->toArray())){
			return redirect(route('modules.detail',['module'=>$section->module_id]))->with('error', 'You are not authorized to access this section');
		}
		$milestone = array();
		$getSections = Section::where('module_id',$section->module_id)->orderBy('order')->get();
		
		$module = Module::where('id', $section->module_id)->orderBy('order')->first();
		
		if($module){
			$milestone = Milestone::where('id', $module->milestone_id)->orderBy('order')->first();
            if($milestone){
            
                $courseId = $milestone->course_id;
                $course = Courses::where('id','=',$courseId)->get();
                //print_r($course);
            }			
		}
        return view('student.courses.sectionDetail',compact('section', 'getSections','module','milestone','course'));
    }

    public function showDetail($id)
    {
        $section = Section::findOrFail($id);
		$milestone = array();
		$getSections = Section::where('module_id',$section->module_id)->orderBy('order')->get();
		
		$module = Module::where('id', $section->module_id)->orderBy('order')->first();
		
		if($module){
			$milestone = Milestone::where('id', $module->milestone_id)->orderBy('order')->first();
            if($milestone){
            
                $courseId = $milestone->course_id;
                $course = Courses::where('id','=',$courseId)->get();
                //print_r($course);
            }			
		}
		
        return view('student.courses.sectionDetail',compact('section', 'getSections','module','milestone','course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseManagement\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {

        $modules = Module::orderBy('order')->get();
        $tags = Tag::all();
        $section_tags = ModelTag::where([
            ['model_id', $section->id],
            ['model_type', get_class($section)]
        ])->pluck('tag_id')->toArray();
        $section_user_types = $section->user_sections_roles()->pluck('user_role_id')->toArray();
        return view('admin.courses.sections.edit', compact('section','tags', 'section_tags', 'modules', 'section_user_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseManagement\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, Section $section)
    {
        if ($request->status == 'unpaid') {
            $request->request->add(['product_id' => null]);
        } else {
            if ($request->product) {
                $request->request->add(['product_id' => $request->product]);
                unset($request['product']);
            }
        }
        $request->request->add(['published' => $request->published ? true : false]);
//        $this->reorderOnUpdate($section, $request);
        $model = $this->updateFromRequest($section, $request);

        $section_user_types = $section->user_sections_roles()->pluck('user_role_id')->toArray();
        if (count($section_user_types) > 0) {
            $section->user_sections_roles()->detach($section_user_types);
        }
        $model->user_sections_roles()->attach($request->user_type);

        $section_products = $section->user_section_products()->pluck('product_id')->toArray();
        if (count($section_products) > 0) {
            $section->user_section_products()->detach($section_products);
        }
        if ($request->status == 'paid') {
            $section->user_section_products()->attach($request->products);
        }
		/**********Order reset**********/
		/*$sections = Section::orderBy('order')->get();
		$currentId = $section->id;
		$currentOrder = $section->order;
		$orderInd=1;
		
		foreach($sections as $sectio){
			$sectio->update([
				'order' => $orderInd
			]);
			$orderInd++;
		}*/
        if($request->tags) {
            ModelTag::where([
                ['model_id', $model->id],
                ['model_type', get_class($model)]
            ])->delete();
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $model->id,
                    'model_type' => get_class($model),
                    'tag_id' => $tag
                ]);
            }
        } else {
            ModelTag::where([
                ['model_id', $model->id],
                ['model_type', get_class($model)]
            ])->delete();
        }
		return redirect('admin/course-management/sections/'.$model->id.'/edit')->with('success', 'Section updated successfully');
        /*return redirect()->route('sections.index')->with('success', 'Section updated successfully');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseManagement\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully');

    }

    public function sectionsByModule($id) {
        return response()->json([
            'data' => Section::where('module_id', $id)->orderBy('order')->get()
        ],200);
    }

    private function reorderOnUpdate($old_order, $new_order, $dont_reorder) {
        if($new_order > $old_order) {
            //selected item move down
            $reorder_sections = Section::where([
                ['order','>=', $old_order],
                ['order','<=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order-1]);
            }
        }elseif($old_order > $new_order) {
            $reorder_sections = Section::where([
                ['order','<=', $old_order],
                ['order','>=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order+1]);
            }
        }
    }
    private function reorderOnCreate($request) {
        $reorder_sections = Section::where([
            ['order','>=', $request->order],
            ['module_id','>=', $request->module_id],
        ])->orderBy('order')->get();
        foreach ($reorder_sections as $section) {
            $section->update(['order'=> $section->order+1]);
        }
    }

    public function reorder($id, Request $request) {

        $new_order = $request->new_index;
        $old_order = $request->old_index;
        $model = Section::findOrFail($id);
        $model->order = $new_order;
        $model->save();
        
		$currOrder =0;
		if($request->currSectionId>0){
			$currentSection = Section::findOrFail($request->currSectionId);
			$currOrder = $currentSection->order;
		}
		$this->reorderOnUpdate($old_order, $new_order, $id);
        return response()->json([
            'message' => 'reordered successfully','currOrder'=>$currOrder
        ],200);
    }

    public function sectionJson($id) {
        $sections = Section::where('module_id', $id)->where('published',1)->orderBy('order')->get();
        $user = \request('user_id');
        $sectionData = [];
        foreach ($sections as $section) {
            $_section = $section->toArray();
            $all_tasks = $section->taskStatus();
            $completion_percent = 0;
            if ($all_tasks->count() > 0) {
                $tasks = $all_tasks->unique('id');
                $user_tasks = $all_tasks->filter(function ($item) use ($user) {
                    return $item->user_id == $user && $item->complete == 1;
                });
                $user_tasks = $user_tasks->count() > 0 ?
                    array_map(function ($item) {
                        return $item['id'];
                    }, $user_tasks->toArray())
                    :
                    [];
                $completion_percent = floor(count($user_tasks) / $tasks->count() * 100);
                $_section['tasks'] = $tasks;
                $_section['user_tasks'] = $user_tasks;
            }
            $_section['all_tasks'] = $all_tasks;
            $_section['completion_rate'] = $completion_percent;

            array_push($sectionData, $_section);
        }

        return response()->json([
            'data' => $sectionData
        ],200);
    }
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseManagement\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
		$milestone = array();
		$course=[];
		$section = Section::findOrFail($id);
		$getSections = Section::where('module_id',$section->module_id)->orderBy('order')->get();
		
		$module = Module::where('id', $section->module_id)->orderBy('order')->first();
		
		if($module){
			$milestone = Milestone::where('id', $module->milestone_id)->orderBy('order')->first();			
		}
        if($milestone){
            
			$courseid = $milestone->course_id;
			$course = Courses::where('id','=',$courseid)->get();
			//print_r($course);
		}
        $tags = Tag::all();
        $section_tags = ModelTag::where([
            ['model_id', $section->id],
            ['model_type', get_class($section)]
        ])->pluck('tag_id')->toArray();
		
        return view('admin.courses.sections.preview', compact('section', 'getSections', 'module','tags', 'section_tags', 'milestone','course'));
    }
}
