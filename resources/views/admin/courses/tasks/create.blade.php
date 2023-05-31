@extends('layouts.admin')

@section('title', 'Admin Dashboard : Tasks')

@section('page-style')
    <style>
        .label-check{
            padding:4px;
        }
    </style>
@endsection
@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form action="{{route('tasks.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="content content-boxed">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Add Task</h3>
                        </div>
                        <div class="block-content block-content-full">

                          
                            <div class="mb-2">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('title') ? 'is-invalid' : ''}}"
                                id="title" name="title" placeholder="Title" value="{{old('title')}}" required>
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="description" class="form-label">Description:</label>


                                <textarea id="js-ckeditor" name="description" class="form-control form-control-lg form-control-alt
                                {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description"
                                        placeholder="Description"
                                        >
                                {{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <div class="holder">
                                    <img id="imgPreview" src="#" alt="pic" width="200" style="display:none;" />
                                </div>
                                    <label for="content" class="form-label">Upload Cover Image</label>
                                    <input type = "file" name="course_cover_image" class="form-label" id="course_cover_image" />
                                    @error('content')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            <div class="col-md-12 col-xl-12 mb-4">
                                <button type="button" class="btn w-25 btn-alt-success"
                                onclick="previewModal()">
                                    <i class="fa fa-fw fa-eye me-1 opacity-50"></i> Preview
                                </button>
                                <button type="submit" class="btn w-25 btn-alt-success">
                                    <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Settings</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="card mb-2">
                                <div class="card-body py-2 my-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1" id="published" name="published">
                                        <label class="form-check-label" for="published"></label>
                                        <label><b>Published</b></label>
                                    </div>
                                </div>
                            </div>
							<div class="mb-2">
                                <label for="type" class="form-label">Parent Section:</label>
                                <select name="section_id" class="form-control" id="section_id">
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}"> {{ $section->title }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
							<div class="mb-2">
                                <label class="form-label" for="order">Order</label>

                                <div class="input-group mb-3">
                                    <input type="number" readonly class="form-control" name="order" value="{{ $tasks+1 }}"
                                        id="order"/>
                                    <button type="button" class="input-group-text" id="basic-addon2" onclick="openOrderDialog()">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>

                            </div>
							<div class="mb-2">
									<label class="form-label" for="status">Task Type</label>

									<select name="task_type" class="form-control">
										<option value="text_video">Text/Video Task</option>
										<option value="quiz">Quiz Task</option>
										<option value="assignment">Assignment Task</option>
									</select>
								</div>
                            <div class="mb-2">
                                <label class="form-label" for="tags">Tags</label>
                                <input type="text" maxlength="30"
                                    id="tag"
                                    placeholder="add tag" class="form-control" onkeypress="addTag(event)"/>

                                <div class="row items-push mt-2 tag-div">
                                    @if($tags && count($tags) > 0)
                                        @foreach($tags as $tag)
                                            <div class="col">
                                                <div class="form-check form-block">
                                                    <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="example-checkbox-block{{$tag->id}}" name="tags[]">
                                                    <label class="form-check-label label-check" for="example-checkbox-block{{$tag->id}}">
                                                        <span class="d-block fs-sm text-muted">{{$tag->name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
							<div class="mb-2">
                                <label class="form-label" for="status">Status</label>

                                <select name="status" class="form-control">
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
<!-- END Main Container -->
<div class="modal fade" id="dragModal"

     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Top level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- List with handle -->
                <div id="listWithHandle" class="list-group">

                    <div class="list-group-item">

                        <span class="glyphicon glyphicon-move" aria-hidden="true">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </span>

                        <button class="btn btn-primary"> Current Section</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveOrder()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
    @include('admin.preview.task')


@endsection
@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/plugins/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>


    <script>
        $(document).ready(()=>{
      $('#course_cover_image').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
            $('#imgPreview').show();
          }
          reader.readAsDataURL(file);
        }
      });
    });
	 var order = 0;
        var myModal = new bootstrap.Modal(document.getElementById('dragModal'), {
            keyboard: false
        });

        One.helpersOnLoad(['js-ckeditor', 'jq-select2']);
        var allowedContent = true;
		CKEDITOR.replace( 'js-ckeditor',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});

		function openOrderDialog() {
            $('#listWithHandle').empty();

            let section_id = $('#section_id').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/sections/${section_id}/tasks`,
                method: 'post',
                success: (res) => {
                    res.data.forEach(i => {

                        $('<div class="list-group-item">\n' +
                            '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                            '<i class="fa-solid fa-grip-vertical"></i>\n' +
                            '</span>\n' +
                            '<button class="btn btn-primary" value="'+i.id+'">'+i.title+'</button>\n' +
                            '</div>').appendTo('#listWithHandle');
                    });

                    myModal.show();
                }
            });
        }

        function saveOrder() {
            /*$('#order').val(order);*/
            myModal.hide();
        }		
        function previewModal() {}
	 // List with handle
        Sortable.create(listWithHandle, {
            handle: '.glyphicon-move',
            animation: 150,
            onEnd: function(evt) {
                let data = {
                    new_index: evt.newIndex+1,
                    old_index: evt.oldIndex+1,
                    item: evt.item.children[1].value,
					currTaskId:0
                };
				
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `/api/tasks/${data.item}/reorder`,
                    method: 'post',
                    data:data,
                    success: (res) => {

                    },
                    error: () => {
                        alert('Something went wrong')
                    }
                });
            }
        },);

    </script>
@endsection
