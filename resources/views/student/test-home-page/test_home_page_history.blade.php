
                                {{-- accordion-collapse 2 --}}
                                <div>

                                    <div class="accordion" id="accordionExampleThree">
                                        {{-- collaps 1 --}}
                                        <div class="accordion-item">
                                            <div class="border mb-3">
                                                <h2 class="accordion-header" id="headingOneHistory">
                                                    <button class="accordion-button border-0 fw-bold" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#tabOneHistory" aria-expanded="true"
                                                        aria-controls="tabOneHistory">
                                                        ACT
                                                    </button>
                                                </h2>
                                                <div id="tabOneHistory" class="accordion-collapse collapse "
                                                    aria-labelledby="headingOneHistory" data-bs-parent="#accordionExampleThree">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="block block-rounded border">
                                                                <div class="block-header block-header-default">
                                                                    <h3 class="block-title fw-bold ">ACT TEST HISTORY</h3>
                                                                    <button class="btn btn-success" id="sortable_act_1">Sort
                                                                        <i class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <div class="block-content py-0">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="act_table_1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        ACT English<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        ACT Math<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        ACT Reading<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        ACT Science<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($act_details_array as $act_test)
                                                                                    @if ($act_test['date_taken'] !== '-')
                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                <a
                                                                                                    href="{{ url('user/practice-test-sections/' . $act_test['test_id']) }}"><button
                                                                                                        class="btn btn-success d-block mb-2">{{ isset($act_test['test_name']) ? $act_test['test_name'] : '0' }}</button></a>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['English']) ? $act_test['English'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($act_test['English_actual_time']) && $act_test['English_actual_time'] !== '')
                                                                                                        ({{ $act_test['English_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $act_test['English_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['Math']) ? $act_test['Math'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($act_test['Math_actual_time']) && $act_test['Math_actual_time'] !== '')
                                                                                                        ({{ $act_test['Math_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $act_test['Math_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['Reading']) ? $act_test['Reading'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($act_test['Reading_actual_time']) && $act_test['Reading_actual_time'] !== '')
                                                                                                        ({{ $act_test['Reading_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $act_test['Reading_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['Science']) ? $act_test['Science'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($act_test['Science_actual_time']) && $act_test['Science_actual_time'] !== '')
                                                                                                        ({{ $act_test['Science_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $act_test['Science_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @php
                                                                                                    $total_score =
                                                                                                        (isset(
                                                                                                            $act_test[
                                                                                                                'English'
                                                                                                            ],
                                                                                                        )
                                                                                                            ? $act_test[
                                                                                                                'English'
                                                                                                            ]
                                                                                                            : '0') +
                                                                                                        (isset(
                                                                                                            $act_test[
                                                                                                                'Math'
                                                                                                            ],
                                                                                                        )
                                                                                                            ? $act_test[
                                                                                                                'Math'
                                                                                                            ]
                                                                                                            : '0') +
                                                                                                        (isset(
                                                                                                            $act_test[
                                                                                                                'Reading'
                                                                                                            ],
                                                                                                        )
                                                                                                            ? $act_test[
                                                                                                                'Reading'
                                                                                                            ]
                                                                                                            : '0') +
                                                                                                        (isset(
                                                                                                            $act_test[
                                                                                                                'Science'
                                                                                                            ],
                                                                                                        )
                                                                                                            ? $act_test[
                                                                                                                'Science'
                                                                                                            ]
                                                                                                            : '0');
                                                                                                @endphp
                                                                                                {{ number_format($total_score / ($act_test['section_count'] == 0 ? 1 : $act_test['section_count']), 0) }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['date_taken']) ? $act_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold ">ACT CUSTOM QUIZ
                                                                            HISTORY</h3>
                                                                        <button class="btn btn-success" id="sortable_act_2">Sort
                                                                            <i class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="act_table_2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Correct/Total</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Section</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Categories</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Question Types</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($act_custom_details as $getTest)
                                                                                    <tr>
                                                                                        <?php $url = url(
                                                                                            "user/practice-test-sections/" .
                                                                                                $getTest[
                                                                                                    "id"
                                                                                                ]
                                                                                        ); ?>
                                                                                        <td class="text-center">
                                                                                            <button
                                                                                                onclick="openTestSection(this)"
                                                                                                class="btn btn-success d-block mb-2 hover-btn button-text"
                                                                                                data-id="{{ $getTest['id'] }}"
                                                                                                data-url="<?php echo $url; ?>">
                                                                                                {{ $getTest['test_name'] }}

                                                                                            </button>
                                                                                        </td>
                                                                                        <td class="text-center">

                                                                                            @if (!@empty($getTest['total_question']))
                                                                                                {{ $getTest['right_question'] ?? 0 }}/{{ $getTest['total_question'] }}
                                                                                            @endif
                                                                                            @php
                                                                                                $sectionTypeActualTime =
                                                                                                    $getTest[
                                                                                                        $getTest[
                                                                                                            'section_type'
                                                                                                        ] .
                                                                                                            '_actual_time'
                                                                                                    ] ?? '';
                                                                                            @endphp
                                                                                            <br>
                                                                                            <span class="custom-actual-time">
                                                                                                @if ($sectionTypeActualTime !== '')
                                                                                                    ({{ $sectionTypeActualTime }})
                                                                                                @endif
                                                                                            </span>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['section_type'] }}
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['date_taken'] }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold ">ALL ACT TEST & QUIZ
                                                                            HISTORY</h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_act_3">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="act_table_3">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        ACT English<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        ACT Math<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        ACT Reading<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        ACT Science<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($all_act_details_array as $act_test)
                                                                                    @if ($act_test['date_taken'] !== '-')
                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                <a
                                                                                                    href="{{ url('user/practice-test-sections/' . $act_test['test_id']) }}"><button
                                                                                                        class="btn btn-success d-block mb-2">{{ $act_test['test_name'] }}</button></a>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['English']) ? $act_test['English'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($act_test['English_actual_time']) && $act_test['English_actual_time'] !== '')
                                                                                                        ({{ $act_test['English_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $act_test['English_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['Math']) ? $act_test['Math'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($act_test['Math_actual_time']) && $act_test['Math_actual_time'] !== '')
                                                                                                        ({{ $act_test['Math_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $act_test['Math_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['Reading']) ? $act_test['Reading'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($act_test['Reading_actual_time']) && $act_test['Reading_actual_time'] !== '')
                                                                                                        ({{ $act_test['Reading_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $act_test['Reading_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['Science']) ? $act_test['Science'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($act_test['Science_actual_time']) && $act_test['Science_actual_time'] !== '')
                                                                                                        ({{ $act_test['Science_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $act_test['Science_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ number_format(((isset($act_test['English']) ? $act_test['English'] : '0') + (isset($act_test['Math']) ? $act_test['Math'] : '0') + (isset($act_test['Reading']) ? $act_test['Reading'] : '0') + (isset($act_test['Science']) ? $act_test['Science'] : '0')) / ($act_test['section_count'] == 0 ? 1 : $act_test['section_count']), 0) }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($act_test['date_taken']) ? $act_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
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
                                        <div class="accordion-item">
                                            <div class="border mb-3">
                                                <h2 class="accordion-header" id="headingTwoHistory">
                                                    <button class="accordion-button collapsed border-0 fw-bold" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#tabTwoHistory"
                                                        aria-expanded="false" aria-controls="tabTwoHistory">
                                                        SAT
                                                    </button>
                                                </h2>
                                                <div id="tabTwoHistory" class="accordion-collapse collapse"
                                                    aria-labelledby="headingTwoHistory" data-bs-parent="#accordionExampleThree">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="block block-rounded border">
                                                                <div class="block-header block-header-default py-2">
                                                                    <h3 class="block-title fw-bold">SAT TEST HISTORY</h3>
                                                                    <button class="btn btn-success" id="sortable_sat_1">Sort
                                                                        <i class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <div class="block-content pt-0">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="sat_table_1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        SAT Reading<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        SAT Writing<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        SAT Math<span class="mt-2"> (Combined
                                                                                            Section 3 & 4)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($sat_details_array as $sat_test)
                                                                                    @if ($sat_test['date_taken'] !== '-')
                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                <a
                                                                                                    href="{{ url('user/practice-test-sections/' . $sat_test['test_id']) }}"><button
                                                                                                        class="btn btn-success d-block mb-2">{{ $sat_test['test_name'] }}</button></a>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($sat_test['Reading']) ? $sat_test['Reading'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($sat_test['Reading_actual_time']) && $sat_test['Reading_actual_time'] !== '')
                                                                                                        ({{ $sat_test['Reading_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $sat_test['Reading_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($sat_test['Writing']) ? $sat_test['Writing'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($sat_test['Writing_actual_time']) && $sat_test['Writing_actual_time'] !== '')
                                                                                                        ({{ $sat_test['Writing_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $sat_test['Writing_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{(isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0')}} --}}
                                                                                                {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @php
                                                                                                        $mathNoCalculatorActualTime =
                                                                                                            $sat_test[
                                                                                                                'Math_no_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $mathWithCalculatorActualTime =
                                                                                                            $sat_test[
                                                                                                                'Math_with_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $totalTime = addTimes(
                                                                                                            $mathNoCalculatorActualTime,
                                                                                                            $mathWithCalculatorActualTime,
                                                                                                        );
                                                                                                    @endphp

                                                                                                    @if ($totalTime !== '')
                                                                                                        ({{ $totalTime }})
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0)) }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($sat_test['date_taken']) ? $sat_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold">SAT CUSTOM QUIZ HISTORY
                                                                        </h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_sat_2">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="sat_table_2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Correct/Total</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Section</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Categories</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Question Types</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($sat_custom_details as $getTest)
                                                                                    <tr>
                                                                                        <?php $url = url(
                                                                                            "user/practice-test-sections/" .
                                                                                                $getTest[
                                                                                                    "id"
                                                                                                ]
                                                                                        ); ?>
                                                                                        <td class="text-center">
                                                                                            <button
                                                                                                onclick="openTestSection(this)"
                                                                                                class="btn btn-success d-block btn_{{ $getTest['id'] }} mb-2 hover-btn button-text"
                                                                                                data-id="{{ $getTest['id'] }}"
                                                                                                data-url="<?php echo $url; ?>">
                                                                                                {{ $getTest['test_name'] }}

                                                                                            </button>
                                                                                            <input type="text"
                                                                                                class="form-control input_{{ $getTest['id'] }}"
                                                                                                style="display: none"
                                                                                                value="{{ $getTest['test_name'] }}"
                                                                                                onblur="changeSectionName(this,{{ $getTest['id'] }})" />
                                                                                            <button
                                                                                                class="btn btn-transparent transparent-btn"
                                                                                                data-id="{{ $getTest['id'] }}"
                                                                                                onclick="editQuizName({{ $getTest['id'] }})">
                                                                                                <i class="fa fa-pencil"></i>
                                                                                            </button>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            @if (!@empty($getTest['total_question']))
                                                                                                {{ $getTest['right_question'] ?? 0 }}/{{ $getTest['total_question'] }}
                                                                                            @endif
                                                                                            @php
                                                                                                $sectionTypeActualTime =
                                                                                                    $getTest[
                                                                                                        $getTest[
                                                                                                            'section_type'
                                                                                                        ] .
                                                                                                            '_actual_time'
                                                                                                    ] ?? '';
                                                                                            @endphp
                                                                                            <br>
                                                                                            <span class="custom-actual-time">
                                                                                                @if ($sectionTypeActualTime !== '')
                                                                                                    ({{ $sectionTypeActualTime }})
                                                                                                @endif
                                                                                            </span>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['section_type'] }}
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['date_taken'] }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold">ALL SAT TEST & QUIZ
                                                                            HISTORY</h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_sat_3">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="sat_table_3">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        SAT Reading</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        SAT Writing</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        SAT Math<span class="mt-2"> (Combined
                                                                                            Section 3 & 4)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($all_sat_details_array as $sat_test)
                                                                                    @if ($sat_test['date_taken'] !== '-')
                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                <a
                                                                                                    href="{{ url('user/practice-test-sections/' . $sat_test['test_id']) }}"><button
                                                                                                        class="btn btn-success d-block mb-2">{{ $sat_test['test_name'] }}</button></a>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($sat_test['Reading']) ? $sat_test['Reading'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($sat_test['Reading_actual_time']) && $sat_test['Reading_actual_time'] !== '')
                                                                                                        ({{ $sat_test['Reading_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $sat_test['Reading_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($sat_test['Writing']) ? $sat_test['Writing'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($sat_test['Writing_actual_time']) && $sat_test['Writing_actual_time'] !== '')
                                                                                                        ({{ $sat_test['Writing_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $sat_test['Writing_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @php
                                                                                                        $mathNoCalculatorActualTime =
                                                                                                            $sat_test[
                                                                                                                'Math_no_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $mathWithCalculatorActualTime =
                                                                                                            $sat_test[
                                                                                                                'Math_with_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $totalTime = addTimes(
                                                                                                            $mathNoCalculatorActualTime,
                                                                                                            $mathWithCalculatorActualTime,
                                                                                                        );
                                                                                                    @endphp

                                                                                                    @if ($totalTime !== '')
                                                                                                        ({{ $totalTime }})
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0)) }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($sat_test['date_taken']) ? $sat_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
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

                                        <div class="accordion-item">
                                            <div class="border mb-3">
                                                <h2 class="accordion-header" id="headingOneHistory">
                                                    <button class="accordion-button border-0 fw-bold" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#tabThreeHistory"
                                                        aria-expanded="true" aria-controls="tabThreeHistory">
                                                        PSAT
                                                    </button>
                                                </h2>
                                                <div id="tabThreeHistory" class="accordion-collapse collapse "
                                                    aria-labelledby="headingOneHistory" data-bs-parent="#accordionExampleThree">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="block block-rounded border">
                                                                <div class="block-header block-header-default">
                                                                    <h3 class="block-title fw-bold ">PSAT TEST HISTORY</h3>
                                                                    <button class="btn btn-success" id="sortable_psat_1">Sort
                                                                        <i class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <div class="block-content py-0">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="psat_table_1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        PSAT Reading<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        PSAT Writing<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        PSAT Math<span class="mt-2">
                                                                                            (Combined
                                                                                            Section 3 & 4)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($psat_details_array as $psat_test)
                                                                                    @if ($psat_test['date_taken'] !== '-')
                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                <a
                                                                                                    href="{{ url('user/practice-test-sections/' . $psat_test['test_id']) }}"><button
                                                                                                        class="btn btn-success d-block mb-2">{{ $psat_test['test_name'] }}</button></a>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($psat_test['Reading']) ? $psat_test['Reading'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($psat_test['Reading_actual_time']) && $psat_test['Reading_actual_time'] !== '')
                                                                                                        ({{ $psat_test['Reading_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $psat_test['Reading_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($psat_test['Writing']) ? $psat_test['Writing'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($psat_test['Writing_actual_time']) && $psat_test['Writing_actual_time'] !== '')
                                                                                                        ({{ $psat_test['Writing_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $psat_test['Writing_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{(isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : '0') +  (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : '0')}} --}}
                                                                                                {{ isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0) }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @php
                                                                                                        $mathNoCalculatorActualTime =
                                                                                                            $psat_test[
                                                                                                                'Math_no_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $mathWithCalculatorActualTime =
                                                                                                            $psat_test[
                                                                                                                'Math_with_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $totalTime = addTimes(
                                                                                                            $mathNoCalculatorActualTime,
                                                                                                            $mathWithCalculatorActualTime,
                                                                                                        );
                                                                                                    @endphp

                                                                                                    @if ($totalTime !== '')
                                                                                                        ({{ $totalTime }})
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($psat_test['Reading']) ? $psat_test['Reading'] : '0') + (isset($psat_test['Writing']) ? $psat_test['Writing'] : '0') + (isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : '0') + (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                {{ (isset($psat_test['Reading']) ? $psat_test['Reading'] : '0') + (isset($psat_test['Writing']) ? $psat_test['Writing'] : '0') + (isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0)) }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($psat_test['date_taken']) ? $psat_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold ">PSAT CUSTOM QUIZ
                                                                            HISTORY</h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_psat_2">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="psat_table_2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Correct/Total</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Section</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Categories</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Question Types</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($psat_custom_details as $getTest)
                                                                                    <tr>
                                                                                        <?php $url = url(
                                                                                            "user/practice-test-sections/" .
                                                                                                $getTest[
                                                                                                    "id"
                                                                                                ]
                                                                                        ); ?>
                                                                                        <td class="text-center">
                                                                                            <button
                                                                                                onclick="openTestSection(this)"
                                                                                                class="btn btn-success d-block mb-2 hover-btn button-text"
                                                                                                data-id="{{ $getTest['id'] }}"
                                                                                                data-url="<?php echo $url; ?>">
                                                                                                {{ $getTest['test_name'] }}

                                                                                            </button>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            @if (!@empty($getTest['total_question']))
                                                                                                {{ $getTest['right_question'] ?? 0 }}/{{ $getTest['total_question'] }}
                                                                                            @endif
                                                                                            @php
                                                                                                $sectionTypeActualTime =
                                                                                                    $getTest[
                                                                                                        $getTest[
                                                                                                            'section_type'
                                                                                                        ] .
                                                                                                            '_actual_time'
                                                                                                    ] ?? '';
                                                                                            @endphp
                                                                                            <br>
                                                                                            <span class="custom-actual-time">
                                                                                                @if ($sectionTypeActualTime !== '')
                                                                                                    ({{ $sectionTypeActualTime }})
                                                                                                @endif
                                                                                            </span>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['section_type'] }}
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['date_taken'] }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold ">ALL PSAT TEST & QUIZ
                                                                            HISTORY</h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_psat_3">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="psat_table_3">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        PSAT Reading<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        PSAT Writing<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        PSAT Math<span class="mt-2">
                                                                                            (Combined
                                                                                            Section 3 & 4)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($all_psat_details_array as $psat_test)
                                                                                    @if ($psat_test['date_taken'] !== '-')
                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                <a
                                                                                                    href="{{ url('user/practice-test-sections/' . $psat_test['test_id']) }}"><button
                                                                                                        class="btn btn-success d-block mb-2">{{ isset($psat_test['test_name']) ? $psat_test['test_name'] : '-' }}</button></a>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($psat_test['Reading']) ? $psat_test['Reading'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($psat_test['Reading_actual_time']) && $psat_test['Reading_actual_time'] !== '')
                                                                                                        ({{ $psat_test['Reading_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $psat_test['Reading_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($psat_test['Writing']) ? $psat_test['Writing'] : '0' }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($psat_test['Writing_actual_time']) && $psat_test['Writing_actual_time'] !== '')
                                                                                                        ({{ $psat_test['Writing_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $psat_test['Writing_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : '0') + (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                {{ isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0) }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @php
                                                                                                        $mathNoCalculatorActualTime =
                                                                                                            $psat_test[
                                                                                                                'Math_no_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $mathWithCalculatorActualTime =
                                                                                                            $psat_test[
                                                                                                                'Math_with_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $totalTime = addTimes(
                                                                                                            $mathNoCalculatorActualTime,
                                                                                                            $mathWithCalculatorActualTime,
                                                                                                        );
                                                                                                    @endphp

                                                                                                    @if ($totalTime !== '')
                                                                                                        ({{ $totalTime }})
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($psat_test['Reading']) ? $psat_test['Reading'] : '0') + (isset($psat_test['Writing']) ? $psat_test['Writing'] : '0') + (isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : '0') + (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                {{ (isset($psat_test['Reading']) ? $psat_test['Reading'] : '0') + (isset($psat_test['Writing']) ? $psat_test['Writing'] : '0') + (isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0)) }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($psat_test['date_taken']) ? $psat_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
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

                                        <div class="accordion-item">
                                            <div class="border mb-3">
                                                <h2 class="accordion-header" id="headingOneHistory">
                                                    <button class="accordion-button border-0 fw-bold" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#tabFourHistory"
                                                        aria-expanded="true" aria-controls="tabFourHistory">
                                                        DSAT
                                                    </button>
                                                </h2>
                                                <div id="tabFourHistory" class="accordion-collapse collapse "
                                                    aria-labelledby="headingOneHistory" data-bs-parent="#accordionExampleFour">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="block block-rounded border">
                                                                <div class="block-header block-header-default">
                                                                    <h3 class="block-title fw-bold ">DSAT TEST HISTORY</h3>
                                                                    <button class="btn btn-success" id="sortable_psat_1">Sort
                                                                        <i class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <div class="block-content py-0">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="psat_table_1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DSAT Reading & Writing<span
                                                                                            class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DSAT Math<span class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    {{-- <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DSAT <span class="mt-2">
                                                                                            (Combined
                                                                                            Section 2 & 3)</span></th> --}}
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>

                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($dsat_details_array as $psat_test)
                                                                                    @if ($psat_test['date_taken'] !== '-')
                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                @if ($psat_test['is_proctored'] == 1)
                                                                                                    <a
                                                                                                        href="{{ url('user/practice-test-sections/' . $psat_test['test_id'] . '?test_section=proctored') }}"><button
                                                                                                            class="btn btn-success d-block mb-2">{{ $psat_test['test_name'] }}</button></a>
                                                                                                @else
                                                                                                    <a
                                                                                                        href="{{ url('user/practice-test-sections/' . $psat_test['test_id']) }}"><button
                                                                                                            class="btn btn-success d-block mb-2">{{ $psat_test['test_name'] }}</button></a>
                                                                                                @endif
                                                                                            </td>
                                                                                            <td class="text-center 1">
                                                                                                @php
                                                                                                    $test = \DB::table(
                                                                                                        'practice_tests',
                                                                                                    )
                                                                                                        ->where(
                                                                                                            'id',
                                                                                                            $psat_test[
                                                                                                                'test_id'
                                                                                                            ],
                                                                                                        )
                                                                                                        ->first();
                                                                                                @endphp
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['ReadSectionsScore']) ? $psat_test['ReadSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['reading_score']) ? $psat_test['reading_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($psat_test['ReadSectionsScore']) ? $psat_test['ReadSectionsScore'] : '0' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($psat_test['Reading_And_Writing_actual_time']) && $psat_test['Reading_And_Writing_actual_time'] !== '')
                                                                                                        ({{ $psat_test['Reading_And_Writing_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $psat_test['Reading_And_Writing_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center 2">
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['MathSectionsScore']) ? $psat_test['MathSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['math_score']) ? $psat_test['math_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($psat_test['MathSectionsScore']) ? $psat_test['MathSectionsScore'] : '0' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($psat_test['Math_actual_time']) && $psat_test['Math_actual_time'] !== '')
                                                                                                        ({{ $psat_test['Math_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $psat_test['Math_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            {{-- <td class="text-center 3">
                                                                                                {{ isset($psat_test['CompSectionsScore']) ? $psat_test['CompSectionsScore'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0) }}
                                                                                                <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @php
                                                                                                        $mathNoCalculatorActualTime = $psat_test['Math_no_calculator_actual_time'] ?? '';
                                                                                                        $mathWithCalculatorActualTime = $psat_test['Math_with_calculator_actual_time'] ?? '';
                                                                                                        $totalTime = addTimes($mathNoCalculatorActualTime, $mathWithCalculatorActualTime);
                                                                                                    @endphp

                                                                                                    @if ($totalTime !== '')
                                                                                                        ({{ $totalTime }})
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td> --}}
                                                                                            <td class="text-center">
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['CompSectionsScore']) ? $psat_test['CompSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['actual_total_score']) ? $psat_test['actual_total_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($psat_test['CompSectionsScore']) ? $psat_test['CompSectionsScore'] : '0' }}
                                                                                                @endif
                                                                                            </td>

                                                                                            <td class="text-center">
                                                                                                {{ isset($psat_test['date_taken']) ? $psat_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold">DSAT CUSTOM QUIZ
                                                                            HISTORY
                                                                        </h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_sat_2">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="sat_table_2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Correct/Total</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Section</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Categories</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Question Types</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($dsat_custom_details as $getTest)
                                                                                    <tr>
                                                                                        <?php $url = url(
                                                                                            "user/practice-test-sections/" .
                                                                                                $getTest[
                                                                                                    "id"
                                                                                                ]
                                                                                        ); ?>
                                                                                        <td class="text-center">
                                                                                            <button
                                                                                                onclick="openTestSection(this)"
                                                                                                class="btn btn-success d-block btn_{{ $getTest['id'] }} mb-2 hover-btn button-text"
                                                                                                data-id="{{ $getTest['id'] }}"
                                                                                                data-url="<?php echo $url; ?>">
                                                                                                {{ $getTest['test_name'] }}

                                                                                            </button>
                                                                                            <input type="text"
                                                                                                class="form-control input_{{ $getTest['id'] }}"
                                                                                                style="display: none"
                                                                                                value="{{ $getTest['test_name'] }}"
                                                                                                onblur="changeSectionName(this,{{ $getTest['id'] }})" />
                                                                                            <button
                                                                                                class="btn btn-transparent transparent-btn"
                                                                                                data-id="{{ $getTest['id'] }}"
                                                                                                onclick="editQuizName({{ $getTest['id'] }})">
                                                                                                <i class="fa fa-pencil"></i>
                                                                                            </button>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            @if (!@empty($getTest['total_question']))
                                                                                                {{ $getTest['right_question'] ?? 0 }}/{{ $getTest['total_question'] }}
                                                                                            @endif
                                                                                            @php
                                                                                                $sectionTypeActualTime =
                                                                                                    $getTest[
                                                                                                        $getTest[
                                                                                                            'section_type'
                                                                                                        ] .
                                                                                                            '_actual_time'
                                                                                                    ] ?? '';
                                                                                            @endphp
                                                                                            <br>
                                                                                            <span class="custom-actual-time">
                                                                                                @if ($sectionTypeActualTime !== '')
                                                                                                    ({{ $sectionTypeActualTime }})
                                                                                                @endif
                                                                                            </span>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['section_type'] }}
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['date_taken'] }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold">ALL DSAT TEST & QUIZ
                                                                            HISTORY</h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_sat_3">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="sat_table_3">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DSAT Reading</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DSAT Writing</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DSAT Math<span class="mt-2">
                                                                                            (Combined
                                                                                            Section 3 & 4)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>

                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($all_dsat_details_array as $sat_test)
                                                                                    @if ($sat_test['date_taken'] !== '-')
                                                                                        @php
                                                                                            $test = \DB::table(
                                                                                                'practice_tests',
                                                                                            )
                                                                                                ->where(
                                                                                                    'id',
                                                                                                    $sat_test[
                                                                                                        'test_id'
                                                                                                    ],
                                                                                                )
                                                                                                ->first();
                                                                                        @endphp
                                                                                        <tr>
                                                                                            <td class="text-center">

                                                                                                @if ($sat_test['is_proctored'] == 1)
                                                                                                    <a
                                                                                                        href="{{ url('user/practice-test-sections/' . $sat_test['test_id'] . '?test_section=proctored') }}"><button
                                                                                                            class="btn btn-success d-block mb-2">{{ $sat_test['test_name'] }}</button></a>
                                                                                                @else
                                                                                                    <a
                                                                                                        href="{{ url('user/practice-test-sections/' . $sat_test['test_id']) }}"><button
                                                                                                            class="btn btn-success d-block mb-2">{{ $sat_test['test_name'] }}</button></a>
                                                                                                @endif
                                                                                            </td>

                                                                                            <td class="text-center">
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['ReadSectionsScore']) ? $sat_test['ReadSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['reading_score']) ? $sat_test['reading_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($sat_test['ReadSectionsScore']) ? $sat_test['ReadSectionsScore'] : '0' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                {{-- {{ isset($sat_test['Reading']) ? $sat_test['Reading'] : '0' }}
                                                                                                <br> --}}
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($sat_test['Reading_actual_time']) && $sat_test['Reading_actual_time'] !== '')
                                                                                                        ({{ $sat_test['Reading_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $sat_test['Reading_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['ReadSectionsScore']) ? $sat_test['ReadSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['reading_score']) ? $sat_test['reading_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($sat_test['ReadSectionsScore']) ? $sat_test['ReadSectionsScore'] : '0' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                {{-- {{ isset($sat_test['Writing']) ? $sat_test['Writing'] : '0' }}
                                                                                                <br> --}}
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($sat_test['Writing_actual_time']) && $sat_test['Writing_actual_time'] !== '')
                                                                                                        ({{ $sat_test['Writing_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $sat_test['Writing_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">
                                                                                                            {{-- {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }}</span> --}}
                                                                                                            {{ isset($sat_test['MathSectionsScore']) ? $sat_test['MathSectionsScore'] : 0 }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['math_score']) ? $sat_test['math_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{-- {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }} --}}
                                                                                                    {{ isset($sat_test['MathSectionsScore']) ? $sat_test['MathSectionsScore'] : 0 }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                {{-- {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }} --}}
                                                                                                {{-- <br> --}}
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @php
                                                                                                        $mathNoCalculatorActualTime =
                                                                                                            $sat_test[
                                                                                                                'Math_no_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $mathWithCalculatorActualTime =
                                                                                                            $sat_test[
                                                                                                                'Math_with_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $totalTime = addTimes(
                                                                                                            $mathNoCalculatorActualTime,
                                                                                                            $mathWithCalculatorActualTime,
                                                                                                        );
                                                                                                    @endphp

                                                                                                    @if ($totalTime !== '')
                                                                                                        ({{ $totalTime }})
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">
                                                                                                            {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0)) }} --}}
                                                                                                            {{ isset($sat_test['CompSectionsScore']) ? $sat_test['CompSectionsScore'] : 0 }}
                                                                                                        </span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['actual_total_score']) ? $sat_test['actual_total_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0)) }} --}}
                                                                                                    {{ isset($sat_test['CompSectionsScore']) ? $sat_test['CompSectionsScore'] : 0 }}
                                                                                                @endif
                                                                                                {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0)) }} --}}
                                                                                            </td>

                                                                                            <td class="text-center">
                                                                                                {{ isset($sat_test['date_taken']) ? $sat_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
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

                                        <div class="accordion-item">
                                            <div class="border mb-3">
                                                <h2 class="accordion-header" id="headingOneHistory">
                                                    <button class="accordion-button border-0 fw-bold" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#tabFiveHistory"
                                                        aria-expanded="true" aria-controls="tabFiveHistory">
                                                        DPSAT
                                                    </button>
                                                </h2>
                                                <div id="tabFiveHistory" class="accordion-collapse collapse "
                                                    aria-labelledby="headingOneHistory" data-bs-parent="#accordionExampleFive">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="block block-rounded border">
                                                                <div class="block-header block-header-default">
                                                                    <h3 class="block-title fw-bold ">DPSAT TEST HISTORY</h3>
                                                                    <button class="btn btn-success" id="sortable_psat_1">Sort
                                                                        <i class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <div class="block-content py-0">
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="psat_table_1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DPSAT Reading & Writing<span
                                                                                            class="mt-2"> Score
                                                                                            (Timing)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DPSAT WriMathting<span class="mt-2">
                                                                                            Score
                                                                                            (Timing)</span></th>
                                                                                    {{-- <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        PSAT <span class="mt-2">
                                                                                            (Combined
                                                                                            Section 2 & 3)</span></th> --}}
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>

                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($dpsat_details_array as $psat_test)
                                                                                    @if ($psat_test['date_taken'] !== '-')
                                                                                        @php
                                                                                            $test = \DB::table(
                                                                                                'practice_tests',
                                                                                            )
                                                                                                ->where(
                                                                                                    'id',
                                                                                                    $psat_test[
                                                                                                        'test_id'
                                                                                                    ],
                                                                                                )
                                                                                                ->first();
                                                                                        @endphp
                                                                                        <tr>

                                                                                            <td class="text-center">
                                                                                                @if ($psat_test['is_proctored'] == 1)
                                                                                                    <a
                                                                                                        href="{{ url('user/practice-test-sections/' . $psat_test['test_id'] . '?test_section=proctored') }}"><button
                                                                                                            class="btn btn-success d-block mb-2">{{ $psat_test['test_name'] }}</button></a>
                                                                                                @else
                                                                                                    <a
                                                                                                        href="{{ url('user/practice-test-sections/' . $psat_test['test_id']) }}"><button
                                                                                                            class="btn btn-success d-block mb-2">{{ $psat_test['test_name'] }}</button></a>
                                                                                                @endif
                                                                                            </td>

                                                                                            <td class="text-center">
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['ReadSectionsScore']) ? $psat_test['ReadSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['reading_score']) ? $psat_test['reading_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($psat_test['ReadSectionsScore']) ? $psat_test['ReadSectionsScore'] : '0' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                {{-- {{ isset($psat_test['ReadSectionsScore']) ? $psat_test['ReadSectionsScore'] : '0' }}
                                                                                                <br> --}}
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($psat_test['Reading_And_Writing_actual_time']) && $psat_test['Reading_And_Writing_actual_time'] !== '')
                                                                                                        ({{ $psat_test['Reading_And_Writing_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $psat_test['Reading_And_Writing_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['MathSectionsScore']) ? $psat_test['MathSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['math_score']) ? $psat_test['math_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($psat_test['MathSectionsScore']) ? $psat_test['MathSectionsScore'] : '0' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                {{-- {{ isset($psat_test['MathSectionsScore']) ? $psat_test['MathSectionsScore'] : '0' }}
                                                                                                <br> --}}
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($psat_test['Math_actual_time']) && $psat_test['Math_actual_time'] !== '')
                                                                                                        ({{ $psat_test['Math_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $psat_test['Math_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            {{-- <td class="text-center"> --}}
                                                                                            {{-- {{(isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : '0') +  (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : '0')}} --}}
                                                                                            {{-- isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0) --}}
                                                                                            {{-- <br>
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @php
                                                                                                        $mathNoCalculatorActualTime = $psat_test['Math_no_calculator_actual_time'] ?? '';
                                                                                                        $mathWithCalculatorActualTime = $psat_test['Math_with_calculator_actual_time'] ?? '';
                                                                                                        $totalTime = addTimes($mathNoCalculatorActualTime, $mathWithCalculatorActualTime);
                                                                                                    @endphp

                                                                                                    @if ($totalTime !== '')
                                                                                                        ({{ $totalTime }})
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td> --}}
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($psat_test['Reading']) ? $psat_test['Reading'] : '0') + (isset($psat_test['Writing']) ? $psat_test['Writing'] : '0') + (isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : '0') + (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                {{-- (isset($psat_test['Reading']) ? $psat_test['Reading'] : '0') + (isset($psat_test['Writing']) ? $psat_test['Writing'] : '0') + (isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0)) --}}
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['CompSectionsScore']) ? $psat_test['CompSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($psat_test['actual_total_score']) ? $psat_test['actual_total_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($psat_test['CompSectionsScore']) ? $psat_test['CompSectionsScore'] : '0' }}
                                                                                                @endif
                                                                                                {{-- {{ isset($psat_test['CompSectionsScore']) ? $psat_test['CompSectionsScore'] : '0' }} --}}
                                                                                            </td>

                                                                                            <td class="text-center">
                                                                                                {{ isset($psat_test['date_taken']) ? $psat_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold">DPSAT CUSTOM QUIZ
                                                                            HISTORY
                                                                        </h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_sat_2">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="sat_table_2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Correct/Total</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Section</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Categories</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Question Types</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($dpsat_custom_details as $getTest)
                                                                                    <tr>
                                                                                        <?php $url = url(
                                                                                            "user/practice-test-sections/" .
                                                                                                $getTest[
                                                                                                    "id"
                                                                                                ]
                                                                                        ); ?>
                                                                                        <td class="text-center">
                                                                                            <button
                                                                                                onclick="openTestSection(this)"
                                                                                                class="btn btn-success d-block btn_{{ $getTest['id'] }} mb-2 hover-btn button-text"
                                                                                                data-id="{{ $getTest['id'] }}"
                                                                                                data-url="<?php echo $url; ?>">
                                                                                                {{ $getTest['test_name'] }}

                                                                                            </button>
                                                                                            <input type="text"
                                                                                                class="form-control input_{{ $getTest['id'] }}"
                                                                                                style="display: none"
                                                                                                value="{{ $getTest['test_name'] }}"
                                                                                                onblur="changeSectionName(this,{{ $getTest['id'] }})" />
                                                                                            <button
                                                                                                class="btn btn-transparent transparent-btn"
                                                                                                data-id="{{ $getTest['id'] }}"
                                                                                                onclick="editQuizName({{ $getTest['id'] }})">
                                                                                                <i class="fa fa-pencil"></i>
                                                                                            </button>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            @if (!@empty($getTest['total_question']))
                                                                                                {{ $getTest['right_question'] ?? 0 }}/{{ $getTest['total_question'] }}
                                                                                            @endif
                                                                                            @php
                                                                                                $sectionTypeActualTime =
                                                                                                    $getTest[
                                                                                                        $getTest[
                                                                                                            'section_type'
                                                                                                        ] .
                                                                                                            '_actual_time'
                                                                                                    ] ?? '';
                                                                                            @endphp
                                                                                            <br>
                                                                                            <span class="custom-actual-time">
                                                                                                @if ($sectionTypeActualTime !== '')
                                                                                                    ({{ $sectionTypeActualTime }})
                                                                                                @endif
                                                                                            </span>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['section_type'] }}
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            -
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            {{ $getTest['date_taken'] }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="block-header block-header-default px-0">
                                                                        <h3 class="block-title fw-bold">ALL DPSAT TEST & QUIZ
                                                                            HISTORY</h3>
                                                                        <button class="btn btn-success"
                                                                            id="sortable_sat_3">Sort <i
                                                                                class="fa-solid fa-angle-down"></i></button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-bordered table-striped table-vcenter"
                                                                            id="sat_table_3">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Test Form(Click “Button” below to
                                                                                        Review)
                                                                                    </th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DPSAT Reading</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DPSAT Writing</th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        DPSAT Math<span class="mt-2">
                                                                                            (Combined
                                                                                            Section 3 & 4)</span></th>
                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Composite <span>(Total) Score</span>
                                                                                    </th>

                                                                                    <th class="text-center"
                                                                                        style="width: 100px;">
                                                                                        Date Taken</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($all_dpsat_details_array as $sat_test)
                                                                                    @if ($sat_test['date_taken'] !== '-')
                                                                                        @php
                                                                                            $test = \DB::table(
                                                                                                'practice_tests',
                                                                                            )
                                                                                                ->where(
                                                                                                    'id',
                                                                                                    $sat_test[
                                                                                                        'test_id'
                                                                                                    ],
                                                                                                )
                                                                                                ->first();
                                                                                        @endphp
                                                                                        <tr>
                                                                                            <td class="text-center">

                                                                                                @if ($sat_test['is_proctored'] == 1)
                                                                                                    <a
                                                                                                        href="{{ url('user/practice-test-sections/' . $sat_test['test_id'] . '?test_section=proctored') }}"><button
                                                                                                            class="btn btn-success d-block mb-2">{{ $sat_test['test_name'] }}</button></a>
                                                                                                @else
                                                                                                    <a
                                                                                                        href="{{ url('user/practice-test-sections/' . $sat_test['test_id']) }}"><button
                                                                                                            class="btn btn-success d-block mb-2">{{ $sat_test['test_name'] }}</button></a>
                                                                                                @endif
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['ReadSectionsScore']) ? $sat_test['ReadSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['reading_score']) ? $sat_test['reading_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($sat_test['ReadSectionsScore']) ? $sat_test['ReadSectionsScore'] : '0' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                {{-- {{ isset($sat_test['Reading']) ? $sat_test['Reading'] : '0' }}
                                                                                                <br> --}}
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($sat_test['Reading_actual_time']) && $sat_test['Reading_actual_time'] !== '')
                                                                                                        ({{ $sat_test['Reading_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $sat_test['Reading_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['ReadSectionsScore']) ? $sat_test['ReadSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['reading_score']) ? $sat_test['reading_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{ isset($sat_test['ReadSectionsScore']) ? $sat_test['ReadSectionsScore'] : '0' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                {{-- {{ isset($sat_test['Writing']) ? $sat_test['Writing'] : '0' }}
                                                                                                <br> --}}
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @if (isset($sat_test['Writing_actual_time']) && $sat_test['Writing_actual_time'] !== '')
                                                                                                        ({{ $sat_test['Writing_actual_time'] }})
                                                                                                    @else
                                                                                                        {{ $sat_test['Writing_actual_time'] ?? '' }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0') }} --}}
                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        {{-- <span
                                                                                                            class="fw-normal">{{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }}</span> --}}
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['MathSectionsScore']) ? $sat_test['MathSectionsScore'] : 0 }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['reading_score']) ? $sat_test['reading_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{-- {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }} --}}
                                                                                                    {{ isset($sat_test['MathSectionsScore']) ? $sat_test['MathSectionsScore'] : 0 }}
                                                                                                    <br>
                                                                                                @endif
                                                                                                {{-- {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }}
                                                                                                <br> --}}
                                                                                                <span
                                                                                                    class="custom-actual-time">
                                                                                                    @php
                                                                                                        $mathNoCalculatorActualTime =
                                                                                                            $sat_test[
                                                                                                                'Math_no_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $mathWithCalculatorActualTime =
                                                                                                            $sat_test[
                                                                                                                'Math_with_calculator_actual_time'
                                                                                                            ] ?? '';
                                                                                                        $totalTime = addTimes(
                                                                                                            $mathNoCalculatorActualTime,
                                                                                                            $mathWithCalculatorActualTime,
                                                                                                        );
                                                                                                    @endphp

                                                                                                    @if ($totalTime !== '')
                                                                                                        ({{ $totalTime }})
                                                                                                    @endif
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0') }} --}}

                                                                                                @if ($test->test_source == 1)
                                                                                                    <p class="fw-bold">
                                                                                                        Estimated Score:
                                                                                                        {{-- <span
                                                                                                            class="fw-normal">
                                                                                                            {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0)) }}</span> --}}
                                                                                                        <span
                                                                                                            class="fw-normal">
                                                                                                            {{ isset($sat_test['CompSectionsScore']) ? $sat_test['CompSectionsScore'] : '0' }}</span>
                                                                                                    </p>
                                                                                                    <p class="fw-bold"> Actual
                                                                                                        Score:
                                                                                                        <span
                                                                                                            class="fw-normal">{{ isset($sat_test['actual_total_score']) ? $sat_test['actual_total_score'] : '0' }}</span>
                                                                                                    </p>
                                                                                                @else
                                                                                                    {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0)) }} --}}
                                                                                                    {{ isset($sat_test['CompSectionsScore']) ? $sat_test['CompSectionsScore'] : '0' }}
                                                                                                @endif
                                                                                                {{-- {{ (isset($sat_test['Reading']) ? $sat_test['Reading'] : '0') + (isset($sat_test['Writing']) ? $sat_test['Writing'] : '0') + (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0)) }} --}}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ isset($sat_test['date_taken']) ? $sat_test['date_taken'] : '-' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
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

                                    </div>
                                </div>
                           
                                @php
                                // Function to convert time string to seconds
                                function timeToSeconds($time)
                                {
                                    [$hours, $minutes, $seconds] = explode(':', $time);
                                    return $hours * 3600 + $minutes * 60 + $seconds;
                                }
                            
                                function addTimes($time1, $time2)
                                {
                                    // Convert time strings to seconds
                                    $seconds1 = $time1 !== '' ? timeToSeconds($time1) : 0;
                                    $seconds2 = $time2 !== '' ? timeToSeconds($time2) : 0;
                            
                                    // Case 1: If both values are empty strings, return an empty string
                                    if ($seconds1 === 0 && $seconds2 === 0) {
                                        return '';
                                    }
                            
                                    // Case 2: If one of the values is an empty string, return the non-empty value
                                    if ($seconds1 === 0 || $seconds2 === 0) {
                                        return $seconds1 !== 0 ? $time1 : $time2;
                                    }
                            
                                    // Add the time intervals
                                    $totalSeconds = $seconds1 + $seconds2;
                            
                                    // Convert the total seconds back to "H:i:s" format
                                    $totalTime = gmdate('H:i:s', $totalSeconds);
                            
                                    return $totalTime;
                                }
                            @endphp
