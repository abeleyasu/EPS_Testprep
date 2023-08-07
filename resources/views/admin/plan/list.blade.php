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
            To order the plans, please drag and drop "<b>Plan Id</b>" of the plan.
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Plan List</h3>
                <div class="block-options">
                    <a href="{{route('admin.plan.create')}}" class="btn btn-sm btn-alt-success"><i class="fa fa-plus mr-1"></i> Add New Plan</a>
                </div>
            </div>
            <div class="block-content block-content-full">
                <table id="plan" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Plan Id</th>
                            <th>Product</th>
                            <th>Cateogry</th>
                            <th>Interval</th>
                            <th>Interval Count</th>
                            <th>Currency</th>
                            <th>Total Amount</th>
                            <th>Cost per Interval</th>
                            <th>order</th>
                            <th style="width: 10%;">Action</th>
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

        const dataTable = $('#plan').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [],
            searchDelay: 600,
            retrieve: true,
            rowReorder: true,
            bPaginate: false, // hide pagination
            info: false, // hide table information
            ajax: {
                url: "{{route('admin.plan.plan_list')}}",
                method: 'GET',
            },
            columns: [
                { "data": "id", "visible": false, "searchable": false, "orderable": false },
                { "data": "plan_id", "name": "plan_id", "orderable": false },
                { "data": "product", "name": "product", "orderable": false },
                { "data": "category", "name": "category", "orderable": false },
                { "data": "interval", "name": "interval", "orderable": false },
                { "data": "interval_count", "name": "interval_count", "orderable": false },
                { "data": "currency", "name": "currency", "orderable": false },
                { "data": "price", "name": "price", "orderable": false },
                { "data": "amount", "name": "amount", "orderable": false },
                { "data": "order_index", "name": "order_index", "orderable": false },
                { "data": "action", "name": "action", "orderable": false },
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
                    'url': "{{ route('admin.plan.plan_change_order') }}",
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
                if(confirm("Are you sure to delete this plan?") == true){
                    $.ajax({
                        'url': "{{route('admin.plan.plan_delete')}}",
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
