<div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
    {{-- Test review title  --}}
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2 w-75">
                        All Tests Insight Reports

                    </h1>

                    @if (!@empty($test_details))
                        <input type="hidden" id="test_type" name="test_type" value="{{ $test_details->format }}" />
                        <input type="hidden" id="test_id" name="test_id" value="{{ $test_details->id }}" />

                    @endempty

                    @php
                        // echo "<pre>";print_r($user_selected_answers);echo "</pre>";exit;
                    @endphp
                    @if (isset($user_selected_answers[0]['all_sections']) && !empty($user_selected_answers[0]['all_sections']))
                        {{-- <input type="hidden" id="practice_test_type" name="practice_test_type"
                                    value="{{ $user_selected_answers[0]['all_sections'][0]['practice_test_type'] }}" /> --}}
                        <input type="hidden" id="practice_test_type" name="practice_test_type"
                            value="{{ $user_selected_answers[0]['all_sections'][0]->practice_test_type }}" />
                    @endif
                    @if (isset($user_selected_answers[0]['sections']) && !empty($user_selected_answers[0]['sections']))
                        <input type="hidden" id="practice_test_type" name="practice_test_type"
                            value="{{ $user_selected_answers[0]['sections'][0]->practice_test_type }}" />
                    @endif
                    @if ($test_det == 'single')
                        <div class="d-flex align-items-center" style="overflow-wrap: break-word;">
                            <div class="description-test"
                                style="max-width: 100%; display: block; overflow-wrap: anywhere">
                                <h2 class="fs-base lh-base fw-bold mb-2 description-test-review text-muted">
                                    {!! isset($test_details->title) ? $test_details->title : '' !!}
                                </h2>
                                <h3 class="fs-base lh-base fw-medium mb-0 description-test-review text-muted">
                                    {!! isset($test_details->description) ? $test_details->description : '' !!}
                                </h3>
                            </div>
                            {{-- <div>
                                    <p class="ms-5 d-flex align-items-center mb-0 w-100">{{ isset($test_details->created_at) ? ' - '. date('F Y', strtotime($test_details->created_at)) : '' }}</p>
                                </div> --}}
                        </div>
                    @endif
            </div>

        </div>
    </div>
    {{-- END Test review title --}}

    {{-- <div>
                <div class="position-fixed" style="top: 10rem; right: 20px; z-index: 1000;">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-test_type_selection" class="btn btn-primary fs-xs fw-semibold generate_custom_quiz_two">Generate Custom Quiz</button>
                </div>
            </div> --}}
    <div class="mt-1">
        {{-- <ul class="nav nav-tabs col-12" role="tablist">
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
                                        {{ isset($test_details->title) ? $test_details->title : '' }}
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
                                    <p class="fw-semibold text-white mb-0">Mistake Summary</p>
                                    <p class="fs-sm text-white-75 mb-0">
                                        from your missed questions.
                                    </p>
                                </div>
                            </div>
                        </button>
                    </li>
                </ul> --}}
        <div class="block-content tab-content overflow-hidden">

            {{-- Category & Question Type Summary tab --}}
            <div class="" role="tabpanel" aria-labelledby="btabs-animated-fade-profile-tab" tabindex="0">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">(BEST SO FAR..) QUESTION TYPE CATEGORIZATION</h3>
                    </div>
                    <div class="block-content">

                        <div class="block-content p-0">
                            @if (isset($categoryAndQuestionTypeSummaryData) && !empty($categoryAndQuestionTypeSummaryData))
                                <div class="tab-content" id="myTabContent">
                                    @php
                                        $test = 0;
                                    @endphp
                                    <div class="setup-content" role="tabpanel" id="step1"
                                        aria-labelledby="step1-tab">
                                        <div class="accordion accordionExample">
                                            @foreach ($categoryAndQuestionTypeSummaryData as $categoryAndQuestionTypeSummary)
                                                @php
                                                    $category_arr = Helper::getCategoryNameByID(
                                                        $categoryAndQuestionTypeSummary['ct'],
                                                    );
                                                    // dd($category_arr);
                                                @endphp
                                                @if ($category_arr)
                                                    <div
                                                        class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab justify-content-start"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseOne_{{ $categoryAndQuestionTypeSummary['ct'] }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapseOne_{{ $categoryAndQuestionTypeSummary['ct'] }}">
                                                            <table style="width: 100%;">
                                                                <tr>
                                                                    <td class="text-center" style="width: 5%;">
                                                                        <i
                                                                            class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                                                    </td>
                                                                    <td class="pl-4" style="width: 90%;">
                                                                        <button type="button"
                                                                            class="btn btn-danger fs-xs fw-semibold me-1 js-bs-tooltip-enabled"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-trigger="click"
                                                                            data-bs-placement="top" title=""
                                                                            data-bs-original-title="Category Type">CT</button>
                                                                        <button type="button"
                                                                            data-bs-toggle="modal"
                                                                            {{-- data-question_desc="<?php $category_arr->category_type_description; ?>"
                                                                            data-question_title="<?php $category_arr->category_type_title; ?>"
                                                                            data-question_lesson="<?php $category_arr->category_type_lesson; ?>"
                                                                            data-question_strategies="<?php $category_arr->category_type_strategies; ?>"
                                                                            data-question_identification_methods="<?php $category_arr->category_type_identification_methods; ?>"
                                                                            data-question_identification_activity="<?php $category_arr->category_type_identification_activity; ?>" --}}
                                                                            data-bs-target="#modal-block-large-ct1_{{ $categoryAndQuestionTypeSummary['ct'] }}"
                                                                            class="btn btn-dark fs-xs fw-semibold me-1">{{ $category_arr->category_type_title }}</button>

                                                                        <!-- MODAL -->
                                                                        <div class="modal"
                                                                            id="modal-block-large-ct1_{{ $categoryAndQuestionTypeSummary['ct'] }}"
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
                                                                                                {{ isset($category_arr->category_type_title) ? $category_arr->category_type_title : '' }}
                                                                                            </h3>
                                                                                        </div>
                                                                                        <div class="block-content">
                                                                                            <p class="fs-sm mb-0">
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
                                                                                                        {!! isset($category_arr->category_type_description) ? $category_arr->category_type_description : '' !!}
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">
                                                                                                            Lesson
                                                                                                        </h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p class="set_category_type_lesson">
                                                                                                            {!! isset($category_arr->category_type_lesson) ? $category_arr->category_type_lesson : '' !!}
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">
                                                                                                            Strategies
                                                                                                        </h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p class="set_category_type_strategies">
                                                                                                            {!! isset($category_arr->category_type_strategies) ? $category_arr->catgeory_type_strategies : '' !!}
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">
                                                                                                            Identification Methods
                                                                                                        </h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p class="set_category_type_identification_methods">
                                                                                                            {!! isset($category_arr->category_type_identification_methods) ? $category_arr->category_type_identification_methods : '' !!}
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row items-push">
                                                                                                <div id="my-block" class="block block-rounded block-bordered p-0">
                                                                                                    <div class="block-header block-header-default">
                                                                                                        <h3 class="block-title">
                                                                                                            Identification Activity
                                                                                                        </h3>
                                                                                                        <div class="block-options">
                                                                                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="block-content">
                                                                                                        <p class="set_category_type_identification_activity">
                                                                                                            {!! isset($category_arr->category_type_identification_activity) ? $category_arr->category_type_identification_activity : '' !!}
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="block-content block-content-full text-end bg-body">
                                                                                            <button type="button"
                                                                                                class="btn btn-sm block-header-default text-white"
                                                                                                data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END MODAL -->
                                                                        @php
                                                                            $incorrect =
                                                                                $categoryAndQuestionTypeSummary[
                                                                                    'incorrect'
                                                                                ] ?? 0;
                                                                            $correct =
                                                                                $categoryAndQuestionTypeSummary[
                                                                                    'correct'
                                                                                ] ?? 0;
                                                                            $count =
                                                                                $categoryAndQuestionTypeSummary[
                                                                                    'count'
                                                                                ] ?? 0;
                                                                            $total_questions =
                                                                                $categoryAndQuestionTypeSummary[
                                                                                    'total_qts'
                                                                                ] ?? 0;
                                                                            $missed_ct =
                                                                                $categoryAndQuestionTypeSummary[
                                                                                    'missed'
                                                                                ] ?? 0;
                                                                            $percentage =
                                                                                ($incorrect /
                                                                                    $categoryAndQuestionTypeSummary[
                                                                                        'count'
                                                                                    ]) *
                                                                                100;
                                                                            $percentage = $percentage . '%';
                                                                            // dd(
                                                                            //     $categoryAndQuestionTypeSummary[
                                                                            //         'total_qts'
                                                                            //     ],
                                                                            // );
                                                                        @endphp
                                                                        <div class="row">
                                                                            <div class="col-md-12 text-center">
                                                                                <p class="block-title m-0">
                                                                                    Tested
                                                                                    on
                                                                                    @if ($test_det == 'single')
                                                                                        {{ $questionsCtPresent[$categoryAndQuestionTypeSummary['ct']] ?? 0 }}
                                                                                    @else
                                                                                        {{-- {{ $categoryAndQuestionTypeSummary['total_qts'] ?? 0 }} --}}
                                                                                        {{ $questionsCtPresent[$categoryAndQuestionTypeSummary['ct']] ?? 0 }}
                                                                                    @endif

                                                                                    questions
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="progress mt-2 {{ $percentage }}"
                                                                            style="background:#c4c5c7;height: 10px"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="{{ $percentage }}">
                                                                            <div class="progress-bar bg-info"
                                                                                style="width: {{ $percentage }}"
                                                                                role="progressbar"
                                                                                aria-valuenow="25"
                                                                                aria-valuemin="0"
                                                                                aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-3 justify-content-center align-items-center m-3">
                                                                            {{-- @if ($incorrect == 0)
                                                                                    <div
                                                                                        class="text-success text-center">
                                                                                        All Correct Answers,
                                                                                    </div>
                                                                                @else
                                                                                    <div
                                                                                        class="text-danger text-center">
                                                                                        {{ $incorrect }}
                                                                                        /
                                                                                        {{ $count }}
                                                                                        Questions missed,
                                                                                    </div>
                                                                                @endif --}}
                                                                            @if ($missed_ct !== $count)
                                                                                @if (
                                                                                    $categoryAndQuestionTypeSummary['total_incorrect_qts'] == 0 &&
                                                                                        $categoryAndQuestionTypeSummary['total_correct_qts'] == $categoryAndQuestionTypeSummary['total_qts']
                                                                                )
                                                                                    <div
                                                                                        class="text-success text-center">
                                                                                        All Question Types
                                                                                        Correct
                                                                                    </div>
                                                                                @else
                                                                                    <div
                                                                                        class="text-danger text-center">
                                                                                        {{ $categoryAndQuestionTypeSummary['total_incorrect_qts'] }}
                                                                                        /
                                                                                        {{ $categoryAndQuestionTypeSummary['total_qts'] }}
                                                                                        Incorrect Question Types
                                                                                    </div>
                                                                                @endif
                                                                            @endif

                                                                            @if ($missed_ct > 0)
                                                                                <div
                                                                                    class="text-danger text-center">
                                                                                    {{ $missed_ct }} /
                                                                                    {{ $count }}
                                                                                    Missed
                                                                                </div>
                                                                            @endif
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div id="collapseOne_{{ $categoryAndQuestionTypeSummary['ct'] }}"
                                                            class="collapse" aria-labelledby="headingOne"
                                                            data-parent=".accordionExample">
                                                            <div class="odd">
                                                                <div class="fw-semibold fs-sm">
                                                                    <div>
                                                                        <div>
                                                                            @php
                                                                                $qtArray = [];
                                                                                if (
                                                                                    !empty(
                                                                                        $categoryAndQuestionTypeSummary[
                                                                                            'qt'
                                                                                        ]
                                                                                    )
                                                                                ) {
                                                                                    $qtArray =
                                                                                        $categoryAndQuestionTypeSummary[
                                                                                            'qt'
                                                                                        ];
                                                                                    $keys = array_keys($qtArray);
                                                                                    array_multisort(
                                                                                        array_column(
                                                                                            $qtArray,
                                                                                            'incorrect',
                                                                                        ),
                                                                                        SORT_DESC,
                                                                                        SORT_NUMERIC,
                                                                                        $qtArray,
                                                                                        $keys,
                                                                                    );
                                                                                    $qtArray = array_combine(
                                                                                        $keys,
                                                                                        $qtArray,
                                                                                    );
                                                                                }
                                                                            @endphp

                                                                            @foreach ($qtArray as $qtDataKey => $qtData)
                                                                                @php
                                                                                    $question_arr = Helper::getQuestionNameByID(
                                                                                        $qtDataKey,
                                                                                    );
                                                                                    // dump($question_arr);
                                                                                    // dd($question_arr);
                                                                                @endphp
                                                                                <div class="odd p-3 ps-4">
                                                                                    <div></div>

                                                                                    <div class="fw-semibold fs-sm">
                                                                                        <button type="button"
                                                                                            class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-trigger="click"
                                                                                            data-bs-placement="top"
                                                                                            title=""
                                                                                            data-bs-original-title="Question Type">QT</button>
                                                                                        {{-- <button type="button"
                                                                                            data-bs-toggle="modal"
                                                                                            data-question_desc1="<?php //$question_arr->question_type_description ? $question_arr->question_type_description : '';
                                                                                            ?>"
                                                                                            data-question_desc="<?php if (isset($question_arr->question_type_description)) {
                                                                                                echo $question_arr->question_type_description;
                                                                                            } ?>"
                                                                                            data-question_title="<?php if (isset($question_arr->question_type_title)) {
                                                                                                echo $question_arr->question_type_title;
                                                                                            } ?>"
                                                                                            data-question_lesson="<?php if (isset($question_arr->question_type_lesson)) {
                                                                                                echo $question_arr->question_type_lesson;
                                                                                            } ?>"
                                                                                            data-question_strategies="<?php if (isset($question_arr->question_strategies)) {
                                                                                                echo $question_arr->question_strategies;
                                                                                            } ?>"
                                                                                            data-question_identification_methods="<?php if (isset($question_arr->question_type_identification_methods)) {
                                                                                                echo $question_arr->question_type_identification_methods;
                                                                                            } ?>"
                                                                                            data-question_type_identification_activity="<?php if (isset($question_arr->question_type_identification_activity)) {
                                                                                                echo $question_arr->question_type_identification_activity;
                                                                                            } ?>"
                                                                                            data-question_title1="<?php $question_arr->question_type_title;
                                                                                            ?>"
                                                                                            data-question_lesson1="<?php $question_arr->question_type_lesson;
                                                                                            ?>"
                                                                                            data-question_strategies1="<?php $question_arr->question_type_strategies;
                                                                                            ?>"
                                                                                            data-question_identification_methods1="<?php $question_arr->question_type_identification_methods;
                                                                                            ?>"
                                                                                            data-question_identification_activity1="<?php $question_arr->question_type_identification_activity;
                                                                                            ?>"
                                                                                            data-bs-target="#modal-block-large-cg1ct1_<?php echo $qtDataKey; ?>"
                                                                                            class="btn btn-dark fs-xs fw-semibold me-1 mb-3"><?php if (isset($question_arr->question_type_title)) {
                                                                                                echo $question_arr->question_type_title;
                                                                                            } ?></button> --}}
                                                                                        <button type="button"
                                                                                            data-bs-toggle="modal"
                                                                                            {{-- data-question_desc="{{ isset($question_arr->question_type_description) ? $question_arr->question_type_description : '' }}"
                                                                                            data-question_title="{{ isset($question_arr->question_type_title) ? $question_arr->question_type_title : '' }}"
                                                                                            data-question_lesson="{{ isset($question_arr->question_type_lesson) ? $question_arr->question_type_lesson : '' }}"
                                                                                            data-question_strategies="{{ isset($question_arr->question_strategies) ? $question_arr->question_strategies : '' }}"
                                                                                            data-question_identification_methods="{{ isset($question_arr->question_type_identification_methods) ? $question_arr->question_type_identification_methods : '' }}"
                                                                                            data-question_type_identification_activity="{{ isset($question_arr->question_type_identification_activity) ? $question_arr->question_type_identification_activity : '' }}" --}}
                                                                                            data-bs-target="#modal-block-large-cg1ct1_{{ $qtDataKey }}"
                                                                                            class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                                                                                            {{ isset($question_arr->question_type_title) ? $question_arr->question_type_title : '' }}
                                                                                        </button>
                                                                                        <!-- MODAL -->
                                                                                        <div class="modal"
                                                                                            id="modal-block-large-cg1ct1_{{ $qtDataKey }}"
                                                                                            tabindex="-1"
                                                                                            aria-labelledby="modal-block-large-cg1ct1"
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
                                                                                                                class="block-title">
                                                                                                                {{ isset($question_arr->question_type_title) ? $question_arr->question_type_title : '' }}
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
                                                                                                                        {!! isset($question_arr->question_type_description) ? $question_arr->question_type_description : '' !!}
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
                                                                                                                            {!! isset($question_arr->question_type_lesson) ? $question_arr->question_type_lesson : '' !!}
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
                                                                                                                            {!! isset($question_arr->question_type_strategies) ? $question_arr->question_type_strategies : '' !!}
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
                                                                                                                            {!! isset($question_arr->question_type_identification_methods)
                                                                                                                                ? $question_arr->question_type_identification_methods
                                                                                                                                : '' !!}
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
                                                                                                                            {!! isset($question_arr->question_type_identification_activity)
                                                                                                                                ? $question_arr->question_type_identification_activity
                                                                                                                                : '' !!}
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
                                                                                        <!-- END MODAL -->

                                                                                        @php
                                                                                            $incorrect =
                                                                                                $qtData['incorrect'] ??
                                                                                                0;
                                                                                            $correct =
                                                                                                $qtData['correct'] ?? 0;
                                                                                            $missed_qt =
                                                                                                $qtData['missed'] ?? 0;
                                                                                            $count =
                                                                                                $qtData['count'] ?? 0;
                                                                                            $percentage =
                                                                                                ($incorrect /
                                                                                                    $qtData['count']) *
                                                                                                100;
                                                                                            $percentage =
                                                                                                $percentage . '%';
                                                                                        @endphp

                                                                                        <div class="progress mt-2 {{ $percentage }}"
                                                                                            style="background:#c4c5c7;height: 10px"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="top"
                                                                                            title="{{ $percentage }}">
                                                                                            <div class="progress-bar bg-info"
                                                                                                style="width: {{ $percentage }}"
                                                                                                role="progressbar"
                                                                                                aria-valuenow="25"
                                                                                                aria-valuemin="0"
                                                                                                aria-valuemax="100">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="d-flex align-items-center justify-content-center gap-5">
                                                                                            @if ($count != $missed_qt)
                                                                                                {{-- @php
                                                                                                dump($incorrect);
                                                                                                dump($correct);
                                                                                                dump($count);
                                                                                            @endphp --}}
                                                                                                @if ($incorrect == 0 && $correct == $count)
                                                                                                    <div
                                                                                                        class="text-success text-center">
                                                                                                        All
                                                                                                        Correct
                                                                                                        Answers
                                                                                                    </div>
                                                                                                @else
                                                                                                    <div
                                                                                                        class="text-danger text-center">
                                                                                                        {{ $incorrect }}
                                                                                                        /
                                                                                                        {{ $count }}
                                                                                                        Incorrect
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endif

                                                                                            @if ($missed_qt > 0)
                                                                                                <div
                                                                                                    class="text-danger text-center">
                                                                                                    {{ $missed_qt }}
                                                                                                    /
                                                                                                    {{ $count }}
                                                                                                    Missed
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Answer Type Summary tab --}}

        </div>
    </div>


    </main>
    @include('user.test-review._test_type_selection_modal')


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
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    @section('page-script')
        {{-- <script>
            const GETTYPES_ROUTE = "{{ route('gettypes') }}";
            const GETSELFMADEQUESTION_ROUTE = "{{ route('getSelfMadeTestQuestion') }}";
            const ADD_MISTAKE_TYPE_ROUTE = "{{ route('addMistakeType') }}";
            const ADD_NOTES_ROUTE = "{{ route('addNotesToQuestionReview') }}";
        </script> --}}
        <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('js/test-review.js') }}"></script>
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

            function handleNotesChange(e, questionId) {
                console.log(e.value, questionId);
                const notes = e.value;
                $.ajax({
                    type: "POST",
                    url: ADD_NOTES_ROUTE,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: {
                        notes,
                        questionId,
                    },
                    success: function(res) {},
                });
            }

            function showLoaderAndOpenModal(questionId) {
                // Show the loader
                $('#loader').show();

                // Show the modal immediately
                $('#modal-block-large-q1r_' + questionId).modal('show');

                // Hide the loader (you may choose to hide it after a delay if needed)
                $('#loader').hide();
            }
        </script>
    @endsection
