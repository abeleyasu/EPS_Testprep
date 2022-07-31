<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\ContentCategory;
use App\Models\Courses;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Task;
use App\Models\CourseManagement\Milestone;
use App\Models\CourseManagement\Module;
use App\Models\ModelTag;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests\CourseManagement\CourseRequest;

class CourseController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = ContentCategory::orderBy('updated_at')->get();

        return view('admin.courses.index', compact('courses'));
    }
	public function all() {
        return response()->json([
            'data' => Courses::orderBy('order')->get()
        ],200);
    }
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function create()
    {
		$tags = Tag::all();
        $sections = Section::all();
        $contentCategories = ContentCategory::all();
        return view('admin.courses.create', compact('tags','sections', 'contentCategories'));
	}
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
		$course = ContentCategory::create([
            'title' => $request->name,
            'description' => $request->description
        ]);
		return redirect('admin/course-management/courseslist/'.$course->id.'/edit')->with('success', 'Milestone created successfully');
	}
	/**
     * Display the specified resource.
     *
     * @param Course $course
     * @return void
     */
    public function show(Course $course)
    {
		$getCourses = ContentCategory::orderBy('updated_at')->get();
		
        return view('student.courses.course',compact('course','getCourses'));
	}
	/**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$course = ContentCategory::findorfail($id);
		return view('admin.courses.edit',
            compact('course'));
	}
	/**
     * courseupdate the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function courseupdate(CourseRequest $request, $id)
    {
		$course = ContentCategory::findorfail($id);
        
        $course->update([
            'title' => $request->name,
            'description' => $request->description
        ]);
		return redirect('admin/course-management/courses/'.$id.'/edit')->with('success', 'Course updated successfully');
        /*return redirect()->route('courseslist.index')->with('success', 'Milestone updated successfully');*/
	}
	/**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
        $course = ContentCategory::findorfail($id);
        $course->delete();
        return redirect()->route('admin/course-management/courses')->with('success', 'Course delete successfully');
	}
	public function preview($id){
		$milestones = Milestone::orderBy('order')->where('course_id','=',$id)->where('published',1)->get();
        $totalmilestones = 0;
		if($milestones){
			$totalmilestones = $milestones->count();
		}        
        $course = Courses::orderBy('order')->where('id','=',$id)->first();
        
        $tags = Tag::all();
        $sections = Section::all();
		
		return view('admin.courses.preview', compact('tags','milestones','course','totalmilestones'));
	}
	public function reorder($id, Request $request) {
        $new_order = $request->new_index;
        $old_order = $request->old_index;
        $course = Courses::findorfail($id);
        $course->order = $new_order;
        $course->save();
        /*$milestone->update(['order'=> $new_order]);*/
        $this->reorderOnUpdate($old_order, $new_order, $id);
        return response()->json(
            ['message' => 'reordered successfully'],200
        );
    }
	private function reorderOnUpdate($old_order, $new_order, $dont_reorder) {
        if($new_order > $old_order) {
            //selected item move down
            $reorder_sections = Courses::where([
                ['order','>=', $old_order],
                ['order','<=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order-1]);
            }
        }elseif($old_order > $new_order) {
            $reorder_sections = Courses::where([
                ['order','<=', $old_order],
                ['order','>=', $new_order],
                ['id','!=', $dont_reorder]
            ])->orderBy('order')->get();
            foreach ($reorder_sections as $section) {
                $section->update(['order'=> $section->order+1]);
            }
        }
    }
}