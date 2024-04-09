@extends('layouts.user')

@section('title', 'Initial College List : CPS')

@section('user-content')
@php
$current_user_state_code = (
    DB::table('states')
->select('id', 'state_code')
->where('id', '=' , Auth::user()
->state_id)
->first()
)
@endphp
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
        <div class="bg-black-10">
            <div class="content content-full text-center">
                <br>
                <h1 class="h2 text-white mb-0">College Search</h1>
                <br>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="custom-tab-container">
            <div class="custom-college-container">
                @include('user.admin-dashboard.initial-college-list.stepper', [
                    'active_stepper' => 2,
                    'completed_step' => [1]
                ])
            </div>
            <p class="mb-4">Here are your college search results from the Search Parameters you chose.</p>

            @if(count($college_data) == 0)
                <div class="block block-rounded mb-3">
                    <div class="block-header block-header-main justify-content-center flex-column">
                        <h3 class="block-title">No College Found !</h3>
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-between mt-3 mb-3">
                    <div class="prev-btn">
                        <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}" class="btn btn-alt-success prev-step"> Previous Step
                        </a>
                    </div>
                    <div class="">
                        <a href="{{ route('admin-dashboard.initialCollegeList.step3') }}" class="btn  btn-alt-success next-step">Next Step</a>
                    </div>
                </div>
                <div class="mb-3 total-count">
                    {{ $total }} Results
                </div>
                @foreach($college_data as $key => $college)
                    <div class="block block-rounded mb-3">
                        <div class="block-header block-header-default block-header-main">
                            <h3 class="block-title">{{ $college['school.name'] }}</h3>
                            <div class="block-options">
                                <button type="button" class="btn btn-sm btn-alt-success college-details" data-id="{{ $college['id'] }}">College Details</button>
                                @if(in_array($college['id'], $selected_college))
                                    <button type="button" class="btn btn-sm btn-alt-danger remove-list" data-id="{{ $college['id'] }}">Remove College From List</button>
                                @else
                                    <button type="button" class="btn btn-sm btn-alt-success add-list" data-id="{{ $college['id'] }}">Add to My College List</button>
                                @endif
                            </div>
                        </div>
                        <div class="block-content mb-">
                            <div class="college-search-wrapper">
                                <h2>{{ $college['school.city'] }}, {{ $college['school.state'] }}</h2>
                                <div class="college-search-box">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="block block-rounded text-center mb-3">
                                                <div class="block-content py-3 bg-info text-white">
                                                    <span class="text-black-50 college-years">4</span>
                                                    <div class="fs-3 fw-semibold">Year</div>
                                                    <div>College</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="block block-rounded text-center mb-3">
                                                <div class="block-content py-3 bg-danger text-white">
                                                    <i class="fa fa-building fa-2x college-years text-black-50"></i>
                                                        @switch($college['school.ownership'])
                                                            @case(1)
                                                                <div class="fs-3 fw-semibold mt-3 public">Public</div>
                                                                <div></div>
                                                            @break
                                                            @case(2)
                                                                <div class="fs-3 fw-semibold mt-3">Private</div>
                                                                <div>Nonprofit</div>
                                                            @break
                                                            @case(3)
                                                                <div class="fs-3 fw-semibold mt-3">Private</div>
                                                                <div>For-profit</div>
                                                            @break
                                                        @endswitch
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="block block-rounded text-center mb-3">
                                                <div class="block-content py-3 bg-primary text-white">
                                                    @if(in_array($college['school.locale'], [11, 12, 13]))
                                                        <i class="fa fa-city fa-2x college-years text-black-50"></i>
                                                    @elseif(in_array($college['school.locale'], [21, 22, 23]))
                                                        <i class="fa fa-city fa-2x college-years text-black-50"></i>
                                                    @elseif(in_array($college['school.locale'], [31, 32, 33]))
                                                        <i class="fa fa-city" fa-2x college-years text-black-50"></i>
                                                    @elseif(in_array($college['school.locale'], [41, 42, 43]))
                                                        <i class="fa fa-building-wheat fa-2x college-years text-black-50"></i>
                                                    @else
                                                        <i class="fa fa-city fa-2x college-years text-black-50"></i>
                                                    @endif
                                                    <div class="fs-3 fw-semibold mt-3">Campus</div>
                                                    @if(in_array($college['school.locale'], [11, 12, 13]))
                                                        <div>City</div>
                                                    @elseif(in_array($college['school.locale'], [21, 22, 23]))
                                                        <div>Suburban</div>
                                                    @elseif(in_array($college['school.locale'], [31, 32, 33]))
                                                        <div>Town</div>
                                                    @elseif(in_array($college['school.locale'], [41, 42, 43]))
                                                        <div>Rural</div>
                                                    @else
                                                        <div>N/A</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="block block-rounded text-center mb-3">
                                                <div class="block-content py-3 bg-secondary text-white">
                                                    <i class="fa fa-users fa-2x college-years text-black-50"></i>
                                                    <div class="fs-3 fw-semibold mt-3">Size</div>
                                                    @if($college['latest.student.size'] < 2000)
                                                        <div>Small</div>
                                                    @elseif($college['latest.student.size'] > 2000 && $college['latest.student.size'] < 15000)
                                                        <div>Medium</div>
                                                    @else
                                                        <div>Large</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="college-text">
                                                <p>
                                                    <b>Acceptance Rate:</b>
                                                    @if($college['latest.admissions.admission_rate.overall'])
                                                        {{ number_format($college['latest.admissions.admission_rate.overall'] * 100, 0) . '%' }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>
                                                @php
                                                    $costOfAttendanceStr = "Cost of Attendance";
                                                    $total_cost = '';
                                                    $college_info =   $college['college_info'];
                                                    // $fees_ft_d =  $college_info->FEES_FT_D ? (int) $college_info->FEES_FT_D : 0;
                                                    // $books_res_d = $college_info->BOOKS_RES_D ? (int) $college_info->BOOKS_RES_D : 0;
                                                    // $transport_res_d = $college_info->TRANSPORT_RES_D ? (int) $college_info->TRANSPORT_RES_D : 0;
                                                    // $total_cost = $fees_ft_d + $books_res_d + $transport_res_d;
                                                @endphp
                                                @switch($college['school.ownership'])
                                                    @case(1)
                                                            @php
                                                                if($college_info->display_peterson_public_coa == "1"){
                                                                    echo '<p><b>Cost of Attendance (In-State): </b>';
                                                                    // $tuit_state_ft_d  = $college_info->TUIT_STATE_FT_D ? (int) $college_info->TUIT_STATE_FT_D  : 0;
                                                                    $total_cost = $college_info->public_coa_in_state;
                                                                    echo  ($total_cost ? '$' . $total_cost : 'No Data');

                                                                    $costOfAttendanceStr .= "(Out-of-State)";
                                                                    echo '<p><b>Cost of Attendance (Out-of-State): </b>';
                                                                    // $tuit_nres_ft_d = $college_info->TUIT_NRES_FT_D ? (int) $college_info->TUIT_NRES_FT_D  : 0;
                                                                    $total_cost = $college_info->public_coa_out_state;
                                                                    echo  ($total_cost ? '$' . $total_cost : 'No Data');

                                                                }else{
                                                                    echo '<p><b>Cost of Attendance (In-State): </b>';
                                                                    $total_cost = $college_info->public_coa_in_state_admin;
                                                                    echo  ($total_cost ? '$' . $total_cost : 'No Data');

                                                                    $costOfAttendanceStr .= "(Out-of-State)";
                                                                    echo '<p><b>Cost of Attendance (Out-of-State): </b>';
                                                                    $total_cost = $college_info->public_coa_out_state_admin;
                                                                    echo  ($total_cost ? '$' . $total_cost : 'No Data');

                                                                }

                                                            @endphp

                                                    @break
                                                    @case(2)
                                                        @php
                                                            $costOfAttendanceStr .= "";
                                                            echo '<p><b>Cost of Attendance: </b>';
                                                            // $tuit_overall_ft_d = $college_info->TUIT_OVERALL_FT_D ? (int) $college_info->TUIT_OVERALL_FT_D : 0;
                                                            if($college_info->display_peterson_pvt_coa == "1"){
                                                                $total_cost = $college_info->pvt_coa;
                                                                echo  ($total_cost ? '$' . $total_cost : 'No Data');

                                                            }
                                                            else{
                                                                $total_cost = $college_info->pvt_coa_admin;
                                                                echo  ($total_cost ? '$' . $total_cost : 'No Data');

                                                            }

                                                        @endphp
                                                    @break
                                                @endswitch
                                                </p>
                                                <p><b>Median Earnings:</b>
                                                    @if($college['latest.earnings.10_yrs_after_entry.median'])
                                                        {{ '$' . number_format($college['latest.earnings.10_yrs_after_entry.median'] / 1000, 0) . 'k' }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-end">
                    {{ $pagination->links('user.admin-dashboard.initial-college-list.pagination') }}
                </div>
            @endif
            <div class="d-flex justify-content-between mt-3">
                <div class="prev-btn">
                    <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}" class="btn btn-alt-success prev-step"> Previous Step
                    </a>
                </div>
                <div class="">
                    <a href="{{ route('admin-dashboard.initialCollegeList.step3') }}" class="btn  btn-alt-success next-step">Next Step</a>
                </div>
            </div>
        </div>
    </div>
</main>

<!--College-search-tool1 Modal -->
<div class="modal" id="college-details" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default block-header-modal">
                    <h3 class="block-title" id="main-college-name"></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-college fs-sm">
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                            <div class="accordion accordionExample">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#info" aria-expanded="true" aria-controls="info">
                                        <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-circle-info"></i>College Overview</a>
                                    </div>
                                    <div id="info" class="collapse" aria-labelledby="info" data-bs-parent=".accordionExample">
                                        <div class="college-content-wrapper college-content">
                                            <p>Get a quick look at the most important information in the College Overview, or go to each individual dropdown for detailed information about each aspect of the college.</p>
                                            <div class="row mb-2">
                                                <div class="col-lg-3">
                                                    <div class="block block-rounded text-center mb-3">
                                                        <div class="block-content py-3 bg-info text-white">
                                                            <span class="text-black-50 college-years">4</span>
                                                            <div class="fs-3 fw-semibold">Year</div>
                                                            <div>College</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="block block-rounded text-center mb-3">
                                                        <div class="block-content py-3 bg-danger text-white">
                                                            <i class="fa fa-building fa-2x college-years text-black-50"></i>
                                                            <div id="info-ownership">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="block block-rounded text-center mb-3">
                                                        <div class="block-content py-3 bg-primary text-white">
                                                            <i class="fa fa-city fa-2x college-years text-black-50"></i>
                                                            <div class="fs-3 fw-semibold mt-3">Campus</div>
                                                            <div id="info-campus"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="block block-rounded text-center mb-3">
                                                        <div class="block-content py-3 bg-secondary text-white">
                                                            <i class="fa fa-users fa-2x college-years text-black-50"></i>
                                                            <div class="fs-3 fw-semibold mt-3 text-white">Size</div>
                                                            <div class="text-white" id="info-size"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fs-base lh-base fw-large mb-3">
                                                <a class="text-info" id="college-url" target="_blank" href="">Website <i class="fa fa-arrow-right"></i></a>
                                            </div>
                                            <div id="college-description"></div>
                                            <div class="fs-base lh-base fw-large mb-3">
                                                <iframe
                                                    width="450"
                                                    height="250"
                                                    frameborder="0" style="border:0"
                                                    referrerpolicy="no-referrer-when-downgrade"
                                                    src=""
                                                    id="map-url"
                                                >
                                                </iframe>
                                                <!-- <a class="text-info" id="college-map-url" href="" target="_blank">Open Map <i class="fa fa-arrow-right"></i></a> -->
                                            </div>
                                            <div>
                                                <div class="fs-base lh-base fw-large mb-0 border-bottom mb-2">
                                                    <i class="fa fa-comments-dollar"></i> ADMISSIONS
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>ACCEPTANCE RATE</div>
                                                    <small><span id="overall-adminssion-rate"></span></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>Number of Applicants</div>
                                                    <small><span id="c-number-of-applicants"></span></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>Entrance Difficulty</div>
                                                    <small><span id="c-entrance-difficulty"></span></small>
                                                </div>
                                                {{-- <div class="block-title mb-2">
                                                    <div>Early Action Offered</div>
                                                    <small><span id="c-early-action-offered"></span></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>Early Decision Offered</div>
                                                    <small><span id="c-early-decision-offerd"></span></small>
                                                </div> --}}
                                                <div class="block-title mb-2">
                                                    <div>Early Action Deadline</div>
                                                    <small><span id="c-early-action-deadline"></span></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>Regular Admission Deadline</div>
                                                    <small><span id="c-regular-admission-deadline"></span></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>Rolling Admission Deadline</div>
                                                    <small><span id="c-rolling-admission-deadline"></span></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>Early Decision 1 Deadline</div>
                                                    <small><span id="c-early-decision-1-deadline"></span></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>Early Decision 2 Deadline</div>
                                                    <small><span id="c-early-decision-2-deadline"></span></small>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-base lh-base fw-large mb-0 border-bottom mb-2">
                                                    <i class="fa fa-graduation-cap"></i> Enrolled Freshman Academic Statistics
                                                </div>
                                                {{-- <div class="block-title mb-2">
                                                    <div>AVERAGE ACCEPTED GPA</div>
                                                    <small id="c-avg-accepted-gpa"></small>
                                                </div> --}}
                                                <div class="block-title mb-2">
                                                    <div>AVERAGE ACCEPTED WEIGHTED GPA</div>
                                                    <small id="c-avg-accepted-weighted-gpa"></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>AVERAGE ACCEPTED UNWEIGHTED GPA</div>
                                                    <small id="c-avg-accepted-unweighted-gpa"></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>SAT Math</div>
                                                    <div><small>Average SAT Math</small></div>
                                                    <small id="c-avg-sat-math"></small>
                                                    <div><small>Range of middle 50%</small></div>
                                                    <small id="avg-sat-middle"></small>
                                                </div>

                                                <div class="block-title mb-2">
                                                    <div>SAT Reading/Writing</div>
                                                    <div><small>Average SAT Reading/Writing</small></div>
                                                    <small id="c-avg-sat-reading-weiting"></small>
                                                    <div><small>Range of middle 50%</small></div>
                                                    <small id="avg-sat-reading-writing-middle"></small>
                                                </div>

                                                <div class="block-title mb-2">
                                                    <div>ACT Composite</div>
                                                    <div><small>Average ACT Composite</small></div>
                                                    <small id="c-avg-act-composite"></small>
                                                    <div><small>Range of middle 50%</small></div>
                                                    <small id="avg-act-composite-middle"></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>Academic Calender System</div>
                                                    <small id="main_calendar"></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>ENROLLMENT</div>
                                                    <small><span id="enrollment"></span> Undergraduates</small>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-base lh-base fw-large mb-0 border-bottom mb-2">
                                                    <i class="fa fa-comments-dollar"></i> Financial Overview
                                                </div>
                                                <div style="display: none" id="c-private-cost-of-attendance-block" class="block-title mb-2">
                                                    <div>COST OF ATTENDANCE</div>
                                                    <small><span id="c-private-cost-of-attendance"></span></small>
                                                </div>
                                                <div style="display: none" id="c-in-state-cost-of-attendance-block" class="block-title mb-2">
                                                    <div>COST OF ATTENDANCE (In State)</div>
                                                    <small><span id="c-in-state-cost-of-attendance"></span></small>
                                                    {{-- <div>Tuition & Fees (In State))</div>
                                                    <small><span id="c-in-state-tuition-and-fees"></span></small> --}}
                                                </div>
                                                <div style="display:none" id="c-out-state-cost-of-attendance-block" class="block-title mb-2">
                                                    <div>COST OF ATTENDANCE (Out of State)</div>
                                                    <small><span id="c-out-state-cost-of-attendance"></span></small>
                                                    {{-- <div>Tuition & Fees (Out of State)</div>
                                                    <small><span id="c-out-state-tuition-and-fees"></span></small> --}}
                                                </div>
                                                {{-- <div class="block-title mb-2">
                                                    <div>TUITION AND FEES</div>
                                                    <small><span id="c-pvt-tution-and-fees"></span></small>
                                                </div> --}}
                                                <div class="block-title mb-2">
                                                    <div>ROOM AND BOARD</div>
                                                    <small><span id="c-room-and-board"></span></small>
                                                </div>
                                                {{-- <div class="block-title mb-2">
                                                    <div>AVERAGE PERCENT OF NEED MET</div>
                                                    <small><span id="c-average-percent-of-need-met"></span></small>
                                                </div>
                                                <div class="block-title mb-2">
                                                    <div>AVERAGE FRESHMAN AWARD</div>
                                                    <small><span id="c-average-freshman-award"></span></small>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#cost" aria-expanded="true" aria-controls="cost">
                                        <a class="text-white fw-600 collapsed"><i class="fa-solid fa-comments-dollar me-2"></i>Cost</a>
                                    </div>
                                    <div id="cost" class="collapse" aria-labelledby="cost" data-bs-parent=".accordionExample">
                                        <div class="college-content-wrapper college-content block-content">
                                            <h3 class="block-title text-center">Average Annual Cost</h3>
                                            <div class="block-content text-center">
                                                <p class="h1 fw-bold" id="avg-anual-cost">$41,334</p>
                                            </div>
                                            <div class="block-content">
                                                <table class="table table-striped table-vcenter">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>Family Income</th>
                                                            <th class="d-none d-sm-table-cell">Average Annual Cost</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        <tr>
                                                            <td class="text-center"><p>$0-$30,000</p></td>
                                                            <td class="fw-semibold"> <p><strong>$23,297</strong></p>
                                                            </td>
                                                        </tr><tr>
                                                            <td class="text-center"><p>$30,001-$48,000</p></td>
                                                            <td class="fw-semibold"><p><strong>$27,303</strong></p></td>

                                                        </tr><tr>
                                                            <td class="text-center"><p>$48,001-$75,000</p></td>
                                                            <td class="fw-semibold"><p><strong>$31,754</strong></p></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 --}}
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <a class=" text-white fw-600 collapsed"><i class="fa-solid fa-comments-dollar me-2"></i> Fields of Study</a>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-bs-parent=".accordionExample">
                                        {{-- Main Wrapper --}}
                                        <div id="college-content" class="college-content-wrapper college-content">
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                        <a class=" text-white fw-600 collapsed"><i class="fa-solid fa-comments-dollar me-2"></i> Graduation & Retention</a>
                                    </div>
                                    <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-bs-parent=".accordionExample">
                                        <div class="college-content-wrapper college-content">
                                            <div class="college-content-wrapper college-content">
                                                <div class="block block-rounded block-bordered">
                                                    <div class="block-content">
                                                        <div class="block block-rounded block-link-shadow">
                                                            <h2 class="block-title">Graduation Rate</h2>
                                                            <div class="progress push" id="graduation-rate-progress-bar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="block block-rounded block-bordered">
                                                    <div class="block-content">
                                                        <div class="block block-rounded block-link-shadow">
                                                            <h2 class="block-title">Students Who Return After Their First Year</h2>
                                                            <div class="progress push">
                                                                <div class="progress-bar" role="progressbar" style="width: 92%;" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100">
                                                                    <span class="fs-sm fw-semibold">92%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                        <a class="text-white fw-600 collapsed"><i class="fa-solid fa-comments-dollar me-2"></i> Financial Aid & Debt</a>
                                    </div>
                                    <div id="collapseSeven" class="collapse" aria-labelledby="collapseSeven" data-bs-parent=".accordionExample">
                                        <div class="college-content-wrapper college-content">
                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#fstudentload" aria-expanded="true" aria-controls="fstudentload">
                                                    <a class="text-white fw-600 collapsed">Federal Student Loans</a>
                                                </div>
                                                <div id="fstudentload" class="collapse" aria-labelledby="fstudentload" data-bs-parent=".accordionExample1">
                                                    <div class="college-content-wrapper college-content">
                                                        <div class="block block-rounded block-bordered">
                                                            <div class="block-content">
                                                                <div class="block block-rounded block-link-shadow">
                                                                    <h2 class="block-title">Students Receiving Federal Loans </h2>
                                                                    <div id="federal-loans"></div>
                                                                    <p>At some schools where few students borrow federal loans, the typical undergraduate may leave school with $0 in debt.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="block block-rounded block-bordered">
                                                            <div class="block-content">
                                                                <div class="mb-2 mt-2 block block-rounded block-link-shadow">
                                                                    <h2 class="block-title">Median Total Debt After Graduation </h2>
                                                                    <p>The typical total debt for undergraduate borrowers who complete college.</p>
                                                                    <div class="fw-bold fs-2" id="median-total-debt-federal"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="block block-rounded block-bordered">
                                                            <div class="block-content">
                                                                <div class="block block-rounded block-link-shadow">
                                                                    <h2 class="block-title">Typical Monthly Loan Payment </h2>
                                                                    <p>This is based on a standard 10-year payment plan, other payment options are available, like income-driven repayment. An income-driven repayment plan sets your monthly student loan payment at an amount that is intended to be affordable based on your income and family size.</p>
                                                                    <div class="fw-bold fs-2"  id="monthly-total-debt-federal"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#plusloan" aria-expanded="true" aria-controls="plusloan">
                                                    <a class="text-white fw-600 collapsed">Parent PLUS Loans</a>
                                                </div>
                                                <div id="plusloan" class="collapse" aria-labelledby="plusloan" data-bs-parent=".accordionExample1">
                                                    <div class="college-content-wrapper college-content">
                                                        <div class="block block-rounded block-bordered">
                                                            <div class="block-content">
                                                                <div class="mb-2 mt-2 block block-rounded block-link-shadow">
                                                                    <h2 class="block-title">Parent Borrowing Rate</h2>
                                                                    <div class="fw-bold fs-2" id="parent-borrowing-rate"></div>
                                                                    <p>This is an estimated percentage of the number of students who had a parent who borrowed a Parent PLUS loan.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="block block-rounded block-bordered">
                                                            <div class="block-content">
                                                                <div class="mb-2 mt-2 block block-rounded block-link-shadow">
                                                                    <h2 class="block-title">Median Total Debt After Graduation </h2>
                                                                    <div class="fw-bold fs-2" id="median-total-debt-parent-loan"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="block block-rounded block-bordered">
                                                            <div class="block-content">
                                                                <div class="block block-rounded block-link-shadow">
                                                                    <h2 class="block-title">Typical Monthly Loan Payment </h2>
                                                                    <p>This is based on a standard 10-year payment plan, other payment options are available, like income-driven repayment. An income-driven repayment plan sets your monthly student loan payment at an amount that is intended to be affordable based on your income and family size.</p>
                                                                    <div class="fw-bold fs-2" id="monthly-total-debt-parent-loan"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                        <a class=" text-white fw-600 collapsed"><i class="fa-solid fa-comments-dollar me-2"></i> Typical Earnings</a>
                                    </div>
                                    <div id="collapseEight" class="collapse" aria-labelledby="headingOne" data-bs-parent=".accordionExample">
                                        <div class="college-content-wrapper college-content">
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="mb-2 mt-2 block block-rounded block-link-shadow">
                                                        <h2 class="fw-bold fs-4">Median Earnings</h2>
                                                        <div class="fw-bold fs-2" id="total-media-earing"></div>
                                                        <p>The median earnings of former students who received federal financial aid at 10 years after entering the school.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="mb-2 mt-2 block block-rounded block-link-shadow">
                                                        <h2 class="fw-bold fs-4">Percentage Earning More Than a High School Graduate</h2>
                                                        <div class="fw-bold"><span class="fs-3" id="high-school-graduate-percentage-earing">94%</span> of students</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="mb-2 mt-2 block block-rounded block-link-shadow">
                                                        <h2 class="fw-bold fs-4">Earnings After Completing Field of Study</h2>
                                                        <p>Salary information for Fields of Study available at this school are in the All Fields of Study page.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                        <a class=" text-white fw-600 collapsed"><i class="fa-solid fa-comments-dollar me-2"></i> Test Scores &
                                            Acceptance</a>
                                    </div>
                                    <div id="collapseTen" class="collapse" aria-labelledby="headingOne" data-bs-parent=".accordionExample">
                                        <div class="college-content-wrapper college-content">
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">Acceptance Rate</h2>
                                                        <div id="test-info-acceptance-rate"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">Test Scores</h2>
                                                        <p id="test-score-content"><span class="test-score-college-name"></span> has an acceptance rate of <span id="test-score-acceptance-rate-percentage"></span>. <span class="test-score-college-name"></span> considers admission test scores (SAT/ACT) during the application process, but does not require them. Students who were admitted to <span class="test-score-college-name"></span> and enrolled typically had admission test scores in these ranges.</p>
                                                        <div class="block-title mb-2">
                                                            <div>SAT Math</div>
                                                            <div><small>Average SAT Math</small></div>
                                                            <small id="c-avg-sat-math-2"></small>
                                                            <div><small>Range of middle 50%</small></div>
                                                            <small id="avg-sat-middle-2"></small>
                                                        </div>

                                                        <div class="block-title mb-2">
                                                            <div>SAT Reading/Writing</div>
                                                            <div><small>Average SAT Reading/Writing</small></div>
                                                            <small id="c-avg-sat-reading-weiting-2"></small>
                                                            <div><small>Range of middle 50%</small></div>
                                                            <small id="avg-sat-reading-writing-middle-2"></small>
                                                        </div>

                                                        <div class="block-title mb-2">
                                                            <div>ACT Composite</div>
                                                            <div><small>Average ACT Composite</small></div>
                                                            <small id="c-avg-act-composite-2"></small>
                                                            <div><small>Range of middle 50%</small></div>
                                                            <small id="avg-act-composite-middle-2"></small>
                                                        </div>
                                                        {{-- <div class="mb-2 exam-detail">
                                                            <h2 class="block-title">SAT</h2>
                                                            <div>CRITICAL READING: <span id="sat-critical-reading">530-620</span></div>
                                                            <div>Math: <span id="sat-math-score">580-620</span></div>
                                                        </div>
                                                        <div class="mb-2 exam-detail">
                                                            <h2 class="block-title">ACT: <span id="act-score">530-620</span></h2>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
                                        <a class=" text-white fw-600 collapsed"><i class="fa-solid fa-comments-dollar me-2"></i>Campus Life</a>
                                    </div>
                                    <div id="collapseEleven" class="collapse" aria-labelledby="headingOne" data-bs-parent=".accordionExample">
                                        <div class="college-content-wrapper college-content">
                                            {{-- Athletic Division --}}
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">1. Athletic Division</h2>
                                                        @php

                                                        $athletic_divisions = array(
                                                            'ASSN_ATHL_NCAA' => 'National Collegiate Athletic Association (NCAA)',
                                                            'ASSN_ATHL_NAIA' => 'National Association of Intercollegiate Athletics',
                                                            'ASSN_ATHL_NCCAA' => 'National Christian College Athletic Association',
                                                            'ASSN_ATHL_NJCAA' => ' National Small College Athletic Association (NSCAA)',
                                                            'ASSN_ATHL_CIAU' => 'National Junior College Athletic Association'
                                                        );
                                                        foreach ($athletic_divisions as $key => $value) {
                                                            echo "<div hidden id='$key-container'>";
                                                            echo '<div>' . $value . '</div>';
                                                            echo "<div><small id='$key'></small></div>";
                                                            echo "</div>";
                                                        }
                                                        echo "<div id='athletic-divisions-no-data'>No Data Found</div>";

                                                        @endphp
                                                         <small id=""></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered mt-2">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">2. Greek Life (Sororities & Fraternities)</h2>
                                                        {{-- <div>LIFE_SOR_NAT</div>
                                                        <small id="life_sor_nat"></small>
                                                        <div>LIFE_SOR_LOCAL</div>
                                                        <small id="life_sor_local"></small>
                                                        <div>LIFE_FRAT_NAT</div>
                                                        <small id="life_frat_nat"></small>
                                                        <div>LIFE_FRAT_LOCAL</div>
                                                        <small id="life_frat_local"></small> --}}

                                                        <div class="mb-2">
                                                            <div class="fw-semibold">Has National Sororities</div>
                                                            <small id="life_sor_nat"></small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="fw-semibold">Has Local Sororities</div>
                                                            <small id="life_sor_local"></small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="fw-semibold">Has National Fraternities</div>
                                                            <small id="life_frat_nat"></small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="fw-semibold">Has Local Fraternities</div>
                                                            <small id="life_frat_local"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">3.% in Sororities </h2>
                                                         <small id="SORO_1ST_P"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">4.% Fraternities</h2>
                                                         <small id="FRAT_1ST_P"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">5. Nearest Metropolitan Area </h2>
                                                         <small id="CMPS_METRO_T"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">6. Freshman Housing Guarantee </h2>
                                                         <small id="HOUS_FRSH_POLICY"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                    <div class="block block-rounded block-link-shadow">
                                                        <h2 class="block-title">7. Students in College Housing</h2>
                                                         <small id="HOUS_SPACES_OCCUP"></small>
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
</div>
<!--Honors Modal -->

@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
<link rel="stylesheet" href="{{ asset('css/college-application-deadline.css') }}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<style>
    .college-years {
        font-size: 2em;
        font-weight: 900;
    }
    .public {
        margin-bottom: 24px;
    }
    .no-data {
        border: 1px solid;
        border-style: dashed;
        border-color: darkgray;
        padding: 10px;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
    }
    #map {
        height: 100%;
        width: 100%;
    }


    .fa-house-building:before {
        content: "\e1b1";
    }

    .fa-house-tree:before {
        content: "\e1b3";
    }

    .total-count {
        font-size: 20px;
        font-weight: 900;
        margin: 0px 15px
    }
</style>
@endsection

@section('user-script')
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{asset('assets/js/moment/moment.min.js')}}"></script>
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

    const college_id = @json($college_id)

    $(document).on('click', '.add-list', function (e) {
        const schools = @json($college_data);
        const school = schools.find(college => college.id == e.target.dataset.id)
        $.ajax({
            type: "POST",
            url: "{{ route('admin-dashboard.initialCollegeList.step2.saveCollege') }}",
            data: {
                school_lists_id: college_id,
                school_id: e.target.dataset.id,
                school_name: school['school.name'],
                size: school['latest.student.size'],
                ownership: school['school.ownership'],
                locale: school['school.locale'],
                college_acceptance_rate: school['latest.completion.consumer_rate'],
                college_average_anual_cost: school['latest.cost.avg_net_price.overall'],
                college_median_earnings: school['latest.earnings.10_yrs_after_entry.median'],
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done((response) => {
            if (response.success) {
                e.target.className = 'btn btn-sm btn-alt-danger remove-list'
                e.target.innerHTML = 'Remove College From List'
                e.target.blur()
                toastr.success(response.message)
            } else {
                toastr.error(response.message)
            }
        })
    })

    $(document).on('click', '.remove-list', function (e) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to remove this college?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const school_id = e.target.dataset.id
                let url = "{{ route('admin-dashboard.initialCollegeList.step2.removeCollge', [ 'id' => ':id', 'sid' => 'school_id' ]) }}".replace(':id', college_id)
                url = url.replace('school_id', school_id)
                $.ajax({
                    type: "DELETE",
                    url: url,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                }).done((response) => {
                    if (response.success) {
                        e.target.className = 'btn btn-sm btn-alt-success add-list'
                        e.target.innerHTML = 'Add to My College List'
                        e.target.blur()
                        toastr.success(response.message)
                    } else {
                        toastr.error(response.message)
                    }
                })
            }
        })
    })

    $(document).ready(function () {
        // One.loader('show')
    })

    $(document).on('click', '.college-details', function (e) {
        One.loader('show')
        const url = "{{ route('admin-dashboard.initialCollegeList.step2.getSingleCollege', [ 'id' => ':uid' ]) }}"
        $.ajax({
            url: url.replace(':uid', e.target.dataset.id),
            method: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done((response) => {
            if (response.success) {
                One.loader('hide')
                console.log(response)
                const data = response.data
                const programmes = response.programmes
                let ownership = '', campus = 'N/A', size = 'Large'
                switch(data.school.ownership) {
                    case 1:
                        ownership = '<div class="fs-3 fw-semibold mt-3 public">Public</div><div>University</div>'
                    break;
                    case 2:
                        ownership = '<div class="fs-3 fw-semibold mt-3">Private</div><div>Nonprofit</div>'
                    break;
                    case 3:
                        ownership = '<div class="fs-3 fw-semibold mt-3">Private</div><div>For-profit</div>'
                    break;
                }
                switch(data.school.locale) {
                    case 11 || 12 || 13 :
                        campus = 'City'
                    break;
                    case 21 || 22 || 23:
                        campus = 'Suburban'
                    break;
                    case 31 || 32 || 33:
                        campus = 'Town'
                    break;
                    case 41 || 42 || 43:
                        campus = 'Rural'
                    break;
                }
                if (data.latest.student.size < 2000) {
                    size = 'Small'
                } else if (data.latest.student.size > 2000 && data.latest.student.size < 15000) {
                    size = 'Medium'
                }

                const avganualcosr = data.latest.cost.avg_net_price.overall ? data.latest.cost.avg_net_price.overall : 0
                const graduationrate = data.latest.completion.consumer_rate ? Math.round(data.latest.completion.consumer_rate * 100) : 0
                $('#graduation-rate-progress-bar').html(`
                    <div class="progress-bar" role="progressbar" style="width: ${graduationrate}%;" aria-valuenow="${graduationrate}" aria-valuemin="0" aria-valuemax="100">
                        <span class="fs-sm fw-semibold">${graduationrate}%</span>
                    </div>
                `)

                const federalLoans = data.latest.aid.ftft_federal_loan_rate_pooled ? Math.round(data.latest.aid.ftft_federal_loan_rate_pooled * 100) : 0;
                if (federalLoans > 0) {
                    $('#federal-loans').html(`
                        <div class="progress push">
                            <div class="progress-bar" role="progressbar" style="width: ${federalLoans}%;" aria-valuenow="${federalLoans}" aria-valuemin="0" aria-valuemax="100">
                                <span class="fs-sm fw-semibold">${federalLoans}%</span>
                            </div>
                        </div>
                    `)
                } else {
                    $('#federal-loans').html(`
                        <div class="no-data">Data Not Available</div>
                    `)
                }
                $('#median-total-debt-federal').html('$'+ Math.round(data.latest.aid.median_debt.completers.overall))
                $('#monthly-total-debt-federal').html('$'+ Math.round(data.latest.aid.median_debt.completers.monthly_payments))

                $('#parent-borrowing-rate').html(`${data.latest.aid.plus_loan_pct_lower_pooled}-${data.latest.aid.plus_loan_pct_upper_pooled}%`)
                $('#median-total-debt-parent-loan').html(data.latest.aid.plus_debt.completers.eval_inst.median ? `$${data.latest.aid.plus_debt.completers.eval_inst.median}` : '<div class="no-data">Data Not Available</div>')
                $('#monthly-total-debt-parent-loan').html(data.latest.aid.plus_debt.completers.eval_inst.median_payment ? `$${data.latest.aid.plus_debt.completers.eval_inst.median_payment}` : '<div class="no-data">Data Not Available</div>')

                $('#total-media-earing').html(data.latest.earnings['10_yrs_after_entry'].median ? `$${data.latest.earnings['10_yrs_after_entry'].median}` : '<div class="no-data">Data Not Available</div>')
                $('#high-school-graduate-percentage-earing').html(`${data.latest.earnings['10_yrs_after_entry'].gt_threshold ? Math.round(data.latest.earnings['10_yrs_after_entry'].gt_threshold * 100) : 0}%`)

                const firstcriticalreading = data.latest.admissions.sat_scores['25th_percentile'].critical_reading
                const secondcriticalreading = data.latest.admissions.sat_scores['75th_percentile'].critical_reading

                if (firstcriticalreading && secondcriticalreading) {
                    $('#sat-critical-reading').html(`${firstcriticalreading}-${secondcriticalreading}`)
                    $('#avg-sat-reading-writing-middle').html(`${firstcriticalreading}-${secondcriticalreading} (200 to 800)`)
                } else {
                    $('#sat-critical-reading').html('N/A')
                    $('#avg-sat-reading-writing-middle').html('-')
                }
                if (firstcriticalreading && secondcriticalreading) {
                    $('#sat-critical-reading').html(`${firstcriticalreading}-${secondcriticalreading}`)
                    $('#avg-sat-reading-writing-middle-2').html(`${firstcriticalreading}-${secondcriticalreading} (200 to 800)`)
                } else {
                    $('#sat-critical-reading').html('N/A')
                    $('#avg-sat-reading-writing-middle-2').html('-')
                }

                const firstMathreading = data.latest.admissions.sat_scores['25th_percentile'].math
                const secondMathreading = data.latest.admissions.sat_scores['75th_percentile'].math

                if (firstMathreading && secondMathreading) {
                    $('#avg-sat-middle').html(`${firstMathreading}-${secondMathreading} (200 to 800)`)
                } else {
                    $('#avg-sat-middle').html('-')
                }
                if (firstMathreading && secondMathreading) {
                    $('#avg-sat-middle-2').html(`${firstMathreading}-${secondMathreading} (200 to 800)`)
                } else {
                    $('#avg-sat-middle-2').html('-')
                }

                const firstactscore = data.latest.admissions.act_scores['25th_percentile'].cumulative
                const secondactscore = data.latest.admissions.act_scores['75th_percentile'].cumulative

                if (firstactscore && secondactscore) {
                    $('#act-score').html(`${firstactscore}-${secondactscore}`)
                    $('#avg-act-composite-middle').html(`${firstactscore}-${secondactscore} (0 to 36)`)
                    $('#avg-act-composite-middle-2').html(`${firstactscore}-${secondactscore} (0 to 36)`)
                } else {
                    $('#act-score').html('N/A')
                    $('#avg-act-composite-middle').html('-')
                }

                if (!firstcriticalreading && !secondcriticalreading && !firstactscore && !secondactscore) {
                    $('#test-score-content').html(`The admission test score (SAT/ACT) policy for ${data.school.name} is unknown.`)
                    $('.exam-detail').remove()
                }

                const calculateaccptancerate = data.latest.admissions.admission_rate.overall ? Math.round(data.latest.admissions.admission_rate.overall * 100) : 0
                if (calculateaccptancerate > 0) {
                    $('#test-info-acceptance-rate').html(`
                        <div class="progress push">
                            <div class="progress-bar" role="progressbar" style="width: ${calculateaccptancerate}%;" aria-valuenow="${calculateaccptancerate}" aria-valuemin="0" aria-valuemax="100">
                                <span class="fs-sm fw-semibold">${calculateaccptancerate}%</span>
                            </div>
                        </div>
                    `)
                    $('#test-score-acceptance-rate-percentage').html(`${calculateaccptancerate}%`)
                    $('.test-score-college-name').html(data.school.name)
                } else {
                    $('#test-info-acceptance-rate').html(`
                        <div class="no-data">Data Not Available</div>
                    `)
                }

                $('#main-college-name').html(data.school.name)
                $('#main_calendar').html((data.latest.college_info.MAIN_CALENDAR ? data.latest.college_info.MAIN_CALENDAR : '-'))

                // $('#college-map-url').attr('href', `https://www.google.com/maps/search/?api=1&query=${data.location.lat},${data.location.lon}`)


                if (data.latest.college_info.description) {
                    $('#college-description').html(`
                        <div class="fs-base lh-base fw-large mb-0 border-bottom mb-2">
                            Description
                        </div>
                        <div class="mb-2">
                            <div>${data.latest.college_info.description}</div>
                        </div>
                    `)
                } else {
                    $('#college-description').html('')
                }




                if(parseInt(data.latest.college_info.display_peterson_weighted_gpa)) {
                    console.log('Displaying Peterson Unweighted GPA')
                    $('#c-avg-accepted-weighted-gpa').html(data.latest.college_info.FRSH_GPA_WEIGHTED ? data.latest.college_info.FRSH_GPA_WEIGHTED : data.latest.college_info.weighted_gpa)
                }else{
                    $('#c-avg-accepted-weighted-gpa').html(data.latest.college_info.weighted_gpa ? data.latest.college_info.weighted_gpa : 'No Data')
                }
                if(parseInt(data.latest.college_info.display_peterson_unweighted_gpa)) {
                    console.log('Displaying Peterson weighted GPA')
                    $('#c-avg-accepted-unweighted-gpa').html(data.latest.college_info.FRSH_GPA? data.latest.college_info.FRSH_GPA : data.latest.college_info.unweighted_gpa)
                }else{
                    $('#c-avg-accepted-unweighted-gpa').html(data.latest.college_info.unweighted_gpa ? data.latest.college_info.unweighted_gpa : 'No Data')
                }

                $('#c-avg-accepted-gpa').html((data.latest.college_info.gpa_average && data.latest.college_info.gpa_average !== '0' ? data.latest.college_info.gpa_average : '-'))
                $('#c-avg-accepted-gpa-2').html((data.latest.college_info.gpa_average && data.latest.college_info.gpa_average !== '0' ? data.latest.college_info.gpa_average : '-'))
                $('#c-avg-sat-math').html((data.latest.college_info.sat_math_average && data.latest.college_info.sat_math_average !== '0' ? data.latest.college_info.sat_math_average : '-'))
                $('#c-avg-sat-math-2').html((data.latest.college_info.sat_math_average && data.latest.college_info.sat_math_average !== '0' ? data.latest.college_info.sat_math_average : '-'))
                $('#c-avg-sat-reading-weiting').html((data.latest.college_info.sat_reading_writing_average && data.latest.college_info.sat_reading_writing_average !== '0' ? data.latest.college_info.sat_reading_writing_average : '-'))
                $('#c-avg-sat-reading-weiting-2').html((data.latest.college_info.sat_reading_writing_average && data.latest.college_info.sat_reading_writing_average !== '0' ? data.latest.college_info.sat_reading_writing_average : '-'))
                $('#c-avg-act-composite').html((data.latest.college_info.act_composite_average && data.latest.college_info.act_composite_average !== '0' ? data.latest.college_info.act_composite_average : '-'))
                $('#c-avg-act-composite-2').html((data.latest.college_info.act_composite_average && data.latest.college_info.act_composite_average !== '0' ? data.latest.college_info.act_composite_average : '-'))

                if(data.latest.school.ownership == 1){
                    $('#c-in-state-cost-of-attendance-block').show()
                    $('#c-in-state-cost-of-attendance').html((data.latest.college_info.public_coa_in_state && data.latest.college_info.public_coa_in_state !== '0' ? '$'+data.latest.college_info.public_coa_in_state : '-'))
                    // $('#c-in-state-tuition-and-fees').html((data.latest.college_info.TUIT_STATE_FT_D && data.latest.college_info.TUIT_STATE_FT_D !== '0' && data.latest_college_info.FEES_FT_D ? '$'+(parseInt(data.latest.college_info.TUIT_STATE_FT_D) +  parseInt(data.latest.college_info.FEES_FT_D))    : '-'))
                    $('#c-out-state-cost-of-attendance-block').show()
                    $('#c-out-state-cost-of-attendance').html((data.latest.college_info.public_coa_out_state && data.latest.college_info.public_coa_out_state !== '0' ? '$'+data.latest.college_info.public_coa_out_state : '-'))
                    // $('#c-out-state-tuition-and-fees').html((data.latest.college_info.TUIT_NRES_FT_D && data.latest.college_info.TUIT_NRES_FT_D !== '0' && data.latest_college_info.FEES_FT_D ? '$'+( parseInt(data.latest.college_info.TUIT_NRES_FT_D) + parseInt(data.latest.college_info.FEES_FT_D) )   : '-'))
                }else{
                    $('#c-private-cost-of-attendance-block').show()
                    $('#c-private-cost-of-attendance').html((data.latest.college_info.pvt_coa && data.latest.college_info.pvt_coa !== '0' ? '$'+data.latest.college_info.pvt_coa : '-'))
                    // $('#c-pvt-tuition-and-fees').html((data.latest.college_info.TUIT_OVERALL_FT_D && data.latest.college_info.TUIT_OVERALL_FT_D !== '0' && data.latest_college_info.FEES_FT_D ? '$'+(  parseInt(data.latest.college_info.TUIT_NRES_FT_D) +  parseInt(data.latest.college_info.FEES_FT_D) )   : '-'))
                }
                // $('#c-tution-and-fees').html((data.latest.college_info.tution_and_fess && data.latest.college_info.tution_and_fess !== '0' ? '$'+data.latest.college_info.tution_and_fess : '-'))
                // $('#c-room-and-board').html((data.latest.college_info.RM_BD_D && data.latest.college_info.RM_BD_D !== '0' ? '$'+data.latest.college_info.RM_BD_D : '-'))

                const collegeInfo =  data.latest.college_info
                // console.log('collegeInfo', collegeInfo)

                let roomAndBoard = null;

                roomAndBoard = collegeInfo.room_and_board ? collegeInfo.room_and_board : null
                if (roomAndBoard == null || roomAndBoard == '') {
                    roomAndBoard = collegeInfo.RM_BD_D ? collegeInfo.RM_BD_D : null
                }

                $('#c-room-and-board').html(`${roomAndBoard ? '$'+roomAndBoard : '-'}`)

                $('#c-average-percent-of-need-met').html((data.latest.college_info.average_percent_of_need_met && data.latest.college_info.average_percent_of_need_met !== '0' ? data.latest.college_info.average_percent_of_need_met+ '%' : '-'))
                $('#c-average-freshman-award').html((data.latest.college_info.average_freshman_award && data.latest.college_info.average_freshman_award !== '0' ? '$'+data.latest.college_info.average_freshman_award : '-'))

                // $('#c-entrance-difficulty').html((data.latest.college_info.entrance_difficulty ? data.latest.college_info.entrance_difficulty : '-'))
                $('#c-entrance-difficulty').html((data.latest.college_info.AD_DIFF_ALL ? data.latest.college_info.AD_DIFF_ALL : '-'))
                $('#c-number-of-applicants').html((data.latest.college_info.AP_RECD_1ST_N ? data.latest.college_info.AP_RECD_1ST_N : '-'))


                // Campus Accordion Data
                // displayYesOrNo = (input) => input.toLowerCase() == 'y' ? 'Yes' : 'No'
                // $('#life_sor_nat').html((data.latest.college_info.LIFE_SOR_NAT ? displayYesOrNo(data.latest.college_info.LIFE_SOR_NAT) : '-'))
                // $('#life_sor_local').html((data.latest.college_info.LIFE_SOR_LOCAL ? displayYesOrNo(data.latest.college_info.LIFE_SOR_LOCAL) : '-'))
                // $('#life_frat_nat').html((data.latest.college_info.LIFE_FRAT_NAT ? displayYesOrNo(data.latest.college_info.LIFE_FRAT_NAT) : '-'))
                // $('#life_frat_local').html((data.latest.college_info.LIFE_FRAT_LOCAL ? displayYesOrNo(data.latest.college_info.LIFE_FRAT_LOCAL): '-'))

                const lifeSorNat = collegeInfo.has_national_sororities ? parseInt(collegeInfo.has_national_sororities) : (collegeInfo.LIFE_SOR_NAT == 'Y' ? 1 : 0)
                const lifeSorLocal = collegeInfo.has_local_sororities ? parseInt(collegeInfo.has_local_sororities) : (collegeInfo.LIFE_SOR_LOCAL == 'Y' ? 1 : 0)
                const lifeFratNat = collegeInfo.has_national_fraternities ? parseInt(collegeInfo.has_national_fraternities) : (collegeInfo.LIFE_FRAT_NAT == 'Y' ? 1 : 0)
                const lifeFratLocal = collegeInfo.has_local_fraternities ? parseInt(collegeInfo.has_local_fraternities) : (collegeInfo.LIFE_FRAT_LOCAL == 'Y' ? 1 : 0)

                const displayGuarantedOrNot = (input) => parseInt(input) === 1 ? 'Guaranteed' : 'Not Guaranteed'
                $('#life_sor_nat').html(displayGuarantedOrNot(lifeSorNat))
                $('#life_sor_local').html(displayGuarantedOrNot(lifeSorLocal))
                $('#life_frat_nat').html(displayGuarantedOrNot(lifeFratNat))
                $('#life_frat_local').html(displayGuarantedOrNot(lifeFratLocal))

                $('#SORO_1ST_P').html((data.latest.college_info.SORO_1ST_P ? (data.latest.college_info.SORO_1ST_P): '-'))
                $('#FRAT_1ST_P').html((data.latest.college_info.FRAT_1ST_P ? (data.latest.college_info.FRAT_1ST_P + '%'): '-'))
                $('#CMPS_METRO_T').html((data.latest.college_info.CMPS_METRO_T ? (data.latest.college_info.CMPS_METRO_T) : '-'))
                $('#HOUS_FRSH_POLICY').html((data.latest.college_info.HOUS_FRSH_POLICY ? (data.latest.college_info.HOUS_FRSH_POLICY) : '-'))
                $('#HOUS_SPACES_OCCUP').html((data.latest.college_info.HOUS_SPACES_OCCUP ? (data.latest.college_info.HOUS_SPACES_OCCUP) : '-'))



                let earlyDeadlineMonth = data.latest.college_info.AP_DL_EACT_MON;
                let earlyDeadlineDay = data.latest.college_info.AP_DL_EACT_DAY;
                let regAdmissionDeadlineDay = data.latest.college_info.AP_DL_FRSH_DAY
                let regAdmissionDeadlineMon = data.latest.college_info.AP_DL_FRSH_MON
                // let collegeInfo = data.latest.college_info
                let earlyDecision1DeadlineMon = collegeInfo.AP_DL_EDEC_1_MON
                let earlyDecision1DeadlineDay = collegeInfo.AP_DL_EDEC_1_DAY
                let earlyDecision2DeadlineMon = collegeInfo.AP_DL_EDEC_2_MON
                let earlyDecision2DeadlineDay = collegeInfo.AP_DL_EDEC_2_DAY

                function displayDate(day, month, whereToInsert){
                    if(day && month){
                        let currentYear = new Date().getFullYear()
                        let earlyActionDeadlineDate = new Date( currentYear , month - 1, day);
                        let todayDate = new Date()

                        if (earlyActionDeadlineDate < todayDate){
                            earlyActionDeadlineDate.setFullYear(earlyActionDeadlineDate.getFullYear() + 1)
                            $(whereToInsert).html((earlyActionDeadlineDate.toDateString()))
                        } else {
                            $(whereToInsert).html((earlyActionDeadlineDate.toDateString()))
                        }
                    }else{
                        $(whereToInsert).html(('No Data'))
                    }
                }

                function getAllUniqueProgrammesID(programmes){
                    const uniqueProgrammes = [...new Map(programmes.map(programme =>
                    [programme['code'], programme])).values()];
                    return uniqueProgrammes
                }
                function appendProgramme(programme){
                    let programmeMedianEarning =  programme.median_earning
                    let median
                            $("#college-content").append(`
                        <div class="block block-rounded block-bordered overflow-hidden mb-1">
                            <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#id-${programme.code}" aria-expanded="true" aria-controls="collapseFour">
                                <a class="text-white fw-600 collapsed"><i class="fa-solid fa-circle-check me-2"></i> ${programme.title}</a>
                            </div>
                            <div id="id-${programme.code}" class="collapse" aria-labelledby="headingOne1" data-bs-parent=".accordionExamplemain">
                                <div class="college-content-wrapper college-content">
                                    <p><b>Description</b></p>
                                    <p>${programme.description}</p>
                                    <p><b>Salary After Completing</b></p>
                                    <p>Median Earnings <b>${programmeMedianEarning}</b></p>
                                    <p><b>Financial Aid & Debt</b></p>
                                    <p>Median Debt After Graduation <b>${programme.debt_after_graduation}</b></p>
                                </div>
                            </div>
                        </div>
                    `);
                }

                if(programmes){
                    programmes.forEach(programme => appendProgramme(programme))
                }









                displayDate(earlyDeadlineDay, earlyDeadlineMonth, '#c-early-action-deadline')
                displayDate(regAdmissionDeadlineDay, regAdmissionDeadlineMon, '#c-regular-admission-deadline')
                displayDate(earlyDecision1DeadlineDay, earlyDecision1DeadlineMon, '#c-early-decision-1-deadline')
                displayDate(earlyDecision2DeadlineDay, earlyDecision2DeadlineMon, '#c-early-decision-2-deadline')

                function displayGPA(){


                }

                function convertStringToDate(dateString){
                    const [month, day, year] = dateString.split('-')
                    return new Date(year, month - 1, day)
                }

                let rollingAdmissionDeadline = data.latest.college_info.rolling_admission_deadline
                console.log(rollingAdmissionDeadline)
                if(rollingAdmissionDeadline){
                    const [month, day, year] = rollingAdmissionDeadline.split('-')
                    const rollingAdmissionDeadlineDate = new Date(year, month - 1, day)
                    const todayDate = new Date()
                    if(todayDate > rollingAdmissionDeadlineDate){
                        rollingAdmissionDeadlineDate.setFullYear(todayDate.getFullYear() + 1)
                    }
                    $('#c-rolling-admission-deadline').html((rollingAdmissionDeadlineDate ? rollingAdmissionDeadlineDate.toDateString() : 'No Data'))

                }

                // Athletic Division


                let ASSN_ATHL_NCAA = data.latest.college_info.ASSN_ATHL_NCAA
                ASSN_ATHL_NCAA != null ? $('#ASSN_ATHL_NCAA' + '-container').removeAttr('hidden') : ''
                $('#ASSN_ATHL_NCAA').html('NCAA Division ' + ASSN_ATHL_NCAA)
                ASSN_ATHL_NCAA != null ? $('athletic-division-no-data').prop('hidden' , true) : ''

                const athleticDivisionIDs = [
                    'ASSN_ATHL_NAIA' ,
                    'ASSN_ATHL_NCCAA',
                    'ASSN_ATHL_NJCAA',
                    'ASSN_ATHL_CIAU'
                ];

                athleticDivisionIDs.forEach( (ad) => {
                    if(data.latest.college_info.ad != null){
                        $('athletic-division-no-data').prop('hidden' , true)
                        $(`${ad}-container`).removeAttr('hidden')
                        $(`#ad`).html(data.latest.college_info.ad)
                    }
                })

                // $('#c-early-action-offered').html((data.latest.college_info.early_action_offerd === 1 ? 'Yes' : 'No'))
                // $('#c-early-decision-offerd').html((data.latest.college_info.early_decision_offerd === 1 ? 'Yes' : 'No'))
                // $('#c-regular-adminssion-deadline').html((data.latest.college_info.regular_admission_deadline ? moment(data.latest.college_info.early_decision_deadline).format('MMMM, DD') : '-'))
                // $('#c-rolling-admission-deadline').html((data.latest.college_info.regular_admission_deadline ? moment(data.latest.college_info.early_decision_deadline).format('MMMM, DD') : '-'))
                console.log(typeof(data.latest.college_info.rolling_admission_deadline))
                $('#overall-adminssion-rate').html(data.latest.admissions.admission_rate.overall ? Math.round(data.latest.admissions.admission_rate.overall * 100) + '%' : '0%')
                // $('#total-application').html(data.latest.student.FAFSA_applications)
                $('#enrollment').html(data.latest.student.size)
                $('#info-ownership').html(ownership)
                $('#info-campus').html(campus)
                $('#info-size').html(size)
                $('#college-url').attr('href', data.latest.college_info.school_url ? '//' + data.latest.college_info.school_url : '//'+data.school.school_url)
                $('#avg-anual-cost').html('$' + avganualcosr)
                const gmapKey = "{{ env('GOOGLE_MAP_KEY') }}"
                const url = "https://www.google.com/maps/embed/v1/place?key="+gmapKey+"&q=" + data.school.name + "," + data.school.city +
                    "," + data.school.state + "," + data.school.zip + "&zoom=13";
                $('#map-url').attr('src', url)
                $('#college-details').modal('show');
            } else {
                toastr.error('Oops! Something went wrong')
            }
        })
    })

    // const link = document.getElementById('college-url');

    $(document).ready(function () {
        $('#college-url').on('click', function (e) {
            e.preventDefault()
            Swal.fire({
                title: 'You are leaving the college preparation system!',
                text: "Links are provided by the institutions and are only updated about once a year. As such, over the course of the year, some links may break or website may be taken offline",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, visit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(e.target.href, '_blank')
                }
            })
        })
    })
</script>

@endsectioncon
