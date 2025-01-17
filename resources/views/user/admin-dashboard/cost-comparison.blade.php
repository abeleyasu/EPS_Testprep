@extends('layouts.user')

@section('title', 'Cost Comparison : CPS')

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/college-application-deadline.css') }}">
<link rel="stylesheet" href="{{ asset('css/collegeExploration.css') }}">

<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
<style>
  .colleg-add-header {
    background: #1f2937;
    color: #fff;
  }
  .block-content {
    padding: 15px;
  }
  .table-success:hover {
    background-color: #e0edcf;
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
  .w-10 {
    width: 8%;
  }

  .td-width {
    width: 15%
  }

  .delete-option {
    width: 3%;
  }
</style>
@endsection

@php
$stateActiveId = session('costComparisonActiveStateId') ?: $user->state_id;
@endphp

@section('user-content')
@can('Access Cost Comparison Tool')
<main id="main-container">
  <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
    <div class="bg-black-10">
      <div class="content content-full text-center">
        <br>
        <div class="row">
          <div class="col-12">
            <h1 class="h2 text-white mb-0">College Cost Comparison Tool</h1>
            <button type="button" class="btn btn-inform" data-bs-toggle="popover" data-bs-placement="bottom" title="" data-bs-content="This is example content. You can put a description or more info here." data-bs-original-title="Bottom Popover">Instructions</button>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>
  <div class="college-application-wrapper">
    Enter costs for each college <b><u>PER YEAR</u></b>. This is to calculate annual costs, NOT total 4-year costs.
    <div class="block block-rounded">
      <div class="block-header block-header-default block-header-main">
        <h3 class="block-title">DIRECT COLLEGE COMPARISON: COST & AID</h3>
      </div>
      <div class="block-content">
        <div class="tab-content" id="myTabContent">
          <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
            <div class="accordion accordionExample">
              <div class="block block-rounded block-bordered overflow-hidden mb-1">
                <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="true">
                  <a class="text-white fw-600 collapsed">
                    <i class="fa fa-2x fa-angle-down" id="toggle"></i>
                    <i class="fa fa-2x fa-bars"></i>
                    <span>COMPARISON SUMMARY</span>
                  </a>
                </div>
                <div id="collapse" class="collapse show" aria-labelledby="headingOne" data-bs-parent=".accordionExample">
                  <div class="college-content-wrapper college-content">
                    <table class="table table-bordered table-striped table-vcenter" id="costcomparison-summary">
                      <thead>
                        <tr>
                          <th></th>
                          <th>College</th>
                          <th>DIrect Cost</th>
                          <th>Merit AID</th>
                          <th>Need Based Aid</th>
                          <th>OUTSIDE SCHOLARSHIP AID / YEAR</th>
                          <th>COST OF ATTENDANCE / YEAR</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="block block-rounded">
      <div class="block-header block-header-default block-header-main">
        <h3 class="block-title">YOUR COLLEGE LIST'S COSTS & AID</h3>
        <button type="button" class="btn btn-sm btn btn-alt-success" data-bs-toggle="modal" data-bs-target="#add_new_college">+ Add College</button>
        <button type="button" class="btn btn-sm btn-alt-success ms-2" id="view-hide-college-btn">View Hidden Colleges</button>
        <button type="button" class="btn btn-sm btn-alt-danger ms-2" id="reset-all-cost-comparion-data" data-id="${costComparisonData.id}">Reset All</button>
      </div>

      <div class="college-states px-3 my-3">
        <label for="choose_state_options" class="form-label">Choose State:</label>
        <select class="js-example-basic-single js-states form-control" id="choose_state_options" name="choose_state_options" style="width: 100%;" data-placeholder="Select One.">
            <option></option>
            @foreach($states as $st)
                <option value="{!! $st->id !!}" data-statecode="{{ $st->state_code }}"
                    @if($st->id == $stateActiveId) selected @endif>{!! $st->state_name !!}</option>
            @endforeach
        </select>
        <input type="hidden" id="cost_comparison_active_state_id" value="{{ $stateActiveId }}">
        <input type="hidden" id="user_state_code" value="{{ $user->state_code }}">
      </div>

      <div class="block-content">
        <div class="tab-content" id="college-list-cost">
          <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
            <div class="accordion accordionExample1" id="userSelectedCollegeList" data-type="cost-comparison" @if($college) data-collegeid="{{ $college->id }}" @endif></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<div class="modal fade" id="add-college-cost-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add OUTSIDE SCHOLARSHIP AID / YEAR for <span id="modal-college-header"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
        <form id="cost-form">
          @csrf
          <input type="hidden" name="cost_comparison_id" id="cost-id">
          <div class="mb-4">
            <label for="name" class="form-label">Enter Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
          </div>

          <div class="mb-4">
            <label for="amount" class="form-label">Enter Amount</label>
            <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="save-cost" class="btn btn-sm btn-success">Save</button>
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

<div class="modal" id="add_new_college" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="block block-rounded block-transparent mb-0">
        <div class="block-header colleg-add-header">
          <h3 class="block-title">Add College</h3>
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
          <button type="submit" class="btn submit-btn" id="add-college">Add</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endcan

@cannot('Access Cost Comparison Tool')
  @include('components.subscription-warning')
@endcan
@endsection

@can('Access Cost Comparison Tool')
@section('user-script')
<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/pages/be_tables_datatables.min.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>
<script src="{{asset('js/cost-comparison.js')}}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{asset('js/college-list.js')}}"></script>
<script>

var global = {
    userState: $('#user_state_code').val(),
    currentSelectedState: $('select[name=choose_state_options]').find('option:selected').data('statecode'),
    stateChanged: false
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
  $('#costcomparison-summary').DataTable({
    processing: true,
    serverSide: true,
    aaSorting: [],
    searchDelay: 600,
    retrieve: true,
    rowReorder: true,
    bPaginate: false, // hide pagination
    info: false, // hide table information
    searching: false,
    ajax: {
      url: "{{route('admin-dashboard.cost_comparison.get_cost_comparison_summary')}}",
      method: 'GET',
    },
    columns: [
      { "data": "id", "visible": false, "searchable": false, "orderable": false },
      { "data": "college_name", "orderable": false },
      { "data": "total_direct_cost", "orderable": false },
      { "data": "total_merit_cost", "orderable": false },
      { "data": "total_need_based_aid", "orderable": false },
      { "data": "total_outside_scholarship", "orderable": false },
      { "data": "total_cost_attendance", "orderable": false },
    ],
    rowReorder: {
      dataSrc: 'title'
    }
  });

  $(document).ready(function () {
    getCollegeListForCostComparison();
  })

  $('#myTabContent').on('show.bs.collapse', function (e) {
    $('#toggle').removeClass('fa-angle-right').addClass('fa-angle-down');
  })

  $('#myTabContent').on('hidden.bs.collapse', function (e) {
    $('#toggle').removeClass('fa-angle-down').addClass('fa-angle-right');
  })

  $('#college-list-cost').on('show.bs.collapse', function (e) {
    const id = e.target.dataset.index;
    $('#toggle' + id).removeClass('fa-angle-right').addClass('fa-angle-down');
  })

  $('#college-list-cost').on('hidden.bs.collapse', function (e) {
    const id = e.target.dataset.index;
    $('#toggle' + id).removeClass('fa-angle-down').addClass('fa-angle-right');
  })

  $(document).on('click', '.add-cost', function (e) {
    e.preventDefault();
    console.log('e -->', e)
    $('#cost-id').val(e.target.dataset.costcomparisonid)
    $('#modal-college-header').html($('#college-name-' + e.target.dataset.index).html())
    $('#add-college-cost-modal').modal('show')
  })

  $('#cost-aid').on('change', function (e) {
    const costTypes = @json($types);
    const costType = e.target.value;
    $('#cost-aid-type').html('')
    $('#cost-aid-type').append('<option value="">Select Option</option>')
    costTypes.forEach((item, index) => {
      if (item.cost_type == costType) {
        $('#cost-aid-type').append('<option value="' + item.id + '">' + item.name + '</option>')
      }
    })
  })

  $('#edit-cost-aid').on('change', function (e) {
    const costTypes = @json($types);
    const costType = e.target.value;
    $('#edit-cost-aid-type').html('')
    $('#edit-cost-aid-type').append('<option value="">Select Option</option>')
    costTypes.forEach((item, index) => {
      if (item.cost_type == costType) {
        $('#edit-cost-aid-type').append('<option value="' + item.id + '">' + item.name + '</option>')
      }
    })
  })

  $(document).on('click', '#save-cost', function (e) {
    e.preventDefault();
    if ($('#cost-form').valid()) {
      $.ajax({
        url: "{{route('admin-dashboard.cost_comparison.save_cost_comparison_details')}}",
        method: 'PATCH',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $('#cost-form').serialize(),
      }).done(function (response) {
        if (response.success) {
          $('#add-college-cost-modal').modal('hide')
          getCollegeListForCostComparison($('#cost-id').val());
          $('#cost-form')[0].reset()
          $('#costcomparison-summary').DataTable().ajax.reload();
          toastr.success(response.message)
        } else {
          toastr.error(response.message)
        }
      })
    }
  })

  function checkNumber(value) {
    let number = value;
    if (!number) {
      number = '0'
    }
    if (value.includes('.')) {
      const decimal = +(value.split('.')[1]);
      if (decimal === 0) {
        number = value.split('.')[0];
      } else {
        number = (+value).toFixed(2);
      }
    }
    return number;
  }

  function validNumber(e) {
    const charCode = (e.which) ? e.which : e.keyCode;
    console.log(charCode);
    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
      e.preventDefault();
    } else {
      return true;
    }
  }

  $(document).on('keypress', '.edit-value', function (e) {
    const validate = validNumber(e);
    if (!validate) {
      return;
    }
  })

  $(document).on('keypress', '.edit-outside-aid', function (e) {
    const validate = validNumber(e);
    if (!validate) {
      return;
    }
  })

  $(document).on('change', '.edit-value', function (e) {
    if (!e.target.name) return;
    const value = checkNumber(e.target.value);
    if (!value) {
      return;
    }

    e.target.value = value;
    const data = {
      [e.target.name] : e.target.value,
    }
    $.ajax({
      url: "{{ route('admin-dashboard.cost_comparison.edit_college_detail', ['id' => ':id']) }}".replace(':id', e.target.dataset.id),
      method: 'PATCH',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: data,
    }).done((response) => {
      if (response.success) {
        toastr.success(response.message)
        refreshdata(e.target.dataset.index, response)
      } else {
        toastr.error(response.message)
      }
    })
  })

  $(document).on('change', '.edit-outside-aid', function (e) {
    const value = checkNumber(e.target.value);
    if (!value) {
      return;
    }
    e.target.value = value;
    const data = {
      amount: e.target.value,
      id: e.target.dataset.id,
    }
    $.ajax({
      url: "{{route('admin-dashboard.cost_comparison.save_cost_comparison_details')}}",
      method: 'PATCH',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: data,
    }).done(function (response) {
      if (response.success) {
        toastr.success(response.message)
        refreshdata(e.target.dataset.index, response)
      } else {
        toastr.error(response.message)
      }
    })
  })

  $(document).on('click', '.delete-outside-aid', function (e) {
    e.preventDefault();
    const id = e.target.dataset.id;
    const index = e.target.dataset.index;
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to delete this outside scholarship aid?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ route('admin-dashboard.cost_comparison.delete_cost_details', ['id' => ':id']) }}".replace(':id', id),
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {id: id},
        }).done(function (response) {
          if (response.success) {
            toastr.success(response.message)
            e.target.closest('tr').remove();
            refreshdata(index, response)
          } else {
            toastr.error(response.message)
          }
        })
      }
    })
  })

const getFormatMoney = (value) => {
    // return `$${(value || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`;
    // const number = (value || 0).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    const number = (parseFloat(value) || 0).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")

    if (number.includes('.')) {
        const decimal = +(number.split('.')[1]);
        if (decimal === 0) {
            return `$${number.split('.')[0]}`
        } else {
            return `$${number}`
        }
    }

    return `$${number}`
}

function updateField(index, fieldName, data) {
    const value = getFormatMoney(data[fieldName]);
    $(`#${fieldName}-${index}`).html(value);
}

function refreshdata(index, response) {
    $('#costcomparison-summary').DataTable().ajax.reload();

    updateField(index, 'total_direct_cost', response.data);
    updateField(index, 'total_merit_aid', response.data);
    updateField(index, 'total_need_based_aid', response.data);
    updateField(index, 'total_outside_scholarship', response.data);
    updateField(index, 'total_cost_attendance', response.data);
}


  $(document).on('focus', '.edit-value, .edit-outside-aid', function (e) {
    e.target.select();
  })

  $(document).on('mouseup', '.edit-value, .edit-outside-aid', function (e) {
    e.preventDefault();
  })

  $('#view-hide-college-btn').on('click', function (e) {
    getHideCollegeList('hide-college-list-modal')
  })

  $(document).on('click', '.show-college-from-list', async function (e) {
    const response = await hideshowlist(e.target.dataset.id);
    if (response) {
      await getHideCollegeList('hide-college-list-modal')
      $('#costcomparison-summary').DataTable().ajax.reload();
      getCollegeListForCostComparison();
    }
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
          $('#costcomparison-summary').DataTable().ajax.reload();
          getCollegeListForCostComparison();
        }
      }
    })
  })

  $(document).on('click', '#add-college', function (e) {
    $.ajax({
      url: "{{ route('admin-dashboard.collegeApplicationDeadline.college_save') }}",
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {college: $('#select-college').val()},
    }).done(async (response) => {
      if (response.success) {
        window.localStorage.setItem('APP-REFRESHED', Date.now());
        $('#add_new_college').modal('hide')
        $('#costcomparison-summary').DataTable().ajax.reload();
        await getCollegeListForCostComparison();
      } else {
        toastr.error(response.message)
      }
    })
  })

  $(document).on('click', '.reset-cost-comparion-data', function (e) {
    resetCostComparisonData("You want to reset all data for this college? Once you reset, you can't undo this action.", e.target.dataset.id)
  })

  $(document).on('click', '#reset-all-cost-comparion-data', function (e) {
    resetCostComparisonData("You want to reset all data for all colleges? Once you reset, you can't undo this action.", 0, true)
  })

  function resetCostComparisonData(text, id = 0, isAll = false) {
    Swal.fire({
      title: 'Are you sure?',
      text: text,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, reset it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then(async (result) => {
      if (result.isConfirmed) {
        const data = {
          isall: isAll,
        }
        if (!isAll) {
          data.id = id;
        }
        $.ajax({
          url: "{{ route('admin-dashboard.cost_comparison.reset-cost-comparion-data') }}",
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data,
        }).done((response) => {
          if (response.success) {
            toastr.success(response.message)
            $('#costcomparison-summary').DataTable().ajax.reload();
            getCollegeListForCostComparison();
          } else {
            toastr.error(response.message)
          }
        })
      }
    })
  }

</script>

@endsection
@endcan
