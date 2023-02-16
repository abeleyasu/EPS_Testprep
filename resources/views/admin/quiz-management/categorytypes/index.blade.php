@extends('layouts.admin')

@section('title', 'Admin Dashboard : Category Type')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/admin.css')}}">


@endsection

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Category Type

                </h3>
                <a href="{{ route('add_category_type')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" ></i> New Category Type
                </a>
               

            </div>
            <div class="block-content block-content-full table-view">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th class="">Description</th>
                             <th >Lesson</th>
                             <th >Strategies</th>
                             <th >Identification Methods</th>
                             <th >Identification Activity</th>
                             <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoryTypes as $singlecategoryType)
                        <tr>
                            <td class="fw-semibold fs-sm">{{$singlecategoryType->category_type_title}}</td>
                            <td class="fs-sm">
                                {!! $singlecategoryType->category_type_description !!}
                            </td>
                            <td class="fw-semibold fs-sm">{{$singlecategoryType->category_type_lesson}}</td>
                            <td class="fw-semibold fs-sm">{{$singlecategoryType->category_type_strategies}}</td>
                            <td class="fw-semibold fs-sm">{{$singlecategoryType->category_type_identification_methods}}</td>
                            <td class="fw-semibold fs-sm">{{$singlecategoryType->category_type_identification_activity}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('edit_category_type',['id'=>$singlecategoryType->id])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Category Type">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-content-category"
                                            data-id="{{$singlecategoryType->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Category Type"
                                            onclick="deleteItem_fun({{ $singlecategoryType->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-item-form-{{$singlecategoryType->id}}" action="{{ route('deleteCategoryType',['category_type_id' => $singlecategoryType->id]) }}"method="POST" style="display: none;">
                                        
                                        {{ csrf_field() }}
                                    </form>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
	function deleteItem_fun(id) {
		// var id = $(this).data("id");
		var form =  $('#delete-item-form-'+id);
		event.preventDefault();
		swal({
			title: "Are you sure?",
			//text: "But you will still be able to retrieve this.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if (isConfirm) {
				form.submit();
			} else {
				swal("Cancelled", "", "error");
			}
		});
	}


    </script>
@endsection