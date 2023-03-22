<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CRUD;
use App\Http\Requests\CourseManagement\ModuleRequest;
use App\Models\CourseManagement\Milestone;
use App\Models\CourseManagement\Module;
use App\Models\CourseManagement\Section;
use App\Models\ModelTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Courses;

class ModuleController extends Controller
{
    use CRUD;

    public function index()
    {
        $modules = Module::orderBy('order')->get();
        return view('admin.courses.modules.index', compact('modules'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $milestones = Milestone::orderBy('order')->get();
        $tags = Tag::all();
		$totalModule = Module::count();
        return view('admin.courses.modules.create', compact('tags', 'milestones', 'totalModule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->request->add(['added_by' => auth()->id()]);

        /*$order = $request->order;
        if(!$order || $order == 0) {
            $request->request->add(['order' => Module::where('milestone_id',$request->milestone_id)->count() + 1]);
        } else {
            $this->reorderOnCreate($request);
        }*/
       
        $module = $this->createFromRequest(app('App\Models\CourseManagement\Module'),$request);
        /**********Order reset**********/
		/*$modules = Module::orderBy('order')->get();
		$currentId = $module->id;
		$currentOrder = $request->order;
		$orderInd=1;
		
		foreach($modules as $modul){
			$modul->update([
				'order' => $orderInd
			]);
			$orderInd++;
		}*/
        if($request->tags) {
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $module->id,
                    'model_type' => get_class($module),
                    'tag_id' => $tag
                ]);
            }
        }
        return redirect()->route('modules.edit',['module'=>$module->id])->with('success', 'Module created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param Module $module
     * @return void
     */
    public function show(Module $module)
    {
		if($module->status == 'paid'){
			return redirect(route('home'));
		}
		$getModules = Module::where('milestone_id', $module->milestone_id)->orderBy('id')->get();
		$milestone = Milestone::where('id', $module->milestone_id)->orderBy('order')->first();
        if($milestone){
            
            $courseId = $milestone->course_id;
            $course = Courses::where('id','=',$courseId)->get();
            //print_r($course);
        }
		
        return view('student.courses.moduleDetailNew',compact('module', 'getModules','milestone','course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Module $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {

        $milestones = Milestone::orderBy('order')->get();
        $tags = Tag::all();
        $module_tags = ModelTag::where([
            ['model_id', $module->id],
            ['model_type', get_class($module)]
        ])->pluck('tag_id')->toArray();
        return view('admin.courses.modules.edit', compact('module',
            'milestones','tags', 'module_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ModuleRequest $request
     * @param Module $module
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request, Module $module)
    {

//        if($request->milestone_id == $module->milestone_id) {
//            $this->reorderOnUpdate($module, $request);
//        }else {
//            if($request->order == 0 || !$request->order) {
//                $request->request->add(['order' => Module::where('milestone_id',$request->milestone_id)->count() + 1]);
//            } else {
//                $this->reorderOnCreate($request);
//            }
//        }

        

        $request->request->add(['published' => $request->published ? true : false]);

        $this->updateFromRequest($module, $request);
		/**********Order reset**********/
		/*$modules = Module::orderBy('order')->get();
		$currentId = $module->id;
		$currentOrder = $module->order;
		$orderInd=1;
		
		foreach($modules as $modul){
			$modul->update([
				'order' => $orderInd
			]);
			$orderInd++;
		}*/
        if($request->tags) {
            ModelTag::where([
                ['model_id', $module->id],
                ['model_type', get_class($module)]
            ])->delete();
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $module->id,
                    'model_type' => get_class($module),
                    'tag_id' => $tag
                ]);
            }
        }
		return redirect()->route('modules.edit',['module'=>$module->id])->with('success', 'Module updated successfully');
        /*return redirect()->route('modules.index')->with('success', 'Module updated successfully');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Module $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.index')->with('success', 'Module delete successfully');
    }

    private function reorderOnUpdate($old_order, $new_order, $dont_reorder) {
        if($new_order > $old_order) {
            //selected item move down
            $reorder_sections = Module::where([
                ['order','>=', $old_order],
                ['order','<=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order-1]);
            }
        }elseif($old_order > $new_order) {
            $reorder_sections = Module::where([
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

        $reorder_sections = Module::where([
            ['order','>=', $request->order],
            ['milestone_id','>=', $request->milestone_id]
        ])->orderBy('order')->get();

        foreach ($reorder_sections as $section) {
            $section->update(['order'=> $section->order+1]);
        }
    }



    public function getByMilestone($id) {
        return response()->json([
            'data' => Module::where('milestone_id', $id)->orderBy('order')->get()
        ],200);
    }

    public function reorder($id, Request $request) {
        $new_order = $request->new_index;
        $old_order = $request->old_index;
        $module = Module::findOrFail($id);

        $module->order = $new_order;
        $module->save();
        $currModOrder =0;
		if($request->currentModId>0){
			$currentModule = Module::findOrFail($request->currentModId);
			$currModOrder = $currentModule->order;
		}
        /*$milestone->update(['order'=> $new_order]);*/
        $this->reorderOnUpdate($old_order, $new_order, $id);
        return response()->json(
            ['message' => 'reordered successfully','currentModuleId'=>$currModOrder],200
        );
    }
	/**
     * Show the form for editing the specified resource.
     *
     * @param Module $module
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
        $tags = Tag::all();
		$module = Module::findOrFail($id);
        $module_tags = ModelTag::where([
            ['model_id', $id],
            ['model_type', get_class($module)]
        ])->pluck('tag_id')->toArray();
		
		$getModules = Module::where('milestone_id', $module->milestone_id)->orderBy('id')->get();
		$milestone = Milestone::where('id', $module->milestone_id)->orderBy('order')->first();
		$course = [];
		if($milestone){
            
                $courseId = $milestone->course_id;
                $course = Courses::where('id','=',$courseId)->get();
                //print_r($course);
            }
        return view('admin.courses.modules.preview', compact('module',
            'milestone','tags', 'module_tags','getModules', 'module','course'));
    }
}
