@extends('layouts.user')

@section('title', 'Question & Concept Review : CPS')

@section('user-content')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            {{-- Test review title  --}}
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                        <div class="flex-grow-1">
                            <h1 class="h3 fw-bold mb-2 w-75">
                                Test Review
                                <br />
                                {{ isset($test_details->format) ? $test_details->format . ' Practice Test' : '' }}
                            </h1>
                            <div class="d-flex align-items-center" style="overflow-wrap: break-word;">
                                <div class="description-test"
                                    style="max-width: 100%; display: block; overflow-wrap: anywhere">
                                    <h2 class="fs-base lh-base fw-medium mb-0 description-test-review text-muted">
                                        {!! isset($test_details->description) ? $test_details->description : '' !!}
                                    </h2>
                                </div>
                                {{-- <div>
                                    <p class="ms-5 d-flex align-items-center mb-0 w-100">{{ isset($test_details->created_at) ? ' - '. date('F Y', strtotime($test_details->created_at)) : '' }}</p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="content content-full">
                        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                @if (isset($test_details) && !empty($test_details))
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a class="link-fx"
                                            href="{{ url('user/practice-test-sections/' . $test_details->id) }}">College
                                            Prep
                                            System {{ isset($test_details->format) ? $test_details->format : '' }}
                                            {{ isset($test_details->title) ? $test_details->title : '' }}
                                            {{ isset($test_details->id) ? '#' . $test_details->id : '' }}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="link-fx"
                                            href="javascript:void(0)">{{ isset($test_details->format) ? $test_details->format . ' Practice Test' : '' }}
                                            {{ isset($test_details->created_at) ? ' - ' . date('F Y', strtotime($test_details->created_at)) . ' Review Summary' : '' }}</a>
                                    </li>
                                @endif
                                {{-- <li class="breadcrumb-item" aria-current="page">
                                    ACT Math Review (Form 1576C / Z04)
                                </li> --}}
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            {{-- END Test review title --}}

            <div class="content">
                {{-- Pick a Review Option --}}
                <h2 class="content-heading">Pick a Review Option</h2>
                {{-- END Pick a Review Option --}}

                <div class="">
                    <ul class="nav nav-tabs col-12" role="tablist">
                        <li class="nav-item me-0 col-12 col-md-4 col-xl-4 px-2 pe-md-3" role="presentation">
                            <button class="block block-rounded bg-primary-dark nav-link w-100 tab-padding"
                                id="btabs-animated-fade-home-tab" data-bs-toggle="tab"
                                data-bs-target="#btabs-animated-fade-home" role="tab"
                                aria-controls="btabs-animated-fade-home" aria-selected="false" tabindex="-1">
                                <div
                                    class="block-content text-start p-0 block-content-full  d-flex justify-content-between">
                                    <div class="me-3">
                                        <p class="fw-semibold text-white mb-0">Question & Concept Review</p>
                                        <p class="fs-sm text-white-75 mb-0">
                                            Practice Test 1576C
                                        </p>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item me-0 col-12 col-md-4 col-xl-4 px-2" role="presentation">
                            <button class="block block-rounded bg-primary-dark nav-link w-100 tab-padding"
                                id="btabs-animated-fade-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#btabs-animated-fade-profile" role="tab"
                                aria-controls="btabs-animated-fade-profile" aria-selected="true">
                                <div
                                    class="block-content text-start p-0 block-content-full  d-flex justify-content-between">
                                    <div class="me-3">
                                        <p class="fw-semibold text-white mb-0">Category & Question Type Summary</p>
                                        <p class="fs-sm text-white-75 mb-0">
                                            from your missed questions.
                                        </p>
                                    </div>
                                </div>
                            </button>
                        </li>
                        <li class="nav-item me-0 col-12 col-md-4 col-xl-4 px-2 ps-md-3" role="presentation">
                            <button class="block block-rounded bg-primary-dark nav-link w-100 tab-padding"
                                id="btabs-animated-fade-answer-tab" data-bs-toggle="tab"
                                data-bs-target="#btabs-animated-fade-answer" role="tab"
                                aria-controls="btabs-animated-fade-answer" aria-selected="true">
                                <div
                                    class="block-content text-start p-0 block-content-full  d-flex justify-content-between">
                                    <div class="me-3">
                                        <p class="fw-semibold text-white mb-0">Answer Type Summary</p>
                                        <p class="fs-sm text-white-75 mb-0">
                                            from your missed questions.
                                        </p>
                                    </div>
                                </div>
                            </button>
                        </li>
                    </ul>
                    <div class="block-content tab-content overflow-hidden">

                        {{-- Question & Concept Review MOBILE tab --}}
                        <div class="tab-pane fade active show" id="btabs-animated-fade-home" role="tabpanel"
                            aria-labelledby="btabs-animated-fade-home-tab" tabindex="0">
                            {{-- score summary - act 1576c --}}
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Score Summary - ACT 1576C</h3>
                                </div>
                                <div class="block-content">
                                    {{-- <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="" id="mega-settings-status" name="mega-settings-status">
                                        <label class="form-check-label fs-sm" for="mega-settings-status">Show All Sections</label>
                                    </div> --}}
                                    <table class="js-table-sections table table-hover table-vcenter table-contant">
                                        <thead>
                                            <tr class=" align-items-center justify-content-between">
                                                <th>Section</th>
                                                <th># Correct</th>
                                                <th>Scaled Score
                                                    ({{ isset($low_score) ? number_format($low_score, 0) : '-' }}-{{ isset($high_score) ? number_format($high_score, 0) : '-' }})
                                                </th>
                                                <th>Date Taken</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class=" align-items-center justify-content-between">
                                                <td>
                                                    @if (isset($user_selected_answers[0]['all_sections']) && !empty($user_selected_answers[0]['all_sections']))
                                                        @foreach ($user_selected_answers[0]['all_sections'] as $test_section)
                                                            <li class="mt-3">{{ $test_section->practice_test_type }}</li>
                                                        @endforeach
                                                    @endif
                                                    @if (isset($user_selected_answers[0]['sections']) && !empty($user_selected_answers[0]['sections']))
                                                        @foreach ($user_selected_answers[0]['sections'] as $test_section)
                                                            <li>{{ $test_section->practice_test_type }}</li>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                {{-- @if (isset($right_answers) && !empty($right_answers))
                                                    <td>{{ $right_answers }}/{{ $total_questions }}</td>
                                                @endif --}}
                                                <td>{{ isset($right_answers) ? $right_answers : '' }}/{{ isset($total_questions) ? $total_questions : '' }}
                                                </td>
                                                <td>{{ number_format($scaled_score, 0) }}</td>
                                                <td>
                                                    @if (isset($user_selected_answers[0]['date_taken']) && !empty($user_selected_answers[0]['date_taken']))
                                                        @foreach ($user_selected_answers[0]['date_taken'] as $test_date)
                                                            <li>{{ date('d-m-Y', strtotime($test_date->created_at)) }}</li>
                                                        @endforeach
                                                    @endif
                                                    @if (isset($user_selected_answers[0]['taken_date']) && !empty($user_selected_answers[0]['taken_date']))
                                                        @foreach ($user_selected_answers[0]['taken_date'] as $test_date)
                                                            <li>{{ date('d-m-Y', strtotime($test_date->created_at)) }}</li>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                {{-- <td>{{date('d-m-y',strtotime($user_selected_answers[0]['date_taken'][0]->created_at))}}</td>
                                            </tr> --}}
                                                {{-- @if ($user_selected_answers[0]['type'] == 'all')
                                                @foreach ($user_selected_answers as $user_selected_answer)
                                                    <tr>
                                                        <td>{{$user_selected_answer['all_sections'][0]['practice_test_type']}}</td>
                                                        <td>{{$right_answers}}/{{$total_questions}}</td>
                                                        <td>28</td>
                                                        <td>{{date('d-m-y',strtotime($user_selected_answer['date_taken'][0]->created_at))}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if ($user_selected_answers[0]['type'] == 'single')
                                                @foreach ($user_selected_answers as $user_selected_answer)
                                                    <tr>
                                                        <td>{{$user_selected_answer['sections'][0]['practice_test_type']}}</td>
                                                        <td>{{$right_answers}}/{{$total_questions}}</td>
                                                        <td>28</td>
                                                        <td>{{date('d-m-y',strtotime($user_selected_answer['date_taken'][0]->created_at))}}</td>
                                                    </tr>
                                                    @break
                                                @endforeach
                                            @endif --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- END score summary - act 1576c --}}

                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Question & Concept Review</h3>
                                </div>
                                <div class="block-content">
                                    <h3>ACT Math - Official Form 1576C</h3>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value=""
                                            onchange="showIncorrectAnswer(this)" name="mega-settings-status">
                                        <label class="form-check-label fs-sm" for="mega-settings-status">Show Incorrect
                                            Questions Only</label>
                                    </div>
                                    <div class="container position-fixed">
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-primary fs-xs fw-semibold"
                                                        data-bs-trigger="click">Generate
                                                        Custom Quiz</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- header --}}
                                    <table class="js-table-sections table table-hover table-vcenter">
                                        <thead>
                                            <tr class="d-flex align-items-center justify-content-between"
                                                style="width: 410px">
                                                <th></th>
                                                <th class="ms-2">Q#</th>
                                                <th class="text-center ms-2">Your Answer</th>
                                                <th class="text-center ms-2">Correct Answer</th>
                                                <th>Flags</th>
                                            </tr>
                                        </thead>
                                    </table>

                                    {{-- END header --}}
                                    <script>
                                        jQuery(document).ready(function() {
                                            function removeTags(str) {
                                                if ((str === null) || (str === ''))
                                                    return false;
                                                else
                                                    str = str.toString();
                                                return str.replace(/(<([^>]+)>)/ig, '');
                                            }

                                            jQuery(".text-info").click(function() {
                                                jQuery(this).next("div.modal").css("display", "block");


                                                jQuery(this).next("div.modal").find(".nav-link").removeClass('active');
                                                jQuery(this).next("div.modal").find(".tab-pane").removeClass('active');
                                                jQuery(this).next("div.modal").find(".tab-pane:first").addClass('active');

                                                //jQuery('.nav-link').removeClass('active');
                                                //jQuery('.tab-pane').removeClass('active');
                                                //jQuery(".tab-pane:first").addClass('active');

                                                var get_question_title = removeTags(jQuery(this).data('question-title'));
                                                jQuery(".text-info").addClass(get_question_title);
                                                // var get_passage_title = removeTags(jQuery(this).data('passage-title'));
                                                var serial_no = jQuery(this).data('serial-no');
                                                var get_correct_answer = jQuery(this).data('correct-answer');
                                                var get_user_answer = jQuery(this).data('user-answer');
                                                var get_answers_exp = jQuery(this).data('answers-exp');
                                                var get_answers_explanation = jQuery(this).data('answers-explanation');
                                                var get_question_id = jQuery(this).data('question-id');

                                                jQuery(".set_serial_no").text(serial_no);
                                                // jQuery(".set_question_title").text(get_question_title);
                                                // jQuery(".set_passage_title").text(get_passage_title);

                                                var array_correct = get_correct_answer.split(',');
                                                array_correct = $.map(array_correct, function(value) {
                                                    // return value.replace(/ /g, '');
                                                    return value.trim();
                                                });
                                                var array_user_answer = get_user_answer.split(',');
                                                array_user_answer = $.map(array_user_answer, function(value) {
                                                    // return value.replace(/ /g, '');
                                                    return value.trim();
                                                });

                                                jQuery(".text-info").parent().find(`.nav-tabs-alt-${get_question_id} .nav-item`).find(
                                                    '.text-gray').each(
                                                    function(index) {
                                                        for (let i = 0; i < get_answers_exp.length; i++) {
                                                            var new_txt = removeTags(get_answers_exp[i]);
                                                            if (get_answers_explanation && get_answers_explanation[i].length) {
                                                                $("div").find('[data-option=' + i + ']').html($("<p>" + get_answers_exp[
                                                                        i] +
                                                                    "</p><div class='d-flex'>Explanation: &nbsp;" +
                                                                    get_answers_explanation[i] + "</div>"));
                                                            } else {
                                                                $("div").find('[data-option=' + i + ']').html($("<p>" + get_answers_exp[
                                                                        i] +
                                                                    "</p><div class='d-flex text-danger'>No Explanation</div>"));
                                                            }
                                                        }

                                                        if ($(this).data('option-value') == 'a') {
                                                            $(this).addClass('active');
                                                        }
                                                        var option_value = $(this).data('option-value');
                                                        if (jQuery.inArray(option_value, array_correct) != -1) {
                                                            $(this).removeClass('bg-city-dark');
                                                            $(this).removeClass('bg-success');
                                                            $(this).removeClass('bg-danger');
                                                            $(this).addClass('bg-success');
                                                        } else if (jQuery.inArray(option_value, array_user_answer) != -1) {
                                                            $(this).addClass('bg-danger');
                                                            $(this).addClass('text-gray');
                                                            $(this).removeClass('bg-success');
                                                            $(this).removeClass('bg-city-dark');
                                                        } else {
                                                            $(this).removeClass('bg-success');
                                                            $(this).addClass('text-gray');
                                                            $(this).addClass('bg-city-dark');
                                                        }
                                                    });
                                            });
                                            jQuery(".cat_type_desc_btn").click(function() {
                                                var get_question_desc = jQuery(this).data('question_desc');
                                                var get_question_title = jQuery(this).data('question_title');
                                                var get_question_lesson = jQuery(this).data('question_lesson');
                                                var get_question_strategies = jQuery(this).data('question_strategies');
                                                var get_question_identification_methods = jQuery(this).data(
                                                    'question_identification_methods');
                                                var get_question_identification_activity = jQuery(this).data(
                                                    'question_identification_activity');
                                                jQuery('.set_question_type_title').html(get_question_title);
                                                jQuery('.set_question_type_desc').html(get_question_desc);
                                                jQuery('.set_question_type_lesson').html(get_question_lesson);
                                                jQuery('.set_question_type_strategies').html(get_question_strategies);
                                                jQuery('.set_question_type_identification_methods').html(
                                                    get_question_identification_methods);
                                                jQuery('.set_question_type_identification_activity').html(
                                                    get_question_identification_activity);
                                            });
                                            jQuery(".category_description").click(function() {
                                                var get_category_title = jQuery(this).data('category_title');
                                                var get_category_description = jQuery(this).data('category_description');
                                                var get_category_lesson = jQuery(this).data('category_lesson');
                                                var get_category_strategies = jQuery(this).data('category_strategies');
                                                var get_category_identification_methods = jQuery(this).data(
                                                    'category_identification_methods');
                                                var get_category_identification_activity = jQuery(this).data(
                                                    'category_identification_activity');

                                                jQuery('.set_category_title').html(get_category_title);
                                                jQuery('.set_category_description').html(get_category_description);
                                                jQuery('.set_category_type_lesson').html(get_category_lesson);
                                                jQuery('.set_category_type_strategies').html(get_category_strategies);
                                                jQuery('.set_category_type_identification_methods').html(
                                                    get_category_identification_methods);
                                                jQuery('.set_category_type_identification_activity').html(
                                                    get_category_identification_activity);
                                            });
                                        });

                                        function showIncorrectAnswer(data) {
                                            let is_checked = $(data).is(':checked');
                                            let incorrect_answer = $('.incorrect-answers').parents('.hide-correct-answers').length;
                                            if (is_checked) {
                                                if (incorrect_answer == 0) {
                                                    $('.correct-answers').parents('.hide-correct-answers').hide();
                                                    $('#incorrect-message').text("Incorrect Question Not Found !");
                                                } else {
                                                    $('.correct-answers').parents('.hide-correct-answers').hide();
                                                }
                                            } else {
                                                $('#incorrect-message').text('');
                                                $('.correct-answers').parents('.hide-correct-answers').show();
                                            }
                                        }
                                    </script>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="setup-content" role="tabpanel" id="step1"
                                            aria-labelledby="step1-tab">
                                            <div class="accordion accordionExample">
                                                <span id="incorrect-message" class="text-danger"
                                                    style="text-align: center; font-weight:bolder;"></span>
                                                <?php
                                                $count = 1;
                                                $acc_id = 0;
                                                ?>
                                                @if (isset($user_selected_answers) && !empty($user_selected_answers))
                                                    @foreach ($user_selected_answers as $key => $single_user_selected_answers)
                                                        <div
                                                            class="hide-correct-answers block block-rounded block-bordered overflow-hidden mb-1">
                                                            @if (isset($single_user_selected_answers['get_question_details'][0]->question_id) &&
                                                                    !empty($single_user_selected_answers['get_question_details'][0]->question_id))
                                                                <div class="block-header block-header-tab justify-content-start"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#collapse_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapse_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>">
                                                                    <table>
                                                                        <tr>
                                                                            <td class="text-center">
                                                                                <i
                                                                                    class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                                            </td>
                                                                            <td class="d-flex align-items-center">
                                                                                <div
                                                                                    style="width: 70px; display: flex; align-items: start;">
                                                                                    <button type="button"
                                                                                        class="btn btn-danger fs-xs fw-semibold me-1 error-button"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-trigger="click"
                                                                                        data-bs-placement="top"
                                                                                        title="Question No.">{{ $count++ }}</button>
                                                                                </div>
                                                                                <?php $correct = [];
                                                                                array_push($correct, str_replace(' ', '', $single_user_selected_answers['get_question_details'][0]->question_answer));
                                                                                $helper = new Helper();
                                                                                ?>
                                                                                @if ($single_user_selected_answers['get_question_details'][0]->is_multiple_choice == 2)
                                                                                    {{-- @if (in_array(str_replace(' ', '', $single_user_selected_answers['user_selected_answer']), explode(',', $correct[0])) || in_array(str_replace(' ', '', $single_user_selected_answers['user_selected_answer']), $correct) || Str::contains($correct[0], explode(',', str_replace(' ', '', $single_user_selected_answers['user_selected_answer'])))) --}}
                                                                                    @if ($helper->stringExactMatch($correct[0], $single_user_selected_answers['user_selected_answer']))
                                                                                        <div
                                                                                            style="width: 120px; display: flex; align-items: start;">
                                                                                            <button type="button"
                                                                                                class="correct-answers btn btn-success fs-xs fw-semibold me-1"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-trigger="click"
                                                                                                data-bs-placement="top"
                                                                                                title="User Answer"><i
                                                                                                    class="fa fa-lg fa-circle-check me-1"
                                                                                                    style="color:white"></i>
                                                                                                {{ $single_user_selected_answers['user_selected_answer'] }}</button>
                                                                                        </div>
                                                                                    @else
                                                                                        <div
                                                                                            style="width: 120px; display: flex; align-items: start;">
                                                                                            <button type="button"
                                                                                                class="incorrect-answers btn btn-danger fs-xs fw-semibold me-1"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-trigger="click"
                                                                                                data-bs-placement="top"
                                                                                                title="User Answer"><i
                                                                                                    class="fa fa-lg fa-circle-xmark me-1"
                                                                                                    style="color:white"></i>
                                                                                                {{ $single_user_selected_answers['user_selected_answer'] }}</button>
                                                                                        </div>
                                                                                    @endif
                                                                                @else
                                                                                    @if (str_replace(' ', '', $single_user_selected_answers['user_selected_answer']) == str_replace(' ', '', $correct[0]))
                                                                                        <div
                                                                                            style="width: 120px; display: flex; align-items: start;">
                                                                                            <button type="button"
                                                                                                class="correct-answers btn btn-success fs-xs fw-semibold me-1"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-trigger="click"
                                                                                                data-bs-placement="top"
                                                                                                title="User Answer"><i
                                                                                                    class="fa fa-lg fa-circle-check me-1"
                                                                                                    style="color:white"></i>
                                                                                                {{ $single_user_selected_answers['user_selected_answer'] }}</button>
                                                                                        </div>
                                                                                    @else
                                                                                        <div
                                                                                            style="width: 120px; display: flex; align-items: start;">
                                                                                            <button type="button"
                                                                                                class="incorrect-answers btn btn-danger fs-xs fw-semibold me-1"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-trigger="click"
                                                                                                data-bs-placement="top"
                                                                                                title="User Answer"><i
                                                                                                    class="fa fa-lg fa-circle-xmark me-1"
                                                                                                    style="color:white"></i>
                                                                                                {{ $single_user_selected_answers['user_selected_answer'] }}</button>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif

                                                                                <div
                                                                                    style="width: 110px; display: flex; align-items: start;">
                                                                                    <button type="button"
                                                                                        class="btn btn-success fs-xs fw-semibold me-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-trigger="click"
                                                                                        data-bs-placement="top"
                                                                                        title="Right Answer"><i
                                                                                            class="fa fa-lg fa-circle-check me-1"
                                                                                            style="color:white"></i>
                                                                                        {{ $single_user_selected_answers['get_question_details'][0]->question_answer }}</button>
                                                                                </div>
                                                                                <div>
                                                                                    @if ($single_user_selected_answers['user_selected_flag'] == 'yes')
                                                                                        <i class="fa fa-fw fa-flag me-1"
                                                                                            style="color:rgb(255, 255, 255)"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-trigger="click"
                                                                                            data-bs-placement="top"
                                                                                            title="Flagged Question"></i>
                                                                                    @endif

                                                                                    @if ($single_user_selected_answers['user_selected_guess'] == 'yes')
                                                                                        <i class="fa fa-fw fa-circle-question me-1"
                                                                                            style="color:rgb(255, 255, 255)"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-trigger="click"
                                                                                            data-bs-placement="top"
                                                                                            title="Guessed On Question"></i>
                                                                                    @endif

                                                                                    @if ($single_user_selected_answers['user_selected_answer'] == '-')
                                                                                        <i style="color:rgb(255, 255, 255)"
                                                                                            class="fa fa-fw fa-forward me-1"
                                                                                            data-bs-trigger="click"
                                                                                            data-bs-placement="top"
                                                                                            title="Skipped Question"></i>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div id="collapse_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>" class="collapse"
                                                                    aria-labelledby="headingOne"
                                                                    data-parent=".accordionExample">
                                                                    <div class="odd">
                                                                        <div class="fw-semibold fs-sm p-4 ">

                                                                            <button type="button" data-bs-toggle="modal"
                                                                                data-bs-target="#modal-block-large-q1r_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                data-question-id="{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                data-question-title="{{ $single_user_selected_answers['get_question_details'][0]->question_title }}"
                                                                                data-correct-answer="{{ $single_user_selected_answers['get_question_details'][0]->question_answer }}"
                                                                                data-user-answer="{{ $single_user_selected_answers['user_selected_answer'] }}"
                                                                                data-answers-exp="{{ $single_user_selected_answers['get_question_details'][0]->question_answer_options }}"
                                                                                data-answers-explanation="{{ isset($single_user_selected_answers['get_question_details'][0]->answer_exp) ? $single_user_selected_answers['get_question_details'][0]->answer_exp : '' }}"
                                                                                data-serial-no="{{ $key + 1 }}"
                                                                                class="btn btn-info fs-xs fw-semibold me-1 mb-3 bg-info text-white text-info"><i
                                                                                    class="fa fa-lg fa-pencil me-1"></i>REVIEW</button>

                                                                            <div class="modal"
                                                                                id="modal-block-large-q1r_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                tabindex="-1"
                                                                                aria-labelledby="modal-block-large-q1r_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                style="display: none;" aria-hidden="true">
                                                                                <div class="modal-dialog modal-lg"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="block block-rounded">
                                                                                            <div
                                                                                                class="block-header block-header-default">
                                                                                                <h3 class="block-title">
                                                                                                    Question <span
                                                                                                        class="set_serial_no">{{ $key + 1 }}</span>
                                                                                                    Review</h3>
                                                                                            </div>
                                                                                            <div class="block-content">
                                                                                                <div
                                                                                                    class="row items-push">
                                                                                                    <div id="my-block"
                                                                                                        class="block block-rounded block-bordered">
                                                                                                        <div
                                                                                                            class="block-content">
                                                                                                            <p>N/A</p>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div id="my-block"
                                                                                                        class="block block-rounded block-bordered p-0">
                                                                                                        <div
                                                                                                            class="block-header block-header-default">
                                                                                                            <h3
                                                                                                                class="block-title">
                                                                                                                Question
                                                                                                                <span
                                                                                                                    class="set_serial_no">{{ $key + 1 }}</span>
                                                                                                            </h3>
                                                                                                            <div
                                                                                                                class="block-options">
                                                                                                                <button
                                                                                                                    type="button"
                                                                                                                    class="btn-block-option"
                                                                                                                    data-toggle="block-option"
                                                                                                                    data-action="content_toggle"></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="block-content">
                                                                                                            <p
                                                                                                                class="set_question_title">
                                                                                                                {!! $single_user_selected_answers['get_question_details'][0]->question_title !!}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @if ($single_user_selected_answers['get_question_details'][0]->practice_type == 'choiceOneInFive_Odd')
                                                                                                        <div
                                                                                                            class="block block-rounded">
                                                                                                            <ul class="nav nav-tabs nav-tabs-alt-{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                                                role="tablist">
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link active bg-danger
                                                                                                            text-gray
                                                                                                            text-white"
                                                                                                                        id="btabs-alt-static-home-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-home"
                                                                                                                        data-option-value='a'
                                                                                                                        aria-selected="true">Answer
                                                                                                                        A</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='b'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        B</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='c'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        C</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='d'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        D</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1e_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='e'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        E</button>
                                                                                                                </li>
                                                                                                            </ul>

                                                                                                            <div
                                                                                                                class="block-content tab-content">
                                                                                                                <div class="tab-pane active"
                                                                                                                    id="btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="0"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-home-tab">
                                                                                                                    <p>NO
                                                                                                                        CHANGE:
                                                                                                                        1/9
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="1"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>1/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="2"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>6/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="3"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>7/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1e_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="4"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>8/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @elseif($single_user_selected_answers['get_question_details'][0]->practice_type == 'choiceOneInFive_Even')
                                                                                                        <div
                                                                                                            class="block block-rounded">
                                                                                                            <ul class="nav nav-tabs nav-tabs-alt-{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                                                role="tablist">
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link active bg-danger
                                                                                                            text-gray
                                                                                                            text-white"
                                                                                                                        id="btabs-alt-static-home-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1f_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-home"
                                                                                                                        data-option-value='f'
                                                                                                                        aria-selected="true">Answer
                                                                                                                        F</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1g_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='g'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        G</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1h_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='h'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        H</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1j_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='j'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        J</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1k_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='k'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        K</button>
                                                                                                                </li>
                                                                                                            </ul>

                                                                                                            <div
                                                                                                                class="block-content tab-content">
                                                                                                                <div class="tab-pane active"
                                                                                                                    id="btabs-alt-static-q1f_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="0"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-home-tab">
                                                                                                                    <p>NO
                                                                                                                        CHANGE:
                                                                                                                        1/9
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1g_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="1"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>1/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1h_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="2"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>6/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1j_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="3"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>7/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1k_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="4"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>8/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @elseif($single_user_selected_answers['get_question_details'][0]->practice_type == 'choiceOneInFour_Odd')
                                                                                                        <div
                                                                                                            class="block block-rounded">
                                                                                                            <ul class="nav nav-tabs nav-tabs-alt-{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                                                role="tablist">
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link active bg-danger
                                                                                                            text-gray
                                                                                                            text-white"
                                                                                                                        id="btabs-alt-static-home-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-home"
                                                                                                                        data-option-value='a'
                                                                                                                        aria-selected="true">Answer
                                                                                                                        A</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='b'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        B</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='c'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        C</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='d'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        D</button>
                                                                                                                </li>
                                                                                                            </ul>

                                                                                                            <div
                                                                                                                class="block-content tab-content">
                                                                                                                <div class="tab-pane active"
                                                                                                                    id="btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="0"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-home-tab">
                                                                                                                    <p>NO
                                                                                                                        CHANGE:
                                                                                                                        1/9
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="1"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>1/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="2"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>6/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="3"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>7/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @elseif($single_user_selected_answers['get_question_details'][0]->practice_type == 'choiceOneInFour_Even')
                                                                                                        <div
                                                                                                            class="block block-rounded">
                                                                                                            <ul class="nav nav-tabs nav-tabs-alt-{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                                                role="tablist">
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link active bg-danger
                                                                                                            text-gray
                                                                                                            text-white"
                                                                                                                        id="btabs-alt-static-home-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1f_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-home"
                                                                                                                        data-option-value='f'
                                                                                                                        aria-selected="true">Answer
                                                                                                                        F</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1g_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='g'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        G</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1h_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='h'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        H</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1j_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='j'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        J</button>
                                                                                                                </li>
                                                                                                            </ul>

                                                                                                            <div
                                                                                                                class="block-content tab-content">
                                                                                                                <div class="tab-pane active"
                                                                                                                    id="btabs-alt-static-q1f_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="0"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-home-tab">
                                                                                                                    <p>NO
                                                                                                                        CHANGE:
                                                                                                                        1/9
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1g_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="1"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>1/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1h_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="2"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>6/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1j_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="3"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>7/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @elseif($single_user_selected_answers['get_question_details'][0]->practice_type == 'choiceOneInFourPass_Odd')
                                                                                                        <div
                                                                                                            class="block block-rounded">
                                                                                                            <ul class="nav nav-tabs nav-tabs-alt-{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                                                role="tablist">
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link active bg-danger
                                                                                                            text-gray
                                                                                                            text-white"
                                                                                                                        id="btabs-alt-static-home-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-home"
                                                                                                                        data-option-value='a'
                                                                                                                        aria-selected="true">Answer
                                                                                                                        A</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='b'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        B</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='c'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        C</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='d'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        D</button>
                                                                                                                </li>
                                                                                                            </ul>

                                                                                                            <div
                                                                                                                class="block-content tab-content">
                                                                                                                <div class="tab-pane active"
                                                                                                                    id="btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="0"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-home-tab">
                                                                                                                    <p>NO
                                                                                                                        CHANGE:
                                                                                                                        1/9
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="1"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>1/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="2"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>6/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="3"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>7/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @elseif($single_user_selected_answers['get_question_details'][0]->practice_type == 'choiceOneInFourPass_Even')
                                                                                                        <div
                                                                                                            class="block block-rounded">
                                                                                                            <ul class="nav nav-tabs nav-tabs-alt-{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                                                role="tablist">
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link active bg-danger
                                                                                                            text-gray
                                                                                                            text-white"
                                                                                                                        id="btabs-alt-static-home-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1f_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-home"
                                                                                                                        data-option-value='f'
                                                                                                                        aria-selected="true">Answer
                                                                                                                        F</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1g_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='g'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        G</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1h_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='h'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        H</button>
                                                                                                                </li>
                                                                                                                <li
                                                                                                                    class="nav-item">
                                                                                                                    <button
                                                                                                                        class="nav-link bg-city-dark text-gray"
                                                                                                                        id="btabs-alt-static-profile-tab"
                                                                                                                        data-bs-toggle="tab"
                                                                                                                        data-bs-target="#btabs-alt-static-q1j_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        role="tab"
                                                                                                                        aria-controls="btabs-alt-static-profile"
                                                                                                                        data-option-value='j'
                                                                                                                        aria-selected="false">Answer
                                                                                                                        J</button>
                                                                                                                </li>
                                                                                                            </ul>

                                                                                                            <div
                                                                                                                class="block-content tab-content">
                                                                                                                <div class="tab-pane active"
                                                                                                                    id="btabs-alt-static-q1f_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="0"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-home-tab">
                                                                                                                    <p>NO
                                                                                                                        CHANGE:
                                                                                                                        1/9
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1g_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="1"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>1/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1h_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="2"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>6/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                                <div class="tab-pane"
                                                                                                                    id="btabs-alt-static-q1j_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                    data-option="3"
                                                                                                                    role="tabpanel"
                                                                                                                    aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                    <p>7/15
                                                                                                                    </p>
                                                                                                                    <p><b>Explanation:
                                                                                                                        </b>Reasons...
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @elseif($single_user_selected_answers['get_question_details'][0]->practice_type == 'choiceMultInFourFill')
                                                                                                        {{-- {{dd($single_user_selected_answers['get_question_details'][0]->is_multiple_choice)}} --}}
                                                                                                        @if ($single_user_selected_answers['get_question_details'][0]->is_multiple_choice == 1)
                                                                                                            <div
                                                                                                                class="block block-rounded">
                                                                                                                <ul class="nav nav-tabs nav-tabs-alt-{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                                                    role="tablist">
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            class="nav-link active bg-danger
                                                                                                                text-gray
                                                                                                                text-white"
                                                                                                                            id="btabs-alt-static-home-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-home"
                                                                                                                            data-option-value='a'
                                                                                                                            aria-selected="true">Answer
                                                                                                                            A</button>
                                                                                                                    </li>
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            class="nav-link bg-city-dark text-gray"
                                                                                                                            id="btabs-alt-static-profile-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-profile"
                                                                                                                            data-option-value='b'
                                                                                                                            aria-selected="false">Answer
                                                                                                                            B</button>
                                                                                                                    </li>
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            class="nav-link bg-city-dark text-gray"
                                                                                                                            id="btabs-alt-static-profile-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-profile"
                                                                                                                            data-option-value='c'
                                                                                                                            aria-selected="false">Answer
                                                                                                                            C</button>
                                                                                                                    </li>
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            class="nav-link bg-city-dark text-gray"
                                                                                                                            id="btabs-alt-static-profile-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-profile"
                                                                                                                            data-option-value='d'
                                                                                                                            aria-selected="false">Answer
                                                                                                                            D</button>
                                                                                                                    </li>
                                                                                                                </ul>

                                                                                                                <div
                                                                                                                    class="block-content tab-content">
                                                                                                                    <div class="tab-pane active"
                                                                                                                        id="btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        data-option="0"
                                                                                                                        role="tabpanel"
                                                                                                                        aria-labelledby="btabs-alt-static-home-tab">
                                                                                                                        <p>NO
                                                                                                                            CHANGE:
                                                                                                                            1/9
                                                                                                                        </p>
                                                                                                                        <p><b>Explanation:
                                                                                                                            </b>Reasons...
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    <div class="tab-pane"
                                                                                                                        id="btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        data-option="1"
                                                                                                                        role="tabpanel"
                                                                                                                        aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                        <p>1/15
                                                                                                                        </p>
                                                                                                                        <p><b>Explanation:
                                                                                                                            </b>Reasons...
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    <div class="tab-pane"
                                                                                                                        id="btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        data-option="2"
                                                                                                                        role="tabpanel"
                                                                                                                        aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                        <p>6/15
                                                                                                                        </p>
                                                                                                                        <p><b>Explanation:
                                                                                                                            </b>Reasons...
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    <div class="tab-pane"
                                                                                                                        id="btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        data-option="3"
                                                                                                                        role="tabpanel"
                                                                                                                        aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                        <p>7/15
                                                                                                                        </p>
                                                                                                                        <p><b>Explanation:
                                                                                                                            </b>Reasons...
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @elseif($single_user_selected_answers['get_question_details'][0]->is_multiple_choice == 3)
                                                                                                            <div
                                                                                                                class="block block-rounded">
                                                                                                                <ul class="nav nav-tabs nav-tabs-alt-{{ $single_user_selected_answers['get_question_details'][0]->question_id }}"
                                                                                                                    role="tablist">
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            class="nav-link active bg-danger
                                                                                                                text-gray
                                                                                                                text-white"
                                                                                                                            id="btabs-alt-static-home-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-home"
                                                                                                                            data-option-value='a'
                                                                                                                            aria-selected="true">Answer
                                                                                                                            A</button>
                                                                                                                    </li>
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            class="nav-link bg-city-dark text-gray"
                                                                                                                            id="btabs-alt-static-profile-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-profile"
                                                                                                                            data-option-value='b'
                                                                                                                            aria-selected="false">Answer
                                                                                                                            B</button>
                                                                                                                    </li>
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            class="nav-link bg-city-dark text-gray"
                                                                                                                            id="btabs-alt-static-profile-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-profile"
                                                                                                                            data-option-value='c'
                                                                                                                            aria-selected="false">Answer
                                                                                                                            C</button>
                                                                                                                    </li>
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            class="nav-link bg-city-dark text-gray"
                                                                                                                            id="btabs-alt-static-profile-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-profile"
                                                                                                                            data-option-value='d'
                                                                                                                            aria-selected="false">Answer
                                                                                                                            D</button>
                                                                                                                    </li>
                                                                                                                </ul>

                                                                                                                <div
                                                                                                                    class="block-content tab-content">
                                                                                                                    <div class="tab-pane active"
                                                                                                                        id="btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        data-option="0"
                                                                                                                        role="tabpanel"
                                                                                                                        aria-labelledby="btabs-alt-static-home-tab">
                                                                                                                        <p>NO
                                                                                                                            CHANGE:
                                                                                                                            1/9
                                                                                                                        </p>
                                                                                                                        <p><b>Explanation:
                                                                                                                            </b>Reasons...
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    <div class="tab-pane"
                                                                                                                        id="btabs-alt-static-q1b_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        data-option="1"
                                                                                                                        role="tabpanel"
                                                                                                                        aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                        <p>1/15
                                                                                                                        </p>
                                                                                                                        <p><b>Explanation:
                                                                                                                            </b>Reasons...
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    <div class="tab-pane"
                                                                                                                        id="btabs-alt-static-q1c_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        data-option="2"
                                                                                                                        role="tabpanel"
                                                                                                                        aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                        <p>6/15
                                                                                                                        </p>
                                                                                                                        <p><b>Explanation:
                                                                                                                            </b>Reasons...
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    <div class="tab-pane"
                                                                                                                        id="btabs-alt-static-q1d_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                        data-option="3"
                                                                                                                        role="tabpanel"
                                                                                                                        aria-labelledby="btabs-alt-static-profile-tab">
                                                                                                                        <p>7/15
                                                                                                                        </p>
                                                                                                                        <p><b>Explanation:
                                                                                                                            </b>Reasons...
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <?php $helper = new Helper(); ?>
                                                                                                        @elseif($single_user_selected_answers['get_question_details'][0]->is_multiple_choice == 2)
                                                                                                            <div
                                                                                                                class="block block-rounded">
                                                                                                                <ul class="nav nav-tabs nav-tabs-alt"
                                                                                                                    role="tablist">
                                                                                                                    {{-- @if (in_array(str_replace(' ', '', $single_user_selected_answers['user_selected_answer']), explode(',', $correct[0])) || in_array(str_replace(' ', '', $single_user_selected_answers['user_selected_answer']), $correct) || Str::contains($correct[0], explode(',', str_replace(' ', '', $single_user_selected_answers['user_selected_answer'])))) --}}
                                                                                                                    {{-- @if (Str::contains($single_user_selected_answers['get_question_details'][0]->question_answer, explode(',', $single_user_selected_answers['user_selected_answer']))) --}}
                                                                                                                    @if ($helper->stringExactMatch($correct[0], $single_user_selected_answers['user_selected_answer']))
                                                                                                                        <li
                                                                                                                            class="nav-item">
                                                                                                                            <button
                                                                                                                                style="background: #65a30d !important;"
                                                                                                                                class="nav-link active bg-danger
                                                                                                                    text-gray
                                                                                                                    text-white"
                                                                                                                                id="btabs-alt-static-home-tab"
                                                                                                                                data-bs-toggle="tab"
                                                                                                                                data-bs-target="#btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                                role="tab"
                                                                                                                                aria-controls="btabs-alt-static-home"
                                                                                                                                data-option-value='a'
                                                                                                                                aria-selected="true">{{ $single_user_selected_answers['user_selected_answer'] }}</button>
                                                                                                                        </li>
                                                                                                                    @else
                                                                                                                        <li
                                                                                                                            class="nav-item">
                                                                                                                            <button
                                                                                                                                style="background: #dc2626 !important;"
                                                                                                                                class="nav-link active bg-danger
                                                                                                                    text-gray
                                                                                                                    text-white"
                                                                                                                                id="btabs-alt-static-home-tab"
                                                                                                                                data-bs-toggle="tab"
                                                                                                                                data-bs-target="#btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                                role="tab"
                                                                                                                                aria-controls="btabs-alt-static-home"
                                                                                                                                data-option-value='a'
                                                                                                                                aria-selected="true">{{ $single_user_selected_answers['user_selected_answer'] }}</button>
                                                                                                                        </li>
                                                                                                                    @endif
                                                                                                                    <li
                                                                                                                        class="nav-item">
                                                                                                                        <button
                                                                                                                            style="background: #65a30d !important;"
                                                                                                                            class="nav-link active bg-danger
                                                                                                                text-gray
                                                                                                                text-white"
                                                                                                                            id="btabs-alt-static-home-tab"
                                                                                                                            data-bs-toggle="tab"
                                                                                                                            data-bs-target="#btabs-alt-static-q1a_<?php echo $single_user_selected_answers['get_question_details'][0]->question_id; ?>"
                                                                                                                            role="tab"
                                                                                                                            aria-controls="btabs-alt-static-home"
                                                                                                                            data-option-value='a'
                                                                                                                            aria-selected="true">{{ $single_user_selected_answers['get_question_details'][0]->question_answer }}</button>
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="block-content block-content-full text-end bg-body">
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm block-header-default  text-white review_model_close"
                                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <br />

                                                                            <div class="col-md-6 mb-2">
                                                                                <select class="form-select"
                                                                                    id="example-select"
                                                                                    name="example-select">
                                                                                    <option selected>Mistake Type (Select
                                                                                        One)</option>
                                                                                    <option value="1">Content
                                                                                        Misunderstanding</option>
                                                                                    <option value="2">Random Error
                                                                                    </option>
                                                                                    <option value="3">Timing Issue
                                                                                    </option>
                                                                                </select>
                                                                            </div>

                                                                            <table
                                                                                class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="width: 30%;"
                                                                                            class="sorting" tabindex="0"
                                                                                            aria-controls="DataTables_Table_4"
                                                                                            rowspan="1" colspan="1"
                                                                                            aria-label="Name: activate to sort column ascending">
                                                                                            Category</th>
                                                                                        <th style="width: 55%;"
                                                                                            class="sorting" tabindex="0"
                                                                                            aria-controls="DataTables_Table_4"
                                                                                            rowspan="1" colspan="1"
                                                                                            aria-label="Name: activate to sort column ascending">
                                                                                            Question Type</th>
                                                                                        <th style="width: 15%;"
                                                                                            class="sorting" tabindex="0"
                                                                                            aria-controls="DataTables_Table_4"
                                                                                            rowspan="1" colspan="1"
                                                                                            aria-label="Name: activate to sort column ascending">
                                                                                            Add to
                                                                                            Custom Quiz</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @php
                                                                                        $category_type_arr = $categoryTypeData[$single_user_selected_answers['get_question_details'][0]->question_id] ?? [];
                                                                                        $question_type_arr = $questionTypeData[$single_user_selected_answers['get_question_details'][0]->question_id] ?? [];
                                                                                        $checkbox_arr = $checkboxData[$single_user_selected_answers['get_question_details'][0]->question_id] ?? [];
                                                                                        // dd($checkbox_arr);
                                                                                    @endphp
                                                                                    @foreach ($category_type_arr as $key => $category_type)
                                                                                        @for ($i = 0; $i < count($category_type); $i++)
                                                                                            <tr class="odd">
                                                                                                <td>
                                                                                                    <?php
                                                                                                    $modal_count = 1;
                                                                                                    $category_arr = Helper::getCategoryNameByID($category_type[$i]);
                                                                                                    $modal_count = $modal_count++;
                                                                                                    ?>
                                                                                                    <button type="button"
                                                                                                        data-bs-toggle="modal"
                                                                                                        data-bs-target="#modal-block-category-ct2_{{ $modal_count }}_{{ $acc_id }}"
                                                                                                        class="btn @if ($checkbox_arr[$key][0] == '1') btn-success
                                                                                                        @elseif ($checkbox_arr[$key][0] == '0')
                                                                                                        btn-danger
                                                                                                    @else
                                                                                                    btn-dark @endif fs-xs fw-semibold me-1 category_description"
                                                                                                        data-category_title="{{ isset($category_arr->category_type_title) ? $category_arr->category_type_title : '' }}"
                                                                                                        data-category_description="{{ isset($category_arr->category_type_description) ? $category_arr->category_type_description : '' }}"
                                                                                                        data-category_lesson="{{ isset($category_arr->category_type_lesson) ? $category_arr->category_type_lesson : '' }}"
                                                                                                        data-category_strategies="{{ isset($category_arr->category_type_strategies) ? $category_arr->category_type_strategies : '' }}"
                                                                                                        data-category_identification_methods="{{ isset($category_arr->category_type_identification_methods) ? $category_arr->category_type_identification_methods : '' }}"
                                                                                                        data-category_identification_activity="{{ isset($category_arr->category_type_identification_activity) ? $category_arr->category_type_identification_activity : '' }}">
                                                                                                        {{ isset($category_arr->category_type_title) ? $category_arr->category_type_title : '' }}</button>

                                                                                                    {{-- start model  --}}
                                                                                                    <div class="modal"
                                                                                                        id="modal-block-category-ct2_{{ $modal_count }}_{{ $acc_id }}"
                                                                                                        tabindex="-1"
                                                                                                        aria-labelledby="modal-block-category-ct2_{{ $modal_count }}_{{ $acc_id }}"
                                                                                                        style="display: none;"
                                                                                                        aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-lg"
                                                                                                            role="document">
                                                                                                            <div
                                                                                                                class="modal-content">
                                                                                                                <div
                                                                                                                    class="block block-rounded">
                                                                                                                    <div
                                                                                                                        class="block-header block-header-default">
                                                                                                                        <h3
                                                                                                                            class="block-title set_category_title">
                                                                                                                        </h3>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="block-content">
                                                                                                                        <p
                                                                                                                            class="fs-sm mb-0">
                                                                                                                        </p>

                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Description
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>

                                                                                                                                <div
                                                                                                                                    class="block-content set_category_description">
                                                                                                                                    <p>other
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        {{-- start new  --}}
                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Lesson
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_category_type_lesson">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Strategies
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_category_type_strategies">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Identification
                                                                                                                                        Methods
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_category_type_identification_methods">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Identification
                                                                                                                                        Activity
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_category_type_identification_activity">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                    <div
                                                                                                                        class="block-content block-content-full text-end bg-body">
                                                                                                                        <button
                                                                                                                            type="button"
                                                                                                                            class="btn btn-sm block-header-default text-white"
                                                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    $question_arr = Helper::getQuestionNameByID($question_type_arr[$key][$i]);
                                                                                                    ?>
                                                                                                    <button type="button"
                                                                                                        data-bs-toggle="modal"
                                                                                                        data-question_desc="{{ isset($question_arr->question_type_description) ? $question_arr->question_type_description : '' }}"
                                                                                                        data-question_title="{{ isset($question_arr->question_type_title) ? $question_arr->question_type_title : '' }}"
                                                                                                        data-question_lesson="{{ isset($question_arr->question_type_lesson) ? $question_arr->question_type_lesson : '' }}"
                                                                                                        data-question_strategies="{{ isset($question_arr->question_type_strategies) ? $question_arr->question_type_strategies : '' }}"
                                                                                                        data-question_identification_methods="{{ isset($question_arr->question_type_identification_methods) ? $question_arr->question_type_identification_methods : '' }}"
                                                                                                        data-question_identification_activity="{{ isset($question_arr->question_type_identification_activity) ? $question_arr->question_type_identification_activity : '' }}"
                                                                                                        data-bs-target="#modal-block-question-cg1ct2_{{ $modal_count }}_{{ $acc_id }}"
                                                                                                        class="btn @if ($checkbox_arr[$key][0] == '1') btn-success
                                                                                                            @elseif ($checkbox_arr[$key][0] == '0')
                                                                                                            btn-danger
                                                                                                        @else
                                                                                                        btn-dark @endif  fs-xs fw-semibold me-1 cat_type_desc_btn">{{ isset($question_arr->question_type_title) ? $question_arr->question_type_title : '' }}</button>
                                                                                                    {{-- start question type modal  --}}
                                                                                                    <div class="modal"
                                                                                                        id="modal-block-question-cg1ct2_{{ $modal_count }}_{{ $acc_id }}"
                                                                                                        tabindex="-1"
                                                                                                        aria-labelledby="modal-block-question-cg1ct2_{{ $modal_count }}_{{ $acc_id }}"
                                                                                                        style="display: none;"
                                                                                                        aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-lg"
                                                                                                            role="document">
                                                                                                            <div
                                                                                                                class="modal-content">
                                                                                                                <div
                                                                                                                    class="block block-rounded">
                                                                                                                    <div
                                                                                                                        class="block-header block-header-default">
                                                                                                                        <h3
                                                                                                                            class="block-title set_question_type_title">
                                                                                                                            Arithmetic
                                                                                                                            Operations
                                                                                                                        </h3>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="block-content">
                                                                                                                        <p
                                                                                                                            class="fs-sm mb-0">
                                                                                                                        </p>

                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Description
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_question_type_desc">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        {{-- start  --}}
                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Lesson
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_question_type_lesson">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Strategies
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_question_type_strategies">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Identification
                                                                                                                                        Methods
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_question_type_identification_methods">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                            class="row items-push">
                                                                                                                            <div id="my-block"
                                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                                <div
                                                                                                                                    class="block-header block-header-default">
                                                                                                                                    <h3
                                                                                                                                        class="block-title">
                                                                                                                                        Identification
                                                                                                                                        Activity
                                                                                                                                    </h3>
                                                                                                                                    <div
                                                                                                                                        class="block-options">
                                                                                                                                        <button
                                                                                                                                            type="button"
                                                                                                                                            class="btn-block-option"
                                                                                                                                            data-toggle="block-option"
                                                                                                                                            data-action="content_toggle"><i
                                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                    class="block-content">
                                                                                                                                    <p
                                                                                                                                        class="set_question_type_identification_activity">
                                                                                                                                        words
                                                                                                                                    </p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        {{-- end  --}}
                                                                                                                    </div>

                                                                                                                    <div
                                                                                                                        class="block-content block-content-full text-end bg-body">
                                                                                                                        <button
                                                                                                                            type="button"
                                                                                                                            class="btn btn-sm block-header-default text-white"
                                                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="block-content block-content-full text-center">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="checkbox"
                                                                                                            value=""
                                                                                                            name="add_to_custom_quiz">
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endfor
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $acc_id = $acc_id + 1;
                                                        @endphp
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Category & Question Type Summary tab --}}
                        <div class="tab-pane fade" id="btabs-animated-fade-profile" role="tabpanel"
                            aria-labelledby="btabs-animated-fade-profile-tab" tabindex="0">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">(BEST SO FAR..) QUESTION TYPE CATEGORIZATION</h3>
                                </div>
                                <div class="block-content">
                                    <div class="block-content p-0">
                                        @if (isset($store_all_data) && !empty($store_all_data))
                                            <div class="tab-content" id="myTabContent">
                                                <div class="setup-content" role="tabpanel" id="step1"
                                                    aria-labelledby="step1-tab">
                                                    <div class="accordion accordionExample">

                                                        {{-- accordian tab 1 --}}
                                                        <?php
                                                        $count = 1;
                                                        $new_count = 1;
                                                        ?>
                                                        @foreach ($store_all_data as $get_question_type => $single_question_data)
                                                            <?php
                                                            $test = $count++;
                                                            $store_total_wrong_answer = 0;
                                                            foreach ($single_question_data as $question_type_val => $single_question_details_item) {
                                                                $store_correct_answer = 0;
                                                                $store_wrong_answer = 0;
                                                            
                                                                foreach ($single_question_details_item as $get_single_ques_data) {
                                                                    foreach ($user_selected_answers as $single_answer_user_selected) {
                                                                        if (isset($single_answer_user_selected['get_question_details'][0]->question_id) && !empty($single_answer_user_selected['get_question_details'][0]->question_id)) {
                                                                            if ($get_single_ques_data[0] == $single_answer_user_selected['get_question_details'][0]->question_id) {
                                                                                if ($single_answer_user_selected['user_selected_answer'] == $single_answer_user_selected['get_question_details'][0]->question_answer) {
                                                                                    $store_correct_answer++;
                                                                                } else {
                                                                                    $store_wrong_answer++;
                                                                                    $store_total_wrong_answer += $store_wrong_answer;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            ?>
                                                            <div
                                                                class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                <div class="block-header block-header-tab justify-content-start"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#collapseOne_<?php echo $test; ?>"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapseOne_<?php echo $test; ?>">
                                                                    <table class="w-75">
                                                                        <tr>
                                                                            <td class="text-center" style="width: 5%">
                                                                                <i
                                                                                    class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                                            </td>
                                                                            @foreach ($single_question_data as $question_type_val => $single_question_details_item)
                                                                                <td class="pl-4 text-start ">
                                                                                    <button type="button"
                                                                                        class="btn btn-danger fs-xs fw-semibold me-1 js-bs-tooltip-enabled"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-trigger="click"
                                                                                        data-bs-placement="top"
                                                                                        title=""
                                                                                        data-bs-original-title="Category Type">CT</button>
                                                                                    <button type="button"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#modal-block-large-ct1"
                                                                                        data-category_title="<?php echo $single_question_details_item[0]['category_title']; ?>"
                                                                                        data-category_description="<?php echo $single_question_details_item[0]['category_description']; ?>"
                                                                                        data-category_lesson="<?php echo $single_question_details_item[0]['category_type_lesson']; ?>"
                                                                                        data-category_strategies="<?php echo $single_question_details_item[0]['category_type_strategies']; ?>"
                                                                                        data-category_identification_methods="<?php echo $single_question_details_item[0]['category_type_identification_methods']; ?>"
                                                                                        data-category_identification_activity="<?php echo $single_question_details_item[0]['category_type_identification_activity']; ?>"
                                                                                        class="btn btn-dark fs-xs fw-semibold me-1 category_description">{{ $get_question_type }}</button>

                                                                                    <!-- MODAL -->
                                                                                    <div class="modal"
                                                                                        id="modal-block-large-ct1"
                                                                                        tabindex="-1"
                                                                                        aria-labelledby="modal-block-large-ct1"
                                                                                        style="display: none;"
                                                                                        aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg"
                                                                                            role="document">
                                                                                            <div class="modal-content">
                                                                                                <div
                                                                                                    class="block block-rounded">
                                                                                                    <div
                                                                                                        class="block-header block-header-default">
                                                                                                        <h3
                                                                                                            class="block-title set_category_title">
                                                                                                        </h3>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="block-content">
                                                                                                        <p
                                                                                                            class="fs-sm mb-0">
                                                                                                        </p>

                                                                                                        <div
                                                                                                            class="row items-push">
                                                                                                            <div id="my-block"
                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                <div
                                                                                                                    class="block-header block-header-default">
                                                                                                                    <h3
                                                                                                                        class="block-title">
                                                                                                                        Description
                                                                                                                    </h3>
                                                                                                                    <div
                                                                                                                        class="block-options">
                                                                                                                        <button
                                                                                                                            type="button"
                                                                                                                            class="btn-block-option"
                                                                                                                            data-toggle="block-option"
                                                                                                                            data-action="content_toggle"><i
                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="block-content set_category_description">
                                                                                                                    <p>other
                                                                                                                        words
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        {{-- start new  --}}
                                                                                                        <div
                                                                                                            class="row items-push">
                                                                                                            <div id="my-block"
                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                <div
                                                                                                                    class="block-header block-header-default">
                                                                                                                    <h3
                                                                                                                        class="block-title">
                                                                                                                        Lesson
                                                                                                                    </h3>
                                                                                                                    <div
                                                                                                                        class="block-options">
                                                                                                                        <button
                                                                                                                            type="button"
                                                                                                                            class="btn-block-option"
                                                                                                                            data-toggle="block-option"
                                                                                                                            data-action="content_toggle"><i
                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="block-content">
                                                                                                                    <p
                                                                                                                        class="set_category_type_lesson">
                                                                                                                        words
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="row items-push">
                                                                                                            <div id="my-block"
                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                <div
                                                                                                                    class="block-header block-header-default">
                                                                                                                    <h3
                                                                                                                        class="block-title">
                                                                                                                        Strategies
                                                                                                                    </h3>
                                                                                                                    <div
                                                                                                                        class="block-options">
                                                                                                                        <button
                                                                                                                            type="button"
                                                                                                                            class="btn-block-option"
                                                                                                                            data-toggle="block-option"
                                                                                                                            data-action="content_toggle"><i
                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="block-content">
                                                                                                                    <p
                                                                                                                        class="set_category_type_strategies">
                                                                                                                        words
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="row items-push">
                                                                                                            <div id="my-block"
                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                <div
                                                                                                                    class="block-header block-header-default">
                                                                                                                    <h3
                                                                                                                        class="block-title">
                                                                                                                        Identification
                                                                                                                        Methods
                                                                                                                    </h3>
                                                                                                                    <div
                                                                                                                        class="block-options">
                                                                                                                        <button
                                                                                                                            type="button"
                                                                                                                            class="btn-block-option"
                                                                                                                            data-toggle="block-option"
                                                                                                                            data-action="content_toggle"><i
                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="block-content">
                                                                                                                    <p
                                                                                                                        class="set_category_type_identification_methods">
                                                                                                                        words
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="row items-push">
                                                                                                            <div id="my-block"
                                                                                                                class="block block-rounded block-bordered p-0">
                                                                                                                <div
                                                                                                                    class="block-header block-header-default">
                                                                                                                    <h3
                                                                                                                        class="block-title">
                                                                                                                        Identification
                                                                                                                        Activity
                                                                                                                    </h3>
                                                                                                                    <div
                                                                                                                        class="block-options">
                                                                                                                        <button
                                                                                                                            type="button"
                                                                                                                            class="btn-block-option"
                                                                                                                            data-toggle="block-option"
                                                                                                                            data-action="content_toggle"><i
                                                                                                                                class="si si-arrow-up"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="block-content">
                                                                                                                    <p
                                                                                                                        class="set_category_type_identification_activity">
                                                                                                                        words
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        {{-- end  --}}
                                                                                                    </div>

                                                                                                    <div
                                                                                                        class="block-content block-content-full text-end bg-body">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-sm block-header-default text-white"
                                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                            @endforeach
                                                                            <!-- END MODAL -->
                                                                            @if (isset($percentage_arr_all) && !empty($percentage_arr_all))
                                                                                @foreach ($percentage_arr_all as $cat_type => $percentage_arr)
                                                                                    @if ($cat_type == $get_question_type)
                                                                                        @if (isset($percentage_arr['percentage']) && !empty($percentage_arr['percentage']))
                                                                                            <div class="progress mt-2"
                                                                                                style="background:#c4c5c7;height: 10px"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-placement="top"
                                                                                                title="{{ $percentage_arr['percentage'] }}">
                                                                                                <div class="progress-bar bg-info"
                                                                                                    style="width: {{ $percentage_arr['percentage'] }}"
                                                                                                    role="progressbar"
                                                                                                    aria-valuenow="25"
                                                                                                    aria-valuemin="0"
                                                                                                    aria-valuemax="100">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                        @if (isset($percentage_arr['percentage_label']) && !empty($percentage_arr['percentage_label']))
                                                                                            <div
                                                                                                class="text-danger text-center fw-bolder mt-1 incorrect">
                                                                                                {{ $percentage_arr['percentage_label'] }}
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <div
                                                                        class="d-flex flex-wrap justify-content-end w-50 ms-auto">
                                                                        @foreach ($question_tags as $ct_name => $tags)
                                                                            @if ($ct_name == $get_question_type)
                                                                                @foreach ($tags as $tag)
                                                                                    <button type="button"
                                                                                        class="btn btn-success category-badge fs-xs fw-semibold ms-2 mb-1 js-bs-tooltip-enabled"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="top"
                                                                                        title="{{ $tag }}">{{ $tag }}</button>
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div id="collapseOne_<?php echo $test; ?>"
                                                                    class="collapse" aria-labelledby="headingOne"
                                                                    data-parent=".accordionExample">
                                                                    <div class="odd">
                                                                        <div class="fw-semibold fs-sm">
                                                                            <div>
                                                                                <div>
                                                                                    @foreach ($single_question_data as $question_type_val => $single_question_details_item)
                                                                                        <?php
                                                                                        
                                                                                        ?>
                                                                                        <?php $new_test = $new_count++; ?>
                                                                                        <div class="odd p-3 ps-4">
                                                                                            <div></div>

                                                                                            <div
                                                                                                class="fw-semibold fs-sm">
                                                                                                <button type="button"
                                                                                                    class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled"
                                                                                                    data-bs-toggle="tooltip"
                                                                                                    data-bs-trigger="click"
                                                                                                    data-bs-placement="top"
                                                                                                    title=""
                                                                                                    data-bs-original-title="Question Type">QT</button>
                                                                                                <button type="button"
                                                                                                    data-bs-toggle="modal"
                                                                                                    data-question_desc="<?php echo $single_question_details_item[0]['question_desc']; ?>"
                                                                                                    data-question_title="<?php echo $single_question_details_item[0]['question_type_title']; ?>"
                                                                                                    data-question_lesson="<?php echo $single_question_details_item[0]['question_type_lesson']; ?>"
                                                                                                    data-question_strategies="<?php echo $single_question_details_item[0]['question_type_strategies']; ?>"
                                                                                                    data-question_identification_methods="<?php echo $single_question_details_item[0]['question_type_identification_methods']; ?>"
                                                                                                    data-question_identification_activity="<?php echo $single_question_details_item[0]['question_type_identification_activity']; ?>"
                                                                                                    data-bs-target="#modal-block-large-cg1ct1_<?php echo $new_test; ?>"
                                                                                                    class="btn btn-dark fs-xs fw-semibold me-1 mb-3 cat_type_desc_btn">{{ $question_type_val }}</button>

                                                                                                <!-- MODAL -->
                                                                                                <div class="modal"
                                                                                                    id="modal-block-large-cg1ct1_<?php echo $new_test; ?>"
                                                                                                    tabindex="-1"
                                                                                                    aria-labelledby="modal-block-large-cg1ct1_<?php echo $new_test; ?>"
                                                                                                    style="display: none;"
                                                                                                    aria-hidden="true">
                                                                                                    <div class="modal-dialog modal-lg"
                                                                                                        role="document">
                                                                                                        <div
                                                                                                            class="modal-content">
                                                                                                            <div
                                                                                                                class="block block-rounded">
                                                                                                                <div
                                                                                                                    class="block-header block-header-default">
                                                                                                                    <h3
                                                                                                                        class="block-title set_question_type_title">
                                                                                                                        Arithmetic
                                                                                                                        Operations
                                                                                                                    </h3>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="block-content">
                                                                                                                    <p
                                                                                                                        class="fs-sm mb-0">
                                                                                                                    </p>

                                                                                                                    <div
                                                                                                                        class="row items-push">
                                                                                                                        <div id="my-block"
                                                                                                                            class="block block-rounded block-bordered p-0">
                                                                                                                            <div
                                                                                                                                class="block-header block-header-default">
                                                                                                                                <h3
                                                                                                                                    class="block-title">
                                                                                                                                    Description
                                                                                                                                </h3>
                                                                                                                                <div
                                                                                                                                    class="block-options">
                                                                                                                                    <button
                                                                                                                                        type="button"
                                                                                                                                        class="btn-block-option"
                                                                                                                                        data-toggle="block-option"
                                                                                                                                        data-action="content_toggle"><i
                                                                                                                                            class="si si-arrow-up"></i></button>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div
                                                                                                                                class="block-content">
                                                                                                                                <p
                                                                                                                                    class="set_question_type_desc">
                                                                                                                                    words
                                                                                                                                </p>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    {{-- start  --}}
                                                                                                                    <div
                                                                                                                        class="row items-push">
                                                                                                                        <div id="my-block"
                                                                                                                            class="block block-rounded block-bordered p-0">
                                                                                                                            <div
                                                                                                                                class="block-header block-header-default">
                                                                                                                                <h3
                                                                                                                                    class="block-title">
                                                                                                                                    Lesson
                                                                                                                                </h3>
                                                                                                                                <div
                                                                                                                                    class="block-options">
                                                                                                                                    <button
                                                                                                                                        type="button"
                                                                                                                                        class="btn-block-option"
                                                                                                                                        data-toggle="block-option"
                                                                                                                                        data-action="content_toggle"><i
                                                                                                                                            class="si si-arrow-up"></i></button>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div
                                                                                                                                class="block-content">
                                                                                                                                <p
                                                                                                                                    class="set_question_type_lesson">
                                                                                                                                    words
                                                                                                                                </p>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="row items-push">
                                                                                                                        <div id="my-block"
                                                                                                                            class="block block-rounded block-bordered p-0">
                                                                                                                            <div
                                                                                                                                class="block-header block-header-default">
                                                                                                                                <h3
                                                                                                                                    class="block-title">
                                                                                                                                    Strategies
                                                                                                                                </h3>
                                                                                                                                <div
                                                                                                                                    class="block-options">
                                                                                                                                    <button
                                                                                                                                        type="button"
                                                                                                                                        class="btn-block-option"
                                                                                                                                        data-toggle="block-option"
                                                                                                                                        data-action="content_toggle"><i
                                                                                                                                            class="si si-arrow-up"></i></button>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div
                                                                                                                                class="block-content">
                                                                                                                                <p
                                                                                                                                    class="set_question_type_strategies">
                                                                                                                                    words
                                                                                                                                </p>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="row items-push">
                                                                                                                        <div id="my-block"
                                                                                                                            class="block block-rounded block-bordered p-0">
                                                                                                                            <div
                                                                                                                                class="block-header block-header-default">
                                                                                                                                <h3
                                                                                                                                    class="block-title">
                                                                                                                                    Identification
                                                                                                                                    Methods
                                                                                                                                </h3>
                                                                                                                                <div
                                                                                                                                    class="block-options">
                                                                                                                                    <button
                                                                                                                                        type="button"
                                                                                                                                        class="btn-block-option"
                                                                                                                                        data-toggle="block-option"
                                                                                                                                        data-action="content_toggle"><i
                                                                                                                                            class="si si-arrow-up"></i></button>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div
                                                                                                                                class="block-content">
                                                                                                                                <p
                                                                                                                                    class="set_question_type_identification_methods">
                                                                                                                                    words
                                                                                                                                </p>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="row items-push">
                                                                                                                        <div id="my-block"
                                                                                                                            class="block block-rounded block-bordered p-0">
                                                                                                                            <div
                                                                                                                                class="block-header block-header-default">
                                                                                                                                <h3
                                                                                                                                    class="block-title">
                                                                                                                                    Identification
                                                                                                                                    Activity
                                                                                                                                </h3>
                                                                                                                                <div
                                                                                                                                    class="block-options">
                                                                                                                                    <button
                                                                                                                                        type="button"
                                                                                                                                        class="btn-block-option"
                                                                                                                                        data-toggle="block-option"
                                                                                                                                        data-action="content_toggle"><i
                                                                                                                                            class="si si-arrow-up"></i></button>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div
                                                                                                                                class="block-content">
                                                                                                                                <p
                                                                                                                                    class="set_question_type_identification_activity">
                                                                                                                                    words
                                                                                                                                </p>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    {{-- end  --}}
                                                                                                                </div>

                                                                                                                <div
                                                                                                                    class="block-content block-content-full text-end bg-body">
                                                                                                                    <button
                                                                                                                        type="button"
                                                                                                                        class="btn btn-sm block-header-default text-white"
                                                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- END MODAL -->
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        {{-- END accordian tab 1 --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Answer Type Summary tab --}}
                        <div class="tab-pane fade" id="btabs-animated-fade-answer" role="tabpanel"
                            aria-labelledby="btabs-animated-fade-answer-tab" tabindex="0">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">INCORRECT ANSWER TYPE SUMMARY</h3>
                                </div>
                                <div class="block-content">
                                    <div class="block-content p-0">
                                        <table
                                            class="js-table-sections table table-hover table-vcenter js-table-sections-enabled">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px;"></th>
                                                    <th style="width: 20%;">Type</th>
                                                    <th>Name</th>
                                                    <th style="width: 20%;">FREQUENCY OF INCORRECT ANSWER TYPES</th>
                                                </tr>
                                            </thead>

                                            <tbody class="fs-sm">
                                                <?php $modelcount = 0; ?>
                                                <!-- Answer Type 1 -->
                                                @if (isset($store_question_type_data) && !empty($store_question_type_data))
                                                    @foreach ($store_question_type_data as $get_question_type => $single_question_data)
                                                        <?php
                                                        $test = $count++;
                                                        $store_total_wrong_answer = 0;
                                                        
                                                        foreach ($single_question_data as $single_question_details_item) {
                                                            $store_correct_answer = 0;
                                                            $store_wrong_answer = 0;
                                                        
                                                            foreach ($user_selected_answers as $single_answer_user_selected) {
                                                                if (isset($single_answer_user_selected['get_question_details'][0]->question_id) && !empty($single_answer_user_selected['get_question_details'][0]->question_id)) {
                                                                    if ($single_question_details_item[0] == $single_answer_user_selected['get_question_details'][0]->question_id) {
                                                                        if ($single_answer_user_selected['user_selected_answer'] == $single_answer_user_selected['get_question_details'][0]->question_answer) {
                                                                            $store_correct_answer++;
                                                                        } else {
                                                                            $store_wrong_answer++;
                                                                            $store_total_wrong_answer += $store_wrong_answer;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>

                                                        <tr>
                                                            <td class="text-center"></td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">Answer
                                                                    Type</button>
                                                            </td>
                                                            <td class="fw-semibold fs-sm">
                                                                <button type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#modal-block-large-ag<?php $new = strtolower(str_replace(' ', '', $get_question_type));
                                                                    echo preg_replace('/[^a-zA-Z0-9?]+/', '', strtolower($new));
                                                                    ?>"
                                                                    class="btn block-header-default text-white fs-xs fw-semibold me-1 mb-3">{{ $get_question_type }}</button>

                                                                <div class="modal"
                                                                    id="modal-block-large-ag<?php $new = strtolower(str_replace(' ', '', $get_question_type));
                                                                    echo preg_replace('/[^a-zA-Z0-9?]+/', '', strtolower($new));
                                                                    ?>"
                                                                    tabindex="-1"
                                                                    aria-labelledby="modal-block-large-ag<?php $new = strtolower(str_replace(' ', '', $get_question_type));
                                                                    echo preg_replace('/[^a-zA-Z0-9?]+/', '', strtolower($new));
                                                                    ?>"
                                                                    style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="block block-rounded">
                                                                                <div
                                                                                    class="block-header block-header-default">
                                                                                    <h3 class="block-title">Answer Type:
                                                                                        {{ $get_question_type }}</h3>
                                                                                </div>
                                                                                <div class="block-content">
                                                                                    <div id="faq2" class="mb-5"
                                                                                        role="tablist"
                                                                                        aria-multiselectable="true">
                                                                                        <div
                                                                                            class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                            <div class="block-header block-header-default"
                                                                                                role="tab"
                                                                                                id="faq2_h1">
                                                                                                <a class="text-white"
                                                                                                    data-bs-toggle="collapse"
                                                                                                    data-bs-parent="#faq2"
                                                                                                    href="#faq2_q1"
                                                                                                    aria-expanded="true"
                                                                                                    aria-controls="faq2_q1">Description</a>
                                                                                            </div>
                                                                                            <div id="faq2_q1"
                                                                                                class="collapse show"
                                                                                                role="tabpanel"
                                                                                                aria-labelledby="faq2_h1"
                                                                                                data-bs-parent="#faq2">
                                                                                                <div
                                                                                                    class="block-content">
                                                                                                    <?php echo $single_question_data[0]['question_desc']; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                            <div class="block-header block-header-default"
                                                                                                role="tab"
                                                                                                id="faq2_h1">
                                                                                                <a class="text-white"
                                                                                                    data-bs-toggle="collapse"
                                                                                                    data-bs-parent="#faq2"
                                                                                                    href="#faq2_q1"
                                                                                                    aria-expanded="true"
                                                                                                    aria-controls="faq2_q1">Lesson</a>
                                                                                            </div>
                                                                                            <div id="faq2_q1"
                                                                                                class="collapse show"
                                                                                                role="tabpanel"
                                                                                                aria-labelledby="faq2_h1"
                                                                                                data-bs-parent="#faq2">
                                                                                                <div
                                                                                                    class="block-content">
                                                                                                    <?php echo $single_question_data[0]['question_type_lesson']; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                            <div class="block-header block-header-default"
                                                                                                role="tab"
                                                                                                id="faq2_h1">
                                                                                                <a class="text-white"
                                                                                                    data-bs-toggle="collapse"
                                                                                                    data-bs-parent="#faq2"
                                                                                                    href="#faq2_q1"
                                                                                                    aria-expanded="true"
                                                                                                    aria-controls="faq2_q1">Strategies</a>
                                                                                            </div>
                                                                                            <div id="faq2_q1"
                                                                                                class="collapse show"
                                                                                                role="tabpanel"
                                                                                                aria-labelledby="faq2_h1"
                                                                                                data-bs-parent="#faq2">
                                                                                                <div
                                                                                                    class="block-content">
                                                                                                    <?php echo $single_question_data[0]['question_type_strategies']; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                            <div class="block-header block-header-default"
                                                                                                role="tab"
                                                                                                id="faq2_h1">
                                                                                                <a class="text-white"
                                                                                                    data-bs-toggle="collapse"
                                                                                                    data-bs-parent="#faq2"
                                                                                                    href="#faq2_q1"
                                                                                                    aria-expanded="true"
                                                                                                    aria-controls="faq2_q1">Identification
                                                                                                    Methods</a>
                                                                                            </div>
                                                                                            <div id="faq2_q1"
                                                                                                class="collapse show"
                                                                                                role="tabpanel"
                                                                                                aria-labelledby="faq2_h1"
                                                                                                data-bs-parent="#faq2">
                                                                                                <div
                                                                                                    class="block-content">
                                                                                                    <?php echo $single_question_data[0]['question_type_identification_methods']; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="block block-rounded block-bordered overflow-hidden mb-1">
                                                                                            <div class="block-header block-header-default"
                                                                                                role="tab"
                                                                                                id="faq2_h1">
                                                                                                <a class="text-white"
                                                                                                    data-bs-toggle="collapse"
                                                                                                    data-bs-parent="#faq2"
                                                                                                    href="#faq2_q1"
                                                                                                    aria-expanded="true"
                                                                                                    aria-controls="faq2_q1">Identification
                                                                                                    Activity</a>
                                                                                            </div>
                                                                                            <div id="faq2_q1"
                                                                                                class="collapse show"
                                                                                                role="tabpanel"
                                                                                                aria-labelledby="faq2_h1"
                                                                                                data-bs-parent="#faq2">
                                                                                                <div
                                                                                                    class="block-content">
                                                                                                    <?php echo $single_question_data[0]['question_type_identification_activity']; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="block-content block-content-full text-end bg-body">
                                                                                        <button type="button"
                                                                                            class="btn btn-sm block-header-default text-white text-white"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="fw-semibold fs-sm">
                                                                <div class="py-1">
                                                                    <p><?php echo $store_total_wrong_answer; ?></p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                <!-- END Answer Type 1 -->



                                                <!-- END ANSWER Type 3 MODAL -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/test-review.css') }}">
    <style>
        .tab-padding {
            padding: 20px !important;
        }

        .border-top-tr {
            border-top: 1px solid #ebeef2;
        }

        .category-badge.btn-success:hover {
            background-color: #65a30d !important;
            border-color: #65a30d !important;
        }

        .category-badge.btn-success:focus {
            background-color: #65a30d !important;
            border-color: #65a30d !important;
            box-shadow: none !important;
        }

        .category-badge {
            cursor: default !important;
        }

        #incorrect-message {
            position: relative;
            top: -20px;
            left: 31px;
            font-size: 14px;
        }

        /* .description-test-review p:nth-child(2){
                                                                                                                                                display: none;
                                                                                                                                            } */
        .content-full {
            max-width: 1195px !important;
            overflow: hidden !important;
        }

        .table thead th {
            padding: 10px 19px 10px 12px !important;
        }

        .table-contant tbody tr td {
            padding: 10px 19px 10px 12px !important;
        }

        @media(max-width:575px) {
            table {
                display: block;
                /* width: 260px; */
                overflow: scroll;
            }
        }
    </style>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/test-review.js') }}"></script>
@endsection
