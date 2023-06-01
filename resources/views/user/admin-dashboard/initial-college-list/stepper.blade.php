<?php
    $stepper = [
        [
            'title' => 'Selecting Search Parameters',
            'route' => route('admin-dashboard.initialCollegeList.step1') ,
            'number' => 1
        ],
        [
            'title' => 'College Search Results',
            'route' => route('admin-dashboard.initialCollegeList.step2'),
            'number' => 2,
        ],
        [
            'title' => 'My Academic Statistics',
            'route' => route('admin-dashboard.initialCollegeList.step3'),
            'number' => 3,
        ],
        [
            'title' => 'Academic Qualification Comparison',
            'route' => route('admin-dashboard.initialCollegeList.step4'),
            'number' => 4,
        ],
        // [
        //     'title' => 'College List',
        //     'route' => 'javascript:void(0)',
        //     'number' => 5,
        // ],
    ];
?>


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <div class="row justify-content-center align-items-start">
        @foreach($stepper as $key => $step)
            <div class="col">
                <li class="m-0" role="presentation">
                    <a class="nav-link {{ $active_stepper === $step['number'] ? 'active' : '' }}">
                        <p class="{{ in_array($step['number'], $completed_step) ? 'd-none' : '' }}">{{ $step['number'] }}</p>
                        <i class="fa-solid fa-check {{ in_array($step['number'], $completed_step) ? 'd-block' : '' }} "></i>
                        <h6>{{ $step['title'] }}</h6>
                    </a>
                </li>
            </div>
        @endforeach
    </div>
</ul>