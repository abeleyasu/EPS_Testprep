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
        <h3 class="block-title">Role List</h3>
      </div>
      <div class="block-content block-content-full">
        <table id="worksheet-info" class="table table-bordered table-striped table-vcenter">
          <thead>
            <tr>
              <th style="width: 20%">Name</th>
              <th style="width: 10%;">Action</th>
            </tr>
          </thead>
          <tbody>
            @if(count($roles) > 0)
              @foreach($roles as $role)
                <tr>
                  <td>{{$role->name}}</td>
                  <td>
                    <a href="{{route('admin.roles.permission-list', $role->id)}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Attach Permission">
                      <i class="fa fa-fw fa-file-lines"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            @else
              <tr class="text-center">
                <td colspan="3">No data found</td>
              </tr>
            @endif
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
</script>
@endsection
