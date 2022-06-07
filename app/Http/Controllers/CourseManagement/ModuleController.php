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
        return view('admin.courses.modules.create', compact('tags', 'milestones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {

        $request->request->add(['added_by' => auth()->id()]);

        $order = $request->order;
        if(!$order || $order == 0) {
            $request->request->add(['order' => Module::where('milestone_id',$request->milestone_id)->count() + 1]);
        } else {
            $this->reorderOnCreate($request);
        }

        $module = $this->createFromRequest(app('App\Models\CourseManagement\Module'),$request);
        if($request->tags) {
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $module->id,
                    'model_type' => get_class($module),
                    'tag_id' => $tag
                ]);
            }
        }
        return redirect()->route('modules.index')->with('success', 'Module created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param Module $module
     * @return void
     */
    public function show(Module $module)
    {
        return view('student.courses.moduleDetailNew',compact('module'));
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

        return redirect()->route('modules.index')->with('success', 'Module updated successfully');
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

    private function reorderOnUpdate($module, $request) {
        $new_order = $request->order;
        $old_order = $module->order;
        if($new_order > $old_order) {
            //selected item move down
            $reorder_sections = Module::where([
                ['order','>=', $old_order],
                ['order','<=', $new_order],
                ['id','!=', $module->id],
                ['milestone_id','!=', $request->milestone_id]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order-1]);
            }
        }elseif($old_order > $new_order) {
            //selected item move down
            $reorder_sections = Module::where([
                ['order','<=', $old_order],
                ['order','>=', $new_order],
                ['id','!=', $module->id],
                ['milestone_id','!=', $request->milestone_id]
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
        $module = Module::findorfail($id);

        $module->order = $new_order;
        $module->save();
        if($new_order > $old_order) {
            //selected item move down
            $reorder_sections = Module::where([
                ['order','>=', $old_order],
                ['order','<=', $new_order],
                ['id','!=', $module->id],
                ['milestone_id','=', $module->milestone_id]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order-1]);
            }
        }elseif($old_order > $new_order) {
            //selected item move down
            $reorder_sections = Module::where([
                ['order','<=', $old_order],
                ['order','>=', $new_order],
                ['id','!=', $module->id],
                ['milestone_id','=', $module->milestone_id]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order+1]);
            }
        }

        return response()->json([
            'message' => 'module ordered successfully'
        ],200);
    }
}
