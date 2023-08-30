@extends('layouts.user')

@section('title', 'User Dashboard : CPS')

@section('user-content')
<!-- Main Container -->
<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
      <div class="bg-black-10">
        <div class="content content-full text-center">
          <br>
          <h1 class="h2 text-white mb-0">Dashboard</h1>
          <br>
        </div>
      </div>
    </div>
    <div class="content">
      @if(session('success'))
        <div class="alert alert-success fade show" role="alert">
          {{ session('success') }}
        </div>
      @endif
      @if(!auth()->user()->userSurvey)
        <div class="alert alert-success fade show" role="alert">
          Congratulations! You have successfully completed your profile. If you have the time, please take a moment to tell us how satisfied you are with your experience so far.
          <a href="{{ route('survey-form') }}" class="btn btn-sm btn-primary">Take Survey</a>
        </div>
      @endif
        
      <section class="my-college-section border-class mb-0">
        <div class="block-header block-header-tab justify-content-center fs-4">
          My College
        </div>
        <div class="block-content p-0">
          @include('components.admission.dashboard-college-list', [
            'college_list_deadline' => $college_list_deadline
          ])
        </div>
      </section>

      <section class="my-test-score mt-4 mb-0">
        <div class="block block-rounded block-bordered overflow-hidden mb-1">
          <div class="block-header block-header-tab justify-content-center fs-4">
            My Test Score
          </div>
          <div class="block-content">
            @include('components.test-prep.test-score', [
              'getTestScores' => $getTestScores,
              'is_main_dashboard' => true
            ])
          </div>
        </div>
      </section>

      <section class="milestone-calender-events mt-4">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="block block-rounded">
              <div class="block-header block-header-tab text-white">
                <h3 class="block-title">
                  <i class="fa fa-book text-white me-1"></i> College Prep Milestone lessons
                </h3>
              </div>
              <div class="block-content">
                @include('components.admission.milestone-lession', [
                  'milestones' => $milestones
                ])
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="block block-rounded">
              <div class="block-header block-header-tab text-white">
                <h3 class="block-title">
                  <i class="fa fa-book text-white me-1"></i> Calendar & Notification
                </h3>
              </div>
              <div class="block-content">
                <div id="section-1" class="mb-5" role="tablist" aria-multiselectable="true">
                  <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-tab" role="tab" id="faq12_h1">
                      <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1" href="#notification-system" aria-expanded="true" aria-controls="notification-system">
                        <i class="nav-main-link-icon fa fa-file"></i> 
                        Notification System
                      </a>
                    </div>
                    <div id="notification-system" class="collapse" role="tabpanel" aria-labelledby="faq12_h1" data-bs-parent="#section-1">
                      <div class="block-content">
                        Comming Soon!
                      </div>
                    </div>
                  </div>
                  <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-tab" role="tab" id="faq12_h1">
                      <a class="text-white" data-bs-toggle="collapse" data-bs-parent="#section-1" href="#practice-calendar" aria-expanded="true" aria-controls="practice-calendar">
                        <i class="nav-main-link-icon fa fa-file"></i> 
                        Study & Practice Calendar
                      </a>
                    </div>
                    <div id="practice-calendar" class="collapse show" role="tabpanel" aria-labelledby="faq12_h1" data-bs-parent="#section-1">
                      <div class="block-content">
                        @include('components.test-prep.calendar', [
                          'events' => $events
                        ])
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
</main>
<!-- END Main Container -->
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/js/owal-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/college-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/fullcalendar/main.min.css') }}">
@endsection

@section('user-script')
<script src="{{ asset('assets/js/plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('assets/js/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/_js/pages/be_comp_calendar.js') }}"></script>
<script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>

<script src="{{asset('assets/js/lib/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{ asset('assets/js/owal-carousel/owl.carousel.min.js') }}"></script>
<script>
  One.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-masked-inputs', 'jq-rangeslider', 'jq-colorpicker']);
  $(".owl-carousel").owlCarousel({
    margin: 1,
    loop: false,
    items: 3,
    animateIn: "fadeIn",
    animateOut: "fadeOut",
    dots: false,
    nav: true,
    responsive: {
      1200: {
        items: 4,
      },
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
<script>
  let eventObj = @json($final_arr);

  pageCompCalendar.init(eventObj);
		
  var testTypeDropdown = $('#testTypeDropdown').val();
  if(testTypeDropdown) {
    $.ajax({
      url: "{{ route('update_test_type') }}",
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        updtvalue: 'primary_test_type',
        field_value: testTypeDropdown
      },
      success: function(response) {
        $('.lastTestCls').text(response.scaled_score);
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  } else {
    $('.editInitialScore').hide();
    $('.editGoalScore').hide();
  }

  $(document).ready(function() {
    $("#categoryQuestion1").click(function() {
      $(this).toggleClass("show");
    });

    $(".editPrimaryTest").click(function() {
      $('#editDropdownContainer').toggle();
      $('.selectedPrimaryTest').toggle();
    });

    $("#testTypeDropdown").change(function() {
      // var testTypeValue = $('.selectedPrimaryTest').text().trim();
      var newTestType = this.value;

      if(newTestType != '') {
        $.ajax({
          url: "{{ route('update_test_type') }}",
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            updtvalue: 'primary_test_type',
            field_value: newTestType
          },
          success: function(response) {
            // console.log(response.scaled_score);

            $('.selectedPrimaryTest').text(newTestType);
            $('.lastTestCls').text(response.scaled_score);
            
            $('#editDropdownContainer').toggle();
            $('.selectedPrimaryTest').toggle();

            $('.editInitialScore').show();
            $('.editGoalScore').show();

            toastr.options = {
                "progressBar": true,
                "closeButton": true,
                "timeOut": 4000,
            };
            toastr.success("PRIMARY TEST UPDATED!");
          },
          error: function(xhr) {
            console.log(xhr.responseText);
          }
        });
      }
    });


    $(".editInitialScore").click(function() {
      $('.initialScoreCls').toggle();
      $('#editInitialScoreContainer').toggle();
      $('#txtinitialScore').focus().select();
    });

    $('#txtinitialScore').on('keypress', function(event) {
      // Allow backspace, delete, and arrow keys
      if (event.keyCode === 8 || event.keyCode === 37 || event.keyCode === 39) {
        return true;
      }
      // Ensure only numeric characters are allowed (ASCII codes 48 to 57)
      if (event.keyCode < 48 || event.keyCode > 57) {
        event.preventDefault();
      }
      if (event.which === 13) {
        var old_initialScore = $('.initialScoreCls').text().trim();
        var new_initialScore = this.value;
        if(new_initialScore != '' && new_initialScore != old_initialScore) {
          $.ajax({
            url: "{{ route('update_test_type') }}",
            type: 'POST',
            data: {
              _token: '{{ csrf_token() }}',
              updtvalue: 'initial_score',
              field_value: new_initialScore
            },
            success: function(response) {
              $('.initialScoreCls').text(new_initialScore);
              $('.initialScoreCls').toggle();
              $('#editInitialScoreContainer').toggle();

              toastr.options = {
                "progressBar": true,
                "closeButton": true,
                "timeOut": 4000,
              };
              toastr.success("INITIAL SCORE UPDATED!");
            },
            error: function(xhr) {
              console.log(xhr.responseText);
            }
          });
        }
      }
    });

    $(".editGoalScore").click(function() {
      $('.goalScoreCls').toggle();
      $('#editGoalScoreContainer').toggle();
      $('#txtgoalScore').focus().select();
    });

    $('#txtgoalScore').on('keypress', function(event) {
      // Allow backspace, delete, and arrow keys
      if (event.keyCode === 8 || event.keyCode === 37 || event.keyCode === 39) {
        return true;
      }
      // Ensure only numeric characters are allowed (ASCII codes 48 to 57)
      if (event.keyCode < 48 || event.keyCode > 57) {
        event.preventDefault();
      }
      if (event.which === 13) {
        var old_goalScore = $('.goalScoreCls').text().trim();
        var new_goalScore = this.value;
        if(new_goalScore != '' && new_goalScore != old_goalScore) {
          $.ajax({
            url: "{{ route('update_test_type') }}",
            type: 'POST',
            data: {
              _token: '{{ csrf_token() }}',
              updtvalue: 'goal_score',
              field_value: new_goalScore
            },
            success: function(response) {
              $('.goalScoreCls').text(new_goalScore);
              $('.goalScoreCls').toggle();
              $('#editGoalScoreContainer').toggle();
              toastr.options = {
                "progressBar": true,
                "closeButton": true,
                "timeOut": 4000,
              };
              toastr.success("GOAL SCORE UPDATED!");
            },
            error: function(xhr) {
              console.log(xhr.responseText);
            }
          });
        }
      }
    });
  });

  $('input[type="checkbox"]').click(function(e) {
    e.stopPropagation()
  })

  function addTitle() {
    let title = $('#event-title').val();

    if (title == "") {
      toastr.error("Please Enter Event!");
      return false;
    } else {
      $.ajax({
        url: "{{ route('calendar.addEvent') }}",
        type: "POST",
        dataType: "JSON",
        data: {
          "_token": "{{ csrf_token() }}",
          "title": title
        },
        success: function(resp) {
          let html = ``;
          if (resp.success) {
            html += `<li class="event-list-${resp.data.id}">`;
            html +=
              `<div class="js-event p-2 fs-sm fw-medium rounded bg-${resp.data.color}-light text-${resp.data.color}" data-url="{{ route('calendar.assignEvent') }}" data-id="${resp.data.id}">${resp.data.title}<span class="main-event-trash" onclick="mainEventTrash(${resp.data.id})"><i class="fa-solid fa-trash"></i></div>`;
            html += `</li>`;

            $('.list-events').append(html);
            $('#event-title').val("");
            toastr.success(resp.message);
          }
        },
        error: function(err) {
          console.log("err =>>>", err);
        }
      });
    }
  }

  function mainEventTrash(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to delete this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `{{ url('user/calendar/trash-event/${id}') }}`,
          type: "DELETE",
          dataType: "JSON",
          data: {
            "_token": "{{ csrf_token() }}",
          },
          success: function(resp) {
            if (resp.success) {
              $(`.event-list-${resp.data}`).remove();
              toastr.success(resp.message);
            }
          },
          error: function(err) {
            console.log("err =>>>", err);
          }
        });
      }
    })
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