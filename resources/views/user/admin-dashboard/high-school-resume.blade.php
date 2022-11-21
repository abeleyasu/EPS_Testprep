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
                <!-- <span class="text-white-75">ACT/SAT/PSAT</span> -->
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="custom-tab-container">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
                <li role="presentation">
                    <a class="nav-link active" href="#step1" id="step1-tab" data-bs-toggle="tab" role="tab" aria-controls="step1">
                        <i class="fa-solid fa-envelope"></i>
                        <i class="fa-solid fa-check "></i>
                        <p>Personal Info</p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="#step2" id="step2-tab" data-bs-toggle="tab" role="tab" aria-controls="step2" aria-selected="false" title="Step 2">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <i class="fa-solid fa-check "></i>
                        <p>Education </p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="#step3" id="step3-tab" data-bs-toggle="tab" role="tab" aria-controls="step3" aria-selected="false" title="Step 3">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <i class="fa-solid fa-check "></i>
                        <p>Honors </p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="#step4" id="step4-tab" data-bs-toggle="tab" role="tab" aria-controls="step4" aria-selected="false" title="Step 4">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <i class="fa-solid fa-check "></i>
                        <p>Activities</p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="#step5" id="step4-tab" data-bs-toggle="tab" role="tab" aria-controls="step4" aria-selected="false" title="Step 4">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <i class="fa-solid fa-check "></i>
                        <p>Employment & <br> Certifications</p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="#step6" id="step4-tab" data-bs-toggle="tab" role="tab" aria-controls="step4" aria-selected="false" title="Step 4">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <i class="fa-solid fa-check "></i>
                        <p>Featured <br> Attributes</p>
                    </a>
                </li>
                <li role="presentation">
                    <a class="nav-link" href="#step7" id="step4-tab" data-bs-toggle="tab" role="tab" aria-controls="step4" aria-selected="false" title="Step 4">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <i class="fa-solid fa-check "></i>
                        <p>Preview</p>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                    <div class="accordion accordionExample">
                        <form>
                            <!-- personal-information start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <a class=" text-white fw-600 collapsed"> Personal info</a>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="First name">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Middle Name">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Last Name">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- personal-information end-->
                            <!-- Address start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <a class=" text-white fw-600 collapsed">Address</a>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Street Address 1">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Street Address 1 ">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="City">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="State">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Zip">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Address end-->
                            <!-- Contact-details start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <a class=" text-white fw-600 collapsed">Contact information</a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent=".accordionExample">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2">
                                                <input type="tel" class="form-control" placeholder="Cell phone">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="email" class="form-control" placeholder="Email">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="position-relative mb-2">
                                                <input type="text" class="form-control" placeholder="Social links">
                                                <span class="text-danger">Enter First Name</span>
                                                <div class="addbutton">
                                                    <a href="#" class="add-btn"><i class="fa-solid fa-plus"></i></a>
                                                </div>
                                            </div>
                                            <div class="position-relative d-none mb-2">
                                                <input type="text" class="form-control" placeholder="Social links">
                                                <span class="text-danger">Enter First Name</span>
                                                <div class="addbutton">
                                                    <a href="#" class="add-btn"><i class="fa-solid fa-minus"></i></a>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <input type="email" class="form-control" placeholder="Parent Email1 ">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Parent Email2">
                                                <span class="text-danger">Enter First Name</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact-details end-->
                            <div class="d-flex justify-content-end mt-3">
                                <div class="previous-btn opacity-5">
                                    <a href="#" class="btn me-2 prev-step">Previous</a>
                                </div>
                                <div class="next-btn">
                                    <a href="#" class="btn next-step">Next</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="step2" aria-labelledby="step2-tab">
                    <div class="accordion accordionExample2">
                        <form>
                            <!-- High school information start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <a class=" text-white fw-600 collapsed"> High school information</a>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Current grade">
                                                <span class="text-danger">Current grade</span>
                                            </div>
                                            <div class="mb-2">
                                                <select class="form-control">
                                                    <option>Projected Graduation Month</option>
                                                    <option>January</option>
                                                    <option>February</option>
                                                    <option>March</option>
                                                    <option>April</option>
                                                    <option>May</option>
                                                    <option>June</option>
                                                    <option>June</option>
                                                    <option>July</option>
                                                    <option>September</option>
                                                    <option>October</option>
                                                    <option>November</option>
                                                    <option>December</option>
                                                </select>
                                                <span class="text-danger">Projected Graduation Month</span>
                                            </div>
                                            <div class="mb-2">
                                                <select class="form-control">
                                                    <option>Projected Graduation Year</option>
                                                    <option>2000</option>
                                                    <option>2001</option>
                                                    <option>2002</option>
                                                    <option>2003</option>
                                                    <option>2004</option>
                                                    <option>2005</option>
                                                    <option>2006</option>
                                                    <option>2007</option>
                                                    <option>2008</option>
                                                    <option>2009</option>

                                                </select>
                                                <span class="text-danger">Projected Graduation Year</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="High School name">
                                                <span class="text-danger">Enter High School name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="High School city">
                                                <span class="text-danger">Enter High School city</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="High School state">
                                                <span class="text-danger">High School state</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="High School District">
                                                <span class="text-danger">Enter High School District</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- personal-information end-->
                            <!-- College information start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <a class=" text-white fw-600 collapsed">College information</a>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2">
                                                <label>
                                                    <input type="checkbox" checked="checked">
                                                    I have already graduated high school
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Grade level ">
                                                <span class="text-danger">Enter Grade level </span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Collage name">
                                                <span class="text-danger">Enter Collage name</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="search" class="form-control" placeholder="Collage city">
                                                <span class="text-danger">Enter Collage city</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Collage state">
                                                <span class="text-danger">Enter Collage state</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- College information end-->
                            <!-- Grades start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <a class=" text-white fw-600 collapsed">Contact information</a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Cumulative GPA (UNWEIGHTED)">
                                                <span class="text-danger">Enter Cumulative GPA (UNWEIGHTED)</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Cumulative GPA (WEIGHTED)”">
                                                <span class="text-danger">Enter Cumulative GPA (WEIGHTED)”</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Grades end-->
                            <!-- Class rank start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <a class=" text-white fw-600 collapsed">Class rank</a>
                                </div>
                                <div id="collapseFour" class="collapse" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2">
                                                <input type="number" class="form-control" placeholder="Class rank">
                                                <span class="text-danger">Class rank</span>
                                            </div>
                                            <div class="mb-2">
                                                <input type="number" class="form-control" placeholder="Cumulative GPA (WEIGHTED)”">
                                                <span class="text-danger">Enter Cumulative GPA (WEIGHTED)”</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Class rank end-->
                            <!-- Courses start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    <a class=" text-white fw-600 collapsed">Courses</a>
                                </div>
                                <div id="collapseFive" class="collapse" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2"> <select class="form-control select" multiple="multiple">
                                                    <option selected="selected">IB Courses </option>
                                                    <option>list 1</option>
                                                    <option>list 2</option>
                                                    <option>list 3</option>
                                                    <option>list 4</option>
                                                    <option>list 5</option>
                                                    <option>list 6</option>
                                                    <option>list 7</option>
                                                    <option>list 8</option>
                                                    <option>list 9</option>
                                                </select>
                                                <span class="text-danger">Projected Graduation Year</span>
                                            </div>
                                            <div class="mb-2">
                                                <select class="form-control select" multiple="multiple">
                                                    <option selected="selected">AP Courses </option>
                                                    <option>list 1</option>
                                                    <option>list 2</option>
                                                    <option>list 3</option>
                                                    <option>list 4</option>
                                                    <option>list 5</option>
                                                    <option>list 6</option>
                                                    <option>list 7</option>
                                                    <option>list 8</option>
                                                    <option>list 9</option>
                                                </select>
                                                <span class="text-danger">Projected Graduation Year</span>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-4">
                                                    <label class="mb-2">Course Name</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Collage English 101)">
                                                    <span class="text-danger">Enter Cumulative GPA (WEIGHTED)”</span>
                                                    <div class="custom-drodown-course d-none">
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
                                                    <label class="mb-2">College Name</label>
                                                    <input type="search" class="form-control" placeholder="Enter College ">
                                                    <span class="text-danger">Enter College”</span>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="mb-2">Action</label>
                                                </div>
                                                <table class="table d-none">
                                                    <tbody>
                                                        <tr>
                                                            <td class="td-width">Mark</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-width">Jacob</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-width">Larry the Bird</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-8">
                                                    <label class="mb-2">Course Name</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Collage English 101)">
                                                    <span class="text-danger">Enter Cumulative GPA (WEIGHTED)”</span>
                                                    <div class="custom-drodown-course d-none">
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
                                                <table class="table d-none">
                                                    <tbody>
                                                        <tr>
                                                            <td class="td-width">Mark</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-width">Jacob</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-width">Larry the Bird</td>
                                                            <td colspan="2"><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Courses end-->
                            <!-- Testing start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    <a class=" text-white fw-600 collapsed">Testing</a>
                                </div>
                                <div id="collapseSix" class="collapse" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="row mb-2">
                                                <div class="col-lg-3">
                                                    <label class="mb-2">Name of test</label>
                                                    <input type="text" class="form-control" placeholder="Name of test">
                                                    <span class="text-danger">Enter Cumulative GPA (WEIGHTED)”</span>
                                                    <div class="custom-drodown-course d-none">
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
                                                    <label class="mb-2">Results score</label>
                                                    <input type="search" class="form-control" placeholder="Results score">
                                                    <span class="text-danger">Enter College”</span>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="mb-2">Date</label>
                                                    <input type="date" class="form-control" placeholder="Date">
                                                    <span class="text-danger">Enter College”</span>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="mb-2">Action</label>
                                                </div>
                                                <table class="table ">
                                                    <tbody>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td >Mark</td>
                                                            <td><i class="fa-solid fa-pen me-2"></i> <i class="fa-solid fa-circle-xmark"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Testing end-->
                            <!-- Future plans start-->
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                    <a class=" text-white fw-600 collapsed">Future plans</a>
                                </div>
                                <div id="collapseSeven" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample2">
                                    <div class="block-content">
                                        <div class="main-form-input">
                                            <div class="mb-2">
                                                <select class="form-control">
                                                    <option>Intended college major</option>
                                                    <option>January</option>
                                                    <option>February</option>
                                                    <option>March</option>
                                                    <option>April</option>
                                                    <option>May</option>
                                                    <option>June</option>
                                                    <option>June</option>
                                                    <option>July</option>
                                                    <option>September</option>
                                                    <option>October</option>
                                                    <option>November</option>
                                                    <option>December</option>
                                                </select>
                                                <span class="text-danger">Intended college major</span>
                                            </div>
                                            <div class="mb-2">
                                                <select class="form-control">
                                                    <option>Intended college major</option>
                                                    <option>2000</option>
                                                    <option>2001</option>
                                                    <option>2002</option>
                                                    <option>2003</option>
                                                    <option>2004</option>
                                                    <option>2005</option>
                                                    <option>2006</option>
                                                    <option>2007</option>
                                                    <option>2008</option>
                                                    <option>2009</option>

                                                </select>
                                                <span class="text-danger">Intended college major</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Future plans end-->

                            <!-- button start -->
                            <div class="d-flex justify-content-end mt-3">
                                <div class="previous-btn opacity-5">
                                    <a href="#" class="btn me-2 prev-step">Previous</a>
                                </div>
                                <div class="next-btn">
                                    <a href="#" class="btn next-step">Next</a>
                                </div>
                            </div>
                            <!-- button end -->
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="step3" aria-labelledby="step3-tab">
                    <h3>Step 3</h3>
                    <div class="d-flex justify-content-end mt-3">
                        <div class="previous-btn opacity-5">
                            <a href="#" class="btn me-2 prev-step">Previous</a>
                        </div>
                        <div class="next-btn">
                            <a href="#" class="btn next-step">Next</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="step4" aria-labelledby="step4-tab">
                    step-4
                    <div class="d-flex justify-content-end mt-3">
                        <div class="previous-btn opacity-5">
                            <a href="#" class="btn me-2 prev-step">Previous</a>
                        </div>
                        <div class="next-btn">
                            <a href="#" class="btn next-step">Next</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="step5" aria-labelledby="step4-tab">
                    step-5
                    <div class="d-flex justify-content-end mt-3">
                        <div class="previous-btn opacity-5">
                            <a href="#" class="btn me-2 prev-step">Previous</a>
                        </div>
                        <div class="next-btn">
                            <a href="#" class="btn next-step">Next</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="step6" aria-labelledby="step4-tab">
                    step-6
                    <div class="d-flex justify-content-end mt-3">
                        <div class="previous-btn opacity-5">
                            <a href="#" class="btn me-2 prev-step">Previous</a>
                        </div>
                        <div class="next-btn">
                            <a href="#" class="btn next-step">Next</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="step7" aria-labelledby="step4-tab">
                    step-7
                    <div class="d-flex justify-content-end mt-3">
                        <div class="previous-btn opacity-5">
                            <a href="#" class="btn me-2 prev-step">Previous</a>
                        </div>
                        <div class="next-btn">
                            <input type="submit" class="btn" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
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

    .custom-tab-container ul li:focus-visible,
    .nav-link:focus-visible {
        outline: 0 !important;
    }

    .custom-drodown22 {
        width: 100%;
        border: 1px solid #1f2937 !important;
        padding: 10px;

    }

    .fa-pen {
        color: #1f2937;
        font-size: 16px;
        cursor: pointer;
    }

    .fa-circle-xmark {
        color: red;
        font-size: 16px;
        cursor: pointer;
    }

    .custom-drodown-course ul {
        display: unset !important;
        justify-content: unset !important;
    }

    .custom-drodown22 ul li {
        margin-right: unset !important;
        text-align: unset !important;
        display: block !important;
        cursor: unset !important;
    }

    .custom-drodown22 ul li a {
        color: #1f2937;
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 10px;
        display: inline-block;
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
        border: 1px solid #1f2937 !important;

    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        color: #1f2937 !important;
    }

    .nav-tabs .nav-link:focus,
    .nav-tabs .nav-link:hover {
        border: unset !important;
        isolation: unset !important;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background-color: transparent !important;
        border: none !important;
    }

    .tab-pane {
        display: none;
    }

    .fa-check {
        display: none;
    }

    .opacity-5 {
        opacity: .5;
    }

    .opacity-5 .btn {
        cursor: not-allowed !important;
    }

    .opacity-1 {
        opacity: 1;
    }

    .opacity-1 .btn {
        cursor: pointer !important;
    }

    .custom-tab-container ul li a.active i {
        background-color: #1f2937;
        color: #fff;
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

    .main-form-input .form-control {
        border: 1px solid #1f2937;
        color: #1f2937;
        font-size: 16px;
    }

    .form-control:focus {
        box-shadow: none;
    }

    .main-form-input .form-control::placeholder {
        color: #1f2937;
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
        top: 4px;
        right: 8px;
    }

    .btn {
        background-color: #1f2937;
        color: #fff;
    }

    .btn:hover {
        color: #fff;
    }

    .btn:focus {
        box-shadow: none;
    }

    .td-width {
        width: 67%;
        margin-left: 16px;
        display: inline-block;
    }
</style>
@endsection

@section('user-script')
<script src="{{ asset('assets/js/boostrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        //Advance Tabs
        $(".next-step").click(function() {
            const nextTabLinkEl = $(".nav-tabs .active")
                .closest("li")
                .next("li")
                .find("a")[0];
            const nextTab = new bootstrap.Tab(nextTabLinkEl);
            nextTab.show();
            $(".previous-btn").addClass("opacity-1");
            $(".previous-btn").addClass("opacity-5");
        });

        $(".prev-step").click(function() {
            const prevTabLinkEl = $(".nav-tabs .active")
                .closest("li")
                .prev("li")
                .find("a")[0];
            const prevTab = new bootstrap.Tab(prevTabLinkEl);
            prevTab.show();
        });


        $(".select").select2({
            tags: true
        })
    });
</script>
@endsection