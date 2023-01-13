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
    <div class="education-container">
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
                <li role="presentation" onclick="{{ !isset($education) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                    <a class="nav-link" href="{{ isset($education) && $education != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/honors?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.honors')) : ''}}" id="step3-tab">
                        <p>3</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Honors </h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                    <a class="nav-link" href="{{ isset($honor) && $honor != null ? ( isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.activities')) : ''}}" id="step4-tab">
                        <p>4</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Activities</h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                    <a class="nav-link" href="{{ isset($activity) && $activity != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.employmentCertification')) : ''}}" id="step5-tab">
                        <p>5</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Employment & <br> Certifications</h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                    <a class="nav-link" href="{{ isset($employmentCertification) && $employmentCertification != null ? (isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.featuresAttributes')) : ''}}" id="step6-tab">
                        <p>6</p>
                        <i class="fa-solid fa-check "></i>
                        <h6>Featured <br> Attributes</h6>
                    </a>
                </li>
                <li role="presentation" onclick="{{ !isset($education) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
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
                                                    <div class="select2-container_main">
                                                        <label class="form-label" for="current_grade">Current
                                                            Grade
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="js-select2 select"
                                                            id="current_grade"
                                                            name="current_grade[]"
                                                            multiple="multiple">
                                                            @foreach ($grades as $grade)
                                                                <option {{ isset($education['current_grade']) && $education['current_grade'] != null ? (in_array($grade->id, json_decode($education['current_grade'])) ? 'selected' : '') : ''}}  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <!-- start  -->
                                                    <div class="select2-container_main mt-3">
                                                        <label class="form-label" for="graduation_designation">
                                                            Graduation Designation 
                                                        </label>
                                                        <select class="js-select2 form-select" name="graduation_designation" style="width: 100%;" data-placeholder="Select Graduation Designation">
                                                            @foreach($graduation_designations as $graduation_designation)
                                                                <option {{ isset($education['graduation_designation']) && $education['graduation_designation'] != null ? ($education['graduation_designation'] == $graduation_designation ? 'selected' : '') : '' }} > {{ $graduation_designation }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="month">Intended Graduation Month
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input class="month-own form-control" onkeydown="javascript: return event.keyCode == 69 ? false : true" placeholder="Intended Graduation Month" min="1" max="12" id="month" name="month" value="{{ isset($education->month) && $education->month != null ? $education->month : old('month') }}" style="width: 100%;" type="number" autocomplete="off" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="year">Intended Graduation Year
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input class="year-own form-control" onkeydown="javascript: return event.keyCode == 69 ? false : true" placeholder="Intended Graduation Year Ex:2022" id="year" name="year" value="{{ isset($education->year)  && $education->year != null  ? $education->year : old('year') }}" style="width: 100%;" type="number" autocomplete="off" readonly>
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
                                                        <label class="form-label" for="high_school_city">
                                                            City <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="high_school_city" value="{{ isset($education->high_school_city) && $education->high_school_city != null ? $education->high_school_city : old('high_school_city') }}" name="high_school_city" placeholder="Enter High School City">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="select2-container_main">
                                                        <label class="form-label" for="high_school_state">
                                                            State <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="js-select2 form-select" name="high_school_state" style="width: 100%;" data-placeholder="Select high school state">
                                                            <option></option>
                                                            @foreach($states as $state)
                                                                <option value="{{$state}}" {{ isset($education->high_school_state) && $education->high_school_state != null ? ($education->high_school_state  == $state ? 'selected' : '') : '' }} > {{$state}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label class="form-label" for="high_school_district">School District Name <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="high_school_district" value="{{ isset($education->high_school_district) && $education->high_school_district != null ? $education->high_school_district : old('high_school_district') }}" name="high_school_district" placeholder="Enter High School District">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="block block-rounded block-bordered overflow-hidden mb-1">
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
                            </div> --}}
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <a class=" text-white fw-600 collapsed">Grades</a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="cumulative_gpa_unweighted">Cumulative
                                                            GPA
                                                            (UNWEIGHTED)
                                                        </label>
                                                        <input type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" id="cumulative_gpa_unweighted" class="form-control" id="cumulative_gpa_unweighted" min="0" max="8" value="{{ isset($education->cumulative_gpa_unweighted) && $education->cumulative_gpa_unweighted != null ? $education->cumulative_gpa_unweighted : old('cumulative_gpa_unweighted') }}" name="cumulative_gpa_unweighted" placeholder="Enter Cumulative GPA (UNWEIGHTED)">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="cumulative_gpa_weighted">Cumulative
                                                            GPA
                                                            (WEIGHTED)</label>
                                                        <input type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" id="cumulative_gpa_weighted" class="form-control" id="cumulative_gpa_weighted" min="0" max="8" value="{{ isset($education->cumulative_gpa_weighted) && $education->cumulative_gpa_weighted != null ? $education->cumulative_gpa_weighted : old('cumulative_gpa_weighted') }}" name="cumulative_gpa_weighted" placeholder="Enter Cumulative GPA (WEIGHTED)">
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
                                <div id="collapseFour" class="collapse" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="class_rank">
                                                            Class Rank
                                                        </label>
                                                        <input type="text" class="form-control" value="{{ isset($education->class_rank) && $education->class_rank != null ? $education->class_rank : old('class_rank') }}" id="class_rank" name="class_rank" placeholder="Enter Class Rank">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label" for="total_no_of_student">
                                                            Total Number Of Students In Your Class
                                                        </label>
                                                        <input type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control" value="{{ isset($education->total_no_of_student) && $education->total_no_of_student != null ? $education->total_no_of_student : old('total_no_of_student') }}" id="total_no_of_student" name="total_no_of_student" placeholder="Enter Total Number Of Students">
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
                                                <div class="col-lg-6 ">
                                                    <div class="select2-container_main">
                                                        <label class="form-label" for="ib_courses">
                                                            IB Courses
                                                            {{-- <span class="text-danger">*</span> --}}
                                                        </label><br>
                                                        <select class="js-select2 select" data-placeholder="Select IB courses" id="ib_courses" name="ib_courses[]" multiple="multiple" >
                                                            @foreach($courses_list as $course_list)
                                                                @if($course_list->course_type == 1)
                                                                    <option value="{{ $course_list->id }}" {{ (!empty($education->ib_courses) && in_array($course_list->id,json_decode($education->ib_courses))) ? 'selected' : '' }}>{{ $course_list->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="select2-container_main">
                                                        <label class="form-label" for="ap_courses">
                                                            AP Courses
                                                            {{-- <span class="text-danger">*</span> --}}
                                                        </label><br>
                                                        
                                                        <select class="js-select2 select" data-placeholder="Select AP courses" id="ap_courses" name="ap_courses[]" multiple="multiple">
                                                            @foreach($courses_list as $course_list)
                                                                @if($course_list->course_type == 2)
                                                                    <option value="{{ $course_list->id }}" {{ (!empty($education->ap_courses) && in_array($course_list->id,json_decode($education->ap_courses))) ? 'selected' : '' }}>{{ $course_list->name }}</option>
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
                                                                Concurrent Course Name
                                                                {{-- <span class="text-danger">*</span> --}}
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-label" for="search_college_name">
                                                                Search College Name
                                                                {{-- <span class="text-danger">*</span> --}}
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
                                                                    <input type="text" class="form-control" value="{{ $course_data['course_name'] }}" data-count="{{$index}}" id="course_name_{{$index}}" name="course_data[{{ $index }}][course_name]" placeholder="Ex: College English 101" onchange="change(this)">
                                                                </td>
                                                                <td class="select2-container_main select2-container_main-position">
                                                                    <select class=" js-select2 select" id="search_college_name_{{ $index }}" name="course_data[{{ $index }}][search_college_name][]" multiple="multiple" data-placeholder="Select college name" disabled>
                                                                        @foreach ($colleges_list as $college_info)
                                                                            <option
                                                                                {{ in_array($college_info->id,  (isset($course_data['search_college_name']) ?  is_array($course_data['search_college_name']) : '') ? $course_data['search_college_name'] : []) ? 'selected' : '' }}
                                                                                value="{{ $college_info->id }}">{{ $college_info->name }}
                                                                            </option>
                                                                        @endforeach
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
                                                                <input type="text" class="form-control" id="course_name_0" data-count="0" name="course_data[0][course_name]" placeholder="Ex: College English 101" onchange="change(this)">
                                                            </td>
                                                            <td class="select2-container_main select2-container_main-position">
                                                                <select class=" js-select2"
                                                                    id="search_college_name_0" name="course_data[0][search_college_name][]"
                                                                    multiple="multiple" data-placeholder="Select college name" disabled>
                                                                    @foreach ($colleges_list as $college_info)
                                                                        <option value="{{ $college_info->id }}">{{ $college_info->name }}
                                                                        </option>
                                                                    @endforeach
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
                                                            {{-- <span class="text-danger">*</span> --}}
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="form-label">Action</label><br>
                                                    </td>
                                                </tr>
                                                @if (!empty($education->honor_course_data))
                                                @foreach ($education->honor_course_data as $index => $honor_course_data)
                                                        <tr class="honor_course_data_table_row {{ $loop->first ? '' : 'remove_honors_courses' }}"> 
                                                            <td class="select2-container_main select2-container_main-position"> 
                                                                <select class="js-select2"
                                                                id="honor_course_data_{{$index}}" name="honor_course_data[{{$index}}][course_data][]"
                                                                multiple="multiple" data-placeholder="Select honors course name">
                                                                @foreach ($honors_course_list as $honors_course_name)
                                                                    <option
                                                                        {{ in_array($honors_course_name->id,$honor_course_data['course_data']) ? 'selected' : ''  }}
                                                                        value="{{ $honors_course_name->id }}">{{ $honors_course_name->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                                
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
                                                        <td class="select2-container_main select2-container_main-position">  
                                                            <select class="js-select2"
                                                                id="honor_course_data_0" name="honor_course_data[0][course_data][]"
                                                                multiple="multiple" data-placeholder="Select honors course name">
                                                                @foreach ($honors_course_list as $honors_course_name)
                                                                    <option value="{{ $honors_course_name->id }}">{{ $honors_course_name->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
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
                                <div id="collapseSix" class="collapse" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="is_tested" name="is_tested">
                                                    <label class="form-check-label" for="is_tested">
                                                        I haven't taken a test yet
                                                    </label>
                                                </div>
                                            </div>
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
                                                                    <select class="form-select" name="testing_data[{{ $index }}][name_of_test]" style="width: 100%;">
                                                                        <option value="" disabled selected hidden>Select Name Of Test</option>
                                                                        <option value="SAT – 400 – 1600" {{ (isset($testing_data['name_of_test']) && $testing_data['name_of_test'] != null ? ($testing_data['name_of_test'] == 'SAT – 400 – 1600' ? 'selected' : '' ) : '' ) }}>SAT – 400 – 1600</option>
                                                                        <option value="PSAT 320-1520" {{ (isset($testing_data['name_of_test']) && $testing_data['name_of_test'] != null ? ($testing_data['name_of_test'] == 'PSAT 320-1520' ? 'selected' : '' ) : '' ) }}>PSAT 320-1520</option>
                                                                        <option value="ACT 1-36" {{ (isset($testing_data['name_of_test']) && $testing_data['name_of_test'] != null ? ($testing_data['name_of_test'] == 'ACT 1-36' ? 'selected' : '' ) : '' ) }}>ACT 1-36</option>
                                                                    </select>   
                                                                </td>
                                                                <td>                                                            
                                                                    <input type="text" class="form-control" value="{{ $testing_data['results_score'] }}" name="testing_data[{{ $index }}][results_score]" placeholder="Enter Results score">
                                                                </td>
                                                                <td>                                                            
                                                                    <input type="text" class="form-control" value="{{ $testing_data['date'] }}" id="testing-date-{{ $index }}" name="testing_data[{{ $index }}][date]" placeholder="Enter Date" autocomplete="off" readonly>
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
                                                                <select class="form-select" id="name_of_test" name="testing_data[0][name_of_test]" style="width: 100%;">
                                                                    <option value="">Select name of test</option>
                                                                    <option value="SAT – 400 – 1600">SAT – 400 – 1600</option>
                                                                    <option value="PSAT 320-1520">PSAT 320-1520</option>
                                                                    <option value="ACT 1-36">ACT 1-36</option>
                                                                </select>
                                                            </td>
                                                            <td>                                                            
                                                                <input type="text" class="form-control" value="{{ old('results_score') }}" id="results_score" name="testing_data[0][results_score]" placeholder="Enter Results score">
                                                            </td>
                                                            <td>                                                            
                                                                <input type="text" class="form-control" value="{{ old('date') }}" id="testing-date-0" name="testing_data[0][date]" placeholder="Enter Date" autocomplete="off" readonly>
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
                                <div id="collapseSeven" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-4">
                                                <div class="col-lg-6">
                                                    <div class="select2-container_main">
                                                        <label class="form-label" for="intended_college_major">
                                                            Intended College Major
                                                        </label>
                                                        <span class="text-danger">*</span>
                                                        <select class="js-select2 select"
                                                            id="intended_college_major"
                                                            name="intended_college_major[]"
                                                            data-placeholder="Select intended College Major"
                                                            multiple="multiple">
                                                            @foreach ($intended_major as $major)
                                                                <option {{ isset($education['intended_college_major']) && $education['intended_college_major'] != null ? (in_array($major->id, json_decode($education['intended_college_major'])) ? 'selected' : '') : ''}} value="{{ $major->id }}">{{ $major->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="select2-container_main">
                                                        <label class="form-label" for="intended_college_minor">
                                                            Intended College Minor
                                                        </label>
                                                        <span class="text-danger">*</span>
                                                        <select class="js-select2 select"
                                                            id="intended_college_minor"
                                                            name="intended_college_minor[]"
                                                            data-placeholder="Select intended College Minor"
                                                            multiple="multiple">
                                                            @foreach ($intended_minor as $minor)
                                                                <option {{ isset($education['intended_college_minor']) && $education['intended_college_minor'] != null ? (in_array($minor->id, json_decode($education['intended_college_minor'])) ? 'selected' : '') : ''}} value="{{ $minor->id }}">{{ $minor->name }}</option>
                                                            @endforeach
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
        .select2-container_main-position{
            display: block;
        }
        .select2-container_main-position .error{
            position: absolute;
            top: 50px;
            left: 0;
        }
        /* .form-label{
            margin-bottom: 10px;
        } */
    </style>
@endsection

@section('user-script')
    <script>One.helpersOnLoad(['jq-select2']);</script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    <script>    
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

        let total_search_college_name_count = "{{ isset($education->course_data) && $education->course_data != null ? count($education->course_data) : 0 }}";

        let total_honor_course_count = "{{ isset($education->honor_course_data) && $education->honor_course_data != null ? count($education->honor_course_data) : 0 }}";

        $(document).ready(() => {
            if(total_testing_count > 0) {
                for (let index = 0; index < total_testing_count; index++) {
                    $(`#testing-date-${index}`).datepicker({
                        format: 'dd-mm-yyyy',
                        endDate: '-1d'
                    });
                }
            } else {
                $('#testing-date-0').datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '-1d'
                });
            }

            if (total_search_college_name_count > 0) {
                for (let index = 0; index < total_search_college_name_count; index++) {
                    $(`#search_college_name_${index}`).select2({
                        tags: true,
                        placeholder: "Select search college name ",
                        allowClear: true
                    });
                }
            } else {
                $("#search_college_name_0").select2({
                    tags: true,
                    placeholder: "Select search college name ",
                    allowClear: true
                });
            }

            if (total_honor_course_count > 0) {
                for (let index = 0; index < total_honor_course_count; index++) {
                    $(`#honor_course_data_${index}`).select2({
                        tags: true,
                        placeholder: "Select honor course name",
                        allowClear: true
                    });
                }
            } else {
                $("#honor_course_data_0").select2({
                    tags: true,
                    placeholder: "Select honor course name",
                    allowClear: true
                });
            }

            $(".select").select2({
                tags: true,
            });
        });

        $(document).ready(function() {
            let validations_rules = @json($validations_rules);
            let validations_messages = @json($validations_messages);
            
            $("#education_form").validate({
                rules: validations_rules,
                messages: validations_messages,
                ignore: false,
                submitHandler: function(form) {
                    form.submit();
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error);
                        $(element).parents("div.select2-container_main").css("margin-bottom",'0');
                        $(element).parents("td.select2-container_main").css("margin-bottom",'0');
                    } else {
                        error.insertAfter(element);
                        if(element.hasClass('error')){
                            element.parents().find('.collapse').addClass('show');
                        }
                        $(element).parents("div.select2-container_main").css("margin-bottom",'20px');
                        $(element).parents("td.select2-container_main").css("margin-bottom",'20px');    
                        if($(element).is('.js-select2 .error')){
                            $(element).parents('div.select2-container_main').find('.select2-selection--multiple').removeAttr('style');
                            $(element).parents('td.select2-container_main').find('.select2-selection--multiple').removeAttr('style');
                        }
                    }
                },
                success: function(label,element) {
                    label.parent().removeClass('error');
                    label.remove(); 
                    $(element).parents('div.select2-container_main').find('.select2-selection--multiple').attr('style', 'border: 1px solid #198754 !important');
                    $(element).parents('td.select2-container_main').find('.select2-selection--multiple').attr('style', 'border: 1px solid #198754 !important');
                },
            })

            $('select[name^="current_grade[]"]').filter().each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Course grade field is required"
                    }
                });
            });
            
            let testing_data = $('input[name^="testing_data"]');

            $("#is_tested").click(function () {    
                if($(this).is(':checked')){
                    $('.testing_data_table td select').removeClass('error');
                    $('.testing_data_table td input').removeClass('error');
                    $('.testing_data_table label.error').remove();

                    $('select[name^="testing_data"]').filter('select[name$="[name_of_test]"]').each(function() {
                        $(this).rules("add", {
                            required: false
                        });
                    });
                    testing_data.filter('input[name$="[date]"],input[name$="[results_score]"]').each(function() {
                        $(this).rules("add", {
                            required: false
                        });
                    });
                }else{
                    $('select[name^="testing_data"]').filter('select[name$="[name_of_test]"]').each(function() {
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
                }
            });

            $('select[name^="testing_data"]').filter('select[name$="[name_of_test]"]').each(function() {
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

            $("#intended_college_major").filter("#intended_college_major").each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Intended college major field is required"
                    }
                });
            });
            $("#intended_college_minor").filter("#intended_college_minor").each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Intended college minor field is required"
                    }
                });
            });

            
        });

        for (let key = 0; key < $('.course_data_table_row').length; key++) {
            $(`input[name='course_data[${key}][course_name]']`).each(function(i,e){
                let course_name = $(e).val();
                if(course_name != ''){
                    if($(`#search_college_name_${key}`).length && $(`#search_college_name_${key}`).length > 0){
                        $(`#search_college_name_${key}`).removeAttr('disabled');
                        $(`#search_college_name_${key}`).attr('required','true');

                        // $(`#search_college_name_${key}`).rules("add",{
                        //     required: true,
                        //     messages: {
                        //         required: "search college name is required"
                        //     }
                        // });                        
                    } 
                } 
            });
        }

        function change(value) {
            let id = $(value).attr("data-count");
            let course_name = $(`#course_name_${id}`).val();
            if(course_name != ''){
                $(`#search_college_name_${id}`).removeAttr('disabled');
                $(`#search_college_name_${id}`).attr('required','true');

                // $(`#search_college_name_${id}`).rules("add",{
                //     required: true,
                //     messages: {
                //         required: "search college name is required"
                //     }
                // })
            }else{
                $(`#search_college_name_${id}`).attr('disabled','true');
            }
        }

            
        $("#current_grade").select2({
            tags: true,
            placeholder : "Select Current grade"            
        });

        $("#intended_college_major").select2({
            tags: true,
            placeholder : "Select intended college major"            
        });
        $("#intended_college_minor").select2({
            tags: true,
            placeholder : "Select intended college minor"            
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