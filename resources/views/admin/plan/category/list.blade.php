@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
@endsection

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="alert alert-warning">
            To order the categories please drag and drop "<b>Name</b>" of the category.
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Category List</h3>
                <div class="block-options">
                    <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-alt-success"><i class="fa fa-plus mr-1"></i> Add New Category</a>
                </div>
            </div>
            <div class="block-content block-content-full">
                <table id="product-category" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th style="width: 60%;">Plan key</th>
                            <th>Order</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
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
    <script src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.min.js"></script>
    <script>

        const dataTable = $('#product-category').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [],
            searchDelay: 600,
            retrieve: true,
            rowReorder: true,
            ajax: {
                url: "{{route('admin.category.category_list')}}",
                method: 'GET',
            },
            columns: [
                { "data": "id", "visible": false, "searchable": false, "orderable": false },
                { "data": "title", "orderable": false },
                { "data": "description", "orderable": false },
                { "data": "order_index", "orderable": false },
                { "data": "action", "orderable": false },
            ],
            rowReorder: {
                dataSrc: 'title'
            }
        });

        dataTable.on('row-reorder', function (e, details) {
            if (details.length > 0) {
                const rows = details.map((data) => {
                    return {
                        id: dataTable.row(data.node).data().id,
                        order_index: data.newPosition,
                    }
                })
                $.ajax({
                    'url': "{{ route('admin.category.category_change_order') }}",
                    'type': "POST",
                    'data': {
                        data: rows,
                    },
                    'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                }).
                done(function (data) {
                    dataTable.ajax.reload();
                })
            }
        })

        dataTable.on('draw.dt', function () {
            $('.delete-user').click(function(){
                if(confirm("Are you sure to delete this category?") == true){
                    $.ajax({
                        'url': "{{route('admin.category.category_delete')}}",
                        'type': "POST",
                        'data': {id: $(this).data('id')},
                        'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    }).done(function(data){
                        dataTable.ajax.reload();
                    });
                }
            });
        });

        
    </script>

@endsection
