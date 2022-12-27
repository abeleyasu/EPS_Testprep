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
                        <a class="nav-link" href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/personal-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.personalInfo')}}"
                            id="step1-tab">
                            <p class="d-none">1</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Personal Info</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{ isset($resume_id) && $resume_id != null  ? url('user/admin-dashboard/high-school-resume/education-info?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.educationInfo')}}"
                            id="step2-tab">
                            <p class="d-none">2</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Education </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{isset($resume_id) && $resume_id != null  ? url('user/admin-dashboard/high-school-resume/honors?resume_id='.$resume_id) :route('admin-dashboard.highSchoolResume.honors')}}" id="step3-tab">
                            <p class="d-none">3</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Honors </h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link " href="{{isset($resume_id) && $resume_id != null  ? url('user/admin-dashboard/high-school-resume/activities?resume_id='.$resume_id): route('admin-dashboard.highSchoolResume.activities') }}"
                            id="step4-tab">
                            <p class="d-none">4</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Activities</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="{{ isset($resume_id) && $resume_id != null  ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.employmentCertification')}}"
                            id="step5-tab">
                            <p class="d-none">5</p>
                            <i class="fa-solid fa-check fa-check-block "></i>
                            <h6>Employment & <br> Certifications</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link active" href="{{ isset($resume_id) && $resume_id != null  ? url('user/admin-dashboard/high-school-resume/features-attributes?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.featuresAttributes') }}"
                            id="step6-tab">
                            <p>6</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Featured <br> Attributes</h6>
                        </a>
                    </li>
                    <li role="presentation" onclick="{{ !isset($featuredAttribute) ? 'errorMsg(); return false;' : 'javascript:void(0)' }}">
                        <a class="nav-link" href="{{ isset($featuredAttribute) && $featuredAttribute != null  ? (isset($resume_id) && $resume_id != null  ? url('user/admin-dashboard/high-school-resume/preview?resume_id='.$resume_id):route('admin-dashboard.highSchoolResume.preview')) : ''}}" id="step7-tab">
                            <p>7</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Preview</h6>
                        </a>
                    </li>
                </ul>
                <form class="js-validation" id="features_attributes_form" action="{{ isset($featuredAttribute) && $featuredAttribute != null ? route('admin-dashboard.highSchoolResume.featuresAttributes.update', $featuredAttribute->id) : route('admin-dashboard.highSchoolResume.featuresAttributes.store') }}" method="POST">
                    @csrf
                    @if(isset($featuredAttribute) && $featuredAttribute != null)
                        @method('PUT')
                    @endif
                    @if(isset($resume_id) && $resume_id != null)
                        <input type="hidden" name="resume_id" id="resume_id" value="{{ $resume_id }}">
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="setup-content">
                            <div class="accordion accordionExample2">
                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <a class="text-white fw-600 collapsed"> Featured Qualities</a>
                                    </div>
                                    <div id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table featured_skill_table">
                                                    <tbody>
                                                        <tr>
                                                            <input type="hidden" name="feature_skill" id="feature_skill" value="{{ isset($featuredAttribute) && $featuredAttribute != null ? $featuredAttribute->id : '' }}">
                                                            <td>
                                                                <label class="form-label" for="featured_skill">
                                                                    Featured Qualities
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($featuredAttribute->featured_skills_data))
                                                            @foreach ($featuredAttribute->featured_skills_data as $index => $featured_skills_data)
                                                                <tr class="featured_skill_data_table_row {{ $loop->first ? '' : 'remove_featured_skill_data' }}">
                                                                    <td>
                                                                        <input type="text" class="form-control" value="{{ $featured_skills_data['skill'] }}" id="featured_skill"
                                                                            name="featured_skills_data[{{ $index }}][skill]" placeholder="Enter Featured Qualities">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i onclick="{{ $loop->first ? 'addFeaturedSkillData(this)' : 'removeFeaturedSkillData(this)' }}" data-count="{{ count($featuredAttribute->featured_skills_data) != 0 ? count($featuredAttribute->featured_skills_data) - 1 : 0 }}" class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="featured_skill_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control" id="featured_skill"
                                                                        name="featured_skills_data[0][skill]" placeholder="Enter Featured Skill">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i onclick="addFeaturedSkillData(this)" data-count="0" class="fa-solid fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
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
                                        <a class="text-white fw-600 collapsed"> Featured Awards </a>
                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table featured_award_table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label" for="featured_award">
                                                                    Featured Awards
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($featuredAttribute->featured_awards_data))
                                                            @foreach ($featuredAttribute->featured_awards_data as $index => $featured_awards_data) 
                                                                <tr class="featured_award_data_table_row {{ $loop->first ? '' : 'remove_featured_award_data' }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="{{ $featured_awards_data['award'] }}"
                                                                            id="featured_award" name="featured_awards_data[{{ $index }}][award]"
                                                                            placeholder="Enter Featured Award">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i data-count="{{ count($featuredAttribute->featured_awards_data) != 0 ? count($featuredAttribute->featured_awards_data) - 1 : 0 }}" onclick="{{ $loop->first ? 'addFeaturedAwardData(this)' : 'removeFeaturedAwardData(this)' }}" class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else 
                                                            <tr class="featured_award_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="featured_award" name="featured_awards_data[0][award]"
                                                                        placeholder="Enter Featured Award">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i onclick="addFeaturedAwardData(this)" data-count="0" class="fa-solid fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
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
                                        class="collapse"
                                        aria-labelledby="headingOne" data-parent=".accordionExample2">
                                        <div class="block-content">
                                            <div class="main-form-input">
                                                <table class="table featured_language_table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label" for="featured_language">
                                                                    Language
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label" for="languages_level">
                                                                    Languages Level
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-label">Action</label><br>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($featuredAttribute->featured_languages_data))
                                                            @foreach ($featuredAttribute->featured_languages_data as $index => $featured_languages_data)   
                                                                <tr class="featured_language_data_table_row {{ $loop->first ? '' : 'remove_featured_language_data' }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="{{ $featured_languages_data['language'] }}"
                                                                            id="featured_language" name="featured_languages_data[{{ $index }}][language]"
                                                                            placeholder="Enter Language">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            value="{{ $featured_languages_data['level'] }}"
                                                                            id="languages_level" name="featured_languages_data[{{ $index }}][level]"
                                                                            placeholder="Fluent">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                            <i data-count="{{ count($featuredAttribute->featured_languages_data) != 0 ? count($featuredAttribute->featured_languages_data) - 1 : 0 }}" onclick="{{ $loop->first ? 'addFeaturedLanguageData(this)' : 'removeFeaturedLanguageData(this)' }}" class="fa-solid {{ $loop->first ? 'fa-plus' : 'fa-minus' }}"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else    
                                                            <tr class="featured_language_data_table_row">
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="featured_language" name="featured_languages_data[0][language]"
                                                                        placeholder="Enter Language">
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        id="languages_level" name="featured_languages_data[0][level]"
                                                                        placeholder="Fluent">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="add-btn plus-icon d-flex">
                                                                        <i data-count="0" onclick="addFeaturedLanguageData(this)" class="fa-solid fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
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
                                    <a href="{{ isset($resume_id) && $resume_id != null ? url('user/admin-dashboard/high-school-resume/employment-certifications?resume_id='.$resume_id) : route('admin-dashboard.highSchoolResume.employmentCertification') }}"
                                        class="btn btn-alt-success prev-step"> Previous Step
                                    </a> 
                                   
                                </div>
                                <div class="next-btn d-flex">
                                    @if (!isset($resume_id))
                                        <div>
                                            @include('components.reset-all-drafts-button')
                                        </div>
                                    @endif
                                    <input type="submit" class="btn btn-alt-success next-step" value="Next Step" >
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
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
    <script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
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
        function errorMsg()
        {
            Swal.fire({
                title: 'Complete Current Step',
                text: "You Have to submit current form",
                icon: 'warning',
                confirmButtonColor: '#F27474',
                confirmButtonText: 'Okay'
            }).then((result) => {
                window.location.href = "{{ route('admin-dashboard.highSchoolResume.featuresAttributes') }}";
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
