@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
  <!-- Stylesheets -->
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
  <style>
    .table {
      width: 100% !important;
    }
  </style>
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

    @if(session('error'))
      <div class="alert alert-error">
        {{ session('error') }}
      </div>
    @endif
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">User Survey List</h3>
      </div>
      <div class="block-content block-content-full">
        <table id="survey-list" class="table table-bordered table-striped table-vcenter table-responsive">
          <thead>
            <tr>
              <th>id</th>
              <th>User name</th>
              <th>Survey Type</th>
              <th>High School Year</th>
              <th>Reference</th>
              <th>Specific Path</th>
              <th>Submitted Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<!-- END Main Container -->
@endsection

@section('admin-script')
<script>
  const dataTable = $('#survey-list').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 600,
    scrollX: true,
    ajax: {
      url: "{{route('admin.survey.index')}}",
      method: 'GET',
    },
    columns: [
        {data: 'id', name: 'id', orderable: false, visible:false},
        {data: 'user_name', name: 'user_name', orderable: false},
        {data: 'survey_type', name: 'survey_type', orderable: false},
        {data: 'high_school_year', name: 'high_school_year', orderable: false},
        {data: 'reference_path', name: 'reference_path', orderable: false},
        {data: 'specific_path', name: 'specific_path', orderable: false},
        {data: 'created_at', name: 'created_at', orderable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
  });

</script>
@endsection
