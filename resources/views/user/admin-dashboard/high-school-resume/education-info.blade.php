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
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Personal Info</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Education </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.honors') }}" id="step3-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Honors </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Activities</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                            id="step5-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Employment & <br> Certifications</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Featured <br> Attributes</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.preview') }}" id="step7-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Preview</p>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" action="{{ route('admin-dashboard.highSchoolResume.educationInfo.store') }}"
                    method="POST">
                    @csrf
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content" role="tabpanel" id="step2" aria-labelledby="step2-tab">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> High school information</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse {{ $errors->first('current_grade') || $errors->first('month') || $errors->first('year') || $errors->first('high_school_name') || $errors->first('high_school_city') || $errors->first('high_school_state') || $errors->first('high_school_district') || $errors->first('high_school_district') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="current_grade">Current
                                                                Grade
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('current_grade') is-invalid @enderror"
                                                                value="{{ old('current_grade') }}" id="current_grade"
                                                                name="current_grade" placeholder="Enter Current Grade">
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
                                                            <select
                                                                class="js-select2 form-select @error('month') is-invalid @enderror"
                                                                id="month" name="month" style="width: 100%;">
                                                                <option selected="selected" disabled>Projected
                                                                    Graduation
                                                                    Month
                                                                </option>
                                                                <option value="January">January</option>
                                                                <option value="February">February</option>
                                                                <option value="March">March</option>
                                                                <option value="April">April</option>
                                                                <option value="May">May</option>
                                                                <option value="June">June</option>
                                                                <option value="July">July</option>
                                                                <option value="August">August</option>
                                                                <option value="September">September</option>
                                                                <option value="October">October</option>
                                                                <option value="November">November</option>
                                                                <option value="December">December</option>
                                                            </select>
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
                                                            <select
                                                                class="js-select2 form-select @error('year') is-invalid @enderror"
                                                                id="year" name="year" style="width: 100%;">
                                                                <option selected="selected" disabled>Projected
                                                                    Graduation
                                                                    Year
                                                                </option>
                                                                <option value="2000">2000</option>
                                                                <option value="2001">2001</option>
                                                                <option value="2002">2002</option>
                                                                <option value="2003">2003</option>
                                                                <option value="2004">2004</option>
                                                                <option value="2005">2005</option>
                                                                <option value="2006">2006</option>
                                                                <option value="2007">2007</option>
                                                                <option value="2008">2008</option>
                                                                <option value="2009">2009</option>
                                                                <option value="2010">2010</option>
                                                                <option value="2011">2011</option>
                                                            </select>
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
                                                            <input type="text"
                                                                class="form-control @error('high_school_name') is-invalid @enderror"
                                                                id="high_school_name"
                                                                value="{{ old('high_school_name') }}"
                                                                name="high_school_name"
                                                                placeholder="Enter High School name">
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
                                                            <input type="text"
                                                                class="form-control @error('high_school_city') is-invalid @enderror"
                                                                id="high_school_city"
                                                                value="{{ old('high_school_city') }}"
                                                                name="high_school_city"
                                                                placeholder="Enter High School City">
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
                                                            <input type="text"
                                                                class="form-control @error('high_school_state') is-invalid @enderror"
                                                                id="high_school_state"
                                                                value="{{ old('high_school_state') }}"
                                                                name="high_school_state"
                                                                placeholder="Enter High School State">
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
                                                            <input type="text"
                                                                class="form-control @error('high_school_district') is-invalid @enderror"
                                                                id="high_school_district"
                                                                value="{{ old('high_school_district') }}"
                                                                name="high_school_district"
                                                                placeholder="Enter High School District">
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
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <a class="text-white fw-600 collapsed">College information</a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse {{ $errors->first('grade_level') || $errors->first('college_name') || $errors->first('college_city') || $errors->first('college_state') || $errors->first('college_state') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="val-terms"
                                                            name="val-terms">
                                                        <label class="form-check-label" for="val-terms">
                                                            I have already graduated high school
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="grade_level">
                                                                Grade level
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('grade_level') is-invalid @enderror"
                                                                value="{{ old('grade_level') }}" id="grade_level"
                                                                name="grade_level" placeholder="Enter Grade level">
                                                            @error('grade_level')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="college_name">
                                                                College Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="js-example-disabled-results form-control">
                                                                <option value="one">First</option>
                                                                <option value="two">Second</option>
                                                                <option value="three">Third</option>
                                                            </select>
                                                            @error('college_name')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="college_city">
                                                                College City
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('college_city') is-invalid @enderror"
                                                                value="{{ old('college_city') }}" id="college_city"
                                                                name="college_city" placeholder="Enter College City">
                                                            @error('college_city')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="college_state">
                                                                College State
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('college_state') is-invalid @enderror"
                                                                value="{{ old('college_state') }}" id="college_state"
                                                                name="college_state" placeholder="Enter College State">
                                                            @error('college_state')
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
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <a class=" text-white fw-600 collapsed">Contact information</a>
                                    </div>
                                    <div id="collapseThree"
                                        class="collapse {{ $errors->first('cumulative_gpa_unweighted') || $errors->first('cumulative_gpa_weighted') || $errors->first('cumulative_gpa_unweighted') ? 'show' : '' }}"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label"
                                                                for="cumulative_gpa_unweighted">Cumulative
                                                                GPA
                                                                (UNWEIGHTED) <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('cumulative_gpa_unweighted') is-invalid @enderror"
                                                                id="cumulative_gpa_unweighted"
                                                                value="{{ old('cumulative_gpa_unweighted') }}"
                                                                name="cumulative_gpa_unweighted"
                                                                placeholder="Enter Cumulative GPA (UNWEIGHTED)">
                                                            @error('cumulative_gpa_unweighted')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label"
                                                                for="cumulative_gpa_weighted">Cumulative
                                                                GPA
                                                                (WEIGHTED) <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('cumulative_gpa_weighted') is-invalid @enderror"
                                                                id="cumulative_gpa_weighted"
                                                                value="{{ old('cumulative_gpa_weighted') }}"
                                                                name="cumulative_gpa_weighted"
                                                                placeholder="Enter Cumulative GPA (WEIGHTED)">
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
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <a class="text-white fw-600 collapsed">Class rank</a>
                                    </div>
                                    <div id="collapseFour"
                                        class="collapse {{ $errors->first('class_rank') || $errors->first('total_no_of_student') ? 'show' : '' }}"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="class_rank">
                                                                Class rank
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number"
                                                                class="form-control @error('class_rank') is-invalid @enderror"
                                                                value="{{ old('class_rank') }}" id="class_rank"
                                                                name="class_rank" placeholder="Enter Class Rank">
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
                                                            <input type="number"
                                                                class="form-control @error('total_no_of_student') is-invalid @enderror"
                                                                value="{{ old('total_no_of_student') }}"
                                                                id="total_no_of_student" name="total_no_of_student"
                                                                placeholder="Enter Total Number Of Students">
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
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                        <a class=" text-white fw-600 collapsed">Courses</a>
                                    </div>
                                    <div id="collapseFive"
                                        class="collapse {{ $errors->first('ib_courses') || $errors->first('ap_courses') || $errors->first('course_name') || $errors->first('honors_course_name') ? 'show' : '' }}"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="ib_courses">
                                                                IB Courses
                                                                <span class="text-danger">*</span>
                                                            </label><br>
                                                            <select class="js-select2 select" id="ib_courses"
                                                                name="ib_courses" multiple="multiple">
                                                                <option value="list 1">list 1</option>
                                                                <option value="list 2">list 2</option>
                                                                <option value="list 3">list 3</option>
                                                                <option value="list 4">list 4</option>
                                                                <option value="list 5">list 5</option>
                                                                <option value="list 6">list 6</option>
                                                                <option value="list 7">list 7</option>
                                                                <option value="list 8">list 8</option>
                                                                <option value="list 9">list 9</option>
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
                                                            <select class="js-select2 select" id="ap_courses"
                                                                name="ap_courses" multiple="multiple">
                                                                <option value="list 1">list 1</option>
                                                                <option value="list 2">list 2</option>
                                                                <option value="list 3">list 3</option>
                                                                <option value="list 4">list 4</option>
                                                                <option value="list 5">list 5</option>
                                                                <option value="list 6">list 6</option>
                                                                <option value="list 7">list 7</option>
                                                                <option value="list 8">list 8</option>
                                                                <option value="list 9">list 9</option>
                                                            </select>
                                                            @error('ap_courses')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td><label class="form-label" for="course_name">
                                                                    Course Name
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('course_name') is-invalid @enderror"
                                                                    id="course_name" name="course_name"
                                                                    value="{{ old('course_name') }}"
                                                                    placeholder="Ex: Collage English 101">
                                                                @error('course_name')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td> <label class="form-label" for="college_id">
                                                                    Search College Name
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-example-disabled-results form-control">
                                                                    <option value="one">First</option>
                                                                    <option value="two">Second</option>
                                                                    <option value="three">Third</option>
                                                                </select>
                                                                @error('college_id')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror

                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" class="add-btn plus-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>
                                                                <i class="fa-solid fa-pen me-2" data-bs-toggle="modal"
                                                                    data-bs-target="#modal-block-extra-large"></i>
                                                                <i class="fa-solid fa-circle-xmark"></i>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>
                                                                <i class="fa-solid fa-pen me-2"></i>
                                                                <i class="fa-solid fa-circle-xmark"></i>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>
                                                                <i class="fa-solid fa-pen me-2"></i>
                                                                <i class="fa-solid fa-circle-xmark"></i>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><label class="form-label" for="honors_course_name">
                                                                Honors Course Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('honors_course_name') is-invalid @enderror"
                                                                id="honors_course_name"
                                                                value="{{ old('honors_course_name') }}"
                                                                name="honors_course_name"
                                                                placeholder="Ex: Collage English 101">
                                                            @error('honors_course_name')
                                                                <span class="invalid">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <label class="form-label">Action</label><br>
                                                            <a href="javascript:void(0)" class="add-btn plus-icon">
                                                                <i class="fa-solid fa-plus"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mark</td>
                                                        <td><i class="fa-solid fa-pen me-2" data-bs-toggle="modal"
                                                                data-bs-target="#honors_course"></i> <i
                                                                class="fa-solid fa-circle-xmark"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jacob</td>
                                                        <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                class="fa-solid fa-circle-xmark"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Larry the Bird</td>
                                                        <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                class="fa-solid fa-circle-xmark"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                        <a class=" text-white fw-600 collapsed">Testing</a>
                                    </div>
                                    <div id="collapseSix"
                                        class="collapse {{ $errors->first('name_of_test') || $errors->first('results_score') || $errors->first('date') ? 'show' : '' }}"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td> <label class="form-label" for="name_of_test">
                                                                    Name of test
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('name_of_test') is-invalid @enderror"
                                                                    value="{{ old('name_of_test') }}" id="name_of_test"
                                                                    name="name_of_test" placeholder="Enter Name of test">
                                                                @error('name_of_test')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="results_score">
                                                                    Results Score
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('results_score') is-invalid @enderror"
                                                                    value="{{ old('results_score') }}" id="results_score"
                                                                    name="results_score"
                                                                    placeholder="Enter Results score">
                                                                @error('results_score')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td><label class="form-label" for="date">
                                                                    Date
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="date"
                                                                    class="form-control @error('date') is-invalid @enderror"
                                                                    id="date" value="{{ old('date') }}"
                                                                    name="date" placeholder="Enter Date">
                                                                @error('date')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" class="add-btn plus-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td cl>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2" data-bs-toggle="modal"
                                                                    data-bs-target="#testing_course"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td>Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i
                                                                    class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        <a class=" text-white fw-600 collapsed">Future plans</a>
                                    </div>
                                    <div id="collapseSeven"
                                        class="collapse {{ $errors->first('intended_college_major') || $errors->first('intended_college_minor') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="intended_college_major">
                                                                Intended College Major
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select
                                                                class="js-select2 form-select @error('intended_college_major') is-invalid @enderror"
                                                                id="intended_college_major" name="intended_college_major"
                                                                style="width: 100%;">
                                                                <option value="">Select Intended College Major
                                                                </option>
                                                                <option value="1">Test</option>
                                                                <option value="2">Demo</option>
                                                                <option value="3">Temp</option>
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
                                                            <select
                                                                class="js-select2 form-select @error('intended_college_minor') is-invalid @enderror"
                                                                id="intended_college_minor" name="intended_college_minor"
                                                                style="width: 100%;">
                                                                <option value="">Select Intended College Minor
                                                                </option>
                                                                <option value="1">Test</option>
                                                                <option value="2">Demo</option>
                                                                <option value="3">Temp</option>
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
                            <a href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}"
                                class="btn btn-alt-primary next-step"> Prev
                            </a>
                        </div>
                        <div class="next-btn">
                            <div class="next-btn">
                                <input type="submit" class="btn btn-alt-primary next-step" value="Next">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>






    <!-- Course college search Modal-->
    <div class="modal" id="modal-block-extra-large" tabindex="-1" role="dialog"
        aria-labelledby="modal-block-extra-large" aria-hidden="true">
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
                        <form>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="course_name">
                                        Course Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('course_name') is-invalid @enderror"
                                        id="course_name" name="course_name" value="{{ old('course_name') }}"
                                        placeholder="Ex: Collage English 101">
                                    @error('course_name')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="college_id">
                                        Search College Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-example-disabled-results form-control">
                                        <option value="one">First</option>
                                        <option value="two">Second</option>
                                        <option value="three">Third</option>
                                    </select>
                                    @error('college_id')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end">
                        <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn submit-btn" data-bs-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Course college search  -->

    <!--Courses Modal -->
    <div class="modal" id="honors_course" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
        aria-hidden="true">
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
                            <input type="text" class="form-control @error('honors_course_name') is-invalid @enderror"
                                id="honors_course_name" value="{{ old('honors_course_name') }}"
                                name="honors_course_name" placeholder="Ex: Collage English 101">
                            @error('honors_course_name')
                                <span class="invalid">{{ $message }}</span>
                            @enderror
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end">
                        <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn submit-btn" data-bs-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses Modal -->
    
    <!--Testing Modal -->
    <div class="modal" id="testing_course" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
        aria-hidden="true">
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
                                    <label class="form-label" for="name_of_test">
                                        Name of test
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('name_of_test') is-invalid @enderror"
                                        value="{{ old('name_of_test') }}" id="name_of_test" name="name_of_test"
                                        placeholder="Enter Name of test">
                                    @error('name_of_test')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="results_score">
                                        Results Score
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('results_score') is-invalid @enderror"
                                        value="{{ old('results_score') }}" id="results_score" name="results_score"
                                        placeholder="Enter Results score">
                                    @error('results_score')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="date">
                                        Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        id="date" value="{{ old('date') }}" name="date"
                                        placeholder="Enter Date">
                                    @error('date')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="block-content block-content-full text-end">
                        <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn submit-btn" data-bs-dismiss="modal">Submit</button>
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
@endsection
