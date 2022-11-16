@extends('layouts.user')

@section('title', 'Student View Dashboard : CPS')

@section('page-script')
<script>
  $(document).ready(function() {
    $("#categoryQuestion1").click(function() {
      $(this).toggleClass("show");
    });
  });

  $('input[type="checkbox"]').click(function(e) {
    e.stopPropagation()
  })
</script>
@endsection

@section('user-content')
<!-- Main Container -->
<main id="main-container">
        <div class="bg-body-light">
        <div class="content content-boxed">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="be_pages_elearning_courses.html">Practice Tests</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">College Prep System SAT Practice Test #1</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Sections</a>
                    </li>
                </ol>
            </nav>
        </div>
        </div>
        <!-- Hero -->
        <div class="bg-body-light">
          <div class="content content-boxed">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
              <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                  Practice test sections
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                  This test has 4 sections and 15 questions
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content content-boxed">
          <!-- Timeline -->
          <!--
              Available classes for timeline list:

              'timeline'                                      A normal timeline with icons to the left in all screens
              'timeline timeline-centered timeline-alt'       A centered timeline with odd events to the left and even events to the right (screen width > 1200px)
              'timeline timeline-centered'                    A centered timeline with all events to the left. You can add the class 'timeline-event-alt'
                                                              to 'timeline-event' elements to position them to the right (screen width > 1200px) (useful, if you
                                                              would like to have multiple events to the left or to the right section)
          -->
          <ul class="timeline timeline-alt" style='padding: 0'>
            

            <!-- START SECTION -->
            <li class="timeline-event">
              <div class="timeline-event-icon bg-success">
                <i class="fa-solid fa-1"></i>
              </div>
              <div class="timeline-event-block block">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Section 1</h3>
                  <div class="block-options">
                    <div class="timeline-event-time block-options-item fs-sm fw-semibold">
                        14 Questions - 10 Minutes
                    </div>
                  </div>
                </div>
                <div class="block-content">
                    <div class="d-flex justify-content-between">
                      <p>
                        Start Section 1 questions
                      </p>
                      <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                        <i class="fa fa-lg fa-circle-check me-1"></i>Start Section 1
                      </button>
                    </div>
                </div>
              </div>
            </li>
            <!-- END SECTION -->

            <!-- START SECTION -->
            <li class="timeline-event">
              <div class="timeline-event-icon bg-success">
                <i class="fa-solid fa-2"></i>
              </div>
              <div class="timeline-event-block block">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Section 1</h3>
                  <div class="block-options">
                    <div class="timeline-event-time block-options-item fs-sm fw-semibold">
                        14 Questions - 10 Minutes
                    </div>
                  </div>
                </div>
                <div class="block-content">
                    <div class="d-flex justify-content-between">
                      <p>
                        Start Section 1 questions
                      </p>
                      <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                        <i class="fa fa-lg fa-circle-check me-1"></i>Start Section 1
                      </button>
                    </div>
                </div>
              </div>
            </li>
            <!-- END SECTION -->

            <!-- START SECTION -->
            <li class="timeline-event">
              <div class="timeline-event-icon bg-success">
                <i class="fa-solid fa-3"></i>
              </div>
              <div class="timeline-event-block block">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Section 1</h3>
                  <div class="block-options">
                    <div class="timeline-event-time block-options-item fs-sm fw-semibold">
                        14 Questions - 10 Minutes
                    </div>
                  </div>
                </div>
                <div class="block-content">
                    <div class="d-flex justify-content-between">
                      <p>
                        Start Section 1 questions
                      </p>
                      <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                        <i class="fa fa-lg fa-circle-check me-1"></i>Start Section 1
                      </button>
                    </div>
                </div>
              </div>
            </li>
            <!-- END SECTION -->

            <!-- START SECTION -->
            <li class="timeline-event">
              <div class="timeline-event-icon bg-success">
                <i class="fa-solid fa-4"></i>
              </div>
              <div class="timeline-event-block block">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Section 1</h3>
                  <div class="block-options">
                    <div class="timeline-event-time block-options-item fs-sm fw-semibold">
                        14 Questions - 10 Minutes
                    </div>
                  </div>
                </div>
                <div class="block-content">
                    <div class="d-flex justify-content-between">
                      <p>
                        Start Section 1 questions
                      </p>
                      <button type="button" class="btn btn-success fs-xs fw-semibold me-1 mb-3 bg-success-light text-success">
                        <i class="fa fa-lg fa-circle-check me-1"></i>Start Section 1
                      </button>
                    </div>
                </div>
              </div>
            </li>
            <!-- END SECTION -->

            

          </ul>
          <!-- END Timeline -->
        </div>
        <!-- END Page Content -->
      </main>
<!-- END Main Container -->
@endsection

@section('page-style')
<style>
  .content {
    width: 90%;
  }

  .input-check {
    position: absolute;
    top: 145px;
    right: 64px;
  }

  .block-header {
    justify-content: start;
    /* padding: 0; */
  }

  .js-table-sections-header.show>tr>td:first-child>i .js-table-checkable tbody tr,
  .js-table-sections-header>tr {
    cursor: pointer;
  }

  .js-table-sections-header>tr>td:first-child>i {

    transition: transform 0.15s ease-out;
  }

  .js-table-sections-header tbody {
    display: none;
  }

  .js-table-sections-header .show>tr>td:first-child>i {
    transform: rotate(90deg);
  }

  .js-table-sections-header .show tbody {
    display: table-row-group;
  }
</style>
@endsection