@if (isset($categoryAndQuestionTypeSummaryDataMultiple) &&
        !empty($categoryAndQuestionTypeSummaryDataMultiple))
    <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
        <div class="accordion accordionExample">
            @foreach ($categoryAndQuestionTypeSummaryDataMultiple as $categoryAndQuestionTypeSummaryMultiple)
                @php
                    $category_arr = Helper::getCategoryNameByID($categoryAndQuestionTypeSummaryMultiple['ct']);
                    // dump($category_arr);
                @endphp
                @if ($category_arr)
                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                        <div class="block-header block-header-tab justify-content-start" type="button"
                            data-toggle="collapse"
                            data-target="#collapseOne_{{ $categoryAndQuestionTypeSummaryMultiple['ct'] }}"
                            aria-expanded="false"
                            aria-controls="collapseOne_{{ $categoryAndQuestionTypeSummaryMultiple['ct'] }}">
                            <table style="width: 100%;">
                                <tr>
                                    <td class="text-center" style="width: 5%;">
                                        <i class="fa fa-angle-right text-white me-2 accordian-icon"></i>
                                    </td>
                                    <td class="pl-4" style="width: 90%;">
                                        <button type="button"
                                            class="btn btn-danger fs-xs fw-semibold me-1 js-bs-tooltip-enabled"
                                            data-bs-toggle="tooltip" data-bs-trigger="click" data-bs-placement="top"
                                            title="" data-bs-original-title="Category Type">CT</button>
                                        <button type="button" data-bs-toggle="modal"
                                            data-question_desc="<?php $category_arr->category_type_description; ?>"
                                            data-question_title="<?php $category_arr->category_type_title; ?>"
                                            data-question_lesson="<?php $category_arr->category_type_lesson; ?>"
                                            data-question_strategies="<?php $category_arr->category_type_strategies; ?>"
                                            data-question_identification_methods="<?php $category_arr->category_type_identification_methods; ?>"
                                            data-question_identification_activity="<?php $category_arr->category_type_identification_activity; ?>"
                                            data-bs-target="#modal-block-large-ct1_{{ $categoryAndQuestionTypeSummaryMultiple['ct'] }}"
                                            class="btn btn-dark fs-xs fw-semibold me-1">{{ $category_arr->category_type_title }}</button>

                                        <!-- MODAL -->
                                        <div class="modal"
                                            id="modal-block-large-ct1_{{ $categoryAndQuestionTypeSummaryMultiple['ct'] }}"
                                            tabindex="-1" aria-labelledby="modal-block-large-ct1"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-rounded">
                                                        <div class="block-header block-header-default">
                                                            <h3 class="block-title set_category_title">
                                                                {{ isset($category_arr->category_type_title) ? $category_arr->category_type_title : '' }}
                                                            </h3>
                                                        </div>
                                                        <div class="block-content">
                                                            <p class="fs-sm mb-0">
                                                            </p>

                                                            <div class="row items-push">
                                                                <div id="my-block"
                                                                    class="block block-rounded block-bordered p-0">
                                                                    <div class="block-header block-header-default">
                                                                        <h3 class="block-title">
                                                                            Description
                                                                        </h3>
                                                                        <div class="block-options">
                                                                            <button type="button"
                                                                                class="btn-block-option"
                                                                                data-toggle="block-option"
                                                                                data-action="content_toggle"><i
                                                                                    class="si si-arrow-up"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="block-content">
                                                                        <p>
                                                                            {!! isset($category_arr->category_type_description) ? $category_arr->category_type_description : '' !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row items-push">
                                                                <div id="my-block"
                                                                    class="block block-rounded block-bordered p-0">
                                                                    <div class="block-header block-header-default">
                                                                        <h3 class="block-title">
                                                                            Lesson
                                                                        </h3>
                                                                        <div class="block-options">
                                                                            <button type="button"
                                                                                class="btn-block-option"
                                                                                data-toggle="block-option"
                                                                                data-action="content_toggle"><i
                                                                                    class="si si-arrow-up"></i></button>
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
                                                                <div id="my-block"
                                                                    class="block block-rounded block-bordered p-0">
                                                                    <div class="block-header block-header-default">
                                                                        <h3 class="block-title">
                                                                            Strategies
                                                                        </h3>
                                                                        <div class="block-options">
                                                                            <button type="button"
                                                                                class="btn-block-option"
                                                                                data-toggle="block-option"
                                                                                data-action="content_toggle"><i
                                                                                    class="si si-arrow-up"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="block-content">
                                                                        <p class="set_category_type_strategies">
                                                                            {!! isset($category_arr->category_type_strategies) ? $category_arr->category_type_strategies : '' !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row items-push">
                                                                <div id="my-block"
                                                                    class="block block-rounded block-bordered p-0">
                                                                    <div class="block-header block-header-default">
                                                                        <h3 class="block-title">
                                                                            Identification
                                                                            Methods
                                                                        </h3>
                                                                        <div class="block-options">
                                                                            <button type="button"
                                                                                class="btn-block-option"
                                                                                data-toggle="block-option"
                                                                                data-action="content_toggle"><i
                                                                                    class="si si-arrow-up"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="block-content">
                                                                        <p
                                                                            class="set_category_type_identification_methods">
                                                                            {!! isset($category_arr->category_type_identification_methods)
                                                                                ? $category_arr->category_type_identification_methods
                                                                                : '' !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row items-push">
                                                                <div id="my-block"
                                                                    class="block block-rounded block-bordered p-0">
                                                                    <div class="block-header block-header-default">
                                                                        <h3 class="block-title">
                                                                            Identification
                                                                            Activity
                                                                        </h3>
                                                                        <div class="block-options">
                                                                            <button type="button"
                                                                                class="btn-block-option"
                                                                                data-toggle="block-option"
                                                                                data-action="content_toggle"><i
                                                                                    class="si si-arrow-up"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="block-content">
                                                                        <p
                                                                            class="set_category_type_identification_activity">
                                                                            {!! isset($category_arr->category_type_identification_activity)
                                                                                ? $category_arr->category_type_identification_activity
                                                                                : '' !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="block-content block-content-full text-end bg-body">
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
                                            $incorrect_ct = $categoryAndQuestionTypeSummaryMultiple['incorrect'] ?? 0;
                                            $count = $categoryAndQuestionTypeSummaryMultiple['count'] ?? 0;
                                            $total_questions =
                                                $categoryAndQuestionTypeSummaryMultiple['total_qts'] ?? 0;
                                            $missed_ct = $categoryAndQuestionTypeSummaryMultiple['missed'] ?? 0;
                                            $percentage =
                                                (($incorrect_ct + $missed_ct) /
                                                    $categoryAndQuestionTypeSummaryMultiple['count']) *
                                                100;

                                            $percentage = $percentage . '%';
                                            $missedCounts = array_column(
                                                $categoryAndQuestionTypeSummaryMultiple['qt'],
                                                'missed',
                                            );
                                            $incorrectCounts = array_column(
                                                $categoryAndQuestionTypeSummaryMultiple['qt'],
                                                'incorrect',
                                            );
                                            $correctCounts = array_column(
                                                $categoryAndQuestionTypeSummaryMultiple['qt'],
                                                'correct',
                                            );
                                            $totalMissed = array_sum($missedCounts);
                                            $totalIncorrect = array_sum($incorrectCounts);
                                            $totalCorrect = array_sum($correctCounts);
                                            // dump($totalMissed);
                                            // dump($totalIncorrect);
                                            // dd($totalCorrect);
                                            // dd($categoryAndQuestionTypeSummaryMultiple);
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <p class="block-title m-0">
                                                    {{-- @if ($missed_ct > 0) --}}
                                                    {{-- Missed
                                                    on
                                                    {{ $incorrect_ct + $missed_ct }} /
                                                    {{ $questionsCtPresent[$categoryAndQuestionTypeSummaryMultiple['ct']] ?? 0 }}
                                                    questions --}}

                                                    Missed on
                                                    @foreach ($questionsCtPresent as $key => $question)
                                                        @if ($key == $categoryAndQuestionTypeSummaryMultiple['ct'])
                                                            {{ count($question['incorrect']) + count($question['missed']) }}
                                                            /
                                                            {{ $question['count'] ?? 0 }}
                                                            questions
                                                        @endif
                                                    @endforeach

                                                    {{-- @endif --}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="progress mt-2 {{ $percentage }}"
                                            style="background:#c4c5c7;height: 10px" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="{{ $percentage }}">
                                            <div class="progress-bar bg-info" style="width: {{ $percentage }}"
                                                role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 justify-content-center align-items-center m-3">
                                            {{-- @if ($incorrect_ct == 0)
                                    <div
                                        class="text-success text-center">
                                        All Correct Answers,
                                    </div>
                                @else
                                    <div
                                        class="text-danger text-center">
                                        {{ $incorrect_ct }}
                                        /
                                        {{ $count }}
                                        Questions missed,
                                    </div>
                                @endif --}}
                                            @if ($missed_ct !== $count)
                                                @if (
                                                    $categoryAndQuestionTypeSummaryMultiple['total_incorrect_qts'] == 0 &&
                                                        $categoryAndQuestionTypeSummaryMultiple['total_correct_qts'] ==
                                                            $categoryAndQuestionTypeSummaryMultiple['total_qts']
                                                )
                                                    <div class="text-success text-center">
                                                        All Question Types
                                                        Correct
                                                    </div>
                                                @elseif($missed_ct > 0)
                                                    <div class="text-danger text-center">
                                                        {{ $totalMissed + $totalIncorrect }}
                                                        /
                                                        {{ $totalMissed + $totalIncorrect + $totalCorrect }}
                                                        Incorrect Question Types
                                                    </div>
                                                @else
                                                    <div class="text-danger text-center">
                                                        {{ $categoryAndQuestionTypeSummaryMultiple['total_incorrect_qts'] }}
                                                        /
                                                        {{-- {{ $categoryAndQuestionTypeSummaryMultiple['total_qts'] }} --}}
                                                        {{-- {{ count($categoryAndQuestionTypeSummaryMultiple['qt']) }} --}}
                                                        {{ $totalMissed + $totalIncorrect + $totalCorrect }}
                                                        Incorrect Question Types
                                                    </div>
                                                @endif
                                            @elseif($missed_ct > 0)
                                                <div class="text-danger text-center">
                                                    {{ $totalMissed + $totalIncorrect }}
                                                    /
                                                    {{ $totalMissed + $totalIncorrect + $totalCorrect }}
                                                    Incorrect Question Types
                                                </div>
                                            @endif

                                            {{-- @if ($missed_ct > 0)
                                        <div
                                            class="text-danger text-center">
                                            {{ $missed_ct }} /
                                            {{ $questionsCtPresent[$categoryAndQuestionTypeSummaryMultiple['ct']] ?? 0 }}
                                            {{ $count }}
                                            Missed
                                        </div>
                                    @endif --}}
                                        </div>

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="collapseOne_{{ $categoryAndQuestionTypeSummaryMultiple['ct'] }}" class="collapse"
                            aria-labelledby="headingOne" data-parent=".accordionExample">
                            <div class="odd">
                                <div class="fw-semibold fs-sm">
                                    <div>
                                        <div>
                                            @php
                                                $qtArray = [];
                                                if (!empty($categoryAndQuestionTypeSummaryMultiple['qt'])) {
                                                    $qtArray = $categoryAndQuestionTypeSummaryMultiple['qt'];
                                                    $keys = array_keys($qtArray);
                                                    array_multisort(
                                                        array_column($qtArray, 'incorrect'),
                                                        SORT_DESC,
                                                        SORT_NUMERIC,
                                                        $qtArray,
                                                        $keys,
                                                    );
                                                    $qtArray = array_combine($keys, $qtArray);
                                                }
                                                // dd($qtArray);
                                            @endphp

                                            @foreach ($qtArray as $qtDataKey => $qtData)
                                                @php
                                                    $question_arr = Helper::getQuestionNameByID($qtDataKey);
                                                    // dd($question_arr);
                                                @endphp
                                                <div class="odd p-3 ps-4">
                                                    <div></div>

                                                    <div class="fw-semibold fs-sm">
                                                        <button type="button"
                                                            class="btn btn-warning fs-xs fw-semibold me-1 mb-3 js-bs-tooltip-enabled"
                                                            data-bs-toggle="tooltip" data-bs-trigger="click"
                                                            data-bs-placement="top" title=""
                                                            data-bs-original-title="Question Type">QT</button>

                                                        {{-- /* data-question_desc1="<?php //$question_arr->question_type_description ? $question_arr->question_type_description : '';
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
                                                    data-question_title1="<?php //$question_arr->question_type_title;
                                                    ?>"
                                                    data-question_lesson1="<?php //$question_arr->question_type_lesson;
                                                    ?>"
                                                    data-question_strategies1="<?php //$question_arr->question_type_strategies;
                                                    ?>"
                                                    data-question_identification_methods1="<?php //$question_arr->question_type_identification_methods;
                                                    ?>"
                                                    data-question_identification_activity1="<?php //$question_arr->question_type_identification_activity;
                                                    ?>" */ --}}



                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modal-block-large-cg1ct1_<?php echo $qtDataKey; ?>"
                                                            class="btn btn-dark fs-xs fw-semibold me-1 mb-3">
                                                            <?php if (isset($question_arr->question_type_title)) {
                                                                echo $question_arr->question_type_title;
                                                            } ?>

                                                        </button>
                                                        @php

                                                            $incorrect = $qtData['incorrect'] ?? 0;
                                                            $missed_qt = $qtData['missed'] ?? 0;
                                                            $count = $qtData['count'] ?? 0;
                                                            // $percentage =
                                                            //     (($incorrect ) /
                                                            //         $qtData[
                                                            //             'count'
                                                            //         ]) *
                                                            //     100;
                                                            $percentage =
                                                                (($incorrect + $missed_qt) /
                                                                    ($incorrect + $missed_qt + $qtData['correct'])) *
                                                                100;
                                                            $percentage = $percentage . '%';
                                                            // dump($qtData);
                                                        @endphp

                                                        <div class="progress mt-2 {{ $percentage }}"
                                                            style="background:#c4c5c7;height: 10px"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="{{ $percentage }}">
                                                            <div class="progress-bar bg-info"
                                                                style="width: {{ $percentage }}" role="progressbar"
                                                                aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center justify-content-center gap-5">
                                                            {{-- @if ($count != $missed_qt) --}}
                                                                {{-- @php
                                                            dump(
                                                                $incorrect
                                                            );
                                                            dump(
                                                                $qtData['correct']
                                                            );
                                                            dump(
                                                                $count
                                                            );
                                                        @endphp --}}
                                                                @if ($incorrect == 0 && $qtData['correct'] == $count)
                                                                    <div class="text-success text-center">
                                                                        All
                                                                        Correct
                                                                        Answers
                                                                    </div>
                                                                @else
                                                                    <div class="text-danger text-center">

                                                                        {{ $incorrect + $missed_qt }}
                                                                        /
                                                                        {{ $incorrect + $missed_qt + $qtData['correct'] }}
                                                                        {{-- {{$count}} --}}
                                                                        Incorrect
                                                                    </div>
                                                                @endif
                                                            {{-- @endif --}}

                                                            {{-- @if ($missed_qt > 0)
                                                        <div
                                                            class="text-danger text-center">
                                                            {{ $missed_qt }}
                                                            /
                                                            {{ $count }}
                                                            Missed
                                                        </div>
                                                    @endif --}}
                                                        </div>

                                                        <!-- MODAL -->
                                                        <div class="modal"
                                                            id="modal-block-large-cg1ct1_{{ $qtDataKey }}"
                                                            tabindex="-1" aria-labelledby="modal-block-large-cg1ct1"
                                                            style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="block block-rounded">
                                                                        <div class="block-header block-header-default">
                                                                            <h3 class="block-title">
                                                                                {{ isset($question_arr->question_type_title) ? $question_arr->question_type_title : '' }}

                                                                            </h3>
                                                                        </div>
                                                                        <div class="block-content">
                                                                            <p class="fs-sm mb-0">
                                                                            </p>

                                                                            <div class="row items-push">
                                                                                <div id="my-block"
                                                                                    class="block block-rounded block-bordered p-0">
                                                                                    <div
                                                                                        class="block-header block-header-default">
                                                                                        <h3 class="block-title">
                                                                                            Description
                                                                                        </h3>
                                                                                        <div class="block-options">
                                                                                            <button type="button"
                                                                                                class="btn-block-option"
                                                                                                data-toggle="block-option"
                                                                                                data-action="content_toggle"><i
                                                                                                    class="si si-arrow-up"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="block-content">
                                                                                        <p>
                                                                                            {!! isset($question_arr->question_type_description) ? $question_arr->question_type_description : '' !!}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row items-push">
                                                                                <div id="my-block"
                                                                                    class="block block-rounded block-bordered p-0">
                                                                                    <div
                                                                                        class="block-header block-header-default">
                                                                                        <h3 class="block-title">
                                                                                            Lesson
                                                                                        </h3>
                                                                                        <div class="block-options">
                                                                                            <button type="button"
                                                                                                class="btn-block-option"
                                                                                                data-toggle="block-option"
                                                                                                data-action="content_toggle"><i
                                                                                                    class="si si-arrow-up"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="block-content">
                                                                                        <p
                                                                                            class="set_category_type_lesson">
                                                                                            {!! isset($question_arr->question_type_lesson) ? $question_arr->question_type_lesson : '' !!}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row items-push">
                                                                                <div id="my-block"
                                                                                    class="block block-rounded block-bordered p-0">
                                                                                    <div
                                                                                        class="block-header block-header-default">
                                                                                        <h3 class="block-title">
                                                                                            Strategies
                                                                                        </h3>
                                                                                        <div class="block-options">
                                                                                            <button type="button"
                                                                                                class="btn-block-option"
                                                                                                data-toggle="block-option"
                                                                                                data-action="content_toggle"><i
                                                                                                    class="si si-arrow-up"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="block-content">
                                                                                        <p
                                                                                            class="set_category_type_strategies">
                                                                                            {!! isset($question_arr->question_type_strategies) ? $question_arr->question_type_strategies : '' !!}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row items-push">
                                                                                <div id="my-block"
                                                                                    class="block block-rounded block-bordered p-0">
                                                                                    <div
                                                                                        class="block-header block-header-default">
                                                                                        <h3 class="block-title">
                                                                                            Identification
                                                                                            Methods
                                                                                        </h3>
                                                                                        <div class="block-options">
                                                                                            <button type="button"
                                                                                                class="btn-block-option"
                                                                                                data-toggle="block-option"
                                                                                                data-action="content_toggle"><i
                                                                                                    class="si si-arrow-up"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="block-content">
                                                                                        <p
                                                                                            class="set_category_type_identification_methods">
                                                                                            {!! isset($question_arr->question_type_identification_methods)
                                                                                                ? $question_arr->question_type_identification_methods
                                                                                                : '' !!}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row items-push">
                                                                                <div id="my-block"
                                                                                    class="block block-rounded block-bordered p-0">
                                                                                    <div
                                                                                        class="block-header block-header-default">
                                                                                        <h3 class="block-title">
                                                                                            Identification
                                                                                            Activity
                                                                                        </h3>
                                                                                        <div class="block-options">
                                                                                            <button type="button"
                                                                                                class="btn-block-option"
                                                                                                data-toggle="block-option"
                                                                                                data-action="content_toggle"><i
                                                                                                    class="si si-arrow-up"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="block-content">
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
                                                                            <button type="button"
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
                @endif
            @endforeach


        </div>
    </div>
@endif
