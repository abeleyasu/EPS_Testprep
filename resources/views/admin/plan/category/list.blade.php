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
                <h3 class="block-title">Category List</h3>
                <div class="block-options">
                    <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-alt-success"><i class="fa fa-plus mr-1"></i> Add New Category</a>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="" style="width: 60%;">Plan key</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="fw-semibold fs-sm">{{ $category->title }}</td>
                            <td class="fs-sm">
                                {{ $category->description }}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('admin.category.edit', ['id' => $category->id])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Category">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-alt-secondary delete-user" data-id="{{$category->id}}" data-bs-toggle="tooltip" title="Delete Category">
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
        $('.delete-user').click(function(){
            if(confirm("Are you sure to delete this category?") == true){
                $.ajax({
                    'url': "{{route('admin.category.category_delete')}}",
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
