@extends('layouts.user')

@section('title', 'Student View Dashboard : CPS')

@section('user-content')

    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>

                    <h1 class="h2 text-white mb-0">Test Prep Dashboard</h1>
                    <br>
                    <span class="text-white-75">ACT/SAT/PSAT</span>
                    <br>
                    <br>
                </div>
            </div>
            <div class="content">
                <div class="card p-3  col-lg-10 mx-lg-auto ">
                    <nav class="d-flex justify-content-center">
                        <div class="nav nav-tabs mb-3 btn-group" id="nav-tab" role="tablist">
                            <button class="btn nav-link active text-uppercase" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Available Tests</button>
                            <button class="btn nav-link text-uppercase" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">test,quiz & score history</button>
                        </div>
                    </nav>
                    <div class="tab-content p-3 " id="nav-tabContent">

                        {{-- tab 1 --}}
                        <div class="tab-pane fade  active show" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            {{-- accordion-collapse 1 --}}
                            <div>
                                <div class="accordion" id="accordionExample">
                                    {{-- collaps 1 --}}
                                    <div class="accordion-item">
                                        <div class="border mb-3">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button border-0 fw-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#tabOne" aria-expanded="true"
                                                    aria-controls="tabOne">
                                                    Official Released Practice Test
                                                </button>
                                            </h2>
                                            <div id="tabOne" class="accordion-collapse collapse "
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    {{-- tab accordion-collapse 1 --}}
                                                    <div>
                                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                            <div class="accordion-item">
                                                                <div class="border mb-2">
                                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                                        <button
                                                                            class="accordion-button collapsed border-0 fw-bold"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#tabChileOne"
                                                                            aria-expanded="false"
                                                                            aria-controls="tabChileOne">
                                                                            ACT
                                                                        </button>
                                                                    </h2>
                                                                    <div id="tabChileOne"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="flush-headingOne"
                                                                        data-bs-parent="#accordionFlushExample">
                                                                        <div class="accordion-body">
                                                                            @if (!$getOfficialPracticeTests['ACT']->isEmpty())
                                                                                @foreach ($getOfficialPracticeTests['ACT'] as $getOfficialPracticeTest)
                                                                                    @if ($getOfficialPracticeTest->format == 'ACT')
                                                                                        <a
                                                                                            href="{{ route('single_test', ['id' => $getOfficialPracticeTest->id]) }}"><button
                                                                                                class="btn btn-success d-block mb-2">Official
                                                                                                Released
                                                                                                {{ $getOfficialPracticeTest->title }}</button></a>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <span class="text-danger">No any pending
                                                                                    test!</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <div class="border mb-2">
                                                                    <h2 class="accordion-header" id="flush-headingTwo">
                                                                        <button
                                                                            class="accordion-button collapsed border-0 fw-bold"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#tabChiledTwo"
                                                                            aria-expanded="false"
                                                                            aria-controls="tabChiledTwo">
                                                                            SAT
                                                                        </button>
                                                                    </h2>
                                                                    <div id="tabChiledTwo"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="flush-headingTwo"
                                                                        data-bs-parent="#accordionFlushExample">
                                                                        <div class="accordion-body">
                                                                            @if (!$getOfficialPracticeTests['SAT']->isEmpty())
                                                                                @foreach ($getOfficialPracticeTests['SAT'] as $getOfficialPracticeTest)
                                                                                    @if ($getOfficialPracticeTest->format == 'SAT')
                                                                                        <a
                                                                                            href="{{ route('single_test', ['id' => $getOfficialPracticeTest->id]) }}"><button
                                                                                                class="btn btn-success d-block mb-2">Official
                                                                                                Released
                                                                                                {{ $getOfficialPracticeTest->title }}</button></a>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <span class="text-danger">No any pending
                                                                                    test!</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <div class="border mb-2">
                                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                                        <button
                                                                            class="accordion-button collapsed border-0 fw-bold"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#tabChiledThree"
                                                                            aria-expanded="false"
                                                                            aria-controls="tabChiledThree">
                                                                            PSAT
                                                                        </button>
                                                                    </h2>
                                                                    <div id="tabChiledThree"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="flush-headingThree"
                                                                        data-bs-parent="#accordionFlushExample">
                                                                        <div class="accordion-body">
                                                                            @if (!$getOfficialPracticeTests['PSAT']->isEmpty())
                                                                                @foreach ($getOfficialPracticeTests['PSAT'] as $getOfficialPracticeTest)
                                                                                    @if ($getOfficialPracticeTest->format == 'PSAT')
                                                                                        <a
                                                                                            href="{{ route('single_test', ['id' => $getOfficialPracticeTest->id]) }}"><button
                                                                                                class="btn btn-success d-block mb-2">Official
                                                                                                Released
                                                                                                {{ $getOfficialPracticeTest->title }}</button></a>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <span class="text-danger">No any pending
                                                                                    test!</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- collaps 2 --}}
                                    </div>
                                    <div class="accordion-item">
                                        <div class="border">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed border-0 fw-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    College Prep System Practice Test
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div>
                                                        <div class="accordion accordion-flush"
                                                            id="accordionFlushExampleTwo">
                                                            <div class="accordion-item">
                                                                <div class="border mb-2">
                                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                                        <button
                                                                            class="accordion-button collapsed border-0 fw-bold"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapsTabOne"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapsTabOne">
                                                                            ACT
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapsTabOne"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="flush-headingOne"
                                                                        data-bs-parent="#accordionFlushExampleTwo">
                                                                        <div class="accordion-body">
                                                                            @if (!$getAllPracticeTests['ACT']->isEmpty())
                                                                                @foreach ($getAllPracticeTests['ACT'] as $test)
                                                                                    @if ($test->format == 'ACT')
                                                                                        <a
                                                                                            href="{{ route('single_test', ['id' => $test->id]) }}"><button
                                                                                                class="btn btn-success d-block mb-2">College
                                                                                                Prep
                                                                                                {{ $test->title }}</button></a>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <span class="text-danger">No any pending
                                                                                    test!</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <div class="border mb-2">
                                                                    <h2 class="accordion-header" id="flush-headingTwo">
                                                                        <button
                                                                            class="accordion-button collapsed border-0 fw-bold"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapsTabTwo"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapsTabTwo">
                                                                            SAT
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapsTabTwo"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="flush-headingTwo"
                                                                        data-bs-parent="#accordionFlushExampleTwo">
                                                                        <div class="accordion-body">
                                                                            @if (!$getAllPracticeTests['SAT']->isEmpty())
                                                                                @foreach ($getAllPracticeTests['SAT'] as $test)
                                                                                    @if ($test->format == 'SAT')
                                                                                        <a
                                                                                            href="{{ route('single_test', ['id' => $test->id]) }}"><button
                                                                                                class="btn btn-success d-block mb-2">College
                                                                                                Prep
                                                                                                {{ $test->title }}</button></a>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <span class="text-danger">No any pending
                                                                                    test!</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <div class="border mb-2">
                                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                                        <button
                                                                            class="accordion-button collapsed border-0 fw-bold"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapsTabThree"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapsTabThree">
                                                                            PSAT
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapsTabThree"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="flush-headingThree"
                                                                        data-bs-parent="#accordionFlushExampleTwo">
                                                                        <div class="accordion-body">
                                                                            @if (!$getAllPracticeTests['PSAT']->isEmpty())
                                                                                @foreach ($getAllPracticeTests['PSAT'] as $test)
                                                                                    @if ($test->format == 'PSAT')
                                                                                        <a
                                                                                            href="{{ route('single_test', ['id' => $test->id]) }}"><button
                                                                                                class="btn btn-success d-block mb-2">College
                                                                                                Prep
                                                                                                {{ $test->title }}</button></a>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <span class="text-danger">No any pending
                                                                                    test!</span>
                                                                            @endif
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

                                </div>
                            </div>
                        </div>


                        {{-- tab 2 --}}
                        <div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            {{-- accordion-collapse 2 --}}
                            <div>
                                <div class="accordion" id="accordionExampleThree">
                                    {{-- collaps 1 --}}
                                    <div class="accordion-item">
                                        <div class="border mb-3">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button border-0 fw-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#tabOne"
                                                    aria-expanded="true" aria-controls="tabOne">
                                                    ACT
                                                </button>
                                            </h2>
                                            <div id="tabOne" class="accordion-collapse collapse "
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExampleThree">
                                                <div class="accordion-body">
                                                    <div>
                                                        <div class="block block-rounded border">
                                                            <div class="block-header block-header-default">
                                                                <h3 class="block-title fw-bold ">ACT TEST HISTORY</h3>
                                                                <button class="btn btn-success" id="sortable_act_1">Sort
                                                                    <i class="fa-solid fa-angle-down"></i></button>
                                                            </div>
                                                            <div class="block-content py-0">
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="act_table_1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                ACT English<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                ACT Math<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                ACT Reading<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                ACT Science<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Composite <span>(Total) Score</span></th>
                                                                            <th class="text-center" style="width: 100px;">
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
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($act_test['Math']) ? $act_test['Math'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($act_test['Reading']) ? $act_test['Reading'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($act_test['Science']) ? $act_test['Science'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        @php
                                                                                            $total_score = (isset($act_test['English']) ? $act_test['English'] : '0') + (isset($act_test['Math']) ? $act_test['Math'] : '0') + (isset($act_test['Reading']) ? $act_test['Reading'] : '0') + (isset($act_test['Science']) ? $act_test['Science'] : '0');
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
                                                                <div class="block-header block-header-default px-0">
                                                                    <h3 class="block-title fw-bold ">ACT CUSTOM QUIZ
                                                                        HISTORY</h3>
                                                                    <button class="btn btn-success"
                                                                        id="sortable_act_2">Sort <i
                                                                            class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="act_table_2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Correct/Total</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Section</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Categories</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Question Types</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Date Taken</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($act_custom_details as $getTest)
                                                                            <tr>
                                                                                <?php $url = url('user/practice-test-sections/' . $getTest['id']); ?>
                                                                                <td class="text-center">
                                                                                    <button onclick="openTestSection(this)"
                                                                                        class="btn btn-success d-block mb-2 hover-btn button-text"
                                                                                        data-id="{{ $getTest['id'] }}"
                                                                                        data-url="<?php echo $url; ?>">
                                                                                        {{ $getTest['test_name'] }}

                                                                                    </button>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{ $getTest['right_question'] }}/{{ $getTest['total_question'] }}
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
                                                                <div class="block-header block-header-default px-0">
                                                                    <h3 class="block-title fw-bold ">ALL ACT TEST & QUIZ
                                                                        HISTORY</h3>
                                                                    <button class="btn btn-success"
                                                                        id="sortable_act_3">Sort <i
                                                                            class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="act_table_3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                ACT English<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                ACT Math<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                ACT Reading<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                ACT Science<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Composite <span>(Total) Score</span></th>
                                                                            <th class="text-center" style="width: 100px;">
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
                                                                                                class="btn btn-success d-block mb-2">{{ $act_test['test_name'] }}</button></a>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($act_test['English']) ? $act_test['English'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($act_test['Math']) ? $act_test['Math'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($act_test['Reading']) ? $act_test['Reading'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($act_test['Science']) ? $act_test['Science'] : '0' }}
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
                                    <div class="accordion-item">
                                        <div class="border mb-3">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed border-0 fw-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#tabTwo"
                                                    aria-expanded="false" aria-controls="tabTwo">
                                                    SAT
                                                </button>
                                            </h2>
                                            <div id="tabTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExampleThree">
                                                <div class="accordion-body">
                                                    <div>
                                                        <div class="block block-rounded border">
                                                            <div class="block-header block-header-default py-2">
                                                                <h3 class="block-title fw-bold">SAT TEST HISTORY</h3>
                                                                <button class="btn btn-success" id="sortable_sat_1">Sort
                                                                    <i class="fa-solid fa-angle-down"></i></button>
                                                            </div>
                                                            <div class="block-content pt-0">
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="sat_table_1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                SAT Reading<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                SAT Writing<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                SAT Math<span class="mt-2"> (Combined
                                                                                    Section 3 & 4)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Composite <span>(Total) Score</span></th>
                                                                            <th class="text-center" style="width: 100px;">
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
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($sat_test['Writing']) ? $sat_test['Writing'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{-- {{(isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0')}} --}}
                                                                                        {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }}
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
                                                                <div class="block-header block-header-default px-0">
                                                                    <h3 class="block-title fw-bold">SAT CUSTOM QUIZ HISTORY
                                                                    </h3>
                                                                    <button class="btn btn-success"
                                                                        id="sortable_sat_2">Sort <i
                                                                            class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="sat_table_2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Correct/Total</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Section</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Categories</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Question Types</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Date Taken</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($sat_custom_details as $getTest)
                                                                            <tr>
                                                                                <?php $url = url('user/practice-test-sections/' . $getTest['id']); ?>
                                                                                <td class="text-center">
                                                                                    <button onclick="openTestSection(this)"
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
                                                                                    {{ $getTest['right_question'] }}/{{ $getTest['total_question'] }}
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
                                                                <div class="block-header block-header-default px-0">
                                                                    <h3 class="block-title fw-bold">ALL SAT TEST & QUIZ
                                                                        HISTORY</h3>
                                                                    <button class="btn btn-success"
                                                                        id="sortable_sat_3">Sort <i
                                                                            class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="sat_table_3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                SAT Reading</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                SAT Writing</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                SAT Math<span class="mt-2"> (Combined
                                                                                    Section 3 & 4)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Composite <span>(Total) Score</span></th>
                                                                            <th class="text-center" style="width: 100px;">
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
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($sat_test['Writing']) ? $sat_test['Writing'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{-- {{ (isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : '0') + (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : '0') }} --}}
                                                                                        {{ isset($sat_test['Math_no_calculator']) ? $sat_test['Math_no_calculator'] : (isset($sat_test['Math_with_calculator']) ? $sat_test['Math_with_calculator'] : 0) }}
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

                                    <div class="accordion-item">
                                        <div class="border mb-3">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button border-0 fw-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#tabThree"
                                                    aria-expanded="true" aria-controls="tabThree">
                                                    PSAT
                                                </button>
                                            </h2>
                                            <div id="tabThree" class="accordion-collapse collapse "
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExampleThree">
                                                <div class="accordion-body">
                                                    <div>
                                                        <div class="block block-rounded border">
                                                            <div class="block-header block-header-default">
                                                                <h3 class="block-title fw-bold ">PSAT TEST HISTORY</h3>
                                                                <button class="btn btn-success" id="sortable_psat_1">Sort
                                                                    <i class="fa-solid fa-angle-down"></i></button>
                                                            </div>
                                                            <div class="block-content py-0">
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="psat_table_1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                PSAT Reading<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                PSAT Writing<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                PSAT Math<span class="mt-2"> (Combined
                                                                                    Section 3 & 4)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Composite <span>(Total) Score</span></th>
                                                                            <th class="text-center" style="width: 100px;">
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
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($psat_test['Writing']) ? $psat_test['Writing'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{-- {{(isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : '0') +  (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : '0')}} --}}
                                                                                        {{ isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0) }}
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
                                                                <div class="block-header block-header-default px-0">
                                                                    <h3 class="block-title fw-bold ">PSAT CUSTOM QUIZ
                                                                        HISTORY</h3>
                                                                    <button class="btn btn-success"
                                                                        id="sortable_psat_2">Sort <i
                                                                            class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="psat_table_2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Correct/Total</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Section</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Categories</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Question Types</th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Date Taken</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($psat_custom_details as $getTest)
                                                                            <tr>
                                                                                <?php $url = url('user/practice-test-sections/' . $getTest['id']); ?>
                                                                                <td class="text-center">
                                                                                    <button onclick="openTestSection(this)"
                                                                                        class="btn btn-success d-block mb-2 hover-btn button-text"
                                                                                        data-id="{{ $getTest['id'] }}"
                                                                                        data-url="<?php echo $url; ?>">
                                                                                        {{ $getTest['test_name'] }}

                                                                                    </button>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{ $getTest['right_question'] }}/{{ $getTest['total_question'] }}
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
                                                                <div class="block-header block-header-default px-0">
                                                                    <h3 class="block-title fw-bold ">ALL PSAT TEST & QUIZ
                                                                        HISTORY</h3>
                                                                    <button class="btn btn-success"
                                                                        id="sortable_psat_3">Sort <i
                                                                            class="fa-solid fa-angle-down"></i></button>
                                                                </div>
                                                                <table
                                                                    class="table table-bordered table-striped table-vcenter"
                                                                    id="psat_table_3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Test Form(Click “Button” below to Review)
                                                                            </th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                PSAT Reading<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                PSAT Writing<span class="mt-2"> Score
                                                                                    (Timing)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                PSAT Math<span class="mt-2"> (Combined
                                                                                    Section 3 & 4)</span></th>
                                                                            <th class="text-center" style="width: 100px;">
                                                                                Composite <span>(Total) Score</span></th>
                                                                            <th class="text-center" style="width: 100px;">
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
                                                                                                class="btn btn-success d-block mb-2">{{ isset($psat_test['test_name']) ? $psat_test['test_name'] : '-' }}</button></a>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($psat_test['Reading']) ? $psat_test['Reading'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{ isset($psat_test['Writing']) ? $psat_test['Writing'] : '0' }}
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        {{-- {{ (isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : '0') + (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : '0') }} --}}
                                                                                        {{ isset($psat_test['Math_no_calculator']) ? $psat_test['Math_no_calculator'] : (isset($psat_test['Math_with_calculator']) ? $psat_test['Math_with_calculator'] : 0) }}
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
                            </div>
                        </div>


                    </div>
                </div>
            </div>
    </main>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#act_table_1').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [6, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4, 5]
                }]
            });
            $('#act_table_2').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [5, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4]
                }]
            });
            $('#act_table_3').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [6, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4, 5]
                }]
            });
            $('#sat_table_1').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [5, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4]
                }]
            });
            $('#sat_table_2').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [5, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4]
                }]
            });
            $('#sat_table_3').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [5, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4]
                }]
            });
            $('#psat_table_1').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [5, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4]
                }]
            });
            $('#psat_table_2').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [5, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4]
                }]
            });
            $('#psat_table_3').DataTable({
                "initComplete": function() {
                    $('.sorting, .sorting_asc, .sorting_desc').removeClass(
                        'sorting sorting_asc sorting_desc');
                },
                bInfo: false,
                paging: false,
                searching: false,
                "order": [
                    [5, "desc"]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4]
                }]
            });
        });

        $('#sortable_act_1').on('click', function() {
            var table = $('#act_table_1').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [6, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });
        $('#sortable_act_2').on('click', function() {
            var table = $('#act_table_2').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [6, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });
        $('#sortable_act_3').on('click', function() {
            var table = $('#act_table_3').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [6, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });
        $('#sortable_sat_1').on('click', function() {
            var table = $('#sat_table_1').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [5, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });
        $('#sortable_sat_2').on('click', function() {
            var table = $('#sat_table_2').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [5, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });
        $('#sortable_sat_3').on('click', function() {
            var table = $('#sat_table_3').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [5, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });
        $('#sortable_psat_1').on('click', function() {
            var table = $('#psat_table_1').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [5, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });
        $('#sortable_psat_2').on('click', function() {
            var table = $('#psat_table_2').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [5, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });
        $('#sortable_psat_3').on('click', function() {
            var table = $('#psat_table_3').DataTable();
            var currentOrder = table.order()[0];
            var column = currentOrder[0];
            var direction = currentOrder[1];
            table.order([
                [5, direction === 'asc' ? 'desc' : 'asc']
            ]).draw();
            $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
            $(this).find("i").toggleClass('fa-angle-down fa-angle-up');
        });

        var DELAY = 700,
            clicks = 0,
            timer = null;

        function editQuizName(quizId) {
            $(`button.btn_${quizId}`).hide();
            $(`.input_${quizId}`).show();

        }

        function changeSectionName(data, rowId) {
            $.ajax({
                type: 'post',
                url: '{{ route('changeTitleSelfMade') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'test_name': data.value.trim(),
                    'test_id': rowId
                },
                success: function(res) {
                    toastr.success("Name updated successfully.");
                    setTimeout(() => {
                        location.reload();
                    }, 3000)
                }
            });
        }

        function openTestSection(data) {
            clicks++;
            if (clicks === 1) {
                timer = setTimeout(function() {
                    clicks = 0;
                    let url = $(data).attr('data-url');
                    window.location.href = url;
                }, DELAY);
            } else {
                console.log(data);
                clearTimeout(timer);
                clicks = 0;
                var test_id = $(data).attr('data-id');
                let url = $(data).attr('data-url');
                var text = $(data).text().trim();
                var input = document.createElement("input");
                input.classList.add('input_test_name');
                input.value = text;

                input.addEventListener("keydown", function(event) {
                    if (event.key === "Enter") {
                        var updatedText = input.value.trim();
                        if (updatedText !== "") {
                            var newButton = document.createElement("button");
                            newButton.classList.add("btn", "btn-success", "d-block", "mb-2", "hover-btn",
                                "button-text");
                            newButton.textContent = updatedText;
                            newButton.setAttribute("onclick", `openTestSection(this)`);
                            newButton.setAttribute("data-id", `${test_id}`);
                            newButton.setAttribute("data-url", `${url}`);
                            setTimeout(() => {
                                window.location.reload();
                            }, 100);

                            $('.input_test_name').replaceWith(newButton);
                        }
                        $.ajax({
                            type: 'post',
                            url: '{{ route('changeTitleSelfMade') }}',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                'test_name': updatedText,
                                'test_id': test_id
                            },
                            success: function(res) {

                            }
                        });
                    }
                });
                $(data).replaceWith(input);
                input.focus();
            }

        }
    </script>

@endsection

@section('page-style')
    <style>
        .nav-tabs .nav-link.active {
            color: #fff;
            background-color: #4c78dd;
            border-color: #4c78dd;
        }

        .nav-tabs .nav-link {
            border: 1px solid #4c78dd;
        }

        .btn:focus {
            box-shadow: none
        }

        .accordion-button::after {
            display: none
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: #dde2e9;
        }

        .accordion-button:not(.collapsed) {
            background: #fff;
            color: #334155;
            box-shadow: none;
        }

        .accordion-button {
            background: #fff;
            border: 1px solid #dde2e9;
        }

        .accordion-item {
            background-color: #fff;
            border: 0;
        }

        .table {
            border-color: gray;
        }

        .table thead tr th {
            background-color: rgba(0, 0, 0, .1) !important;
        }

        .table thead tr th span {
            display: block;
        }

        @media(max-width: 768px) {
            .table {
                border-color: gray;
                display: block;
                overflow-x: scroll;
            }
        }

        /* .edit-icon{
                                                                                                                                                                                        display: none;
                                                                                                                                                                                    }
                                                                                                                                                                                    .hover-btn:hover .edit-icon{
                                                                                                                                                                                        display: block;
                                                                                                                                                                                        position: absolute;
                                                                                                                                                                                        bottom: 6px;
                                                                                                                                                                                        right: 7px
                                                                                                                                                                                    }
                                                                                                                                                                                    .hover-btn {
                                                                                                                                                                                        transition: all 0.5s;
                                                                                                                                                                                        width: auto;
                                                                                                                                                                                        position: relative;
                                                                                                                                                                                    } */
        .input_test_name {
            max-width: 110px !important;
        }
    </style>
@endsection
