<?php

namespace App\Http\Controllers;
use App\Http\Requests\CoursesRequest;
use Illuminate\Http\Request;
use App\Models\Courses;
use Redirect;
use App\Models\Tag;
use App\Models\ModelTag;
use App\Models\User;
use App\Models\UserRole;
use App\Models\CourseManagement\Section;
use App\Models\CourseManagement\Milestone;


class CoursesController extends Controller
{
    public function index()
    {
        $courses = Courses::orderBy('order')->get();
		$totalmilestone = [];
        foreach($courses as $course){
            $courseId = $course->id;
            
            if($courseId){
                $courseMilestones = Milestone::orderBy('order')->where('course_id','=',$courseId)->get();
                $totalmilestone[$courseId] = count($courseMilestones);
            }
        }
  
        return view('admin.courses.index', compact('courses','totalmilestone'));
    }
    public function store(Request $request)
    {
		$request->validate([
			'name' => 'required',
			// 'description' => 'required',
			// 'content' => 'required',
			'user_type' => 'required|array|min:1',
			'order' => 'required',
			'status' => 'required',
		], [
            'name.required' => 'Course name is required',
            'user_type.required' => 'Course user type is required',
            'user_type.min' => 'Course user type is required',
            'user_type.array' => 'Course user type is required',
            'order.required' => 'Course order is required',
            'status.required' => 'Course status is required',
        ]);


        // dd($request->all());
		
		
        $published = $request->published;
        $duration = (int)($request->hour ? $request->hour * 60 : 0)+ (int)($request->minute ? $request->minute : 0);
        if($published == 'true'){
            $published = 1;
        }else{
            $published = 0; 
        }

       
        $filename = '';
        if($request->hasFile('course_cover_image')){
            
            $file= $request->file('course_cover_image');
            $filename= date('YmdHis').'.'.$file->getClientOriginalExtension();
            $file->move((public_path(). '/public/Image'), $filename);
           
        }
		
        $course = Courses::create([
            'title' => $request->name,
            'description' => $request->description,
            'published'=>$published,
            'content' => $request->get('content'),
            'user_type' => $request->get('user_type')[0],
            'duration' => $duration,
            'order' => $request->get('order'),
            'status' => $request->get('status'),
            'coverimage' =>$filename
        ]);

        $course->user_course_roles()->attach($request->user_type);

		/**********Order reset**********/
		$courses = Courses::orderBy('order')->get();
		
		$currentId = $course->id;
		$currentOrder = $course->order;
		$orderInd=1;
		foreach($courses as $course){
			$course->update([
				'order' => $currentOrder
			]); 			
			
			$orderInd++;
		}
        
		if($request->tags) {
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $course->id,
                    'model_type' => get_class($course),
                    'tag_id' => $tag
                ]);
            }
        }
		return redirect('admin/course-management/courses/'.$course->id.'/edit')->with('success', 'Course created successfully');
    }
    public function edit($id)
    {
        // dd('called');
        $usersRoles = UserRole::where('slug','!=','super_admin')->get();		
        $milestones = Milestone::where('course_id',$id)->orderBy('order')->get();
        $tags = Tag::all();
        $sections = Section::all();
		$course = Courses::findOrFail($id);
        $course_user_types = $course->user_course_roles()->pluck('user_role_id')->toArray();
		$course_tags = ModelTag::where([
            ['model_id', $course->id],
            ['model_type', get_class($course)]
        ])->pluck('tag_id')->toArray();
		return view('admin.courses.edit',
            compact('course','tags', 'course_tags', 'sections','usersRoles','milestones', 'course_user_types'));
	}
    public function course_update(Request $request, $id)
    {
        $request->validate([
			'name' => 'required',
			// 'description' => 'required',
			// 'content' => 'required',
			'user_type' => 'required|array|min:1',
			'order' => 'required',
			'status' => 'required',
		], [
            'name.required' => 'Course name is required',
            'user_type.required' => 'Course user type is required',
            'user_type.min' => 'Course user type is required',
            'user_type.array' => 'Course user type is required',
            'order.required' => 'Course order is required',
            'status.required' => 'Course status is required',
        ]);
        $published = $request->published;
        if($published == 'true'){
            $published = 1;
        }else{
            $published = 0; 
        }
		$course = Courses::findOrFail($id);
        $filename = '';
        if($request->hasFile('course_cover_image')){
            
            $file= $request->file('course_cover_image');
            $filename= date('YmdHis').'.'.$file->getClientOriginalExtension();
            $file->move((public_path().'/public/Image'), $filename);
           
        } else {
            $filename = $request->course_cover_image_old;
        }
		$content = '';
		if($request->get('content')){
			$content = $request->get('content');
		}
		$duration = (int)($request->hour ? $request->hour * 60 : 0)+ (int)($request->minute ? $request->minute : 0);
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
        $course_user_types = $course->user_course_roles()->pluck('user_role_id')->toArray();
        if (count($course_user_types) > 0) {
            $course->user_course_roles()->detach($course_user_types);
        }
        $course->user_course_roles()->attach($request->user_type);
		/**********Order reset**********/
		/*$courses = Courses::orderBy('order')->get();
		$currentId = $course->id;
		$currentOrder = $request->get('order');
		$orderInd=1;
		foreach($courses as $cours){
			if($orderInd<$currentOrder){
				if($currentId == $cours->id){
					$cours->update([
						'order' => $request->get('order')
					]);
				}else{
					$cours->update([
						'order' => $orderInd
					]);
				}
				 
			}else{
				if($orderInd==$currentOrder || $currentId == $cours->id){
					$cours->update([
						'order' => $currentOrder
					]);
				}else{
					$cours->update([
						'order' => $orderInd+1
					]);
				}					
			}
			$cours->update([
						'order' => $orderInd
					]);
			$orderInd++;
		}*/
   
        if($request->tags) {
            ModelTag::where([
                ['model_id', $course->id],
                ['model_type', get_class($course)]
            ])->delete();
            foreach ($request->tags as $tag) {
                ModelTag::create([
                    'model_id' => $course->id,
                    'model_type' => get_class($course),
                    'tag_id' => $tag
                ]);
            }
        } else {
            ModelTag::where([
                ['model_id', $course->id],
                ['model_type', get_class($course)]
            ])->delete();
        }   
        //return redirect()->route('courses.index')->with('success', 'Milestone updated successfully');
        /*return Redirect::back()->withErrors(['msg' => 'The Message']);*/
		return redirect('admin/course-management/courses/'.$id.'/edit')->with('success', 'Course updated successfully');
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
        $user = auth()->user();
        $course = Courses::orderBy('order')->where('id','=',$course)->first();
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found');
        }
        $couser_user_type = $course->user_course_roles()->pluck('user_role_id')->toArray();
        if (!in_array($user->role, $couser_user_type)) {
            return redirect()->route('courses.index')->with('error', 'You don\'t have permission to access this course');
        }
        // $milestones = Milestone::orderBy('order')->where('course_id','=',$course->id)->where('published',1)->get();
        $milestones = Milestone::getUserTypeWiseMilestones($course->id)->orderBy('order')->get();
        // dd($milestones);
        $totalmilestones = 0;
		if($milestones){
			$totalmilestones = $milestones->count();
		}        
        if($course->status == 'paid'){
			return redirect(route('home'));
		}
        $tags = Tag::all();
        $sections = Section::all();
        
        return view('student.courses.milestones', compact('tags','milestones','course','totalmilestones'));
    }
	/**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
        $course = Courses::findOrFail($id);
        $course->delete();
        return back()->with('success', 'Course deleted successfully!');
	}
}
