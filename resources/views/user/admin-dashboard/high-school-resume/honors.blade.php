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
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}"
                            id="step1-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Personal Info</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                            id="step2-tab">
                            <i class="fa-solid fa-envelope d-none"></i>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <p>Education </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.honors') }}"
                            id="step3-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Honors </p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Activities</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                            id="step5-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Employment & <br> Certifications</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Featured <br> Attributes</p>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.preview') }}" id="step7-tab">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <i class="fa-solid fa-check "></i>
                            <p>Preview</p>
                        </a>
                    </li>
                </ul>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif
                <form class="js-validation" action="{{ isset($honor) ? route('admin-dashboard.highSchoolResume.honors.update', $honor->id) : route('admin-dashboard.highSchoolResume.honors.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($honor))
                        @method('PUT')
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
                                        class="collapse {{ $errors->has('position') || $errors->has('honor_achievement_award') || $errors->has('grade') || $errors->has('location') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <input type="hidden" name="honors_data" id="honors_data" value="{{ !empty($honor->honors_data) ? $honor->honors_data : '' }}">
                                                        <tr class="honors_data_table_row">
                                                            <td>
                                                                <label class="form-label" for="position">
                                                                    Position
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="number"
                                                                    class="form-control @error('position') is-invalid @enderror"
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
                                                                    class="form-control @error('honor_achievement_award') is-invalid @enderror"
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
                                                                <select class="js-select2 select" id="grade"
                                                                    name="grade[]" multiple="multiple">
                                                                    <option value="1st grade">1st grade</option>
                                                                    <option value="2st grade">2st grade</option>
                                                                    <option value="3st grade">3st grade</option>
                                                                    <option value="4st grade">4st grade</option>
                                                                    <option value="5st grade">5st grade</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="location">
                                                                    Location
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('location') is-invalid @enderror"
                                                                    value="{{ old('location') }}" id="location"
                                                                    name="location" placeholder="Ex: DRHS">
                                                                @error('location')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addHonorsData(this)" class="add-btn plus-icon">
                                                                    <i class="fa-solid fa-plus"></i>
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
                            <div class="prev-btn">
                                <a href="{{ route('admin-dashboard.highSchoolResume.educationInfo') }}"
                                    class="btn btn-alt-primary next-step"> Previous
                                </a>
                            </div>
                            <div class="next-btn">
                                <div class="next-btn">
                                    <input type="submit" class="btn btn-alt-primary next-step" value="Next">
                                </div>
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
    <script>
        var honorsData = [];

        function addHonorsData(data) {
            let position = $('input[name="position"]').val();
            let honor_achievement_award = $('input[name="honor_achievement_award"]').val();
            let grade = $('#grade').val();
            let location = $('input[name="location"]').val();
            let temp_honors_id = Date.now();

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
                alert('Please Enter Honors Details');
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
        }
    </script>
@endsection