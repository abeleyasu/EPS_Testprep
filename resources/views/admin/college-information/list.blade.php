@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
  <!-- Stylesheets -->
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
@endsection

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
  <div class="content">
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">College Information List</h3>
      </div>
      <div class="block-content block-content-full">
        <div class="row">
          <form class="row" action=" {{ route('admin.admission-management.college-information.import_csv')}}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3 col-sm-12 col-md-6">
                <label for="csv_file" class="form-label">Import Peterson Data Using CSV:</label>
                <input required type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv">
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-end">
              <button type="submit" class="btn btn-primary">Import CSV</button>
            </div>
          </form>
        </div>
        <div class="row">
          {{-- <form class="row" action=" {{ route('admin.admission-management.college-information.import_ug_expense_asgns')}}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3 col-sm-12 col-md-6">
                <label for="csv_file" class="form-label">Import UG Expense Data Using CSV:</label>
                <input required type="file" class="form-control" id="ug_expense_asgns" name="ug_expense_asgns" accept=".csv">
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-end">
              <button type="submit" class="btn btn-primary">Import CSV</button>
            </div>
          </form>
          <form class="row" action=" {{ route('admin.admission-management.college-information.import_ug_admis')}}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3 col-sm-12 col-md-6">
                <label for="csv_file" class="form-label">Import UG Admis Data Using CSV:</label>
                <input required type="file" class="form-control" id="ug_admis" name="ug_admis" accept=".csv">
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-end">
              <button type="submit" class="btn btn-primary">Import UG Admission</button>
            </div>
          </form>
          <form class="row" action=" {{ route('admin.admission-management.college-information.import_ux_inst')}}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3 col-sm-12 col-md-6">
                <label for="csv_file" class="form-label">Import UX INST data using CSV:</label>
                <input required type="file" class="form-control" id="ux_inst" name="ux_inst" accept=".csv">
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-end">
              <button type="submit" class="btn btn-primary">Import UG Admission</button>
            </div>
          </form>
          <form class="row" action=" {{ route('admin.admission-management.college-information.import_ug_campus')}}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3 col-sm-12 col-md-6">
                <label for="csv_file" class="form-label">Import UG Campus Data Using CSV:</label>
                <input required type="file" class="form-control" id="ug_campus" name="ug_campus" accept=".csv">
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-end">
              <button type="submit" class="btn btn-primary">Import UG Campus</button>
            </div>
          </form>
          <form class="row" action=" {{ route('admin.admission-management.college-information.import_ux_inst')}}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3 col-sm-12 col-md-6">
                <label for="csv_file" class="form-label">Import UX Inst Data Using CSV:</label>
                <input required type="file" class="form-control" id="ux_inst" name="ux_inst" accept=".csv">
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-end">
              <button type="submit" class="btn btn-primary">Import UX INST</button>
            </div>
          </form>
          <form class="row" action=" {{ route('admin.admission-management.college-information.import_ug_enroll')}}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-3 col-sm-12 col-md-6">
                <label for="csv_file" class="form-label">Import UG Enroll Data Using CSV:</label>
                <input required type="file" class="form-control" id="ux_inst" name="ug_enroll" accept=".csv">
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-end">
              <button type="submit" class="btn btn-primary">Import UG Enroll</button>
            </div> --}}
          </form>
        </div>
        <table id="college-information" class="table table-bordered table-striped table-vcenter">
          <thead>
            <tr>
              <th></th>
              <th style="width: 50%;">Name</th>
              <th>City</th>
              <th>State</th>
              <th style="width: 10%;">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</main>
<!-- END Main Container -->
@endsection

@section('admin-script')
<script>
  // admin.admission-management.college-information.index
  $('#college-information').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 600,
    ajax: "{{ route('admin.admission-management.college-information.index') }}",
    columns: [
      {data: 'id', visible: false, searchable:false },
      {data: 'name', name: 'name', orderable: false,},
      {data: 'city', name: 'city', orderable: false,},
      {data: 'state', name: 'state', orderable: false,},
      {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
  })
</script>
@endsection
