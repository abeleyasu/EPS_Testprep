@extends('layouts.user')

@section('title', 'Initial College List : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    <h1 class="h2 text-white mb-0">Initial College List</h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="custom-tab-container">
                <div class="custom-college-container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li role="presentation">
                            <a class="nav-link " href="{{ route('admin-dashboard.initialCollegeList.selectingSearchParams') }}"
                                id="step1-tab">
                                <p class="d-none">1</p>
                                <i class="fa-solid fa-check d-block "></i>
                                <h6>Selecting Search <br> Parameters</h6>
                            </a>
                        </li>
                        <li role="presentation">
                            <a class="nav-link active" href="javascript:void(0)" id="step2-tab">
                                <p>2</p>
                                <i class="fa-solid fa-check  "></i>
                                <h6>College Search <br> Results</h6>
                            </a>
                        </li>
                        <li role="presentation">
                            <a class="nav-link" href="javascript:void(0)" id="step3-tab">
                                <p>3</p>
                                <i class="fa-solid fa-check "></i>
                                <h6>My Academic <br> Statistics</h6>
                            </a>
                        </li>
                        <li role="presentation">
                            <a class="nav-link" href="javascript:void(0)" id="step4-tab">
                                <p>4</p>
                                <i class="fa-solid fa-check "></i>
                                <h6>Academic Qualification <br> Comparison</h6>
                            </a>
                        </li>
                        <li role="presentation">
                            <a class="nav-link" href="javascript:void(0)" id="step5-tab">
                                <p>5</p>
                                <i class="fa-solid fa-check"></i>
                                <h6>College List</h6>
                            </a>
                        </li>
                    </ul>
                </div>
                <p class="mb-4">Here are your college search results from the Search Parameters you chose.</p>
                <div class="block block-rounded mb-3">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">UC BERKELEY</h3>
                        <div class="block-options">
                            <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                                data-bs-target="#college-details">College Details</button>
                            <button type="button" class="btn btn-sm btn-alt-success">Add to My College List</button>
                        </div>
                    </div>
                    <div class="block-content mb-">
                        <div class="college-search-wrapper">
                            <h2>Berkeley, CA</h2>
                            <div class="college-search-box">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="block block-rounded text-center mb-3">
                                            <div class="block-content py-3 bg-info-light">
                                                <i class="fa fa-4 fa-2x"></i>
                                                <div class="fs-3 fw-semibold mt-3">Year</div>
                                                <div class="">College</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="block block-rounded text-center mb-3">
                                            <div class="block-content py-3 bg-danger-light">
                                                <i class="fa fa-building fa-2x"></i>
                                                <div class="fs-3 fw-semibold mt-3">Public</div>
                                                <div>University</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="block block-rounded text-center mb-3">
                                            <div class="block-content py-3 bg-primary-lighter">
                                                <i class="fa fa-city fa-2x"></i>
                                                <div class="fs-3 fw-semibold mt-3">Campus</div>
                                                <div>City</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="block block-rounded text-center mb-3">
                                            <div class="block-content py-3 bg-gray-dark">
                                                <i class="fa fa-users fa-2x text-white"></i>
                                                <div class="fs-3 fw-semibold mt-3 text-white">Size</div>
                                                <div class="text-white">Large</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="college-text">
                                            <p><b>Acceptance Rate:</b> 23%</p>
                                            <p><b>Average Annual Cost:</b> $56k</p>
                                            <p><b>Median Earnings:</b> $98k</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>This school is known for its...</p>
                    </div>

                </div>
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">CU DENVER</h3>
                        <div class="block-options">
                            <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                                data-bs-target="#college-details_1">College Details</button>
                            <button type="button" class="btn btn-sm btn-alt-success">Add to My College List</button>
                        </div>
                    </div>
                    <div class="block-content mb-">
                        <div class="college-search-wrapper">
                            <h2>Berkeley, CA</h2>
                            <div class="college-search-box">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="block block-rounded text-center mb-3">
                                            <div class="block-content py-3 bg-info-light">
                                                <i class="fa fa-4 fa-2x"></i>
                                                <div class="fs-3 fw-semibold mt-3">Year</div>
                                                <div class="">College</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="block block-rounded text-center mb-3">
                                            <div class="block-content py-3 bg-danger-light">
                                                <i class="fa fa-building fa-2x"></i>
                                                <div class="fs-3 fw-semibold mt-3">Public</div>
                                                <div>University</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="block block-rounded text-center mb-3">
                                            <div class="block-content py-3 bg-primary-lighter">
                                                <i class="fa fa-city fa-2x"></i>
                                                <div class="fs-3 fw-semibold mt-3">Campus</div>
                                                <div>City</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="block block-rounded text-center mb-3">
                                            <div class="block-content py-3 bg-gray-dark">
                                                <i class="fa fa-users fa-2x text-white"></i>
                                                <div class="fs-3 fw-semibold mt-3 text-white">Size</div>
                                                <div class="text-white">Large</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="college-text">
                                            <p><b>Acceptance Rate:</b> 56%</p>
                                            <p><b>Average Annual Cost:</b> $32k</p>
                                            <p><b>Median Earnings:</b> $75k</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>This school is known for its...</p>
                    </div>

                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="prev-btn">
                        <a href="{{ route('admin-dashboard.initialCollegeList.selectingSearchParams') }}" class="btn btn-alt-success prev-step"> Previous Step
                        </a>
                    </div>
                    <div class="">
                        <a href="{{ route('admin-dashboard.initialCollegeList.AcademicStatistics') }}"
                            class="btn  btn-alt-success next-step">Next Step</a>
                    </div>
                    {{-- <div class="next-btn">
                        <input type="submit" class="btn btn-alt-success next-step" value="Next Step">
                    </div> --}}
                </div>
            </div>
        </div>
    </main>

    <!--College-search-tool1 Modal -->
    <div class="modal" id="college-details" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default block-header-modal">
                        <h3 class="block-title">UC Berkeley</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-college fs-sm">
                        <div class="tab-content" id="myTabContent">
                            <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                <div class="accordion accordionExample accordionExamplemain">
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa fa-2x fa-circle-info"></i>College Overview</a>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                <div class="college-search-modal-text">
                                                    <p>Get a quick look at the most important information in the College
                                                        Overview,
                                                        or go to each individual dropdown for detailed information about
                                                        each aspect
                                                        of the college.</p>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="block block-rounded text-center mb-3">
                                                                <div class="block-content py-3 bg-info-light">
                                                                    <i class="fa fa-4 fa-2x"></i>
                                                                    <div class="fs-3 fw-semibold mt-3">Year</div>
                                                                    <div class="">College</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="block block-rounded text-center mb-3">
                                                                <div class="block-content py-3 bg-danger-light">
                                                                    <i class="fa fa-building fa-2x"></i>
                                                                    <div class="fs-3 fw-semibold mt-3">Public</div>
                                                                    <div>University</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="block block-rounded text-center mb-3">
                                                                <div class="block-content py-3 bg-primary-lighter">
                                                                    <i class="fa fa-city fa-2x"></i>
                                                                    <div class="fs-3 fw-semibold mt-3">Campus</div>
                                                                    <div>City</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="block block-rounded text-center mb-3">
                                                                <div class="block-content py-3 bg-gray-dark">
                                                                    <i class="fa fa-users fa-2x text-white"></i>
                                                                    <div class="fs-3 fw-semibold mt-3 text-white">Size
                                                                    </div>
                                                                    <div class="text-white">Large</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <h2 class="fs-base lh-base fw-large mb-0"><a class="text-info"
                                                            href="#">Website <i class="fa fa-arrow-right"></i></a>
                                                    </h2>
                                                    <h4 class="h5 mt-3 mb-2">
                                                        <a href="javascript:void(0)">Description</a>
                                                    </h4>
                                                    <p class="">
                                                        Berkeley is a large, primarily residential Tier One research
                                                        university with a majority of its enrollment in undergraduate
                                                        programs but also offering a comprehensive doctoral program. The
                                                        four-year, full-time undergraduate program offers 107 bachelor's
                                                        degrees.
                                                    </p>
                                                    <b>Still can't get map to show up on right</b>
                                                    <div class="mb-5"><iframe scrolling="no" marginheight="0"
                                                            marginwidth="0"
                                                            src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=110%20Sproul%20Hall%20Berkeley,%20CA%2094720+(UC%20Berkeley)&amp;t=&amp;z=3&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                                            width="" height="" frameborder="0"><a
                                                                href="https://www.maps.ie/distance-area-calculator.html">measure
                                                                distance on map</a></iframe></div>

                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-graduation-cap"></i> Admissions</h2>
                                                    <h2 class="block-title mb-3">Entrance difficulty<br>
                                                        <small><b>Very
                                                                difficult</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">OVERALL ADMISSION RATE<br>
                                                        <small><b>20% out of 32,131 total applicants</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE ACCEPTED GPA<br>
                                                        <small><b>3.89</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE ACT / SAT SCORES<br>
                                                        <small><b>30 / 1350</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">ENROLLMENT<br>
                                                        <small><b>4,214 Undergraduates</b></small>
                                                    </h2>
                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-comments-dollar"></i> Cost</h2>
                                                    <h2 class="block-title mb-3">COST OF ATTENDANCE<br>
                                                        <small><b>$80,968</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">TUITION AND FEES<br>
                                                        <small><b>$61,706</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">ROOM AND BOARD<br>
                                                        <small><b>$16,312</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE PERCENT OF NEED MET<br>
                                                        <small><b>100%</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE FRESHMAN AWARD<br>
                                                        <small><b>$46,417</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE INDEBTEDNESS OF 2018 GRADUATES<br>
                                                        <small><b>$23,136</b></small>
                                                    </h2>
                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-chalkboard"></i> Academics</h2>
                                                    <h2 class="block-title mb-3">ACADEMIC CALENDAR SYSTEM<br>
                                                        <small><b>Semester</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE CLASS SIZE<br>
                                                        <small><b>24</b></small>
                                                    </h2>
                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-basketball"></i> Campus Life</h2>
                                                    <h2 class="block-title mb-3">CITY POPULATION<br>
                                                        <small><b>19,440</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">NEAREST METRO AREA<br>
                                                        <small><b>Boston</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">ATHLETIC CONFERENCES<br>
                                                        <small><b>NCAA Division I</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">SORORITIES & FRATERNITIES<br>
                                                        <small><b>Not Reported </b></small>
                                                    </h2>
                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-user"></i> Student Demographics</h2>
                                                    <h2 class="block-title mb-3">RACE/ETHNICITY<br>
                                                        <small><b>*Show Bar Graph* </b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">FIRST-YEAR STUDENTS RETURNING<br>
                                                        <small><b>95.0%</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">STUDENTS GRADUATING WITHIN 4 YEARS <br>
                                                        <small><b>90.0%</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">GRADUATES OFFERED FULL-TIME EMPLOYMENT
                                                        WITHIN 6 MONTHS<br>
                                                        <small><b>73%</b></small>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Costs</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                <div class="block-content">
                                                    <a class="block block-rounded block-link-shadow text-center"
                                                        href="javascript:void(0)">
                                                        <div class="block-header">
                                                            <h3 class="block-title">Average Annual Cost</h3>
                                                        </div>
                                                        <div class="block-content bg-success-light">
                                                            <div class="py-2">
                                                                <p class="h1 fw-bold text-success mb-2">$41,334</p>
                                                            </div>
                                                        </div>
                                                        <div class="block-content">
                                                            <table class="table table-striped table-vcenter">
                                                                <thead>
                                                                    <tr>

                                                                        <th>Family Income</th>
                                                                        <th class="d-none d-sm-table-cell">Average Annual
                                                                            Cost</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <p>$0-$30,000</p>
                                                                        </td>
                                                                        <td class="fw-semibold">
                                                                            <p><strong>$23,297</strong></p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <p>$30,001-$48,000</p>
                                                                        </td>
                                                                        <td class="fw-semibold">
                                                                            <p><strong>$27,303</strong></p>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <p>$48,001-$75,000</p>
                                                                        </td>
                                                                        <td class="fw-semibold">
                                                                            <p><strong>$31,754</strong></p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Fields of Study</a>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab" type="button"
                                                        data-toggle="collapse" data-target="#collapseFour"
                                                        aria-expanded="true" aria-controls="collapseFour">
                                                        <a class=" text-white fw-600 collapsed"><i
                                                                class="fa-solid fa-circle-check me-2"></i> Architecture</a>
                                                    </div>
                                                    <div id="collapseFour" class="collapse "
                                                        aria-labelledby="headingOne1" data-parent=".accordionExamplemain">
                                                        <div class="college-content-wrapper college-content">
                                                            <p><b>Salary After Completing</b></p>
                                                            <p>Median Earnings <b>$79,000</b></p>
                                                            <p><b>Financial Aid & Debt</b></p>
                                                            <p>Median Debt After Graduation <b>$25,000</b></p>
                                                            <p><b>Additional Information</b></p>
                                                            <p class="mb-0">Number of Graduates <b>250</b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab" type="button"
                                                        data-toggle="collapse" data-target="#collapseFive"
                                                        aria-expanded="true" aria-controls="collapseFive">
                                                        <a class=" text-white fw-600 collapsed"><i
                                                                class="fa-solid fa-circle-check me-2"></i> Accounting</a>
                                                    </div>
                                                    <div id="collapseFive" class="collapse" aria-labelledby="headingOne1"
                                                        data-parent=".accordionExamplemain">
                                                        <div class="college-content-wrapper college-content">
                                                            <p><b>Salary After Completing</b></p>
                                                            <p>Median Earnings <b>$79,000</b></p>
                                                            <p><b>Financial Aid & Debt</b></p>
                                                            <p>Median Debt After Graduation <b>$25,000</b></p>
                                                            <p><b>Additional Information</b></p>
                                                            <p class="mb-0">Number of Graduates <b>250</b></p>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Graduation &
                                                Retention</a>
                                        </div>
                                        <div id="collapseSix" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Words
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseSeven" aria-expanded="true"
                                            aria-controls="collapseSeven">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Financial Aid & Debt</a>
                                        </div>
                                        <div id="collapseSeven" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseEight" aria-expanded="true"
                                            aria-controls="collapseEight">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Typical Earnings</a>
                                        </div>
                                        <div id="collapseEight" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseNine" aria-expanded="true"
                                            aria-controls="collapseNine">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Student Body</a>
                                        </div>
                                        <div id="collapseNine" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Test Scores &
                                                Acceptance</a>
                                        </div>
                                        <div id="collapseTen" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseEleven" aria-expanded="true"
                                            aria-controls="collapseEleven">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Admissions
                                                Requirements</a>
                                        </div>
                                        <div id="collapseEleven" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="block-content block-content-full text-end">
                        <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn submit-btn" id="updateHonorForm"
                            onclick="updateHonorForm(this)">Submit</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!--Honors Modal -->

    <!--College-search-tool2 Modal -->
    <div class="modal" id="college-details_1" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default block-header-modal">
                        <h3 class="block-title">UC Berkeley</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-college fs-sm">
                        <div class="tab-content" id="myTabContent">
                            <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                <div class="accordion accordionExample accordionExamplemain">
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa fa-2x fa-circle-info"></i>College Overview</a>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                <div class="college-search-modal-text">
                                                    <p>Get a quick look at the most important information in the College
                                                        Overview,
                                                        or go to each individual dropdown for detailed information about
                                                        each aspect
                                                        of the college.</p>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="block block-rounded text-center mb-3">
                                                                <div class="block-content py-3 bg-info-light">
                                                                    <i class="fa fa-4 fa-2x"></i>
                                                                    <div class="fs-3 fw-semibold mt-3">Year</div>
                                                                    <div class="">College</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="block block-rounded text-center mb-3">
                                                                <div class="block-content py-3 bg-danger-light">
                                                                    <i class="fa fa-building fa-2x"></i>
                                                                    <div class="fs-3 fw-semibold mt-3">Public</div>
                                                                    <div>University</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="block block-rounded text-center mb-3">
                                                                <div class="block-content py-3 bg-primary-lighter">
                                                                    <i class="fa fa-city fa-2x"></i>
                                                                    <div class="fs-3 fw-semibold mt-3">Campus</div>
                                                                    <div>City</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="block block-rounded text-center mb-3">
                                                                <div class="block-content py-3 bg-gray-dark">
                                                                    <i class="fa fa-users fa-2x text-white"></i>
                                                                    <div class="fs-3 fw-semibold mt-3 text-white">Size
                                                                    </div>
                                                                    <div class="text-white">Large</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <h2 class="fs-base lh-base fw-large mb-0"><a class="text-info"
                                                            href="#">Website <i class="fa fa-arrow-right"></i></a>
                                                    </h2>
                                                    <h4 class="h5 mt-3 mb-2">
                                                        <a href="javascript:void(0)">Description</a>
                                                    </h4>
                                                    <p class="">
                                                        Berkeley is a large, primarily residential Tier One research
                                                        university with a majority of its enrollment in undergraduate
                                                        programs but also offering a comprehensive doctoral program. The
                                                        four-year, full-time undergraduate program offers 107 bachelor's
                                                        degrees.
                                                    </p>
                                                    <b>Still can't get map to show up on right</b>
                                                    <div class="mb-5"><iframe scrolling="no" marginheight="0"
                                                            marginwidth="0"
                                                            src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=110%20Sproul%20Hall%20Berkeley,%20CA%2094720+(UC%20Berkeley)&amp;t=&amp;z=3&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                                            width="" height="" frameborder="0"><a
                                                                href="https://www.maps.ie/distance-area-calculator.html">measure
                                                                distance on map</a></iframe></div>

                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-graduation-cap"></i> Admissions</h2>
                                                    <h2 class="block-title mb-3">Entrance difficulty<br>
                                                        <small><b>Very
                                                                difficult</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">OVERALL ADMISSION RATE<br>
                                                        <small><b>20% out of 32,131 total applicants</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE ACCEPTED GPA<br>
                                                        <small><b>3.89</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE ACT / SAT SCORES<br>
                                                        <small><b>30 / 1350</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">ENROLLMENT<br>
                                                        <small><b>4,214 Undergraduates</b></small>
                                                    </h2>
                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-comments-dollar"></i> Cost</h2>
                                                    <h2 class="block-title mb-3">COST OF ATTENDANCE<br>
                                                        <small><b>$80,968</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">TUITION AND FEES<br>
                                                        <small><b>$61,706</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">ROOM AND BOARD<br>
                                                        <small><b>$16,312</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE PERCENT OF NEED MET<br>
                                                        <small><b>100%</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE FRESHMAN AWARD<br>
                                                        <small><b>$46,417</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE INDEBTEDNESS OF 2018 GRADUATES<br>
                                                        <small><b>$23,136</b></small>
                                                    </h2>
                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-chalkboard"></i> Academics</h2>
                                                    <h2 class="block-title mb-3">ACADEMIC CALENDAR SYSTEM<br>
                                                        <small><b>Semester</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">AVERAGE CLASS SIZE<br>
                                                        <small><b>24</b></small>
                                                    </h2>
                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-basketball"></i> Campus Life</h2>
                                                    <h2 class="block-title mb-3">CITY POPULATION<br>
                                                        <small><b>19,440</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">NEAREST METRO AREA<br>
                                                        <small><b>Boston</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">ATHLETIC CONFERENCES<br>
                                                        <small><b>NCAA Division I</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">SORORITIES & FRATERNITIES<br>
                                                        <small><b>Not Reported </b></small>
                                                    </h2>
                                                    <h2 class="fs-base lh-base fw-large mb-3 border-bottom"><i
                                                            class="fa fa-user"></i> Student Demographics</h2>
                                                    <h2 class="block-title mb-3">RACE/ETHNICITY<br>
                                                        <small><b>*Show Bar Graph* </b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">FIRST-YEAR STUDENTS RETURNING<br>
                                                        <small><b>95.0%</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">STUDENTS GRADUATING WITHIN 4 YEARS <br>
                                                        <small><b>90.0%</b></small>
                                                    </h2>
                                                    <h2 class="block-title mb-3">GRADUATES OFFERED FULL-TIME EMPLOYMENT
                                                        WITHIN 6 MONTHS<br>
                                                        <small><b>73%</b></small>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Costs</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                <div class="block-content">
                                                    <a class="block block-rounded block-link-shadow text-center"
                                                        href="javascript:void(0)">
                                                        <div class="block-header">
                                                            <h3 class="block-title">Average Annual Cost</h3>
                                                        </div>
                                                        <div class="block-content bg-success-light">
                                                            <div class="py-2">
                                                                <p class="h1 fw-bold text-success mb-2">$41,334</p>
                                                            </div>
                                                        </div>
                                                        <div class="block-content">
                                                            <table class="table table-striped table-vcenter">
                                                                <thead>
                                                                    <tr>

                                                                        <th>Family Income</th>
                                                                        <th class="d-none d-sm-table-cell">Average Annual
                                                                            Cost</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <p>$0-$30,000</p>
                                                                        </td>
                                                                        <td class="fw-semibold">
                                                                            <p><strong>$23,297</strong></p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <p>$30,001-$48,000</p>
                                                                        </td>
                                                                        <td class="fw-semibold">
                                                                            <p><strong>$27,303</strong></p>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <p>$48,001-$75,000</p>
                                                                        </td>
                                                                        <td class="fw-semibold">
                                                                            <p><strong>$31,754</strong></p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Fields of Study</a>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab" type="button"
                                                        data-toggle="collapse" data-target="#collapseFour"
                                                        aria-expanded="true" aria-controls="collapseFour">
                                                        <a class=" text-white fw-600 collapsed"><i
                                                                class="fa-solid fa-circle-check me-2"></i> Architecture</a>
                                                    </div>
                                                    <div id="collapseFour" class="collapse "
                                                        aria-labelledby="headingOne1" data-parent=".accordionExamplemain">
                                                        <div class="college-content-wrapper college-content">
                                                            <p><b>Salary After Completing</b></p>
                                                            <p>Median Earnings <b>$79,000</b></p>
                                                            <p><b>Financial Aid & Debt</b></p>
                                                            <p>Median Debt After Graduation <b>$25,000</b></p>
                                                            <p><b>Additional Information</b></p>
                                                            <p class="mb-0">Number of Graduates <b>250</b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab" type="button"
                                                        data-toggle="collapse" data-target="#collapseFive"
                                                        aria-expanded="true" aria-controls="collapseFive">
                                                        <a class=" text-white fw-600 collapsed"><i
                                                                class="fa-solid fa-circle-check me-2"></i> Accounting</a>
                                                    </div>
                                                    <div id="collapseFive" class="collapse" aria-labelledby="headingOne1"
                                                        data-parent=".accordionExamplemain">
                                                        <div class="college-content-wrapper college-content">
                                                            <p><b>Salary After Completing</b></p>
                                                            <p>Median Earnings <b>$79,000</b></p>
                                                            <p><b>Financial Aid & Debt</b></p>
                                                            <p>Median Debt After Graduation <b>$25,000</b></p>
                                                            <p><b>Additional Information</b></p>
                                                            <p class="mb-0">Number of Graduates <b>250</b></p>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Graduation &
                                                Retention</a>
                                        </div>
                                        <div id="collapseSix" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Words
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseSeven" aria-expanded="true"
                                            aria-controls="collapseSeven">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Financial Aid & Debt</a>
                                        </div>
                                        <div id="collapseSeven" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseEight" aria-expanded="true"
                                            aria-controls="collapseEight">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Typical Earnings</a>
                                        </div>
                                        <div id="collapseEight" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseNine" aria-expanded="true"
                                            aria-controls="collapseNine">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Student Body</a>
                                        </div>
                                        <div id="collapseNine" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Test Scores &
                                                Acceptance</a>
                                        </div>
                                        <div id="collapseTen" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                            data-target="#collapseEleven" aria-expanded="true"
                                            aria-controls="collapseEleven">
                                            <a class=" text-white fw-600 collapsed"><i
                                                    class="fa-solid fa-comments-dollar me-2"></i> Admissions
                                                Requirements</a>
                                        </div>
                                        <div id="collapseEleven" class="collapse" aria-labelledby="headingOne"
                                            data-parent=".accordionExample">
                                            <div class="college-content-wrapper college-content">
                                                Input various costs of each college you're considering to compare the
                                                difference in final cost. This tool provides a more realistic look at the
                                                costs because you can input tuition, fees, scholarships, and more that are
                                                unique to each college.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="block-content block-content-full text-end">
                     <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="btn submit-btn" id="updateHonorForm"
                         onclick="updateHonorForm(this)">Submit</button>
                 </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!--Honors Modal -->

@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
@endsection


@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/selecting-search-params.js') }}"></script>
@endsection
