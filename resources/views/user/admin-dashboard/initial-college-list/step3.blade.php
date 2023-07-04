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
            <div class="d-flex justify-content-between mt-3 mb-3">
                <a href="{{ route('admin-dashboard.initialCollegeList.step2', ['college_lists_id' => request()->get('college_lists_id')]) }}" class="btn btn-alt-success prev-step"> Previous Step </a>
                <a href="{{ route('admin-dashboard.initialCollegeList.step4', ['college_lists_id' => request()->get('college_lists_id')]) }}" class="btn btn-alt-success next-step"> Next Step </a>
            </div>
            <div class="row">
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
                                    <div class="block-header block-header-default" role="tab" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q1" aria-expanded="false" aria-controls="faq6_q1">
                                        <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i> High School GPA</a>
                                    </div>
                                    <div id="faq6_q1" class="collapse show" role="tabpanel" aria-labelledby="faq6_h1" data-bs-parent="#faq6" style="">
                                        <div class="block-content">
                                            <div class="block block-rounded">
                                                <form id="high-school-form">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="high_school_test_type">Select Test Type</label>
                                                        <select class="form-control hss-value" id="high_school_test_type" name="high_school_test_type">
                                                            @foreach($test_type as $key => $test)
                                                                <option value="{{ $test }}" @if($college_list_date['high_school_test_type'] == $test) selected @endif>{{ $test }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 mb-4 w-100">
                                                        <label class="form-label" for="high_school_test_date">Select Test Date</label>
                                                        <input type="text" class="date-own form-control hss-value" id="high_school_test_date" name="high_school_test_date" value="{{ $college_list_date['high_school_test_date'] }}" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="mb-2 high-school-act-fields">
                                                        <label class="form-label" for="high_school_english_score"><span>ACT</span> English Score</label>
                                                        <input type="text" class="form-control high-school-score hss-value" id="high_school_english_score" value="{{ $college_list_date['high_school_english_score'] }}" name="high_school_english_score" placeholder="Please enter English Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="high_school_reading_score" id="high-school-reading-label">ACT Reading Score</label>
                                                        <input type="text" class="form-control high-school-score hss-value" id="high_school_reading_score" value="{{ $college_list_date['high_school_reading_score'] }}" name="high_school_reading_score" placeholder="Please enter Reading Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="high_school_math_score"><span class="high-school-other-field-name">ACT</span> Math Score</label>
                                                        <input type="text" class="form-control high-school-score hss-value" id="high_school_math_score" value="{{ $college_list_date['high_school_math_score'] }}" name="high_school_math_score" placeholder="Please enter Math Score">
                                                    </div>
                                                    <div class="mb-2 high-school-act-fields">
                                                        <label class="form-label" for="high_school_science_score"><span>ACT</span> Science Score</label>
                                                        <input type="text" class="form-control high-school-score hss-value" id="high_school_science_score" value="{{ $college_list_date['high_school_science_score'] }}" name="high_school_science_score" placeholder="Please enter Science Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="high_school_composite_score"><span class="high-school-other-field-name">ACT</span> Composite Score</label>
                                                        <input type="text" class="form-control high-school-score hss-value" id="high_school_composite_score" value="{{ $college_list_date['high_school_composite_score'] }}" name="high_school_composite_score" placeholder="Please enter Composite Score" readonly="readonly">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="unweighted_gpa"> Unweighted GPA</label>
                                                        <input type="text" class="form-control gpa-value store-value hss-value" id="unweighted_gpa" name="unweighted_gpa" value="{{ $college_list_date['unweighted_gpa'] }}" placeholder="Please enter unweighted gpa">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="weighted_gpa"> Weighted GPA</label>
                                                        <input type="text" class="form-control gpa-value store-value hss-value" id="weighted_gpa" name="weighted_gpa" value="{{ $college_list_date['weighted_gpa'] }}" placeholder="Please enter weighted gpa">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-default" role="tab" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q2" aria-expanded="false" aria-controls="faq6_q2">
                                        <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i> Past/Current Test Scores</a>
                                    </div>
                                    <div id="faq6_q2" class="collapse" role="tabpanel" aria-labelledby="faq6_h1" data-bs-parent="#faq6" style="">
                                        <div class="block-content">
                                            <div class="block block-rounded">
                                                <div class="d-flex justify-content-end mb-3">
                                                    <button class="btn btn-alt-success" data-bs-toggle="modal" data-bs-target="#add-past-current-score">+ Add Score</button>
                                                </div>
                                                <div id="list-past-current"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-default" role="tab" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q3" aria-expanded="false" aria-controls="faq6_q3">
                                        <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i>Goal Scores</a>
                                    </div>
                                    <div id="faq6_q3" class="collapse" role="tabpanel" aria-labelledby="faq6_h1" data-bs-parent="#faq6">
                                        <div class="block-content">
                                            <div class="block block-rounded">
                                                <form id="goal-school-form">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="goal_test_type">Select Test Type</label>
                                                        <select class="form-control gss-value" id="goal_test_type" name="goal_test_type">
                                                            @foreach($test_type as $key => $test)
                                                                <option value="{{ $test }}" @if($college_list_date['goal_test_type'] == $test) selected @endif>{{ $test }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 mb-4 w-100">
                                                        <label class="form-label" for="goal_test_date">Select Test Date</label>
                                                        <input type="text" class="date-own form-control gss-value" id="goal_test_date" name="goal_test_date" value="{{ $college_list_date['goal_test_date'] }}" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="mb-2 goal-school-act-fields">
                                                        <label class="form-label" for="goal_english_score">ACT English Score</label>
                                                        <input type="text" class="form-control goal-school-score gss-value" id="goal_english_score" value="{{ $college_list_date['goal_english_score'] }}" name="goal_english_score" placeholder="Please enter English Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="goal_reading_score" id="goal-school-reading-label">ACT Reading Score</label>
                                                        <input type="text" class="form-control goal-school-score gss-value" id="goal_reading_score" value="{{ $college_list_date['goal_reading_score'] }}" name="goal_reading_score" placeholder="Please enter Reading Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="goal_math_score"><span class="goal-school-other-field-name">ACT</span> Math Score</label>
                                                        <input type="text" class="form-control goal-school-score gss-value" id="goal_math_score" value="{{ $college_list_date['goal_math_score'] }}" name="goal_math_score" placeholder="Please enter Math Score">
                                                    </div>
                                                    <div class="mb-2 goal-school-act-fields">
                                                        <label class="form-label" for="goal_science_score">ACT Science Score</label>
                                                        <input type="text" class="form-control goal-school-score gss-value" id="goal_science_score" value="{{ $college_list_date['goal_science_score'] }}" name="goal_science_score" placeholder="Please enter Science Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="goal_composite_score"><span class="goal-school-other-field-name">ACT</span> Composite Score</label>
                                                        <input type="text" class="form-control goal-school-score gss-value" id="goal_composite_score" value="{{ $college_list_date['goal_composite_score'] }}" name="goal_composite_score" placeholder="Please enter Composite Score" readonly="readonly">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-default" role="tab" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q4" aria-expanded="false" aria-controls="faq6_q4">
                                        <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i>Final Scores</a>
                                    </div>
                                    <div id="faq6_q4" class="collapse" role="tabpanel" aria-labelledby="faq6_h1"
                                        data-bs-parent="#faq6" style="">
                                        <div class="block-content">
                                            <div class="block block-rounded">
                                                <form id="final-school-form">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="final_test_type">Select Test Type</label>
                                                        <select class="form-control fss-value" id="final_test_type" name="final_test_type">
                                                            @foreach($test_type as $key => $test)
                                                                <option value="{{ $test }}" @if($college_list_date['final_test_type'] == $test) selected @endif>{{ $test }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 mb-4 w-100">
                                                        <label class="form-label" for="final_test_date">Select Test Date</label>
                                                        <input type="text" class="date-own form-control fss-value" id="final_test_date" name="final_test_date" value="{{ $college_list_date['final_test_date'] }}" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="mb-2 final-school-act-fields">
                                                        <label class="form-label" for="final_english_score">ACT English Score</label>
                                                        <input type="text" class="form-control final-school-score fss-value" id="final_english_score" value="{{ $college_list_date['final_english_score'] }}" name="final_english_score" placeholder="Please enter English Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="final_reading_score" id="final-school-reading-label">ACT Reading Score</label>
                                                        <input type="text" class="form-control final-school-score fss-value" id="final_reading_score" value="{{ $college_list_date['final_reading_score'] }}" name="final_reading_score" placeholder="Please enter Reading Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="final_math_score"><span class="final-school-other-field-name">ACT</span> Math Score</label>
                                                        <input type="text" class="form-control final-school-score fss-value" id="final_math_score" value="{{ $college_list_date['final_math_score'] }}" name="final_math_score" placeholder="Please enter Math Score">
                                                    </div>
                                                    <div class="mb-2 final-school-act-fields">
                                                        <label class="form-label" for="final_science_score">ACT Science Score</label>
                                                        <input type="text" class="form-control final-school-score fss-value" id="final_science_score" value="{{ $college_list_date['final_science_score'] }}" name="final_science_score" placeholder="Please enter Science Score">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label" for="final_composite_score"><span class="final-school-other-field-name">ACT</span> Composite Score</label>
                                                        <input type="text" class="form-control final-school-score fss-value" id="final_composite_score" value="{{ $college_list_date['final_composite_score'] }}" name="final_composite_score" placeholder="Please enter Composite Score" readonly="readonly">
                                                    </div>
                                                </form>
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
                <a href="{{ route('admin-dashboard.initialCollegeList.step2', ['college_lists_id' => request()->get('college_lists_id')]) }}" class="btn btn-alt-success prev-step"> Previous Step </a>
                <!-- <button type="submit" class="btn  btn-alt-success next-step">Next Step</button> -->
                <a href="{{ route('admin-dashboard.initialCollegeList.step4') }}" class="btn btn-alt-success next-step"> Next Step </a>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="add-past-current-score" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><span id="form-title">Add</span> Past/Current Test Scores</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add-past-current-score-form">
            <div class="mb-4">
               <label class="form-label" for="test_type">Select Test Type</label>
               <select class="form-control" id="test_type" name="test_type">
                   @foreach($test_type as $key => $test)
                       <option value="{{ $test }}">{{ $test }}</option>
                   @endforeach
               </select>
            </div>
            <div class="col-xl-4 mb-4 w-100">
                <label class="form-label" for="test_date">Select Test Date</label>
                <input type="text" class="date-own form-control" id="test_date" name="test_date" value="" placeholder="dd/mm/yy" autocomplete="off">
            </div>
            <div class="mb-2 act-fields">
                <label class="form-label" for="english_score"><span>ACT</span> English Score</label>
                <input type="text" class="form-control score" id="english_score" name="english_score" placeholder="Please enter English Score">
            </div>
            <div class="mb-2">
                <label class="form-label" for="reading_score"><span class="other-field-name">ACT</span> <span id="reading-title">Reading</span> Score</label>
                <input type="text" class="form-control score" id="reading_score" name="reading_score" placeholder="Please enter Reading Score">
            </div>
            <div class="mb-2">
                <label class="form-label" for="math_score"><span class="other-field-name">ACT</span> Math Score</label>
                <input type="text" class="form-control score" id="math_score" name="math_score" placeholder="Please enter Math Score">
            </div>
            <div class="mb-2 act-fields">
                <label class="form-label" for="science_score"><span>ACT</span> Science Score</label>
                <input type="text" class="form-control score" id="science_score" name="science_score" placeholder="Please enter Science Score">
            </div>
            <div class="mb-2">
                <label class="form-label" for="composite_score"><span class="other-field-name">ACT</span> Composite Score</label>
                <input type="text" class="form-control score" id="composite_score" name="composite_score" placeholder="Please enter Composite Score" readonly="readonly">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-alt-success" id="add-score">Add</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">

    <style>
        .no-data {
            border: `1px solid;
            border-style: dashed;
            border-color: darkgray;
            padding: 10px;
            text-align: center;
            font-size: 15px;
            f`ont-weight: 500;
        }
    </style>
@endsection


@section('user-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/selecting-search-params.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{asset('js/college-score.js')}}"></script>
<script>
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

    const collegeData = @json($college_list_date)

    $('.date-own').datepicker({
        format: 'dd-mm-yyyy',
        // startDate: '-3d',
        autoclose: true,
    });

    $(document).ready(function () {
        getPastCurrentScore(collegeData)
        hideShowHighSchoolScoreFields(collegeData.high_school_test_type)
        hideShowGoalSchoolScoreFields(collegeData.goal_test_type)
        hideShowFinalSchoolScoreFields(collegeData.final_test_type)
    })

    $('#add-score').on('click', function (e) {
        e.preventDefault();
        if ($('#add-past-current-score-form').valid()) {
            $.ajax({
                url: "{{ route('admin-dashboard.initialCollegeList.storePastCurrentScore') }}",
                type: "post",
                data: {
                    college_list_id: collegeData.id,
                    ...$('#add-past-current-score-form').serializeArray().reduce((acc, item) => {
                        acc[item.name] = item.value;
                        return acc;
                    }, {})
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }).done(async (response) => {
                if (response.success) {
                    $('#add-past-current-score').modal('hide');
                    resetModal();
                    await getPastCurrentScore(collegeData)
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            })
        }
    })
</script>
@endsection
