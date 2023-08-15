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

    @if(session('error'))
      <div class="alert alert-error">
        {{ session('error') }}
      </div>
    @endif
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">User Subscription List</h3>
      </div>
      <div class="block-content block-content-full">
        <table id="subscription-list" class="table table-bordered table-striped table-vcenter table-responsive">
          <thead>
            <tr>
              <th>id</th>
              <th>Subscription Product</th>
              <th>Subscription Id</th>
              <th>User Name</th>
              <th>Amout</th>
              <th>Interval</th>
              <th>Plan Type</th>
              <th>Status</th>
              <th>End Date</th>
              <th>Created Date</th>
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
  const dataTable = $('#subscription-list').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 600,
    // responsive: true,
    ajax: {
      url: "{{route('admin.subscription.index')}}",
      method: 'GET',
    },
    columns: [
      { "data": "id", "visible": false, "searchable": false, "orderable": false },
      { "data": "subscription_product", "name": "subscription_product", "orderable": false },
      { "data": "subscription_id", "name": "subscription_id", "orderable": false },
      { "data": "user_name", "name": "user_name", "orderable": false },
      { "data": "amount", "name": "amount", "orderable": false },
      { "data": "interval", "name": "interval", "orderable": false },
      { "data": "plan_type", "name": "plan_type", "orderable": false },
      { "data": "status", "name": "status", "orderable": false },
      { "data": "end_date", "name": "end_date", "orderable": false },
      { "data": "created_at", "name": "created_at", "orderable": false },
      { "data": "action", "name": "action", "orderable": false },
    ],
  });

</script>
@endsection
