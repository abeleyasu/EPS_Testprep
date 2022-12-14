@extends('layouts.user')

@section('title', 'HSR | Features Attribute : CPS')

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
                        <a class="nav-link" href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                            id="step5-tab">
                            <p class="d-none">5</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation" @if (!isset($featuredAttribute)) onclick="errorMsg()" @endif>
                        <a class="nav-link" href="{{ isset($featuredAttribute) ? route('admin-dashboard.highSchoolResume.preview') : ''}}" id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" action="{{ isset($featuredAttribute) ? route('admin-dashboard.highSchoolResume.featuresAttributes.update', $featuredAttribute->id) : route('admin-dashboard.highSchoolResume.featuresAttributes.store') }}" method="POST">
                    @csrf
                    @if(isset($featuredAttribute))
                        @method('PUT')
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> Featured skills</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="featured_skill_data_table_row">
                                                            <input type="hidden" name="featured_skills_data" id="featured_skills_data" value="{{ !empty($featuredAttribute->featured_skills_data) ? $featuredAttribute->featured_skills_data : old('featured_skills_data') }}">
                                                            <td>
                                                                <label class="form-label" for="featured_skill">
                                                                    Featured skill
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('featured_skills_data') is-invalid @enderror"
                                                                    value="{{ old('featured_skill') }}" id="featured_skill"
                                                                    name="featured_skill" placeholder="Enter Featured Skill">
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addFeaturedSkillData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('featured_skills_data') bg-danger @enderror"></i>
                                                                    @error('featured_skills_data') 
                                                                        <span class="ms-2 me-2 invalid">Click on add icon to insert featured skills data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($featuredAttribute->featured_skills_data) || !empty(old('featured_skills_data')))
                                                            @php
                                                                $featured_skills_data = !empty($featuredAttribute->featured_skills_data) ? $featuredAttribute->featured_skills_data : old('featured_skills_data');
                                                            @endphp
                                                            @foreach(json_decode($featured_skills_data) as $featured_skills_data)
                                                                <tr id="featured_skill_{{ $featured_skills_data->id }}">
                                                                    <td class="featured_skill">{{ $featured_skills_data->featured_skill }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $featured_skills_data->id }}" onclick="featured_skill_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $featured_skills_data->id }}" onclick="featured_skill_model_remove(this)"></i>
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
                                        <a class="text-white fw-600 collapsed"> Featured Award </a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse {{ $errors->has('featured_awards_data') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="featured_award_data_table_row">
                                                            <input type="hidden" name="featured_awards_data" id="featured_awards_data" value="{{ !empty($featuredAttribute->featured_awards_data) ? $featuredAttribute->featured_awards_data : old('featured_awards_data') }}">
                                                            <td>
                                                                <label class="form-label" for="featured_award">
                                                                    Featured Award
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('featured_awards_data') is-invalid @enderror"
                                                                    value="{{ old('featured_award') }}"
                                                                    id="featured_award" name="featured_award"
                                                                    placeholder="Enter Featured Award">
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addFeaturedAwardData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('featured_awards_data') bg-danger @enderror"></i>
                                                                    @error('featured_awards_data') 
                                                                        <span class="ms-2 me-2 invalid">Click on add icon to insert featured award data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($featuredAttribute->featured_awards_data) || !empty(old('featured_awards_data')))
                                                            @php
                                                                $featured_awards_data = !empty($featuredAttribute->featured_awards_data) ? $featuredAttribute->featured_awards_data : old('featured_awards_data');
                                                            @endphp
                                                            @foreach(json_decode($featured_awards_data) as $featured_awards_data)
                                                                <tr id="featured_award_{{ $featured_awards_data->id }}">
                                                                    <td class="featured_award">{{ $featured_awards_data->featured_award }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $featured_awards_data->id }}" onclick="featured_award_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $featured_awards_data->id }}" onclick="featured_award_model_remove(this)"></i>
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
                                        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <a class="text-white fw-600 collapsed"> Featured Languages </a>
                                    </div>
                                    <div id="collapseThree"
                                        class="collapse {{ $errors->has('featured_languages_data') ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="featured_language_data_table_row">
                                                            <input type="hidden" name="featured_languages_data" id="featured_languages_data" value="{{ !empty($featuredAttribute->featured_languages_data) ? $featuredAttribute->featured_languages_data : old('featured_languages_data') }}">
                                                            <td>
                                                                <label class="form-label" for="featured_language">
                                                                    Language
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('featured_languages_data') is-invalid @enderror"
                                                                    value="{{ old('featured_language') }}"
                                                                    id="featured_language" name="featured_language"
                                                                    placeholder="Enter Language">
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="languages_level">
                                                                    Languages level
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('featured_languages_data') is-invalid @enderror"
                                                                    value="{{ old('languages_level') }}"
                                                                    id="languages_level" name="languages_level"
                                                                    placeholder="Fluent">
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                                <a href="javascript:void(0)" onclick="addFeaturedLanguageData(this)" class="add-btn plus-icon d-flex">
                                                                    <i class="fa-solid fa-plus @error('featured_languages_data') bg-danger @enderror"></i>
                                                                    @error('featured_languages_data') 
                                                                        <span class="ms-2 me-2 invalid">Click on add icon to insert featured language data</span>
                                                                    @enderror
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($featuredAttribute->featured_languages_data) || !empty(old('featured_languages_data')))
                                                            @php
                                                                $featured_languages_data = !empty($featuredAttribute->featured_languages_data) ? $featuredAttribute->featured_languages_data : old('featured_languages_data');
                                                            @endphp
                                                            @foreach(json_decode($featuredAttribute->featured_languages_data) as $featured_languages_data)
                                                                <tr id="featured_language_{{ $featured_languages_data->id }}">
                                                                    <td class="featured_language">{{ $featured_languages_data->featured_language }}</td>
                                                                    <td class="languages_level">{{ $featured_languages_data->languages_level }}</td>
                                                                    <td>
                                                                        <i class="fa-solid fa-pen me-2" data-id="{{ $featured_languages_data->id }}" onclick="featured_language_edit_model(this)"></i>
                                                                        <i class="fa-solid fa-circle-xmark" data-id="{{ $featured_languages_data->id }}" onclick="featured_language_model_remove(this)"></i>
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
                                    <a href="{{ route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                                        class="btn btn-alt-success prev-step"> Previous Step
                                    </a> 
                                   
                                </div>
                                <div class="next-btn d-flex">
                                    <div>
                                        @include('components.reset-all-drafts-button')
                                    </div>
                                    <input type="submit" class="btn btn-alt-success next-step" value="Next Step">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <!-- Featured skills Modal -->
        <div class="modal" id="features_skill_modal" tabindex="-1" role="dialog"
            aria-labelledby="modal-block-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Featured skills</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <label class="form-label" for="featured_skill_modal">
                                Featured skill
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control"
                                value="{{ old('featured_skill') }}" id="featured_skill_modal" name="featured_skill"
                                placeholder="Enter Featured Skill">
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateFeaturedSkillForm" onclick="updateFeaturedSkillForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Featured skills Modal -->

    <!-- Featured Award Modal -->
        <div class="modal" id="featured_award_model" tabindex="-1" role="dialog"
            aria-labelledby="modal-block-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Featured Award</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <label class="form-label" for="featured_award_modal">
                                Featured Award
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control"
                                value="{{ old('featured_award') }}" id="featured_award_modal"
                                name="featured_award" placeholder="Enter Featured Award">
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateFeaturedAwardForm" onclick="updateFeaturedAwardForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Featured Award Modal -->

    <!-- Featured Languages Modal -->
        <div class="modal" id="featured_language_model" tabindex="-1" role="dialog"
            aria-labelledby="modal-block-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Featured Languages</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="form-label" for="featured_language_modal">
                                        Language
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        value="{{ old('featured_language') }}" id="featured_language_modal"
                                        name="featured_language" placeholder="Enter Language">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="languages_level_modal">
                                        Language level
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control"
                                        value="{{ old('languages_level') }}" id="languages_level_modal"
                                        name="languages_level" placeholder="Fluent">
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn submit-btn" id="updateFeaturedLanguageForm" onclick="updateFeaturedLanguageForm(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Featured Languages Modal -->
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    <script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script>

        var featuredSkillsData = [];
        var featuredAwardsData = [];
        var featuredLanguagesData = [];

        // Featured skills table start

        function addFeaturedSkillData(data) {
            let featured_skill = $('input[name="featured_skill"]').val();
            let temp_featured_skill_id = Date.now();

            let html = ``;
            if (featured_skill != "") {
                html += `<tr id="featured_skill_${temp_featured_skill_id}">`;
                html += `<td class="featured_skill">${featured_skill}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_featured_skill_id}" onclick="featured_skill_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_featured_skill_id}" onclick="featured_skill_model_remove(this)"></i>`;
                html += `</td>`;

                featuredSkillsData.push({
                    "id": temp_featured_skill_id,
                    "featured_skill": featured_skill
                });
            } else {
                toastr.error('Please Enter Featured Skills Details');
            }

            $('.featured_skill_data_table_row').after(html);
            $('input[name="featured_skill"]').val('');
            $('#featured_skills_data').val(JSON.stringify(featuredSkillsData));
        }

        function featured_skill_edit_model(data) {
            let featured_skill_data = $('#featured_skills_data').val();
                featured_skill_data = JSON.parse(featured_skill_data);
            let id = $(data).attr('data-id');
            let featured_skill_result = featured_skill_data.find(featured_skill => featured_skill.id == id);
            
            $('#featured_skill_modal').val(featured_skill_result.featured_skill);
            $('#updateFeaturedSkillForm').attr('data-id', id);
            $('#features_skill_modal').modal('show');
        }

        function updateFeaturedSkillForm(data) {
            let id = $(data).attr('data-id');
            let featured_skill = $('#featured_skill_modal').val();
        
            let featured_skill_data = $('#featured_skills_data').val();
                featured_skill_data = JSON.parse(featured_skill_data);
            for (let i = 0; i < featured_skill_data.length; i++) {
                if (featured_skill_data[i].id == id) {
                    featured_skill_data[i].featured_skill = featured_skill
                }
            }
            $('#featured_skills_data').val(JSON.stringify(featured_skill_data));
            $(`#featured_skill_${id} .featured_skill`).text(featured_skill);

            $('#features_skill_modal').modal('hide');
        }

        function featured_skill_model_remove(data) {
            let id = $(data).attr('data-id');
            let featured_skill_data = $('#featured_skills_data').val();
                featured_skill_data = JSON.parse(featured_skill_data);
            const deleted_featured_skill = featured_skill_data.filter(featured_skill => featured_skill.id != id)
            $('#featured_skills_data').val(JSON.stringify(deleted_featured_skill));
            $(`#featured_skill_${id}`).remove();
        }

        // Featured skills table end

        // Featured awards table start

        function addFeaturedAwardData(data) {
            let featured_award = $('input[name="featured_award"]').val();
            let temp_featured_award_id = Date.now();

            let html = ``;
            if (featured_award != "") {
                html += `<tr id="featured_award_${temp_featured_award_id}">`;
                html += `<td class="featured_award">${featured_award}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_featured_award_id}" onclick="featured_award_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_featured_award_id}" onclick="featured_award_model_remove(this)"></i>`;
                html += `</td>`;

                featuredAwardsData.push({
                    "id": temp_featured_award_id,
                    "featured_award": featured_award
                });
            } else {
                toastr.error('Please Enter Featured Awards Details');
            }

            $('.featured_award_data_table_row').after(html);
            $('input[name="featured_award"]').val('');
            $('#featured_awards_data').val(JSON.stringify(featuredAwardsData));
        }

        function featured_award_edit_model(data) {
            let featured_award_data = $('#featured_awards_data').val();
                featured_award_data = JSON.parse(featured_award_data);
            let id = $(data).attr('data-id');
            let featured_award_result = featured_award_data.find(featured_award => featured_award.id == id);
            
            $('#featured_award_modal').val(featured_award_result.featured_award);
            $('#updateFeaturedAwardForm').attr('data-id', id);
            $('#featured_award_model').modal('show');
        }

        function updateFeaturedAwardForm(data) {
            let id = $(data).attr('data-id');
            let featured_award = $('#featured_award_modal').val();
        
            let featured_award_data = $('#featured_awards_data').val();
                featured_award_data = JSON.parse(featured_award_data);
            for (let i = 0; i < featured_award_data.length; i++) {
                if (featured_award_data[i].id == id) {
                    featured_award_data[i].featured_award = featured_award
                }
            }
            $('#featured_awards_data').val(JSON.stringify(featured_award_data));
            $(`#featured_award_${id} .featured_award`).text(featured_award);

            $('#featured_award_model').modal('hide');
        }

        function featured_award_model_remove(data) {
            let id = $(data).attr('data-id');
            let featured_award_data = $('#featured_awards_data').val();
                featured_award_data = JSON.parse(featured_award_data);
            const deleted_featured_award = featured_award_data.filter(featured_award => featured_award.id != id)
            $('#featured_awards_data').val(JSON.stringify(deleted_featured_award));
            $(`#featured_award_${id}`).remove();
        }

        // Featured awards table end

        // Featured languages table start

        function addFeaturedLanguageData(data) {
            let featured_language = $('input[name="featured_language"]').val();
            let languages_level = $('input[name="languages_level"]').val();
            let temp_featured_language_id = Date.now();

            let html = ``;
            if (featured_language != "" && languages_level != "") {
                html += `<tr id="featured_language_${temp_featured_language_id}">`;
                html += `<td class="featured_language">${featured_language}</td>`;
                html += `<td class="languages_level">${languages_level}</td>`;
                html += `<td>`;
                html += `<i class="fa-solid fa-pen me-2" data-id="${temp_featured_language_id}" onclick="featured_language_edit_model(this)"></i>`;
                html += `<i class="fa-solid fa-circle-xmark" data-id="${temp_featured_language_id}" onclick="featured_language_model_remove(this)"></i>`;
                html += `</td>`;

                featuredLanguagesData.push({
                    "id": temp_featured_language_id,
                    "featured_language": featured_language,
                    "languages_level": languages_level
                });
            } else {
                toastr.error('Please Enter Featured Language Details');
            }

            $('.featured_language_data_table_row').after(html);
            $('input[name="featured_language"]').val('');
            $('input[name="languages_level"]').val('');
            $('#featured_languages_data').val(JSON.stringify(featuredLanguagesData));
        }

        function featured_language_edit_model(data) {
            let featured_languages_data = $('#featured_languages_data').val();
                featured_languages_data = JSON.parse(featured_languages_data);
            let id = $(data).attr('data-id');
            let featured_languages_result = featured_languages_data.find(featured_languages => featured_languages.id == id);
            
            $('#featured_language_modal').val(featured_languages_result.featured_language);
            $('#languages_level_modal').val(featured_languages_result.languages_level);
            $('#updateFeaturedLanguageForm').attr('data-id', id);
            $('#featured_language_model').modal('show');
        }

        function updateFeaturedLanguageForm(data) {
            let id = $(data).attr('data-id');
            let featured_language = $('#featured_language_modal').val();
            let languages_level = $('#languages_level_modal').val();
        
            let featured_languages_data = $('#featured_languages_data').val();
                featured_languages_data = JSON.parse(featured_languages_data);
            for (let i = 0; i < featured_languages_data.length; i++) {
                if (featured_languages_data[i].id == id) {
                    featured_languages_data[i].featured_language = featured_language
                    featured_languages_data[i].languages_level = languages_level
                }
            }
            $('#featured_languages_data').val(JSON.stringify(featured_languages_data));
            $(`#featured_language_${id} .featured_language`).text(featured_language);
            $(`#featured_language_${id} .languages_level`).text(languages_level);

            $('#featured_language_model').modal('hide');
        }

        function featured_language_model_remove(data) {
            let id = $(data).attr('data-id');
            let featured_languages_data = $('#featured_languages_data').val();
                featured_languages_data = JSON.parse(featured_languages_data);
            const deleted_featured_language = featured_languages_data.filter(featured_language => featured_language.id != id)
            $('#featured_languages_data').val(JSON.stringify(deleted_featured_language));
            $(`#featured_language_${id}`).remove();
        }

        function errorMsg()
        {
            alert('You Have to submit current form first.');    
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
        // Featured languages table end
    </script>
@endsection
