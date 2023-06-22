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
                <form action="{{ route('admin-dashboard.initialCollegeList.step3.submitForm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="college_lists_id" value="{{ request()->get('college_lists_id') }}">
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
                                            <div id="faq6_q1" class="collapse @if($errors->has('high_school_test_type') || $errors->has('high_school_test_date') || $errors->has('high_school_english_score') || $errors->has('high_school_math_score') || $errors->has('high_school_reading_score') || $errors->has('high_school_science_score') || $errors->has('high_school_composite_score')) show @endif" role="tabpanel" aria-labelledby="faq6_h1" data-bs-parent="#faq6" style="">
                                                <div class="block-content">
                                                    <div class="block block-rounded">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="high_school_test_type">Select Test Type</label>
                                                            <select class="form-control store-value {{$errors->has('high_school_test_type') ? 'is-invalid' : ''}}" id="high_school_test_type" name="high_school_test_type">
                                                                @foreach($test_type as $key => $test)
                                                                    <option value="{{ $test }}" @if($college_list_date['high_school_test_type'] == $test) selected @elseif($key === 0) selected @endif>{{ $test }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('high_school_test_type')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-4 mb-4">
                                                            <label class="form-label" for="high_school_test_date">Select Test Date</label>
                                                            <input type="text" class="date-own form-control store-value {{$errors->has('high_school_test_date') ? 'is-invalid' : ''}}" id="high_school_test_date" name="high_school_test_date" placeholder="dd/mm/yy" value="{{ $college_list_date['high_school_test_date'] }}" autocomplete="off">
                                                            @error('high_school_test_date')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 act-fileds @if($college_list_date['high_school_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="high_school_english_score"><span class="high-test-name">ACT</span> English Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('high_school_english_score') ? 'is-invalid' : ''}}" id="high_school_english_score" name="high_school_english_score" value="{{ $college_list_date['high_school_english_score'] }}" placeholder="Please enter English Score">
                                                            @error('high_school_english_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 act-fileds @if($college_list_date['high_school_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="high_school_math_score"><span class="high-test-name">ACT</span> Math Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('high_school_math_score') ? 'is-invalid' : ''}}" id="high_school_math_score" name="high_school_math_score" value="{{ $college_list_date['high_school_math_score'] }}" placeholder="Please enter Math Score">
                                                            @error('high_school_math_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 act-fileds @if($college_list_date['high_school_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="high_school_science_score"><span class="high-test-name">ACT</span> Science Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('high_school_science_score') ? 'is-invalid' : ''}}" id="high_school_science_score" name="high_school_science_score" value="{{ $college_list_date['high_school_science_score'] }}" placeholder="Please enter Science Score">
                                                            @error('high_school_science_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2">
                                                            <label class="form-label" for="high_school_reading_score"><span class="high-test-name">ACT</span> Reading Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('high_school_reading_score') ? 'is-invalid' : ''}}" id="high_school_reading_score" name="high_school_reading_score" value="{{ $college_list_date['high_school_reading_score'] }}" placeholder="Please enter Reading Score">
                                                            @error('high_school_reading_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 other-fileds @if($college_list_date['high_school_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="high_school_write_score"><span class="high-test-name">ACT</span> Write Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('high_school_write_score') ? 'is-invalid' : ''}}" id="high_school_write_score" name="high_school_write_score" value="{{ $college_list_date['high_school_write_score'] }}" placeholder="Please enter Write Score">
                                                            @error('high_school_write_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 other-fileds @if($college_list_date['high_school_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="high_school_math_with_no_calculator_score"><span class="high-test-name">ACT</span> Math with no Calculator</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('high_school_math_with_no_calculator_score') ? 'is-invalid' : ''}}" id="high_school_math_with_no_calculator_score" name="high_school_math_with_no_calculator_score" value="{{ $college_list_date['high_school_math_with_no_calculator_score'] }}" placeholder="Please enter Math with no Calculator Score">
                                                            @error('high_school_math_with_no_calculator_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 other-fileds @if($college_list_date['high_school_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="high_school_math_with_calculator_score"><span class="high-test-name">ACT</span> Math with Calculator</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('high_school_math_with_calculator_score') ? 'is-invalid' : ''}}" id="high_school_math_with_calculator_score" name="high_school_math_with_calculator_score" value="{{ $college_list_date['high_school_math_with_calculator_score'] }}" placeholder="Please enter Math with no Calculator Score">
                                                            @error('high_school_math_with_calculator_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                            <div class="block-header block-header-default" role="tab" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q2" aria-expanded="false" aria-controls="faq6_q2">
                                                <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i> Past/Current Test Scores</a>
                                            </div>
                                            <div id="faq6_q2" class="collapse @if($errors->has('past_current_test_type') || $errors->has('past_current_test_date') || $errors->has('past_current_english_score') || $errors->has('past_current_math_score') || $errors->has('past_current_reading_score') || $errors->has('past_current_science_score') || $errors->has('past_current_composite_score')) show @endif" role="tabpanel" aria-labelledby="faq6_h1" data-bs-parent="#faq6" style="">
                                                <div class="block-content">
                                                    <div class="block block-rounded">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="past_current_test_type">Select Test Type</label>
                                                            <select class="form-control store-value {{$errors->has('past_current_test_type') ? 'is-invalid' : ''}}" id="past_current_test_type" name="past_current_test_type">
                                                                @foreach($test_type as $key => $test)
                                                                    <option value="{{ $test }}" @if($college_list_date['past_current_test_type'] == $test) selected @elseif($key === 0) selected @endif>{{ $test }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('past_current_test_type')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-4 mb-4">
                                                            <label class="form-label" for="past_current_test_date">Select Test Date</label>
                                                            <input type="text" class="date-own form-control store-value {{$errors->has('past_current_test_date') ? 'is-invalid' : ''}}" id="past_current_test_date" name="past_current_test_date" value="{{ $college_list_date['past_current_test_date'] }}" placeholder="dd/mm/yy" autocomplete="off">
                                                            @error('past_current_test_date')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 past-current-act-fileds @if($college_list_date['past_current_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="past_current_english_score"><span class="past-curent-test-name">ACT</span> English Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('past_current_english_score') ? 'is-invalid' : ''}}" id="past_current_english_score" name="past_current_english_score" value="{{ $college_list_date['past_current_english_score'] }}" placeholder="Please enter English Score">
                                                            @error('past_current_english_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 past-current-act-fileds @if($college_list_date['past_current_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="past_current_math_score"><span class="past-curent-test-name">ACT</span> Math Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('past_current_math_score') ? 'is-invalid' : ''}}" id="past_current_math_score" name="past_current_math_score" value="{{ $college_list_date['past_current_math_score'] }}" placeholder="Please enter Math Score">
                                                            @error('past_current_math_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 past-current-act-fileds @if($college_list_date['past_current_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="past_current_science_score"><span class="past-curent-test-name">ACT</span> Science Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('past_current_science_score') ? 'is-invalid' : ''}}" id="past_current_science_score" name="past_current_science_score" value="{{ $college_list_date['past_current_science_score'] }}" placeholder="Please enter Science Score">
                                                            @error('past_current_science_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2">
                                                            <label class="form-label" for="past_current_reading_score"><span class="past-curent-test-name">ACT</span> Reading Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('past_current_reading_score') ? 'is-invalid' : ''}}" id="past_current_reading_score" name="past_current_reading_score" value="{{ $college_list_date['past_current_reading_score'] }}" placeholder="Please enter Reading Score">
                                                            @error('past_current_reading_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        

                                                        <div class="mb-2 past-current-other-fileds @if($college_list_date['past_current_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="past_current_write_score"><span class="past-curent-test-name">ACT</span> Write Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('past_current_write_score') ? 'is-invalid' : ''}}" id="past_current_write_score" name="past_current_write_score" value="{{ $college_list_date['past_current_write_score'] }}" placeholder="Please enter Write Score">
                                                            @error('past_current_write_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 past-current-other-fileds @if($college_list_date['past_current_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="past_current_math_with_no_calculator_score"><span class="past-curent-test-name">ACT</span> Math with no Calculator</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('past_current_math_with_no_calculator_score') ? 'is-invalid' : ''}}" id="past_current_math_with_no_calculator_score" name="past_current_math_with_no_calculator_score" value="{{ $college_list_date['past_current_math_with_no_calculator_score'] }}" placeholder="Please enter Math with no Calculator Score">
                                                            @error('past_current_math_with_no_calculator_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 past-current-other-fileds @if($college_list_date['past_current_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="past_current_math_with_calculator_score"><span class="past-curent-test-name">ACT</span> Math with Calculator</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('past_current_math_with_calculator_score') ? 'is-invalid' : ''}}" id="past_current_math_with_calculator_score" name="past_current_math_with_calculator_score" value="{{ $college_list_date['past_current_math_with_calculator_score'] }}" placeholder="Please enter Math with no Calculator Score">
                                                            @error('past_current_math_with_calculator_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                            <div class="block-header block-header-default" role="tab" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q3" aria-expanded="false" aria-controls="faq6_q3">
                                                <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i>Goal Scores</a>
                                            </div>
                                            <div id="faq6_q3" class="collapse @if($errors->has('goal_test_type') || $errors->has('goal_test_date') || $errors->has('goal_english_score') || $errors->has('goal_math_score') || $errors->has('goal_reading_score') || $errors->has('goal_science_score') || $errors->has('goal_composite_score')) show @endif" role="tabpanel" aria-labelledby="faq6_h1"
                                                data-bs-parent="#faq6">
                                                <div class="block-content">
                                                    <div class="block block-rounded">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="goal_test_type">Select Test Type</label>
                                                            <select class="form-control store-value {{$errors->has('goal_test_type') ? 'is-invalid' : ''}}" id="goal_test_type" name="goal_test_type">
                                                                @foreach($test_type as $key => $test)
                                                                    <option value="{{ $test }}" @if($college_list_date['goal_test_type'] == $test) selected @elseif($key === 0) selected @endif>{{ $test }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('goal_test_type')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-4 mb-4">
                                                            <label class="form-label" for="goal_test_date">Select Test Date</label>
                                                            <input type="text" class="date-own form-control store-value {{$errors->has('goal_test_date') ? 'is-invalid' : ''}}" id="goal_test_date" name="goal_test_date" value="{{ $college_list_date['goal_test_date'] }}" placeholder="dd/mm/yy" autocomplete="off">
                                                            @error('goal_test_date')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 goal-act-fileds @if($college_list_date['goal_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="goal_english_score"><span class="goal-test-name">ACT</span> English Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('goal_english_score') ? 'is-invalid' : ''}}" id="goal_english_score" name="goal_english_score" value="{{ $college_list_date['goal_english_score'] }}" placeholder="Please enter English Score">
                                                            @error('goal_english_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 goal-act-fileds @if($college_list_date['goal_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="goal_math_score"><span class="goal-test-name">ACT</span> Math Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('goal_math_score') ? 'is-invalid' : ''}}" id="goal_math_score" name="goal_math_score" value="{{ $college_list_date['goal_math_score'] }}" placeholder="Please enter Math Score">
                                                            @error('goal_math_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 goal-act-fileds @if($college_list_date['goal_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="goal_science_score"><span class="goal-test-name">ACT</span> Science Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('goal_science_score') ? 'is-invalid' : ''}}" id="goal_science_score" name="goal_science_score" value="{{ $college_list_date['goal_science_score'] }}" placeholder="Please enter Science Score">
                                                            @error('goal_science_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2">
                                                            <label class="form-label" for="goal_reading_score"><span class="goal-test-name">ACT</span> Reading Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('goal_reading_score') ? 'is-invalid' : ''}}" id="goal_reading_score" name="goal_reading_score" value="{{ $college_list_date['goal_reading_score'] }}" placeholder="Please enter Reading Score">
                                                            @error('goal_reading_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        
                                                        <div class="mb-2 goal-other-fileds @if($college_list_date['goal_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="goal_write_score"><span class="goal-test-name">ACT</span> Write Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('goal_write_score') ? 'is-invalid' : ''}}" id="goal_write_score" name="goal_write_score" value="{{ $college_list_date['goal_write_score'] }}" placeholder="Please enter Write Score">
                                                            @error('goal_write_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 goal-other-fileds @if($college_list_date['goal_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="goal_math_with_no_calculator_score"><span class="goal-test-name">ACT</span> Math with no Calculator</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('goal_math_with_no_calculator_score') ? 'is-invalid' : ''}}" id="goal_math_with_no_calculator_score" name="goal_math_with_no_calculator_score" value="{{ $college_list_date['goal_math_with_no_calculator_score'] }}" placeholder="Please enter Math with no Calculator Score">
                                                            @error('goal_math_with_no_calculator_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 goal-other-fileds @if($college_list_date['goal_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="goal_math_with_calculator_score"><span class="goal-test-name">ACT</span> Math with Calculator</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('goal_math_with_calculator_score') ? 'is-invalid' : ''}}" id="goal_math_with_calculator_score" name="goal_math_with_calculator_score" value="{{ $college_list_date['goal_math_with_calculator_score'] }}" placeholder="Please enter Math with no Calculator Score">
                                                            @error('high_school_math_with_calculator_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                            <div class="block-header block-header-default" role="tab" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q4" aria-expanded="false" aria-controls="faq6_q4">
                                                <a class="text-dark collapsed"><i class="nav-main-link-icon fa fa-clock"></i>Final Scores</a>
                                            </div>
                                            <div id="faq6_q4" class="collapse @if($errors->has('final_test_type') || $errors->has('final_test_date') || $errors->has('final_english_score') || $errors->has('final_math_score') || $errors->has('final_reading_score') || $errors->has('final_science_score') || $errors->has('final_composite_score')) show @endif" role="tabpanel" aria-labelledby="faq6_h1"
                                                data-bs-parent="#faq6" style="">
                                                <div class="block-content">
                                                    <div class="block block-rounded">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="final_test_type">Select Test Type</label>
                                                            <select class="form-control store-value {{$errors->has('final_test_type') ? 'is-invalid' : ''}}" id="final_test_type" name="final_test_type">
                                                                @foreach($test_type as $key => $test)
                                                                    <option value="{{ $test }}" @if($college_list_date['final_test_type'] == $test) selected @elseif($key === 0) selected @endif>{{ $test }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('final_test_type')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-4 mb-4">
                                                            <label class="form-label" for="final_test_date">Select Test Date</label>
                                                            <input type="text" class="date-own form-control store-value {{$errors->has('final_test_date') ? 'is-invalid' : ''}}" id="final_test_date" name="final_test_date" value="{{ $college_list_date['final_test_date'] }}" placeholder="dd/mm/yy" autocomplete="off">
                                                            @error('final_test_date')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 final-act-fileds @if($college_list_date['final_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="final_english_score"><span class="final-test-name">ACT</span> English Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('final_english_score') ? 'is-invalid' : ''}}" id="final_english_score" name="final_english_score" value="{{ $college_list_date['final_english_score'] }}" placeholder="Please enter English Score">
                                                            @error('final_english_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 final-act-fileds @if($college_list_date['final_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="final_math_score"><span class="final-test-name">ACT</span> Math Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('final_math_score') ? 'is-invalid' : ''}}" id="final_math_score" name="final_math_score" value="{{ $college_list_date['final_math_score'] }}" placeholder="Please enter Math Score">
                                                            @error('final_math_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 final-act-fileds @if($college_list_date['final_test_type'] != 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="final_science_score"><span class="final-test-name">ACT</span> Science Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('final_science_score') ? 'is-invalid' : ''}}" id="final_science_score" name="final_science_score" value="{{ $college_list_date['final_science_score'] }}" placeholder="Please enter Science Score">
                                                            @error('final_science_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2">
                                                            <label class="form-label" for="final_reading_score"><span class="final-test-name">ACT</span> Reading Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('final_reading_score') ? 'is-invalid' : ''}}" id="final_reading_score" name="final_reading_score" value="{{ $college_list_date['final_reading_score'] }}" placeholder="Please enter Reading Score">
                                                            @error('final_reading_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        
                                                        <div class="mb-2 final-fileds @if($college_list_date['final_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="final_write_score"><span class="final-test-name">ACT</span> Write Score</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('final_write_score') ? 'is-invalid' : ''}}" id="final_write_score" name="final_write_score" value="{{ $college_list_date['final_write_score'] }}" placeholder="Please enter Write Score">
                                                            @error('final_write_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 final-fileds @if($college_list_date['final_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="final_math_with_no_calculator_score"><span class="final-test-name">ACT</span> Math with no Calculator</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('final_math_with_no_calculator_score') ? 'is-invalid' : ''}}" id="final_math_with_no_calculator_score" name="final_math_with_no_calculator_score" value="{{ $college_list_date['final_math_with_no_calculator_score'] }}" placeholder="Please enter Math with no Calculator Score">
                                                            @error('final_math_with_no_calculator_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2 final-fileds @if($college_list_date['final_test_type'] === 'ACT') d-none @else d-block @endif">
                                                            <label class="form-label" for="final_math_with_calculator_score"><span class="final-test-name">ACT</span> Math with Calculator</label>
                                                            <input type="text" class="form-control store-value {{$errors->has('final_math_with_calculator_score') ? 'is-invalid' : ''}}" id="final_math_with_calculator_score" name="final_math_with_calculator_score" value="{{ $college_list_date['final_math_with_calculator_score'] }}" placeholder="Please enter Math with no Calculator Score">
                                                            @error('high_school_math_with_calculator_score')
                                                                <div class="invalid-feedback">{{$message}}</div>
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
                        <a href="{{ route('admin-dashboard.initialCollegeList.step2', ['college_lists_id' => request()->get('college_lists_id')]) }}" class="btn btn-alt-success prev-step"> Previous Step </a>
                        <!-- <button type="submit" class="btn  btn-alt-success next-step">Next Step</button> -->
                        <a href="{{ route('admin-dashboard.initialCollegeList.step4') }}" class="btn btn-alt-success next-step"> Next Step </a>
                    </div>
                </form>
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
    $(document).ready(function () {
        $('.high-test-name').text($('#high_school_test_type').val());
        $('.past-curent-test-name').text($('#past_current_test_type').val());
        $('.goal-test-name').text($('#goal_test_type').val());
        $('.final-test-name').text($('#final_test_type').val());
    })

    const collegeData = @json($college_list_date)

    $('.date-own').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '-3d',
        autoclose: true,
    });
    $('#high_school_test_type').on('change', function (e) {
        $('.high-test-name').text($('#high_school_test_type').val());

        if ($('#high_school_test_type').val() == 'ACT') {
            $('.act-fileds').removeClass('d-none');
            $('.other-fileds').addClass('d-none');
            $('#high_school_write_score').val('');
            $('#high_school_math_with_no_calculator_score').val('');
            $('#high_school_math_with_calculator_score').val('');
        } else {
            $('.act-fileds').addClass('d-none');
            $('.other-fileds').removeClass('d-none');
            $('#high_school_english_score').val('');
            $('#high_school_math_score').val('');
            $('#high_school_science_score').val('');
        }
        $('#high_school_reading_score').val('');
    })
    $('#past_current_test_type').on('change', function (e) {
        $('.past-curent-test-name').text($('#past_current_test_type').val());

        if ($('#past_current_test_type').val() == 'ACT') {
            $('.past-current-act-fileds').removeClass('d-none');
            $('.past-current-other-fileds').addClass('d-none');
            $('#past_current_write_score').val('');
            $('#past_current_math_with_no_calculator_score').val('');
            $('#past_current_math_with_calculator_score').val('');
        } else {
            $('.past-current-act-fileds').addClass('d-none');
            $('.past-current-other-fileds').removeClass('d-none');
            $('#past_current_english_score').val('');
            $('#past_current_math_score').val('');
            $('#past_current_science_score').val('');
        }
        $('#past_current_reading_score').val('');
    })
    $('#goal_test_type').on('change', function (e) {
        $('.goal-test-name').text($('#goal_test_type').val());

        if ($('#goal_test_type').val() == 'ACT') {
            $('.goal-act-fileds').removeClass('d-none');
            $('.goal-other-fileds').addClass('d-none');
            $('#goal_write_score').val('');
            $('#goal_math_with_no_calculator_score').val('');
            $('#goal_math_with_calculator_score').val('');
        } else {
            $('.goal-act-fileds').addClass('d-none');
            $('.goal-other-fileds').removeClass('d-none');
            $('#goal_english_score').val('');
            $('#goal_math_score').val('');
            $('#goal_science_score').val('');
        }
        $('#goal_reading_score').val('');
    })
    $('#final_test_type').on('change', function (e) {
        $('.final-test-name').text($('#final_test_type').val());

        if ($('#final_test_type').val() == 'ACT') {
            $('.final-act-fileds').removeClass('d-none');
            $('.final-fileds').addClass('d-none');
            $('#final_write_score').val('');
            $('#final_math_with_no_calculator_score').val('');
            $('#final_math_with_calculator_score').val('');
        } else {
            $('.final-act-fileds').addClass('d-none');
            $('.final-fileds').removeClass('d-none');
            $('#final_english_score').val('');
            $('#final_math_score').val('');
            $('#final_science_score').val('');
        }
        $('#final_reading_score').val('');
    })

    $('.store-value').on('change', function (e) {
        const payload = {}   
        if (e.target.tagName === 'SELECT') {
            let dNoneElement = $(this).closest('.block-content').find('.d-none');
            for (let  i = 0; i < dNoneElement.length; i++) {
                let elementName = $(dNoneElement[i]).find('.form-label').attr('for');
                payload[elementName] = null;
            }
        }
        autosave({
            ...payload,
            [e.target.name]: e.target.value
        });
    })

    function autosave(data) {
        $.ajax({
            url: "{{ route('admin-dashboard.initialCollegeList.step3.saveAcademicStatistics', [ 'id' => ':id' ]) }}".replace(':id', collegeData.id),
            type: "put",
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done((response) => {
            console.log(response);
        })
    }
</script>
@endsection
