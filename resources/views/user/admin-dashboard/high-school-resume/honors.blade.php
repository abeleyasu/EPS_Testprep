@extends('layouts.user')

@section('title', 'HSR | Honors : CPS')

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
        <div class="container honors-container">
            <div class="custom-tab-container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link" href="{{isset($resume_id) ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <p class="d-none">1</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ isset($resume_id) ? url('user/admin-dashboard/high-school-resume/education-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <p class="d-none">2</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Education </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ isset($resume_id) ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id) :route('admin-dashboard.highSchoolResume.honors')}}"
                            id="step3-tab">
                            <p>3</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>Honors </h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($honor) ? "errorMsg(); return false;" : "javascript:void(0)" }}">
                        <a class="nav-link" href="{{ isset($honor) ? ( isset($resume_id) ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.activities')) : ''}}"
                            id="step4-tab">
                            <p>4</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($honor) ? "errorMsg(); return false;" : "javascript:void(0)" }}" >
                        <a class="nav-link" href="{{ isset($employmentCertification) ? (isset($resume_id) ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.employmentCertification')) : ''}}"
                            id="step5-tab">
                            <p>5</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($honor) ? "errorMsg(); return false;" : "javascript:void(0)" }}" >
                        <a class="nav-link" href="{{ isset($featuredAttribute) ? ( isset($resume_id) ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id='.$resume_id): route('admin-dashboard.highSchoolResume.featuresAttributes')) : ''}}"
                            id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($honor) ? "errorMsg(); return false;" : "javascript:void(0)" }}" >
                        <a class="nav-link" href="{{ isset($featuredAttribute) ? ( isset($resume_id) ? url('user/admin-dashboard/high-school-resume/preview?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.preview')) : ''}}" id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" action="{{ isset($honor) ? route('admin-dashboard.highSchoolResume.honors.update', $honor->id) : route('admin-dashboard.highSchoolResume.honors.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($honor))
                        @method('PUT')
                    @endif
                    @if(isset($resume_id))
                        <input type="hidden" name="resume_id" value="{{ $resume_id }}">
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class=" text-white fw-600 collapsed"> Academic Honors, Achievements & Other
                                            Awards</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <input type="hidden" name="honors_data" id="honors_data" value="{{ !empty($honor->honors_data) ? $honor->honors_data : old('honors_data') }}">
                                                        <tr class="honors_data_table_row">
                                                            <td>
                                                                <label class="form-label" for="position">
                                                                    Position
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="number"
                                                                    class="form-control @error('honors_data') is-invalid @enderror"
                                                                    id="position" name="position"
                                                                    value="{{ old('position') }}"
                                                                    placeholder="Enter Position" autocomplete="off">
                                                                @error('position')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="honor_achievement_award">
                                                                    Honor/Achievement/Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('honors_data') is-invalid @enderror"
                                                                    id="honor_achievement_award"
                                                                    name="honor_achievement_award"
                                                                    value="{{ old('honor_achievement_award') }}"
                                                                    placeholder="Ex: National Honor Society">
                                                                @error('honor_achievement_award')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="grade">
                                                                    Grade(s)
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="js-select2 select @error('honors_data') is-invalid @enderror" id="grade"
                                                                    name="grade[]" multiple="multiple">
                                                                    <option {{ (in_array('1st grade' ,(is_array(old('grade')) ? old('grade') : []))) ? 'selected' : '' }} value="1st grade">1st grade</option>
                                                                    <option {{ (in_array('2st grade' ,(is_array(old('grade')) ? old('grade') : []))) ? 'selected' : '' }} value="2st grade">2st grade</option>
                                                                    <option {{ (in_array('3st grade' ,(is_array(old('grade')) ? old('grade') : []))) ? 'selected' : '' }} value="3st grade">3st grade</option>
                                                                    <option {{ (in_array('4st grade' ,(is_array(old('grade')) ? old('grade') : []))) ? 'selected' : '' }} value="4st grade">4st grade</option>
                                                                    <option {{ (in_array('5st grade' ,(is_array(old('grade')) ? old('grade') : []))) ? 'selected' : '' }} value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('honors_data') is-invalid @enderror"
                                                                    value="{{ old('location') }}" id="location"
                                                                    name="location" placeholder="Ex: DRHS">
                                                                @error('location')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addHonorsData(this)" class="add-btn d-flex plus-icon">
                                                                    <i class="fa-solid fa-plus @error('honors_data') bg-danger @enderror"></i>
                                                                    @error('honors_data')
                                                                        <span class="ms-2 mt-2 invalid">Click on add icon to insert honors data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($honor->honors_data))
                                                            @foreach(json_decode($honor->honors_data) as $honors_data)
                                                                <tr id="honors_{{ $honors_data->id }}">
                                                                    <td class="position">{{ $honors_data->position }}</td>
                                                                    <td class="honor_achievement_award">{{ $honors_data->honor_achievement_award }}</td>
                                                                    <td class="grade">{{ implode(", ",json_decode($honors_data->grade)) }}</td>
                                                                    <td class="location">{{ $honors_data->location }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $honors_data->id }}" onclick="honor_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $honors_data->id }}" onclick="honor_model_remove(this)"></i>
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
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="prev-btn next-btn">
                                <a href="{{ isset($resume_id) ? url('user/admin-dashboard/high-school-resume/education-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.educationInfo') }}"
                                    class="btn btn-alt-success prev-step "> Previous Step
                                </a>
                            </div>
                            <div class="next-btn d-flex">
                                @if (!isset($resume_id))
                                    <div>
                                        @include('components.reset-all-drafts-button')
                                    </div>
                                @endif
                                <input type="submit" class="btn btn-alt-success next-step" value="Next Step">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!--Honors Modal -->
        <div class="modal" id="honors_modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Academic Honors, Achievements & Other Awards</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="honors_modal_position">
                                        Position
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control"
                                        id="honors_modal_position" name="position" value="{{ old('position') }}"
                                        placeholder="Enter Position" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="honors_modal_achievement_award">
                                        Honor/Achievement/Award
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        id="honors_modal_achievement_award" name="achievement_award"
                                        value="{{ old('achievement_award') }}"
                                        placeholder="Ex: National Honor Society" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="honors_modal_grade">
                                        Grade(s)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="js-select2 select" id="honors_modal_grade" name="grade[]"
                                        multiple="multiple">
                                        <option value="1st grade">1st grade</option>
                                        <option value="2st grade">2st grade</option>
                                        <option value="3st grade">3st grade</option>
                                        <option value="4st grade">4st grade</option>
                                        <option value="5st grade">5st grade</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="honors_modal_location">
                                        Location
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        value="{{ old('location') }}" id="honors_modal_location" name="location"
                                        placeholder="Ex: DRHS">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateHonorForm" onclick="updateHonorForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--Honors Modal -->
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
    <style>
        .select2-container .select2-selection--multiple {
            min-width: 14vw !important;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    <script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
    <style>
        .swal2-styled.swal2-default-outline:focus {
            box-shadow: none;
        }
        .swal2-icon.swal2-warning {
            border-color: #f27474;
            color: #f27474;
        }
    </style>
    <script>
        var honorsData = [];

        $('#step1-tab').click(function() {
            toastr.success('Congratulations');
        });

        function addHonorsData(data) {
            let position = $('input[name="position"]').val();
            let honor_achievement_award = $('input[name="honor_achievement_award"]').val();
            let grade = $('#grade').val();
            let location = $('input[name="location"]').val();
            let temp_honors_id = Date.now();

            let honor = $('#honors_data').val();
            if(honor != "") {
                honorsData = JSON.parse($('#honors_data').val());
            }

            let html = ``;
            if (position != "" && honor_achievement_award != "" && location != "" && grade != "") {
                html += `<tr id="honors_${temp_honors_id}">`;
                html += `<td class="position">${position}</td>`;
                html += `<td class="honor_achievement_award">${honor_achievement_award}</td>`;
                html += `<td class="grade">${grade.join(", ").toString()}</td>`;
                html += `<td class="location">${location}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_honors_id}" onclick="honor_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_honors_id}" onclick="honor_model_remove(this)"></i>`;
                html += `</td>`;

                honorsData.push({
                    "id": temp_honors_id,
                    "position": position,
                    "honor_achievement_award": honor_achievement_award,
                    "grade": JSON.stringify(grade),
                    "location": location
                });
            } else {
                toastr.error('Please Enter Honors Details');
            }

            $('.honors_data_table_row').after(html);
            $('input[name="position"]').val('');
            $('input[name="honor_achievement_award"]').val('');
            $('input[name="location"]').val('');
            $("#grade").val(null).trigger("change");
            $('#honors_data').val(JSON.stringify(honorsData));
        }

        function honor_edit_model(data) {
            let honor_data = $('#honors_data').val();
                honor_data = JSON.parse(honor_data);
            let id = $(data).attr('data-id');
            let honor_result = honor_data.find(honor => honor.id == id);
            let grade = JSON.parse(honor_result.grade);
            
            $('#honors_modal_position').val(honor_result.position);
            $('#honors_modal_achievement_award').val(honor_result.honor_achievement_award);
            $("#honors_modal_grade").val(grade).trigger("change");
            $('#honors_modal_location').val(honor_result.location);
            $('#updateHonorForm').attr('data-id', id);
            $('#honors_modal').modal('show');
        }

        function updateHonorForm(data) {
            let id = $(data).attr('data-id');
            let position = $('#honors_modal_position').val();
            let honor_achievement_award = $('#honors_modal_achievement_award').val();
            let grade = $('#honors_modal_grade').val();
            let location = $('#honors_modal_location').val();
        
            let honor_data = $('#honors_data').val();
                honor_data = JSON.parse(honor_data);
            for (let i = 0; i < honor_data.length; i++) {
                if (honor_data[i].id == id) {
                    honor_data[i].position = position
                    honor_data[i].honor_achievement_award = honor_achievement_award
                    honor_data[i].grade = JSON.stringify(grade)
                    honor_data[i].location = location
                }
            }
            $('#honors_data').val(JSON.stringify(honor_data));
            $(`#honors_${id} .position`).text(position);
            $(`#honors_${id} .honor_achievement_award`).text(honor_achievement_award);
            $(`#honors_${id} .grade`).text(grade.join(", ").toString());
            $(`#honors_${id} .location`).text(location);

            $('#honors_modal').modal('hide');
        }

        function honor_model_remove(data) {
            let id = $(data).attr('data-id');
            let honor_data = $('#honors_data').val();
                honor_data = JSON.parse(honor_data);
            const deleted_honor = honor_data.filter(honor => honor.id != id)
            $('#honors_data').val(JSON.stringify(deleted_honor));
            $(`#honors_${id}`).remove();
            
            if ($('#honors_data').val() == '[]') {
                $('#honors_data').val(null);
            }
        }
        
    function errorMsg()
    {
        Swal.fire({
            title: 'Complete Current Step',
            text: "You Have to submit current form",
            icon: 'warning',
            confirmButtonColor: '#F27474',
            confirmButtonText: 'Okay'
        }).then((result) => {
            window.location.href = "{{ route('admin-dashboard.highSchoolResume.honors') }}";
        });
    }

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

    </script>   
@endsection
