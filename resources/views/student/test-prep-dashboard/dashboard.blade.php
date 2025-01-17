@extends('layouts.user')

@section('title', 'Student View Dashboard : CPS')

@section('user-content')
@can('Access Test Prep Dashboard')
    <!-- Main Container -->

    <main id="main-container">
        <!-- Hero -->
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>

                    <h1 class="h2 text-white mb-0">Test Prep Dashboard</h1>
                    <br>
                    <span class="text-white-75">ACT/SAT/PSAT</span>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Stats -->
        <div class="bg-body-extra-light">
            <div class="content content-boxed">
                @include('components.test-prep.test-score', [
                    'getTestScores' => $getTestScores,
                ])
            </div>
        </div>
        <!-- END Stats -->




        <!-- Page Content -->
        <!-- <div class="bg-body-extra-light"> -->
        <div class="content">
            <div class="row">
                <!-- BEGIN TEST PREP TOOLS CONTENT BOX -->
                <div class="col-md-8 col-xl-7">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default text-white" style="background: #000">
                            <h3 class="block-title">
                                <i class="fa fa-screwdriver-wrench text-white me-1"></i> Test Prep Tools
                            </h3>
                        </div>
                        <div class="block-content">
                            <div id="faq6" class="mb-5" role="tablist" aria-multiselectable="true">


                                <!-- BEGIN Accordion Block 1 STUDY AND PRACTICE CALENDAR -->
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-default" role="tab" id="faq6_h1">
                                        <a class="text-dark" data-bs-toggle="collapse" data-bs-parent="#faq6"
                                            href="#faq6_q1" aria-expanded="true" aria-controls="faq6_q1"><i
                                                class="nav-main-link-icon fa fa-calendar"></i> Study &amp; Practice
                                            Calendar</a>
                                    </div>
                                    <div id="faq6_q1" class="collapse show" role="tabpanel" aria-labelledby="faq6_h1"
                                        data-bs-parent="#faq6">
                                        <div class="block-content">
                                            <!-- Calendar -->
                                            <div class="block block-rounded">
                                                <div class="block-content">
                                                    @include('components.test-prep.calendar', [
                                                        'events' => $events
                                                    ])
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
                                        <a class="text-dark" data-bs-toggle="collapse" data-bs-parent="#faq6"
                                            href="#faq12_q1" aria-expanded="true" aria-controls="faq12_q1"><i
                                                class="nav-main-link-icon fa fa-clock"></i> Test Proctor</a>
                                    </div>
                                    <div id="faq12_q1" class="collapse" role="tabpanel" aria-labelledby="faq12_h1"
                                        data-bs-parent="#faq6">
                                        <div class="block-content">
                                            <!-- Updates -->
                                            Use this to track timing as you take official tests on paper.
                                            Use the Test Proctor when you take any Official or Unofficial Practice
                                            ACT/SAT/PSAT on paper. The Test Proctor will track and record your time on each
                                            section whether you finish early, on time, or late. This will help you track
                                            your timing improvements for each new test you take. At the end of the test,
                                            you'll be able to score your official practice test using our Exam Analyzer or
                                            record your scores if you took an unofficial practice test. Remember, if you've
                                            already take an Official Practice Test, you can score it below in the "Official
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
                                        <a class="text-dark" data-bs-toggle="collapse" data-bs-parent="#faq6"
                                            href="#faq13_q1" aria-expanded="true" aria-controls="faq13_q1"><i
                                                class="nav-main-link-icon fa fa-clock"></i> Exam Analyzer</a>
                                    </div>
                                    <div id="faq13_q1" class="collapse" role="tabpanel" aria-labelledby="faq13_h1"
                                        data-bs-parent="#faq6">
                                        <div class="block-content">
                                            <!-- Updates -->
                                            This is information about the Exam Analyzer. This tells you how it works and
                                            maybe links you to the page that lets you get started with it, such as picking a
                                            test, using the score calculator, then reviewing the analyzed test's categories,
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





                                <!-- BEGIN Accordion Block 4 PRACTICE TESTS -->




                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-default" role="tab" id="faq15_h2">
                                        <a class="text-dark" data-bs-toggle="collapse" data-bs-parent="#faq6"
                                            href="#faq15_q2" aria-expanded="true" aria-controls="faq15_q2"><i
                                                class="nav-main-link-icon fa fa-marker"></i>
                                            <!--Take, Score, Analyze, and Review -->Practice Tests
                                        </a>
                                    </div>
                                    <div id="faq15_q2" class="collapse" role="tabpanel" aria-labelledby="faq15_h2"
                                        data-bs-parent="#faq6">
                                        <div class="block-content">
                                            <!-- Updates -->

                                            <!--
                                      <span><b>Select Test</b></span>
                                      <br />
                                      <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>Official ACT Practice Test</button>
                                      <br /> -->
                                            <!-- If user selects "Official Practice Test", show them the following options -->



                                            <!--

                                      <p><b>Get Started</b></p>
                                      
                                      <p>In the Available Tests section, select the Official test you want to take or score with the Score Calculator using your answer choices. download and print the Official ACT/SAT/PSAT that you want to take. Use the free Score Calculator to automatically score your Official test. Alternatively, select the College Prep System practice test you want to take. </p>

                                      <p>In the Completed Tests section, review past tests that you've already taken and scored. Use the Exam Analyzer to get a detailed analysis of the question types and content you're missing, as well as access to question type lessons, strategies, and more. </p>
                                      <br />
    -->
                                            <!-- New Accordion within Accordion BLOCK 3 TEST -->
                                            <div class="block block-rounded">
                                                <div class="block-content">




                                                    <!-- BEGIN Accordion Block 1 within Accordion block 3 -->
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-default" role="tab"
                                                            id="faq1_h1">
                                                            <a class="text-dark" data-bs-toggle="collapse"
                                                                data-bs-parent="#faq1" href="#faq1_q1"
                                                                aria-expanded="false" aria-controls="faq1_q1"><i
                                                                    class="nav-main-link-icon fa fa-circle-check"></i>
                                                                Official Practice Tests</a>
                                                        </div>
                                                        <div id="faq1_q1" class="collapse" role="tabpanel"
                                                            aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                                            <div class="block-content">
                                                                <!-- Basics -->
                                                                <!--
                                                  <div class="block-header block-header-default">
                                                    <h3 class="block-title">Completed Quizzes</h3>
                                                  </div> -->

                                                                <p><b>Download, Score, and Analyze Official Tests</b></p>

                                                                <p>Take and print/download an Official ACT, SAT, or PSAT
                                                                    test. Select the test you want to take from the Official
                                                                    Tests table below and click the link in the Test Form
                                                                    column to download the free test.</p>

                                                                <p><b>Score an Official ACT, SAT, or PSAT test that I've
                                                                        already taken</b></p>

                                                                <p>If you've taken an Official test but haven't scored it
                                                                    yet, look in the Available Official Tests table below
                                                                    and click "Calculate Score" to enter your answer choices
                                                                    and automatically score your test. </p>

                                                                <p><b>Exam Analyzer</b></p>

                                                                <p>Try the most powerful test prep tool ever: the Exam
                                                                    Analyzer for Official ACT, SAT, and PSAT tests.
                                                                    Automatically score and get a <b>full analysis of all
                                                                        the incorrect question types</b> and answer
                                                                    explanations for Official practice tests as well as real
                                                                    test dates where the SAT's QAS (Question &amp; Answer
                                                                    Service) or ACT's TIR (Test Information Release) were
                                                                    available. Upgrade to access all locked Exam Analyzers.
                                                                    All Score Calculators are free. Review your answer
                                                                    choices or get valuable personalized feedback on which
                                                                    concepts to study that will improve your score fast.</p>


                                                                <!-- Basics -->
                                                                <div class="block-header block-header-default">
                                                                    <h3 class="block-title">Official Tests</h3>
                                                                </div>
                                                                <table class="table table-borderless table-vcenter">
                                                                    <tbody>

                                                                        <tr class="table-active">
                                                                            <th>Test Name &amp; Download
                                                                                <!--Test Name-->
                                                                            </th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        <?php $count = 0; ?>
                                                                        @foreach ($getOfficialPracticeTests as $getOfficialPracticeTest)
                                                                            <tr>
                                                                                <td>
                                                                                    <a class="fw-medium"
                                                                                    href="{{route('single_test', ['id' => $getOfficialPracticeTest['id']])}}">Official Released {{ $getOfficialPracticeTest['title'] }} #{{ ++$count }}</a>
                                                                                </td>
                                                                                <td class="text-end text-muted">
                                                                                    <button type="button"
                                                                                        class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-animation="true"
                                                                                        data-bs-placement="top" title=""
                                                                                        data-bs-original-title="Click to see your exam analysis, including which question types you missed and their lessons/strategies"><i
                                                                                            class="fa fa-lg fa-circle-exclamation me-1"></i>Exam
                                                                                        Analyzer</button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        {{-- <tr>
                                                                            <td>
                                                                                <a class="fw-medium"
                                                                                    href="javascript:void(0)">Official ACT
                                                                                    A10 April 2019</a>
                                                                            </td>
                                                                            <td class="text-end text-muted">
                                                                                <button type="button"
                                                                                    class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning js-bs-tooltip-enabled"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-animation="true"
                                                                                    data-bs-placement="top" title=""
                                                                                    data-bs-original-title="You have scored your test and can review it, but you need to upgrade to access the Exam Analyzer"><i
                                                                                        class="fa fa-lg fa-circle-exclamation me-1"></i>Exam
                                                                                    Analyzer</button> --}}
                                                                                <!--
                                                          <button type="button"class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success text-gray"></i>UPGRADE</button>-->
                                                                            {{-- </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <a class="fw-medium"
                                                                                    href="javascript:void(0)">Official ACT
                                                                                    B05 December 2020</a>
                                                                            </td>
                                                                            <td class="text-end text-muted">
                                                                                <button type="button"
                                                                                    class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning js-bs-tooltip-enabled"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-animation="true"
                                                                                    data-bs-placement="top" title=""
                                                                                    data-bs-original-title="Input your answers to calculate your score"><i
                                                                                        class="fa fa-lg fa-circle-exclamation me-1"></i>Calculate
                                                                                    Score</button>
                                                                            </td>
                                                                        </tr> --}}

                                                                    </tbody>
                                                                </table>
                                                                <!-- END Basics -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END Accordion 1 WITHIN Accordion Block 3 -->

                                                    <!-- BEGIN Accordion Block 1 within Accordion block 3 -->
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-default" role="tab"
                                                            id="faq111_h1">
                                                            <a class="text-dark" data-bs-toggle="collapse"
                                                                data-bs-parent="#faq1" href="#faq111_q1"
                                                                aria-expanded="false" aria-controls="faq111_q1"><i
                                                                    class="nav-main-link-icon fa fa-circle-check"></i>
                                                                College Prep System Tests</a>
                                                        </div>
                                                        <div id="faq111_q1" class="collapse" role="tabpanel"
                                                            aria-labelledby="faq111_h1" data-bs-parent="#faq1">
                                                            <div class="block-content">
                                                                <!-- Basics -->
                                                                <!--
                                                  <div class="block-header block-header-default">
                                                    <h3 class="block-title">Completed Quizzes</h3>
                                                  </div> -->


                                                                <p><b>Take, score, and analyze a digital College Prep System
                                                                        test developed by test prep experts</b></p>

                                                                <p>Select a test from the Available College Prep System
                                                                    Tests table. The system will automatically score each
                                                                    section after they're completed and give you a total
                                                                    score once all 4 sections are complete.</p>

                                                                <p><b>Review or Analyze a Test You've Already Taken</b></p>


                                                                <p>Review your score and answer choices from any test. Click
                                                                    "Score Details" on any test to review your score and
                                                                    answer choices from any test.</p>


                                                                <!-- Basics -->
                                                                <div class="block-header block-header-default">
                                                                    <h3 class="block-title">College Prep System Tests</h3>
                                                                </div>
                                                                <table class="table table-borderless table-vcenter">
                                                                    <tbody>

                                                                        <tr class="table-active">
                                                                            <th>Test Name &amp; Link
                                                                                <!--Test Name-->
                                                                            </th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                  <?php  $count = 0; //echo "<pre>"; print_r($getAllPracticeTests); echo "</pre>"; ?>
                                                  @foreach($getAllPracticeTests as $singleGetAllPracticeTests)
                                                  <?php  //echo "<pre>"; print_r($singleGetAllPracticeTests); echo "</pre>"; ?>
                                                                        <tr>
                                                                            <td>
                                                                                <a class="fw-medium"
                                                                                    href="{{route('single_test', ['id' => $singleGetAllPracticeTests->id])}}">College Prep
                                                                                    {{$singleGetAllPracticeTests->title}} {{$singleGetAllPracticeTests->format}} #{{++$count}}</a>
                                                                            </td>
                                                                            <td class="text-end text-muted">
                                                                                <button type="button"
                                                                                    class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning"><i
                                                                                        class="fa fa-lg fa-circle-exclamation me-1"></i>Upgrade
                                                                                    to Take Test</button>
                                                                            </td>
                                                                        </tr>
                                                  @endforeach
                                                                        <!-- <tr>
                                                                            <td>
                                                                                <a class="fw-medium"
                                                                                    href="javascript:void(0)">College Prep
                                                                                    System SAT #1</a>
                                                                            </td>
                                                                            <td class="text-end text-muted">
                                                                                <button type="button"
                                                                                    class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning"><i
                                                                                        class="fa fa-lg fa-circle-exclamation me-1"></i>Upgrade
                                                                                    to Take Test</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <a class="fw-medium"
                                                                                    href="javascript:void(0)">College Prep
                                                                                    System SAT #2</a>
                                                                            </td>
                                                                            <td class="text-end text-muted">
                                                                                <button type="button"
                                                                                    class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning"><i
                                                                                        class="fa fa-lg fa-circle-exclamation me-1"></i>Upgrade
                                                                                    to Take Test</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <a class="fw-medium"
                                                                                    href="javascript:void(0)">College Prep
                                                                                    System ACT #1</a>
                                                                            </td>
                                                                            <td class="text-end text-muted">
                                                                                <button type="button"
                                                                                    class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning"><i
                                                                                        class="fa fa-lg fa-circle-exclamation me-1"></i>Upgrade
                                                                                    to Take Test</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <a class="fw-medium"
                                                                                    href="javascript:void(0)">College Prep
                                                                                    System ACT #2</a>
                                                                            </td>
                                                                            <td class="text-end text-muted">
                                                                                <button type="button"
                                                                                    class="btn btn-warning fs-xs fw-semibold me-1 mb-3 bg-warning-light text-warning"><i
                                                                                        class="fa fa-lg fa-circle-exclamation me-1"></i>Upgrade
                                                                                    to Take Test</button>
                                                                            </td>
                                                                            
                                                                        </tr> -->
                                                                    </tbody>
                                                                </table>
                                                                <!-- END Basics -->
                                                            </div>
                                                        </div>
                                                    </div>






                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-default" role="tab" id="faq19_h2">
                                        <a class="text-dark" data-bs-toggle="collapse" data-bs-parent="#faq6"
                                            href="#faq19_q2" aria-expanded="true" aria-controls="faq19_q2"><i
                                                class="nav-main-link-icon fa fa-lightbulb"></i>
                                            <!--Take, Score, Analyze, and Review -->Content Mastery Quizzes
                                        </a>
                                    </div>
                                    <div id="faq19_q2" class="collapse" role="tabpanel" aria-labelledby="faq19_h2"
                                        data-bs-parent="#faq6">
                                        <div class="block-content">
                                            <!-- Updates -->

                                            <!-- <p><b>Custom Quizzes</b></p> -->

                                            <!-- BEGIN Accordion Block 1 within Accordion block 3 -->
                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                <div class="block-header block-header-default" role="tab"
                                                    id="faq1_h1">
                                                    <a class="text-dark" data-bs-toggle="collapse" data-bs-parent="#faq1"
                                                        href="#faq1_q1" aria-expanded="false" aria-controls="faq1_q1"><i
                                                            class="nav-main-link-icon fa fa-circle-check"></i> Create a
                                                        Custom Quiz</a>
                                                </div>
                                                <div id="faq1_q1" class="collapse" role="tabpanel"
                                                    aria-labelledby="faq1_h1" data-bs-parent="#faq1">
                                                    <div class="block-content">
                                                        <!-- Basics -->
                                                        <!--
                                                  <div class="block-header block-header-default">
                                                    <h3 class="block-title">Completed Quizzes</h3>
                                                  </div> -->
                                                        <!--
                                                  <h2 class="content-heading border-bottom mb-4">Custom Quizzes</h2> -->

                                                        <p>Practice specific concepts organized by Category and Question
                                                            Type to improve your scores quickly.</p>

                                                        <!--
                                      <span><b>Select Test</b></span>
                                      <br />
                                      <button type="button"class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>Official ACT Practice Test</button>
                                      <br /> -->
                                                        <!-- If user selects "Official Practice Test", show them the following options -->

                                                        <!-- <p><b>Get Started</b></p> -->
                                                        <!--
                                      <h2 class="content-heading border-bottom mb-4">Get Started</h2> -->

                                                        <p>Select the content from Categories and Question Types you'd like
                                                            to practice.</p>
                                                        <!--
                                      <button type="button"class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success text-gray"></i>UPGRADE</button>
                                      <br />
                                      <br />
    -->
                                                        <!-- Basics -->
                                                        <!--
                                                <div class="block-header block-header-default">
                                                  <h3 class="block-title">Available Official Tests</h3>
                                                </div> -->
                                                        <label class="form-label" for="example-select">Select Test and
                                                            Section</label>

                                                        <br><br>
                                                        <select class="form-select" id="example-select"
                                                            name="example-select">
                                                            <option selected="">Select One</option>
                                                            <option value="1">ACT English</option>
                                                            <option value="2">ACT Math</option>
                                                            <option value="3">ACT Reading</option>
                                                            <option value="4">ACT Science</option>
                                                            <option value="5">SAT Reading</option>
                                                            <option value="6">SAT Writing</option>
                                                            <option value="7">SAT Math</option>
                                                        </select>
                                                        <br>
                                                        <label class="form-label" for="example-select">Select Categories
                                                            &amp; Question Types to Practice</label>
                                                        <br><br>
                                                        <label class="form-label">Arithmetic</label>
                                                        <div class="space-y-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="example-checkbox-default1-1"
                                                                    name="example-checkbox-default1-1">
                                                                <label class="form-check-label"
                                                                    for="example-checkbox-default1-1">All
                                                                    Arithmetic</label>
                                                            </div>
                                                            <!-- use a "left side nav" style of indentation if possible -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="example-checkbox-default1-2"
                                                                    name="example-checkbox-default1-2">
                                                                <label class="form-check-label"
                                                                    for="example-checkbox-default1-2">Adding
                                                                    Fractions</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="example-checkbox-default1-3"
                                                                    name="example-checkbox-default1-3">
                                                                <label class="form-check-label"
                                                                    for="example-checkbox-default1-3">Types of
                                                                    Numbers</label>
                                                            </div>
                                                            <label class="form-label">Algebra</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="example-checkbox-default2-1"
                                                                    name="example-checkbox-default2-1">
                                                                <label class="form-check-label"
                                                                    for="example-checkbox-default2-1">All Algebra</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="example-checkbox-default2-2"
                                                                    name="example-checkbox-default2-2">
                                                                <label class="form-check-label"
                                                                    for="example-checkbox-default2-2">Systems of
                                                                    Equations</label>
                                                            </div>
                                                            <label class="form-label">Geometry</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="example-checkbox-default3-1"
                                                                    name="example-checkbox-default3-1">
                                                                <label class="form-check-label"
                                                                    for="example-checkbox-default3-1">All Geometry</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="example-checkbox-default3-2"
                                                                    name="example-checkbox-default3-2">
                                                                <label class="form-check-label"
                                                                    for="example-checkbox-default3-2">Translations</label>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <!-- SELECT2 third party plugin is really good -->

                                                        <!-- Multiple Select on this site:
    https://mdbootstrap.com/docs/b4/jquery/forms/select/ -->

                                                        <!-- Searchable select box on the following page... can't get it to work
    https://demo.pixelcave.com/oneui/be_forms_plugins.html -->

                                                        <!-- Use Multiple Select Box for admin side of adding new "Tags" / question types, categories, answer types ... https://demo.pixelcave.com/oneui/be_forms_plugins.html -->



                                                        <!--
                                                    <form action="be_forms_plugins.html" method="POST" onsubmit="return false;">
                                                      <h2 class="content-heading border-bottom mb-4 pb-2">Normal Select Box</h2>
                                                      <div class="row">
                                                        <div class="col-lg-8 col-xl-5">
                                                          <div class="mb-4">
                                                            <select class="js-select2 form-select" id="example-select2" name="example-select2" style="width: 100%;" data-placeholder="Choose one..">
                                                              <option></option> -->
                                                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                        <!--
                                                              <option value="1">HTML</option>
                                                              <option value="2">CSS</option>
                                                              <option value="3">JavaScript</option>
                                                              <option value="4">PHP</option>
                                                              <option value="5">MySQL</option>
                                                              <option value="6">Ruby</option>
                                                              <option value="7">Angular</option>
                                                              <option value="8">React</option>
                                                              <option value="9">Vue.js</option>
                                                            </select>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      
                                                    </form>

                     COMBINE optgroup select with checkboxes                               -->

                                                        <!--

                                                    <select class="custom-select">
                                                      <optgroup label="Group 1">
                                                        <optgroup label="Sub Group 1">
                                                          <option>Item 1</option>
                                                          <option>Item 2</option>
                                                          <option>Item 3</option>
                                                        </optgroup>
                                                      
                                                        <option>Item 2</option>
                                                        <option>Item 3</option>
                                                      </optgroup>

                                                      <optgroup label="Group 2">
                                                        <option>Item 1</option>
                                                        <option>Item 2</option>
                                                        <option>Item 3</option>
                                                      </optgroup>
                                                    </select> -->


                                                        <label class="form-label">Difficulty</label>
                                                        <div class="space-y-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="example-radios-default1-1"
                                                                    name="example-radios-default1-1" value="option1"
                                                                    checked="">
                                                                <label class="form-check-label"
                                                                    for="example-radios-default1-1">All</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="example-radios-default1-2"
                                                                    name="example-radios-default1-1" value="option1">
                                                                <label class="form-check-label"
                                                                    for="example-radios-default1-1">Easy</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="example-radios-default1-3"
                                                                    name="example-radios-default1-1" value="option1">
                                                                <label class="form-check-label"
                                                                    for="example-radios-default1-1">Medium</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="example-radios-default1-4"
                                                                    name="example-radios-default1-1" value="option1">
                                                                <label class="form-check-label"
                                                                    for="example-radios-default1-1">Hard</label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <label class="form-label">Question Pool</label>
                                                        <div class="space-y-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="example-radios-default2-1"
                                                                    name="example-radios-default2-1" value="option1">
                                                                <label class="form-check-label"
                                                                    for="example-radios-default2-1">All</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="example-radios-default2-2"
                                                                    name="example-radios-default2-2" value="option1"
                                                                    checked="">
                                                                <label class="form-check-label"
                                                                    for="example-radios-default2-2">Unanswered</label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <p>There are 53 questions in this question pool</p>
                                                        <br>
                                                        <br>
                                                        <label class="form-label" for="example-select">Number of
                                                            Questions</label>
                                                        <br>
                                                        <select class="form-select" id="example-select"
                                                            name="example-select">
                                                            <option selected="">Unlimited</option>
                                                            <option value="1">5 Questions</option>
                                                            <option value="2">10 Questions</option>
                                                            <option value="3">15 Questions</option>
                                                            <option value="4">20 Questions</option>
                                                            <option value="5">25 Questions</option>
                                                            <option value="5">30 Questions</option>
                                                        </select>
                                                        <br>
                                                        <label class="form-label" for="example-select">Time Limit</label>
                                                        <br>
                                                        <select class="form-select" id="example-select"
                                                            name="example-select">
                                                            <option selected="">Unlimited</option>
                                                            <option value="1">5 Minutes</option>
                                                            <option value="2">10 Minutes</option>
                                                            <option value="3">15 Minutes</option>
                                                            <option value="4">20 Minutes</option>
                                                            <option value="5">25 Minutes</option>
                                                            <option value="5">30 Minutes</option>
                                                        </select>
                                                        <br>
                                                        <label class="form-label" for="example-select">Mode</label>
                                                        <div class="space-y-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="example-radios-default1-1"
                                                                    name="example-radios-default1-1" value="option1"
                                                                    checked="">
                                                                <label class="form-check-label"
                                                                    for="example-radios-default1-1">Practice Mode (see
                                                                    answers &amp; explanations after each question)</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="example-radios-default1-2"
                                                                    name="example-radios-default1-1" value="option1">
                                                                <label class="form-check-label"
                                                                    for="example-radios-default1-1">Quiz Mode (see answers
                                                                    &amp; explanations at the end)</label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button type="button"
                                                            class="btn btn-outline-success fs-xs fw-semibold me-1 mb-3"><i
                                                                class="fa fa-fw fa-marker me-1"></i>Create Quiz</button>


                                                        <!-- END Overall Accordion Block within Accordion block 3 -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Accordion Block 3 TEST -->

                                            <!-- BEGIN Accordion Block 1 within Accordion block 3 -->
                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                <div class="block-header block-header-default" role="tab"
                                                    id="faq111_h1">
                                                    <a class="text-dark" data-bs-toggle="collapse" data-bs-parent="#faq1"
                                                        href="#faq111_q1" aria-expanded="false"
                                                        aria-controls="faq111_q1"><i
                                                            class="nav-main-link-icon fa fa-circle-check"></i> Review
                                                        Quizzes</a>
                                                </div>
                                                <div id="faq111_q1" class="collapse" role="tabpanel"
                                                    aria-labelledby="faq111_h1" data-bs-parent="#faq1">
                                                    <div class="block-content">
                                                        <!-- Basics -->
                                                        <!--
                                                  <div class="block-header block-header-default">
                                                    <h3 class="block-title">Completed Quizzes</h3>
                                                  </div> -->


                                                        <p><b>Review Custom Quizzes</b></p>

                                                        <p>Look at your score history and review questions and concepts.</p>

                                                        <p><b>Get Started</b></p>

                                                        <p>Select the quiz you'd like to review. Click the section name in
                                                            the right column to see the Categories and Question Types you
                                                            practiced on each quiz.</p>


                                                        <!-- Basics -->
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title">Completed Quizzes</h3>
                                                        </div>
                                                        <table class="table table-borderless table-vcenter">
                                                            <tbody>

                                                                <tr class="table-active">
                                                                    <th>Review Quiz</th>
                                                                    <th>Section</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <a class="fw-medium"
                                                                            href="javascript:void(0)">July 2nd, 2022</a>
                                                                    </td>
                                                                    <td class="text-end text-muted">
                                                                        <button type="button"
                                                                            class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">ACT
                                                                            Math</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <a class="fw-medium" href="javascript:void(0)">May
                                                                            23rd, 2022</a>
                                                                    </td>
                                                                    <td class="text-end text-muted">
                                                                        <button type="button"
                                                                            class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">ACT
                                                                            Reading</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- END Basics -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Accordion 1 WITHIN Accordion Block 3 -->






                                            <!-- END Basics -->

                                        </div>
                                    </div>
                                </div>
                                <!-- END Accordion 1 WITHIN Accordion Block 3 -->






                                <!-- BEGIN Accordion Block 4 -->
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-default" role="tab" id="faq10_h2">
                                        <a class="text-dark" data-bs-toggle="collapse" data-bs-parent="#faq6"
                                            href="#faq10_q2" aria-expanded="true" aria-controls="faq10_q2"><i
                                                class="nav-main-link-icon si si-bar-chart"></i> Score History &amp;
                                            Statistics</a>
                                    </div>
                                    <div id="faq10_q2" class="collapse" role="tabpanel" aria-labelledby="faq10_h2"
                                        data-bs-parent="#faq6">
                                        <!-- Dashboard Charts -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="block block-rounded block-mode-loading-oneui">
                                                    <div class="block-header block-header-default">
                                                        <h3 class="block-title">Score History</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option"
                                                                data-toggle="block-option" data-action="state_toggle"
                                                                data-action-mode="demo">
                                                                <i class="si si-refresh"></i>
                                                            </button>
                                                            <button type="button" class="btn-block-option">
                                                                <i class="si si-settings"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content p-0 text-center">
                                                        <!-- Chart.js is initialized in js/pages/be_pages_dashboard_v1.min.js which was auto compiled from _js/pages/be_pages_dashboard_v1.js) -->
                                                        <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                                                        <div class="pt-3" style="height: 360px;"><canvas
                                                                id="js-chartjs-dashboard-earnings" height="0"
                                                                style="display: block; box-sizing: border-box; height: 0px; width: 0px;"
                                                                width="0"></canvas></div>
                                                    </div>
                                                    <div class="block-content">
                                                        <div class="row items-push text-center py-3">
                                                            <div class="col-6 col-xl-3">
                                                                <i class="fa fa-wallet fa-2x text-muted"></i>
                                                                <div class="text-muted mt-3">$148,000</div>
                                                            </div>
                                                            <div class="col-6 col-xl-3">
                                                                <i class="fa fa-angle-double-up fa-2x text-muted"></i>
                                                                <div class="text-muted mt-3">+9% Earnings</div>
                                                            </div>
                                                            <div class="col-6 col-xl-3">
                                                                <i class="fa fa-ticket-alt fa-2x text-muted"></i>
                                                                <div class="text-muted mt-3">+20% Tickets</div>
                                                            </div>
                                                            <div class="col-6 col-xl-3">
                                                                <i class="fa fa-users fa-2x text-muted"></i>
                                                                <div class="text-muted mt-3">+46% Clients</div>
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
                    </div>
                </div>

                <!-- END TEST PREP TOOLS CONTENT BOX -->

                <!-- BEGIN TEST PREP LESSONS CONTENT BOX -->
                <div class="col-md-4 col-xl-5">


                    <div class="block block-rounded">
                        <div class="block-header block-header-default text-white" style="background: #000">
                            <h3 class="block-title">
                                <i class="nav-main-link-icon fa fa-brain text-white"></i> Test Prep Lessons
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="fs-sm push">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <a class="fw-semibold" href="">How to Prepare for the ACT/SAT/PSAT</a>
                                    </div>
                                </div>
                                <p class="mb-0">Learn the most efficient and effective way to prepare for the tests.</p>
                            </div>
                            {{-- <div class="fs-sm push">
                <div class="d-flex justify-content-between mb-2">
                  <div>
                    <a class="fw-semibold" href="">ACT Core Strategies</a>
                  </div>
                </div>
                <p class="mb-0">Learn the main test-taking strategies that will help you successfully and quickly improve your score.</p>
              </div> --}}
                            {{-- <div class="fs-sm push">
                <div class="d-flex justify-content-between mb-2">
                  <div>
                    <a class="fw-semibold" href="">ACT English Lessons &amp; Strategies</a>
                  </div>
                </div>
                <p class="mb-0">Learn everything you need to know about every ACT English concept, including lessons, strategies, question type identification, and content drills.</p>
              </div> --}}
                            <div class="push">
                                <button type="button" class="btn btn-sm btn-alt-secondary">Visit the Test Prep Lesson
                                    Homepage for more..</button>
                                <!-- sends student to the Test Prep Milestone 4 page with all the Test Prep Modules on it -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END TEST PREP LESSONS CONTENT BOX -->
            </div>
        </div>
        @include('components.test-prep.calender-modal')
    </main>
	
    <div id="loadingIndicator" class="loading-indicator" style="display: none;">
		<img src="{{ asset('image/Spinner.gif') }}" alt="Loading...">
    </div>

    <!-- End Main Container -->
@endcan

@cannot('Access Test Prep Dashboard')
    @include('components.subscription-warning')
@endcan

@endsection

@can('Access Test Prep Dashboard')
@section('page-script')
    <script src="{{ asset('assets/js/plugins/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/_js/pages/be_comp_calendar.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    
    <script src="{{asset('assets/js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dropzone/min/dropzone.min.js')}}"></script>

    <!-- Data Table -->
    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>

    <script src="{{ asset('js/calender.js') }}"></script>

    <script>One.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-masked-inputs', 'jq-rangeslider', 'jq-colorpicker']);</script>


    <script>
        // $(document).ready(function () {
        //     let eventObj = @json($final_arr);
    
        // })
        pageCompCalendar.init(@json($final_arr));
		
		var testTypeDropdown = $('#testTypeDropdown').val();
        if(testTypeDropdown) {
            $.ajax({
                url: "{{ route('update_test_type') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    updtvalue: 'primary_test_type',
                    field_value: testTypeDropdown
                },
                success: function(response) {
                    $('.lastTestCls').text(response.scaled_score);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        } else {
            $('.editInitialScore').hide();
            $('.editGoalScore').hide();
        }

        $(document).ready(function() {
            $("#categoryQuestion1").click(function() {
                $(this).toggleClass("show");
            });
			
            $(".editPrimaryTest").click(function() {
                $('#editDropdownContainer').toggle();
                $('.selectedPrimaryTest').toggle();
            });

            $("#testTypeDropdown").change(function() {
                // var testTypeValue = $('.selectedPrimaryTest').text().trim();
                var newTestType = this.value;

                if(newTestType != '') {
                    $.ajax({
                        url: "{{ route('update_test_type') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            updtvalue: 'primary_test_type',
                            field_value: newTestType
                        },
                        success: function(response) {
                            // console.log(response.scaled_score);

                            $('.selectedPrimaryTest').text(newTestType);
                            $('.lastTestCls').text(response.scaled_score);
                            
                            $('#editDropdownContainer').toggle();
                            $('.selectedPrimaryTest').toggle();
							
							$('.editInitialScore').show();
                            $('.editGoalScore').show();

                            toastr.options = {
                                "progressBar": true,
                                "closeButton": true,
                                "timeOut": 4000,
                            };
                            toastr.success("PRIMARY TEST UPDATED!");
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });


            $(".editInitialScore").click(function() {
                $('.initialScoreCls').toggle();
                $('#editInitialScoreContainer').toggle();
                $('#txtinitialScore').focus().select();
            });

            $('#txtinitialScore').on('keypress', function(event) {
                // Allow backspace, delete, and arrow keys
                if (event.keyCode === 8 || event.keyCode === 37 || event.keyCode === 39) {
                    return true;
                }
                // Ensure only numeric characters are allowed (ASCII codes 48 to 57)
                if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
                }
                if (event.which === 13) {
                    var old_initialScore = $('.initialScoreCls').text().trim();
                    var new_initialScore = this.value;
                    if(new_initialScore != '' && new_initialScore != old_initialScore) {
                        $.ajax({
                            url: "{{ route('update_test_type') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                updtvalue: 'initial_score',
                                field_value: new_initialScore
                            },
                            success: function(response) {
                                $('.initialScoreCls').text(new_initialScore);
                                $('.initialScoreCls').toggle();
                                $('#editInitialScoreContainer').toggle();

                                toastr.options = {
                                    "progressBar": true,
                                    "closeButton": true,
                                    "timeOut": 4000,
                                };
                                toastr.success("INITIAL SCORE UPDATED!");
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                }
            });

            $(".editGoalScore").click(function() {
                $('.goalScoreCls').toggle();
                $('#editGoalScoreContainer').toggle();
                $('#txtgoalScore').focus().select();
            });

            $('#txtgoalScore').on('keypress', function(event) {
                // Allow backspace, delete, and arrow keys
                if (event.keyCode === 8 || event.keyCode === 37 || event.keyCode === 39) {
                    return true;
                }
                // Ensure only numeric characters are allowed (ASCII codes 48 to 57)
                if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
                }
                if (event.which === 13) {
                    var old_goalScore = $('.goalScoreCls').text().trim();
                    var new_goalScore = this.value;
                    if(new_goalScore != '' && new_goalScore != old_goalScore) {
                        $.ajax({
                            url: "{{ route('update_test_type') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                updtvalue: 'goal_score',
                                field_value: new_goalScore
                            },
                            success: function(response) {
                                $('.goalScoreCls').text(new_goalScore);
                                $('.goalScoreCls').toggle();
                                $('#editGoalScoreContainer').toggle();
                                toastr.options = {
                                    "progressBar": true,
                                    "closeButton": true,
                                    "timeOut": 4000,
                                };
                                toastr.success("GOAL SCORE UPDATED!");
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                }
            });
        });

        $('input[type="checkbox"]').click(function(e) {
            e.stopPropagation()
        })

        function addTitle() {
            let title = $('#event-title').val();

            if (title == "") {
                toastr.error("Please Enter Event!");
                return false;
            } else {
                $.ajax({
                    url: "{{ route('calendar.addEvent') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "title": title
                    },
                    success: function(resp) {
                        let html = ``;
                        if (resp.success) {
                            html += `<li class="event-list-${resp.data.id}">`;
                            html +=
                                `<div class="js-event p-2 fs-sm fw-medium rounded bg-${resp.data.color}-light text-${resp.data.color}" data-url="{{ route('calendar.assignEvent') }}" data-id="${resp.data.id}">${resp.data.title}<span class="main-event-trash" onclick="mainEventTrash(${resp.data.id})"><i class="fa-solid fa-trash"></i></div>`;
                            html += `</li>`;

                            $('.list-events').append(html);
                            $('#event-title').val("");
                            toastr.success(resp.message);
                        }
                    },
                    error: function(err) {
                        console.log("err =>>>", err);
                    }
                });
            }
        }

        function mainEventTrash(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('user/calendar/trash-event/${id}') }}`,
                        type: "DELETE",
                        dataType: "JSON",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(resp) {
                            if (resp.success) {
                                $(`.event-list-${resp.data}`).remove();
                                toastr.success(resp.message);
                            }
                        },
                        error: function(err) {
                            console.log("err =>>>", err);
                        }
                    });
                }
            })
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
@endcan

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/fullcalendar/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    
    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/oneui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <!-- data table -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">

    <style>
    .loader {
        margin: auto;
        border: 5px solid #EAF0F6;
        border-radius: 50%;
        border-top: 5px solid #FF7A59;
        width: 100px;
        height: 100px;
        animation: spinner 4s linear infinite;
    }

    @keyframes spinner {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
    <style>
		.test-block {
            height: 105px;
        }
		.toast-success {
            background-color: #51A351 !important;
        }
		.loading-indicator {
			display: flex;
			justify-content: center;
			align-items: center;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.5);
			z-index: 9999;
		}
        .fc-toolbar-title {
            font-size: 120% !important;
        }

        .fc-toolbar-chunk {
            display: flex;
            font-size: 75%;
        }


        .content {
            width: 90%;
        }

        .input-check {
            position: absolute;
            top: 145px;
            right: 64px;
        }

        .block-header {
            justify-content: start;
            /* padding: 0; */
        }

        .js-table-sections-header.show>tr>td:first-child>i .js-table-checkable tbody tr,
        .js-table-sections-header>tr {
            cursor: pointer;
        }

        .js-table-sections-header>tr>td:first-child>i {

            transition: transform 0.15s ease-out;
        }

        .js-table-sections-header tbody {
            display: none;
        }

        .js-table-sections-header .show>tr>td:first-child>i {
            transform: rotate(90deg);
        }

        .js-table-sections-header .show tbody {
            display: table-row-group;
        }

        .main-event-trash {
            position: absolute;
            right: 12px;
            cursor: pointer;
        }

        .fc-button-primary {
            color: #334155 !important;
            background-color: #dde2e9 !important;
            border-color: #dde2e9 !important;
        }

        .fc-today-button {
            background-color: #334155 !important;
            color: #dde2e9 !important;
        }

        .fc-button-active {
            color: #334155 !important;
            background-color: #f6f7f9 !important;
            border-color: #f6f7f9 !important;
        }
    </style>
@endsection
