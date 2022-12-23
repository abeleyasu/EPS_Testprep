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
            <form class="js-validation" id="form" action="{{ isset($education) && $education != null ? route('admin-dashboard.highSchoolResume.educationInfo.update',$education->id) : route('admin-dashboard.highSchoolResume.educationInfo.store') }}" method="POST">
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
                                                        <input type="text" class="form-control @error('current_grade') is-invalid @enderror" value="{{ isset($education->current_grade) && $education->current_grade != null ? $education->current_grade : old('current_grade') }}" id="current_grade" name="current_grade" placeholder="Enter Current Grade">
                                                        @error('current_grade')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="month">Month
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input class="month-own form-control @error('month') is-invalid @enderror" id="month" name="month" value="{{ isset($education->month) && $education->month != null ? $education->month : old('month') }}" style="width: 100%;" type="text" autocomplete="off">
                                                        @error('month')
                                                            <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="year">Year
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input class="year-own form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ isset($education->year)  && $education->year != null  ? $education->year : old('year') }}" style="width: 100%;" type="text" autocomplete="off">
                                                        @error('year')
                                                            <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_name">High School
                                                            Name <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('high_school_name') is-invalid @enderror" id="high_school_name" value="{{ isset($education->high_school_name) && $education->high_school_name != null ? $education->high_school_name : old('high_school_name') }}" name="high_school_name" placeholder="Enter High School name">
                                                        @error('high_school_name')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_city">High School
                                                            City <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('high_school_city') is-invalid @enderror" id="high_school_city" value="{{ isset($education->high_school_city) && $education->high_school_city != null ? $education->high_school_city : old('high_school_city') }}" name="high_school_city" placeholder="Enter High School City">
                                                        @error('high_school_city')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_state">High School
                                                            State <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('high_school_state') is-invalid @enderror" id="high_school_state" value="{{ isset($education->high_school_state) && $education->high_school_state != null ? $education->high_school_state : old('high_school_state') }}" name="high_school_state" placeholder="Enter High School State">
                                                        @error('high_school_state')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_district">High
                                                            School
                                                            District <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('high_school_district') is-invalid @enderror" id="high_school_district" value="{{ isset($education->high_school_district) && $education->high_school_district != null ? $education->high_school_district : old('high_school_district') }}" name="high_school_district" placeholder="Enter High School District">
                                                        @error('high_school_district')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('cumulative_gpa_unweighted') is-invalid @enderror" id="cumulative_gpa_unweighted" value="{{ isset($education->cumulative_gpa_unweighted) && $education->cumulative_gpa_unweighted != null ? $education->cumulative_gpa_unweighted : old('cumulative_gpa_unweighted') }}" name="cumulative_gpa_unweighted" placeholder="Enter Cumulative GPA (UNWEIGHTED)">
                                                        @error('cumulative_gpa_unweighted')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="cumulative_gpa_weighted">Cumulative
                                                            GPA
                                                            (WEIGHTED) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control @error('cumulative_gpa_weighted') is-invalid @enderror" id="cumulative_gpa_weighted" value="{{ isset($education->cumulative_gpa_weighted) && $education->cumulative_gpa_weighted != null ? $education->cumulative_gpa_weighted : old('cumulative_gpa_weighted') }}" name="cumulative_gpa_weighted" placeholder="Enter Cumulative GPA (WEIGHTED)">
                                                        @error('cumulative_gpa_weighted')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('class_rank') is-invalid @enderror" value="{{ isset($education->class_rank) && $education->class_rank != null ? $education->class_rank : old('class_rank') }}" id="class_rank" name="class_rank" placeholder="Enter Class Rank">
                                                        @error('class_rank')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="total_no_of_student">
                                                            Total Number Of Student
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" class="form-control @error('total_no_of_student') is-invalid @enderror" value="{{ isset($education->total_no_of_student) && $education->total_no_of_student != null ? $education->total_no_of_student : old('total_no_of_student') }}" id="total_no_of_student" name="total_no_of_student" placeholder="Enter Total Number Of Students">
                                                        @error('total_no_of_student')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
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
                                <div id="collapseFive" class="collapse {{ $errors->first('ib_courses') || $errors->first('ap_courses') || $errors->first('course_name') || $errors->first('course_data') || $errors->first('honor_course_data') ? 'show' : '' }}" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="ib_courses">
                                                            IB Courses
                                                            <span class="text-danger">*</span>
                                                        </label><br>
                                                        <select class="js-select2 select @error('ib_courses') is-invalid @enderror" id="ib_courses" name="ib_courses[]" multiple="multiple">
                                                            @foreach($courses_list as $course_list)
                                                                @if($course_list->course_type == 1)
                                                                    <option value="{{ $course_list->id }}" {{ (!empty($education->ib_courses) && in_array($course_list->id,json_decode($education->ib_courses))) || in_array($course_list->id, is_array(old('ib_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>{{ $course_list->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('ib_courses')
                                                            <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="ap_courses">
                                                            AP Courses
                                                            <span class="text-danger">*</span>
                                                        </label><br>
                                                        <select class="js-select2 select @error('ap_courses') is-invalid @enderror" id="ap_courses" name="ap_courses[]" multiple="multiple">
                                                            @foreach($courses_list as $course_list)
                                                                @if($course_list->course_type == 2)
                                                                    <option value="{{ $course_list->id }}" {{ (!empty($education->ap_courses) && in_array($course_list->id,json_decode($education->ap_courses))) || in_array($course_list->id, is_array(old('ap_courses')) ? old('ap_courses') : []) ? 'selected' : '' }}>{{ $course_list->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('ap_courses')
                                                            <span class="invalid">{{ $message }}</span>
                                                        @enderror
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
                                                                <select class="form-control" name="course_data[0][search_college_name]" id="search_college_name">
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
                                                                <input type="text" value="{{ $honor_course_data['course_data'] }}" class="form-control" id="honors_course_name" name="honor_course_data[{{ $index }}][course_data]" placeholder="Ex: College English 101">
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
                                                        <select class="form-select @error('intended_college_major') is-invalid @enderror" id="intended_college_major" name="intended_college_major" style="width: 100%;">
                                                            <option value="">Select Intended College Major</option>
                                                            <option value="Test" {{ (isset($education->intended_college_major) && $education->intended_college_major != null ? $education->intended_college_major : old('intended_college_minor')) == 'Test' ? 'selected' : '' }}>Test</option>
                                                            <option value="Demo" {{ (isset($education->intended_college_major) && $education->intended_college_major != null ? $education->intended_college_major : old('intended_college_minor')) == 'Demo' ? 'selected' : '' }}>Demo</option>
                                                            <option value="Temp" {{ (isset($education->intended_college_major) && $education->intended_college_major != null ? $education->intended_college_major : old('intended_college_minor')) == 'Temp' ? 'selected' : '' }}>Temp</option>
                                                        </select>
                                                        @error('intended_college_major')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="intended_college_minor">
                                                            Intended College Minor
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-select @error('intended_college_minor') is-invalid @enderror" id="intended_college_minor" name="intended_college_minor" style="width: 100%;">
                                                            <option value="">Select Intended College Minor</option>
                                                            <option value="Test" {{ (isset($education->intended_college_minor) && $education->intended_college_minor != null ? $education->intended_college_minor : old('intended_college_minor')) == 'Test' ? 'selected' : '' }}>Test</option>
                                                            <option value="Demo" {{ (isset($education->intended_college_minor) && $education->intended_college_minor != null ? $education->intended_college_minor : old('intended_college_minor')) == 'Demo' ? 'selected' : '' }}>Demo</option>
                                                            <option value="Temp" {{ (isset($education->intended_college_minor) && $education->intended_college_minor != null ? $education->intended_college_minor : old('intended_college_minor')) == 'Temp' ? 'selected' : '' }}>Temp</option>
                                                        </select>
                                                        @error('intended_college_minor')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
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
                        <input type="button" class="btn btn-alt-success next-step" value="Next Step" onclick="checkValidation()">
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
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
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script>
        var courseData = [];
        var honorCourseData = [];
        var testingData = [];

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

        function checkValidation()
        {
            let site_url = $('#site_url').val();
            let education = $('#education').val();
            let resume_id = $('#resume_id').val();
            let url = `${site_url}/user/admin-dashboard/high-school-resume/education-info/store`;
            
            let data = $("#form").serializeArray();

            let formData = new FormData();

            $.each(data, function(key, value) {
                formData.append(value['name'], value['value']);
            });

            if(education){
                url = `${site_url}/user/admin-dashboard/high-school-resume/education-info/${education}`
            }
                $.ajax({
                    url : url,
                    type : 'POST',
                    datatype : 'json',
                    data : formData, 
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.success){
                            if (resume_id) {
                                window.location.href = `${site_url}/user/admin-dashboard/high-school-resume/honors?resume_id=${resume_id}`;
                                education = nulll;
                            }else{
                                window.location.href = `${site_url}/user/admin-dashboard/high-school-resume/honors`;
                            }
                        }
                    },
                    error:function(error){
                        if (error.responseJSON != null) {
                            // console.log(error.responseJSON.errors);
                            $.each(error.responseJSON.errors , function(key,value){
                                toastr.error(value);
                            });
                        }
                    }
                });
        }   

        // function addCourseData(data) {
        //     let course_name = $('input[name="course_name"]').val();
        //     let search_college_name = $('#search_college_name').val();
        //     let temp_course_id = Date.now();

        //     let course = $('#course_data').val();
        //     if(course != "") {
        //         courseData = JSON.parse($('#course_data').val());
        //     }

        //     let html = ``;
        //     if (course_name != "" && search_college_name != "") {
        //         html += `<tr id="course_${temp_course_id}">`;
        //         html += `<td class="course_name">${course_name}</td>`;
        //         html += `<td class="search_college_name">${search_college_name}</td>`;
        //         html += `<td>`;
        //         html += `<i class="fa-solid fa-pen me-2" data-id="${temp_course_id}" onclick="course_edit_model(this)"></i>`;
        //         html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_course_id}" onclick="course_model_remove(this)"></i>`;
        //         html += `</td>`;

        //         courseData.push({
        //             "id": temp_course_id,
        //             "course_name": course_name,
        //             "search_college_name": search_college_name
        //         });
        //     } else {
        //         toastr.error('Please Enter Course Name & College name');
        //     }
        //     $('.course_data_table_row').after(html);
        //     $('input[name="course_name"]').val('');
        //     $('#search_college_name').val('');
        //     $('#course_data').val(JSON.stringify(courseData));
        // }

        // function course_edit_model(data) {
        //     let course_data = $('#course_data').val();
        //     course_data = JSON.parse(course_data);
        //     let id = $(data).attr('data-id');
        //     let course_result = course_data.find(course => course.id == id);
        //     $('#course_modal_name').val(course_result.course_name);
        //     $('#course_modal_college_name').val(course_result.search_college_name);
        //     $('#updateCourseForm').attr('data-id', id);
        //     $('#course_name_modal').modal('show');
        // }

        // function updateCourseForm(data) {
        //     let id = $(data).attr('data-id');
        //     let course_name = $('#course_modal_name').val();
        //     let search_college_name = $('#course_modal_college_name').val();
        //     let course_data = $('#course_data').val();
        //     course_data = JSON.parse(course_data);
        //     for (let i = 0; i < course_data.length; i++) {
        //         if (course_data[i].id == id) {
        //             course_data[i].course_name = course_name
        //             course_data[i].search_college_name = search_college_name
        //         }
        //     }
        //     $('#course_data').val(JSON.stringify(course_data));
        //     $(`#course_${id} .course_name`).text(course_name);
        //     $(`#course_${id} .search_college_name`).text(search_college_name);
        //     $('#course_name_modal').modal('hide');
        // }

        // function course_model_remove(data) {
        //     let id = $(data).attr('data-id');
        //     let course_data = $('#course_data').val();
        //     course_data = JSON.parse(course_data);
        //     const deleted_course = course_data.filter(course => course.id != id)
        //     $('#course_data').val(JSON.stringify(deleted_course));
        //     $(`#course_${id}`).remove();

        //     if ($('#course_data').val() == '[]') {
        //         $('#course_data').val(null);
        //     }
                
        // }

        // function addHonorCourseData(data) {

        //     let honor_course_name = $('input[name="honors_course_name"]').val();
        //     let temp_honor_course_id = Date.now();

        //     let honor = $('#honor_course_data').val();
        //     if(honor != "") {
        //         honorCourseData = JSON.parse($('#honor_course_data').val());
        //     }
        //     let html = ``;
        //     if (honor_course_name != "") {
        //         html += `<tr id="honor_course_${temp_honor_course_id}">`;
        //         html += `<td class="honor_course_name">${honor_course_name}</td>`;
        //         html += `<td>`;
        //         html += `<i class="fa-solid fa-pen me-2" data-id="${temp_honor_course_id}" onclick="honor_course_edit_model(this)"></i>`;
        //         html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_honor_course_id}" onclick="honor_course_model_remove(this)"></i>`;
        //         html += `</td>`;

        //         honorCourseData.push({
        //             "id": temp_honor_course_id,
        //             "honor_course_name": honor_course_name
        //         });
        //     } else {
        //         toastr.error    ('Please Enter Honor Course Name');
        //     }

        //     $('.honor_course_data_table_row').after(html);
        //     $('input[name="honors_course_name"]').val('');
        //     $('#honor_course_data').val(JSON.stringify(honorCourseData));
        // }

        // function honor_course_edit_model(data) {
        //     let honor_course_data = $('#honor_course_data').val();
        //     honor_course_data = JSON.parse(honor_course_data);
        //     let id = $(data).attr('data-id');
        //     let honor_course_result = honor_course_data.find(course => course.id == id);
        //     $('#honors_course_modal_name').val(honor_course_result.honor_course_name);
        //     $('#updateHonorCourseForm').attr('data-id', id);
        //     $('#honors_course').modal('show');
        // }

        // function updateHonorCourseForm(data) {
        //     let id = $(data).attr('data-id');
        //     let honor_course_name = $('#honors_course_modal_name').val();
        //     let honor_course_data = $('#honor_course_data').val();
        //         honor_course_data = JSON.parse(honor_course_data);
        //     for (let i = 0; i < honor_course_data.length; i++) {
        //         if (honor_course_data[i].id == id) {
        //             honor_course_data[i].honor_course_name = honor_course_name
        //         }
        //     }
        //     $('#honor_course_data').val(JSON.stringify(honor_course_data));
        //     $(`#honor_course_${id} .honor_course_name`).text(honor_course_name);
        //     $('#honors_course').modal('hide');
        // }

        // function honor_course_model_remove(data) {
        //     let id = $(data).attr('data-id');
        //     let honor_course_data = $('#honor_course_data').val();
        //         honor_course_data = JSON.parse(honor_course_data);
        //     const deleted_honor_course = honor_course_data.filter(course => course.id != id)
        //     $('#honor_course_data').val(JSON.stringify(deleted_honor_course));
        //     $(`#honor_course_${id}`).remove();

        //     if ($('#honor_course_data').val() == '[]') {
        //         $('#honor_course_data').val(null);
        //     }
        // }

        // function addTestingData(data) {
        //     let name_of_test = $('input[name="name_of_test"]').val();
        //     let results_score = $('input[name="results_score"]').val();
        //     let date = $('input[name="date"]').val();
        //     let temp_testing_id = Date.now();

        //     let testing = $('#testing_data').val();
        //     if(testing != "") {
        //         testingData = JSON.parse($('#testing_data').val());
        //     }
        //     let html = ``;
        //     if (name_of_test != "" && results_score != "" && date != "") {
        //         html += `<tr id="testing_${temp_testing_id}">`;
        //         html += `<td class="name_of_test">${name_of_test}</td>`;
        //         html += `<td class="results_score">${results_score}</td>`;
        //         html += `<td class="date">${date}</td>`;
        //         html += `<td>`;
        //         html += `<i class="fa-solid fa-pen me-2" data-id="${temp_testing_id}" onclick="testing_edit_model(this)"></i>`;
        //         html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_testing_id}" onclick="testing_model_remove(this)"></i>`;
        //         html += `</td>`;

        //         testingData.push({
        //             "id": temp_testing_id,
        //             "name_of_test": name_of_test,
        //             "results_score": results_score,
        //             "date": date
        //         });
        //     } else {
        //         toastr.error('Please Enter Testing Details');
        //     }

        //     $('.testing_table_row').after(html);
        //     $('input[name="name_of_test"]').val('');
        //     $('input[name="results_score"]').val('');
        //     $('input[name="date"]').val('');
        //     $('#testing_data').val(JSON.stringify(testingData));
        // }

        // function testing_edit_model(data) {
        //     let testing_data = $('#testing_data').val();
        //         testing_data = JSON.parse(testing_data);
        //     let id = $(data).attr('data-id');
        //     let testing_result = testing_data.find(testing => testing.id == id);
        //     $('#testing_name_of_test').val(testing_result.name_of_test);
        //     $('#testing_results_score').val(testing_result.results_score);
        //     $('#testing_date').val(testing_result.date);
        //     $('#updateTestingForm').attr('data-id', id);
        //     $('#testing_course').modal('show');
        // }

        // function updateTestingForm(data) {
        //     let id = $(data).attr('data-id');
        //     let name_of_test = $('#testing_name_of_test').val();
        //     let results_score = $('#testing_results_score').val();
        //     let date = $('#testing_date').val();

        //     let testing_data = $('#testing_data').val();
        //         testing_data = JSON.parse(testing_data);
        //     for (let i = 0; i < testing_data.length; i++) {
        //         if (testing_data[i].id == id) {
        //             testing_data[i].name_of_test = name_of_test
        //             testing_data[i].results_score = results_score
        //             testing_data[i].date = date
        //         }
        //     }
        //     $('#testing_data').val(JSON.stringify(testing_data));
        //     $(`#testing_${id} .name_of_test`).text(name_of_test);
        //     $(`#testing_${id} .results_score`).text(results_score);
        //     $(`#testing_${id} .date`).text(date);
        //     $('#testing_course').modal('hide');
        // }

        // function testing_model_remove(data) {
        //     let id = $(data).attr('data-id');
        //     let testing_data = $('#testing_data').val();
        //         testing_data = JSON.parse(testing_data);
        //     const deleted_testing = testing_data.filter(testing => testing.id != id)
        //     $('#testing_data').val(JSON.stringify(deleted_testing));
        //     $(`#testing_${id}`).remove();
        //     if ($('#testing_data').val() == '[]') {
        //         $('#testing_data').val(null);
        //     }
        // }

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
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
@endsection