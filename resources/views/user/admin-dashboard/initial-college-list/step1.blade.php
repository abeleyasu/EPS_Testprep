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
</style>
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
        <div class="bg-black-10">
            <div class="content content-full text-center">
                <br>
                <h1 class="h2 text-white mb-0">Initial College List</h1>
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

            @if(session('cmessage'))
            <div class="alert alert-success">
                {{ session('cmessage') }}
            </div>
            @endif

            <form>
                <div class="block block-rounded tab-container ">
                    <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                        <li class="nav-item">
                            <div class="nav-link college_tablinks active" id="btabs-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-home" role="tab" aria-controls="btabs-static-home" aria-selected="true">Search By College Wants</div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link college_tablinks" id="btabs-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-profile" role="tab" aria-controls="btabs-static-profile" aria-selected="false">Search By College Name</div>
                        </li>
                        <li class="nav-item ms-auto">
                            <div class="nav-link college_tablinks" id="btabs-static-settings-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-settings" role="tab" aria-controls="btabs-static-settings" aria-selected="false">
                                <i class="si si-settings"></i>
                                <span class="visually-hidden">Settings</span>
                            </div>
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
                                                <div class="accordion accordionExample">
                                                    <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                        <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <a class=" text-white fw-600 collapsed"><i class="fa fa-2x fa-calendar"></i> College Major & Degree Type</a>
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
                                                                    <input type="number" min="0" class=" form-control" id="average_annual_cost" name="average_annual_cost">
                                                                </div>
    
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="acceptance_rate">
                                                                        Acceptance rate
                                                                    </label>
                                                                    <input type="number" min="0" class=" form-control" id="acceptance_rate" name="acceptance_rate">
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
                                                                <!-- <div class="mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="1" id="Competitiveness" name="Competitiveness">
                                                                        <label class="form-check-label" for="Competitiveness">
                                                                            Competitiveness / Entrance Difficulty
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="1" id="GPA" name="GPA">
                                                                        <label class="form-check-label" for="GPA">
                                                                            GPA
                                                                        </label>
                                                                    </div>
                                                                </div> -->
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="Math_Score">
                                                                        SAT Math
                                                                    </label>
                                                                    <input type="number" min="0" class=" form-control" id="sat_math" name="sat_math">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-check-label bold-label mb-2" for="Sat_Score">
                                                                        SAT Critical Reading
                                                                    </label>
                                                                    <input type="number" min="0" class=" form-control" id="sat_critical_reading" name="sat_critical_reading">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label class="form-check-label bold-label mb-2" for="Act_Score">
                                                                        ACT Score
                                                                    </label>
                                                                    <input type="number" min="0" class=" form-control" id="act_score" name="act_score">
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
                                                <input type="text" class="form-control" placeholder="Start Typing College Name..." id="search_college" name="search_college">
                                                <span class="input-group-text">
                                                    <i class="fa fa-fw fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-alt-success submit_btn mt-4">Start College Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="btabs-static-settings" role="tabpanel" aria-labelledby="btabs-static-settings-tab">
                            <h4 class="fw-normal">Information Button Content</h4>
                            <p>...</p>
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
<link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
@endsection


@section('user-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/selecting-search-params.js') }}"></script>
<script>

    $('.js-example-basic-single').select2({
        placeholder: 'Select an option',
        allowClear: true
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
    }

    function hideshow(elementid, isshow) {
        $('#' + elementid).attr("style", `display: ${isshow ? 'block' : 'none'} !important`);
    }
</script>
@endsection