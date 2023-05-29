@extends('layouts.user')

@section('title', 'College Application DeadLine : CPS')

@section('user-content')
<style>
    .college-content {
        padding: 10px 20px;
    }

    .list-content {
        display: flex;
        align-items: center;
    }

    .colleg-add-header {
        background: #1f2937;
        color: #fff;
    }

    .block-content {
        padding: 15px;
    }

    /* #page-container.page-header-fixed #main-container {
        padding-top: 0px;
    } */
</style>
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column justify-content-center">
                <h1 class="h3 mb-3">College Application Deadline Organizer</h1>
                <span>
                    <button type="button" class="btn btn-inform" data-bs-toggle="popover" data-bs-placement="bottom" title="" data-bs-content="This is example content. You can put a description or more info here." data-bs-original-title="Bottom Popover">Instructions</button>
                </span>
            </div>
        </div>
    </div>
    <div class="block block-rounded college-application-wrapper">
        <div class="block-header block-header-default block-header-main">
            <h3 class="block-title">COLLEGE LIST & APPLICATION DEADLINES</h3>
        </div>
        <div class="block-content">
            <button type="reset" class="btn btn-sm btn btn-alt-success mb-3" data-bs-toggle="modal" data-bs-target="#add_new_college">+ Add New College</button>
            <p>
                <span class="note-text">Note:</span> Adding or removing a college from this list will also add it to or remove it from all tools on your profile, including the My College List tool.
            </p>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="tab-content" id="myTabContent">
                <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                    <div class="accordion accordionExample accordionExample2">
                        @foreach($college_list_deadline as $i => $college)
                        <form action="{{route('admin-dashboard.college_application_save')}}" id="form-{{ $i }}" method="POST">
                            @csrf
                            <input type="hidden" name="college_id" value="{{ $college['id'] }}">

                            @if($college['college_details']) 
                                <input type="hidden" name="college_detail_id" value="{{ $college['college_details']['id'] }}">
                            @endif

                            <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                <div class="block-header block-header-tab row">
                                    <div class="col-10" type="button" data-toggle="collapse" data-target="#collapse{{ $i }}" aria-expanded="true">
                                        <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-angle-right" id="toggle{{ $i }}"></i>{{ $college['name'] }}</a> 
                                    </div>
                                    <div class="col-2">
                                        <input class="form-check-input form-check-input_all chagecollagecheckbox" id="iscompleted-{{ $i }}" data-college_id="{{$college['id']}}" data-college_detail_id="{{ $college['college_details'] ? $college['college_details']['id'] : null  }}" @if($college['college_details'] && $college['college_details']['is_completed_all_process']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_completed_all_process'] : '' }}" name="is_completed_all_process" type="checkbox" value="">
                                    </div>
                                </div>
                                <div id="collapse{{ $i }}" class="collapse" aria-labelledby="headingOne" data-id="{{ $i }}" data-parent=".accordionExample">
                                    <div class="college-content-wrapper college-content">
                                        <div class="row mb-3 list-content">
                                            <label class="form-label" for="type_of_application-{{ $i }}">Type of Application</label>
                                            <div class="col-10">
                                                <select class="form-select" id="type_of_application-{{ $i }}" name="type_of_application">
                                                    <option value="">Select One</option>
                                                    @foreach($applications as $application)
                                                        <option value="{{ $application }}" @if($college['college_details'] && $college['college_details']['type_of_application'] == $application) selected @endif>{{ $application }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_complete_application_type" name="is_complete_application_type" @if($college['college_details'] && $college['college_details']['is_complete_application_type']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_submit_application'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3 list-content">
                                            <label class="form-label" for="admission_option-{{ $i }}">Admission Open</label>
                                            <div class="col-10">
                                                <select class="form-select" id="admission_option-{{ $i }}" name="admission_option">
                                                    <option value="">Select One</option>
                                                    @foreach($admision_option as $admission)
                                                        <option value="{{ $admission }}" @if($college['college_details'] && $college['college_details']['admission_option'] == $admission) selected @endif>{{ $admission }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_complete_admission_open-{{ $i }}" name="is_complete_admission_open" @if($college['college_details'] && $college['college_details']['is_complete_admission_open']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_complete_admission_open'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3 list-content">
                                            <label class="form-label" for="number_of_essaya-{{ $i }}">Number of Essays</label>
                                            <div class="col-10">
                                                <select class="form-select" id="number_of_essaya-{{ $i }}" name="number_of_essaya">
                                                    <option value="">Select One</option>
                                                    @for($Essays = 0; $Essays <= 10; $Essays++)
                                                        <option value="{{ $Essays }}" @if($college['college_details'] && $college['college_details']['number_of_essaya'] == $Essays) selected @endif>{{ $Essays }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_complete_number_of_essays-{{ $i }}" name="is_complete_number_of_essays" @if($college['college_details'] && $college['college_details']['is_complete_number_of_essays']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_complete_number_of_essays'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3 list-content">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label" for="admissions_deadline-{{ $i }}">Admissions Deadline</label>
                                                        <input type="text" class="date-own form-control" id="admissions_deadline-{{ $i }}" name="admissions_deadline" value="{{ $college['college_details'] ? $college['college_details']['admissions_deadline'] : '' }}" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="ad_status">Status</label>
                                                        <select class="form-select" id="ad_status" name="ad_status">
                                                            <option value="">Select One</option>
                                                            @foreach($college_list_status as $status)
                                                                <option value="{{ $status }}" @if($college['college_details'] && $college['college_details']['ad_status'] == $status) selected @endif>{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_complete_admission_deadline-{{ $i }}" name="is_complete_admission_deadline" @if($college['college_details'] && $college['college_details']['is_complete_admission_deadline']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_complete_admission_deadline'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3 list-content">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label" for="competitive_scholarship_deadline-{{ $i }}">Competitive Scholarship Deadline</label>
                                                        <input type="text" class="date-own form-control" id="competitive_scholarship_deadline-{{ $i }}" value="{{ $college['college_details'] ? $college['college_details']['competitive_scholarship_deadline'] : '' }}" name="competitive_scholarship_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="csd_status">Status</label>
                                                        <select class="form-select" id="csd_status" name="csd_status">
                                                            <option value="">Select One</option>
                                                            @foreach($college_list_status as $status)
                                                                <option value="{{ $status }}" @if($college['college_details'] && $college['college_details']['csd_status'] == $status) selected @endif>{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_complete_competitive_scholarship_deadline-{{ $i }}" name="is_complete_competitive_scholarship_deadline" @if($college['college_details'] && $college['college_details']['is_complete_competitive_scholarship_deadline']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_complete_competitive_scholarship_deadline'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3 list-content">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label" for="departmental_scholarship_deadline-{{ $i }}">Departmental/STEM Scholarship Deadline</label>
                                                        <input type="text" class="date-own form-control" id="departmental_scholarship_deadline-{{ $i }}" value="{{ $college['college_details'] ? $college['college_details']['departmental_scholarship_deadline'] : '' }}" name="departmental_scholarship_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="dsd_status">Status</label>
                                                        <select class="form-select" id="dsd_status" name="dsd_status">
                                                            <option value="">Select One</option>
                                                            @foreach($college_list_status as $status)
                                                                <option value="{{ $status }}" @if($college['college_details'] && $college['college_details']['dsd_status'] == $status) selected @endif>{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_complete_scholarship_deadline-{{ $i }}" name="is_complete_scholarship_deadline" @if($college['college_details'] && $college['college_details']['is_complete_scholarship_deadline']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_complete_scholarship_deadline'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3 list-content">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label" for="honors_college_deadline-{{ $i }}">Honors College Deadline</label>
                                                        <input type="text" class="date-own form-control" id="honors_college_deadline-{{ $i }}" value="{{ $college['college_details'] ? $college['college_details']['honors_college_deadline'] : '' }}" name="honors_college_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="hcd_status">Status</label>
                                                        <select class="form-select" id="hcd_status" name="hcd_status">
                                                            <option value="">Select One</option>
                                                            @foreach($college_list_status as $status)
                                                                <option value="{{ $status }}" @if($college['college_details'] && $college['college_details']['hcd_status'] == $status) selected @endif>{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_completed_honors_college_deadline-{{ $i }}" name="is_completed_honors_college_deadline" @if($college['college_details'] && $college['college_details']['is_completed_honors_college_deadline']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_completed_honors_college_deadline'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3 list-content">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label" for="fafsa_deadline-{{ $i }}">FAFSA Deadline</label>
                                                        <input type="text" class="date-own form-control" id="fafsa_deadline-{{ $i }}" value="{{ $college['college_details'] ? $college['college_details']['fafsa_deadline'] : '' }}" name="fafsa_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="fafsa_status">Status</label>
                                                        <select class="form-select" id="fafsa_status" name="fafsa_status">
                                                            <option value="">Select One</option>
                                                            @foreach($college_list_status as $status)
                                                                <option value="{{ $status }}" @if($college['college_details'] && $college['college_details']['fafsa_status'] == $status) selected @endif>{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_completed_fafsa_deadline-{{ $i }}" name="is_completed_fafsa_deadline" @if($college['college_details'] && $college['college_details']['is_completed_fafsa_deadline']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_completed_fafsa_deadline'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3 list-content">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label" for="css_profile_deadline-{{ $i }}">CSS Profile Deadline</label>
                                                        <input type="text" class="date-own form-control" id="css_profile_deadline-{{ $i }}" value="{{ $college['college_details'] ? $college['college_details']['css_profile_deadline'] : '' }}" name="css_profile_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="css_status">Status</label>
                                                        <select class="form-select" id="css_status" name="css_status">
                                                            <option value="">Select One</option>
                                                            @foreach($college_list_status as $status)
                                                                <option value="{{ $status }}" @if($college['college_details'] && $college['college_details']['css_status'] == $status) selected @endif>{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-input_all status" id="is_completed_css_profile_deadline-{{ $i }}" name="is_completed_css_profile_deadline" @if($college['college_details'] && $college['college_details']['is_completed_css_profile_deadline']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_completed_css_profile_deadline'] : '' }}" type="checkbox">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all application_checklist" id="is_application_checklist-{{ $i }}" name="is_application_checklist" @if($college['college_details'] && $college['college_details']['is_application_checklist']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_application_checklist'] : '' }}" type="checkbox">
                                                <b class="ml-4">Application Checklist Complete</b>
                                                <i class="fa fa-2x fa-circle-info" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Checklist Information" data-bs-content="Once all of the checkboxes below are checked off, this checkbox will automatically be checked."></i>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_completed_application-{{ $i }}" value="{{ $college['college_details'] ? $college['college_details']['is_completed_application'] : '' }}" @if($college['college_details'] && $college['college_details']['is_completed_application']) checked @endif name="is_completed_application" type="checkbox">
                                                Completed College Application?
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_request_pay-{{ $i }}" name="is_request_pay" @if($college['college_details'] && $college['college_details']['is_request_pay']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_request_pay'] : '' }}" type="checkbox">
                                                Request & pay for test scores (if applicable) to be sent to the colleges you will apply to
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_high_school_transcript-{{ $i }}" name="is_high_school_transcript" @if($college['college_details'] && $college['college_details']['is_high_school_transcript']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_high_school_transcript'] : '' }}" type="checkbox">
                                                Pay the high school transcript submittal fee (This varies by high school)
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_letter_of_recommedation-{{ $i }}" name="is_letter_of_recommedation" @if($college['college_details'] && $college['college_details']['is_letter_of_recommedation']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_letter_of_recommedation'] : '' }}" type="checkbox">
                                                Request letters of recommedation from your teachers and outside recommenders
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_your_offical_high_school_transcripts-{{ $i }}" name="is_your_offical_high_school_transcripts" @if($college['college_details'] && $college['college_details']['is_your_offical_high_school_transcripts']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_your_offical_high_school_transcripts'] : '' }}" type="checkbox">
                                                Confirm that your official high school transcripts have been sent by your high school's counseling office
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_school_report_and_counselor-{{ $i }}" name="is_school_report_and_counselor" @if($college['college_details'] && $college['college_details']['is_school_report_and_counselor']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_school_report_and_counselor'] : '' }}" type="checkbox">
                                                Confirm that the school report and counselor recommendation have been sent by your high school's counseling office
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_test_scores_sent-{{ $i }}" name="is_test_scores_sent" @if($college['college_details'] && $college['college_details']['is_test_scores_sent']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_test_scores_sent'] : '' }}" type="checkbox">
                                                Confirm that your test scores have been sent
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_letters_of_recommendation_submitted-{{ $i }}" name="is_letters_of_recommendation_submitted" @if($college['college_details'] && $college['college_details']['is_letters_of_recommendation_submitted']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_letters_of_recommendation_submitted'] : '' }}" type="checkbox">
                                                Confirm that your letters of recommendation have been submitted
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_pay_application_fee-{{ $i }}" name="is_pay_application_fee" @if($college['college_details'] && $college['college_details']['is_pay_application_fee']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_pay_application_fee'] : '' }}" type="checkbox">
                                                Pay application fee
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input class="form-check-input form-check-input_all status application-{{ $i }}" id="is_submit_application-{{ $i }}" name="is_submit_application" @if($college['college_details'] && $college['college_details']['is_submit_application']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_submit_application'] : '' }}" type="checkbox">
                                                Submit application
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col d-flex">
                                                <input class="form-check-input form-check-input_all inline-block me-1 status application-{{ $i }}" id="is_received_application-{{ $i }}" name="is_received_application" @if($college['college_details'] && $college['college_details']['is_received_application']) checked @endif value="{{ $college['college_details'] ? $college['college_details']['is_received_application'] : '' }}" type="checkbox">
                                                After you submit your application, set up your student portal to confirm that the college has received your application and required documentation <br>
                                                (Usually the college will send you an email with directions on how to set up your student portal once they've received your application)
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-end">
                                            <button class="btn btn-alt-success" type="submit" value="Submit">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
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
                    <div class="block-header colleg-add-header">
                        <h3 class="block-title">Header</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row block-content">
                        <div class="col-12 mb-3">
                            <label for="">College Name</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="College Name" value="">
                            @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="">City</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('city') ? 'is-invalid' : ''}}" id="city" name="city" placeholder="City Name" value="">
                            @error('city')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
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
<link rel="stylesheet" href="{{ asset('css/collegeExploration.css') }}">
@endsection

@section('user-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script>
    One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);
    $('#myTabContent').on('show.bs.collapse', function (e) {
        const id = e.target.dataset.id;
        $('#toggle' + id).removeClass('fa-angle-right').addClass('fa-angle-down');
    })

    $('#myTabContent').on('hidden.bs.collapse', function (e) {
        const id = e.target.dataset.id;
        $('#toggle' + id).removeClass('fa-angle-down').addClass('fa-angle-right');
    })

    $('.chagecollagecheckbox').on('change', function (e) {
        $.ajax({
            url: "{{ route('admin-dashboard.set_application_completed') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                is_completed_all_process: e.target.checked ? 1 : 0,
                ...e.target.dataset
            }
        }).done(function(data){
            window.location.reload();
        });
    })

    $('.application_checklist').on('change', function (e) {
        const id = e.target.id;
        const currentIndex = id.split('-')[1];
        const applications = document.querySelectorAll('.application-' + currentIndex);
        applications.forEach((application) => {
            application.checked = e.target.checked;
            application.value = e.target.checked ? 1 : 0;
        })
        $('#' + id).val(e.target.checked ? 1 : 0);
    })

    $('.status').on('change', function (e) {
        const id = e.target.id;
        $('#' + id).val(e.target.checked ? 1 : 0);
    })

    $('.date-own').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '-3d'
    });
    $(document).ready(function() {
        const errors = {{ $errors->count() }};
        if(errors > 0) {
            $('#add_new_college').modal('show');
        }
    });
</script>
@endsection