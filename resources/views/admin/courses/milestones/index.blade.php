@extends('layouts.admin')

@section('title', 'Admin Dashboard : Milestones')

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
                    Milestones
                    <span class="btn-group" style="margin-left: 40%">
                        <button class="btn grid-btn"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Grid View">
                            <i class="fa-solid fa-table"></i>
                        </button>
                        <button class="btn table-btn"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Table View">
                            <i class="fa-solid fa-table-cells"></i>
                        </button>
                    </span>
                </h3>
                <a href="{{ route('milestones.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" ></i> New Milestone
                </a>
            </div>
            <div class="block-content block-content-full table-view">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="">Description</th>
                             <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($milestones as $milestone)
                        <tr>
                            <td class="fw-semibold fs-sm">{{$milestone->name}}</td>
                            <td class="fs-sm">
                                {!! $milestone->description !!}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('milestones.preview', ['milestone' => $milestone->id])}}" target="_blank" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Preview Milestone">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
									<a href="{{route('milestones.edit', ['milestone' => $milestone->id])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Milestone">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-milestone"
                                            data-id="{{$milestone->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Milestone"
                                            onclick="deleteItem({{ $milestone->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-form-{{$milestone->id}}" action="{{ route('milestones.destroy',$milestone->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <div class="row grid-view px-2">

                @foreach($milestones as $milestone)
                    <div class=" col-md-3 my-2 col-sm-6">
                        <div class="card">
                            <div class="card-body bg-default">
                                <div class="opacity-0" style="min-height: 200px" onmouseover="addOpacity(this)" onmouseout="removeOpacity(this)">

                                    <div class="btn-group float-end">
										<a href="{{route('milestones.preview', ['milestone' => $milestone->id])}}" target="_blank" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Preview Milestone">
											<i class="fa fa-fw fa-eye"></i>
										</a>
                                        <a href="{{route('milestones.edit', ['milestone' => $milestone->id])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Milestone">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-alt-secondary delete-milestone"
                                                data-id="{{$milestone->id}}"
                                                data-bs-toggle="tooltip"
                                                title="Delete Milestone"
                                                onclick="deleteItem_fun({{$milestone->id}})"
                                        >
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                        <form id="delete-item-form-{{$milestone->id}}" action="{{ route('milestones.destroy',$milestone->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                        </form>
                                    </div>

                                </div>
								<div class="fs-sm text-white-75 displaymilecnt">
									 {{ $milestone->modules->count() }} Modules
								</div>
                            </div>
                            <h5>
                                {{ $milestone->name }}
                            </h5>
                            <span class="text-end"> {{ $milestone->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
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
			text: "But you will still be able to retrieve this.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, archive it!",
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
	};
        var gridDiv = $('.grid-view');
        var tableDiv = $('.table-view');
        var gridBtn = $('.grid-btn');
        var tableBtn = $('.table-btn');

        $(document).ready(() => {
            tableDiv.hide();
            gridDiv.show();
            tableBtn.addClass("btn-outline-primary");
            gridBtn.addClass("btn-primary");
            tableBtn.click(function () {
                tableDiv.show();
                gridDiv.hide();
                tableBtn.removeClass("btn-outline-primary");
                tableBtn.addClass("btn-primary");
                gridBtn.removeClass("btn-primary");
                gridBtn.addClass("btn-outline-primary");
            })
            gridBtn.click(function () {
                tableDiv.hide();
                gridDiv.show();
                tableBtn.removeClass("btn-primary");
                tableBtn.addClass("btn-outline-primary");
                gridBtn.removeClass("btn-outline-primary");
                gridBtn.addClass("btn-primary");
            })
        })

        function removeOpacity(evt) {
            $(evt).removeClass('opacity-100')
        }
        function addOpacity(evt) {
            $(evt).addClass('opacity-100')
        }

    </script>
@endsection
