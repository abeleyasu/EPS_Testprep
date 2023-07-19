@extends('layouts.user')

@section('title', 'Admission Dashboard : CPS')

@section('user-content')
<main id="main-container">
  <div class="bg-image" style="background-image: url('{{ asset('static-image/admissionsimage.jpg') }}');">
    <div class="bg-black-15">
      <div class="content content-full text-center">
        <br /> 
        <span class="text-white-75"></span>
        <br />

        <h1 class="h2 text-white mb-0">Admissions Dashboard</h1>
        <br /> 
        <span class="text-white-75"></span>
        <br /> 
      </div>
    </div>
  </div>
  <div class="bg-body-extra-light">
    <div class="content content-boxed">
      
      @if(count($college_list_deadline) > 0)
      <div class="row @if(count($college_list_deadline) > 3) owl-carousel owl-theme @endif">
        @foreach($college_list_deadline as $key => $deadline)
        <div class="@if(count($college_list_deadline) > 3) col-12 @else col-6 col-md-4 @endif">
          <div class="block block-bordered shadow py-3 px-2 gap-1 d-flex flex-column align-items-center">
            @if($deadline['college_information']['college_icon'])
              <img class="college-image" src="{{ asset('college_icon/' . $deadline['college_information']['college_icon']) }}" alt="">
            @else
              <img class="college-image" src="{{ asset('static-image/no-image.jpg') }}" alt="">
            @endif
            <div class="fs-sm fw-semibold text-muted text-uppercase">Choice #{{$key + 1}}</div>
            <a class="text-dark text-center">{{ $deadline['college_name'] }}</a>
            @if($deadline['college_deadline']['admissions_deadline'])
              <div class="fs-sm fw-semibold text-muted text-uppercase">Admissions Deadline</div>
              <a class="text-dark">{{ $deadline['college_deadline']['admissions_deadline'] }}</a>
              <a class="text-dark">{{ $deadline['college_deadline']['admissions_deadline_diff'] }}</a>
            @else
              <a href="{{ route('admin-dashboard.collegeApplicationDeadline') }}" class="btn btn-alt-success btn-sm">Add Deadline Date</a>
            @endif
          </div>
        </div>
        @endforeach
      </div>
      @else
      <div class="no-data mb-4">
        <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}" class="btn btn-alt-success btn-sm">Click here to add college</a>
      </div>
      @endif
    </div>
  </div>
  <div class="content content-boxed">
    <div class="row">
      <div class="col-md-6 col-xl-6">
        <div class="block block-rounded">
          <div class="block-header block-header-tab text-white">
            <h3 class="block-title">
              <i class="fa fa-screwdriver-wrench text-white me-1"></i> Admissions Tools
            </h3>
          </div>
          <div class="block-content">
            <div id="section-1" class="mb-5" role="tablist" aria-multiselectable="true">
              <div class="block block-rounded block-bordered overflow-hidden mb-1">
                <div class="block-header block-header-tab" role="tab" id="faq12_h1">
                  <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1" href="#college-application-resume" aria-expanded="true" aria-controls="college-application-resume">
                    <i class="nav-main-link-icon fa fa-file"></i> 
                    High School Resume
                  </a>
                </div>
                <div id="college-application-resume" class="collapse" role="tabpanel" aria-labelledby="faq12_h1" data-bs-parent="#section-1">
                  <div class="block-content">
                    <div>Your College Application Resume is an important step in crafting your profile for college admissions committees. Get started by clicking the link below.</div>
                    <div>Click to begin or edit your College Application Resume</div>
                    <a href="{{ route('admin-dashboard.highSchoolResume.personalInfo') }}" class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>High School Resume</a>
                  </div>
                </div>
              </div>
              <div class="block block-rounded block-bordered overflow-hidden mb-1">
                <div class="block-header block-header-tab" role="tab" id="faq5_h2">
                  <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1" href="#initial-college-list" aria-expanded="true" aria-controls="initial-college-list">
                    <i class="nav-main-link-icon fa fa-list-check"></i> 
                    Initial College List
                  </a>
                </div>
                <div id="initial-college-list" class="collapse" role="tabpanel" aria-labelledby="faq5_h2" data-bs-parent="#section-1">
                  <div class="block-content">
                    <div>Start a list of colleges that you're interested in attending. Fill out your high school statistics (GPA & test scores) and compare them with the college's typical accepted statistics. Rank the colleges based on your research and preferences. Apply Smart, Match, or Reach labels to each of them to make sure you have a good mix of schools.</div> 
                    <div>Click to begin or edit your list</div>
                    <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}" class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>Initial College List</a>
                  </div>
                </div>
              </div>
              <div class="block block-rounded block-bordered overflow-hidden mb-1">
                <div class="block-header block-header-tab" role="tab" id="faq3_h2">
                  <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1" href="#college-application-deadline-organizer" aria-expanded="true" aria-controls="college-application-deadline-organizer">
                    <i class="nav-main-link-icon fa fa-timeline"></i> 
                    College Application Deadline Organizer
                  </a>
                </div>
                <div id="college-application-deadline-organizer" class="collapse" role="tabpanel" aria-labelledby="faq3_h2" data-bs-parent="#section-1">
                  <div class="block-content">
                    <div>Input deadlines for the colleges you're interested in attending. Set reminders for these deadlines to stay on track with your applications.</div>
                    <div>Click to start inputting application deadlines</div>
                    <a href="{{ route('admin-dashboard.collegeApplicationDeadline') }}" class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>College Application Deadline Organizer</a>
                  </div>
                </div>
              </div>
              <div class="block block-rounded block-bordered overflow-hidden mb-1">
                <div class="block-header block-header-tab" role="tab" id="faq4_h2">
                  <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1" href="#college-cost-comparison" aria-expanded="true" aria-controls="college-cost-comparison">
                    <i class="nav-main-link-icon fa fa-comments-dollar"></i> 
                    College Cost Comparison
                  </a>
                </div>
                <div id="college-cost-comparison" class="collapse" role="tabpanel" aria-labelledby="faq4_h2" data-bs-parent="#section-1">
                  <div class="block-content">
                    <div>Input various costs of each college you're considering to compare the difference in final cost. This tool provides a more realistic look at the costs because you can input tuition, fees, scholarships, and more that are unique to each college.</div>
                    <div>Click to start comparing college costs</div>
                    <a href="{{ route('admin-dashboard.cost_comparison') }}" class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>College Cost Comparison</a>
                  </div>
                </div>
              </div>
              <div class="block block-rounded block-bordered overflow-hidden mb-1">
                <div class="block-header block-header-tab" role="tab" id="faq4_h2">
                  <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1" href="#career-exploration" aria-expanded="true" aria-controls="career-exploration">
                    <i class="nav-main-link-icon fa fa-file"></i> 
                    Career Exploration
                  </a>
                </div>
                <div id="career-exploration" class="collapse" role="tabpanel" aria-labelledby="faq4_h2" data-bs-parent="#section-1">
                  <div class="block-content">
                    <div>Your High School Resume is an important step in crafting your profile for college admissions committees. Get started by clicking the link below.</div>
                    <div>Click to begin your career search</div>
                    <a href="{{ route('admin-dashboard.careerExploration') }}" class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>Career Exploration</a>
                  </div>
                </div>
              </div>
              <div class="block block-rounded block-bordered overflow-hidden mb-1">
                <div class="block-header block-header-tab" role="tab" id="faq4_h2">
                  <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1" href="#college-search" aria-expanded="true" aria-controls="college-search">
                    <i class="nav-main-link-icon fa fa-file"></i> 
                    College Search
                  </a>
                </div>
                <div id="college-search" class="collapse" role="tabpanel" aria-labelledby="faq4_h2" data-bs-parent="#section-1">
                  <div class="block-content">
                    <div>Your College Application Resume is an important step in crafting your profile for college admissions committees. Get started by clicking the link below.</div>
                    <div>Click to begin your College Search</div>
                    <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}" class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray"></i>College Search</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="block block-rounded">
          <div class="block-header block-header-tab text-white">
            <h3 class="block-title">
              <i class="fa fa-screwdriver-wrench text-white me-1"></i> ADMISSIONS WORKSHEETS
            </h3>
          </div>
          <div class="block-content">
            <div id="section-2" class="mb-5" role="tablist" aria-multiselectable="true">
              @if(count($worksheet_data) > 0)
                @foreach($worksheet_data as $worksheet)
                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                  <div class="block-header block-header-tab" role="tab" id="faq12_h1">
                    <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-2" href="#tips-for-college-fairs" aria-expanded="true" aria-controls="tips-for-college-fairs">
                      <i class="nav-main-link-icon fa fa-file"></i> 
                      {{ $worksheet->name }}
                    </a>
                  </div>
                  <div id="tips-for-college-fairs" class="collapse" role="tabpanel" aria-labelledby="faq12_h1" data-bs-parent="#section-2">
                    <div class="block-content">
                      <div>{{ $worksheet->description }}</div>
                      <div>Click the below to download the worksheet</div>
                      <a href="{{ asset('uploads/worksheet/' . $worksheet->sheet_name) }}" download="sheet.csv" class="btn btn-gray fs-xs fw-semibold me-1 mb-3 bg-dark text-gray download-worksheet"></i>Download Worksheet</a>
                    </div>
                  </div>
                </div>
                @endforeach
              @else
                <div class="no-data mb-4">
                  No worksheet found
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-6">
      <div class="block block-rounded">
        <div class="block-header block-header-tab text-white">
          <h3 class="block-title">
            <i class="fa fa-book text-white me-1"></i> Admissions Lessons
          </h3>
        </div>
        <div class="block-content">
          <div class="fs-sm push">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <a class="fw-semibold" href=""><i class="nav-main-link-icon fa fa-person"></i> Milestone 1: Profile Development</a>
              </div>
            </div>
            <p class="mb-0">Learn why developing your profile is important and how to do it.</p>
          </div>
          <div class="fs-sm push">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <a class="fw-semibold" href=""><i class="nav-main-link-icon fa fa-user-doctor"></i> Milestone 2: Career Exploration</a>
              </div>
            </div>
            <p class="mb-0">Learn how to research careers and decide what's right for you.</p>
          </div>
          <div class="fs-sm push">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <a class="fw-semibold" href=""><i class="nav-main-link-icon fa fa-magnifying-glass-location"></i> Milestone 3: College Search</a>
              </div>
            </div>
            <p class="mb-0">Learn how to search for colleges that fit you and your goals.</p>
          </div>
          <div class="fs-sm push">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <a class="fw-semibold" href=""><i class="nav-main-link-icon fa fa-brain"></i> Milestone 4: Test Prep</a>
              </div>
            </div>
            <p class="mb-0">Learn how to search for colleges that fit you and your goals.</p>
          </div>
          <div class="fs-sm push">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <a class="fw-semibold" href=""><i class="nav-main-link-icon fa fa-rectangle-list"></i> Milestone 5: College Applications</a>
              </div>
            </div>
            <p class="mb-0">Learn how to fill out your college applications and the do's and don't's of college applications.</p>
          </div>
          <div class="fs-sm push">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <a class="fw-semibold" href=""><i class="nav-main-link-icon fa fa-magnifying-glass-dollar"></i> Milestone 6: Financial Aid and Scholarships</a>
              </div>
            </div>
            <p class="mb-0">Learn how to find financial aid and research scholarships.</p>
          </div>
          <div class="fs-sm push">
            <div class="d-flex justify-content-between mb-2">
              <div>
                <a class="fw-semibold" href=""><i class="nav-main-link-icon fa fa-school"></i> Milestone 7: Final College Selection</a>
              </div>
            </div>
            <p class="mb-0">Learn how to make a decision between the colleges that you were accepted to.</p>
          </div>
          <div class="text-center push">
            <button type="button" class="btn btn-sm btn-alt-secondary">Visit the Test Prep Lesson Homepage for more..</button><!-- sends student to the Test Prep Milestone 4 page with all the Test Prep Modules on it -->
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/js/owal-carousel/owl.carousel.min.css') }}">
<style>
  .college-image {
    display: inline-block!important;
    width: 64px !important;
    height: 64px;
    border-radius: 50%;
  }
  .block-header-tab {
    background-color: #1f2937;
    text-align: left;
    justify-content: left;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
  }

  .block-header-tab i {
    font-size: 17px;
    position: relative;
    top: 0px;
  }
  .no-data {
    border: 1px solid;
    border-style: dashed;
    border-color: darkgray;
    padding: 10px;
    text-align: center;
    font-size: 15px;
    font-weight: 500;
  }

  .owl-carousel .owl-nav button.owl-prev {
    background: #d9e8c3;
    color: #000;
    border: 1px solid #d9e8c3;
    border-radius: 50%;
    height: 40px;
    width: 40px;
    line-height: 40px;
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    outline: none;
    transition: all 0.3s ease-in-out;
  }

  .owl-carousel .owl-nav button.owl-next {
    background: #d9e8c3;
    color: #000;
    border: 1px solid #d9e8c3;
    border-radius: 50%;
    height: 40px;
    width: 40px;
    line-height: 40px;
    font-size: 20px;
    position: absolute;
    top: 50%;
    right: -20px;
    transform: translateY(-50%);
    outline: none;
    transition: all 0.3s ease-in-out;
  }
</style>
@endsection

@section('user-script')
<script src="{{ asset('assets/js/owal-carousel/owl.carousel.min.js') }}"></script>
<script>
  $(".owl-carousel").owlCarousel({
    margin: 20,
    loop: false,
    items: 3,
    animateIn: "fadeIn",
    animateOut: "fadeOut",
    dots: false,
    nav: true,
    responsive: {
      980: {
        items: 3,
      },
      600: {
        items: 2,
      },
      320: {
        items: 1,
      },
    }
  });
</script>

@endsection
