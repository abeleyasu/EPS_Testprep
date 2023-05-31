@extends('layouts.admin')

@section('title', 'Admin Dashboard : Difficulty Ratings')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/admin.css')}}">
    <style>
        .teble-checkBox{
            width: 17px;
            height: 17px;
            accent-color: #1f2937;
        }
        
    </style>


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
                    Question Tag
                </h3>
                <a href="{{ route('questiontags.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" ></i> New Tag
                </a>
            </div>
            <div class="block-content block-content-full table-view">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Format</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag['title'] }}</td>
                            <td>{{ $tag['format'] }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('questiontags.edit',['questiontag' => $tag['id']])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Question Tag">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-content-category"
                                            data-id="{{$tag['id']}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Question Tag"
                                            onclick="deleteItem_fun({{ $tag['id'] }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-item-form-{{$tag['id']}}" action="{{ route('questiontags.destroy',['questiontag' => $tag['id']]) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                    </form>
                                    <div class="btn btn-sm btn-alt-secondary"> <input type="checkbox" class="teble-checkBox questionTag mt-1" value="{{ $tag['id'] }}" @if ($tag['selfMade'] == 1) checked @endif></div>
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

    $(document).on('change','.questionTag',function(){
        let question_tag_id = $(this).val();
        if($(this).is(':checked')){
            $.ajax({
                type: 'post',
                url: '{{ route("addSelfMadeQuestionTag") }}',
                data:{
                    searchValue: question_tag_id,
                    '_token': $('input[name="_token"]').val()
                },
                success: function(res){
                    
                }
            });
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route("removeSelfMadeQuestionTag") }}',
                data:{
                    searchValue: question_tag_id,
                    '_token': $('input[name="_token"]').val()
                },
                success: function(res){
                    
                }
            });
        }
    });  

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