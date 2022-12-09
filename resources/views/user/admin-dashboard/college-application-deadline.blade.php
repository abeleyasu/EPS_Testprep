@extends('layouts.user')

@section('title', 'College Application DeadLine : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full content-flex">
                    <br>
                    <div>
                        <h1 class="h2 text-white mb-3">College Application Deadline Organizer</h1>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-inform w-50" data-bs-toggle="popover" data-bs-placement="bottom"
                            title=""
                            data-bs-content="This is example content. You can put a description or more info here."
                            data-bs-original-title="Bottom Popover">Instructions</button>
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
                <button type="reset" class="btn btn-sm btn btn-alt-success mb-3" data-bs-toggle="modal"
                    data-bs-target="#add_new_college">+ Add New College</button>
                <p class="mb-0">
                    <span class="note-text">Note:</span> Adding or removing a college from this list will also add it to or
                    remove it from all tools on
                    your
                    profile, including the My College List tool.
                </p>
                <form>
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

                        <tbody class="js-table-sections-header table-default-active">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right"></i>
                                </td>
                                <td>
                                    <i class="fa fa-bars"></i>
                                </td>
                                <td class="fw-semibold fs-sm">
                                    Harvard University
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="College_checkAll"
                                            name="row_1">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="fs-sm">
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div>
                                        <label class="form-label" for="example-select">Type of Application</label>
                                        <select class="form-select" id="example-select" name="example-select">
                                            <option selected>Select One</option>
                                            <option value="1">Common App</option>
                                            <option value="2">Coalition App</option>
                                            <option value="3">Universal App</option>
                                            <option value="4">College System App</option>
                                            <option value="5">Apply Directly</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center ">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all " type="checkbox" value=""
                                            id="row_2" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div>
                                        <label class="form-label" for="admissions_option">Admissions Option</label>
                                        <select class="form-select" id="admissions_option" name="admissions_option">
                                            <option selected>Select One</option>
                                            <option value="1">Early Action</option>
                                            <option value="2">Regular Decision</option>
                                            <option value="3">Rolling Admissions</option>
                                            <option value="2">Early Decision</option>
                                            <option value="2">Early Decision II</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all" type="checkbox" value=""
                                            id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div>
                                        <label class="form-label" for="number_of_essays">Number of Essays</label>
                                        <select class="form-select" id="number_of_essays" name="number_of_essays">
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
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="admissions_deadline">Admissions
                                                Deadline</label>
                                            <input type="text" class="date-own form-control" id="admissions_deadline"
                                                name="admissions_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="admissions_status">Status</label>
                                            <select class="form-select" id="admissions_status" name="admissions_status">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all" type="checkbox"
                                            value="" id="" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="competitive_scholarship">Competitive
                                                Scholarship
                                                Deadline</label>
                                            <input type="text" class="date-own form-control"
                                                id="competitive_scholarship" name="competitive_scholarship"
                                                placeholder="dd/mm/yy" autocomplete="off">

                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="competitive_scholarship_status">Status</label>
                                            <select class="form-select" id="competitive_scholarship_status"
                                                name="competitive_scholarship_status">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="departmental_scholarship">Departmental/STEM
                                                Scholarship
                                                Deadline</label>
                                            <input type="text" class="date-own form-control"
                                                id="departmental_scholarship" name="departmental_scholarship"
                                                placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="departmental_scholarship_status">Status</label>
                                            <select class="form-select" id="departmental_scholarship_status"
                                                name="departmental_scholarship_status">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="honors_college">Honors College Deadline</label>
                                            <input type="text" class="date-own form-control" id="honors_college"
                                                name="honors_college" placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="honors_college_status">Status</label>
                                            <select class="form-select" id="honors_college_status"
                                                name="honors_college_status">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="fafas_deadline">FAFSA Deadline</label>
                                            <input type="text" class="date-own form-control" id="fafas_deadline"
                                                name="fafas_deadline" placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="fafas_deadline_status">Status</label>
                                            <select class="form-select" id="fafas_deadline_status"
                                                name="fafas_deadline_status">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="css_profile">CSS Profile Deadline</label>
                                            <input type="text" class="date-own form-control" id="css_profile"
                                                name="css_profile" placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="css_profile_status">Status</label>
                                            <select class="form-select" id="css_profile_status"
                                                name="css_profile_status">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                        <label class="form-check-label " for="row_1"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="Application_Checklist" name="Application_Checklist">
                                        <label class="form-check-label mb-3" for="Application_Checklist"><b>Application
                                                Checklist
                                                Complete
                                            </b></label><button type="button" class="btn btn-alt-primary w-100"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Checklist Information"
                                            data-bs-content="Once all of the checkboxes below are checked off, this checkbox will automatically be checked.">i</button>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="completed"
                                            name="completed">
                                        <label class="form-check-label" for="completed">Completed
                                            College
                                            Application?</label>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="Request_pay"
                                            name="Request_pay">
                                        <label class="form-check-label" for="Request_pay">Request & pay for test scores
                                            (if
                                            applicable) to be sent to the
                                            colleges you will apply to</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="request_your_official" name="request_your_official">
                                        <label class="form-check-label" for="request_your_official">Request your official
                                            high school
                                            transcripts
                                            from your counseling office</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="high_school_transcript" name="high_school_transcript">
                                        <label class="form-check-label" for="high_school_transcript">Pay the high school
                                            transcript
                                            submittal fee
                                            (This varies by high school)</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="request_letters" name="request_letters">
                                        <label class="form-check-label" for="request_letters">Request letters of
                                            recommedation
                                            from
                                            your
                                            teachers and outside recommenders
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="high_school_counseling_office" name="high_school_counseling_office">
                                        <label class="form-check-label" for="high_school_counseling_office">Confirm that
                                            your official high
                                            school
                                            transcripts have been sent by your high school's counseling office</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="school_report" name="school_report">
                                        <label class="form-check-label" for="school_report">Confirm that the school report
                                            and
                                            counselor recommendation have been sent by your high school's counseling
                                            office</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="test_scores"
                                            name="test_scores">
                                        <label class="form-check-label" for="test_scores">Confirm that your test scores
                                            have
                                            been
                                            sent</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="letters_of_recommendation" name="letters_of_recommendation">
                                        <label class="form-check-label" for="letters_of_recommendation">Confirm that your
                                            letters of
                                            recommendation have been submitted</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="pay_application_fee" name="pay_application_fee">
                                        <label class="form-check-label" for="pay_application_fee">Pay application
                                            fee</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="submit_application" name="submit_application">
                                        <label class="form-check-label" for="submit_application">Submit
                                            application</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="submit_your_application" name="submit_your_application">
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
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="col-sm-6 col-xl-3">
                                        <label class="form-label" for="final_admissions_decision">Final Admissions
                                            Decision</label>
                                        <select class="form-select" id="final_admissions_decision"
                                            name="final_admissions_decision">
                                            <option selected>Select One</option>
                                            <option value="1">Accepted</option>
                                            <option value="2">Denied</option>
                                            <option value="3">Pending</option>
                                            <option value="4">Waitlisted</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input form-check-input_all" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                        <label class="form-check-label" for="row_1"></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                        <tbody class="js-table-sections-header table-default-active">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right"></i>
                                </td>
                                <td>
                                    <i class="fa fa-bars"></i>
                                </td>
                                <td class="fw-semibold fs-sm">
                                    University of Southern California
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="College_checkAll1" name="College_checkAll1">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="fs-sm">
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div>
                                        <label class="form-label" for="example-select1">Type of Application</label>
                                        <select class="form-select" id="example-select1" name="example-select1">
                                            <option selected>Select One</option>
                                            <option value="1">Common App</option>
                                            <option value="2">Coalition App</option>
                                            <option value="3">Universal App</option>
                                            <option value="4">College System App</option>
                                            <option value="5">Apply Directly</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center ">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1 " type="checkbox"
                                            value="" id="row_2" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div>
                                        <label class="form-label" for="admissions_option1">Admissions Option</label>
                                        <select class="form-select" id="admissions_option1" name="admissions_option1">
                                            <option selected>Select One</option>
                                            <option value="1">Early Action</option>
                                            <option value="2">Regular Decision</option>
                                            <option value="3">Rolling Admissions</option>
                                            <option value="2">Early Decision</option>
                                            <option value="2">Early Decision II</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div>
                                        <label class="form-label" for="number_of_essays1">Number of Essays</label>
                                        <select class="form-select" id="number_of_essays1" name="number_of_essays1">
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
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="admissions_deadline1">Admissions
                                                Deadline</label>
                                            <input type="text" class="date-own form-control" id="admissions_deadline1"
                                                name="admissions_deadline1" placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="admissions_status1">Status</label>
                                            <select class="form-select" id="admissions_status1"
                                                name="admissions_status1">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="competitive_scholarship1">Competitive
                                                Scholarship
                                                Deadline</label>
                                            <input type="text" class="date-own form-control"
                                                id="competitive_scholarship1" name="competitive_scholarship1"
                                                placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="competitive_scholarship_status1">Status</label>
                                            <select class="form-select" id="competitive_scholarship_status1"
                                                name="competitive_scholarship_status">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="departmental_scholarship1">Departmental/STEM
                                                Scholarship
                                                Deadline</label>
                                            <input type="text" class="date-own form-control"
                                                id="departmental_scholarship1" name="departmental_scholarship1"
                                                placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label"
                                                for="departmental_scholarship_status1">Status</label>
                                            <select class="form-select" id="departmental_scholarship_status1"
                                                name="departmental_scholarship_status1">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="honors_college1">Honors College
                                                Deadline</label>
                                            <input type="text" class="date-own form-control" id="honors_college1"
                                                name="honors_college1" placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="honors_college_status1">Status</label>
                                            <select class="form-select" id="honors_college_status1"
                                                name="honors_college_status1">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="fafas_deadline1">FAFSA Deadline</label>
                                            <input type="text" class="date-own form-control" id="fafas_deadline1"
                                                name="fafas_deadline1" placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="fafas_deadline_status1">Status</label>
                                            <select class="form-select" id="fafas_deadline_status1"
                                                name="fafas_deadline_status1">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="css_profile1">CSS Profile Deadline</label>
                                            <input type="text" class="date-own form-control" id="css_profile1"
                                                name="css_profile1" placeholder="dd/mm/yy" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="css_profile_status1">Status</label>
                                            <select class="form-select" id="css_profile_status1"
                                                name="css_profile_status1">
                                                <option selected>Select One</option>
                                                <option value="1">Applied</option>
                                                <option value="2">Not Applied</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block td-position">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="Application_Checklist1" name="Application_Checklist1">
                                        <label class="form-check-label mb-3" for="Application_Checklist1"><b>Application
                                                Checklist
                                                Complete
                                            </b></label><button type="button" class="btn btn-alt-primary w-100"
                                            data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom"
                                            title="Checklist Information"
                                            data-bs-content="Once all of the checkboxes below are checked off, this checkbox will automatically be checked.">i</button>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="completed1"
                                            name="completed1">
                                        <label class="form-check-label" for="completed1">Completed College
                                            Application?</label>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="Request_pay1"
                                            name="Request_pay1">
                                        <label class="form-check-label" for="Request_pay1">Request & pay for test scores
                                            (if
                                            applicable) to be sent to the
                                            colleges you will apply to</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="request_your_official1" name="request_your_official1">
                                        <label class="form-check-label" for="request_your_official1">Request your official
                                            high school
                                            transcripts
                                            from your counseling office</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="high_school_transcript1" name="high_school_transcrip1t">
                                        <label class="form-check-label" for="high_school_transcript1">Pay the high school
                                            transcript
                                            submittal fee
                                            (This varies by high school)</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="request_letters1" name="request_letters1">
                                        <label class="form-check-label" for="request_letters1">Request letters of
                                            recommedation
                                            from
                                            your
                                            teachers and outside recommenders
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="high_school_counseling_office1" name="high_school_counseling_office1">
                                        <label class="form-check-label" for="high_school_counseling_office1">Confirm that
                                            your official high
                                            school
                                            transcripts have been sent by your high school's counseling office</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="school_report1" name="school_report1">
                                        <label class="form-check-label" for="school_report1">Confirm that the school
                                            report
                                            and
                                            counselor recommendation have been sent by your high school's counseling
                                            office</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="test_scores1"
                                            name="test_scores1">
                                        <label class="form-check-label" for="test_scores1">Confirm that your test scores
                                            have
                                            been
                                            sent</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="letters_of_recommendation1" name="letters_of_recommendation1">
                                        <label class="form-check-label" for="letters_of_recommendation1">Confirm that your
                                            letters of
                                            recommendation have been submitted</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="pay_application_fee1" name="pay_application_fee1">
                                        <label class="form-check-label" for="pay_application_fee1">Pay application
                                            fee</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="submit_application1" name="submit_application1">
                                        <label class="form-check-label" for="submit_application1">Submit
                                            application</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-left">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="submit_your_application1" name="submit_your_application1">
                                        <label class="form-check-label" for="submit_your_application1">After you submit
                                            your application,
                                            set
                                            up your student portal to confirm that the college has received your application
                                            and
                                            required documentation (Usually the college will send you an email with
                                            directions
                                            on how to set up your student portal once they've received your application)
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="fw-semibold fs-sm">
                                    <div class="col-sm-6 col-xl-3">
                                        <label class="form-label" for="final_admissions_decision1">Final Admissions
                                            Decision</label>
                                        <select class="form-select" id="final_admissions_decision1"
                                            name="final_admissions_decision1">
                                            <option selected>Select One</option>
                                            <option value="1">Accepted</option>
                                            <option value="2">Denied</option>
                                            <option value="3">Pending</option>
                                            <option value="4">Waitlisted</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input form-check-input_all1" type="checkbox"
                                            value="" id="row_1" name="row_1">
                                        <label class="form-check-label " for="row_1"></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </main>

    <!--Add New College Modal -->
    <div class="modal" id="add_new_college" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Header</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        ......
                    </div>
                    <div class="block-content block-content-full text-end">
                        <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn submit-btn">Submit</button>
                    </div>
                </div>
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
