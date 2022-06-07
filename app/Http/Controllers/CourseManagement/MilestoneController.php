<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\ContentCategory;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Task;
use App\Models\ModelTag;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests\CourseManagement\MilestoneRequest;

use App\Models\CourseManagement\Milestone;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $milestones = Milestone::orderBy('order')->get();

        return view('admin.courses.milestones.index', compact('milestones'));
    }

    public function all() {
        return response()->json([
            'data' => Milestone::orderBy('order')->get()
        ],200);
    }

    public function studentIndex()
    {
        $milestones = Milestone::where('published', true)->orderBy('order')->get();

        return view('student.courses.index', compact('milestones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        $milestones = Milestone::orderBy('order')->get();
        $tags = Tag::all();
        $sections = Section::all();
        $contentCategories = ContentCategory::all();
        return view('admin.courses.milestones.create', compact('tags','sections', 'contentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MilestoneRequest $request)
    {

        $duration = (int)($request->hour?$request->hour * 60: 0)+ (int)$request->minute ?? 0;

        $order = $request->order;
        if(!$order || $order == 0) {
            $request->request->add(['order' => Milestone::count() + 1]);
        }
        else {
            $this->reorderOnCreate($order);
        }

        $milestone = Milestone::create([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->get('content'),
            'user_type' => $request->get('user_type'),
            'duration' => $duration,
            'order' => $request->get('order'),
            'status' => $request->get('status'),
            'added_by' => auth()->id(),
            'content_category_id' => $request->content_category,
            'published' => $request->get('published') ? true : false
        ]);
        if($request->tags) {
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $milestone->id,
                    'model_type' => get_class($milestone),
                    'tag_id' => $tag
                ]);
            }
        }
        return redirect()->route('milestones.index')->with('success', 'Milestone created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Milestone $milestone
     * @return void
     */
    public function show(Milestone $milestone)
    {
        return view('student.courses.modules',compact('milestone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tags = Tag::all();
        $milestone = Milestone::findorfail($id);
        $sections = Section::all();
        $milestone_tags = ModelTag::where([
            ['model_id', $milestone->id],
            ['model_type', get_class($milestone)]
        ])->pluck('tag_id')->toArray();
        $contentCategories = ContentCategory::all();
        return view('admin.courses.milestones.edit',
            compact('milestone','tags', 'milestone_tags', 'sections', 'contentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MilestoneRequest $request, $id)
    {

        $milestone = Milestone::findorfail($id);

        $duration = (int)($request->hour?$request->hour * 60: 0)+ (int)$request->minute ?? 0;

//        $this->reorderOnUpdate($milestone->order, $request->order, $id);
        $milestone->update([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->get('content'),
            'user_type' => $request->get('user_type'),
            'duration' => $duration,
            'order' => $request->get('order'),
            'status' => $request->get('status'),
//            'added_by' => auth()->id(),
            'content_category_id' => $request->content_category,
            'published' => $request->get('published') ? true : false
        ]);

        if($request->tags) {
            ModelTag::where([
                ['model_id', $milestone->id],
                ['model_type', get_class($milestone)]
            ])->delete();
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $milestone->id,
                    'model_type' => get_class($milestone),
                    'tag_id' => $tag
                ]);
            }
        }

        return redirect()->route('milestones.index')->with('success', 'Milestone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $milestone = Milestone::findorfail($id);
        $milestone->delete();
        return redirect()->route('milestones.index')->with('success', 'Milestone delete successfully');
    }

    private function reorderOnUpdate($old_order, $new_order, $dont_reorder) {
        if($new_order > $old_order) {
            //selected item move down
            $reorder_sections = Milestone::where([
                ['order','>=', $old_order],
                ['order','<=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order-1]);
            }
        }elseif($old_order > $new_order) {
            $reorder_sections = Milestone::where([
                ['order','<=', $old_order],
                ['order','>=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order+1]);
            }
        }
    }
    private function reorderOnCreate($order) {
        $reorder_sections = Milestone::where([
            ['order','>=', $order],
        ])->orderBy('order')->get();
        foreach ($reorder_sections as $section) {
            $section->update(['order'=> $section->order+1]);
        }
    }

    public function reOrder($id, Request $request) {
        $new_order = $request->new_index;
        $old_order = $request->old_index;
        $milestone = Milestone::findorfail($id);
        $milestone->order = $new_order;
        $milestone->save();
        $this->reorderOnUpdate($old_order, $new_order, $id);
        return response()->json(
            ['message' => 'reordered successfully'],200
        );
    }
}
