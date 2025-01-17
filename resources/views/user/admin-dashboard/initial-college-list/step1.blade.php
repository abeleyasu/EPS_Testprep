@extends('layouts.user')

@section('title', 'Initial College List : CPS')

@section('user-content')
<style>
    .bold-label {
        font-weight: 800;
    }
    .semi-bold {
        font-weight: 600;
        color: #61656a
    }
    .curson-drag {
        cursor: move;
    }
</style>
@can('Access Initial College List')
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
        <div class="bg-black-10">
            <div class="content content-full text-center">
                <br>
                <h1 class="h2 text-white mb-0">College Search</h1>
                <br>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="custom-tab-container">
            <div class="custom-college-container">
                @include('user.admin-dashboard.initial-college-list.stepper', [
                    'active_stepper' => 1,
                    'completed_step' => []
                ])
            </div>
            <p class="mb-5">Input the aspects of colleges that matter to you the most -OR- directly search for colleges</p>

            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-alt-success" id="view-college-list">View College List</button>
            </div>

            @if(session('cmessage'))
            <div class="alert alert-success">
                {{ session('cmessage') }}
            </div>
            @endif

            <form>
                <div class="block block-rounded tab-container">
                    <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                        <li class="nav-item">
                            <div class="nav-link college_tablinks active" id="btabs-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-home" role="tab" aria-controls="btabs-static-home" aria-selected="true">Search By College Wants</div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link college_tablinks" id="btabs-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-profile" role="tab" aria-controls="btabs-static-profile" aria-selected="false">Search By College Name</div>
                        </li>
                    </ul>

                    <div class="block-content tab-content college-content">
                        <div class="tab-pane active" id="btabs-static-home" role="tabpanel" aria-labelledby="btabs-static-home-tab">
                            <form method="get">
                                <div class="college_wants-wrapper">
                                    <h6>
                                        <span>Note:</span>
                                        We suggest starting your search with no more than 3 of the following aspects selected, see which colleges show up in your results, then decide whether to choose more than 3 aspects to refine your results, if it feels necessary (or if too many colleges show up in your search). We suggest choosing the 1st 3 aspects, but feel free to choose different options that are important to you personally if you choose.
                                    </h6>
                                    <div class="college_wants_list">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                                <div class="accordion accordionExample accordionExample2">
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-calendar"></i> College Major & Degree Type</a>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                            <div class="college-content-wrapper college-content">
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="college_majors_options">
                                                                        College Majors
                                                                    </label>
                                                                    <select class="js-example-basic-single js-states form-control" id="college_majors_options" name="college_majors_options" style="width: 100%;" data-placeholder="Select One.">
                                                                        <option></option>
                                                                        @foreach($college_major_data as $option)
                                                                            <option value="{{ $option->code }}">{{ $option->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label" for="degree_type">
                                                                        Degree Type
                                                                    </label>
                                                                </div>
                                                                <div class="mb-2 ms-2">
                                                                    <label for="" class="semi-bold">Undergraduate</label>
                                                                    @include('user.admin-dashboard.initial-college-list.common-options', [
                                                                        'name' => 'degree[]',
                                                                        'options' => config('constants.undergraduate_degree_option'),
                                                                        'value_key' => 'value',
                                                                        'text_key' => 'option',
                                                                    ])
                                                                    <label for="" class="semi-bold">Graduate</label>
                                                                    @include('user.admin-dashboard.initial-college-list.common-options', [
                                                                        'name' => 'degree[]',
                                                                        'options' => config('constants.graduate_degree_option'),
                                                                        'value_key' => 'value',
                                                                        'text_key' => 'option',
                                                                    ])
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                            <a class=" text-white fw-600 collapsed"><i class="fa fa-2x fa-clock"></i> Location</a>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                            <div class="college-content-wrapper college-content">
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label" for="search_state">
                                                                        Search by Location
                                                                    </label>
                                                                    <input class="form-control form-control-lg form-control-alt" type="text" id="search_state" placeholder="Start Typing to Search...">
                                                                </div>
                                                                @include('user.admin-dashboard.initial-college-list.common-dropdown', [
                                                                    'title' => 'Browse by Location',
                                                                    'name' => 'state[]',
                                                                    'id' => 'step3',
                                                                    'accordion_id' => 'browse_colloege',
                                                                    'options' => $states,
                                                                    'ishide' => false,
                                                                    'value_key' => 'state_code',
                                                                    'text_key' => 'state_name',
                                                                ])
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                            <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-clock"></i> Student Body</a>
                                                        </div>
                                                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                            <div class="college-content-wrapper college-content">
                                                                <div class="mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="1" id="is_select_college_size">
                                                                        <label class="form-check-label" for="is_select_college_size">
                                                                            College Size
                                                                        </label>
                                                                        @include('user.admin-dashboard.initial-college-list.common-dropdown', [
                                                                            'title' => 'College Size',
                                                                            'name' => 'college_size_option[]',
                                                                            'id' => 'college_size_step',
                                                                            'accordion_id' => 'college_size_accordion',
                                                                            'options' => config('constants.college_size_option'),
                                                                            'ishide' => true,
                                                                            'value_key' => 'value',
                                                                            'text_key' => 'option',
                                                                        ])
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="1" id="is_type_school">
                                                                        <label class="form-check-label" for="is_type_school">
                                                                            Type of School
                                                                        </label>
                                                                        @include('user.admin-dashboard.initial-college-list.common-dropdown', [
                                                                            'title' => 'Type of School',
                                                                            'name' => 'type_of_school[]',
                                                                            'id' => 'type_of_school_step',
                                                                            'accordion_id' => 'type_of_school_accordion',
                                                                            'options' => config('constants.type_of_school'),
                                                                            'ishide' => true,
                                                                            'value_key' => 'value',
                                                                            'text_key' => 'option',
                                                                        ])
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="1" id="is_urbanicity">
                                                                        <label class="form-check-label" for="is_urbanicity">
                                                                            Urbanicity
                                                                        </label>
                                                                        @include('user.admin-dashboard.initial-college-list.common-dropdown', [
                                                                            'title' => 'Urbanicity',
                                                                            'name' => 'urbanicity[]',
                                                                            'id' => 'urbanicity_step',
                                                                            'accordion_id' => 'urbanicity_accordion',
                                                                            'options' => config('constants.urbanicity'),
                                                                            'ishide' => true,
                                                                            'value_key' => 'value',
                                                                            'text_key' => 'option',
                                                                        ])
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="specialized_mission">
                                                                        Specialized Mission
                                                                    </label>
                                                                    <select class="js-example-basic-single js-states form-control" id="specialized_mission" name="specialized_mission" style="width: 100%;" data-placeholder="Select One.">
                                                                        <option></option>
                                                                        @foreach(config('constants.specialized_mission_options') as $option)
                                                                            <option value="{{ $option['search_key'] }}">{{ $option['option'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="religious_affiliation">
                                                                        Religious Affiliation
                                                                    </label>
                                                                    <select class="js-example-basic-single js-states form-control" id="religious_affiliation" name="religious_affiliation" style="width: 100%;" data-placeholder="Select One.">
                                                                        <option></option>
                                                                        @foreach(config('constants.religious_affiliation_options') as $option)
                                                                            <option value="{{ $option['value'] }}">{{ $option['option'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                            <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-clock"></i> College Costs, Aid, and
                                                                Financials</a>
                                                        </div>
                                                        <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                            <div class="college-content-wrapper college-content">
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="average_annual_cost">
                                                                        Average Annual Cost
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="average_annual_cost" name="average_annual_cost" data-min="0" data-max="100" data-from="0" data-grid="true" data-postfix="k">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="average_annual_cost_of_attendance">
                                                                        Average Annual Cost of Attendance
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="average_annual_cost_of_attendance" name="average_annual_cost_of_attendance" data-min="0" data-max="100" data-from="0" data-grid="true" data-postfix="k">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="tution_and_fees">
                                                                        Tution and Fees
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="tution_and_fees" name="tution_and_fees" data-min="0" data-max="100" data-from="0" data-grid="true" data-postfix="k">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="average_percent_of_need_met">
                                                                        Average Percent of Need Met
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="average_percent_of_need_met" name="average_percent_of_need_met" data-min="0" data-max="100" data-from="0" data-grid="true" data-postfix="%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                                            <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-clock"></i> Admissions Criteria &
                                                                Statistics</a>
                                                        </div>
                                                        <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                            <div class="college-content-wrapper college-content">
                                                                <div class="mb-2">
                                                                    @include('user.admin-dashboard.initial-college-list.common-dropdown', [
                                                                        'title' => 'Entrance Difficulty',
                                                                        'name' => 'entrance_difficulty[]',
                                                                        'id' => 'entrance_difficulty_step',
                                                                        'accordion_id' => 'entrance_difficulty_accordion',
                                                                        'options' => config('constants.entrance_difficulty'),
                                                                        'ishide' => false,
                                                                    ])
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="graduate_rate">
                                                                        Graduate Rate
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="graduate_rate" name="graduate_rate" data-min="0" data-max="100" data-from="0" data-grid="true" data-postfix="%">
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="acceptance_rate">
                                                                        Acceptance rate
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="acceptance_rate" name="acceptance_rate" data-min="0" data-max="100" data-from="0" data-grid="true" data-postfix="%">
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="average_gpa"> Average GPA </label>
                                                                    <input type="text" class="js-range-slider form-control" id="average_gpa" name="average_gpa" data-step="0.1" data-min="0.00" data-max="8.00" data-from="0.00" data-grid="true">
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="Math_Score">
                                                                        SAT Math
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="sat_math" name="sat_math" data-min="0" data-max="800" data-from="0" data-grid="true">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="Sat_Score">
                                                                        SAT Critical Reading
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="sat_critical_reading" name="sat_critical_reading" data-min="0" data-max="800" data-from="0" data-grid="true">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label class="form-check-label bold-label mb-2" for="Act_Score">
                                                                        ACT Score
                                                                    </label>
                                                                    <input type="text" class="js-range-slider form-control" id="act_score" name="act_score" data-min="0" data-max="36" data-from="0" data-grid="true">
                                                                </div>
                                                                <h6><span>Note:</span> Be aware that we include schools that
                                                                    don’t provide us with test data even if they’re outside
                                                                    of your score range because we want to show you schools
                                                                    that would otherwise fit all of your search aparmeters.
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-alt-success submit_btn mt-4">Start College Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="btabs-static-profile" role="tabpanel" aria-labelledby="btabs-static-profile-tab">
                            <div class="college_wants-wrapper">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="input-group">
                                                <label for="search_college" class="form-label">Select College</label>
                                                <select class="js-data-example-ajax form-control" id="search_college" name="search_college" style="width: 100%;" data-placeholder="Start Typing College Name...">
                                                    <option value="">Start Typing College Name...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-alt-success submit_btn mt-4">Start College Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<div class="modal fade" id="college-list" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="block-title fw-500">College List</h3>
        <button type="button" class="btn btn-sm btn-alt-success" id="add-college">Add College</button>
        <button type="button" class="btn btn-sm btn-alt-success ms-2" id="view-hide-college-btn">View Hidden Colleges</button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="userSelectedCollegeList" data-type="search-step-1" @if($college_id) data-collegeid="{{ $college_id }}" @endif>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_new_college_list" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="block block-rounded block-transparent mb-0">
        <div class="block-header block-header-tab">
          <h3 class="block-title text-white">Add College</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-fw fa-times"></i>
            </button>
          </div>
        </div>

        <div class="row block-content">
          <div>
            <label for="select-college" class="form-label">Select College</label>
            <select class="js-data-example form-control" id="select-college" name="college" style="width: 100%;" data-placeholder="Select One.">
              <option value="">Select One</option>
            </select>
          </div>
        </div>
        <div class="block-content block-content-full text-end">
          <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn submit-btn" id="add-college-detail">Add</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hide-college-list-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">College List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="hide-college-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-sm btn-alt-danger" data-type="search-list" id="remove-all-college">Remove All College</button>
      </div>
    </div>
  </div>
</div>
@endcan

@cannot('Access Initial College List')
    @include('components.subscription-warning')
@endcan
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="{{ asset('assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<style>
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

@can('Access Initial College List')
@section('user-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/selecting-search-params.js') }}"></script>
<script src="{{asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>
<script src="{{asset('js/college-list.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>

    $(".js-range-slider").ionRangeSlider({
        skin: 'round',
    });

    $('.js-example-basic-single').select2({
        placeholder: 'Select an option',
        allowClear: true
    });

    $('.js-data-example-ajax').select2({
        allowClear: true,
        ajax: {
            delay: 500,
            url: "{{ route('admin-dashboard.collegeApplicationDeadline.collegeList') }}",
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1,
                    all: true
                }
                return query;
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                const result = data.data.map((item) => { return { id: item.name, text: item.name } });
                return {
                    results: result,
                    pagination: {
                        more: (params.page * 30) < data.total
                    }
                };
            }
        }
    });

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $('#is_select_college_size').on('change', function(e) {
        hideshow('college_size_step', this.checked);
    });

    $('#is_type_school').on('change', function(e) {
        hideshow('type_of_school_step', this.checked);
    });

    $('#is_urbanicity').on('change', function(e) {
        hideshow('urbanicity_step', this.checked);
    });

    $('#is_entrance_difficulty').on('change', function(e) {
        hideshow('entrance_difficulty_step', this.checked);
    });

    $('#search_state').on('keyup', function(e) {
        const originalArray = @json($states);
        const searchValue = e.target.value;
        if (searchValue.length > 0) {
            const filteredArray = originalArray.filter((item) => {
                return item.state_name.toLowerCase().includes(searchValue.toLowerCase());
            });
            setStateOption(filteredArray);
        } else {
            setStateOption(originalArray);
        }
    });

    function setStateOption(data) {
        document.getElementById('content-browse_colloege').innerHTML = '';
        const options = data.map((item, index) => {
            return `
                <div class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="${item.state_name}${index}" value="${item.state_code}" name="state[]">
                        <label class="form-check-label" for="${item.state_name}${index}">
                            ${item.state_name}
                        </label>
                    </div>
                </div>
            `
        });
        if (options.length > 0) {
            options.forEach($options => {
                document.getElementById('content-browse_colloege').innerHTML += $options;
            })
        } else {
            document.getElementById('content-browse_colloege').innerHTML = '<h6 class="text-center">No Result</h6>';
        }
        $('#browse_colloege').attr('class', 'show')
    }

    function hideshow(elementid, isshow) {
        $('#' + elementid).attr("style", `display: ${isshow ? 'block' : 'none'} !important`);
    }

    $(document).ready(function () {
        // $('#college-list').modal('show')
    })
    const collegeid = @json($college_id);
    $('#view-college-list').on('click', function (e) {
        e.preventDefault();
        // getStep1CollegeList();
        getCollegeList()
    })

    function getCollegeList() {
    $.ajax({
      url: "{{ route('admin-dashboard.initialCollegeList.step4.getSelectedCollegeList', ['id' => ':id' ]) }}".replace(':id', collegeid),
      method: 'get',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          $('#userSelectedCollegeList').html('');
          const options = ['Smart', 'Match', 'Reach'];
          if (response.data.length > 0) {
            response.data.forEach((data, index) => {
              let optionCLass= '';
              if (data.option && data.option === 'Smart') {
                optionCLass = 'bg-smart'
              } else if (data.option && data.option === 'Match') {
                optionCLass = 'bg-match'
              } else if (data.option && data.option === 'Reach') {
                optionCLass = 'bg-reach'
              }
              const element = `
                <div class="block block-rounded block-bordered overflow-hidden mb-1" data-id="${data.id}">
                  <div class="block-header block-header-tab">
                    <div class="d-flex align-items-center w-100 gap-3 text-white fw-600 drag-handle" role="tab" data-bs-toggle="collapse" data-bs-parent="#userSelectedCollegeList" href="#accodion-${index}" aria-expanded="false" aria-controls="accodion-${index}">
                      <i class="fa fa-2x fa-angle-right" id="toggle${index}"></i>
                      <i class="fa fa-bars"></i>
                      <span>${index + 1}</span>
                      <span>${data.college_name}</span>
                    </div>
                    <div class="d-flex">
                      <button type="button" class="btn btn-sm btn-alt-danger hide-college-from-list me-2" data-id="${data.id}">Hide</button>
                      <button type="button" class="btn btn-sm btn-alt-danger remove-user-college" data-type="step-4" data-id="${data.id}">Remove</button>
                    </div>
                  </div>
                  <div id="accodion-${index}" data-id="${index}" class="collapse" role="tabpanel" aria-labelledby="faq6_h1" data-bs-parent="#userSelectedCollegeList">
                    <div class="block-content">
                      <div class="block block-rounded">
                        <div class="mb-3">
                          <select class="form-control selection-type ${optionCLass}" data-id="${data.id}">
                            <option value="">Select Type</option>
                            ${options.map((option, index) => {
                              return `<option value="${option}" ${data.option === option ? 'selected' : ''}>${option}</option>`
                            })}
                          </select>
                        </div>
                        <table class="table table-bordered table-sm table-hover">
                          <tbody>
                            <tr>
                              <th>Average Admitted GPA:</th>
                              <th>${data.college_information.gpa_average ? data.college_information.gpa_average : '-'}</th>
                            </tr>
                            <tr>
                              <th>Average Accepted ACT:</th>
                              <th>${data.college_information.avg_act_score ? data.college_information.avg_act_score : '-'}</th>
                            </tr>
                            <tr>
                              <th>Average Accepted SAT:</th>
                              <th>${data.college_information.avg_sat_score ? data.college_information.avg_sat_score : '-'}</th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              `
              $('#userSelectedCollegeList').append(element);
              $('#college-list').modal('show')
            })
          } else {
            $('#userSelectedCollegeList').html(`<div class="no-data">No College Found</div>`);
          }
        }
      }
    })
  }

  $('#view-hide-college-btn').on('click', async function (e) {
    await getHideCollegeList('hide-college-list-modal')
  })

  $('#add-college').on('click', function (e) {
    $('#add_new_college_list').modal('show');
  })

  $(document).on('click', '#add-college-detail', function (e) {
    $.ajax({
      url: "{{ route('admin-dashboard.collegeApplicationDeadline.college_save') }}",
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {college: $('#select-college').val()},
    }).done((response) => {
      if (response.success) {
        $('#select-college').val('').trigger('change');
        window.localStorage.setItem('APP-REFRESHED', Date.now());
        $('#add_new_college_list').modal('hide')
        getCollegeList()

      } else {
        console.log('no')
        toastr.error(response.message)
      }
    })
  })

  $(document).on('click', '.hide-college-from-list', function (e) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to hide this college?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, hide it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then(async (result) => {
      if (result.isConfirmed) {
        const response = await hideshowlist(e.target.dataset.id);
        if (response) {
          getCollegeList();
        }
      }
    })
  })

  $(document).on('click', '.show-college-from-list', async function (e) {
    const response = await hideshowlist(e.target.dataset.id);
    if (response) {
      getCollegeList();
      getHideCollegeList('hide-college-list-modal')
    }
  })

  $('.js-data-example').select2({
    dropdownParent: $('#add_new_college_list'),
    allowClear: true,
    ajax: {
        delay: 500,
        url: core.collegelustUrl,
        dataType: 'json',
        data: function (params) {
        var query = {
            search: params.term,
            page: params.page || 1
        }
        return query;
        },
        processResults: function (data, params) {
        params.page = params.page || 1;
        const result = data.data.map((item) => { return { id: item.college_id, text: item.name } });
        return {
            results: result,
            pagination: {
            more: (params.page * 30) < data.total
            }
        };
        }
    }
  });
    // function getStep1CollegeList() {
    //     $.ajax({
    //         url: "{{ route('admin-dashboard.initialCollegeList.getUserCollegeList') }}",
    //         method: 'GET',
    //         headers: {
    //             'X-CSRF-TOKEN': "{{ csrf_token() }}"
    //         },
    //     }).done((response) => {
    //         if (response.success) {
    //             $('#userSelectedCollegeList').html('')
    //             if (response.data.length > 0) {
    //                 response.data.forEach((data, index) => {
    //                     const element = `
    //                         <div class="block block-rounded block-bordered overflow-hidden mb-1" data-id="${data.id}">
    //                             <div class="block-header block-header-tab">
    //                                 <div class="d-flex align-items-center w-100 gap-3 text-white fw-600 curson-drag" role="tab" data-bs-toggle="collapse" data-bs-parent="#userSelectedCollegeList" href="#accodion-${index}" aria-expanded="false" aria-controls="accodion-${index}">
    //                                     <i class="fa fa-bars"></i>
    //                                     <span>${index + 1}</span>
    //                                     <span>${data.college_name}</span>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     `
    //                     $('#userSelectedCollegeList').append(element)
    //                 })
    //                 $('#college-list').modal('show')
    //             } else {
    //                 $('#userSelectedCollegeList').html('<h5 class="no-data">No College Found</h5>')
    //             }
    //         }
    //     })
    // }
</script>
@endsection
@endcan
