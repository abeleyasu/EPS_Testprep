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
                    @include('user.admin-dashboard.initial-college-list.stepper', [
                        'active_stepper' => 3,
                        'completed_step' => [1, 2]
                    ])
                </div>
                <p class="mb-4">Here are your college search results from the Search Parameters you chose.</p>


                <div class="row">
                    <!-- BEGIN TEST PREP TOOLS CONTENT BOX -->
                    <div class="col-md-7 col-xl-7">
                        <div class="block block-rounded">
                            <div class="block-header block-header-default text-white" style="background: #000">
                                <h3 class="block-title">
                                    <i class="fa fa-screwdriver-wrench text-white me-1"></i> MY STATISTICS
                                </h3>
                            </div>
                            <div class="block-content pb-3">
                                <div id="faq6" class="mb-3" role="tablist" aria-multiselectable="true">

                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-default" role="tab"
                                            data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q1"
                                            aria-expanded="false" aria-controls="faq6_q1">
                                            <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i>
                                                High School GPA</a>
                                        </div>
                                        <div id="faq6_q1" class="collapse" role="tabpanel" aria-labelledby="faq6_h1"
                                            data-bs-parent="#faq6" style="">
                                            <div class="block-content">
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
                                                        <label class="form-label" for="test_date">Select Test
                                                            Date</label>
                                                        <input type="text" class="date-own form-control" id="test_date"
                                                            name="test_date" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="english_score">ACT English
                                                            Score</label>
                                                        <input type="text" class="form-control" id="english_score"
                                                            name="english_score" placeholder="Please enter English Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="math_score">ACT Math Score</label>
                                                        <input type="text" class="form-control" id="math_score"
                                                            name="math_score" placeholder="Please enter Math Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="reading_score">ACT Reading
                                                            Score</label>
                                                        <input type="text" class="form-control" id="reading_score"
                                                            name="reading_score" placeholder="Please enter Reading Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="science_score">ACT Science
                                                            Score</label>
                                                        <input type="text" class="form-control" id="science_score"
                                                            name="science_score" placeholder="Please enter Science Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="composite_score">ACT Composite
                                                            Score</label>
                                                        <input type="text" class="form-control" id="composite_score"
                                                            name="composite_score"
                                                            placeholder="Please enter Composite Score">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-default" role="tab"
                                            data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q2"
                                            aria-expanded="false" aria-controls="faq6_q2">
                                            <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i>
                                                Past/Current Test Scores</a>
                                        </div>
                                        <div id="faq6_q2" class="collapse" role="tabpanel" aria-labelledby="faq6_h1"
                                            data-bs-parent="#faq6" style="">
                                            <div class="block-content">
                                                <div class="block block-rounded">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="example-select_test_scores">Select
                                                            Test
                                                            Type</label>
                                                        <select class="form-select" id="example-select_test_scores"
                                                            name="example-select_test_scores">
                                                            <option selected="">Select One</option>
                                                            <option value="1">ACT</option>
                                                            <option value="2">SAT</option>
                                                            <option value="3">PSAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 mb-4">
                                                        <label class="form-label" for="test_date_test_scores">Select Test
                                                            Date</label>
                                                        <input type="text" class="date-own form-control"
                                                            id="test_date_test_scores" name="test_date_test_scores"
                                                            placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="english_score_test_scores">ACT
                                                            English
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="english_score_test_scores"
                                                            name="english_score_test_scores"
                                                            placeholder="Please enter English Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="math_score_test_scores">ACT Math
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="math_score_test_scores" name="math_score_test_scores"
                                                            placeholder="Please enter Math Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="reading_score_test_scores">ACT
                                                            Reading
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="reading_score_test_scores"
                                                            name="reading_score_test_scores"
                                                            placeholder="Please enter Reading Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="science_score_test_scores">ACT
                                                            Science
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="science_score_test_scores"
                                                            name="science_score_test_scores"
                                                            placeholder="Please enter Science Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="composite_score_test_scores">ACT
                                                            Composite Score</label>
                                                        <input type="text" class="form-control"
                                                            id="composite_score_test_scores"
                                                            name="composite_score_test_scores"
                                                            placeholder="Please enter Composite Score">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-default" role="tab"
                                            data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q3"
                                            aria-expanded="false" aria-controls="faq6_q3">
                                            <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i>
                                                Goal Scores</a>
                                        </div>
                                        <div id="faq6_q3" class="collapse" role="tabpanel" aria-labelledby="faq6_h1"
                                            data-bs-parent="#faq6">
                                            <div class="block-content">
                                                <div class="block block-rounded">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="example-select_goal_scores">Select
                                                            Test
                                                            Type</label>
                                                        <select class="form-select" id="example-select_goal_scores"
                                                            name="example-select_goal_scores">
                                                            <option selected="">Select One</option>
                                                            <option value="1">ACT</option>
                                                            <option value="2">SAT</option>
                                                            <option value="3">PSAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 mb-4">
                                                        <label class="form-label" for="test_date_goal_scores">Select Test
                                                            Date</label>
                                                        <input type="text" class="date-own form-control"
                                                            id="test_date_goal_scores" name="test_date_goal_scores"
                                                            placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="english_score_goal_scores">ACT
                                                            English
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="english_score_goal_scores"
                                                            name="english_score_goal_scores"
                                                            placeholder="Please enter English Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="math_score_goal_scores">ACT Math
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="math_score_goal_scores" name="math_score_goal_scores"
                                                            placeholder="Please enter Math Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="reading_score_goal_scores">ACT
                                                            Reading
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="reading_score_goal_scores"
                                                            name="reading_score_goal_scores"
                                                            placeholder="Please enter Reading Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="science_score_goal_scores">ACT
                                                            Science
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="science_score_goal_scores"
                                                            name="science_score_goal_scores"
                                                            placeholder="Please enter Science Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="composite_score_goal_scores">ACT
                                                            Composite
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="composite_score_goal_scores"
                                                            name="composite_score_goal_scores"
                                                            placeholder="Please enter Composite Score">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                        <div class="block-header block-header-default" role="tab"
                                            data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q4"
                                            aria-expanded="false" aria-controls="faq6_q4">
                                            <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i>
                                                Final Scores</a>
                                        </div>
                                        <div id="faq6_q4" class="collapse" role="tabpanel" aria-labelledby="faq6_h1"
                                            data-bs-parent="#faq6" style="">
                                            <div class="block-content">
                                                <div class="block block-rounded">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="example-select_final_scores">Select
                                                            Test
                                                            Type</label>
                                                        <select class="form-select" id="example-select_final_scores"
                                                            name="example-select_final_scores">
                                                            <option selected="">Select One</option>
                                                            <option value="1">ACT</option>
                                                            <option value="2">SAT</option>
                                                            <option value="3">PSAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 mb-4">
                                                        <label class="form-label" for="test_date_final_scores">Select Test
                                                            Date</label>
                                                        <input type="text" class="date-own form-control"
                                                            id="test_date_final_scores" name="test_date_final_scores"
                                                            placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="english_score_final_scores">ACT
                                                            English
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="english_score_final_scores"
                                                            name="english_score_final_scores"
                                                            placeholder="Please enter English Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="math_score_final_scores">ACT Math
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="math_score_final_scores" name="math_score_final_scores"
                                                            placeholder="Please enter Math Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="reading_score_final_scores">ACT
                                                            Reading
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="reading_score_final_scores"
                                                            name="reading_score_final_scores"
                                                            placeholder="Please enter Reading Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="science_score_final_scores">ACT
                                                            Science
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="science_score_final_scores"
                                                            name="science_score_final_scores"
                                                            placeholder="Please enter Science Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="composite_score_final_scores">ACT
                                                            Composite
                                                            Score</label>
                                                        <input type="text" class="form-control"
                                                            id="composite_score_final_scores"
                                                            name="composite_score_final_scores"
                                                            placeholder="Please enter Composite Score">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <button type="reset" class="btn btn-sm btn btn-alt-success">Save Statistics (Hopefully
                                    auto-saves)</button> --}}
                            </div>
                        </div>
                    </div>
                    <!-- END TEST PREP TOOLS CONTENT BOX -->
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <div class="prev-btn">
                        <a href="{{ route('admin-dashboard.initialCollegeList.step2') }}"
                            class="btn btn-alt-success prev-step"> Previous Step
                        </a>
                    </div>
                    <div class="">
                        <a href="#"
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
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
@endsection


@section('user-script')

    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/selecting-search-params.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.date-own').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '-3d'
        });
    </script>
@endsection
