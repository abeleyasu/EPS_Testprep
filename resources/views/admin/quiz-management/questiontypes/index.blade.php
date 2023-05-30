@extends('layouts.admin')

@section('title', 'Admin Dashboard : Question Type')

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
        .custom-table{
            display: block;
            overflow-x: scroll;
            overflow-x: auto;
        }
        .table-vcenter td{
            vertical-align: top;
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
                    Question Type

                </h3>
                <a href="{{ route('add_question_type')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" ></i> New Question Type
                </a>
               

            </div>
            <div class="block-content block-content-full table-view">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden custom-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Test Format</th>
                            <th class="">Description</th>
                             <th >Lesson</th>
                             <th >Strategies</th>
                             <th >Identification Methods</th>
                             <th >Identification Activity</th>
                             <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questionTypes as $singlequestionType)
                        <tr>
                            <td class="fw-semibold fs-sm">{!! $singlequestionType->question_type_title !!}</td>
                            <td>{{ $singlequestionType->format }}</td>
                            <td class="fs-sm">
                                {!! $singlequestionType->question_type_description !!}
                            </td>
                            <td class="fw-semibold fs-sm">{!! $singlequestionType->question_type_lesson !!}</td>
                            <td class="fw-semibold fs-sm">{!! $singlequestionType->question_type_strategies !!}</td>
                            <td class="fw-semibold fs-sm">{!! $singlequestionType->question_type_identification_methods !!}</td>
                            <td class="fw-semibold fs-sm">{!! $singlequestionType->question_type_identification_activity !!}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('edit_question_type',['id'=>$singlequestionType->id])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Question Type">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-content-category"
                                            data-id="{{$singlequestionType->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Question Type"
                                            onclick="deleteItem_fun({{ $singlequestionType->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-item-form-{{$singlequestionType->id}}" action="{{ route('deleteQuestionType',['question_type_id' => $singlequestionType->id]) }}"method="POST" style="display: none;">
                                        
                                        {{ csrf_field() }}
                                    </form>
                                    <div class="btn btn-sm btn-alt-secondary"> <input type="checkbox" class="teble-checkBox questionType mt-1" value="{{ $singlequestionType->id }}" @if ($singlequestionType->selfMade == 1) checked @endif></div>
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

    $(document).on('change','.questionType',function(){
        let type_id = $(this).val();
        if($(this).is(':checked')){
            $.ajax({
                type: 'post',
                url: '{{ route("addSelfMadeQuestionType") }}',
                data:{
                    searchValue: type_id,
                    '_token': $('input[name="_token"]').val()
                },
                success: function(res){
                    
                }
            });
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route("removeSelfMadeQuestionType") }}',
                data:{
                    searchValue: type_id,
                    '_token': $('input[name="_token"]').val()
                },
                success: function(res){
                    
                }
            });
        }
    });  

	function deleteItem_fun(id) {
        console.log(id);
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
