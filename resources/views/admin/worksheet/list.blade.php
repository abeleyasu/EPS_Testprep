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
        <h3 class="block-title">Worksheet List</h3>
        <div class="block-options">
            <a href="{{route('admin.worksheet-management.create')}}" class="btn btn-sm btn-alt-success"><i class="fa fa-plus mr-1"></i> Add Workshhet</a>
        </div>
      </div>
      <div class="block-content block-content-full">
        <table id="worksheet-info" class="table table-bordered table-striped table-vcenter">
          <thead>
            <tr>
              <th style="width: 20%">Name</th>
              <th style="width: 50%">Description</th>
              <th style="width: 10%;">Action</th>
            </tr>
          </thead>
          <tbody>
            @if(count($worksheet_data) > 0)
              @foreach($worksheet_data as $worksheet)
                <tr>
                  <td>{{$worksheet->name}}</td>
                  <td>{{$worksheet->description}}</td>
                  <td>
                    <a href="{{route('admin.worksheet-management.edit', $worksheet->id)}}" class="btn btn-sm btn-alt-primary"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="{{route('admin.worksheet-management.delete', $worksheet->id)}}" class="btn btn-sm btn-alt-danger delete-worksheet"><i class="fa fa-fw fa-trash"></i></a>
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
  $(document).ready(function () {
    $('.delete-worksheet').click(function (e) {
      e.preventDefault();
      if (confirm('Are you sure you want to delete this worksheet?')) {
        $.ajax({
          url: $(this).attr('href'),
          type: 'DELETE',
          data: {
            _token: '{{csrf_token()}}'
          },
          success: function (response) {
            window.location.reload();
          }
        })
      }
    });
  })
</script>
@endsection
