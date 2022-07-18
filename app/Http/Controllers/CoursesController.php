<?php

namespace App\Http\Controllers;
use App\Http\Requests\CoursesRequest;
use Illuminate\Http\Request;
use App\Models\Courses;
use Redirect;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserRole;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Milestone;


class CoursesController extends Controller
{
    public function index()
    {
        $courses = Courses::orderBy('order')->get();
        foreach($courses as $course){
            $courseid = $course->id;
            $totalmilestone = 0;
            if($courseid){
                $coursemilestones = Milestone::orderBy('order')->where('course_id','=',$courseid)->get();
                $totalmilestone = count($coursemilestones);
            }
        }

        return view('admin.courses.index', compact('courses','totalmilestone'));
    }
    public function store(Request $request)
    {
        $published = $request->published;
        $duration = (int)($request->hour?$request->hour * 60: 0)+ (int)$request->minute ?? 0;
        if($published == 'true'){
            $published = 1;
        }else{
            $published = 0; 
        }

       
        $filename = '';
        if($request->file('course_cover_image')){
            
            $file= $request->file('course_cover_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(('public/Image'), $filename);
           
        }
        $course = Courses::create([
            'title' => $request->name,
            'description' => $request->description,
            'published'=>$published,
            'content' => $request->get('content'),
            'user_type' => $request->get('user_type'),
            'duration' => $duration,
            'order' => $request->get('order'),
            'status' => $request->get('status'),
            'coverimage' =>$filename
        ]);
		return redirect('admin/course-management/courses/'.$course->id.'/edit')->with('success', 'Milestone created successfully');
    }
    public function edit($id)
    {
        $usersRoles = UserRole::where('slug','!=','super_admin')->get();		
        $milestones = Milestone::where('course_id',$id)->orderBy('order')->get();
        $tags = Tag::all();
        $sections = Section::all();
		$course = Courses::findorfail($id);
		return view('admin.courses.edit',
            compact('course','tags','sections','usersRoles','milestones'));
	}
    public function courseupdate(Request $request, $id)
    {
        $published = $request->published;
        if($published == 'true'){
            $published = 1;
        }else{
            $published = 0; 
        }
		$course = Courses::findorfail($id);
        $filename = '';
        if($request->file('course_cover_image')){
            
            $file= $request->file('course_cover_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(('public/Image'), $filename);
           
        }
		$content = '';
		if($request->get('content')){
			$content = $request->get('content');
		}
		$duration = (int)($request->hour?$request->hour * 60: 0)+ (int)$request->minute ?? 0;
        $course->update([
            'title' => $request->name,
            'description' => $request->description,
            'published'=>$published,
            'coverimage'=>$filename,
			'content' => $content,
            'user_type' => $request->get('user_type'),
            'duration' => $duration,
            'order' => $request->get('order'),
            'status' => $request->get('status'),
        ]);                 
            
        //return redirect()->route('courses.index')->with('success', 'Milestone updated successfully');
        return Redirect::back()->withErrors(['msg' => 'The Message']);
    }

    public function create()
    {		
        $usersRoles = UserRole::where('slug','!=','super_admin')->get();		
//        $milestones = Milestone::orderBy('order')->get();
        $tags = Tag::all();
        $sections = Section::all();
        
        return view('admin.courses.create', compact('tags','sections','usersRoles'));
    }

    public function show($course)
    {		
        $usersRoles = UserRole::where('slug','!=','super_admin')->get();		
//        $milestones = Milestone::orderBy('order')->get();
        $tags = Tag::all();
        $sections = Section::all();
        
        return view('admin.courses.create', compact('tags','sections','usersRoles'));
    }

    public function UserCourseDetail($course)
    {		
        //$usersRoles = UserRole::where('slug','!=','super_admin')->get();		
        $milestones = Milestone::orderBy('order')->where('course_id','=',$course)->where('published',1)->get();
        $totalmilestones = 0;
		if($milestones){
			$totalmilestones = $milestones->count();
		}        
        $course = Courses::orderBy('order')->where('id','=',$course)->get();
        
        $tags = Tag::all();
        $sections = Section::all();
        
        return view('student.courses.milestones', compact('tags','milestones','course','totalmilestones'));
    }
}
