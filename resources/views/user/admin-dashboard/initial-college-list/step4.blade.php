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

      <div class="block block-rounded">
        <div class="block-header block-header-tab">
          <h3 class="block-title text-white fw-500">Your Statistics</h3>
        </div>
        <div class="block-content block-content-full">
          <table class="table table-bordered table-sm table-striped table-vcenter">
            <thead>
              <tr>
                <th>Unweight GPA</th>
                <th>{{ $score->unweighted_gpa ? $score->unweighted_gpa : '-' }}</th>
              </tr>  
              <tr>
                <th>Weight GPA</th>
                <th>{{ $score->weighted_gpa ? $score->weighted_gpa : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Goal PSAT Score</th>
                <th>{{ $score->goal_psat_score ? $score->goal_psat_score : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Goal ACT Score</th>
                <th>{{ $score->goal_act_score ? $score->goal_act_score : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Goal SAT Score</th>
                <th>{{ $score->goal_sat_score ? $score->goal_sat_score : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Final ACT Score</th>
                <th>{{ $score->final_act_score ? $score->final_act_score : '-' }}</th>
              </tr>  
              <tr>
                <th>Your Final SAT Score</th>
                <th>{{ $score->final_sat_score ? $score->final_sat_score : '-' }}</th>
              </tr>  
            </thead>
          </table>
        </div>
      </div>

      <div class="block block-rounded">
        <div class="block-header block-header-tab">
          <h3 class="block-title text-white fw-500">College List</h3>
          <button type="button" class="btn btn-sm btn-alt-success" id="add-college">Add College</button>
        </div>
        <div class="block-content block-content-full">
          <div id="userSelectedCollegeList" class="mb-3" role="tablist" aria-multiselectable="true">
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-3">
        <div class="prev-btn">
          <a href="{{ route('admin-dashboard.initialCollegeList.step3', ['college_lists_id' => request()->get('college_lists_id')]) }}" class="btn btn-alt-success prev-step"> Previous Step </a>
        </div>
        <div class="">
          <button class="btn  btn-alt-success save-close">Save & Submit</a>
        </div>
      </div>
    </div>
  </div>
</main>

<div class="modal fade" id="add-college-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add College</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
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
      background-color: #0070c0;
      color: #fff;
    }

    .bg-smart:focus {
      background-color: #0070c0;
      color: #fff;
    }

    .bg-match {
      background-color: #00b050;
      color: #fff;
    }

    .bg-match:focus {
      background-color: #00b050;
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
</style>
@endsection


@section('user-script')
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
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
  let collegeList = []
  $(document).ready(function() {
    // $('#add-college-modal').modal('show');
    getCollegeList();
  })

  function getCollegeList() {
    $.ajax({
      url: "{{ route('admin-dashboard.initialCollegeList.step4.getSelectedCollegeList', ['id' => request()->get('college_lists_id')]) }}",
      method: 'get',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          $('#userSelectedCollegeList').html('');
          const options = ['Smart', 'Match', 'Reach'];
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
                <div class="block-header block-header-default" role="tab" data-bs-toggle="collapse" data-bs-parent="#userSelectedCollegeList" href="#accodion-${index}" aria-expanded="false" aria-controls="accodion-${index}">
                  <div class="d-flex align-items-center gap-3">
                    <i class="fa fa-bars"></i>
                    <span>${data.order_index}</span>
                    <span>${data.college_name}</span>
                  </div>
                </div>
                <div id="accodion-${index}" class="collapse" role="tabpanel" aria-labelledby="faq6_h1" data-bs-parent="#userSelectedCollegeList">
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
                            <th>1</th>
                          </tr>  
                          <tr>
                            <th>Average Accepted ACT:</th>
                            <th>1</th>
                          </tr>  
                          <tr>
                            <th>Average Accepted SAT:</th>
                            <th>1</th>
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
        }
      }
    })
  }

  $(document).on('change', '.selection-type', function (e) {
    console.log(e)
    switch (e.target.value) {
      case 'Smart':
        // set background color blue
        $(this).css('background', '#0070c0');
        $(this).css('color', '#fff');
        break;
      case 'Match':
        $(this).css('background', '#00b050');
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

  Sortable.create(userSelectedCollegeList, {
    animation: 150,
    ghostClass: 'blue-background-class',
    onEnd: function (evt) {
      const payload = []
      for (let  i = 0; i < evt.from.children.length; i++) {
        const data = evt.from.children[i];
        payload.push({
          id: +data.dataset.id,
          order_index: i + 1,
          college_id: +data.dataset.collegeid
        })
      }
      $.ajax({
        url: "{{ route('admin-dashboard.initialCollegeList.step4.updateOrder', ['id' => request()->get('college_lists_id')]) }}",
        method: 'patch',
        data: {
          data: payload
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            getCollegeList();
          }
        }
      })
    }
  });

  $('#add-college').on('click', function (e) {
    One.loader('show')
    $.ajax({
      url: "{{ route('admin-dashboard.initialCollegeList.step4.collegeList', ['id' => request()->get('college_lists_id')]) }}",
      method: 'get',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    }).done(function (response) {
      if (response.success) {
        collegeList = response.data;
        One.loader('hide')
        for (let  i = 0; i < response.data.length; i++) {
          const data = response.data[i];
          const ownership = data['school.ownership'] === 1 ? 'Public' : 'Private';
          const profit = data['school.ownership'] === 3 ? 'For-Profit' : data['school.ownership'] === 2 ? 'Non-Profit' : '';
          const classname = data['school.ownership'] === 1 ? 'fs-3 fw-semibold mt-3 public' : 'fs-3 fw-semibold mt-3';
          let campus = 'N/A'
          switch(data['school.locale']) {
            case 11 || 12 || 13 :
              campus = 'City'
            break;
            case 21 || 22 || 23:
              campus = 'Suburb'
            break;
            case 31 || 32 || 33:
              campus = 'Town'
            break;
            case 41 || 42 || 43:
              campus = 'Rural'
            break;
          }
          let size = 'Large';
          if (data['latest.student.size'] < 2000) {
            size = 'Small'
          } else if (data['latest.student.size'] > 2000 &&data['latest.student.size'] < 15000) {
            size = 'Medium'
          }
          const element =`
            <div class="block block-rounded mb-3">
              <div class="block-header block-header-default block-header-tab">
                <h3 class="block-title text-white fw-500">${data['school.name']}</h3>
                <div class="block-options">
                  ${data['selected'] ? 
                    '<button type="button" class="btn btn-sm btn-alt-danger remove-list" data-id="'+ data['id'] +'">Remove College From List</button>'
                    :
                    '<button type="button" class="btn btn-sm btn-alt-success add-list" data-id="'+ data['id'] +'">Add to My College List</button>'
                  }
                </div>
              </div>
              <div class="block-content mb-">
                <div class="college-search-wrapper">
                  <h5>${data['school.city']}, ${data['school.state']}</h5>
                  <div class="college-search-box">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="block block-rounded text-center mb-3">
                          <div class="block-content py-3 bg-info text-white">
                            <span class="text-black-50 college-years">4</span>
                            <div class="fs-3 fw-semibold">Year</div>
                            <div>College</div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="block block-rounded text-center mb-3">
                          <div class="block-content py-3 bg-danger text-white">
                            <i class="fa fa-building fa-2x college-years text-black-50"></i>
                            <div class="${classname}">${ownership}</div>
                            <div>${profit}</div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="block block-rounded text-center mb-3">
                          <div class="block-content py-3 bg-primary text-white">
                            <i class="fa fa-city fa-2x college-years text-black-50"></i>
                            <div class="fs-3 fw-semibold mt-3">Campus</div>
                            <div>${campus}</div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="block block-rounded text-center mb-3">
                          <div class="block-content py-3 bg-secondary text-white">
                            <i class="fa fa-users fa-2x college-years text-black-50"></i>
                            <div class="fs-3 fw-semibold mt-3">Size</div>
                            <div>${size}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                    <div class="college-text">
                      <p>
                        <b>Acceptance Rate:</b> 
                        ${ data['latest.completion.consumer_rate'] ? (data['latest.completion.consumer_rate'] * 100).toFixed(2) + '%'  : 'N/A' }
                      </p>
                      <p><b>Average Annual Cost:</b> 
                        ${ data['latest.cost.avg_net_price.overall'] ? (data['latest.cost.avg_net_price.overall'] / 1000).toFixed(2) + 'k'  : 'N/A' }
                      </p>
                      <p><b>Median Earnings:</b>
                        ${ data['latest.earnings.10_yrs_after_entry.median'] ? (data['latest.earnings.10_yrs_after_entry.median'] / 1000).toFixed(2) + 'k'  : 'N/A' }
                      </p>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          `
          $('#modal-body').append(element);
        }
        $('#add-college-modal').modal('show');
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
        let url = "{{ route('admin-dashboard.initialCollegeList.step2.removeCollge', [ 'id' => request()->get('college_lists_id'), 'sid' => 'school_id' ]) }}"
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

  $('.save-close').on('click', function (e) {
    console.log('e -->', e)
    let url = "{{ route('admin-dashboard.initialCollegeList.saveCollegeList', [ 'id' => request()->get('college_lists_id') ]) }}"
    $.ajax({
      type: "patch",
      url: "{{ route('admin-dashboard.initialCollegeList.saveCollegeList', [ 'id' => request()->get('college_lists_id') ]) }}",
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
</script>
@endsection
