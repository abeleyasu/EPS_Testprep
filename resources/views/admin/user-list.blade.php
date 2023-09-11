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
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Standard User List</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="" style="width: 30%;">Email</th>
                            <th class="" style="width: 15%;">Phone</th>
                            <th style="width: 12%;">Active/Deactive</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="fw-semibold fs-sm">{{$user->name}}</td>
                            <td class="fs-sm">
                                {{$user->email}}
                            </td>
                            <td class="">
                                {{$user->phone}}
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" data-id="{{ $user->id }}" @if($user->is_active) checked @endif>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin-user-info', ['id' => $user->id]) }}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View User">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                    <a href="{{route('admin-edit-user', ['id' => $user->id])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit User">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-alt-secondary delete-user" data-id="{{$user->id}}" data-bs-toggle="tooltip" title="Delete User">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@endsection

@section('admin-script')


    <script>

        $('input[type="checkbox"]').change(function(e){
            const url = core.updateUserStatus.replace(':id', $(this).data('id'));
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change this user status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const response = await updateUserStatus(url);
                    if (response.success) {
                        Swal.fire('Changed!', response.message, 'success')
                    } else {
                        Swal.fire('Error!', response.message, 'error')
                        $(this).prop('checked', !$(this).prop('checked'));
                    }
                } else {
                    $(this).prop('checked', !$(this).prop('checked'));
                }
            })
        });

        $('.delete-user').click(function(){
            if(confirm("Are you sure to delete this user?") == true){
                $.ajax({
                    'url': "{{route('admin-delete-user')}}",
                    'type': "POST",
                    'data': {id: $(this).data('id')},
                    'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                }).done(function(data){
                    document.location.reload();
                });
            }
        });
    </script>
@endsection
