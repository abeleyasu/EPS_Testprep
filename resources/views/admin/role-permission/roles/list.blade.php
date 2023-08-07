@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
  <!-- Stylesheets -->
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
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
              <th style="width: 70%">Name</th>
              <th style="width: 10%">Is Visible</th>
              <th style="width: 10%;">Action</th>
            </tr>
          </thead>
          <tbody>
            @if(count($roles) > 0)
              @foreach($roles as $role_key => $role)
                <tr>
                  <td>{{$role->name}}</td>
                  <td>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="role-{{$role_key}}" name="role-{{$role_key}}" data-id="{{ $role->id }}" @if($role->is_visible) checked @endif>
                    </div>
                  </td>
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
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
  $('input[type="checkbox"]').on('change', function (e) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to change status of this role",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, change it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ route('admin.roles.change-role-status', ['id' => ':id']) }}".replace(':id', e.target.dataset.id),
          type: 'PATCH',
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
        }).done(function (response) {
          if (response.success) {
            Swal.fire(
              'Changed!',
              response.message,
              'success'
            )
          } else {
            Swal.fire(
              'Error!',
              response.message,
              'error'
            )
          }
        })
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        $(this).prop('checked', !$(this).prop('checked'));
      }
    })
  })
</script>
@endsection
