@extends('layouts.user')

@section('title', 'HSR | Education : CPS')

@section('user-content')
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
        <div class="bg-black-10">
            <div class="content content-full text-center">
                <br>
                <h1 class="h2 text-white mb-0">High School Resume Tool</h1>
                <br>
            </div>
        </div>
    </div>
    <div class="container education-container">
        <div class="custom-tab-container ">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li role="presentation">
                    <a class="nav-link" href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.personalInfo') }}" id="step1-tab">
                        <p class="d-none">1</p>
                        <i class="fa-solid fa-check fa-check-block "></i>
                        <h6>Personal Info</h6>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link active" href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/education-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.educationInfo') }}" id="step2-tab">
                        <p>2</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Education </h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                    <a class="nav-link" href="{{ isset($education) && $education != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/honors?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.honors')) : ''}}" id="step3-tab">
                        <p>3</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Honors </h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                    <a class="nav-link" href="{{ isset($honor) && $honor != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.activities')) : ''}}" id="step4-tab">
                        <p>4</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Activities</h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                    <a class="nav-link" href="{{ isset($employmentCertification) && $employmentCertification != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.employmentCertification')) : ''}}" id="step5-tab">
                        <p>5</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Employment & <br> Certifications</h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                    <a class="nav-link" href="{{ isset($featuredAttribute) && $featuredAttribute != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.featuresAttributes')) : ''}}" id="step6-tab">
                        <p>6</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Featured <br> Attributes</h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                    <a class="nav-link" href="{{ isset($featuredAttribute) && $featuredAttribute != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/preview?resume_id='.$resume_id) :route('admin-dashboard.highSchoolResume.preview')) : ''}}" id="step7-tab">
                        <p>7</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Preview</h6>
                    </a>
                </li>
            </ul>
            <input type="hidden" name="education" id="education" value="{{ isset($education) && $education != null ? $education->id : ''}}">
            <form class="js-validation" id="education_form" action="{{ isset($education) && $education != null ? route('admin-dashboard.highSchoolResume.educationInfo.update',$education->id) : route('admin-dashboard.highSchoolResume.educationInfo.store') }}" method="POST" onSubmit="event.preventDefault();">
                @csrf
                @if(isset($education) && $education != null)
                    @method('PUT')
                @endif
                @if(isset($resume_id) && $resume_id != null)
                    <input type="hidden" name="resume_id" id="resume_id" value="{{ $resume_id }}">
                @endif
                <div class="tab-content" id="myTabContent">
                    <div class="setup-content" role="tabpanel" id="step2" aria-labelledby="step2-tab">
                        <div class="accordion accordionExample2">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <a class="text-white fw-600 collapsed"> High School Information</a>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="current_grade">Current
                                                            Grade
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" value="{{ isset($education->current_grade) && $education->current_grade != null ? $education->current_grade : old('current_grade') }}" id="current_grade" name="current_grade" placeholder="Enter Current Grade">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="month">Month
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input class="month-own form-control" id="month" name="month" value="{{ isset($education->month) && $education->month != null ? $education->month : old('month') }}" style="width: 100%;" type="text" autocomplete="off">
                                                      
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="year">Year
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input class="year-own form-control" id="year" name="year" value="{{ isset($education->year)  && $education->year != null  ? $education->year : old('year') }}" style="width: 100%;" type="text" autocomplete="off">
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_name">High School
                                                            Name <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="high_school_name" value="{{ isset($education->high_school_name) && $education->high_school_name != null ? $education->high_school_name : old('high_school_name') }}" name="high_school_name" placeholder="Enter High School name">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_city">High School
                                                            City <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="high_school_city" value="{{ isset($education->high_school_city) && $education->high_school_city != null ? $education->high_school_city : old('high_school_city') }}" name="high_school_city" placeholder="Enter High School City">
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_state">High School
                                                            State <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control " id="high_school_state" value="{{ isset($education->high_school_state) && $education->high_school_state != null ? $education->high_school_state : old('high_school_state') }}" name="high_school_state" placeholder="Enter High School State">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_district">High
                                                            School
                                                            District <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="high_school_district" value="{{ isset($education->high_school_district) && $education->high_school_district != null ? $education->high_school_district : old('high_school_district') }}" name="high_school_district" placeholder="Enter High School District">
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <a class="text-white fw-600 collapsed">College Information</a>
                                </div>
                                <div id="collapseTwo" class="collapse {{ $errors->first('grade_level') || $errors->first('college_name') || $errors->first('college_city') || $errors->first('college_state') || $errors->first('college_state') ? 'show' : '' }}" aria-labelledby="headingOne" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="is_graduate" name="is_graduate" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_graduate">
                                                        I have already graduated high school
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="grade_level">
                                                            Grade level
                                                        </label>
                                                        <input type="text" class="form-control" value="{{ isset($education->grade_level) && $education->grade_level != null ? $education->grade_level : old('grade_level') }}" id="grade_level" name="grade_level" placeholder="Enter Grade level" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="college_name">
                                                            College Name
                                                        </label>
                                                        <select class="form-control" id="college_name" name="college_name" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'disabled' : '' }}>
                                                            <option value="">Select College Name</option>
                                                            <option value="one" {{ isset($education->college_name) && $education->college_name == "first" ? 'selected' : '' }}>First</option>
                                                            <option value="two" {{ isset($education->college_name) && $education->college_name == "second" ? 'selected' : '' }}>Second</option>
                                                            <option value="three" {{ isset($education->college_name) && $education->college_name == "third" ? 'selected' : '' }}>Third</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="college_city">
                                                            College City
                                                        </label>
                                                        <input type="text" class="form-control" value="{{ isset($education->college_city) && $education->college_city != null ? $education->college_city : old('college_city') }}" id="college_city" name="college_city" placeholder="Enter College City" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="college_state">
                                                            College State
                                                        </label>
                                                        <input type="text" class="form-control" value="{{ isset($education->college_state) && $education->college_state != null ? $education->college_state : old('college_state') }}" id="college_state" name="college_state" placeholder="Enter College State" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <a class=" text-white fw-600 collapsed">Grades</a>
                                </div>
                                <div id="collapseThree" class="collapse {{ $errors->first('cumulative_gpa_unweighted') || $errors->first('cumulative_gpa_weighted') || $errors->first('cumulative_gpa_unweighted') ? 'show' : '' }}" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="cumulative_gpa_unweighted">Cumulative
                                                            GPA
                                                            (UNWEIGHTED) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="cumulative_gpa_unweighted" value="{{ isset($education->cumulative_gpa_unweighted) && $education->cumulative_gpa_unweighted != null ? $education->cumulative_gpa_unweighted : old('cumulative_gpa_unweighted') }}" name="cumulative_gpa_unweighted" placeholder="Enter Cumulative GPA (UNWEIGHTED)">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="cumulative_gpa_weighted">Cumulative
                                                            GPA
                                                            (WEIGHTED) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="cumulative_gpa_weighted" value="{{ isset($education->cumulative_gpa_weighted) && $education->cumulative_gpa_weighted != null ? $education->cumulative_gpa_weighted : old('cumulative_gpa_weighted') }}" name="cumulative_gpa_weighted" placeholder="Enter Cumulative GPA (WEIGHTED)">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <a class="text-white fw-600 collapsed">Class Rank</a>
                                </div>
                                <div id="collapseFour" class="collapse {{ $errors->first('class_rank') || $errors->first('total_no_of_student') ? 'show' : '' }}" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="class_rank">
                                                            Class Rank
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" value="{{ isset($education->class_rank) && $education->class_rank != null ? $education->class_rank : old('class_rank') }}" id="class_rank" name="class_rank" placeholder="Enter Class Rank">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="total_no_of_student">
                                                            Total Number Of Student
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" class="form-control" value="{{ isset($education->total_no_of_student) && $education->total_no_of_student != null ? $education->total_no_of_student : old('total_no_of_student') }}" id="total_no_of_student" name="total_no_of_student" placeholder="Enter Total Number Of Students">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    <a class=" text-white fw-600 collapsed">Courses</a>
                                </div>
                                <div id="collapseFive" class="collapse" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6 select2-container_main">
                                                    <div>
                                                        <label class="form-label" for="ib_courses">
                                                            IB Courses
                                                            <span class="text-danger">*</span>
                                                        </label><br>
                                                        <select class="js-select2 select" id="ib_courses" name="ib_courses[]" multiple="multiple" >
                                                            @foreach($courses_list as $course_list)
                                                                @if($course_list->course_type == 1)
                                                                    <option value="{{ $course_list->id }}" {{ (!empty($education->ib_courses) && in_array($course_list->id,json_decode($education->ib_courses))) || in_array($course_list->id, is_array(old('ib_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>{{ $course_list->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 select2-container_main">
                                                    <div>
                                                        <label class="form-label" for="ap_courses">
                                                            AP Courses
                                                            <span class="text-danger">*</span>
                                                        </label><br>
                                                        <select class="required js-select2 select" id="ap_courses" name="ap_courses[]" multiple="multiple">
                                                            @foreach($courses_list as $course_list)
                                                                @if($course_list->course_type == 2)
                                                                    <option value="{{ $course_list->id }}" {{ (!empty($education->ap_courses) && in_array($course_list->id,json_decode($education->ap_courses))) || in_array($course_list->id, is_array(old('ap_courses')) ? old('ap_courses') : []) ? 'selected' : '' }}>{{ $course_list->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table course_table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label class="form-label" for="course_name">
                                                                Course Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                        </td>
                                                        
                                                        <td>
                                                            <label class="form-label" for="search_college_name">

                                                                Search College Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label">Action</label><br>
                                                        </td>
                                                    </tr>
                                                    @if (!empty($education->course_data))
                                                        @foreach($education->course_data as $index => $course_data) 
                                                            <tr class="course_data_table_row {{ $loop->first ? '' : 'remove_courses' }}">
                                                                <td>
                                                                    <input type="text" class="form-control" value="{{ $course_data['course_name'] }}" id="course_name" name="course_data[{{ $index }}][course_name]" placeholder="Ex: College English 101">
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" name="course_data[{{ $index }}][search_college_name]" id="search_college_name">
                                                                        <option value="">Search College Name</option>
                                                                        <option {{ $course_data['search_college_name'] == "first" ? 'selected' : "" }} value="first">First</option>
                                                                        <option {{ $course_data['search_college_name'] == "second" ? 'selected' : "" }} value="second">Second</option>
                                                                        <option {{ $course_data['search_college_name'] == "third" ? 'selected' : "" }} value="third">Third</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn d-flex plus-icon">
                                                                        <i data-count="{{ count($education->course_data) != 0 ? count($education->course_data) - 1 : 0 }}" class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}" onclick="{{ $loop->first ? 'addCourseData(this)' : 'removeCourses(this)' }}"></i>
                                                                    </a>
                                                                </td>                                                                
                                                            </tr>
                                                        @endforeach                                                    
                                                    @else
                                                        <tr class="course_data_table_row">
                                                            <td>
                                                                <input type="text" class="form-control" id="course_name" name="course_data[0][course_name]" placeholder="Ex: College English 101">
                                                            </td>
                                                            <td>
                                                                <select class="required form-control" name="course_data[0][search_college_name]">
                                                                    <option value="">Search College Name</option>
                                                                    <option {{ old('search_college_name') == "first" ? 'selected' : "" }} value="first">First</option>
                                                                    <option {{ old('search_college_name') == "second" ? 'selected' : "" }} value="second">Second</option>
                                                                    <option {{ old('search_college_name') == "third" ? 'selected' : "" }} value="third">Third</option>
                                                                </select>
                                                            </td>   
                                                            <td>
                                                                <a href="javascript:void(0)" data-count="0" onclick="addCourseData(this)" class="add-btn d-flex plus-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <table class="table honors_table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="honors_course_name">
                                                        Honors Course Name
                                                        <span class="text-danger">*</span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-label">Action</label><br>
                                                    </td>
                                                </tr>
                                                @if (!empty($education->honor_course_data))
                                                    @foreach ($education->honor_course_data as $index => $honor_course_data)
                                                        <tr class="honor_course_data_table_row {{ $loop->first ? '' : 'remove_honors_courses' }}"> 
                                                            <td>                                                        
                                                                <input type="text" value="{{ $honor_course_data['course_data'] }}" class="form-control" name="honor_course_data[{{ $index }}][course_data]" placeholder="Ex: College English 101">
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                    <i data-count="{{ count($education->honor_course_data) != 0 ? count($education->honor_course_data) - 1 : 0 }}" class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}" onclick="{{ $loop->first ? 'addHonorCourseData(this)' : 'removeHonorsCourses(this)' }}"></i>
                                                                </a>                                                        
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="honor_course_data_table_row"> 
                                                        <td>                                                        
                                                            <input type="text" class="form-control" value="{{ old('honors_course_name') }}" id="honors_course_name" name="honor_course_data[0][course_data]" placeholder="Ex: College English 101">
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                <i data-count="0" class="fa-solid fa-plus" onclick="addHonorCourseData(this)"></i>
                                                            </a>                                                        
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    <a class=" text-white fw-600 collapsed">Testing</a>
                                </div>
                                <div id="collapseSix" class="collapse {{ $errors->first('testing_data') ? 'show' : '' }}" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <table class="table testing_data_table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label class="form-label" for="name_of_test">
                                                                Name Of Test
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label" for="results_score">
                                                                Results Score
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label" for="date">
                                                                Date
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label">Action</label><br>
                                                        </td>
                                                    </tr>
                                                    @if(!empty($education->testing_data))
                                                        @foreach($education->testing_data as $index => $testing_data)
                                                            <tr class="testing_table_row {{ $loop->first ? '' : 'remove_testing_data' }}">
                                                                <td>
                                                                    <input type="text" class="form-control" value="{{ $testing_data['name_of_test'] }}" id="name_of_test" name="testing_data[{{ $index }}][name_of_test]" placeholder="Enter Name of test">
                                                                </td>
                                                                <td>                                                            
                                                                    <input type="text" class="form-control" value="{{ $testing_data['results_score'] }}" id="results_score" name="testing_data[{{ $index }}][results_score]" placeholder="Enter Results score">
                                                                </td>
                                                                <td>                                                            
                                                                    <input type="text" class="form-control" value="{{ $testing_data['date'] }}" id="testing-date-{{ $index }}" name="testing_data[{{ $index }}][date]" placeholder="Enter Date" autocomplete="off">
                                                                </td>
                                                                <td>                                                            
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i data-count="{{ count($education->testing_data) != 0 ? count($education->testing_data) - 1 : 0 }}" class="fa-solid  {{ $loop->first ? 'fa-plus' : 'fa-minus' }}" onclick="{{ $loop->first ? 'addTestingData(this)' : 'removeTestingData(this)' }}"></i>
                                                                    </a>                                                        
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr class="testing_table_row">
                                                            <td>
                                                                <input type="text" class="form-control" value="{{ old('name_of_test') }}" id="name_of_test" name="testing_data[0][name_of_test]" placeholder="Enter Name of test">
                                                            </td>
                                                            <td>                                                            
                                                                <input type="text" class="form-control" value="{{ old('results_score') }}" id="results_score" name="testing_data[0][results_score]" placeholder="Enter Results score">
                                                            </td>
                                                            <td>                                                            
                                                                <input type="text" class="form-control" value="{{ old('date') }}" id="testing-date-0" name="testing_data[0][date]" placeholder="Enter Date" autocomplete="off">
                                                            </td>
                                                            <td>                                                            
                                                                <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                    <i data-count="0" class="fa-solid fa-plus" onclick="addTestingData(this)"></i>
                                                                </a>                                                        
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                    <a class=" text-white fw-600 collapsed">Future Plans</a>
                                </div>
                                <div id="collapseSeven" class="collapse {{ $errors->first('intended_college_major') || $errors->first('intended_college_minor') ? 'show' : '' }}" aria-labelledby="headingOne" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="intended_college_major">
                                                            Intended College Major
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-select" id="intended_college_major" name="intended_college_major" style="width: 100%;">
                                                            <option value="">Select Intended College Major</option>
                                                            <option value="Test" {{ (isset($education->intended_college_major) && $education->intended_college_major != null ? $education->intended_college_major : old('intended_college_minor')) == 'Test' ? 'selected' : '' }}>Test</option>
                                                            <option value="Demo" {{ (isset($education->intended_college_major) && $education->intended_college_major != null ? $education->intended_college_major : old('intended_college_minor')) == 'Demo' ? 'selected' : '' }}>Demo</option>
                                                            <option value="Temp" {{ (isset($education->intended_college_major) && $education->intended_college_major != null ? $education->intended_college_major : old('intended_college_minor')) == 'Temp' ? 'selected' : '' }}>Temp</option>
                                                        </select>
                                                      
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="intended_college_minor">
                                                            Intended College Minor
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-select " id="intended_college_minor" name="intended_college_minor" style="width: 100%;">
                                                            <option value="">Select Intended College Minor</option>
                                                            <option value="Test" {{ (isset($education->intended_college_minor) && $education->intended_college_minor != null ? $education->intended_college_minor : old('intended_college_minor')) == 'Test' ? 'selected' : '' }}>Test</option>
                                                            <option value="Demo" {{ (isset($education->intended_college_minor) && $education->intended_college_minor != null ? $education->intended_college_minor : old('intended_college_minor')) == 'Demo' ? 'selected' : '' }}>Demo</option>
                                                            <option value="Temp" {{ (isset($education->intended_college_minor) && $education->intended_college_minor != null ? $education->intended_college_minor : old('intended_college_minor')) == 'Temp' ? 'selected' : '' }}>Temp</option>
                                                        </select>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="prev-btn">
                        <a href="{{ isset($resume_id) ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.personalInfo') }}" class="btn btn-alt-success prev-step"> Previous Step
                        </a>
                    </div>
                    <div class="next-btn d-flex">
                        @if (!isset($resume_id))
                            <div>
                                @include('components.reset-all-drafts-button')
                            </div>
                        @endif
                        <input type="submit" class="btn btn-alt-success next-step" value="Next Step">
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <style>
        .swal2-styled.swal2-default-outline:focus {
            box-shadow: none;
        }
        .swal2-icon.swal2-warning {
            border-color: #f27474;
            color: #f27474;
        }
       
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    
    <script>    
        // var courseData = [];
        // var honorCourseData = [];
        // var testingData = [];

        $('.year-own').datepicker({
            minViewMode: 2,
            format: 'yyyy'
        });

        $('.month-own').datepicker({
            minViewMode: "months",
            startView: "months", 
            format: 'mm'
        });

        let total_testing_count = "{{ isset($education->testing_data) ? count($education->testing_data) : 0 }}";

        $(document).ready(() => {
            if(total_testing_count > 0) {
                for (let index = 0; index < total_testing_count; index++) {
                    $(`#testing-date-${index}`).datepicker({
                        format: 'dd-mm-yyyy',
                        startDate: '-3d'
                    });
                }
            } else {
                $('#testing-date-0').datepicker({
                    format: 'dd-mm-yyyy',
                    startDate: '-3d'
                });
            }

            $(".select").select2({
                tags: true,
            });
        });

        $(document).ready(function() {
            let validations_rules = @json($validations_rules);
            let validations_messages = @json($validations_messages);
            // console.log(validations_rules, validations_messages);
            
            $("#education_form").validate({
                rules: validations_rules,
                messages: validations_messages,
                ignore: false,
                submitHandler: function(form) {
                    form.submit();
                },
                errorPlacement: function(error, element) {
                    console.log(error, element);
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                        element.parents().find('.collapse').addClass('show');
                    }
                }
            });

            let course_data = $('input[name^="course_data"]');

            course_data.filter('input[name$="[course_name]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Course name field is required"
                    }
                });
            });
            course_data.filter('input[name$="[search_college_name]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Search college name field is required"
                        
                    }
                });
            });

            let honor_course_data = $('input[name^="honor_course_data"]');

            honor_course_data.filter('input[name$="[course_data]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Honors course name field is required"
                    }
                });
            });

            let testing_data = $('input[name^="testing_data"]');

            testing_data.filter('input[name$="[name_of_test]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Name of test field is required"
                    }
                });
            });
            testing_data.filter('input[name$="[results_score]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Result score field is required"
                    }
                });
            });
            testing_data.filter('input[name$="[date]"]').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Date field is required"
                    }
                });
            });
        });

        $(document).on('change', '#is_graduate', function(){
            if(this.checked){
                $('#grade_level').attr('disabled',true);
                $('#college_name').attr('disabled',true);
                $('#college_city').attr('disabled',true);
                $('#college_state').attr('disabled',true);
            } else {
                $('#grade_level').attr('disabled',false);
                $('#college_name').attr('disabled',false);
                $('#college_city').attr('disabled',false);
                $('#college_state').attr('disabled',false);
            }
        });
        
        function errorMsg()
        {
            Swal.fire({
                title: 'Complete Current Step',
                text: "You Have to submit current form",
                icon: 'warning',
                confirmButtonColor: '#F27474',
                confirmButtonText: 'Okay'
            }).then((result) => {
                window.location.href = "{{ route('admin-dashboard.highSchoolResume.educationInfo') }}";
            });
        }

        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    </script>
@endsection