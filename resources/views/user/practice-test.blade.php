@extends('layouts.user')

@section('title', 'practice-test : CPS')

@section('user-content')
    <meta name="_token" content="{{ csrf_token() }}" />
    <style>
        .checkbox-button {
            appearance: none;
            background-color: #fff;
            border: 1px solid #000;
            border-radius: 4px;
            box-sizing: border-box;
            display: inline-block;
            font-size: 16px;
            padding: 3px 8px;
            position: relative;
            vertical-align: middle;
            border: solid #ea580c;
        }

        .checkbox-button input[type="checkbox"] {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            cursor: pointer;

        }

        .checkbox-button.main_guess_section:hover {
            background-color: #ea580c;
        }

        .checkbox-button:hover {
            cursor: pointer;
        }

        .scroll_target {
            height: 110px;
            overflow: auto;
        }

        .content-height {
            min-height: 460px;
        }

        .block-content h5 {
            font-size: 14px;
        }

        .scroll_target {
            height: 270px
        }

        .scroll_target p {
            margin-bottom: 0px !important;
        }

        .clock-button {
            min-width: 100px;
            display: inline-flex;
            align-items: center;
            padding-left: 11px;
            pointer-events: none;
        }

        .dcg-wrapper {
            width: 100% !important;
            height: 500px !important;
        }

        .question-button {
            cursor: pointer !important;
            font-size: 17px !important;
            padding: 10px 20px !important;
            border-radius: 0 !important;
        }

        .btn-blue {
            background-color: #0d6efd !important;
        }

        .btn-yellow {
            background-color: #ffc107 !important;
        }

        .btn-orange {
            background-color: rgb(234, 88, 12) !important;
        }

        .btn-red {
            background-color: #dc3545 !important;
        }

        .btn-nocolor {
            background-color: #f6f7f9 !important;
            color: #000 !important;
            border-color: #000 !important;
            border: 1px solid #000 !important;
        }

        .blue-button {
            /* 0d6efd */
            /* 395aa6 */
            background-color: #0d6efd !important;
            /* display: inline-block; */
            /* width: 20px;
                                                                                                              height: 20px;
                                                                                                              background-color: blue;
                                                                                                              margin-right: 5px; */
        }
    </style>

    <!-- Main Container -->
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-boxed py-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        {{-- <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="{{ url('user/practice-test-sections/'.$section_id) }}">Practice Tests</a>
                    </li> --}}
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx"
                                href="{{ url('user/practice-test-sections/' . $testSection[0]->testid) }}">College Prep
                                System</a>
                            {{-- {{ isset($testSection[0]->section_title) ? $testSection[0]->section_title : '' }} {{ isset($testSection[0]->title) ? $testSection[0]->title : '' }} {{ isset($testSection[0]->id) ? '#'. $testSection[0]->id : '' }} --}}
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">College Prep System SAT Practice Test #1</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <input type="hidden" id="timeisover" name="timeisover" value=0>
        <input type="hidden" id="section_id" value="{{ $section_id }}">
        <input type="hidden" id="get_offset" value="{{ $set_offset }}">
        <input type="hidden" id="get_question_type" value="{{ $question_type }}">
        <input type="hidden" id="time_selected" value="">
        <!-- Page Content -->
        <div class="content content-boxed content-height">
            <div class="row">
                <div class="col-xl-6 passageContainer">
                    <!-- Lessons -->
                    <div class="block block-rounded">
                        <div class="block-content fs-sm">

                            @if (isset($total_questions[0]))
                                <input type="hidden" id="onload_question_id" value="{{ $total_questions[0] }}">
                            @else
                                <input type="hidden" id="onload_question_id" value="">
                            @endif
                            <h5 class=" mb-2">
                                PASSAGE I
                            </h5>
                            <h5 class=" mb-4">
                                <strong id="passage_type">PASSAGE TYPE: NATURAL SCIENCE</strong><br /><span
                                    id="passage_title">This is adapted from author Blah.</span>
                            </h5>
                            <div class="mb-4">
                                <div id="passage_description" class="form-control scroll_target" style="resize: vertical;">
                                </div>
                                {{-- <textarea id="passage_description" class="form-control scroll_target bg-transparent"></textarea> --}}
                            </div>
                            <div class="output">

                            </div>
                        </div>
                    </div>
                    <!-- END Lessons -->
                </div>
                <div class="col-xl-6" id="set_question_data">

                    <!-- Question -->

                    <!-- END Subscribe -->


                </div>
            </div>
        </div>
        <!-- END Page Conten    t -->
        <!-- Navigation -->
        <div class="bg-body-extra-light">
            <div class="content content-boxed py-3">
                <div class="row">
                    <div class="col-xl-4">
                        <button type="button" id="get_previous_question_btn" value=""
                            class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 prev" data-count="0"><i
                                class="fa fa-fw fa-arrow-left me-1"></i>Previous</button>
                        <button type="button" id="get_next_question_btn" value=""
                            class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 next" data-count="0">Next<i
                                class="fa fa-fw fa-arrow-right me-1"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 review"><i
                                class="fa fa-fw fa-list-check me-1"></i>Review</button>
                        <button type="button" class="btn btn-sm btn-dark fs-xs fw-semibold me-1 mb-3 clock-button"><i
                                class="fa fa-fw fa-clock me-1"></i>
                            <span id="timer">
                                @php
                                    $optionValue = $_GET['time'] ?? null;
                                    $regularTime = optional($testSection[0])->regular_time ?? '00:00:00';
                                    $fiftyPerExtended = optional($testSection[0])->fifty_per_extended ?? '00:00:00';
                                    $hundredPerExtended = optional($testSection[0])->hundred_per_extended ?? '00:00:00';
                                @endphp
                                {{ $optionValue == 'regular' ? $regularTime : ($optionValue == '50per' ? $fiftyPerExtended : ($optionValue == '100per' ? $hundredPerExtended : '00:00:00')) }}
                            </span>
                        </button>
                    </div>
                    <div class="col-xl-5">
                        <label
                            class="btn btn-sm btn-outline-danger fs-xs fw-semibold me-1 mb-3 checkbox-button main_flag_section">
                            <input type="checkbox" class="flag" />
                            <span><i class="fa fa-fw fa-flag me-1" style="color:red"></i>Flag</span>
                        </label>

                        {{-- <button type="button" id="get_skip_question_btn" class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 skip" data-count="0"><i class="fa fa-fw fa-forward me-1"></i>Skip</button> --}}
                        <label
                            class="btn btn-sm btn-outline-info fs-xs fw-semibold me-1 mb-3 checkbox-button main_skip_section">
                            <input type="checkbox" class="skip" />
                            <span><i class="fa fa-fw fa-forward me-1"></i>Skip</span>
                        </label>

                        <label
                            class="btn btn-sm btn-outline-warning fs-xs fw-semibold me-1 mb-3 checkbox-button main_guess_section">
                            <input type="checkbox" class="guess" />
                            <span><i class="fa fa-fw fa-circle-question me-1"></i>Guess</span>
                        </label>
                        {{--
                        @if ($testSection[0]->practice_test_type == 'Math')
                            <button type="button"
                                class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 calculator"><i
                                    class="fa fa-fw fa-calculator me-1" style="color:black"></i>Calculator</button>
                        @endif
                        --}}
                        @php
                            $section = ['Math', 'Math_with_calculator'];
                        @endphp

                        @if (in_array($testSection[0]->practice_test_type, $section) || $testSection[0]->show_calculator == 1)
                            <button type="button"
                                class="btn btn-sm btn-outline-dark fs-xs fw-semibold me-1 mb-3 calculator"><i
                                    class="fa fa-fw fa-calculator me-1" style="color:black"></i>Calculator</button>
                        @endif
                    </div>
                    <div class="col-xl-3">
                        <input type="hidden" id="actual_time" name="actual_time" value="00:00:00">
                        <button type="button" disabled
                            class="btn btn-sm btn-outline-success fs-xs fw-semibold me-1 mb-3 submit_section_btn"><i
                                class="fa fa-fw fa-circle-check me-1"></i>Submit Section</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="calculator-container"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Navigation -->
    </main>
    <!-- END Main Container -->
@endsection

@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}">
    <style>
        .content {
            width: 90%;
        }

        .modal-dialog {
            max-width: 1000px;
        }
    </style>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://www.desmos.com/api/v1.7/calculator.js?apiKey=dcb31709b452b1cf9dc26972add0fda6"></script>
    <script>
        var storedSelectedAnswers = [];
        $(document).on('click', '.calculator', function() {
            $('#exampleModal #calculator-container').html('');
            const calculator = Desmos.GraphingCalculator(document.getElementById('calculator-container'));
            $('#exampleModal').modal('show');
        });

        jQuery(document).ready(function() {

            //PROGRESS CHECK STARTS
            let sectionId = $('#section_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('check_progress') }}",
                method: 'post',
                data: {
                    'sectionId': sectionId,
                },
                success: function(result) {
                    let progressFlag = result.progressFlag;
                    // progressFlag = 0;
                    if (progressFlag) {
                        //handleProgress(result.existingProgress);
                        // console.log(result.existingProgress);
                        var get_offset = result.existingProgress.progress_index;
                        var question_id_arr = JSON.parse(result.existingProgress.question_id);
                        if (question_id_arr[get_offset])
                            $('#onload_question_id').val(question_id_arr[get_offset]);
                        get_first_question(get_offset, result.existingProgress);

                        jQuery('.next').attr('data-count', get_offset);
                        jQuery('.prev').attr('data-count', get_offset);

                    } else {
                        var get_offset = jQuery('#get_offset').val();
                        get_first_question(get_offset);
                    }
                }
            });
            //PROGRESS CHECK ENDS

            var selected_answer = [];
            var selected_gusess_details = [];
            var selected_flag_details = [];
            var selected_skip_details = [];

            var question_id_arr = @json($total_questions);
            $('#onload_question_id').val(question_id_arr[0]);

            var getSelectedAnswer;
            var check_click_type = 'onload';
            get_time();

            $('.content').on('click', 'input[name=example-radios-default]:radio', function() {
                var get_question_id = jQuery('.get_question_id').val();
                // $('.skip').css("color", "#0891b2");
                // $('.skip').css("background-color", "white");
                // selected_skip_details[get_question_id] = 'no';
            });


            jQuery(".prev").click(function() {
                var get_offset = jQuery(this).val();
                var get_question_id = jQuery('.get_question_id').val();
                let data_count = jQuery(this).attr('data-count');
                data_count = parseInt(data_count);
                jQuery(this).attr('data-count', data_count - 1);
                // jQuery('.skip').attr('data-count', data_count - 1);
                jQuery('.next').attr('data-count', data_count - 1);
                var set_scroll_position = 0;

                let arr_index = jQuery('.prev').attr('data-count');
                $('#onload_question_id').val(question_id_arr[arr_index]);

                if ($("input[name='example-radios-default']").is(':checked')) {
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                    // selected_skip_details[get_question_id] = 'no';
                } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        store_multi += this.value + ',';
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                    // selected_skip_details[get_question_id] = 'no';
                } else if ($("input[name='example-textbox-default']")) {
                    store_multi = $("input[name='example-textbox-default']").val();
                    selected_answer[get_question_id] = store_multi;
                    // selected_skip_details[get_question_id] = 'no';
                } else {
                    selected_answer[get_question_id] = '-';
                    // selected_skip_details[get_question_id] = 'yes';
                }

                if (!$(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if (!$(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'no';
                }

                var check_click_type = 'prev';

                //PROGRESS CHECK Starts
                let sectionId = $('#section_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ route('check_progress') }}",
                    method: 'post',
                    data: {
                        'sectionId': sectionId,
                    },
                    success: function(result) {
                        let progressFlag = result.progressFlag;
                        // progressFlag = 0;
                        if (progressFlag) {
                            get_first_question(get_offset, result.existingProgress);
                        } else {
                            //var get_offset = jQuery('#get_offset').val();
                            get_first_question(get_offset);
                        }
                    }
                });
                //PROGRESS CHECK Ends

                var scroll_id = jQuery('.get_question_id').val();
                scroll_id = scroll_id - 1;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ url('/user/get_scroll_position/post') }}",
                    method: 'post',
                    data: {
                        get_question_id: scroll_id,
                    },
                    success: function(result) {
                        var element = document.querySelector('#passage_description');
                        set_scroll_position = result.scroll_position[0].scroll_position;
                        element.scrollTop = set_scroll_position;


                    }
                });

            });

            var count = 1;
            jQuery(".next").click(async function() {
                await storeProgress();
                var get_offset = jQuery(this).val();
                let data_count = jQuery(this).attr('data-count');
                data_count = parseInt(data_count);
                jQuery(this).attr('data-count', data_count + 1);
                // jQuery('.skip').attr('data-count', data_count + 1);
                jQuery('.prev').attr('data-count', data_count + 1);
                var get_question_id = jQuery('.get_question_id').val();

                let arr_index = jQuery('.next').attr('data-count');
                $('#onload_question_id').val(question_id_arr[arr_index]);

                if ($("input[name='example-radios-default']").is(':checked')) {
                    count++;
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                    // selected_skip_details[get_question_id] = 'no';
                } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                    count++;
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        store_multi += this.value + ',';
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                    // selected_skip_details[get_question_id] = 'no';
                } else if ($("input[name='example-textbox-default']")) {
                    store_multi = $("input[name='example-textbox-default']").val();
                    selected_answer[get_question_id] = store_multi;
                    // selected_skip_details[get_question_id] = 'no';
                }

                if (!$(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if (!$(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'no';
                }

                //PROGRESS CHECK Starts
                let sectionId = $('#section_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ route('check_progress') }}",
                    method: 'post',
                    data: {
                        'sectionId': sectionId,
                    },
                    success: function(result) {
                        let progressFlag = result.progressFlag;
                        // progressFlag = 0;
                        if (progressFlag) {
                            get_first_question(get_offset, result.existingProgress);
                        } else {
                            get_first_question(get_offset);
                        }
                    }
                });
                //PROGRESS CHECK Ends


                var scroll_position = $('#passage_description').scrollTop();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ url('/user/set_scroll_position/post') }}",
                    method: 'post',
                    data: {
                        get_question_id: get_question_id,
                        scroll_position: scroll_position
                    },
                    success: function(result) {

                    }
                });
            });

            //skip function
            jQuery(".skip").click(function() {
                var get_question_id = jQuery('.get_question_id').val();
                if ($(this).is(':checked')) {
                    $('.main_skip_section').css("color", "white");
                    $('.main_skip_section').css("background-color", "#ea580c");
                    selected_skip_details[get_question_id] = 'yes';
                } else {
                    $('.main_skip_section').css("color", "#ea580c");
                    $('.main_skip_section').css("background-color", "white");
                    selected_skip_details[get_question_id] = 'no';
                }

                if (!$(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'no';
                }
            });

            //guess function
            jQuery(".guess").click(function() {
                var get_question_id = jQuery('.get_question_id').val();
                if ($(this).is(':checked')) {
                    $('.main_guess_section').css("color", "white");
                    $('.main_guess_section').css("background-color", "#ea580c");
                    selected_gusess_details[get_question_id] = 'yes';
                } else {
                    $('.main_guess_section').css("color", "#ea580c");
                    $('.main_guess_section').css("background-color", "white");
                    selected_gusess_details[get_question_id] = 'no';
                }

                if (!$(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'no';
                }
            });

            jQuery(".flag").click(function() {
                var get_question_id = jQuery('.get_question_id').val();
                if ($(this).is(':checked')) {
                    $('.main_flag_section').css("color", "white");
                    $('.main_flag_section').css("background-color", "#dc2626");
                    selected_flag_details[get_question_id] = 'yes';
                } else {
                    $('.main_flag_section').css("color", "#dc2626");
                    $('.main_flag_section').css("background-color", "white");
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if (!$(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'no';
                }
            });

            jQuery(".review").click(function() {
                var current_question_id = $('.next').val();
                var question_ids = @json($total_questions);

                let my_arr = []
                let totalFlag = 0;
                let totalSkip = 0;
                let totalGuess = 0;

                for (let index = 0; index < question_ids.length; index++) {
                    my_arr[question_ids[index]] = {
                        "flag": selected_flag_details[question_ids[index]],
                        "guess": selected_gusess_details[question_ids[index]],
                        "skip": selected_skip_details[question_ids[index]]
                    }
                }

                my_arr.forEach(element => {
                    if (element.flag == 'yes')
                        totalFlag++

                    if (element.skip == 'yes')
                        totalSkip++

                    if (element.guess == 'yes')
                        totalGuess++
                });

                // if(current_question_id==1 && !totalFlag && !totalGuess && !totalSkip)
                // {
                //     var alert_data={
                //         title: "You didn’t answer all questions do you want to review section now ?",
                //         // text: "You didn’t answer all questions do you want to review section now ?",
                //         type: "info",
                //         showCancelButton: true,
                //         confirmButtonColor: "#DD6B55",
                //         confirmButtonText: "Yes",
                //         cancelButtonText: "Cancel",
                //         closeOnConfirm: false,
                //         closeOnCancel: true,
                //         index:true,
                //     }
                var reviewCount = {
                    flag: totalFlag,
                    skip: totalSkip,
                    guess: totalGuess
                }
                // }
                // else
                // {
                var questionBoxes = "";
                for (let index = 0; index < question_ids.length; index++) {
                    var num = index + 1;

                    var btn_color = 'btn-nocolor';
                    if (selected_flag_details[question_ids[index]] == 'yes') {
                        btn_color = 'btn-red';
                    } else if (selected_gusess_details[question_ids[index]] == 'yes') {
                        btn_color = 'btn-orange';
                    } else if (selected_skip_details[question_ids[index]] == 'yes') {
                        btn_color = 'btn-yellow';
                    } else if (selected_answer[question_ids[index]]) {
                        btn_color = 'btn-blue';
                    }
                    questionBoxes += '<button type="button" value="' + num + '" class="question-button ' +
                        btn_color + ' btn qtbutton" data-count="' + index + '">' + num + '</button>';
                }

                var alert_data = {
                    title: "Review Details",
                    // text: "Flag :- "+totalFlag+","+"Skip :- "+totalSkip+","+"Guess :- "+totalGuess,
                    text: "<div class='d-flex flex-wrap'>" + questionBoxes + "</div>",
                    type: "success",
                   
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Cancel",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: true,
                    closeOnCancel: false,
                    index: false,
                };
                // }
                sweet_alert(alert_data, reviewCount, question_ids);
            });

            function sweet_alert(data, review, question_ids) {
                swal({
                    title: data.title,
                    text: data.text,
                    html: true,
                    type: data.type,
                    showCancelButton: data.showCancelButton,
                    confirmButtonColor: data.confirmButtonColor,
                    confirmButtonText: data.confirmButtonText,
                    cancelButtonText: data.cancelButtonText,
                    closeOnConfirm: data.closeOnConfirm,
                    closeOnCancel: data.closeOnCancel
                }, (resp) => {
                    if (data.index && resp) {
                        var questionBoxes = "";
                        for (let index = 0; index < question_ids.length; index++) {
                            var num = index + 1;

                            var btn_color = 'btn-nocolor';
                            if (selected_flag_details[question_ids[index]] == 'yes') {
                                btn_color = 'btn-red';
                            } else if (selected_gusess_details[question_ids[index]] == 'yes') {
                                btn_color = 'btn-orange';
                            } else if (selected_skip_details[question_ids[index]] == 'yes') {
                                btn_color = 'btn-yellow';
                            } else if (selected_answer[question_ids[index]]) {
                                btn_color = 'btn-blue';
                            }
                            questionBoxes += '<button type="button" value="' + num +
                                '" class="question-button ' + btn_color + ' btn qtbutton" data-count="' +
                                index + '">' + num + '</button>';
                        }

                        swal({
                            title: "Review Details",
                            // text: "Flag :- "+review.flag+","+"Skip :- "+review.skip+","+"Guess :- "+review.guess,
                            text: "<div class='d-flex flex-wrap'>" + questionBoxes + "</div>",
                            html: true,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Cancel",
                            cancelButtonText: "Cancel",
                            closeOnConfirm: true,
                            closeOnCancel: false,
                            index: false,
                        })
                    }
                });
            }

            jQuery(".submit_section_btn").click(async function() {
                await storeProgress();
                if (jQuery('.next').prop('disabled') == false) {
                    var timeisover = jQuery('#timeisover').val();
                    if (timeisover == 1) {
                        confirm(true);
                    } else {
                        swal({
                            title: "Warning",
                            text: "Are you sure you want to submit this test? Make sure you have answered every question using the Review button.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes",
                            cancelButtonText: "No",
                            closeOnConfirm: true,
                            closeOnCancel: true,
                        }, function(isConfirm) {
                            if (isConfirm) {
                                confirm(false);
                            }
                        });
                    }
                } else {
                    var timeisover = jQuery('#timeisover').val();
                    if (timeisover == 1) {
                        confirm(true);
                    } else {
                        confirm(false);
                    }
                }
            });

            function confirm(flagTimeOut, submit = false) {


                let sectionID = '{{ $section_id }}';

                var get_question_id = jQuery('#onload_question_id').val();
                if ($(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'yes';
                } else {
                    selected_flag_details[get_question_id] = 'no';
                }

                if ($(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'yes';
                } else {
                    selected_skip_details[get_question_id] = 'no';
                }

                if ($(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'yes';
                } else {
                    selected_gusess_details[get_question_id] = 'no';
                }

                var get_section_id = jQuery('#section_id').val();
                var get_question_type = jQuery('#get_question_type').val();
                var get_practice_id = jQuery(this).attr('data-practice_test_id');
                var get_test_id = '';
                let question_ids = @json($total_questions);
                var actual_time = jQuery('#actual_time').val();

                //if (window.location.href.indexOf("all") > -1)
                //{
                //    var url = window.location.href,
                //    parts = url.split("/"),
                //    last_part = parts[parts.length-1];
                //    get_test_id = last_part;
                //} else {
                const urlParams = new URLSearchParams(window.location.search);
                get_test_id = urlParams.get('test_id');
                //}

                if ($("input[name='example-radios-default']").is(':checked')) {
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        store_multi += this.value + ',';
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                } else if ($("input[name='example-textbox-default']")) {
                    store_multi = $("input[name='example-textbox-default']").val();
                    selected_answer[get_question_id] = store_multi;
                } else {
                    selected_answer[get_question_id] = '-';
                }


                let flag_detail = [];
                // selected_flag_details = selected_flag_details.filter(function( element, key ) {
                //     return element !== "undefined";
                // });
                //start
                for (let index = 0; index < question_ids.length; index++) {
                    if (selected_flag_details.hasOwnProperty(question_ids[index])) {
                        flag_detail[question_ids[index]] = selected_flag_details[question_ids[index]];
                    } else {
                        flag_detail[question_ids[index]] = 'no';
                    }
                }
                //end
                let guess_detail = [];
                // selected_gusess_details = selected_gusess_details.filter(function( element, key ) {
                //     return element !== "undefined";
                // });
                //start
                for (let index = 0; index < question_ids.length; index++) {
                    if (selected_gusess_details.hasOwnProperty(question_ids[index])) {
                        guess_detail[question_ids[index]] = selected_gusess_details[question_ids[index]];
                    } else {
                        guess_detail[question_ids[index]] = 'no';
                    }
                }
                //end

                //skip
                let skip_detail = [];
                for (let index = 0; index < question_ids.length; index++) {
                    if (selected_skip_details.hasOwnProperty(question_ids[index])) {
                        skip_detail[question_ids[index]] = selected_skip_details[question_ids[index]];
                    } else {
                        skip_detail[question_ids[index]] = 'no';
                    }
                }
                //end

                Array.prototype.associate = function(keys) {
                    var result = {};

                    this.forEach(function(el, i) {
                        result[keys[i]] = el;
                    });

                    return result;
                };

                let answer_details = [];
                if (storedSelectedAnswers) {
                    answer_details = storedSelectedAnswers;
                } else {
                    for (let index = 0; index < question_ids.length; index++) {
                        if (selected_answer.hasOwnProperty(question_ids[index])) {
                            answer_details[question_ids[index]] = selected_answer[question_ids[index]];
                        } else {
                            answer_details[question_ids[index]] = '-';
                        }
                    }
                    answer_details = answer_details.filter(function(element, key) {
                        return element !== 'undefined';
                    });
                    answer_details = answer_details.associate(question_ids);
                }
                // var new_answer_detail = [];
                // answer_details.map(function(key,index){
                //     if(key !== 'undefined'){
                //         new_answer_detail.push({[index]: key})
                //     }

                // });

                flag_detail = flag_detail.filter(function(element, key) {
                    return element !== 'undefined';
                });
                flag_detail = flag_detail.associate(question_ids);

                guess_detail = guess_detail.filter(function(element, key) {
                    return element !== 'undefined';
                });
                guess_detail = guess_detail.associate(question_ids);

                skip_detail = skip_detail.filter(function(element, key) {
                    return element !== 'undefined';
                });
                skip_detail = skip_detail.associate(question_ids);
                if (window.location.href.indexOf("all") !== -1) {
                    var section_size = 'all';
                } else {
                    var section_size = 'single';
                }

                // let flag_details = selected_flag_details.associate(question_ids);
                // let gusess_details = selected_gusess_details.associate(question_ids);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                const postData = {
                    section_id: sectionID,
                    selected_answer: answer_details,
                    selected_gusess_details: guess_detail,
                    selected_flag_details: flag_detail,
                    selected_skip_details: skip_detail,
                    get_section_id: get_section_id,
                    get_practice_id: get_test_id,
                    get_question_type: get_question_type,
                    section_size: section_size,
                    actual_time: actual_time
                };
                jQuery.ajax({
                    url: "{{ url('/user/set_user_question_answer/post') }}",
                    method: 'post',
                    data: postData,
                    success: function(result) {
                        // console.log(result);
                        // alert('Break Time: '+result.break_time);
                        // alert('Redirect URL: '+result.redirect_url);
                        // die;
                        if (count < result.total_question) {
                            window.alert(
                                "Are you sure you want to submit this test? Make sure you have answered every question using the Review button."
                            );
                        }

                        // redirect code here.
                        if (result.redirect_url != 0) {
                            // only for DSAT, DPSAT
                            var url = window.location.origin + result.redirect_url;
                            window.location.href = url;
                            return false;
                        } else {

                            if (result.break_time != 0) {
                                let next_section_id = result.next_section_id;
                                var url = window.location.origin + '/user/test-break/' +
                                    next_section_id + '?test_id=' + get_test_id;
                                window.location.href = url;
                                return false;
                            }

                            var url = window.location.origin + '/user/practice-test-sections/' +
                                get_test_id;
                            window.location.href = url;
                            return false;
                        }

                        // redirect to test break here.
                        // this code below is not working anymore.
                        var url = "{{ url('') }}" + '/user/practice-tests/' + result
                            .get_test_name + '/' + result.section_id + '/review-page?test_id=' +
                            get_test_id + '&type=' + result.get_test_type;

                        if (window.location.href.indexOf("all") > -1) {
                            var url = window.location.href,
                                parts = url.split("=");
                            var sectionArrayJson = parts[parts.length - 1];
                            var sectionArray = JSON.parse(sectionArrayJson);
                            if (sectionArray.length > 0) {
                                var next_section_id = sectionArray[0];
                                if (next_section_id != '') {
                                    sectionArray.shift();
                                    let remainingSectionArrayJson = JSON.stringify(sectionArray);

                                    let option = new URLSearchParams(window.location.search);
                                    let OptionValue = option.get('time');

                                    if (flagTimeOut) {
                                        swal({
                                            title: "Confirm",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "Submit",
                                            cancelButtonText: "Proceed to Next section",
                                            closeOnConfirm: true,
                                            closeOnCancel: true,
                                        }, function(isConfirm) {
                                            if (isConfirm) {
                                                var url = "{{ url('') }}" +
                                                    '/user/practice-tests/' + result
                                                    .get_test_name + '/' + result.section_id +
                                                    '/review-page?test_id=' + get_test_id +
                                                    '&type=' + result.get_test_type;
                                                window.location.href = url;
                                            } else {
                                                var url = "{{ url('') }}" +
                                                    '/user/practice-test/' + next_section_id +
                                                    '?test_id=' + get_test_id + '&time=' +
                                                    OptionValue + '&section=all&sections=' +
                                                    remainingSectionArrayJson;
                                                window.location.href = url;
                                            }
                                        });
                                        return false;
                                    } else {
                                        var url = "{{ url('') }}" + '/user/practice-test/' +
                                            next_section_id + '?test_id=' + get_test_id + '&time=' +
                                            OptionValue + '&section=all&sections=' +
                                            remainingSectionArrayJson;
                                    }
                                } else {
                                    // var url = "{{ url('') }}"+'/user/practice-test-sections/'+get_test_id;
                                    var url = "{{ url('') }}" + '/user/practice-tests/' + result
                                        .get_test_name + '/' + get_test_id + '/review-page?test_id=' +
                                        get_test_id + '&type=all';
                                }
                            } else {
                                var url = "{{ url('') }}" + '/user/practice-tests/' + result
                                    .get_test_name + '/' + get_test_id + '/review-page?test_id=' +
                                    get_test_id + '&type=all';
                            }
                        } else {
                            if (flagTimeOut) {
                                var url = "{{ url('') }}" + '/user/practice-tests/' + result
                                    .get_test_name + '/' + result.section_id + '/review-page?test_id=' +
                                    get_test_id + '&type=' + result.get_test_type;
                            } else {
                                var url = "{{ url('') }}" + '/user/practice-test-sections/' +
                                    get_test_id;
                            }
                        }
                        window.location.href = url;
                    }
                });
            }

            function get_first_question(get_offset, existingProgress = null) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/user/get_section_questions/post') }}",
                    method: 'post',
                    data: {
                        section_id: jQuery('#section_id').val(),
                        question_id: $('#onload_question_id').val(),
                        question_type: jQuery('#get_question_type').val(),
                        get_offset: get_offset,
                    },
                    success: function(result) {
                        let questionId = result.questions[0].question_id;

                        $('.submit_section_btn').attr('data-practice_test_id', result.practice_test_id);
                        var check_if_flag_selected = selected_flag_details[result.questions[0]
                            .question_id];
                        var check_if_guess_selected = selected_gusess_details[result.questions[0]
                            .question_id];
                        var check_if_skip_selected = selected_skip_details[result.questions[0]
                            .question_id];

                        if (result.questions[0].passage_type && result.questions[0].passage_title &&
                            result.questions[0].passage_description) {
                            $('.passageContainer').css('display', 'block');
                            var passage_type = 'PASSAGE TYPE: ' + result.questions[0].passage_type;
                            var passage_title = result.questions[0].passage_title;
                            var passage_description = result.questions[0].passage_description;
                            var set_passage_type = '<strong>' + passage_type + '</strong><br />' +
                                passage_title + '';
                        } else {
                            // var passage_type = '';
                            // var passage_title =  '';
                            // var passage_description = '';
                            // var set_passage_type = '<strong>'+passage_type+'</strong><br />'+passage_title+'';
                            $('.passageContainer').css('display', 'none');
                        }
                        // if(passage_description)
                        // {
                        //     passage_description = passage_description.replace(/(<([^>]+)>)/gi, "");
                        // }

                        var get_question_title = result.questions[0].question_title;
                        // get_question_title = result.questions[0].question_title.replace(/(<([^>]+)>)/gi, "");
                        get_question_title = result.questions[0].question_title.replace(
                            /(<([<p></p>]+)>)/gi, "");
                        var get_question_no = parseInt(result.get_offset) + 1;

                        var set_questions_options = '<div class="mb-4">';
                        set_questions_options +=
                            `<input type="hidden" value="${result.questions[0].question_id}" class="get_question_id"><label class="form-label">Question ${get_question_no} ${get_question_title}</label>`;

                        if (result.questions[0].question_answer_options) {
                            var get_options = result.questions[0].question_answer_options.replace(
                                /(<([<p></p>]+)>)/gi, "");
                        } else {
                            get_options = '["a"]';
                        }
                        jQuery.each(JSON.parse(get_options), function(key, val) {
                            var get_option_number = 'A';
                            if (result.questions[0].practice_type == "choiceOneInFive_Odd") {
                                if (key == 0) {
                                    get_option_number = 'a';
                                } else if (key == 1) {
                                    get_option_number = 'b';
                                } else if (key == 2) {
                                    get_option_number = 'c';
                                } else if (key == 3) {
                                    get_option_number = 'd';
                                } else if (key == 4) {
                                    get_option_number = 'e';
                                }
                            } else if (result.questions[0].practice_type ==
                                "choiceOneInFive_Even") {
                                if (key == 0) {
                                    get_option_number = 'f';
                                } else if (key == 1) {
                                    get_option_number = 'g';
                                } else if (key == 2) {
                                    get_option_number = 'h';
                                } else if (key == 3) {
                                    get_option_number = 'j';
                                } else if (key == 4) {
                                    get_option_number = 'k';
                                }

                            } else if (result.questions[0].practice_type ==
                                "choiceOneInFourPass_Odd") {
                                if (key == 0) {
                                    get_option_number = 'a';
                                } else if (key == 1) {
                                    get_option_number = 'b';
                                } else if (key == 2) {
                                    get_option_number = 'c';
                                } else if (key == 3) {
                                    get_option_number = 'd';
                                }
                            } else if (result.questions[0].practice_type ==
                                "choiceOneInFourPass_Even") {
                                if (key == 0) {
                                    get_option_number = 'f';
                                } else if (key == 1) {
                                    get_option_number = 'g';
                                } else if (key == 2) {
                                    get_option_number = 'h';
                                } else if (key == 3) {
                                    get_option_number = 'j';
                                }
                            } else if (result.questions[0].practice_type ==
                                "choiceOneInFour_Odd") {
                                if (key == 0) {
                                    get_option_number = 'a';
                                } else if (key == 1) {
                                    get_option_number = 'b';
                                } else if (key == 2) {
                                    get_option_number = 'c';
                                } else if (key == 3) {
                                    get_option_number = 'd';
                                }
                            } else if (result.questions[0].practice_type ==
                                "choiceOneInFour_Even") {
                                if (key == 0) {
                                    get_option_number = 'f';
                                } else if (key == 1) {
                                    get_option_number = 'g';
                                } else if (key == 2) {
                                    get_option_number = 'h';
                                } else if (key == 3) {
                                    get_option_number = 'j';
                                }
                            } else if (result.questions[0].practice_type ==
                                "choiceMultInFourFill" && result.questions[0]
                                .is_multiple_choice == 2) {
                                if (key == 0) {
                                    get_option_number = result.questions[0].question_answer;
                                }

                            } else {
                                if (key == 0) {
                                    get_option_number = 'a';
                                } else if (key == 1) {
                                    get_option_number = 'b';
                                } else if (key == 2) {
                                    get_option_number = 'c';
                                } else if (key == 3) {
                                    get_option_number = 'd';
                                }
                            }

                            if (selected_answer[result.questions[0].question_id] !== '' &&
                                selected_answer[result.questions[0].question_id] !== undefined
                            ) {
                                if (jQuery.type(result.questions[0].is_multiple_choice) ==
                                    'null') {
                                    if (selected_answer[result.questions[0].question_id] ==
                                        get_option_number) {
                                        set_questions_options += '<div class="space-y-2">';
                                        set_questions_options +=
                                            '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                            get_option_number +
                                            '" name="example-radios-default" value="' +
                                            get_option_number +
                                            '" checked ><label class="form-check-label" for="' +
                                            get_option_number + '">' + get_option_number
                                            .toUpperCase() + '. ' + val + '</label></div></div>'
                                    } else {
                                        set_questions_options += '<div class="space-y-2">';
                                        set_questions_options +=
                                            '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                            get_option_number +
                                            '" name="example-radios-default" value="' +
                                            get_option_number +
                                            '"><label class="form-check-label" for="' +
                                            get_option_number + '">' + get_option_number
                                            .toUpperCase() + '. ' + val + '</label></div></div>'
                                    }
                                } else {
                                    var array = selected_answer[result.questions[0].question_id]
                                        .split(',');
                                    if (jQuery.inArray(get_option_number, array) == -1) {
                                        if (jQuery.type(result.questions[0]
                                                .is_multiple_choice) == 'null') {
                                            set_questions_options += '<div class="space-y-2">';
                                            set_questions_options +=
                                                '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                get_option_number +
                                                '" name="example-radios-default"  value="' +
                                                get_option_number +
                                                '"><label class="form-check-label" for="' +
                                                get_option_number + '">' + get_option_number
                                                .toUpperCase() + '. ' + val +
                                                '</label></div></div>';
                                        } else if (result.questions[0].is_multiple_choice ==
                                            1) {
                                            set_questions_options += '<div class="space-y-2">';
                                            set_questions_options +=
                                                '<div class="form-check"><input class="selected-option form-check-input" type="checkbox" id="' +
                                                get_option_number +
                                                '" name="example-checkbox-default"  value="' +
                                                get_option_number +
                                                '"><label class="form-check-label" for="' +
                                                get_option_number + '">' + get_option_number
                                                .toUpperCase() + '. ' + val +
                                                '</label></div></div>';
                                        } else if (result.questions[0].is_multiple_choice ==
                                            2) {
                                            set_questions_options +=
                                                '<div class="space-y-2"><input type="text" class="selected-option" id="' +
                                                get_option_number +
                                                '" name="example-textbox-default" value="' +
                                                array + '"></div>';
                                        } else {
                                            set_questions_options += '<div class="space-y-2">';
                                            set_questions_options +=
                                                '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                get_option_number +
                                                '" name="example-radios-default" value="' +
                                                get_option_number +
                                                '"><label class="form-check-label" for="' +
                                                get_option_number + '">' + get_option_number
                                                .toUpperCase() + '. ' + val +
                                                '</label></div></div>'
                                        }
                                    }

                                    $.each(array, function(index, value) {
                                        if (value == get_option_number) {
                                            if (jQuery.type(result.questions[0]
                                                    .is_multiple_choice) == 'null') {
                                                set_questions_options +=
                                                    '<div class="space-y-2">';
                                                set_questions_options +=
                                                    '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                    get_option_number +
                                                    '" name="selected-option example-radios-default" checked value="' +
                                                    get_option_number +
                                                    '"><label class="form-check-label" for="' +
                                                    get_option_number + '">' +
                                                    get_option_number.toUpperCase() +
                                                    '. ' + val + '</label></div></div>'
                                            } else if (result.questions[0]
                                                .is_multiple_choice == 1) {
                                                set_questions_options +=
                                                    '<div class="space-y-2">';
                                                set_questions_options +=
                                                    '<div class="form-check"><input class="selected-option form-check-input" type="checkbox" id="' +
                                                    get_option_number +
                                                    '" name="example-checkbox-default" checked value="' +
                                                    get_option_number +
                                                    '"><label class="form-check-label" for="' +
                                                    get_option_number + '">' +
                                                    get_option_number.toUpperCase() +
                                                    '. ' + val + '</label></div></div>'
                                            } else if (result.questions[0]
                                                .is_multiple_choice == 2) {
                                                set_questions_options +=
                                                    '<div class="space-y-2"><input type="text" id="' +
                                                    get_option_number +
                                                    '" name="example-textbox-default" class="selected-option" value="' +
                                                    value + '" ></div>';
                                            } else {
                                                set_questions_options +=
                                                    '<div class="space-y-2">';
                                                set_questions_options +=
                                                    '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                                    get_option_number +
                                                    '" name="example-radios-default" checked value="' +
                                                    get_option_number +
                                                    '"><label class="form-check-label" for="' +
                                                    get_option_number + '">' +
                                                    get_option_number.toUpperCase() +
                                                    '. ' + val + '</label></div></div>'
                                            }
                                        }
                                    });
                                }
                            } else {
                                if (jQuery.type(result.questions[0].is_multiple_choice) ==
                                    'null') {
                                    let selectStr = '';
                                    if (existingProgress) {
                                        let progress_selected_ans_Array = JSON.parse(
                                            existingProgress.selected_answer);
                                        if (progress_selected_ans_Array?.[questionId] ===
                                            get_option_number) {
                                            selectStr = ' checked=checked ';
                                        }
                                    }

                                    set_questions_options += '<div class="space-y-2">';
                                    set_questions_options +=
                                        '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                        get_option_number +
                                        '" name="example-radios-default" value="' +
                                        get_option_number + '" ' + selectStr +
                                        '><label class="form-check-label" for="' +
                                        get_option_number + '">' + get_option_number
                                        .toUpperCase() + '. ' + val + '</label></div></div>'
                                } else if (result.questions[0].is_multiple_choice == 1) {
                                    let selectStr = '';
                                    if (existingProgress) {
                                        let progress_selected_ans_Array = JSON.parse(
                                            existingProgress.selected_answer);
                                        if (progress_selected_ans_Array?.[questionId] ===
                                            get_option_number) {
                                            selectStr = ' checked=checked ';
                                        }
                                    }
                                    set_questions_options += '<div class="space-y-2">';
                                    set_questions_options +=
                                        '<div class="form-check"><input class="selected-option form-check-input" type="checkbox" id="' +
                                        get_option_number +
                                        '" name="example-checkbox-default" value="' +
                                        get_option_number + '" ' + selectStr +
                                        '><label class="form-check-label" for="' +
                                        get_option_number + '">' + get_option_number
                                        .toUpperCase() + '. ' + val + '</label></div></div>'
                                } else if (result.questions[0].is_multiple_choice == 2) {
                                    set_questions_options +=
                                        '<div class="space-y-2"><input type="text" id="' +
                                        get_option_number +
                                        '" name="example-textbox-default" ></div>';
                                } else {
                                    let selectStr = '';
                                    if (existingProgress) {
                                        let progress_selected_ans_Array = JSON.parse(
                                            existingProgress.selected_answer);
                                        if (progress_selected_ans_Array?.[questionId] ===
                                            get_option_number) {
                                            selectStr = ' checked=checked ';
                                        }
                                    }
                                    set_questions_options += '<div class="space-y-2">';
                                    set_questions_options +=
                                        '<div class="form-check"><input class="selected-option form-check-input" type="radio" id="' +
                                        get_option_number +
                                        '" name="example-radios-default" value="' +
                                        get_option_number + '" ' + selectStr +
                                        '><label class="form-check-label" for="' +
                                        get_option_number + '">' + get_option_number
                                        .toUpperCase() + '. ' + val + '</label></div></div>'
                                }
                            }
                        });

                        set_questions_options += '</div>';

                        if (existingProgress?.flag) {
                            const flagArray = JSON.parse(existingProgress.flag);
                            // console.log('existingFlag = '+flagArray[questionId]);
                            if (flagArray[questionId] === 'yes') {
                                $('.flag').prop('checked', true);
                                $('.main_flag_section').css("color", "white");
                                $('.main_flag_section').css("background-color", "#dc2626");
                            } else {
                                $('.flag').prop('checked', false);
                                $('.main_flag_section').css("color", "#dc2626");
                                $('.main_flag_section').css("background-color", "white");
                            }
                        } else {
                            if (check_if_flag_selected === undefined || check_if_flag_selected ==
                                'no') {
                                $('.flag').prop('checked', false);
                                $('.main_flag_section').css("color", "#dc2626");
                                $('.main_flag_section').css("background-color", "white");
                            } else {
                                $('.flag').prop('checked', true);
                                $('.main_flag_section').css("color", "white");
                                $('.main_flag_section').css("background-color", "#dc2626");
                            }
                        }

                        if (existingProgress?.guess) {
                            const guessArray = JSON.parse(existingProgress.guess);
                            // console.log('existingGuess = '+guessArray[questionId]);
                            if (guessArray[questionId] === 'yes') {
                                $('.guess').prop('checked', true);
                                $('.main_guess_section').css("color", "white");
                                $('.main_guess_section').css("background-color", "#ea580c");
                            } else {
                                $('.guess').prop('checked', false);
                                $('.main_guess_section').css("color", "#ea580c");
                                $('.main_guess_section').css("background-color", "white");
                            }
                        } else {
                            if (check_if_guess_selected === undefined || check_if_guess_selected ==
                                'no') {
                                $('.guess').prop('checked', false);
                                $('.main_guess_section').css("color", "#ea580c");
                                $('.main_guess_section').css("background-color", "white");
                            } else {
                                $('.guess').prop('checked', true);
                                $('.main_guess_section').css("color", "white");
                                $('.main_guess_section').css("background-color", "#ea580c");
                            }
                        }

                        if (existingProgress?.skip) {
                            const skipArray = JSON.parse(existingProgress.skip);
                            // console.log('existingSkip = '+skipArray[questionId]);
                            if (skipArray[questionId] === 'yes') {
                                $('.skip').prop('checked', true);
                                $('.main_skip_section').css("color", "white");
                                $('.main_skip_section').css("background-color", "#ea580c");
                            } else {
                                $('.skip').prop('checked', false);
                                $('.main_skip_section').css("color", "#ea580c");
                                $('.main_skip_section').css("background-color", "white");
                            }
                        } else {
                            if (check_if_skip_selected === undefined || check_if_skip_selected ==
                                'no') {
                                $('.skip').prop('checked', false);
                                $('.main_skip_section').css("color", "#ea580c");
                                $('.main_skip_section').css("background-color", "white");
                            } else {
                                $('.skip').prop('checked', true);
                                $('.main_skip_section').css("color", "white");
                                $('.main_skip_section').css("background-color", "#ea580c");
                            }
                        }

                        jQuery('#set_question_data').html(set_questions_options);
                        jQuery('#passage_type').text(passage_type);
                        jQuery('#passage_title').text(passage_title);
                        // jQuery('#passage_description').text(passage_description);
                        $('#passage_description').html('');
                        $('#passage_description').append(passage_description);

                        // $editor.html(passage_description)
                        //         .attr('contenteditable', true)
                        //         .height($editor.height());



                        jQuery('#get_offset').val(result.get_offset);

                        if (result.set_prev_offset < 0) {
                            jQuery('#get_previous_question_btn').prop('disabled', true);
                            jQuery('.prev').prop('disabled', true);
                        } else {
                            jQuery('#get_previous_question_btn').prop('disabled', false);
                            jQuery('.prev').prop('disabled', false);
                        }

                        if (result.set_next_offset >= result.total_question) {
                            jQuery('#get_next_question_btn').prop('disabled', true);
                            // jQuery('#get_skip_question_btn').prop('disabled', true);

                            jQuery('.next').prop('disabled', true);
                            jQuery('.submit_section_btn').prop('disabled', false);
                            // jQuery('.skip').prop('disabled', true);
                        } else {
                            jQuery('#get_next_question_btn').prop('disabled', false);
                            // jQuery('#get_skip_question_btn').prop('disabled', false);

                            jQuery('.next').prop('disabled', false);
                            jQuery('.submit_section_btn').prop('disabled', false);
                            jQuery('.skip').prop('disabled', false);
                        }

                        jQuery('#get_next_question_btn').val(result.set_next_offset);
                        jQuery('.next').val(result.set_next_offset);
                        // jQuery('.skip').val(result.set_next_offset);

                        jQuery('#get_previous_question_btn').val(result.set_prev_offset);
                        jQuery('.prev').val(result.set_prev_offset);
                    }
                });
            }

            $(document).on('click', '.question-button', function() {
                var get_question_id = jQuery('.get_question_id').val();
                let data_count = jQuery(this).attr('data-count');
                data_count = parseInt(data_count);
                var get_offset = data_count;

                jQuery('.next').attr('data-count', data_count);
                jQuery('.prev').attr('data-count', data_count);

                let arr_index = data_count;
                $('#onload_question_id').val(question_id_arr[arr_index]);


                if ($("input[name='example-radios-default']").is(':checked')) {
                    var getSelectedAnswer = $("input[name='example-radios-default']:checked").val();
                    selected_answer[get_question_id] = getSelectedAnswer;
                } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                    var store_multi = '';
                    $('input[name="example-checkbox-default"]:checked').each(function() {
                        store_multi += this.value + ',';
                    });
                    store_multi = store_multi.replace(/,\s*$/, "");
                    selected_answer[get_question_id] = store_multi;
                } else if ($("input[name='example-textbox-default']")) {
                    store_multi = $("input[name='example-textbox-default']").val();
                    selected_answer[get_question_id] = store_multi;
                }

                if (!$(".guess").is(':checked')) {
                    selected_gusess_details[get_question_id] = 'no';
                }

                if (!$(".flag").is(':checked')) {
                    selected_flag_details[get_question_id] = 'no';
                }

                if (!$(".skip").is(':checked')) {
                    selected_skip_details[get_question_id] = 'no';
                }

                get_first_question(get_offset);

                var scroll_position = $('#passage_description').scrollTop();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ url('/user/set_scroll_position/post') }}",
                    method: 'post',
                    data: {
                        get_question_id: get_question_id,
                        scroll_position: scroll_position
                    },
                    success: function(result) {}
                });
                swal.close();
            });
        });

        function get_time() {
            let option = new URLSearchParams(window.location.search);
            let OptionValue = option.get('time');
            let section_id = $('#section_id').val();
            let question_type = $('#get_question_type').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('get_time') }}",
                method: 'post',
                data: {
                    'time': OptionValue,
                    'section_id': section_id,
                    question_type: question_type,
                },
                success: function(result) {
                    if (result.progressFlag) {
                        $('#time_selected').val(result.time_left);
                    } else {
                        if (OptionValue == 'regular') {
                            $('#time_selected').val(result.time.regular_time);
                        } else if (OptionValue == '50per') {
                            $('#time_selected').val(result.time.fifty_per_extended);
                        } else if (OptionValue == '100per') {
                            $('#time_selected').val(result.time.hundred_per_extended);
                        } else {
                            $('#time_selected').val('00:00:00');
                        }
                    }

                    var targetTime = $('#time_selected').val();
                    var parts = targetTime.split(':');
                    var targetHours = parseInt(parts[0], 10);
                    var targetMinutes = parseInt(parts[1], 10);
                    var targetSeconds = parseInt(parts[2], 10);
                    var targetMilliseconds = ((targetHours * 60 * 60) + (targetMinutes * 60) + targetSeconds) *
                        1000;

                    var hours = targetHours;
                    var minutes = targetMinutes;
                    var seconds = targetSeconds;
                    var elapsedMilliseconds = 0;

                    var actual_hours = 0;
                    var actual_minutes = 0;
                    var actual_seconds = 0;

                    //Array for progress saving Starts
                    var selected_answer = [];
                    var selected_gusess_details = [];
                    var selected_flag_details = [];
                    var selected_skip_details = [];
                    //Array for progress saving Ends
                    var get_test_id = '';
                    const urlParams = new URLSearchParams(window.location.search);
                    get_test_id = urlParams.get('test_id');

                    var timerInterval = setInterval(function() {
                        elapsedMilliseconds += 1000;

                        actual_hours = Math.floor(elapsedMilliseconds / (60 * 60 * 1000));
                        actual_minutes = Math.floor((elapsedMilliseconds % (60 * 60 * 1000)) / (60 *
                            1000));
                        actual_seconds = Math.floor((elapsedMilliseconds % (60 * 1000)) / 1000);

                        if (elapsedMilliseconds < targetMilliseconds && OptionValue != 'untimed') {
                            var remainingMilliseconds = targetMilliseconds - elapsedMilliseconds;
                            hours = Math.floor(remainingMilliseconds / (60 * 60 * 1000));
                            minutes = Math.floor((remainingMilliseconds % (60 * 60 * 1000)) / (60 *
                                1000));
                            seconds = Math.floor((remainingMilliseconds % (60 * 1000)) / 1000);
                        } else if (OptionValue == 'untimed') {
                            var remainingMilliseconds = targetMilliseconds + elapsedMilliseconds;
                            hours = Math.floor(remainingMilliseconds / (60 * 60 * 1000));
                            minutes = Math.floor((remainingMilliseconds % (60 * 60 * 1000)) / (60 *
                                1000));
                            seconds = Math.floor((remainingMilliseconds % (60 * 1000)) / 1000);
                        } else {
                            clearInterval(timerInterval);
                            hours = 0;
                            minutes = 0;
                            seconds = 0;
                        }

                        var formattedHours = hours.toString().padStart(2, '0');
                        var formattedMinutes = minutes.toString().padStart(2, '0');
                        var formattedSeconds = seconds.toString().padStart(2, '0');

                        var formattedActualHours = actual_hours.toString().padStart(2, '0');
                        var formattedActualMinutes = actual_minutes.toString().padStart(2, '0');
                        var formattedActualSeconds = actual_seconds.toString().padStart(2, '0');

                        $('#timer').text(formattedHours + ':' + formattedMinutes + ':' +
                            formattedSeconds);
                        $('#actual_time').val(formattedActualHours + ':' + formattedActualMinutes +
                            ':' + formattedActualSeconds);

                        if (OptionValue != 'untimed') {
                            if (hours === 0 && minutes === 5 && seconds === 0) {
                                swal({
                                    icon: 'warning',
                                    title: 'Time is elapsed!',
                                    text: 'You have 5 minutes remaining.',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                });
                            }

                            if (hours === 0 && minutes === 0 && seconds === 0) {
                                clearInterval(timerInterval);
                                swal({
                                    icon: 'warning',
                                    title: 'Time is over!',
                                    text: 'Your time has expired.',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Continue'
                                }, function(isConfirm) {
                                    $('#timeisover').val(1);
                                    if (isConfirm) {
                                        $('.submit_section_btn').trigger('click');
                                    }
                                });
                            }
                        }


                        //Progress Saving Starts
                        let progress_index = jQuery('.next').attr('data-count');
                        var get_question_id = jQuery('#onload_question_id').val();

                        let selected_flag_val;
                        if ($(".flag").is(':checked')) {
                            selected_flag_val = 'yes';
                        } else {
                            selected_flag_val = 'no';
                        }

                        let selected_skip_val;
                        if ($(".skip").is(':checked')) {
                            selected_skip_val = 'yes';
                        } else {
                            selected_skip_val = 'no';
                        }

                        let selected_guess_val;
                        if ($(".guess").is(':checked')) {
                            selected_guess_val = 'yes';
                        } else {
                            selected_guess_val = 'no';
                        }

                        var get_section_id = jQuery('#section_id').val();
                        var get_question_type = jQuery('#get_question_type').val();
                        var get_practice_id = jQuery(this).attr('data-practice_test_id');

                        let question_ids = @json($total_questions);
                        var actual_time = jQuery('#actual_time').val();

                        if ($("input[name='example-radios-default']").is(':checked')) {
                            var getSelectedAnswer = $("input[name='example-radios-default']:checked")
                                .val();
                            selected_answer[get_question_id] = getSelectedAnswer;
                        } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                            var store_multi = '';
                            $('input[name="example-checkbox-default"]:checked').each(function() {
                                store_multi += this.value + ',';
                            });
                            store_multi = store_multi.replace(/,\s*$/, "");
                            selected_answer[get_question_id] = store_multi;
                        } else if ($("input[name='example-textbox-default']")) {
                            store_multi = $("input[name='example-textbox-default']").val();
                            selected_answer[get_question_id] = store_multi;
                        } else {
                            selected_answer[get_question_id] = '-';
                        }

                        Array.prototype.associate = function(keys) {
                            var result = {};

                            this.forEach(function(el, i) {
                                result[keys[i]] = el;
                            });
                            return result;
                        };

                        let answer_details = [];
                        for (let index = 0; index < question_ids.length; index++) {
                            if (selected_answer.hasOwnProperty(question_ids[index])) {
                                answer_details[question_ids[index]] = selected_answer[question_ids[
                                    index]];
                            } else {
                                answer_details[question_ids[index]] = '-';
                            }
                        }

                        answer_details = answer_details.filter(function(element, key) {
                            return element !== 'undefined';
                        });

                        answer_details = answer_details.associate(question_ids);

                        {{-- $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        jQuery.ajax({
                            url: "{{ url('/user/test-progress/store') }}",
                            method: 'post',
                            data: {
                                selected_answer: answer_details,
                                selected_guess_val: selected_guess_val,
                                selected_flag_val: selected_flag_val,
                                selected_skip_val: selected_skip_val,
                                get_section_id: get_section_id,
                                get_practice_id: get_test_id,
                                get_question_type: get_question_type,
                                progress_index: progress_index,
                                curr_question_id: get_question_id,
                                actual_time: actual_time,
                                time_left: formattedHours + ':' + formattedMinutes + ':' +
                                    formattedSeconds
                            },
                            success: function(result) {

                                storedSelectedAnswers = result?.data?.selected_answer;
                                if (typeof result !== 'undefined' && result.message ===
                                    'delete') {
                                    clearInterval(timerInterval);
                                }
                            }
                        }); --}}
                        //Progress Saving Ends
                    }, 1000);
                }
            });
        }

        async function storeProgress() {
            console.log('start')
            let option = new URLSearchParams(window.location.search);
            let OptionValue = option.get('time');
            var targetTime = $('#time_selected').val();
            var parts = targetTime.split(':');
            var targetHours = parseInt(parts[0], 10);
            var targetMinutes = parseInt(parts[1], 10);
            var targetSeconds = parseInt(parts[2], 10);
            var targetMilliseconds = ((targetHours * 60 * 60) + (targetMinutes * 60) + targetSeconds) *
                1000;

            var hours = targetHours;
            var minutes = targetMinutes;
            var seconds = targetSeconds;
            var elapsedMilliseconds = 0;

            var actual_hours = 0;
            var actual_minutes = 0;
            var actual_seconds = 0;

            //Array for progress saving Starts
            var selected_answer = [];
            var selected_gusess_details = [];
            var selected_flag_details = [];
            var selected_skip_details = [];
            //Array for progress saving Ends
            var get_test_id = '';
            const urlParams = new URLSearchParams(window.location.search);
            get_test_id = urlParams.get('test_id');
            elapsedMilliseconds += 1000;
            actual_hours = Math.floor(elapsedMilliseconds / (60 * 60 * 1000));
            actual_minutes = Math.floor((elapsedMilliseconds % (60 * 60 * 1000)) / (60 *
                1000));
            actual_seconds = Math.floor((elapsedMilliseconds % (60 * 1000)) / 1000);

            if (elapsedMilliseconds < targetMilliseconds && OptionValue != 'untimed') {
                var remainingMilliseconds = targetMilliseconds - elapsedMilliseconds;
                hours = Math.floor(remainingMilliseconds / (60 * 60 * 1000));
                minutes = Math.floor((remainingMilliseconds % (60 * 60 * 1000)) / (60 *
                    1000));
                seconds = Math.floor((remainingMilliseconds % (60 * 1000)) / 1000);
            } else if (OptionValue == 'untimed') {
                var remainingMilliseconds = targetMilliseconds + elapsedMilliseconds;
                hours = Math.floor(remainingMilliseconds / (60 * 60 * 1000));
                minutes = Math.floor((remainingMilliseconds % (60 * 60 * 1000)) / (60 *
                    1000));
                seconds = Math.floor((remainingMilliseconds % (60 * 1000)) / 1000);
            } else {
                {{-- console.log(timerInterval)
                if(timerInterval != undefined){
                    clearInterval(timerInterval);
                } --}}
                hours = 0;
                minutes = 0;
                seconds = 0;
            }

            var formattedHours = hours.toString().padStart(2, '0');
            var formattedMinutes = minutes.toString().padStart(2, '0');
            var formattedSeconds = seconds.toString().padStart(2, '0');

            var formattedActualHours = actual_hours.toString().padStart(2, '0');
            var formattedActualMinutes = actual_minutes.toString().padStart(2, '0');
            var formattedActualSeconds = actual_seconds.toString().padStart(2, '0');
            //Progress Saving Starts
            let progress_index = jQuery('.next').attr('data-count');
            var get_question_id = jQuery('#onload_question_id').val();

            let selected_flag_val;
            if ($(".flag").is(':checked')) {
                selected_flag_val = 'yes';
            } else {
                selected_flag_val = 'no';
            }

            let selected_skip_val;
            if ($(".skip").is(':checked')) {
                selected_skip_val = 'yes';
            } else {
                selected_skip_val = 'no';
            }

            let selected_guess_val;
            if ($(".guess").is(':checked')) {
                selected_guess_val = 'yes';
            } else {
                selected_guess_val = 'no';
            }

            var get_section_id = jQuery('#section_id').val();
            var get_question_type = jQuery('#get_question_type').val();
            var get_practice_id = jQuery(this).attr('data-practice_test_id');

            let question_ids = @json($total_questions);
            var actual_time = jQuery('#actual_time').val();

            if ($("input[name='example-radios-default']").is(':checked')) {
                var getSelectedAnswer = $("input[name='example-radios-default']:checked")
                    .val();
                selected_answer[get_question_id] = getSelectedAnswer;
            } else if ($("input[name='example-checkbox-default']").is(':checked')) {
                var store_multi = '';
                $('input[name="example-checkbox-default"]:checked').each(function() {
                    store_multi += this.value + ',';
                });
                store_multi = store_multi.replace(/,\s*$/, "");
                selected_answer[get_question_id] = store_multi;
            } else if ($("input[name='example-textbox-default']")) {
                store_multi = $("input[name='example-textbox-default']").val();
                selected_answer[get_question_id] = store_multi;
            } else {
                selected_answer[get_question_id] = '-';
            }

            Array.prototype.associate = function(keys) {
                var result = {};

                this.forEach(function(el, i) {
                    result[keys[i]] = el;
                });
                return result;
            };

            let answer_details = [];
            for (let index = 0; index < question_ids.length; index++) {
                if (selected_answer.hasOwnProperty(question_ids[index])) {
                    answer_details[question_ids[index]] = selected_answer[question_ids[
                        index]];
                } else {
                    answer_details[question_ids[index]] = '-';
                }
            }

            answer_details = answer_details.filter(function(element, key) {
                return element !== 'undefined';
            });

            answer_details = answer_details.associate(question_ids);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            console.log(JSON.stringify({
                    selected_answer: answer_details,
                }));
            return jQuery.ajax({
                url: "{{ url('/user/test-progress/store') }}",
                method: 'post',
                data: {
                    selected_answer: answer_details,
                    selected_guess_val: selected_guess_val,
                    selected_flag_val: selected_flag_val,
                    selected_skip_val: selected_skip_val,
                    get_section_id: get_section_id,
                    get_practice_id: get_test_id,
                    get_question_type: get_question_type,
                    progress_index: progress_index,
                    curr_question_id: get_question_id,
                    actual_time: actual_time,
                    time_left: formattedHours + ':' + formattedMinutes + ':' +
                        formattedSeconds
                },
                success: function(result) {
                    console.log('end')
                    storedSelectedAnswers = result?.data?.selected_answer;
                }
            });
            //Progress Saving Ends
        }
    </script>
@endsection
