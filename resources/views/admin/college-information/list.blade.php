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
