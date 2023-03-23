<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CRUD;
use App\Http\Requests\CourseManagement\TaskRequest;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Milestone;
use App\Models\CourseManagement\Module;
use App\Models\CourseManagement\Task;
use App\Models\CourseManagement\UserTaskStatus;
use App\Models\ModelTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Courses;

class TaskController extends Controller
{
    use CRUD;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('order')->get();
        return view('admin.courses.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::orderBy('order')->get();
		$tasks = Task::count();
        $tags = Tag::all();
        return view('admin.courses.tasks.create', compact('sections','tags', 'tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        //$task = $this->createFromRequest(app('App\Models\CourseManagement\Task'),$request);
		$order = $request->order;
        if(!$order || $order == 0) {
            $request->request->add(['order' => Task::where('section_id','=', $request->section_id)->count() + 1]);
        } else {
            $this->reorderOnCreate($request);
        }

        $task = $this->createFromRequest(app('App\Models\CourseManagement\Task'),$request);
        if($request->tags) {
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $task->id,
                    'model_type' => get_class($task),
                    'tag_id' => $tag
                ]);
            }
        }
        if($request->redirectBack)
            return redirect()->back()->with('success', 'Task updated successfully');
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseManagement\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
		if($task->status == 'paid'){
			return redirect(route('home'));
		}
		$gettasks = Task::where('section_id',$task->section_id)->orderBy('order')->get();
		
		$course = array();
		$milestone = array();
		$module = array();
		$section = array();
		$section = Section::where('id',$task->section_id)->orderBy('order')->first();
	
		if($section){
			$module = Module::where('id', $section->module_id)->orderBy('order')->first();	
		}
		
		if($module){
			$milestone = Milestone::where('id', $module->milestone_id)->orderBy('order')->first();
            if($milestone){
            
                $courseId = $milestone->course_id;
                $course = Courses::where('id','=',$courseId)->get();
                //print_r($course);
            }				
				
			
		}
		if($milestone){
            
            $courseId = $milestone->course_id;
            $course = Courses::where('id','=',$courseId)->get();
            //print_r($course);
        }
		
        return view('student.courses.taskDetail',compact('task','gettasks', 'section', 'module', 'milestone','course'));
    }
    public function showDetail($id)
    {
        $task = Task::findOrFail($id);
		
		
        return view('student.courses.taskDetail',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseManagement\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $sections = Section::orderBy('order')->get();
        $tags = Tag::all();
        $module_tags = ModelTag::where([
            ['model_id', $task->id],
            ['model_type', get_class($task)]
        ])->pluck('tag_id')->toArray();
        return view('admin.courses.tasks.edit', compact('task','sections','tags', 'module_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseManagement\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->request->add(['published' => $request->published ? true : false]);

        $model = $this->updateFromRequest($task,$request);

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
        /*return redirect()->route('tasks.index')->with('success', 'Task updated successfully');*/
		return redirect('admin/course-management/tasks/'.$model->id.'/edit')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseManagement\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function changeStatus(Task $task) {
        $task_status = $task->authTaskStatus();
        if($task_status) {
            $task_status->status = $task_status->status == UserTaskStatus::INCOMPLETE
                ? UserTaskStatus::COMPLETE: UserTaskStatus::INCOMPLETE;
            $task_status->save();
        }else {
            UserTaskStatus::create([
                'user_id' => auth()->id(),
                'task_id' => $task->id,
                'status' => UserTaskStatus::COMPLETE
            ]);
        }
        return redirect()->back()->with('message', 'Task Status Changed Successfully');
    }

    public function changeStatusJson($id) {
        $task = Task::findOrFail($id);
        $user = \request('user_id');
        $task_status = $task->taskStatus->where('user_id', $user)->first();;
        if($task_status) {
            $task_status->status = $task_status->status == UserTaskStatus::INCOMPLETE
                ? UserTaskStatus::COMPLETE: UserTaskStatus::INCOMPLETE;
            $task_status->save();
        }else {
            UserTaskStatus::create([
                'user_id' => $user,
                'task_id' => $task->id,
                'status' => UserTaskStatus::COMPLETE
            ]);
        }
        return response()->json([
            'message' => 'Status Changed Successfully'
        ],200);
    }
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseManagement\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
		$task = Task::findOrFail($id);
        $gettasks = Task::where('section_id',$task->section_id)->orderBy('order')->get();
		
		$course = array();
		$milestone = array();
		$module = array();
		$section = array();
		$section = Section::where('id',$task->section_id)->orderBy('order')->first();
	
		if($section){
			$module = Module::where('id', $section->module_id)->orderBy('order')->first();	
		}
		
		if($module){
			$milestone = Milestone::where('id', $module->milestone_id)->orderBy('order')->first();			
		}
		if($milestone){
            
                $courseid = $milestone->course_id;
                $course = Courses::where('id','=',$courseid)->get();
                //print_r($course);
            }
        return view('admin.courses.tasks.preview', compact('task','gettasks', 'section', 'module', 'milestone','course'));
    }
	public function taskBySection($id) {
        return response()->json([
            'data' => Task::where('section_id', $id)->orderBy('order')->get()
        ],200);
    }

    private function reorderOnUpdate($old_order, $new_order, $dont_reorder) {
        if($new_order > $old_order) {
            //selected item move down
            $reorder_tasks = Task::where([
                ['order','>=', $old_order],
                ['order','<=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_tasks as $task) {
                $task->update(['order'=> $task->order-1]);
            }
        }elseif($old_order > $new_order) {
            $reorder_tasks = Task::where([
                ['order','<=', $old_order],
                ['order','>=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_tasks as $task) {
                $task->update(['order'=> $task->order+1]);
            }
        }
    }
    private function reorderOnCreate($request) {
        $reorder_tasks = Task::where([
            ['order','>=', $request->order],
            ['section_id','>=', $request->section_id],
        ])->orderBy('order')->get();
        foreach ($reorder_tasks as $task) {
            $task->update(['order'=> $task->order+1]);
        }
    }

    public function reorder($id, Request $request) {

        $new_order = $request->new_index;
        $old_order = $request->old_index;
        $model = Task::findOrFail($id);
        $model->order = $new_order;
        $model->save();
         
		$currOrder =0;
		if($request->currTaskId>0){
			$currentTask = Task::findOrFail($request->currTaskId);
			$currOrder = $currentTask->order;
		}
		$this->reorderOnUpdate($old_order, $new_order, $id);
        return response()->json([
            'message' => 'reordered successfully','currOrder'=>$currOrder
        ],200);
    }
}
