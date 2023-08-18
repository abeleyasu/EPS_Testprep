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
        @include('user.admin-dashboard.initial-college-list.stepper', [
          'active_stepper' => 4,
          'completed_step' => [1, 2, 3]
        ])
      </div>

      <div class="d-flex justify-content-between mt-3 mb-3">
        <div class="prev-btn">
          <a href="{{ route('admin-dashboard.initialCollegeList.step3') }}" class="btn btn-alt-success prev-step"> Previous Step </a>
        </div>
        <div class="">
          <button class="btn  btn-alt-success save-close">Save & Submit</a>
        </div>
      </div>

      <div class="block block-rounded">
        <div class="block-header block-header-tab">
          <h3 class="block-title text-white fw-500">Your Statistics</h3>
        </div>
        <div class="block-content block-content-full">
          <table class="table table-bordered table-sm table-striped table-vcenter">
            <thead>
              <tr>
                <th>Unweight GPA</th>
                <th>{{ $score ? $score['unweighted_gpa'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Weight GPA</th>
                <th>{{ $score ? $score['weighted_gpa'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Past/Current PSAT Score</th>
                <th>{{ $score && $score['past_current_psat_score'] != 0 ? $score['past_current_psat_score'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Past/Current ACT Score</th>
                <th>{{ $score && $score['past_current_act_score'] != 0 ? $score['past_current_act_score'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Past/Current SAT Score</th>
                <th>{{ $score && $score['past_current_sat_score'] != 0 ? $score['past_current_sat_score'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Goal PSAT Score</th>
                <th>{{ $score && $score['goal_test_type'] == 'PSAT' && $score['goal_composite_score'] ? $score['goal_composite_score'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Goal ACT Score</th>
                <th>{{ $score && $score['goal_test_type'] == 'ACT' && $score['goal_composite_score'] ? $score['goal_composite_score'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Goal SAT Score</th>
                <th>{{ $score && $score['goal_test_type'] == 'SAT' && $score['goal_composite_score'] ? $score['goal_composite_score'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Final ACT Score</th>
                <th>{{ $score && $score['final_test_type'] == 'ACT' && $score['final_composite_score'] ? $score['final_composite_score'] : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Final SAT Score</th>
                <th>{{ $score && $score['final_test_type'] == 'SAT' && $score['final_composite_score'] ? $score['final_composite_score'] : '-' }}</th>
              </tr>
              <tr>
                <th>Your Final PSAT Score</th>
                <th>{{ $score && $score['final_test_type'] == 'PSAT' && $score['final_composite_score'] ? $score['final_composite_score'] : '-' }}</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>

      <div class="block block-rounded">
        <div class="block-header block-header-tab">
          <h3 class="block-title text-white fw-500">College List</h3>
          <button type="button" class="btn btn-sm btn-alt-success" id="add-college">Add College</button>
          <button type="button" class="btn btn-sm btn-alt-success ms-2" id="view-hide-college-btn">View Hidden Colleges</button>
        </div>
        <div class="block-content block-content-full">
          <div class="tab-content" id="user-college-list">
            <div class="setup-content" role="tabpanel" id="deadline-reminder-content-accordian" aria-labeledby="deadline-reminders">
              <div class="accordion" id="userSelectedCollegeList" data-type="step-4" @if($score) data-collegeid="{{ $score['id']  }}" @endif>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-3">
        <div class="prev-btn">
          <a href="{{ route('admin-dashboard.initialCollegeList.step3') }}" class="btn btn-alt-success prev-step"> Previous Step </a>
        </div>
        <div class="">
          <button class="btn  btn-alt-success save-close">Save & Submit</a>
        </div>
      </div>
    </div>
  </div>
</main>

<div class="modal fade" id="add_new_college" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <select class="js-data-example-ajax form-control" id="select-college" name="college" style="width: 100%;" data-placeholder="Select One.">
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
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
<style>
    .block-content, .block-content-full {
      padding: 10px 15px;
    }
    .block-content.block-content-full {
      padding-bottom: 10px;
    }
    .college-list {
      padding: 10px;
      border-bottom: 1px solid #eee;
    }
    .selection-type {
      font-weight: 600;
    }

    .selection-type:focus {
      font-weight: 600;
    }

    .selection-type:focus option {
      background-color: #fff;
      color: black;
    }

    .selection-type option {
      background-color: #fff;
    }

    .college-years {
      font-size: 2em;
      font-weight: 900;
    }
    .public {
      margin-bottom: 24px;
    }

    .bg-smart {
      background-color: #00b050;
      color: #fff;
    }

    .bg-smart:focus {
      background-color: #00b050;
      color: #fff;
    }

    .bg-match {
      background-color: #0070c0;
      color: #fff;
    }

    .bg-match:focus {
      background-color: #0070c0;
      color: #fff;
    }

    .bg-reach {
      background-color: #ff0000;
      color: #fff;
    }

    .bg-reach:focus {
      background-color: #ff0000;
      color: #fff;
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
</style>
@endsection


@section('user-script')
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script src="{{asset('js/college-list.js')}}"></script>
<script>
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

  $('#user-college-list').on('show.bs.collapse', async function (e) {
    $('#toggle' + e.target.dataset.id).removeClass('fa-angle-right').addClass('fa-angle-down');
  })

  $('#user-college-list').on('hidden.bs.collapse', function (e) {
    $('#toggle' + e.target.dataset.id).removeClass('fa-angle-down').addClass('fa-angle-right');
  })

  const collegeid = @json($college);

  let collegeList = []
  $(document).ready(function() {
    getCollegeList();
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
                    <div class="d-flex align-items-center w-100 gap-3 text-white fw-600" role="tab" data-bs-toggle="collapse" data-bs-parent="#userSelectedCollegeList" href="#accodion-${index}" aria-expanded="false" aria-controls="accodion-${index}">
                      <i class="fa fa-2x fa-angle-right" id="toggle${index}"></i>
                      <i class="fa fa-bars"></i>
                      <span>${index + 1}</span>
                      <span>${data.college_name}</span>
                    </div>
                    <div class="d-flex">
                      <button type="button" class="btn btn-sm btn-alt-danger hide-college-from-list me-2" data-id="${data.id}">Hide</button>
                      <button type="button" class="btn btn-sm btn-alt-danger remove-user-college" data-type="step4" data-id="${data.id}">Remove</button>
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
            })
          } else {
            $('#userSelectedCollegeList').html(`<div class="no-data">No College Found</div>`);
          }
        }
      }
    })
  }

  $(document).on('change', '.selection-type', function (e) {
    switch (e.target.value) {
      case 'Smart':
        // set background color blue
        $(this).css('background', '#00b050');
        $(this).css('color', '#fff');
        break;
      case 'Match':
        $(this).css('background', '#0070c0');
        $(this).css('color', '#fff');
        break;
      case 'Reach':
        $(this).css('background', '#ff0000');
        $(this).css('color', '#fff');
        break;
      default:
        $(this).css('background', '#fff');
        $(this).css('color', '#000');
      break;
    }
    const url = "{{ route('admin-dashboard.initialCollegeList.step4.storeSelection', ['id' => ':eid']) }}"
    $.ajax({
      url: url.replace(':eid', e.target.dataset.id),
      method: 'patch',
      data: {
        option: e.target.value
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    }).done(function (response) {
      if (response.success) {
        toastr.success(response.message)
      } else {
        toastr.error(response.message)
      }
    })
  })

  $('#add-college').on('click', function (e) {
    $('#add_new_college').modal('show');
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
        $('#add_new_college').modal('hide')
        getCollegeList()
      } else {
        toastr.error(response.message)
      }
    })
  })

  $(document).on('click', '.add-list', function (e) {
    const schools = collegeList;
    const college_list_id = "{{ request()->get('college_lists_id') }}"
    const school = schools.find(college => college.id == e.target.dataset.id)
    $.ajax({
      type: "POST",
      url: "{{ route('admin-dashboard.initialCollegeList.step2.saveCollege') }}",
      data: {
        school_lists_id: college_list_id,
        school_id: e.target.dataset.id,
        school_name: school['school.name'],
        size: school['latest.student.size'],
        ownership: school['school.ownership'],
        locale: school['school.locale'],
        college_acceptance_rate: school['latest.completion.consumer_rate'],
        college_average_anual_cost: school['latest.cost.avg_net_price.overall'],
        college_median_earnings: school['latest.earnings.10_yrs_after_entry.median'],
      },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    }).done((response) => {
      if (response.success) {
        getCollegeList();
        e.target.className = 'btn btn-sm btn-alt-danger remove-list'
        e.target.innerHTML = 'Remove College From List'
        e.target.blur()
        toastr.success(response.message)
      } else {
        toastr.error(response.message)
      }
    })
  })

  $(document).on('click', '.remove-list', function (e) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to remove this college?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, remove it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        const school_id = e.target.dataset.id
        let url = "{{ route('admin-dashboard.initialCollegeList.step2.removeCollge', [ 'id' => ':id', 'sid' => 'school_id' ]) }}".replace(':id', collegeid)
        url = url.replace('school_id', school_id)
        $.ajax({
          type: "DELETE",
          url: url,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done((response) => {
          if (response.success) {
            getCollegeList();
            e.target.className = 'btn btn-sm btn-alt-success add-list'
            e.target.innerHTML = 'Add to My College List'
            e.target.blur()
            toastr.success(response.message)
          } else {
            toastr.error(response.message)
          }
        })
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

  $('.save-close').on('click', function (e) {
    $.ajax({
      type: "patch",
      url: "{{ route('admin-dashboard.initialCollegeList.saveCollegeList', [ 'id' => ':id' ]) }}".replace(':id', collegeid),
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    }).done((response) => {
      if (response.success) {
        toastr.success("College List Saved Successfully")
        window.location.href = "{{ route('admin-dashboard.initialCollegeList.step1') }}"
      } else {
        toastr.error(response.message)
      }
    })
  })

  $('#view-hide-college-btn').on('click', async function (e) {
    await getHideCollegeList('hide-college-list-modal')
  })

  $(document).on('click', '.show-college-from-list', async function (e) {
    const response = await hideshowlist(e.target.dataset.id);
    if (response) {
      getCollegeList();
      getHideCollegeList('hide-college-list-modal')
    }
  })
</script>
@endsection
