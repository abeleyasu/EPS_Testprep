@extends('layouts.user')

@section('title', 'Initial College List : CPS')

@section('user-content')
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
        <div class="bg-black-10">
            <div class="content content-full text-center">
                <br>
                <h1 class="h2 text-white mb-0">Initial College List</h1>
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
                @foreach($college_data as $key => $college)
                    <div class="block block-rounded mb-3">
                        <div class="block-header block-header-default block-header-main">
                            <h3 class="block-title">{{ $college->{'school.name'} }}</h3>
                            <div class="block-options">
                                <button type="button" class="btn btn-sm btn-alt-success college-details" data-id="{{ $college->id }}">College Details</button>
                                @if(in_array($college->id, $selected_college))
                                    <button type="button" class="btn btn-sm btn-alt-danger remove-list" data-id="{{ $college->id }}">Remove College From List</button>
                                @else
                                    <button type="button" class="btn btn-sm btn-alt-success add-list" data-id="{{ $college->id }}">Add to My College List</button>
                                @endif
                            </div>
                        </div>
                        <div class="block-content mb-">
                            <div class="college-search-wrapper">
                                <h2>{{ $college->{'school.city'} }}, {{ $college->{'school.state'} }}</h2>
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
                                                        @switch($college->{'school.ownership'})
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
                                                    <i class="fa fa-city fa-2x college-years text-black-50"></i>
                                                    <div class="fs-3 fw-semibold mt-3">Campus</div>
                                                    @switch($college->{'school.locale'})
                                                        @case(11 || 12 || 13)
                                                            <div>City</div>
                                                        @break
                                                        @case(21 || 22 || 23)
                                                            <div>Suburban</div>
                                                        @break
                                                        @case(31 || 32 || 33)
                                                            <div>Town</div>
                                                        @break
                                                        @case(41 || 42 || 43)
                                                            <div>Rural</div>
                                                        @break
                                                        @default
                                                            <div>N/A</div>
                                                        @break
                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="block block-rounded text-center mb-3">
                                                <div class="block-content py-3 bg-secondary text-white">
                                                    <i class="fa fa-users fa-2x college-years text-black-50"></i>
                                                    <div class="fs-3 fw-semibold mt-3">Size</div>
                                                    @if($college->{'latest.student.size'} < 2000)
                                                        <div>Small</div>
                                                    @elseif($college->{'latest.student.size'} > 2000 && $college->{'latest.student.size'} < 15000)
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
                                                    @if($college->{'latest.completion.consumer_rate'})
                                                        {{ number_format($college->{'latest.completion.consumer_rate'} * 100, 0) . '%' }}
                                                    @else    
                                                        N/A
                                                    @endif
                                                </p>
                                                <p><b>Average Annual Cost:</b> 
                                                    @if($college->{'latest.cost.avg_net_price.overall'})
                                                        {{ '$' . number_format($college->{'latest.cost.avg_net_price.overall'} / 1000, 0) . 'k' }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>
                                                <p><b>Median Earnings:</b>
                                                    @if($college->{'latest.earnings.10_yrs_after_entry.median'})
                                                        {{ '$' . number_format($college->{'latest.earnings.10_yrs_after_entry.median'} / 1000, 0) . 'k' }}
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
            @endif
            <div class="d-flex justify-content-between mt-3">
                <div class="prev-btn">
                    <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}" class="btn btn-alt-success prev-step"> Previous Step
                    </a>
                </div>
                <div class="">
                    <a href="{{ route('admin-dashboard.initialCollegeList.step3', ['college_lists_id' => request()->get('college_lists_id')]) }}" class="btn  btn-alt-success next-step">Next Step</a>
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
                    <h3 class="block-title">UC Berkeley</h3>
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
                                                <a class="text-info" id="college-url" href="" target="_blank">Website <i class="fa fa-arrow-right"></i></a>
                                            </div>
                                            <div class="fs-base lh-base fw-large mb-0 border-bottom mb-2">
                                                <i class="fa fa-graduation-cap"></i> Admissions
                                            </div>
                                            <div class="block-title mb-2">
                                                <div>OVERALL ADMISSION RATE</div>
                                                <small><span id="overall-adminssion-rate"></span></small>
                                                <!-- out of <span id="total-application"></span> total applicants -->
                                            </div>
                                            <div class="block-title mb-2">
                                                <div>AVERAGE ACCEPTED GPA</div>
                                                <small id="avg-accepted-gpa">3.89</small>
                                            </div>
                                            <div class="block-title mb-2">
                                                <div>AVERAGE ACT / SAT SCORES</div>
                                                <small id="avg-act-sat-score">30 / 1350</small>
                                            </div>
                                            <div class="block-title mb-2">
                                                <div>ENROLLMENT</div>
                                                <small><span id="enrollment"></span> Undergraduates</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
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
                                
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <a class=" text-white fw-600 collapsed"><i class="fa-solid fa-comments-dollar me-2"></i> Fields of Study</a>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-bs-parent=".accordionExample">
                                        <div class="college-content-wrapper college-content">
                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                    <a class=" text-white fw-600 collapsed"><i class="fa-solid fa-circle-check me-2"></i> Architecture</a>
                                                </div>
                                                <div id="collapseFour" class="collapse " aria-labelledby="headingOne1" data-bs-parent=".accordionExamplemain">
                                                    <div class="college-content-wrapper college-content">
                                                        <p><b>Salary After Completing</b></p>
                                                        <p>Median Earnings <b>$79,000</b></p>
                                                        <p><b>Financial Aid & Debt</b></p>
                                                        <p>Median Debt After Graduation <b>$25,000</b></p>
                                                        <p><b>Additional Information</b></p>
                                                        <p class="mb-0">Number of Graduates <b>250</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                    <a class=" text-white fw-600 collapsed"><i class="fa-solid fa-circle-check me-2"></i> Accounting</a>
                                                </div>
                                                <div id="collapseFive" class="collapse" aria-labelledby="headingOne1" data-bs-parent=".accordionExamplemain">
                                                    <div class="college-content-wrapper college-content">
                                                        <p><b>Salary After Completing</b></p>
                                                        <p>Median Earnings <b>$79,000</b></p>
                                                        <p><b>Financial Aid & Debt</b></p>
                                                        <p>Median Debt After Graduation <b>$25,000</b></p>
                                                        <p><b>Additional Information</b></p>
                                                        <p class="mb-0">Number of Graduates <b>250</b></p>
                                                    </div>
                                                </div>
                                            </div>


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
                                                        <p id="test-score-content">University of Health Sciences and Pharmacy in St. Louis has an acceptance rate of 91%. University of Health Sciences and Pharmacy in St. Louis considers admission test scores (SAT/ACT) during the application process, but does not require them. Students who were admitted to University of Health Sciences and Pharmacy in St. Louis and enrolled typically had admission test scores in these ranges.</p>
                                                        <div class="mb-2 exam-detail">
                                                            <h2 class="block-title">SAT</h2>
                                                            <div>CRITICAL READING: <span id="sat-critical-reading">530-620</span></div>
                                                            <div>Math: <span id="sat-math-score">580-620</span></div>
                                                        </div>
                                                        <div class="mb-2 exam-detail">
                                                            <h2 class="block-title">ACT: <span id="act-score">530-620</span></h2>
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
</style>
@endsection

@section('user-script')
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
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
    $(document).on('click', '.add-list', function (e) {
        const schools = @json($college_data);
        const college_list_id = "{{ request()->get('college_lists_id') }}"
        const school = schools.find(college => college.id == e.target.dataset.id)
        $.ajax({
            type: "POST",
            url: "{{ route('admin-dashboard.initialCollegeList.step2.saveCollege') }}",
            data: {
                school_lists_id: college_list_id,
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
                let url = "{{ route('admin-dashboard.initialCollegeList.step2.removeCollge', [ 'id' => request()->get('college_lists_id'), 'sid' => 'school_id' ]) }}"
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
                const data = response.data
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
                        campus = 'Suburb'
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
                } else {
                    $('#sat-critical-reading').html('N/A')
                }
                
                const firstactscore = data.latest.admissions.act_scores['25th_percentile'].cumulative
                const secondactscore = data.latest.admissions.act_scores['75th_percentile'].cumulative

                if (firstactscore && secondactscore) {
                    $('#act-score').html(`${firstactscore}-${secondactscore}`)
                } else {
                    $('#act-score').html('N/A')
                }

                if (!firstcriticalreading && !secondcriticalreading && !firstactscore && !secondactscore) {
                    $('#test-score-content').html(`The admission test score (SAT/ACT) policy for ${data.school.name} is unknown.`)
                    $('.exam-detail').remove()
                }

                const calculateaccptancerate = data.latest.completion.consumer_rate ? Math.round(data.latest.completion.consumer_rate * 100) : 0
                if (calculateaccptancerate > 0) {
                    $('#test-info-acceptance-rate').html(`
                        <div class="progress push">
                            <div class="progress-bar" role="progressbar" style="width: ${calculateaccptancerate}%;" aria-valuenow="${calculateaccptancerate}" aria-valuemin="0" aria-valuemax="100">
                                <span class="fs-sm fw-semibold">${calculateaccptancerate}%</span>
                            </div>
                        </div>
                    `)
                } else {
                    $('#test-info-acceptance-rate').html(`
                        <div class="no-data">Data Not Available</div>
                    `)
                }


                $('#overall-adminssion-rate').html(data.latest.admissions.admission_rate.overall ? Math.round(data.latest.admissions.admission_rate.overall * 100) + '%' : '0%')
                // $('#total-application').html(data.latest.student.FAFSA_applications)
                $('#enrollment').html(data.latest.student.size)
                $('#info-ownership').html(ownership)
                $('#info-campus').html(campus)
                $('#info-size').html(size)
                $('#college-url').attr('href', data.school.school_url)
                $('#avg-anual-cost').html('$' + avganualcosr)
                $('#college-details').modal('show');
            } else {
                toastr.error('Oops! Something went wrong')
            }
            console.log('response -->', response)
        })
    })
</script>

@endsectioncon