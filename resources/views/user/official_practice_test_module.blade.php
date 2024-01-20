@extends('layouts.user')

@section('title', 'Official Practice Test : CPS')

@section('user-content')
    <meta name="_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .fa-circle-arrow-right {
            font-size: 22px;
            color: #87ceeb;
        }

        .ques {
            border: 1px solid black;
            padding: 10px 16px;
            margin-top: -1px;
            margin-left: -1px;
            text-align: center;
        }

        .space-y-2 {
            padding: 0px 0 0 9px;
        }

        .sweet-alert {
            width: 70% !important;
            transform: translate(-50%, -50%);
            margin-top: 0px !important;
            margin-left: 0px !important;
        }

        .sweet-alert p {
            height: 156px !important;
            overflow-y: auto !important;
        }

        .checkbox-button {
            appearance: none;
            background-color: transparent;
            /* border: 1px solid #000; */
            border-radius: 4px;
            box-sizing: border-box;
            display: inline-block;
            font-size: 16px;
            /* padding: 3px 8px; */
            position: relative;
            vertical-align: middle;
            /* border: solid #ea580c; */
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
    @php
        // dump($testSections);
        $getTestSection = $testSections->where('id', $sectionId)->first();
        // dd($getTestSection);
        if ($getTestSection->practice_test_type == 'Math') {
            $mareSections = $testSections->whereIn('practice_test_type', ['Math_no_calculator', 'Math_with_calculator']);
            // dd($mareSections);
        } elseif ($getTestSection->practice_test_type == 'Reading_And_Writing') {
            $mareSections = $testSections->whereIn('practice_test_type', ['Easy_Reading_And_Writing', 'Hard_Reading_And_Writing']);
            // dd($mareSections);
        } else {
        }
    @endphp

    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-boxed py-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        {{-- <li class="breadcrumb-item">
                    <a class="link-fx text-dark" href="{{ url('user/practice-test-sections/'.$section_id) }}">Practice Tests</a>
                </li> --}}
                        @php
                            $test_name = \DB::table('practice_tests')
                                ->where('id', $test_id)
                                ->value('title');
                        @endphp
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="{{ url('user/practice-test-sections/' . $test_id) }}">Official Released
                                Practice Test</a>
                            {{-- {{ isset($testSection[0]->section_title) ? $testSection[0]->section_title : '' }} {{ isset($testSection[0]->title) ? $testSection[0]->title : '' }} {{ isset($testSection[0]->id) ? '#'. $testSection[0]->id : '' }} --}}
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">{{ $test_name }}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Content -->
        <div class="content content-boxed content-height">
            <div class="row">
                <div class="col-xl-12"  style="border: 1px dashed black;
                padding: 21px;
                text-align: center;">
                    <h5>Select Delimiter</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <label class="form-check-label" for="easy">
                                    @php
                                        $easyDelimiter = $mareSections->where('easy_section_determiner', '!=', null);
                                    @endphp
                                    @if ($easyDelimiter)
                                        @foreach ($easyDelimiter as $easyDe)
                                            <input class="form-check-input" type="radio" name="easy_hard" id="easy"
                                                data-id={{ $easyDe->id }}>
                                            {{ $easyDe->easy_section_determiner }}
                                        @endforeach
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-check">
                                <label class="form-check-label" for="hard">
                                    @php
                                        $hardDelimiter = $mareSections->where('hard_section_determiner', '!=', null);
                                    @endphp
                                    @if ($hardDelimiter)
                                        @foreach ($hardDelimiter as $hardDe)
                                            <input class="form-check-input" type="radio" name="easy_hard" id="hard"
                                                data-id={{ $hardDe->id }}>

                                            {{ $hardDe->hard_section_determiner }}
                                        @endforeach
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        $(document).ready(function() {
            let test_id = {{ $test_id }};
            $('#easy').on('change', function() {
                if ($(this).is(':checked')) {
                    let sectionId = $(this).data('id');

                    jQuery.ajax({
                        url: "{{ route('get_official_tests') }}",
                        method: 'get',
                        data: {
                            'sectionId': sectionId,
                            'test_id': test_id,
                        },
                        success: function(result) {
                            console.log(result);
                            window.location.href = '/user/official-practice-test/' + result.data
                                .section_id + '?test_id=' + result.data.test_id +
                                '&time=regular';

                        }
                    });

                } else {
                    alert('is unchecked');
                }
            });

            $('#hard').on('change', function() {
                if ($(this).is(':checked')) {
                    let sectionId = $(this).data('id');

                    jQuery.ajax({
                        url: "{{ route('get_official_tests') }}",
                        method: 'get',
                        data: {
                            'sectionId': sectionId,
                            'test_id': test_id,
                        },
                        success: function(result) {
                            console.log(result);
                            window.location.href = '/user/official-practice-test/' + result.data
                                .section_id + '?test_id=' + result.data.test_id +
                                '&time=regular';

                        }
                    });
                } else {
                    alert('is unchecked');
                }
            });
        });
    </script>
@endsection
