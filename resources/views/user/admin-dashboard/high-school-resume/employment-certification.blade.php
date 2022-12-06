@extends('layouts.user')

@section('title', 'HSR | Employment & Certification : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    <h1 class="h2 text-white mb-0">High School Resume Tool</h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="custom-tab-container ">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <p class="d-none">1</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <p class="d-none">2</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Education </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.honors') }}" id="step3-tab">
                            <p class="d-none">3</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Honors </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <p class="d-none">4</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active"
                            href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}" id="step5-tab">
                            <p>5</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)"
                            id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" action="{{ isset($employmentCertification) ? route('admin-dashboard.highSchoolResume.employmentCertification.update', $employmentCertification->id) : route('admin-dashboard.highSchoolResume.employmentCertification.store') }}" method="POST">
                    @csrf
                    @if(isset($employmentCertification))
                        @method('PUT')
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> Employment & Certifications</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="employment_data_table_row">
                                                            <input type="hidden" name="employment_data" id="employment_data" value="{{ !empty($employmentCertification->employment_data) ? $employmentCertification->employment_data : old('employment_data') }}">
                                                            <td>
                                                                <label class="form-label" for="job_title">
                                                                    Job title
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('employment_data') is-invalid @enderror"
                                                                    value="{{ old('job_title') }}" id="job_title"
                                                                    name="job_title" placeholder="Enter Job title">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 @error('employment_data') is-invalid @enderror select" id="employment_grade"
                                                                    name="employment_grade[]" multiple="multiple">
                                                                    <option {{ in_array("1st grade" ,is_array(old('employment_grade')) ? old('employment_grade') : []) ? 'selected' : ' '}} value="1st grade">1st grade</option>
                                                                    <option {{ in_array("2st grade" ,is_array(old('employment_grade')) ? old('employment_grade') : []) ? 'selected' : ' '}} value="2st grade">2st grade</option>
                                                                    <option {{ in_array("3st grade" ,is_array(old('employment_grade')) ? old('employment_grade') : []) ? 'selected' : ' '}} value="3st grade">3st grade</option>
                                                                    <option {{ in_array("4st grade" ,is_array(old('employment_grade')) ? old('employment_grade') : []) ? 'selected' : ' '}} value="4st grade">4st grade</option>
                                                                    <option {{ in_array("5st grade" ,is_array(old('employment_grade')) ? old('employment_grade') : []) ? 'selected' : ' '}} value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('employment_data') is-invalid @enderror"
                                                                    id="employment_location" name="employment_location"
                                                                    value="{{ old('employment_location') }}"
                                                                    placeholder="Enter Location">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="employment_honor_award">
                                                                    Honor / Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('employment_data') is-invalid @enderror"
                                                                    id="employment_honor_award"
                                                                    name="employment_honor_award"
                                                                    value="{{ old('employment_honor_award') }}"
                                                                    placeholder="Enter Honor / Award">
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addEmploymentData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('employment_data') bg-danger @enderror"></i>
                                                                    @error('employment_data') 
                                                                        <span class="ms-2 me-2 invalid">Click on add icon to insert employment data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($employmentCertification->employment_data) || !empty(old('employment_data')))
                                                            @php
                                                                $employment_data = !empty($employmentCertification->employment_data) ? $employmentCertification->employment_data : old('employment_data');
                                                            @endphp
                                                            @foreach(json_decode($employment_data) as $employment_data)
                                                                <tr id="employment_{{ $employment_data->id }}">
                                                                    <td class="job_title">{{ $employment_data->job_title }}</td>
                                                                    <td class="employment_grade">{{ implode(", ",json_decode($employment_data->employment_grade)) }}</td>
                                                                    <td class="employment_location">{{ $employment_data->employment_location }}</td>
                                                                    <td class="employment_honor_award">{{ $employment_data->employment_honor_award }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $employment_data->id }}" onclick="employment_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $employment_data->id }}" onclick="employment_model_remove(this)"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <a class="text-white fw-600 collapsed">Other Significant Responsibilities or
                                            interests</a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse {{ $errors->has('significant_data') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="significant_data_table_row">
                                                            <input type="hidden" name="significant_data" id="significant_data" value="{{ !empty($employmentCertification->significant_data) ? $employmentCertification->significant_data : old('significant_data') }}">
                                                            <td>
                                                                <label class="form-label"
                                                                    for="responsibility_interest">
                                                                    Responsibility or interest
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('significant_data') is-invalid @enderror"
                                                                    value="{{ old('responsibility_interest') }}"
                                                                    id="responsibility_interest"
                                                                    name="responsibility_interest"
                                                                    placeholder="Enter Responsibility/interest">
                                                            </td>
                                                            <td>
                                                                <label class="form-label"
                                                                    for="significant_grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 select @error('significant_data') is-invalid @enderror"
                                                                    id="significant_grade"
                                                                    name="significant_grade[]"
                                                                    multiple="multiple">
                                                                    <option {{ in_array("1st grade" ,is_array(old('significant_grade')) ? old('significant_grade') : []) ? 'selected' : ' '}} value="1st grade">1st grade</option>
                                                                    <option {{ in_array("2st grade" ,is_array(old('significant_grade')) ? old('significant_grade') : []) ? 'selected' : ' '}} value="2st grade">2st grade</option>
                                                                    <option {{ in_array("3st grade" ,is_array(old('significant_grade')) ? old('significant_grade') : []) ? 'selected' : ' '}} value="3st grade">3st grade</option>
                                                                    <option {{ in_array("4st grade" ,is_array(old('significant_grade')) ? old('significant_grade') : []) ? 'selected' : ' '}} value="4st grade">4st grade</option>
                                                                    <option {{ in_array("5st grade" ,is_array(old('significant_grade')) ? old('significant_grade') : []) ? 'selected' : ' '}} value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="form-label"
                                                                    for="significant_location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('significant_data') is-invalid @enderror"
                                                                    id="significant_location"
                                                                    name="significant_location"
                                                                    value="{{ old('significant_location') }}"
                                                                    placeholder="Enter Location">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="significant_honor_award">
                                                                    Honor / Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('significant_data') is-invalid @enderror"
                                                                    value="{{ old('significant_honor_award') }}"
                                                                    id="significant_honor_award"
                                                                    name="significant_honor_award"
                                                                    placeholder="Enter Honor / Award">
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addSignificantData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('significant_data') bg-danger @enderror"></i>
                                                                    @error('significant_data') 
                                                                        <span class="ms-2 me-2 invalid">Click on add icon to insert significant data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($employmentCertification->significant_data) || !empty(old('significant_data')))
                                                            @php
                                                                $significant_data = !empty($employmentCertification->significant_data) ? $employmentCertification->significant_data : old('significant_data');
                                                            @endphp
                                                            @foreach(json_decode($significant_data) as $significant_data)
                                                                <tr id="significant_{{ $significant_data->id }}">
                                                                    <td class="responsibility_interest">{{ $significant_data->responsibility_interest }}</td>
                                                                    <td class="significant_grade">{{ implode(", ",json_decode($significant_data->significant_grade)) }}</td>
                                                                    <td class="significant_location">{{ $significant_data->significant_location }}</td>
                                                                    <td class="significant_honor_award">{{ $significant_data->significant_honor_award }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $significant_data->id }}" onclick="significant_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $significant_data->id }}" onclick="significant_model_remove(this)"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="prev-btn next-btn">
                                    <a href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                                        class="btn btn-alt-success prev-step"> Previous Step
                                    </a>
                                   
                                </div>
                                <div class="next-btn">
                                    <input type="submit" class="btn  btn-alt-success next-step" value="Next Step">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Employment & Certifications Modal -->
        <div class="modal" id="employment_certification_modal" tabindex="-1" role="dialog"
            aria-labelledby="modal-block-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Employment & Certifications</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="employment_modal_job_title">
                                        Job title
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        value="{{ old('job_title') }}" id="employment_modal_job_title" name="job_title"
                                        placeholder="Enter Job title">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="employment_modal_grade">
                                        Grade(s)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-select2 select" id="employment_modal_grade"
                                        name="grade" multiple="multiple">
                                        <option value="1st grade">1st grade</option>
                                        <option value="2st grade">2st grade</option>
                                        <option value="3st grade">3st grade</option>
                                        <option value="4st grade">4st grade</option>
                                        <option value="5st grade">5st grade</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="employment_modal_location">
                                        Location
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="employment_modal_location" name="location"
                                        value="{{ old('location') }}" placeholder="Enter Location">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="employment_modal_honor_award">
                                        Honor / Award
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="employment_modal_honor_award" name="honor_award"
                                        value="{{ old('honor_award') }}" placeholder="Enter Honor / Award">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateEmploymentForm" onclick="updateEmploymentForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Employment & Certifications Modal -->

    <!-- Other Significant Responsibilities or interests Modal -->
        <div class="modal" id="significant_modal" tabindex="-1" role="dialog"
            aria-labelledby="modal-block-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Other Significant Responsibilities or interests</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="significant_modal_responsibility_interest">
                                        Responsibility or interest
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        value="{{ old('responsibility_interest') }}"
                                        id="significant_modal_responsibility_interest" name="responsibility_interest"
                                        placeholder="Enter Responsibility or interest">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="significant_modal_grade">
                                        Grade(s)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-select2 select" id="significant_modal_grade"
                                        name="significant_grade" multiple="multiple">
                                        <option value="1st grade">1st grade</option>
                                        <option value="2st grade">2st grade</option>
                                        <option value="3st grade">3st grade</option>
                                        <option value="4st grade">4st grade</option>
                                        <option value="5st grade">5st grade</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="significant_modal_location">
                                        Location
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="significant_modal_location"
                                        name="significant_location"
                                        value="{{ old('significant_location') }}"
                                        placeholder="Enter Location">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="significant_modal_honor_award">
                                        Honor / Award
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="significant_modal_honor_award" name="significant_honor_award"
                                        placeholder="Enter Additional details">
                                        {{ old('significant_honor_award') }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateSignificantForm" onclick="updateSignificantForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Other Significant Responsibilities or interests Modal -->
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <style>
        .select2-container .select2-selection--multiple {
            min-width: 13vw !important;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    <script>
        var employmentData = [];
        var significantData = [];

        // Employment table start

        function addEmploymentData(data) {
            let job_title = $('input[name="job_title"]').val();
            let employment_grade = $('#employment_grade').val();
            let employment_location = $('input[name="employment_location"]').val();
            let employment_honor_award = $('input[name="employment_honor_award"]').val();
            let temp_employment_id = Date.now();

            let html = ``;
            if (job_title != "" && employment_grade != "" && employment_location != "" && employment_honor_award != "") {
                html += `<tr id="employment_${temp_employment_id}">`;
                html += `<td class="job_title">${job_title}</td>`;
                html += `<td class="employment_grade">${employment_grade.join(", ").toString()}</td>`;
                html += `<td class="employment_location">${employment_location}</td>`;
                html += `<td class="employment_honor_award">${employment_honor_award}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_employment_id}" onclick="employment_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_employment_id}" onclick="employment_model_remove(this)"></i>`;
                html += `</td>`;

                employmentData.push({
                    "id": temp_employment_id,
                    "job_title": job_title,
                    "employment_grade": JSON.stringify(employment_grade),
                    "employment_location": employment_location,
                    "employment_honor_award": employment_honor_award
                });
            } else {
                alert('Please Enter Employment Details');
            }

            $('.employment_data_table_row').after(html);
            $('input[name="job_title"]').val('');
            $("#employment_grade").val(null).trigger("change");
            $('input[name="employment_location"]').val('');
            $('input[name="employment_honor_award"]').val('');
            $('#employment_data').val(JSON.stringify(employmentData));
        }

        function employment_edit_model(data) {
            let employment_data = $('#employment_data').val();
                employment_data = JSON.parse(employment_data);
            let id = $(data).attr('data-id');
            let employment_result = employment_data.find(employment => employment.id == id);
            let employment_grade = JSON.parse(employment_result.employment_grade);
            
            $('#employment_modal_job_title').val(employment_result.job_title);
            $("#employment_modal_grade").val(employment_grade).trigger("change");
            $('#employment_modal_location').val(employment_result.employment_location);
            $('#employment_modal_honor_award').val(employment_result.employment_honor_award);
            $('#updateEmploymentForm').attr('data-id', id);
            $('#employment_certification_modal').modal('show');
        }

        function updateEmploymentForm(data) {
            let id = $(data).attr('data-id');
            let job_title = $('#employment_modal_job_title').val();
            let employment_grade = $('#employment_modal_grade').val();
            let employment_location = $('#employment_modal_location').val();
            let employment_honor_award = $('#employment_modal_honor_award').val();
        
            let employment_data = $('#employment_data').val();
                employment_data = JSON.parse(employment_data);
            for (let i = 0; i < employment_data.length; i++) {
                if (employment_data[i].id == id) {
                    employment_data[i].job_title = job_title
                    employment_data[i].employment_grade = JSON.stringify(employment_grade)
                    employment_data[i].employment_location = employment_location
                    employment_data[i].employment_honor_award = employment_honor_award
                }
            }
            $('#employment_data').val(JSON.stringify(employment_data));
            $(`#employment_${id} .job_title`).text(job_title);
            $(`#employment_${id} .employment_grade`).text(employment_grade.join(", ").toString());
            $(`#employment_${id} .employment_location`).text(employment_location);
            $(`#employment_${id} .employment_honor_award`).text(employment_honor_award);

            $('#employment_certification_modal').modal('hide');
        }

        function employment_model_remove(data) {
            let id = $(data).attr('data-id');
            let employment_data = $('#employment_data').val();
                employment_data = JSON.parse(employment_data);
            const deleted_employment = employment_data.filter(employment => employment.id != id)
            $('#employment_data').val(JSON.stringify(deleted_employment));
            $(`#employment_${id}`).remove();
        }

        // Employment table end

        // Significant table start

        function addSignificantData(data) {
            let responsibility_interest = $('input[name="responsibility_interest"]').val();
            let significant_grade = $('#significant_grade').val();
            let significant_location = $('input[name="significant_location"]').val();
            let significant_honor_award = $('input[name="significant_honor_award"]').val();
            let temp_significant_id = Date.now();

            let html = ``;
            if (responsibility_interest != "" && significant_grade != "" && significant_location != "" && significant_honor_award != "") {
                html += `<tr id="significant_${temp_significant_id}">`;
                html += `<td class="responsibility_interest">${responsibility_interest}</td>`;
                html += `<td class="significant_grade">${significant_grade.join(", ").toString()}</td>`;
                html += `<td class="significant_location">${significant_location}</td>`;
                html += `<td class="significant_honor_award">${significant_honor_award}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_significant_id}" onclick="significant_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_significant_id}" onclick="significant_model_remove(this)"></i>`;
                html += `</td>`;

                significantData.push({
                    "id": temp_significant_id,
                    "responsibility_interest": responsibility_interest,
                    "significant_grade": JSON.stringify(significant_grade),
                    "significant_location": significant_location,
                    "significant_honor_award": significant_honor_award
                });
            } else {
                alert('Please Enter Significant Details');
            }

            $('.significant_data_table_row').after(html);
            $('input[name="responsibility_interest"]').val('');
            $("#significant_grade").val(null).trigger("change");
            $('input[name="significant_location"]').val('');
            $('input[name="significant_honor_award"]').val('');
            $('#significant_data').val(JSON.stringify(significantData));
        }

        function significant_edit_model(data) {
            let significant_data = $('#significant_data').val();
                significant_data = JSON.parse(significant_data);
            let id = $(data).attr('data-id');
            let significant_result = significant_data.find(significant => significant.id == id);
            let significant_grade = JSON.parse(significant_result.significant_grade);
            
            $('#significant_modal_responsibility_interest').val(significant_result.responsibility_interest);
            $("#significant_modal_grade").val(significant_grade).trigger("change");
            $('#significant_modal_location').val(significant_result.significant_location);
            $('#significant_modal_honor_award').val(significant_result.significant_honor_award);
            $('#updateSignificantForm').attr('data-id', id);
            $('#significant_modal').modal('show');
        }

        function updateSignificantForm(data) {
            let id = $(data).attr('data-id');
            let responsibility_interest = $('#significant_modal_responsibility_interest').val();
            let significant_grade = $('#significant_modal_grade').val();
            let significant_location = $('#significant_modal_location').val();
            let significant_honor_award = $('#significant_modal_honor_award').val();
        
            let significant_data = $('#significant_data').val();
                significant_data = JSON.parse(significant_data);
            for (let i = 0; i < significant_data.length; i++) {
                if (significant_data[i].id == id) {
                    significant_data[i].responsibility_interest = responsibility_interest
                    significant_data[i].significant_grade = JSON.stringify(significant_grade)
                    significant_data[i].significant_location = significant_location
                    significant_data[i].significant_honor_award = significant_honor_award
                }
            }
            $('#significant_data').val(JSON.stringify(significant_data));
            $(`#significant_${id} .responsibility_interest`).text(responsibility_interest);
            $(`#significant_${id} .significant_grade`).text(significant_grade.join(", ").toString());
            $(`#significant_${id} .significant_location`).text(significant_location);
            $(`#significant_${id} .significant_honor_award`).text(significant_honor_award);

            $('#significant_modal').modal('hide');
        }

        function significant_model_remove(data) {
            let id = $(data).attr('data-id');
            let significant_data = $('#significant_data').val();
                significant_data = JSON.parse(significant_data);
            const deleted_significant = significant_data.filter(significant => significant.id != id)
            $('#significant_data').val(JSON.stringify(deleted_significant));
            $(`#significant_${id}`).remove();
        }

        // Significant table end
    </script>
@endsection
