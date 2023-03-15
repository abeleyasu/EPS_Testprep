@extends('layouts.admin')

@section('title', 'Admin Dashboard : Edit Section')

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form action="{{route('sections.update',$section->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="content content-boxed">
            <!-- Dynamic Table Full -->
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit section</h3>
                            <a target="_blank" class="btn w-25 btn-alt-success" href="{{ route('sections.preview',['section' => $section->id]) }}">
                                <i class="fa fa-fw fa-eye me-1 opacity-50"></i> Preview
                            </a>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="mb-2">
                                <label for="name" class="form-label">Title:</label>
                                <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('title') ? 'is-invalid' : ''}}"
                                    id="title" name="title" placeholder="Title" value="{{$section->title}}" required>
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
                                    {!! $section->description !!}
                                </textarea>
                                @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <div class="holder">
                                @if($section->coverimage)
                                <img id="imgPreview" src="{{ asset('public/Image/'.$section->coverimage) }}" alt="pic" width="200" />   
                                @else
                                <img id="imgPreview" src="#" alt="pic" width="200" style="display:none;" />
                                @endif
                                </div>
                                    <label for="content" class="form-label">Upload Cover Image</label>
                                    <input type = "file" name="course_cover_image" class="form-label" id="course_cover_image" />
                                    @error('content')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            @if($section->tasks)
                                <h3>SECTION TASKS</h3>
                                <div class="card mb-2">
                                @foreach($section->tasks as $task)

                                <div class="mx-6 my-2 section-detail{{$section->id}}"><i class="fa-solid fa-list"></i><a href="/admin/course-management/tasks/{{$task->id}}/edit" target="__blank">  {!! $task->title !!}</a>

                                    <span class="text-center badge bg-danger ml-4">tasks</span>
                                </div>

                                @endforeach
                                    <button type="button" class="btn w-100 btn-alt-light text-center"
                                            data-bs-toggle="modal" data-bs-target="#modal-block-large">
                                        <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Task
                                    </button>
                                </div>
                            @endif

                            <div class="col-md-6 col-xl-5 mb-4">
                                <button type="submit" class="btn w-100 btn-alt-success">
                                    Update section
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
                            <div class="card-body py-2 my-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" id="published" name="published"
                                        @if($section->published) checked @endif>
                                    <label class="form-check-label" for="published"></label>
                                    <label><b>Published</b></label>
                                </div>
                            </div>
                                <div class="mb-2">
                                    <label for="type" class="form-label">Parent Module:</label>
                                    <select name="module_id" class="form-control" id="module_id">
                                        @foreach($modules as $module)
                                            <option value="{{$module->id}}"
                                                    @if($module->id == $section->module_id) selected @endif
                                            > {{ $module->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('module_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                

                                <div class="mb-2">
                                    <label class="form-label" for="order">Order</label>

                                    <div class="input-group mb-3">
                                        <input type="number" readonly class="form-control" value="{{ $section->order }}"
                                            id="order"/>
                                        <button type="button" class="input-group-text" id="basic-addon2" onclick="openOrderDialog()">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </div>

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
                                                        <input class="form-check-input"
                                                            type="checkbox" value="{{$tag->id}}"
                                                            name="tags[]"
                                                            id="example-checkbox-block{{$tag->id}}"
                                                        @if(in_array($tag->id,$section_tags)) checked @endif>
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
                                        <option value="paid" @if($section->status == 'paid') selected @endif>Paid</option>
                                        <option value="unpaid" @if($section->status == 'unpaid') selected @endif>Unpaid</option>
                                    </select>
                                </div>
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
{{--                    @foreach($sections as $section)--}}
{{--                        <div class="list-group-item">--}}

{{--                        <span class="glyphicon glyphicon-move" aria-hidden="true">--}}
{{--                            <i class="fa-solid fa-grip-vertical"></i>--}}
{{--                        </span>--}}

{{--                            <button class="btn btn-primary"> {{ $section }}</button>--}}
{{--                        </div>--}}

{{--                    @endforeach--}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveOrder()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- END Main Container -->


<!-- Large Block Modal -->
<div class="modal" id="modal-block-large" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Task</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="block-content block-content-full">
                    <form action="{{route('tasks.store')}}" method="POST" >
                        @csrf
                        <input type="hidden" value="true" name="redirectBack">
                        <div class="row py-3">
                            <div class="col-md-12">

                                <div class="mb-2">
                                    <label for="name" class="form-label">Section:</label>
                                    <select class=" form-control {{$errors->has('section_id') ? 'is-invalid' : ''}}"
                                            name="section_id" required >
{{--                                        @foreach($sections as $section)--}}
                                            <option value="{{$section->id}}">{{ $section->title }}</option>
{{--                                        @endforeach--}}
                                    </select>

                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
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


                                    <textarea id="js-ckeditor-task" name="description" class="form-control form-control-lg form-control-alt
                            {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description"
                                              placeholder="Description"
                                    >
                            {{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                               

                                <div class="mb-2">
                                    <label class="form-label" for="tags">Tags</label>

                                    <div class="row items-push mt-2 tag-div">
                                        @if($tags && count($tags) > 0)
                                            @foreach($tags as $tag)
                                                <div class="col">
                                                    <div class="form-check form-block">
                                                        <input class="form-check-input"
                                                               type="checkbox" value="{{$tag->id}}"
                                                               name="tags[]"
                                                               id="example-checkbox-block-{{$tag->id}}"
                                                        >
                                                        <label class="form-check-label label-check" for="example-checkbox-block-{{$tag->id}}">
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
								<div class="mb-2">
									<label class="form-label" for="status">Task Type</label>

									<select name="task_type" class="form-control">
										<option value="text_video">Text/Video Task</option>
										<option value="quiz">Quiz Task</option>
										<option value="assignment">Assignment Task</option>
									</select>
								</div>
							
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" id="task_published" name="published">
                                    <label class="form-check-label" for="task_published"></label>
                                    <label><b>Published</b></label>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-xl-5 mb-4">
                            <button type="submit" class="btn w-100 btn-alt-success">
                                <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Task
                            </button>
                        </div>

                    </form>
                    <!-- END Edit User Form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Large Block Modal -->
@endsection

@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>

    <script>
         var currsectId = '<?php echo $section->id; ?>';
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
        // One.helpersOnLoad(['js-ckeditor']);
        var allowedContent = true;
		CKEDITOR.replace( 'js-ckeditor',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});
		CKEDITOR.replace( 'js-ckeditor-task',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent
		});

        function openOrderDialog() {

            let module_id = $('#module_id').val();

            let _id = '{{ $section->id }}';
            let _title = '{{ $section->title }}';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/modules/${module_id}/sections`,
                method: 'post',
                success: (res) => {
                    $('#listWithHandle').empty();


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




        // List with handle
        Sortable.create(listWithHandle, {
            handle: '.glyphicon-move',
            animation: 150,
            onEnd: function(evt) {
                let data = {
                    new_index: evt.newIndex+1,
                    old_index: evt.oldIndex+1,
                    item: evt.item.children[1].value,
					currSectionId: currsectId
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `/api/sections/${data.item}/reorder`,
                    method: 'post',
                    data:data,
                    success: (res) => {
						$('#order').val(res.currOrder);
                    },
                    error: () => {
                        alert('Something went wrong')
                    }
                });
            }
        },);

    </script>
@endsection