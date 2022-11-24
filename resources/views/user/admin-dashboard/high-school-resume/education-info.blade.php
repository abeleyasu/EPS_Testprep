@extends('layouts.user')

@section('title', 'High School Resume : CPS')

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
        <div class="container">
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
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employementCertified') }}"
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
                <form class="js-validation" action="" method="POST">
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content" role="tabpanel" id="step2" aria-labelledby="step2-tab">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed"> High school information</a>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <label class="form-label" for="current-grade">current
                                                        grade</label>
                                                    <input type="text" class="form-control" id="current-grade"
                                                        name="current-grade" placeholder="Enter current-grade" required>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="month">Month</label>
                                                            <select class="js-select2 form-select" id="month"
                                                                name="month" style="width: 100%;" required>
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="year">Year</label>
                                                            <select class="js-select2 form-select" id="year"
                                                                name="year" style="width: 100%;" required>
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
                                                                <option value="2011">2011></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="school-name">High School
                                                                name</label>
                                                            <input type="text" class="form-control" id="school-name"
                                                                name="school-name" placeholder="Enter High School name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="school-state">High School
                                                                State</label>
                                                            <input type="text" class="form-control" id="school-state"
                                                                name="school-state" placeholder="Enter High School State">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="school-state">High School
                                                                State</label>
                                                            <input type="text" class="form-control" id="school-state"
                                                                name="school-state" placeholder="Enter High School State">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="school-district">High
                                                                School
                                                                District</label>
                                                            <input type="text" class="form-control"
                                                                id="school-district" name="school-district"
                                                                placeholder="Enter High School District">
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
                                        <a class=" text-white fw-600 collapsed">College information</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="val-terms" name="val-terms">
                                                        <label class="form-check-label" for="val-terms">I have already
                                                            graduated high school</label>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="Grade-level">Grade level</label>
                                                    <input type="text" class="form-control" id="Grade-level"
                                                        name="Grade-level" placeholder="Enter Grade level">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="collage-name">Collage Name</label>
                                                    <input type="text" class="form-control" id="collage-name"
                                                        name="collage-name" placeholder="Enter Collage name">
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="collage-city">Collage
                                                                city</label>
                                                            <input type="text" class="form-control" id="collage-city"
                                                                name="collage-city" placeholder="Enter Collage City">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label class="form-label" for="collage-state">Collage
                                                                state</label>
                                                            <input type="text" class="form-control" id="collage-state"
                                                                name="collage-state" placeholder="Enter collage state">
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
                                    <div id="collapseThree" class="collapse" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <label class="form-label" for="Cumulative-GPA">Cumulative GPA
                                                        (UNWEIGHTED)</label>
                                                    <input type="text" class="form-control" id="Cumulative-GPA"
                                                        name="Cumulative-GPA"
                                                        placeholder="Enter Cumulative GPA (UNWEIGHTED)">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="Cumulative-GPA-WEIGHTED">Cumulative
                                                        GPA
                                                        (WEIGHTED)</label>
                                                    <input type="text" class="form-control"
                                                        id="Cumulative-GPA-WEIGHTED" name="Cumulative-GPA-WEIGHTED"
                                                        placeholder="Enter Cumulative GPA (WEIGHTED)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <a class=" text-white fw-600 collapsed">Class rank</a>
                                    </div>
                                    <div id="collapseFour" class="collapse" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <label class="form-label" for="Class-rank">Class rank</label>
                                                    <input type="number" class="form-control" id="Class-rank"
                                                        name="Class-rank" placeholder="Enter Class-rank">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="Cumulative-GPA-(WEIGHTED)1">Cumulative
                                                        GPA (WEIGHTED)</label>
                                                    <input type="number" class="form-control"
                                                        id="Cumulative-GPA-(WEIGHTED)1" name="Cumulative-GPA-(WEIGHTED)1"
                                                        placeholder="Enter Cumulative GPA (WEIGHTED)">
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
                                    <div id="collapseFive" class="collapse" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div clacoursess="main-form-input">
                                                <div class="mb-4">
                                                    <label class="form-label" for="IB-Courses">IB Courses</label>
                                                    <select class="js-select2 select" id="IB-Courses" name="IB-Courses"
                                                        multiple="multiple">
                                                        {{-- <option selected="selected" disabled>IB Courses</option> --}}
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
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label" for="AP-Courses">AP Courses</label>
                                                    <select class="js-select2 select" id="AP-Courses" name="AP-Courses"
                                                        multiple="multiple">
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
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-4">
                                                        <label class="form-label" for="Course-Name">Course
                                                            Name</label>
                                                        <input type="text" class="form-control form-drop"
                                                            id="Course-Name" name="Course-Name"
                                                            placeholder="Ex: Collage English 101">
                                                        <div class="custom-drodown-course">
                                                            <ul>
                                                                <li><a href="#">list</a></li>
                                                                <li><a href="#">list2</a></li>
                                                                <li><a href="#">list3</a></li>
                                                                <li><a href="#">list4</a></li>
                                                                <li><a href="#">list5</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="form-label" for="College-Name">College
                                                            Name</label>
                                                        <input type="text" class="form-control" id="College-Name"
                                                            name="College-Name" placeholder="Enter College Name">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="mb-2">Action</label>
                                                    </div>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Mark</td>
                                                                <td>Mark</td>
                                                                <td>
                                                                    <i class="fa-solid fa-pen me-2"></i> 
                                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jacob</td>
                                                                <td>Jacob</td>
                                                                <td>
                                                                    <i class="fa-solid fa-pen me-2"></i>
                                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Larry the Bird</td>
                                                                <td>Larry the Bird</td>
                                                                <td>
                                                                    <i class="fa-solid fa-pen me-2"></i> 
                                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-4">
                                                        <label class="form-label" for="Course-Name1">Course
                                                            Name</label>
                                                        <input type="text" class="form-control" id="Course-Name1"
                                                            name="Course-Name1" placeholder="Ex: Collage English 101">
                                                        <div class="custom-drodown-course">
                                                            <ul>
                                                                <li><a href="#">list</a></li>
                                                                <li><a href="#">list2</a></li>
                                                                <li><a href="#">list3</a></li>
                                                                <li><a href="#">list4</a></li>
                                                                <li><a href="#">list5</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="mb-2">Action</label>
                                                    </div>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="td-width">Mark</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-width">Jacob</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-width">Larry the Bird</td>
                                                                <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i
                                                                        class="fa-solid fa-circle-xmark"></i></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                        <a class=" text-white fw-600 collapsed">Testing</a>
                                    </div>
                                    <div id="collapseSix" class="collapse" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="row mb-2">
                                                    <div class="col-lg-3">
                                                        <label class="form-label" for="Name-test">Name of test</label>
                                                        <input type="text" class="form-control" id="Name-test"
                                                            name="Name-test" placeholder="Enter Name of test">
                                                        <div class="custom-drodown-course">
                                                            <ul>
                                                                <li><a href="#">list</a></li>
                                                                <li><a href="#">list2</a></li>
                                                                <li><a href="#">list3</a></li>
                                                                <li><a href="#">list4</a></li>
                                                                <li><a href="#">list5</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="form-label" for="Results-score">Results
                                                            score</label>
                                                        <input type="text" class="form-control" id="Results-score"
                                                            name="Results-score" placeholder="Enter Results score">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="form-label" for="Results-score">Date</label>
                                                        <input type="date" class="form-control" id="Date"
                                                            name="Date" placeholder="Enter Date">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="mb-2">Action</label>
                                                    </div>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr >
                                                                <td cl>Mark</td>
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
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        <a class=" text-white fw-600 collapsed">Future plans</a>
                                    </div>
                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingOne"
                                        data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <div class="mb-4">
                                                    <label class="form-label" for="year2">Year</label>
                                                    <select class="js-select2 form-select is-invalid" id="year2"
                                                        name="year2" style="width: 100%;">
                                                        <option selected="selected" disabled="">Intended college
                                                            major
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
                                                        <option value="2011">2011&gt;</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="year3">Year</label>
                                                    <select class="js-select2 form-select is-invalid" id="year3"
                                                        name="year3" style="width: 100%;">
                                                        <option selected="selected" disabled="">Intended college
                                                            major
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
                                                        <option value="2011">2011&gt;</option>
                                                    </select>
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
                                        <a href="{{ route('admin-dashboard.highSchoolResume.honors') }}"
                                            class="btn btn-alt-primary next-step"> Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <style>
        .main-tab-container {
            padding: 40px 30px;
        }

        ul,
        li {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .custom-tab-container {
            padding: 50px 0;
        }

        .invalid {
            width: 100%;
            margin-top: 0.375rem;
            font-size: .875rem;
            color: #dc2626;
        }

        .is-invalid {
            border-color: #dc2626
        }

        .valid {
            border: 1px solid green;
            position: relative;
        }
        td{
            width: 200px;
        }

        .custom-tab-container ul li:focus-visible,
        .nav-link:focus-visible {
            outline: 0 !important;
        }

        .custom-drodown-course {
            width: 100%;
            border: 1px solid #dfe3ea;
            border-radius: 5px;
            display: none
        }

        .fa-pen {
            color: #1f2937;
            font-size: 16px;
            cursor: pointer;
        }

        .fa-circle-xmark {
            color: #ff3b3b;
            font-size: 16px;
            cursor: pointer;
        }
        element.style {
    width: 430px;
}

        table,
        th,
        td {
            border: none;
        }

        .custom-drodown-course ul {
            display: unset !important;
            justify-content: unset !important;
        }

        .custom-drodown-course ul li {
            margin-right: unset !important;
            text-align: unset !important;
            display: block !important;
            cursor: unset !important;
        }

        .custom-drodown-course ul li a {
            color: #1f2937;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            width: 100%;
            display: inline-block;
            padding: 10px
        }

        .custom-drodown-course ul li a:hover {
            background: #1f2937;
            color: #fff
        }

        .nav-link {
            background: transparent !important;
        }


        .select2-container .select2-selection--multiple {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            min-height: 33px;
            user-select: none;
            -webkit-user-select: none;
            min-width: 77.8vw !important;
        }

        .custom-tab-container ul li i {
            width: 50px;
            height: 50px;
            font-size: 22px;
            background-color: #a8a8a8;
            text-align: center;
            border-radius: 50%;
            line-height: 50px;
            margin-bottom: 20px;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dfe3ea !important;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #232d3a;
            position: absolute;
            top: -2px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            color: #1f2937 !important;
        }

        .fa-check {
            display: none;
        }

        .fa-check-block {
            display: inline-block
        }

        .custom-tab-container ul li a.active i {
            background-color: #1f2937;
            color: #fff;
        }

        .custom-tab-container ul li a {
            color: #1f2937;
        }

        .custom-tab-container ul li {
            margin-right: 50px;
            text-align: center;
            display: inline-block;
            cursor: pointer;
        }

        .nav-link {
            font-size: 16px !important;
            font-weight: 600;
            text-transform: uppercase;
            margin: 0;
            color: #545454 !important;
            padding: 0 !important;
            border: unset !important;
        }

        .custom-tab-container ul {
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
        }

        .nav-tabs {
            border: 0;
        }

        p {
            margin-bottom: 0;
        }

        .block-header-tab {
            background-color: #1f2937;
            text-align: center;
            justify-content: center;
            cursor: pointer;
        }

        .custom-tab-main {
            padding: 20px 0;
        }

        .add-btn i {
            width: 30px;
            height: 30px;
            background-color: #1f2937;
            color: #fff;
            text-align: center;
            border-radius: 50%;
            line-height: 31px;
            font-size: 16px;
        }

        .addbutton {
            position: absolute;
            top: 34px;
            right: 8px;
        }

        .td-width {
            width: 425px;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/boostrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_forms_validation.min.js') }}"></script>


    <script>
        $(document).ready(() => {
            // var navListItems = $('.custom-tab-container ul li a'),
            //     allWells = $('.setup-content'),
            //     allNextBtn = $('.next-step');
            //     allPrevBtn = $('.prev-step');

            // navListItems.click(function(e) {
            //     e.preventDefault();
            //     var $target = $($(this).attr('href')),
            //         $item = $(this);

            //     if (!$item.hasClass('disabled')) {
            //         navListItems.removeClass('active');
            //         $item.addClass('active');
            //         allWells.hide();
            //         $target.show();
            //         $target.find('input:eq(0)').focus();
            //     }
            // });


            // allNextBtn.click(function() {
            //     var curStep = allNextBtn.closest('.setup-content'),
            //         curStepBtn = curStep.attr("id"),
            //         nextStepWizard = $('.custom-tab-container ul li a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            //         // curInputs = curStep.find("input[type='text'],input[type='email']"),
            //         isValid = true;

            //         console.log(nextStepWizard);
            //     if (isValid)
            //         nextStepWizard.removeClass().trigger('click');
            // });

            // allPrevBtn.click(function() {
            //     var curStep = allPrevBtn.closest('.setup-content'),
            //         curStepBtn = curStep.attr("id"),
            //         prevtStepWizard = $('.custom-tab-container ul li a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
            //         // curInputs = curStep.find("input[type='text'],input[type='email']"),
            //         isValid = true;

            //         console.log(curStepBtn);

            //     if (isValid)
            //     prevtStepWizard.addClass().trigger('click');
            // });


            $(".select").select2({
                tags: true
            })

            $(".form-drop").click(function() {
                $(".custom-drodown-course").toggle();
            });

        });
    </script>
@endsection
