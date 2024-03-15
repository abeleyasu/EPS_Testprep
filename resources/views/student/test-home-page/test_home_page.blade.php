@extends('layouts.user')

@section('title', 'Student View Dashboard : CPS')

@section('user-content')
    @can('Access Test Home Page')
        <main id="main-container">
            <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
                <div class="bg-black-10">
                    <div class="content content-full text-center">
                        <br>

                        <h1 class="h2 text-white mb-0">Test Prep Dashboard</h1>
                        <br>
                        <span class="text-white-75">ACT/SAT/PSAT/DSAT/DPSAT</span>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="content">
                    @if (session('error'))
                        <div class="mx-lg-auto col-lg-10">
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="card p-3  col-lg-10 mx-lg-auto ">
                        <nav class="d-flex justify-content-center">
                            <div class="nav nav-tabs mb-3 btn-group" id="nav-tab" role="tablist">
                                <button class="btn nav-link active text-uppercase" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Available Tests</button>
                                {{-- <button class="btn nav-link text-uppercase" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">test,quiz & score history</button>   --}}
                                <button class="btn nav-link text-uppercase" id="nav-profile-tab" data-bs-toggle="tab"
                                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">test,quiz &
                                    score history</button>
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
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                                                                        <h2 class="accordion-header" id="flush-headingFour">
                                                                            <button
                                                                                class="accordion-button collapsed border-0 fw-bold"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#tabChiledFour"
                                                                                aria-expanded="false"
                                                                                aria-controls="tabChiledFour">
                                                                                DSAT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="tabChiledFour"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingFour"
                                                                            data-bs-parent="#accordionFlushExample">
                                                                            <div class="accordion-body">
                                                                                @if (!$getOfficialPracticeTests['DSAT']->isEmpty())
                                                                                    @foreach ($getOfficialPracticeTests['DSAT'] as $getOfficialPracticeTest)
                                                                                        @if ($getOfficialPracticeTest->format == 'DSAT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                                                                        <h2 class="accordion-header" id="flush-headingFive">
                                                                            <button
                                                                                class="accordion-button collapsed border-0 fw-bold"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#tabChiledFive"
                                                                                aria-expanded="false"
                                                                                aria-controls="tabChiledFive">
                                                                                DPSAT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="tabChiledFive"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingFive"
                                                                            data-bs-parent="#accordionFlushExample">
                                                                            <div class="accordion-body">
                                                                                @if (!$getOfficialPracticeTests['DPSAT']->isEmpty())
                                                                                    @foreach ($getOfficialPracticeTests['DPSAT'] as $getOfficialPracticeTest)
                                                                                        @if ($getOfficialPracticeTest->format == 'DPSAT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                                            <div class="border mb-3">
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
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $test,
                                                                                                    'slug' =>
                                                                                                        'College Prep',
                                                                                                ]
                                                                                            )
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
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $test,
                                                                                                    'slug' =>
                                                                                                        'College Prep',
                                                                                                ]
                                                                                            )
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
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $test,
                                                                                                    'slug' =>
                                                                                                        'College Prep',
                                                                                                ]
                                                                                            )
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
                                                                        <h2 class="accordion-header" id="flush-headingFour">
                                                                            <button
                                                                                class="accordion-button collapsed border-0 fw-bold"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#collapsTabFour"
                                                                                aria-expanded="false"
                                                                                aria-controls="collapsTabFour">
                                                                                DSAT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="collapsTabFour"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingFour"
                                                                            data-bs-parent="#accordionFlushExampleTwo">
                                                                            <div class="accordion-body">
                                                                                @if (!$getAllPracticeTests['DSAT']->isEmpty())
                                                                                    @foreach ($getAllPracticeTests['DSAT'] as $test)
                                                                                        @if ($test->format == 'DSAT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $test,
                                                                                                    'slug' =>
                                                                                                        'College Prep',
                                                                                                ]
                                                                                            )
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
                                                                        <h2 class="accordion-header" id="flush-headingFive">
                                                                            <button
                                                                                class="accordion-button collapsed border-0 fw-bold"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#collapsTabFive"
                                                                                aria-expanded="false"
                                                                                aria-controls="collapsTabFive">
                                                                                DPSAT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="collapsTabFive"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingFive"
                                                                            data-bs-parent="#accordionFlushExampleTwo">
                                                                            <div class="accordion-body">
                                                                                @if (!$getAllPracticeTests['DPSAT']->isEmpty())
                                                                                    @foreach ($getAllPracticeTests['DPSAT'] as $test)
                                                                                        @if ($test->format == 'DPSAT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $test,
                                                                                                    'slug' =>
                                                                                                        'College Prep',
                                                                                                ]
                                                                                            )
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

                                        <div class="accordion-item">
                                            <div class="border">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button border-0 fw-bold" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="true" aria-controls="collapseThree">
                                                        Tests in Progress
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div>
                                                            <div class="accordion accordion-flush"
                                                                id="accordionFlushExampleThree">
                                                                <div class="accordion-item">
                                                                    <div class="border mb-2">
                                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                                            <button
                                                                                class="accordion-button collapsed border-0 fw-bold"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#tip_collapsTabOne"
                                                                                aria-expanded="false"
                                                                                aria-controls="tip_collapsTabOne">
                                                                                ACT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="tip_collapsTabOne"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingOne"
                                                                            data-bs-parent="#accordionFlushExampleThree">
                                                                            <div class="accordion-body">
                                                                                @if (!$getAllProgressPracticeTests['ACT']->isEmpty())
                                                                                    @foreach ($getAllProgressPracticeTests['ACT'] as $test)
                                                                                        @if ($test->format == 'ACT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $test,
                                                                                                    'slug' =>
                                                                                                        'College Prep',
                                                                                                ]
                                                                                            )
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
                                                                                data-bs-target="#tip_collapsTabTwo"
                                                                                aria-expanded="false"
                                                                                aria-controls="tip_collapsTabTwo">
                                                                                SAT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="tip_collapsTabTwo"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingTwo"
                                                                            data-bs-parent="#accordionFlushExampleThree">
                                                                            <div class="accordion-body">
                                                                                @if (!$getAllProgressPracticeTests['SAT']->isEmpty())
                                                                                    @foreach ($getAllProgressPracticeTests['SAT'] as $getOfficialPracticeTest)
                                                                                        @if ($getOfficialPracticeTest->format == 'SAT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                                                                                data-bs-target="#tip_collapsTabThree"
                                                                                aria-expanded="false"
                                                                                aria-controls="tip_collapsTabThree">
                                                                                PSAT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="tip_collapsTabThree"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingThree"
                                                                            data-bs-parent="#accordionFlushExampleThree">
                                                                            <div class="accordion-body">
                                                                                @if (!$getAllProgressPracticeTests['PSAT']->isEmpty())
                                                                                    @foreach ($getAllProgressPracticeTests['PSAT'] as $getOfficialPracticeTest)
                                                                                        @if ($getOfficialPracticeTest->format == 'PSAT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                                                                        <h2 class="accordion-header" id="flush-headingFour">
                                                                            <button
                                                                                class="accordion-button collapsed border-0 fw-bold"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#tip_collapsTabFour"
                                                                                aria-expanded="false"
                                                                                aria-controls="tip_collapsTabFour">
                                                                                DSAT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="tip_collapsTabFour"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingFour"
                                                                            data-bs-parent="#accordionFlushExampleThree">
                                                                            <div class="accordion-body">
                                                                                @if (!$getAllProgressPracticeTests['DSAT']->isEmpty())
                                                                                    @foreach ($getAllProgressPracticeTests['DSAT'] as $getOfficialPracticeTest)
                                                                                        @if ($getOfficialPracticeTest->format == 'DSAT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                                                                        <h2 class="accordion-header" id="flush-headingFive">
                                                                            <button
                                                                                class="accordion-button collapsed border-0 fw-bold"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#tip_collapsTabFive"
                                                                                aria-expanded="false"
                                                                                aria-controls="tip_collapsTabFive">
                                                                                DPSAT
                                                                            </button>
                                                                        </h2>
                                                                        <div id="tip_collapsTabFive"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-headingFive"
                                                                            data-bs-parent="#accordionFlushExampleThree">
                                                                            <div class="accordion-body">
                                                                                @if (!$getAllProgressPracticeTests['DPSAT']->isEmpty())
                                                                                    @foreach ($getAllProgressPracticeTests['DPSAT'] as $getOfficialPracticeTest)
                                                                                        @if ($getOfficialPracticeTest->format == 'DPSAT')
                                                                                            @include(
                                                                                                'student.test-home-page.components.test-button',
                                                                                                [
                                                                                                    'test' => $getOfficialPracticeTest,
                                                                                                    'slug' =>
                                                                                                        'Official Released',
                                                                                                ]
                                                                                            )
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
                            <div class="tab-content p-3 " id="nav-tabContent">
                                <div class="custom-loader-his"></div>
                                <div class="tab-pane fade " id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    @endcan

    @cannot('Access Test Home Page')
        @include('components.subscription-warning')
    @endcan

@endsection
@can('Access Test Home Page')
    @section('page-script')
        <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#nav-profile-tab').click(function() {
                    $.ajax({
                        url: '/user/test-home-page-history',
                        type: 'GET',
                        beforeSend: function() {
                            var className = 'tabOneHistory';

                            // Function to check if class exists
                            function checkClass() {
                                if ($('#' + className).length > 0) {
                                    $('.custom-loader-his').css('visibility', 'hidden');
                                } else {
                                    $('.custom-loader-his').css('visibility', 'visible');
                                }
                            }

                            // Call checkClass every second
                            setInterval(checkClass, 1);
                            $('#nav-home').removeClass('active');
                            $('#nav-home').removeClass('show');
                            $('#nav-profile').addClass('active');
                            $('#nav-profile').addClass('show');
                        },
                        success: function(response) {
                            $('.custom-loader-his').css('visibility', 'hidden');

                            $('#nav-profile').html(response.html);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });

                $('#nav-home-tab').click(function() {
                    $('#nav-profile').removeClass('active');
                    $('#nav-profile').removeClass('show');
                });

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
@endcan

@section('page-style')
    <style>
        .custom-loader-his {
            width: 50px;
            height: 50px;
            display: grid;
            border-radius: 50%;
            -webkit-mask: radial-gradient(farthest-side, #0000 40%, #000 41%);
            background: linear-gradient(0deg, #766DF480 50%, #766DF4FF 0) center/4px 100%,
                linear-gradient(90deg, #766DF440 50%, #766DF4BF 0) center/100% 4px;
            background-repeat: no-repeat;
            animation: s3 1s infinite steps(12);
            position: fixed;
            top: 50%;
            left: 50%;
            visibility: hidden;
        }

        .custom-loader-his::before,
        .custom-loader-his::after {
            content: "";
            grid-area: 1/1;
            border-radius: 50%;
            background: inherit;
            opacity: 0.915;
            transform: rotate(30deg);
        }

        .custom-loader-his::after {
            opacity: 0.83;
            transform: rotate(60deg);
        }

        @keyframes s3 {
            100% {
                transform: rotate(1turn)
            }
        }

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

        .custom-actual-time {
            font-size: 14px;
            color: #888;
        }
    </style>
@endsection
