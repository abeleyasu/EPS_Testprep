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
                            <a class="nav-link "
                                href="{{ route('admin-dashboard.initialCollegeList.selectingSearchParams') }}"
                                id="step1-tab">
                                <p class="d-none">1</p>
                                <i class="fa-solid fa-check d-block "></i>
                                <h6>Selecting Search <br> Parameters</h6>
                            </a>
                        </li>
                        <li role="presentation">
                            <a class="nav-link "
                                href="{{ route('admin-dashboard.initialCollegeList.CollegeSearchResults') }}"
                                id="step2-tab">
                                <p class="d-none">2</p>
                                <i class="fa-solid fa-check d-block "></i>
                                <h6>College Search <br> Results</h6>
                            </a>
                        </li>
                        <li role="presentation">
                            <a class="nav-link active" href="javascript:void(0)" id="step3-tab">
                                <p>3</p>
                                <i class="fa-solid fa-check"></i>
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


                <div class="row">
                    <!-- BEGIN TEST PREP TOOLS CONTENT BOX -->
                    <div class="col-md-8 col-xl-7">
                        <div class="block block-rounded">
                            <div class="block-header block-header-default text-white" style="background: #000">
                                <h3 class="block-title">
                                    <i class="fa fa-screwdriver-wrench text-white me-1"></i> MY STATISTICS
                                </h3>
                            </div>
                            <div class="block-content">
                                <div id="faq6" class="mb-5" role="tablist" aria-multiselectable="true">
                                    <!-- BEGIN Accordion Block 1 STUDY AND PRACTICE CALENDAR -->
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-default" role="tab" id="faq6_h1">
                                            <a class="text-dark collapsed" data-bs-toggle="collapse" data-bs-parent="#faq6"
                                                href="#faq6_q1" aria-expanded="false" aria-controls="faq6_q1"><i
                                                    class="nav-main-link-icon fa fa-clock"></i> High School GPA</a>
                                        </div>
                                        <div id="faq6_q1" class="collapse" role="tabpanel" aria-labelledby="faq6_h1"
                                            data-bs-parent="#faq6" style="">
                                            <div class="block-content">
                                                <!-- Calendar -->
                                                <div class="block block-rounded">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="example-select">Select Test
                                                            Type</label>
                                                        <select class="form-select" id="example-select"
                                                            name="example-select">
                                                            <option selected="">Select One</option>
                                                            <option value="1">ACT</option>
                                                            <option value="2">SAT</option>
                                                            <option value="3">PSAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 mb-4">
                                                        <label class="form-label" for="example-select">Select Test
                                                            Date</label>
                                                        <input type="date" class="js-datepicker form-control"
                                                            id="example-datepicker1" name="example-datepicker1"
                                                            data-week-start="1" data-autoclose="true"
                                                            data-today-highlight="true" data-date-format="mm/dd/yy"
                                                            placeholder="mm/dd/yy">
                                                    </div>
                                                </div>
                                                <!-- END Calendar -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Accordion Block 1 STUDY AND PRACTICE CALENDAR -->
                                    <!-- BEGIN Accordion Block 2 TEST PROCTOR -->
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-default" role="tab" id="faq12_h1">
                                            <a class="text-dark collapsed" data-bs-toggle="collapse" data-bs-parent="#faq6"
                                                href="#faq12_q1" aria-expanded="false" aria-controls="faq12_q1"><i
                                                    class="nav-main-link-icon fa fa-clock"></i>
                                                Test Proctor</a>
                                        </div>
                                        <div id="faq12_q1" class="collapse" role="tabpanel" aria-labelledby="faq12_h1"
                                            data-bs-parent="#faq6" style="">
                                            <div class="block-content">
                                                <!-- Updates -->
                                                Use this to track timing as you take official tests on paper.
                                                Use the Test Proctor when you take any Official or Unofficial Practice
                                                ACT/SAT/PSAT on paper. The Test Proctor will track and record your time on
                                                each
                                                section whether you finish early, on time, or late. This will help you track
                                                your timing improvements for each new test you take. At the end of the test,
                                                you'll be able to score your official practice test using our Exam Analyzer
                                                or
                                                record your scores if you took an unofficial practice test. Remember, if
                                                you've
                                                already take an Official Practice Test, you can score it below in the
                                                "Official
                                                Practice Test <b>Exam Analyzer</b> &amp; Scoring Tool" tab.
                                                <br><br>
                                                <span>Select Test Type</span><br>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">SAT</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">PSAT</button>

                                                <br><br>
                                                <!--
                        
                                                    <span>Select Test Source</span>
                                                    <br />
                                                    <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>Official ACT Practice Test</button>
                                                    <br /> -->
                                                <!-- I REMOVED THE TEST SOURCE FROM HERE SO THAT IT'S EASY TO JUST START USING THE TEST PROCTOR... AFTER THE TEST PROCTOR IS USED, IT WILL PROMPT THE USER TO GO INPUT THEIR ANSWER CHOICES IN THE "OFFICIAL TEST ANALYZER & SCORE CALCULATOR" BY PROVIDING A LINK TO THAT PAGE... IF THEY DIDN'T TAKE AN OFFICIAL TEST, THEN THEY CAN IGNORE THE PROMPT -->
                                                <!-- If user selects "Official Practice Test", show them the following options -->
                                                <!--
                                                    <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-info text-gray"></i>ACT 74F April 2017</button>
                                                    <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-info text-gray"></i>ACT A09 December 2019</button>
                                                    <br />
                                                    <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>College Prep System Practice Test</button>
                                                    <br /> -->
                                                <!-- If user selects "College Prep System Practice Test", show them the following options -->
                                                <!--
                                                    <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-info text-gray"></i>College Prep System ACT #1</button>
                                                    <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-info text-gray"></i>College Prep System ACT #2</button>
                                                    <br />
                                                    <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>Other Test</button>
                                                    <br /> -->
                                                <!-- If user selects "Other Test", go to next set of options "Select Section(s)" -->


                                                <span>Select Section(s)</span><br>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">All
                                                    (Full Test)</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT
                                                    English</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT
                                                    Math</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT
                                                    Reading</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT
                                                    Science</button>

                                                <br><br>
                                                <span>Click to Get Started</span><br>
                                                <button type="button"
                                                    class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success text-gray">Enter
                                                    Test Proctor</button>

                                                <br>





                                                <!-- END Updates -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Accordion Block 2 TEST PROCTOR -->

                                    <!-- BEGIN Accordion Block 3 EXAM ANALYZER -->
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-default" role="tab" id="faq13_h1">
                                            <a class="text-dark collapsed" data-bs-toggle="collapse"
                                                data-bs-parent="#faq6" href="#faq13_q1" aria-expanded="false"
                                                aria-controls="faq13_q1"><i class="nav-main-link-icon fa fa-clock"></i>
                                                Exam Analyzer</a>
                                        </div>
                                        <div id="faq13_q1" class="collapse" role="tabpanel" aria-labelledby="faq13_h1"
                                            data-bs-parent="#faq6" style="">
                                            <div class="block-content">
                                                <!-- Updates -->
                                                This is information about the Exam Analyzer. This tells you how it works and
                                                maybe links you to the page that lets you get started with it, such as
                                                picking a
                                                test, using the score calculator, then reviewing the analyzed test's
                                                categories,
                                                question types, answer types, etc.
                                                <br><br>
                                                <span>Select Test Type</span><br>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">SAT</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">PSAT</button>

                                                <br><br>


                                                <span>Select Section(s)</span><br>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">All
                                                    (Full Test)</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT
                                                    English</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT
                                                    Math</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT
                                                    Reading</button>
                                                <button type="button"
                                                    class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray">ACT
                                                    Science</button>

                                                <br><br>
                                                <span>Click to Get Started</span><br>
                                                <button type="button"
                                                    class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success text-gray">Enter
                                                    Exam Analyzer</button>

                                                <br>





                                                <!-- END Updates -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Accordion Block 3 EXAM ANALYZER -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TEST PREP TOOLS CONTENT BOX -->
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <div class="prev-btn">
                        <a href="{{ route('admin-dashboard.initialCollegeList.CollegeSearchResults') }}"
                            class="btn btn-alt-success prev-step"> Previous Step
                        </a>
                    </div>
                    <div class="">
                        <a href="{{ route('admin-dashboard.initialCollegeList.selectingSearchParams') }}"
                            class="btn  btn-alt-success next-step">Next Step</a>
                    </div>
                    {{-- <div class="next-btn">
                        <input type="submit" class="btn btn-alt-success next-step" value="Next Step">
                    </div> --}}
                </div>
            </div>
        </div>
    </main>
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
