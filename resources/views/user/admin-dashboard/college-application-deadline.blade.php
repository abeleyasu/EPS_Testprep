@extends('layouts.user')

@section('title', 'College Application DeadLine : CPS')

@section('user-content')
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
        <div class="bg-black-10">
            <div class="content content-full text-center">
                <br>
                <h1 class="h2 text-white mb-0">College Application Deadline Organizer</h1>
                <br>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">COLLEGE LIST & APPLICATION DEADLINES</h3>
        </div>
        <div class="block-content">
            <button type="reset" class="btn btn-sm btn-success">+ Add New College</button>
            <br>
            Note: Adding or removing a college from this list will also add it to or remove it from all tools on your profile, including the My College List tool.
            <br>
            <hr>
            <hr>
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th style="width: 30px;"></th>
                        <th></th>
                        <th style="width: 20px;">Completed?</th>
                    </tr>
                </thead>
                <tbody class="js-table-sections-header">
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
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tbody class="fs-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="mb-4">
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
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="mb-4">
                                <label class="form-label" for="example-select">Admissions Option</label>
                                <select class="form-select" id="example-select" name="example-select">
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
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="mb-4">
                                <label class="form-label" for="example-select">Number of Essays</label>
                                <select class="form-select" id="example-select" name="example-select">
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
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Admissions Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Applied</option>
                                        <option value="2">Not Applied</option>
                                        <option value="3">Not Applicable</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Competitive Scholarship Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Applied</option>
                                        <option value="2">Not Applied</option>
                                        <option value="3">Not Applicable</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Departmental/STEM Scholarship Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Applied</option>
                                        <option value="2">Not Applied</option>
                                        <option value="3">Not Applicable</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Honors College Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Applied</option>
                                        <option value="2">Not Applied</option>
                                        <option value="3">Not Applicable</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">FAFSA Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Applied</option>
                                        <option value="2">Not Applied</option>
                                        <option value="3">Not Applicable</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">CSS Profile Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Applied</option>
                                        <option value="2">Not Applied</option>
                                        <option value="3">Not Applicable</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"><b>Application Checklist Complete </b></label><button type="button" class="btn btn-alt-primary w-100" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Checklist Information" data-bs-content="Once all of the checkboxes below are checked off, this checkbox will automatically be checked.">i</button>
                            </div>
                        </td>
                        <hr />
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Completed College Application?</label>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Request & pay for test scores (if applicable) to be sent to the
                                    colleges you will apply to</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Request your official high school transcripts
                                    from your counseling office</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Pay the high school transcript submittal fee
                                    (This varies by high school)</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Request letters of recommedation from your
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
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Confirm that your official high school transcripts have been sent by your high school's counseling office</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Confirm that the school report and counselor recommendation have been sent by your high school's counseling office</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Confirm that your test scores have been sent</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Confirm that your letters of recommendation have been submitted</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Pay application fee</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Submit application</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">After you submit your application, set up your student portal to confirm that the college has received your application and required documentation (Usually the college will send you an email with directions on how to set up your student portal once they've received your application) </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="col-sm-6 col-xl-3">
                                <label class="form-label" for="example-select">Final Admissions Decision</label>
                                <select class="form-select" id="example-select" name="example-select">
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
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tbody class="js-table-sections-header table-active">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td>
                            <i class="fa fa-bars"></i>
                        </td>
                        <td class="fw-semibold fs-sm">
                            University of Southern California
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_2" name="row_2">
                                <label class="form-check-label" for="row_2"></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tbody class="fs-sm">
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="mb-4">
                                <label class="form-label" for="example-select">Type of Application</label>
                                <select class="form-select" id="example-select" name="example-select">
                                    <option selected>Select One</option>
                                    <option value="1">Direct</option>
                                    <option value="2">etc</option>
                                    <option value="3">etc 2</option>
                                </select>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="mb-4">
                                <label class="form-label" for="example-select">Admissions Option</label>
                                <select class="form-select" id="example-select" name="example-select">
                                    <option selected>Select One</option>
                                    <option value="1">Early Action</option>
                                    <option value="2">etc</option>
                                    <option value="3">etc 2</option>
                                </select>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Admissions Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Not Applied</option>
                                        <option value="2">Applied</option>
                                        <option value="3">etc 2</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Competitive Scholarship Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Not Applied</option>
                                        <option value="2">Applied</option>
                                        <option value="3">etc 2</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Departmental/STEM Scholarship Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Not Applied</option>
                                        <option value="2">Applied</option>
                                        <option value="3">etc 2</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Honors College Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Not Applied</option>
                                        <option value="2">Applied</option>
                                        <option value="3">etc 2</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">FAFSA Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Not Applied</option>
                                        <option value="2">Applied</option>
                                        <option value="3">etc 2</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" for="example-select">CSS Profile Deadline</label>
                                    <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="example-select">Status</label>
                                    <select class="form-select" id="example-select" name="example-select">
                                        <option selected>Select One</option>
                                        <option value="1">Not Applied</option>
                                        <option value="2">Applied</option>
                                        <option value="3">etc 2</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"><b>Application Checklist Complete</b></label> <!-- This checkbox should populate/be checked ONLY once all of other checkboxes are checked -->
                            </div>
                        </td>
                        <hr />
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Completed College Application?</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Request & Pay for Test Scores to be sent to the
                                    colleges you applied to</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Request your official high school transcripts
                                    from your Counseling office</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Pay the high school transcript submittal fee
                                    (This varies by high school)</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Request Letters of Recommedation from your
                                    teachers and possible outside recommendations
                                </label>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Official High School Transcript Received by the
                                    College You’re Applying to? (Sent by Counseling Office)</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Mid-Year and Year-End Grade Reports
                                    (Sent by Counseling Office)</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Secondary School Reports or Counselor Recommendations (Sent by Counseling Office)</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1">Letters of Recommendation (Sent by Recommenders)</label>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="fw-semibold fs-sm">
                            <div class="col-sm-6 col-xl-3">
                                <label class="form-label" for="example-select">Final Admissions Decision</label>
                                <select class="form-select" id="example-select" name="example-select">
                                    <option selected>Select One</option>
                                    <option value="1">Accepted</option>
                                    <option value="2">Waitlisted</option>
                                    <option value="3">Denied</option>
                                </select>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection

@section('page-style')

@endsection

@section('user-script')
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
                    if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                        var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                        elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
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