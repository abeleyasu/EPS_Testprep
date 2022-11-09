@extends('layouts.admin')

@section('title', 'Admin Dashboard : Tags')

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
                    Tags
                </h3>

                <button type="button" class="btn btn-alt-primary push"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-block-large">
                    <i class="fa fa-plus" ></i> New Tag
                </button>
            </div>
            <div class="block-content block-content-full table-view">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden">
                    <thead>
                        <tr>
                            <th>Name</th>
                             <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                        <tr>
                            <td class="fw-semibold fs-sm">{{$tag->name}}</td>

                            <td>
                                <div class="btn-group">
{{--                                    <button type="button"--}}
{{--                                       class="btn btn-sm btn-alt-secondary"--}}
{{--                                       data-bs-toggle="tooltip"--}}
{{--                                       title="Edit Tag">--}}
{{--                                        <i class="fa fa-fw fa-pencil-alt"></i>--}}
{{--                                    </button>--}}
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-tag"
                                            data-id="{{$tag->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Tag"
                                            onclick="deleteItem_fun({{ $tag->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-item-form-{{$tag->id}}" action="{{ route('tags.destroy',$tag->id) }}" method="POST" style="display: none;">
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

        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Large Block Modal -->
<div class="modal" id="modal-block-large" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Tag</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('tags.store') }}" method="post" class="form-row">
                    @csrf
                <div class="block-content fs-sm">

                    <div class="col-6 m-4">
                    <label for="name" class="form-label"> Tag name</label>
                    <input type="text" maxlength="30"
                           id="tag"
                           name="tag"
                           placeholder="add tag"
                           class="form-control"
                    />
                    </div>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Large Block Modal -->

<!-- Large Block Modal -->
<div class="modal" id="modal-block-large-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Tag</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('tags.store') }}" method="post" class="form-row">
                    @csrf
                <div class="block-content fs-sm">

                    <div class="col-6 m-4">
                    <label for="name" class="form-label"> Tag name</label>
                    <input type="text" maxlength="30"
                           id="tag"
                           name="tag"
                           placeholder="add tag"
                           class="form-control"
                    />
                    </div>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Large Block Modal -->
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
	}


    </script>
@endsection
