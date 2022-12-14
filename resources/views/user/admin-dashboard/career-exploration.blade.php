@extends('layouts.user')

@section('title', 'Career Exploration Architecture : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full content-flex">
                    <br>
                    <div class="text-center">
                        <h1 class="h2 text-white mb-3">Career Exploration Architecture</h1>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-alt-success w-20">Add to Career List</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <form>
            <div class="block-content tab-content college-content">
                <div class="tab-content" id="myTabContent">
                    <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                        <div class="accordion accordionExample accordionExample2">
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <a class=" text-white fw-600 collapsed"><i class="fa fa-2x fa-circle-info"></i> Career
                                        Overview</a>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent=".accordionExample">
                                    <div class="college-content-wrapper college-content">
                                        <h2 class="artchitecture_text mb-3">Architecture</h2>
                                        <div class="block-title">Description</div>
                                        <p class="d-none d-sm-block text-muted mb-3">
                                            Plan and design structures, such as private residences, office buildings,
                                            theaters, factories, and other structural property.
                                        </p>

                                        <div class="block-title">AVERAGE SALARY</div>
                                        <p class="d-none d-sm-block text-muted mb-3">
                                            $100,120
                                        </p>
                                        <div class="block-title">MOST COMMON EDUCATION LEVEL</div>
                                        <p class="d-none d-sm-block text-muted mb-0">
                                            Bachelor's Degree <b>45%</b>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <a class=" text-white fw-600 collapsed"><i class="fa fa-2x fa-comments-dollar"></i>
                                        Career Details </a>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                    data-parent=".accordionExample">
                                    <div class="college-content-wrapper college-content">
                                        <div class="block-title">DAILY ACTIVITIES</div>
                                        <p class="d-none d-sm-block text-muted mb-3">
                                            <b>Operations Analysis</b> - Figuring out what a product or service needs to be
                                            able to do.<br>
                                            <b>Critical Thinking</b> - Thinking about the pros and cons of different ways to
                                            solve a problem.<br>
                                            <b>Speaking</b> - Talking to others.<br>
                                            <b>Reading Comprehension</b> - Reading work-related information.<br>
                                            <b>Writing</b> - Writing things for co-workers or customers.<br>
                                            <b>Active Listening</b> - Listening to others, not interrupting, and asking good
                                            questions.<br>
                                        </p>
                                        <div class="block-title">ABILITIES</div>
                                        <p class="d-none d-sm-block text-muted">
                                            <b>Visualization</b> - Imagining how something will look after it is moved
                                            around or changed.<br>
                                            <b>Oral Comprehension</b> - Listening and understanding what people say.<br>
                                            <b>Fluency of Ideas</b> - Coming up with lots of ideas.<br>
                                            <b>Written Comprehension</b> - Reading and understanding what is written.<br>
                                            <b>Inductive Reasoning</b> - Making general rules or coming up with answers from
                                            lots of detailed information.<br>
                                            <b>Written Expression</b> - Communicating by writing.<br>
                                            <b>Information Ordering</b> - Ordering or arranging things.<br>
                                            <b>Category Flexibility</b> - Grouping things in different ways.<br>
                                            <b>Problem Sensitivity</b> - Noticing when problems happen.<br>
                                            <b>Oral Expression</b> - Communicating by speaking.<br>
                                            <b>Originality</b> - Creating new and original ideas.<br>
                                            <b>Deductive Reasoning</b> - Using rules to solve problems.<br>
                                        </p>
                                        <div class="block-title">KNOWLEDGE</div>
                                        <p class="d-none d-sm-block text-muted">
                                            <b>Design</b> - Knowledge of design techniques, tools, and principles involved
                                            in production of precision technical plans, blueprints, drawings, and
                                            models.<br>
                                            <b>Building and Construction</b> - Knowledge of materials, methods, and the
                                            tools involved in the construction or repair of houses, buildings, or other
                                            structures such as highways and roads.<br>
                                            <b>Public Safety and Security</b> - Knowledge of relevant equipment, policies,
                                            procedures, and strategies to promote effective local, state, or national
                                            security operations for the protection of people, data, property, and
                                            institutions.<br>
                                            <b>Engineering and Technology</b> - Knowledge of the practical application of
                                            engineering science and technology. This includes applying principles,
                                            techniques, procedures, and equipment to the design and production of various
                                            goods and services.<br>
                                            <b>Computers and Electronics</b> - Knowledge of circuit boards, processors,
                                            chips, electronic equipment, and computer hardware and software, including
                                            applications and programming.<br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-comments-dollar"></i>
                                        Schools & Education</a>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingOne"
                                    data-parent=".accordionExample">
                                    <div class="college-content-wrapper college-content">
                                        <div class="block-title">Education</div>
                                        <p class="d-none d-sm-block text-muted">
                                            Doctoral or Professional Degree <b>9%</b>
                                        </p>
                                        <p class="d-none d-sm-block text-muted">
                                            Master's Degree <b>38%</b>
                                        </p>
                                        <p class="d-none d-sm-block text-muted">
                                            Bachelor's Degree <b>45%</b>
                                        </p>
                                        <p class="d-none d-sm-block text-muted">
                                            Associate's Degree <b>3%</b>
                                        </p>
                                        <p class="d-none d-sm-block text-muted">
                                            Some College, No Degree <b>4%</b>
                                        </p>
                                        <p class="d-none d-sm-block text-muted">
                                            High School Diploma or Equivalent <b>1%</b>
                                        </p>
                                        <p class="d-none d-sm-block text-muted">
                                            Less than High School Diploma <b>0%</b>
                                        </p>
                                        <div class="block-title">Schools</div>
                                        <p class="d-none d-sm-block text-muted">
                                            Rice University
                                        </p>
                                        <p class="d-none d-sm-block text-muted">
                                            Cornell University
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-comments-dollar"></i>
                                        Wages</a>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingOne"
                                    data-parent=".accordionExample">
                                    <div class="college-content-wrapper college-content">
                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                            <div class="block-header block-header-tab" type="button"
                                                data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
                                                aria-controls="collapseFive">
                                                <a class="text-white fw-600 collapsed"><i
                                                        class="fa fa-2x fa-circle-check"></i> Architecture</a>
                                            </div>
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingOne"
                                                data-parent=".accordionExample2">
                                                <div class="college-content-wrapper college-content">
                                                    EDUCATION LEVEL
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                            <div class="block-header block-header-tab" type="button"
                                                data-toggle="collapse" data-target="#collapseSix" aria-expanded="true"
                                                aria-controls="collapseSix">
                                                <a class="text-white fw-600 collapsed"><i
                                                        class="fa fa-2x fa-circle-check"></i> Employers</a>
                                            </div>
                                            <div id="collapseSix" class="collapse" aria-labelledby="headingOne"
                                                data-parent=".accordionExample2">
                                                <div class="college-content-wrapper college-content">
                                                    <p><b>Salary After Completing</b></p>
                                                    <p>Median Earnings <b>$79,000</b></p>
                                                    <p><b>Financial Aid &amp; Debt</b></p>
                                                    <p>Median Debt After Graduation <b>$25,000</b></p>
                                                    <p><b>Additional Information</b></p>
                                                    <p>Number of Graduates <b>250</b></p>
                                                    <div class="block-title">Education</div>
                                                    <p class="d-none d-sm-block text-muted">
                                                        $48,930 <b>Bottom 10th Percentile</b>
                                                    </p>
                                                    <p class="d-none d-sm-block text-muted">
                                                        $80,180 <b>Median</b>
                                                    </p>
                                                    <p class="d-none d-sm-block text-muted">
                                                        $129,980 <b>Top 10th Percentile</b>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                    data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                    <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-comments-dollar"></i>
                                        Projected Employment</a>
                                </div>
                                <div id="collapseEight" class="collapse" aria-labelledby="headingOne"
                                    data-parent=".accordionExample">
                                    <div class="college-content-wrapper college-content">
                                        <p><b>United States</b></p>
                                        <p><b>2020 Employment</b></p>
                                        <p>126,700</p>

                                        <p><b>2030 Employment</b></p>

                                        <p>130,700</p>

                                        <p><b>Percent Change</b></p>

                                        <p>3%</p>

                                        <p><b>Annual Projected Job Openings</b></p>

                                        <p>9,400</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="d-flex justify-content-end mt-3">
                    <div class="">
                        <a href="http://127.0.0.1:8000/user/admin-dashboard/initial-college-list/college-search-results"
                            class="btn  btn-alt-success next-step">Next Step</a>
                    </div>
                </div> --}}
            </div>
        </form>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/collegeExploration.css') }}">

@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
@endsection
