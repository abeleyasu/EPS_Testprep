@extends('layouts.user')

@section('title', 'College Application DeadLine : CPS')

@section('user-content')
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="bg-black-10">
            <div class="content content-full content-flex">
                <br>
                <div>
                    <h1 class="h2 text-white mb-3">College Application Deadline Organizer</h1>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-inform w-50" data-bs-toggle="popover" data-bs-placement="bottom" title="" data-bs-content="This is example content. You can put a description or more info here." data-bs-original-title="Bottom Popover">Instructions</button>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="block block-rounded college-application-wrapper">
        <div class="block-header block-header-default block-header-main">
            <h3 class="block-title">COLLEGE LIST & APPLICATION DEADLINES</h3>
        </div>
        <div class="block-content">
            <button type="reset" class="btn btn-sm btn btn-alt-success mb-3" data-bs-toggle="modal" data-bs-target="#add_new_college">+ Add New College</button>
            <p class="mb-0">
                <span class="note-text">Note:</span> Adding or removing a college from this list will also add it to or remove it from all tools on your profile, including the My College List tool.
            </p>

            <table class="js-table-sections table">
                <thead>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th style="width: 30px;"></th>
                        <th></th>
                        <th style="width: 20px;"></th>
                    </tr>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th style="width: 30px;"></th>
                        <th></th>
                        <th style="width: 20px;"></th>
                    </tr>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th style="width: 30px;"></th>
                        <th></th>
                        <th style="width: 20px;">Completed?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colleges as $college)
                    <tr>
                        <td colspan="4">
                            <div class="js-table-sections-header table-default-active">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-center">
                                        <i class="fa fa-angle-right"></i>
                                    </div>
                                    <div>
                                        <i class="fa fa-bars"></i>
                                    </div>
                                    <div class="fw-semibold fs-sm">
                                        {{ $college->name }}
                                    </div>
                                    <div class="text-center">
                                        <div class="form-check d-inline-block">
                                            <input class="form-check-input" type="checkbox" value="" id="College_checkAll" name="row_1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="./college_application_save" method="POST">

                                <div class="fs-sm">
                                    @csrf
                                    <input type="hidden" name="college_id" id="college_id" value="{{$college->id}}">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-center"></div>
                                            <div class="text-center"></div>
                                            <div class="fw-semibold fs-sm">
                                                <div>
                                                    <label class="form-label" for="example-select">Type of Application</label>
                                                    <select class="form-select" id="type_of_application" name="type_of_application">
                                                        <option selected>Select One</option>
                                                        <option value="1">Common App</option>
                                                        <option value="2">Coalition App</option>
                                                        <option value="3">Universal App</option>
                                                        <option value="4">College System App</option>
                                                        <option value="5">Apply Directly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="form-check d-inline-block td-position">
                                                    <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_2" name="row_1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 text-center"></div>
                                        <div class="col-4 text-center"></div>
                                        <div class="col-4 fw-semibold fs-sm">
                                            <div>
                                                <label class="form-label" for="admission_option">Admissions Option</label>
                                                <select class="form-select" id="admission_option" name="admission_option">
                                                    <option selected>Select One</option>
                                                    <option value="1">Early Action</option>
                                                    <option value="2">Regular Decision</option>
                                                    <option value="3">Rolling Admissions</option>
                                                    <option value="2">Early Decision</option>
                                                    <option value="2">Early Decision II</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center">
                                            <div class="form-check d-inline-block td-position">
                                                <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_1" name="row_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 text-center"></div>
                                        <div class="col-md-2 text-center"></div>
                                        <div class="col-md-6 fw-semibold fs-sm">
                                            <label class="form-label" for="number_of_essaya">Number of Essays</label>
                                            <select class="form-select" id="number_of_essaya" name="number_of_essaya">
                                                <option selected>Select One</option>
                                                <option value="1">0</option>
                                                <option value="2">1</option>
                                                <option value="3">2</option>
                                                <option value="4">3</option>
                                                <option value="5">4</option>
                                                <option value="6">5</option>
                                                <option value="7">6</option>
                                                <option value="8">7</option>
                                                <option value="9">8</option>
                                                <option value="10">9</option>
                                                <option value="11">10</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <div class="form-check d-inline-block td-position">
                                                <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_1" name="row_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-2"></div>
                                        <div class="col-8 fw-semibold fs-sm">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label" for="admissions_deadline">Admissions Deadline</label>
                                                    <input type="text" class="date-own form-control" id="admissions_deadline" name="admissions_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="ad_status">Status</label>
                                                    <select class="form-select" id="ad_status" name="ad_status">
                                                        <option selected>Select One</option>
                                                        <option value="1">Applied</option>
                                                        <option value="2">Not Applied</option>
                                                        <option value="3">Not Applicable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <div class="form-check d-inline-block td-position">
                                                <input class="form-check-input form-check-input_all" type="checkbox" value="" id="" name="row_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-2"></div>
                                        <div class="col-8 fw-semibold fs-sm">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label" for="competitive_scholarship_deadline">Competitive Scholarship Deadline</label>
                                                    <input type="text" class="date-own form-control" id="competitive_scholarship_deadline" name="competitive_scholarship_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="csd_status">Status</label>
                                                    <select class="form-select" id="csd_status" name="csd_status">
                                                        <option selected>Select One</option>
                                                        <option value="1">Applied</option>
                                                        <option value="2">Not Applied</option>
                                                        <option value="3">Not Applicable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <div class="form-check d-inline-block td-position">
                                                <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_1" name="row_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 text-center"></div>
                                        <div class="col-md-2 text-center"></div>
                                        <div class="col-md-8 fw-semibold fs-sm">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="departmental_scholarship">Departmental/STEM Scholarship Deadline</label>
                                                    <input type="text" class="date-own form-control" id="departmental_scholarship_deadline" name="departmental_scholarship_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="dsd_status">Status</label>
                                                    <select class="form-select" id="dsd_status" name="dsd_status">
                                                        <option selected>Select One</option>
                                                        <option value="1">Applied</option>
                                                        <option value="2">Not Applied</option>
                                                        <option value="3">Not Applicable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <div class="form-check d-inline-block td-position">
                                                <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_1" name="row_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 text-center"></div>
                                        <div class="col-2 text-center"></div>
                                        <div class="col-8 fw-semibold fs-sm">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label" for="honors_college">Honors College Deadline</label>
                                                    <input type="text" class="date-own form-control" id="honors_college_deadline" name="honors_college_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="honors_college_status">Status</label>
                                                    <select class="form-select" id="hcd_status" name="hcd_status">
                                                        <option selected>Select One</option>
                                                        <option value="1">Applied</option>
                                                        <option value="2">Not Applied</option>
                                                        <option value="3">Not Applicable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <div class="form-check d-inline-block td-position">
                                                <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_1" name="row_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="fw-semibold fs-sm">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label" for="fafsa_deadline">FAFSA Deadline</label>
                                                    <input type="text" class="date-own form-control" id="fafsa_deadline" name="fafsa_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="fafsa_deadline_status">Status</label>
                                                    <select class="form-select" id="fafsa_status" name="fafsa_status">
                                                        <option selected>Select One</option>
                                                        <option value="1">Applied</option>
                                                        <option value="2">Not Applied</option>
                                                        <option value="3">Not Applicable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="form-check d-inline-block td-position">
                                                <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_1" name="row_1">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="fw-semibold fs-sm">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label" for="css_profile">CSS Profile Deadline</label>
                                                    <input type="text" class="date-own form-control" id="css_profile_deadline" name="css_profile_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="css_status">Status</label>
                                                    <select class="form-select" id="css_status" name="css_status">
                                                        <option selected>Select One</option>
                                                        <option value="1">Applied</option>
                                                        <option value="2">Not Applied</option>
                                                        <option value="3">Not Applicable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="form-check d-inline-block td-position">
                                                <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_1" name="row_1">
                                                <label class="form-check-label " for="row_1"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="" name="application_checklist[]">
                                                <label class="form-check-label mb-3" for="Application_Checklist"><b>Application Checklist Complete</b></label>
                                                <button type="button" class="btn btn-alt-primary w-100" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Checklist Information" data-bs-content="Once all of the checkboxes below are checked off, this checkbox will automatically be checked.">i</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center"></div>
                                        <div class="col text-center"></div>
                                        <div class="col text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="completed" name="application_checklist[]">
                                                <label class="form-check-label" for="completed">Completed College Application?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 text-center"></div>
                                        <div class="col-md-2 text-center"></div>
                                        <div class="col-md-8 text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="Request_pay" name="application_checklist[]">
                                                <label class="form-check-label" for="Request_pay">Request &amp; pay for test scores (if applicable) to be sent to the colleges you will apply to</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="request_your_official" name="application_checklist[]">
                                                <label class="form-check-label" for="request_your_official">Request your official high school transcripts from your counseling office</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 text-center"></div>
                                        <div class="col-md-2 text-center"></div>
                                        <div class="col-md-8 text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="high_school_transcript" name="application_checklist[]">
                                                <label class="form-check-label" for="high_school_transcript">Pay the high school transcript submittal fee (This varies by high school)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="request_letters" name="application_checklist[]">
                                                <label class="form-check-label" for="request_letters">Request letters of recommendation from your teachers and outside recommenders</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="high_school_counseling_office" name="application_checklist[]">
                                                <label class="form-check-label" for="high_school_counseling_office">Confirm that your official high school transcripts have been sent by your high school's counseling office</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="school_report" name="application_checklist[]">
                                                <label class="form-check-label" for="school_report">Confirm that the school report and counselor recommendation have been sent by your high school's counseling office</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="test_scores" name="application_checklist[]">
                                                <label class="form-check-label" for="test_scores">Confirm that your test scores
                                                    have
                                                    been
                                                    sent</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="letters_of_recommendation" name="application_checklist[]">
                                                <label class="form-check-label" for="letters_of_recommendation">Confirm that your
                                                    letters of
                                                    recommendation have been submitted</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="pay_application_fee" name="application_checklist[]">
                                                <label class="form-check-label" for="pay_application_fee">Pay application
                                                    fee</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="submit_application" name="submit_application">
                                                <label class="form-check-label" for="submit_application">Submit
                                                    application</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div class="text-left">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="checkbox" value="" id="submit_your_application" name="application_checklist[]">
                                                <label class="form-check-label" for="submit_your_application">After you submit
                                                    your application,
                                                    set
                                                    up your student portal to confirm that the college has received your application
                                                    and
                                                    required documentation (Usually the college will send you an email with
                                                    directions
                                                    on how to set up your student portal once they've received your application)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div>
                            <div class="text-center"></div>
                            <div class="text-center"></div>
                            <div class="fw-semibold fs-sm">
                                <div class="col-sm-6 col-xl-3">
                                    <label class="form-label" for="final_admissions_decision">Final Admissions Decision</label>
                                    <select class="form-select" id="final_admissions_decision" name="final_admissions_decision">
                                        <option selected>Select One</option>
                                        <option value="1">Accepted</option>
                                        <option value="2">Denied</option>
                                        <option value="3">Pending</option>
                                        <option value="4">Waitlisted</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input form-check-input_all" type="checkbox" value="" id="row_1" name="row_1">
                                    <label class="form-check-label" for="row_1"></label>
                                </div>
                            </div>
                        </div>-->

                                    <div>
                                        <div class="text-center"></div>
                                        <div class="text-center"></div>
                                        <div colspan="2" class="text-center">
                                            <button class="btn btn-primary" type="submit" value="Submit">Save</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<!--Add New College Modal -->
<div class="modal" id="add_new_college" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="./college_save" method="POST">
                @csrf
                <div class="block block-rounded block-transparent mb-0">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="block-header">
                        <h3 class="block-title">Header</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <div class="mb-4 col-md-8">
                            <label for="">College Name</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="College Name" value="">
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-8">
                            <label for="">City</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('city') ? 'is-invalid' : ''}}" id="city" name="city" placeholder="City Name" value="">
                            @error('city')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-8">
                            <label for="">State</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('state') ? 'is-invalid' : ''}}" id="state" name="state" placeholder="State Name" value="">
                            @error('state')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end">
                        <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn submit-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Add New College Modal -->
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/college-application-deadline.css') }}">

@endsection

@section('user-script')
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    $('.date-own').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '-3d'
    });


    $(document).ready(function() {
        $('#College_checkAll').click(function() {
            $('.form-check-input_all').prop('checked', this.checked);
        });

        $('.form-check-input_all').change(function() {
            var check = ($('.form-check-input_all').filter(":checked").length == $('.form-check-input_all').length);
            $('#College_checkAll').prop("checked", check);
        });
    });

    $(document).ready(function() {
        $('#College_checkAll1').click(function() {
            $('.form-check-input_all1').prop('checked', this.checked);
        });

        $('.form-check-input_all1').change(function() {
            var check = ($('.form-check-input_all1').filter(":checked").length == $('.form-check-input_all1').length);
            $('#College_checkAll1').prop("checked", check);
        });
    });
</script>
<script>
    One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);
</script>
<script>
    // <![CDATA[  <-- For SVG support
    if ('WebSocket' in window) {
        (function() {
            function refreshCSS() {
                var sheets = [].slice.call(document.getElementsByTagName("link"));
                var head = document.getElementsByTagName("head")[0];
                for (var i = 0; i < sheets.length; ++i) {
                    var elem = sheets[i];
                    var parent = elem.parentElement || head;
                    parent.removeChild(elem);
                    var rel = elem.rel;
                    if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                        "stylesheet") {
                        var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                        elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                            .valueOf());
                    }
                    parent.appendChild(elem);
                }
            }
            var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
            var address = protocol + window.location.host + window.location.pathname + '/ws';
            var socket = new WebSocket(address);
            socket.onmessage = function(msg) {
                if (msg.data == 'reload') window.location.reload();
                else if (msg.data == 'refreshcss') refreshCSS();
            };
            if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                console.log('Live reload enabled.');
                sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
            }
        })();
    } else {
        console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
    }
    // ]]>
</script>
@endsection