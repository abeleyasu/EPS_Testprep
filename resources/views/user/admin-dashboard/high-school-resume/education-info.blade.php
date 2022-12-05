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
                    <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}" id="step1-tab">
                        <p class="d-none">1</p>
                        <i class="fa-solid fa-check fa-check-block "></i>
                        <h6>Personal Info</h6>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}" id="step2-tab">
                        <p>2</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Education </h6>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="javascript:void(0)" id="step3-tab">
                        <p>3</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Honors </h6>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="javascript:void(0)" id="step4-tab">
                        <p>4</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Activities</h6>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="javascript:void(0)" id="step5-tab">
                        <p>5</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Employment & <br> Certifications</h6>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="javascript:void(0)" id="step6-tab">
                        <p>6</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Featured <br> Attributes</h6>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="javascript:void(0)" id="step7-tab">
                        <p>7</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Preview</h6>
                    </a>
                </li>
            </ul>
        
            <form class="js-validation" action="{{ isset($education) ? route('admin-dashboard.highSchoolResume.educationInfo.update',$education->id) : route('admin-dashboard.highSchoolResume.educationInfo.store') }}" method="POST">
                @csrf
                @if(isset($education))
                    @method('PUT')
                @endif
                <div class="tab-content" id="myTabContent">
                    <div class="setup-content" role="tabpanel" id="step2" aria-labelledby="step2-tab">
                        <div class="accordion accordionExample2">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <a class="text-white fw-600 collapsed"> High school information</a>
                                </div>
                                <div id="collapseOne" class="collapse {{ $errors->first('current_grade') || $errors->first('month') || $errors->first('year') || $errors->first('high_school_name') || $errors->first('high_school_city') || $errors->first('high_school_state') || $errors->first('high_school_district') || $errors->first('high_school_district') ? 'show' : '' }}" aria-labelledby="headingOne" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="current_grade">Current
                                                            Grade
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('current_grade') is-invalid @enderror" value="{{ isset($education->current_grade) ? $education->current_grade : old('current_grade') }}" id="current_grade" name="current_grade" placeholder="Enter Current Grade">
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
                                                        <input class="month-own form-control @error('month') is-invalid @enderror" id="month" name="month" value="{{ isset($education->month) ? $education->month : old('month') }}" style="width: 100%;" type="text" autocomplete="off">
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
                                                        <input class="year-own form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ isset($education->year) ? $education->year : old('year') }}" style="width: 100%;" type="text" autocomplete="off">
                                                        @error('year')
                                                            <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_name">High School
                                                            name <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('high_school_name') is-invalid @enderror" id="high_school_name" value="{{ isset($education->high_school_name) ? $education->high_school_name : old('high_school_name') }}" name="high_school_name" placeholder="Enter High School name">
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
                                                        <input type="text" class="form-control @error('high_school_city') is-invalid @enderror" id="high_school_city" value="{{ isset($education->high_school_city) ? $education->high_school_city : old('high_school_city') }}" name="high_school_city" placeholder="Enter High School City">
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
                                                        <input type="text" class="form-control @error('high_school_state') is-invalid @enderror" id="high_school_state" value="{{ isset($education->high_school_state) ? $education->high_school_state : old('high_school_state') }}" name="high_school_state" placeholder="Enter High School State">
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
                                                        <input type="text" class="form-control @error('high_school_district') is-invalid @enderror" id="high_school_district" value="{{ isset($education->high_school_district) ? $education->high_school_district : old('high_school_district') }}" name="high_school_district" placeholder="Enter High School District">
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
                                    <a class="text-white fw-600 collapsed">College information</a>
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
                                                        <input type="text" class="form-control" value="{{ isset($education->grade_level) ? $education->grade_level : old('grade_level') }}" id="grade_level" name="grade_level" placeholder="Enter Grade level" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="college_name">
                                                            College Name
                                                        </label>
                                                        <select class="form-control" id="college_name" name="college_name" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'disabled' : '' }}>
                                                            <option value="">Select College Name</option>
                                                            <option value="one" {{ isset($education->college_name) && $education->college_name == "one" ? 'selected' : '' }}>First</option>
                                                            <option value="two" {{ isset($education->college_name) && $education->college_name == "two" ? 'selected' : '' }}>Second</option>
                                                            <option value="three" {{ isset($education->college_name) && $education->college_name == "three" ? 'selected' : '' }}>Third</option>
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
                                                        <input type="text" class="form-control" value="{{ isset($education->college_city) ? $education->college_city : old('college_city') }}" id="college_city" name="college_city" placeholder="Enter College City" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="college_state">
                                                            College State
                                                        </label>
                                                        <input type="text" class="form-control" value="{{ isset($education->college_state) ? $education->college_state : old('college_state') }}" id="college_state" name="college_state" placeholder="Enter College State" {{ isset($education->is_graduate) && $education->is_graduate == 1 ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <a class=" text-white fw-600 collapsed">Contact information</a>
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
                                                        <input type="text" class="form-control @error('cumulative_gpa_unweighted') is-invalid @enderror" id="cumulative_gpa_unweighted" value="{{ isset($education->cumulative_gpa_unweighted) ? $education->cumulative_gpa_unweighted : old('cumulative_gpa_unweighted') }}" name="cumulative_gpa_unweighted" placeholder="Enter Cumulative GPA (UNWEIGHTED)">
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
                                                        <input type="text" class="form-control @error('cumulative_gpa_weighted') is-invalid @enderror" id="cumulative_gpa_weighted" value="{{ isset($education->cumulative_gpa_weighted) ? $education->cumulative_gpa_weighted : old('cumulative_gpa_weighted') }}" name="cumulative_gpa_weighted" placeholder="Enter Cumulative GPA (WEIGHTED)">
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
                                    <a class="text-white fw-600 collapsed">Class rank</a>
                                </div>
                                <div id="collapseFour" class="collapse {{ $errors->first('class_rank') || $errors->first('total_no_of_student') ? 'show' : '' }}" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="class_rank">
                                                            Class rank
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('class_rank') is-invalid @enderror" value="{{ isset($education->class_rank) ? $education->class_rank : old('class_rank') }}" id="class_rank" name="class_rank" placeholder="Enter Class Rank">
                                                        @error('class_rank')
                                                        <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="total_no_of_student">
                                                            Total Number of Student
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" class="form-control @error('total_no_of_student') is-invalid @enderror" value="{{ isset($education->total_no_of_student) ? $education->total_no_of_student : old('total_no_of_student') }}" id="total_no_of_student" name="total_no_of_student" placeholder="Enter Total Number Of Students">
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
                                                            <option value="list 1" {{ (!empty($education->ib_courses) && in_array("list 1",json_decode($education->ib_courses))) || in_array("list 1", is_array(old('ib_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 1</option>
                                                            <option value="list 2" {{ (!empty($education->ib_courses) && in_array("list 2",json_decode($education->ib_courses))) || in_array("list 2", is_array(old('ib_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 2</option>
                                                            <option value="list 3" {{ (!empty($education->ib_courses) && in_array("list 3",json_decode($education->ib_courses))) || in_array("list 3", is_array(old('ib_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 3</option>
                                                            <option value="list 4" {{ (!empty($education->ib_courses) && in_array("list 4",json_decode($education->ib_courses))) || in_array("list 4", is_array(old('ib_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 4</option>
                                                            <option value="list 5" {{ (!empty($education->ib_courses) && in_array("list 5",json_decode($education->ib_courses))) || in_array("list 5", is_array(old('ib_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 5</option>
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
                                                            <option value="list 1" {{ (!empty($education->ap_courses) && in_array("list 1",json_decode($education->ap_courses))) || in_array("list 1", is_array(old('ap_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 1</option>
                                                            <option value="list 2" {{ (!empty($education->ap_courses) && in_array("list 2",json_decode($education->ap_courses))) || in_array("list 2", is_array(old('ap_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 2</option>
                                                            <option value="list 3" {{ (!empty($education->ap_courses) && in_array("list 3",json_decode($education->ap_courses))) || in_array("list 3", is_array(old('ap_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 3</option>
                                                            <option value="list 4" {{ (!empty($education->ap_courses) && in_array("list 4",json_decode($education->ap_courses))) || in_array("list 4", is_array(old('ap_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 4</option>
                                                            <option value="list 5" {{ (!empty($education->ap_courses) && in_array("list 5",json_decode($education->ap_courses))) || in_array("list 5", is_array(old('ap_courses')) ? old('ib_courses') : []) ? 'selected' : '' }}>list 5</option>
                                                        </select>
                                                        @error('ap_courses')
                                                            <span class="invalid">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="course_data" id="course_data" value="{{ !empty($education->course_data) ? $education->course_data : old('course_data') }}">
                                            <table class="table">
                                                <tbody>
                                                    <tr class="course_data_table_row">
                                                        <td>
                                                            <label class="form-label" for="course_name">
                                                                Course Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('course_data') is-invalid @enderror" value="{{ old('course_name') }}" id="course_name" name="course_name" placeholder="Ex: College English 101">
                                                        </td>
                                                        <td>
                                                            <label class="form-label" for="search_college_name">
                                                                Search College Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control @error('course_data') is-invalid @enderror" name="search_college_name" id="search_college_name">
                                                                <option {{ old('search_college_name') == "" ? 'selected' : "" }} value="">Search College Name</option>
                                                                <option {{ old('search_college_name') == "first" ? 'selected' : "" }} value="first">First</option>
                                                                <option {{ old('search_college_name') == "second" ? 'selected' : "" }} value="second">Second</option>
                                                                <option {{ old('search_college_name') == "third" ? 'selected' : "" }} value="third">Third</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <label class="form-label">Action</label><br>
                                                            <a href="javascript:void(0)" onclick="addCourseData(this)" class="add-btn d-flex plus-icon">
                                                                <i class="fa-solid fa-plus @error('course_data') bg-danger @enderror"></i>
                                                                @error('course_data')
                                                                    <span class="ms-2 mt-2 invalid">Click on add icon to insert course data</span>
                                                                @enderror
                                                            </a>
                                                            
                                                        </td>
                                                    </tr>
                                                    @if(!empty($education->course_data))
                                                        @foreach(json_decode($education->course_data) as $course_data) 
                                                            <tr id="course_{{ $course_data->id }}">
                                                                <td class="course_name">{{ $course_data->course_name }}</td>
                                                                <td class="search_college_name">{{ $course_data->search_college_name }}</td>
                                                                <td>
                                                                    <i class="fa-solid fa-pen me-2" data-id="{{ $course_data->id }}" onclick="course_edit_model(this)"></i>
                                                                    <i class="fa-solid fa-circle-xmark" data-id="{{ $course_data->id }}" onclick="course_model_remove(this)"></i>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @elseif(!empty(old('course_data')))
                                                        @foreach(json_decode(old('course_data')) as $course_data) 
                                                            <tr id="course_{{ $course_data->id }}">
                                                                <td class="course_name">{{ $course_data->course_name }}</td>
                                                                <td class="search_college_name">{{ $course_data->search_college_name }}</td>
                                                                <td>
                                                                    <i class="fa-solid fa-pen me-2" data-id="{{ $course_data->id }}" onclick="course_edit_model(this)"></i>
                                                                    <i class="fa-solid fa-circle-xmark" data-id="{{ $course_data->id }}" onclick="course_model_remove(this)"></i>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" name="honor_course_data" id="honor_course_data" value="{{ !empty($education->honor_course_data) ? $education->honor_course_data : old('honor_course_data') }}">
                                        <table class="table">
                                            <tbody>
                                                <tr class="honor_course_data_table_row"> 
                                                    <td>
                                                        <label class="form-label" for="honors_course_name">
                                                            Honors Course Name
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control @error('honor_course_data') is-invalid @enderror" value="{{ old('honors_course_name') }}" id="honors_course_name" name="honors_course_name" placeholder="Ex: College English 101">
                                                    </td>
                                                    <td>
                                                        <label class="form-label">Action</label><br>
                                                        <a href="javascript:void(0)" onclick="addHonorCourseData(this)" class="add-btn plus-icon d-flex">
                                                            <i class="fa-solid fa-plus @error('honor_course_data') bg-danger @enderror"></i>
                                                            @error('honor_course_data')
                                                                <span class="ms-2 mt-2 invalid">Click on add icon to insert Honors course name</span>
                                                            @enderror
                                                        </a>
                                                        
                                                    </td>
                                                </tr>
                                                
                                                @if(!empty($education->honor_course_data))
                                                    @foreach(json_decode($education->honor_course_data) as $honor_course_data)
                                                        <tr id="honor_course_{{ $honor_course_data->id }}">
                                                            <td class="honor_course_name">{{ $honor_course_data->honor_course_name }}</td>
                                                            <td>
                                                                <i class="fa-solid fa-pen me-2" data-id="{{ $honor_course_data->id }}" onclick="honor_course_edit_model(this)"></i>
                                                                <i class="fa-solid fa-circle-xmark" data-id="{{ $honor_course_data->id }}" onclick="honor_course_model_remove(this)"></i>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @elseif(!empty(old('honor_course_data')))
                                                    @foreach(json_decode(old('honor_course_data')) as $honor_course_data)
                                                        <tr id="honor_course_{{ $honor_course_data->id }}">
                                                            <td class="honor_course_name">{{ $honor_course_data->honor_course_name }}</td>
                                                            <td>
                                                                <i class="fa-solid fa-pen me-2" data-id="{{ $honor_course_data->id }}" onclick="honor_course_edit_model(this)"></i>
                                                                <i class="fa-solid fa-circle-xmark" data-id="{{ $honor_course_data->id }}" onclick="honor_course_model_remove(this)"></i>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
                                            <input type="hidden" name="testing_data" id="testing_data" value="{{ !empty($education->testing_data) ? $education->testing_data : old('testing_data') }}">
                                            <table class="table">
                                                <tbody>
                                                    <tr class="testing_table_row">
                                                        <td>
                                                            <label class="form-label" for="name_of_test">
                                                                Name of test
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('testing_data') is-invalid @enderror" value="{{ old('name_of_test') }}" id="name_of_test" name="name_of_test" placeholder="Enter Name of test">
                                                        </td>
                                                        <td>
                                                            <label class="form-label" for="results_score">
                                                                Results Score
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control @error('testing_data') is-invalid @enderror" value="{{ old('results_score') }}" id="results_score" name="results_score" placeholder="Enter Results score">
                                                        </td>
                                                        <td>
                                                            <label class="form-label" for="date">
                                                                Date
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="date-own form-control @error('testing_data') is-invalid @enderror" value="{{ old('date') }}" id="date" name="date" placeholder="Enter Date" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <label class="form-label">Action</label><br>
                                                            <a href="javascript:void(0)" onclick="addTestingData(this)" class="add-btn plus-icon d-flex">
                                                                <i class="fa-solid fa-plus @error('testing_data') bg-danger @enderror"></i>
                                                                @error('testing_data') 
                                                                    <span class="ms-2 mt-2 invalid">Click on add icon to insert Testing data</span>
                                                                @enderror
                                                            </a>
                                                        
                                                        </td>
                                                    </tr>
                                                    @if(!empty($education->testing_data))
                                                        @foreach(json_decode($education->testing_data) as $testing_data)
                                                            <tr id="testing_{{ $testing_data->id }}">
                                                                <td class="name_of_test">{{ $testing_data->name_of_test }}</td>
                                                                <td class="results_score">{{ $testing_data->results_score }}</td>
                                                                <td class="date">{{ $testing_data->date }}</td>
                                                                <td>
                                                                    <i class="fa-solid fa-pen me-2" data-id="{{ $testing_data->id }}" onclick="testing_edit_model(this)"></i>
                                                                    <i class="fa-solid fa-circle-xmark" data-id="{{ $testing_data->id }}" onclick="testing_model_remove(this)"></i>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @elseif(!empty(old('testing_data')))
                                                        @foreach(json_decode(old('testing_data')) as $testing_data)
                                                            <tr id="testing_{{ $testing_data->id }}">
                                                                <td class="name_of_test">{{ $testing_data->name_of_test }}</td>
                                                                <td class="results_score">{{ $testing_data->results_score }}</td>
                                                                <td class="date">{{ $testing_data->date }}</td>
                                                                <td>
                                                                    <i class="fa-solid fa-pen me-2" data-id="{{ $testing_data->id }}" onclick="testing_edit_model(this)"></i>
                                                                    <i class="fa-solid fa-circle-xmark" data-id="{{ $testing_data->id }}" onclick="testing_model_remove(this)"></i>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                    <a class=" text-white fw-600 collapsed">Future plans</a>
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
                                                            <option value="Test" {{ (isset($education->intended_college_major) ? $education->intended_college_major : old('intended_college_minor')) == 'Test' ? 'selected' : '' }}>Test</option>
                                                            <option value="Demo" {{ (isset($education->intended_college_major) ? $education->intended_college_major : old('intended_college_minor')) == 'Demo' ? 'selected' : '' }}>Demo</option>
                                                            <option value="Temp" {{ (isset($education->intended_college_major) ? $education->intended_college_major : old('intended_college_minor')) == 'Temp' ? 'selected' : '' }}>Temp</option>
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
                                                            <option value="Test" {{ (isset($education->intended_college_minor) ? $education->intended_college_minor : old('intended_college_minor')) == 'Test' ? 'selected' : '' }}>Test</option>
                                                            <option value="Demo" {{ (isset($education->intended_college_minor) ? $education->intended_college_minor : old('intended_college_minor')) == 'Demo' ? 'selected' : '' }}>Demo</option>
                                                            <option value="Temp" {{ (isset($education->intended_college_minor) ? $education->intended_college_minor : old('intended_college_minor')) == 'Temp' ? 'selected' : '' }}>Temp</option>
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
                    <div class="prev-btn next-btn">
                        <a href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}" class="btn btn-alt-success next-step"> Previous Step
                        </a>
                        <div class="eye-module">
                            <i class="fa-solid fa-eye btn-alt-success opacity-50"></i>
                        </div>
                    </div>
                    <div class="next-btn">
                        <input type="submit" class="btn btn-alt-success next-step" value="Next Step">
                        <div class="eye-module">
                            <i class="fa-solid fa-eye btn-alt-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Course Modal Modal-->
<div class="modal" id="course_name_modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Course</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label class="form-label" for="course_modal_name">
                                Course Name
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="course_modal_name" name="course_modal_name" value="{{ old('course_name') }}" placeholder="Ex: Collage English 101" required>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="course_modal_college_name">
                                Search College Name
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="college_name" id="course_modal_college_name" required>
                                <option {{ old('college_name') == "" ? 'selected' : "" }} value="">Select College Name</option>
                                <option {{ old('college_name') == "first" ? 'selected' : "" }} value="first">First</option>
                                <option {{ old('college_name') == "second" ? 'selected' : "" }} value="second">Second</option>
                                <option {{ old('college_name') == "third" ? 'selected' : "" }} value="third">Third</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-end">
                    <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="updateCourseForm" onclick="updateCourseForm(this)" class="btn submit-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Course Modal  -->

<!--Honor Courses Modal -->
<div class="modal" id="honors_course" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Courses</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form>
                        <label class="form-label" for="honors_course_name">
                            Honors Course Name
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('honors_course_name') is-invalid @enderror" id="honors_course_modal_name" value="{{ old('honors_course_name') }}" name="honors_course_name" placeholder="Ex: Collage English 101">
                    </form>
                </div>
                <div class="block-content block-content-full text-end">
                    <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="updateHonorCourseForm" onclick="updateHonorCourseForm(this)" class="btn submit-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Honor Courses Modal -->

<!--Testing Modal -->
<div class="modal" id="testing_course" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Testing</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form>
                        <div class="row mb-4">
                            <div class="col-lg-4">
                                <label class="form-label" for="testing_name_of_test">
                                    Name of test
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="testing_name_of_test" name="testing_name_of_test" placeholder="Enter Name of test">
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label" for="testing_results_score">
                                    Results Score
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="testing_results_score" name="testing_results_score" placeholder="Enter Results score">
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label" for="testing_date">
                                    Date
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="date-own form-control" id="testing_date" name="testing_date" placeholder="Enter Date" autocomplete="off">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end">
                    <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    
                    <button type="button" class="btn submit-btn" id="updateTestingForm" onclick="updateTestingForm(this)">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Testing Modal -->
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<style>
    .select2-container .select2-selection--multiple {
        min-width: 36vw !important;
    }
</style>
@endsection

@section('user-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/high-school-resume.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
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

    $('.date-own').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '-3d'
    });

    function addCourseData(data) {
        let course_name = $('input[name="course_name"]').val();
        let search_college_name = $('#search_college_name').val();
        let temp_course_id = Date.now();

        let html = ``;
        if (course_name != "" && search_college_name != "") {
            html += `<tr id="course_${temp_course_id}">`;
            html += `<td class="course_name">${course_name}</td>`;
            html += `<td class="search_college_name">${search_college_name}</td>`;
            html += `<td>`;
            html += `<i class="fa-solid fa-pen me-2" data-id="${temp_course_id}" onclick="course_edit_model(this)"></i>`;
            html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_course_id}" onclick="course_model_remove(this)"></i>`;
            html += `</td>`;

            courseData.push({
                "id": temp_course_id,
                "course_name": course_name,
                "search_college_name": search_college_name
            });
        } else {
            alert('Please Enter Course Name & College name');
        }
        $('.course_data_table_row').after(html);
        $('input[name="course_name"]').val('');
        $('#search_college_name').val('');
        $('#course_data').val(JSON.stringify(courseData));
    }

    function course_edit_model(data) {
        let course_data = $('#course_data').val();
        course_data = JSON.parse(course_data);
        let id = $(data).attr('data-id');
        let course_result = course_data.find(course => course.id == id);
        $('#course_modal_name').val(course_result.course_name);
        $('#course_modal_college_name').val(course_result.search_college_name);
        $('#updateCourseForm').attr('data-id', id);
        $('#course_name_modal').modal('show');
    }

    function updateCourseForm(data) {
        let id = $(data).attr('data-id');
        let course_name = $('#course_modal_name').val();
        let search_college_name = $('#course_modal_college_name').val();
        let course_data = $('#course_data').val();
        course_data = JSON.parse(course_data);
        for (let i = 0; i < course_data.length; i++) {
            if (course_data[i].id == id) {
                course_data[i].course_name = course_name
                course_data[i].search_college_name = search_college_name
            }
        }
        $('#course_data').val(JSON.stringify(course_data));
        $(`#course_${id} .course_name`).text(course_name);
        $(`#course_${id} .search_college_name`).text(search_college_name);
        $('#course_name_modal').modal('hide');
    }

    function course_model_remove(data) {
        let id = $(data).attr('data-id');
        let course_data = $('#course_data').val();
        course_data = JSON.parse(course_data);
        const deleted_course = course_data.filter(course => course.id != id)
        $('#course_data').val(JSON.stringify(deleted_course));
        $(`#course_${id}`).remove();
    }

    function addHonorCourseData(data) {

        let honor_course_name = $('input[name="honors_course_name"]').val();
        let temp_honor_course_id = Date.now();

        let html = ``;
        if (honor_course_name != "") {
            html += `<tr id="honor_course_${temp_honor_course_id}">`;
            html += `<td class="honor_course_name">${honor_course_name}</td>`;
            html += `<td>`;
            html += `<i class="fa-solid fa-pen me-2" data-id="${temp_honor_course_id}" onclick="honor_course_edit_model(this)"></i>`;
            html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_honor_course_id}" onclick="honor_course_model_remove(this)"></i>`;
            html += `</td>`;

            honorCourseData.push({
                "id": temp_honor_course_id,
                "honor_course_name": honor_course_name
            });
        } else {
            alert('Please Enter Honor Course Name');
        }

        $('.honor_course_data_table_row').after(html);
        $('input[name="honors_course_name"]').val('');
        $('#honor_course_data').val(JSON.stringify(honorCourseData));
    }

    function honor_course_edit_model(data) {
        let honor_course_data = $('#honor_course_data').val();
        honor_course_data = JSON.parse(honor_course_data);
        let id = $(data).attr('data-id');
        let honor_course_result = honor_course_data.find(course => course.id == id);
        $('#honors_course_modal_name').val(honor_course_result.honor_course_name);
        $('#updateHonorCourseForm').attr('data-id', id);
        $('#honors_course').modal('show');
    }

    function updateHonorCourseForm(data) {
        let id = $(data).attr('data-id');
        let honor_course_name = $('#honors_course_modal_name').val();
        let honor_course_data = $('#honor_course_data').val();
            honor_course_data = JSON.parse(honor_course_data);
        for (let i = 0; i < honor_course_data.length; i++) {
            if (honor_course_data[i].id == id) {
                honor_course_data[i].honor_course_name = honor_course_name
            }
        }
        $('#honor_course_data').val(JSON.stringify(honor_course_data));
        $(`#honor_course_${id} .honor_course_name`).text(honor_course_name);
        $('#honors_course').modal('hide');
    }

    function honor_course_model_remove(data) {
        let id = $(data).attr('data-id');
        let honor_course_data = $('#honor_course_data').val();
            honor_course_data = JSON.parse(honor_course_data);
        const deleted_honor_course = honor_course_data.filter(course => course.id != id)
        $('#honor_course_data').val(JSON.stringify(deleted_honor_course));
        $(`#honor_course_${id}`).remove();
    }

    function addTestingData(data) {
        let name_of_test = $('input[name="name_of_test"]').val();
        let results_score = $('input[name="results_score"]').val();
        let date = $('input[name="date"]').val();
        let temp_testing_id = Date.now();

        let html = ``;
        if (name_of_test != "" && results_score != "" && date != "") {
            html += `<tr id="testing_${temp_testing_id}">`;
            html += `<td class="name_of_test">${name_of_test}</td>`;
            html += `<td class="results_score">${results_score}</td>`;
            html += `<td class="date">${date}</td>`;
            html += `<td>`;
            html += `<i class="fa-solid fa-pen me-2" data-id="${temp_testing_id}" onclick="testing_edit_model(this)"></i>`;
            html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_testing_id}" onclick="testing_model_remove(this)"></i>`;
            html += `</td>`;

            testingData.push({
                "id": temp_testing_id,
                "name_of_test": name_of_test,
                "results_score": results_score,
                "date": date
            });
        } else {
            alert('Please Enter Testing Details');
        }

        $('.testing_table_row').after(html);
        $('input[name="name_of_test"]').val('');
        $('input[name="results_score"]').val('');
        $('input[name="date"]').val('');
        $('#testing_data').val(JSON.stringify(testingData));
    }

    function testing_edit_model(data) {
        let testing_data = $('#testing_data').val();
            testing_data = JSON.parse(testing_data);
        let id = $(data).attr('data-id');
        let testing_result = testing_data.find(testing => testing.id == id);
        $('#testing_name_of_test').val(testing_result.name_of_test);
        $('#testing_results_score').val(testing_result.results_score);
        $('#testing_date').val(testing_result.date);
        $('#updateTestingForm').attr('data-id', id);
        $('#testing_course').modal('show');
    }

    function updateTestingForm(data) {
        let id = $(data).attr('data-id');
        let name_of_test = $('#testing_name_of_test').val();
        let results_score = $('#testing_results_score').val();
        let date = $('#testing_date').val();

        let testing_data = $('#testing_data').val();
            testing_data = JSON.parse(testing_data);
        for (let i = 0; i < testing_data.length; i++) {
            if (testing_data[i].id == id) {
                testing_data[i].name_of_test = name_of_test
                testing_data[i].results_score = results_score
                testing_data[i].date = date
            }
        }
        $('#testing_data').val(JSON.stringify(testing_data));
        $(`#testing_${id} .name_of_test`).text(name_of_test);
        $(`#testing_${id} .results_score`).text(results_score);
        $(`#testing_${id} .date`).text(date);
        $('#testing_course').modal('hide');
    }

    function testing_model_remove(data) {
        let id = $(data).attr('data-id');
        let testing_data = $('#testing_data').val();
            testing_data = JSON.parse(testing_data);
        const deleted_testing = testing_data.filter(testing => testing.id != id)
        $('#testing_data').val(JSON.stringify(deleted_testing));
        $(`#testing_${id}`).remove();
    }

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

</script>
@endsection