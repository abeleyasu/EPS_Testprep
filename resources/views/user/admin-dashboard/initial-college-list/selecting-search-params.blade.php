@extends('layouts.user')

@section('title', 'Initial College List : CPS')

@section('user-content')
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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li role="presentation">
                        <a class="nav-link active" href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}" id="step1-tab">
                            <p>1</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Selecting Search <br> Parameters</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step2-tab">
                            <p>2</p>
                            <i class="fa-solid fa-check  "></i>
                            <h6>College Search <br> Results</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step3-tab">
                            <p>3</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>My Academic <br> Statistics</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step4-tab">
                            <p>4</p>
                            <i class="fa-solid fa-check "></i>
                            <h6>Academic Qualification <br> Comparison</h6>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="nav-link" href="javascript:void(0)" id="step5-tab">
                            <p>5</p>
                            <i class="fa-solid fa-check"></i>
                            <h6>College List</h6>
                        </a>
                    </li>
                </ul>
            </div>
            <p class="mb-5">Input the aspects of colleges that matter to you the most -OR- directly search for colleges</p>
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
                            <div class="college_wants-wrapper">
                                <h6><span>Note:</span> We suggest starting your search with no more than 3 of the
                                    following
                                    aspects selected, see
                                    which colleges show up in your results, then decide whether to choose more than 3
                                    aspects to
                                    refine your results, if it feels necessary (or if too many colleges show up in your
                                    search).
                                    We
                                    suggest choosing the 1st 3 aspects, but feel free to choose different options that
                                    are
                                    important
                                    to you personally if you choose.</h6>
                                <div class="college_wants_list">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                                            <div class="accordion accordionExample">
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <a class=" text-white fw-600 collapsed"><i class="fa fa-2x fa-calendar"></i> College Major & Degree
                                                            Type</a>
                                                    </div>
                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                        <div class="college-content-wrapper college-content">
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="search_major" name="search_major">
                                                                    <label class="form-check-label" for="search_major">
                                                                        Search Specific College Majors
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="college_major" name="college_major">
                                                                    <label class="form-check-label" for="college_major">
                                                                        Browse All College Majors
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="degree_type" name="degree_type">
                                                                    <label class="form-check-label" for="degree_type">
                                                                        Degree Type
                                                                    </label>
                                                                </div>
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
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="location_city" name="location_city">
                                                                    <label class="form-check-label" for="location_city">
                                                                        Search by City, State, or Region
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="location_browse_city" name="location_browse_city">
                                                                    <label class="form-check-label" for="location_browse_city">
                                                                        Browse by City, State, or Region
                                                                    </label>
                                                                </div>
                                                            </div>
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
                                                                    <input class="form-check-input" type="checkbox" value="1" id="student_population" name="student_population">
                                                                    <label class="form-check-label" for="student_population">
                                                                        Student Population / College Size
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="type_school" name="type_school">
                                                                    <label class="form-check-label" for="type_school">
                                                                        Type of School
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="specialized_mission" name="specialized_mission">
                                                                    <label class="form-check-label" for="specialized_mission">
                                                                        Specialized Mission
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="religious_affiliation" name="religious_affiliation">
                                                                    <label class="form-check-label" for="religious_affiliation">
                                                                        Religious Affiliation
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                                                    <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                        <a class="text-white fw-600 collapsed"><i class="fa fa-2x fa-clock"></i> Sports</a>
                                                    </div>
                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample">
                                                        <div class="college-content-wrapper college-content">
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="Search_Sports" name="Search_Sports">
                                                                    <label class="form-check-label" for="Search_Sports">
                                                                        Search Sports
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="Browse_Sports" name="Browse_Sports">
                                                                    <label class="form-check-label" for="Browse_Sports">
                                                                        Browse Sports
                                                                    </label>
                                                                </div>
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
                                                            <div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="Average_Cost" name="Average_Cost">
                                                                    <label class="form-check-label" for="Average_Cost">
                                                                        Average Annual Cost
                                                                    </label>
                                                                </div>
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
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="Test_Scores" name="Test_Scores">
                                                                    <label class="form-check-label" for="Test_Scores">
                                                                        Test Scores
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="Sat_Score" name="Sat_Score">
                                                                    <label class="form-check-label" for="Sat_Score">
                                                                        SAT Reading/Writing Score
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="Math_Score" name="Math_Score">
                                                                    <label class="form-check-label" for="Math_Score">
                                                                        SAT Math Score
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="Act_Score" name="Act_Score">
                                                                    <label class="form-check-label" for="Act_Score">
                                                                        ACT Score
                                                                    </label>
                                                                </div>
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
                                <a href="#" class="btn btn-alt-success submit_btn mt-4">Start College Search</a>
                            </div>
                        </div>
                        <div class="tab-pane" id="btabs-static-profile" role="tabpanel" aria-labelledby="btabs-static-profile-tab">
                            <div class="college_wants-wrapper">
                                <div class="input-group input-group-sm college_wants_input">
                                    <input type="text" class="search_college_by_name form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                                    <span class="input-group-text border-0">
                                        <i class="fa fa-fw fa-search"></i>
                                    </span>
                                </div>
                                <a href="javascript:void(0)" onclick="retriveCollegeByName()" class="btn btn-alt-success submit_btn mt-4">Start College Search</a>
                            </div>
                        </div>
                        <div class="tab-pane" id="btabs-static-settings" role="tabpanel" aria-labelledby="btabs-static-settings-tab">
                            <h4 class="fw-normal">Information Button Content</h4>
                            <p>...</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{-- <div class="next-btn">
                            <input type="submit" class="btn  btn-alt-success next-step" value="Next Step"/>
                        </div> --}}
                    <div class="">
                        <a href="{{ route('admin-dashboard.initialCollegeList.CollegeSearchResults') }}" class="btn  btn-alt-success next-step">Next Step</a>
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
    var retrivedData = "";

    function retriveCollegeByName() {
        const collegeName = jQuery(".search_college_by_name").val();

        $.ajax({
            url: "https://api.data.gov/ed/collegescorecard/v1/schools?api_key=PzDzDnBqAja14KXZF7C9guQB33Wrnltd0Mk4dNbw&school.search=" + collegeName,
            method: "GET",
            dataType: "json",
            success: function(data) {
                // Process the response data here
                console.log(data);
                localStorage.setItem("searchResult", JSON.stringify(data));
                window.location = "{{ route('admin-dashboard.initialCollegeList.CollegeSearchResults') }}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle the error here
                console.log("Request failed: " + textStatus + ", " + errorThrown);
            }
        });


    }
</script>
@endsection