@extends('layouts.user')

@section('title', 'Cost Comparison : CPS')

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/college-application-deadline.css') }}">
<link rel="stylesheet" href="{{ asset('css/collegeExploration.css') }}">

<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
<style>
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
</style>
@endsection

@section('user-content')
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
      </div>
      <div class="block-content">
        <div class="tab-content" id="college-list-cost">
          <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
            <div class="accordion accordionExample1" id="college-details-cost-comparison">
            </div>
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
        <h5 class="modal-title" id="staticBackdropLabel">Add Cost for Harvard University</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
        <form id="cost-form">
          @csrf
          <input type="hidden" name="cost_comparison_id" id="cost-id">
          <div class="block block-rounded">
            <div class="block-header block-header-default block-header-main">
              <h3 class="block-title">DIRECT COST/YEAR</h3>
            </div>
            <div class="block-content">
              <div class="mb-4">
                <label for="direct_tuition_free_year" class="from-label">Tuition & Fees / Year:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="direct_tuition_free_year" name="direct_tuition_free_year" placeholder="Tuition & Fees / Year">
              </div>
              <div class="mb-4">
                <label for="direct_room_board_year" class="from-label">Room & Board / Year:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="direct_room_board_year" name="direct_room_board_year" placeholder="Room & Board / Year">
              </div>
            </div>
          </div>
          <div class="block block-rounded">
            <div class="block-header block-header-default block-header-main">
              <h3 class="block-title">INSTITUTIONAL SCHOLARSHIP AID / YEAR</h3>
            </div>
            <div class="block-content">
              <div class="mb-4">
                <label for="institutional_academic_merit_aid" class="from-label">Academic Merit Aid:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_academic_merit_aid" name="institutional_academic_merit_aid" placeholder="Academic Merit Aid">
              </div>
              <div class="mb-4">
                <label for="institutional_exchange_program_scho" class="from-label">Tuition Exchange Program Scholarship (i.e. WUE/Midwest Exchange):</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_exchange_program_scho" name="institutional_exchange_program_scho" placeholder="Tuition Exchange Program Scholarship (i.e. WUE/Midwest Exchange)">
              </div>
              <div class="mb-4">
                <label for="institutional_honors_col_program" class="from-label">Honors College Program Scholarship:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_honors_col_program" name="institutional_honors_col_program" placeholder="Honors College Program Scholarship">
              </div>
              <div class="mb-4">
                <label for="institutional_academic_department_scho" class="from-label">Academic Departmental Scholarship:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_academic_department_scho" name="institutional_academic_department_scho" placeholder="Academic Departmental Scholarship">
              </div>
              <div class="mb-4">
                <label for="institutional_atheletic_scho" class="from-label">Athletic Scholarship:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_atheletic_scho" name="institutional_atheletic_scho" placeholder="Athletic Scholarship">
              </div>
              <div class="mb-4">
                <label for="institutional_other_talent_scho" class="from-label">Other Talent Scholarship:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_other_talent_scho" name="institutional_other_talent_scho" placeholder="Other Talent Scholarship">
              </div>
              <div class="mb-4">
                <label for="institutional_diversity_scho" class="from-label">Diversity Scholarship:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_diversity_scho" name="institutional_diversity_scho" placeholder="Diversity Scholarship">
              </div>
              <div class="mb-4">
                <label for="institutional_legacy_scho" class="from-label">Legacy Scholarship:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_legacy_scho" name="institutional_legacy_scho" placeholder="Legacy Scholarship">
              </div>
              <div class="mb-4">
                <label for="institutional_other_scho" class="from-label">Other Scholarships (Volunteer, Leadership, etc.):</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="institutional_other_scho" name="institutional_other_scho" placeholder="Other Scholarships (Volunteer, Leadership, etc.)">
              </div>
            </div>
          </div>  
          <div class="block block-rounded">
            <div class="block-header block-header-default block-header-main">
              <h3 class="block-title">NEED-BASED AID / YEAR (FEDERAL, STATE, & INSTITUTIONAL)</h3>
            </div>
            <div class="block-content">
              <div class="mb-4">
                <label for="need_base_federal_grants" class="from-label">Federal Grants (i.e. Pell Grant, Military, etc.):</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="need_base_federal_grants" name="need_base_federal_grants" placeholder="Federal Grants (i.e. Pell Grant, Military, etc.)">
              </div>
              <div class="mb-4">
                <label for="need_base_institutional_grants" class="from-label">Institutional Grants:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="need_base_institutional_grants" name="need_base_institutional_grants" placeholder="Institutional Grants">
              </div>
              <div class="mb-4">
                <label for="need_base_state_grants" class="from-label">State Grants:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="need_base_state_grants" name="need_base_state_grants" placeholder="State Grants">
              </div>
              <div class="mb-4">
                <label for="need_base_work_study_grants" class="from-label">Work Study:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="need_base_work_study_grants" name="need_base_work_study_grants" placeholder="Work Study">
              </div>
              <div class="mb-4">
                <label for="need_base_student_loans_grants" class="from-label">Student Loans:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="need_base_student_loans_grants" name="need_base_student_loans_grants" placeholder="Student Loans">
              </div>
              <div class="mb-4">
                <label for="need_base_parent_plus_grants" class="from-label">Parent Plus Loan:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="need_base_parent_plus_grants" name="need_base_parent_plus_grants" placeholder="Parent Plus Loan">
              </div>
              <div class="mb-4">
                <label for="need_base_other_grants" class="from-label">Other Grants:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="need_base_other_grants" name="need_base_other_grants" placeholder="Other Grants">
              </div>
            </div>
          </div>
          <div class="block block-rounded">
            <div class="block-header block-header-default block-header-main">
              <h3 class="block-title">OUTSIDE SCHOLARSHIP AID / YEAR</h3>
              <button class="btn btn-sm btn-alt-success add-outside-scholarship">+</button>
            </div>
            <div class="block-content" id="outside-scholarship">
            </div>
          </div>
          <!-- <div class="block block-rounded">
            <div class="block-header block-header-default block-header-main">
              <h3 class="block-title">COST OF ATTENDANCE / YEAR</h3>
            </div>
            <div class="block-content">
              <div class="mb-4">
                <label for="cost_of_attendance_year" class="from-label">Estimated Total Cost of Attendence / Year:</label>
                <input type="text" class="form-control form-control-lg form-control-alt" id="cost_of_attendance_year" name="cost_of_attendance_year" placeholder="Estimated Total Cost of Attendence / Year">
              </div>
            </div>
          </div>   -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="save-cost" class="btn btn-sm btn-success">Save cost</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('user-script')
<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/pages/be_tables_datatables.min.js')}}"></script>
<script src="{{asset('js/cost-comparison.js')}}"></script>
<script>
  const url = "{{route('admin-dashboard.cost_comparison.get_college_list_for_cost_comparison')}}"
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
    getCollegeListForCostComparison(url);
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
    getSingleCostDetails("{{ route('admin-dashboard.cost_comparison.get_single_cost_details', ['id' => ':id']) }}".replace(':id', e.target.dataset.costcomparisonid))
    // $('#add-college-cost-modal').modal('show')
  })
  
  $('.add-outside-scholarship').on('click', function (e) {
    e.preventDefault();
    const index = $('#outside-scholarship')[0].children.length
    const element = `
      <div class="row mb-3">
          <div class="col-sm-12 col-lg-6">
          <label for="" class="from-label">Scholarship Name:</label>
          <input type="text" class="form-control form-control-lg form-control-alt" id="" name="scholarship[${index}][name]" placeholder="Scholarship Name">
        </div>
        <div class="col-11 col-sm-11 col-lg-5">
          <label for="" class="from-label">Scholarship Amount:</label>
          <input type="text" class="form-control form-control-lg form-control-alt" id="" name="scholarship[${index}][amount]" placeholder="Scholarship Amount">
        </div>
        <div class="col-1 col-sm-1 col-lg-1 d-flex align-items-end">
          <button class="btn btn-alt-danger remove-outside-scholarship">-</button>
        </div>
      </div>
    `
    $('#outside-scholarship').append(element)
  })

  $(document).on('click', '.remove-outside-scholarship', function (e) {
    e.preventDefault();
    $(this).parent().parent().remove()
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
          $('#cost-form')[0].reset()
          $('#outside-scholarship').html('')
          getCollegeListForCostComparison(url);
          $('#costcomparison-summary').DataTable().ajax.reload();
        } else {
        }
        console.log(response)
      })
    }
  })
</script>

@endsection