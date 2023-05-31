<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\ContentCategory;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Task;
use App\Models\ModelTag;
use App\Models\Tag;
use App\Models\Courses;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CourseManagement\MilestoneRequest;
use App\Models\CourseManagement\Module;

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
        $courses = Courses::where('published', true)->orderBy('order')->get();
		$totalmilestone = [];
        foreach($courses as $course){
            $courseid = $course->id;
            
            if($courseid){
                // $coursemilestones = Milestone::orderBy('updated_at')->where('course_id','=',$courseid)->get();
                // $totalmilestone[$courseid] = count($coursemilestones);
                $coursemilestones = Milestone::orderBy('updated_at')->where('course_id','=',$courseid)->where('published',1)->get();
                $totalmilestone[$courseid]['total_milestone'] = count($coursemilestones);
                
                $totalmilestone[$courseid]['completed_task'] = 0;
				$totalmilestone[$courseid]['total_module'] = 0;
				$total_milestone_completion_percent = 0;
				$completed_task_per = 0;
				foreach($coursemilestones as $mkey=>$milestone){
					$completedmodule=0;
					$totalmodules=0;
					$modules =  $milestone->modules();
					$totalmodules = $modules->count();
					foreach($milestone->modules as $mmkey=>$module){
						 $mtotaltasks = $module->tasks()->count();
						 $mtotalcompletetasks = $module->completeTasks(auth()->id())->count();
						 if($mtotaltasks == $mtotalcompletetasks){
							$completedmodule++;
						 }elseif($mtotalcompletetasks > 0){
						     $completedmodule = $mtotalcompletetasks / $mtotaltasks;
						 }
					 }
					 if($completedmodule > 0){
						$modulepercentage = floor(($completedmodule/$totalmodules)*100);
						$total_milestone_completion_percent = $total_milestone_completion_percent + $modulepercentage;
					 }
				}			
				if($total_milestone_completion_percent > 0){
					$completed_task_per = $total_milestone_completion_percent / count($coursemilestones);
					$totalmilestone[$courseid]['completed_task'] = round($completed_task_per);
				}else {
					$totalmilestone[$courseid]['completed_task'] = 0;					
				}
               
            }
        }
        return view('student.courses.index', compact('courses','totalmilestone'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {		
        $usersRoles = UserRole::where('slug','!=','super_admin')->get();		
//        $milestones = Milestone::orderBy('order')->get();
        $tags = Tag::all();
        $sections = Section::all();
        $contentCategories = ContentCategory::all();
        $courses = $courses = Courses::all();
		$totalMilstone = Milestone::count();
        return view('admin.courses.milestones.create', compact('tags','sections','courses', 'contentCategories','usersRoles','totalMilstone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MilestoneRequest $request)
    {
        $duration = (int)($request->hour ? $request->hour * 60 : 0)+ (int) ($request->minute ? $request->minute : 0);
		$filename= '';
        $order = $request->order;
        if(!$order || $order == 0) {
            $request->request->add(['order' => Milestone::count() + 1]);
        }
        else {
            $this->reorderOnCreate($order);
        }
        if($request->hasFile('course_cover_image')){
            
            $file= $request->file('course_cover_image');
            $filename= date('YmdHis').'.'.$file->getClientOriginalExtension();
            $file->move((public_path().'/public/Image'), $filename);
           
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
            'course_id' => $request->select_course,
            'coverimage'=>$filename,
            'published' => $request->get('published') ? true : false
        ]);
		/**********Order reset**********/
		/*$milestones = Milestone::orderBy('order')->get();
		$currentId = $milestone->id;
		$currentOrder = $milestone->order;
		$orderInd=1;
		
		foreach($milestones as $mileston){
			$mileston->update([
				'order' => $orderInd
			]);
			$orderInd++;
		}*/
        if($request->tags) {
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $milestone->id,
                    'model_type' => get_class($milestone),
                    'tag_id' => $tag
                ]);
            }
        }
        return redirect('admin/course-management/milestones/'.$milestone->id.'/edit')->with('success', 'Milestone created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Milestone $milestone
     * @return void
     */
    public function show(Milestone $milestone)
    {
        //echo $milestone->id;
		if($milestone->status == 'paid'){
			return redirect(route('home'));
		}
		$getMilestones = Milestone::where('published', true)->where('id','=',$milestone->id)->orderBy('id')->get();
        
        if($milestone){
            
                $courseid = $milestone->course_id;
                $course = Courses::where('id','=',$courseid)->get();
                //print_r($course);
            }
      
        
        return view('student.courses.modules',compact('milestone','getMilestones','course'));
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
        $milestone = Milestone::findOrFail($id);
        $sections = Section::all();
        $milestone_tags = ModelTag::where([
            ['model_id', $milestone->id],
            ['model_type', get_class($milestone)]
        ])->pluck('tag_id')->toArray();
        $contentCategories = ContentCategory::all();
        $courses = Courses::all();
		$usersRoles = UserRole::where('slug','!=','super_admin')->get();
        
  
        return view('admin.courses.milestones.edit',
            compact('milestone','tags', 'milestone_tags', 'sections', 'contentCategories','courses','usersRoles'));
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
        $milestone = Milestone::findOrFail($id);
		$filename= '';
        $duration = (int)($request->hour ? $request->hour * 60 : 0)+ (int)($request->minute ? $request->minute : 0);
        if($request->hasFile('course_cover_image')){
            
            $file= $request->file('course_cover_image');
            $filename= date('YmdHis').'.'.$file->getClientOriginalExtension();
            $file->move((public_path(). '/public/Image'), $filename);
           
        } else {
            $filename = $request->course_cover_image_old;
        }
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
            'course_id' => $request->course,
            'coverimage' => $filename,
            'published' => $request->get('published') ? true : false
        ]);
		/**********Order reset**********/
		/*$milestones = Milestone::orderBy('order')->get();
		$currentId = $milestone->id;
		$currentOrder = $request->get('order');
		$orderInd=1;
		
		foreach($milestones as $mileston){
			$mileston->update([
				'order' => $orderInd
			]);
			$orderInd++;
		}*/
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
        } else {
            ModelTag::where([
                ['model_id', $milestone->id],
                ['model_type', get_class($milestone)]
            ])->delete();
        }
		return redirect('admin/course-management/milestones/'.$id.'/edit')->with('success', 'Milestone updated successfully');
        /*return redirect()->route('milestones.index')->with('success', 'Milestone updated successfully');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $milestone = Milestone::findOrFail($id);
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

    public function reorder($id, Request $request) {
        $new_order = $request->new_index;
        $old_order = $request->old_index;
        $milestone = Milestone::findOrFail($id);
        $milestone->order = $new_order;
        $milestone->save();
		$currMileOrder =0;
		if($request->currentMileId>0){
			$currentmilestone = Milestone::findOrFail($request->currentMileId);
			$currMileOrder = $currentmilestone->order;
		}
        /*$milestone->update(['order'=> $new_order]);*/
        $this->reorderOnUpdate($old_order, $new_order, $id);
        return response()->json(
            ['message' => 'reordered successfully','currentMilestoneId'=>$currMileOrder],200
        );
    }
	
	/**
     * Show the form for preview the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {

        $tags = Tag::all();
        $milestone = Milestone::findOrFail($id);
        $sections = Section::all();
        $milestone_tags = ModelTag::where([
            ['model_id', $milestone->id],
            ['model_type', get_class($milestone)]
        ])->pluck('tag_id')->toArray();
        $contentCategories = ContentCategory::all();
		
		$getMilestones = Milestone::orderby('id')->get();
		
		if($milestone){
            
                $courseid = $milestone->course_id;
                $course = Courses::where('id','=',$courseid)->get();
                //print_r($course);
            }
		
        return view('admin.courses.milestones.preview',
            compact('milestone','tags', 'milestone_tags', 'sections', 'contentCategories','getMilestones','course'));
    }
}
